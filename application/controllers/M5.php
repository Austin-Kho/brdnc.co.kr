<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M5 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			echo "<meta http-equiv='Refresh' content='0; URL=".$this->config->base_url()."member/'>";
			exit;
		}

		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m5_m'); //모델 파일 로드
		$this->load->helper('is_mobile'); //모바일 기기 확인 헬퍼
		$this->load->helper('alert'); // 경고창 헤퍼 로딩
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->config();
	}

	function _remap($method){ // $method 는 현재 호출된 함수
		// 헤더 include
		$this->load->view('cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_main_footer');
	}

	public function config($mdi='', $sdi=''){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		if( !$this->uri->segment(3)) $mdi = 1; else $mdi = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $sdi = 1; else $sdi = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('부서 관리', '직원 관리', '거래처 정보', '계좌 관리'), // 첫번째 하위 메뉴
			array('회사 정보', '권한 관리'),                          // 두번째 하위 메뉴
			array('부서 정보 관리', '직원 정보 관리', '거래처 정보 정보', '은행계좌 관리'), // 첫번째 하위 제목
			array('회사 기본 정보', '사용자 권한관리')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m5/config_v', $menu);


		// 기본정보관리 1. 부서관리 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_1'] or $auth['_m5_1_1']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd1_v');
			}






		// 기본정보관리 2. 직원관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_2'] or $auth['_m5_1_2']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd2_v');
			}






		// 기본정보관리 3. 거래처정보 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_3', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_3'] or $auth['_m5_1_3']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd3_v');
			}






		// 기본정보관리 4. 계좌관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==4) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_4', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_4'] or $auth['_m5_1_4']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd4_v');
			}






		// 회사정보관리 1. 회사정보 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m5_2_1'] or $auth['_m5_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				//// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('co_name', '회사명', 'required');
				$this->form_validation->set_rules('co_no1', '사업자등록번호', 'required|numeric');
				$this->form_validation->set_rules('co_no2', '사업자등록번호', 'required|numeric');
				$this->form_validation->set_rules('co_no3', '사업자등록번호', 'required|numeric');
				$this->form_validation->set_rules('co_form', '회사형태', 'required');
				$this->form_validation->set_rules('ceo', '대표자', 'required');
				$this->form_validation->set_rules('or_no1', '법인등록번호', 'required|numeric');
				$this->form_validation->set_rules('or_no2', '법인등록번호', 'required|numeric');
				$this->form_validation->set_rules('sur', '부가세신고주기', 'required');
				$this->form_validation->set_rules('biz_cond', '업태', 'required');
				$this->form_validation->set_rules('biz_even', '종목', 'required');
				$this->form_validation->set_rules('co_phone1', '대표전화', 'required|numeric');
				$this->form_validation->set_rules('co_phone2', '대표전화', 'required|numeric');
				$this->form_validation->set_rules('co_phone3', '대표전화', 'required|numeric');
				$this->form_validation->set_rules('co_hp1', '휴대전화', 'required|numeric');
				$this->form_validation->set_rules('co_hp2', '휴대전화', 'required|numeric');
				$this->form_validation->set_rules('co_hp3', '휴대전화', 'required|numeric');
				$this->form_validation->set_rules('co_fax1', '팩스번호', 'numeric');
				$this->form_validation->set_rules('co_fax2', '팩스번호', 'numeric');
				$this->form_validation->set_rules('co_fax3', '팩스번호', 'numeric');
				$this->form_validation->set_rules('es_date', '설립일', 'required');
				$this->form_validation->set_rules('op_date', '개업일', 'required');
				$this->form_validation->set_rules('carr_y', '기초잔액입력월', 'required');
				$this->form_validation->set_rules('carr_m', '기초잔액입력월', 'required');
				$this->form_validation->set_rules('m_wo_st', '업무개시월', 'required');
				$this->form_validation->set_rules('bl_cycle', '결산주기', 'required');
				$this->form_validation->set_rules('email1', '이메일', 'required|alpha_numeric');
				$this->form_validation->set_rules('emai2', '이메일', 'required|alpha_numeric');
				$this->form_validation->set_rules('calc_mail1', '세금계산서메일', 'required|alpha_numeric');
				$this->form_validation->set_rules('calc_mail2', '세금계산서메일', 'required|alpha_numeric');
				$this->form_validation->set_rules('tax_off1_code', '세무서1코드', 'required');
				$this->form_validation->set_rules('tax_off1_name', '세무서1이름', 'required');
				$this->form_validation->set_rules('zipcode', '우편번호', 'required|numeric');
				$this->form_validation->set_rules('address1', '주소1', 'required');
				$this->form_validation->set_rules('address2', '주소2', 'required');
				$this->form_validation->set_rules('en_co_name', '영문회사명', 'alpha_numeric');
				$this->form_validation->set_rules('en_address', '영문주소	', 'alpha_numeric');

				echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";

				// 회사 등록 정보가 있는지 확인
				$com_chk = $this->m5_m->is_com_chk();
				if( !$com_chk) {
					$com = array( // 없으면 등록권한 및 새로 등록하라는 변수 전달
						'auth' => $auth['_m5_2_1'],
						'mode' => 'com_reg'
					);
				}  else {
					$com = array( // 있으면 등록권한, 등록회사정보 및 수정하라는 변수 전달
						'auth' => $auth['_m5_2_1'],
						'com' => $com_chk,
						'mode' => 'com_modify'
					);
				}

				if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,
					//본 페이지 로딩
					$this->load->view('/menu/m5/md2_sd1_v', $com); // 조회권한 있고 폼 전송 데이타가 없을 때 등록권한 데이터 및 등록데이터와 함께 폼 열기
				}else{
					//폼 데이타 가공
					$co_no = $this->input->post('co_no1')."-".$this->input->post('co_no2')."-".$this->input->post('co_no3');
					$or_no = $this->input->post('or_no1')."-".$this->input->post('or_no2');
					$co_phone = $this->input->post('co_phone1').'-'.$this->input->post('co_phone2').'-'.$this->input->post('co_phone3');
					$co_hp = $this->input->post('co_hp1').'-'.$this->input->post('co_hp2').'-'.$this->input->post('co_hp3');
					$co_fax = $this->input->post('co_fax1').'-'.$this->input->post('co_fax2').'-'.$this->input->post('co_fax3');
					$carr = $this->input->post('carr_y').'-'.$this->input->post('carr_m');
					$email = $this->input->post('email1').'@'.$this->input->post('email2');
					$calc_mail = $this->input->post('calc_mail1').'@'.$this->input->post('calc_mail2');

					$com_data = array(
						'co_name' => $this->input->post('co_name', TRUE),
						'co_no' => $co_no,
						'co_form' => $this->input->post('co_form', TRUE),
						'ceo' => $this->input->post('ceo', TRUE),
						'or_no' => $or_no,
						'sur' => $this->input->post('sur', TRUE),
						'biz_cond' => $this->input->post('biz_cond', TRUE),
						'biz_even' => $this->input->post('biz_even', TRUE),
						'co_phone' => $co_phone,
						'co_hp' => $co_hp,
						'co_fax' => $co_fax,
						'co_div1' => $this->input->post('co_div1', TRUE),
						'co_div2' => $this->input->post('co_div2', TRUE),
						'co_div3' => $this->input->post('co_div3', TRUE),
						'es_date' => $this->input->post('es_date', TRUE),
						'op_date' => $this->input->post('op_date', TRUE),
						'carr' => $carr,
						'm_wo_st' => $this->input->post('m_wo_st', TRUE),
						'bl_cycle' => $this->input->post('bl_cycle', TRUE),
						'email' => $email,
						'calc_mail' => $calc_mail,
						'tax_off1_code' => $this->input->post('tax_off1_code', TRUE),
						'tax_off1_name' => $this->input->post('tax_off1_name', TRUE),
						'tax_off2_code' => $this->input->post('tax_off2_code', TRUE),
						'tax_off2_name' => $this->input->post('tax_off2_name', TRUE),
						'zipcode' => $this->input->post('zipcode', TRUE),
						'address1' => $this->input->post('address1', TRUE),
						'address2' => $this->input->post('address2', TRUE),
						'en_co_name' => $this->input->post('en_co_name', TRUE),
						'en_address' => $this->input->post('en_address', TRUE),
						'red_date' => 'now()'
					);

				if($com ['mode']=='com_reg') {
					$result = $this->m5_m->com_reg($com_data);
				}else if($com ['mode']=='com_modify') {
					$result = $this->m5_m->com_reg($com_modify);
				}

				// $result = $this->m5_m->com_reg($com_data);

				if($result) {
					// 등록 성공 시
					alert_only('회사 정보가 '.$result.'등록 되었습니다.', '/m5/config/2/1/');
					//exit;
				}else{ // 등록 실패 시
					// 실패 시
					alert_only('회사 정보등록이 실해하였습니다.\n 다시 시도하여 주십시요.', '/m5/config/2/1/');
					//exit;
				}
			}
		}



		// 권한정보관리 1. 권한관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m5_2_2'] or $auth['_m5_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m5/md2_sd2_v');
			}
		}
	}
}
// End of this File