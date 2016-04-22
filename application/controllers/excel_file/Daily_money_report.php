<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_money_report extends CI_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m4_m'); //모델 파일 로드
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
		// 자금일보 출력 일자
		$sh_date = $this->input->get('sh_date', TRUE);
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
		// 은행계좌 데이터
		$data['bank_acc'] = $this->m4_m->select_data_lt('cms_capital_bank_account', '', '', '');
		//$data['b_acc'] = $this->main_m->sql_result('SELECT no, name FROM cms_capital_bank_account ORDER BY no');

		// 은행 계좌별 전일 잔고 및 금일 출납, 잔고 구하기 데이터
		for($i=0; $i<$data['bank_acc']['num']; $i++) {
			$data['cum_in'][$i] = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date<='".$sh_date."' ");
			$data['date_in'][$i] = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date ='".$sh_date."' ");
			$data['cum_ex'][$i] = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date<='".$sh_date."' ");
			$data['date_ex'][$i] = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='".$data['bank_acc']['result'][$i]->no."' AND deal_date ='".$sh_date."' ");
		}

		// 회사 현금자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
		$cum_inc = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND deal_date<='".$sh_date."' ");
		$date_inc = $this->main_m->sql_result("SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND deal_date ='".$sh_date."' ");
		$date_exp = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND deal_date ='".$sh_date."' ");
		$cum_exp = $this->main_m->sql_result("SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND deal_date<='".$sh_date."' ");
		$data['yd_tot'] = $cum_inc[0]->inc-$cum_exp[0]->exp-$date_inc[0]->inc+$date_exp[0]->exp;
		$data['td_inc'] = $date_inc[0]->inc;
		$data['td_exp'] = $date_exp[0]->exp;
		$data['td_tot'] = $cum_inc[0]->inc-$cum_exp[0]->exp;



		// 조합 대여금 데이터
		$data['jh_data'] = $this->m4_m->select_data_lt('cms_capital_cash_book', 'any_jh', 'any_jh<>0', 'any_jh');
		for($i=0; $i<$data['jh_data']['num']; $i++){
			$data['jh_name'][$i] = $this->main_m->sql_result(" SELECT pj_name FROM cms_project1_info WHERE seq = '".$data['jh_data']['result'][$i]->any_jh."' ORDER BY seq ");//조합명
			$data['jh_cum_in'][$i] = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '".$data['jh_data']['result'][$i]->any_jh."' AND deal_date<='".$sh_date."' "); //총 회수금
			$data['jh_date_in'][$i] = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '".$data['jh_data']['result'][$i]->any_jh."' AND deal_date='".$sh_date."' "); // 당일 회수
			$data['jh_cum_ex'][$i] = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh ='".$data['jh_data']['result'][$i]->any_jh."' AND deal_date<='".$sh_date."' "); // 총 대여금
			$data['jh_date_ex'][$i] = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh = '".$data['jh_data']['result'][$i]->any_jh."' AND deal_date='".$sh_date."' "); // 당일 대여
		}

		// 회사 현금자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
		$jh_cum_inc = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date<='".$sh_date."' "); //총 회수금
		$jh_date_inc = $this->main_m->sql_result(" SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date='".$sh_date."' "); // 당일 회수
		$jh_cum_exp = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date<='".$sh_date."' "); // 총 대여금
		$jh_date_exp = $this->main_m->sql_result(" SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date='".$sh_date."' "); // 당일 대여

		$data['jh_yd_tot'] = $jh_cum_inc[0]->inc-$jh_cum_exp[0]->exp-$jh_date_inc[0]->inc+$jh_date_exp[0]->exp;
		$data['jh_td_inc'] = $jh_date_inc[0]->inc;
		$data['jh_td_exp'] = $jh_date_exp[0]->exp;
		$data['jh_td_tot'] = $jh_cum_inc[0]->inc-$jh_cum_exp[0]->exp;

		// 설정일 입금 내역
		$data['da_in'] = $this->m4_m->select_data_lt("cms_capital_cash_book", "account, cont, acc, inc, note", "(com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='".$sh_date."'", "", "seq_num");
		// 설정일까지 입금 내역
		$data['da_in_total'] = $this->m4_m->da_in_total('cms_capital_cash_book', $sh_date);
		// 설정일 출금내역
		$data['da_ex'] = $this->m4_m->select_data_lt("cms_capital_cash_book", "account, cont, acc, exp, note", "(com_div>0) AND (class1='2' or class1='3') AND deal_date='".$sh_date."'", "", "seq_num");
		// 설정일까지 출금내역
		$data['da_ex_total'] = $this->m4_m->da_ex_total('cms_capital_cash_book', $sh_date);



		// 워크시트에서 1번째는 활성화
		$this->excel->setActiveSheetIndex(0);
		// 워크시트 이름 지정
		$this->excel->getActiveSheet()->setTitle('자금일보');



		/*
	* 셀 컨트롤
	*/
	// $this->excel->setActiveSheetIndex(0)->setCellValue("A1", "셀값"); // 셀 갑 입력
	// $this->excel->getActiveSheet()->mergeCells('A1:C1'); // 셀 합치기
	// $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(6); // 셀 가로크기
	// $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(25); // 셀 높이
	// $this->excel->getActiveSheet()->getStyle('A1:C1')->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)

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
	// $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setWrapText(true);
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

		$this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15); // 전체 기본 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(19.5); // 1행의 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(2)->setRowHeight(37.5); // 2행의 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(3)->setRowHeight(22.5); // 3행의 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(33.75); // 4행의 셀 높이 설정

		$this->excel->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
			array(
				'font' => array('size' => 9),
				'alignment' => array(
					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'horizontal'   => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				)
			),
			'A:K'
		);

		$this->excel->getActiveSheet()->mergeCells('A1:F2');// A1부터 D1까지 셀을 합칩니다.
		$this->excel->getActiveSheet()->mergeCells('A3:F3');
		$this->excel->getActiveSheet()->mergeCells('H2:H3');
		$this->excel->getActiveSheet()->mergeCells('I2:I3');
		$this->excel->getActiveSheet()->mergeCells('J2:J3');
		$this->excel->getActiveSheet()->mergeCells('K2:K3');
		$this->excel->getActiveSheet()->mergeCells('A4:J4');
		$this->excel->getActiveSheet()->mergeCells('A5:C5');
		$this->excel->getActiveSheet()->mergeCells('D5:E5');
		$this->excel->getActiveSheet()->mergeCells('F5:G5');
		$this->excel->getActiveSheet()->mergeCells('D5:E5');
		$this->excel->getActiveSheet()->mergeCells('H5:I5');
		$this->excel->getActiveSheet()->mergeCells('J5:K5');
		$this->excel->getActiveSheet()->mergeCells('B6:C6');
		$this->excel->getActiveSheet()->mergeCells('D6:E6');
		$this->excel->getActiveSheet()->mergeCells('F6:G6');
		$this->excel->getActiveSheet()->mergeCells('D6:E6');
		$this->excel->getActiveSheet()->mergeCells('H6:I6');
		$this->excel->getActiveSheet()->mergeCells('J6:K6');

		$this->excel->getActiveSheet()->getStyle('A5:K5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		$this->excel->getActiveSheet()->getStyle('A6:K6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCFDF2');

		$this->excel->getActiveSheet()->getStyle('A1:F3')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('G1:G3')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('H1:K3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('A4:K4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$this->excel->getActiveSheet()->getStyle('A5:K13')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		$this->excel->getActiveSheet()->setCellValue('A1', '[주] 바램디앤씨 자금일보');// A1의 내용을 입력 합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);// A1의 글씨를 볼드로 변경합니다.



		$this->excel->getActiveSheet()->setCellValue('G1', '결');
		$this->excel->getActiveSheet()->setCellValue('G2', '재');
		$this->excel->getActiveSheet()->getStyle('G1:G2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);

		$this->excel->getActiveSheet()->setCellValue('H1', '담당');
		$this->excel->getActiveSheet()->setCellValue('I1', '전무');
		$this->excel->getActiveSheet()->setCellValue('J1', '대표이사');
		$this->excel->getActiveSheet()->setCellValue('K1', '회장');

		$this->excel->getActiveSheet()->setCellValue('A3', '2016년 04월 21일 목요일');
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setIndent(4);


		$this->excel->getActiveSheet()->setCellValue('A4', '■ 자 금 현 황');
		$this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$this->excel->getActiveSheet()->setCellValue('K4', '(단위 : 원)');
		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);




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
