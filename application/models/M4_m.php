<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M4_m extends CI_Model {

	//공통 함수 Start//
	/**
	 * [select_data_list 복수 데이터 불러오기]
	 * @param  [String] $table [테이블명]
	 * @param  [Array] $where [필터링 '키'=>값]
	 * @return [Boolean]        [성공 여부]
	 */
	public function select_data_list($table) {
		$qry = $this->db->get($table);
		return $rlt = $qry->result();
	}

	public function select_data_lt($table, $sel='', $where, $group='', $order='') {
		if($sel !='') { $this->db->select($sel); }
		if($where !='') { $this->db->where($where); }
		if($group !='') { $this->db->group_by($group); }
		if($order !='') { $this->db->order_by($order); }
		$qry = $this->db->get($table);
		$rlt = array(
			'num' => $qry->num_rows(),
			'result' => $qry->result()
		);
		return $rlt;
	}

	/**
	 * [select_data_row  단수 데이터 불러오기]
	 * @param  [String] $table [테이블명]
	 * @param  [Array] $where [필터링 '키'=>값]
	 * @return [Boolean]        [성공 여부]
	 */
	public function select_data_row($table, $where) {
		$qry = $this->db->get_where($table, $where);
		return $rlt = $qry->row();
	}

	/**
	 * [insert_data 데이터 입력함수]
	 * @param  [String] $table [테이블명]
	 * @param  [Array] $data  [입력할 데이터]
	 * @return [Boolean]        [입력 성공여부]
	 */
	public function insert_data($table, $data) {
		$result = $this->db->insert($table, $data);
		return $result;
	}

	/**
	 * [update_data 데이터 수정함수]
	 * @param  [String] $table [테이블명]
	 * @param  [Array] $data  [수정할 데이터]
	 * @param  [Int] $seq   [데이터 키 값]
	 * @return [Boolean]        [수정 성공여부]
	 */
	public function update_data($table, $data, $where) {
		$result = $this->db->update($table, $data, $where);
		return $result;
	}

	/**
	 * [delete_data 데이터 삭제함수]
	 * @param  [String] $table [테이블명]
	 * @param  [Int] $seq   [데이터 키 값]
	 * @return [Boolean]        [삭제 성공여부]
	 */
	public function delete_data($table, $where) {
		$result = $this->db->delete($table, $where);
		return $result;
	}
	//공통 함수 Start//


	public function da_in_total($table, $sh_date) {
		$sql = "SELECT SUM(inc) AS total_inc FROM ".$table." WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='".$sh_date."'";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	// $bbq="SELECT SUM(exp) AS total_exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date'";
	public function da_ex_total($table, $sh_date) {
		$sql = "SELECT SUM(exp) AS total_exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='".$sh_date."'";
		$qry = $this->db->query($sql);
		return $qry->result();
	}	


	public function cash_book_list($table, $start='', $limit='', $sh_frm, $n) {
		$this->db->select('seq_num, class1, class2, account, cont, acc, in_acc, inc, out_acc, exp, evidence, cms_capital_cash_book.note, worker, deal_date, name, no');
		$where=" (com_div>0 AND ((in_acc=no AND class2<>7) OR out_acc=no) OR (com_div IS NULL AND in_acc=no AND class2=6)) ";

		//검색어가 있을 경우
		if($sh_frm['class1']){
			if($sh_frm['class1']==1) $where.=" AND class1='1' ";
			if($sh_frm['class1']==2) $where.=" AND class1='2' ";
			if($sh_frm['class1']==3) $where.=" AND class1='3' ";
		}
		if($sh_frm['class2']) $where.=" AND class2='".$sh_frm['class2']."' ";
		if($sh_frm['s_date']) $where.=" AND deal_date>='".$sh_frm['s_date']."' ";
		if($sh_frm['e_date']) {$where.=" AND deal_date<='".$sh_frm['e_date']."' "; } //$e_add=" AND deal_date<='$sh_frm['e_date']' ";} else{$e_add="";}

		if($sh_frm['sh_text']){
			if($sh_frm['sh_con']==0) $where.=" AND (account like '%".$sh_frm['sh_text']."%' OR cont like '%".$sh_frm['sh_text']."%' OR acc like '%".$sh_frm['sh_text']."%' OR evidence like '%".$sh_frm['sh_text']."%' OR cms_capital_cash_book.worker like '%".$sh_frm['sh_text']."%') "; // 통합검색
			if($sh_frm['sh_con']==1) $where.=" AND account like '%".$sh_frm['sh_text']."%' "; // 계정과목
			if($sh_frm['sh_con']==2) $where.=" AND cont like '%".$sh_frm['sh_text']."%' "; //적요
			if($sh_frm['sh_con']==3) $where.=" AND acc like '%".$sh_frm['sh_text']."%' "; // 거래처
			if($sh_frm['sh_con']==4) $where.=" AND (in_acc like '%".$sh_frm['sh_text']."%' OR out_acc like '%".$sh_frm['sh_text']."%')  ";  //입출금처
		}
		$this->db->where($where);

		$this->db->order_by('deal_date', 'DESC');
		$this->db->order_by('seq_num', 'DESC');
		if($start != '' or $limit !='')	$this->db->limit($limit, $start);
		$qry = $this->db->get($table);

		if($n=='num'){ $result = $qry->num_rows(); }else{ $result = $qry->result(); }
		return $result;
	}

	public function d3_acc($d1) {
		$this->db->select('d3_code, d3_acc_name');
		$this->db->where(array('d1_code' =>$d1));
		$this->db->where(array('is_sp_acc !=' => '1'));
		$this->db->order_by('d3_code', 'ASC');
		$qry = $this->db->get('cms_capital_account_d3');

		$result = $qry->result();
		return $result;
	}

	public function pj_dt() {
		$this->db->select('seq, pj_name');
		$this->db->where('is_end !=', '1');
		$this->db->order_by('start_date DESC', 'seq ASC');
		$qry = $this->db->get('cms_project1_info');
		$result = $qry->result();
		return $result;
	}

	public function aaa() {
		$query="select no, name from cms_capital_bank_account ";
		$query="select no, bank, name from cms_capital_bank_account ";
	}
}
// End of this File
