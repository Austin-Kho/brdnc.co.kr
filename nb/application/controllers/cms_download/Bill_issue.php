<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill_issue extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();

	}

	public function download(){

		/**------------------------  데이터 가져오기  ------------------------**/
		// // url로 받은 계약 고유아이디 배열('-'로 연결을 배열로 나눔)
		// $view['project'] = $project = $this->input->get('pj');
		// $view['view']['cont_seq'] = explode('-', $this->input->get('seq'));
    //
		// // view page로 보낼 데이터 구하기
		// $view['view']['bill_issue'] = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_bill_issue WHERE pj_seq='$project' ");
		// $view['view']['addr'] = explode("|", $view['view']['bill_issue']->address);
		// $view['view']['pay_sche'] = $this->cms_main_model->sql_result(" SELECT seq, pay_sort, pay_code, pay_name, pay_due_date FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' ");
    //
		// // 프로젝트명, 타입 정보 구하기
		// $pj_info = $this->cms_main_model->sql_row(" SELECT pj_name, type_name, type_color FROM cb_cms_project WHERE seq='$project' ");
		// if($pj_info) {
		// 	$view['tp_name'] = explode("-", $pj_info->type_name);
		// 	$view['tp_color'] = explode("-", $pj_info->type_color);
		// }
		/**------------------------  데이터 가져오기  ------------------------**/
		require_once APPPATH.'/third_party/mpdf/mpdf.php';

		$view = [];
		$data = [];

		$style = file_get_contents("style.css");


    //load the view and saved it into $html variable
    $html=$this->load->view('cms_views/pdf/bill_issue', $data, true);

    //this the the PDF filename that user will get to download
    $pdfFilePath = "bill.pdf";


    //load mPDF library
    // $this->load->library('m_pdf');
		$mpdf=new mPDF('ko');

		$mpdf->WriteHTML($style,1);   // 1 은 스타일시트를 의미
    //generate the PDF from the given html
    $mpdf->WriteHTML($html, 2); // 2는 html 을 의미 //생략가능

    //download it.
    $mpdf->Output($pdfFilePath, "D");
		exit;
	}
}
// End of File
