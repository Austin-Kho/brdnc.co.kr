<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * [__construct description]
	 */
	public function __construct() {
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member').'?returnURL='.rawurlencode(current_url()));
		}
	}

	/**
	 * [_remap description]
	 * @param  [type] $method [description]
	 * @return [type]         [description]
	 */
	public function _remap($method){
		// 헤더 include
		$this->load->view('cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_main_footer');
	}

	public function index(){
		$this->main();
	}

	public function main() {
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//
		$this->load->view('cms_main_index');
	}

	public function module() {
		$this->load->view('cms_module');
		//$this->load->view('no_auth');
	}
}
// End of this File
