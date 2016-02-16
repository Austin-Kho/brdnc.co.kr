<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M5 extends CI_Controller {

	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
		//my code...
	}

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

	public function config($m_di=''){
		// echo 'config';
	}
}