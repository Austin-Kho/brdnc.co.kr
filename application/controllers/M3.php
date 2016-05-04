<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M3 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member').'?returnURL='.rawurlencode(current_url()));
		}
		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m3_m'); //모델 파일 로드
		$this->load->helper('alert'); // 경고창 헤퍼 로딩
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->project();
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

	public function project($mdi='', $sdi=''){
		$this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('데이터 등록', '데이터 수정'), // 첫번째 하위 메뉴
			array('신규 등록', '예비 검토'),       // 두번째 하위 메뉴
			array('세부 데이터 입력<현재 구축 진행 중>', '프로젝트 기본정보 수정'),   // 첫번째 하위 제목
			array('신규 프로젝트 등록', '프로젝트 검토 현황<현재 구축 진행 중>')        // 두번째 하위 제목
		);
		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('menu/m3/project_v', $menu);

		// 프로젝트 관리 1. 데이터등록 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m3_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m3_1_1'] or $auth['_m3_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m3_1_1'];

				$where=" WHERE is_data_reg = '0' ";
				if($this->input->get('yr')>1) $where.=" AND biz_start_ym LIKE '".$this->input->get('yr')."%' ";
				$data['new_pj_list'] = $this->main_m->sql_result(" SELECT * FROM cms_project11_info ".$where." ORDER BY biz_start_ym DESC  ");

				$where=" WHERE is_data_reg = '1' ";
				if($this->input->get('yr')>1) $where.=" AND biz_start_ym LIKE '".$this->input->get('yr')."%' ";
				$data['reg_pj_list'] = $this->main_m->sql_result(" SELECT * FROM cms_project11_info ".$where." ORDER BY biz_start_ym DESC ");

				if($this->input->get('new_pj') OR $this->input->get('reg_pj')){
					if($this->input->get('new_pj') && !$this->input->get('reg_pj')){
						$data['pre_pj_seq'] = $this->input->get('new_pj'); // 신규 등록인지
					}else if($this->input->get('reg_pj') && !$this->input->get('new_pj')){
						$data['pre_pj_seq'] = $this->input->get('reg_pj'); // 기등록 프로젝트인지
					}
					$where = " WHERE seq = '".$data['pre_pj_seq']."'  ";
					$data['project'] = $this->main_m->sql_row(" SELECT pj_name, sort, data_cr, type_name FROM cms_project11_info ".$where);
					switch ($data['project']->sort) {
						case '1': $data['sort']="아파트(일반분양)"; break;
						case '2': $data['sort']="아파트(조합)"; break;
						case '3': $data['sort']="주상복합(아파트)"; break;
						case '4': $data['sort']="주상복합(오피스텔)"; break;
						case '5': $data['sort']="도시형생활주택"; break;
						case '6': $data['sort']="근린생활시설"; break;
						case '7': $data['sort']="레저(숙박)시설"; break;
						case '8': $data['sort']="기 타"; break;
						default: $data['sort']=""; break;
					}
					if($this->input->get('new_pj')) { // 최근 동록한 동과 라인 총 등록 수량 구하기
						$data['reg_chk'] = $this->main_m->sql_num_result(" SELECT dong, ho FROM cms_project22_indi_table, cms_project11_info WHERE pj_seq = '".$data['pre_pj_seq']."' AND pj_seq = cms_project11_info.seq AND is_data_reg != 1 ORDER BY cms_project22_indi_table.seq DESC ");
					}
					if($data['pre_pj_seq']){
						$add_where = "";
						if($this->input->get('type')) $add_where .= " AND type = '".$this->input->get('type')."' ";
						$data['reg_dong'] = $this->main_m->sql_result(" SELECT dong FROM cms_project22_indi_table WHERE pj_seq = '".$data['pre_pj_seq']."' ".$add_where." GROUP BY dong  ");
						if($this->input->get('dong')) $add_where .= " AND dong = '".$this->input->get('dong')."' ";

						$data['reg_dong_ho'] = $this->main_m->sql_result(" SELECT pj_seq, pj_name, type, dong, ho, type_name, type_color, is_hold FROM  cms_project22_indi_table, cms_project11_info WHERE pj_seq = ".$data['pre_pj_seq']." AND pj_seq=cms_project11_info.seq ".$add_where." ORDER BY cms_project22_indi_table.seq DESC ");
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
					//본 페이지 로딩
					$this->load->view('/menu/m3/md1_sd1_v', $data);
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
								$ck_rlt = $this->main_m->sql_result(" SELECT seq FROM cms_project22_indi_table WHERE pj_seq='".$this->input->post('pj_seq')."' AND dong='".$dong[$j]."' AND	ho ='".$ho[$j]."' ");
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
										'reg_time' => 'now()'
									);
									$bat_insert = $this->main_m->insert_data('cms_project22_indi_table', $bat_data);
									if(!$bat_insert) alert('데이터베이스 오류가 발생하였습니다.', '');
								}
							}
						}
						alert('정상적으로 프로젝트 데이터 정보가 등록 되었습니다.', "?mode=".$this->input->post('mode')."&amp;new_pj=".$this->input->post('new_pj')."&amp;reg_pj=".$this->input->post('reg_pj')." ");

					}else if($this->input->get('mode')=='end'){// 데이터 등록 마감

					}else if($this->input->get('mode')=='re_reg'){ // 데이터 재등록

					}else if($this->input->get('mode')=='individual_reg'){ // 개별 등록 수정일 경우

					}
				}
			}

		// 프로젝트 관리 2. 기본정보 수정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m3_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m3_1_2'] or $auth['_m3_1_2']==0) {
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m3_1_2'];

				$where = "";
				if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";

				// 페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = '/m3/project/1/2/';   //페이징 주소
				$config['total_rows'] = $this->main_m->sql_num_rows(' SELECT * FROM cms_project11_info '.$where.' ORDER BY biz_start_ym DESC ');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 4;  // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
				$config['reuse_query_string'] = TRUE; //http://example.com/index.php/test/page/20?query=search%term

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->uri->segment($config['uri_segment']);
				if($page<=1 or empty($page)) { $start = 0; }else{ $start = ($page-1) * $config['per_page']; }
				$limit = $config['per_page'];

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();

				if($start != '' or $limit !='')	$limit = " LIMIT ".$start.", ".$limit." ";

				// 등록된 프로젝트 데이터
				$data['all_pj'] = $this->main_m->sql_result(' SELECT * FROM cms_project11_info '.$where.' ORDER BY biz_start_ym DESC '.$limit);

				if($this->input->get('project')) $data['project'] = $this->main_m->sql_result(' SELECT * FROM cms_project11_info WHERE seq = '.$this->input->get('project'));

				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('pj_name', '프로젝트 명', 'required');
				$this->form_validation->set_rules('sort', '프로젝트 종류', 'required');
				$this->form_validation->set_rules('zipcode', '우편번호', 'required|numeric');
				$this->form_validation->set_rules('address1', '메인 주소', 'required');
				$this->form_validation->set_rules('address2', '상세 주소', 'max_length[93]');
				$this->form_validation->set_rules('buy_land_extent', '대지 매입면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('scheme_land_extent', '계획 대지면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('build_size', '건축 규모', 'max_length[60]');
				$this->form_validation->set_rules('num_unit', '세대(호/실) 수', 'required|numeric|max_length[6]');
				$this->form_validation->set_rules('build_area', '건축 면적', 'numeric|max_length[10]');
				$this->form_validation->set_rules('gr_floor_area', '총 연면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('on_floor_area', '지상 연면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('ba_floor_area', '지하 연면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('floor_ar_rat', '용적율(%)', 'required|max_length[8]');
				$this->form_validation->set_rules('bu_to_la_rat', '건폐율(%)', 'max_length[8]');
				$this->form_validation->set_rules('law_num_parking', '법정주차대수', 'numeric|max_length[6]');
				$this->form_validation->set_rules('plan_num_parking', '계획주차대수', 'numeric|max_length[6]');
				$this->form_validation->set_rules('type_name_1', '타입명(1)', 'required|max_length[10]');
				$this->form_validation->set_rules('type_color_1', '타입컬러(1)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_1', '타입수량(1)', 'required|max_length[5]');
				$this->form_validation->set_rules('count_unit_1', '수량단위(1)', 'required');
				$this->form_validation->set_rules('type_name_2', '타입명(2)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_2', '타입컬러(2)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_2', '타입수량(2)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_3', '타입명(3)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_3', '타입컬러(3)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_3', '타입수량(3)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_4', '타입명(4)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_4', '타입컬러(4)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_4', '타입수량(4)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_5', '타입명(5)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_5', '타입컬러(5)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_5', '타입수량(5)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_6', '타입명(6)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_6', '타입컬러(6)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_6', '타입수량(6)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_7', '타입명(7)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_7', '타입컬러(7)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_7', '타입수량(7)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_8', '타입명(8)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_8', '타입컬러(8)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_8', '타입수량(8)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_9', '타입명(9)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_9', '타입컬러(9)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_9', '타입수량(9)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_10', '타입명(10)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_10', '타입컬러(10)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_10', '타입수량(10)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_11', '타입명(11)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_11', '타입컬러(11)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_11', '타입수량(11)', 'max_length[5]');
				$this->form_validation->set_rules('land_cost', '토지 매입비', 'numeric|max_length[10]');
				$this->form_validation->set_rules('build_cost', '평당건축비', 'numeric|max_length[5]');
				$this->form_validation->set_rules('arc_design_cost', '설계용역비', 'numeric|max_length[8]');
				$this->form_validation->set_rules('supervision_cost', '감리용역비', 'numeric|max_length[8]');
				$this->form_validation->set_rules('initial_inves', '시행사 초기투자금', 'numeric|max_length[10]');
				$this->form_validation->set_rules('dev_agency_charge', '시행대행 용역비(세대당)', 'numeric|max_length[5]');
				$this->form_validation->set_rules('bridge_loan', '브리지차입규모', 'numeric|max_length[10]');
				$this->form_validation->set_rules('pf_loan', 'PF차입규모', 'numeric|max_length[10]');
				$this->form_validation->set_rules('con_lead_time', '공사 소요기간', 'numeric|max_length[4]');
				$this->form_validation->set_rules('biz_start_year', '사업개시 년', 'numeric|max_length[4]');
				$this->form_validation->set_rules('biz_start_month', '사업개시 월', 'numeric|max_length[2]');

				if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,
					//본 페이지 로딩
					$this->load->view('/menu/m3/md1_sd2_v', $data);
				}else{
					//폼 데이타 가공
					$local_addr = $this->input->post('zipcode')."|".$this->input->post('address1')."|".$this->input->post('address2');
					$type_name = $this->input->post('type_name_1', TRUE);
					if($this->input->post('type_name_2', TRUE)) $type_name .="-".$this->input->post('type_name_2', TRUE);
					if($this->input->post('type_name_3', TRUE)) $type_name .="-".$this->input->post('type_name_3', TRUE);
					if($this->input->post('type_name_4', TRUE)) $type_name .="-".$this->input->post('type_name_4', TRUE);
					if($this->input->post('type_name_5', TRUE)) $type_name .="-".$this->input->post('type_name_5', TRUE);
					if($this->input->post('type_name_6', TRUE)) $type_name .="-".$this->input->post('type_name_6', TRUE);
					if($this->input->post('type_name_7', TRUE)) $type_name .="-".$this->input->post('type_name_7', TRUE);
					if($this->input->post('type_name_8', TRUE)) $type_name .="-".$this->input->post('type_name_8', TRUE);
					if($this->input->post('type_name_9', TRUE)) $type_name .="-".$this->input->post('type_name_9', TRUE);
					if($this->input->post('type_name_10', TRUE)) $type_name .="-".$this->input->post('type_name_10', TRUE);
					if($this->input->post('type_name_11', TRUE)) $type_name .="-".$this->input->post('type_name_11', TRUE);
					$type_color = $this->input->post('type_color_1', TRUE);
					if($this->input->post('type_color_2', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_2', TRUE);
					if($this->input->post('type_color_3', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_3', TRUE);
					if($this->input->post('type_color_4', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_4', TRUE);
					if($this->input->post('type_color_5', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_5', TRUE);
					if($this->input->post('type_color_6', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_6', TRUE);
					if($this->input->post('type_color_7', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_7', TRUE);
					if($this->input->post('type_color_8', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_8', TRUE);
					if($this->input->post('type_color_9', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_9', TRUE);
					if($this->input->post('type_color_10', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_10', TRUE);
					if($this->input->post('type_color_11', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_11', TRUE);
					$type_quantity = $this->input->post('type_quantity_1', TRUE);
					if($this->input->post('type_quantity_2', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_2', TRUE);
					if($this->input->post('type_quantity_3', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_3', TRUE);
					if($this->input->post('type_quantity_4', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_4', TRUE);
					if($this->input->post('type_quantity_5', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_5', TRUE);
					if($this->input->post('type_quantity_6', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_6', TRUE);
					if($this->input->post('type_quantity_7', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_7', TRUE);
					if($this->input->post('type_quantity_8', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_8', TRUE);
					if($this->input->post('type_quantity_9', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_9', TRUE);
					if($this->input->post('type_quantity_10', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_10', TRUE);
					if($this->input->post('type_quantity_11', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_11', TRUE);
					$count_unit = $this->input->post('count_unit_1', TRUE);
					if($this->input->post('count_unit_2', TRUE)) $count_unit .="-".$this->input->post('count_unit_2', TRUE);
					if($this->input->post('count_unit_3', TRUE)) $count_unit .="-".$this->input->post('count_unit_3', TRUE);
					if($this->input->post('count_unit_4', TRUE)) $count_unit .="-".$this->input->post('count_unit_4', TRUE);
					if($this->input->post('count_unit_5', TRUE)) $count_unit .="-".$this->input->post('count_unit_5', TRUE);
					if($this->input->post('count_unit_6', TRUE)) $count_unit .="-".$this->input->post('count_unit_6', TRUE);
					if($this->input->post('count_unit_7', TRUE)) $count_unit .="-".$this->input->post('count_unit_7', TRUE);
					if($this->input->post('count_unit_8', TRUE)) $count_unit .="-".$this->input->post('count_unit_8', TRUE);
					if($this->input->post('count_unit_9', TRUE)) $count_unit .="-".$this->input->post('count_unit_9', TRUE);
					if($this->input->post('count_unit_10', TRUE)) $count_unit .="-".$this->input->post('count_unit_10', TRUE);
					if($this->input->post('count_unit_11', TRUE)) $count_unit .="-".$this->input->post('count_unit_11', TRUE);
					$biz_start_ym = $this->input->post('biz_start_year').'-'.$this->input->post('biz_start_month');

					$update_pj_data = array(
						'pj_name' => $this->input->post('pj_name', TRUE),
						'sort' => $this->input->post('sort', TRUE),
						'local_addr' => $local_addr,
						'buy_land_extent' => $this->input->post('buy_land_extent', TRUE),
						'scheme_land_extent' => $this->input->post('scheme_land_extent', TRUE),
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
						'land_cost' => $this->input->post('land_cost', TRUE),
						'build_cost' => $this->input->post('build_cost', TRUE),
						'arc_design_cost' => $this->input->post('arc_design_cost', TRUE),
						'supervision_cost' => $this->input->post('supervision_cost', TRUE),
						'initial_inves' => $this->input->post('initial_inves', TRUE),
						'dev_agency_charge' => $this->input->post('dev_agency_charge', TRUE),
						'bridge_loan' => $this->input->post('bridge_loan', TRUE),
						'pf_loan' => $this->input->post('pf_loan', TRUE),
						'con_lead_time' => $this->input->post('con_lead_time', TRUE),
						'biz_start_ym' => $biz_start_ym
					);

					$result = $this->main_m->update_data('cms_project11_info', $update_pj_data, $where = array('seq' => $this->input->post('project')));

					if($result) { // 등록 성공 시
						alert('프로젝트 정보가  수정되었습니다.', '/m3/project/1/2/?project='.$this->input->post('project'));
						exit;
					}else{   // 등록 실패 시
						alert('데이터베이스 오류가 발생하였습니다..', '/m3/project/1/2/');
						exit;
					}
				}
			}





		// 신규 프로젝트 1. 신규등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m3_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m3_2_1'] or $auth['_m3_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m3_2_1'];

				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('pj_name', '프로젝트 명', 'required');
				$this->form_validation->set_rules('sort', '프로젝트 종류', 'required');
				$this->form_validation->set_rules('zipcode', '우편번호', 'required|numeric');
				$this->form_validation->set_rules('address1', '메인 주소', 'required');
				$this->form_validation->set_rules('address2', '상세 주소', 'max_length[93]');
				$this->form_validation->set_rules('buy_land_extent', '대지 매입면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('scheme_land_extent', '계획 대지면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('build_size', '건축 규모', 'max_length[60]');
				$this->form_validation->set_rules('num_unit', '세대(호/실) 수', 'required|numeric|max_length[6]');
				$this->form_validation->set_rules('build_area', '건축 면적', 'numeric|max_length[10]');
				$this->form_validation->set_rules('gr_floor_area', '총 연면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('on_floor_area', '지상 연면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('ba_floor_area', '지하 연면적', 'required|numeric|max_length[10]');
				$this->form_validation->set_rules('floor_ar_rat', '용적율(%)', 'required|max_length[8]');
				$this->form_validation->set_rules('bu_to_la_rat', '건폐율(%)', 'max_length[8]');
				$this->form_validation->set_rules('law_num_parking', '법정주차대수', 'numeric|max_length[6]');
				$this->form_validation->set_rules('plan_num_parking', '계획주차대수', 'numeric|max_length[6]');
				$this->form_validation->set_rules('type_name_1', '타입명(1)', 'required|max_length[10]');
				$this->form_validation->set_rules('type_color_1', '타입컬러(1)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_1', '타입수량(1)', 'required|max_length[5]');
				$this->form_validation->set_rules('count_unit_1', '수량단위(1)', 'required');
				$this->form_validation->set_rules('type_name_2', '타입명(2)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_2', '타입컬러(2)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_2', '타입수량(2)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_3', '타입명(3)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_3', '타입컬러(3)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_3', '타입수량(3)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_4', '타입명(4)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_4', '타입컬러(4)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_4', '타입수량(4)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_5', '타입명(5)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_5', '타입컬러(5)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_5', '타입수량(5)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_6', '타입명(6)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_6', '타입컬러(6)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_6', '타입수량(6)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_7', '타입명(7)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_7', '타입컬러(7)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_7', '타입수량(7)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_8', '타입명(8)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_8', '타입컬러(8)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_8', '타입수량(8)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_9', '타입명(9)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_9', '타입컬러(9)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_9', '타입수량(9)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_10', '타입명(10)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_10', '타입컬러(10)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_10', '타입수량(10)', 'max_length[5]');
				$this->form_validation->set_rules('type_name_11', '타입명(11)', 'max_length[10]');
				$this->form_validation->set_rules('type_color_11', '타입컬러(11)', 'max_length[7]');
				$this->form_validation->set_rules('type_quantity_11', '타입수량(11)', 'max_length[5]');
				$this->form_validation->set_rules('land_cost', '토지 매입비', 'numeric|max_length[10]');
				$this->form_validation->set_rules('build_cost', '평당건축비', 'numeric|max_length[5]');
				$this->form_validation->set_rules('arc_design_cost', '설계용역비', 'numeric|max_length[8]');
				$this->form_validation->set_rules('supervision_cost', '감리용역비', 'numeric|max_length[8]');
				$this->form_validation->set_rules('initial_inves', '시행사 초기투자금', 'numeric|max_length[10]');
				$this->form_validation->set_rules('dev_agency_charge', '시행대행 용역비(세대당)', 'numeric|max_length[5]');
				$this->form_validation->set_rules('bridge_loan', '브리지차입규모', 'numeric|max_length[10]');
				$this->form_validation->set_rules('pf_loan', 'PF차입규모', 'numeric|max_length[10]');
				$this->form_validation->set_rules('con_lead_time', '공사 소요기간', 'numeric|max_length[4]');
				$this->form_validation->set_rules('biz_start_year', '사업개시 년', 'numeric|max_length[4]');
				$this->form_validation->set_rules('biz_start_month', '사업개시 월', 'numeric|max_length[2]');


				if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,
					//본 페이지 로딩
					$this->load->view('/menu/m3/md2_sd1_v', $data);
				}else{
					//폼 데이타 가공
					$local_addr = $this->input->post('zipcode')."|".$this->input->post('address1')."|".$this->input->post('address2');
					$type_name = $this->input->post('type_name_1', TRUE);
					if($this->input->post('type_name_2', TRUE)) $type_name .="-".$this->input->post('type_name_2', TRUE);
					if($this->input->post('type_name_3', TRUE)) $type_name .="-".$this->input->post('type_name_3', TRUE);
					if($this->input->post('type_name_4', TRUE)) $type_name .="-".$this->input->post('type_name_4', TRUE);
					if($this->input->post('type_name_5', TRUE)) $type_name .="-".$this->input->post('type_name_5', TRUE);
					if($this->input->post('type_name_6', TRUE)) $type_name .="-".$this->input->post('type_name_6', TRUE);
					if($this->input->post('type_name_7', TRUE)) $type_name .="-".$this->input->post('type_name_7', TRUE);
					if($this->input->post('type_name_8', TRUE)) $type_name .="-".$this->input->post('type_name_8', TRUE);
					if($this->input->post('type_name_9', TRUE)) $type_name .="-".$this->input->post('type_name_9', TRUE);
					if($this->input->post('type_name_10', TRUE)) $type_name .="-".$this->input->post('type_name_10', TRUE);
					if($this->input->post('type_name_11', TRUE)) $type_name .="-".$this->input->post('type_name_11', TRUE);
					$type_color = $this->input->post('type_color_1', TRUE);
					if($this->input->post('type_color_2', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_2', TRUE);
					if($this->input->post('type_color_3', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_3', TRUE);
					if($this->input->post('type_color_4', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_4', TRUE);
					if($this->input->post('type_color_5', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_5', TRUE);
					if($this->input->post('type_color_6', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_6', TRUE);
					if($this->input->post('type_color_7', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_7', TRUE);
					if($this->input->post('type_color_8', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_8', TRUE);
					if($this->input->post('type_color_9', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_9', TRUE);
					if($this->input->post('type_color_10', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_10', TRUE);
					if($this->input->post('type_color_11', TRUE)!="#000000") $type_color .="-".$this->input->post('type_color_11', TRUE);
					$type_quantity = $this->input->post('type_quantity_1', TRUE);
					if($this->input->post('type_quantity_2', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_2', TRUE);
					if($this->input->post('type_quantity_3', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_3', TRUE);
					if($this->input->post('type_quantity_4', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_4', TRUE);
					if($this->input->post('type_quantity_5', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_5', TRUE);
					if($this->input->post('type_quantity_6', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_6', TRUE);
					if($this->input->post('type_quantity_7', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_7', TRUE);
					if($this->input->post('type_quantity_8', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_8', TRUE);
					if($this->input->post('type_quantity_9', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_9', TRUE);
					if($this->input->post('type_quantity_10', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_10', TRUE);
					if($this->input->post('type_quantity_11', TRUE)) $type_quantity .="-".$this->input->post('type_quantity_11', TRUE);
					$count_unit = $this->input->post('count_unit_1', TRUE);
					if($this->input->post('count_unit_2', TRUE)) $count_unit .="-".$this->input->post('count_unit_2', TRUE);
					if($this->input->post('count_unit_3', TRUE)) $count_unit .="-".$this->input->post('count_unit_3', TRUE);
					if($this->input->post('count_unit_4', TRUE)) $count_unit .="-".$this->input->post('count_unit_4', TRUE);
					if($this->input->post('count_unit_5', TRUE)) $count_unit .="-".$this->input->post('count_unit_5', TRUE);
					if($this->input->post('count_unit_6', TRUE)) $count_unit .="-".$this->input->post('count_unit_6', TRUE);
					if($this->input->post('count_unit_7', TRUE)) $count_unit .="-".$this->input->post('count_unit_7', TRUE);
					if($this->input->post('count_unit_8', TRUE)) $count_unit .="-".$this->input->post('count_unit_8', TRUE);
					if($this->input->post('count_unit_9', TRUE)) $count_unit .="-".$this->input->post('count_unit_9', TRUE);
					if($this->input->post('count_unit_10', TRUE)) $count_unit .="-".$this->input->post('count_unit_10', TRUE);
					if($this->input->post('count_unit_11', TRUE)) $count_unit .="-".$this->input->post('count_unit_11', TRUE);
					$biz_start_ym = $this->input->post('biz_start_year').'-'.$this->input->post('biz_start_month');

					$new_pj_data = array(
						'pj_name' => $this->input->post('pj_name', TRUE),
						'sort' => $this->input->post('sort', TRUE),
						'local_addr' => $local_addr,
						'buy_land_extent' => $this->input->post('buy_land_extent', TRUE),
						'scheme_land_extent' => $this->input->post('scheme_land_extent', TRUE),
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
						'land_cost' => $this->input->post('land_cost', TRUE),
						'build_cost' => $this->input->post('build_cost', TRUE),
						'arc_design_cost' => $this->input->post('arc_design_cost', TRUE),
						'supervision_cost' => $this->input->post('supervision_cost', TRUE),
						'initial_inves' => $this->input->post('initial_inves', TRUE),
						'dev_agency_charge' => $this->input->post('dev_agency_charge', TRUE),
						'bridge_loan' => $this->input->post('bridge_loan', TRUE),
						'pf_loan' => $this->input->post('pf_loan', TRUE),
						'con_lead_time' => $this->input->post('con_lead_time', TRUE),
						'biz_start_ym' => $biz_start_ym,
						'reg_date' => 'now()'
					);

					$result = $this->m3_m->insert_data('cms_project11_info', $new_pj_data);

					if($result) { // 등록 성공 시
						alert('프로젝트 정보가  등록되었습니다.', '/m3/project/2/1/');
						exit;
					}else{   // 등록 실패 시
						alert('데이터베이스 오류가 발생하였습니다..', '/m3/project/2/1/');
						exit;
					}
				}
			}




		// 신규 프로젝트 1. 예비검토 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m3_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m3_2_2'] or $auth['_m3_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m3_2_2'];

				//본 페이지 로딩
				$this->load->view('/menu/m3/md2_sd2_v', $data);
			}
		}
	}
}
// End of this File
