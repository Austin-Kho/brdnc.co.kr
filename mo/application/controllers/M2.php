<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M2 extends CI_Controller {

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
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->local();
	}

	public function _remap($method){
		// 헤더 include
		$this->load->view('cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_main_footer');
	}

	public function local($mdi='', $sdi=''){
		//$this->output->enable_profiler(TRUE); //프로파일러 보기//

		if( !$this->uri->segment(3)) $mdi = 1; else $mdi = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $sdi = 1; else $sdi = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('전도금 내역', '입출 등록', '전도금 현황'), // 첫번째 하위 메뉴
			array('인원 현황', '인원 등록', '소속 관리'),                          // 두번째 하위 메뉴
			array('현장 전도금 입출내역', '현장 전도금 입출등록', '전체 현장별 전도금 현황'), // 첫번째 하위 제목
			array('현장별 조직 및 인원 현황', '현장별 조직 및 인원 등록', '현장 관계자 소속 관리')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m2/local_v', $menu);

		// 전도금 관리 1. 전도금 내역 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m2_1_1'] or $auth['_m2_1_1']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m2/md1_sd1_v');
			}






		// 전도금 관리 2. 입출내역 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m2_1_2'] or $auth['_m2_1_2']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m2/md1_sd2_v');
			}






		// 전도금 관리 3. 전도금 현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_1_3', $this->session->userdata['user_id']);

			if( !$auth['_m2_1_3'] or $auth['_m2_1_3']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m2/md1_sd3_v');
			}



		// 투입자원 관리 4. 인원현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m2_2_1'] or $auth['_m2_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m2/md2_sd1_v');
			}





		// 투입자원 관리 1. 인원 등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m2_2_2'] or $auth['_m2_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m2/md2_sd2_v');
			}





		// 투입자원 관리 1. 소속 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_2_3', $this->session->userdata['user_id']);

			if( !$auth['_m2_2_3'] or $auth['_m2_2_3']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m2/md2_sd3_v');
			}
		}
	}
}
// End of this File