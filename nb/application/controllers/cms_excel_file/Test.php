<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m4_model'); //모델 파일 로드
		// PHPExcel 라이브러리 로드
		// $this->load->library('excel');
		// $this->load->helper('cms_cut_string');
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->excel_file();
	}

	public function excel_file(){

    $output_file_name = "다운로드.xls";
    header( "Content-type: application/vnd.ms-excel" );
    header( "Content-type: application/vnd.ms-excel; charset=utf-8");
    header( "Content-Disposition: attachment; filename = invoice.xls" );
    header( "Content-Description: PHP4 Generated Data" );

    // $sql = "select * from tblName order by reg_date desc";
    // $result = mysql_query($sql);

    // 테이블 상단 만들기
    $EXCEL_STR = "
    <table border='1'>
    <tr>
       <td>번호</td>
       <td>코드</td>
       <td>내용</td>
    </tr>";

    // while($row = mysql_fetch_array($result)) {
    //    $EXCEL_STR .= "
    //    <tr>
    //        <td>".$row['idx']."</td>
    //        <td>".$row['code']."</td>
    //        <td>".$row['contents']."</td>
    //    </tr>
    //    ";
    // }

    $EXCEL_STR .= "</table>";

    echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
    echo $EXCEL_STR;
  }
}
// End of this file
