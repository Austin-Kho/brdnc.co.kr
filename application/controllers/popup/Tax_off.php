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

		$search_text = '';
		if(isset($_POST['search_text'])) $search_text = $_POST['search_text'];

		//페이지네이션 설정///////////////////////////////////////////////////
		$this->load->library('pagination'); //페이지네이션 라이브러리 로딩 추가

		$config['base_url'] = '/popup/tax_off/lists/'; //페이징 주소
		$config['per_page'] = 6; //한 페이지에 표시할 게시물 수
		$config['uri_segment'] = 4; //페이지 번호가 위치한 세그먼트

		$start = 0;
		if($this->uri->segment($config['uri_segment'])) $start =  $this->uri->segment($config['uri_segment'])*$config['per_page']-$config['per_page']; //$config['use_page_numbers'] = TRUE; 일 경우 // FALSE 또는 기본 값(무설정)일 경우 uri_segment 를 그대로 사용함.
		$limit = $config['per_page'];
		$config['total_rows'] = $this->popup_m->tax_search($search_text, '', '', 'num'); //게시물의 전체 갯수

		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination'] = $this->pagination->create_links();
		///////////////////////////////////////////////////////////////////
		///
		$data['tax_rlt'] = $this->popup_m->tax_search($search_text , $start, $config['per_page'], '');
		$this->load->view('/popup/tax_search_v', $data);

	}
}
// End of this File