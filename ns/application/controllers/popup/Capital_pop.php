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

	// public function index() {
	// 	$this->accounts();
	// }

	public function accounts ()
	{
		// $this->output->enable_profiler(TRUE);
		$data['d2_acc'] = $this->popup_m->d2_acc($this->input->post('acc_d1'));

		$this->load->view('/popup/accounts_v', $data);
	}

	public function cash_book($id)
	{
		$this->load->view('/popup/pop_header_v');

		$where = array('seq_num'=>$id);
		$data['row'] = $this->main_m->select_data_row('cms_capital_cash_book', $where);

		// 계정별 세부계정과목 구하기
		$data['acnt1'] = $this->main_m->sql_result(" SELECT * FROM cms_capital_account_d3 WHERE d1_code='1' AND is_sp_acc !='1' ORDER BY d3_code ASC ");
		$data['acnt2'] = $this->main_m->sql_result(" SELECT * FROM cms_capital_account_d3 WHERE d1_code='2' AND is_sp_acc !='1' ORDER BY d3_code ASC ");
		$data['acnt3'] = $this->main_m->sql_result(" SELECT * FROM cms_capital_account_d3 WHERE d1_code='3' AND is_sp_acc !='1' ORDER BY d3_code ASC ");
		$data['acnt4'] = $this->main_m->sql_result(" SELECT * FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc !='1' ORDER BY d3_code ASC ");
		$data['acnt5'] = $this->main_m->sql_result(" SELECT * FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc !='1' ORDER BY d3_code ASC ");

		// 현장목록 가져오기
		$data['pj'] = $this->main_m->sql_result(" SELECT seq, pj_name FROM cms_project WHERE is_end!='1' ORDER BY biz_start_ym DESC, seq DESC ");

		// 입출금 계좌 가져오기 select * from cms_capital_bank_account
		$data['bank_acc'] =  $this->main_m->sql_result(" select * from cms_capital_bank_account ");

		// 폼 검증 라이브러리 로드
		$this->load->library('form_validation'); // 폼 검증

		//// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('deal_date', '거래일자', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('class1', '구분1', 'trim|required');
		$this->form_validation->set_rules('class2', '구분2', 'trim|required');
		$this->form_validation->set_rules('cont', '적요', 'trim|required');
		$this->form_validation->set_rules('inc', '입금금액', 'trim|numeric');
		$this->form_validation->set_rules('exp', '출금금액', 'trim|numeric');

		if($this->form_validation->run()==FALSE) {
			//본 페이지 로딩
			$this->load->view('/popup/cash_book_v', $data);
			$this->load->view('/popup/pop_footer_v');
		}else{
			if($this->input->post('account_1')) $account = $this->input->post('account_1');
			if($this->input->post('account_2')) $account = $this->input->post('account_2');
			if($this->input->post('account_3')) $account = $this->input->post('account_3');
			if($this->input->post('account_4')) $account = $this->input->post('account_4');
			if($this->input->post('account_5')) $account = $this->input->post('account_5');

			$deal_data = array(
				'class1' => $this->input->post('class1', TRUE),
				'class2' => $this->input->post('class2', TRUE),
				'is_jh_loan' => $this->input->post('is_jh', TRUE),
				'any_jh' => $this->input->post('any_jh', TRUE),
				'account' => $account,
				'cont' => $this->input->post('cont', TRUE),
				'acc' => $this->input->post('acc', TRUE),
				'in_acc' => $this->input->post('ina', TRUE),
				'inc' => $this->input->post('inc', TRUE),
				'out_acc' => $this->input->post('out', TRUE),
				'exp' => $this->input->post('exp', TRUE),
				'evidence' => $this->input->post('evi', TRUE),
				'note' => $this->input->post('note', TRUE),
				'worker' => $this->session->userdata['name'],
				'deal_date' => $this->input->post('deal_date', TRUE)
			);

			$where = array('seq_num'=>$this->input->post('seq_num', TRUE));
			$result = $this->main_m->update_data('cms_capital_cash_book', $deal_data, $where);

			if($result){
				alert('정상적으로 처리되었습니다.', base_url('popup/capital_pop/cash_book')."/".$this->input->post('seq_num', TRUE));
			}else{
				alert('다시 시도하여 주십시요.', base_url('popup/capital_pop/cash_book')."/".$this->input->post('seq_num', TRUE));
			}
		}
	}
}
// End of File
