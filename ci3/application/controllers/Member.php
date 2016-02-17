<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('member_m');
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
	// public function _remap($method){
	// 	// 헤더 include
	// 	$this->load->view('header_v');

	// 	if(method_exists($this, $method)){
	// 		$this->{"$method"}();
	// 	}
	// 	// 푸터 include
	// 	$this->load->view('footer_v');
	// }

	/**
	 * [login 로그인 함수]
	 * @return [type] [description]
	 */
	public function login(){
		// 폼 검증 라이브러리 로드
		$this->load->library('form_validation');

		$this->load->helper('alert');

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('user_id', '아이디', 'required|alpha_numeric');
		$this->form_validation->set_rules('passwd', '비밀번호', 'required');

		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

		if($this->form_validation->run() == TRUE) {
			$auth_data = array(
				'user_id' => $this->input->post('user_id', TRUE),
				'passwd' => $this->input->post('passwd', TRUE)
			);

			$result = $this->member_m->login($login_data);

			if($result) {
				// 세션 생성
				$newdata = array(
					'user_id' => $result->user_id,
					'email' => $result->email,
					'logged_in' => TRUE
				);

				$this->session->set_userdata($newdata);

				alert('로그인 되었습니다.', '/ci3/');
				exit;
			}else{
				// 실패 시
				alert('아이디나 비밀번호를 확인해 주세요.', '/ci3/member/login');
				exit;
			}
		}else{
			// 쓰기 form 호출
			$this->load->view('mem/login_v');
		}
	}

	/**
	 * [logout 로그아웃 함수]
	 * @return [type] [description]
	 */
	public function logout(){
		$this->load->helper('alert');
		$this->session->sess_destrou();

		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

		alert('로그아웃 되었습니다.', '/ci3/bbs/board/lists/ci_board/page/1');
	}
}
// End of this File