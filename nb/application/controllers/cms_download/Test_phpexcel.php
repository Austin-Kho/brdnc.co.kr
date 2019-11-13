<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_phpexcel extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
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

	/**
	 * 메인 함수
	 * @return [type] [description]
	 */
    public function download(){

        /** 데이터 가져오기 시작 **/
		//----------------------------------------------------------//
		// $project = urldecode($this->input->get('pj'));
		// $basic_site_data = $this->cms_main_model->sql_result("SELECT * FROM cb_cms_site_status WHERE pj_seq={$project} ORDER BY 'order_no, seq'"); // 토지 지번 목록 데이터
		// $pj_title = $this->cms_main_model->sql_row("SELECT pj_name FROM cb_cms_project WHERE seq={$project}");
		//----------------------------------------------------------//
		/** 데이터 가져오기 종료 **/


		/** 엑셀 시트만들기 시작 **/
		//----------------------------------------------------------//
    	require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

    	// Create new Spreadsheet object
    	$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // 본문 내용 시작---------------------------------------------------------------//

		// 본문 내용은 여기에


        // 본문 내용 종료---------------------------------------------------------------//

		$filename='파일제목.xlsx'; // 엑셀 파일 이름

	    // Redirect output to a client's web browser (Excel2007)
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // mime 타입
		header('Content-Disposition: attachment; filename='.iconv('UTF-8','CP949',$filename)); // 브라우저에서 받을 파일 이름
	    header('Cache-Control: max-age=0'); // no cache
	    // If you're serving to IE 9, then the following may be needed
	    header('Cache-Control: max-age=1');

	    // If you're serving to IE over SSL, then the following may be needed
	    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
	    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
	    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
	    header('Pragma: public'); // HTTP/1.0

		// Excel5 포맷으로 저장 -> 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
    	$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
		// 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
    	$writer->save('php://output');
    	exit;
    	// create new file and remove Compatibility mode from word title
    }
} // End of this File
