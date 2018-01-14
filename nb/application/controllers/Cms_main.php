<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cms_main extends CB_Controller {


	/**
	 * [__construct 로그인 유실 시 현재 페이지 정보를 가지고 로그인 페이지로]
	 */
	public function __construct()	{
		parent::__construct();
		if($this->member->is_member() === false) {
			redirect(base_url('cms_member'));
		}
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

	/**
	 * [_remap description]
	 * @param  [type] $method [description]
	 * @return [type]         [description]
	 */
	public function _remap($method){
		// 헤더 include
		$this->load->view('cms_views/cms_main_header');

		if(method_exists($this, $method)){
			$this->{"$method"}();
		}
		// 푸터 include
		$this->load->view('cms_views/cms_main_footer');
	}

	public function index(){
		$this->main();
	}

	public function main() {
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		$say_num = $this->cms_main_model->sql_num_rows(" SELECT seq FROM cb_cms_wise_saying ");
		$now_num = mt_rand(1, $say_num);
		$data['saying'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_wise_saying WHERE seq='$now_num' ");

		$config_date = date('Y-m-d', strtotime('-7 day'));
		$data['app_7day'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_application WHERE disposal_div='0' AND app_date>='$config_date' "); // 최근 7일 청약 건수
		$data['cont_7day'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_contract WHERE is_rescission='0' AND cont_date>='$config_date' "); // 최근 7일 계약 건수

		$data['app_num'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_application WHERE disposal_div='0' "); // 전체 청약 건수
		$data['cont_num'] = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_contract WHERE is_rescission='0' "); // 전체 계약 건수

		$data['receive'] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS receive FROM cb_cms_sales_received WHERE pj_seq='1' AND pay_sche_code!='2' AND pay_sche_code!='4' AND is_refund='0' "); // 분담금 수납금 총액
		$data['agent_cost'] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS agent_cost FROM cb_cms_sales_received WHERE pj_seq='1' AND (pay_sche_code='2' OR pay_sche_code='4') AND is_refund='0' "); // 대행비 수납금 총액

		$data['rec'][0] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='1' AND is_refund='0' "); // 현금수표계좌 수납금 총액
		$data['rec'][1] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='2' AND is_refund='0' "); // 신탁[신청금]계좌 수납금 총액
		$data['rec'][2] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='3' AND is_refund='0' "); // 신탁[분담금]계좌 수납금 총액
		$data['rec'][3] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='4' AND is_refund='0' "); // 신탁[대행금]계좌 수납금 총액
		$data['rec'][4] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='5' AND is_refund='0' "); // 바램[외환]계좌 수납금 총액
		$data['rec'][5] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='6' AND is_refund='0' "); // 바램[국민]계좌 수납금 총액
		$data['rec'][6] = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS rec FROM cb_cms_sales_received WHERE pj_seq='1' AND paid_acc='7' AND is_refund='0' "); // 바램[신한]계좌 수납금 총액

		$data['current_rec1'] = 5;
		$data['current_rec2'] = 5;

		// // board list 불러오기 Start--------------------------//
		// $where = array(
		// 		'brd_search' => 1,
		// );
		// $board_id = $view['board_id'] = $this->Board_model->get_board_list($where);
		// $board_list = array();
		// if ($board_id && is_array($board_id)) {
		// 		foreach ($board_id as $key => $val) {
		// 				$board_list[] = $this->board->item_all(element('brd_id', $val));
		// 		}
		// }
		// $view['view']['board_list'] = $board_list;
		// // board list 불러오기 End----------------------------//

		$this->load->view('/cms_views/cms_main_index', $data);
		// 최근 게시물 불러오기
		// $this->load->view('/cms_views/board/d_main', $view);
	}

	public function module() {
		$data[] = '';
		$this->load->view('cms_views/cms_module', $data);
		//$this->load->view('no_auth');
	}
}
// End of this File
