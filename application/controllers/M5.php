<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M5 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			echo "<meta http-equiv='Refresh' content='0; URL=".$this->config->base_url()."member/'>";
			exit;
		}

		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m5_m'); //모델 파일 로드
		$this->load->helper('alert'); // 경고창 헤퍼 로딩
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->config();
	}

	function _remap($method){ // $method 는 현재 호출된 함수
		// 헤더 include
		$this->load->view('cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_main_footer');
	}

	public function config($mdi='', $sdi=''){
		$this->output->enable_profiler(TRUE); //프로파일러 보기//

		if( !$this->uri->segment(3)) $mdi = 1; else $mdi = $this->uri->segment(3);
		if( !$this->uri->segment(4)) $sdi = 1; else $sdi = $this->uri->segment(4);

		$menu['s_di'] = array(
			array('부서 관리', '직원 관리', '거래처 정보', '계좌 관리'), // 첫번째 하위 메뉴
			array('회사 정보', '권한 관리'),                          // 두번째 하위 메뉴
			array('부서 정보 관리', '직원 정보 관리', '거래처 정보 정보', '은행계좌 관리'), // 첫번째 하위 제목
			array('회사 기본 정보', '사용자 권한관리')                                  // 두번째 하위 제목
		);

		$this->load->view('menu/m5/config_v', $menu);


		// 1. 기본정보관리 1. 부서관리 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_1'] or $auth['_m5_1_1']==0) {
				$this->load->view('no_auth');
			}else{
				$data['auth'] = $auth['_m5_1_1'];

				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');
				//$data['n'] = $this->uri->segment(4);

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = '/m5/config/1/1/';//.$data['n']; //페이징 주소
				$config['total_rows'] = $this->m5_m->com_div_list('', '', '', '', 'num');  //게시물의 전체 갯수
				$config['per_page'] = 2; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = $uri_segment =5; //페이지 번호가 위치한 세그먼트

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->uri->segment($uri_segment);

				$st1 = $this->input->post('div_code');
				$st2 = $this->input->post('div_search');

				if($page<=1 or empty($page)) { $start = 0; }else{ $start = ($page-1) * $config['per_page']; }
				$limit = $config['per_page'];

				// db[전체부서목록] 데이터 불러오기
				$data['all_div'] = $this->m5_m->all_div_name();

				//  db [부서]데이터 불러오기
				$data['list'] = $this->m5_m->com_div_list($st1, $st2, $start, $limit, '');


				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd1_v', $data);
			}



		// 1. 기본정보관리 2. 직원관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_2'] or $auth['_m5_1_2']==0) {
				$this->load->view('no_auth');
			}else{
//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');
				//$data['n'] = $this->uri->segment(4);

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = '/m5/config/1/2/';//.$data['n']; //페이징 주소
				$config['total_rows'] = $this->m5_m->com_div_list('', '', '', '', 'num');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = $uri_segment =5; //페이지 번호가 위치한 세그먼트

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->uri->segment($uri_segment);

				$st1 = $this->input->post('div_code');
				$st2 = $this->input->post('div_search');

				if($page<=1 or empty($page)) { $start = 0; }else{ $start = ($page-1) * $config['per_page']; }
				$limit = $config['per_page'];

				// db[전체부서목록] 데이터 불러오기
				$data['all_div'] = $this->m5_m->all_div_name();

				//  db [부서]데이터 불러오기
				$data['list'] = $this->m5_m->com_mem_list($st1, $st2, $start, $limit, '');

				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd2_v', $data);
			}



		// 1. 기본정보관리 3. 거래처정보 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_3', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_3'] or $auth['_m5_1_3']==0) {
				$this->load->view('no_auth');
			}else{
				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');
				//$data['n'] = $this->uri->segment(4);

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = '/m5/config/1/3/';//.$data['n']; //페이징 주소
				$config['total_rows'] = $this->m5_m->com_div_list('', '', '', '', 'num');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = $uri_segment =5; //페이지 번호가 위치한 세그먼트

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->uri->segment($uri_segment);

				$st1 = $this->input->post('div_code');
				$st2 = $this->input->post('div_search');

				if($page<=1 or empty($page)) { $start = 0; }else{ $start = ($page-1) * $config['per_page']; }
				$limit = $config['per_page'];

				// db[전체부서목록] 데이터 불러오기
				$data['all_acc'] = $this->m5_m->all_acc_name();

				//  db [부서]데이터 불러오기
				$data['list'] = $this->m5_m->com_accounts_list($st1, $st2, $start, $limit, '');

				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd3_v', $data);
			}



		// 1. 기본정보관리 4. 계좌관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==4) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_4', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_4'] or $auth['_m5_1_4']==0) {
				$this->load->view('no_auth');
			}else{
//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');
				//$data['n'] = $this->uri->segment(4);

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = '/m5/config/1/4/';//.$data['n']; //페이징 주소
				$config['total_rows'] = $this->m5_m->com_div_list('', '', '', '', 'num');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
				$config['uri_segment'] = $uri_segment =5; //페이지 번호가 위치한 세그먼트

				//페이지네이션 초기화
				$this->pagination->initialize($config);
				//페이징 링크를 생성하여 view에서 사용할 변수에 할당
				$data['pagination'] = $this->pagination->create_links();

				// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
				$page = $this->uri->segment($uri_segment);

				$st1 = $this->input->post('div_code');
				$st2 = $this->input->post('div_search');

				if($page<=1 or empty($page)) { $start = 1; }else{ $start = ($page) * $config['per_page']; }
				$limit = $config['per_page'];

				// db[전체부서목록] 데이터 불러오기
				$data['all_bank'] = $this->m5_m->all_bank_name();

				//  db [부서]데이터 불러오기
				$data['list'] = $this->m5_m->bank_account_list($st1, $st2, $start, $limit, '');

				//본 페이지 로딩
				$this->load->view('/menu/m5/md1_sd4_v', $data);
			}



		// 2. 회사정보관리 1. 회사정보 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m5_2_1'] or $auth['_m5_2_1']==0) { // 조회권한 없을 때
				$this->load->view('no_auth');                 // 권한 없음 페이지 보이기
			}else{ // 조회 이상 권한 있을 때

				// 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증

				//// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('co_name', '회사명', 'required');
				$this->form_validation->set_rules('co_no1', '사업자등록번호', 'required|numeric');
				$this->form_validation->set_rules('co_no2', '사업자등록번호', 'required|numeric');
				$this->form_validation->set_rules('co_no3', '사업자등록번호', 'required|numeric');
				$this->form_validation->set_rules('co_form', '회사형태', 'required');
				$this->form_validation->set_rules('ceo', '대표자', 'required');
				$this->form_validation->set_rules('or_no1', '법인등록번호', 'required|numeric');
				$this->form_validation->set_rules('or_no2', '법인등록번호', 'required|numeric');
				$this->form_validation->set_rules('sur', '부가세신고주기', 'required');
				$this->form_validation->set_rules('biz_cond', '업태', 'required');
				$this->form_validation->set_rules('biz_even', '종목', 'required');
				$this->form_validation->set_rules('co_phone1', '대표전화', 'required|numeric');
				$this->form_validation->set_rules('co_phone2', '대표전화', 'required|numeric');
				$this->form_validation->set_rules('co_phone3', '대표전화', 'required|numeric');
				$this->form_validation->set_rules('co_hp1', '휴대전화', 'required|numeric');
				$this->form_validation->set_rules('co_hp2', '휴대전화', 'required|numeric');
				$this->form_validation->set_rules('co_hp3', '휴대전화', 'required|numeric');
				$this->form_validation->set_rules('co_fax1', '팩스번호', 'numeric');
				$this->form_validation->set_rules('co_fax2', '팩스번호', 'numeric');
				$this->form_validation->set_rules('co_fax3', '팩스번호', 'numeric');
				$this->form_validation->set_rules('es_date', '설립일', 'required');
				$this->form_validation->set_rules('op_date', '개업일', 'required');
				$this->form_validation->set_rules('carr_y', '기초잔액입력월', 'required');
				$this->form_validation->set_rules('carr_m', '기초잔액입력월', 'required');
				$this->form_validation->set_rules('m_wo_st', '업무개시월', 'required');
				$this->form_validation->set_rules('bl_cycle', '결산주기', 'required');
				$this->form_validation->set_rules('email1', '이메일', 'required');
				$this->form_validation->set_rules('email2', '이메일', 'required');
				$this->form_validation->set_rules('tax_off1_code', '세무서1코드', 'required');
				$this->form_validation->set_rules('tax_off1_name', '세무서1이름', 'required');
				$this->form_validation->set_rules('zipcode', '우편번호', 'required|numeric');
				$this->form_validation->set_rules('address1', '주소1', 'required');
				$this->form_validation->set_rules('address2', '주소2', 'required');


				// 회사 등록 정보가 있는지 확인
				$com_chk = $this->m5_m->is_com_chk();
				if( !$com_chk) {
					$comd = array( // 없으면 등록권한 및 새로 등록하라는 변수 전달
						'auth' => $auth['_m5_2_1'],
						'mode' => 'com_reg'
					);
				}  else {
					$comd = array( // 있으면 등록권한, 등록회사정보 및 수정하라는 변수 전달
						'auth' => $auth['_m5_2_1'],
						'com' => $com_chk,
						'mode' => 'com_modify'
					);
				}

				if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,
					//본 페이지 로딩
					$this->load->view('/menu/m5/md2_sd1_v', $comd); // 조회권한 있고 폼 전송 데이타가 없을 때 등록권한 데이터 및 등록데이터와 함께 폼 열기
				}else{
					//폼 데이타 가공
					$co_no = $this->input->post('co_no1')."-".$this->input->post('co_no2')."-".$this->input->post('co_no3');
					$or_no = $this->input->post('or_no1')."-".$this->input->post('or_no2');
					$co_phone = $this->input->post('co_phone1').'-'.$this->input->post('co_phone2').'-'.$this->input->post('co_phone3');
					$co_hp = $this->input->post('co_hp1').'-'.$this->input->post('co_hp2').'-'.$this->input->post('co_hp3');
					$co_fax = $this->input->post('co_fax1').'-'.$this->input->post('co_fax2').'-'.$this->input->post('co_fax3');
					$carr = $this->input->post('carr_y').'-'.$this->input->post('carr_m');
					$email = $this->input->post('email1').'@'.$this->input->post('email2');
					$calc_mail = $this->input->post('calc_mail1').'@'.$this->input->post('calc_mail2');

					$com_data = array(
						'co_name' => $this->input->post('co_name', TRUE),
						'co_no' => $co_no,
						'co_form' => $this->input->post('co_form', TRUE),
						'ceo' => $this->input->post('ceo', TRUE),
						'or_no' => $or_no,
						'sur' => $this->input->post('sur', TRUE),
						'biz_cond' => $this->input->post('biz_cond', TRUE),
						'biz_even' => $this->input->post('biz_even', TRUE),
						'co_phone' => $co_phone,
						'co_hp' => $co_hp,
						'co_fax' => $co_fax,
						'co_div1' => $this->input->post('co_div1', TRUE),
						'co_div2' => $this->input->post('co_div2', TRUE),
						'co_div3' => $this->input->post('co_div3', TRUE),
						'es_date' => $this->input->post('es_date', TRUE),
						'op_date' => $this->input->post('op_date', TRUE),
						'carr' => $carr,
						'm_wo_st' => $this->input->post('m_wo_st', TRUE),
						'bl_cycle' => $this->input->post('bl_cycle', TRUE),
						'email' => $email,
						'calc_mail' => $calc_mail,
						'tax_off1_code' => $this->input->post('tax_off1_code', TRUE),
						'tax_off1_name' => $this->input->post('tax_off1_name', TRUE),
						'tax_off2_code' => $this->input->post('tax_off2_code', TRUE),
						'tax_off2_name' => $this->input->post('tax_off2_name', TRUE),
						'zipcode' => $this->input->post('zipcode', TRUE),
						'address1' => $this->input->post('address1', TRUE),
						'address2' => $this->input->post('address2', TRUE),
						'en_co_name' => $this->input->post('en_co_name', TRUE),
						'en_address' => $this->input->post('en_address', TRUE),
						'red_date' => 'now()'
					);

				if($comd['mode']=='com_reg') {
					$result = $this->m5_m->com_reg($com_data);
					$msg = '등록';
				}else if($comd['mode']=='com_modify') {
					$result = $this->m5_m->com_modify($com_data);
					$msg = '변경';
				}

				if($result) {
					// 등록 성공 시
					alert('회사 정보가 '.$msg.' 되었습니다.', '/m5/config/2/1/');
					exit;
				}else{ // 등록 실패 시
					// 실패 시
					alert('회사 정보'.$msg.'에 실패하였습니다.\n 다시 시도하여 주십시요.', '/m5/config/2/1/');
					exit;
				}
			}
		}



		// 2. 회사정보관리 2. 권한관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m5_2_2'] or $auth['_m5_2_2']==0) {
				$this->load->view('no_auth');
			}else{
				// 폼검증 라이브러리 로드
				$this->load->library('form_validation');

				// 폼 검증할 필드와 규칙 사전 정의
				if($this->input->post('no')) $this->form_validation->set_rules('no', '유저번호', 'required');
				if($this->input->post('user_no')) $this->form_validation->set_rules('user_no', '사용자 번호', 'required');

				if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,
					$data['auth'] = $auth['_m5_2_2'];   // 등록 권한
					$data['new_rq'] = $this->m5_m->new_rq_chk();   //  신규 등록 신청자가 있는 지 확인
					$data['user_list'] = $this->m5_m->user_list(); // 승인된 유저 목록
					$data['sel_user'] = $this->m5_m->sel_user($this->input->get('un', TRUE)); //  선택된 유저 데이터
					$data['user_auth'] = $this->m5_m->user_auth($this->input->get('un', TRUE)); //  선택된 유저의 권한 데이터

					//본 페이지 로딩
					$this->load->view('/menu/m5/md2_sd2_v', $data);
				}else{

					if($this->input->post('sf')){
						//사용자 승인//////////////////////////////////////////////
						$where_no = $this->input->post('no', TRUE);
						$auth_data = array(
							'request' => $this->input->post('sf', TRUE),
							'auth_level' => 9
						);
						$result = $this->m5_m->rq_perm($where_no, $auth_data);
						if($result){
							alert('요청하신 작업이 처리 되었습니다.', '/m5/config/2/2/');
							exit;
						}else{
							alert('데이터베이스 에러입니다. 다시 확인하여 주십시요', '/m5/config/2/2/');
							exit;
						}
						//사용자 승인//////////////////////////////////////////////
					}

					//사용자 권한 설정/////////////////////////////////////////
					if($this->input->post('_m1_1_1_m')=='on'){$_m1_1_1=2;} else if($this->input->post('_m1_1_1')=='on') {$_m1_1_1=1;} else {$_m1_1_1=0;}
					if($this->input->post('_m1_1_2_m')=='on'){$_m1_1_2=2;} else if($this->input->post('_m1_1_2')=='on') {$_m1_1_2=1;} else {$_m1_1_2=0;}
					if($this->input->post('_m1_1_3_m')=='on'){$_m1_1_3=2;} else if($this->input->post('_m1_1_3')=='on'){$_m1_1_3=1;} else {$_m1_1_3=0;}
					if($this->input->post('_m1_2_1_m')=='on'){$_m1_2_1=2;} else if($this->input->post('_m1_2_1')=='on'){$_m1_2_1=1;} else {$_m1_2_1=0;}
					if($this->input->post('_m1_2_2_m')=='on'){$_m1_2_2=2;} else if($this->input->post('_m1_2_2')=='on'){$_m1_2_2=1;} else {$_m1_2_2=0;}
					if($this->input->post('_m1_2_3_m')=='on'){$_m1_2_3=2;} else if($this->input->post('_m1_2_3')=='on'){$_m1_2_3=1;} else {$_m1_2_3=0;}

					if($this->input->post('_m2_1_1_m')=='on'){$_m2_1_1=2;} else if($this->input->post('_m2_1_1')=='on'){$_m2_1_1=1;} else {$_m2_1_1=0;}
					if($this->input->post('_m2_1_2_m')=='on'){$_m2_1_2=2;} else if($this->input->post('_m2_1_2')=='on'){$_m2_1_2=1;} else {$_m2_1_2=0;}
					if($this->input->post('_m2_1_3_m')=='on'){$_m2_1_3=2;} else if($this->input->post('_m2_1_3')=='on'){$_m2_1_3=1;} else {$_m2_1_3=0;}
					if($this->input->post('_m2_2_1_m')=='on'){$_m2_2_1=2;} else if($this->input->post('_m2_2_1')=='on'){$_m2_2_1=1;} else {$_m2_2_1=0;}
					if($this->input->post('_m2_2_2_m')=='on'){$_m2_2_2=2;} else if($this->input->post('_m2_2_2')=='on'){$_m2_2_2=1;} else {$_m2_2_2=0;}
					if($this->input->post('_m2_2_3_m')=='on'){$_m2_2_3=2;} else if($this->input->post('_m2_2_3')=='on'){$_m2_2_3=1;} else {$_m2_2_3=0;}

					if($this->input->post('_m3_1_1_m')=='on'){$_m3_1_1=2;} else if($this->input->post('_m3_1_1')=='on'){$_m3_1_1=1;} else {$_m3_1_1=0;}
					if($this->input->post('_m3_1_2_m')=='on'){$_m3_1_2=2;} else if($this->input->post('_m3_1_2')=='on'){$_m3_1_2=1;} else {$_m3_1_2=0;}
					if($this->input->post('_m3_2_1_m')=='on'){$_m3_2_1=2;} else if($this->input->post('_m3_2_1')=='on'){$_m3_2_1=1;} else {$_m3_2_1=0;}
					if($this->input->post('_m3_2_2_m')=='on'){$_m3_2_2=2;} else if($this->input->post('_m3_2_2')=='on'){$_m3_2_2=1;} else {$_m3_2_2=0;}

					if($this->input->post('_m4_1_1_m')=='on'){$_m4_1_1=2;} else if($this->input->post('_m4_1_1')=='on'){$_m4_1_1=1;} else {$_m4_1_1=0;}
					if($this->input->post('_m4_1_2_m')=='on'){$_m4_1_2=2;} else if($this->input->post('_m4_1_2')=='on'){$_m4_1_2=1;} else {$_m4_1_2=0;}
					if($this->input->post('_m4_1_3_m')=='on'){$_m4_1_3=2;} else if($this->input->post('_m4_1_3')=='on'){$_m4_1_3=1;} else {$_m4_1_3=0;}
					if($this->input->post('_m4_2_1_m')=='on'){$_m4_2_1=2;} else if($this->input->post('_m4_2_1')=='on'){$_m4_2_1=1;} else {$_m4_2_1=0;}
					if($this->input->post('_m4_2_2_m')=='on'){$_m4_2_2=2;} else if($this->input->post('_m4_2_2')=='on'){$_m4_2_2=1;} else {$_m4_2_2=0;}
					if($this->input->post('_m4_2_3_m')=='on'){$_m4_2_3=2;} else if($this->input->post('_m4_2_3')=='on'){$_m4_2_3=1;} else {$_m4_2_3=0;}

					if($this->input->post('_m5_1_1_m')=='on'){$_m5_1_1=2;} else if($this->input->post('_m5_1_1')=='on'){$_m5_1_1=1;} else {$_m5_1_1=0;}
					if($this->input->post('_m5_1_2_m')=='on'){$_m5_1_2=2;} else if($this->input->post('_m5_1_2')=='on'){$_m5_1_2=1;} else {$_m5_1_2=0;}
					if($this->input->post('_m5_1_3_m')=='on'){$_m5_1_3=2;} else if($this->input->post('_m5_1_3')=='on'){$_m5_1_3=1;} else {$_m5_1_3=0;}
					if($this->input->post('_m5_1_4_m')=='on'){$_m5_1_4=2;} else if($this->input->post('_m5_1_4')=='on'){$_m5_1_4=1;} else {$_m5_1_4=0;}
					if($this->input->post('_m5_2_1_m')=='on'){$_m5_2_1=2;} else if($this->input->post('_m5_2_1')=='on'){$_m5_2_1=1;} else {$_m5_2_1=0;}
					if($this->input->post('_m5_2_2_m')=='on'){$_m5_2_2=2;} else if($this->input->post('_m5_2_2')=='on'){$_m5_2_2=1;} else {$_m5_2_2=0;}

					$auth_dt = array(
						'user_no' => $this->input->post('user_no', TRUE),
						'user_id' => $this->input->post('user_id', TRUE),
						'_m1_1_1' => $_m1_1_1,
						'_m1_1_2' => $_m1_1_2,
						'_m1_1_3' => $_m1_1_3,
						'_m1_2_1' => $_m1_2_1,
						'_m1_2_2' => $_m1_2_2,
						'_m1_2_3' => $_m1_2_3,

						'_m2_1_1' => $_m2_1_1,
						'_m2_1_2' => $_m2_1_2,
						'_m2_1_3' => $_m2_1_3,
						'_m2_2_1' => $_m2_2_1,
						'_m2_2_2' => $_m2_2_2,
						'_m2_2_3' => $_m2_2_3,

						'_m3_1_1' => $_m3_1_1,
						'_m3_1_2' => $_m3_1_2,
						'_m3_2_1' => $_m3_2_1,
						'_m3_2_2' => $_m3_2_2,

						'_m4_1_1' => $_m4_1_1,
						'_m4_1_2' => $_m4_1_2,
						'_m4_1_3' => $_m4_1_3,
						'_m4_2_1' => $_m4_2_1,
						'_m4_2_2' => $_m4_2_2,
						'_m4_2_3' => $_m4_2_3,

						'_m5_1_1' => $_m5_1_1,
						'_m5_1_2' => $_m5_1_2,
						'_m5_1_3' => $_m5_1_3,
						'_m5_1_4' => $_m5_1_4,
						'_m5_2_1' => $_m5_2_1,
						'_m5_2_2' => $_m5_2_2
					);
					$auth_result = $this->m5_m->auth_reg($this->input->get('un'), $auth_dt);
					if($auth_result) alert('요청하신 작업이 처리되었습니다.', ''); else alert('다시 시도하여 주십시요.', '');
					//사용자 권한 설정/////////////////////////////////////////

				}// 폼 검증 로직 종료
			}// 조회 권한 분기 종료
		}// 권한관리 sdi 분기 종료
	}// config 함수 종료/
}// 클래스 종료
// End of this File
