<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$this->download();
	}

	public function download()
	{
		 $com = $this->input->get('com');

        $where = "(cb_cms_capital_cash_book.com_seq={$com} AND com_div>0 AND ((in_acc=no AND class2<>7) OR out_acc=no) OR (com_div IS NULL AND in_acc=no AND class2=6)) ";

        // 검색어 get 데이터
        $sh_frm = array(
            'c1' => $this->input->get('c1', TRUE),
            'c2' => $this->input->get('c2', TRUE),
            'sd' => $this->input->get('sd', TRUE),
            'ed' => $this->input->get('ed', TRUE),
            'sc' => $this->input->get('sc', TRUE),
            'st' => $this->input->get('st', TRUE)
        );

        //검색어가 있을 경우
        if ($sh_frm['c1']) {
            if ($sh_frm['c1'] == 1) $where .= " AND class1='1' ";
            if ($sh_frm['c1'] == 2) $where .= " AND class1='2' ";
            if ($sh_frm['c1'] == 3) $where .= " AND class1='3' ";
        }
        if ($sh_frm['c2']) $where .= " AND class2='" . $sh_frm['c2'] . "' ";
        if ($sh_frm['sd']) $where .= " AND deal_date>='" . $sh_frm['sd'] . "' ";
        if ($sh_frm['ed']) $where .= " AND deal_date<='" . $sh_frm['ed'] . "' ";  //$e_add=" AND deal_date<='$sh_frm['ed']' ";} else{$e_add="";}

        if ($sh_frm['st']) {
            if ($sh_frm['sc'] == 0) $where .= " AND (account like '%" . $sh_frm['st'] . "%' OR cont like '%" . $sh_frm['st'] . "%' OR acc like '%" . $sh_frm['st'] . "%' OR evidence like '%" . $sh_frm['st'] . "%' OR cb_cms_capital_cash_book.worker like '%" . $sh_frm['st'] . "%') "; // 통합검색
            if ($sh_frm['sc'] == 1) $where .= " AND account like '%" . $sh_frm['st'] . "%' "; // 계정과목
            if ($sh_frm['sc'] == 2) $where .= " AND cont like '%" . $sh_frm['st'] . "%' "; //적요
            if ($sh_frm['sc'] == 3) $where .= " AND acc like '%" . $sh_frm['st'] . "%' "; // 거래처
            if ($sh_frm['sc'] == 4) $where .= " AND (in_acc like '%" . $sh_frm['st'] . "%' OR out_acc like '%" . $sh_frm['st'] . "%')  ";  //입출금처
        }

		 $data['is_sc'] = ($sh_frm['st'] === "") ? 0 : 1;

		 // sql문에 적용할 테이블명 ////////////////
		 $table = 'cb_cms_capital_cash_book, cb_cms_capital_bank_account';

		 $data['com_title'] = $this->cms_main_model->sql_row("SELECT co_name FROM cb_cms_com WHERE seq={$com}");
		 $data['cash_book_list'] = $this->cms_m4_model->cash_book_list($table, $where, '', '', '', 'ASC');

        // 실제 엑셀 VIEW 파일 로드
        $this->load->view('/cms_views/excel/cash_book', $data);
	}
}
// End of this file
