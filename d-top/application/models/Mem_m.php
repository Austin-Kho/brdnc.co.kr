<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Mem_m extends CI_Model
{
	// public function __construct(){
	// 	parent::__construct();
	// }

	/**
	 * [login 로그인 DB처리]
	 * @param  [Array] $auth [로그인 정보 데이터]
	 * @return [boolean]       [로그인 성공 여부]
	 */
	public function login($auth){
		$sql = " SELECT user_id, email, request FROM cms_member_table WHERE user_id = '".$auth['user_id']."' AND passwd = '".$auth['passwd']."' ";
		$qry = $this->db->query($sql);

		if($qry->num_rows() >0 ){
			// 맞는 데이터가 있다면 해당 내용 반환
			return $qry->row();
		}else{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}
}
// End of this File