<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M1 extends CI_Controller {

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
		$this->work();
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

	public function work($mdi='', $sdi=''){
		//$this->output->enable_profiler(TRUE); //프로파일러 보기//

		if( !$this->uri->segment(3)) $m_di = 1; else $m_di = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $s_di = 1; else $s_di = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('계약 현황', '계약 등록', '동호수 현황'), // 첫번째 하위 메뉴
			array('상담 일지', '업무 일지', '업무 보고'),                          // 두번째 하위 메뉴
			array('현장별 계약현황', '현장별 계약등록(수정)', '동호수 계약 현황도'), // 첫번째 하위 제목
			array('고객 상담일지', '현장별 업무일지', '시행사 업무보고')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m1/work_v', $menu);

		// 계약 현황 1. 계약 현황 ////////////////////////////////////////////////////////////////////
		if($m_di==1 && $s_di==1 ){
			$this->load->view('/menu/m1/md1_sd1_v');


		// 계약 현황 2. 계약 등록 ////////////////////////////////////////////////////////////////////
		}else if($m_di==1 && $s_di==2) {
			$this->load->view('/menu/m1/md1_sd2_v');

		// 계약 현황 3. 동호수 현황 ////////////////////////////////////////////////////////////////////
		}else if($m_di==1 && $s_di==3) {
			$this->load->view('/menu/m1/md1_sd3_v');

		// 업무 현황 1. 상담일지 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==1) {
			$this->load->view('/menu/m1/md2_sd1_v');

		// 업무 현황 2. 업무일지 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==2) {
			$this->load->view('/menu/m1/md2_sd2_v');

		// 업무 현황 3. 업무보고 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==3) {
			$this->load->view('/menu/m1/md2_sd3_v');

		}
	}
}
// End of this File