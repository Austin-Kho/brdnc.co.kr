<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Zip_ extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->helper('is_mobile');
		$this->load->library('form_validation'); // 폼 검증 라이브러리 로드
		$this->load->model('popup_m');            //  모델 로드
		$this->load->helper('alert');
	}

	public function _remap($method) {
 		//헤더 include
    $this->load->view('/popup/pop_header_v');
		if( method_exists($this, $method) )	{
			$this->{"{$method}"}();
		}
		//푸터 include
		$this->load->view('/popup/pop_footer_v');
  }

	public function index(){
		$this->lists();
	}

	public function lists () {
		// $this->output->enable_profiler(TRUE);

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

			$result['zip_rlt'] = $this->popup_m->zip_search($zip_data);

			$this->load->view('/popup/zip_search_v', $result);
		}
	}
}
// End of this File
