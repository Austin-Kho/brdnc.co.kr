<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Cms_m4_model extends CB_Model {

	////////////////////////////////////////////////////////
	// 자금 일보 관리 모델
	////////////////////////////////////////////////////////

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

	public function da_in_total($table, $sh_date) {
		$sql = "SELECT SUM(inc) AS total_inc FROM ".$table." WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='".$sh_date."'";
		$qry = $this->db->query($sql);
		return $qry->result();
	}

	public function da_ex_total($table, $sh_date) {
		$sql = "SELECT SUM(exp) AS total_exp FROM ".$table." WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='".$sh_date."'";
		$qry = $this->db->query($sql);
		return $qry->result();
	}



	////////////////////////////////////////////////////////
	// 입출금 내역 관리 모델
	////////////////////////////////////////////////////////

	public function cash_book_list($table, $where, $start='', $limit='', $sh_frm, $n, $ex='') {
		$this->db->select('seq_num, class1, class2, account, cont, acc, in_acc, inc, out_acc, exp, evidence, cms_capital_cash_book.note AS memo, worker, deal_date, name, no');

		$this->db->where($where);

		if($ex=='') $order_by = 'DESC'; else if($ex=='ex') $order_by = 'ASC';

		$this->db->order_by('deal_date', $order_by);
		$this->db->order_by('seq_num', $order_by);
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
		$this->db->order_by('biz_start_ym DESC', 'seq ASC');
		$qry = $this->db->get('cms_project');
		$result = $qry->result();
		return $result;
	}

	public function aaa() {
		$query="select no, name from cms_capital_bank_account ";
		$query="select no, bank, name from cms_capital_bank_account ";
	}
}
// End of this File
