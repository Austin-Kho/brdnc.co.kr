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
		$this->download();
	}

	public function download(){

		$data['pj_seq'] = urldecode($this->input->get('pj'));
		$rec_query = urldecode($this->input->get('qry'));
		$rec_query .= "ORDER BY paid_date, cb_cms_sales_received.seq ";

		$data['rec_data'] = $this->cms_main_model->sql_result($rec_query); // 수납 데이터
		$data['project'] = $this->cms_main_model->sql_row("SELECT pj_name FROM cb_cms_project"); // 수납 데이터

		// 실제 엑셀 VIEW 파일 로드
		$this->load->view('/cms_views/excel/received_data', $data);
	}
}
// End of this file
