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
		// 헤더 include
		$this->load->view('/mem/mem_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('/mem/mem_footer');
	}

	/**
	 * [login 로그인 함수]
	 * @return [type] [description]
	 */
	public function login(){
		// 라이브러리 로드
		$this->load->library('form_validation'); // 폼 검증
		$this->load->helper('alert');            // 경고창 사용자 헬퍼

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('user_id', '아이디', 'required|alpha_numeric');
		$this->form_validation->set_rules('passwd', '비밀번호', 'required');

		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

		if($this->form_validation->run() == TRUE) { // 폼 전송 데이타가 있으면,
			$login_data = array(
				'user_id' => $this->input->post('user_id', TRUE),
				'passwd' => md5($this->input->post('passwd', TRUE)),
				'id_rem' => $this->input->post('id_rem',  TRUE)
			);

			$result = $this->mem_m->login($login_data);

			if($result) {
				if($result->request==2){
					alert('관리자 사용 승인 후 사용이 가능합니다.\n승인 지연 시, 직접 관리자에게 문의하여 주세요.\n\nEmail : cigiko@naver.com / 전화문의 : 010-3320-0088', '/ci3');
				}else{
					// 세션 생성
					$newdata = array(
						'user_id' => $result->user_id,
						'email' => $result->email,
						'logged_in' => TRUE
					);

					$this->session->set_userdata($newdata);

					echo "<meta http-equiv='Refresh' content='0; URL=/ci3/main/'>";
					exit;
				}
			}else{ // 아이디 // 비번이 맞지 않을 때
				// 실패 시
				alert('아이디 또는 비밀번호를 확인해 주세요.', '/ci3/member/login');
				exit;
			}
		}else{ // 폼 전송 데이타가 없으면,
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
		$this->session->sess_destroy();

		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

		echo "<meta http-equiv='Refresh' content='0; URL=/ci3/member/'>";
		exit;
	}

	public function join() {
		// 폼 검증 라이브러리 로드
		$this->load->library('form_validation');

		$this->load->helper('alert');

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('user_id', '아이디', 'required|alpha_numeric');
		$this->form_validation->set_rules('passwd', '비밀번호', 'required');

		echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";

		if($this->form_validation->run() == TRUE) {
			$login_data = array(
				'user_id' => $this->input->post('user_id', TRUE),
				'passwd' => md5($this->input->post('passwd', TRUE)),
				'id_rem' => $this->input->post('id_rem',  TRUE)
			);

			$result = $this->mem_m->login($login_data);

			if($result) {
				if($result->request==2){
					alert('관리자 사용 승인 후 사용이 가능합니다.\n승인 지연 시, 직접 관리자에게 문의하여 주세요.\n\nEmail : cigiko@naver.com / 전화문의 : 010-3320-0088', '/ci3');
				}else{
					// 세션 생성
					$newdata = array(
						'user_id' => $result->user_id,
						'email' => $result->email,
						'logged_in' => TRUE
					);

					$this->session->set_userdata($newdata);

					echo "<meta http-equiv='Refresh' content='0; URL=/ci3/main/'>";
					exit;
				}
			}else{
				// 실패 시
				alert('아이디 또는 비밀번호를 확인해 주세요.', '/ci3/member/login');
				exit;
			}
		}else{
			// 쓰기 form 호출
			$this->load->view('mem/join_v');
		}
	}

	public function modify() {
		// 멤버 정보 수정
	}
}
// End of this File