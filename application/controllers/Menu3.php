<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Menu3 extends CI_Controller {
		/**
		 *
		 *
		 */

		// public function __construct(){
		// 	parent::__construct();
		// 	// Your own constructor code
		// }


		public function index()
		{
			$this->load->view('cms_/cms_main_header');
			//$this->load->view('cms_/cms_main_content');
			$this->load->view('cms_/cms_main_footer');

			$this->load->model('cms/cms_model', '', TRUE);
		}
	}