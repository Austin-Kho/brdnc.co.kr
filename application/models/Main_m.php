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

		$sh_what = $data['sh_what'];
		$sido = $data['sido'];
		$search_text = $data['search_text'];

		if($data['sh_what'] == 1) {
			//$where = "(lemd_name LIKE '%$search_text%') OR (lr_name LIKE '%$search_text%') OR (doro_name LIKE '%$search_text%') OR (ad_name LIKE '%$search_text%')'; // 도로명 검색 (법정읍면동/lemd_name/법정리/lr_name/도로명/doro_name/행정동/ad_name)";
		} // 도로명 검색 (법정읍면동/lemd_name/법정리/lr_name/도로명/doro_name/행정동/ad_name)

		if($data['sh_what'] == 2) {
			//$where = "(abd_name LIKE '%$search_text%') OR (dbd_name LIKE '%$search_text%') OR (sgg_bdn LIKE '%$search_text%')"; // 도로명 검색 (법정읍면동/lemd_name/법정리/lr_name/도로명/doro_name/행정동/ad_name)';
		} // 건물명 검색 (건축물대장/abd_name/상세건물명/dbd_name/시군구용건물명/sgg_bdn)

		$sql = " SELECT * FROM cms_zip_".$data['sido']." WHERE ".$where."; ";
		// $qry = $this->db->qeury($sql);
		// if($num =$qry->num_rows()>0) {
		// 	return $result = $qry->result();
		// }else{
		// 	return FALSE;
		// }
	}
}
 // End of this File