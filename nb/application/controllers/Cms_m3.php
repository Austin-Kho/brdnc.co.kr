<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_m3 extends CB_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if($this->member->is_member() === false) {
			redirect(site_url('login?url=' . urlencode(current_full_url())));
		}
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m3_model'); //모델 파일 로드
		$this->load->helper('cms_alert'); // 경고창 헤퍼 로딩
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->project();
	}

	public function project($mdi='', $sdi=''){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		///////////////////////////
		// 이벤트 라이브러리를 로딩합니다
		$eventname = 'event_main_index';
		$this->load->event($eventname);

		$view = array();
		$view['data'] = array();

		// 이벤트가 존재하면 실행합니다
		$view['data']['event']['before'] = Events::trigger('before', $eventname);

		$view['data']['canonical'] = site_url();

		// 이벤트가 존재하면 실행합니다
		$view['data']['event']['before_layout'] = Events::trigger('before_layout', $eventname);
		////////////////////////

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$view['top_menu'] = $this->cms_main_model->data_result('cb_menu', array('men_parent'=>0), 'men_order');
		$view['sec_menu'] = $this->cms_main_model->data_result('cb_menu', array('men_parent'=>$view['top_menu'][2]->men_id), 'men_order');

		$view['s_di'] = array(
			array('동호수 등록', '세부설정 관리', '토지조서 관리'), // 첫번째 하위 메뉴
			array('프로젝트 목록', '신규 등록', '검토 자료'),       // 두번째 하위 메뉴
			array('동호(UNIT) 데이터 입력', 'UNIT별 세부설정 관리', '토지목록 조서 관리'),   // 첫번째 하위 제목
			array('목록 및 기본정보 관리', '신규 프로젝트 등록', '예비 프로젝트 검토')     // 두번째 하위 제목
		);

		// 등록된 프로젝트 데이터
		$where = "";
		if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
		$view['pj_list'] = $this->cms_main_model->data_result('cb_cms_project', '', 'biz_start_ym DESC');
		$project = $view['project'] = ($this->input->get_post('project')) ? $this->input->get_post('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)



		// 3-1 프로젝트 관리 1. 데이터등록 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m3_1_1', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth11'] = $auth['_m3_1_1'];

			$where=" WHERE is_data_reg = '0' ";
			if($this->input->get('yr')>1) $where.=" AND biz_start_ym LIKE '".$this->input->get('yr')."%' ";
			$view['new_pj_list'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_project ".$where." ORDER BY biz_start_ym DESC  ");

			$where=" WHERE is_data_reg = '1' ";
			if($this->input->get('yr')>1) $where.=" AND biz_start_ym LIKE '".$this->input->get('yr')."%' ";
			$view['end_pj_list'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_project ".$where." ORDER BY biz_start_ym DESC ");

			if($this->input->get('new_pj') OR $this->input->get('end_pj')){
				if($this->input->get('new_pj') && !$this->input->get('end_pj')){
					$view['pre_pj_seq'] = $this->input->get('new_pj'); // 신규 등록인지
				}else if($this->input->get('end_pj') && !$this->input->get('new_pj')){
					$view['pre_pj_seq'] = $this->input->get('end_pj'); // 기등록 프로젝트인지
				}
				$where = " WHERE seq = '".$view['pre_pj_seq']."'  ";
				$view['project'] = $this->cms_main_model->sql_row(" SELECT pj_name, sort, data_cr, type_name FROM cb_cms_project ".$where);
				switch ($view['project']->sort) {
					case '1': $view['sort']="아파트(일반분양)"; break;
					case '2': $view['sort']="아파트(조합)"; break;
					case '3': $view['sort']="주상복합(아파트)"; break;
					case '4': $view['sort']="주상복합(오피스텔)"; break;
					case '5': $view['sort']="도시형생활주택"; break;
					case '6': $view['sort']="근린생활시설"; break;
					case '7': $view['sort']="레저(숙박)시설"; break;
					case '8': $view['sort']="기 타"; break;
					default: $view['sort']=""; break;
				}
				if($this->input->get('new_pj')) { // 최근 동록한 동과 라인 총 등록 수량 구하기
					$view['reg_chk'] = $this->cms_main_model->sql_num_result(" SELECT dong, ho FROM cb_cms_project_all_housing_unit, cb_cms_project WHERE pj_seq = '".$view['pre_pj_seq']."' AND pj_seq = cb_cms_project.seq AND is_data_reg != 1 ORDER BY cb_cms_project_all_housing_unit.seq DESC ");
				}
				if($view['pre_pj_seq']){
					$add_where = "";
					if($this->input->get('type')) $add_where .= " AND type = '".$this->input->get('type')."' ";
					$view['reg_dong'] = $this->cms_main_model->sql_result(" SELECT dong FROM cb_cms_project_all_housing_unit WHERE pj_seq = '".$view['pre_pj_seq']."' ".$add_where." GROUP BY dong  ");
					if($this->input->get('dong')) $add_where .= " AND dong = '".$this->input->get('dong')."' ";

					// 상태에 따른 검색 소스
					switch ($this->input->get('condi')) {
						case '1': $add_where .= " AND is_application='0' AND is_contract='0' AND is_hold='0' "; break;
						case '2': $add_where .= " AND is_application='1' "; break;
						case '3': $add_where .= " AND is_contract='1' "; break;
						case '4': $add_where .= " AND is_hold='1' "; break;
						default: $add_where .= ""; break;
					}

					//페이지네이션 라이브러리 로딩 추가
					$this->load->library('pagination');

					//페이지네이션 설정/////////////////////////////////
					$config['base_url'] = base_url('cms_m3/project/1/1');   //페이징 주소
					$config['total_rows'] = $this->cms_main_model->sql_num_rows(" SELECT pj_seq, pj_name, type, dong, ho, type_name, type_color, is_hold FROM  cb_cms_project_all_housing_unit, cb_cms_project WHERE pj_seq = ".$view['pre_pj_seq']." AND pj_seq=cb_cms_project.seq ".$add_where." ORDER BY cb_cms_project_all_housing_unit.seq DESC ");  //게시물의 전체 갯수
					if( !$this->input->get('num')) $config['per_page'] = 10;  else $config['per_page'] = $this->input->get('num'); // 한 페이지에 표시할 게시물 수
					$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
					$config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
					$config['reuse_query_string'] = TRUE; //http://example.com/index.php/test/page/20?query=search%term

					// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
					$page = $this->input->get('page'); // get 방식 아닌 경우 $this->uri->segment($config['uri_segment']);
					$start = ($page<=1 or empty($page)) ? 0 : ($page-1) * $config['per_page'];
					$limit = $config['per_page'];

					//페이지네이션 초기화
					$this->pagination->initialize($config);
					//페이징 링크를 생성하여 view에서 사용할 변수에 할당
					$view['pagination'] = $this->pagination->create_links();

					if($start != '' or $limit !='')	$limit = " LIMIT ".$start.", ".$limit." ";

					$order = " ORDER BY cb_cms_project_all_housing_unit.seq DESC  ";

					if($this->input->get('order_reg') OR $this->input->get('order_reg')=="on"){
						$order = " ORDER BY cb_cms_project_all_housing_unit.seq ASC ";
					}

					if($this->input->get('dong_ho_sc1')=="1"){
						$order = " ORDER BY dong ASC , ho ASC  ";
					}else if($this->input->get('dong_ho_sc1')=="2"){
						$order = " ORDER BY dong DESC , ho DESC    ";
					}
					$view['reg_dong_ho'] = $this->cms_main_model->sql_result(" SELECT cb_cms_project_all_housing_unit.seq, pj_seq, pj_name, type, dong, ho, type_name, type_color, is_hold, hold_reason, is_application, is_contract FROM  cb_cms_project_all_housing_unit, cb_cms_project WHERE pj_seq = ".$view['pre_pj_seq']." AND pj_seq=cb_cms_project.seq ".$add_where." ".$order." ".$limit);
				}
			}

			// 라이브러리 로드
			$this->load->library('form_validation'); // 폼 검증

			$this->form_validation->set_rules('dong_1', '동1', 'required|max_length[8]');
			$this->form_validation->set_rules('dong_2', '동2', 'max_length[8]');
			$this->form_validation->set_rules('dong_3', '동3', 'max_length[8]');
			$this->form_validation->set_rules('dong_4', '동4', 'max_length[8]');
			$this->form_validation->set_rules('dong_5', '동5', 'max_length[8]');
			$this->form_validation->set_rules('dong_6', '동6', 'max_length[8]');
			$this->form_validation->set_rules('line_2', '라인1', 'required|max_length[2]|numeric');
			$this->form_validation->set_rules('line_2', '라인2', 'max_length[2]|numeric');
			$this->form_validation->set_rules('line_3', '라인3', 'max_length[2]|numeric');
			$this->form_validation->set_rules('line_4', '라인4', 'max_length[2]|numeric');
			$this->form_validation->set_rules('line_5', '라인5', 'max_length[2]|numeric');
			$this->form_validation->set_rules('line_6', '라인6', 'max_length[2]|numeric');
			$this->form_validation->set_rules('type_1', '타입1', 'required');
			$this->form_validation->set_rules('min_floor_3', '최저층1', 'required|max_length[3]|numeric');
			$this->form_validation->set_rules('min_floor_3', '최저층2', 'max_length[3]|numeric');
			$this->form_validation->set_rules('min_floor_3', '최저층3', 'max_length[3]|numeric');
			$this->form_validation->set_rules('min_floor_3', '최저층4', 'max_length[3]|numeric');
			$this->form_validation->set_rules('min_floor_3', '최저층5', 'max_length[3]|numeric');
			$this->form_validation->set_rules('min_floor_3', '최저층6', 'max_length[3]|numeric');
			$this->form_validation->set_rules('max_floor_3', '최고층1', 'required|max_length[3]|numeric');
			$this->form_validation->set_rules('max_floor_3', '최고층2', 'max_length[3]|numeric');
			$this->form_validation->set_rules('max_floor_3', '최고층3', 'max_length[3]|numeric');
			$this->form_validation->set_rules('max_floor_3', '최고층4', 'max_length[3]|numeric');
			$this->form_validation->set_rules('max_floor_3', '최고층5', 'max_length[3]|numeric');
			$this->form_validation->set_rules('max_floor_3', '최고층6', 'max_length[3]|numeric');


			if($this->form_validation->run() == FALSE) {

				if($this->input->get('mode')=='end'){// 데이터 등록 마감
					$end_dt = array('is_data_reg'=>'1');
					$end_wr = array('seq'=>$this->input->get('seq'));
					$pj_end = $this->cms_main_model->update_data('cb_cms_project', $end_dt, $end_wr);
					if($pj_end) alert('정상적으로 데이터 등록 마감 처리 되었습니다.', base_url('cms_m3/project/1/1'));

				}else if($this->input->get('mode')=='re_reg'){ // 데이터 재등록
					$rereg_dt = array('is_data_reg'=>'0');
					$rereg_wr = array('seq'=>$this->input->get('seq'));
					$pj_rereg = $this->cms_main_model->update_data('cb_cms_project', $rereg_dt, $rereg_wr);
					if($pj_rereg) alert('정상적으로 마감 취소(재등록) 처리 되었습니다.', base_url('cms_m3/project/1/1'));

				}else if($this->input->get('mode')=='individual_reg'){ // 개별 등록 수정일 경우

				}
			}else{
				// 동 데이터
				$dong = array ($this->input->post('dong_1', TRUE), $this->input->post('dong_2', TRUE), $this->input->post('dong_3', TRUE), $this->input->post('dong_4', TRUE), $this->input->post('dong_5', TRUE), $this->input->post('dong_6', TRUE));
				// 라인 데이터
				$line_1 = str_pad($this->input->post('line_1', TRUE), 2, "0", STR_PAD_LEFT);
				$line_2 = str_pad($this->input->post('line_2', TRUE), 2, "0", STR_PAD_LEFT);
				$line_3 = str_pad($this->input->post('line_3', TRUE), 2, "0", STR_PAD_LEFT);
				$line_4 = str_pad($this->input->post('line_4', TRUE), 2, "0", STR_PAD_LEFT);
				$line_5 = str_pad($this->input->post('line_5', TRUE), 2, "0", STR_PAD_LEFT);
				$line_6 = str_pad($this->input->post('line_6', TRUE), 2, "0", STR_PAD_LEFT);
				$line = array($line_1, $line_2, $line_3, $line_4, $line_5, $line_6);
				// 타입 데이터
				$type = array($this->input->post('type_1', TRUE), $this->input->post('type_2', TRUE), $this->input->post('type_3', TRUE), $this->input->post('type_4', TRUE), $this->input->post('type_5', TRUE), $this->input->post('type_6', TRUE));
				// 층 데이터
				$min_floor = array($this->input->post('min_floor_1', TRUE), $this->input->post('min_floor_2', TRUE), $this->input->post('min_floor_3', TRUE), $this->input->post('min_floor_4', TRUE), $this->input->post('min_floor_5', TRUE), $this->input->post('min_floor_6', TRUE));
				$max_floor = array($this->input->post('max_floor_1', TRUE), $this->input->post('max_floor_2', TRUE), $this->input->post('max_floor_3', TRUE), $this->input->post('max_floor_4', TRUE), $this->input->post('max_floor_5', TRUE), $this->input->post('max_floor_6', TRUE));

				// 입력할 동호수 중 기 등록 중복 동호수 있는지 여부 확인
				for($j=0; $j<6; $j++ ){
					if($min_floor[$j]&&$max_floor[$j]){
						$fl_range[$j] = range($min_floor[$j], $max_floor[$j]);
						$fn[$j]= count($fl_range[$j]);  // 입력된 층의 개수
						for($i=0; $i<$fn[$j]; $i++){
							$ho[$j] = $fl_range[$j][$i].$line[$j];
							//기존에 등록되어 있는 동호수가 있는지 체크
							$ck_rlt = $this->cms_main_model->sql_result(" SELECT seq FROM cb_cms_project_all_housing_unit WHERE pj_seq='".$this->input->post('pj_seq')."' AND dong='".$dong[$j]."' AND	ho ='".$ho[$j]."' ");
							if($ck_rlt) alert('이미 등록되어 있는 동호수와 중복되는 동호수가 있습니다.', '');
						}
					}
				}
				if($this->input->post('hold_1', TRUE)=="on") $hold_1 = 1; else $hold_1 = 0;
				if($this->input->post('hold_2', TRUE)=="on") $hold_2 = 1; else $hold_2 = 0;
				if($this->input->post('hold_3', TRUE)=="on") $hold_3 = 1; else $hold_3 = 0;
				if($this->input->post('hold_4', TRUE)=="on") $hold_4 = 1; else $hold_4 = 0;
				if($this->input->post('hold_5', TRUE)=="on") $hold_5 = 1; else $hold_5 = 0;
				if($this->input->post('hold_6', TRUE)=="on") $hold_6 = 1; else $hold_6 = 0;
				$hold = array($hold_1, $hold_2, $hold_3, $hold_4, $hold_5, $hold_6);

				if($this->input->post('mode')=='reg'){ // 데이터 등록 모드

					############# DB INSERT. #############
					for($j=0; $j<6; $j++){
						if($min_floor[$j]&&$max_floor[$j]){ //[$j] // 일괄 등록 층에 대한 쿼리 실행

							$fl_range[$j] = range($min_floor[$j], $max_floor[$j], 1);
							$fn[$j]= count($fl_range[$j]);  // 입력된 층의 개수

							for($i=0; $i<$fn[$j]; $i++){
								$ho[$j] = $fl_range[$j][$i].$line[$j];
								$floor = $fl_range[$j][$i];
								$bat_data = array(
									'pj_seq' => $this->input->post('pj_seq'),
									'type' => $type[$j],
									'dong' => $dong[$j],
									'ho' => $ho[$j],
									'floor' =>$floor,
									'line' => $line[$j],
									'is_hold' => $hold[$j],
									'reg_worker' => $this->session->userdata['mem_username']
								);
								$bat_insert = $this->cms_main_model->insert_data('cb_cms_project_all_housing_unit', $bat_data, 'reg_time');
								if(!$bat_insert) alert('데이터베이스 오류가 발생하였습니다.', base_url('cms_m3/project/1/1/'));
							}
						}
					}
					alert('정상적으로 프로젝트 데이터 정보가 등록 되었습니다.', base_url('cms_m3/project/1/1')."?mode=".$this->input->post('mode')."&amp;new_pj=".$this->input->post('new_pj')."&amp;end_pj=".$this->input->post('end_pj'));
				}
			}





		// 3-1 프로젝트 관리 2. 기타 세부약정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m3_1_2', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth12'] = $auth['_m3_1_2'];

			// 1. 분양 차수 등록
			$con_diff = $view['con_diff'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_con_diff WHERE pj_seq='$project' ORDER BY seq, diff_no ");  // 프로젝트 등록된 전체 차수

			// 2. 납입 회차 등록
			$view['pay_time'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' ORDER BY seq, pay_code ");

			// 3. 층별 조건 등록
			$con_floor = $view['con_floor'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_con_floor WHERE pj_seq='$project' ORDER BY seq ");

			// 4. 향별 조건 등록
			$view['con_direction'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_con_direction WHERE pj_seq='$project' ORDER BY seq ");

			// 5. 조건별 분양가 등록
			// view 파일에서 보내 온 차수 데이터
			$this_diff = $this->input->get('con_diff');
			$view['type_info'] = $this->cms_main_model->sql_row(" SELECT type_name, type_color FROM cb_cms_project WHERE seq='$project' ");
			$view['diff'] = $this->cms_main_model->sql_row(" SELECT diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no='$this_diff' ");
			// price - 데이터 불러오기
			$price = $view['price'] =
				$this->cms_main_model->sql_result(
					" SELECT *, cb_cms_sales_price.seq AS pr_seq, cb_cms_sales_price.reg_date AS pr_reg_date, cb_cms_sales_price.reg_worker AS pr_reg_worker
						FROM cb_cms_sales_price, cb_cms_sales_con_floor
						WHERE cb_cms_sales_price.pj_seq='$project' AND con_diff_no='$this_diff' AND con_floor_no=cb_cms_sales_con_floor.seq
						ORDER BY cb_cms_sales_price.seq "
				);

			// 6. 회차별 납입가 등록
			$pay_sche = $view['pay_sche'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' AND pay_sort='".$this->input->get('pay_sort')."' ORDER BY pay_code ");
			$diff_no = $this->input->get('con_diff');
			$view['pr_diff'] = $this->cms_main_model->sql_result(" SELECT	seq, diff_no, diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no='$diff_no' "); // 차수

			$type = $view['type'] = explode("-", $view['type_info']->type_name);


			// 라이브러리 로드
			$this->load->library('form_validation'); // 폼 검증

			for($a=0; $a<5; $a++){ // 1. diff form_validation->set_rules(''); 설정
				$this->form_validation->set_rules('diff_no_'.$a, '등록차수'.($a+1), 'trim|max_length[2]|numeric');
				$this->form_validation->set_rules('diff_name_'.$a, '차수명'.($a+1), 'trim|max_length[10]');
			}

			for($b=0; $b<15; $b++){ // 2. pay_sche form_validation->set_rules(''); 설정
				$this->form_validation->set_rules('pay_sort_'.$b, '납부구분'.($b+1), 'trim|max_length[1]|numeric');
				$this->form_validation->set_rules('pay_code_'.$b, '회차코드'.($b+1), 'trim|max_length[2]|numeric');
				$this->form_validation->set_rules('pay_time_'.$b, '납부순서'.($b+1), 'trim|max_length[2]|numeric');
				$this->form_validation->set_rules('pay_name_'.$b, '회차명칭'.($b+1), 'trim|max_length[10]');
				$this->form_validation->set_rules('pay_disc_'.$b, '부가설명'.($b+1), 'trim|max_length[10]');
				$this->form_validation->set_rules('pay_due_date_'.$b, '납부기한'.($b+1), 'trim|max_length[10]');
			}

			for($c=0; $c<10; $c++){ // 3. floor form_validation->set_rules(''); 설정
				$this->form_validation->set_rules('s_range_'.$c, '층 범위(시작)'.($c+1), 'trim|max_length[2]|numeric');
				$this->form_validation->set_rules('e_range_'.$c, '층 범위(종료)'.($c+1), 'trim|max_length[2]|numeric');
				$this->form_validation->set_rules('floor_name_'.$c, '층 범위 명칭'.($c+1), 'trim|max_length[12]');
			}

			for($d=0; $d<15; $d++){ // 4. direction form_validation->set_rules(''); 설정
				$this->form_validation->set_rules('dir_no_'.$d, '향별 조건코드'.($d+1), 'trim|max_length[1]|numeric');
				$this->form_validation->set_rules('dir_name_'.$d, '향별 조건명'.($d+1), 'trim|max_length[10]');
			}

			$k=0;
			for($i=0; $i<count($type); $i++) { // 5. price form_validation->set_rules(''); 설정
				for($j=0; $j<count($con_floor); $j++){
					for($l=0; $l<count($view['con_direction']); $l++) {
						$this->form_validation->set_rules(('price_'.$k), '분양(모집) 가격'.($k+1), 'trim|max_length[10]|numeric');
						$this->form_validation->set_rules(('num_'.$k), '해당조건 세대수'.($k+1), 'trim|max_length[5]|numeric');
						$k++;
					}
				}
			}

			$p=0;
			for($i=0; $i<count($type); $i++) : // 6. payment form_validation->set_rules(''); 설정
				for($m=0; $m<count($con_floor); $m++) :
					$p_seq = $view['price'][$p]->pr_seq;
					$p++;
					for($j=0; $j<count($view['pay_sche']); $j++) :
						$this->form_validation->set_rules("pmt_".$p_seq."_".$view['pay_sche'][$j]->seq, "납부금액_".$p_seq."_".$view['pay_sche'][$j]->seq, 'trim|max_length[10]|numeric');
					endfor;
				endfor;
			endfor;


			if($this->form_validation->run() !== FALSE) : // 폼검증 통과 했을 경우, post 데이터가 있을 때

				// 1. 분양 차수 등록
				if($this->input->post('set_sort')==='1'){

					for($a=0; $a<5; $a++){ //
						$diff_data = array(
							'pj_seq' => $project,
							'diff_no' => $this->input->post('diff_no_'.$a),
							'diff_name' => $this->input->post('diff_name_'.$a),
							'reg_date' => date('Y-m-d'),
							'reg_worker' => $this->session->userdata('mem_username')
						);
						if(isset($diff_data['diff_no']) && $this->input->post('diff_name_'.$a)){
							if($a<count($view['con_diff'])){
								// 포스트 데이터가 서버 등록 데이터 수 초과하지 않을 경우 - 데이터 업데이트
								$result[$a] = $this->cms_main_model->update_data('cb_cms_sales_con_diff', $diff_data, array('seq'=> $this->input->post('seq_'.$a), 'pj_seq'=>$project));
								if( !$result[$a]) {alert('데이터베이스 에러입니다.1', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=1');}
							}else{
								// 포스트 데이터가 서버 등록 데이터 수 초과 시 - 신규 입력
								$result[$a] = $this->cms_main_model->insert_data('cb_cms_sales_con_diff', $diff_data);
								if( !$result[$a]) {alert('데이터베이스 에러입니다.2', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=1');}
							}
						}else{
							break;
						}
					}
					alert('정상 처리 되었습니다.', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=1');

				// 2. 납입 회차 등록
				}elseif($this->input->post('set_sort')==='2'){

					for($b=0; $b<15; $b++){ //
						$sche_data = array(
							'pj_seq' => $project,
							'pay_sort' => $this->input->post('pay_sort_'.$b),
							'pay_code' => $this->input->post('pay_code_'.$b),
							'pay_time' => $this->input->post('pay_time_'.$b),
							'pay_name' => $this->input->post('pay_name_'.$b),
							'pay_disc' => $this->input->post('pay_disc_'.$b),
							'pay_due_date' => $this->input->post('pay_due_date_'.$b),
							'reg_date' => date('Y-m-d'),
							'reg_worker' => $this->session->userdata('mem_username')
						);
						if(isset($sche_data['pay_sort']) && $this->input->post('pay_name_'.$b)){
							if($b<count($view['pay_time'])){
								// 포스트 데이터가 서버 등록 데이터 수 초과하지 않을 경우 - 데이터 업데이트
								$result[$b] = $this->cms_main_model->update_data('cb_cms_sales_pay_sche', $sche_data, array('seq'=> $this->input->post('seq_'.$b), 'pj_seq'=>$project));
								if( !$result[$b]) {alert('데이터베이스 에러입니다.1', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=2');}
							}else{
								// 포스트 데이터가 서버 등록 데이터 수 초과 시 - 신규 입력
								$result[$b] = $this->cms_main_model->insert_data('cb_cms_sales_pay_sche', $sche_data);
								if( !$result[$b]) {alert('데이터베이스 에러입니다.2', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=2');}
							}
						}else{
							break;
						}
					}
					alert('정상 처리 되었습니다.', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=2');

				// 3. 층별 조건 등록
				}elseif($this->input->post('set_sort')==='3'){

					for($c=0; $c<15; $c++){ //
						$con_fl_data = array(
							'pj_seq' => $project,
							'floor_range' => $this->input->post('s_range_'.$c)."-".$this->input->post('e_range_'.$c),
							'floor_name' => $this->input->post('floor_name_'.$c),
							'reg_date' => date('Y-m-d'),
							'reg_worker' => $this->session->userdata('mem_username')
						);
						if(isset($con_fl_data['floor_range']) && $this->input->post('floor_name_'.$c)){
							if($c<count($view['con_floor'])){
								// 포스트 데이터가 서버 등록 데이터 수 초과하지 않을 경우 - 데이터 업데이트
								$result[$c] = $this->cms_main_model->update_data('cb_cms_sales_con_floor', $con_fl_data, array('seq'=> $this->input->post('seq_'.$c), 'pj_seq'=>$project));
								if( !$result[$c]) {alert('데이터베이스 에러입니다.1', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=3');}
							}else{
								// 포스트 데이터가 서버 등록 데이터 수 초과 시 - 신규 입력
								$result[$c] = $this->cms_main_model->insert_data('cb_cms_sales_con_floor', $con_fl_data);
								if( !$result[$c]) {alert('데이터베이스 에러입니다.2', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=3');}
							}
						}else{
							break;
						}
					}
					alert('정상 처리 되었습니다.', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=3');

				// 4. 향별 조건 등록
				}elseif($this->input->post('set_sort')==='4'){

					for($d=0; $d<15; $d++){ //
						$con_dir_data = array(
							'pj_seq' => $project,
							'dir_no' => $this->input->post('dir_no_'.$d),
							'dir_name' => $this->input->post('dir_name_'.$d),
							'reg_date' => date('Y-m-d'),
							'reg_worker' => $this->session->userdata('mem_username')
						);
						if(isset($con_dir_data['dir_no']) && $this->input->post('dir_name_'.$d)){
							if($d<count($view['con_direction'])){
								// 포스트 데이터가 서버 등록 데이터 수 초과하지 않을 경우 - 데이터 업데이트
								$result[$d] = $this->cms_main_model->update_data('cb_cms_sales_con_direction', $con_dir_data, array('seq'=> $this->input->post('seq_'.$d), 'pj_seq'=>$project));
								if( !$result[$d]) {alert('데이터베이스 에러입니다.1', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=4');}
							}else{
								// 포스트 데이터가 서버 등록 데이터 수 초과 시 - 신규 입력
								$result[$d] = $this->cms_main_model->insert_data('cb_cms_sales_con_direction', $con_dir_data);
								if( !$result[$d]) {alert('데이터베이스 에러입니다.2', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=4');}
							}
						}else{
							break;
						}
					}
					alert('정상 처리 되었습니다.', base_url('cms_m3/project/1/2').'?project='.$project.'&set_sort=4');

				// 5. 조건별 분양가 등록
				}elseif($this->input->post('set_sort')==='5'){

					$price =
						$this->cms_main_model->sql_result(
							" SELECT *, cb_cms_sales_price.seq AS pr_seq, cb_cms_sales_price.reg_date AS pr_reg_date, cb_cms_sales_price.reg_worker AS pr_reg_worker
								FROM cb_cms_sales_con_diff, cb_cms_sales_price, cb_cms_sales_con_floor
								WHERE cb_cms_sales_price.pj_seq='$project' AND con_diff_no='$this_diff' AND con_floor_no=cb_cms_sales_con_floor.seq
								ORDER BY cb_cms_sales_price.seq "
						);

					if( !$this->input->post('con_diff')) {
						alert('차수구분 데이터를 입력하여 주십시오!');
					}else{
						$type = explode("-", $view['type_info']->type_name);
					  $k=0;
					  for($e=0; $e<count($type); $e++) {
							for($f=0; $f<count($view['con_floor']); $f++){
								$price_data = array(
									'pj_seq' => $project,
									'con_diff_no' => $this->input->post('diff_no_'.$k),
									'con_type_no' => $this->input->post('type_no_'.$k),
									'con_type' => $this->input->post('type_'.$k),
									'con_direction_no' => $this->input->post('dir_no_'.$k),
									'con_floor_no' => $this->input->post('fl_no_'.$k),
									'unit_price' => $this->input->post('price_'.$k),
									'unit_num' => $this->input->post('num_'.$k),
									'reg_date' => date('Y-m-d'),
									'reg_worker' => $this->session->userdata('mem_username')
								);
								if(empty($this->input->post("price_".$k."_h")) or $this->input->post("price_".$k."_h") ==="0"){
									// 입력할 데이터가 존재하는 경우 업데이트(UPDATE)
									$result[$j] = $this->cms_main_model->insert_data('cb_cms_sales_price', $price_data);
									if( !$result[$j]) {alert('데이터베이스 에러입니다.1', '');}

								}else if($this->input->post("price_".$k."_h") ==="1"){
									// 입력할 데이터가 존재하지 않는 경우 인서트(INSERT)
									$result[$j] = $this->cms_main_model->update_data('cb_cms_sales_price', $price_data, array(
										'pj_seq'=>$project,
										'con_diff_no'=> $this->input->post('diff_no_'.$k),
										'con_type_no' => $this->input->post('type_no_'.$k),
										'con_type' => $this->input->post('type_'.$k),
										'con_direction_no' => $this->input->post('dir_no_'.$k),
										'con_floor_no' => $this->input->post('fl_no_'.$k)
									));
									if( !$result[$j]) {alert('데이터베이스 에러입니다.2', '');}
								}
								$k++;
							}
						}
						alert('정상 처리 되었습니다.', '');
					}

				// 6. 회차별 납입가 등록
				}elseif($this->input->post('set_sort')==='6'){

					if( empty($this->input->post('con_diff'))) {
						alert('차수구분 데이터를 입력하여 주십시오!');
					}else	if( empty($this->input->post('pay_sort'))){
						alert('회차구분 데이터를 선택하여 주십시오!');
					}else {
						$type = explode("-", $view['type_info']->type_name);
						$p=0;
						for($i=0; $i<count($type); $i++) : // 6. payment form_validation->set_rules(''); 설정
							for($m=0; $m<count($con_floor); $m++) :
								$p_seq = $price[$p]->pr_seq; // $p++ 시키기 전에 seq 미리 정의
								$p++;
								for($j=0; $j<count($pay_sche); $j++) :
									$pmt_data = array(
										'pj_seq' => $project,
										'price_seq' => $p_seq,
										'pay_sche_seq' => $pay_sche[$j]->seq,
										'sche_pay_code' => $pay_sche[$j]->pay_code,
										'payment' => $this->input->post("pmt_".$p_seq."_".$pay_sche[$j]->seq),
										'reg_date' => date('Y-m-d'),
										'reg_worker' => $this->session->userdata('mem_username')
									);

									if($this->input->post("pmt_".$p_seq."_".$pay_sche[$j]->seq) && ($this->input->post("pmt_".$p_seq."_".$pay_sche[$j]->seq."_h"))=='0') {
										$result[$j] = $this->cms_main_model->insert_data('cb_cms_sales_payment', $pmt_data);
										if( !$result[$j]) {alert('데이터베이스 에러입니다.1', '');}
									}elseif($this->input->post("pmt_".$p_seq."_".$pay_sche[$j]->seq) && $this->input->post("pmt_".$p_seq."_".$pay_sche[$j]->seq."_h")=='1') {
										$result[$j] = $this->cms_main_model->update_data('cb_cms_sales_payment', $pmt_data, array('pj_seq'=>$project, 'price_seq'=>$p_seq, 'pay_sche_seq'=>$pay_sche[$j]->seq));
										if( !$result[$j]) {alert('데이터베이스 에러입니다.2', '');}
									}

								endfor;
							endfor;
						endfor;

						alert('정상 처리 되었습니다.', '');

						// 6. 회차별 납입가 등록---종료
					}
				}

			endif; // 폼검증 통과 시 종료





		// 3-1 프로젝트 관리 3. 토지목록 조서 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m3_1_3', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth13'] = $auth['_m3_1_3'];

			if( !$this->input->get('set_sort') OR $this->input->get('set_sort')=='1') {
				// 등록된 토지 기초 데이터 총 면적
				$view['summary'] = $this->cms_main_model->data_row('cb_cms_site_status', array('pj_seq'=>$project), 'SUM(area_returned) as total_area'); // $table, $where, $order, $select, $group, $start='', $limit=''

			}elseif( !$this->input->get('set_sort') OR $this->input->get('set_sort')=='2') {
				// 소유권 관련
				$view['site_lot'] = $this->cms_main_model->data_result('cb_cms_site_status', array('pj_seq'=>$project));
				$view['bank'] = $this->cms_main_model->data_result('cb_cms_capital_bank_code', '', 'bank_code'); // 은행 데이터

				if( !empty($this->input->get('own_seq'))){
					$view['owner_row'] = $this->cms_main_model->data_row('cb_cms_site_ownership', array('pj_seq'=>$project, 'seq'=>$this->input->get('own_seq')));
				}
				$view['own_total'] = $this->cms_main_model->sql_row(" SELECT SUM(owned_area) AS area, COUNT(seq) AS num FROM cb_cms_site_ownership WHERE pj_seq='$project' ");
				$view['own_cont'] = $this->cms_main_model->sql_row(" SELECT SUM(owned_area) AS area, COUNT(seq) AS num FROM cb_cms_site_ownership WHERE pj_seq='$project' AND is_contract='1' ");
			}


			// 페이지네이션 라이브러리 로딩 추가
			$this->load->library('pagination');

			if( !$this->input->get('set_sort') OR $this->input->get('set_sort')=='1') {

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('cms_m3/project/1/3/');   //페이징 주소
				$config['total_rows'] = $view['total_rows'] = $this->cms_main_model->data_num_rows('cb_cms_site_status', array('pj_seq'=>$project));  //게시물의 전체 갯수
				$config['per_page'] = 12; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 4;  // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
				$config['reuse_query_string'] = TRUE; //http://example.com/index.php/test/page/20?query=search%term

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->input->get('page'); // get 방식 아닌 경우 $this->uri->segment($config['uri_segment']);
				$start = ($page<=1 or empty($page)) ? 0 : ($page-1) * $config['per_page'];
				$limit = $config['per_page'];

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$view['pagination'] = $this->pagination->create_links();

				$view['site_lot_list'] = $this->cms_main_model->data_result('cb_cms_site_status', array('pj_seq'=>$project), 'order_no DESC, seq DESC', '', '', $start, $limit); // $table, $where, $order, $select, $group, $start='', $limit=''

				if($this->input->get('del_code')) {
					$del_rlt1 = $this->cms_main_model->delete_data('cb_cms_site_status', array('seq' => $this->input->get('del_code')));
					$del_rlt2 = $this->cms_main_model->delete_data('cb_cms_site_ownership', array('lot_seq' => $this->input->get('del_code')));
					if($del_rlt1 or $del_rlt2) {
						alert('삭제 되었습니다.', base_url('cms_m3/project/1/3/&page='.$this->input->get('page')));
					}else{
						alert('데이터베이스 에러입니다. 다시 시도하여 주십시요!', base_url('cms_m3/project/1/3/&page='.$this->input->get('page')));
					}
				}

			}elseif($this->input->get('set_sort')=='2'){
				// 소유권 정보 입력할 토지(지번) 데이터
				if($this->input->get('site_lot')) $view['sel_site'] = $sel_site = $this->cms_main_model->data_row('cb_cms_site_status', array('seq' => $this->input->get('site_lot')));

				if( !$this->input->get('search_con') OR $this->input->get('search_con')===''){
					$like_array = array('lot_num'=>$this->input->get('search_word'));
					$or_like_array = array('owner'=>$this->input->get('search_word'));
				}elseif($this->input->get('search_con')==='1'){
					$like_array = array('lot_num'=>$this->input->get('search_word'));
				}elseif($this->input->get('search_con')==='2'){
					$like_array = array('owner'=>$this->input->get('search_word'));
				}


				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('cms_m3/project/1/3/');   //페이징 주소
				$config['total_rows'] = $view['total_rows'] = $this->cms_main_model->data_num_rows('cb_cms_site_ownership', array('pj_seq'=>$project), $like_array, $or_like_array);  //게시물의 전체 갯수
				$config['per_page'] = 12; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 4;  // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
				$config['reuse_query_string'] = TRUE; //http://example.com/index.php/test/page/20?query=search%term

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->input->get('page'); // get 방식 아닌 경우 $this->uri->segment($config['uri_segment']);
				$start = ($page<=1 or empty($page)) ? 0 : ($page-1) * $config['per_page'];
				$limit = $config['per_page'];

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$view['pagination'] = $this->pagination->create_links();

				$w_qry = "WHERE cb_cms_site_ownership.pj_seq = ". $project;
				if($this->input->get('search_word')){
					switch ($this->input->get('search_con')) {
						case '1': $w_qry.= " AND cb_cms_site_status.lot_num LIKE '%".$this->input->get('search_word')."%' "; break;
						case '2': $w_qry.= " AND cb_cms_site_ownership.owner LIKE '%".$this->input->get('search_word')."%' "; break;
						default: $w_qry.= " AND cb_cms_site_status.lot_num LIKE '%".$this->input->get('search_word')."%'  OR cb_cms_site_ownership.owner LIKE '%".$this->input->get('search_word')."%' "; break;
					}
				}

				$view['owners_list'] = $this->cms_main_model->sql_result(
					" SELECT cb_cms_site_ownership.*,
						cb_cms_site_status.admin_dong AS admin_dong,
						cb_cms_site_status.land_mark AS land_mark,
						cb_cms_site_status.area_official AS area_official,
						cb_cms_site_status.area_returned AS area_returned
						FROM cb_cms_site_ownership JOIN cb_cms_site_status
						ON cb_cms_site_ownership.lot_seq = cb_cms_site_status.seq
						$w_qry
						ORDER BY cb_cms_site_ownership.seq DESC, lot_order DESC, lot_seq DESC
						LIMIT $start, $limit "
				);

				if($this->input->get('mode')==='3' && $this->input->get('own_seq')) {
					$del_rlt = $this->cms_main_model->delete_data('cb_cms_site_ownership', array('seq' => $this->input->get('own_seq')));

					if($del_rlt) {
						alert('삭제 되었습니다.', base_url('cms_m3/project/1/3/?project='.$project.'&set_sort=2')."&page=".$this->input->get('page'));
					}else{
						alert('데이터베이스 에러입니다. 다시 시도하여 주십시요!', base_url('cms_m3/project/1/3/?project='.$project.'&set_sort=2')."&page=".$this->input->get('page'));
					}
				}
			}

			// 라이브러리 로드
			$this->load->library('form_validation'); // 폼 검증

			if(!$this->input->get('set_sort') OR $this->input->get('set_sort')==='1'){ // 지번 입력 폼
				$this->form_validation->set_rules('order_no', '순번', 'trim|required|numeric|max_length[5]');
				$this->form_validation->set_rules('admin_dong', '행정동', 'trim|required|max_length[10]');
				$this->form_validation->set_rules('lot_num', '지번', 'trim|required|max_length[10]');
				$this->form_validation->set_rules('land_mark', '지목', 'trim|required|max_length[10]');
				$this->form_validation->set_rules('area_official', '공부상 면적', 'trim|required|numeric|max_length[12]');
				$this->form_validation->set_rules('area_returned', '환지면적', 'trim|numeric|max_length[12]');

			}elseif($this->input->get('set_sort')==='2'){ // 소유권 입력 폼
				$this->form_validation->set_rules('owner', '소유자명', 'trim|required|max_length[10]');
				$this->form_validation->set_rules('owner_id_birth', '생년월일', 'trim|numeric|max_length[6]');
				if($this->input->post('owner_id_birth')) $this->form_validation->set_rules('owner_id_gender', '성별', 'trim|numeric|required');
				$this->form_validation->set_rules('owner_tel_1', '연락처1', 'trim|required|max_length[13]');
				$this->form_validation->set_rules('owner_tel_2', '연락처2', 'trim|max_length[13]');
				$this->form_validation->set_rules('dup_issue_date', '등기부등본 발급일', 'trim|max_length[10]');
				$this->form_validation->set_rules('owned_percent', '소유지분', 'trim|required|numeric|max_length[9]');
				$this->form_validation->set_rules('owned_area', '지분면적', 'trim|required|numeric|max_length[13]');
				$this->form_validation->set_rules('acc_number', '계좌번호', 'trim|max_length[20]');
				$this->form_validation->set_rules('acc_owner', '예금주', 'trim|max_length[10]');
				$this->form_validation->set_rules('total_price', '총 매매계약 금액', 'trim|numeric|max_length[12]');
				$this->form_validation->set_rules('down_pay1', '1차 계약금', 'trim|numeric|max_length[11]');
				$this->form_validation->set_rules('down_pay1_date', '1차 계약금 지급일', 'trim|max_length[10]');
				$this->form_validation->set_rules('down_pay2', '2차 계약금', 'trim|numeric|max_length[11]');
				$this->form_validation->set_rules('down_pay2_date', '2차 계약금 지급일', 'trim|max_length[10]');
				$this->form_validation->set_rules('inter_pay1', '1차 중도금', 'trim|numeric|max_length[11]');
				$this->form_validation->set_rules('inter_pay1_date', '1차 중도금 지급일', 'trim|max_length[10]');
				$this->form_validation->set_rules('inter_pay2', '2차 중도금', 'trim|numeric|max_length[12]');
				$this->form_validation->set_rules('inter_pay1_date', '2차 중도금 지급일', 'trim|max_length[10]');
				$this->form_validation->set_rules('remain_pay', '잔 금', 'trim|numeric|max_length[12]');
				$this->form_validation->set_rules('remain_pay_date', '잔금 지급일', 'trim|max_length[10]');
			}

			if($this->form_validation->run() !== FALSE) : // 폼검증 통과 했을 경우, post 데이터가 있을 때

				// 지번 입력 테이블
				if($this->input->post('sort')==='basic'){
					$right_area = !empty($this->input->post('area_returned')) ? $this->input->post('area_returned', TRUE) : $this->input->post('area_official', TRUE);

					$site_basic_unit = array( // 토지 기초 데이터
						'pj_seq' => $this->input->post('project', TRUE),
						'order_no' => $this->input->post('order_no', TRUE),
						'admin_dong' => $this->input->post('admin_dong', TRUE),
						'lot_num' => $this->input->post('lot_num', TRUE),
						'land_mark' => $this->input->post('land_mark', TRUE),
						'area_official' => $this->input->post('area_official', TRUE),
						'area_returned' => $right_area,
						'reg_date' => date('Y-m-d'),
						'reg_worker' => $this->session->userdata('mem_username')
					);

					$result = $this->cms_main_model->insert_data('cb_cms_site_status', $site_basic_unit);
					if( !$result){
						alert('데이터베이스 에러입니다.', base_url('cms_m3/project/1/3/?project='.$this->input->post('project', TRUE)."&page=".$this->input->get('page')));
					}else{
						alert('정상적으로 등록되었습니다.', base_url('cms_m3/project/1/3/?project='.$this->input->post('project', TRUE)."&page=".$this->input->get('page')));
					}

				// 소유권 입력 테이블
				}elseif($this->input->post('sort')==='ownership'){

					$owner_id_date = $this->input->post('owner_id_birth')."-".$this->input->post('owner_id_gender');
					$owner_addr = $this->input->post('postcode1')."|".$this->input->post('address1_1')."|".$this->input->post('address2_1');
					$payment_acc = $this->input->post('bank_name')."|".$this->input->post('acc_number')."|".$this->input->post('acc_owner');
					$is_contract = $this->input->post('is_contract', TRUE) ? $this->input->post('is_contract', TRUE) : 0;
					$down_pay1_is_paid = $this->input->post('down_pay1_is_paid', TRUE) ? $this->input->post('down_pay1_is_paid', TRUE) : 0;
					$down_pay2_is_paid = $this->input->post('down_pay2_is_paid', TRUE) ? $this->input->post('down_pay2_is_paid', TRUE) : 0;
					$inter_pay1_is_paid = $this->input->post('inter_pay1_is_paid', TRUE) ? $this->input->post('inter_pay1_is_paid', TRUE) : 0;
					$inter_pay2_is_paid = $this->input->post('inter_pay2_is_paid', TRUE) ? $this->input->post('inter_pay2_is_paid', TRUE) : 0;
					$remain_pay_is_paid = $this->input->post('remain_pay_is_paid', TRUE) ? $this->input->post('remain_pay_is_paid', TRUE) : 0;
					$ownership_is_take = $this->input->post('ownership_is_take', TRUE) ? $this->input->post('ownership_is_take', TRUE) : 0;

					$site_own_unit = array( // 소유권 정보 데이터
						'pj_seq' => $this->input->post('project', TRUE),
						'lot_seq' => $this->input->post('lot_seq', TRUE),
						'lot_order' => $this->input->post('lot_order', TRUE),
						'lot_num' => $this->input->post('lot_num', TRUE),
						'owner' => $this->input->post('owner', TRUE),
						'owner_id_date' => $owner_id_date,
						'owner_tel_1' => $this->input->post('owner_tel_1', TRUE),
						'owner_tel_2' => $this->input->post('owner_tel_2', TRUE),
						'owner_addr' => $owner_addr,
						'dup_issue_date' => $this->input->post('dup_issue_date', TRUE),
						'own_sort' => $this->input->post('own_sort', TRUE),
						'owned_percent' => $this->input->post('owned_percent', TRUE),
						'owned_area' => $this->input->post('owned_area', TRUE),
						'is_contract' => $is_contract,
						'total_price' => $this->input->post('total_price', TRUE),
						'payment_acc' => $payment_acc,
						'down_pay1' => $this->input->post('down_pay1', TRUE),
						'down_pay1_date' => $this->input->post('down_pay1_date', TRUE),
						'down_pay1_is_paid' => $down_pay1_is_paid,
						'down_pay2' => $this->input->post('down_pay2', TRUE),
						'down_pay2_date' => $this->input->post('down_pay2_date', TRUE),
						'down_pay2_is_paid' => $down_pay2_is_paid,
						'inter_pay1' => $this->input->post('inter_pay1', TRUE),
						'inter_pay1_date' => $this->input->post('inter_pay1_date', TRUE),
						'inter_pay1_is_paid' => $inter_pay1_is_paid,
						'inter_pay2' => $this->input->post('inter_pay2', TRUE),
						'inter_pay2_date' => $this->input->post('inter_pay2_date', TRUE),
						'inter_pay2_is_paid' => $inter_pay2_is_paid,
						'remain_pay' => $this->input->post('remain_pay', TRUE),
						'remain_pay_date' => $this->input->post('remain_pay_date', TRUE),
						'remain_pay_is_paid' => $remain_pay_is_paid,
						'ownership_is_take' => $ownership_is_take,
						'rights_restrictions' => $this->input->post('rights_restrictions', TRUE),
						'counsel_record' => $this->input->post('counsel_record', TRUE)
					);

					$insert_arr = array(
						'reg_date' => date('Y-m-d'),
						'reg_worker' => $this->session->userdata('mem_username')
					);
					$update_arr = array(
						'modi_date' => date('Y-m-d'),
						'modi_worker' => $this->session->userdata('mem_username')
					);

					$insert_data = array_merge($site_own_unit, $insert_arr); // 신규입력 데이터
					$update_data = array_merge($site_own_unit, $update_arr); // 업데이트 데이터

					if($this->input->post('mode')==='1') {
						$result = $this->cms_main_model->insert_data('cb_cms_site_ownership', $insert_data);
					}elseif($this->input->post('mode')==='2'){
						$result = $this->cms_main_model->update_data('cb_cms_site_ownership', $update_data, array('seq'=>$this->input->post('own_seq')));
					}

					if( !$result){
						alert('데이터베이스 에러입니다.', base_url('cms_m3/project/1/3/?project='.$this->input->post('project', TRUE).'&set_sort=2')."&page=".$this->input->get('page'));
					}else{
						alert('정상적으로 등록되었습니다.', base_url('cms_m3/project/1/3/?project='.$this->input->post('project', TRUE).'&set_sort=2')."&page=".$this->input->get('page'));
					}
				}

			endif;






		// 3-2 신규 프로젝트 1. 목록 및 기본정보 수정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m3_2_1', $this->session->userdata['mem_id']);
			$view['auth21'] = $auth['_m3_2_1']; // 불러올 페이지에 보낼 조회 권한 데이터

			// 페이지네이션 라이브러리 로딩 추가
			$this->load->library('pagination');

			//페이지네이션 설정/////////////////////////////////
			$config['base_url'] = base_url('cm/project/1/2/');   //페이징 주소
			$config['total_rows'] = $this->cms_main_model->sql_num_rows(' SELECT * FROM cb_cms_project '.$where.' ORDER BY biz_start_ym DESC ');  //게시물의 전체 갯수
			$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
			$config['num_links'] = 4;  // 링크 좌우로 보여질 페이지 수
			$config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
			$config['reuse_query_string'] = TRUE; //http://example.com/index.php/test/page/20?query=search%term

			// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
			$page = $this->input->get('page'); // get 방식 아닌 경우 $this->uri->segment($config['uri_segment']);
			$start = ($page<=1 or empty($page)) ? 0 : ($page-1) * $config['per_page'];
			$limit = $config['per_page'];

			//페이지네이션 초기화
			$this->pagination->initialize($config);
			//페이징 링크를 생성하여 view에서 사용할 변수에 할당
			$view['pagination'] = $this->pagination->create_links();

			if($start != '' or $limit !='')	$limit = " LIMIT ".$start.", ".$limit." ";

			// 등록된 프로젝트 데이터
			$view['pj_list'] = $this->cms_main_model->sql_result(' SELECT * FROM cb_cms_project '.$where.' ORDER BY biz_start_ym DESC '.$limit);
			if($this->input->get('project')) $view['project_data'] = $this->cms_main_model->data_row('cb_cms_project', array('seq'=>$project));

			// 라이브러리 로드
			$this->load->library('form_validation'); // 폼 검증

			// 폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('pj_name', '프로젝트 명', 'trim|required');
			$this->form_validation->set_rules('sort', '프로젝트 종류', 'trim|required');
			$this->form_validation->set_rules('postcode1', '우편번호', 'trim|required|numeric');
			$this->form_validation->set_rules('address1_1', '메인 주소', 'trim|required');
			$this->form_validation->set_rules('address2_1', '상세 주소', 'trim|max_length[93]');
			$this->form_validation->set_rules('buy_land_extent', '대지 매입면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('donation_land_extent', '기부채납 면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('scheme_land_extent', '계획 대지면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('area_usage', '용도지역지구', 'trim|max_length[30]');
			$this->form_validation->set_rules('build_size', '건축 규모', 'trim|max_length[60]');
			$this->form_validation->set_rules('num_unit', '세대(호/실) 수', 'trim|required|numeric|max_length[6]');
			$this->form_validation->set_rules('build_area', '건축 면적', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('gr_floor_area', '총 연면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('on_floor_area', '지상 연면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('ba_floor_area', '지하 연면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('floor_ar_rat', '용적율(%)', 'trim|required|max_length[8]');
			$this->form_validation->set_rules('bu_to_la_rat', '건폐율(%)', 'trim|max_length[8]');
			$this->form_validation->set_rules('law_num_parking', '법정주차대수', 'trim|numeric|max_length[6]');
			$this->form_validation->set_rules('plan_num_parking', '계획주차대수', 'trim|numeric|max_length[6]');

			for($q=1; $q<=11; $q++):
				$this->form_validation->set_rules('type_name_'.$q, '타입명('.$q.')', 'trim|max_length[10]');
				$this->form_validation->set_rules('type_color_'.$q, '타입컬러('.$q.')', 'trim|max_length[7]');
				$this->form_validation->set_rules('type_quantity_'.$q, '타입수량('.$q.')', 'trim|max_length[5]');
				$this->form_validation->set_rules('count_unit_'.$q, '수량단위('.$q.')', 'trim');
				$this->form_validation->set_rules('area_exc_'.$q, '전용면적('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_com_'.$q, '주거공용('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_sup_'.$q, '공급면적('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_other_'.$q, '기타공용('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_cont_'.$q, '계약면적('.$q.')', 'trim|numeric|max_length[10]');
			endfor;

			$this->form_validation->set_rules('land_cost', '토지 매입비', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('build_cost', '평당건축비', 'trim|numeric|max_length[5]');
			$this->form_validation->set_rules('inside_arcade_area', '단지내 상가 면적', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('inside_arcade_price', '단지내 상가 매각가', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('arc_design_cost', '설계용역비', 'trim|numeric|max_length[8]');
			$this->form_validation->set_rules('supervision_cost', '감리용역비', 'trim|numeric|max_length[8]');
			$this->form_validation->set_rules('initial_inves', '시행사 초기투자금', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('dev_agency_charge', '시행대행 용역비(세대당)', 'trim|numeric|max_length[5]');
			$this->form_validation->set_rules('bridge_loan', '브리지차입규모', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('pf_loan', 'PF차입규모', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('con_lead_time', '공사 소요기간', 'trim|numeric|max_length[4]');
			$this->form_validation->set_rules('biz_start_year', '사업개시 년', 'trim|numeric|max_length[4]');
			$this->form_validation->set_rules('biz_start_month', '사업개시 월', 'trim|numeric|max_length[2]');


			if($this->form_validation->run() !== FALSE) { // 폼 전송 데이타가 있을 때 폼 데이타 가공
				$local_addr = $this->input->post('postcode1')."|".$this->input->post('address1_1')."|".$this->input->post('address2_1');

				$type_name = $this->input->post('type_name_1', TRUE);
				$type_color = $this->input->post('type_color_1', TRUE);
				$type_quantity = $this->input->post('type_quantity_1', TRUE);
				$count_unit = $this->input->post('count_unit_1', TRUE);
				$area_exc = $this->input->post('area_exc_1', TRUE);
				$area_com = $this->input->post('area_com_1', TRUE);
				$area_sup = $this->input->post('area_sup_1', TRUE);
				$area_other = $this->input->post('area_other_1', TRUE);
				$area_cont = $this->input->post('area_cont_1', TRUE);
				for($r=2; $r<=11; $r++):
					if($this->input->post('type_name_'.$r, TRUE)) $type_name .="-".$this->input->post('type_name_'.$r, TRUE);
					if($this->input->post('type_color_'.$r, TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_'.$r, TRUE);
					if($this->input->post('type_quantity_'.$r, TRUE)) $type_quantity .="-".$this->input->post('type_quantity_'.$r, TRUE);
					if($this->input->post('count_unit_'.$r, TRUE)) $count_unit .="-".$this->input->post('count_unit_'.$r, TRUE);
					if($this->input->post('area_exc_'.$r, TRUE)) $area_exc .="-".$this->input->post('area_exc_'.$r, TRUE);
					if($this->input->post('area_com_'.$r, TRUE)) $area_com .="-".$this->input->post('area_com_'.$r, TRUE);
					if($this->input->post('area_sup_'.$r, TRUE)) $area_sup .="-".$this->input->post('area_sup_'.$r, TRUE);
					if($this->input->post('area_other_'.$r, TRUE)) $area_other .="-".$this->input->post('area_other_'.$r, TRUE);
					if($this->input->post('area_cont_'.$r, TRUE)) $area_cont .="-".$this->input->post('area_cont_'.$r, TRUE);
				endfor;

				$biz_start_ym = $this->input->post('biz_start_year').'-'.$this->input->post('biz_start_month');

				$update_pj_data = array(
					'pj_name' => $this->input->post('pj_name', TRUE),
					'sort' => $this->input->post('sort', TRUE),
					'local_addr' => $local_addr,
					'buy_land_extent' => $this->input->post('buy_land_extent', TRUE),
					'donation_land_extent' => $this->input->post('donation_land_extent', TRUE),
					'scheme_land_extent' => $this->input->post('scheme_land_extent', TRUE),
					'area_usage' => $this->input->post('area_usage', TRUE),
					'build_size' => $this->input->post('build_size', TRUE),
					'num_unit' => $this->input->post('num_unit', TRUE),
					'build_area' => $this->input->post('build_area', TRUE),
					'gr_floor_area' => $this->input->post('gr_floor_area', TRUE),
					'on_floor_area' => $this->input->post('on_floor_area', TRUE),
					'ba_floor_area' => $this->input->post('ba_floor_area', TRUE),
					'floor_ar_rat' => $this->input->post('floor_ar_rat', TRUE),
					'bu_to_la_rat' => $this->input->post('bu_to_la_rat', TRUE),
					'law_num_parking' => $this->input->post('law_num_parking', TRUE),
					'plan_num_parking' => $this->input->post('plan_num_parking', TRUE),
					'type_name' => $type_name,
					'type_color' => $type_color,
					'type_quantity' => $type_quantity,
					'count_unit' => $count_unit,
					'area_exc' => $area_exc,
					'area_com' => $area_com,
					'area_sup' => $area_sup,
					'area_other' => $area_other,
					'area_cont' => $area_cont,
					'land_cost' => $this->input->post('land_cost', TRUE),
					'build_cost' => $this->input->post('build_cost', TRUE),
					'inside_arcade_area' => $this->input->post('inside_arcade_area', TRUE),
					'inside_arcade_price' => $this->input->post('inside_arcade_price', TRUE),
					'arc_design_cost' => $this->input->post('arc_design_cost', TRUE),
					'supervision_cost' => $this->input->post('supervision_cost', TRUE),
					'initial_inves' => $this->input->post('initial_inves', TRUE),
					'dev_agency_charge' => $this->input->post('dev_agency_charge', TRUE),
					'bridge_loan' => $this->input->post('bridge_loan', TRUE),
					'pf_loan' => $this->input->post('pf_loan', TRUE),
					'con_lead_time' => $this->input->post('con_lead_time', TRUE),
					'biz_start_ym' => $biz_start_ym
				);

				$result = $this->cms_main_model->update_data('cb_cms_project', $update_pj_data, $where = array('seq' => $this->input->post('project')));

				if($result) { // 등록 성공 시
					alert('프로젝트 정보가  수정되었습니다.', base_url('cms_m3/project/2/1/?project='.$this->input->post('project')));
					exit;
				}else{   // 등록 실패 시
					alert('데이터베이스 오류가 발생하였습니다..',  base_url('cms_m3/project/2/1/?project='.$this->input->post('project')));
					exit;
				}
			}




		// 3-2 신규 프로젝트 2. 신규등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m3_2_2', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth22'] = $auth['_m3_2_2'];

			// 라이브러리 로드
			$this->load->library('form_validation'); // 폼 검증

			// 폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('pj_name', '프로젝트 명', 'trim|required');
			$this->form_validation->set_rules('sort', '프로젝트 종류', 'trim|required');
			$this->form_validation->set_rules('postcode1', '우편번호', 'trim|required|numeric');
			$this->form_validation->set_rules('address1_1', '메인 주소', 'trim|required');
			$this->form_validation->set_rules('address2_1', '상세 주소', 'trim|max_length[93]');
			$this->form_validation->set_rules('buy_land_extent', '대지 매입면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('donation_land_extent', '기부채납 면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('scheme_land_extent', '계획 대지면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('area_usage', '용도지역지구', 'trim|max_length[30]');
			$this->form_validation->set_rules('build_size', '건축 규모', 'trim|max_length[60]');
			$this->form_validation->set_rules('num_unit', '세대(호/실) 수', 'trim|required|numeric|max_length[6]');
			$this->form_validation->set_rules('build_area', '건축 면적', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('gr_floor_area', '총 연면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('on_floor_area', '지상 연면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('ba_floor_area', '지하 연면적', 'trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('floor_ar_rat', '용적율(%)', 'trim|required|max_length[8]');
			$this->form_validation->set_rules('bu_to_la_rat', '건폐율(%)', 'trim|max_length[8]');
			$this->form_validation->set_rules('law_num_parking', '법정주차대수', 'trim|numeric|max_length[6]');
			$this->form_validation->set_rules('plan_num_parking', '계획주차대수', 'trim|numeric|max_length[6]');

			for($q=1; $q<=11; $q++):
				$this->form_validation->set_rules('type_name_'.$q, '타입명('.$q.')', 'trim|max_length[10]');
				$this->form_validation->set_rules('type_color_'.$q, '타입컬러('.$q.')', 'trim|max_length[7]');
				$this->form_validation->set_rules('type_quantity_'.$q, '타입수량('.$q.')', 'trim|numeric|max_length[5]');
				$this->form_validation->set_rules('count_unit_'.$q, '수량단위('.$q.')', 'trim');
				$this->form_validation->set_rules('area_exc_'.$q, '전용면적('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_com_'.$q, '주거공용('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_sup_'.$q, '공급면적('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_other_'.$q, '기타공용('.$q.')', 'trim|numeric|max_length[10]');
				$this->form_validation->set_rules('area_cont_'.$q, '계약면적('.$q.')', 'trim|numeric|max_length[10]');
			endfor;

			$this->form_validation->set_rules('land_cost', '토지 매입비', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('build_cost', '평당건축비', 'trim|numeric|max_length[5]');
			$this->form_validation->set_rules('inside_arcade_area', '단지내 상가 면적', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('inside_arcade_price', '단지내 상가 매각가', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('arc_design_cost', '설계용역비', 'trim|numeric|max_length[8]');
			$this->form_validation->set_rules('supervision_cost', '감리용역비', 'trim|numeric|max_length[8]');
			$this->form_validation->set_rules('initial_inves', '시행사 초기투자금', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('dev_agency_charge', '시행대행 용역비(세대당)', 'trim|numeric|max_length[5]');
			$this->form_validation->set_rules('bridge_loan', '브리지차입규모', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('pf_loan', 'PF차입규모', 'trim|numeric|max_length[10]');
			$this->form_validation->set_rules('con_lead_time', '공사 소요기간', 'trim|numeric|max_length[4]');
			$this->form_validation->set_rules('biz_start_year', '사업개시 년', 'trim|numeric|max_length[4]');
			$this->form_validation->set_rules('biz_start_month', '사업개시 월', 'trim|numeric|max_length[2]');


			if($this->form_validation->run() !== FALSE) { // 폼 전송 데이타가 있으면,//폼 데이타 가공
				$local_addr = $this->input->post('postcode1')."|".$this->input->post('address1_1')."|".$this->input->post('address2_1');

				$type_name = $this->input->post('type_name_1', TRUE);
				$type_color = $this->input->post('type_color_1', TRUE);
				$type_quantity = $this->input->post('type_quantity_1', TRUE);
				$count_unit = $this->input->post('count_unit_1', TRUE);
				$area_exc = $this->input->post('area_exc_1', TRUE);
				$area_com = $this->input->post('area_com_1', TRUE);
				$area_sup = $this->input->post('area_sup_1', TRUE);
				$area_other = $this->input->post('area_other_1', TRUE);
				$area_cont = $this->input->post('area_cont_1', TRUE);

				for($r=2; $r<=11; $r++):
					if($this->input->post('type_name_'.$r, TRUE)) $type_name .="-".$this->input->post('type_name_'.$r, TRUE);
					if($this->input->post('type_color_'.$r, TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_'.$r, TRUE);
					if($this->input->post('type_quantity_'.$r, TRUE)) $type_quantity .="-".$this->input->post('type_quantity_'.$r, TRUE);
					if($this->input->post('count_unit_'.$r, TRUE)) $count_unit .="-".$this->input->post('count_unit_'.$r, TRUE);
					if($this->input->post('area_exc_'.$r, TRUE)) $area_exc .="-".$this->input->post('area_exc_'.$r, TRUE);
					if($this->input->post('area_com_'.$r, TRUE)) $area_com .="-".$this->input->post('area_com_'.$r, TRUE);
					if($this->input->post('area_sup_'.$r, TRUE)) $area_sup .="-".$this->input->post('area_sup_'.$r, TRUE);
					if($this->input->post('area_other_'.$r, TRUE)) $area_other .="-".$this->input->post('area_other_'.$r, TRUE);
					if($this->input->post('area_cont_'.$r, TRUE)) $area_cont .="-".$this->input->post('area_cont_'.$r, TRUE);
				endfor;

				$biz_start_ym = $this->input->post('biz_start_year').'-'.$this->input->post('biz_start_month');

				$new_pj_data = array(
					'pj_name' => $this->input->post('pj_name', TRUE),
					'sort' => $this->input->post('sort', TRUE),
					'local_addr' => $local_addr,
					'buy_land_extent' => $this->input->post('buy_land_extent', TRUE),
					'donation_land_extent' => $this->input->post('donation_land_extent', TRUE),
					'scheme_land_extent' => $this->input->post('scheme_land_extent', TRUE),
					'area_usage' => $this->input->post('area_usage', TRUE),
					'build_size' => $this->input->post('build_size', TRUE),
					'num_unit' => $this->input->post('num_unit', TRUE),
					'build_area' => $this->input->post('build_area', TRUE),
					'gr_floor_area' => $this->input->post('gr_floor_area', TRUE),
					'on_floor_area' => $this->input->post('on_floor_area', TRUE),
					'ba_floor_area' => $this->input->post('ba_floor_area', TRUE),
					'floor_ar_rat' => $this->input->post('floor_ar_rat', TRUE),
					'bu_to_la_rat' => $this->input->post('bu_to_la_rat', TRUE),
					'law_num_parking' => $this->input->post('law_num_parking', TRUE),
					'plan_num_parking' => $this->input->post('plan_num_parking', TRUE),
					'type_name' => $type_name,
					'type_color' => $type_color,
					'type_quantity' => $type_quantity,
					'count_unit' => $count_unit,
					'area_exc' => $area_exc,
					'area_com' => $area_com,
					'area_sup' => $area_sup,
					'area_other' => $area_other,
					'area_cont' => $area_cont,
					'land_cost' => $this->input->post('land_cost', TRUE),
					'build_cost' => $this->input->post('build_cost', TRUE),
					'inside_arcade_area' => $this->input->post('inside_arcade_area', TRUE),
					'inside_arcade_price' => $this->input->post('inside_arcade_price', TRUE),
					'arc_design_cost' => $this->input->post('arc_design_cost', TRUE),
					'supervision_cost' => $this->input->post('supervision_cost', TRUE),
					'initial_inves' => $this->input->post('initial_inves', TRUE),
					'dev_agency_charge' => $this->input->post('dev_agency_charge', TRUE),
					'bridge_loan' => $this->input->post('bridge_loan', TRUE),
					'pf_loan' => $this->input->post('pf_loan', TRUE),
					'con_lead_time' => $this->input->post('con_lead_time', TRUE),
					'biz_start_ym' => $biz_start_ym
				);

				$result = $this->cms_main_model->insert_data('cb_cms_project', $new_pj_data, 'reg_date');

				if($result) { // 등록 성공 시
					alert('프로젝트 정보가  등록되었습니다.', base_url('cms_m3/project/2/1/'));
					exit;
				}else{   // 등록 실패 시
					alert('데이터베이스 오류가 발생하였습니다..', base_url('cms_m3/project/2/2/'));
					exit;
				}
			}




		// 3-3 신규 프로젝트 3. 예비 검토자료
		}else if($mdi==2 && $sdi==3) {

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m3_2_3', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth23'] = $auth['_m3_2_3'];


		}



		/**
		 * 레이아웃을 정의합니다.
		 */
		$page_title = $this->cbconfig->item('site_meta_title_main');
		$meta_description = $this->cbconfig->item('site_meta_description_main');
		$meta_keywords = $this->cbconfig->item('site_meta_keywords_main');
		$meta_author = $this->cbconfig->item('site_meta_author_main');
		$page_name = $this->cbconfig->item('site_page_name_main');

		$layoutconfig = array(
				'path' => 'cms_m3',
				'layout' => 'layout',
				'skin' => 'm3_header',
				'layout_dir' => 'bootstrap',
				'mobile_layout_dir' => 'bootstrap',
				'use_sidebar' => 0,
				'use_mobile_sidebar' => 0,
				'skin_dir' => 'bootstrap',
				'mobile_skin_dir' => 'bootstrap',
				'page_title' => $page_title,
				'meta_description' => $meta_description,
				'meta_keywords' => $meta_keywords,
				'meta_author' => $meta_author,
				'page_name' => $page_name,
		);
		$view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
		$this->data = $view;
		$this->layout = element('layout_skin_file', element('layout', $view));
		$this->view = element('view_skin_file', element('layout', $view));
	}
}
// End of this File
