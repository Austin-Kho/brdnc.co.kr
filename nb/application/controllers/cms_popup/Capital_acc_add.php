<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Capital_acc_add extends CB_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('cms_main_model');
		$this->load->model('cms_popup_model');    // 팝업 모델 로드
		$this->load->helper('cms_cut_string');
		$this->load->helper('cms_is_mobile');
	}

	public function _remap($method)
	{
		//헤더 include
		$this->load->view('/cms_views/popup/pop_header_v');
		if( method_exists($this, $method) )
		{
			$this->{"{$method}"}();
		}
		//푸터 include
		$this->load->view('/cms_views/popup/pop_footer_v');
	}

	public function index()
	{
		$this->accounts();
	}

	public function accounts()
	{
		// $this->output->enable_profiler(TRUE);
		$qry = " SELECT seq, pj_name FROM cb_cms_project_info ";
		$data['pj_info'] = $this->cms_main_model->sql_result($qry);

		// $total_bnum = $_REQUEST['total_bnum'];
		// $where_add = " WHERE no!=1 ";
		// if($sort){
		// 	if($sort=='com'){
		// 		$where_add.=" AND is_com='1' ";
		// 	}else{
		// 		$where_add.=" AND pj_seq='$sort' ";
		// 	}
		// }
		// if($category) $where_add.=" AND ((bank LIKE '%$category%') OR (note LIKE '%$category%')) ";
		// $query="SELECT no FROM cms_capital_bank_account $where_add ";
		// $result=mysql_query($query, $connect);
		// $total_bnum = mysql_num_rows($result);	// 총 게시물 수   11111111111111111111
		// mysqli_free_result($result);
		// if($total_bnum==0){
		// }else{
		// $index_num = 5;                 // 한 페이지 표시할 목록 개수 22222222222222
		// $page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
		// $start=$_REQUEST['start'];
		// if(!$start) $start = 1;              // 현재페이지 444444444
		// $s = ($start-1)*$index_num;
		// $e = $index_num;
		// $query2="SELECT no, bank, name, number, is_com, pj_seq
		// 			 FROM cms_capital_bank_account
		// 			 $where_add
		// 			 ORDER BY no ASC LIMIT $s, $e";
		// $result2=mysql_query($query2, $connect);
		// $search_bnum=mysql_num_rows($result2);
		// for($i=0; $rows2=mysql_fetch_array($result2); $i++){
		// 	$bunho=$total_bnum-($i+$cline)+1;
		// 	if($rows2[is_com]=='1'){$sort = "본사";}
		// 	if($rows2[is_com]=='0'){
		// 		$rlt = mysql_query("SELECT pj_name FROM cms_project_info WHERE seq='$rows2[pj_seq]' ", $connect);
		// 		$row = mysql_fetch_array($rlt);
		// 		$sort = rg_cut_string($row[pj_name],9,"");
		// 	}
		// }
		// $back_url="&amp;sort=$sort&amp;category=$category";
		// page_avg($total_bnum,$page_num, $index_num,$start, $back_url);
		// //1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
		// }



		$this->load->view('/cms_views/popup/acc_add_v', $data);
	}
}
// End of this File
