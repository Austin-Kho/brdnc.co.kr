<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M2 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member').'?returnURL='.rawurlencode(current_url()));
		}
		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m2_m'); //모델 파일 로드
		$this->load->helper('alert'); // 경고창 헤퍼 로딩
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->process();
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

	public function process($mdi='', $sdi=''){
		//$this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('집행 현황', '집행 등록', '사업 수지'), // 첫번째 하위 메뉴
			array('진행 현황', '일정 관리', '프로세스'),                          // 두번째 하위 메뉴
			array('현장별 예산집행 내역<구축 작업 전>', '현장별 예산집행 등록<구축 작업 전>', '현장별 사업수지 관리<구축 작업 전>'), // 첫번째 하위 제목
			array('현장별 조직 및 인원 현황<구축 작업 전>', '현장별 조직 및 인원 등록<구축 작업 전>', '현장 관계자 소속 관리<구축 작업 전>')                                  // 두번째 하위 제목
		);
		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('menu/m2/process_v', $menu);

		// 전도금 관리 1. 전도금 내역 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m2_1_1'] or $auth['_m2_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_1_1'];


				//본 페이지 로딩
				$this->load->view('/menu/m2/md1_sd1_v', $data);
			}






		// 전도금 관리 2. 입출내역 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m2_1_2'] or $auth['_m2_1_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_1_2'];

				//본 페이지 로딩
				$this->load->view('/menu/m2/md1_sd2_v', $data);
			}






		// 전도금 관리 3. 전도금 현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_1_3', $this->session->userdata['user_id']);

			if( !$auth['_m2_1_3'] or $auth['_m2_1_3']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_1_3'];

				//본 페이지 로딩
				$this->load->view('/menu/m2/md1_sd3_v', $data);
			}



		// 투입자원 관리 4. 인원현황 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m2_2_1'] or $auth['_m2_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_2_1'];

				//본 페이지 로딩
				$this->load->view('/menu/m2/md2_sd1_v', $data);
			}





		// 투입자원 관리 1. 인원 등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m2_2_2'] or $auth['_m2_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_2_2'];

				//본 페이지 로딩
				$this->load->view('/menu/m2/md2_sd2_v', $data);
			}





		// 투입자원 관리 1. 소속 관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m2_2_3', $this->session->userdata['user_id']);

			if( !$auth['_m2_2_3'] or $auth['_m2_2_3']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m2_2_3'];


				//본 페이지 로딩
				$this->load->view('/menu/m2/md2_sd3_v', $data);
			}
		}
	}
}
// End of this File
