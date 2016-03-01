<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Zip_search extends CI_Controller
{
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->search();
	}

	public function search () {
		// $this->output->enable_profiler(TRUE);

		$this->load->library('form_validation'); // 폼 검증 라이브러리 로드
		$this->load->model('main_m');            // 메인 모델 로드
		$this->load->helper('alert');

		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('search_text', '도로(건물)명', 'required');

		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,

			$this->load->view('/popup/zip_search_v');
		}else{

			$zip_data = array(
				'sh_what' => $this->input->post('sh_what', TRUE), // 도로명 건물명 여부
				'sido' => $this->input->post('sido', TRUE),           // 시도
				'search_text' => $this->input->post('search_text',  TRUE) // 검색어
			);

			$result['zip_rlt'] = $this->main_m->zip_search($zip_data);

			$this->load->view('/popup/zip_search_v', $result);
		}
	}
}
// End of this File