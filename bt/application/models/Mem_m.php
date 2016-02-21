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

	public function join($new_data) {
		// 중복 정보 확인
		$i_sql = " SELECT no FROM cms_member_table WHERE user_id = '".$new_data['user_id']."'";
		$i_qry = $this->db->query($i_sql);

		$e_sql = " SELECT no FROM cms_member_table WHERE email = '".$new_data['email']."'";
		$e_qry = $this->db->query($e_sql);

		if($i_qry->num_rows()>0 && $e_qry->num_rows()>0) {
			alert('입력한 아이디와 이메일이 이미 등록된 정보입니다.', '');
			exit;
		}else if($i_qry->num_rows()>0 && $e_qry->num_rows()==0) {
			alert('입력한 아이디가 이미 등록된 아이디입니다.', '');
			exit;
		}else if($i_qry->num_rows()==0 && $e_qry->num_rows()>0) {
			alert('입력한 이메일이 이미 등록된 이메일입니다.', '');
			exit;
		}else{
			// 신규 등록처리
			$insert_array = array(
				'name' => $new_data['name'],
				'user_id' => $new_data['user_id'],
				'email' => $new_data['email'],
				'rcv_mail' => 1,
				'passwd' => $new_data['passwd'],
				'request' => 2,
				'is_company' => 1,
				'pj_posi' => 0,
				'auth_level' => 9,
				'reg_date' => date('Y-m-d H:i:S')
			);
			$result = $this->db->insert('cms_member_table', $insert_array); // 테이블명, 데이터

			// 결과 반환
			return $result;
		}
	}
}
// End of this File