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
	include '../php/util.php'
	// MySQL 연결
	$connect=dbconn();
	$add_where = stripslashes($_REQUEST['add_where']);
	$s_date = stripslashes($_REQUEST['s_date']);
	$e_date = stripslashes($_REQUEST['e_date']);
	$m4 = stripslashes($_REQUEST['m4']);
	$sc = stripslashes($_REQUEST['sc']);
	if($m4=='ok') $where = ' WHERE '.$add_where; else $where = $add_where;
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
	if($s_date){$s_add=" AND deal_date<'$s_date' ";}else{$s_add="  AND deal_date<'2015-05-01'  ";} // 시작일이 있으면 시작일 이후 없으면 2015-05-01부터 시작
	$query1="SELECT seq_num, class1, class2, account, cont, acc, in_acc, inc, out_acc, exp, evidence, cms_capital_cash_book.note, worker, deal_date, name, no
			    FROM cms_capital_cash_book, cms_capital_bank_account
			    $where
			    ORDER BY deal_date, seq_num";
	$result1=mysqli_query($connect, $query1);
	for($i=0; $rows1=mysqli_fetch_array($result1); $i++){
		if($sc==0){
			if($i==0){
				// 현금 최초 시재 구한다.
				$c_in_qry = " SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE in_acc = '1' AND deal_date < '".$rows1[deal_date]."'" ;
				$c_in_rlt = mysqli_query($connect, $c_in_qry);
				$c_in_row = mysqli_fetch_array($c_in_rlt);
				$c_ex_qry = " SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE out_acc = '1' AND deal_date < '".$rows1[deal_date]."'";
				$c_ex_rlt = mysqli_query($connect, $c_ex_qry);
				$c_ex_row = mysqli_fetch_array($c_ex_rlt);
				$fcash = $c_in_row[inc]-$c_ex_row[exp];
				// 예금 최초 시재 구한다.
				$b_in_qry = " SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE in_acc > '1' AND deal_date < '".$rows1[deal_date]."'";
				$b_in_rlt = mysqli_query($connect, $b_in_qry);
				$b_in_row = mysqli_fetch_array($b_in_rlt);
				$b_ex_qry = " SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE out_acc > '1' AND deal_date < '".$rows1[deal_date]."'";
				$b_ex_rlt = mysqli_query($connect, $b_ex_qry);
				$b_ex_row = mysqli_fetch_array($b_ex_rlt);
				$fbank = $b_in_row[inc]-$b_ex_row[exp];
				$cash_hand = '=SUMIF(F3,"현금",G3)-SUMIF(H3,"현금",I3)+'.$fcash;
				$bank_balance = '=SUMIF(F3,"<>현금",G3)-SUMIF(H3,"<>현금",I3)+'.$fbank;
			}else if($i>0){
				$cash_hand = '=J'.($i+2).'+SUMIF(F'.($i+3).',"현금",G'.($i+3).')-SUMIF(H'.($i+3).',"현금",I'.($i+3).')';
				$bank_balance = '=K'.($i+2).'+SUMIF(F'.($i+3).',"<>현금",G'.($i+3).')-SUMIF(H'.($i+3).',"<>현금",I'.($i+3).')';
			}
		}
		switch ($rows1[class1]) {
			case '1': $cla1="<font color='#0066ff'>[입금]</font>"; break;
			case '2': $cla1="<font color='#ff3333'>[출금]</font>"; break;
			case '3': $cla1="<font color='#669900'>[대체]</font>"; break;
		}
		switch ($rows1[class2]) {
			case '1': $cla2="<font color='#0066ff'>[자산]</font>"; break;
			case '2': $cla2="<font color='#6600ff'>[부채]</font>"; break;
			case '3': $cla2="<font color='#0066ff'>[자본]</font>"; break;
			case '4': $cla2="<font color='#009900'>[수익]</font>"; break;
			case '5': $cla2="<font color='#ff3333'>[비용]</font>"; break;
			case '6': $cla2="<font color='#009900'>[본사]</font>"; break;
			case '7': $cla2="<font color='#669900'>[현장]</font>"; break;
		}
		$cla = $cla1."-".$cla2;
		if($rows1[account]==""){ $account = "-"; }else{ $account = "[".$rows1[account]."]"; }
		if($rows1[inc]==0||($rows1[class1]==3&&$rows1[out_acc]==$rows1[no])){ $inc=""; }else{ $inc=number_format($rows1[inc]); }
		if($rows1[exp]==0||($rows1[class1]==3&&$rows1[in_acc]==$rows1[no])){ $exp=""; }else{ $exp=number_format($rows1[exp]); }
		if($rows1[acc]) {$acc=$rows1[acc];}else{$acc="-";}
		if($rows1[in_acc]==0||($rows1[class1]==3&&$rows1[out_acc]==$rows1[no])){ $in_acc=""; }else{ $in_acc=$rows1[name]; }
		if($rows1[out_acc]==0||($rows1[class1]==3&&$rows1[in_acc]==$rows1[no])){ $out_acc=""; }else{ $out_acc=$rows1[name]; }
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
		<td align="right" height="30"><? if($sc==0) echo $cash_hand;?></td>
		<td align="right" height="30"><? if($sc==0) echo $bank_balance;?></td>
		<td align="right" height="30"><?=$rows1[note]?></td>
	</tr>
<?
	}
	mysqli_free_result($result1);
?>
</table>
