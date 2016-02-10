<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cms_cont extends CI_Controller {

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

		public function index()
		{
			parent::__construct();
			$this->load->view('cms_/cms_header');
			$this->load->view('cms_/cms_article');
			$this->load->view('cms_/cms_footer');

			$this->load->model('cms/cms_model', '', TRUE);
		}
		public function work()
		{
			parent::__construct();
			$this->load->view('cms_/cms_header');
			$this->load->view('cms_/cms_article');
			$this->load->view('cms_/cms_footer');

			$this->load->model('cms/cms_model', '', TRUE);
		}
		public function capital()
		{
			parent::__construct();
			$this->load->view('cms_/cms_header');
			$this->load->view('cms_/cms_article');
			$this->load->view('cms_/cms_footer');

			$this->load->model('cms/cms_model', '', TRUE);
		}
		public function porject()
		{
			parent::__construct();
			$this->load->view('cms_/cms_header');
			$this->load->view('cms_/cms_article');
			$this->load->view('cms_/cms_footer');

			$this->load->model('cms/cms_model', '', TRUE);
		}
		public function config()
		{
			parent::__construct();
			$this->load->view('cms_/cms_header');
			$this->load->view('cms_/cms_article');
			$this->load->view('cms_/cms_footer');

			$this->load->model('cms/cms_model', '', TRUE);
		}
	}