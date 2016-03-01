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

	public function zip_search($data) {

		$search_text = $data['search_text'];

		if($data['sh_what'] == 1) { // 도로명주소 검색 시
			$where = "(epmn LIKE '%$search_text%') OR (doro_name LIKE '%$search_text%') OR (ld_name LIKE '%$search_text%') OR (lr_name LIKE '%$search_text%') OR (ad_name LIKE '%$search_text%')";
		} // 도로명 검색 (법정읍면동/lemd_name/법정리/lr_name/도로명/doro_name/행정동/ad_name)

		if($data['sh_what'] == 2) { // 건물명 검색 시
			$where = "(sgg_bd_name LIKE '%$search_text%')";
		} // 건물명 검색 (건축물대장/abd_name/상세건물명/dbd_name/시군구용건물명/sgg_bdn)

		// zipcode
		$sql = " SELECT * FROM cms_zip_".$data['sido']." WHERE ".$where;
		$qry = $this->db->query($sql);

		$rlt1 = $qry->num_rows();
		$rlt2 = $qry->result();
		return $result = array($rlt1, $rlt2);
	}
}
 // End of this File