<?php
defined('BASEPATH') or exit('No direct script access allowed');
Header("Content-type: application/vnd.ms-excel; charset=UTF-8");
Header("Content-Disposition: attachment; filename=" . iconv("UTF-8", "cp949//IGNORE", $project->pj_name . "_수납_데이터(" . date('Y-m-d') . ").xls"));
Header("Content-Description: PHP7 Generated Data");
Header("Pragma: no-cache");
Header("Expires: 0");

// 테이블 상단 만들기
echo $EXCEL_STR1 = "
  <table border='1'>
    <tr align='center' height='48'>
      <td colspan='11' style='font-size:15pt; text-align:center;'><b>" . $project->pj_name . " 수납 데이터</b></td>
    </tr>
    <tr><td  colspan='11' align='right' height='20' style='font-size:9pt;'>" . date('Y-m-d') . " 현재</td></tr>
    <tr align='center' height='20' style='font-size:9pt;'>
      <td width='50' bgcolor='#EAEAEA'>no.</td>
      <td width='80' bgcolor='#EAEAEA'>일련번호</td>
      <td width='90' bgcolor='#EAEAEA'>계약자</td>
      <td width='70' bgcolor='#EAEAEA'>타입</td>
      <td width='100' bgcolor='#EAEAEA'>동호수</td>
      <td width='90' bgcolor='#EAEAEA'>수납 일자</td>
      <td width='100' bgcolor='#EAEAEA'>수납 금액</td>
      <td width='120' bgcolor='#EAEAEA'>입금자</td>
      <td width='100' bgcolor='#EAEAEA'>입금 계좌</td>
      <td width='100' bgcolor='#EAEAEA'>납입 회차</td>
      <td width='110' bgcolor='#EAEAEA'>당 건 총입금액</td>
    </tr>
  ";

$i = 1;
// 데이터 가져오기 시작
foreach ($rec_data as $lt) :
  $dong_ho = explode("-", $lt->unit_dong_ho);

  $code = $this->cms_main_model->sql_row(
    " SELECT cont_code
      FROM cb_cms_sales_contract
      WHERE pj_seq='$pj_seq' AND seq='$lt->cont_seq' "
  );
  $contractor = $this->cms_main_model->sql_row(
    " SELECT contractor AS ct
      FROM cb_cms_sales_contractor
      WHERE cont_seq='$lt->cont_seq' "
  );
  $total_rec = $this->cms_main_model->sql_row(
    " SELECT SUM(paid_amount) AS pa
      FROM cb_cms_sales_received
      WHERE pj_seq='$pj_seq' AND cb_cms_sales_received.cont_seq='$lt->cont_seq'
      GROUP BY cb_cms_sales_received.cont_seq "
  );

  echo $EXCEL_STR2 = "
<tr   height='20' style='font-size:9pt;'>
   <td align='center'>" . $i . "</td>
   <td align='center'>" . $code->cont_code . "</td>
	 <td align='center'>" . $contractor->ct . "</td>
	 <td align='center'>" . $lt->unit_type . "</td>
	 <td align='center'>" . $lt->unit_dong_ho . "</td>
	 <td align='center'>" . $lt->paid_date . "</td>
	 <td align='right'>" . number_format($lt->paid_amount) . "</td>
	 <td align='center'>" . $lt->paid_who . "</td>
   <td align='center'>" . $lt->acc_nick . "</td>
   <td align='center'>" . $lt->pay_name . "</td>
   <td align='right'>" . number_format($total_rec->pa) . "</td>
</tr>
   ";
  $i++;
endforeach;

echo $EXCEL_STR3 = "</table>";

echo "<meta content='application/vnd.ms-excel; charset=UTF-8' name='Content-type'> ";

// End of this file
