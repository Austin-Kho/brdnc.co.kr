<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_board2 extends CB_Controller
{
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->download();
	}

	public function download(){

		$data['pj_seq'] = urldecode($this->input->get('pj')); // 프로젝트 아이디
		$data['project'] = $this->cms_main_model->data_row("cb_cms_project", array('seq'=>$data['pj_seq']), "pj_name"); // 프로젝트 데이터

		// 실제 엑셀 VIEW 파일 로드
		$this->load->view('/cms_views/excel/status_board', $data);
	}
}
// End of File
