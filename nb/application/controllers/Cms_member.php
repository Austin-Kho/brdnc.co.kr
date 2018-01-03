<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cms_member extends CB_Controller
{

	protected $helpers = array('form', 'array', 'string');

	public function __construct(){
		parent::__construct();
		$this->load->model('cms_member_model');
	}

	/**
	 * [_remap 헤더, 푸터가 자동으로 추가된다.]
	 * @return [type] [description]
	 */
	public function _remap($method){
		//헤더 include
		$this->load->view('/cms_views/mem/mem_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		//푸터 include
		$this->load->view('/cms_views/mem/mem_footer');
	}

	/**
	 * [index 메서드 생략시 기본 실행 메서드]
	 * @return [type] [description]
	 */
	public function index(){
		$this->login();
	}

	/**
	 * [login 로그인 함수]
	 * @return [type] [description]
	 */
	public function login(){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		// 라이브러리 로드
		$this->load->library('form_validation'); // 폼 검증
		$this->load->helper('cookie');  // 쿠키 헬퍼 로딩

		// if ( ! function_exists('password_hash')) {
		// 	 $this->load->helper('password');
	  // }

		$use_login_account = $this->cbconfig->item('use_login_account');

		/**
		 * 전송된 데이터의 유효성을 체크합니다.
		 */
		if ($use_login_account === 'both') {
				$config[] = array(
						'field' => 'user_data',
						'label' => '아이디 또는 이메일',
						'rules' => 'trim|required',
				);
				$view['view']['userid_label_text'] = '아이디 또는 이메일';
		} elseif ($use_login_account === 'email') {
				$config[] = array(
						'field' => 'user_data',
						'label' => '이메일',
						'rules' => 'trim|required|valid_email',
				);
				$view['view']['userid_label_text'] = '이메일';
		} else {
				$config[] = array(
						'field' => 'user_data',
						'label' => '아이디',
						'rules' => 'trim|required|alphanumunder|min_length[3]|max_length[20]',
				);
				$view['view']['userid_label_text'] = '아이디';
		}
		$config[] = array(  //// _check_id_pw - 아이디 비번 검증 롤백 함수 실행
				'field' => 'mem_password',
				'label' => '패스워드',
				'rules' => 'trim|required|min_length[4]|callback__check_id_pw['.$this->input->post('user_data').']',
		);

		$this->form_validation->set_rules($config);


		/**
		 * 유효성 검사를 하지 않는 경우, 또는 유효성 검사에 실패한 경우입니다.
		 * 즉 글쓰기나 수정 페이지를 보고 있는 경우입니다
		 */
		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,

			// view 파일 -> 쓰기 form 호출
			$this->load->view('/cms_views/mem/login_v', array('returnURL' => $this->input->get('returnURL')));

		}else{   // 폼 전송 데이타가 있으면,
		/**
		 * 유효성 검사를 통과한 경우입니다.
		 * 즉 데이터의 insert 나 update 의 process 처리가 필요한 상황입니다
		 */

			if ($use_login_account === 'both') {
				$userinfo = $this->Member_model->get_by_both($this->input->post('user_data'), 'mem_id, mem_userid, mem_username, request, mem_is_admin');
			} elseif ($use_login_account === 'email') {
				$userinfo = $this->Member_model->get_by_email($this->input->post('user_data'), 'mem_id, mem_userid, mem_username, request, mem_is_admin');
			} else {
				$userinfo = $this->Member_model->get_by_userid($this->input->post('user_data'), 'mem_id, mem_userid, mem_username, request, mem_is_admin');
			}

			// 승인 전 비관리자 회원인 경우 안내
			if($userinfo['request'] !=='1' && $userinfo[mem_is_admin] !== '1'){
				alert('관리자 사용 승인 후 사용이 가능합니다.\n승인 지연 시, 직접 관리자에게 문의하여 주세요.\n\nEmail : kori.susie@gmail.com / 전화문의 : 010-3320-0088', base_url('/cms_member/'));
			}

			// 로그인 처리 및 세션 데이터 생성
			$this->member->update_login_log(element('mem_id', $userinfo), $this->input->post('user_data'), 1, '로그인 성공');
			$user_sess_data = array(
				'mem_id' => $userinfo['mem_id'],
				'mem_userid' => $userinfo['mem_userid'],
				'mem_username' => $userinfo['mem_username'],
				'mem_is_admin' => $userinfo['mem_is_admin'],
				'logged_in' => TRUE
			);
			$this->session->set_userdata($user_sess_data);

			// 로그인 후 리다이렉션
			if( !$this->input->post('returnURL') OR $this->input->post('returnURL')=='') $returnURL = base_url(); else  $returnURL = $this->input->post('returnURL');
			redirect(rawurldecode($returnURL));
		}
	}

	/**
	 * 로그인시 아이디와 패스워드가 일치하는지 체크합니다. 로그인 시 폼 검증 과정에서 실행되는 콜백함수.
	 */
	public function _check_id_pw($password, $userid) {
		if ( ! function_exists('password_hash')) {
			$this->load->helper('password');
		}

		$max_login_try_count = (int) $this->cbconfig->item('max_login_try_count');
		$max_login_try_limit_second = (int) $this->cbconfig->item('max_login_try_limit_second');

		$loginfailnum = 0;
		$loginfailmessage = '';
		if ($max_login_try_count && $max_login_try_limit_second) {
			$select = 'mll_id, mll_success, mem_id, mll_ip, mll_datetime';
			$where = array(
				'mll_ip' => $this->input->ip_address(),
				'mll_datetime > ' => strtotime(ctimestamp() - 86400 * 30),
			);
			$this->load->model('Member_login_log_model');
			$logindata = $this->Member_login_log_model->get('', $select, $where, '', '', 'mll_id', 'DESC');

			if ($logindata && is_array($logindata)) {
				foreach ($logindata as $key => $val) {
					if ((int) $val['mll_success'] === 0) {
						$loginfailnum++;
					} elseif ((int) $val['mll_success'] === 1) {
						break;
					}
				}
			}
			if ($loginfailnum > 0 && $loginfailnum % $max_login_try_count === 0) {
				$lastlogintrydatetime = $logindata[0]['mll_datetime'];
				$next_login = strtotime($lastlogintrydatetime) + $max_login_try_limit_second - ctimestamp();
				if ($next_login > 0) {
					$this->form_validation->set_message(
						'_check_id_pw',
						'회원님은 패스워드를 연속으로 '. $loginfailnum.'회 잘못 입력하셨기 때문에 '.$next_login .'초 후에 다시 로그인 시도가 가능합니다.'
					);
					return false;
				}
			}
			$loginfailmessage = '<br />회원님은 '.($loginfailnum + 1).'회 연속으로 패스워드를 잘못입력하셨습니다.';
		}

		$use_login_account = $this->cbconfig->item('use_login_account');

		$this->load->model(array('Member_dormant_model'));

		$userselect = 'mem_id, mem_password, mem_denied, mem_email_cert, mem_is_admin';
		$is_dormant_member = false;
		if ($use_login_account === 'both') {
			$userinfo = $this->Member_model->get_by_both($userid, $userselect);
			if ( ! $userinfo) {
				$userinfo = $this->Member_dormant_model->get_by_both($userid, $userselect);
				if ($userinfo) {$is_dormant_member = true;}
			}
		} elseif ($use_login_account === 'email') {
			$userinfo = $this->Member_model->get_by_email($userid, $userselect);
			if ( ! $userinfo) {
				$userinfo = $this->Member_dormant_model->get_by_email($userid, $userselect);
				if ($userinfo) {$is_dormant_member = true;}
			}
		} else {
			$userinfo = $this->Member_model->get_by_userid($userid, $userselect);
			if (! $userinfo) {
				$userinfo = $this->Member_dormant_model->get_by_userid($userid, $userselect);
				if ($userinfo) {$is_dormant_member = true;}
			}
		}
		$hash = password_hash($password, PASSWORD_BCRYPT);

		if ( ! element('mem_id', $userinfo) OR ! element('mem_password', $userinfo)) {
			$this->member->update_login_log(0, $userid, 0, '회원 아이디가 존재하지 않습니다.');
			// return false;
			alert('회원 아이디와 패스워드가 서로 맞지 않습니다.','cms_member');
		} elseif ( ! password_verify($password, element('mem_password', $userinfo))) {
			$this->member->update_login_log(element('mem_id', $userinfo), $userid, 0, '패스워드가 올바르지 않습니다.');
			alert('회원 아이디와 패스워드가 서로 맞지 않습니다.','cms_member');
		} elseif (element('mem_denied', $userinfo)) {
			$this->member->update_login_log(element('mem_id', $userinfo), $userid, 0, '접근이 금지된 아이디입니다.');
			// return false;
			alert('접근이 금지된 아이디입니다.','cms_member');
		} elseif ($this->cbconfig->item('use_register_email_auth') && ! element('mem_email_cert', $userinfo)) {
			$this->member->update_login_log(element('mem_id', $userinfo), $userid, 0, '이메일 인증을 받지 않은 회원아이디입니다.');
			alert('회원님은 아직 이메일 인증을 받지 않으셨습니다.','cms_member');
		} elseif (element('mem_is_admin', $userinfo) && $this->input->post('autologin')) {
			// $this->form_validation->set_message('_check_id_pw', '최고관리자는 자동로그인 기능을 사용할 수 없습니다.');
			// return false;
			alert('최고관리자는 자동로그인 기능을 사용할 수 없습니다.','cms_member');
		}

		if ($is_dormant_member === true) {
			$this->member->recover_from_dormant(element('mem_id', $userinfo));
		}
		return true;
	}

	/**
	 * [logout 로그아웃 함수]
	 * @return [type] [description]
	 */
	public function logout(){
		$return = $this->input->get('returnURL');
		$this->session->sess_destroy();
		redirect(base_url('cms_member').'?returnURL='.rawurlencode($return));
	}

	/**
	 * [join 회원가입 함수]
	 * @return [type] [description]
	 */
	public function join() {
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		// 라이브러리 로드
		$this->load->library('form_validation'); // 폼 검증
		$this->load->helper('alert');  // 경고창 사용자 헬퍼 로딩

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('mem_username', '이름', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('mem_userid', '아이디', 'trim|required|alpha_numeric|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('mem_email', '이메일', 'trim|required|valid_email|max_length[50]');
		$this->form_validation->set_rules('mem_password', '비밀번호', 'trim|required|min_length[5]|matches[mem_passconf]|max_length[200]');
		$this->form_validation->set_rules('mem_passconf', '비밀번호 확인', 'trim|required|max_length[200]');

		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,

			// view 파일 -> 쓰기 form 호출
			$this->load->view('/cms_views/mem/join_v');

		}else{ // 폼 전송 데이타가 있으면,

			$join_data = array(
				'mem_username' => $this->input->post('mem_username', TRUE),
				'mem_userid' => $this->input->post('mem_userid', TRUE),
				'mem_email' => $this->input->post('mem_email', TRUE),
				'mem_password' => password_hash($this->input->post('mem_password', TRUE), PASSWORD_BCRYPT)
			);

			$result = $this->cms_member_model->join($join_data);

			if($result) {
				// 등록 성공 시
				alert('등록 되었습니다. \n 관리자의 승인 후 로그인 하여 주십시요.', base_url('cms_member/login'));
			}else{ // 아이디 // 비번이 맞지 않을 때
				// 실패 시
				alert('계정등록에 실패하였습니다.\n 다시 시도하여 주십시요.', base_url('cms_member/join'));
				exit;
			}
		} // 폼 검증 종료
	} // fucntion join 종료

	/**
	 * [user_id_chk 생성아이디 중복확인 콜백 함수]
	 * @return [boolean] [아이디 중복 여부]
	 */
	public function modify() {
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		// 라이브러리 로드
		$this->load->library('form_validation'); // 폼 검증

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('mem_username', '이름', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('mem_userid', '아이디', 'trim|required|alpha_numeric|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('mem_email', '이메일', 'trim|required|valid_email|max_length[50]');
		$this->form_validation->set_rules('mem_password', '비밀번호', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('new_password', '새 비밀번호', 'trim|min_length[5]|matches[new_passconf]|max_length[200]');
		$this->form_validation->set_rules('new_passconf', '비밀번호 확인', 'trim|max_length[200]');

		// 세션 사용자 정보 가져오기
		// 회원가입과 달리 정보수정화면에서 내용을 보여주고 수정하기 때문에 유저정보를 가져오는 부분 추가
		$data['user'] = $this->cms_member_model->user_chk($this->session->userdata('mem_id'));

		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으으면,

			// view 파일 -> 쓰기 form 호출
			$this->load->view('/cms_views/mem/modify_v', $data);

		}else{ // 폼 전송 데이타가 있으면,

			// 유저정보가 있고, 패스워드가 맞는 경우
			if( !empty($data['user']) && password_verify($this->input->post('mem_password'), $data['user']->mem_password)){
				$modify_data = array(
					'mem_username' => $this->input->post('mem_username', TRUE),
					'mem_userid' => $this->input->post('mem_userid', TRUE),
					'mem_email' => $this->input->post('mem_email', TRUE),
					'new_password' => $this->input->post('new_password', TRUE)   // 여기서는 해쉬하지 않는다 // 값이 없어도 해쉬값이 생성되기 때문
				);

				$result = $this->cms_member_model->modify($modify_data);

				if($result) {
					// 등록 성공 시
					alert('사용자 정보가 변경 되었습니다.', base_url());
					exit;
				}else{ // 아이디 // 비번이 맞지 않을 때
					// 실패 시
					alert('데이터베이스 에러가 발생하였습니다.', base_url('cms_member/modify'));
					exit;
				}
			}else{ // 유저정보가 틀린 경우
				alert('입력하신 기존 비밀번호가 맞지 않습니다.', base_url('cms_member/modify'));
			}
		} // 폼 검증 종료
	} // modify() 함수 종료
} // cms_member class 종료
// End of this File
