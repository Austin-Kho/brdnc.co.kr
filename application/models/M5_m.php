<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M5_m extends CI_Model {

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
	 * @return [Boolean]           [변경 등록 성공 여부]
	 */
	public function com_modify($com_data){
		$result = $this->db->update('cms_com_info', $com_data);
		return $result;
	}
}
// End of this File