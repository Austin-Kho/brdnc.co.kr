<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Mem_m extends CI_Model
{
	// public function __construct(){
	// 	parent::__construct();
	// }

	/**
	 * [login 로그인 DB처리 모델]
	 * @param  [Array] $auth [로그인 정보 데이터]
	 * @return [boolean]       [로그인 성공 여부]
	 */
	public function login($auth){
		$sql = " SELECT user_id, name, email, request FROM cms_member_table WHERE user_id = '".$auth['user_id']."' AND passwd = '".$auth['passwd']."' ";
		$qry = $this->db->query($sql);

		if($qry->num_rows() >0 ){
			// 맞는 데이터가 있다면 해당 내용 반환
			return $qry->row();
		}else{
			// 맞는 데이터가 없을 경우
			return FALSE;
		}
	}

	/**
	 * [join 회원가입 모델]
	 * @param  [Array] $new_data [회원 가입 정보]
	 * @return [boolean]           [입력 성공 여부]
	 */
	public function join($new_data) {

		////중복 정보 확인
		$this->db->select('no');
		$i_qry = $this->db->get_where('cms_member_table', array('user_id' => $new_data['user_id']));
		if($i_qry->row()) {alert('입력하신 아이디는 이미 등록된 아이디입니다.', ''); exit;}

		$e_qry = $this->db->get_where('cms_member_table', array('email' => $new_data['email']));
		if($e_qry->row()) {alert('입력하신 이메일은 이미 등록된 이메입니다.', ''); exit;}

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
			'reg_date' => 'now()'
		);
		$result = $this->db->insert('cms_member_table', $insert_array); // 테이블명, 데이터

		// 결과 반환
		return $result;
	}

	/**
	 * [user_data_chk 회원정보 수정시 현재 사용자 정보]
	 * @param  [type] $user [현재 사용자 세션 아이디]
	 * @return [Array]       [현재 사용자 정보]
	 */
	public function user_data_chk($user) {
		$sql = " SELECT name, user_id, email, passwd FROM cms_member_table WHERE user_id = '".$user."'" ;
		$qry = $this->db->query($sql);

		return $qry->row();
	}

	/**
	 * [modify 회원정보 수정 모델]
	 * @param  [Array] $data [수정 데이타]
	 * @return [boolean]       [성공 여부]
	 */
	public function modify($data) {

		// 사용자 정보와 비밀번호가 맞는지 체크
		$sql = " SELECT no FROM cms_member_table WHERE user_id = '". $data['user_id']."' AND passwd = '".$data['passwd']."' ";
		$qry = $this->db->query($sql);

		if($qry->num_rows() >0 ){ // 사용자가 인증(ID, PASS가 일치)하면
			// 비밀번호 변경 여부 체크
			if( !$data['new_pass'] or $data['new_pass'] =='') {
				$modi_data = array(
					'name' => $data['name'],
					'email' => $data['email']
				);
			}else{
				$new_pass =  md5($data['new_pass']);
				$modi_data = array(
					'name' => $data['name'],
					'email' => $data['email'],
					'passwd' => $new_pass
				);
			}

			$where = array('user_id' => $data['user_id']);
			// 데이터베이스 UPDATE
			$result = $this->db->update('cms_member_table', $modi_data, $where);
			return $result ;
		}else{
			return FALSE;
		}
	}
}
// End of this File
