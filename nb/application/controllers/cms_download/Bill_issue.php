<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill_issue extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

	public function download(){
		/**------------------------  데이터 가져오기  ------------------------**/
		// url로 받은 계약 고유아이디 배열('-'로 연결을 배열로 나눔)
		$view['project'] = $project = $this->input->get('pj');
		$view['cont_seq'] = explode('-', $this->input->get('seq'));
		$view['issue_date'] = $this->input->get("date", TRUE);

		// view page로 보낼 데이터 구하기
        $view['pj_now'] = $this->cms_main_model->sql_row("SELECT data_cr FROM cb_cms_project WHERE seq={$view['project']}");
		$view['bill_issue'] = $this->cms_main_model->sql_row("SELECT * FROM cb_cms_sales_bill_issue WHERE pj_seq={$project}");
		$view['pay_sche'] = $this->cms_main_model->sql_result(" SELECT * FROM cb_cms_sales_pay_sche WHERE pj_seq = '$project' ORDER BY pay_code ASC, pay_time ASC ");
		$view['real_sche'] = $this->cms_main_model->sql_result( " SELECT MAX(pay_code) AS pay_code FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' GROUP BY pay_time ");
		/**------------------------  데이터 가져오기  ------------------------**/

		require_once APPPATH.'/third_party/mpdf/mpdf.php';

	    //load the view and saved it into $html variable
	    $html=$this->load->view('cms_views/pdf/bill_issue', $view, true);

	    // 인스턴스 생성
		$mpdf=new mPDF('ko');

		// $mpdf->WriteHTML($style,1);   // 1 은 스타일시트를 의미
		//generate the PDF from the given html
		$mpdf->WriteHTML($html, 2); // 2는 html 을 의미 //생략가능
		//this the the PDF filename that user will get to download
	    $pdfFilename = "납부_고지서(".count($view['cont_seq'])."건).pdf";
		//download it.
		$mpdf->Output(iconv("UTF-8","cp949//IGNORE", $pdfFilename), "D");
		exit;
	}
}
// End of File
