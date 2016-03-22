<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M5_m extends CI_Model {

	/**
	 * [com_div_list 등록 부서 리스트]
	 * @param  [string] $search_text   [검색어]
	 * @param  [string] $start       [페이지네이션 시작]
	 * @param  [string] $limit       [페이지네이션 목록수]
	 * @param  [String] $n           [전체리스트 수, 실제리스트 구분인자]
	 * @return [Array]              [실제리스트 데이터]
	 */
	public function com_div_list($st1='', $st2='', $start='', $limit='', $n){
		// 검색어가 있을 경우
		if($st1 !=''){	 $this->db->where('div_code', $st1); }
		if($st2 !='') {
			$this->db->like('div_name', $st2);
			$this->db->or_like('manager', $st2);
			$this->db->or_like('res_work', $st2);
		}
		$this->db->order_by('seq', 'ASC');
		if($start != '' or $limit !='')	$this->db->limit($limit, $start);
		$qry = $this->db->get('cms_com_div');

		if($n=='num'){ $result = $qry->num_rows(); }else{ $result = $qry->result(); }
		return $result;
	}

	/**
	 * [all_div_name 셀렉트바 전체 목록]
	 * @return [Array] [목록]
	 */
	public function all_div_name(){
		$this->db->select('div_code, div_name');
		$qry = $this->db->get('cms_com_div');
		return $result = $qry->result();
	}

	/**
	 * [com_mem_list 직원 목록]
	 * @param  string $search_text [description]
	 * @param  string $start       [페이지네이션 시작]
	 * @param  string $limit       [페이지네이션 목록수]
	 * @param  [String] $n           [전체리스트 수, 실제리스트 구분인자]
	 * @return [Array]              [실제리스트 데이터]
	 */
	public function com_mem_list($st1='', $st2='', $start='', $limit='', $n){
		// 검색어가 있을 경우
		if($st1 !=''){	 $this->db->where('div_code', $st1); }
		if($st2 !='') {
			$this->db->like('div_posi', $search_text);
			$this->db->like('mem_name', $search_text);
			$this->db->like('email', $search_text);
		}
		$this->db->order_by('seq', 'ASC');

		if($start != '' or $limit !='')	$this->db->limit($limit, $start);
		$qry = $this->db->get('cms_com_div_mem1');

		if($n=='num'){ $result = $qry->num_rows(); }else{ $result = $qry->result(); }
		return $result;
	}

	/**
	 * [com_accounts_list 거래처 목록]
	 * @param  string $search_text [description]
	 * @param  string $start       [페이지네이션 시작]
	 * @param  string $limit       [페이지네이션 목록수]
	 * @param  [String] $n           [전체리스트 수, 실제리스트 구분인자]
	 * @return [Array]              [실제리스트 데이터]
	 */
	public function com_accounts_list($st1='', $st2='', $start='', $limit='', $n){
		// 검색어가 있을 경우
		if($st1 !=''){	 $this->db->where('div_code', $st1); }
		if($st2 !='') {
			$this->db->like('si_name', $search_text);
			$this->db->like('web_name', $search_text);
			$this->db->like('res_worker', $search_text);
		}
		$this->db->order_by('seq', 'ASC');

		if($start != '' or $limit !='')	$this->db->limit($limit, $start);
		$qry = $this->db->get('cms_accounts1');

		if($n=='num'){ $result = $qry->num_rows(); }else{ $result = $qry->result(); }
		return $result;
	}

	/**
	 * [all_acc_name 셀렉트바 전체 목록]
	 * @return [Array] [목록]
	 */
	public function all_acc_name(){
		$this->db->select('seq, si_name');
		$qry = $this->db->get('cms_accounts');
		return $result = $qry->result();
	}


	/**
	 * [bank_account_list 은행계좌 목록]
	 * @param  string $search_text [description]
	 * @param  string $start       [페이지네이션 시작]
	 * @param  string $limit       [페이지네이션 목록수]
	 * @param  [String] $n           [전체리스트 수, 실제리스트 구분인자]
	 * @return [Array]              [실제리스트 데이터]
	 */
	public function bank_account_list($st1='', $st2='', $start='', $limit='', $n) {
		// 검색어가 있을 경우
		if($st1 !=''){	 $this->db->where('no', $st1); }
		if($st2 !='') {
			$this->db->like('bank', $search_text);
			$this->db->like('name', $search_text);
			$this->db->like('holder', $search_text);
		}
		$this->db->order_by('no', 'ASC');

		if($start != '' or $limit !='')	$this->db->limit($limit, $start);
		$qry = $this->db->get('cms_capital_bank_account');

		if($n=='num'){ $result = $qry->num_rows(); }else{ $result = $qry->result(); }
		return $result;
	}

	/**
	 * [all_bank_name 셀렉트바 전체 목록]
	 * @return [Array] [목록]
	 */
	public function all_bank_name(){
		$this->db->select('bank_code, bank');
		$this->db->where('bank_code!=', '');
		$this->db->group_by('bank_code');

		$qry = $this->db->get('cms_capital_bank_account');
		return $result = $qry->result();
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
