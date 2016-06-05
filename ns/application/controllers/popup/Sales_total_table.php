<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_total_table extends CI_Controller
{
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('member').'?returnURL='.rawurlencode(base_url(uri_string())));
		}
		$this->load->model('main_m');
		$this->load->model('popup_m');            // 팝업 모델 로드
	}
	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){

		//본 페이지 로딩
		$this->load->view('/popup/sales_total_table_v', $data);
	}
}
// End of File.
