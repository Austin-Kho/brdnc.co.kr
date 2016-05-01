<?php
 defined('BASEPATH') OR exit ('No direct script access allowed');

class Main_m extends CI_Model
{
	//공통 함수 Start//
	/**
	 * [auth_chk 페이지 조회 등록 권한 체크]
	 * @param  [String] $field [조회할 페이지]
	 * @param  [String] $user  [사용자 아이디]
	 * @return [int]        [권한 값]
	 */
	public function auth_chk($field, $user) {
		$sql = " SELECT ".$field." FROM cms_mem_auth WHERE user_id = '".$user."' ";
		$qry = $this->db->query($sql);
		$result = $qry->row_array();
		return $result;
	}

      public function master_auth_chk(){
            $this->db->select('is_admin, auth_level');
            $qry = $this->db->get_where('cms_member_table', array('user_id'=>$this->session->userdata['user_id']));
            return $result = $qry->result();
      }

      /**
       * [sql_result sql인자로 데이터 추출 함수]
       * @param  [String] $sql [sql 인자]
       * @return [Array]      [추출한 데이터]
       */
      public function sql_result($sql) {
		$qry = $this->db->query($sql);
		return $qry->result();
	}

      /**
       * [sql_num_rows sql 인자로 데이터 수 추출 함수]
       * @param  [String] $sql [sql 인자]
       * @return [Array]      [추출한 데이터 수]
       */
      public function sql_num_rows($sql) {
		$qry = $this->db->query($sql);
		return $qry->num_rows();
	}

      /**
       * [sql_num_result sql 인자로 데이터 수와 데이터 추출]
       * @param  [String] $sql [sql 인자]
       * @return [Array]      [추출한 데이터 수와 데이터 다중배열]
       */
      public function sql_num_result($sql) {
		$qry = $this->db->query($sql);
		return array(
                  'num' => $qry->num_rows(),
                  'result' => $qry->result()
            );
	}
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
}
 // End of this File
