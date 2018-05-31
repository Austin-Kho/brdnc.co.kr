<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Received_data extends CB_Controller {
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
		$rec_query = urldecode($this->input->get('qry'));
		$rec_query .= "ORDER BY paid_date, cb_cms_sales_received.seq ";
		$rec_data = $this->cms_main_model->sql_result($rec_query); // 계약 및 계약자 데이터

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
      ->setTitle('Recieved_data')
      ->setSubject('수납_데이터')
      ->setDescription('수납 필터링 데이터');
		//----------------------------------------------------------//

		$spreadsheet->setActiveSheetIndex(0); // 워크시트에서 1번째는 활성화
		$spreadsheet->getActiveSheet()->setTitle('수납_데이터'); // 워크시트 이름 지정

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
			'A:J'
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
    $spreadsheet->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);

		$outBorder = array(
      'borders' => array(
        'outline' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    );
		// $spreadsheet->getActiveSheet()->getStyle('A2:'.toAlpha(count($row_opt)-1).'2')->applyFromArray($outBorder);

		$allBorder = array(
      'borders' => array(
        'allborders' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    );
		// $spreadsheet->getActiveSheet()->getStyle('A3:J'.(count($rec_data)+3))->applyFromArray($allBorder);

		$spreadsheet->getActiveSheet()->getColumnDimension("A")->setWidth(6); // A열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("B")->setWidth(12); // B열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("C")->setWidth(12); // C열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("D")->setWidth(18); // D열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("E")->setWidth(12); // E열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("F")->setWidth(12); // F열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("G")->setWidth(13); // G열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("H")->setWidth(10); // H열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("I")->setWidth(8); // I열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("J")->setWidth(12); // J열의 셀 넓이 설정

		$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19.5); // 전체 기본 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(37.5); // 1행의 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(2)->setRowHeight(9.5); // 2행의 셀 높이 설정

		$spreadsheet->getActiveSheet()->mergeCells('A1:J1');// A1부터 D1까지 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('A1', '수납 데이터');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue('J2', date('Y-m-d')." 현재");// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->getStyle('A3:J3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		$spreadsheet->getActiveSheet()->setCellValue('A3', 'no.');
		$spreadsheet->getActiveSheet()->setCellValue('B3', '수납 일자');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('C3', '수납 금액');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('D3', '입금자');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('E3', '납입 회차');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('F3', '입금 계좌');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('G3', '당 건 총입금액');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('H3', '계약자');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('I3', '타입');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('J3', '동호수');// 해당 셀의 내용을 입력 합니다.

		$tp = $this->cms_main_model->sql_row("SELECT type_name, type_color FROM cb_cms_project WHERE seq='$project' ");
		if(!empty($tp)) :
		  $tn = explode("-", $tp->type_name);
		  $tc = explode("-", $tp->type_color);

		  for($i=0; $i<count($tn); $i++) :
		  	$type_color[$tn[$i]] = $tc[$i];
		  endfor;
		endif;

		$j=1;
		foreach($rec_data as $lt) {
			$dong_ho = explode("-", $lt->unit_dong_ho);
			$contractor = $this->cms_main_model->sql_row(" SELECT contractor AS ct FROM cb_cms_sales_contractor WHERE cont_seq='$lt->cont_seq' ");
			$total_rec = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS pa FROM cb_cms_sales_received WHERE pj_seq='$project' AND cb_cms_sales_received.cont_seq='$lt->cont_seq' GROUP BY cb_cms_sales_received.cont_seq ");

			$spreadsheet->getActiveSheet()->setCellValue('A'.(3+$j), $j);
			$spreadsheet->getActiveSheet()->setCellValue('B'.(3+$j), $lt->paid_date);
			$spreadsheet->getActiveSheet()->getStyle('C'.(3+$j))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->setCellValue('C'.(3+$j), $lt->paid_amount);
			$spreadsheet->getActiveSheet()->getStyle('C'.(3+$j))->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
			$spreadsheet->getActiveSheet()->setCellValue('D'.(3+$j), $lt->paid_who);
			$spreadsheet->getActiveSheet()->setCellValue('E'.(3+$j), $lt->pay_name);
			$spreadsheet->getActiveSheet()->setCellValue('F'.(3+$j), $lt->acc_nick);
			$spreadsheet->getActiveSheet()->getStyle('G'.(3+$j))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->setCellValue('G'.(3+$j), $total_rec->pa);
			// $spreadsheet->getActiveSheet()->getStyle('G'.(3+$j))->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
			$spreadsheet->getActiveSheet()->setCellValue('H'.(3+$j), $contractor->ct);
			$spreadsheet->getActiveSheet()->setCellValue('I'.(3+$j), $lt->unit_type);
			$spreadsheet->getActiveSheet()->setCellValue('J'.(3+$j), $lt->unit_dong_ho);

			$j++;
		}

		// set right to left direction
    // $spreadsheet->getActiveSheet()->setRightToLeft(true);

		// 본문 내용 ---------------------------------------------------------------//

		$filename='수납_데이터.xlsx'; // 엑셀 파일 이름

    // Redirect output to a client's web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // mime 타입
	Header('Content-Disposition: attachment; filename='.iconv('UTF-8','CP949',$filename)); // 브라우저에서 받을 파일 이름
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
