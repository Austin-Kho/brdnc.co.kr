<?php
 defined('BASEPATH') OR exit ('No direct script access allowed');

class Main_m extends CI_Model
{
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
}
 // End of this File
