<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract_data extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

	public function download(){

		/** 데이터 가져오기 시작 **/
		//----------------------------------------------------------//
		$project = urldecode($this->input->get('pj'));
		$cont_query = urldecode($this->input->get('qry'));
		$cont_data = $this->cms_main_model->sql_result($cont_query); // 계약 및 계약자 데이터

		//----------------------------------------------------------//
		/** 데이터 가져오기 종료 **/


		/** 엑셀 시트만들기 시작 **/
		//----------------------------------------------------------//
    require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

    // Create new Spreadsheet object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('brinc.co.kr')
      ->setLastModifiedBy($this->session->userdata('mem_username'))
      ->setTitle('Contract_data')
      ->setSubject('계약자_데이터')
      ->setDescription('계약자 필터링 데이터');
		//----------------------------------------------------------//

		$spreadsheet->setActiveSheetIndex(0); // 워크시트에서 1번째는 활성화
		$spreadsheet->getActiveSheet()->setTitle('계약자_데이터'); // 워크시트 이름 지정

		// 본문 내용 ---------------------------------------------------------------//

		// 전체 글꼴 및 정렬
		$spreadsheet->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
			array(
				'font' => array('size' => 9),
				'alignment' => array(
					'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
				)
			),
			'A:L'
		);

		// 헤더 스타일 생성 -- add style to the header
    $styleArray = array(
      'font' => array(
        'bold' => true,
      ),
      'alignment' => array(
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ),
      'borders' => array(
        'top' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    );
    $spreadsheet->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);

		$spreadsheet->getActiveSheet()->getColumnDimension("A")->setWidth(4); // A열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("B")->setWidth(10); // B열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("C")->setWidth(7); // C열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("D")->setWidth(7); // D열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("E")->setWidth(10); // E열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("F")->setWidth(8); // F열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("G")->setWidth(12); // G열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("H")->setWidth(10); // H열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("I")->setWidth(9); // I열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("J")->setWidth(10); // J열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("K")->setWidth(12); // K열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("L")->setWidth(12); // K열의 셀 넓이 설정

		$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19.5); // 전체 기본 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(37.5); // 1행의 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(2)->setRowHeight(9.5); // 2행의 셀 높이 설정

		$spreadsheet->getActiveSheet()->mergeCells('A1:L1');// A1부터 D1까지 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('A1', '계약자 데이터');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue('L2', date('Y-m-d')." 현재");// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->getStyle('A3:L3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		$spreadsheet->getActiveSheet()->setCellValue('A3', 'no.');
		$spreadsheet->getActiveSheet()->setCellValue('B3', '계약자 일련번호');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('C3', '차 수');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('D3', '타 입');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('E3', '동 호 수');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('F3', '계 약 자');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('G3', '연락처[1]');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('H3', '계약일자');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('I3', '총 납입금');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('J3', '미비 서류');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('K3', '계약자 거주지');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('L3', '비 고');// 해당 셀의 내용을 입력 합니다.

		$i=1;
		foreach ($cont_data as $lt) {
			$nd = $this->cms_main_model->sql_row(" SELECT diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no='$lt->cont_diff' ");
			$total_rec = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS received FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$lt->cont_seq' ");

			$deposit1 = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$lt->price_seq' AND pay_sche_seq<3 ");
			$deposit2 = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$lt->price_seq' AND pay_sche_seq<5 ");

			$idoc = explode("-", $lt->incom_doc); // 미비 서류
			$incom_doc = "";
			if($idoc[0]==1) $incom_doc .= " 각서9종/";
			if($idoc[1]==1) $incom_doc .= " 주민등본/";
			if($idoc[2]==1) $incom_doc .= " 주민초본/";
			if($idoc[3]==1) $incom_doc .= " 가족관계증명/";
			if($idoc[4]==1) $incom_doc .= " 인감증명/";
			if($idoc[5]==1) $incom_doc .= " 사용인감/";
			if($idoc[6]==1) $incom_doc .= " 신분증/";
			if($idoc[7]==1) $incom_doc .= " 배우자등본/";

			$adr1 = ($lt->cont_addr2) ? explode("|", $lt->cont_addr2) : explode("|", $lt->cont_addr1);
			$adr2 = explode(" ", $adr1[1]);
			$addr = $adr2[0]." ".$adr2[1];

			$spreadsheet->getActiveSheet()->setCellValue('A'.(3+$i), $i);
			$spreadsheet->getActiveSheet()->setCellValue('B'.(3+$i), $lt->cont_code);
			$spreadsheet->getActiveSheet()->setCellValue('C'.(3+$i), $nd->diff_name);
			$spreadsheet->getActiveSheet()->setCellValue('D'.(3+$i), $lt->unit_type);
			$spreadsheet->getActiveSheet()->setCellValue('E'.(3+$i), $lt->unit_dong_ho);
			$spreadsheet->getActiveSheet()->setCellValue('F'.(3+$i), $lt->contractor);
			$spreadsheet->getActiveSheet()->setCellValue('G'.(3+$i), $lt->cont_tel1);
			$spreadsheet->getActiveSheet()->setCellValue('H'.(3+$i), $lt->cont_date);
			$spreadsheet->getActiveSheet()->getStyle('I'.(3+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->setCellValue('I'.(3+$i), number_format($total_rec->received));
			$spreadsheet->getActiveSheet()->setCellValue('J'.(3+$i), $incom_doc);
			$spreadsheet->getActiveSheet()->setCellValue('K'.(3+$i), $addr);
			$spreadsheet->getActiveSheet()->getStyle('L'.(3+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			$spreadsheet->getActiveSheet()->setCellValue('L'.(3+$i), $lt->note);

			$i++;
		}

		// set right to left direction
    // $spreadsheet->getActiveSheet()->setRightToLeft(true);

		// 본문 내용 ---------------------------------------------------------------//

		$filename='계약자_데이터.xlsx'; // 엑셀 파일 이름

    // Redirect output to a client's web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // mime 타입
    header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
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
}
// End of File
