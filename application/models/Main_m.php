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
}
 // End of this File
