<?
session_start();
Header("Content-type: application/vnd.ms-excel");
Header("Content-type: charset=UTF-8");
$sh_date = stripslashes($_REQUEST['sh_date']);
Header("Content-Disposition: attachment; filename=daily_money_report_".$sh_date.".xls");
Header("Content-Description: PHP5 Generated Data");
Header("Pragma: no-cache");
Header("Expires: 0");

	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

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
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"

<!-- td 11ea -->
<table border="1">
	<tr align="center" height="26" style="font-size: 9pt;">
		<td style="font-size:18pt; border-bottom: 0; width:328px;" rowspan="2" colspan="6"><b><?=$com_title?> 자금일보</b></td>
		<td style="width:36px;" valign="bottom" rowspan="3">결<br>재</td>
		<td style="width:64px;">대리</td>
		<td style="width:64px;">전무</td>
		<td style="width:64px;">대표이사</td>
		<td style="width:64px;">회장</td>
	</tr>
	<tr align="center" height="50" style="font-size: 9pt;">
		<td style="" rowspan="2"></td>
		<td style="" rowspan="2"></td>
		<td style="" rowspan="2"></td>
		<td style="" rowspan="2"></td>
	</tr>
	<tr height="30" style="font-size: 9pt;">
		<td style="border-top:0; text-align: right; padding-right: 50px;" colspan="6"><?=$year."년 ".$month."월 ".$day."일 ".$daily?></td>
	</tr>
	<tr height="45" style="font-size: 9pt;">
		<td style="border-right: 0;" colspan="10">■ 자 금 현 황</td>
		<td style="border-left: 0; text-align: right;">(단위 : 원)</td>
	</tr>
	<tr align="center" height="26" style="font-size: 9pt;">
		<td style="background-color:#eaeaea; width=192px;" colspan="3">구 분</td>
		<td style="background-color:#eaeaea; width=120px;" colspan="2">전일잔액</td>
		<td style="background-color:#eaeaea;" colspan="2">입금(증가)</td>
		<td style="background-color:#eaeaea;" colspan="2">출금(감소)</td>
		<td style="background-color:#eaeaea;" colspan="2">금일잔액</td>
	</tr>
	<?
		$d_qry=" SELECT * FROM cms_capital_bank_account "; // 은행계좌 정보 테이블
		$d_rlt=mysql_query($d_qry, $connect);
		$d_num=mysql_num_rows($d_rlt);
		$num=$d_num;  // 행수 설정;

		for($i=0; $i<=$num; $i++){ // 현금계정 + 은행계좌 수 만큼 반복 한다.
			if($i==0) $hk_bgcolor = " color:#000099; background-color:#FCFDF2; "; else $hk_bgcolor = "";
			$d_rows=mysql_fetch_array($d_rlt);

			if($i==0) $td_str="<td align='center' style='width:72px;; ".$hk_bgcolor."'>현금</td>";
			if($i==1) $td_str="<td align='center' rowspan='$num'>보통예금</td>";
			if($i>1) $td_str="";

			$in_qry="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='$d_rows[no]' AND deal_date<='$sh_date' "; // 계정별 설정일까지 총 수입
			$in_rlt=mysql_query($in_qry,$connect);
			$in_row=mysql_fetch_array($in_rlt);

			$in_qry1="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='$d_rows[no]' AND deal_date='$sh_date' "; // 계정별 설정당일 수입
			$in_rlt1=mysql_query($in_qry1,$connect);
			$in_row1=mysql_fetch_array($in_rlt1);

			$ex_qry="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date<='$sh_date' "; // 계정별 설정일까지 총 지출
			$ex_rlt=mysql_query($ex_qry,$connect);
			$ex_row=mysql_fetch_array($ex_rlt);

			$ex_qry1="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date='$sh_date' "; // 계정별 설정당일 지출
			$ex_rlt1=mysql_query($ex_qry1,$connect);
			$ex_row1=mysql_fetch_array($ex_rlt1);

			if(!$d_rows[name]){   // 입출금 계정이 없으면
				$balance=""; // 최종 금일 시재(잔고)
			}else	if($in_row[inc]==$ex_row[exp]){ // 계정별 총 입금과 지출이 동일하면
				$balance="-"; // 최종 금일 시재(잔고)
			}else{ // 그렇지 않으면
				$balance=number_format($in_row[inc]-$ex_row[exp]); // 계정별 최종 금일 시재(잔고)
			}

			if(!$d_rows[name]){   // 설정 당일 수입 구하기-> 입출금 계정이 없으면
				$d_inc=""; // 해당 계정 당일 입금(증가)
			}else	if($in_row1[inc]==0){ //
				$d_inc="-"; // 해당 계정 당일 입금(증가)
			}else{
				$d_inc=number_format($in_row1[inc]); // 해당 계정 당일 입금(증가)
			}
			if(!$d_rows[name]){   // 설정 당일 지출 구하기
				$d_exp=""; // 해당 계정 당일 출금 (감소)
			}else	if($ex_row1[exp]==0){
				$d_exp="-"; // 해당 계정 당일 출금 (감소)
			}else{
				$d_exp=number_format($ex_row1[exp]);  // 해당 계정 당일 출금 (감소)
			}

			if(!$d_rows[name]){  // 전일 잔액 구하기
				$y_bal="";
			}else if(($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]==0){
				$y_bal="-";
			}else{
				$y_bal=number_format(($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]);
			}

		$total_y_ba+=($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]; // 토탈 전일 잔액
		if($i>0) $yk_total_y_ba += ($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]; // 보통예금 토탈 전일 잔액
		$total_d_inc+=$in_row1[inc]; // 금일 입금(증가)
		if($i>0) $yk_total_d_inc+=$in_row1[inc]; // 보통예금 금일 입금(증가)
		$total_d_exp+=$ex_row1[exp]; //금일 출금(감소)
		if($i>0) $yk_total_d_exp+=$ex_row1[exp]; //보통예금 금일 출금(감소)
		$total_ba+=$in_row[inc]-$ex_row[exp]; // 금일 잔액
		if($i>0) $yk_total_ba+=$in_row[inc]-$ex_row[exp]; // 보통예금 금일 잔액
	?>
	<tr align="center" height="26" style="font-size: 9pt;">
		<?=$td_str?>
		<td style="text-align: center; <?=$hk_bgcolor?>" colspan="2"><?=$d_rows[name]?></td>
		<td style="text-align: right; padding-right: 18px; <?=$hk_bgcolor?>" colspan="2"><?=$y_bal?></td>
		<td style="text-align: right; padding-right: 18px; <?=$hk_bgcolor?>" colspan="2"><?=$d_inc?></td>
		<td style="text-align: right; padding-right: 18px; <?=$hk_bgcolor?>" colspan="2"><?=$d_exp?></td>
		<td style="text-align: right; padding-right: 18px; <?=$hk_bgcolor?>" colspan="2"><?=$balance?></td>
	</tr>
	<?
		} // 현금 / 보통예금 수만큼 반복 for문 종료
	?>
	<tr align="center" height="26" style="font-size: 9pt;">
		<td style="text-align: center; color:#000099; background-color:#FCFDF2;" colspan="3">보통예금(가용자금) 계</td>
		<td style="text-align: right; padding-right: 18px; color:#000099; background-color:#FCFDF2;" colspan="2"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($yk_total_y_ba==0){echo "-";}else{echo number_format($yk_total_y_ba);}?></td>
		<td style="text-align: right; padding-right: 18px; color:blue; background-color:#FCFDF2;" colspan="2"><?if($total_d_inc==0){echo "-";}else{echo  number_format($yk_total_d_inc);}?></font></td>
		<td style="text-align: right; padding-right: 18px; color:red; background-color:#FCFDF2;" colspan="2"><?if($total_d_exp==0){echo "-";}else{echo number_format($yk_total_d_exp);}?></font></td>
		<td style="text-align: right; padding-right: 18px; color:#000099; background-color:#FCFDF2;" colspan="2"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($yk_total_ba==0){echo "-";}else{echo number_format($yk_total_ba);}?></font></td>
	</tr>
	<!-- -----------------------------------------대여금 집계 시작------------------------------------ -->
	<?
		$jh_qry = "SELECT any_jh FROM cms_capital_cash_book WHERE any_jh<>0 GROUP BY any_jh";// 조합 구하기
		$jh_rlt = mysql_query($jh_qry);
		$jh_num=mysql_num_rows($jh_rlt);
		$col_num = $jh_num+1;

		for($i=0; $i<=$jh_num; $i++){

			$jh_row = mysql_fetch_array($jh_rlt); // 거래한 조합을 구함// 조합코드 및 조합 수

			$pn_qry = "SELECT pj_name FROM cms_project1_info WHERE seq = '$jh_row[any_jh]' "; // 조합명 구하기 쿼리
			$pn_rlt = mysql_query($pn_qry);
			$pn_row = mysql_fetch_array($pn_rlt); // 조합 명칭을 불러옴

			// 총 회수금
			$in_jh_qry="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date<='$sh_date' "; // 조합별 설정일까지 조합 총 대여금 회수
			$in_jh_rlt=mysql_query($in_jh_qry,$connect);
			$in_jh_row=mysql_fetch_array($in_jh_rlt);
			if(!$in_jh_row) $in_jh_row = 0;

			// 당일 회수금
			$in_jh_qry1="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date='$sh_date' "; // 조합별 설정당일 수입
			$in_jh_rlt1=mysql_query($in_jh_qry1,$connect);
			$in_jh_row1=mysql_fetch_array($in_jh_rlt1);
			if(!$in_jh_row1) $in_jh_row1 = 0;

			// 총 대여금
			$ex_jh_qry="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh =' $jh_row[any_jh]' AND deal_date<='$sh_date' "; // 조합별 설정일까지 총 지출
			$ex_jh_rlt=mysql_query($ex_jh_qry,$connect);
			$ex_jh_row=mysql_fetch_array($ex_jh_rlt);
			if(!$ex_jh_row) $ex_jh_row = 0;

			// 당일 대여금
			$ex_jh_qry1="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date='$sh_date' "; // 조합별 설정당일 지출
			$ex_jh_rlt1=mysql_query($ex_jh_qry1,$connect);
			$ex_jh_row1=mysql_fetch_array($ex_jh_rlt1);
			if(!$ex_jh_row1) $ex_jh_row1 = 0;

			// 전일 대여금 잔액 구하기
			if(!$pn_row[pj_name]){  // 조합 명칭이 없으면 // 마지막 행이면
				$y_jh_ba="";
			}else if(($ex_jh_row[exp]-$in_jh_row[inc])+$in_jh_row1[inc]-$ex_jh_row1[exp]==0){
				$y_jh_ba = "-";
			}else{
				$y_jh_ba=number_format(($ex_jh_row[exp]-$in_jh_row[inc])+$in_jh_row1[inc]-$ex_jh_row1[exp]);
			}

			// 설정 당일 대여금 구하기
			if(!$pn_row[pj_name]){  // 조합 명칭이 없으면 // 마지막 행이면
				$d_jh_exp=""; // 해당 계정 당일 대여
			}else	if($ex_jh_row1[exp]==0){
				$d_jh_exp="-"; // 해당 계정 당일 대여
			}else{
				$d_jh_exp=number_format($ex_jh_row1[exp]);  // 해당 계정 대여금
			}

			if(!$pn_row[pj_name]){   // 설정 당일 회수금 구하기-> 조합(현장)명이 없으면
				$d_jh_inc=""; // 해당 계정 당일 회수
			}else	if($in_jh_row1[inc]==0){ //
				$d_jh_inc="-"; // 해당 계정 당일 회수
			}else{
				$d_jh_inc=number_format($in_jh_row1[inc]); // 해당 계정 당일 회수금
			}

			if(!$pn_row[pj_name]){   // 조합(현장)명이 없으면
				$day_loan=""; // 최종 금일 대여금(잔액)
			}else	if($ex_jh_row[exp]==$in_jh_row[inc]){ // 계정별 총 입금과 지출이 동일하면
				$day_loan="-"; // 최종 금일 시재(잔고)
			}else{ // 그렇지 않으면
				$day_loan = number_format($ex_jh_row[exp]-$in_jh_row[inc]); // 계정별 최종 금일 시재(잔고)
			}

		$tot_y_jh_ba+=($ex_jh_row[exp])-$in_jh_row[inc]+$in_jh_row1[inc]-$ex_jh_row1[exp]; // 토탈 전일 잔액 OK
		$tot_d_jh_exp+=$ex_jh_row1[exp]; //금일 대여
		$tot_d_jh_inc+=$in_jh_row1[inc]; // 금일 회수
		$tot_jh_ba+=$ex_jh_row[exp]-$in_jh_row[inc]; //금일 잔액

		if($i==0) $td_str2="<td align='center' rowspan='$col_num'>조합대여금</td>";
		if($i>0) $td_str2="";
	?>
	<tr align="center" height="26" style="font-size: 9pt;">
		<?=$td_str2?>
		<td style="text-align: center;" colspan="2"><?=rg_cut_string($pn_row[pj_name],10,"")?></td>
		<td style="text-align: right; padding-right: 18px;" colspan="2"><?=$y_jh_ba?></td>
		<td style="text-align: right; padding-right: 18px;" colspan="2"><?=$d_jh_exp?></td>
		<td style="text-align: right; padding-right: 18px;" colspan="2"><?=$d_jh_inc?></td>
		<td style="text-align: right; padding-right: 18px;" colspan="2"><?=$day_loan?></td>
	</tr>
	<?
		} // 조합 구하기 for 문 종료
	?>
	<tr align="center" height="26" style="font-size: 9pt;">
		<td style="text-align: center; color:#000099; background-color:#FCFDF2;" colspan="3">조합대여금 계</td>
		<td style="text-align: right; padding-right: 18px; color:#000099; background-color:#FCFDF2;" colspan="2"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($tot_y_jh_ba==0){echo "-";}else{echo number_format($tot_y_jh_ba);}?></td>
		<td style="text-align: right; padding-right: 18px; color:red; background-color:#FCFDF2;" colspan="2"><?if($tot_d_jh_exp==0){echo "-";}else{echo  number_format($tot_d_jh_exp);}?></font></td>
		<td style="text-align: right; padding-right: 18px; color:blue; background-color:#FCFDF2;" colspan="2"><?if($tot_d_jh_inc==0){echo "-";}else{echo number_format($tot_d_jh_inc);}?></font></td>
		<td style="text-align: right; padding-right: 18px; color:#000099; background-color:#FCFDF2;" colspan="2"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($tot_jh_ba==0){echo "-";}else{echo number_format($tot_jh_ba);}?></font></td>
	</tr>
	<!-- -----------------------------------------대여금 집계 종료------------------------------------ -->

	<tr height="45" style="font-size: 9pt;">
		<td style="padding-left: 10px;" colspan="11"><b>■ 금 일 수 지</b></td>
	</tr>
	<tr height="26" style="font-size: 9pt;">
		<td style="padding-left: 20px;" colspan="11"><b>입 금 내 역</b></td>
	</tr>

	<tr align="center" height="26" style="font-size: 9pt;">
		<td style="background-color: #eaeaea;" colspan="2">거래처</td>
		<td style="background-color: #eaeaea;" colspan="3">적 요</td>
		<td style="background-color: #eaeaea;">금액</td>
		<td style="background-color: #eaeaea;" colspan="2">계정과목</td>
		<td style="background-color: #eaeaea;" colspan="3">비 고</td>
	</tr>

	<!--  -->
	<?
		$da_in_qry="SELECT account, cont, acc, inc, note FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$sh_date' order by seq_num";
		$da_in_rlt=mysql_query($da_in_qry, $connect);

		$in_num = mysql_num_rows($da_in_rlt);

		if($in_num<2) $num=2; else $num=$in_num; // 행수 설정;

		for($i=0;$i<=$num;$i++){
			$da_in_rows=mysql_fetch_array($da_in_rlt);
			if($da_in_rows[inc]==0){ $income="";}else{$income=number_format($da_in_rows[inc]);}
	?>
	<tr height="26" style="font-size: 9pt;">
		<td style="padding-left: 14px;" colspan="2"><?=rg_cut_string($da_in_rows[acc],10,"")?></td>
		<td style="padding-left: 14px;" colspan="3"><?=rg_cut_string($da_in_rows[cont],20,"")?></td>
		<td style="width:90px; text-align: right; padding-right: 18px;"><?=$income?></td>
		<td style="padding-left: 14px;" colspan="2"><?=rg_cut_string($da_in_rows[account],7,"")?></td>
		<td style="padding-left: 14px;" colspan="3"><?=rg_cut_string($da_in_rows[note],20,"")?></td>
	</tr>
	<? } ?>
	<tr align="center" height="26" style="font-size: 9pt;" bgcolor="#eaeaea;">
	<?
		$aaq="SELECT SUM(inc) AS total_inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$sh_date'";
		$aar=mysql_query($aaq, $connect);
		$aaro=mysql_fetch_array($aar);
	?>

		<td style="color:#000099; background-color:#FCFDF2;" colspan="5">입 금 합 계</td>
		<td style="color:blue; background-color:#FCFDF2;"><?if($aaro[total_inc]==0){echo "-";}else{echo number_format($aaro[total_inc]);}?></td>
		<td style="color:#000099; background-color:#FCFDF2;" c<?=$income?>olspan="2"><?=rg_cut_string($da_in_rows[account],10,"")?></td>
		<td style="color:#000099; background-color:#FCFDF2;" colspan="3"><?=rg_cut_string($da_in_rows[note],20,"")?></td>
	</tr>

	<tr height="26" style="font-size: 9pt;">
		<td style="padding-left: 20px;" colspan="11"></td>
	</tr>




	<!-- 출금 내역 -->
	<tr height="26" style="font-size: 9pt;">
		<td style="padding-left: 20px;" colspan="11"><b>출 금 내 역</b></td>
	</tr>

	<tr align="center" height="26" style="font-size: 9pt;">
		<td style="background-color: #eaeaea;" colspan="2">거래처</td>
		<td style="background-color: #eaeaea;" colspan="3">적 요</td>
		<td style="background-color: #eaeaea;">금액</td>
		<td style="background-color: #eaeaea;" colspan="2">계정과목</td>
		<td style="background-color: #eaeaea;" colspan="3">비 고</td>
	</tr>
	<?
		$da_ex_qry="SELECT account, cont, acc, exp, note FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date' order by seq_num";
		$da_ex_rlt=mysql_query($da_ex_qry, $connect);

		$ex_num = mysql_num_rows($da_ex_rlt);
		if($ex_num<9) $num = 9; else $num = $ex_num;

		for($i=0;$i<=$num;$i++){
			$da_ex_rows=mysql_fetch_array($da_ex_rlt);
			if($da_ex_rows[exp]==0){ $exp="";}else{$exp=number_format($da_ex_rows[exp]);}
	?>
	<tr height="26" style="font-size: 9pt;">
		<td style="padding-left: 18px;" colspan="2"><?=rg_cut_string($da_ex_rows[acc],10,"")?></td>
		<td style="padding-left: 18px;" colspan="3"><?=rg_cut_string($da_ex_rows[cont],16,"")?></td>
		<td style="width:90px; text-align: right; padding-right: 18px;"><?=$exp?></td>
		<td style="padding-left: 18px;" colspan="2"><?=rg_cut_string($da_ex_rows[account],7,"")?></td>
		<td style="padding-left: 18px;" colspan="3"><?=rg_cut_string($da_ex_rows[note],20,"")?></td>
	</tr>
	<? } ?>

	<tr align="center" height="26" style="font-size: 9pt;" bgcolor="#eaeaea;">
	<?
		$bbq="SELECT SUM(exp) AS total_exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date'";
		$bbr=mysql_query($bbq, $connect);
		$bbro=mysql_fetch_array($bbr);
	?>

		<td style="color:#000099; background-color:#FCFDF2;" colspan="5">출 금 합 계</td>
		<td style="color:red; background-color:#FCFDF2;"><?if($bbro[total_exp]==0){echo "-";}else{echo number_format($bbro[total_exp]);}?></td>
		<td style="color:#000099; background-color:#FCFDF2;" colspan="2"></td>
		<td style="color:#000099; background-color:#FCFDF2;" colspan="3"></td>
	</tr>



	<!--  -->
	<!-- <tr align="center" height="26" style="font-size: 9pt;">
		<td style="width:114px">114</td>
		<td style="width:60px">60</td>
		<td style="width:60px">60</td>
		<td style="width:76px">76</td>
		<td style="width:76px">76</td>
		<td style="width:110px">110</td>
		<td style="width:45px">45</td>
		<td style="width:84px">84</td>
		<td style="width:84px">84</td>
		<td style="width:84px">84</td>
		<td style="width:84px">84</td>
	</tr> -->
</table>
