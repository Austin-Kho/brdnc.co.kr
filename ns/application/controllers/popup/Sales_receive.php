<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_receive extends CI_Controller
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
		$this->load->view('/popup/pop_header_v');

		$project = $this->input->get('project');

		// 납부 회차 데이터
		$pay_sche = $data['pay_sche'] = $this->main_m->sql_result( "SELECT seq, pay_name FROM  cms_sales_pay_sche WHERE pj_seq='$project' ORDER BY pay_code " );

		// price seq 전체 가져오기
		$price = $data['price'] = $this->main_m->sql_result(" SELECT seq, unit_price FROM cms_sales_price WHERE pj_seq='$project' ORDER BY seq ");

		//계약 통계 계산
		$data['total_sum'] = 0;
		$data['sche_sum'] = 0;
		for ($i=0; $i<count($price); $i++) {
			$cont_sum = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_contract WHERE price_seq='".$price[$i]->seq."' ");
			$data['total_sum'] += $price[$i]->unit_price*$cont_sum->num; // 현재 분양 총 매출액
		}

		//본 페이지 로딩
		$this->load->view('/popup/sales_receive_v', $data);



		//본 페이지 로딩
		$this->load->view('/popup/pop_footer_v');
	}
}
// End of File.
