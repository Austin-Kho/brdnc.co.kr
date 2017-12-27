<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Popup_m extends CI_Model
{
      /**
       * [zip_search 우편번호 검색 함수]
       * @param  [String] $data [검색어]
       * @return [Array]       [결과 데이터]
       */
  //     public function zip_search($data) {
  //
	// 	  $a = $data['search_text'];
	// 	  $b = explode(" ", $a);
	// 	  for($i=0; $i<count($b); $i++){
	// 	  	$d[$i] = explode("-", $b[$i]);
	// 	  }
	// 	  for($i=0; $i<count($d); $i++){
	// 	  	for($j=0; $j<count($d[$i]); $j++) {
	// 	  		$search_text[] = $d[$i][$j];
	// 	  	}
	// 	  }
  //
	// 	if($data['sh_what'] == 1) { // 도로명주소 검색 시
	// 		for($i=0; $i<count($search_text); $i++){
	// 			if($i==0) $where = " ((epmn LIKE '%$search_text[0]%') OR (doro_name LIKE '%$search_text[0]%') OR (ld_name LIKE '%$search_text[0]%') OR (lr_name LIKE '%$search_text[0]%') OR (ad_name LIKE '%$search_text[0]%')) ";
	// 			if($i==1 && $search_text[1]!=="") $where .= " AND (mb_num=$search_text[1] OR ml_num=$search_text[1]) ";
	// 		}
	// 	} // 도로명 검색 (법정읍면동/lemd_name/법정리/lr_name/도로명/doro_name/행정동/ad_name)
  //
	// 	if($data['sh_what'] == 2) { // 건물명 검색 시
	// 		for($i=0; $i<count($search_text); $i++){
	// 			if($i==0) $where = "(sgg_bd_name LIKE '%$search_text[0]%')";
	// 			if($i==1 && $search_text[1]!=="") $where .= " AND (mb_num=$search_text[1])  ";
	// 		}
  //
	// 	} // 건물명 검색 (건축물대장/abd_name/상세건물명/dbd_name/시군구용건물명/sgg_bdn)
  //
	// 	// zipcode
	// 	$sql = " SELECT * FROM cms_zip_".$data['sido']." WHERE ".$where;
	// 	$qry = $this->db->query($sql);
  //
	// 	$rlt1 = $qry->num_rows();
	// 	$rlt2 = $qry->result();
	// 	return $result = array($rlt1, $rlt2);
	// }

      /**
       * [tax_search 세무서 검색 함수]
       * @param  string $search_text [검색어]
       * @param  string $start       [페이지네이션 스타트]
       * @param  string $limit       [페이진네이션 리미트]
       * @param  string $num         [총 게시물 구하기 위한 인자]
       * @return [Array]              [결과 데이터]
       */
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

		if($num=='num') {	$result = $qry->num_rows(); }else{ $result = $qry->result(); }
		return $result;
	}

      /**
       * [d2_acc description]
       * @param  [type] $acc_d1 [검색어]
       * @return [type]         [결과 데이터]
       */
      public function d2_acc($acc_d1) {
            $where = " 1=1 ";
            if($acc_d1) $where .= " AND d1_code = '$acc_d1' ";
            $this->db->select('d2_code, d2_acc_name');
            $this->db->where($where);
            $this->db->order_by('d2_code', 'ASC');
            $qry = $this->db->get('cms_capital_account_d2');
            return $result = $qry->result();
      }
}
// End of this File
