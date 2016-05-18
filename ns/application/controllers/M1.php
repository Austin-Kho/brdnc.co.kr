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
		$this->load->helper('alert'); // 경고창 헤퍼 로딩
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
		$this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('계약 현황', '계약 등록', '동호수 현황'), // 첫번째 하위 메뉴
			array('수납 현황', '수납 등록', '수납약정'),     // 두번째 하위 메뉴
			array('프로젝트별 계약현황 [구축 작업 전]', '프로젝트별 계약등록(수정) 구축 [작업 진행 중]', '동호수 계약 현황표'),  // 첫번째 하위 제목
			array('분양대금 수납 현황 [구축 작업 전]', '분양대금 수납 등록 [구축 작업 전]', '프로젝트 타입별 수납약정 관리 [구축 작업 전]')   // 두번째 하위 제목
		);
		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('menu/m1/sales_v', $menu);



		// 계약현황 1. 계약현황 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m1_1_1'] or $auth['_m1_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_1_1'];


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

				// 등록된 프로젝트 데이터
				$where = "";
				if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
				$data['all_pj'] = $this->main_m->sql_result(' SELECT * FROM cms_project '.$where.' ORDER BY biz_start_ym DESC ');
				$project = $data['project'] = ($this->input->get('project')) ? $this->input->get('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)

				$where_add = " WHERE pj_seq='$project' "; // 프로젝트 지정 쿼리

				// 타입 데이터 불러오기
				if($this->input->get('mode')=='1'){ // 신규 등록 시
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==1) $where_add .= " AND is_hold='0' AND is_application='0' AND is_contract='0' "; // 청약 대상
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==2) $where_add .= " AND is_hold='0' AND is_contract='0' "; // 계약대상

				}else if($this->input->get('mode')=='2'){ // 변경 등록 시
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==1) $where_add .= " AND is_hold='0' AND is_application='1' "; // 청약 대상
					if($this->input->get('cont_sort1')==1 && $this->input->get('cont_sort2')==2) $where_add .= " AND is_hold='0' AND (is_application='1' OR is_contract='1') "; // 계약대상
					if($this->input->get('cont_sort1')==2 && $this->input->get('cont_sort3')==3) $where_add .= " AND is_application='1' "; // 청약 물건 (청약해지대상)
					if($this->input->get('cont_sort1')==2 && $this->input->get('cont_sort3')==4) $where_add .= " AND is_contract='1' ";     // 계약 물건 (계약해지대상)
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
						$app_data = $data['is_reg']['app_data'] = $this->main_m->sql_row(" SELECT * FROM cms_sales_application WHERE pj_seq='$project' AND disposal_div='0' AND unit_type='$now_type' AND unit_dong_ho='$dongho' "); // 청약 데이터
					}else if($unit_seq->is_contract=='1'){ // 계약 물건이면
						$cont_data1 = $data['is_reg']['cont_data1'] = $this->main_m->sql_row("  SELECT * FROM cms_sales_contract WHERE pj_seq='$project' AND type='$now_type' AND unit_dong_ho='$dongho' "); // 계약 데이터
						$cont_data2 = $data['is_reg']['cont_data2'] = $this->main_m->sql_row("  SELECT * FROM cms_sales_contractor WHERE pj_seq='$project' AND type='$now_type' AND cont_dong_ho='$dongho' "); // 계약자 데이터
					}
				}

				// 차수 데이터 불러오기
				$data['diff_no'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_diff  WHERE pj_seq='$project' ORDER BY diff_no ");

				// 분양대금 수납 계정
				$data['dep_acc'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_bank_acc WHERE pj_seq='$project' ORDER BY seq ");



				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				$this->form_validation->set_rules('project', '프로젝트', 'trim|required');
				$this->form_validation->set_rules('cont_sort1', '등록구분1', 'trim|required');
				$this->form_validation->set_rules('type', '타입', 'trim|required');
				$this->form_validation->set_rules('dong', '동', 'trim|required');
				$this->form_validation->set_rules('ho', '호수', 'trim|required');
				$this->form_validation->set_rules('custom_name', '청/계약자명', 'trim|required');
				$this->form_validation->set_rules('app_in_mon', '청약금', 'trim|numeric');
				$this->form_validation->set_rules('tel_1', '연락처[1]', 'trim|required');
				$this->form_validation->set_rules('conclu_date', '청/계약일', 'trim|required');
				$this->form_validation->set_rules('deposit_1', '계약금1', 'trim|numeric');
				$this->form_validation->set_rules('deposit_2', '계약금2', 'trim|numeric');
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
						// 1. 청약 관리 테이블 입력
						$app_arr = array(
							'pj_seq' => $this->input->post('project', TRUE),
							'applicant' => $this->input->post('custom_name', TRUE),
							'app_tel1' => $this->input->post('tel_1', TRUE),
							'app_tel2' => $this->input->post('tel_2', TRUE),
							'app_in_mon' => $this->input->post('app_in_mon', TRUE),
							'app_in_acc' => $this->input->post('app_in_acc', TRUE),
							'app_in_date' => $this->input->post('app_in_date', TRUE),
							'app_in_who' => $this->input->post('app_in_who', TRUE),
							'app_diff' => $this->input->post('diff_no', TRUE),
							'unit_seq' => $this->input->post('unit_seq', TRUE),
							'unit_type' => $this->input->post('type', TRUE),
							'unit_dong_ho' => $this->input->post('unit_dong_ho', TRUE),
							'app_date' => $this->input->post('conclu_date', TRUE),
							'due_date' => $this->input->post('due_date', TRUE),
							'note' => $this->input->post('note', TRUE)
						);
						if($this->input->post('mode')=='1'){ // 신규 청약 등록 일 때
							$add_arr = array('ini_reg_worker' => $this->session->userdata('name'));
							$app_put = array_merge($app_arr, $add_arr);
							$result = $this->main_m->insert_data('cms_sales_application', $app_put, 'ini_reg_date'); // 청약관리 테이블 데이터 입력
							if( !$result){
								alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}else{
								// 2. 동호수 관리 테이블 입력
								$where = array('type'=>$this->input->post('type'), 'dong'=>$this->input->post('dong'), 'ho'=>$this->input->post('ho'));
								$result2 = $this->main_m->update_data('cms_project_all_housing_unit', array('is_application'=>'1'), $where); // 동호수 테이블 청약상태로 변경
								if( !$result2) alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}
						}else if($this->input->post('mode')=='2'){ // 기존 청약정보 수정일 때
							$add_arr = array('last_modi_date' => date('Y-m-d'), 'last_modi_worker' => $this->session->userdata('name'));
							$app_put = array_merge($app_arr, $add_arr);
							$where = array('pj_seq'=>$project, 'unit_type' =>$this->input->post('type'), 'unit_dong_ho'=>$this->input->post('unit_dong_ho'));
							$result = $this->main_m->update_data('cms_sales_application', $app_put, $where); // 청약관리 테이블 데이터 입력
							if( !$result){
								alert('데이터베이스 에러입니다.', base_url(uri_string()));
							}
						}
						alert('청약 정보 입력이 정상 처리되었습니다.', base_url('m1/sales/1/2')."?mode=2&cont_sort1=".$this->input->post('cont_sort1')."&cont_sort2=".$this->input->post('cont_sort2')."&project=".$this->input->post('project')."&type=".$this->input->post('type')."&dong=".$this->input->post('dong')."&ho=".$this->input->post('ho'));

/////////////////////////////////////////////// 여기까지 완료 ^^
					}else if($this->input->post('cont_sort2')=='1'){ // 계약일 때
						// if(){ // 신규 계약일 때
						//    -- 계약 및 계약자 관리 테이블 인서트
						//    -- 동호수 관리 테이블 ->계약 업데이트
						//
						// }else if(){ // 기존 청약정보 수정일 때
					 	//    -- 계약 및 계약자 관리 테이블 인서트
						//    -- 청약 관리테이블 -> 계약 전환 처리 업데이트
						//    -- 동호수 관리 테이블 청약->계약 업데이트
						//
						// }else if(){ // 기존 계약정보 수정일 때
						//    -- 게약 테이블 및 계약자 테이블 업데이트
						// }

					}else if($this->input->post('cont_sort2')=='1'){ // 청약 해지일 때
						// 1. 청약 관리 테이블 해지 업데이트
						// 2. 동호수 관리 테이블 해지 상태 업데이트

					}else if($this->input->post('cont_sort2')=='1'){ // 계약 해지일 때
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

				$where = "";
				if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
				// 등록된 프로젝트 데이터
				$data['all_pj'] = $this->main_m->sql_result(' SELECT * FROM cms_project '.$where.' ORDER BY biz_start_ym DESC ');
				$project = $data['project'] = ($this->input->get('project')) ? $this->input->get('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)

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
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m1_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m1_2_2'] or $auth['_m1_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m1_2_2'];

				//본 페이지 로딩
				$this->load->view('/menu/m1/md2_sd2_v', $data);
			}






		// 1. 수납관리 3. 수납약정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {
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
