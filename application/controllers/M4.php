<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M4 extends CI_Controller {

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
		$this->project();
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

	public function project($mdi='', $sdi=''){
		//$this->output->enable_profiler(TRUE); //프로파일러 보기//

		if( !$this->uri->segment(3)) $mdi = 1; else $mdi = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $sdi = 1; else $sdi = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('데이터 등록', '데이터 수정'), // 첫번째 하위 메뉴
			array('검토 현장', '현장 등록'),                          // 두번째 하위 메뉴
			array('동호수 데이터 입력', '기본정보 수정'), // 첫번째 하위 제목
			array('프로젝트 검토 현황', '신규 프로젝트 등록')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m4/project_v', $menu);

		// 프로젝트 관리 1. 데이터등록 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m4_1_1'] or $auth['_m4_1_1']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m4/md1_sd1_v');
			}

		// 프로젝트 관리 2. 데이터수정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m4_1_2'] or $auth['_m4_1_2']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m4/md1_sd2_v');
			}





		// 신규 프로젝트 1. 검토현장 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m4_2_1'] or $auth['_m4_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m4/md2_sd1_v');
			}





		// 신규 프로젝트 1. 현장등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m4_2_2'] or $auth['_m4_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				//본 페이지 로딩
				$this->load->view('/menu/m4/md2_sd2_v');
			}
		}
	}
}
// End of this File