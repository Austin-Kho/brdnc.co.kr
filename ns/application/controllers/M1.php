<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M1 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member').'?returnURL='.rawurlencode(base_url(uri_string())));
		}
		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m1_m'); //모델 파일 로드
		$this->load->helper('cut_string'); // 문자열 자르기 헬퍼 로드
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->sales();
	}

	public function _remap($method){
		// 헤더 include
		$this->load->view('cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_main_footer');
	}

	public function sales($mdi='', $sdi=''){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('계약 현황', '계약 등록', '동호수 현황'), // 첫번째 하위 메뉴
			array('수납 현황', '수납 등록', '수납약정'),	 // 두번째 하위 메뉴
			array('프로젝트별 계약현황', '프로젝트별 계약등록(수정)', '동호수 계약 현황표'),  // 첫번째 하위 제목
			array('분양대금 수납 현황 ---------- [구축 작업 전]', '분양대금 수납 등록 ---------- [구축 작업 전]', '프로젝트 타입별 수납약정 관리 ---------- [구축 작업 전]')   // 두번째 하위 제목
		);

		// 등록된 프로젝트 데이터
		$where = "";
		if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
		$data['all_pj'] = $this->main_m->sql_result(' SELECT * FROM cms_project '.$where.' ORDER BY biz_start_ym DESC ');
		$project = $data['project'] = ($this->input->get('project')) ? $this->input->get('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)

		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('menu/m1/sales_v', $menu);



		// 계약현황 1. 계약현황 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m1_1_1'] or $auth['_m1_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_1_1'];


				// . 프로젝트명, 타입 정보 구하기
				$pj_info = $data['pj_info'] = $this->main_m->sql_row(" SELECT pj_name, type_name, type_color FROM cms_project WHERE seq='$project' ");
				$data['tp_color'] = explode("-", $pj_info->type_color);

				$data['tp_name'] = $this->main_m->sql_result(" SELECT type FROM cms_project_all_housing_unit WHERE pj_seq='$project' GROUP BY type ");

				for($i=0; $i<count($data['tp_name']); $i++) {
					$data['summary'][$i] = $this->main_m->sql_row(" SELECT COUNT(type) AS type_num, SUM(is_hold) AS hold, SUM(is_application) AS app, SUM(is_contract) AS cont FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND type='".$data['tp_name'][$i]->type."' ");
				}
				// 요약 총계 데이터 가져오기
				$data['sum_all'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS unit_num, SUM(is_hold) AS hold, SUM(is_application) AS app, SUM(is_contract) AS cont FROM cms_project_all_housing_unit WHERE pj_seq='$project' ");

				// 청약 데이터 가져오기
				$dis_date = date('Y-m-d', strtotime('-3 day'));
				$data['app_data'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_application WHERE pj_seq='$project' AND disposal_div='0' OR disposal_div='2' OR ((disposal_div='1' OR disposal_div='3') AND disposal_date>='$dis_date') ORDER BY app_date DESC, seq DESC ");

				// 계약 데이터 필터링(타입, 동 별)

				$data['sc_cont_type'] = $this->main_m->sql_result(" SELECT unit_type FROM cms_sales_contract GROUP BY unit_type ORDER BY unit_type ");
				if($this->input->get('type')) {
					$data['sc_cont_dong'] = $this->main_m->sql_result(" SELECT unit_dong FROM cms_sales_contract WHERE unit_type='".$this->input->get('type')."' GROUP BY unit_dong ORDER BY unit_dong ");
				}else {
					$data['sc_cont_dong'] = $this->main_m->sql_result(" SELECT unit_dong FROM cms_sales_contract GROUP BY unit_dong ORDER BY unit_dong ");
				}

				// 계약 데이터 검색 필터링
				$cont_query = "  SELECT *, cms_sales_contractor.seq AS contractor_seq  ";
				$cont_query .= " FROM cms_sales_contract, cms_sales_contractor  ";
				$cont_query .= " WHERE pj_seq='$project' AND is_transfer='0' AND is_rescission='0' AND cms_sales_contract.seq = cont_seq ";
				if( !empty($this->input->get('type'))) {$tp = $this->input->get('type'); $cont_query .= " AND unit_type='$tp' ";}
				if( !empty($this->input->get('dong'))) {$dn = $this->input->get('dong'); $cont_query .= " AND unit_dong='$dn' ";}
				if( !empty($this->input->get('s_date'))) {$sd = $this->input->get('s_date'); $cont_query .= " AND cms_sales_contract.cont_date>='$sd' ";}
				if( !empty($this->input->get('e_date'))) {$ed = $this->input->get('e_date'); $cont_query .= " AND cms_sales_contract.cont_date<='$ed' ";}

				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('m1/sales/1/1');   //페이징 주소
				$config['total_rows'] = $data['total_rows'] = $this->main_m->sql_num_rows($cont_query);  //게시물의 전체 갯수
				if( !$this->input->get('num')) $config['per_page'] = 10;  else $config['per_page'] = $this->input->get('num'); // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
				$config['reuse_query_string'] = TRUE;    //http://example.com/index.php/test/page/20?query=search%term

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->uri->segment($config['uri_segment']);
				if($page<=1 or empty($page)) { $start = 0; }else{ $start = ($page-1) * $config['per_page']; }
				$limit = $config['per_page'];

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();




				// 계약 데이터 가져오기
				$cont_query .= " ORDER BY cms_sales_contract.cont_date DESC, cms_sales_contract.seq DESC ";
				if($start != '' or $limit !='')	$cont_query .= " LIMIT ".$start.", ".$limit." ";
				$data['cont_data'] = $this->main_m->sql_result($cont_query); // 계약 및 계약자 데이터

				//본 페이지 로딩
				$this->load->view('/menu/m1/md1_sd1_v', $data);
			}







		// 계약현황 2. 계약등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m1_1_2'] or $auth['_m1_1_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_1_2'];


				$where_add = " WHERE pj_seq='$project' "; // 프로젝트 지정 쿼리

				// 타입 데이터 불러오기
				if($this->input->get('mode')=='1'){ // 신규 등록 시
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==1) $where_add .= " AND is_hold='0' AND is_application='0' AND is_contract='0' "; // 청약 대상
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==2) $where_add .= " AND is_hold='0' AND is_contract='0' "; // 계약대상

				}else if($this->input->get('mode')=='2'){ // 변경 등록 시
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==1) $where_add .= " AND is_hold='0' AND is_application='1' "; // 청약 대상
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==2) $where_add .= " AND is_hold='0' AND (is_application='1' OR is_contract='1') "; // 계약대상
					if($this->input->get('cont_sort1')==2 && $this->input->get('cont_sort3')==3) $where_add .= " AND is_application='1' "; // 청약 물건 (청약해지대상)
					if($this->input->get('cont_sort1')==2 && $this->input->get('cont_sort3')==4) $where_add .= " AND is_contract='1' ";	 // 계약 물건 (계약해지대상)
				}
				$data['type_list'] = $this->main_m->sql_result("SELECT type FROM cms_project_all_housing_unit $where_add GROUP BY type ORDER BY type");

				// 동 데이터 불러오기
				$now_type = $this->input->get('type');
				if($this->input->get('type')) $where_add .= " AND type='$now_type' ";
				$data['dong_list'] = $this->main_m->sql_result("SELECT dong FROM cms_project_all_housing_unit $where_add GROUP BY dong ORDER BY dong");

				// 호수 데이터 불러오기
				$now_dong = $this->input->get('dong');
				if($this->input->get('dong')) $where_add .= " AND dong='$now_dong' ";
				$data['ho_list'] = $this->main_m->sql_result("SELECT ho FROM cms_project_all_housing_unit $where_add GROUP BY ho ORDER BY ho");

				// 타입 동호수 텍스트
				$now_ho = $this->input->get('ho');

				if( !$this->input->get('cont_sort1')){
					$msg = "* 등록 구분을 선택하세요.";
				}else if( !$this->input->get('cont_sort2') &&  !$this->input->get('cont_sort3')){
					$msg = "* 세부 등록 구분을 선택하세요.";
				}else if( !$this->input->get('type')){
					$msg = "* 등록(변경)할 타입을 선택 하세요.";
				}else if( !$this->input->get('dong')){
					$msg = "* 등록(변경)할 동을 선택 하세요.";
				}else if( !$this->input->get('ho')){
					$msg = "* 등록(변경)할 호수를 선택 하세요.";
				}
				$data['dong_ho'] = ($this->input->get('ho'))
				? "<font color='#9f0404'><span class='glyphicon glyphicon-fire' aria-hidden='true' style='padding-right: 10px;'></span></font><b>[".$now_type." 타입] &nbsp;".$now_dong ." 동 ". $now_ho." 호</b>"
				: "<span style='color: #9f0404;'>".$msg."</span>";


				// 청약 또는 계약 체결된 동호수인지 확인
				if($now_ho){
					$dongho = $data['unit_dong_ho'] = $now_dong."-".$now_ho; // 동호(1005-2002 형식)

					//  등록할 동호수 유닛 데이터
					$unit_seq = $data['unit_seq'] =  $this->main_m->sql_row(" SELECT * FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND type='$now_type' AND dong='$now_dong' AND ho='$now_ho' ");

					// 청약 또는 계약 유닛인지 확인
					if($unit_seq->is_application=='1') { // 청약 물건이면
						$app_data = $data['is_reg']['app_data'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_application WHERE unit_seq='$unit_seq->seq' AND disposal_div='0' "); // 청약 데이터
					}else if($unit_seq->is_contract=='1'){ // 계약 물건이면
						$cont_where = " WHERE unit_seq='$unit_seq->seq' AND is_transfer='0' AND is_rescission='0' AND cms_sales_contract.seq=cont_seq  ";
						$cont_query = "  SELECT *, cms_sales_contractor.seq AS contractor_seq  FROM cms_sales_contract, cms_sales_contractor ".$cont_where;
						$cont_data = $data['is_reg']['cont_data'] = $this->main_m->sql_row($cont_query); // 계약 및 계약자 데이터
					}
				}

				// 차수 데이터 불러오기
				$data['diff_no'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_con_diff  WHERE pj_seq='$project' ORDER BY diff_no ");

				// 분양대금 수납 계정
				$data['dep_acc'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_bank_acc WHERE pj_seq='$project' ORDER BY seq ");

				// 계약 등록 시 당회 납부 회차 데이터 가져오기
				if($this->input->get('cont_sort2')=='2'){
					$data['pay_schedule'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_pay_sche WHERE pj_seq='$project' ORDER BY seq ");
				}

				// 수납 관리 테이블 정보 가져오기
				if( !empty($cont_data)) $data['receiv_app'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='1' ");
				if( !empty($cont_data)) $data['received']['1'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='2' ");
				if( !empty($cont_data)) $data['received']['2'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='3' ");
				if( !empty($cont_data)) $data['received']['3'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='4' ");
				if( !empty($cont_data)) $data['received']['4'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='5' ");
				if( !empty($cont_data)) $data['received']['5'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='6' ");
				if( !empty($cont_data)) $data['received']['6'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='7' ");
				if( !empty($cont_data)) $data['received']['7'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='8' ");
				if( !empty($cont_data)) $data['rec_num'] = $this->main_m->sql_num_rows(" SELECT seq FROM cms_sales_received WHERE cont_seq='$cont_data->seq' ");


				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				$this->form_validation->set_rules('project', '프로젝트', 'trim|required');
				$this->form_validation->set_rules('cont_sort1', '등록구분1', 'trim|required');
				$this->form_validation->set_rules('type', '타입', 'trim|required');
				$this->form_validation->set_rules('dong', '동', 'trim|required');
				$this->form_validation->set_rules('ho', '호수', 'trim|required');
				$this->form_validation->set_rules('cont_code', '계약일련번호', 'trim|max_length[12]');
				$this->form_validation->set_rules('custom_name', '청/계약자명', 'trim|required|max_length[20]');
				$this->form_validation->set_rules('app_in_mon', '청약금', 'trim|numeric');
				$this->form_validation->set_rules('tel_1', '연락처[1]', 'trim|required');
				$this->form_validation->set_rules('conclu_date', '청/계약일', 'trim|required');
				$this->form_validation->set_rules('deposit_1', '계약금1', 'trim|numeric');
				$this->form_validation->set_rules('deposit_2', '계약금2', 'trim|numeric');
				$this->form_validation->set_rules('deposit_3', '계약금3', 'trim|numeric');
				$this->form_validation->set_rules('deposit_4', '계약금4', 'trim|numeric');
				$this->form_validation->set_rules('deposit_5', '계약금5', 'trim|numeric');
				$this->form_validation->set_rules('deposit_6', '계약금6', 'trim|numeric');
				$this->form_validation->set_rules('deposit_7', '계약금7', 'trim|numeric');
				$this->form_validation->set_rules('zipcode', '우편변호1', 'trim|numeric|max_length[5]');
				$this->form_validation->set_rules('address1', '메인주소1', 'trim|max_length[100]');
				$this->form_validation->set_rules('address2', '세부주소1', 'trim|max_length[50]');
				$this->form_validation->set_rules('zipcode_', '우편번호2', 'trim|numeric|max_length[5]');
				$this->form_validation->set_rules('address1_', '메인주소2', 'trim|max_length[100]');
				$this->form_validation->set_rules('address2_', '세부주소2', 'trim|max_length[50]');
				$this->form_validation->set_rules('note', '비고', 'trim|max_length[200]');

				if($this->form_validation->run() == FALSE) {

					//본 페이지 로딩
					$this->load->view('/menu/m1/md1_sd2_v', $data);
				}else{

					if($this->input->post('cont_sort2')=='1'){ // 청약일 때
						$pj = $this->input->post('project', TRUE); // 프로젝트 아이디
						$un = $this->input->post('unit_seq', TRUE); // 동호 아이디
						// 1. 청약 관리 테이블 입력
						$app_arr = array(
							'pj_seq' => $this->input->post('project', TRUE),
							'applicant' => $this->input->post('custom_name', TRUE),
							'app_tel1' => $this->input->post('tel_1', TRUE),
							'app_tel2' => $this->input->post('tel_2', TRUE),
							'app_date' => $this->input->post('conclu_date', TRUE),
							'due_date' => $this->input->post('due_date', TRUE),
							'unit_seq' => $this->input->post('unit_seq', TRUE),
							'unit_type' => $this->input->post('type', TRUE),
							'unit_dong_ho' => $this->input->post('unit_dong_ho', TRUE),
							'app_diff' => $this->input->post('diff_no', TRUE),
							'app_in_mon' => $this->input->post('app_in_mon', TRUE),
							'app_in_acc' => $this->input->post('app_in_acc', TRUE),
							'app_in_date' => $this->input->post('app_in_date', TRUE),
							'app_in_who' => $this->input->post('app_in_who', TRUE),
							'note' => $this->input->post('note', TRUE)
						);
						if($this->input->post('mode')=='1' && $this->input->post('unit_is_app')=='0'){ // 신규 청약 등록 일 때
							$add_arr = array('ini_reg_worker' => $this->session->userdata('name'));
							$app_put = array_merge($app_arr, $add_arr);
							$result = $this->main_m->insert_data('cms_sales_application', $app_put, 'ini_reg_date'); // 청약관리 테이블 데이터 입력
							if( !$result){
								alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}else{
								// 2. 동호수 관리 테이블 입력
								$where = array('type'=>$this->input->post('type'), 'dong'=>$this->input->post('dong'), 'ho'=>$this->input->post('ho'));
								$result2 = $this->main_m->update_data('cms_project_all_housing_unit', array('is_application'=>'1', 'modi_date'=>date('Y-m-d'), 'modi_worker'=>$this->session->userdata('name')), $where); // 동호수 테이블 청약상태로 변경
								if( !$result2) alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}
						}else if($this->input->post('mode')=='2' && $this->input->post('unit_is_app')=='1'){ // 기존 청약정보 수정일 때
							$add_arr = array('last_modi_date' => date('Y-m-d'), 'last_modi_worker' => $this->session->userdata('name'));
							$app_put = array_merge($app_arr, $add_arr);
							$where = array('pj_seq'=>$pj, 'unit_type' =>$this->input->post('type'), 'unit_dong_ho'=>$this->input->post('unit_dong_ho'));
							$result = $this->main_m->update_data('cms_sales_application', $app_put, $where); // 청약관리 테이블 데이터 입력
							if( !$result){
								alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}
						}
						$ret_url = "?mode=2&cont_sort1=".$this->input->post('cont_sort1')."&cont_sort2=".$this->input->post('cont_sort2')."&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho');
						alert('청약 정보 입력이 정상 처리되었습니다.', base_url('m1/sales/1/2').$ret_url);


					/////////////////////////////////////////////////////////////////////////////신규 계약 인서트
					}else if($this->input->post('cont_sort2')=='2'){ // 계약일 때
						$pj = $this->input->post('project', TRUE); // 프로젝트 아이디
						$un = $this->input->post('unit_seq', TRUE); // 동호 아이디

						/******************************계약 테이블 데이터******************************/
						$con_fl = $this->main_m->sql_result(" SELECT * FROM cms_sales_con_floor WHERE pj_seq='$pj' ORDER BY seq "); // 층별 조건 객체배열

						if(strlen($this->input->post('ho'))==3) { // 현재 층수 구하기
							$now_floor = substr($this->input->post('ho'), 0, 1);
						}else if(strlen($this->input->post('ho'))==4){
							$now_floor = substr($this->input->post('ho'), 0, 2);
						}

						foreach($con_fl as $lt) { // 층수조건 아이디 (con_floor_seq) 구하기
							$a = explode("-", $lt->floor_range);
							if($now_floor>=$a[0] && $now_floor<=$a[1]) $con_floor_seq = $lt->seq;
						}

						$pr_where = array(
							'pj_seq'=>$pj,
							'con_type'=>$this->input->post('type'),
							'con_diff_seq'=>$this->input->post('diff_no'),
							'con_direction_seq'=>'1', // 향후 필요 시 폼으로 데이터 받을 것
							'con_floor_seq'=>$con_floor_seq
						);

						$price_seq = $this->main_m->select_data_row('cms_sales_price' , $pr_where);
						$last_paid_sche = ($this->input->post('cont_pay_sche2')) ? $this->input->post('cont_pay_sche2') : $this->input->post('cont_pay_sche1');

						$cont_arr1 = array( // 계약 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_code' => $this->input->post('cont_code', TRUE),
							'cont_date' => $this->input->post('conclu_date', TRUE),
							'unit_seq' => $this->input->post('unit_seq', TRUE),
							'unit_type' => $this->input->post('type', TRUE),
							'unit_dong' => $this->input->post('dong', TRUE),
							'unit_dong_ho' => $this->input->post('unit_dong_ho', TRUE),
							'cont_diff' => $this->input->post('diff_no', TRUE),
							'price_seq' => $price_seq->seq,
							'last_paid_sche' => $last_paid_sche,
							'note' => $this->input->post('note', TRUE)
						);
						/******************************계약 테이블 데이터******************************/

						if($this->input->post('unit_is_cont')=='0'){  // 신규 계약일 때
//   1. 계약관리 테이블에 해당 데이터를 인서트한다.
							$add_arr1 = array('ini_reg_worker' => $this->session->userdata('name'));
							$cont_arr11 = array_merge($cont_arr1, $add_arr1);
							$result[0] = $this->main_m->insert_data('cms_sales_contract', $cont_arr11, 'ini_reg_date');
							if( !$result[0]){
								alert('데이터베이스 에러입니다.1', base_url(uri_string()));
							}
						}

						/******************************계약자 테이블 데이터******************************/
						$cont_seq = $this->main_m->sql_row(" SELECT seq FROM cms_sales_contract WHERE pj_seq='$pj' AND unit_seq='$un' ");
						$addr_id = $this->input->post('zipcode')."|".$this->input->post('address1')."|".$this->input->post('address2');
						$addr_dm = $this->input->post('zipcode_')."|".$this->input->post('address1_')."|".$this->input->post('address2_');
						$idoc1 = $this->input->post('incom_doc_1');
						$idoc2 = $this->input->post('incom_doc_2');
						$idoc3 = $this->input->post('incom_doc_3');
						$idoc4 = $this->input->post('incom_doc_4');
						$idoc5 = $this->input->post('incom_doc_5');
						$idoc6 = $this->input->post('incom_doc_6');
						$idoc7 = $this->input->post('incom_doc_7');
						$idoc8 = $this->input->post('incom_doc_8');
						$incom_doc = $idoc1."-".$idoc2."-".$idoc3."-".$idoc4."-".$idoc5."-".$idoc6."-".$idoc7."-".$idoc8;

						$cont_arr2 = array( // 계약자 테이블 입력 데이터
							'contractor' => $this->input->post('custom_name', TRUE),
							'cont_tel1' =>  $this->input->post('tel_1', TRUE),
							'cont_tel2' =>  $this->input->post('tel_2', TRUE),
							'cont_addr1' =>  $addr_id,
							'cont_addr2' =>  $addr_dm,
							'cont_date' =>  $this->input->post('conclu_date', TRUE),
							'incom_doc' =>  $incom_doc
						);
						/******************************계약자 테이블 데이터******************************/
						/******************************계약금 1 폼 데이터******************************/
						$cont_arr3 = array( // 수납 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_seq' => $cont_seq->seq,
							'pay_sche_code' => $this->input->post('cont_pay_sche1', TRUE), // 당회 납부 회차
							'paid_amount' => $this->input->post('deposit_1', TRUE), // 납부한 금액
							'paid_acc' => $this->input->post('dep_acc_1', TRUE),
							'paid_date' => $this->input->post('cont_in_date1', TRUE),
							'paid_who' => $this->input->post('cont_in_who1', TRUE),
							'cont_form_code' => '2',
							'reg_worker' => $this->session->userdata('name')
						);
						/******************************계약금 1 폼 데이터******************************/
						/******************************계약금 2 폼 데이터******************************/
						$cont_arr4 = array( // 수납 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_seq' => $cont_seq->seq,
							'pay_sche_code' => $this->input->post('cont_pay_sche2', TRUE), // 당회 납부 회차
							'paid_amount' => $this->input->post('deposit_2', TRUE), // 납부한 금액
							'paid_acc' => $this->input->post('dep_acc_2', TRUE),
							'paid_date' => $this->input->post('cont_in_date2', TRUE),
							'paid_who' => $this->input->post('cont_in_who2', TRUE),
							'cont_form_code' => '3',
							'reg_worker' => $this->session->userdata('name')
						);
						/******************************계약금 2 폼 데이터******************************/
						/******************************계약금 3 폼 데이터******************************/
						$cont_arr5 = array( // 수납 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_seq' => $cont_seq->seq,
							'pay_sche_code' => $this->input->post('cont_pay_sche3', TRUE), // 당회 납부 회차
							'paid_amount' => $this->input->post('deposit_3', TRUE), // 납부한 금액
							'paid_acc' => $this->input->post('dep_acc_3', TRUE),
							'paid_date' => $this->input->post('cont_in_date3', TRUE),
							'paid_who' => $this->input->post('cont_in_who3', TRUE),
							'cont_form_code' => '4',
							'reg_worker' => $this->session->userdata('name')
						);
						/******************************계약금 3 폼 데이터******************************/
						/******************************계약금 4 폼 데이터******************************/
						$cont_arr6 = array( // 수납 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_seq' => $cont_seq->seq,
							'pay_sche_code' => $this->input->post('cont_pay_sche4', TRUE), // 당회 납부 회차
							'paid_amount' => $this->input->post('deposit_4', TRUE), // 납부한 금액
							'paid_acc' => $this->input->post('dep_acc_4', TRUE),
							'paid_date' => $this->input->post('cont_in_date4', TRUE),
							'paid_who' => $this->input->post('cont_in_who4', TRUE),
							'cont_form_code' => '5',
							'reg_worker' => $this->session->userdata('name')
						);
						/******************************계약금 4 폼 데이터******************************/
						/******************************계약금 5 폼 데이터******************************/
						$cont_arr7 = array( // 수납 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_seq' => $cont_seq->seq,
							'pay_sche_code' => $this->input->post('cont_pay_sche5', TRUE), // 당회 납부 회차
							'paid_amount' => $this->input->post('deposit_5', TRUE), // 납부한 금액
							'paid_acc' => $this->input->post('dep_acc_5', TRUE),
							'paid_date' => $this->input->post('cont_in_date5', TRUE),
							'paid_who' => $this->input->post('cont_in_who5', TRUE),
							'cont_form_code' => '6',
							'reg_worker' => $this->session->userdata('name')
						);
						/******************************계약금 5 폼 데이터******************************/
						/******************************계약금 6 폼 데이터******************************/
						$cont_arr8 = array( // 수납 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_seq' => $cont_seq->seq,
							'pay_sche_code' => $this->input->post('cont_pay_sche6', TRUE), // 당회 납부 회차
							'paid_amount' => $this->input->post('deposit_6', TRUE), // 납부한 금액
							'paid_acc' => $this->input->post('dep_acc_6', TRUE),
							'paid_date' => $this->input->post('cont_in_date6', TRUE),
							'paid_who' => $this->input->post('cont_in_who6', TRUE),
							'cont_form_code' => '7',
							'reg_worker' => $this->session->userdata('name')
						);
						/******************************계약금 6 폼 데이터******************************/
						/******************************계약금 7 폼 데이터******************************/
						$cont_arr9 = array( // 수납 테이블 입력 데이터
							'pj_seq' => $this->input->post('project', TRUE),
							'cont_seq' => $cont_seq->seq,
							'pay_sche_code' => $this->input->post('cont_pay_sche7', TRUE), // 당회 납부 회차
							'paid_amount' => $this->input->post('deposit_7', TRUE), // 납부한 금액
							'paid_acc' => $this->input->post('dep_acc_7', TRUE),
							'paid_date' => $this->input->post('cont_in_date7', TRUE),
							'paid_who' => $this->input->post('cont_in_who7', TRUE),
							'cont_form_code' => '8',
							'reg_worker' => $this->session->userdata('name')
						);
						/******************************계약금 7 폼 데이터******************************/


						if($this->input->post('unit_is_cont')=='0'){  // 신규 계약일 때

//   2. 계약자관리 테이블에 해당 데이터를 인서트한다.
							$add_arr2 = array('cont_seq' => $cont_seq->seq, 'ini_reg_worker' => $this->session->userdata('name'));
							$cont_arr22 = array_merge($cont_arr2, $add_arr2);
							$result[1] = $this->main_m->insert_data('cms_sales_contractor', $cont_arr22, 'ini_reg_date');
							if( !$result[1]) {
								alert('데이터베이스 에러입니다.2', '');
							}

//   3. 청약 테이블 해당 데이터에 계약 전환 업데이트
							if($this->input->post('unit_is_app')=='1'){ // 청약 상태인 데이터 이면
								// 청약 테이블 계약전환 처리
								$dis_data = array(
									'disposal_div'=> '1',
									'disposal_date' => date('Y-m-d'),
									'last_modi_date'=> date('Y-m-d'),
									'last_modi_worker' =>$this->session->userdata('name')
								);
								$result[2] = $this->main_m->update_data('cms_sales_application', $dis_data, array('unit_seq'=>$this->input->post('unit_seq'))); // 청약 테이블 계약전환 처리
								if( !$result[2]) {
									alert('데이터베이스 에러입니다.3', base_url(uri_string()));
								}

// 4. 동호수 관리 테이블 입력 청약->OFF
								$result[3] = $this->main_m->update_data('cms_project_all_housing_unit', array('is_application'=>'0'), array('seq'=>$un)); // 동호수 테이블 계약상태로 변경
								if( !$result[3]) {
									alert('데이터베이스 에러입니다.4', base_url(uri_string()));
								}

// 5. 청약금 데이터 -> 수납 데이터로 입력
								if( !empty($this->input->post('app_in_mon', TRUE))){
									$app_mon = array( // 청약금 -> 수납 테이블 입력 데이터
										'pj_seq' => $this->input->post('project', TRUE),
										'cont_seq' => $cont_seq->seq,
										'pay_sche_code' => $this->input->post('app_pay_sche', TRUE), // 당회 납부 회차
										'paid_amount' => $this->input->post('app_in_mon', TRUE), // 납부한 금액
										'paid_acc' => $this->input->post('app_in_acc', TRUE),
										'paid_date' => $this->input->post('app_in_date', TRUE),
										'paid_who' => $this->input->post('app_in_who', TRUE),
										'cont_form_code' => '1',
										'reg_worker' => $this->session->userdata('name')
									);
									$result[4] = $this->main_m->insert_data('cms_sales_received', $app_mon, 'reg_date');
									if( !$result[4]) {
										alert('데이터베이스 에러입니다.5', base_url(uri_string()));
									}
								}
							}
// 6. 동호수 관리 테이블 입력 계약->On
								$result[5] = $this->main_m->update_data('cms_project_all_housing_unit', array('is_contract'=>'1', 'modi_date'=>date('Y-m-d'), 'modi_worker'=>$this->session->userdata('name')), array('seq'=>$un)); // 동호수 테이블 계약상태로 변경
								if( !$result[5]) {
									alert('데이터베이스 에러입니다.6', base_url(uri_string()));
								}

// 7. 계약금 데이터1 -> 수납 데이터로 입력
							if($this->input->post('deposit_1') && $this->input->post('deposit_1')!='0'){ // 계약금 1 (분담금 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[6] = $this->main_m->insert_data('cms_sales_received', $cont_arr3, 'reg_date');
								if( !$result[6]) {
									alert('데이터베이스 에러입니다.7', base_url(uri_string()));
								}
							}

// 8. 계약금 데이터2 -> 수납 데이터로 입력
							if($this->input->post('deposit_2') && $this->input->post('deposit_2')!='0'){ // 계약금 2 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[7] = $this->main_m->insert_data('cms_sales_received', $cont_arr4, 'reg_date');
								if( !$result[7]) {
									alert('데이터베이스 에러입니다.8', base_url(uri_string()));
								}
							}

// 9. 계약금 데이터3 -> 수납 데이터로 입력
							if($this->input->post('deposit_3') && $this->input->post('deposit_3')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[8] = $this->main_m->insert_data('cms_sales_received', $cont_arr5, 'reg_date');
								if( !$result[8]) {
									alert('데이터베이스 에러입니다.9', base_url(uri_string()));
								}
							}

// 10. 계약금 데이터4 -> 수납 데이터로 입력
							if($this->input->post('deposit_4') && $this->input->post('deposit_4')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[9] = $this->main_m->insert_data('cms_sales_received', $cont_arr6, 'reg_date');
								if( !$result[9]) {
									alert('데이터베이스 에러입니다.10', base_url(uri_string()));
								}
							}

// 11. 계약금 데이터5 -> 수납 데이터로 입력
							if($this->input->post('deposit_5') && $this->input->post('deposit_5')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[10] = $this->main_m->insert_data('cms_sales_received', $cont_arr7, 'reg_date');
								if( !$result[10]) {
									alert('데이터베이스 에러입니다.11', base_url(uri_string()));
								}
							}

// 12. 계약금 데이터6 -> 수납 데이터로 입력
							if($this->input->post('deposit_6') && $this->input->post('deposit_6')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[11] = $this->main_m->insert_data('cms_sales_received', $cont_arr8, 'reg_date');
								if( !$result[11]) {
									alert('데이터베이스 에러입니다.12', base_url(uri_string()));
								}
							}

// 13. 계약금 데이터7 -> 수납 데이터로 입력
							if($this->input->post('deposit_7') && $this->input->post('deposit_7')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[12] = $this->main_m->insert_data('cms_sales_received', $cont_arr9, 'reg_date');
								if( !$result[12]) {
									alert('데이터베이스 에러입니다.13', base_url(uri_string()));
								}
							}
							$udh = $this->input->post('unit_dong_ho', TRUE);
							alert($udh.'의 계약 정보입력이 정상처리되었습니다.', base_url("m1/sales/1/2?mode=2&cont_sort1=1&cont_sort2=2&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho')." "));




					}else if($this->input->post('unit_is_cont')=='1'){ // 기존 계약정보 수정일 때



//   1. 계약관리 테이블에 해당 데이터를 업데이트한다.
							$add_arr1 = array('last_modi_date' => date('Y-m-d'), 'last_modi_worker' => $this->session->userdata('name'));
							$cont_arr11 = array_merge($cont_arr1, $add_arr1);
							$result[0] = $this->main_m->update_data('cms_sales_contract', $cont_arr11, array('seq'=>$cont_seq->seq, 'unit_seq'=>$un));
							if( !$result[0]){
								alert('데이터베이스 에러입니다.1', base_url(uri_string()));
							}

//   2. 계약자관리 테이블에 해당 데이터를 업데이트한다.
							$cont_arr22 = array_merge($cont_arr2, $add_arr1);
							$result[1] = $this->main_m->update_data('cms_sales_contractor', $cont_arr22,  array('seq'=>$this->input->post('contractor_seq'), 'cont_seq'=>$cont_seq->seq));
							if( !$result[1]) {
								alert('데이터베이스 에러입니다.2', '');
							}

// 3. 계약금 데이터1 -> 수납 데이터로 입력
							if($this->input->post('deposit_1') && $this->input->post('deposit_1')!='0'){ // 계약금 1 (분담금 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[5] = $this->main_m->update_data('cms_sales_received', $cont_arr3, array('seq'=>$this->input->post('received1')));
								if( !$result[5]) {
									alert('데이터베이스 에러입니다.6', base_url(uri_string()));
								}
							}

// 4. 계약금 데이터2 -> 수납 데이터로 입력
							if($this->input->post('deposit_2') && $this->input->post('deposit_2')!='0'){ // 계약금 2 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[6] =$this->main_m->update_data('cms_sales_received', $cont_arr4, array('seq'=>$this->input->post('received2')));
								if( !$result[6]) {
									alert('데이터베이스 에러입니다.7', base_url(uri_string()));
								}
							}

// 5. 계약금 데이터3 -> 수납 데이터로 입력
							if($this->input->post('deposit_3') && $this->input->post('deposit_3')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[7] =$this->main_m->update_data('cms_sales_received', $cont_arr5, array('seq'=>$this->input->post('received3')));
								if( !$result[7]) {
									alert('데이터베이스 에러입니다.8', base_url(uri_string()));
								}
							}

// 6. 계약금 데이터4 -> 수납 데이터로 입력
							if($this->input->post('deposit_4') && $this->input->post('deposit_4')!='0'){ // 계약금 4 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[8] =$this->main_m->update_data('cms_sales_received', $cont_arr6, array('seq'=>$this->input->post('received4')));
								if( !$result[8]) {
									alert('데이터베이스 에러입니다.9', base_url(uri_string()));
								}
							}

// 7. 계약금 데이터5 -> 수납 데이터로 입력
							if($this->input->post('deposit_5') && $this->input->post('deposit_5')!='0'){ // 계약금 5 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[9] =$this->main_m->update_data('cms_sales_received', $cont_arr7, array('seq'=>$this->input->post('received5')));
								if( !$result[9]) {
									alert('데이터베이스 에러입니다.10', base_url(uri_string()));
								}
							}

// 8. 계약금 데이터6 -> 수납 데이터로 입력
							if($this->input->post('deposit_6') && $this->input->post('deposit_6')!='0'){ // 계약금 6 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[10] =$this->main_m->update_data('cms_sales_received', $cont_arr8, array('seq'=>$this->input->post('received6')));
								if( !$result[10]) {
									alert('데이터베이스 에러입니다.11', base_url(uri_string()));
								}
							}

// 9. 계약금 데이터7 -> 수납 데이터로 입력
							if($this->input->post('deposit_7') && $this->input->post('deposit_7')!='0'){ // 계약금 7 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[11] =$this->main_m->update_data('cms_sales_received', $cont_arr9, array('seq'=>$this->input->post('received7')));
								if( !$result[11]) {
									alert('데이터베이스 에러입니다.12', base_url(uri_string()));
								}
							}
							$udh = $this->input->post('unit_dong_ho', TRUE);
							alert($udh.'의 계약 정보수정이 정상처리되었습니다.', base_url("m1/sales/1/2?mode=2&cont_sort1=1&cont_sort2=2&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho')." "));
						}

					}else if($this->input->post('cont_sort3')=='3'){ // 청약 해지일 때
						if($this->input->post('is_cancel')==1) $msg = "청약해지";
						if($this->input->post('is_refund')==1) $msg = "청약 해지환불";
						// 1. 청약 관리 테이블 해지 업데이트
						// 2. 동호수 관리 테이블 해지 상태 업데이트

					}else if($this->input->post('cont_sort3')=='4'){ // 계약 해지일 때
						if($this->input->post('is_cancel')==3) $msg = "계약해지";
						if($this->input->post('is_refund')==4) $msg = "계약 해지환불";
						// 1. 계약 및 계약자 관리 테이블 해지 업데이트
						// 2. 동호수 관리 테이블 해지 상태 업데이트

					}
				}
			}






		// 계약현황 3. 동호수현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_1_3', $this->session->userdata['user_id']);

			if( !$auth['_m1_1_3'] or $auth['_m1_1_3']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_1_3'];

				// 공급세대 및 유보세대 청약 계약세대 구하기
				$data['summary_tb'] = $this->main_m->sql_row(" SELECT COUNT(*) AS total, SUM(is_hold) AS hold, SUM(is_application) AS acn, SUM(is_contract) AS cont FROM cms_project_all_housing_unit WHERE pj_seq='$project'  ");

				// 타입 관련 데이터 구하기
				$type = $this->main_m->sql_row(" SELECT type_name, type_color FROM cms_project WHERE seq='$project' ");
				$data['type'] = array(
					'name' => explode("-", $type->type_name),
					'color' => explode("-", $type->type_color)
				);

				// 해당 단지 최 고층 구하기
				$max_fl = $this->main_m->sql_row(" SELECT MAX(ho) AS max_ho FROM cms_project_all_housing_unit WHERE pj_seq='$project' ");
				if(strlen($max_fl->max_ho)==3) $data['max_floor'] = substr($max_fl->max_ho, -3,1);
				if(strlen($max_fl->max_ho)==4) $data['max_floor'] = substr($max_fl->max_ho, -4,2);

				// 해당 단지 동 수 및 리스트 구하기
				$dong_data = $data['dong_data'] = $this->main_m->sql_result(" SELECT dong FROM cms_project_all_housing_unit WHERE pj_seq='$project' GROUP BY dong ");

				// 각 동별 라인 수 구하기   //$line_num[6]->to_line
				for($j=0; $j<count($data['dong_data']); $j++) :
					$d = $dong_data[$j]->dong;
					$line_num = $data['line_num'][$j] = $this->main_m->sql_row(" SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$d' ");
				endfor;



				//본 페이지 로딩
				$this->load->view('/menu/m1/md1_sd3_v', $data);
			}






		// 1. 수납관리 1. 수납현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			$this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m1_2_1'] or $auth['_m1_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_2_1'];



				//본 페이지 로딩
				$this->load->view('/menu/m1/md2_sd1_v', $data);
			}






		// 1. 수납관리 2. 수납등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			$this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m1_2_2'] or $auth['_m1_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_2_2'];


				$now_dong = $this->input->get('dong');
				$now_ho = $this->input->get('ho');
				$data['dong_list'] = $this->main_m->sql_result(" SELECT dong FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND is_contract='1' GROUP BY dong ORDER BY dong "); // 동 리스트
				$data['ho_list'] = $this->main_m->sql_result(" SELECT ho FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$now_dong' AND is_contract='1' GROUP BY ho ORDER BY ho "); // 호 리스트
				$unit = $data['unit'] = $this->main_m->sql_row(" SELECT * FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$now_dong' AND ho='$now_ho' AND is_contract='1' ");  // 선택한 동호수 유닛

				// $now_dongho = $now_dong."-".$now_ho;
				// $cont_data = $this->main_m->sql_row(" SELECT * FROM cms_sales_contract, cms_sales_contractor WHERE pj_seq='$project' AND unit_dong_ho='$now_dongho' ");

				if( !empty($unit->seq)){
					$cont_where = " WHERE unit_seq='$unit->seq' AND is_transfer='0' AND is_rescission='0' AND cms_sales_contract.seq=cont_seq  ";
					$cont_query = "  SELECT *, cms_sales_contractor.seq AS contractor_seq FROM cms_sales_contract, cms_sales_contractor ".$cont_where;
					$cont_data = $data['cont_data'] = $this->main_m->sql_row($cont_query); // 계약 및 계약자 데이터

					// 수납 데이터
					$data['received'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_received WHERE pj_seq='$project' AND cont_seq='$cont_data->seq' ");
					$data['total_paid'] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS total_paid FROM cms_sales_received WHERE pj_seq='$project' AND cont_seq='$cont_data->seq' ");

					// 수납 약정
					$pay_sche = $data['pay_sche'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_pay_sche WHERE pj_seq='$project' "); // 약정 회차					
				}

				$data['contractor_info'] = ($this->input->get('ho')) ? "<font color='#9f0404'><span class='glyphicon glyphicon-import' aria-hidden='true' style='padding-right: 10px;'></span></font><b>[".$unit->type." 타입] &nbsp;".$now_dong ." 동 ". $now_ho." 호 - 계약자 : ".$cont_data->contractor."</b>" : "";






				//본 페이지 로딩
				$this->load->view('/menu/m1/md2_sd2_v', $data);
			}






		// 1. 수납관리 3. 수납약정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {
			$this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_2_3', $this->session->userdata['user_id']);

			if( !$auth['_m1_2_3'] or $auth['_m1_2_3']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_2_3'];

				//본 페이지 로딩
				$this->load->view('/menu/m1/md2_sd3_v', $data);
			}
		}
	}
}
// End of this File
