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
		$this->acc_add();
	}

	public function acc_add()
	{
		$this->output->enable_profiler(TRUE);

		// $qry = " SELECT seq, pj_name FROM cb_cms_project_info ";
		// $data['pj_now'] = $this->cms_main_model->sql_result($qry);

		// //페이지네이션 라이브러리 로딩 추가
		// $this->load->library('pagination');
    //
		// //페이지네이션 설정/////////////////////////////////
		// $config['base_url'] = base_url('cms_popup/capital_acc_add/');   //페이징 주소
		// $config['total_rows'] = $this->cms_m5_model->com_div_list($div_table, '', '', $st1, $st2, 'num', '');  //게시물의 전체 갯수
		// $config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
		// $config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
		// $config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
		// $config['reuse_query_string'] = TRUE; //http://example.com/index.php/test/page/20?query=search%term
    //
		// // 게시물 목록을 불러오기 위한 start / limit 값 가져오기
		// $page = $this->input->get('page'); // get 방식 아닌 경우 $this->uri->segment($config['uri_segment']);
		// $start = ($page<=1 or empty($page)) ? 0 : ($page-1) * $config['per_page'];
		// $limit = $config['per_page'];
    //
		// //페이지네이션 초기화
		// $this->pagination->initialize($config);
		// //페이징 링크를 생성하여 view에서 사용할 변수에 할당
		// $data['pagination'] = $this->pagination->create_links();
    //
		// // db[전체부서목록] 데이터 불러오기
		// $data['all_div'] = $this->cms_m5_model->all_div_name($div_table);
    //
		// //  db [부서]데이터 불러오기
		// $data['list'] = $this->cms_m5_model->com_div_list($div_table, $start, $limit, $st1, $st2, '', ''); // 테이블, 시작, 갯수,

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
