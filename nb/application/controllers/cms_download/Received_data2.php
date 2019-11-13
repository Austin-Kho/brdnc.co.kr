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

		$data['pj_seq'] = $project = urldecode($this->input->get('pj'));

        // 수납 데이터 검색 필터링
        $rec_query = " SELECT cb_cms_sales_received.seq, cont_seq, paid_amount, paid_date, paid_who, acc_nick, pay_name, unit_type, unit_dong_ho ";

        $rec_query .= " FROM cb_cms_sales_received, cb_cms_sales_pay_sche, cb_cms_sales_bank_acc, cb_cms_sales_contract ";
        $rec_query .= " WHERE is_refund='0' AND cb_cms_sales_received.pj_seq='{$project}' AND cb_cms_sales_pay_sche.pj_seq='{$project}'  AND pay_sche_code=cb_cms_sales_pay_sche.pay_code AND paid_acc=cb_cms_sales_bank_acc.seq AND cont_seq=cb_cms_sales_contract.seq ";
        if( !empty($this->input->get('ps'))) { $rec_query .= " AND pay_sche_code='".$this->input->get('ps')."' ";}
        if( !empty($this->input->get('ac'))) { $rec_query .= " AND paid_acc='".$this->input->get('ac')."' ";}
        if( !empty($this->input->get('sd'))) { $rec_query .= " AND paid_date>='".$this->input->get('sd')."' ";}
        if( !empty($this->input->get('ed'))) { $rec_query .= " AND paid_date<='".$this->input->get('ed')."' ";}

		$rec_query .= "ORDER BY paid_date, cb_cms_sales_received.seq ";

		$data['rec_data'] = $this->cms_main_model->sql_result($rec_query); // 수납 데이터
		$data['project'] = $this->cms_main_model->sql_row("SELECT pj_name FROM cb_cms_project"); // 수납 데이터

		// 실제 엑셀 VIEW 파일 로드
		$this->load->view('/cms_views/excel/received_data', $data);
	}
}
// End of this file
