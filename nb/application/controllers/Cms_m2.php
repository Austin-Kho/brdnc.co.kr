<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_m2 extends CB_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if($this->member->is_member() === false) {
			redirect(site_url('login?url=' . urlencode(current_full_url())));
		}
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m2_model'); //모델 파일 로드
		$this->load->helper('cms_alert'); // 경고창 헤퍼 로딩


	}

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
		$this->process();
	}

	/**
	 * [sales 페이지 메인 함수]
	 * @param  string $mdi [2단계 제목]
	 * @param  string $sdi [3단계 제목]
	 * @return [type]      [description]
	 */
	public function process($mdi='', $sdi=''){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('집행 현황', '집행 등록', '수지 예산안'), // 첫번째 하위 메뉴
			array('중점 현안', '일정 관리', '프로세스'), // 두번째 하위 메뉴
			array('프로젝트별 예산집행 내역<구축 작업 전>', '프로젝트별 예산집행 등록<구축 작업 전>', '프로젝트별 사업수지 관리<구축 작업 전>'), // 첫번째 하위 제목
			array('프로세스 진행 현황<구축 작업 전>', '일정 관리 및 업무 분장<구축 작업 전>', '전체 프로세스 (등록/수정)<구축 작업 전>')      // 두번째 하위 제목
		);

		// 등록된 프로젝트 데이터
		$where = "";
		if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
		$data['all_pj'] = $this->cms_main_model->sql_result(' SELECT * FROM cb_cms_project '.$where.' ORDER BY biz_start_ym DESC ');
		$project = $data['project'] = ($this->input->get('project')) ? $this->input->get('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)

		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('/cms_views/menu/cms_m2/process_v', $menu);



		// 예산집행 관리 1. 집행 현황 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_1_1', $this->session->userdata['mem_id']);

			if( !$auth['_m2_1_1'] or $auth['_m2_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('/cms_views/no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_1_1'];

				// 프로젝트명, 타입 정보 구하기
				$pj_info = $data['pj_info'] = $this->cms_main_model->sql_row(" SELECT pj_name, type_name, type_color FROM cb_cms_project WHERE seq='$project' ");


				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m2/md1_sd1_v', $data);
			}



		// 예산집행 관리 2. 집행 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_1_2', $this->session->userdata['mem_id']);

			if( !$auth['_m2_1_2'] or $auth['_m2_1_2']==0) {
				$this->load->view('/cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_1_2'];

				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m2/md1_sd2_v', $data);
			}






		// 예산집행 관리 3. 수지 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_1_3', $this->session->userdata['mem_id']);

			if( !$auth['_m2_1_3'] or $auth['_m2_1_3']==0) {
				$this->load->view('/cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_1_3'];

				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m2/md1_sd3_v', $data);
			}



		// 프로세스 관리 1. 진행 현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_2_1', $this->session->userdata['mem_id']);

			if( !$auth['_m2_2_1'] or $auth['_m2_2_1']==0) {
				$this->load->view('/cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_2_1'];

				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m2/md2_sd1_v', $data);
			}





		// 프로세스 관리 2. 프로세스 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_2_2', $this->session->userdata['mem_id']);

			if( !$auth['_m2_2_2'] or $auth['_m2_2_2']==0) {
				$this->load->view('/cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_2_2'];

				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m2/md2_sd2_v', $data);
			}





		// 프로세스 관리 3. 일정 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_2_3', $this->session->userdata['mem_id']);

			if( !$auth['_m2_2_3'] or $auth['_m2_2_3']==0) {
				$this->load->view('/cms_views/no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_2_3'];


				//본 페이지 로딩
				$this->load->view('/cms_views/menu/cms_m2/md2_sd3_v', $data);
			}
		}
	}
}
// End of this File
