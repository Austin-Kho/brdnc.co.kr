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

		if( !$this->uri->segment(3)) $m_di = 1; else $m_di = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $s_di = 1; else $s_di = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('데이터 등록', '데이터 수정'), // 첫번째 하위 메뉴
			array('검토 현장', '현장 등록'),                          // 두번째 하위 메뉴
			array('동호수 데이터 입력', '기본정보 수정'), // 첫번째 하위 제목
			array('프로젝트 검토 현황', '신규 프로젝트 등록')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m4/project_v', $menu);

		// 프로젝트 관리 1. 데이터등록 ////////////////////////////////////////////////////////////////////
		if($m_di==1 && $s_di==1 ){
			$this->load->view('/menu/m4/md1_sd1_v');


		// 프로젝트 관리 2. 데이터수정 ////////////////////////////////////////////////////////////////////
		}else if($m_di==1 && $s_di==2) {
			$this->load->view('/menu/m4/md1_sd2_v');


		// 신규 프로젝트 1. 검토현장 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==1) {
			$this->load->view('/menu/m4/md2_sd1_v');

		// 신규 프로젝트 1. 현장등록 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==2) {
			$this->load->view('/menu/m4/md2_sd2_v');

		}
	}
}
// End of this File