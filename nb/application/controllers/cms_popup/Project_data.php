<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Project_data extends CB_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('cms_main_model');
		$this->load->model('cms_popup_model');   // 팝업 모델 로드
	}

	public function index() {
		$this->data_modi();
	}

	public function data_modi ($pj='', $seq='') {
		// $this->output->enable_profiler(TRUE); //프로파일러 보기
		$this->load->view('/cms_views/popup/pop_header_v');

		// 프로젝트 리스트 정보
		$data['pj_list'] = $this->cms_main_model->sql_result(' SELECT * FROM cb_cms_project  ORDER BY biz_start_ym DESC ');
		$data['now_pj'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_project  WHERE seq='$pj'");
		$data['type'] = explode("-", $data['now_pj']->type_name);

		// 수정할 데이터 정보
		$data['modi_data'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_project_all_housing_unit WHERE seq='$seq'" );
		// 동 리스트 정보
		$data['dong'] = $this->cms_main_model->sql_result(" SELECT dong FROM cb_cms_project_all_housing_unit GROUP BY dong ORDER BY dong " );




		// 라이브러리 로드
		$this->load->library('form_validation'); // 폼 검증

		$this->form_validation->set_rules('pj_seq', '프로젝트', 'required');
		$this->form_validation->set_rules('type', '타입', 'required');
		$this->form_validation->set_rules('dong', '동', 'required');
		$this->form_validation->set_rules('ho', '호수', 'required|numeric|max_length[5]');
		$this->form_validation->set_rules('hold_reason', '홀드사유', 'trim|max_length[200]');

		if($this->form_validation->run() == FALSE) {

			//본 페이지 로딩
			$this->load->view('/cms_views/popup/pj_data_modi_v', $data);
			$this->load->view('/cms_views/popup/pop_footer_v');
		}else{
			// 데이터 가공
			if($this->input->post('ho')==$data['modi_data']->ho){
				$floor = $data['modi_data']->floor;
				$line = $data['modi_data']->line;
			}else{
				if(strlen($this->input->post('ho'))==3){
					$floor = mb_substr($this->input->post('ho'), 0, 1);
				}else if(strlen($this->input->post('ho'))==4){
					$floor = mb_substr($this->input->post('ho'), 0, 2);
				}
				$line = mb_substr($this->input->post('ho'), -1, 1);
			}

			$update_data = array(
				'pj_seq' => $this->input->post('pj_seq', TRUE),
				'type' => $this->input->post('type', TRUE),
				'dong' => $this->input->post('dong', TRUE),
				'ho' => $this->input->post('ho', TRUE),
				'floor' => $floor,
				'line' => $line,
				'is_hold' => $this->input->post('is_hold', TRUE),
				'hold_reason' => $this->input->post('hold_reason', TRUE),
				'modi_date' => date("Y-m-d"),
				'modi_worker' => $this->session->userdata('mem_username')
			);

			$result = $this->cms_main_model->update_data('cb_cms_project_all_housing_unit', $update_data, $where = array('seq' => $this->input->post('seq')));

			if($result) { // 등록 성공 시
				alert('프로젝트 정보가  수정되었습니다.', current_url());
			}else{   // 등록 실패 시
				alert('데이터베이스 오류가 발생하였습니다..', current_url());
			}
		}
	}
}
