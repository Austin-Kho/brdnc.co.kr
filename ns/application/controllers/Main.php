<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * [__construct 로그인 유실 시 현재 페이지 정보를 가지고 로그인 페이지로]
	 */
	public function __construct() {
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member'));
		}
		$this->load->model('main_m'); //모델 파일 로드
	}

	/**
	 * [_remap description]
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

	public function index(){
		$this->main();
	}

	public function main() {
		// $this->output->enable_profiler(TRUE); //프로파일러 보기//

		$say_num = $this->main_m->sql_num_rows(" SELECT seq FROM cms_wise_saying ");
		$now_num = mt_rand(1, $say_num);
		$data['saying'] = $this->main_m->sql_row(" SELECT * FROM cms_wise_saying WHERE seq='$now_num' ");

		$config_date = date('Y-m-d', strtotime('-7 day'));
		$data['app_7day'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_application WHERE disposal_div='0' AND app_date>='$config_date' "); // 최근 7일 청약 건수
		$data['cont_7day'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_contract WHERE is_rescission='0' AND cont_date>='$config_date' "); // 최근 7일 계약 건수

		$data['app_num'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_application WHERE disposal_div='0' "); // 전체 청약 건수
		$data['cont_num'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_contract WHERE is_rescission='0' "); // 전체 계약 건수

		$data['receive'] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS receive FROM cms_sales_received WHERE pj_seq='1' AND pay_sche_code!='2' AND pay_sche_code!='4' "); // 분담금 수납금 총액
		$data['agent_cost'] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS agent_cost FROM cms_sales_received WHERE pj_seq='1' AND pay_sche_code='2' OR pay_sche_code='4' "); // 대행비 수납금 총액

		$data['rec'][0] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS rec FROM cms_sales_received WHERE pj_seq='1' AND paid_acc='1' "); // 현금수표계좌 수납금 총액
		$data['rec'][1] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS rec FROM cms_sales_received WHERE pj_seq='1' AND paid_acc='2' "); // 신탁[신청금]계좌 수납금 총액
		$data['rec'][2] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS rec FROM cms_sales_received WHERE pj_seq='1' AND paid_acc='3' "); // 신탁[분담금]계좌 수납금 총액
		$data['rec'][3] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS rec FROM cms_sales_received WHERE pj_seq='1' AND paid_acc='4' "); // 신탁[대행금]계좌 수납금 총액
		$data['rec'][4] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS rec FROM cms_sales_received WHERE pj_seq='1' AND paid_acc='5' "); // 바램[외환]계좌 수납금 총액
		$data['rec'][5] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS rec FROM cms_sales_received WHERE pj_seq='1' AND paid_acc='6' "); // 바램[국민]계좌 수납금 총액
		$data['rec'][6] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS rec FROM cms_sales_received WHERE pj_seq='1' AND paid_acc='7' "); // 바램[신한]계좌 수납금 총액

		$data['current_rec1'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_received WHERE pj_seq='1' ORDER BY paid_date DESC, seq DESC LIMIT 0, 5 "); // 최근 입금 거래 데이터1
		$data['current_rec2'] = $this->main_m->sql_result(" SELECT * FROM cms_sales_received WHERE pj_seq='1' ORDER BY paid_date DESC, seq DESC LIMIT 5, 5 "); // 최근 입금 거래 데이터2

		$this->load->view('cms_main_index', $data);
	}

	public function module() {
		$this->load->view('cms_module', $data);
		//$this->load->view('no_auth');
	}
}
// End of this File
