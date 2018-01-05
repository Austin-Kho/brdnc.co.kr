<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_book extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m4_model'); //모델 파일 로드
		$this->load->helper('cms_cut_string');
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->excel_file();
	}

	public function excel_file(){

    Header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    Header("Content-Disposition: attachment; filename=cash_book.xls");
    Header("Content-Description: PHP7 Generated Data" );
    Header("Pragma: no-cache");
    Header("Expires: 0");

		// 회사명 : 회사이름이 등록되어 있지 않으면 '회사'로 표기
    $com_title = ($this->cms_main_model->select_data_row('cb_cms_com_info', array(1=>1))) ? $this->cms_main_model->select_data_row('cb_cms_com_info', array(1=>1)) : "회사";

		$add_where = $this->input->get('add_where');
		$s_date = $this->input->get('s_date');
		$e_date = $this->input->get('e_date');
		$sc = $this->input->get('sc');
		$where = ' WHERE '.$add_where;

		if(!$e_date){
			 $add_end="";
		}else{
			 $add_end=" and deal_date<='$e_date' ";
		}

    // 테이블 상단 만들기
    $EXCEL_STR = "
    <table border='1'>
    <tr align='center' height='45'>
       <td colspan='12' style='font-size:15pt; text-align:center;'><b>".$com_title->co_name." 자금 출납부</b></td>
    </tr>
    <tr align='center' height='35' style='font-size:9pt;'>
			<td width='80' bgcolor='#EAEAEA'>거래일자</td>
			<td width='80' bgcolor='#EAEAEA'> 구 분</td>
			<td width='100' bgcolor='#EAEAEA'> 계정과목</td>
			<td width='250' bgcolor='#EAEAEA'>적 요</td>
			<td width='100' bgcolor='#EAEAEA'>거 래 처</td>
			<td width='100' bgcolor='#EAEAEA'>입금처</td>
			<td width='100' bgcolor='#EAEAEA'>입금금액</td>
			<td width='100' bgcolor='#EAEAEA'>지출처</td>
			<td width='100' bgcolor='#EAEAEA'>지출금액</td>
			<td width='100' bgcolor='#EAEAEA'>현금시재</td>
			<td width='100' bgcolor='#EAEAEA'>예금잔고</td>
			<td width='100' bgcolor='#EAEAEA'>비 고</td>
	</tr>
    ";
		$a = 'ddd';
		// foreach ($variable as $key => $value) {
			$EXCEL_STR .= "
			<tr  style='font-size:9pt;'>
				 <td align='center' height='30'>".$a."</td>
				 <td align='center'>".$a."</td>
				 <td align='center'>".$a."</td>
				 <td align='left'>".$a."</td>
				 <td align='left'>".$a."</td>
				 <td align='center' bgcolor=''#ECECFF'>".$a."</td>
				 <td align='right' bgcolor='#ECECFF'>".$a."</td>
				 <td align='center' bgcolor='#FFF0F0'>".$a."</td>
				 <td align='right' bgcolor='#FFF0F0'>".$a."</td>
				 <td align='right'>".$a."</td>
				 <td align='right'>".$a."</td>
				 <td align='right'>".$a."</td>
		</tr>
	       ";

    $EXCEL_STR .= "</table>";

    echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
    echo $EXCEL_STR;
  }
}
// End of this file
