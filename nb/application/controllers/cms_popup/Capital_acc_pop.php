<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Capital_acc_pop extends CB_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('cms_main_model');
		$this->load->model('cms_popup_model');    // 팝업 모델 로드
		$this->load->helper('cms_cut_string');
		$this->load->helper('cms_is_mobile');
	}

	public function _remap($method)
	{
		//헤더 include
		$this->load->view('/cms_views/popup/pop_header_v');
		if( method_exists($this, $method) )
		{
			$this->{"{$method}"}();
		}
		//푸터 include
		$this->load->view('/cms_views/popup/pop_footer_v');
	}

	public function index()
	{
		$this->accounts();
	}

	public function accounts()
	{
		// $this->output->enable_profiler(TRUE);
		$data['d2_acc'] = $this->cms_popup_model->d2_acc($this->input->post('acc_d1'));
		$data['d2_acc_1'] = $this->cms_popup_model->d2_acc('1');
		$data['d2_acc_2'] = $this->cms_popup_model->d2_acc('2');
		$data['d2_acc_3'] = $this->cms_popup_model->d2_acc('3');
		$data['d2_acc_4'] = $this->cms_popup_model->d2_acc('4');
		$data['d2_acc_5'] = $this->cms_popup_model->d2_acc('5');

		// $data['d3_acc'] = $this->cms_popup_model->d3_acc($this->input->post('acc_d2'), $this->input->post('is_sp'));



		$this->load->view('/cms_views/popup/accounts_v', $data);
	}
}
// End of this File
