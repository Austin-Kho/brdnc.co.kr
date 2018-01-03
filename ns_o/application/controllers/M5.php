<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M5 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member').'?returnURL='.rawurlencode(base_url(uri_string())));
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

	/**
	 * [_remap 헤더와 푸터 불러오기 위한 페이지로드 선행 함수]
	 * @param  [type] $method [description]
	 * @return [type]         [description]
	 */
	function _remap($method){ // $method 는 현재 호출된 함수
		// 헤더 include
		$this->load->view('cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_main_footer');
	}

	/**
	 * [config 페이지 메인 함수]
	 * @param  string $mdi [2단계 제목]
	 * @param  string $sdi [3단계 제목]
	 * @return [type]      [description]
	 */
	 public function config($mdi='', $sdi=''){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('부서 정보', '직원 정보', '거래처 정보', '계좌 정보'), // 첫번째 하위 메뉴
			array('회사 정보', '권한 관리'),                          // 두번째 하위 메뉴
			array('부서 정보 관리', '직원 정보 관리', '거래처 정보 정보', '은행계좌 관리'), // 첫번째 하위 제목
			array('회사 기본 정보', '사용자 권한관리')                                  // 두번째 하위 제목
		);
		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('menu/m5/config_v', $menu);

		// 1. 기본정보관리 1. 부서관리 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_1'] or $auth['_m5_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m5_1_1'];

				// 검색어 get 데이터
				$st1 = $this->input->get('div_sel');
				$st2 = $this->input->get('div_search');

				// model data ////////////////////////
				$div_table = 'cms_com_div';

				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('m5/config/1/1/');   //페이징 주소
				$config['total_rows'] = $this->m5_m->com_div_list($div_table, '', '', $st1, $st2, 'num');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
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

				// db[전체부서목록] 데이터 불러오기
				$data['all_div'] = $this->m5_m->all_div_name($div_table);

				//  db [부서]데이터 불러오기
				$data['list'] = $this->m5_m->com_div_list($div_table, $start, $limit, $st1, $st2, '');

				// 세부 부서데이터 - 열람(수정)모드일 경우 해당 키 값 가져오기
				if($this->input->get('seq')) $data['sel_div'] = $this->m5_m->select_data_row($div_table, $where = array('seq' => $this->input->get('seq')));

				// 폼 검증 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증
				//// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('div_code', '부서코드', 'required');
				$this->form_validation->set_rules('div_name', '부서명', 'required');
				$this->form_validation->set_rules('res_work', '담당업무', 'required');

				if($this->form_validation->run()==FALSE) {
					//본 페이지 로딩
					$this->load->view('/menu/m5/md1_sd1_v', $data);
				}else{
					$div_data = array(
						'div_code' => $this->input->post('div_code', TRUE),
						'div_name' => $this->input->post('div_name', TRUE),
						'manager' => $this->input->post('manager', TRUE),
						'div_tel' => $this->input->post('div_tel', TRUE),
						'res_work' => $this->input->post('res_work', TRUE),
						'note' => $this->input->post('note', TRUE)
					);

					if($this->input->post('mode')=='reg') {
						$result = $this->m5_m->insert_data($div_table, $div_data);
					}else if($this->input->post('mode')=='modify') {
						$result = $this->m5_m->update_data($div_table, $div_data, $where = array('seq' => $this->input->post('seq')));
					}else if($this->input->post('mode')=='del') {
						$result = $this->m5_m->delete_data($div_table, $this->input->post('seq'));
					}
					if($result){
						alert('정상적으로 처리되었습니다.', base_url('m5/config/1/1/'));
					}else{
						alert('다시 시도하여 주십시요.', base_url('m5/config/1/1/'));
					}
				}
			}



		// 1. 기본정보관리 2. 직원관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_2', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_2'] or $auth['_m5_1_2']==0) {
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m5_1_2'];

				// 검색어 get 데이터
				$st1 = $this->input->get('div_sel');
				$st2 = $this->input->get('mem_search');

				// model data ////////////////////////
				$mem_table = 'cms_com_div_mem';

				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('m5/config/1/2/');  //페이징 주소
				$config['total_rows'] = $this->m5_m->com_mem_list($mem_table, '', '', $st1, $st2, 'num');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
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

				// db[전체부서목록] 데이터 불러오기
				$data['all_div'] = $this->m5_m->all_div_name('cms_com_div');

				//  db [직원 ]데이터 불러오기
				$data['list'] = $this->m5_m->com_mem_list($mem_table, $start, $limit, $st1, $st2, '');

				// 세부 부서데이터 - 열람(수정)모드일 경우 해당 키 값 가져오기
				if($this->input->get('seq')) $data['sel_mem'] = $this->m5_m->select_data_row($mem_table, $where = array('seq' => $this->input->get('seq')));

				// 폼 검증 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증
				// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('mem_name', '(임)직원명', 'required');
				$this->form_validation->set_rules('div_name', '담당부서', 'required');
				$this->form_validation->set_rules('div_posi', '직급(책)', 'required');
				$this->form_validation->set_rules('mobile', '비상전화', 'required');
				$this->form_validation->set_rules('email', '이메일', 'required');
				$this->form_validation->set_rules('join_date', '입사일', 'required');

				if($this->form_validation->run()==FALSE) {
					//본 페이지 로딩
					$this->load->view('/menu/m5/md1_sd2_v', $data);
				}else{
					if($this->input->post('is_reti')===NULL) $is_reti = 0; else $is_reti = 1;
					if($this->input->post('reti_date')===NULL) $reti_date = 0; else $reti_date = $this->input->post('reti_date', TRUE);
					$mem_data = array(
						'com_seq' => 1,
						'div_name' => $this->input->post('div_name', TRUE),
						'div_posi' => $this->input->post('div_posi', TRUE),
						'mem_name' => $this->input->post('mem_name', TRUE),
						'dir_tel' => $this->input->post('dir_tel', TRUE),
						'mobile' => $this->input->post('mobile', TRUE),
						'email' => $this->input->post('email', TRUE),
						'id_num' => $this->input->post('id_num', TRUE),
						'join_date' => $this->input->post('join_date', TRUE),
						'is_reti' => $is_reti,
						'reti_date' => $reti_date
					);

					if($this->input->post('mode')=='reg') {
						$result = $this->m5_m->insert_data($mem_table, $mem_data);
					}else if($this->input->post('mode')=='modify') {
						$result = $this->m5_m->update_data($mem_table, $mem_data, $where = array('seq' => $this->input->post('seq')));
					}else if($this->input->post('mode')=='del') {
						$result = $this->m5_m->delete_data($mem_table, $this->input->post('seq'));
					}
					if($result){
						alert('정상적으로 처리되었습니다.', base_url('m5/config/1/2/'));
					}else{
						alert('다시 시도하여 주십시요.', base_url('m5/config/1/2/'));
					}
				}
			}



		// 1. 기본정보관리 3. 거래처정보 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_3', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_3'] or $auth['_m5_1_3']==0) {
				$this->load->view('no_auth');
			}else{
				// 조회 권한이 있는 경우
				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m5_1_3'];

				// 검색어 get 데이터
				$st1 = $this->input->get('acc_sort');
				$st2 = $this->input->get('acc_search');

				// model data ////////////////////////
				$acc_table = 'cms_accounts';

				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('m5/config/1/3/');  //페이징 주소
				$config['total_rows'] = $this->m5_m->com_accounts_list($acc_table, '', '', $st1, $st2, 'num');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
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

				//  db [거래처 ]데이터 불러오기
				$data['list'] = $this->m5_m->com_accounts_list($acc_table, $start, $limit, $st1, $st2, '');

				// 세부 거래처데이터 - 열람(수정)모드일 경우 해당 키 값 가져오기
				if($this->input->get('seq')) $data['sel_acc'] = $this->m5_m->select_data_row($acc_table, $where = array('seq' => $this->input->get('seq')));

				// 폼 검증 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증
				// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('si_name', '(임)직원명', 'required');
				$this->form_validation->set_rules('acc_cla', '담당부서', 'required');
				$this->form_validation->set_rules('main_tel', '직급(책)', 'required');

				if($this->form_validation->run()==FALSE) {
					//본 페이지 로딩
					$this->load->view('/menu/m5/md1_sd3_v', $data);
				}else{
					$tax_addr = $this->input->post('postcode1', TRUE)."-".$this->input->post('address1_1', TRUE)."-".$this->input->post('address2_1', TRUE);
					$acc_data = array(
						'si_name' => $this->input->post('si_name', TRUE),
						'acc_cla' => $this->input->post('acc_cla', TRUE),
						'main_tel' => $this->input->post('main_tel', TRUE),
						'main_fax' => $this->input->post('main_fax', TRUE),
						'main_web' => $this->input->post('main_web', TRUE),
						'web_name' => $this->input->post('web_name', TRUE),
						'res_div' => $this->input->post('res_div', TRUE),
						'res_worker' => $this->input->post('res_worker', TRUE),
						'res_mobile' => $this->input->post('res_mobile', TRUE),
						'res_email' => $this->input->post('res_email', TRUE),
						'tax_no' => $this->input->post('tax_no', TRUE),
						'tax_ceo' => $this->input->post('tax_ceo', TRUE),
						'tax_addr' => $tax_addr,
						'tax_uptae' => $this->input->post('tax_uptae', TRUE),
						'tax_jongmok' => $this->input->post('tax_jongmok', TRUE),
						'tax_worker' => $this->input->post('tax_worker', TRUE),
						'tax_email' => $this->input->post('tax_email', TRUE),
						'note' => $this->input->post('note', TRUE),
						'reg_date' =>'now()'
					);

					if($this->input->post('mode')=='reg') {
						$result = $this->m5_m->insert_data($acc_table, $acc_data);
					}else if($this->input->post('mode')=='modify') {
						$result = $this->m5_m->update_data($acc_table, $acc_data, $where = array('seq' => $this->input->post('seq')));
					}else if($this->input->post('mode')=='del') {
						$result = $this->m5_m->delete_data($acc_table, $where = array('seq' => $this->input->post('seq')));
					}
					if($result){
						alert('정상적으로 처리되었습니다.', base_url('m5/config/1/3/'));
					}else{
						alert('다시 시도하여 주십시요.', base_url('m5/config/1/3/'));
					}
				}
			}



		// 1. 기본정보관리 4. 계좌관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==4) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_1_4', $this->session->userdata['user_id']);

			if( !$auth['_m5_1_4'] or $auth['_m5_1_4']==0) {
				$this->load->view('no_auth');
			}else{
				// 조회 권한이 있는 경우
				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m5_1_4'];

				// 검색어 get 데이터
				$st1 = $this->input->get('bank_code');
				$st2 = $this->input->get('bank_search');

				// model data ////////////////////////
				$bank_table = 'cms_capital_bank_account';

				//페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = base_url('m5/config/1/4/');  //페이징 주소
				$config['total_rows'] = $this->m5_m->bank_account_list($bank_table, '', '', $st1, $st2, 'num');  //게시물의 전체 갯수
				$config['per_page'] = 10; // 한 페이지에 표시할 게시물 수
				$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
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

				// db[전체은행목록] 데이터 불러오기
				$data['com_bank'] = $this->m5_m->all_bank_name();
				//은행 디비 전체 불러오기
				$data['all_bank'] = $this->m5_m->select_data_list('cms_capital_bank_code');
				$data['all_div'] = $this->m5_m->select_data_list('cms_com_div');

				//  db [은행 ]데이터 불러오기
				$data['list'] = $this->m5_m->bank_account_list($bank_table, $start, $limit, $st1, $st2, '');

				// 세부 은행데이터 - 열람(수정)모드일 경우 해당 키 값 가져오기
				if($this->input->get('seq')) $data['sel_bank'] = $this->m5_m->select_data_row($bank_table, $where = array('no' => $this->input->get('seq')));

				// 폼 검증 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증
				// 폼 검증할 필드와 규칙 사전 정의
				$this->form_validation->set_rules('bank', '은행명', 'required');
				$this->form_validation->set_rules('name', '계좌별칭', 'required');
				$this->form_validation->set_rules('number', '계좌번호', 'required');
				$this->form_validation->set_rules('holder', '예금주', 'required');
				$this->form_validation->set_rules('open_date', '개설일자', 'required');

				if($this->form_validation->run()==FALSE) {
					//본 페이지 로딩
					$this->load->view('/menu/m5/md1_sd4_v', $data);
				}else{
					$bank_name = $this->m5_m->select_data_row('cms_capital_bank_code', $where = array('bank_code' => $this->input->post('bank_code')));
					$bank_data = array(
						'bank' => $bank_name->bank_name,
						'bank_code' => $this->input->post('bank_code', TRUE),
						'name' => $this->input->post('name', TRUE),
						'number' => $this->input->post('number', TRUE),
						'holder' => $this->input->post('holder', TRUE),
						'manager' => $this->input->post('manager', TRUE),
						'open_date' => $this->input->post('open_date', TRUE),
						'note' => $this->input->post('note', TRUE)
					);

					if($this->input->post('mode')=='reg') {
						$result = $this->m5_m->insert_data($bank_table, $bank_data);
					}else if($this->input->post('mode')=='modify') {
						$result = $this->m5_m->update_data($bank_table, $bank_data, $where = array('no' => $this->input->post('seq')));
					}else if($this->input->post('mode')=='del') {
						$result = $this->m5_m->delete_data($bank_table, $where = array('no' => $this->input->post('seq')));
					}
					if($result){
						alert('정상적으로 처리되었습니다.', base_url('m5/config/1/4/'));
					}else{
						alert('다시 시도하여 주십시요.', base_url('m5/config/1/4/'));
					}
				}
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
				$this->form_validation->set_rules('postcode1', '우편번호', 'required|numeric');
				$this->form_validation->set_rules('address1_1', '주소1', 'required');
				$this->form_validation->set_rules('address2_1', '주소2', 'required');


				// 회사 등록 정보가 있는지 확인
				$com_chk = $this->m5_m->is_com_chk();
				if( !$com_chk) {
					$data = array( // 없으면 등록권한 및 새로 등록하라는 변수 전달
						'auth' => $auth['_m5_2_1'],
						'mode' => 'com_reg'
					);
				}  else {
					$data = array( // 있으면 등록권한, 등록회사정보 및 수정하라는 변수 전달
						'auth' => $auth['_m5_2_1'],
						'com' => $com_chk,
						'mode' => 'com_modify'
					);
				}

				if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,
					//본 페이지 로딩
					$this->load->view('/menu/m5/md2_sd1_v', $data); // 조회권한 있고 폼 전송 데이타가 없을 때 등록권한 데이터 및 등록데이터와 함께 폼 열기
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
						'zipcode' => $this->input->post('postcode1', TRUE),
						'address1' => $this->input->post('address1_1', TRUE),
						'address2' => $this->input->post('address2_1', TRUE),
						'en_co_name' => $this->input->post('en_co_name', TRUE),
						'en_address' => $this->input->post('en_address', TRUE),
						'red_date' => 'now()'
					);

				if($data['mode']=='com_reg') {
					$result = $this->m5_m->insert_data('cms_com_info', $com_data);
					$msg = '등록';
				}else if($data['mode']=='com_modify') {
					$result = $this->m5_m->update_data('cms_com_info', $com_data, array('seq'=>1));
					$msg = '변경';
				}

				if($result) {
					// 등록 성공 시
					alert('회사 정보가 '.$msg.' 되었습니다.', base_url('m5/config/2/1/'));
					exit;
				}else{ // 등록 실패 시
					// 실패 시
					alert('회사 정보'.$msg.'에 실패하였습니다.\n 다시 시도하여 주십시요.', base_url('m5/config/2/1/'));
					exit;
				}
			}
		}



		// 2. 회사정보관리 2. 권한관리 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m5_2_2', $this->session->userdata['user_id']);

			if(( !$auth['_m5_2_2'] or $auth['_m5_2_2']==0) && $this->session->userdata['is_admin']!=1) {
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

					if($this->input->post('no')){
						//사용자 승인//////////////////////////////////////////////
						$where_no = $this->input->post('no', TRUE);
						$auth_data = array(
							'request' => $this->input->post('sf', TRUE),
							'auth_level' => 9
						);
						$result = $this->m5_m->rq_perm($where_no, $auth_data);
						if($result){
							alert('요청하신 작업이 정상적으로 처리 되었습니다.', base_url('m5/config/2/2/'));
							exit;
						}else{
							alert('데이터베이스 에러입니다. 다시 확인하여 주십시요', base_url('/m5/config/2/2/'));
							exit;
						}
						//사용자 승인//////////////////////////////////////////////
					}

					if($this->input->get('un')&&$this->input->post('user_no')&&$this->input->post('user_id')){
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
						if($auth_result) alert('요청하신 작업이 정상적으로 처리되었습니다.', base_url('m5/config/2/2/')."?un=".$this->input->get('un')); else alert('데이터베이스 에러입니다. 다시 시도하여 주십시요.', base_url('m5/config/2/2/'));
					}



					//사용자 권한 설정/////////////////////////////////////////

				}// 폼 검증 로직 종료
			}// 조회 권한 분기 종료
		}// 권한관리 sdi 분기 종료
	}// config 함수 종료
}// 클래스 종료
// End of this File
