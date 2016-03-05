<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M5_m extends CI_Model {

	public function is_com_chk() {
		$sql = " SELECT * FROM cms_com_info1 ";
		$qry = $this->db->query($sql);
		if($result = $qry->row()) {
			return $result;
		}else{
			return FALSE;
		}
	}
	public function com_reg($com_data){
		$result = $this->db->insert('cms_com_info1', $com_data);
		return $result;
	}

	public function com_modify($com_data){
		alert('bb', '');
		return $a= '수정등록';
	}
}
// End of this File