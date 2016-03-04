<?php
 defined('BASEPATH') OR exit ('No direct script access allowed');

class Popup_m extends CI_Model
{
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

	public function tax_search($search_text='', $start='', $limit='', $num='') {
		$where = "";
		if($search_text !='') { // 검색어가 있을 경우
			$where = " WHERE office LIKE '%".$search_text."%' ";
		}
		$limit_query = "";
		if($start != '' or $limit !='') {
			$limit_query = " LIMIT ".$start.", ".$limit;
		}

		$sql = " SELECT * FROM cms_tax_office ".$where." ORDER BY no ASC ".$limit_query;
		$qry = $this->db->query($sql);
		$rlt1 = $qry->num_rows();
		$rlt2 = $qry->result();

		if($num=='num') {
			return $rlt1;
		}else{
			return $rlt2;
		}
	}
}
// End of this File