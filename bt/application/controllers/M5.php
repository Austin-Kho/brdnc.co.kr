<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M5 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			echo "<meta http-equiv='Refresh' content='0; URL=/bt/member/'>";
			exit;
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

		$mdi = $this->uri->segment(3);
		$sdi = $this->uri->segment(4);

		$this->load->view('menu/m5/config_v');

		if( !$mdi or $mdi == '1' )  {
			$this->load->view('menu/m5/md1_v');
			if( !$sdi or $sdi==1) $this->load->view('menu/m5/md1_sd1_v');
			if($sdi==2) $this->load->view('menu/m5/md1_sd2_v');
			if($sdi==3) $this->load->view('menu/m5/md1_sd3_v');
			if($sdi==4) $this->load->view('menu/m5/md1_sd4_v');

		} else if($mdi == '2' ) {
			$this->load->view('menu/m5/md2_v');
			if( !$sdi or $sdi==1) $this->load->view('menu/m5/md2_sd1_v');
			if($sdi==2) $this->load->view('menu/m5/md2_sd2_v');
			if($sdi==3) $this->load->view('menu/m5/md2_sd3_v');

		}
	}
}