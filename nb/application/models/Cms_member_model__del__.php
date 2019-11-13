<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Cms_member_model extends CB_Model
{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * [join 회원가입 모델]
	 * @param  [Array] $new_data [회원 가입 정보]
	 * @return [boolean] $result  [입력 성공 여부]
	 */
	public function join($new_data) {

		////중복 정보 확인
		$this->db->select('mem_id');
		$i_qry = $this->db->get_where('cb_member', array('mem_userid' => $new_data['mem_userid']));
		if($i_qry->row()) {alert('입력하신 아이디는 이미 등록된 아이디입니다.', ''); exit;}

		$e_qry = $this->db->get_where('cb_member', array('mem_email' => $new_data['mem_email']));
		if($e_qry->row()) {alert('입력하신 이메일은 이미 등록된 이메입니다.', ''); exit;}

		// 신규 등록처리
		$insert_array = array(
			'mem_username' => $new_data['mem_username'],
			'mem_userid' => $new_data['mem_userid'],
			'mem_email' => $new_data['mem_email'],
			'mem_receive_email' => 1,
			'mem_password' => $new_data['mem_password'],
			'request' => 2,
			'is_company' => 1,
			'pj_posi' => NULL,
			'mem_level' => 1
		);
		$this->db->set($insert_array);
		$this->db->set('mem_register_datetime', 'now()', false);
		$result = $this->db->insert('cb_member'); // 테이블명, 데이터

		// 결과 반환
		return $result;
	}

	/**
	 * [user_chk 회원정보 수정 시 현재 사용자 정보 확인 함수]
	 * @param  [type] $mem_id [현재 사용자]
	 * @return [type]       [사용자 데이터]
	 */
	public function user_chk($memid){ // 로그인시 // 정보 수정 시 멤버 확인
		$this->db->select('mem_username, mem_userid, mem_email, mem_password');
		$this->db->where('mem_id', $memid);
		$qry = $this->db->get('cb_member');
		$result = $qry->row();
		return $result;
	}

	/**
	 * [modify 회원정보 수정 모델]
	 * @param  [Array] $data [수정 데이타]
	 * @return [boolean]       [성공 여부]
	 */
	public function modify($data) {
		// 비밀번호 변경 여부 체크
		if( !$data['new_password'] or $data['new_password'] =='') {
			$modi_data = array(
				'mem_username' => $data['mem_username'],
				'mem_email' => $data['mem_email']
			);
		}else{
			$modi_data = array(
				'mem_username' => $data['mem_username'],
				'mem_email' => $data['mem_email'],
				'mem_password' => password_hash($data['new_password'], PASSWORD_BCRYPT)
			);
		}

		$where = array('mem_userid' => $data['mem_userid']);
		// 데이터베이스 UPDATE
		$result = $this->db->update('cb_member', $modi_data, $where);
		return $result ;
	}
}
// End of this File
