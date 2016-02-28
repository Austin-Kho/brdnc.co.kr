<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M5_m extends CI_Model {

	public function is_com_chk() {
		$sql = " SELECT seq, co_no FROM cms_com_info1 ";
		$qry = $this->db->query($sql);
		if($result = $qry->row()) {
			return $result;
		}else{
			return FALSE;
		}
	}
}
// End of this File