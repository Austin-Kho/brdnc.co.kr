<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
		// if(@$this->session->userdata['logged_in'] !== TRUE) {
<<<<<<< HEAD
		// 	echo "<meta http-equiv='Refresh' content='0; URL=/bt/member/'>";
=======
		// 	echo "<meta http-equiv='Refresh' content='0; URL=/ci3/member/'>";
>>>>>>> 59512bf967dabb6b7089593ce0eaadb6fe48210f
		// 	exit;
		// }
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

	public function index(){
		$this->load->view('cms_main_index');
	}
}