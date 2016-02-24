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
		$this->load->helper('is_mobile');
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->config();
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

	public function config($mdi='', $sdi=''){
		$this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3);
		$sdi = $this->uri->segment(4);

		$md_bt = array(
			$md1_sd_bt = array('부서 관리', '직원 관리', '거래처 정보', '계좌 관리'),
			$md2_sd_bt = array('회사 정보', '권한 관리')
		);

		$sd_sub = array(
			$md1_sd_sub = array('부서 정보 관리', '직원 보 관리', '거래처 정보 정보', '은행계좌 관리'),
			$md2_sd_sub = array('회사 기본 정보', '사용자 권한관리')
		);

		$this->load->view('menu/m5/config_v', $md_bt);

		// if( !$mdi or $mdi == '1' )  {

		// 	$this->load->view('menu/m5/md1_v');

		// 	if( !$sdi or $sdi==1) $this->load->view('menu/m5/md1_sd1_v');
		// 	if($sdi==2) $this->load->view('menu/m5/md1_sd2_v');
		// 	if($sdi==3) $this->load->view('menu/m5/md1_sd3_v');
		// 	if($sdi==4) $this->load->view('menu/m5/md1_sd4_v');

		// } else if($mdi == '2' ) {
		// 	$this->load->view('menu/m5/md2_v');
		// 	if( !$sdi or $sdi==1) $this->load->view('menu/m5/md2_sd1_v');
		// 	if($sdi==2) $this->load->view('menu/m5/md2_sd2_v');
		// }
	}
}
// End of this File