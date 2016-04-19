<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M3 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member/').'?returnURL='.rawurlencode(current_url()));
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
		//$this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('데이터 등록', '데이터 수정'), // 첫번째 하위 메뉴
			array('검토 현장', '현장 등록'),                          // 두번째 하위 메뉴
			array('동호수 데이터 입력', '기본정보 수정'), // 첫번째 하위 제목
			array('프로젝트 검토 현황', '신규 프로젝트 등록')                                  // 두번째 하위 제목
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

				//본 페이지 로딩
				$this->load->view('/menu/m3/md1_sd1_v', $data);
			}

		// 프로젝트 관리 2. 데이터수정 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m3_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m3_1_2'] or $auth['_m3_1_2']==0) {
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m3_1_2'];

				//본 페이지 로딩
				$this->load->view('/menu/m3/md1_sd2_v', $data);
			}





		// 신규 프로젝트 1. 검토현장 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m3_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m3_2_1'] or $auth['_m3_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m3_2_1'];

				//본 페이지 로딩
				$this->load->view('/menu/m3/md2_sd1_v', $data);
			}





		// 신규 프로젝트 1. 현장등록 ////////////////////////////////////////////////////////////////////
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
