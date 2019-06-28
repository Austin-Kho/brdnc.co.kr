<?php
defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Cms_m4 extends CB_Controller
{

    /**
     * [__construct 이 클래스의 생성자]
     */
    public function __construct()
    {
        parent::__construct ();
        if ( $this->member->is_member () === false ) {
            redirect ( site_url ( 'login?url=' . urlencode ( current_full_url () ) ) );
        }
        $this->load->model ( 'cms_main_model' ); //모델 파일 로드
        $this->load->model ( 'cms_m4_model' ); //모델 파일 로드
        $this->load->helper ( 'cms_alert' ); // 경고창 헤퍼 로딩
        $this->load->helper ( 'cms_cut_string' ); // 문자열 자르기 헬퍼 로딩
    }

    /**
     * [index 클래스명 생략시 기본 실행 함수]
     * @return [type] [description]
     */
    public function index()
    {
        $this->capital ();
    }

    /**
     * [capital 페이지 메인 함수]
     * @param string $mdi [2단계 제목]
     * @param string $sdi [3단계 제목]
     * @return [type]      [description]
     */
    public function capital($mdi = '', $sdi = '')
    {
        $this->output->enable_profiler ( TRUE ); //프로파일러 보기//

        ///////////////////////////
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_main_index';
        $this->load->event ( $eventname );

        $view = array();
        $view['data'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['data']['event']['before'] = Events::trigger ( 'before', $eventname );

        $view['data']['canonical'] = site_url ();

        // 이벤트가 존재하면 실행합니다
        $view['data']['event']['before_layout'] = Events::trigger ( 'before_layout', $eventname );
        ////////////////////////

        $mdi = $this->uri->segment ( 3, 1 );
        $sdi = $this->uri->segment ( 4, 1 );

        $view['top_menu'] = $this->cms_main_model->sql_result ( "SELECT * FROM cb_menu WHERE men_parent=0 ORDER BY men_order" );
        $view['sec_menu'] = $this->cms_main_model->sql_result ( "SELECT * FROM cb_menu WHERE men_parent={$view['top_menu'][3]->men_id} ORDER BY men_order" );

        $view['s_di'] = array(
            array('자금 일보', '입출금 내역', '입출금 등록'), // 첫번째 하위 메뉴
            array('문서관리', '인사관리', '채권 채무'),                          // 두번째 하위 메뉴
            array('일일 자금 현황', '자금 입출금 내역', '입출금 등록'), // 첫번째 하위 제목
            array('채권 채무 관리', '인사 급여 관리', '수발신 문서 관리')                 // 두번째 하위 제목
        );

        // 회사 선택
        $view['company'] = $company = $this->input->get ( 'com_sel' ) ? $this->input->get ( 'com_sel' ) : 0; // 선택한 회사 고유식별 값(아이디)
        $view['com_list'] = $this->cms_main_model->sql_result ( ' SELECT * FROM cb_cms_com ' ); // 회사 목록
        if ( $company ) $view['com_now'] = $com_now = $this->cms_main_model->sql_row ( "SELECT * FROM cb_cms_com WHERE seq={$company}" );

        // 자금 현황 1. 자금일보 ////////////////////////////////////////////////////////////////////
        if ( $mdi == 1 && $sdi == 1 ) {

            // 조회 등록 권한 체크
            $auth = $this->cms_main_model->auth_chk ( '_m4_1_1', $this->session->userdata['mem_id'] );
            // 불러올 페이지에 보낼 조회 권한 데이터
            $view['auth11'] = $auth['_m4_1_1'];

            // 자금일보 검색 일자
            $view['ref_date'] = $this->input->post ( 'ref_date', TRUE );
            if ( !$this->input->post ( 'ref_date' ) ) $view['ref_date'] = date ( 'Y-m-d' );

            // 은행계좌 데이터
            $view['bank_acc'] = $this->cms_m4_model->select_data_lt ( 'cb_cms_capital_bank_account', '', '', '' );
            $view['b_acc'] = $this->cms_main_model->sql_result ( 'SELECT no, name FROM cb_cms_capital_bank_account ORDER BY no' );

            // 은행 계좌별 전일 잔고 및 금일 출납, 잔고 구하기 데이터
            for ($i = 0; $i < $view['bank_acc']['num']; $i++) {
                $view['cum_in'][$i] = $this->cms_main_model->sql_result ( "SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='" . $view['bank_acc']['result'][$i]->no . "' AND deal_date<='" . $view['ref_date'] . "' " );
                $view['date_in'][$i] = $this->cms_main_model->sql_result ( "SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='" . $view['bank_acc']['result'][$i]->no . "' AND deal_date ='" . $view['ref_date'] . "' " );
                $view['cum_ex'][$i] = $this->cms_main_model->sql_result ( "SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND out_acc='" . $view['bank_acc']['result'][$i]->no . "' AND deal_date<='" . $view['ref_date'] . "' " );
                $view['date_ex'][$i] = $this->cms_main_model->sql_result ( "SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND out_acc='" . $view['bank_acc']['result'][$i]->no . "' AND deal_date ='" . $view['ref_date'] . "' " );
            }

            // 회사 현금자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
            $cum_inc = $this->cms_main_model->sql_result ( "SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND deal_date<='" . $view['ref_date'] . "' " );
            $date_inc = $this->cms_main_model->sql_result ( "SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class1!=3 AND class2!=7) AND deal_date ='" . $view['ref_date'] . "' " );
            $date_exp = $this->cms_main_model->sql_result ( "SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND class1!=3 AND deal_date ='" . $view['ref_date'] . "' " );
            $cum_exp = $this->cms_main_model->sql_result ( "SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND deal_date<='" . $view['ref_date'] . "' " );
            $view['yd_tot'] = $cum_inc[0]->inc - $cum_exp[0]->exp - $date_inc[0]->inc + $date_exp[0]->exp;
            $view['td_inc'] = $date_inc[0]->inc;
            $view['td_exp'] = $date_exp[0]->exp;
            $view['td_tot'] = $cum_inc[0]->inc - $cum_exp[0]->exp;

            // 조합 대여금 데이터
            $view['jh_data'] = $this->cms_m4_model->select_data_lt ( 'cb_cms_capital_cash_book', 'any_jh', 'any_jh<>0', 'any_jh' );
            for ($i = 0; $i < $view['jh_data']['num']; $i++) {
                $view['jh_name'][$i] = $this->cms_main_model->sql_result ( " SELECT pj_name FROM cb_cms_project WHERE seq = '" . $view['jh_data']['result'][$i]->any_jh . "' ORDER BY seq " ); //조합명
                $view['jh_cum_in'][$i] = $this->cms_main_model->sql_result ( " SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '" . $view['jh_data']['result'][$i]->any_jh . "' AND deal_date<='" . $view['ref_date'] . "' " ); //총 회수금
                $view['jh_date_in'][$i] = $this->cms_main_model->sql_result ( " SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '" . $view['jh_data']['result'][$i]->any_jh . "' AND deal_date='" . $view['ref_date'] . "' " ); // 당일 회수
                $view['jh_cum_ex'][$i] = $this->cms_main_model->sql_result ( " SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh ='" . $view['jh_data']['result'][$i]->any_jh . "' AND deal_date<='" . $view['ref_date'] . "' " ); // 총 대여금
                $view['jh_date_ex'][$i] = $this->cms_main_model->sql_result ( " SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh = '" . $view['jh_data']['result'][$i]->any_jh . "' AND deal_date='" . $view['ref_date'] . "' " ); // 당일 대여
            }

            // 회사 현금자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
            $jh_cum_inc = $this->cms_main_model->sql_result ( " SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date<='" . $view['ref_date'] . "' " ); //총 회수금
            $jh_date_inc = $this->cms_main_model->sql_result ( " SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date='" . $view['ref_date'] . "' " ); // 당일 회수
            $jh_cum_exp = $this->cms_main_model->sql_result ( " SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date<='" . $view['ref_date'] . "' " ); // 총 대여금
            $jh_date_exp = $this->cms_main_model->sql_result ( " SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date='" . $view['ref_date'] . "' " ); // 당일 대여

            $view['jh_yd_tot'] = ($jh_cum_exp[0]->exp - $jh_cum_inc[0]->inc) + ($jh_date_exp[0]->exp - $jh_date_inc[0]->inc);
            $view['jh_td_inc'] = $jh_date_inc[0]->inc;
            $view['jh_td_exp'] = $jh_date_exp[0]->exp;
            $view['jh_td_tot'] = $jh_cum_exp[0]->exp - $jh_cum_inc[0]->inc;

            // 설정일 입금 내역
            $view['da_in'] = $this->cms_m4_model->select_data_lt ( "cb_cms_capital_cash_book", "account, cont, acc, inc, note", "(com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='" . $view['ref_date'] . "'", "", "seq_num" );

            // $aaq="SELECT SUM(inc) AS total_inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$ref_date'";
            $view['da_in_total'] = $this->cms_m4_model->da_in_total ( 'cb_cms_capital_cash_book', $view['ref_date'] );

            $da_ex_qry = "SELECT account, cont, acc, exp, note FROM cb_cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$ref_date' order by seq_num";
            $view['da_ex'] = $this->cms_m4_model->select_data_lt ( "cb_cms_capital_cash_book", "account, cont, acc, exp, note", "(com_div>0) AND (class1='2' or class1='3') AND deal_date='" . $view['ref_date'] . "'", "", "seq_num" );

            // $bbq="SELECT SUM(exp) AS total_exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$ref_date'";
            $view['da_ex_total'] = $this->cms_m4_model->da_ex_total ( 'cb_cms_capital_cash_book', $view['ref_date'] );


            // 자금 현황 2. 입출금 내역 ////////////////////////////////////////////////////////////////////
        } else if ( $mdi == 1 && $sdi == 2 ) {

            // 조회 등록 권한 체크
            $auth = $this->cms_main_model->auth_chk ( '_m4_1_2', $this->session->userdata['mem_id'] );
            $m_auth = $this->cms_main_model->master_auth_chk ();
            // 불러올 페이지에 보낼 조회 권한 데이터
            $view['auth12'] = $auth['_m4_1_2'];
            $view['m_auth'] = $m_auth;


            $view['where'] = " (cb_cms_capital_cash_book.com_seq={$company} AND com_div>0 AND ((in_acc=no AND class2<>7) OR out_acc=no) OR (com_div IS NULL AND in_acc=no AND class2=6)) ";

            // 검색어 get 데이터
            $sh_frm = array(
                'class1' => $this->input->get ( 'class1', TRUE ),
                'class2' => $this->input->get ( 'class2', TRUE ),
                's_date' => $this->input->get ( 's_date', TRUE ),
                'e_date' => $this->input->get ( 'e_date', TRUE ),
                'sh_con' => $this->input->get ( 'search_con', TRUE ),
                'sh_text' => $this->input->get ( 'search_text', TRUE )
            );

            //검색어가 있을 경우
            if ( $sh_frm['class1'] ) {
                if ( $sh_frm['class1'] == 1 ) $view['where'] .= " AND class1='1' ";
                if ( $sh_frm['class1'] == 2 ) $view['where'] .= " AND class1='2' ";
                if ( $sh_frm['class1'] == 3 ) $view['where'] .= " AND class1='3' ";
            }
            if ( $sh_frm['class2'] ) $view['where'] .= " AND class2='" . $sh_frm['class2'] . "' ";
            if ( $sh_frm['s_date'] ) $view['where'] .= " AND deal_date>='" . $sh_frm['s_date'] . "' ";
            if ( $sh_frm['e_date'] ) $view['where'] .= " AND deal_date<='" . $sh_frm['e_date'] . "' ";  //$e_add=" AND deal_date<='$sh_frm['e_date']' ";} else{$e_add="";}

            if ( $sh_frm['sh_text'] ) {
                if ( $sh_frm['sh_con'] == 0 ) $view['where'] .= " AND (account like '%" . $sh_frm['sh_text'] . "%' OR cont like '%" . $sh_frm['sh_text'] . "%' OR acc like '%" . $sh_frm['sh_text'] . "%' OR evidence like '%" . $sh_frm['sh_text'] . "%' OR cb_cms_capital_cash_book.worker like '%" . $sh_frm['sh_text'] . "%') "; // 통합검색
                if ( $sh_frm['sh_con'] == 1 ) $view['where'] .= " AND account like '%" . $sh_frm['sh_text'] . "%' "; // 계정과목
                if ( $sh_frm['sh_con'] == 2 ) $view['where'] .= " AND cont like '%" . $sh_frm['sh_text'] . "%' "; //적요
                if ( $sh_frm['sh_con'] == 3 ) $view['where'] .= " AND acc like '%" . $sh_frm['sh_text'] . "%' "; // 거래처
                if ( $sh_frm['sh_con'] == 4 ) $view['where'] .= " AND (in_acc like '%" . $sh_frm['sh_text'] . "%' OR out_acc like '%" . $sh_frm['sh_text'] . "%')  ";  //입출금처
            }

            // sql문에 적용할 테이블명 ////////////////
            $cb_table = 'cb_cms_capital_cash_book, cb_cms_capital_bank_account';

            // Excel_cach_book file 다운로드 Start
            if ( $this->input->get ( 'excel_cach_book' ) === 'ok' ) {
                $view['com_title'] = $this->cms_main_model->sql_row ( "SELECT * FROM cb_cms_com WHERE seq=" . $company );
                $view['cb_list'] = $this->cms_m4_model->cash_book_list ( $cb_table, $view['where'], '', '', '', 'ASC' );
                $this->load->view ( '/cms_views/excel/cash_book', $view );
            }

            // 페이지네이션 라이브러리 로딩 추가
            $this->load->library ( 'pagination' );

            //페이지네이션 설정/////////////////////////////////
            $config['base_url'] = base_url ( 'cms_m4/capital/1/2/' );   //페이징 주소
            $config['total_rows'] = $this->cms_m4_model->cash_book_list ( $cb_table, $view['where'], '', '', 'num', '' );  //게시물의 전체 갯수
            $config['per_page'] = 12; // 한 페이지에 표시할 게시물 수
            $config['num_links'] = 4;  // 링크 좌우로 보여질 페이지 수
            $config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트
            $config['reuse_query_string'] = TRUE; //http://example.com/index.php/test/page/20?query=search%term

            // 게시물 목록을 불러오기 위한 start / limit 값 가져오기
            $page = $this->input->get ( 'page' ); // get 방식 아닌 경우 $this->uri->segment($config['uri_segment']);
            $start = ($page <= 1 or empty( $page )) ? 0 : ($page - 1) * $config['per_page'];
            $limit = $config['per_page'];

            //페이지네이션 초기화
            $this->pagination->initialize ( $config );
            //페이징 링크를 생성하여 view에서 사용할 변수에 할당
            $view['pagination'] = $this->pagination->create_links ();

            $view['cb_list'] = $this->cms_m4_model->cash_book_list ( $cb_table, $view['where'], $start, $limit, '', 'DESC' ); // table, where, start, limit, num, order

            if ( $this->input->get ( 'del_code' ) && $this->input->get ( 'com' ) ) {
                $result = $this->cms_main_model->delete_data ( 'cb_cms_capital_cash_book', array('seq_num' => $this->input->get ( 'del_code' )) );
                if ( $result ) {
                    $ret_url = '?com_sel=' . $this->input->get ( 'com' );
                    alert ( '삭제 되었습니다.', base_url ( 'cms_m4/capital/1/2/' ) . $ret_url );
                } else {
                    alert ( '다시 시도하여 주십시요!', base_url ( 'cms_m4/capital/1/2/' ) );
                }
            }


            // 자금 현황 3. 입출금 등록 ////////////////////////////////////////////////////////////////////
        } else if ( $mdi == 1 && $sdi == 3 ) {

            // 조회 등록 권한 체크
            $auth = $this->cms_main_model->auth_chk ( '_m4_1_3', $this->session->userdata['mem_id'] );
            // 불러올 페이지에 보낼 조회 권한 데이터
            $view['auth13'] = $auth['_m4_1_3'];

            // 계정과목 데이터
            $view['d3_d11'] = $this->cms_m4_model->d3_acc ( '1' );
            $view['d3_d12'] = $this->cms_m4_model->d3_acc ( '2' );
            $view['d3_d13'] = $this->cms_m4_model->d3_acc ( '3' );
            $view['d3_d14'] = $this->cms_m4_model->d3_acc ( '4' );
            $view['d3_d15'] = $this->cms_m4_model->d3_acc ( '5' );

            // 현장 데이터
            $view['pj_dt'] = $this->cms_m4_model->pj_dt ();
            // 입출금처
            if ( $company ) $view['in_out'] = $this->cms_main_model->sql_result ( "SELECT * FROM cb_cms_capital_bank_account WHERE com_seq={$company}" );

            // 폼 검증 라이브러리 로드
            $this->load->library ( 'form_validation' ); // 폼 검증
            // 폼 검증할 필드와 규칙 사전 정의
            $this->form_validation->set_rules ( 'deal_date', '거래일자', 'required' );

            if ( $this->input->post ( 'class1_1' ) ) {
                $this->form_validation->set_rules ( 'cont_1', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_1', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_1', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_1', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_2' ) ) {
                $this->form_validation->set_rules ( 'cont_2', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_2', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_2', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_2', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_3' ) ) {
                $this->form_validation->set_rules ( 'cont_3', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_3', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_3', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_3', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_4' ) ) {
                $this->form_validation->set_rules ( 'cont_4', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_4', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_4', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_4', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_5' ) ) {
                $this->form_validation->set_rules ( 'cont_5', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_5', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_5', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_5', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_6' ) ) {
                $this->form_validation->set_rules ( 'cont_6', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_6', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_6', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_6', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_7' ) ) {
                $this->form_validation->set_rules ( 'cont_7', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_7', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_7', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_7', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_8' ) ) {
                $this->form_validation->set_rules ( 'cont_8', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_8', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_8', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_8', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_9' ) ) {
                $this->form_validation->set_rules ( 'cont_9', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_9', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_9', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_9', '수수료1', 'numeric|integer' );
            }
            if ( $this->input->post ( 'class1_10' ) ) {
                $this->form_validation->set_rules ( 'cont_10', '적요1', 'required' );
                $this->form_validation->set_rules ( 'inc_10', '입금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'exp_10', '출금액1', 'numeric|integer' );
                $this->form_validation->set_rules ( 'char2_10', '수수료1', 'numeric|integer' );
            }

            // $this->form_validation->set_rules('res_work', '담당업무', 'required');

            if ( $this->form_validation->run () !== FALSE ) {
                // form(inout_frm-post)에서 받은 데이터
                $deal_date = $this->input->post ( 'deal_date', TRUE );
                $worker = $this->session->userdata['mem_username'];

                // 본사 거래 등록 시
                $com_div = array(
                    $this->input->post ( 'com_div_1', TRUE ),
                    $this->input->post ( 'com_div_2', TRUE ),
                    $this->input->post ( 'com_div_3', TRUE ),
                    $this->input->post ( 'com_div_4', TRUE ),
                    $this->input->post ( 'com_div_5', TRUE ),
                    $this->input->post ( 'com_div_6', TRUE ),
                    $this->input->post ( 'com_div_7', TRUE ),
                    $this->input->post ( 'com_div_8', TRUE ),
                    $this->input->post ( 'com_div_9', TRUE ),
                    $this->input->post ( 'com_div_10', TRUE )
                );

                if ( !$com_div[0] ) $com_div[0] = 1;
                if ( !$com_div[1] ) $com_div[1] = 1;
                if ( !$com_div[2] ) $com_div[2] = 1;
                if ( !$com_div[3] ) $com_div[3] = 1;
                if ( !$com_div[4] ) $com_div[4] = 1;
                if ( !$com_div[5] ) $com_div[5] = 1;
                if ( !$com_div[6] ) $com_div[6] = 1;
                if ( !$com_div[7] ) $com_div[7] = 1;
                if ( !$com_div[8] ) $com_div[8] = 1;
                if ( !$com_div[9] ) $com_div[9] = 1;

                // 입출대체 구분
                $class1 = array(
                    $this->input->post ( 'class1_1', TRUE ),
                    $this->input->post ( 'class1_2', TRUE ),
                    $this->input->post ( 'class1_3', TRUE ),
                    $this->input->post ( 'class1_4', TRUE ),
                    $this->input->post ( 'class1_5', TRUE ),
                    $this->input->post ( 'class1_6', TRUE ),
                    $this->input->post ( 'class1_7', TRUE ),
                    $this->input->post ( 'class1_8', TRUE ),
                    $this->input->post ( 'class1_9', TRUE ),
                    $this->input->post ( 'class1_10', TRUE )
                );

                // 입출금 세부 구분
                $class2 = array(
                    $this->input->post ( 'class2_1', TRUE ),
                    $this->input->post ( 'class2_2', TRUE ),
                    $this->input->post ( 'class2_3', TRUE ),
                    $this->input->post ( 'class2_4', TRUE ),
                    $this->input->post ( 'class2_5', TRUE ),
                    $this->input->post ( 'class2_6', TRUE ),
                    $this->input->post ( 'class2_7', TRUE ),
                    $this->input->post ( 'class2_8', TRUE ),
                    $this->input->post ( 'class2_9', TRUE ),
                    $this->input->post ( 'class2_10', TRUE )
                );

                // 현장으로 전도금 송금시 현장 코드
                $pj_seq = array(
                    $this->input->post ( 'pj_seq_1', TRUE ),
                    $this->input->post ( 'pj_seq_2', TRUE ),
                    $this->input->post ( 'pj_seq_3', TRUE ),
                    $this->input->post ( 'pj_seq_4', TRUE ),
                    $this->input->post ( 'pj_seq_5', TRUE ),
                    $this->input->post ( 'pj_seq_6', TRUE ),
                    $this->input->post ( 'pj_seq_7', TRUE ),
                    $this->input->post ( 'pj_seq_8', TRUE ),
                    $this->input->post ( 'pj_seq_9', TRUE ),
                    $this->input->post ( 'pj_seq_10', TRUE )
                );

                // 조합 대여금 여부
                $jh_loan = array(
                    $this->input->post ( 'jh_loan_1', TRUE ),
                    $this->input->post ( 'jh_loan_2', TRUE ),
                    $this->input->post ( 'jh_loan_3', TRUE ),
                    $this->input->post ( 'jh_loan_4', TRUE ),
                    $this->input->post ( 'jh_loan_5', TRUE ),
                    $this->input->post ( 'jh_loan_6', TRUE ),
                    $this->input->post ( 'jh_loan_7', TRUE ),
                    $this->input->post ( 'jh_loan_8', TRUE ),
                    $this->input->post ( 'jh_loan_9', TRUE ),
                    $this->input->post ( 'jh_loan_10', TRUE )
                );

                // 계정과목
                $account = array(
                    $this->input->post ( 'account_1', TRUE ),
                    $this->input->post ( 'account_2', TRUE ),
                    $this->input->post ( 'account_3', TRUE ),
                    $this->input->post ( 'account_4', TRUE ),
                    $this->input->post ( 'account_5', TRUE ),
                    $this->input->post ( 'account_6', TRUE ),
                    $this->input->post ( 'account_7', TRUE ),
                    $this->input->post ( 'account_8', TRUE ),
                    $this->input->post ( 'account_9', TRUE ),
                    $this->input->post ( 'account_10', TRUE )
                );

                // 적요
                $cont = array(
                    $this->input->post ( 'cont_1', TRUE ),
                    $this->input->post ( 'cont_2', TRUE ),
                    $this->input->post ( 'cont_3', TRUE ),
                    $this->input->post ( 'cont_4', TRUE ),
                    $this->input->post ( 'cont_5', TRUE ),
                    $this->input->post ( 'cont_6', TRUE ),
                    $this->input->post ( 'cont_7', TRUE ),
                    $this->input->post ( 'cont_8', TRUE ),
                    $this->input->post ( 'cont_9', TRUE ),
                    $this->input->post ( 'cont_10', TRUE )
                );

                // 거래처
                $acc = array(
                    $this->input->post ( 'acc_1', TRUE ),
                    $this->input->post ( 'acc_2', TRUE ),
                    $this->input->post ( 'acc_3', TRUE ),
                    $this->input->post ( 'acc_4', TRUE ),
                    $this->input->post ( 'acc_5', TRUE ),
                    $this->input->post ( 'acc_6', TRUE ),
                    $this->input->post ( 'acc_7', TRUE ),
                    $this->input->post ( 'acc_8', TRUE ),
                    $this->input->post ( 'acc_9', TRUE ),
                    $this->input->post ( 'acc_10', TRUE )
                );

                // 입금계정
                $ina = array(
                    $this->input->post ( 'in_1', TRUE ),
                    $this->input->post ( 'in_2', TRUE ),
                    $this->input->post ( 'in_3', TRUE ),
                    $this->input->post ( 'in_4', TRUE ),
                    $this->input->post ( 'in_5', TRUE ),
                    $this->input->post ( 'in_6', TRUE ),
                    $this->input->post ( 'in_7', TRUE ),
                    $this->input->post ( 'in_8', TRUE ),
                    $this->input->post ( 'in_9', TRUE ),
                    $this->input->post ( 'in_10', TRUE )
                );

                // 입금액
                $inc = array(
                    $this->input->post ( 'inc_1', TRUE ), $this->input->post ( 'inc_2', TRUE ), $this->input->post ( 'inc_3', TRUE ), $this->input->post ( 'inc_4', TRUE ), $this->input->post ( 'inc_5', TRUE ),
                    $this->input->post ( 'inc_6', TRUE ), $this->input->post ( 'inc_7', TRUE ), $this->input->post ( 'inc_8', TRUE ), $this->input->post ( 'inc_9', TRUE ), $this->input->post ( 'inc_10', TRUE )
                );

                // 출금액
                $exp = array(
                    $this->input->post ( 'exp_1', TRUE ), $this->input->post ( 'exp_2', TRUE ), $this->input->post ( 'exp_3', TRUE ), $this->input->post ( 'exp_4', TRUE ), $this->input->post ( 'exp_5', TRUE ),
                    $this->input->post ( 'exp_6', TRUE ), $this->input->post ( 'exp_7', TRUE ), $this->input->post ( 'exp_8', TRUE ), $this->input->post ( 'exp_9', TRUE ), $this->input->post ( 'exp_10', TRUE )
                );

                // 출금계정(seq코드와 은행명을 분리하여 사용)
                $out[0] = explode ( "-", $this->input->post ( 'out_1', TRUE ) );
                if ( empty( $out[0][1] ) ) $out[0][1] = "";
                $out[1] = explode ( "-", $this->input->post ( 'out_2', TRUE ) );
                if ( empty( $out[1][1] ) ) $out[1][1] = "";
                $out[2] = explode ( "-", $this->input->post ( 'out_3', TRUE ) );
                if ( empty( $out[2][1] ) ) $out[2][1] = "";
                $out[3] = explode ( "-", $this->input->post ( 'out_4', TRUE ) );
                if ( empty( $out[3][1] ) ) $out[3][1] = "";
                $out[4] = explode ( "-", $this->input->post ( 'out_5', TRUE ) );
                if ( empty( $out[4][1] ) ) $out[4][1] = "";
                $out[5] = explode ( "-", $this->input->post ( 'out_6', TRUE ) );
                if ( empty( $out[5][1] ) ) $out[5][1] = "";
                $out[6] = explode ( "-", $this->input->post ( 'out_7', TRUE ) );
                if ( empty( $out[6][1] ) ) $out[6][1] = "";
                $out[7] = explode ( "-", $this->input->post ( 'out_8', TRUE ) );
                if ( empty( $out[7][1] ) ) $out[7][1] = "";
                $out[8] = explode ( "-", $this->input->post ( 'out_9', TRUE ) );
                if ( empty( $out[8][1] ) ) $out[8][1] = "";
                $out[9] = explode ( "-", $this->input->post ( 'out_10', TRUE ) );
                if ( empty( $out[9][1] ) ) $out[9][1] = "";

                $out1 = array($out[0][0], $out[1][0], $out[2][0], $out[3][0], $out[4][0], $out[5][0], $out[6][0], $out[7][0], $out[8][0], $out[9][0]); // code
                $out2 = array($out[0][1], $out[1][1], $out[2][1], $out[3][1], $out[4][1], $out[5][1], $out[6][1], $out[7][1], $out[8][1], $out[9][1]); // name

                // 증빙서류
                $evi = array($this->input->post ( 'evi_1', TRUE ), $this->input->post ( 'evi_2', TRUE ), $this->input->post ( 'evi_3', TRUE ), $this->input->post ( 'evi_4', TRUE ), $this->input->post ( 'evi_5', TRUE ), $this->input->post ( 'evi_6', TRUE ), $this->input->post ( 'evi_7', TRUE ), $this->input->post ( 'evi_8', TRUE ), $this->input->post ( 'evi_9', TRUE ), $this->input->post ( 'evi_10', TRUE ));

                // 비고
                $note = array(
                    $this->input->post ( 'note_1', TRUE ),
                    $this->input->post ( 'note_2', TRUE ),
                    $this->input->post ( 'note_3', TRUE ),
                    $this->input->post ( 'note_4', TRUE ),
                    $this->input->post ( 'note_5', TRUE ),
                    $this->input->post ( 'note_6', TRUE ),
                    $this->input->post ( 'note_7', TRUE ),
                    $this->input->post ( 'note_8', TRUE ),
                    $this->input->post ( 'note_9', TRUE ),
                    $this->input->post ( 'note_10', TRUE )
                );

                // 수수료 체크 여부 확인
                $char1 = array($this->input->post ( 'char1_1', TRUE ), $this->input->post ( 'char1_2', TRUE ), $this->input->post ( 'char1_3', TRUE ), $this->input->post ( 'char1_4', TRUE ), $this->input->post ( 'char1_5', TRUE ), $this->input->post ( 'char1_6', TRUE ), $this->input->post ( 'char1_7', TRUE ), $this->input->post ( 'char1_8', TRUE ), $this->input->post ( 'char1_9', TRUE ), $this->input->post ( 'char1_10', TRUE ));

                // 수수료 발생 시 - 적요
                $cont_1_h = cut_string ( $this->input->post ( 'cont_1_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_2_h = cut_string ( $this->input->post ( 'cont_2_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_3_h = cut_string ( $this->input->post ( 'cont_3_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_4_h = cut_string ( $this->input->post ( 'cont_4_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_5_h = cut_string ( $this->input->post ( 'cont_5_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_6_h = cut_string ( $this->input->post ( 'cont_6_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_7_h = cut_string ( $this->input->post ( 'cont_7_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_8_h = cut_string ( $this->input->post ( 'cont_8_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_9_h = cut_string ( $this->input->post ( 'cont_9_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_10_h = cut_string ( $this->input->post ( 'cont_10_h', TRUE ), 12, ".." ) . "-이체수수료";
                $cont_h = array($cont_1_h, $cont_2_h, $cont_3_h, $cont_4_h, $cont_5_h, $cont_6_h, $cont_7_h, $cont_8_h, $cont_9_h, $cont_10_h);

                // 수수료 발생 시 - 출금액
                $char2 = array($this->input->post ( 'char2_1', TRUE ), $this->input->post ( 'char2_2', TRUE ), $this->input->post ( 'char2_3', TRUE ), $this->input->post ( 'char2_4', TRUE ), $this->input->post ( 'char2_5', TRUE ), $this->input->post ( 'char2_6', TRUE ), $this->input->post ( 'char2_7', TRUE ), $this->input->post ( 'char2_8', TRUE ), $this->input->post ( 'char2_9', TRUE ), $this->input->post ( 'char2_10', TRUE ));

                for ($i = 0; $i < 10; $i++) {
                    if ( $class1[$i] > 0 && $class2[$i] > 0 ) {
                        if ( $jh_loan[$i] === null ) $jh_loan[$i] = 0;
                        // 대여/회수 시 조합을 선택하기 위한 함수
                        if ( $class2[$i] < 8 && ($jh_loan[$i] != null || $jh_loan[$i] != 0) ) {
                            $any_jh[$i] = $pj_seq[$i];
                            $pj_seq[$i] = null;
                        } else {
                            $any_jh[$i] = 0;
                        }
                        if ( $ina[$i] === null ) $ina[$i] = 0;
                        if ( $inc[$i] === null ) $inc[$i] = 0;
                        if ( $out1[$i] === null ) $out1[$i] = 0;
                        if ( $exp[$i] === null ) $exp[$i] = 0;
                        if ( $account[$i] === null ) $account[$i] = "";

                        $cash_data = array(
                            'com_seq' => $company,
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
                            'note' => $note[$i],
                            'worker' => $worker,
                            'deal_date' => $deal_date
                        );
                        $result = $this->cms_main_model->insert_data ( 'cb_cms_capital_cash_book', $cash_data );
                        if ( !$result ) {
                            alert ( '데이터베이스 오류가 발생하였습니다.', base_url ( 'cms_m4/capital/1/3/' ) );
                            exit;
                        }
                        if ( $char1[$i] == 'on' ) {
                            $char_data = array(
                                'com_seq' => $company,
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
                            $result = $this->cms_main_model->insert_data ( 'cb_cms_capital_cash_book', $char_data );
                            if ( !$result ) {
                                alert ( '데이터베이스 오류가 발생하였습니다.', base_url ( 'cms_m4/capital/1/3/' ) );
                                exit;
                            }
                        }
                    }
                }
                $ret_url = "?com_sel=" . $this->input->get ( 'com_sel' );
                alert ( '정상적으로 거래등록이 처리되었습니다.', base_url ( 'cms_m4/capital/1/2/' ) . $ret_url );
            }


            // 문서관리 1. 수신문서 ////////////////////////////////////////////////////////////////////
        } else if ( $mdi == 2 && $sdi == 1 ) {

            // 조회 등록 권한 체크
            $auth = $this->cms_main_model->auth_chk ( '_m4_2_1', $this->session->userdata['mem_id'] );
            // 불러올 페이지에 보낼 조회 권한 데이터
            $view['auth21'] = $auth['_m4_2_1'];


            // 문서관리 2. 발신문서 ////////////////////////////////////////////////////////////////////
        } else if ( $mdi == 2 && $sdi == 2 ) {

            // 조회 등록 권한 체크
            $auth = $this->cms_main_model->auth_chk ( '_m4_2_2', $this->session->userdata['mem_id'] );
            // 불러올 페이지에 보낼 조회 권한 데이터
            $view['auth22'] = $auth['_m4_2_2'];


            // 인사관리 3. 인사급여 ////////////////////////////////////////////////////////////////////
        } else if ( $mdi == 2 && $sdi == 3 ) {

            // 조회 등록 권한 체크
            $auth = $this->cms_main_model->auth_chk ( '_m4_2_3', $this->session->userdata['mem_id'] );
            // 불러올 페이지에 보낼 조회 권한 데이터
            $view['auth23'] = $auth['_m4_2_3'];
        }

        /**
         * 레이아웃을 정의합니다
         */
        $page_title = $this->cbconfig->item ( 'site_meta_title_main' );
        $meta_description = $this->cbconfig->item ( 'site_meta_description_main' );
        $meta_keywords = $this->cbconfig->item ( 'site_meta_keywords_main' );
        $meta_author = $this->cbconfig->item ( 'site_meta_author_main' );
        $page_name = $this->cbconfig->item ( 'site_page_name_main' );

        $layoutconfig = array(
            'path' => 'cms_m4',
            'layout' => 'layout',
            'skin' => 'm4_header',
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
        $view['layout'] = $this->managelayout->front ( $layoutconfig, $this->cbconfig->get_device_view_type () );
        $this->data = $view;
        $this->layout = element ( 'layout_skin_file', element ( 'layout', $view ) );
        $this->view = element ( 'view_skin_file', element ( 'layout', $view ) );
    }
}
// End of this File
