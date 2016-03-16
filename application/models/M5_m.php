<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M5_m extends CI_Model {

	/**
	 * [is_com_chk 회사 정보 등록여부 체크]
	 * @return boolean [회사정보 등록 여부 및 정보]
	 */
	public function is_com_chk() {
		$qry = $this->db->get('cms_com_info');
		if($result = $qry->row()) {
			return $result;
		}else{
			return FALSE;
		}
	}

	/**
	 * [com_reg 회사 정보 등록함수]
	 * @param  [Array] $com_data [등록할 회사정보]
	 * @return [Boolean]           [등록 성공여부]
	 */
	public function com_reg($com_data){
		$result = $this->db->insert('cms_com_info', $com_data);
		return $result;
	}

	/**
	 * [com_modify 회사 정보 변경(수정)등록 함수]
	 * @param  [Array] $com_data [변경할 회사 정보]
	 * @return [Boolean]             [변경 등록 성공 여부]
	 */
	public function com_modify($com_data){
		$result = $this->db->update('cms_com_info', $com_data);
		return $result;
	}

	/**
	 * @return [Array] [신청대기자 목록]
	 */
	public function new_rq_chk() {
		$qry = $this->db->get_where('cms_member_table', array('request' => '2'));
		if($result = $qry->result()) {
			return $result;
		}else{
			return FALSE;
		}
	}
	public function rq_perm($no, $data){
		$this->db->where('no', $no);
		$result = $this->db->update('cms_member_table', $data);
		return $result;
	}

	public function user_list(){
		$this->db->select('no, name');
		$qry = $this->db->get_where('cms_member_table', array('request' => '1'));
		if($result = $qry->result()) {
			return $result;
		}else{
			return FALSE;
		}
	}

	public function sel_user($no){
		$this->db->select('no, name, email, reg_date');
		$qry = $this->db->get_where('cms_member_table', array('no' => $no));
		if($result = $qry->row()) {
			return $result;
		}else{
			return FALSE;
		}
	}
}
// End of this File
