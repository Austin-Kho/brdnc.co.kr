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

		// PDF를 만들기 기능을 사용하기 위해  dompdf 클래스 호출
		include (APPPATH."third_party/dompdf/autoload.inc.php");
		// dompdf 클래스 인스턴스화
        $dompdf = new Dompdf\Dompdf();

        $html = $this->load->view('cms_views/pdf/bill_issue',[],true);

        $dompdf->loadHtml($html);

        // (옵션) 용지 크기 및 방향 설정
        $dompdf->setPaper('A4', '');

        // HTML을 PDF로 렌더링
        $dompdf->render();

        // 생성 된 PDF 파일 내용 가져 오기
        $pdf = $dompdf->output();

        //  생성 된 PDF('파일명')를 브라우저로 출력하십시오.
        $dompdf->stream('aaa');
	}
}
// End of File
