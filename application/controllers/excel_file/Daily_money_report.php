<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_money_report extends CI_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		// PHPExcel 라이브러리 로드
		$this->load->library('excel');
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->excel_file();
	}

	public function excel_file(){
		// 워크시트에서 1번째는 활성화
		$this->excel->setActiveSheetIndex(0);
		// 워크시트 이름 지정
		$this->excel->getActiveSheet()->setTitle('자금일보');

		// 자금일보 출력 일자
		$sh_date = $this->input->get('sh_date');
		$d_obj = date_create($sh_date);
    $year = date_format($d_obj, "Y");
    $month = date_format($d_obj, "m");
    $day = date_format($d_obj, "d");
    $week = date_format($d_obj, "w"); // 0~6
		switch ($week) {
			case '0':	$daily = "일요일";	break;
			case '1':	$daily = "월요일";	break;
			case '2':	$daily = "화요일";	break;
			case '3':	$daily = "수요일";	break;
			case '4':	$daily = "목요일";	break;
			case '5':	$daily = "금요일";	break;
			case '6':	$daily = "토요일";	break;
		}

		/*
	* 셀 컨트롤
	*/
	// $this->excel->setActiveSheetIndex(0)->setCellValue("A1", "셀값"); // 셀 갑 입력
	// $this->excel->getActiveSheet()->mergeCells('A1:C1'); // 셀 합치기
	// $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(6); // 셀 가로크기
	// $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(25); // 셀 높이
	// $this->excel->getActiveSheet()->getStyle('A1:C1')->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
	// 글꼴 및 정렬
	$this->excel->getActiveSheet()->duplicateStyleArray(
		array(
			'font' => array(
				// 'bold' => true,
				'size' => 9
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
			)
		),
		'A1'
	);
	//
	// //개별 적용
	// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); // 셀의 text를 굵게
	// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13); // 셀의 textsize를 13으로
	//
	// // 보더 스타일 지정
	// $defaultBorder = array(
	// 	'style' => PHPExcel_Style_Border::BORDER_THIN,
	// 	'color' => array('rgb'=>'000000')
	// );
	// $headBorder = array(
	// 	'borders' => array(
	// 		'bottom' => $defaultBorder,
	// 		'left'   => $defaultBorder,
	// 		'top'    => $defaultBorder,
	// 		'right'  => $defaultBorder
	// 	)
	// );
	//
	// // 다중 셀 보더 스타일 적용
	// foreach(range('A','C') as $i => $cell){
	// $this->excel->getActiveSheet()->getStyle($cell.'1')->applyFromArray( $headBorder );
	// }
	//
	// //줄바꿈 허용
	// $this->excel->getActiveSheet()->getStyle('H4')->getAlignment()->setWrapText(true);
	// $this->excel->getActiveSheet()->getStyle('K6')->getAlignment()->setWrapText(true);
	// $this->excel->getActiveSheet()->getStyle('K8')->getAlignment()->setWrapText(true);
	//
	// // 배경색 적용
	// $this->excel->getActiveSheet()->duplicateStyleArray(
	// array(
	// 'fill' => array(
	// 'type'  => PHPExcel_Style_Fill::FILL_SOLID,
	// 'color' => array('rgb'=>'F3F3F3')
	// )
	// ),
	// 'A1:C1'
	// );
	//
	// // 셀 정렬 (다른방식)
	// $this->excel->getActiveSheet()->getStyle('A1')
	// ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	//
	// $this->excel->getActiveSheet()->getStyle('A1:C1')
	// ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	// //테두리
	// //셀 전체(윤곽선 + 안쪽)
	// $this->excel->getActiveSheet()->getStyle('B2:C3')->getBorders()
	// ->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	//
	// //윤곽선
	// $this->excel->getActiveSheet()->getStyle('B5:C6')->getBorders()
	// ->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	//
	// //안쪽
	// $this->excel->getActiveSheet()->getStyle('B8:C9')->getBorders()
	// ->getInside()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	//
	// //세로선
	// $this->excel->getActiveSheet()->getStyle('B11:D13')->getBorders()
	// ->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	//
	// //가로선
	// $this->excel->getActiveSheet()->getStyle('B15:D17')->getBorders()
	// ->getHorizontal()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		// 본문 내용 ---------------------------------------------------------------//
		$this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19.5); // 전체 기본 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(19.5); // 1행의 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(2)->setRowHeight(37.5); // 2행의 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(3)->setRowHeight(22.5); // 3행의 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(33.75); // 4행의 셀 높이 설정

		$this->excel->getActiveSheet()->getColumnDimension("A")->setWidth(10); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("B")->setWidth(7); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("C")->setWidth(7); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("D")->setWidth(7); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("E")->setWidth(7); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("F")->setWidth(12); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("G")->setWidth(5); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("H")->setWidth(9); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("I")->setWidth(9); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("J")->setWidth(9); // A열의 셀 넓이 설정
		$this->excel->getActiveSheet()->getColumnDimension("K")->setWidth(9); // A열의 셀 넓이 설정

		$this->excel->getActiveSheet()->setCellValue('A1', '[주] 바램디앤씨 자금일보');// A1의 내용을 입력 합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);// A1의 글씨를 볼드로 변경합니다.
		$this->excel->getActiveSheet()->mergeCells('A1:F2');// A1부터 D1까지 셀을 합칩니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);// A1의 컬럼에서 가운데 쓰기를 합니다.
		$this->excel->getActiveSheet()->setCellValue('G1', '결재')
																	->mergeCells('G1:G3')
																	->setCellValue('H1', '담당')
																	->setCellValue('I1', '전무')
																	->setCellValue('J1', '대표이사')
																	->setCellValue('K1', '회장')
																	->getStyle('H1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->setCellValue('A3', '2016년 04월 21일 목요일')
																	->mergeCells('A3:F3')
																	->mergeCells('H2:H3')
																	->mergeCells('I2:I3')
																	->mergeCells('J2:J3')
																	->mergeCells('K2:K3');




		// 본문 내용 ---------------------------------------------------------------//

		$filename='daily_money_report_'.$sh_date.'.xlsx'; // 엑셀 파일 이름
		header('Content-Type: application/vnd.ms-excel'); //mime 타입
		header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
		header('Cache-Control: max-age=0'); //no cache

		// Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		// 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
		$objWriter->save('php://output');
	}
}
// End of File
