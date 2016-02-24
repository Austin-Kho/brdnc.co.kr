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

		if( !$this->uri->segment(3)) $m_di = 1; else $m_di = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $s_di = 1; else $s_di = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('전도금 내역', '입출 등록', '전도금 현황'), // 첫번째 하위 메뉴
			array('인원 현황', '인원 등록', '소속 관리'),                          // 두번째 하위 메뉴
			array('현장 전도금 입출내역', '현장 전도금 입출등록)', '전체 현장별 전도금 현황'), // 첫번째 하위 제목
			array('현장별 조직 및 인원 현황', '현장별 조직 및 인원 등록', '현장 관계자 소속 관리')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m2/local_v', $menu);

		// 전도금 관리 1. 전도금 내역 ////////////////////////////////////////////////////////////////////
		if($m_di==1 && $s_di==1 ){
			$this->load->view('/menu/m2/md1_sd1_v');


		// 전도금 관리 2. 입출내역 ////////////////////////////////////////////////////////////////////
		}else if($m_di==1 && $s_di==2) {
			$this->load->view('/menu/m2/md1_sd2_v');

		// 전도금 관리 3. 전도금 현황 ////////////////////////////////////////////////////////////////////
		}else if($m_di==1 && $s_di==3) {
			$this->load->view('/menu/m2/md1_sd3_v');

		// 투입자원 관리 4. 인원현황 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==1) {
			$this->load->view('/menu/m2/md2_sd1_v');

		// 투입자원 관리 1. 인원 등록 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==2) {
			$this->load->view('/menu/m2/md2_sd2_v');

		// 투입자원 관리 1. 소속 관리 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==3) {
			$this->load->view('/menu/m2/md2_sd3_v');

		}
	}
}
// End of this File