<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Zip_search extends CI_Controller
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->zip_search();
	}

	public function zip_search () {
		$this->load->view('/popup/zip_search_v');
	}
}
// End of this File