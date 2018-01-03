<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Cms_popup_model extends CB_Model
{
      /**
       * [tax_search 세무서 검색 함수]
       * @param  string $search_text [검색어]
       * @param  string $start       [페이지네이션 스타트]
       * @param  string $limit       [페이진네이션 리미트]
       * @param  string $num         [총 게시물 구하기 위한 인자]
       * @return [Array]  $result      [결과 데이터]
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
