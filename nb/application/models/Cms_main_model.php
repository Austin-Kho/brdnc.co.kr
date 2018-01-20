<?php
 defined('BASEPATH') OR exit ('No direct script access allowed');

class Cms_main_model extends CB_Model
{


  /**************************************************************************************/
	//공통 함수 Start//

  /**
	 * [select_data_list 복수 데이터 불러오기]
	 * @param  [String] $table [테이블명]
	 * @param  [Array] $where [필터링 '키'=>값]
	 * @return [Array]        [추출 데이터]
	 */
	public function select_data_list($table, $where=''){
		if($where!='') $this->db->where($where);
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
	 * [select_data_num 데이터 수 가져오기]
	 * @param  [String] $table [테이블명]
	 * @param  string $where [검색조건]
	 * @return [Array]        [추출 데이터]
	 */
	public function select_data_num($table, $where=''){
		if($where!='') $this->db->where($where);
		$qry = $this->db->get($table);
		return $rlt = $qry->num_rows();
	}

  /**
	 * [select_data_opt description]
	 * @param  [type] $table [description]
	 * @param  string $where [description]
	 * @param  string $opt   [description]
	 * @return [type]        [description]
	 */
	public function select_data_opt($table, $where='', $opt=''){
		if($where!='') $this->db->where($where);
		$qry = $this->db->get($table);
		switch ($opt) {
			case '1': $val = $qry->row(); break;
			case '2': $val = $qry->result(); break;
			case '3': $val = $qry->num_rows(); break;
			case '4': $val = array('result' => $qry->result(), 'num' => $qry->num_rows()); break;
			default: $val = $qry->result(); break;
		}
		return $val;
	}

  /**
	 * [sql_row sql 인자로 단수데이터 추출 함수]
	 * @param  [type] $sql [sql 인자]
	 * @return [type]      [추출한 데이터]
	 */
	public function sql_row($sql){
		$qry = $this->db->query($sql);
		return $qry->row();
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
	 * [sql_sel_opt sql 인자로 데이터 추출 // 추출방식 옵션 적용]
	 * @param  [type] $sql [sql 인자]
	 * @param  [type] $opt [1. row 2. result 3. num_rows 4. result + num_rows]
	 * @return [type]      [추출한 데이터]
	 */
	public function sql_sel_opt($sql, $opt){
		$qry = $this->db->query($sql);
		switch ($opt) {
			case '1': $ret_val = $qry->row(); break;
			case '2': $ret_val = $qry->result(); break;
			case '3': $ret_val = $qry->num_rows(); break;
			case '4': $ret_val = array('result' => $qry->result(), 'num' => $qry->num_rows()); break;
		}
		return $ret_val;
	}

  /**
   * [insert_data 데이터 입력함수]
   * @param  [String] $table [테이블명]
   * @param  [Array] $data  [입력할 데이터]
   * @return [Boolean]        [입력 성공여부]
   */
  public function insert_data($table, $data, $now_field='') {
		$this->db->set($data);
		if($now_field !=='') $this->db->set($now_field, 'now()', false);
		$result = $this->db->insert($table);
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

  //공통 함수 End//
	/**************************************************************************************/

  /**************************************************************************************/
  /**
	 * [auth_chk 페이지 조회 등록 권한 체크]
	 * @param  [String] $field [조회할 페이지]
	 * @param  [String] $where  [사용자 아이디]
	 * @return [int]        [권한 값]
	 */
	public function auth_chk($field, $where) {
    $this->db->select($field);
    $query = $this->db->get_where('cms_mem_auth', array('user_no' => $where));
    return $row = $query->row_array();
	}

	/**
	 * [master_auth_chk 마스터 권한 확인]
	 * @return [Array] [결과 데이터]
	 */
	public function master_auth_chk(){
    $this->db->select('mem_is_admin, mem_level');
    $qry = $this->db->get_where('member', array('mem_id'=>$this->session->userdata['mem_id']));
    return $result = $qry->row();
  }

	/**************************************************************************************/
}
 // End of this File
