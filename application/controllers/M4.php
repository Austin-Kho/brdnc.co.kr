<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M4 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member/').'?returnURL='.rawurlencode(current_url()));
		}
		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m4_m'); //모델 파일 로드
		$this->load->helper('alert'); // 경고창 헤퍼 로딩
		$this->load->helper('cut_string'); // 문자열 자르기 헬퍼 로딩
		$this->load->library('excel'); // PHPExcel 라이브러리 로드

	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->capital();
	}

	/**
	 * [_remap 헤더와 푸터 불러오기 위한 선행함수]
	 * @param  [type] $method [description]
	 * @return [type]         [description]
	 */
	public function _remap($method){
		// 헤더 include
		$this->load->view('cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_main_footer');
	}

	/**
	 * [capital 페이지 메인 함수]
	 * @param  string $mdi [2단계 제목]
	 * @param  string $sdi [3단계 제목]
	 * @return [type]      [description]
	 */
	public function capital($mdi='', $sdi=''){
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		$mdi = $this->uri->segment(3, 1);
		$sdi = $this->uri->segment(4, 1);

		$menu['s_di'] = array(
			array('자금 일보', '입출금 내역', '입출금 등록'), // 첫번째 하위 메뉴
			array('분 개 장', '일·월계표', '제무 제표'),                          // 두번째 하위 메뉴
			array('자금 일보', '입출금 내역', '입출금 등록'), // 첫번째 하위 제목
			array('분 개 장', '일·월계표', '주요 제무제표')                    // 두번째 하위 제목
		);
		// 메뉴데이터 삽입 하여 메인 페이지 호출
		$this->load->view('menu/m4/capital_v', $menu);

		// 자금 현황 1. 자금일보 ////////////////////////////////////////////////////////////////////
		if($mdi==1 && $sdi==1 ){
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_1_1', $this->session->userdata['user_id']);

			if( !$auth['_m4_1_1'] or $auth['_m4_1_1']==0) { // 조회 권한이 없는 경우
				$this->load->view('no_auth');
			}else{ // 조회 권한이 있는 경우

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m4_1_1'];

				// 자금일보 검색 일자
				$data['sh_date'] = $this->input->post('sh_date', TRUE);
				if(!$this->input->post('sh_date')) $data['sh_date'] = date('Y-m-d');

				// 은행계좌 데이터
				$data['bank_acc'] = $this->m4_m->select_data_lt('cms_capital_bank_account', '', '', '');
				//$data['b_acc'] = $this->main_m->sql_result('SELECT no, name FROM cms_capital_bank_account ORDER BY no');

				// 은행 계좌별 전일 잔고 및 금일 출납, 잔고 구하기 데이터
				for($i=0; $i<$data['bank_acc']['num']; $i++) {
					$data['cum_in'][$i] = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date<='".$data['sh_date']."' ");
					$data['date_in'][$i] = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date ='".$data['sh_date']."' ");
					$data['cum_ex'][$i] = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date<='".$data['sh_date']."' ");
					$data['date_ex'][$i] = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date ='".$data['sh_date']."' ");
				}

				// 회사 현금자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
				$cum_inc = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND deal_date<='".$data['sh_date']."' ");
				$date_inc = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND deal_date ='".$data['sh_date']."' ");
				$date_exp = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND deal_date ='".$data['sh_date']."' ");
				$cum_exp = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND deal_date<='".$data['sh_date']."' ");
				$data['yd_tot'] = $cum_inc[0]->inc-$cum_exp[0]->exp-$date_inc[0]->inc+$date_exp[0]->exp;
				$data['td_inc'] = $date_inc[0]->inc;
				$data['td_exp'] = $date_exp[0]->exp;
				$data['td_tot'] = $cum_inc[0]->inc-$cum_exp[0]->exp;



				// 조합 대여금 데이터
				$data['jh_data'] = $this->m4_m->select_data_lt('cms_capital_cash_book', 'any_jh', 'any_jh<>0', 'any_jh');
				for($i=0; $i<$data['jh_data']['num']; $i++){
					$data['jh_name'][$i] = $this->main_m->sql_result(" SELECT pj_name FROM cms_project1_info WHERE seq = '".$data['jh_data']['result'][$i]->any_jh."' ORDER BY seq ");//조합명
					$data['jh_cum_in'][$i] = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '".$data['jh_data']['result'][$i]->any_jh."' AND deal_date<='".$data['sh_date']."' "); //총 회수금
					$data['jh_date_in'][$i] = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '".$data['jh_data']['result'][$i]->any_jh."' AND deal_date='".$data['sh_date']."' "); // 당일 회수
					$data['jh_cum_ex'][$i] = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh ='".$data['jh_data']['result'][$i]->any_jh."' AND deal_date<='".$data['sh_date']."' "); // 총 대여금
					$data['jh_date_ex'][$i] = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh = '".$data['jh_data']['result'][$i]->any_jh."' AND deal_date='".$data['sh_date']."' "); // 당일 대여
				}

				// 회사 현금자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
				$jh_cum_inc = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date<='".$data['sh_date']."' "); //총 회수금
				$jh_date_inc = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date='".$data['sh_date']."' "); // 당일 회수
				$jh_cum_exp = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date<='".$data['sh_date']."' "); // 총 대여금
				$jh_date_exp = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date='".$data['sh_date']."' "); // 당일 대여

				$data['jh_yd_tot'] = $jh_cum_inc[0]->inc-$jh_cum_exp[0]->exp-$jh_date_inc[0]->inc+$jh_date_exp[0]->exp;
				$data['jh_td_inc'] = $jh_date_inc[0]->inc;
				$data['jh_td_exp'] = $jh_date_exp[0]->exp;
				$data['jh_td_tot'] = $jh_cum_inc[0]->inc-$jh_cum_exp[0]->exp;



				// 설정일 입금 내역
				$data['da_in'] = $this->m4_m->select_data_lt("cms_capital_cash_book", "account, cont, acc, inc, note", "(com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='".$data['sh_date']."'", "", "seq_num");

				// $aaq="SELECT SUM(inc) AS total_inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$sh_date'";
				$data['da_in_total'] = $this->m4_m->da_in_total('cms_capital_cash_book', $data['sh_date']);

				// $da_ex_qry="SELECT account, cont, acc, exp, note FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date' order by seq_num";
				$data['da_ex'] = $this->m4_m->select_data_lt("cms_capital_cash_book", "account, cont, acc, exp, note", "(com_div>0) AND (class1='2' or class1='3') AND deal_date='".$data['sh_date']."'", "", "seq_num");

				// $bbq="SELECT SUM(exp) AS total_exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date'";
				$data['da_ex_total'] = $this->m4_m->da_ex_total('cms_capital_cash_book', $data['sh_date']);


				// Excel_pop
				if($this->input->get('daily_report')=='print') {
					redirect('/a.php');
				}else{
					//본 페이지 로딩
					$this->load->view('/menu/m4/md1_sd1_v', $data);
				}
			}






		// 자금 현황 2. 입출금 내역 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_1_2', $this->session->userdata['user_id']);
			$m_auth = $this->main_m->master_auth_chk();

			if( !$auth['_m4_1_2'] or $auth['_m4_1_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m4_1_2'];
				$data['m_auth'] = $m_auth;

				// 검색어 get 데이터
				$sh_frm = array(
					'class1' => $this->input->get('class1', TRUE),
					'class2' => $this->input->get('class2', TRUE),
					's_date' => $this->input->get('s_date', TRUE),
					'e_date' => $this->input->get('e_date', TRUE),
					'sh_con' => $this->input->get('search_con', TRUE),
					'sh_text' => $this->input->get('search_text', TRUE)
				);

				// model data ////////////////
				$cb_table = 'cms_capital_cash_book, cms_capital_bank_account';

				// 페이지네이션 라이브러리 로딩 추가
				$this->load->library('pagination');

				//페이지네이션 설정/////////////////////////////////
				$config['base_url'] = '/m4/capital/1/2/';   //페이징 주소
				$config['total_rows'] = $this->m4_m->cash_book_list($cb_table, '', '', $sh_frm, 'num');  //게시물의 전체 갯수
				$config['per_page'] = 12; // 한 페이지에 표시할 게시물 수
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

				$data['cb_list'] = $this->m4_m->cash_book_list($cb_table, $start, $limit, $sh_frm, '');

				if($this->input->get('del_code')) {
					$result = $this->m4_m->delete_data('cms_capital_cash_book', array('seq_num' => $this->input->get('del_code')));
					if($result) {
						alert('삭제 되었습니다.', '/m4/capital/1/2/');
					}else{
						alert('다시 시도하여 주십시요!', '/m4/capital/1/2/');
					}
				}

				if($this->input->get('cash_book')=='print') {
					// // Excel Cash book Print
					// // redirect(base_url().'static/lib/excel/excel_cash_book.php');
					// $where=" (com_div>0 AND ((in_acc=no AND class2<>7) OR out_acc=no) OR (com_div IS NULL AND in_acc=no AND class2=6)) ";
					// //검색어가 있을 경우
					// if($sh_frm['class1']){
					// 	if($sh_frm['class1']==1) $where.=" AND class1='1' ";
					// 	if($sh_frm['class1']==2) $where.=" AND class1='2' ";
					// 	if($sh_frm['class1']==3) $where.=" AND class1='3' ";
					// }
					// if($sh_frm['class2']) $where.=" AND class2='".$sh_frm['class2']."' ";
					// if($sh_frm['s_date']) $where.=" AND deal_date>='".$sh_frm['s_date']."' ";
					// if($sh_frm['e_date']) {$where.=" AND deal_date<='".$sh_frm['e_date']."' "; } //$e_add=" AND deal_date<='$sh_frm['e_date']' ";} else{$e_add="";}
					//
					// if($sh_frm['sh_text']){
					// 	if($sh_frm['sh_con']==0) $where.=" AND (account like '%".$sh_frm['sh_text']."%' OR cont like '%".$sh_frm['sh_text']."%' OR acc like '%".$sh_frm['sh_text']."%' OR evidence like '%".$sh_frm['sh_text']."%' OR cms_capital_cash_book.worker like '%".$sh_frm['sh_text']."%') "; // 통합검색
					// 	if($sh_frm['sh_con']==1) $where.=" AND account like '%".$sh_frm['sh_text']."%' "; // 계정과목
					// 	if($sh_frm['sh_con']==2) $where.=" AND cont like '%".$sh_frm['sh_text']."%' "; //적요
					// 	if($sh_frm['sh_con']==3) $where.=" AND acc like '%".$sh_frm['sh_text']."%' "; // 거래처
					// 	if($sh_frm['sh_con']==4) $where.=" AND (in_acc like '%".$sh_frm['sh_text']."%' OR out_acc like '%".$sh_frm['sh_text']."%')  ";  //입출금처
					// }
					// $a['where'] = $where;
					// $this->load->view('/popup/a', $a);
					// //$this->db->where($where);
					// //(base_url().'pc/_menu3/excel_cash_book.php?add_where='.$where);
				}else{
					//본 페이지 로딩
					$this->load->view('/menu/m4/md1_sd2_v', $data);
				}
			}





		// 자금 현황 3. 입출금 등록 ////////////////////////////////////////////////////////////////////
		}else if($mdi==1 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_1_3', $this->session->userdata['user_id']);

			if( !$auth['_m4_1_3'] or $auth['_m4_1_3']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m4_1_3'];

				// 계정과목 데이터
				$data['d3_d11'] = $this->m4_m->d3_acc('1');
				$data['d3_d12'] = $this->m4_m->d3_acc('2');
				$data['d3_d13'] = $this->m4_m->d3_acc('3');
				$data['d3_d14'] = $this->m4_m->d3_acc('4');
				$data['d3_d15'] = $this->m4_m->d3_acc('5');

				// 현장 데이터
				$data['pj_dt'] = $this->m4_m->pj_dt();
				// 입출금처
				$data['in_out'] = $this->m4_m->select_data_list('cms_capital_bank_account');

				// 폼 검증 라이브러리 로드
				$this->load->library('form_validation'); // 폼 검증
				//// 폼 검증할 필드와 규칙 사전 정의
				if($this->input->post('class1_1')) {
					$this->form_validation->set_rules('cont_1', '적요1', 'required');
					$this->form_validation->set_rules('inc_1', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_1', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_1', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_2')) {
					$this->form_validation->set_rules('cont_2', '적요1', 'required');
					$this->form_validation->set_rules('inc_2', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_2', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_2', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_3')) {
					$this->form_validation->set_rules('cont_3', '적요1', 'required');
					$this->form_validation->set_rules('inc_3', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_3', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_3', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_4')) {
					$this->form_validation->set_rules('cont_4', '적요1', 'required');
					$this->form_validation->set_rules('inc_4', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_4', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_4', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_5')) {
					$this->form_validation->set_rules('cont_5', '적요1', 'required');
					$this->form_validation->set_rules('inc_5', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_5', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_5', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_6')) {
					$this->form_validation->set_rules('cont_6', '적요1', 'required');
					$this->form_validation->set_rules('inc_6', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_6', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_6', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_7')) {
					$this->form_validation->set_rules('cont_7', '적요1', 'required');
					$this->form_validation->set_rules('inc_7', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_7', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_7', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_8')) {
					$this->form_validation->set_rules('cont_8', '적요1', 'required');
					$this->form_validation->set_rules('inc_8', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_8', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_8', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_9')) {
					$this->form_validation->set_rules('cont_9', '적요1', 'required');
					$this->form_validation->set_rules('inc_9', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_9', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_9', '수수료1', 'numeric|integer');
				}
				if($this->input->post('class1_10')) {
					$this->form_validation->set_rules('cont_10', '적요1', 'required');
					$this->form_validation->set_rules('inc_10', '입금액1', 'numeric|integer');
					$this->form_validation->set_rules('exp_10', '출금액1', 'numeric|integer');
					$this->form_validation->set_rules('char2_10', '수수료1', 'numeric|integer');
				}

				// $this->form_validation->set_rules('res_work', '담당업무', 'required');

				if($this->form_validation->run()==FALSE) {
					//본 페이지 로딩
					$this->load->view('/menu/m4/md1_sd3_v', $data);
				}else{
					// form(inout_frm-post)에서 받은 데이터
					$deal_date = $this->input->post('deal_date', TRUE);
					$worker = $this->session->userdata['name'];

					// 본사 거래 등록 시
					$com_div = array(
						$this->input->post('com_div_1', TRUE),
						$this->input->post('com_div_2', TRUE),
						$this->input->post('com_div_3', TRUE),
						$this->input->post('com_div_4', TRUE),
						$this->input->post('com_div_5', TRUE),
						$this->input->post('com_div_6', TRUE),
						$this->input->post('com_div_7', TRUE),
						$this->input->post('com_div_8', TRUE),
						$this->input->post('com_div_9', TRUE),
						$this->input->post('com_div_10', TRUE)
					);

					if( !$com_div[0]) $com_div[0]=1;
					if( !$com_div[1]) $com_div[1]=1;
					if( !$com_div[2]) $com_div[2]=1;
					if( !$com_div[3]) $com_div[3]=1;
					if( !$com_div[4]) $com_div[4]=1;
					if( !$com_div[5]) $com_div[5]=1;
					if( !$com_div[6]) $com_div[6]=1;
					if( !$com_div[7]) $com_div[7]=1;
					if( !$com_div[8]) $com_div[8]=1;
					if( !$com_div[9]) $com_div[9]=1;

					// 입출대체 구분
					$class1 = array(
						$this->input->post('class1_1', TRUE),
						$this->input->post('class1_2', TRUE),
						$this->input->post('class1_3', TRUE),
						$this->input->post('class1_4', TRUE),
						$this->input->post('class1_5', TRUE),
						$this->input->post('class1_6', TRUE),
						$this->input->post('class1_7', TRUE),
						$this->input->post('class1_8', TRUE),
						$this->input->post('class1_9', TRUE),
						$this->input->post('class1_10', TRUE)
					);

					// 입출금 세부 구분
					$class2 = array(
						$this->input->post('class2_1', TRUE),
						$this->input->post('class2_2', TRUE),
						$this->input->post('class2_3', TRUE),
						$this->input->post('class2_4', TRUE),
						$this->input->post('class2_5', TRUE),
						$this->input->post('class2_6', TRUE),
						$this->input->post('class2_7', TRUE),
						$this->input->post('class2_8', TRUE),
						$this->input->post('class2_9', TRUE),
						$this->input->post('class2_10', TRUE)
					);

					// 현장으로 전도금 송금시 현장 코드
					$pj_seq = array(
						$this->input->post('pj_seq_1', TRUE),
						$this->input->post('pj_seq_2', TRUE),
						$this->input->post('pj_seq_3', TRUE),
						$this->input->post('pj_seq_4', TRUE),
						$this->input->post('pj_seq_5', TRUE),
						$this->input->post('pj_seq_6', TRUE),
						$this->input->post('pj_seq_7', TRUE),
						$this->input->post('pj_seq_8', TRUE),
						$this->input->post('pj_seq_9', TRUE),
						$this->input->post('pj_seq_10', TRUE)
					);

					// 조합 대여금 여부
					$jh_loan = array(
						$this->input->post('jh_loan_1', TRUE),
						$this->input->post('jh_loan_2', TRUE),
						$this->input->post('jh_loan_3', TRUE),
						$this->input->post('jh_loan_4', TRUE),
						$this->input->post('jh_loan_5', TRUE),
						$this->input->post('jh_loan_6', TRUE),
						$this->input->post('jh_loan_7', TRUE),
						$this->input->post('jh_loan_8', TRUE),
						$this->input->post('jh_loan_9', TRUE),
						$this->input->post('jh_loan_10', TRUE)
					);

					// 계정과목
					$account = array(
						$this->input->post('account_1', TRUE),
						$this->input->post('account_2', TRUE),
						$this->input->post('account_3', TRUE),
						$this->input->post('account_4', TRUE),
						$this->input->post('account_5', TRUE),
						$this->input->post('account_6', TRUE),
						$this->input->post('account_7', TRUE),
						$this->input->post('account_8', TRUE),
						$this->input->post('account_9', TRUE),
						$this->input->post('account_10', TRUE)
					);

					// 적요
					$cont = array(
						$this->input->post('cont_1', TRUE),
						$this->input->post('cont_2', TRUE),
						$this->input->post('cont_3', TRUE),
						$this->input->post('cont_4', TRUE),
						$this->input->post('cont_5', TRUE),
						$this->input->post('cont_6', TRUE),
						$this->input->post('cont_7', TRUE),
						$this->input->post('cont_8', TRUE),
						$this->input->post('cont_9', TRUE),
						$this->input->post('cont_10', TRUE)
					);

					// 거래처
					$acc = array(
						$this->input->post('acc_1', TRUE),
						$this->input->post('acc_2', TRUE),
						$this->input->post('acc_3', TRUE),
						$this->input->post('acc_4', TRUE),
						$this->input->post('acc_5', TRUE),
						$this->input->post('acc_6', TRUE),
						$this->input->post('acc_7', TRUE),
						$this->input->post('acc_8', TRUE),
						$this->input->post('acc_9', TRUE),
						$this->input->post('acc_10', TRUE)
					);

					// 입금계정
					$ina = array(
						$this->input->post('in_1', TRUE),
						$this->input->post('in_2', TRUE),
						$this->input->post('in_3', TRUE),
						$this->input->post('in_4', TRUE),
						$this->input->post('in_5', TRUE),
						$this->input->post('in_6', TRUE),
						$this->input->post('in_7', TRUE),
						$this->input->post('in_8', TRUE),
						$this->input->post('in_9', TRUE),
						$this->input->post('in_10', TRUE)
					);

					// 입금액
					$inc = array($this->input->post('inc_1', TRUE), $this->input->post('inc_2', TRUE), $this->input->post('inc_3', TRUE), $this->input->post('inc_4', TRUE), $this->input->post('inc_5', TRUE),
								 $this->input->post('inc_6', TRUE), $this->input->post('inc_7', TRUE), $this->input->post('inc_8', TRUE), $this->input->post('inc_9', TRUE), $this->input->post('inc_10', TRUE));

					// 출금액
					$exp = array($this->input->post('exp_1', TRUE), $this->input->post('exp_2', TRUE), $this->input->post('exp_3', TRUE), $this->input->post('exp_4', TRUE), $this->input->post('exp_5', TRUE),
								 $this->input->post('exp_6', TRUE), $this->input->post('exp_7', TRUE), $this->input->post('exp_8', TRUE), $this->input->post('exp_9', TRUE), $this->input->post('exp_10', TRUE));

					// 출금계정(seq코드와 은행명을 분리하여 사용)
					$out[0] = explode("-", $this->input->post('out_1', TRUE)); if( empty($out[0][1])) $out[0][1] = "";
					$out[1] = explode("-", $this->input->post('out_2', TRUE)); if( empty($out[1][1])) $out[1][1] = "";
					$out[2] = explode("-", $this->input->post('out_3', TRUE)); if( empty($out[2][1])) $out[2][1] = "";
					$out[3] = explode("-", $this->input->post('out_4', TRUE)); if( empty($out[3][1])) $out[3][1] = "";
					$out[4] = explode("-", $this->input->post('out_5', TRUE)); if( empty($out[4][1])) $out[4][1] = "";
					$out[5] = explode("-", $this->input->post('out_6', TRUE)); if( empty($out[5][1])) $out[5][1] = "";
					$out[6] = explode("-", $this->input->post('out_7', TRUE)); if( empty($out[6][1])) $out[6][1] = "";
					$out[7] = explode("-", $this->input->post('out_8', TRUE)); if( empty($out[7][1])) $out[7][1] = "";
					$out[8] = explode("-", $this->input->post('out_9', TRUE)); if( empty($out[8][1])) $out[8][1] = "";
					$out[9] = explode("-", $this->input->post('out_10', TRUE)); if( empty($out[9][1])) $out[9][1] = "";

					$out1 = array($out[0][0] , $out[1][0], $out[2][0], $out[3][0], $out[4][0], $out[5][0], $out[6][0], $out[7][0], $out[8][0], $out[9][0]); // code
					$out2 = array($out[0][1] , $out[1][1], $out[2][1], $out[3][1], $out[4][1], $out[5][1], $out[6][1], $out[7][1], $out[8][1], $out[9][1]); // name


					// 증빙서류
					$evi = array($this->input->post('evi_1', TRUE), $this->input->post('evi_2', TRUE), $this->input->post('evi_3', TRUE), $this->input->post('evi_4', TRUE), $this->input->post('evi_5', TRUE), $this->input->post('evi_6', TRUE), $this->input->post('evi_7', TRUE), $this->input->post('evi_8', TRUE), $this->input->post('evi_9', TRUE), $this->input->post('evi_10', TRUE));

					// 수수료 체크 여부 확인
					$char1 = array($this->input->post('char1_1', TRUE), $this->input->post('char1_2', TRUE), $this->input->post('char1_3', TRUE), $this->input->post('char1_4', TRUE), $this->input->post('char1_5', TRUE), $this->input->post('char1_6', TRUE), $this->input->post('char1_7', TRUE), $this->input->post('char1_8', TRUE), $this->input->post('char1_9', TRUE), $this->input->post('char1_10', TRUE));

					// 수수료 발생 시 - 적요
					$cont_1_h = cut_string($this->input->post('cont_1_h', TRUE),12,"..")."-이체수수료";
					$cont_2_h = cut_string($this->input->post('cont_2_h', TRUE),12,"..")."-이체수수료";
					$cont_3_h = cut_string($this->input->post('cont_3_h', TRUE),12,"..")."-이체수수료";
					$cont_4_h = cut_string($this->input->post('cont_4_h', TRUE),12,"..")."-이체수수료";
					$cont_5_h = cut_string($this->input->post('cont_5_h', TRUE),12,"..")."-이체수수료";
					$cont_6_h = cut_string($this->input->post('cont_6_h', TRUE),12,"..")."-이체수수료";
					$cont_7_h = cut_string($this->input->post('cont_7_h', TRUE),12,"..")."-이체수수료";
					$cont_8_h = cut_string($this->input->post('cont_8_h', TRUE),12,"..")."-이체수수료";
					$cont_9_h = cut_string($this->input->post('cont_9_h', TRUE),12,"..")."-이체수수료";
					$cont_10_h=cut_string($this->input->post('cont_10_h', TRUE),12,"..")."-이체수수료";
					$cont_h = array($cont_1_h, $cont_2_h, $cont_3_h, $cont_4_h, $cont_5_h, $cont_6_h, $cont_7_h, $cont_8_h, $cont_9_h, $cont_10_h);

					// 수수료 발생 시 - 출금액
					$char2 = array($this->input->post('char2_1', TRUE), $this->input->post('char2_2', TRUE), $this->input->post('char2_3', TRUE), $this->input->post('char2_4', TRUE), $this->input->post('char2_5', TRUE), $this->input->post('char2_6', TRUE), $this->input->post('char2_7', TRUE), $this->input->post('char2_8', TRUE), $this->input->post('char2_9', TRUE), $this->input->post('char2_10', TRUE));

					for($i=0; $i<10; $i++){
						if($class1[$i]>0&&$class2[$i]>0){
							if($jh_loan[$i] === null) $jh_loan[$i] = 0;
							// 대여/회수 시 조합을 선택하기 위한 함수
							if($class2[$i]<8 && ($jh_loan[$i] != null || $jh_loan[$i] !=0)){
								$any_jh[$i] = $pj_seq[$i];
								$pj_seq[$i] = null;
							}else{
								$any_jh[$i] = 0;
							}
							if($ina[$i]===null) $ina[$i] = 0;
							if($inc[$i]===null) $inc[$i] = 0;
							if($out1[$i]===null) $out1[$i] = 0;
							if($exp[$i]===null) $exp[$i] = 0;
							if($account[$i]===null) $account[$i] = "";


							$cash_data = array(
								'com_div' => $com_div[$i],
								'pj_seq' => $pj_seq[$i],
								'class1' => $class1[$i],
								'class2' => $class2[$i],
								'is_jh_loan' => $jh_loan[$i],
								'any_jh' => $any_jh[$i],
								'account' => $account[$i],
								'cont' => $cont[$i],
								'acc' => $acc[$i],
								'in_acc' => $ina[$i],
								'inc' => $inc[$i],
								'out_acc' => $out1[$i],
								'exp' => $exp[$i],
								'evidence' => $evi[$i],
								'worker' => $worker,
								'deal_date' => $deal_date
							);
							$result = $this->m4_m->insert_data('cms_capital_cash_book', $cash_data);
							if( !$result) {alert('데이터베이스 오류가 발생하였습니다.', ''); exit;}
							if($char1[$i]=='on'){
								$char_data = array(
									'com_div' => $com_div[$i],
									'class1' => '2',
									'class2' => '5',
									'account' => '지급수수료',
									'cont' => $cont_h[$i],
									'acc' => $out2[$i],
									'out_acc' => $out1[$i],
									'exp' => $char2[$i],
									'evidence' => '1',
									'worker' => $worker,
									'deal_date' => $deal_date
								);
								$result = $this->m4_m->insert_data('cms_capital_cash_book', $char_data);
								if( !$result) {alert('데이터베이스 오류가 발생하였습니다.', ''); exit;}
							}
						}
					}
					alert('정상적으로 거래등록이 처리되었습니다.', '/m4/capital/1/2/');
				}
			}





		// 회계관리 1. 분개장 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==1) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_2_1', $this->session->userdata['user_id']);

			if( !$auth['_m4_2_1'] or $auth['_m4_2_1']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m4_2_1'];

				//본 페이지 로딩
				$this->load->view('/menu/m4/md2_sd1_v', $data);
			}





		// 회계관리 2. 일월계표 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==2) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_2_2', $this->session->userdata['user_id']);

			if( !$auth['_m4_2_2'] or $auth['_m4_2_2']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m4_2_2'];



				//본 페이지 로딩
				$this->load->view('/menu/m4/md2_sd2_v', $data);
			}





		// 회계관리 3. 제무제표 ////////////////////////////////////////////////////////////////////
		}else if($mdi==2 && $sdi==3) {
			// 조회 등록 권한 체크
			$auth = $this->main_m->auth_chk('_m4_2_3', $this->session->userdata['user_id']);

			if( !$auth['_m4_2_3'] or $auth['_m4_2_3']==0) {
				$this->load->view('no_auth');
			}else{

				// 불러올 페이지에 보낼 조회 권한 데이터
				$data['auth'] = $auth['_m4_2_3'];

				//본 페이지 로딩
				$this->load->view('/menu/m4/md2_sd3_v', $data);
			}
		}
	}
}
// End of this File
