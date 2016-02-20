<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M1 extends CI_Controller {

	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
	}

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

	public function work($m_di='', $s_di=''){
		if( !$m_di or $m_di == 1 ) $this->load->view('menu/work_v');

		if($m_di == 2 ) $this->load->view('menu/work_v');
	}
}