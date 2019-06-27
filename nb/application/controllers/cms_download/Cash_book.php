<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cash_book extends CB_Controller
{
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m4_model'); //모델 파일 로드
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->excel_file();
	}

	public function excel_file()
	{

		$data['where'] = $this->input->get('add_where');
		$data['sc'] = $this->input->get('sc');

		// sql문에 적용할 테이블명 ////////////////
		$cb_table = 'cb_cms_capital_cash_book, cb_cms_capital_bank_account';

		$data['com_title'] = $this->cms_main_model->sql_row("SELECT * FROM cb_cms_com_info WHERE seq=1");
		$data['cash_book_list'] = $this->cms_m4_model->cash_book_list($cb_table, $data['where'], '', '', '', 'ASC');

		// 실제 엑셀 VIEW 파일 로드
		$this->load->view('/cms_views/excel/cash_book', $data);
	}
}
// End of this file
