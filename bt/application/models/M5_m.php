<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class M5_m extends CI_Model {

	public function auth_chk($string) {
		$sql = " SELECT  ".$string." FROM cms_mem_auth WHERE user_id = '".$this->session->userdata['user_id']."' ";
		$qry = $this->db->query($sql);
		if($result = $qry->row()) {
			return $result = $qry->row();
		}else{
			return FALSE;
		}
	}
}
// End of this File