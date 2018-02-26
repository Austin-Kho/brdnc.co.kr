<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_m2 extends CB_Controller
{
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

		$view['s_di'] = array(
			array('집행 현황', '집행 등록', '수지 예산안'), // 첫번째 하위 메뉴
			array('문서 관리', '일정 관리', '프로세스'), // 두번째 하위 메뉴
			array('프로젝트별 예산집행 내역<구축 작업 전>', '프로젝트별 예산집행 등록<구축 작업 전>', '프로젝트별 사업수지 관리<구축 작업 전>'), // 첫번째 하위 제목
			array('프로젝트 관련 문서관리', '일정 관리 및 업무 분장<구축 작업 전>', '전체 프로세스 (등록/수정)<구축 작업 전>')      // 두번째 하위 제목
		);

		// 등록된 프로젝트 데이터
		$where = "";
		if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
		$view['pj_list'] = $this->cms_main_model->sql_result(' SELECT * FROM cb_cms_project '.$where.' ORDER BY biz_start_ym DESC ');
		$project = $view['project'] = ($this->input->get('project')) ? $this->input->get('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)
		$pj_now = $view['pj_now'] = $this->cms_main_model->data_row('cb_cms_project', array('seq' => $project)); // cb_cms_project 테이블 정보



		// 예산집행 관리 1. 집행 현황 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// $this->output->enable_profiler(TRUE); //프로파일러 보기//

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_1_1', $this->session->userdata['mem_id']);
			$view['auth11'] = $auth['_m2_1_1']; // 불러올 페이지에 보낼 조회 권한 데이터





		// 예산집행 관리 2. 집행 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_1_2', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth12'] = $auth['_m2_1_2'];





		// 예산집행 관리 3. 수지 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_1_3', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth13'] = $auth['_m2_1_3'];


			$view['diff'] = $this->cms_main_model->data_result('cb_cms_sales_con_diff', array('pj_seq'=>$project)); // 차수 데이터
			$view['type'] = explode("-", $pj_now->type_name); // 타입 데이터
			$view['area_sup'] = explode("-", $pj_now->area_sup); // 공급 면적 데이터
			$view['type_quantity'] = explode("-", $pj_now->type_quantity); // 타입별 세대수 데이터
			$view['apt_take'] = $this->cms_main_model->data_row('cb_cms_sales_price', array('pj_seq'=>$project), 'SUM(unit_price*unit_num) AS total'); // 차수 데이터







		// 프로세스 관리 1. 진행 현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_2_1', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth21'] = $auth['_m2_2_1'];





		// 프로세스 관리 2. 프로세스 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_2_2', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth22'] = $auth['_m2_2_2'];





		// 프로세스 관리 3. 일정 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {

			// 조회 등록 권한 체크
			$auth = $this->cms_main_model->auth_chk('_m2_2_3', $this->session->userdata['mem_id']);
			// 불러올 페이지에 보낼 조회 권한 데이터
			$view['auth23'] = $auth['_m2_2_3'];
		}

		/**
		 * 레이아웃을 정의합니다
		 */
		$page_title = $this->cbconfig->item('site_meta_title_main');
		$meta_description = $this->cbconfig->item('site_meta_description_main');
		$meta_keywords = $this->cbconfig->item('site_meta_keywords_main');
		$meta_author = $this->cbconfig->item('site_meta_author_main');
		$page_name = $this->cbconfig->item('site_page_name_main');

		$layoutconfig = array(
				'path' => 'cms_m2',
				'layout' => 'layout',
				'skin' => 'process_v',
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
