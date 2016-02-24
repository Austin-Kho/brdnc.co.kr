<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M3 extends CI_Controller {

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
		$this->capital();
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

	public function capital($mdi='', $sdi=''){
		//$this->output->enable_profiler(TRUE); //프로파일러 보기//

		if( !$this->uri->segment(3)) $m_di = 1; else $m_di = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $s_di = 1; else $s_di = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('자금 일보', '입출금 내역', '입출금 등록'), // 첫번째 하위 메뉴
			array('분 개 장', '일·월계표', '제무 제표'),                          // 두번째 하위 메뉴
			array('자금 일보', '현장별 계약등록(수정)', '동호수 계약 현황도'), // 첫번째 하위 제목
			array('분 개 장', '일·월계표', '주요 제무제표')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m3/capital_v', $menu);

		// 자금 현황 1. 자금일보 ////////////////////////////////////////////////////////////////////
		if($m_di==1 && $s_di==1 ){
			$this->load->view('/menu/m3/md1_sd1_v');


		// 자금 현황 2. 입출금 내역 ////////////////////////////////////////////////////////////////////
		}else if($m_di==1 && $s_di==2) {
			$this->load->view('/menu/m3/md1_sd2_v');

		// 자금 현황 3. 입출금 등록 ////////////////////////////////////////////////////////////////////
		}else if($m_di==1 && $s_di==3) {
			$this->load->view('/menu/m3/md1_sd3_v');

		// 회계관리 1. 분개장 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==1) {
			$this->load->view('/menu/m3/md2_sd1_v');

		// 회계관리 2. 일월계표 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==2) {
			$this->load->view('/menu/m3/md2_sd2_v');

		// 회계관리 3. 제무제표 ////////////////////////////////////////////////////////////////////
		}else if($m_di==2 && $s_di==3) {
			$this->load->view('/menu/m3/md2_sd3_v');

		}
	}
}
// End of this File