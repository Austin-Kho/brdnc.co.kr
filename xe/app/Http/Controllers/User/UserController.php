<?php
/**
 * @author      XE Developers <developers@xpressengine.com>
 * @copyright   2015 Copyright (C) NAVER Corp. <http://www.navercorp.com>
 * @license     http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html LGPL-2.1
 * @link        https://xpressengine.io
 */

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use XeDB;
use XePresenter;
use XeTheme;
use Xpressengine\Skin\SkinHandler;
use Xpressengine\Support\Exceptions\InvalidArgumentException;
use Xpressengine\Support\Exceptions\InvalidArgumentHttpException;
use Xpressengine\User\EmailBroker;
use Xpressengine\User\Exceptions\CannotDeleteMainEmailOfUserException;
use Xpressengine\User\Exceptions\DisplayNameAlreadyExistsException;
use Xpressengine\User\Exceptions\EmailAlreadyExistsException;
use Xpressengine\User\Exceptions\InvalidConfirmationCodeException;
use Xpressengine\User\Exceptions\InvalidDisplayNameException;
use Xpressengine\User\Exceptions\InvalidPasswordException;
use Xpressengine\User\Exceptions\PendingEmailAlreadyExistsException;
use Xpressengine\User\Exceptions\PendingEmailNotExistsException;
use Xpressengine\User\HttpUserException;
use Xpressengine\User\Repositories\PendingEmailRepositoryInterface;
use Xpressengine\User\Repositories\UserAccountRepositoryInterface;
use Xpressengine\User\Repositories\UserEmailRepositoryInterface;
use Xpressengine\User\UserHandler;
use Xpressengine\User\UserInterface;

class UserController extends Controller
{
    /**
     * @var \Xpressengine\User\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * @var \Xpressengine\User\Repositories\UserGroupRepositoryInterface
     */
    protected $groups;

    /**
     * @var UserEmailRepositoryInterface
     */
    protected $emails;

    /**
     * @var UserHandler
     */
    protected $handler;

    /**
     * @var PendingEmailRepositoryInterface
     */
    protected $pendingMails;

    /**
     * @var UserAccountRepositoryInterface
     */
    protected $accounts;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->handler = app('xe.user');
        $this->users = app('xe.users');
        $this->groups = app('xe.user.groups');
        $this->emails = app('xe.user.emails');
        $this->pendingMails = app('xe.user.pendingEmails');
        $this->accounts = app('xe.user.accounts');

        XeTheme::selectSiteTheme();
        XePresenter::setSkinTargetId('user/settings');
        $this->middleware('auth');
    }

    /**
     * show
     *
     * @param Request $request
     * @param string  $section
     *
     * @return \Xpressengine\Presenter\RendererInterface
     */
    public function show(Request $request, $section = 'settings')
    {
        // remove & move code
        $settingsSection = [
            'settings' => [
                'title' => xe_trans('xe::defaultSettings'),
                'content' => function ($user) {
                    return $this->userEditView($user);
                }
            ]
        ];

        // get sections
        $menus = $this->handler->getSettingsSections();

        // add default settings section
        $menus = array_merge($settingsSection, $menus);

        // get Selected section
        if (isset($menus[$section]) === false) {
            throw new NotFoundHttpException();
        }

        $menus[$section]['selected'] = true;
        $selectedSection = $menus[$section];

        // get current user
        $user = $request->user();

        $content = $selectedSection['content'];
        $selectedSection['selected'] = true;
        $tabContent = $content instanceof \Closure ? $content($user) : $content;

        return XePresenter::make('index', compact('user', 'menus', 'tabContent'));
    }


    /**
     * update DisplayName
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     */
    public function updateDisplayName(Request $request)
    {
        $displayName = $request->get('name');
        $displayName = str_replace('  ', ' ', trim($displayName));

        $user = $request->user();

        XeDB::beginTransaction();
        try {
            $user = $this->handler->update($user, ['display_name' => $displayName]);
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }
        XeDB::commit();

        return XePresenter::makeApi(
            ['type' => 'success', 'message' => 'success', 'displayName' => $displayName]
        );
    }

    /**
     * validate DisplayName
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     * @throws Exception
     */
    public function validateDisplayName(Request $request)
    {
        $name = $request->get('name');
        $name = trim($name);

        $valid = true;
        try {
            $this->handler->validateDisplayName($name);
            $message = '사용 가능한 이름입니다.';
        } catch (DisplayNameAlreadyExistsException $e) {
            $valid = false;
            $message = $e->getMessage();
        } catch (InvalidDisplayNameException $e) {
            $valid = false;
            $message = xe_trans('xe::invalidDisplayName');
        } catch (\Exception $e) {
            throw $e;
        }

        return XePresenter::makeApi(
            ['type' => 'success', 'message' => $message, 'displayName' => $name, 'valid' => $valid]
        );
    }

    /**
     * update Password
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     */
    public function updatePassword(Request $request)
    {

        $this->validate(
            $request,
            ['password' => 'required|confirmed']
        );

        $result = true;
        $message = 'success';
        $target = null;

        if ($request->user()->getAuthPassword() !== "") {

            $credentials = [
                'id' => $request->user()->getId(),
                'password' => $request->get('current_password')
            ];

            if (Auth::validate($credentials) === false) {
                $message = '현재 비밀번호가 틀렸습니다.';
                $target = 'current_password';
                $result = false;
            }
        }

        $password = $request->get('password');

        XeDB::beginTransaction();
        try {
            // save password
            $password = \Hash::make($password);
            $this->handler->update($request->user(), compact('password'));
        } catch (InvalidPasswordException $e) {
            XeDB::rollback();
            throw new HttpException(422, $e->getMessage(), $e);
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }
        XeDB::commit();

        return XePresenter::makeApi(
            ['type' => 'success', 'result' => $result, 'message' => $message, 'target' => $target]
        );
    }

    /**
     * validate Password
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     */
    public function validatePassword(Request $request)
    {
        $password = $request->get('password');
        $password = trim($password);

        try {
            $secure = '';
            if ($this->handler->validatePassword($password)) {
                $levels = app('config')->get('xe.user.password.levels');

                foreach ($levels as $key => $level) {
                    $validate = $level['validate'];
                    if ($validate($password)) {
                        $secure = $key;
                    }
                }
            }
            return XePresenter::makeApi(
                ['type' => 'success', 'message' => 'success', 'valid' => true, 'level' => $secure]
            );
        } catch (\Exception $e) {
            return XePresenter::makeApi(
                ['type' => 'success', 'message' => $e->getMessage(), 'valid' => false]
            );
        }
    }

    /**
     * update user's main email address
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     */
    public function updateMainMail(Request $request)
    {
        $address = $request->get('address');

        if ($request->user()->email === $address) {
            $e = new InvalidArgumentException();
            $e->setMessage('기존 대표 이메일과 동일합니다.');
            throw $e;
        }

        $selected = null;
        foreach ($request->user()->emails as $mail) {
            if ($mail->address === $address) {
                $selected = $mail;
                break;
            }
        }

        // 해당회원이 가진 이메일이 아닐 경우 예외처리한다.
        if ($selected === null) {
            $e = new InvalidArgumentException();
            $e->setMessage('존재하지 않는 이메일입니다.');
            throw $e;
        }

        $request->user()->email = $address;

        XeDB::beginTransaction();
        try {
            $this->users->update($request->user());
        } catch (\Exception $e) {
            XeDB::rollback();
        }
        XeDB::commit();

        \Session::flash('alert', ['type' => 'success', 'message' => '수정되었습니다.']);
        return XePresenter::makeApi(['message' => '수정되었습니다']);
    }

    public function getMailList()
    {
        $user = request()->user();
        $mails = $user->mails;
        if ($mails === null) {
            $mails = $this->emails->findByUserId($user->getId());
        } else {
            $mails = array_values($mails);
        }
        return XePresenter::makeApi(['mails' => $mails]);
    }

    /**
     * add email
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     * @throws Exception
     */
    public function addMail(Request $request)
    {
        $input = $request->only('address');

        // validation
        $this->validate(
            $request,
            [
                'address' => 'email|required'
            ],
            [],
            ['address' => xe_trans('xe::email')]
        );

        // 이미 인증 요청중인 이메일이 있는지 확인한다.
        $useEmailConfirm = $this->handler->usingEmailConfirm();
        if ($useEmailConfirm) {
            if ($request->user()->getPendingEmail() !== null) {
                $e = new PendingEmailAlreadyExistsException();
            }
        }

        // 이미 존재하는 이메일이 있는지 확인한다.
        try {
            $this->handler->validateEmail($input['address']);
        } catch (EmailAlreadyExistsException $e) {
            throw new HttpException(400, xe_trans('xe::emailAlreadyExists'), $e);
        }

        XeDB::beginTransaction();
        try {
            $mail = $this->handler->createEmail($request->user(), $input, !$useEmailConfirm);

            if ($useEmailConfirm) {
                app('xe.auth.email')->sendEmailForAddingEmail($mail);
            }
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }
        XeDB::commit();

        \Session::flash('alert', ['type' => 'success', 'message' => '추가되었습니다.']);
        return XePresenter::makeApi(['message' => '추가되었습니다']);
    }

    /**
     * confirm email
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     * @throws Exception
     */
    public function confirmMail(Request $request)
    {
        $code = $request->get('code');
        $pendingMail = $request->user()->getPendingEmail();

        if ($pendingMail === null) {
            throw new PendingEmailNotExistsException();
        }

        XeDB::beginTransaction();
        try {
            app('xe.auth.email')->confirmEmail($pendingMail, $code);
        } catch (InvalidConfirmationCodeException $e) {
            $e = new InvalidArgumentHttpException();
            $e->setMessage('잘못된 인증 코드입니다. 인증 코드를 확인하시고 다시 입력해주세요.');
            throw $e;
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }
        XeDB::commit();

        \Session::flash('alert', ['type' => 'success', 'message' => '인증되었습니다.']);
        return XePresenter::makeApi(['message' => '인증되었습니다.']);
    }

    /**
     * resend pending email
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     */
    public function resendPendingMail(Request $request)
    {
        $pendingMail = $request->user()->getPendingEmail();

        if ($pendingMail === null) {
            throw new PendingEmailNotExistsException();
        }

        app('xe.auth.email')->sendEmailForAddingEmail($pendingMail);

        return XePresenter::makeApi(['message' => '재전송하였습니다.']);
    }

    /**
     * delete email
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     * @throws Exception
     */
    public function deleteMail(Request $request)
    {
        $address = $request->get('address');

        // 해당회원이 가진 이메일을 찾는다.
        $selected = null;

        $pendingEmail = $request->user()->getPendingEmail();
        if ($pendingEmail !== null && $pendingEmail->getAddress() === $address) {
            $selected = $pendingEmail;
        } else {
            foreach ($request->user()->emails as $mail) {
                if ($mail->address === $address) {
                    $selected = $mail;
                    break;
                }
            }
        }

        // 해당회원이 가진 이메일이 아닐 경우 예외처리한다.
        if ($selected === null) {
            $e = new InvalidArgumentException();
            $e->setMessage('존재하지 않는 이메일입니다.');
            throw $e;
        }

        XeDB::beginTransaction();
        try {
            $this->handler->deleteEmail($selected);
        } catch (CannotDeleteMainEmailOfUserException $e) {
            XeDB::rollback();
            $e = new HttpUserException([], 400, $e);
            $e->setMessage('xe::cannotDeleteMainEmailOfUser');
            throw $e;
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }
        XeDB::commit();

        return XePresenter::makeApi(['message' => '삭제되었습니다.']);
    }

    /**
     * delete user's pending email
     *
     * @param Request $request
     *
     * @return \Xpressengine\Presenter\RendererInterface
     * @throws Exception
     */
    public function deletePendingMail(Request $request)
    {
        return $this->deleteMail($request);
    }

    /**
     * leave
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function leave(Request $request)
    {
        $confirm = $request->get('confirm_leave');

        if ($confirm !== 'Y') {
            $e = new InvalidArgumentException();
            $e->setMessage('약관의 동의가 필요합니다.');
            throw $e;
        }

        $id = $request->user()->getId();

        XeDB::beginTransaction();
        try {
            $this->handler->leave($id);
        } catch (\Exception $e) {
            XeDB::rollback();
            throw $e;
        }
        XeDB::commit();

        Auth::logout();

        return redirect()->to('/');
    }

    /**
     * show user info page
     *
     * @param UserInterface $user
     *
     * @return $this
     */
    private function userEditView(UserInterface $user)
    {
        // dynamic field
        $dynamicField = app('xe.dynamicField');
        $fieldTypes = $dynamicField->gets('user');

        // password configuration
        $passwordConfig = app('config')->get('xe.user.password');
        $passwordLevel = array_get($passwordConfig['levels'], $passwordConfig['default']);

        app('xe.frontend')->js(
            ['assets/core/xe-ui-component/js/xe-form.js', 'assets/core/xe-ui-component/js/xe-page.js']
        )->load();

        /** @var SkinHandler $skinHandler */
        $skinHandler = app('xe.skin');
        $skin = $skinHandler->getAssigned('user/settings');
        return $skin->setView('edit')->setData(compact('user', 'fieldTypes', 'passwordLevel'));
    }

    public function showAdditionField($field)
    {
        $dynamicField = app('xe.dynamicField');
        $fieldType = $dynamicField->get('user', $field);

        $user = request()->user();

        /** @var SkinHandler $skinHandler */
        $skinHandler = app('xe.skin');
        $skin = $skinHandler->getAssigned('user/settings');
        $id = $field;
        $view = $skin->setView('show-field')->setData(compact('user', 'fieldType', 'id'))->render();

        return XePresenter::makeApi(
            [
                'result' => (string) $view,
                'data' => compact('id'),
                'XE_ASSET_LOAD' => [
                    'css' => \Xpressengine\Presenter\Html\Tags\CSSFile::getFileList(),
                    'js' => \Xpressengine\Presenter\Html\Tags\JSFile::getFileList(),
                ],
            ]
        );
    }

    public function editAdditionField($field)
    {
        $dynamicField = app('xe.dynamicField');
        $fieldType = $dynamicField->get('user', $field);

        $user = request()->user();

        /** @var SkinHandler $skinHandler */
        $skinHandler = app('xe.skin');
        $skin = $skinHandler->getAssigned('user/settings');
        $id = $field;
        $view = $skin->setView('edit-field')->setData(compact('user', 'fieldType', 'id'))->render();

        return XePresenter::makeApi(
            [
                'result' => (string) $view,
                'data' => compact('id'),
                'XE_ASSET_LOAD' => [
                    'css' => \Xpressengine\Presenter\Html\Tags\CSSFile::getFileList('head.append'),
                    'js' => \Xpressengine\Presenter\Html\Tags\JSFile::getFileList('body.append'),
                ],
            ]
        );
    }

    public function updateAdditionField(Request $request, $field)
    {
        $inputs = $request->except('_token');
        $user = $request->user();
        $user = $this->handler->update($user, $inputs);
        $showUrl = route('user.settings.additions.show', ['field' => $field]);

        return XePresenter::makeApi(
            ['type' => 'success', 'message' => 'success', 'field' => $field, 'showUrl' => $showUrl]
        );
    }
}
