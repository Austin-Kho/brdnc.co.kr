<?
session_start();
Header("Content-type: application/vnd.ms-excel");
Header("Content-type: charset=UTF-8");
Header("Content-Disposition: attachment; filename=cash_book.xls");
Header("Content-Description: PHP5 Generated Data");
Header("Pragma: no-cache");
Header("Expires: 0");

	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();


	$add_where = stripslashes($_REQUEST['add_where']);
	$s_date = stripslashes($_REQUEST['s_date']);
	$e_date = stripslashes($_REQUEST['e_date']);

	if(!$e_date){
		 $add_end="";
	}else{
		 $add_end=" and deal_date<='$e_date' ";
	}
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<table border="1">
	<tr align="center" height="45">
			<td colspan="11" style="font-size:15pt; text-align:center;"><b><?=$com_title?> 금전 출납부</b></td>
	</tr>
	<tr align="center" height="35">
			<td width="80" bgcolor="#EAEAEA">거래일자</td>
			<td width="80" bgcolor="#EAEAEA"> 구 분</td>
			<td width="100" bgcolor="#EAEAEA"> 계정과목</td>
			<td width="250" bgcolor="#EAEAEA">적 요</td>
			<td width="100" bgcolor="#EAEAEA">거 래 처</td>
			<td width="100" bgcolor="#EAEAEA">입금처</td>
			<td width="100" bgcolor="#EAEAEA">입금금액</td>
			<td width="100" bgcolor="#EAEAEA">지출처</td>
			<td width="100" bgcolor="#EAEAEA">지출금액</td>
			<td width="100" bgcolor="#EAEAEA">현금시재</td>
			<td width="100" bgcolor="#EAEAEA">예금잔고</td>
			<td width="100" bgcolor="#EAEAEA">비 고</td>
	</tr>
<?
	if($s_date){$s_add=" AND deal_date<'$s_date' ";}else{$s_add="  AND deal_date<'2000-01-01'  ";} // 시작일이 있으면 시작일 이후 없으면 2000-01-01부터 시작

	$query1="SELECT seq_num, class1, class2, account, cont, acc, in_acc, inc, out_acc, exp, evidence, cms_capital_cash_book.note, worker, deal_date, name, no
			    FROM cms_capital_cash_book, cms_capital_bank_account
			    $add_where
			    ORDER BY deal_date, seq_num";
	$result1=mysql_query($query1, $connect);
	for($i=0; $rows1=mysql_fetch_array($result1); $i++){

		 if($rows1[out_acc]==1||($rows1[class1]==3&&$rows1[out_acc]==1)) $cash_hand-=$rows1[exp];
		 if($rows1[class1]==3&&$rows1[out_acc]==1&&$rows1[in_acc]==$rows1[no]) $cash_hand = $cash_hand+$rows1[exp];

		 if($rows1[in_acc]==1||($rows1[class1]==3&&$rows1[in_acc]==1)) $cash_hand+=$rows1[inc];
		 if($rows1[class1]==3&&$rows1[in_acc]==1&&$rows1[out_acc]==$rows1[no]) $cash_hand = $cash_hand-$rows1[inc];

		 if($rows1[out_acc]>1||($rows1[class1]==3&&$rows1[out_acc]>1)) $bank_balance-=$rows1[exp];
		 if($rows1[class1]==3&&$rows1[out_acc]>1&&$rows1[in_acc]==$rows1[no]) $bank_balance = $bank_balance+$rows1[exp];

		 if($rows1[in_acc]>1||($rows1[class1]==3&&$rows1[in_acc]>1)) $bank_balance+=$rows1[inc];
		 if($rows1[class1]==3&&$rows1[in_acc]>1&&$rows1[out_acc]==$rows1[no]) $bank_balance = $bank_balance-$rows1[inc];

		 if($rows1[class1]==1) $cla1="<font color='#0066ff'>[입금]</font>";
		 if($rows1[class1]==2) $cla1="<font color='#ff3333'>[출금]</font>";
		 if($rows1[class1]==3) $cla1="<font color='#669900'>[대체]</font>";
		 if($rows1[class2]==1) $cla2="<font color='#0066ff'>[수익]</font>";
		 if($rows1[class2]==2) $cla2="<font color='#6600ff'>[차용]</font>";
		 if($rows1[class2]==3) $cla2="<font color='#0066ff'>[회수]</font>";
		 if($rows1[class2]==4) $cla2="<font color='#ff3333'>[비용]</font>";
		 if($rows1[class2]==5) $cla2="<font color='#009900'>[상환]</font>";
		 if($rows1[class2]==6) $cla2="<font color='#009900'>[대여]</font>";
		 if($rows1[class2]==7) $cla2="<font color='#669900'>[본사]</font>";
		  if($rows1[class2]==8) $cla2="<font color='#669900'>[현장]</font>";

		 $cla = $cla1."-".$cla2;
		 if($rows1[account]==""){
			 $account = "-";
		 }else{
			 $account = "[".$rows1[account]."]";
		 }

		 if($rows1[inc]==0||($rows1[class1]==3&&$rows1[out_acc]==$rows1[no])){
				$inc="-";
		 }else{
				$inc=number_format($rows1[inc]);
		 }
		 if($rows1[exp]==0||($rows1[class1]==3&&$rows1[in_acc]==$rows1[no])){
				$exp="-";
		 }else{
				$exp=number_format($rows1[exp]);
     }

		 if($rows1[acc]) {$acc=$rows1[acc];}else{$acc="-";}

		 if($rows1[in_acc]==0||($rows1[class1]==3&&$rows1[out_acc]==$rows1[no])){
				$in_acc="";
		 }else{
				$in_acc=$rows1[name];
		 }
		 if($rows1[out_acc]==0||($rows1[class1]==3&&$rows1[in_acc]==$rows1[no])){
				$out_acc="";
		 }else{
				$out_acc=$rows1[name];
		 }
?>
	<tr>
		<td align="center" height="30"><?=$rows1[deal_date]?></td>
		<td align="center" height="30"><?=$cla?></td>
		<td align="center"><?=$account?></td>
		<td align="left" height="30"><?=$rows1[cont]?></td>
		<td align="left" height="30"><?=$acc?></td>
		<td align="center" height="30" bgcolor="#ECECFF"><?=$in_acc?></td>
		<td align="right" height="30" bgcolor="#ECECFF"><?=$inc?></td>
		<td align="center" height="30" bgcolor="#FFF0F0"><?=$out_acc?></td>
		<td align="right" height="30" bgcolor="#FFF0F0"><?=$exp?></td>
		<td align="right" height="30"><?=number_format($cash_hand)?></td>
		<td align="right" height="30"><?=number_format($bank_balance)?></td>
		<td align="right" height="30"><?=$rows1[note]?></td>
	</tr>
<?
	 }
	 mysql_free_result($result1);
?>
</table>
<p>
<table border=1>
<tr>
<?
	$cash1=" SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0 AND in_acc='1' AND class2<>8) OR (com_div IS NULL AND in_acc=1 AND class2=7) $e_add  "; // 현금수입금 합계 구하기
	$ca_qry1=mysql_query( $cash1, $connect);
	$ca_row1=mysql_fetch_array($ca_qry1);
	$cash2="SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND out_acc='1' $e_add "; // 현금지출금 합계 구하기
	$ca_qry2=mysql_query( $cash2, $connect);
	$ca_row2=mysql_fetch_array($ca_qry2);

	$b_bal1="SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0 AND in_acc>'1' AND class2<>8) OR (com_div IS NULL AND in_acc>1 AND class2=7)  $e_add   "; // 계좌수입금 합계 구하기
	$b_qry1=mysql_query($b_bal1, $connect);
	$b_row1=mysql_fetch_array($b_qry1);
	$b_bal2="SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND out_acc>'1'  $e_add   "; // 계좌지출금 합계 구하기
	$b_qry2=mysql_query($b_bal2, $connect);
	$b_row2=mysql_fetch_array($b_qry2);

	$dept1=" SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='2' $e_add   "; // 차용금 합계 구하기
	$de_qry1=mysql_query( $dept1, $connect);
	$de_row1=mysql_fetch_array($de_qry1);
	$dept2=" SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='5'  $e_add   "; // 상환금 합계 구하기
	$de_qry2=mysql_query( $dept2, $connect);
	$de_row2=mysql_fetch_array($de_qry2);

	$loan1=" SELECT SUM(exp) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='6'  $e_add   "; // 대여금 합계 구하기
	$lo_qry1=mysql_query( $loan1, $connect);
	$lo_row1=mysql_fetch_array($lo_qry1);
	$loan2=" SELECT SUM(inc) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='3'  $e_add   "; // 회수금 합계 구하기
	$lo_qry2=mysql_query( $loan2, $connect);
	$lo_row2=mysql_fetch_array($lo_qry2);

	$cash_hand = number_format($ca_row1[in_total]-$ca_row2[out_total])." 원"; // 현금시재
	$bank_balance=number_format($b_row1[in_total]-$b_row2[out_total])." 원"; // 계좌잔고
	$dept=number_format($de_row1[in_total]-$de_row2[out_total])." 원"; // 차용금 잔고
	$loan=number_format($lo_row1[in_total]-$lo_row2[out_total])." 원"; // 대여금 잔고
	if($bank_balance==0) $bank_balance="-";
	if($cash_hand==0) $cash_hand="-";
	if($dept==0) $dept="-";
	if($loan==0) $loan="-";
?>
	<td height="50" bgcolor="#ffffcc" align="center" colspan="11"> 현금시재 : <?= $cash_hand?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 예금잔고: <?=$bank_balance?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 차입금잔고 : <?=$dept?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; 대여금잔고 : <?=$loan?> </td>
</tr>
</table>
