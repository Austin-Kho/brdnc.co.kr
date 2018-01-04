<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daily_money_report extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m4_model'); //모델 파일 로드
		// PHPExcel 라이브러리 로드
		$this->load->library('cms_excel');
		$this->load->helper('cms_cut_string');
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
		// // 은행계좌 데이터
		// $bank_acc = $this->cms_m4_model->select_data_lt('cb_cms_capital_bank_account', '', '', '');
    //
		// // 은행 계좌별 전일 잔고 및 금일 출납, 잔고 구하기 데이터
		// for($i=0; $i<$bank_acc['num']; $i++) {
		// 	$cum_in[$i] = $this->cms_main_model->sql_result("SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='".$bank_acc['result'][$i]->no."' AND deal_date<='".$sh_date."' ");
		// 	$date_in[$i] = $this->cms_main_model->sql_result("SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='".$bank_acc['result'][$i]->no."' AND deal_date ='".$sh_date."' ");
		// 	$cum_ex[$i] = $this->cms_main_model->sql_result("SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND out_acc='".$bank_acc['result'][$i]->no."' AND deal_date<='".$sh_date."' ");
		// 	$date_ex[$i] = $this->cms_main_model->sql_result("SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND out_acc='".$bank_acc['result'][$i]->no."' AND deal_date ='".$sh_date."' ");
		// }
    //
		// // 회사 현금자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
		// $cum_inc = $this->cms_main_model->sql_result("SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND deal_date<='".$sh_date."' ");
		// $date_inc = $this->cms_main_model->sql_result("SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND deal_date ='".$sh_date."' ");
		// $date_exp = $this->cms_main_model->sql_result("SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND deal_date ='".$sh_date."' ");
		// $cum_exp = $this->cms_main_model->sql_result("SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND deal_date<='".$sh_date."' ");
		// $yd_tot = $cum_inc[0]->inc-$cum_exp[0]->exp-$date_inc[0]->inc+$date_exp[0]->exp;
		// if($date_inc[0]->inc==0) $td_inc = '-'; else $td_inc = $date_inc[0]->inc;
		// if($date_exp[0]->exp==0) $td_exp = '-'; else $td_exp = $date_exp[0]->exp;
		// $td_tot = $cum_inc[0]->inc-$cum_exp[0]->exp;
    //
		// // 조합 대여금 데이터
		// $jh_data = $this->cms_m4_model->select_data_lt('cb_cms_capital_cash_book', 'any_jh', 'any_jh<>0', 'any_jh');
		// for($i=0; $i<$jh_data['num']; $i++){
		// 	$jh_name[$i] = $this->cms_main_model->sql_result(" SELECT pj_name FROM cb_cms_project WHERE seq = '".$jh_data['result'][$i]->any_jh."' ORDER BY seq ");//조합명
		// 	$jh_cum_in[$i] = $this->cms_main_model->sql_result(" SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '".$jh_data['result'][$i]->any_jh."' AND deal_date<='".$sh_date."' "); //총 회수금
		// 	$jh_date_in[$i] = $this->cms_main_model->sql_result(" SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '".$jh_data['result'][$i]->any_jh."' AND deal_date='".$sh_date."' "); // 당일 회수
		// 	$jh_cum_ex[$i] = $this->cms_main_model->sql_result(" SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh ='".$jh_data['result'][$i]->any_jh."' AND deal_date<='".$sh_date."' "); // 총 대여금
		// 	$jh_date_ex[$i] = $this->cms_main_model->sql_result(" SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh = '".$jh_data['result'][$i]->any_jh."' AND deal_date='".$sh_date."' "); // 당일 대여
		// }
    //
		// // 조합 대여금 자산 설정일 전일잔고 및 금일 출납, 잔고 구하기 데이터
		// $jh_cum_inc = $this->cms_main_model->sql_result(" SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date<='".$sh_date."' "); //총 회수금
		// $jh_date_inc = $this->cms_main_model->sql_result(" SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND deal_date='".$sh_date."' "); // 당일 회수
		// $jh_cum_exp = $this->cms_main_model->sql_result(" SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date<='".$sh_date."' "); // 총 대여금
		// $jh_date_exp = $this->cms_main_model->sql_result(" SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND deal_date='".$sh_date."' "); // 당일 대여
    //
		// $jh_yd_tot = ($jh_cum_exp[0]->exp-$jh_cum_inc[0]->inc)+($jh_date_exp[0]->exp-$jh_date_inc[0]->inc);
		// if($jh_date_inc[0]->inc==0) $jh_td_inc = "-"; else $jh_td_inc = $jh_date_inc[0]->inc;
		// if($jh_date_exp[0]->exp==0) $jh_td_exp = "-"; else $jh_td_exp = $jh_date_exp[0]->exp;
		// $jh_td_tot = $jh_cum_exp[0]->exp-$jh_cum_inc[0]->inc;
    //
		// // 설정일 입금 내역
		// $da_in = $this->cms_m4_model->select_data_lt("cb_cms_capital_cash_book", "account, cont, acc, inc, note", "(com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='".$sh_date."'", "", "seq_num");
		// // 설정일까지 입금 내역
		// $da_in_total = $this->cms_m4_model->da_in_total('cb_cms_capital_cash_book', $sh_date);
		// // 설정일 출금내역
		// $da_ex = $this->cms_m4_model->select_data_lt("cb_cms_capital_cash_book", "account, cont, acc, exp, note", "(com_div>0) AND (class1='2' or class1='3') AND deal_date='".$sh_date."'", "", "seq_num");
		// // 설정일까지 출금내역
		// $da_ex_total = $this->cms_m4_model->da_ex_total('cb_cms_capital_cash_book', $sh_date);

		// 워크시트에서 1번째는 활성화
		$this->cms_excel->setActiveSheetIndex(0);
		// 워크시트 이름 지정
		$this->cms_excel->getActiveSheet()->setTitle('자금일보('.$sh_date.')');



		// // 본문 내용 ---------------------------------------------------------------//
		// $sum_1st = $bank_acc['num']+7;
		// $col_num = $jh_data['num']+1; // 대여회수 거래 조합 프로젝트 수 +1
		// $sum_2nd = $sum_1st+$col_num+1;
		// $in_num = $da_in['num'];
		// if($in_num<2) $numn=2; else $numn=$in_num; // 입금 내역 행수 설정;
		// $sum_3rd = $sum_2nd+$numn+5;
		// $ex_num = $da_ex['num'];
		// if($ex_num<4) $numx = 4; else $numx = $ex_num; // 출금 내역 행수 설정
    //
		// $this->excel->getActiveSheet()->getColumnDimension("A")->setWidth(10); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("B")->setWidth(7); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("C")->setWidth(7); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("D")->setWidth(7); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("E")->setWidth(7); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("F")->setWidth(12); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("G")->setWidth(5); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("H")->setWidth(9); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("I")->setWidth(9); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("J")->setWidth(9); // A열의 셀 넓이 설정
		// $this->excel->getActiveSheet()->getColumnDimension("K")->setWidth(9); // A열의 셀 넓이 설정
    //
		// $this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19.5); // 전체 기본 셀 높이 설정
		// $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(19.5); // 1행의 셀 높이 설정
		// $this->excel->getActiveSheet()->getRowDimension(2)->setRowHeight(37.5); // 2행의 셀 높이 설정
		// $this->excel->getActiveSheet()->getRowDimension(3)->setRowHeight(22.5); // 3행의 셀 높이 설정
		// $this->excel->getActiveSheet()->getRowDimension(4)->setRowHeight(33.75); // 4행의 셀 높이 설정
		// $this->excel->getActiveSheet()->getRowDimension($sum_2nd+1)->setRowHeight(33.75); // 4행의 셀 높이 설정
    //
		// $this->excel->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
		// 	array(
		// 		'font' => array('size' => 9),
		// 		'alignment' => array(
		// 			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		// 			'horizontal'   => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
		// 		)
		// 	),
		// 	'A:K'
		// );
    //
		// $this->excel->getActiveSheet()->mergeCells('A1:F2');// A1부터 D1까지 셀을 합칩니다.
		// $this->excel->getActiveSheet()->mergeCells('A3:F3');
		// $this->excel->getActiveSheet()->mergeCells('H2:H3');
		// $this->excel->getActiveSheet()->mergeCells('I2:I3');
		// $this->excel->getActiveSheet()->mergeCells('J2:J3');
		// $this->excel->getActiveSheet()->mergeCells('K2:K3');
		// $this->excel->getActiveSheet()->mergeCells('A4:J4');
		// $this->excel->getActiveSheet()->mergeCells('A5:C5');
		// $this->excel->getActiveSheet()->mergeCells('D5:E5');
		// $this->excel->getActiveSheet()->mergeCells('F5:G5');
		// $this->excel->getActiveSheet()->mergeCells('D5:E5');
		// $this->excel->getActiveSheet()->mergeCells('H5:I5');
		// $this->excel->getActiveSheet()->mergeCells('J5:K5');
		// $this->excel->getActiveSheet()->mergeCells('A'.($sum_2nd+1).':K'.($sum_2nd+1));
		// $this->excel->getActiveSheet()->mergeCells('A'.($sum_2nd+2).':K'.($sum_2nd+2));
		// $this->excel->getActiveSheet()->mergeCells('A'.($sum_3rd+1).':K'.($sum_3rd+1));
		// $this->excel->getActiveSheet()->mergeCells('A'.($sum_3rd+2).':K'.($sum_3rd+2));
    //
		// $this->excel->getActiveSheet()->getStyle('A5:K5')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		// $this->excel->getActiveSheet()->getStyle('A6:K6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCFDF2');
		// $this->excel->getActiveSheet()->getStyle('A'.$sum_1st.':K'.$sum_1st)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCFDF2');
		// $this->excel->getActiveSheet()->getStyle('A'.$sum_2nd.':K'.$sum_2nd)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCFDF2');
		// $this->excel->getActiveSheet()->getStyle('A'.($sum_2nd+3).':K'.($sum_2nd+3))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		// $this->excel->getActiveSheet()->getStyle('A'.($sum_3rd).':K'.($sum_3rd))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCFDF2');
		// $this->excel->getActiveSheet()->getStyle('A'.($sum_3rd+3).':K'.($sum_3rd+3))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		// $this->excel->getActiveSheet()->getStyle('A'.($sum_3rd+$numx+5).':K'.($sum_3rd+$numx+5))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFFCFDF2');
    //
		// $this->excel->getActiveSheet()->getStyle('A1:F3')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		// $this->excel->getActiveSheet()->getStyle('G1:G3')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		// $this->excel->getActiveSheet()->getStyle('H1:K3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		// $this->excel->getActiveSheet()->getStyle('A4:K4')->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		// $this->excel->getActiveSheet()->getStyle('A5:K'.$sum_2nd)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    //
		// $this->excel->getActiveSheet()->setCellValue('A1', '[주] 바램디앤씨 자금일보');// A1의 내용을 입력 합니다.
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);// A1의 글씨를 볼드로 변경합니다.
    //
		// $this->excel->getActiveSheet()->setCellValue('G1', '결');
		// $this->excel->getActiveSheet()->setCellValue('G2', '재');
		// $this->excel->getActiveSheet()->getStyle('G1:G2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
    //
		// $this->excel->getActiveSheet()->setCellValue('H1', '담당');
		// $this->excel->getActiveSheet()->setCellValue('I1', '전무');
		// $this->excel->getActiveSheet()->setCellValue('J1', '대표이사');
		// $this->excel->getActiveSheet()->setCellValue('K1', '회장');
		// $this->excel->getActiveSheet()->setCellValue('A3', $year.'년 '.$month.'월 '.$day.'일 '.$daily);
		// $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		// $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setIndent(4);
    //
		// $this->excel->getActiveSheet()->setCellValue('A4', '■ 자 금 현 황');
		// $this->excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		// $this->excel->getActiveSheet()->setCellValue('K4', '(단위 : 원)');
		// $this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    //
		// $this->excel->getActiveSheet()->setCellValue('A5', '구 분');
		// $this->excel->getActiveSheet()->setCellValue('D5', '전일잔액');
		// $this->excel->getActiveSheet()->setCellValue('F5', '입금(증가)');
		// $this->excel->getActiveSheet()->setCellValue('H5', '출금(감소)');
		// $this->excel->getActiveSheet()->setCellValue('J5', '금일잔액');
    //
		// for($i=0; $i<=$bank_acc['num']; $i++): // 현금계정 + 은행계좌 수 만큼 반복 한다.
		// 	if(empty($bank_acc['result'][$i]->name)) $bank_acc_name = ''; else $bank_acc_name = $bank_acc['result'][$i]->name;
		// 	if(empty($cum_in[$i][0]->inc)) $cum_inc = "0"; else $cum_inc = $cum_in[$i][0]->inc;
		// 	if($i==$bank_acc['num']) $date_inc=''; else if(empty($date_in[$i][0]->inc)) $date_inc = "-"; else $date_inc = $date_in[$i][0]->inc;
		// 	if(empty($cum_ex[$i][0]->exp)) $cum_exp = "0"; else $cum_exp = $cum_ex[$i][0]->exp;
		// 	if($i==$bank_acc['num']) $date_exp=''; else if(empty($date_ex[$i][0]->exp)) $date_exp = "-"; else $date_exp = $date_ex[$i][0]->exp;
    //
		// 	if($i==$bank_acc['num']) $balance = ''; else if($cum_inc-$cum_exp==0) $balance = '-'; else  $balance = $cum_inc-$cum_exp; // 계정별 최종 금일 시재(잔고)
		// 	if($i==$bank_acc['num']) $y_bal = ''; else if($cum_inc-$cum_exp+$date_exp-$date_inc==0) $y_bal = '-'; else $y_bal = $cum_inc-$cum_exp+$date_exp-$date_inc;
    //
		// 	if($i==0) $this->excel->getActiveSheet()->setCellValue('A6', '현 금');
		// 	if($i==1) {
		// 		$this->excel->getActiveSheet()->mergeCells('A7:A'.($bank_acc['num']+6));
		// 		$this->excel->getActiveSheet()->setCellValue('A7', '보통예금');
		// 	}
		// 	$this->excel->getActiveSheet()->mergeCells('B'.($i+6).':C'.($i+6));
		// 	$this->excel->getActiveSheet()->mergeCells('D'.($i+6).':E'.($i+6));
		// 	$this->excel->getActiveSheet()->mergeCells('F'.($i+6).':G'.($i+6));
		// 	$this->excel->getActiveSheet()->mergeCells('H'.($i+6).':I'.($i+6));
		// 	$this->excel->getActiveSheet()->mergeCells('J'.($i+6).':K'.($i+6));
    //
		// 	$this->excel->getActiveSheet()->setCellValue('B'.($i+6), $bank_acc_name);
		// 	$this->excel->getActiveSheet()->setCellValue('D'.($i+6), $y_bal);
		// 	$this->excel->getActiveSheet()->setCellValue('F'.($i+6), $date_inc);
		// 	$this->excel->getActiveSheet()->setCellValue('H'.($i+6), $date_exp);
		// 	$this->excel->getActiveSheet()->setCellValue('J'.($i+6), $balance);
		// endfor; // 현금 / 보통예금 수만큼 반복 for문 종료
    //
		// $this->excel->getActiveSheet()->mergeCells('A'.$sum_1st.':C'.$sum_1st);
		// $this->excel->getActiveSheet()->mergeCells('D'.$sum_1st.':E'.$sum_1st);
		// $this->excel->getActiveSheet()->mergeCells('F'.$sum_1st.':G'.$sum_1st);
		// $this->excel->getActiveSheet()->mergeCells('H'.$sum_1st.':I'.$sum_1st);
		// $this->excel->getActiveSheet()->mergeCells('J'.$sum_1st.':K'.$sum_1st);
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.$sum_1st, '현금성자산 계');
		// $this->excel->getActiveSheet()->setCellValue('D'.$sum_1st, $yd_tot);
		// $this->excel->getActiveSheet()->setCellValue('F'.$sum_1st, $td_inc);
		// $this->excel->getActiveSheet()->setCellValue('H'.$sum_1st, $td_exp);
		// $this->excel->getActiveSheet()->setCellValue('J'.$sum_1st, $td_tot);
    //
		// for($i=0; $i<=$jh_data['num']; $i++) : // 거래 조합 프로젝트 수 +1 만큼 반복
		// 	if(empty($jh_name[$i][$i])) $jhname = ''; else $jhname = $jh_name[$i][$i]->pj_name;
		// 	if(empty($jh_cum_in[$i][$i]->inc)) $jh_cum_inc = ""; else if($jh_cum_in[$i][$i]->inc==0)$jh_cum_inc = '-'; else $jh_cum_inc = $jh_cum_in[$i][$i]->inc;
		// 	if($i==$jh_data['num']) $jh_date_inc=""; else if($jh_date_in[$i][$i]->inc==0) $jh_date_inc = "-"; else $jh_date_inc = $jh_date_in[$i][$i]->inc;
		// 	if(empty($jh_cum_ex[$i][$i]->exp)) $jh_cum_exp = ""; else if($jh_cum_ex[$i][$i]->exp==0) $jh_cum_exp = '-'; else $jh_cum_exp = $jh_cum_ex[$i][$i]->exp;
		// 	if($i==$jh_data['num']) $jh_date_exp=""; else if($jh_date_ex[$i][$i]->exp==0) $jh_date_exp = "-"; else $jh_date_exp = $jh_date_ex[$i][$i]->exp;
    //
		// 	if($i==$jh_data['num']) $jh_balance = ''; else $jh_balance = $jh_cum_exp-$jh_cum_inc; // 계정별 최종 금일 시재(잔고)
		// 	if($i==$jh_data['num']) $jh_y_bal = ''; else $jh_y_bal = $jh_cum_exp-$jh_cum_inc+$jh_date_exp-$jh_date_inc;
    //
		// 	if($i==0) {
		// 		$this->excel->getActiveSheet()->mergeCells('A'.($sum_1st+1).':A'.($sum_1st+$col_num));
		// 		$this->excel->getActiveSheet()->setCellValue('A'.($sum_1st+1), '조합대여금');
		// 	}
		// 	$this->excel->getActiveSheet()->mergeCells('B'.($i+$sum_1st+1).':C'.($i+$sum_1st+1));
		// 	$this->excel->getActiveSheet()->mergeCells('D'.($i+$sum_1st+1).':E'.($i+$sum_1st+1));
		// 	$this->excel->getActiveSheet()->mergeCells('F'.($i+$sum_1st+1).':G'.($i+$sum_1st+1));
		// 	$this->excel->getActiveSheet()->mergeCells('H'.($i+$sum_1st+1).':I'.($i+$sum_1st+1));
		// 	$this->excel->getActiveSheet()->mergeCells('J'.($i+$sum_1st+1).':K'.($i+$sum_1st+1));
    //
		// 	$this->excel->getActiveSheet()->setCellValue('B'.($i+$sum_1st+1), cut_string($jhname, 8, ''));
		// 	$this->excel->getActiveSheet()->setCellValue('D'.($i+$sum_1st+1), $jh_y_bal);
		// 	$this->excel->getActiveSheet()->setCellValue('F'.($i+$sum_1st+1), $jh_date_exp);
		// 	$this->excel->getActiveSheet()->setCellValue('H'.($i+$sum_1st+1), $jh_date_inc);
		// 	$this->excel->getActiveSheet()->setCellValue('J'.($i+$sum_1st+1), $jh_balance);
		// endfor; // 조합 구하기 for 문 종료
    //
		// $this->excel->getActiveSheet()->mergeCells('A'.$sum_2nd.':C'.$sum_2nd);
		// $this->excel->getActiveSheet()->mergeCells('D'.$sum_2nd.':E'.$sum_2nd);
		// $this->excel->getActiveSheet()->mergeCells('F'.$sum_2nd.':G'.$sum_2nd);
		// $this->excel->getActiveSheet()->mergeCells('H'.$sum_2nd.':I'.$sum_2nd);
		// $this->excel->getActiveSheet()->mergeCells('J'.$sum_2nd.':K'.$sum_2nd);
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.$sum_2nd, '조합대여금 계');
		// $this->excel->getActiveSheet()->setCellValue('D'.$sum_2nd, $jh_yd_tot);
		// $this->excel->getActiveSheet()->setCellValue('F'.$sum_2nd, $jh_td_exp);
		// $this->excel->getActiveSheet()->setCellValue('H'.$sum_2nd, $jh_td_inc);
		// $this->excel->getActiveSheet()->setCellValue('J'.$sum_2nd, $jh_td_tot);
    //
		// $this->excel->getActiveSheet()->getStyle('D6:K'.($bank_acc['num']+$col_num+8))->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
		// $this->excel->getActiveSheet()->getStyle('D6:K'.($bank_acc['num']+$col_num+8))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.($sum_2nd+1), '■ 금 일 수 지 현 황');
		// $this->excel->getActiveSheet()->setCellValue('A'.($sum_2nd+2), '입 금 내 역');
		// $this->excel->getActiveSheet()->getStyle('A'.($sum_2nd+1).':A'.($sum_2nd+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    //
		// $this->excel->getActiveSheet()->mergeCells('A'.($sum_2nd+3).':B'.($sum_2nd+3));
		// $this->excel->getActiveSheet()->mergeCells('C'.($sum_2nd+3).':E'.($sum_2nd+3));
		// $this->excel->getActiveSheet()->mergeCells('G'.($sum_2nd+3).':H'.($sum_2nd+3));
		// $this->excel->getActiveSheet()->mergeCells('I'.($sum_2nd+3).':K'.($sum_2nd+3));
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.($sum_2nd+3), '거래처');
		// $this->excel->getActiveSheet()->setCellValue('C'.($sum_2nd+3), '적 요');
		// $this->excel->getActiveSheet()->setCellValue('F'.($sum_2nd+3), '금 액');
		// $this->excel->getActiveSheet()->setCellValue('G'.($sum_2nd+3), '계정과목');
		// $this->excel->getActiveSheet()->setCellValue('I'.($sum_2nd+3), '비 고');
    //
    //
		// for($i=0;$i<=$numn;$i++) :
		// 	if(empty($da_in['result'][$i]->acc)) $da_in_acc = ''; else $da_in_acc = $da_in['result'][$i]->acc;
		// 	if(empty($da_in['result'][$i]->cont)) $da_in_cont = ''; else $da_in_cont = $da_in['result'][$i]->cont;
		// 	if(empty($da_in['result'][$i]->inc) OR $da_in['result'][$i]->inc==0){ $income = "";}else{$income = number_format($da_in['result'][$i]->inc);}
		// 	if(empty($da_in['result'][$i]->account)) $da_in_account = ''; else $da_in_account = $da_in['result'][$i]->account;
		// 	if(empty($da_in['result'][$i]->note)) $da_in_note = ''; else $da_in_note = $da_in['result'][$i]->note;
    //
		// 	$this->excel->getActiveSheet()->mergeCells('A'.($i+$sum_2nd+4).':B'.($i+$sum_2nd+4));
		// 	$this->excel->getActiveSheet()->mergeCells('C'.($i+$sum_2nd+4).':E'.($i+$sum_2nd+4));
		// 	$this->excel->getActiveSheet()->mergeCells('G'.($i+$sum_2nd+4).':H'.($i+$sum_2nd+4));
		// 	$this->excel->getActiveSheet()->mergeCells('I'.($i+$sum_2nd+4).':K'.($i+$sum_2nd+4));
    //
		// 	$this->excel->getActiveSheet()->setCellValue('A'.($i+$sum_2nd+4), cut_string($da_in_acc,16,""));
		// 	$this->excel->getActiveSheet()->setCellValue('C'.($i+$sum_2nd+4), cut_string($da_in_cont,20,""));
		// 	$this->excel->getActiveSheet()->getStyle('A'.($i+$sum_2nd+4).':C'.($i+$sum_2nd+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		// 	$this->excel->getActiveSheet()->setCellValue('F'.($i+$sum_2nd+4), $income);
		// 	$this->excel->getActiveSheet()->getStyle('F'.($i+$sum_2nd+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		// 	$this->excel->getActiveSheet()->setCellValue('G'.($i+$sum_2nd+4), cut_string($da_in_account,10,""));
		// 	$this->excel->getActiveSheet()->setCellValue('I'.($i+$sum_2nd+4), cut_string($da_in_note,20,""));
		// endfor;
    //
		// $this->excel->getActiveSheet()->mergeCells('A'.$sum_3rd.':E'.$sum_3rd);
		// $this->excel->getActiveSheet()->mergeCells('G'.$sum_3rd.':H'.$sum_3rd);
		// $this->excel->getActiveSheet()->mergeCells('I'.$sum_3rd.':K'.$sum_3rd);
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.$sum_3rd, '입금합계');
		// $this->excel->getActiveSheet()->setCellValue('F'.$sum_3rd, $da_in_total[0]->total_inc);
		// $this->excel->getActiveSheet()->getStyle('F'.$sum_3rd)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		// $this->excel->getActiveSheet()->getStyle('F'.($sum_2nd+4).':F'.$sum_3rd)->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
    //
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.($sum_3rd+2), '출 금 내 역');
		// $this->excel->getActiveSheet()->getStyle('A'.($sum_3rd+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    //
		// $this->excel->getActiveSheet()->mergeCells('A'.($sum_3rd+3).':B'.($sum_3rd+3));
		// $this->excel->getActiveSheet()->mergeCells('C'.($sum_3rd+3).':E'.($sum_3rd+3));
		// $this->excel->getActiveSheet()->mergeCells('G'.($sum_3rd+3).':H'.($sum_3rd+3));
		// $this->excel->getActiveSheet()->mergeCells('I'.($sum_3rd+3).':K'.($sum_3rd+3));
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.($sum_3rd+3), '거래처');
		// $this->excel->getActiveSheet()->setCellValue('C'.($sum_3rd+3), '적 요');
		// $this->excel->getActiveSheet()->setCellValue('F'.($sum_3rd+3), '금 액');
		// $this->excel->getActiveSheet()->setCellValue('G'.($sum_3rd+3), '계정과목');
		// $this->excel->getActiveSheet()->setCellValue('I'.($sum_3rd+3), '비 고');



		// for($i=0;$i<=$numx;$i++):
		// 	if(empty($da_ex['result'][$i]->acc)) $da_ex_acc = ''; else $da_ex_acc = $da_ex['result'][$i]->acc;
		// 	if(empty($da_ex['result'][$i]->cont)) $da_ex_cont = ''; else $da_ex_cont = $da_ex['result'][$i]->cont;
		// 	if(empty($da_ex['result'][$i]->exp) OR $da_ex['result'][$i]->exp==0){ $exp = ""; }else{ $exp = number_format($da_ex['result'][$i]->exp); }
		// 	if(empty($da_ex['result'][$i]->account)) $da_ex_account = ''; else $da_ex_account = $da_ex['result'][$i]->account;
		// 	if(empty($da_ex['result'][$i]->note)) $da_ex_note = ''; else $da_ex_note = $da_ex['result'][$i]->note;
    //
		// 	$this->excel->getActiveSheet()->mergeCells('A'.($i+$sum_3rd+4).':B'.($i+$sum_3rd+4));
		// 	$this->excel->getActiveSheet()->mergeCells('C'.($i+$sum_3rd+4).':E'.($i+$sum_3rd+4));
		// 	$this->excel->getActiveSheet()->mergeCells('G'.($i+$sum_3rd+4).':H'.($i+$sum_3rd+4));
		// 	$this->excel->getActiveSheet()->mergeCells('I'.($i+$sum_3rd+4).':K'.($i+$sum_3rd+4));
    //
		// 	$this->excel->getActiveSheet()->setCellValue('A'.($i+$sum_3rd+4), cut_string($da_ex_acc,16,""));
		// 	$this->excel->getActiveSheet()->setCellValue('C'.($i+$sum_3rd+4), cut_string($da_ex_cont,20,""));
		// 	$this->excel->getActiveSheet()->getStyle('A'.($i+$sum_3rd+4).':C'.($i+$sum_3rd+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		// 	$this->excel->getActiveSheet()->setCellValue('F'.($i+$sum_3rd+4), $exp);
		// 	$this->excel->getActiveSheet()->getStyle('F'.($i+$sum_3rd+4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		// 	$this->excel->getActiveSheet()->setCellValue('G'.($i+$sum_3rd+4), cut_string($da_ex_account,10,""));
		// 	$this->excel->getActiveSheet()->setCellValue('I'.($i+$sum_3rd+4), cut_string($da_ex_note,20,""));
		// endfor;
		// $this->excel->getActiveSheet()->mergeCells('A'.($sum_3rd+$numx+5).':E'.($sum_3rd+$numx+5));
		// $this->excel->getActiveSheet()->mergeCells('G'.($sum_3rd+$numx+5).':H'.($sum_3rd+$numx+5));
		// $this->excel->getActiveSheet()->mergeCells('I'.($sum_3rd+$numx+5).':K'.($sum_3rd+$numx+5));
    //
		// $this->excel->getActiveSheet()->setCellValue('A'.($sum_3rd+$numx+5), '출금합계');
		// $this->excel->getActiveSheet()->setCellValue('F'.($sum_3rd+$numx+5), $da_ex_total[0]->total_exp);
		// $this->excel->getActiveSheet()->getStyle('F'.($sum_3rd+$numx+5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		// $this->excel->getActiveSheet()->getStyle('F'.($sum_3rd+4).':F'.($sum_3rd+$numx+5))->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)
		// $this->excel->getActiveSheet()->getStyle('A'.($sum_2nd+1).':K'.($sum_3rd+$numx+5))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


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
