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

		$config_date = date('Y-m-d', strtotime('-3 day'));
		$data['app_3day'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_application WHERE disposal_div='0' AND app_date>='$config_date' ");
		$data['cont_3day'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_contract WHERE is_rescission='0' AND cont_date>='$config_date' ");

		$data['app_num'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_application WHERE disposal_div='0' ");
		$data['cont_num'] = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_contract WHERE is_rescission='0' ");

		$data['receive'] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS receive FROM cms_sales_received WHERE pj_seq='1' AND pay_sche_code!='2' AND pay_sche_code!='4' ");
		$data['agent_cost'] = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS agent_cost FROM cms_sales_received WHERE pj_seq='1' AND pay_sche_code='2' OR pay_sche_code='4' ");

		$this->load->view('cms_main_index', $data);
	}

	public function module() {
		$this->load->view('cms_module', $data);
		//$this->load->view('no_auth');
	}
}
// End of this File
