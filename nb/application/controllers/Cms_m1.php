<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_m1 extends CB_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if($this->member->is_member() === false) {
			redirect(base_url('cms_member').'?returnURL='.rawurlencode(base_url(uri_string())));
		}
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m1_model'); //모델 파일 로드
		$this->load->helper('cms_alert'); // 경고창 헬퍼 로딩
		$this->load->helper('cms_cut_string'); // 문자열 자르기 헬퍼 로드
		$this->load->library('excel'); // PHPExcel 라이브러리 로드
	}

	/**
	 * [_remap 헤더와 푸터 불러오기 위한 선행함수]
	 * @param  [type] $method [description]
	 * @return [type]         [description]
	 */
	public function _remap($method){
		// 헤더 include
		$this->load->view('/cms_views/cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('/cms_views/cms_main_footer');
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->sales();
	}

	/**
	 * [sales 페이지 메인 함수]
	 * @param  string $mdi [2단계 제목]
	 * @param  string $sdi [3단계 제목]
	 * @return [type]      [description]
	 */
	public function sales($mdi='', $sdi=''){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('계약 현황', '계약 등록', '동호수 현황'), // 첫번째 하위 메뉴
			array('수납 현황', '수납 등록', '설정 관리'),	 // 두번째 하위 메뉴
			array('프로젝트별 계약현황', '프로젝트별 계약등록(수정)', '동호수 계약 현황표'),  // 첫번째 하위 제목
			array('분양대금 수납 현황', '분양대금 수납 등록', '프로젝트 타입별 수납약정 관리 ------- [일부 완성]')   // 두번째 하위 제목
		);

		// 등록된 프로젝트 데이터
		$where = "";
		if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
		$data['all_pj'] = $this->cms_main_model->sql_result(' SELECT * FROM cb_cms_project '.$where.' ORDER BY biz_start_ym DESC ');
		$project = $data['project'] = ($this->input->get('project')) ? $this->input->get('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)

		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('cms_views/menu/cms_m1/sales_v', $menu);



		// 계약현황 1. 계약현황 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m1_1_1', $this->session->userdata['mem_id']);

			if( !$auth['_m1_1_1'] or $auth['_m1_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('cms_views/no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_1_1'];

				// 프로젝트명, 타입 정보 구하기
				$pj_info = $data['pj_info'] = $this->cms_main_model->sql_row(" SELECT pj_name, type_name, type_color FROM cb_cms_project WHERE seq='$project' ");
				if($pj_info) $data['tp_color'] = explode("-", $pj_info->type_color);

				$data['tp_name'] = $this->cms_main_model->sql_result(" SELECT type FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' GROUP BY type ");

				for($i=0; $i<count($data['tp_name']); $i++) {
					$data['summary'][$i] = $this->cms_main_model->sql_row(" SELECT COUNT(type) AS type_num, SUM(is_hold) AS hold, SUM(is_application) AS app, SUM(is_contract) AS cont FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND type='".$data['tp_name'][$i]->type."' ");
				}

				// 요약 총계 데이터 가져오기
				$data['sum_all'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS unit_num, SUM(is_hold) AS hold, SUM(is_application) AS app, SUM(is_contract) AS cont FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' ");

				// 청약 데이터 가져오기
				$dis_date = date('Y-m-d', strtotime('-3 day'));
				$data['app_data'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_application WHERE pj_seq='$project' AND disposal_div='0' OR disposal_div='2' OR ((disposal_div='1' OR disposal_div='3') AND disposal_date>='$dis_date') ORDER BY app_date DESC, seq DESC ");

				// 계약 데이터 필터링(타입, 동 별)
				$data['sc_cont_diff'] = $this->cms_main_model->sql_result(" SELECT cont_diff FROM cb_cms_sales_contract GROUP BY cont_diff ORDER BY cont_diff ");
				$data['sc_cont_type'] = $this->cms_main_model->sql_result(" SELECT unit_type FROM cb_cms_sales_contract GROUP BY unit_type ORDER BY unit_type ");
				if($this->input->get('type')) {
					$data['sc_cont_dong'] = $this->cms_main_model->sql_result(" SELECT unit_dong FROM cb_cms_sales_contract WHERE unit_type='".$this->input->get('type')."' GROUP BY unit_dong ORDER BY unit_dong ");
				}else {
					$data['sc_cont_dong'] = $this->cms_main_model->sql_result(" SELECT unit_dong FROM cb_cms_sales_contract GROUP BY unit_dong ORDER BY unit_dong ");
				}

				// 계약 데이터 검색 필터링
				$cont_query = "  SELECT *, cb_cms_sales_contractor.seq AS contractor_seq  ";
				$cont_query .= " FROM cb_cms_sales_contract, cb_cms_sales_contractor  ";
				$cont_query .= " WHERE pj_seq='$project' AND is_transfer='0' AND is_rescission='0' AND cb_cms_sales_contract.seq = cont_seq ";
				if( !empty($this->input->get('diff'))) {$df = $this->input->get('diff'); $cont_query .= " AND cont_diff='$df' ";}
				if( !empty($this->input->get('type'))) {$tp = $this->input->get('type'); $cont_query .= " AND unit_type='$tp' ";}
				if( !empty($this->input->get('dong'))) {$dn = $this->input->get('dong'); $cont_query .= " AND unit_dong='$dn' ";}
				if( !empty($this->input->get('s_date'))) {$sd = $this->input->get('s_date'); $cont_query .= " AND cb_cms_sales_contract.cont_date>='$sd' ";}
				if( !empty($this->input->get('e_date'))) {$ed = $this->input->get('e_date'); $cont_query .= " AND cb_cms_sales_contract.cont_date<='$ed' ";}
				if( !empty($this->input->get('sc_name'))) {$ctor = $this->input->get('sc_name'); $cont_query .= " AND (cb_cms_sales_contractor.contractor='$ctor' OR cb_cms_sales_contract.note LIKE '%$ctor%') ";}

				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('cms_m1/sales/1/1');   //페이징 주소
				$config['total_rows'] = $data['total_rows'] = $this->cms_main_model->sql_num_rows($cont_query);  //게시물의 전체 갯수
				if( !$this->input->get('num')) $config['per_page'] = 10;  else $config['per_page'] = $this->input->get('num'); // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
				// $config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
				$config['reuse_query_string'] = TRUE;    //http://example.com/index.php/test/page/20?query=search%term

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				// $page = $this->uri->segment($config['uri_segment']);
				$page = $this->input->get('page');
				if($page<=1 or empty($page)) { $start = 0; }else{ $start = ($page-1) * $config['per_page']; }
				$limit = $config['per_page'];

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();


				// 계약 데이터 가져오기
				if( !$this->input->get('order')) $cont_query .= " ORDER BY cb_cms_sales_contract.cont_date DESC, cb_cms_sales_contract.seq DESC ";
				if($this->input->get('order')=='1') $cont_query .= " ORDER BY cont_code ";
				if($this->input->get('order')=='2') $cont_query .= " ORDER BY cont_code DESC ";
				if($start != '' or $limit !='')	$cont_query .= " LIMIT ".$start.", ".$limit." ";
				$data['cont_data'] = $this->cms_main_model->sql_result($cont_query); // 계약 및 계약자 데이터

				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m1/md1_sd1_v', $data);
			}







		// 계약현황 2. 계약등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m1_1_2', $this->session->userdata['mem_id']);

			if( !$auth['_m1_1_2'] or $auth['_m1_1_2']==0) {
				$this->load->view('cms_views/no_auth');
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
				$data['type_list'] = $this->cms_main_model->sql_result("SELECT type FROM cb_cms_project_all_housing_unit $where_add GROUP BY type ORDER BY type");

				// 동 데이터 불러오기
				$now_type = $this->input->get('type');
				if($this->input->get('type')) $where_add .= " AND type='$now_type' ";
				$data['dong_list'] = $this->cms_main_model->sql_result("SELECT dong FROM cb_cms_project_all_housing_unit $where_add GROUP BY dong ORDER BY dong");

				// 호수 데이터 불러오기
				$now_dong = $this->input->get('dong');
				if($this->input->get('dong')) $where_add .= " AND dong='$now_dong' ";
				$data['ho_list'] = $this->cms_main_model->sql_result("SELECT ho FROM cb_cms_project_all_housing_unit $where_add GROUP BY ho ORDER BY ho");

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
					$unit_seq = $data['unit_seq'] =  $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND type='$now_type' AND dong='$now_dong' AND ho='$now_ho' ");

					// 청약 또는 계약 유닛인지 확인
					if($unit_seq->is_application=='1') { // 청약 물건이면
						$app_data = $data['is_reg']['app_data'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_application WHERE unit_seq='$unit_seq->seq' AND disposal_div<>'3' "); // 청약 데이터
					}else if($unit_seq->is_contract=='1'){ // 계약 물건이면
						$data['is_app_cont'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_application WHERE pj_seq='$project' AND unit_seq='$unit_seq->seq' AND disposal_div='1' "); // 청약->계약전환 물건인지 확인
						$cont_where = " WHERE unit_seq='$unit_seq->seq' AND is_transfer='0' AND is_rescission='0' AND cb_cms_sales_contract.seq=cont_seq  ";
						$cont_query = "  SELECT *, cb_cms_sales_contract.seq AS cont_seq, cb_cms_sales_contractor.seq AS contractor_seq  FROM cb_cms_sales_contract, cb_cms_sales_contractor ".$cont_where;
						$cont_data = $data['is_reg']['cont_data'] = $this->cms_main_model->sql_row($cont_query); // 계약 및 계약자 데이터
					}
				}

				// 차수 데이터 불러오기
				$data['diff_no'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_con_diff  WHERE pj_seq='$project' ORDER BY diff_no ");

				// 분양대금 수납 계정
				$data['dep_acc'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_bank_acc WHERE pj_seq='$project' ORDER BY seq ");

				// 계약 등록 시 당회 납부 회차 데이터 가져오기
				if($this->input->get('cont_sort2')=='2'){
					$data['pay_schedule'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' AND pay_code<3 ORDER BY seq ");
				}

				// 수납 관리 테이블 정보 가져오기
				if( !empty($cont_data)) $data['receiv_app'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='1' ");
				if( !empty($cont_data)) $data['received']['1'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='2' ");
				if( !empty($cont_data)) $data['received']['2'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='3' ");
				if( !empty($cont_data)) $data['received']['3'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='4' ");
				if( !empty($cont_data)) $data['received']['4'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='5' ");
				if( !empty($cont_data)) $data['received']['5'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='6' ");
				if( !empty($cont_data)) $data['received']['6'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='7' ");
				if( !empty($cont_data)) $data['received']['7'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' AND cont_form_code='8' ");
				if( !empty($cont_data)) $data['rec_num'] = $this->cms_main_model->sql_num_rows(" SELECT seq FROM cb_cms_sales_received WHERE cont_seq='$cont_data->seq' ");


				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				$this->form_validation->set_rules('project', '프로젝트', 'trim|required');
				$this->form_validation->set_rules('cont_sort1', '등록구분1', 'trim|required');
				$this->form_validation->set_rules('type', '타입', 'trim|required');
				$this->form_validation->set_rules('dong', '동', 'trim|required');
				$this->form_validation->set_rules('ho', '호수', 'trim|required');
				$this->form_validation->set_rules('cont_code', '계약일련번호', 'trim|max_length[12]');
				$this->form_validation->set_rules('custom_name', '청/계약자명', 'trim|required|max_length[20]');

				$this->form_validation->set_rules('conclu_date', '처리일자', 'trim|exact_length[10]');
				$this->form_validation->set_rules('due_date', '계약예정일', 'trim|exact_length[10]');
				$this->form_validation->set_rules('app_in_date', '청약금 입금일', 'trim|exact_length[10]');
				$this->form_validation->set_rules('cont_in_date1', '계약금 입금일1', 'trim|exact_length[10]');
				$this->form_validation->set_rules('cont_in_date2', '계약금 입금일2', 'trim|exact_length[10]');
				$this->form_validation->set_rules('cont_in_date3', '계약금 입금일3', 'trim|exact_length[10]');
				$this->form_validation->set_rules('cont_in_date4', '계약금 입금일4', 'trim|exact_length[10]');
				$this->form_validation->set_rules('cont_in_date5', '계약금 입금일5', 'trim|exact_length[10]');
				$this->form_validation->set_rules('cont_in_date6', '계약금 입금일6', 'trim|exact_length[10]');
				$this->form_validation->set_rules('cont_in_date7', '계약금 입금일7', 'trim|exact_length[10]');

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
				$this->form_validation->set_rules('postcode1', '우편변호1', 'trim|numeric|max_length[5]');
				$this->form_validation->set_rules('address1_1', '메인주소1', 'trim|max_length[100]');
				$this->form_validation->set_rules('address2_1', '세부주소1', 'trim|max_length[50]');
				$this->form_validation->set_rules('postcode2', '우편번호2', 'trim|numeric|max_length[5]');
				$this->form_validation->set_rules('address1_2', '메인주소2', 'trim|max_length[100]');
				$this->form_validation->set_rules('address2_2', '세부주소2', 'trim|max_length[50]');
				$this->form_validation->set_rules('note', '비고', 'trim|max_length[200]');

				if($this->form_validation->run() == FALSE) {

					//본 페이지 로딩
					$this->load->view('/cms_views/menu/cms_m1/md1_sd2_v', $data);
				}else{
					$pj = $this->input->post('project', TRUE); // 프로젝트 아이디
					$un = $this->input->post('unit_seq', TRUE); // 동호 아이디

					if($this->input->post('cont_sort2')=='1'){ // 청약일 때
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
							$add_arr = array('ini_reg_worker' => $this->session->userdata('mem_username'));
							$app_put = array_merge($app_arr, $add_arr);
							$result = $this->cms_main_model->insert_data('cb_cms_sales_application', $app_put, 'ini_reg_date'); // 청약관리 테이블 데이터 입력
							if( !$result){
								alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}else{
								// 2. 동호수 관리 테이블 입력
								$where = array('type'=>$this->input->post('type'), 'dong'=>$this->input->post('dong'), 'ho'=>$this->input->post('ho'));
								$result2 = $this->cms_main_model->update_data('cb_cms_project_all_housing_unit', array('is_application'=>'1', 'modi_date'=>date('Y-m-d'), 'modi_worker'=>$this->session->userdata('mem_username')), $where); // 동호수 테이블 청약상태로 변경
								if( !$result2) alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}
						}else if($this->input->post('mode')=='2' && $this->input->post('unit_is_app')=='1'){ // 기존 청약정보 수정일 때
							$add_arr = array('last_modi_date' => date('Y-m-d'), 'last_modi_worker' => $this->session->userdata('mem_username'));
							$app_put = array_merge($app_arr, $add_arr);
							$where = array('pj_seq'=>$pj, 'unit_type' =>$this->input->post('type'), 'unit_dong_ho'=>$this->input->post('unit_dong_ho'));
							$result = $this->cms_main_model->update_data('cb_cms_sales_application', $app_put, $where); // 청약관리 테이블 데이터 입력
							if( !$result){
								alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}
						}
						$ret_url = "?mode=2&cont_sort1=".$this->input->post('cont_sort1')."&cont_sort2=".$this->input->post('cont_sort2')."&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho');
						alert('청약 정보 입력이 정상 처리되었습니다.', base_url('cms_m1/sales/1/2').$ret_url);



					}else if($this->input->post('cont_sort2')=='2'){ // 계약일 때
						$pj = $this->input->post('project', TRUE); // 프로젝트 아이디
						$un = $this->input->post('unit_seq', TRUE); // 동호 아이디

						/******************************계약 테이블 데이터******************************/
						$con_fl = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_con_floor WHERE pj_seq='$pj' ORDER BY seq "); // 층별 조건 객체배열

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

						$price_seq = $this->cms_main_model->select_data_row('cb_cms_sales_price' , $pr_where);

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
							'note' => $this->input->post('note', TRUE)
						);
						/******************************계약 테이블 데이터******************************/
						/////////////////////////////////////////////////////////////////////////////신규 계약 인서트
						if($this->input->post('unit_is_cont')=='0'){  // 신규 계약일 때
							//   1. 계약관리 테이블에 해당 데이터를 인서트한다.
							$add_arr1 = array('ini_reg_worker' => $this->session->userdata('mem_username'));
							$cont_arr11 = array_merge($cont_arr1, $add_arr1);
							$result[0] = $this->cms_main_model->insert_data('cb_cms_sales_contract', $cont_arr11, 'ini_reg_date');
							if( !$result[0]){
								alert('데이터베이스 에러입니다.1', base_url(uri_string()));
							}
						}

						/******************************계약자 테이블 데이터******************************/
                        $cont_seq = $this->cms_main_model->sql_row(" SELECT seq FROM cb_cms_sales_contract WHERE pj_seq='$pj' AND unit_seq='$un' AND is_rescission='0' ");
						$addr_id = $this->input->post('postcode1')."|".$this->input->post('address1_1')."|".$this->input->post('address2_1');
						$addr_dm = $this->input->post('postcode2')."|".$this->input->post('address1_2')."|".$this->input->post('address2_2');
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
							'reg_worker' => $this->session->userdata('mem_username')
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
							'reg_worker' => $this->session->userdata('mem_username')
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
							'reg_worker' => $this->session->userdata('mem_username')
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
							'reg_worker' => $this->session->userdata('mem_username')
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
							'reg_worker' => $this->session->userdata('mem_username')
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
							'reg_worker' => $this->session->userdata('mem_username')
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
							'reg_worker' => $this->session->userdata('mem_username')
						);
						/******************************계약금 7 폼 데이터******************************/


						if($this->input->post('unit_is_cont')=='0'){  // 신규 계약일 때

							//   2. 계약자관리 테이블에 해당 데이터를 인서트한다.
							$add_arr2 = array('cont_seq' => $cont_seq->seq, 'ini_reg_worker' => $this->session->userdata('mem_username'));
							$cont_arr22 = array_merge($cont_arr2, $add_arr2);
							$result[1] = $this->cms_main_model->insert_data('cb_cms_sales_contractor', $cont_arr22, 'ini_reg_date');
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
									'last_modi_worker' =>$this->session->userdata('mem_username')
								);
								$result[2] = $this->cms_main_model->update_data('cb_cms_sales_application', $dis_data, array('unit_seq'=>$this->input->post('unit_seq'))); // 청약 테이블 계약전환 처리
								if( !$result[2]) {
									alert('데이터베이스 에러입니다.3', base_url(uri_string()));
								}

								// 4. 동호수 관리 테이블 입력 청약->OFF
								$result[3] = $this->cms_main_model->update_data('cb_cms_project_all_housing_unit', array('is_application'=>'0'), array('seq'=>$un)); // 동호수 테이블 계약상태로 변경
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
										'reg_worker' => $this->session->userdata('mem_username')
									);
									$result[4] = $this->cms_main_model->insert_data('cb_cms_sales_received', $app_mon, 'reg_date');
									if( !$result[4]) {
										alert('데이터베이스 에러입니다.5', base_url(uri_string()));
									}
								}
							}
							// 6. 동호수 관리 테이블 입력 계약->On
								$result[5] = $this->cms_main_model->update_data('cb_cms_project_all_housing_unit', array('is_contract'=>'1', 'modi_date'=>date('Y-m-d'), 'modi_worker'=>$this->session->userdata('mem_username')), array('seq'=>$un)); // 동호수 테이블 계약상태로 변경
								if( !$result[5]) {
									alert('데이터베이스 에러입니다.6', base_url(uri_string()));
								}

							// 7. 계약금 데이터1 -> 수납 데이터로 입력
							if($this->input->post('deposit_1') && $this->input->post('deposit_1')!='0'){ // 계약금 1 (분담금 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[6] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr3, 'reg_date');
								if( !$result[6]) {
									alert('데이터베이스 에러입니다.7', base_url(uri_string()));
								}
							}

							// 8. 계약금 데이터2 -> 수납 데이터로 입력
							if($this->input->post('deposit_2') && $this->input->post('deposit_2')!='0'){ // 계약금 2 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[7] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr4, 'reg_date');
								if( !$result[7]) {
									alert('데이터베이스 에러입니다.8', base_url(uri_string()));
								}
							}

							// 9. 계약금 데이터3 -> 수납 데이터로 입력
							if($this->input->post('deposit_3') && $this->input->post('deposit_3')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[8] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr5, 'reg_date');
								if( !$result[8]) {
									alert('데이터베이스 에러입니다.9', base_url(uri_string()));
								}
							}

							// 10. 계약금 데이터4 -> 수납 데이터로 입력
							if($this->input->post('deposit_4') && $this->input->post('deposit_4')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[9] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr6, 'reg_date');
								if( !$result[9]) {
									alert('데이터베이스 에러입니다.10', base_url(uri_string()));
								}
							}

							// 11. 계약금 데이터5 -> 수납 데이터로 입력
							if($this->input->post('deposit_5') && $this->input->post('deposit_5')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[10] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr7, 'reg_date');
								if( !$result[10]) {
									alert('데이터베이스 에러입니다.11', base_url(uri_string()));
								}
							}

							// 12. 계약금 데이터6 -> 수납 데이터로 입력
							if($this->input->post('deposit_6') && $this->input->post('deposit_6')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[11] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr8, 'reg_date');
								if( !$result[11]) {
									alert('데이터베이스 에러입니다.12', base_url(uri_string()));
								}
							}

							// 13. 계약금 데이터7 -> 수납 데이터로 입력
							if($this->input->post('deposit_7') && $this->input->post('deposit_7')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								$result[12] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr9, 'reg_date');
								if( !$result[12]) {
									alert('데이터베이스 에러입니다.13', base_url(uri_string()));
								}
							}
							$udh = $this->input->post('unit_dong_ho', TRUE);
							alert($udh.'의 계약 정보입력이 정상처리되었습니다.', base_url("cms_m1/sales/1/2?mode=2&cont_sort1=1&cont_sort2=2&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho')." "));

						}else if($this->input->post('unit_is_cont')=='1'){ // 기존 계약정보 수정일 때

							//   1. 계약관리 테이블에 해당 데이터를 업데이트한다.
							$add_arr1 = array('last_modi_date' => date('Y-m-d'), 'last_modi_worker' => $this->session->userdata('mem_username'));
							$cont_arr11 = array_merge($cont_arr1, $add_arr1);
							$result[0] = $this->cms_main_model->update_data('cb_cms_sales_contract', $cont_arr11, array('seq'=>$this->input->post('cont_seq'), 'unit_seq'=>$un));
							if( !$result[0]){
								alert('데이터베이스 에러입니다.1', base_url(uri_string()));
							}

							//   2. 계약자관리 테이블에 해당 데이터를 업데이트한다.
							$cont_arr22 = array_merge($cont_arr2, $add_arr1);
							$result[1] = $this->cms_main_model->update_data('cb_cms_sales_contractor', $cont_arr22,  array('seq'=>$this->input->post('contractor_seq'), 'cont_seq'=>$this->input->post('cont_seq')));
							if( !$result[1]) {
								alert('데이터베이스 에러입니다.2', '');
							}

							// 3. 계약금 데이터1 -> 수납 데이터로 수정
							if($this->input->post('deposit_1') && $this->input->post('deposit_1')!='0'){ // 계약금 1 (분담금 // 또는 일반 분양대금) 입력정보 있을때 처리
								if($this->input->post('deposit_1_')=='1'){
									$result[5] = $this->cms_main_model->update_data('cb_cms_sales_received', $cont_arr3, array('seq'=>$this->input->post('received1')));
								}else{
									$result[5] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr3, 'reg_date');
								}
								if( !$result[5]) {
									alert('데이터베이스 에러입니다.6', base_url(uri_string()));
								}
							}

							// 4. 계약금 데이터2 -> 수납 데이터로 수정
							if($this->input->post('deposit_2') && $this->input->post('deposit_2')!='0'){ // 계약금 2 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								if($this->input->post('deposit_2_')=='1'){
									$result[6] =$this->cms_main_model->update_data('cb_cms_sales_received', $cont_arr4, array('seq'=>$this->input->post('received2')));
								}else{
									$result[6] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr4, 'reg_date');
								}
								if( !$result[6]) {
									alert('데이터베이스 에러입니다.7', base_url(uri_string()));
								}
							}

							// 5. 계약금 데이터3 -> 수납 데이터로 수정
							if($this->input->post('deposit_3') && $this->input->post('deposit_3')!='0'){ // 계약금 3 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								if($this->input->post('deposit_3_')=='1'){
									$result[7] =$this->cms_main_model->update_data('cb_cms_sales_received', $cont_arr5, array('seq'=>$this->input->post('received3')));
								}else{
									$result[7] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr5, 'reg_date');
								}
								if( !$result[7]) {
									alert('데이터베이스 에러입니다.8', base_url(uri_string()));
								}
							}

							// 6. 계약금 데이터4 -> 수납 데이터로 수정
							if($this->input->post('deposit_4') && $this->input->post('deposit_4')!='0'){ // 계약금 4 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								if($this->input->post('deposit_4_')=='1'){
									$result[8] =$this->cms_main_model->update_data('cb_cms_sales_received', $cont_arr6, array('seq'=>$this->input->post('received4')));
								}else{
									$result[8] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr6, 'reg_date');
								}
								if( !$result[8]) {
									alert('데이터베이스 에러입니다.9', base_url(uri_string()));
								}
							}

							// 7. 계약금 데이터5 -> 수납 데이터로 수정
							if($this->input->post('deposit_5') && $this->input->post('deposit_5')!='0'){ // 계약금 5 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								if($this->input->post('deposit_5_')=='1'){
									$result[9] =$this->cms_main_model->update_data('cb_cms_sales_received', $cont_arr7, array('seq'=>$this->input->post('received5')));
								}else{
									$result[9] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr7, 'reg_date');
								}
								if( !$result[9]) {
									alert('데이터베이스 에러입니다.10', base_url(uri_string()));
								}
							}

							// 8. 계약금 데이터6 -> 수납 데이터로 수정
							if($this->input->post('deposit_6') && $this->input->post('deposit_6')!='0'){ // 계약금 6 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								if($this->input->post('deposit_6_')=='1'){
									$result[10] =$this->cms_main_model->update_data('cb_cms_sales_received', $cont_arr8, array('seq'=>$this->input->post('received6')));
								}else{
									$result[10] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr8, 'reg_date');
								}
								if( !$result[10]) {
									alert('데이터베이스 에러입니다.11', base_url(uri_string()));
								}
							}

							// 9. 계약금 데이터7 -> 수납 데이터로 수정
							if($this->input->post('deposit_7') && $this->input->post('deposit_7')!='0'){ // 계약금 7 (대행비 // 또는 일반 분양대금) 입력정보 있을때 처리
								if($this->input->post('deposit_7_')=='1'){
									$result[11] =$this->cms_main_model->update_data('cb_cms_sales_received', $cont_arr9, array('seq'=>$this->input->post('received7')));
								}else{
									$result[11] = $this->cms_main_model->insert_data('cb_cms_sales_received', $cont_arr9, 'reg_date');
								}
								if( !$result[11]) {
									alert('데이터베이스 에러입니다.12', base_url(uri_string()));
								}
							}
							$udh = $this->input->post('unit_dong_ho', TRUE);
							alert($udh.'의 계약 정보수정이 정상처리되었습니다.', base_url("cms_m1/sales/1/2?mode=2&cont_sort1=1&cont_sort2=2&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho')." "));
						}

					}else if($this->input->post('cont_sort3')=='3'){ // 청약 해지일 때
						if($this->input->post('is_cancel')=='1' && $this->input->post('is_refund')!='1') {
							$cancel_data = array(
								'disposal_div'=>'2',
								'disposal_date'=>$this->input->post('conclu_date'),
								'last_modi_date'=>date('Y-m-d'),
								'last_modi_worker'=>$this->session->userdata('mem_username')
							);
							$result[0] = $this->cms_main_model->update_data('cb_cms_sales_application', $cancel_data, array('pj_seq'=>$pj, 'unit_seq'=>$un)); // 해지처리
							if( !$result[0]) alert('데이터베이스 에러입니다.', '');
							$ret_url = "?mode=2&cont_sort1=2&cont_sort3=3&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho');
							alert('청약 해지가 정상처리 되었습니다.', $ret_url);
						}
						if($this->input->post('is_cancel')=='1' && $this->input->post('is_refund')=='1') {
							$cancel_data = array(
								'refund_amount' => $this->input->post('app_in_mon'),
								'disposal_div' => '3',
								'disposal_date' => $this->input->post('conclu_date'),
								'last_modi_date' => date('Y-m-d'),
								'last_modi_worker' => $this->session->userdata('mem_username')
							);
							$result[0] = $this->cms_main_model->update_data('cb_cms_sales_application', $cancel_data, array('pj_seq'=>$pj, 'unit_seq'=>$un)); // 해지 환불 처리
							if( !$result[0]) alert('데이터베이스 에러입니다.', '');
							$result[1] = $this->cms_main_model->update_data('cb_cms_project_all_housing_unit', array('is_application'=>'0', 'modi_date'=>date('Y-m-d'), 'modi_worker'=>$this->session->userdata('mem_username')), array('seq'=>$un));
							if( !$result[1])  alert('데이터베이스 에러입니다.', '');
							$ret_url = "?mode=2&cont_sort1=2&cont_sort3=3&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho');
							alert('해지 환불이 정상처리 되었습니다.', $ret_url);
						}

					}else if($this->input->post('cont_sort3')=='4'){ // 계약 해지일 때
						if($this->input->post('is_cont_cancel')=='1' && $this->input->post('is_cont_refund')!='1') {
							$cancel_data = array(
								'is_rescission'=>'1', // 해지 처리
								'rescission_date'=>$this->input->post('conclu_date'),
								'last_modi_date'=>date('Y-m-d'),
								'last_modi_worker'=>$this->session->userdata('mem_username')
							);
							$result[0] = $this->cms_main_model->update_data('cb_cms_sales_contract', $cancel_data, array('seq'=>$this->input->post('cont_seq'))); // 해지 처리
							if( !$result[0]) alert('데이터베이스 에러입니다.', '');
							$cancel_data2 = array(
								'is_transfer'=>'2', // 1.매도, 2. 해약
								'transfer_date'=>$this->input->post('conclu_date'),
								'last_modi_date'=>date('Y-m-d'),
								'last_modi_worker'=>$this->session->userdata('mem_username')
							);
							$result[1] = $this->cms_main_model->update_data('cb_cms_sales_contractor', $cancel_data2, array('cont_seq'=>$this->input->post('cont_seq'))); // 해지 처리
							if( !$result[1]) alert('데이터베이스 에러입니다.', '');
							$ret_url = "?mode=2&cont_sort1=2&cont_sort3=4&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho');
							alert('계약 해지가 정상처리 되었습니다.', $ret_url);
						}
						if($this->input->post('is_cont_cancel')=='1' && $this->input->post('is_cont_refund')=='1') { // 계약 해지 환불일 때
							$cancel_data = array(
								'is_rescission'=>'2', // 환불 처리
								'rescission_date'=>$this->input->post('conclu_date'),
								'last_modi_date'=>date('Y-m-d'),
								'last_modi_worker'=>$this->session->userdata('mem_username')
							);
							$result[0] = $this->cms_main_model->update_data('cb_cms_sales_contract', $cancel_data, array('seq'=>$this->input->post('cont_seq'))); // 해지 환불 처리
							if( !$result[0]) alert('데이터베이스 에러입니다.', '');
							$cancel_data2 = array(
								'is_transfer'=>'2', // 1.매도, 2. 해약
								'transfer_date'=>$this->input->post('conclu_date'),
								'last_modi_date'=>date('Y-m-d'),
								'last_modi_worker'=>$this->session->userdata('mem_username')
							);
							$result[1] = $this->cms_main_model->update_data('cb_cms_sales_contractor', $cancel_data2, array('cont_seq'=>$this->input->post('cont_seq'))); // 해지 처리
							if( !$result[1]) alert('데이터베이스 에러입니다.', '');
							$result[2] = $this->cms_main_model->update_data('cb_cms_sales_received', array('is_refund'=>'1'), array('cont_seq'=>$this->input->post('cont_seq'))); // 해지 환불 처리
							if( !$result[2]) alert('데이터베이스 에러입니다.', '');
							$result[3] = $this->cms_main_model->update_data('cb_cms_project_all_housing_unit', array('is_contract'=>'0', 'modi_date'=>date('Y-m-d'), 'modi_worker'=>$this->session->userdata('mem_username')), array('seq'=>$un));
							if( !$result[3])  alert('데이터베이스 에러입니다.', '');
							$ret_url = "?mode=2&cont_sort1=2&cont_sort3=4&project=".$pj."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho');
							alert('해약 환불이 정상처리 되었습니다.', $ret_url);
						}
					}
				}
			}






		// 계약현황 3. 동호수현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// $this->output->enable_profiler(TRUE); //프로파일러 보기
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m1_1_3', $this->session->userdata['mem_id']);

			if( !$auth['_m1_1_3'] or $auth['_m1_1_3']==0) {
				$this->load->view('cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_1_3'];

				// 공급세대 및 유보세대 청약 계약세대 구하기
				$data['summary_tb'] = $this->cms_main_model->sql_row(" SELECT COUNT(*) AS total, SUM(is_hold) AS hold, SUM(is_application) AS acn, SUM(is_contract) AS cont FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project'  ");

				// 타입 관련 데이터 구하기
				$type = $this->cms_main_model->sql_row(" SELECT type_name, type_color FROM cb_cms_project WHERE seq='$project' ");
				if($type) {
					$data['type'] = array(
						'name' => explode("-", $type->type_name),
						'color' => explode("-", $type->type_color)
					);
				}


				// 해당 단지 최 고층 구하기
				$max_fl = $this->cms_main_model->sql_row(" SELECT MAX(ho) AS max_ho FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' ");
				if(strlen($max_fl->max_ho)==3) $data['max_floor'] = substr($max_fl->max_ho, -3,1);
				if(strlen($max_fl->max_ho)==4) $data['max_floor'] = substr($max_fl->max_ho, -4,2);

				// 해당 단지 동 수 및 리스트 구하기
				$dong_data = $data['dong_data'] = $this->cms_main_model->sql_result(" SELECT dong FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' GROUP BY dong ");

				// 각 동별 라인 수 구하기   //$line_num[6]->to_line
				for($j=0; $j<count($data['dong_data']); $j++) :
					$d = $dong_data[$j]->dong;
					$line_num = $data['line_num'][$j] = $this->cms_main_model->sql_row(" SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$d' ");
				endfor;



				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m1/md1_sd3_v', $data);
			}






		// 1. 수납관리 1. 수납현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m1_2_1', $this->session->userdata['mem_id']);

			if( !$auth['_m1_2_1'] or $auth['_m1_2_1']==0) {
				$this->load->view('cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_2_1'];

				// 총 약정금액
				$data['total_pmt'] = $this->cms_main_model->sql_row(" SELECT SUM(unit_price * unit_num) AS total FROM cb_cms_sales_price WHERE pj_seq='$project' ");
				// 분양 금액 구하기
				$data['sell_data'] = $this->cms_main_model->sql_row(" SELECT SUM(unit_price) AS sell_total FROM cb_cms_sales_contract, cb_cms_sales_price WHERE cb_cms_sales_contract.pj_seq='$project' AND price_seq=cb_cms_sales_price.seq ");

				// 필터링 위한 데이터
				$data['pay_sche'] = $this->cms_main_model->sql_result(" SELECT pay_code, pay_name FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' ORDER BY pay_code ");
				$data['paid_acc'] = $this->cms_main_model->sql_result(" SELECT seq, acc_nick FROM cb_cms_sales_bank_acc WHERE pj_seq='$project' ORDER BY seq ");

				// 수납데이터
				$data['rec_data'] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec_total FROM cb_cms_sales_received WHERE pj_seq='$project' ");


				// 수납 데이터 검색 필터링
				$rec_query = " SELECT cb_cms_sales_received.seq, cont_seq, paid_amount, paid_date, paid_who, acc_nick, pay_name, unit_type, unit_dong_ho ";
				$amount_qry = " SELECT SUM(paid_amount) AS total_amount FROM cb_cms_sales_received WHERE pj_seq='$project'  ";
				$w_qry = "";

				$rec_query .= " FROM cb_cms_sales_received, cb_cms_sales_pay_sche, cb_cms_sales_bank_acc, cb_cms_sales_contract ";
				$rec_query .= " WHERE cb_cms_sales_received.pj_seq='$project' AND cb_cms_sales_pay_sche.pj_seq='$project'  AND pay_sche_code=cb_cms_sales_pay_sche.pay_code AND paid_acc=cb_cms_sales_bank_acc.seq AND cont_seq=cb_cms_sales_contract.seq ";
				if( !empty($this->input->get('con_pay_sche'))) { $rec_query .= " AND pay_sche_code='".$this->input->get('con_pay_sche')."' ";}
				if( !empty($this->input->get('con_paid_acc'))) { $rec_query .= " AND paid_acc='".$this->input->get('con_paid_acc')."' ";}
				if( !empty($this->input->get('s_date'))) { $rec_query .= " AND paid_date>='".$this->input->get('s_date')."' ";}
				if( !empty($this->input->get('e_date'))) { $rec_query .= " AND paid_date<='".$this->input->get('e_date')."' ";}

				if( !empty($this->input->get('con_pay_sche'))) { $w_qry = " AND pay_sche_code='".$this->input->get('con_pay_sche')."' ";}
				if( !empty($this->input->get('con_paid_acc'))) { $w_qry .= " AND paid_acc='".$this->input->get('con_paid_acc')."' ";}
				if( !empty($this->input->get('s_date'))) { $w_qry .= " AND paid_date>='".$this->input->get('s_date')."' ";}
				if( !empty($this->input->get('e_date'))) { $w_qry .= " AND paid_date<='".$this->input->get('e_date')."' ";}


				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('cms_m1/sales/2/1');   //페이징 주소
				$config['total_rows'] = $data['total_rows'] = $this->cms_main_model->sql_num_rows($rec_query);  //게시물의 전체 갯수
				if( !$this->input->get('num')) $config['per_page'] = 10;  else $config['per_page'] = $this->input->get('num'); // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] =5; //페이지 번호가 위치한 세그먼트
				$config['reuse_query_string'] = TRUE;    //http://example.com/index.php/test/page/20?query=search%term

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				// $page = $this->uri->segment($config['uri_segment']);
				$page = $this->input->get('page');
				if($page<=1 or empty($page)) { $start = 0; }else{ $start = ($page-1) * $config['per_page']; }
				$limit = $config['per_page'];

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();


				// 수납 데이터 가져오기
				$rec_query .= "ORDER BY paid_date DESC, cb_cms_sales_received.seq DESC ";
				if($start != '' or $limit !='')	$rec_query .= " LIMIT ".$start.", ".$limit." ";
				$data['rec_list'] = $this->cms_main_model->sql_result($rec_query); // 수납 및 계약자 데이터
				$data['rec'] = $this->cms_main_model->sql_row($amount_qry.$w_qry); // 총 수납액 구하기

				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m1/md2_sd1_v', $data);
			}






		// 1. 수납관리 2. 수납등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m1_2_2', $this->session->userdata['mem_id']);

			if( !$auth['_m1_2_2'] or $auth['_m1_2_2']==0) {
				$this->load->view('cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_2_2'];


				$now_dong = $this->input->get('dong');
				$now_ho = $this->input->get('ho');
				if(!empty($this->input->get('payer'))){
					$now_payer = $this->input->get('payer');
					$paid_who = $this->cms_main_model->sql_row(" SELECT seq FROM cb_cms_sales_received WHERE paid_who='$now_payer' ");

					if(!empty($paid_who)){
						$data['now_payer'] = $this->cms_main_model->sql_result(" SELECT paid_who, cont_seq, unit_dong_ho, is_rescission FROM cb_cms_sales_received, cb_cms_sales_contract WHERE cb_cms_sales_received.pj_seq='$project' AND cont_seq=cb_cms_sales_contract.seq AND paid_who LIKE '%$now_payer%' GROUP BY cont_seq ");
					}else {
						$pay_cont_seq =  $this->cms_main_model->sql_row(" SELECT cont_seq FROM cb_cms_sales_contractor WHERE contractor='$now_payer' ");
						if(!empty($pay_cont_seq)){
							$data['now_payer'] = $this->cms_main_model->sql_result(" SELECT paid_who, cont_seq, unit_dong_ho, is_rescission FROM cb_cms_sales_received, cb_cms_sales_contract WHERE cb_cms_sales_received.pj_seq='$project' AND cont_seq=cb_cms_sales_contract.seq AND cont_seq='$pay_cont_seq->cont_seq' GROUP BY cont_seq ");
						}
					}
				}

				// $data['dong_list'] = $this->cms_main_model->sql_result(" SELECT dong FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND is_contract='1' GROUP BY dong ORDER BY dong "); // 동 리스트
				$data['dong_list'] = $this->cms_main_model->sql_result(" SELECT dong FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' GROUP BY dong ORDER BY dong "); // 동 리스트
				$data['ho_list'] = $this->cms_main_model->sql_result(" SELECT ho FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$now_dong' AND is_contract='1' GROUP BY ho ORDER BY ho "); // 호 리스트

				$unit = $data['unit'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$now_dong' AND ho='$now_ho' ");  // 선택한 동호수 유닛

				if( !empty($unit->seq)){
					$cont_where = " WHERE unit_seq='$unit->seq' AND cb_cms_sales_contract.seq=cont_seq  ";
					$cont_query = "  SELECT *, cb_cms_sales_contractor.seq AS contractor_seq FROM cb_cms_sales_contract, cb_cms_sales_contractor ".$cont_where;
					$cont_data = $data['cont_data'] = $this->cms_main_model->sql_row($cont_query); // 계약 및 계약자 데이터

					// 수납 데이터
					$data['received'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$cont_data->seq' ORDER BY paid_date, seq "); // 계약자별 수납데이터
					$data['total_paid'] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS total_paid FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$cont_data->seq' "); // 계약자별 총 수납액
				}
				// 수납 약정
            	$pay_sche_code = $data['pay_sche_code'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' "); // 전체 약정 회차
            	$pay_sche_code_sel = $data['pay_sche_code_sel'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_pay_sche WHERE pj_seq='$project'  "); // 계약금 이후 약정 회차



				$data['contractor_info'] = ( !empty($this->input->get('ho'))) ? "
				<font color='#9f0404'><span class='glyphicon glyphicon-import' aria-hidden='true' style='padding-right: 10px;'></span></font><b>
				[".$unit->type." 타입] &nbsp;".$now_dong ." 동 ". $now_ho." 호 - 계약자 : ".$cont_data->contractor."</b>" : "";

				// $data['cont_info'] =

				// 수납 계좌
				$data['paid_acc'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_bank_acc WHERE pj_seq='$project' ");
				// 수정 시 수납 데이터
				$data['modi_rec'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_received WHERE seq='".$this->input->get('rec_seq')."' ");

				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				$this->form_validation->set_rules('paid_date', '수납일자', 'trim|exact_length[10]|required');
				$this->form_validation->set_rules('pay_sche_code', '수납회차', 'trim|required');
				$this->form_validation->set_rules('paid_amount', '수납금액', 'trim|numeric|required');
				$this->form_validation->set_rules('paid_acc', '수납계좌', 'trim|required');
				$this->form_validation->set_rules('paid_who', '입금자', 'trim|required|max_length[20]');
				$this->form_validation->set_rules('note', '비 고', 'trim|max_length[200]');

				if($this->form_validation->run() == FALSE) {

					//본 페이지 로딩
					$this->load->view('/cms_views/menu/cms_m1/md2_sd2_v', $data);
				}else{

					$ins_data = array(
						'pj_seq' => $project,
						'cont_seq' => $this->input->post('cont_seq'),
						'pay_sche_code' => $this->input->post('pay_sche_code'),
						'paid_amount' => $this->input->post('paid_amount'),
						'paid_acc' => $this->input->post('paid_acc'),
						'paid_date' => $this->input->post('paid_date'),
						'paid_who' => $this->input->post('paid_who'),
						'note' => $this->input->post('note'),
						'reg_date' => date('Y-m-d'),
						'reg_worker' => $this->session->userdata('mem_username')
					);
					if($this->input->post('modi')=='1'){
						$result = $this->cms_main_model->update_data('cb_cms_sales_received', $ins_data, array('seq' => $this->input->post('rec_seq'))); // 수정 모드일 경우
					}else{
						$result = $this->cms_main_model->insert_data('cb_cms_sales_received', $ins_data); // 입력 모드일 경우
					}

					if( !$result) alert($ins_data, '');
					// if( !$result) alert("데이터베이스 에러입니다.", '');

					alert("수납내역이 정상 입력 되었습니다.", base_url('cms_m1/sales/2/2?project='.$project.'&dong='.$this->input->post('dong').'&ho='.$this->input->post('ho')));
				}
			}






		// 1. 수납관리 3. 수납약정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {
			$this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m1_2_3', $this->session->userdata['mem_id']);

			if( !$auth['_m1_2_3'] or $auth['_m1_2_3']==0) {
				$this->load->view('cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_2_3'];

				// 1. 분양 차수 설정
				$data['con_diff'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_con_diff WHERE pj_seq='$project' ORDER BY diff_no "); // 프로젝트 등록된 전체 차수

				// 2. 납입 회차 설정

				// 3. 층별 조건 설정

				// 4. 향별 조건 설정

				// 5. 조건별 분양가 설정

				// 6. 회차별 납입가 설정
				// price - 데이터 불러오기
				$price = $data['price'] = $this->cms_main_model->sql_result(" SELECT *, cb_cms_sales_price.seq AS pr_seq FROM cb_cms_sales_price, cb_cms_sales_con_floor WHERE cb_cms_sales_price.pj_seq='$project' AND con_diff_seq='".$this->input->get('con_diff')."' AND con_floor_seq=cb_cms_sales_con_floor.seq  ORDER BY cb_cms_sales_price.seq ");
				$pay_sche = $data['pay_sche'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' AND pay_sort='".$this->input->get('pay_sort')."' ORDER BY pay_code ");

				$diff_no = $this->input->get('con_diff');
				$data['pr_diff'] = $this->cms_main_model->sql_result(" SELECT	seq, diff_no, diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no='$diff_no' "); // 차수
				$data['pr_floor'] = $this->cms_main_model->sql_result(" SELECT seq, floor_name, COUNT(seq) AS num_floor FROM cb_cms_sales_con_floor WHERE pj_seq='$project' "); // 층별
				$data['pr_type'] = $this->cms_main_model->sql_result(" SELECT seq, type_name, COUNT(seq) AS num_type FROM cb_cms_sales_con_type WHERE pj_seq='$project' "); // 타입
				$data['pr_row'] = $data['pr_floor'][0]->num_floor*$data['pr_type'][0]->num_type;

				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				// 6. 회차별 납입가 설정
				for($i=0; $i<count($price); $i++) :
					for($j=0; $j<count($pay_sche); $j++) :
						$this->form_validation->set_rules("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq, "납부액_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq, 'trim|numeric|required');
					endfor;
				endfor;

				if($this->form_validation->run() == FALSE) : // 폼검증 안했거나 통과 못했을 경우

					//본 페이지 로딩
					$this->load->view('/cms_views/menu/cms_m1/md2_sd3_v', $data);
				else : // 폼검증 통과 시

					for($i=0; $i<count($price); $i++) :
						for($j=0; $j<count($pay_sche); $j++) :
							$pmt_data = array(
								'pj_seq' => $project,
								'price_seq' => $price[$i]->pr_seq,
								'pay_sche_seq' => $pay_sche[$j]->seq,
								'payment' => $this->input->post("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq),
								'reg_date' => date('Y-m-d'),
								'reg_worker' => $this->session->userdata('mem_username')
							);
							if(empty($this->input->post("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq."_h")) OR ($this->input->post("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq."_h"))=='0') {
								$result[$j] = $this->cms_main_model->insert_data('cb_cms_sales_payment', $pmt_data);
								if( !$result[$j]) {alert('데이터베이스 에러입니다.1', '');}
							}elseif(($this->input->post("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq."_h"))=='1') {
								$result[$j] = $this->cms_main_model->update_data('cb_cms_sales_payment', $pmt_data, array('pj_seq'=>$project, 'price_seq'=>$price[$i]->pr_seq, 'pay_sche_seq'=>$pay_sche[$j]->seq));
								if( !$result[$j]) {alert('데이터베이스 에러입니다.2', '');}
							}
						endfor;
					endfor;

					alert('정상 처리 되었습니다.', '');
				endif; // 폼검증 통과 시 종료
			}
		}
	}
}
// End of this File
