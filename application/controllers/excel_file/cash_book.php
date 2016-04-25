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
			'class1' => $this->input->get('class1'),
			'class2' => $this->input->get('class2'),
			's_date' => $this->input->get('s_date'),
			'e_date' => $this->input->get('e_date'),
			'sh_con' => $this->input->get('search_con'),
			'sh_text' => $this->input->get('search_text')
		);
		$where=" (com_div>0 AND ((in_acc=no AND class2<>7) OR out_acc=no) OR (com_div IS NULL AND in_acc=no AND class2=6)) ";

		//검색어가 있을 경우
		if($sh_frm['class1']){
			if($sh_frm['class1']==1) $where.=" AND class1='1' ";
			if($sh_frm['class1']==2) $where.=" AND class1='2' ";
			if($sh_frm['class1']==3) $where.=" AND class1='3' ";
		}
		if($sh_frm['class2']) $where.=" AND class2='".$sh_frm['class2']."' ";
		if($sh_frm['s_date']) $where.=" AND deal_date>='".$sh_frm['s_date']."' ";
		if($sh_frm['e_date']) {$where.=" AND deal_date<='".$sh_frm['e_date']."' "; } //$e_add=" AND deal_date<='$sh_frm['e_date']' ";} else{$e_add="";}

		if($sh_frm['sh_text']){
			if($sh_frm['sh_con']==0) $where.=" AND (account like '%".$sh_frm['sh_text']."%' OR cont like '%".$sh_frm['sh_text']."%' OR acc like '%".$sh_frm['sh_text']."%' OR evidence like '%".$sh_frm['sh_text']."%' OR cms_capital_cash_book.worker like '%".$sh_frm['sh_text']."%') "; // 통합검색
			if($sh_frm['sh_con']==1) $where.=" AND account like '%".$sh_frm['sh_text']."%' "; // 계정과목
			if($sh_frm['sh_con']==2) $where.=" AND cont like '%".$sh_frm['sh_text']."%' "; //적요
			if($sh_frm['sh_con']==3) $where.=" AND acc like '%".$sh_frm['sh_text']."%' "; // 거래처
			if($sh_frm['sh_con']==4) $where.=" AND (in_acc like '%".$sh_frm['sh_text']."%' OR out_acc like '%".$sh_frm['sh_text']."%')  ";  //입출금처
		}
		// 검색변수 데이터 --------------------------------------------------------//

		// 검색결과 데이터 --------------------------------------------------------//
		$list_num = $this->m4_m->cash_book_list('cms_capital_cash_book, cms_capital_bank_account', $where, '', '', $sh_frm, 'num', '');
		$cb_list = $this->m4_m->cash_book_list('cms_capital_cash_book, cms_capital_bank_account', $where, '', '', $sh_frm, '', 'ex');
		// 검색결과 데이터 --------------------------------------------------------//


		// 본문 내용 ---------------------------------------------------------------//
		if($cb_list) :
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

			$this->excel->getActiveSheet()->setCellValue("A1", '[주] 바램디앤씨 자금 출납기록'); // 셀 갑 입력
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);// A1의 글씨를 볼드로 변경합니다.

			$this->excel->getActiveSheet()->mergeCells('A1:E1');
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

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


			$this->excel->getActiveSheet()->getStyle('G3:G'.($list_num+2))->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
			$this->excel->getActiveSheet()->getStyle('I3:K'.($list_num+2))->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
			$this->excel->getActiveSheet()->getStyle('D3:D'.($list_num+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$this->excel->getActiveSheet()->getStyle('G3:G'.($list_num+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$this->excel->getActiveSheet()->getStyle('I3:K'.($list_num+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			$this->excel->getActiveSheet()->getStyle('L3:L'.($list_num+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

			function c1($c1){
				switch ($c1) {
					case '1': $c1 = "[입금]"; break;
					case '2': $c1 = "[출금]"; break;
					case '3': $c1 = "[대체]"; break;
				}
				return $c1;
			}
			function c2($c2){
				switch ($c2) {
					case '1': $c2 = "[자산]"; break;
					case '2': $c2 = "[부채]"; break;
					case '3': $c2 = "[자본]"; break;
					case '4': $c2 = "[수익]"; break;
					case '5': $c2 = "[비용]"; break;
					case '6': $c2 = "[본사]"; break;
					case '7': $c2 = "[현장]"; break;
				}
				return $c2;
			}

			// $b_acc = $this->main_m->sql_result(' SELECT no, name FROM cms_capital_bank_account ORDER BY no ');



			for($i=0; $i<$list_num; $i++) :
				if($cb_list[$i]->inc==0) $inc = "-"; else $inc = $cb_list[$i]->inc;
				if($cb_list[$i]->exp==0) $exp = "-"; else $exp = $cb_list[$i]->exp;

				if($cb_list[$i]->account=="" || $cb_list[$i]->account=='0'){ $account = "-"; }else{ $account = "[".$cb_list[$i]->account."]"; } //계정과목

				// 수입 지출 구하기
				// (수입금이 '0' 이거나 대체거래이고, 출금계정이 은행등록계좌와 같으면,
				if($cb_list[$i]->inc==0||($cb_list[$i]->class1==3&&$cb_list[$i]->out_acc==$cb_list[$i]->no)){ $inc="-"; }else{ $inc=number_format($cb_list[$i]->inc); }// 수입금
				// 지출금이 '0' 이거나 대체거래이고 입금계정이 은행등록계좌와 같으면,
				if($cb_list[$i]->exp==0||($cb_list[$i]->class1==3&&$cb_list[$i]->in_acc==$cb_list[$i]->no)){ $exp="-"; }else{ $exp=number_format($cb_list[$i]->exp); }// 지출금

				// 입금처 출금처 구하기
				// 입금계정정보가 없거나 대체거래이고 출금계정이 은행등록계좌와 같으면,
				if($cb_list[$i]->in_acc==0||($cb_list[$i]->class1==3&&$cb_list[$i]->out_acc==$cb_list[$i]->no)){ $in_acc=""; }else{ $in_acc=$cb_list[$i]->name; } // 입금계정은 계좌별칭
				// 출금계정정보가 없거나 대체거래이고 입금계정이 은행등록계좌와 같으면,
				if($cb_list[$i]->out_acc==0||($cb_list[$i]->class1==3&&$cb_list[$i]->in_acc==$cb_list[$i]->no)){ $out_acc=""; }else{ $out_acc=$cb_list[$i]->name; } // 출금계정은 계좌별칭

				$this->excel->getActiveSheet()->setCellValue('A'.($i+3), $cb_list[$i]->deal_date);
				$this->excel->getActiveSheet()->setCellValue('B'.($i+3), c1($cb_list[$i]->class1).'-'.c2($cb_list[$i]->class2));
				$this->excel->getActiveSheet()->setCellValue('C'.($i+3), $account);
				$this->excel->getActiveSheet()->setCellValue('D'.($i+3), cut_string($cb_list[$i]->cont, 16, '..'));
				$this->excel->getActiveSheet()->setCellValue('E'.($i+3), cut_string($cb_list[$i]->acc, 10, '..'));
				$this->excel->getActiveSheet()->setCellValue('F'.($i+3), $in_acc);
				$this->excel->getActiveSheet()->setCellValue('G'.($i+3), $inc);
				$this->excel->getActiveSheet()->setCellValue('H'.($i+3), $out_acc);
				$this->excel->getActiveSheet()->setCellValue('I'.($i+3), $exp);
				$this->excel->getActiveSheet()->setCellValue('J'.($i+3), '');
				$this->excel->getActiveSheet()->setCellValue('K'.($i+3), '');
				$this->excel->getActiveSheet()->setCellValue('L'.($i+3), $cb_list[$i]->note);
			endfor;
		endif;



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
