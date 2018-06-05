<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Received_data2 extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->excel_file();
	}

	public function excel_file(){

		$project = urldecode($this->input->get('pj'));
		$rec_query = urldecode($this->input->get('qry'));
		$rec_query .= "ORDER BY paid_date, cb_cms_sales_received.seq ";

		$data['project'] = $this->cms_main_model->data_row("cb_cms_project", array('seq'=>$project), "pj_name"); // 수납 데이터
		$data['rec_data'] = $this->cms_main_model->sql_result($rec_query); // 수납 데이터


		// $data['where'] = $this->input->get('add_where');
		// $data['sc'] = $this->input->get('sc');

		// sql문에 적용할 테이블명 ////////////////
		// $cb_table = 'cb_cms_capital_cash_book, cb_cms_capital_bank_account';

		// $data['com_title'] = $this->cms_main_model->data_row('cb_cms_com_info', array(1=>1));
		// $data['cash_book_list'] = $this->cms_m4_model->cash_book_list($cb_table, $data['where'], '', '', '', 'ASC');

		// 실제 엑셀 VIEW 파일 로드
		$this->load->view('/cms_views/excel/received_data', $data);
	}
}
// End of this file
