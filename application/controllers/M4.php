<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M4 extends CI_Controller {

	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url().'member/');
		}
		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m4_m'); //모델 파일 로드
		$this->load->helper('alert'); // 경고창 헤퍼 로딩
		$this->load->helper('cut_string'); // 문자열 자르기 헬퍼 로딩
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

				//본 페이지 로딩
				$this->load->view('/menu/m4/md1_sd1_v');
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
					// Excel Cash book Print
					// redirect(base_url().'static/lib/excel/excel_cash_book.php');
					$where=" (com_div>0 AND ((in_acc=no AND class2<>7) OR out_acc=no) OR (com_div IS NULL AND in_acc=no AND class2=6)) ";
					//검색어가 있을 경우
					if($sh_frm['class1']){
						if($sh_frm['class1']==1) $where.=" AND class1='1' ";
						if($sh_frm['class1']==2) $where.=" AND class1='2' ";
						if($sh_frm['class1']==3) $where.=" AND class1='3' ";
					}
					if($sh_frm['class2']) $where.=" AND class2='".$sh_frm['class2']."' ";
					if($sh_frm['s_date']) $where.=" AND deal_date>='".$sh_frm['s_date']."' ";
					if($sh_frm['e_date']) {$where.=" AND deal_date<='".$sh_frm['e_date']."' "; } //$e_add=" AND deal_date<='$sh_frm['e_date']' ";} else{$e_add="";}

					if($sh_frm['sh_text']){
						if($sh_frm['sh_con']==0) $where.=" AND (account like '%".$sh_frm['sh_text']."%' OR cont like '%".$sh_frm['sh_text']."%' OR acc like '%".$sh_frm['sh_text']."%' OR evidence like '%".$sh_frm['sh_text']."%' OR cms_capital_cash_book.worker like '%".$sh_frm['sh_text']."%') "; // 통합검색
						if($sh_frm['sh_con']==1) $where.=" AND account like '%".$sh_frm['sh_text']."%' "; // 계정과목
						if($sh_frm['sh_con']==2) $where.=" AND cont like '%".$sh_frm['sh_text']."%' "; //적요
						if($sh_frm['sh_con']==3) $where.=" AND acc like '%".$sh_frm['sh_text']."%' "; // 거래처
						if($sh_frm['sh_con']==4) $where.=" AND (in_acc like '%".$sh_frm['sh_text']."%' OR out_acc like '%".$sh_frm['sh_text']."%')  ";  //입출금처
					}
					$a['where'] = $where;
					$this->load->view('/popup/a', $a);
					//$this->db->where($where);
					//(base_url().'pc/_menu3/excel_cash_book.php?add_where='.$where);
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

				//본 페이지 로딩
				$this->load->view('/menu/m4/md1_sd3_v', $data);
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
