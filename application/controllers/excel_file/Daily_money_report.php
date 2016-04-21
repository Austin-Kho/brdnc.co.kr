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

		// 본문 내용 ---------------------------------------------------------------//
		// A1의 내용을 입력 합니다.
		$this->excel->getActiveSheet()->setCellValue('A1', '[주] 바램디앤씨 자금일보');
		// A1의 폰트를 변경 합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
		// A1의 글씨를 볼드로 변경합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		// A1부터 D1까지 셀을 합칩니다.
		$this->excel->getActiveSheet()->mergeCells('A1:F2');
		// A1의 컬럼에서 가운데 쓰기를 합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

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
