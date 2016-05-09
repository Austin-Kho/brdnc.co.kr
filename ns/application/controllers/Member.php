<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('mem_m');
		$this->load->helper('form');
	}

	/**
	 * [index 메서드 생략시 기본 실행 메서드]
	 * @return [type] [description]
	 */
	public function index(){
		$this->login();
	}

	/**
	 * [_remap 헤더, 푸터가 자동으로 추가된다.]
	 * @return [type] [description]
	 */
	public function _remap($method){
		//헤더 include
		$this->load->view('/mem/mem_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		//푸터 include
		$this->load->view('/mem/mem_footer');
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

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('user_data', '아이디 또는 이메일', 'trim|required');
		$this->form_validation->set_rules('passwd', '비밀번호', 'trim|required');

		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,

			// view 파일 -> 쓰기 form 호출
			$this->load->view('mem/login_v', array('returnURL' => $this->input->get('returnURL')));

		}else{   // 폼 전송 데이타가 있으면,

			// 일단 유저 데이터를 불러온다
			$user = $this->mem_m->user_chk($this->input->post('user_data', TRUE));

			// 패스워드 해쉬 파일이 없을 경우 패스워드 헬퍼 호출
			if( !function_exists('password_hash')){
				$this->load->helper('password');
			}
			// 유저 정보가 있고 패스워드가 맞는 경우
			if( !empty($user) && password_verify($this->input->post('passwd'), $user->passwd)){
				if($user->request != 1 && $user->is_admin!=1){// 승인전 비관리자 회원인 경우 안내
					alert('관리자 사용 승인 후 사용이 가능합니다.\n승인 지연 시, 직접 관리자에게 문의하여 주세요.\n\nEmail : cigiko@naver.com / 전화문의 : 010-3320-0088', base_url('/member/'));
				}else{ // 승인된 사용자인 경우
					// 세션 생성
					$user_data = array(
						'is_admin' => $user->is_admin,
						'user_id' => $user->user_id,
						'name' => $user->name,
						'email' => $user->email,
						'logged_in' => TRUE
					);
					$this->session->set_userdata($user_data);

					if($this->input->post('id_rem') =='rem') {        // 쿠키 저장 체크가 되어 있으면
						if( !get_cookie('id_r')) { // 실제 쿠키가 없으면 만들고
	    					set_cookie('id_r', 'rem', 1000000);
	    					set_cookie('id', $this->input->post('user_data'), 1000000);
						}
					}else{   // 쿠키 저장 체크가 되어 있지 않으면 ,쿠키를 파괴하라
						delete_cookie('id_r');
						delete_cookie('id');
					}
					if( !$this->input->post('returnURL') OR $this->input->post('returnURL')=='') $returnURL = "main"; else  $returnURL = $this->input->post('returnURL');
					redirect(rawurldecode($returnURL));
				}
			}else{
				alert('아이디 또는 비밀번호를 확인해 주세요.', base_url('/member/'));
			}
		}
	}

	/**
	 * [logout 로그아웃 함수]
	 * @return [type] [description]
	 */
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('member'));
	}

	public function join() {
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		// 라이브러리 로드
		$this->load->library('form_validation'); // 폼 검증
		$this->load->helper('alert');  // 경고창 사용자 헬퍼 로딩

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('name', '이름', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('user_id', '아이디', 'trim|required|alpha_numeric|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email|max_length[50]');
		$this->form_validation->set_rules('passwd', '비밀번호', 'trim|required|min_length[5]|matches[passcf]|max_length[200]');
		$this->form_validation->set_rules('passcf', '비밀번호 확인', 'trim|required|max_length[200]');

		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,

			// view 파일 -> 쓰기 form 호출
			$this->load->view('mem/join_v');

		}else{ // 폼 전송 데이타가 있으면,

			$join_data = array(
				'name' => $this->input->post('name', TRUE),
				'user_id' => $this->input->post('user_id', TRUE),
				'email' => $this->input->post('email', TRUE),
				'passwd' => password_hash($this->input->post('passwd', TRUE), PASSWORD_BCRYPT)
			);

			$result = $this->mem_m->join($join_data);

			if($result) {
				// 등록 성공 시
				alert('등록 되었습니다. \n 관리자의 승인 후 로그인 하여 주십시요.', base_url('member/login'));
			}else{ // 아이디 // 비번이 맞지 않을 때
				// 실패 시
				alert('계정등록에 실패하였습니다.\n 다시 시도하여 주십시요.', base_url('member/join'));
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
		$this->load->helper('alert');  // 경고창 사용자 헬퍼 로딩

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('name', '이름', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('user_id', '아이디', 'trim|required|alpha_numeric|min_length[5]|max_length[15]');
		$this->form_validation->set_rules('email', '이메일', 'trim|required|valid_email|max_length[50]');
		$this->form_validation->set_rules('passwd', '비밀번호', 'trim|required|max_length[200]');
		$this->form_validation->set_rules('new_pass', '새 비밀번호', 'trim|min_length[5]|matches[passcf]|max_length[200]');
		$this->form_validation->set_rules('passcf', '비밀번호 확인', 'trim|max_length[200]');

		// 세션 사용자 정보 가져오기
		// 회원가입과 달리 정보수정화면에서 내용을 보여주고 수정하기 때문에 유저정보를 가져오는 부분 추가
		$data['user'] = $this->mem_m->user_chk($this->session->userdata('user_id'));

		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으으면,

			// view 파일 -> 쓰기 form 호출
			$this->load->view('mem/modify_v', $data);

		}else{ // 폼 전송 데이타가 있으면,

			// 패스워드 해쉬 파일이 없을 경우 패스워드 헬퍼 호출
			if( !function_exists('password_hash')){
				$this->load->helper('password');
			}
			// 유저정보가 있고, 패스워드가 맞는 경우
			if( !empty($data['user']) && password_verify($this->input->post('passwd'), $data['user']->passwd)){
				$modify_data = array(
					'name' => $this->input->post('name', TRUE),
					'user_id' => $this->input->post('user_id', TRUE),
					'email' => $this->input->post('email', TRUE),
					'new_pass' => $this->input->post('new_pass', TRUE)   // 여기서는 해쉬하지 않는다 // 값이 없어도 해쉬값이 생성되기 때문
				);

				$result = $this->mem_m->modify($modify_data);

				if($result) {
					// 등록 성공 시
					alert('사용자 정보가 변경 되었습니다.', base_url('main'));
					exit;
				}else{ // 아이디 // 비번이 맞지 않을 때
					// 실패 시
					alert('데이터베이스 에러가 발생하였습니다.', base_url('member/modify'));
					exit;
				}
			}else{ // 유저정보가 틀린 경우
				alert('입력하신 기존 비밀번호가 맞지 않습니다.', base_url('member/modify'));
			}
		} // 폼 검증 종료
	} // modify() 함수 종료
} // member class 종료
// End of this File
