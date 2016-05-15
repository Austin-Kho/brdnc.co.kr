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
			array('프로젝트별 계약현황<구축 작업 전>', '프로젝트별 계약등록(수정)<구축 작업 진행 중>', '동호수 계약 현황표'),  // 첫번째 하위 제목
			array('분양대금 수납 현황<구축 작업 전>', '분양대금 수납 등록<구축 작업 전>', '프로젝트 타입별 수납약정 관리<구축 작업 전>')   // 두번째 하위 제목
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
				if($this->input->post('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->post('yr')."%' ";
				$data['all_pj'] = $this->main_m->sql_result(' SELECT * FROM cms_project '.$where.' ORDER BY biz_start_ym DESC ');
				$project = $data['project'] = $this->input->post('project'); // 선택한 프로젝트 고유식별 값(아이디)

				$where_add = " WHERE pj_seq='$project' ";

				// 차수 데이터 불러오기
				$data['diff_no'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_diff  $where_add ORDER BY diff_no ");

				// 타입 데이터 불러오기
				if( !$this->input->get('mode') && $this->input->post('cont_sort1')==1&&($this->input->post('cont_sort2')==1)) $where_add .= " AND is_hold='0' AND is_application='0' AND is_contract='0' "; // 청약 대상
				if( !$this->input->get('mode') && $this->input->post('cont_sort1')==1&&($this->input->post('cont_sort2')==2)) $where_add .= " AND is_hold='0' AND is_contract='0' "; // 계약대상
				if( !$this->input->get('mode') && $this->input->post('cont_sort1')==2&&$this->input->post('cont_sort3')==3) $where_add .= " AND is_application='1' "; // 청약 물건 (청약해지대상)
				if( !$this->input->get('mode') && $this->input->post('cont_sort1')==2&&$this->input->post('cont_sort3')==4) $where_add .= " AND is_contract='1' ";     // 계약 물건 (계약해지대상)
				// 청약 / 계약 분기 후 각 해당 데이터 Key 값 가져온다.
				//if($this->input->get('mode')=="modi")  $where_add .= " AND con_no = '$mo_row[con_no]' ";

				$data['type'] = $this->main_m->sql_result("SELECT type FROM cms_project_all_housing_unit $where_add GROUP BY type ORDER BY type");

				// 동 데이터 불러오기
				$tp = $this->input->post('type');
				if($this->input->post('type')) $where_add .= " AND type='$tp' ";
				$data['dong'] = $this->main_m->sql_result("SELECT dong FROM cms_project_all_housing_unit $where_add GROUP BY dong ORDER BY dong");

				// 호수 데이터 불러오기
				$dg = $this->input->post('dong');
				if($this->input->post('dong')) $where_add .= " AND dong='$dg' ";
				$data['ho'] = $this->main_m->sql_result("SELECT ho FROM cms_project_all_housing_unit $where_add GROUP BY ho ORDER BY ho");

				// 타입 동호수 텍스트
				$data['dong_ho'] =
				($this->input->post('type') && $this->input->post('dong') && $this->input->post('ho'))
				? "<span class='glyphicon glyphicon-home' aria-hidden='true' style='padding-right: 10px;'></span><font color='#b81681'><b>[".$this->input->post('type')." 타입]</font> &nbsp;".$this->input->post('dong') ." <font color='#817F7F'>동</font> ". $this->input->post('ho')." <font color='#817F7F'>호</b></font>"
				: "";

				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				// $this->form_validation->set_rules('mode', '입력수정구분', 'required');
				// $this->form_validation->set_rules('project', '프로젝트', 'required');
				// $this->form_validation->set_rules('diff_no', '차수', 'required');
				// $this->form_validation->set_rules('cont_sort1', '계약해지여부', 'required');
				// $this->form_validation->set_rules('cont_sort2', '청약계약여부', 'required');
				// $this->form_validation->set_rules('cont_sort3', '청계약해지여부', 'required');
				// $this->form_validation->set_rules('type', '타입', 'required');
				// $this->form_validation->set_rules('dong', '동', 'required');
				// $this->form_validation->set_rules('ho', '호수', 'required');

				//project_
				// diff_no_
				// cont_sort1_
				//cont_sort2_
				// cont_sort3_
				//type_
				// dong_
				// ho_
				// con_no_

				$this->form_validation->set_rules('custom_name', '청/계약자명', 'trim|required');
				$this->form_validation->set_rules('app_money', '청약금', 'trim|numeric');
				// $this->form_validation->set_rules('app_acc', '청약금입금계정', 'trim');
				$this->form_validation->set_rules('tel_1', '연락처[1]', 'trim|required');
				// $this->form_validation->set_rules('tel_2', '연락처[2]', 'trim');
				$this->form_validation->set_rules('conclu_date', '청/계약일', 'trim|required');
				// $this->form_validation->set_rules('cont_due_date', '계약예정일', 'trim');
				$this->form_validation->set_rules('deposit_1', '계약금1', 'trim|numeric');
				// $this->form_validation->set_rules('dep_acc_1', '계약금1계정', 'trim');
				$this->form_validation->set_rules('deposit_2', '계약금2', 'trim|numeric');
				// $this->form_validation->set_rules('dep_acc_2', '계약금2계정', 'trim');
				$this->form_validation->set_rules('zipcode', '우편변호1', 'trim|numeric|max_length[5]');
				$this->form_validation->set_rules('address1', '메인주소1', 'trim|max_length[100]');
				$this->form_validation->set_rules('address2', '세부주소1', 'trim|max_length[50]');
				$this->form_validation->set_rules('zipcode_', '우편번호2', 'trim|numeric|max_length[5]');
				$this->form_validation->set_rules('address1_', '메인주소2', 'trim|max_length[100]');
				$this->form_validation->set_rules('address2_', '세부주소2', 'trim|max_length[50]');
				// $this->form_validation->set_rules('incom_doc_1', '미비서류1', 'trim|required');
				// $this->form_validation->set_rules('incom_doc_2', '미비서류2', 'trim|required');
				// $this->form_validation->set_rules('incom_doc_3', '미비서류3', 'trim|required');
				// $this->form_validation->set_rules('incom_doc_4', '미비서류4', 'trim|required');
				// $this->form_validation->set_rules('incom_doc_5', '미비서류5', 'trim|required');
				// $this->form_validation->set_rules('incom_doc_6', '미비서류6', 'trim|required');
				// $this->form_validation->set_rules('incom_doc_7', '미비서류7', 'trim|required');
				// $this->form_validation->set_rules('incom_doc_8', '미비서류8', 'trim|required');
				$this->form_validation->set_rules('note', '비고', 'trim|max_length[200]');

				if($this->form_validation->run() == FALSE) {

					//본 페이지 로딩
					$this->load->view('/menu/m1/md1_sd2_v', $data);
				}else{

					$reg_data = array(
						'a' => 'a'
					);

					if($this->input->post('mode')=='new'){ // 신규 등록 시
						if($this->input->post('cont_sort2')=='1'){ // 청약 시



						}else if($this->input->post('cont_sort2')=='2'){ // 계약 시



						}




					}else if($this->input->post('mode')=='modi'){ // 수정 등록 시
						if($this->input->post('cont_sort2')=='1'){ // 청약 시



						}else if($this->input->post('cont_sort2')=='2'){ // 계약 시



						}else if($this->input->post('cont_sort3')=='3'){ // 청약 해지 시



						}else if($this->input->post('cont_sort3')=='4'){ // 계약 해지 시



						}




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
