<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_receive extends CB_Controller
{
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		if(@$this->session->userdata['logged_in'] !== TRUE) {
			redirect(base_url('cms_member').'?returnURL='.rawurlencode(base_url(uri_string())));
		}
		$this->load->model('cms_main_model');
		$this->load->model('cms_popup_model');            // 팝업 모델 로드
	}
	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		//본 페이지 로딩
		$this->load->view('/cms_views/popup/pop_header_v');

		// 조회 등록 권한 체크
		$auth = $this->cms_main_model->auth_chk('_m1_2_1', $this->session->userdata['mem_id']);

		if( !$auth['_m1_2_1'] or $auth['_m1_2_1']==0) {
			$this->load->view('/cms_views/no_auth');
		}else{
			// 불러올 페이지에 보낼 조회 권한 데이터
			$data['auth'] = $auth['_m1_2_1'];

			// 등록된 프로젝트 데이터
			$where = "";
			if($this->input->get('yr') !="") $where=" WHERE biz_start_ym LIKE '".$this->input->get('yr')."%' ";
			$data['all_pj'] = $this->cms_main_model->sql_result(' SELECT * FROM cb_cms_project '.$where.' ORDER BY biz_start_ym DESC ');
			$project = $data['project'] = ($this->input->get('project')) ? $this->input->get('project') : 1; // 선택한 프로젝트 고유식별 값(아이디)

			// 납부 회차 데이터
			$pay_sche = $data['pay_sche'] = $this->cms_main_model->sql_result( "SELECT seq, pay_name FROM  cb_cms_sales_pay_sche WHERE pj_seq='$project' ORDER BY pay_code " );

			// price seq 전체 가져오기
			$price = $data['price'] = $this->cms_main_model->sql_result(" SELECT seq, unit_price FROM cb_cms_sales_price WHERE pj_seq='$project' ORDER BY seq ");

			//계약 통계 계산
			$data['total_sum'] = 0;
			$data['sche_sum'] = 0;
			for ($i=0; $i<count($price); $i++) {
				$cont_sum = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS num FROM cb_cms_sales_contract WHERE price_seq='".$price[$i]->seq."' ");
				$data['total_sum'] += $price[$i]->unit_price*$cont_sum->num; // 현재 분양 총 매출액
			}

			//본 페이지 로딩
			$this->load->view('/cms_views/popup/sales_receive_v', $data);

			//본 페이지 로딩
			$this->load->view('/cms_views/popup/pop_footer_v');
		}
	}
}
// End of File.
