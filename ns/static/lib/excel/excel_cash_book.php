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


	$where = stripslashes($_REQUEST['where']);
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<table border="1">
	<tr align="center" height="45">
			<td colspan="12" style="font-size:15pt; text-align:center;"><b><?=$com_title?> 자금 출납부</b></td>
	</tr>
	<tr align="center" height="35" style="font-size:9pt;">
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
	$query1="SELECT seq_num, class1, class2, account, cont, acc, in_acc, inc, out_acc, exp, evidence, cms_capital_cash_book.note, worker, deal_date, name, no
			    FROM cms_capital_cash_book, cms_capital_bank_account
			    $where
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

		 if($rows1[class2]==1) $cla2="<font color='#0066ff'>[자산]</font>";
		 if($rows1[class2]==2) $cla2="<font color='#6600ff'>[부채]</font>";
		 if($rows1[class2]==3) $cla2="<font color='#0066ff'>[자본]</font>";
		 if($rows1[class2]==4) $cla2="<font color='#ff3333'>[수익]</font>";
		 if($rows1[class2]==5) $cla2="<font color='#009900'>[비용]</font>";
		 if($rows1[class2]==6) $cla2="<font color='#009900'>[본사]</font>";
		 if($rows1[class2]==7) $cla2="<font color='#669900'>[현장]</font>";

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
	<tr  style="font-size:9pt;">
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
	 mysqli_free_result($result1);
?>
</table>
