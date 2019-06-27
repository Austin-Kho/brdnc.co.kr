<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cms_m5_model extends CB_Model
{

	////////////////////////////////////////////////////////
	// 기본 정보 관리 모델
	////////////////////////////////////////////////////////

	/**
	 * [com_div_list 등록 부서 리스트]
	 * @param  [string] $search_text   [검색어]
	 * @param  [string] $start       [페이지네이션 시작]
	 * @param  [string] $limit       [페이지네이션 목록수]
	 * @param  [String] $n           [전체리스트 수, 실제리스트 구분인자]
	 * @return [Array]              [실제리스트 데이터]
	 */
	public function com_div_list($table, $com, $start = '', $limit = '', $st1 = '', $st2 = '', $n)
	{
        $this->db->where('com_seq', $com);

		// 검색어가 있을 경우
		if ($st1 != '') {
			$this->db->where('div_code', $st1);
		}
		if ($st2 != '') {
			$this->db->group_start();
			$this->db->like('div_name', $st2);
			$this->db->or_like('manager', $st2);
			$this->db->or_like('res_work', $st2);
			$this->db->group_end();
		}
		$this->db->order_by('seq', 'ASC');
		if ($st1 == '' && ($start != '' or $limit != ''))	$this->db->limit($limit, $start);
		$qry = $this->db->get($table);

		if ($n == 'num') {
			$result = $qry->num_rows();
		} else {
			$result = $qry->result();
		}
		return $result;
	}

	/**
	 * [all_div_name 셀렉트바 전체 목록 불러오기]
	 * @return [Array] [부서 목록]
	 */
	public function all_div_name($table, $com)
	{
		$this->db->select('seq, div_code, div_name');
		$qry = $this->db->get_where($table, array('com_seq' => $com));
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
	public function com_mem_list($table, $com, $start = '', $limit = '', $st1 = '', $st2 = '', $n)
	{
        $this->db->where('com_seq', $com);
		$this->db->where('is_reti !=', '1');

		// 검색어가 있을 경우
		if ($st1 != '') {
			$this->db->where('div_name', $st1);
		}
		if ($st2 != '') {
			$this->db->group_start();
			$this->db->like('div_posi', $st2);
			$this->db->or_like('mem_name', $st2);
			$this->db->or_like('email', $st2);
			$this->db->group_end();
		}
		$this->db->order_by('seq', 'ASC');

		if ($start != '' or $limit != '')	$this->db->limit($limit, $start);
		$qry = $this->db->get($table);

		if ($n == 'num') {
			$result = $qry->num_rows();
		} else {
			$result = $qry->result();
		}
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
	public function com_accounts_list($table, $start = '', $limit = '', $st1 = '', $st2 = '', $n)
	{
		// 검색어가 있을 경우
		if ($st1 != '') {
			$this->db->where('acc_cla', $st1);
		}
		if ($st2 != '') {
			$this->db->group_start();
			$this->db->like('si_name', $st2);
			$this->db->or_like('web_name', $st2);
			$this->db->or_like('res_worker', $st2);
			$this->db->group_end();
		}
		$this->db->order_by('seq', 'ASC');

		if ($start != '' or $limit != '')	$this->db->limit($limit, $start);
		$qry = $this->db->get($table);

		if ($n == 'num') {
			$result = $qry->num_rows();
		} else {
			$result = $qry->result();
		}
		return $result;
	}

	/**
	 * [all_bank_name 셀렉트바 전체 목록]
	 * @return [Array] [목록]
	 */
	public function all_bank_name($com)
	{
		$this->db->select('bank_code, bank');
		$this->db->where('bank_code!=', '');
		$this->db->where('com_seq', $com);
		$this->db->group_by('bank_code');

		$qry = $this->db->get('cms_capital_bank_account');
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
	public function bank_account_list($table, $com, $start = '', $limit = '', $st1 = '', $st2 = '', $n)
	{
	    $this->db->where('com_seq', $com);
		$this->db->where('name !=', '현금'); // 현금계정은 제외하고 불러옴
		// 검색어가 있을 경우
		if ($st1 != '') {
			$this->db->where('bank_code', $st1);
		}
		if ($st2 != '') {
			$this->db->group_start();
			$this->db->like('bank', $st2);
			$this->db->or_like('name', $st2);
			$this->db->or_like('holder', $st2);
			$this->db->or_like('note', $st2);
			$this->db->group_end();
		}
		$this->db->order_by('no', 'ASC');

		if ($start != '' or $limit != '')	$this->db->limit($limit, $start);
		$qry = $this->db->get($table);

		if ($n == 'num') {
			$result = $qry->num_rows();
		} else {
			$result = $qry->result();
		}
		return $result;
	}


	////////////////////////////////////////////////////////
	// 회사 정보 관리 모델
	////////////////////////////////////////////////////////
	/**
	 * [is_com_chk 회사 정보 등록여부 체크]
	 * @return boolean [회사정보 등록 여부 및 정보]
	 */
	public function is_com_chk()
	{
		$qry = $this->db->get('cms_com');
		if ($result = $qry->row()) {
			return $result;
		} else {
			return FALSE;
		}
	}

	////////////////////////////////////////////////////////
	// 회사 리스트
	////////////////////////////////////////////////////////
	/**
	 * [com_list 회사 리스트]
	 * @return boolean [회사 리스트 정보]
	 */
	public function com_list()
	{
		$query = $this->db->get('cms_com');
		if ($result = $query->result()) {
			return $result;
		} else {
			return FALSE;
		}
	}


	////////////////////////////////////////////////////////
	// 시스템 권한 관리 모델
	////////////////////////////////////////////////////////
	/**
	 * [new_rq_chk 신규 가입 사용자 데이터 추출 함수]
	 * @return [Array] [신청대기자 목록]
	 */
	public function new_rq_chk()
	{
		$this->db->select('mem_id, mem_username, mem_userid, mem_email, mem_register_datetime');
		$qry = $this->db->get_where('member', array('request' => '2'));
		if ($result = $qry->result()) {
			return $result;
		} else {
			return FALSE;
		}
	}

	/**
	 * [rq_perm 신규 가입 사용자 승인 함수]
	 * @param  [String]   $no [유저 넘버]
	 * @param  [Array]    $data [사용신청대기자 승인 여부 데이터]
	 * @return [Boolean]  $result [쿼리 성공 여부]
	 */
	public function rq_perm($where_no, $data)
	{
		$result = $this->db->update('member', $data, array('mem_id' => $where_no));
		return $result;
	}

	/**
	 * [user_list 승인된 사용자 리스트 불러오기 함수]
	 * @return [Array]  [승인된 사용자 리스트 데이터]
	 */
	public function user_list()
	{
		$this->db->select('mem_id, mem_userid, mem_username');
		$qry = $this->db->get_where('member', array('request' => '1'));
		$result = $qry->result();
		return $result;
	}

	/**
	 * [sel_user 권한 부여(수정)할 사용자 선택 함수]
	 * @param  [String] [선택된 사용자 번호]
	 * @return [Array] [선택된 사용자 데이터]
	 */
	public function sel_user($no)
	{
		$this->db->select('mem_id, mem_userid, mem_username, mem_email, mem_register_datetime');
		$qry = $this->db->get_where('member', array('mem_id' => $no));
		$result = $qry->row();
		return $result;
	}

	/**
	 * [user_auth 선택한 사용자의 현재 권한 데이터 추출 함수]
	 * @param  [String] [선택된 사용자 번호]
	 * @return [Array] [사용자 권한 데이터]
	 */
	public function user_auth($no)
	{
		$qry = $this->db->get_where('cms_mem_auth', array('user_no' => $no));
		$result = $qry->row();
		return $result;
	}

	public function auth_reg($no, $auth_data)
	{
		// 권한 등록 회원인지 확인
		$this->db->select('auth_seq');
		$qry = $this->db->get_where('cms_mem_auth', array('user_no' => $no));

		if ($qry->row()) {
			$this->db->where('user_no', $no);
			$result = $this->db->update('cms_mem_auth', $auth_data);
			return $result;
		} else {
			$result = $this->db->insert('cms_mem_auth', $auth_data);
			return $result;
		}
	}
}
// End of this File.
