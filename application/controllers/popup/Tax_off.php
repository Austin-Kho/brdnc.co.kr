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

		// 검색어 초기화
		$search_text = $page_url = '';
		$uri_segment = 5;

		// 주소 중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 전환
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if(in_array('q', $uri_array)) // 주소에 검색어 ('q')가 있을 경우, 즉 검색 시 처리
		{
			// 검색어
			$search_text = urldecode($this->url_explode($uri_array, 'q'));
			// 페이지네이션용 주소
			$page_url = '/q/'.$search_text;
			$uri_segment = 7;
		}


		//페이지네이션 라이브러리 로딩 추가
		$this->load->library('pagination');

		//페이지네이션 설정///////////////////////////////////////////////////
		$config['base_url'] = '/popup/tax_off/lists/'.$page_url.'/page/'; //페이징 주소
		$config['total_rows'] = $this->popup_m->tax_search($search_text, '', '', 'num'); //게시물의 전체 갯수
		$config['per_page'] = 6; //한 페이지에 표시할 게시물 수
		$config['num_links'] = 3; // 링크 좌우로 보여질 페이지 수
		$config['uri_segment'] = $uri_segment; //페이지 번호가 위치한 세그먼트

		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination'] = $this->pagination->create_links();
		///////////////////////////////////////////////////////////////////

		// 게시물 목록을 불러오기 위한 start / limit 값 가져오기
		$page = $this->uri->segment($uri_segment, 1);

		if($page>1)
		{
			$start = (($page/$config['per_page'])) * $config['per_page'];
		}
		else
		{
			$start = ($page-1) * $config['per_page'];
		}

		//$start = 0;
		//if($this->uri->segment($config['uri_segment'])) $start =  $this->uri->segment($config['uri_segment']-1)*$config['per_page']; //$config['use_page_numbers'] = TRUE; 일 경우 // FALSE 또는 기본 값(무설정)일 경우 uri_segment 를 그대로 사용함.
		$limit = $config['per_page'];

		$data['tax_rlt'] = $this->popup_m->tax_search($search_text , $start, $config['per_page'], '');
		$this->load->view('/popup/tax_search_v', $data);
	}

	/**
	 * [url 중 키 값을 구분하여 값을 가져오도록]
	 * @param  [Array] $url [segment_explode 한 url 값]
	 * @param  [String] $key [가져오려는 값의 key]
	 * @return [String] $url[$k] [리턴 값]
	 */
	public function url_explode($url, $key){
		$cnt = count($url);
		for($i = 0; $cnt>$i; $i++){
			if($url[$i] == $key){
				$k = $i+1;           // 'q' 바로 다음에 있는
				return $url[$k];     // 검색어를 추출하여 리턴한다.
			}
		}
	}

	public function segment_explode($seg){
		// 세그먼트 앞뒤 '/' 제거 후 uri를 배열로 반환
		$len = strlen($seg);
		if(substr($seg, 0, 1) == '/'){
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
		if(substr($seg, -1) == '/'){
			$seg = substr($seg, 0, $len-1);
		}
		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}
}
// End of this File