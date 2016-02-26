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
		$this->load->helper('is_mobile'); //모바일 기기 확인 헬퍼
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

				//본 페이지 로딩
				$this->load->view('/menu/m5/md2_sd1_v');
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