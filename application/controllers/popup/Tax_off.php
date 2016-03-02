<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Tax_off extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('popup_m');            // 팝업 모델 로드
		$this->load->helper('is_mobile');
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


		$this->load->library('pagination'); //페이지네이션 라이브러리 로딩 추가

		//페이지네이션 설정///////////////////////////////////////////////////
		$config['base_url'] = '/popup/tax_off/'; //페이징 주소
		$config['total_rows'] = $this->popup_m->tax_search('', 'num'); //게시물의 전체 갯수
		$config['per_page'] = 6; //한 페이지에 표시할 게시물 수
		$config['uri_segment'] = $uri_segment = 3; //페이지 번호가 위치한 세그먼트

		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination'] = $this->pagination->create_links();
		///////////////////////////////////////////////////////////////////

		// 폼 검증 라이브러리 로드
		$this->load->library('form_validation');
		// 폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('search_text', '세무서명', 'required');


		if($this->form_validation->run() == FALSE) { // 폼 전송 데이타가 없으면,

			// $page_data = array(
			// 	'search_text' => '',
			// 	'start' => $start,
			// 	'limit' => $limit
			// );

			$data['tax_rlt'] = $this->popup_m->tax_search('', '');
			$this->load->view('/popup/tax_search_v', $data);

		}else{ // 폼 전송 시


		}
	}
}
// End of this File