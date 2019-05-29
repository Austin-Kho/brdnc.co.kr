<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Main class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 메인 페이지를 담당하는 controller 입니다.
 */
class Main extends CB_Controller
{
    /**
     * 모델을 로딩합니다 // 보드 용
     */
    protected $models = array('Board');

    /**
     * 헬퍼를 로딩합니다 // 보드 용
     */
    protected $helpers = array('form', 'array');

    function __construct()
    {
        parent::__construct();
        if($this->member->is_member() === false) {
    			redirect(site_url('login?url=' . urlencode(current_full_url())));
    		}

        $this->load->library(array('querystring')); // 라이브러리를 로딩합니다.
        $this->load->model('cms_main_model'); //모델 파일 로드
    }


    /**
     * 전체 메인 페이지입니다
     */
    public function index()
    {
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_main_index';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $where = array(
            'brd_search' => 1,
        );
        $board_id = $view['board_id'] = $this->Board_model->get_board_list($where);
        $board_list = array();
        if ($board_id && is_array($board_id)) {
            foreach ($board_id as $key => $val) {
                $board_list[] = $this->board->item_all(element('brd_id', $val));
            }
        }
        $view['view']['board_list'] = $board_list;
        $view['view']['canonical'] = site_url();

        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        /**
         * 레이아웃을 정의합니다
         */
        $page_title = $this->cbconfig->item('site_meta_title_main');
        $meta_description = $this->cbconfig->item('site_meta_description_main');
        $meta_keywords = $this->cbconfig->item('site_meta_keywords_main');
        $meta_author = $this->cbconfig->item('site_meta_author_main');
        $page_name = $this->cbconfig->item('site_page_name_main');

        $layoutconfig = array(
            'path' => 'main',
            'layout' => 'layout',
            'skin' => 'main',
            'layout_dir' => $this->cbconfig->item('layout_main'),
            'mobile_layout_dir' => $this->cbconfig->item('mobile_layout_main'),
            'use_sidebar' => $this->cbconfig->item('sidebar_main'),
            'use_mobile_sidebar' => $this->cbconfig->item('mobile_sidebar_main'),
            'skin_dir' => $this->cbconfig->item('skin_main'),
            'mobile_skin_dir' => $this->cbconfig->item('mobile_skin_main'),
            'page_title' => $page_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'meta_author' => $meta_author,
            'page_name' => $page_name,
        );

        /**
         * [$say_num description]
         * @var [type]
         */
        $say_num = $this->cms_main_model->sql_num_rows(" SELECT seq FROM cb_cms_wise_saying ");
		$now_num = mt_rand(1, $say_num);
		$view['saying'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_wise_saying WHERE seq='$now_num' ");

		$config_date = date('Y-m-d', strtotime('-7 day'));
		$view['app_7day'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_application WHERE disposal_div='0' AND app_date>='$config_date' "); // 최근 7일 청약 건수
		$view['cont_7day'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_contract WHERE is_rescission='0' AND cont_date>='$config_date' "); // 최근 7일 계약 건수

		$view['app_num'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_application WHERE disposal_div='0' "); // 전체 청약 건수
		$view['cont_num'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_contract WHERE is_rescission='0' "); // 전체 계약 건수

		$view['receive'] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS receive FROM cb_cms_sales_received WHERE pj_seq='1' AND pay_sche_code!='2' AND pay_sche_code!='4' AND is_refund='0' "); // 분담금 수납금 총액
		$view['agent_cost'] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS agent_cost FROM cb_cms_sales_received WHERE pj_seq='1' AND (pay_sche_code='2' OR pay_sche_code='4') AND is_refund='0' "); // 대행비 수납금 총액

		$view['rec'][0] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='1' AND is_refund='0' "); // 현금수표계좌 수납금 총액
		$view['rec'][1] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='2' AND is_refund='0' "); // 신탁[신청금]계좌 수납금 총액
		$view['rec'][2] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='3' AND is_refund='0' "); // 신탁[분담금]계좌 수납금 총액
		$view['rec'][3] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='4' AND is_refund='0' "); // 신탁[대행금]계좌 수납금 총액
		$view['rec'][4] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='5' AND is_refund='0' "); // 바램[외환]계좌 수납금 총액
		$view['rec'][5] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='6' AND is_refund='0' "); // 바램[국민]계좌 수납금 총액
		$view['rec'][6] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='7' AND is_refund='0' "); // 바램[신한]계좌 수납금 총액
        $view['rec'][7] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='8' AND is_refund='0' "); // 바램[농협]계좌 수납금 총액
        $view['rec'][8] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='9' AND is_refund='0' "); // 김현수 계좌 수납금 총액

		$view['current_rec1'] = 5;
		$view['current_rec2'] = 5;


        $view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }
}
