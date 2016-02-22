<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M2 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
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

		$mdi = $this->uri->segment(3);
		$sdi = $this->uri->segment(4);

		$this->load->view('menu/m2/local_v');

		if( !$mdi or $mdi == '1' )  {
			$this->load->view('menu/m2/md1_v');
			if( !$sdi or $sdi==1) $this->load->view('menu/m2/md1_sd1_v');
			if($sdi==2) $this->load->view('menu/m2/md1_sd2_v');
			if($sdi==3) $this->load->view('menu/m2/md1_sd3_v');

		} else if($mdi == '2' ) {
			$this->load->view('menu/m2/md2_v');
			if( !$sdi or $sdi==1) $this->load->view('menu/m2/md2_sd1_v');
			if($sdi==2) $this->load->view('menu/m2/md2_sd2_v');
			if($sdi==3) $this->load->view('menu/m2/md2_sd3_v');

		}
	}
}