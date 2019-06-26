<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
// Header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
// Header("Content-Disposition: attachment; filename=".iconv("UTF-8","cp949//IGNORE", "입출금_내역서(".date('Y-m-d').").xls"));
// Header("Content-Description: PHP7 Generated Data" );
// Header("Pragma: no-cache");
// Header("Expires: 0");

// $company = ($com_title->co_name===NULL) ? "회사" : $com_title->co_name;

// // 테이블 상단 만들기
// echo $EXCEL_STR1 = "
//   <table border='1'>
//     <tr align='center' height='45'>
//       <td colspan='12' style='font-size:15pt; text-align:center;'><b>".$company." 자금 출납부</b></td>
//     </tr>
//     <tr align='center' height='35' style='font-size:9pt;'>
//       <td width='80' bgcolor='#EAEAEA'>거래일자</td>
//       <td width='80' bgcolor='#EAEAEA'> 구 분</td>
//       <td width='100' bgcolor='#EAEAEA'> 계정과목</td>
//       <td width='250' bgcolor='#EAEAEA'>적 요</td>
//       <td width='100' bgcolor='#EAEAEA'>거 래 처</td>
//       <td width='100' bgcolor='#EAEAEA'>입금처</td>
//       <td width='100' bgcolor='#EAEAEA'>입금금액</td>
//       <td width='100' bgcolor='#EAEAEA'>지출처</td>
//       <td width='100' bgcolor='#EAEAEA'>지출금액</td>
//       <td width='100' bgcolor='#EAEAEA'>현금시재</td>
//       <td width='100' bgcolor='#EAEAEA'>예금잔고</td>
//       <td width='100' bgcolor='#EAEAEA'>비 고</td>
//     </tr>
//   ";

// $i = 0;
// // 데이터 가져오기 시작
// foreach ($cash_book_list as $lt) :

//   if($sc==0):
//   	if($i==0) : // 전장이월 행, 즉 1행
//   		// 현금 최초 시재 구한다.
//   		$c_in_qry = " SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE in_acc = '1' AND deal_date < '".$lt->deal_date."'" ;
//   		$c_in_row = $this->cms_main_model->sql_row($c_in_qry);

//   		$c_ex_qry = " SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE out_acc = '1' AND deal_date < '".$lt->deal_date."'";
//   		$c_ex_row = $this->cms_main_model->sql_row($c_ex_qry);

//   		$fcash = $c_in_row->inc-$c_ex_row->exp; // 전일 현금 시재

//   		// 예금 최초 시재 구한다.
//   		$b_in_qry = " SELECT SUM(inc) AS inc FROM cb_cms_capital_cash_book WHERE in_acc > '1' AND deal_date < '".$lt->deal_date."'";
//   		$b_in_row = $this->cms_main_model->sql_row($b_in_qry);

//   		$b_ex_qry = " SELECT SUM(exp) AS exp FROM cb_cms_capital_cash_book WHERE out_acc > '1' AND deal_date < '".$lt->deal_date."'";
//   		$b_ex_row = $this->cms_main_model->sql_row($b_ex_qry);

//   		$fbank = $b_in_row->inc-$b_ex_row->exp; // 전일 예금 잔고

//   		$cash_hand = '=SUMIF(F3,"현금",G3)-SUMIF(H3,"현금",I3)+'.$fcash; // 금일 현금 시재
//   		$bank_balance = '=SUMIF(F3,"<>현금",G3)-SUMIF(H3,"<>현금",I3)+'.$fbank; // 금일 예금 잔고

//   	elseif($i>0) :
//   		$cash_hand = '=J'.($i+2).'+SUMIF(F'.($i+3).',"현금",G'.($i+3).')-SUMIF(H'.($i+3).',"현금",I'.($i+3).')';        // 금일 현금 시재
//   		$bank_balance = '=K'.($i+2).'+SUMIF(F'.($i+3).',"<>현금",G'.($i+3).')-SUMIF(H'.($i+3).',"<>현금",I'.($i+3).')'; // 금일 예금 잔고

//   	endif;
//   endif;
//   $i++;

// switch ($lt->class1) :
// 	case '1': $cla1="<font color='#0066ff'>[입금]</font>"; break;
// 	case '2': $cla1="<font color='#ff3333'>[출금]</font>"; break;
// 	case '3': $cla1="<font color='#669900'>[대체]</font>"; break;
// endswitch;

// switch ($lt->class2) :
// 	case '1': $cla2="<font color='#0066ff'>[자산]</font>"; break;
// 	case '2': $cla2="<font color='#6600ff'>[부채]</font>"; break;
// 	case '3': $cla2="<font color='#0066ff'>[자본]</font>"; break;
// 	case '4': $cla2="<font color='#009900'>[수익]</font>"; break;
// 	case '5': $cla2="<font color='#ff3333'>[비용]</font>"; break;
// 	case '6': $cla2="<font color='#009900'>[본사]</font>"; break;
// 	case '7': $cla2="<font color='#669900'>[현장]</font>"; break;
// endswitch;

// $cla = $cla1."-".$cla2;  // 대분류
// $account = ($lt->account=="") ? "-" : "[".$lt->account."]"; // 계정과목
// $acc = ($lt->acc) ? $lt->acc : "-"; // 거래처
// $in_acc = ($lt->in_acc==0 or ($lt->class1==3 && $lt->out_acc==$lt->no)) ? "" : $lt->name; // 입금계정
// $out_acc = ($lt->out_acc==0 or ($lt->class1==3 && $lt->in_acc==$lt->no)) ? "" : $lt->name; // 출금계정
// $inc = ($lt->inc==0 or ($lt->class1==3 && $lt->out_acc==$lt->no)) ? "" : number_format($lt->inc); // 입금액
// $exp = ($lt->exp==0 or ($lt->class1==3 && $lt->in_acc==$lt->no)) ? "" : number_format($lt->exp);  // 출금액

// echo $EXCEL_STR2 = "
// <tr  style='font-size:9pt;'>
// 	 <td align='center' height='30'>".$lt->deal_date."</td>
// 	 <td align='center'>".$cla."</td>
// 	 <td align='center'>".$account."</td>
// 	 <td align='left'>".$lt->cont."</td>
// 	 <td align='left'>".$acc."</td>
// 	 <td align='center' bgcolor=''#ECECFF'>".$in_acc."</td>
// 	 <td align='right' bgcolor='#ECECFF'>".$inc."</td>
// 	 <td align='center' bgcolor='#FFF0F0'>".$out_acc."</td>
// 	 <td align='right' bgcolor='#FFF0F0'>".$exp."</td>
// 	 <td align='right'>".$cash_hand."</td>
// 	 <td align='right'>".$bank_balance."</td>
// 	 <td align='right'>".$lt->note."</td>
// </tr>
//    ";
// endforeach;

// echo $EXCEL_STR3 = "</table>";

// echo "<meta content='application/vnd.ms-excel; charset=UTF-8' name='Content-type'> ";

// End of this file
