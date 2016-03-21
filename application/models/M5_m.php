<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M5_m extends CI_Model {

	public function com_div_list($search_text='', $start='', $limit='', $n){
		// 검색어가 있을 경우
		if($search_text !='') {
			$this->db->like('div_name', $search_text);
			$this->db->like('manager', $search_text);
			$this->db->like('res_work', $search_text);
		}
		$this->db->order_by('seq', 'ASC');

		if($start != '' or $limit !='')	$this->db->limit($start, $limit);
		$qry = $this->db->get('cms_com_div');

		if($n=='num'){ $result = $qry->num_rows(); }else{ $result = $qry->result(); }
		return $result;
	}

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
	 * [new_rq_chk 신규 가입 사용자 데이터 추출 함수]
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

	/**
	 * [rq_perm 신규 가입 사용자 승인 함수]
	 * @param  [String]   [유저 넘버]
	 * @param  [Array]    [사용신청대기자 승인 데이터]
	 * @return [Boolean]  [쿼리 성공 여부]
	 */

	public function rq_perm($no, $data){
		// $this->db->where('no', $no);
		$result = $this->db->update('cms_member_table', $data, array('no' => $no));
		return $result;
	}

	/**
	 * [user_list 승인된 사용자 리스트 불러오기 함수]
	 * @return [Array]  [승인된 사용자 리스트 데이터]
	 */
	public function user_list(){
		$this->db->select('no, user_id, name');
		$qry = $this->db->get_where('cms_member_table', array('request' => '1'));
		$result = $qry->result();
		return $result;
	}

	/**
	 * [sel_user 권한 부여(수정)할 사용자 선택 함수]
	 * @param  [String] [선택된 사용자 번호]
	 * @return [Array] [선택된 사용자 데이터]
	 */
	public function sel_user($no){
		$this->db->select('no, user_id, name, email, reg_date');
		$qry = $this->db->get_where('cms_member_table', array('no' => $no));
		$result = $qry->row();
		return $result;
	}

	/**
	 * [user_auth 선택한 사용자의 현재 권한 데이터 추출 함수]
	 * @param  [String] [선택된 사용자 번호]
	 * @return [Array] [사용자 권한 데이터]
	 */
	public function user_auth($no){
		$qry = $this->db->get_where('cms_mem_auth', array('user_no' => $no));
		$result = $qry->row();
		return $result;
	}

	public function auth_reg($no, $auth_data){
		// 권한 등록 회원인지 확인
		$this->db->select('auth_seq');
		$qry = $this->db->get_where('cms_mem_auth', array('user_no' => $no));

		if($qry->row()) {
			$this->db->where('user_no', $no);
			$result = $this->db->update('cms_mem_auth', $auth_data);
			return $result;
		}else{
			$result = $this->db->insert('cms_mem_auth', $auth_data);
			return $result;
		}
	}
}
// End of this File
