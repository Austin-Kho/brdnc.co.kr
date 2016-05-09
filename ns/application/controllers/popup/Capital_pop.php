<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Capital_pop extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('main_m');
		$this->load->model('popup_m');            // 팝업 모델 로드
		$this->load->helper('alert');
	}

	public function _remap($method) {
 		//헤더 include
    		$this->load->view('/popup/pop_header_v');
		if( method_exists($this, $method) )
		{
			$this->{"{$method}"}();
		}
		//푸터 include
		$this->load->view('/popup/pop_footer_v');
  	}

	// public function index() {
	// 	$this->accounts();
	// }

	public function accounts () {
		// $this->output->enable_profiler(TRUE);
		$data['d2_acc'] = $this->popup_m->d2_acc($this->input->post('acc_d1'));

		$this->load->view('/popup/accounts_v', $data);
	}

	public function cash_book($cb_seq=''){
		$where = array('seq_num'=>$cb_seq);
		$data['deal_data'] = $this->main_m->select_data_row('cms_capital_cash_book', $where);
		$this->load->view('/popup/cash_book_v', $data);
	}
}
// End of File
