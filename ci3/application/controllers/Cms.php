<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cms extends CI_Controller {

		/**
		 *
		 */
		public function __construct(){
			parent::__construct();
			//$this->load->model('cms/cms_model', '', TRUE);
			$this->load->library('session');
		}

		public function index(){
			$this->main();
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

		public function main(){
			$s_id = $this->session->id;
			$this->load->view('cms_main_index');
		}

		public function menu1(){
			$this->load->view('cms_main_content');

			//$this->load->model('cms/cms_model', '', TRUE);
		}

		public function menu2(){
			$this->load->view('cms_main_content');

			//$this->load->model('cms/cms_model', '', TRUE);
		}

		public function menu3(){
			$this->load->view('cms_main_content');

			//$this->load->model('cms/cms_model', '', TRUE);
		}

		public function menu4(){
			$this->load->view('cms_main_content');

			//$this->load->model('cms/cms_model', '', TRUE);
		}

		public function menu5(){
			$this->load->view('cms_main_content');

			//$this->load->model('cms/cms_model', '', TRUE);
		}
	}