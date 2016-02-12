<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Main extends CI_Controller {

		/**
		 * Index Page for this controller.
		 *
		 * Maps to the following URL
		 * 		http://example.com/index.php/welcome
		 *	- or -
		 * 		http://example.com/index.php/welcome/index
		 *	- or -
		 * Since this controller is set as the default controller in
		 * config/routes.php, it's displayed at http://example.com/
		 *
		 * So any other public methods not prefixed with an underscore will
		 * map to /index.php/welcome/<method_name>
		 * @see https://codeigniter.com/user_guide/general/urls.html
		 */

		public function __construct(){
			parent::__construct();
			// Your own constructor code
		}

		public function index()
		{
			$this->load->model('cms/cms_model', '', TRUE);

			$this->load->library('session');
			$s_id = $this->session->id;

			$this->load->view('cms_/cms_main_header');
			$this->load->view('cms_/cms_main_index');
			$this->load->view('cms_/cms_main_footer');
		}
		public function url_data(){
			echo $this->uri->segment(2);
		}
	}