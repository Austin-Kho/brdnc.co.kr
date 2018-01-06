<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class Tax_off extends CB_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->model('cms_popup_model');    // 팝업 모델 로드
		$this->load->helper('cms_is_mobile');
	}

	public function _remap($method) {
 		//헤더 include
    		$this->load->view('/cms_views/popup/pop_header_v');
		if( method_exists($this, $method) )
		{
			$this->{"{$method}"}();
		}
		//푸터 include
		$this->load->view('/cms_views/popup/pop_footer_v');
  	}

	public function index() {
		$this->lists();
	}

	public function lists () {
		// $this->output->enable_profiler(TRUE);

		$search_text = $this->input->post('search_text');

		//페이지네이션 라이브러리 로딩 추가
		$this->load->library('pagination');
		$data['n'] = $this->uri->segment(4);

		//페이지네이션 설정/////////////////////////////////
		$config['base_url'] = base_url('/cms_popup/tax_off/lists/'.$data['n']); //페이징 주소
		$config['total_rows'] = $this->cms_popup_model->tax_search($search_text, '', '', 'num'); //게시물의 전체 갯수
		$config['per_page'] = 6; //한 페이지에 표시할 게시물 수
		$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
		$config['uri_segment'] = 5; //페이지 번호가 위치한 세그먼트

		// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
		$page = $this->input->get('page'); // get방식이 아닌 경우, $config['uri_segment'];
		$start = ($page<=1 or empty($page)) ? 0 : ($page-1) * $config['per_page'];
		$limit = $config['per_page'];

		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination'] = $this->pagination->create_links();
		///////////////////////////////////////////////////////////////////

		$data['tax_off_list'] = $this->cms_popup_model->tax_search($search_text , $start, $limit, '');

		$this->load->view('/cms_views/popup/tax_search_v', $data);
	}
}
// End of this File
