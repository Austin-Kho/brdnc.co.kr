<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_book extends CI_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('main_m'); //모델 파일 로드
		$this->load->model('m4_m'); //모델 파일 로드
		// PHPExcel 라이브러리 로드
		$this->load->library('excel');
		$this->load->helper('cut_string');
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->excel_file();
	}

	public function excel_file(){

		// 검색변수 데이터 --------------------------------------------------------//
		$sh_frm = array(
			'class1' => $this->input->get('class1', TRUE),
			'class2' => $this->input->get('class2', TRUE),
			's_date' => $this->input->get('s_date', TRUE),
			'e_date' => $this->input->get('e_date', TRUE),
			'sh_con' => $this->input->get('search_con', TRUE),
			'sh_text' => $this->input->get('search_text', TRUE)
		);
		// 검색변수 데이터 --------------------------------------------------------//

		// 검색결과 데이터 --------------------------------------------------------//
		$cb_table = 'cms_capital_cash_book, cms_capital_bank_account';
		$list_num = $this->m4_m->cash_book_list($cb_table, '', '', $sh_frm, 'num');
		$cb_list = $this->m4_m->cash_book_list($cb_table, '', '', $sh_frm, '');
		// 검색결과 데이터 --------------------------------------------------------//


		// 본문 내용 ---------------------------------------------------------------//
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);

		$this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15); // 전체 기본 셀 높이 설정
		$this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(30); // 1행의 셀 높이 설정

		$this->excel->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
			array(
				'font' => array('size' => 9),
				'alignment' => array(
					'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					'horizontal'   => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
				)
			),
			'A:L'
		);

		$this->excel->getActiveSheet()->setCellValue("A1", '자금 출납부'); // 셀 갑 입력
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);// A1의 글씨를 볼드로 변경합니다.

		$this->excel->getActiveSheet()->mergeCells('A1:E1');
		$this->excel->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

		$this->excel->getActiveSheet()->setCellValue('A2', '거래일자');
		$this->excel->getActiveSheet()->setCellValue('B2', '구 분');
		$this->excel->getActiveSheet()->setCellValue('C2', '계정과목');
		$this->excel->getActiveSheet()->setCellValue('D2', '적 요');
		$this->excel->getActiveSheet()->setCellValue('E2', '거 래 처');
		$this->excel->getActiveSheet()->setCellValue('F2', '입금처');
		$this->excel->getActiveSheet()->setCellValue('G2', '입금금액');
		$this->excel->getActiveSheet()->setCellValue('H2', '지출처');
		$this->excel->getActiveSheet()->setCellValue('I2', '지출금액');
		$this->excel->getActiveSheet()->setCellValue('J2', '현금시재');
		$this->excel->getActiveSheet()->setCellValue('K2', '예금잔고');
		$this->excel->getActiveSheet()->setCellValue('L2', '비 고');
		$this->excel->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		for($i=0; $i<$list_num; $i++) :
			switch ($cb_list[0]->class1) {
				case '1': $cla1 = '[입금]'; break;
				case '2': $cla1 = '[출금]'; break;
				case '3': $cla1 = '[대체]'; break;
			}
			switch ($cb_list[0]->class2) {
				case '1': $cla2 = '[자산]'; break;
				case '2': $cla2 = '[부채]'; break;
				case '3': $cla2 = '[자본]'; break;
				case '4': $cla2 = '[수익]'; break;
				case '5': $cla2 = '[비용]'; break;
				case '6': $cla2 = '[본사]'; break;
				case '7': $cla2 = '[현장]'; break;
			}

			if($cb_list[0]->account=="" || $cb_list[0]->account=='0'){ $account = "-"; }else{ $account = "[".$cb_list[0]->account."]"; } //계정과목
			if($cb_list[0]->inc==0) $inc = '-'; else $inc = $cb_list[0]->inc;
			if($cb_list[0]->exp==0) $exp = '-'; else $exp = $cb_list[0]->exp;
			if($cb_list->acc) $acc=$cb_list->acc; else $acc="-"; // 거래처정보가 없을 때

			// 대체거래일 때
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			// (수입금이 '0' 이거나 대체거래이고, 출금계정이 은행등록계좌와 같으면,
			if($cb_list->inc==0||($cb_list->class1==3&&$cb_list->out_acc==$cb_list->no)){ $inc="-"; }else{ $inc=number_format($cb_list->inc); }// 수입금
			// 지출금이 '0' 이거나 대체거래이고 입금계정이 은행등록계좌와 같으면,
			if($cb_list->exp==0||($cb_list->class1==3&&$cb_list->in_acc==$cb_list->no)){ $exp="-"; }else{ $exp=number_format($cb_list->exp); }// 지출금
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			// 대체거래일 때
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			// 입금계정정보가 없거나 대체거래이고 출금계정이 은행등록계좌와 같으면,
			if($cb_list->in_acc==0||($cb_list->class1==3&&$cb_list->out_acc==$cb_list->no)){ $in_acc=""; }else{ $in_acc=$cb_list->name; } // 입금계정은 계좌별칭
			// 출금계정정보가 없거나 대체거래이고 입금계정이 은행등록계좌와 같으면,
			if($cb_list->out_acc==0||($cb_list->class1==3&&$cb_list->in_acc==$cb_list->no)){ $out_acc=""; }else{ $out_acc=$cb_list->name; } // 출금계정은 계좌별칭
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			switch ($cb_list->evidence) {
				case '1': $evi="증빙 없음"; break;
				case '2': $evi="세금계산서"; break;
				case '3': $evi="계산서"; break;
				case '4': $evi="카드전표"; break;
				case '5': $evi="현금영수증"; break;
				case '6': $evi="간이영수증"; break;
			}

			$this->excel->setActiveSheetIndex(0)->setCellValue("A".($i+3), $cb_list->deal_date);
			$this->excel->setActiveSheetIndex(0)->setCellValue("B".($i+3), $cla1." - ".$cla2);
			$this->excel->setActiveSheetIndex(0)->setCellValue("C".($i+3), $account);
			$this->excel->setActiveSheetIndex(0)->setCellValue("D".($i+3), cut_string($cb_list->cont, 20, '..'));
			$this->excel->setActiveSheetIndex(0)->setCellValue("E".($i+3), cut_string($acc, 8, '..'));
			$this->excel->setActiveSheetIndex(0)->setCellValue("F".($i+3), $in_acc);
			$this->excel->setActiveSheetIndex(0)->setCellValue("G".($i+3), $inc);
			$this->excel->setActiveSheetIndex(0)->setCellValue("H".($i+3), $out_acc);
			$this->excel->setActiveSheetIndex(0)->setCellValue("I".($i+3), $exp);
			// $this->excel->setActiveSheetIndex(0)->setCellValue("J".($i+3), $cash_hand);
			// $this->excel->setActiveSheetIndex(0)->setCellValue("K".($i+3), $bank_balance);
			$this->excel->setActiveSheetIndex(0)->setCellValue("L".($i+3), $cb_list->note);

		endfor;


		// 본문 내용 ---------------------------------------------------------------//

		$filename='cash_book.xlsx'; // 엑셀 파일 이름
		header('Content-Type: application/vnd.ms-excel'); //mime 타입
		header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
		header('Cache-Control: max-age=0'); //no cache
		// Excel5 포맷으로 저장 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
		// 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
		$objWriter->save('php://output');
	}
}
		/** 셀 컨트롤**/
		// $this->excel->setActiveSheetIndex(0)->setCellValue("A1", "셀값"); // 셀 갑 입력
		// $this->excel->getActiveSheet()->mergeCells('A1:C1'); // 셀 합치기
		// $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(6); // 셀 가로크기
		// $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(25); // 셀 높이
		// $this->excel->getActiveSheet()->getStyle('A1:C1')->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)

		//
		// 개별 적용
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); // 셀의 text를 굵게
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13); // 셀의 textsize를 13으로
		//
		//  보더 스타일 지정
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
		// 다중 셀 보더 스타일 적용
		// foreach(range('A','C') as $i => $cell){
		// 	$this->excel->getActiveSheet()->getStyle($cell.'1')->applyFromArray( $headBorder );
		// }
		//
		// 줄바꿈 허용
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
