<?php
	//if($auth<2){ $excel_pop = "alert('출력 권한이 없습니다!');";
	//}else{
		// $url_where = urlencode($add_where);
		// $url_s_date = urlencode($s_date);
		// $url_e_date = urlencode($e_date);
		// $excel_pop = "location.href='excel_cash_book.php?add_where=$url_where&amp;s_date=$url_s_date&amp;e_date=$url_e_date)' ";
		//
		// $url_date = urlencode('$sh_date');
		$excel_pop = "location.href='/m4/capital/1/2/?cash_book=print'";
	//}
 ?>
			<div class="main_start">
				<a href="javascript:" onclick="<?php echo $excel_pop; ?>">
					<img src="/static/img/excel_icon.jpg" height="10" border="0" alt="EXCEL 아이콘" /> EXCEL로 출력
				</a>
			</div>



			<div class="row bo-bottom" style="margin: 0 0 20px 0;">
				<div class="col-xs-3 col-md-2 center" style="background-color: #F4F4F4; height: 40px; padding: 10px; 0">날 짜</div>
				<div class="col-xs-4 col-md-8" style="height: 40px; padding-top: 5px;">
					<form method="post" name="d_cash_book_frm" action="">
						<div class="col-xs-10 col-md-3" style="padding: 0px;">
							<label for="sh_date" class="sr-only">시작일</label>
							<input type="text" class="form-control input-sm wid-95" id="sh_date" name="sh_date" maxlength="10" value="<?php echo $sh_date;?>" readonly onClick="cal_add(this); event.cancelBubble=true">
						</div>
						<div class="col-xs-2 col-md-1 glyphicon-wrap" style="padding: 6px 0;">
							<a href="javascript:" onclick="cal_add(document.getElementById('sh_date'),this); event.cancelBubble=true">
								<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
							</a>
						</div>
						<div class="col-xs-3 col-md-2">
							<input type="button" class="btn btn-primary btn-sm" name="name" value="검 색" onclick="submit();">
						</div>
					</form>
				</div>
			</div>


			<div class="row">
				<div class="col-md-12 table-responsive" style="margin: 0;">

					<!-- 자금현황 테이블 시작 -->
					<table class="table table-bordered table-hover table-condensed font12">
						<tr bgcolor="#f2f2f9">
							<td colspan="5">
							<b><font color="#ee0066">▶</font> <font color="#003399">자 금 현 황</font></b> (<?php echo $sh_date?> 현재)
							</td>
							<td class="right">(단위 : 원)</td>
						</tr>
						<tr bgcolor="#f5f5f5">
							<td class="center" colspan="2"> 구 분 </td>
							<td class="center">전일잔액</td>
							<td class="center">입금(증가)</td>
							<td class="center">출금(감소)</td>
							<td class="center">금일잔액</td>
						</tr>
<?php $hk_bgcolor = "color:#000099; background-color:#FCFDF2;"; ?>

							<!-- <td class='center' style='.$hk_bgcolor.'><?php echo$bank_acc['num'].'-'.$bank_acc['result'][0]->bank; ?></td> -->

						<?
							for($i=0; $i<=$bank_acc['num']; $i++){ // 현금계정 + 은행계좌 수 만큼 반복 한다.
							// 	 $d_rows=mysql_fetch_array($d_rlt);
							//
								if($i==0) $td_str="<td class='center' style='".$hk_bgcolor."'>현금</td>";
								if($i==1) $td_str="<td class='center' rowspan='".$bank_acc['num']."'>보통예금</td>";
								if($i>1) $td_str="";

								// $d_rows[name];
								if(empty($bank_acc['result'][$i]->name)) $bank_acc_name = '&nbsp;'; else $bank_acc_name = $bank_acc['result'][$i]->name;

							// 	 $in_qry="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='$d_rows[no]' AND deal_date<='$sh_date' "; // 계정별 설정일까지 총 수입
							// 	 $in_rlt=mysql_query($in_qry,$connect);
							// 	 $in_row=mysql_fetch_array($in_rlt);
							//
							// 	 $in_qry1="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='$d_rows[no]' AND deal_date='$sh_date' "; // 계정별 설정당일 수입
							// 	 $in_rlt1=mysql_query($in_qry1,$connect);
							// 	 $in_row1=mysql_fetch_array($in_rlt1);
							//
							// 	 $ex_qry="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date<='$sh_date' "; // 계정별 설정일까지 총 지출
							// 	 $ex_rlt=mysql_query($ex_qry,$connect);
							// 	 $ex_row=mysql_fetch_array($ex_rlt);
							//
							// 	 $ex_qry1="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date='$sh_date' "; // 계정별 설정당일 지출
							// 	 $ex_rlt1=mysql_query($ex_qry1,$connect);
							// 	 $ex_row1=mysql_fetch_array($ex_rlt1);
							//
							// 	 if(!$d_rows[name]){   // 입출금 계정이 없으면
							// 		 $balance=""; // 최종 금일 시재(잔고)
							// 	 }else	if($in_row[inc]==$ex_row[exp]){ // 계정별 총 입금과 지출이 동일하면
							// 		 $balance="-"; // 최종 금일 시재(잔고)
							// 	 }else{ // 그렇지 않으면
							// 		 $balance=number_format($in_row[inc]-$ex_row[exp]); // 계정별 최종 금일 시재(잔고)
							//   }
							//
							// 	 if(!$d_rows[name]){   // 설정 당일 수입 구하기-> 입출금 계정이 없으면
							// 		 $d_inc=""; // 해당 계정 당일 입금(증가)
							// 	 }else	if($in_row1[inc]==0){ //
							// 		 $d_inc="-"; // 해당 계정 당일 입금(증가)
							// 	 }else{
							// 		 $d_inc=number_format($in_row1[inc]); // 해당 계정 당일 입금(증가)
							// 	 }
							// 	 if(!$d_rows[name]){   // 설정 당일 지출 구하기
							// 		 $d_exp=""; // 해당 계정 당일 출금 (감소)
							// 	 }else	if($ex_row1[exp]==0){
							// 		 $d_exp="-"; // 해당 계정 당일 출금 (감소)
							// 	 }else{
							// 		 $d_exp=number_format($ex_row1[exp]);  // 해당 계정 당일 출금 (감소)
							// 	 }
							//
							// 	 if(!$d_rows[name]){  // 전일 잔액 구하기
							// 		 $y_bal="";
							// 	 }else if(($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]==0){
							// 		 $y_bal="-";
							// 	 }else{
							// 		 $y_bal=number_format(($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]);
							// 	 }
							//
							// 	 $total_y_ba+=($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]; // 토탈 전일 잔액
							// 	 if($i>0) $yk_total_y_ba += ($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]; // 보통예금 토탈 전일 잔액
							// 	 $total_d_inc+=$in_row1[inc]; // 금일 입금(증가)
							// 	 if($i>0) $yk_total_d_inc+=$in_row1[inc]; // 보통예금 금일 입금(증가)
							// 	 $total_d_exp+=$ex_row1[exp]; //금일 출금(감소)
							// 	 if($i>0) $yk_total_d_exp+=$ex_row1[exp]; //보통예금 금일 출금(감소)
							// 	 $total_ba+=$in_row[inc]-$ex_row[exp]; // 금일 잔액
							// 	 if($i>0) $yk_total_ba+=$in_row[inc]-$ex_row[exp]; // 보통예금 금일 잔액
						?>
						<tr>
							<?php echo $td_str?>
							<td width="185" style="<?php if($i==0) echo $hk_bgcolor?>"><?php echo $bank_acc_name; ?></td><!-- 계정 명 -->
							<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>"><?php // echo $y_bal?></td> <!-- 전일 잔액 -->
							<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>"><?php // echo $d_inc?></td> <!-- 당일 입금 -->
							<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>"><?php // echo $d_exp?></td> <!-- 당일 출금 -->
							<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>;"><?php // echo $balance?></td> <!-- 금일 잔액 -->
						</tr>
						<?
							} // 현금 / 보통예금 수만큼 반복 for문 종료
						?>
						<tr bgcolor="#f6f6f6">
							<td class="center" colspan="2">보통예금(가용자금) 계</td>
							<td class="right"><?php // if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($yk_total_y_ba==0){echo "-";}else{echo number_format($yk_total_y_ba);}?></td>
							<td class="right"><font color="#0066ff"><?php // if($total_d_inc==0){echo "-";}else{echo  number_format($yk_total_d_inc);}?></font></td>
							<td class="right"><font color="#ff3300"><?php // if($total_d_exp==0){echo "-";}else{echo number_format($yk_total_d_exp);}?></font></td>
							<td class="right"><font color="#000099"><?php // if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($yk_total_ba==0){echo "-";}else{echo number_format($yk_total_ba);}?></font></td>
						</tr>
						<!-- <tr bgcolor="#f6f6f6">
							<td class="center" colspan="2">TOTAL</td>
							<td class="right"><?php // if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($total_y_ba==0){echo "-";}else{echo number_format($total_y_ba);}?></td>
							<td class="right"><font color="#0066ff"><?php // if($total_d_inc==0){echo "-";}else{echo  number_format($total_d_inc);}?></font></td>
							<td class="right"><font color="#ff3300"><?php // if($total_d_exp==0){echo "-";}else{echo number_format($total_d_exp);}?></font></td>
							<td class="right"><font color="#000099"><?php // if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($total_ba==0){echo "-";}else{echo number_format($total_ba);}?></font></td>
						</tr> -->
						<!-- -----------------------------------------대여금 집계 시작------------------------------------ -->
						<?
							// $jh_qry = "SELECT any_jh FROM cms_capital_cash_book WHERE any_jh<>0 GROUP BY any_jh";// 조합 구하기
							// $jh_rlt = mysql_query($jh_qry);
							// $jh_num=mysql_num_rows($jh_rlt);
							$col_num = $jh_data['num']+1;
							//
							for($i=0; $i<=$jh_data['num']; $i++){

								if(empty($jh_data['result'][$i]->any_jh)) $jh_name = '&nbsp;'; else $jh_name = $jh_data['result'][$i]->any_jh;
							//
							// 	$jh_row = mysql_fetch_array($jh_rlt); // 거래한 조합을 구함// 조합코드 및 조합 수
							//
								// $pn_qry = "SELECT pj_name FROM cms_project1_info WHERE seq = '".$jh_data['result'][$i]->any_jh."' "; // 조합명 구하기 쿼리
								// $pn_rlt = mysql_query($pn_qry);
								// $pn_row = mysql_fetch_array($pn_rlt); // 조합 명칭을 불러옴
							//
							// 	// 총 회수금
							// 	$in_jh_qry="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date<='$sh_date' "; // 조합별 설정일까지 조합 총 대여금 회수
							// 	$in_jh_rlt=mysql_query($in_jh_qry,$connect);
							// 	$in_jh_row=mysql_fetch_array($in_jh_rlt);
							// 	if(!$in_jh_row) $in_jh_row = 0;
							//
							// 	// 당일 회수금
							// 	$in_jh_qry1="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date='$sh_date' "; // 조합별 설정당일 수입
							// 	$in_jh_rlt1=mysql_query($in_jh_qry1,$connect);
							// 	$in_jh_row1=mysql_fetch_array($in_jh_rlt1);
							// 	if(!$in_jh_row1) $in_jh_row1 = 0;
							//
							// 	// 총 대여금
							// 	$ex_jh_qry="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh =' $jh_row[any_jh]' AND deal_date<='$sh_date' "; // 조합별 설정일까지 총 지출
							// 	$ex_jh_rlt=mysql_query($ex_jh_qry,$connect);
							// 	$ex_jh_row=mysql_fetch_array($ex_jh_rlt);
							// 	if(!$ex_jh_row) $ex_jh_row = 0;
							//
							// 	// 당일 대여금
							// 	$ex_jh_qry1="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date='$sh_date' "; // 조합별 설정당일 지출
							// 	$ex_jh_rlt1=mysql_query($ex_jh_qry1,$connect);
							// 	$ex_jh_row1=mysql_fetch_array($ex_jh_rlt1);
							// 	if(!$ex_jh_row1) $ex_jh_row1 = 0;
							//
							// 	// 전일 대여금 잔액 구하기
							// 	if(!$pn_row[pj_name]){  // 조합 명칭이 없으면 // 마지막 행이면
							// 		$y_jh_ba="";
							// 	}else if(($ex_jh_row[exp]-$in_jh_row[inc])+$in_jh_row1[inc]-$ex_jh_row1[exp]==0){
							// 		$y_jh_ba = "-";
							// 	}else{
							// 		$y_jh_ba=number_format(($ex_jh_row[exp]-$in_jh_row[inc])+$in_jh_row1[inc]-$ex_jh_row1[exp]);
							// 	}
							//
							// 	// 설정 당일 대여금 구하기
							// 	if(!$pn_row[pj_name]){  // 조합 명칭이 없으면 // 마지막 행이면
							// 		$d_jh_exp=""; // 해당 계정 당일 대여
							// 	}else	if($ex_jh_row1[exp]==0){
							// 		$d_jh_exp="-"; // 해당 계정 당일 대여
							// 	}else{
							// 		$d_jh_exp=number_format($ex_jh_row1[exp]);  // 해당 계정 대여금
							// 	}
							//
							// 	if(!$pn_row[pj_name]){   // 설정 당일 회수금 구하기-> 조합(현장)명이 없으면
							// 		$d_jh_inc=""; // 해당 계정 당일 회수
							// 	}else	if($in_jh_row1[inc]==0){ //
							// 		$d_jh_inc="-"; // 해당 계정 당일 회수
							// 	}else{
							// 		$d_jh_inc=number_format($in_jh_row1[inc]); // 해당 계정 당일 회수금
							// 	}
							//
							// 	if(!$pn_row[pj_name]){   // 조합(현장)명이 없으면
							// 		$day_loan=""; // 최종 금일 대여금(잔액)
							// 	}else	if($ex_jh_row[exp]==$in_jh_row[inc]){ // 계정별 총 입금과 지출이 동일하면
							// 		$day_loan="-"; // 최종 금일 시재(잔고)
							// 	}else{ // 그렇지 않으면
							// 		$day_loan = number_format($ex_jh_row[exp]-$in_jh_row[inc]); // 계정별 최종 금일 시재(잔고)
							// 	}
							//
							// 	$tot_y_jh_ba+=($ex_jh_row[exp])-$in_jh_row[inc]+$in_jh_row1[inc]-$ex_jh_row1[exp]; // 토탈 전일 잔액 OK
							// 	$tot_d_jh_exp+=$ex_jh_row1[exp]; //금일 대여
							// 	$tot_d_jh_inc+=$in_jh_row1[inc]; // 금일 회수
							// 	$tot_jh_ba+=$ex_jh_row[exp]-$in_jh_row[inc]; //금일 잔액
							//
							if($i==0) $td_str2="<td class='center bo-bottom' rowspan='$col_num'>조합대여금</td>";
							if($i>0) $td_str2="";
						?>
						<tr>
							<?php echo $td_str2; ?>
							<td><?php echo $jh_name; ?></td><!-- 조합 명 -->
							<td class="right"><?php // echo $y_jh_ba?></td> <!-- 전일 대여금 잔액 -->
							<td class="right"><?php // echo $d_jh_exp?></td> <!-- 당일 대여금 출금 -->
							<td class="right"><?php // echo $d_jh_inc?></td> <!-- 당일 대여금 회수 -->
							<td class="right"><?php // echo $day_loan?></td> <!-- 금일 대여금 잔액 -->
						</tr>
						<?
							} // 조합 구하기 for 문 종료
						?>
						<tr bgcolor="#f6f6f6">
							<td class="center" colspan="2">
								조합대여금 계
							</td>
							<td class="right"><?php // if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($tot_y_jh_ba==0){echo "-";}else{echo number_format($tot_y_jh_ba);}?></td>
							<td class="right"><font color="#ff3300"><?php // if($tot_d_jh_exp==0){echo "-";}else{echo  number_format($tot_d_jh_exp);}?></font></td>
							<td class="right"><font color="#0066ff"><?php // if($tot_d_jh_inc==0){echo "-";}else{echo number_format($tot_d_jh_inc);}?></font></td>
							<td class="right"><font color="#000099"><?php // if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($tot_jh_ba==0){echo "-";}else{echo number_format($tot_jh_ba);}?></font></td>
						</tr>
						<!-- -----------------------------------------대여금 집계 종료------------------------------------ -->
					</table>


					<!-- 금일 수지 현황 -->
					<table class="table table-bordered table-hover table-condensed font12">
						<tr bgcolor="#f2f2f9">
							<td colspan="4">
								<b><font color="#ee0066">▶</font> <font color="#003399">금 일 수 지 현 황</font></b> (<?php echo $sh_date?> 현재)
							</td>
							<td class="right">(단위 : 원)</td>
						</tr>

						<!-- 입금 내역 -->
						<tr bgcolor="#f5f5f5">
							<td colspan="5"> <b>입 금 내 역</b> </td>
						</tr>
						<tr bgcolor="#f8f8f3">
							<td class="center" width="150">거 래 처</td>
							<td class="center" width="200">적 요</td>
							<td class="center" width="100">금 액</td>
							<td class="center" width="100">계정과목</td>
							<td class="center" width="200">비 고 <?php var_dump($da_in); ?> </td>
						</tr>
						<?
							// $da_in_qry="SELECT account, cont, acc, inc, note FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$sh_date' order by seq_num";
							// $da_in_rlt=mysql_query($da_in_qry, $connect);
							//
							$in_num = $da_in['num'];
							if($in_num<2) $num=2; else $num=$in_num; // 행수 설정;

							for($i=0;$i<=$num;$i++){
							// 	$da_in_rows=mysql_fetch_array($da_in_rlt);
							// 	if($da_in_rows[inc]==0){ $income="";}else{$income=number_format($da_in_rows[inc]);}
							if(empty($da_in['result'][$i]->acc)) $da_in_acc = '&nbsp;'; else $da_in_acc = $da_in['result'][$i]->acc;
						?>
						<tr>
							<td><?php echo cut_string($da_in_acc,16,"")?></td>



							<td><?php // echo cut_string($da_in_rows[cont],20,"")?></td>
							<td class="right"><?php // echo $income?></td>
							<td class="center"><?php // echo cut_string($da_in_rows[account],10,"")?></td>
							<td class="center"><?php // echo cut_string($da_in_rows[note],20,"")?></td>
						</tr>
						<? } ?>
						<tr bgcolor="#f6f6f6">
						<?
							// $aaq="SELECT SUM(inc) AS total_inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$sh_date'";
							// $aar=mysql_query($aaq, $connect);
							// $aaro=mysql_fetch_array($aar);
						?>
							<td class="center" colspan="2">입 금 합 계</td>
							<td class="right"><font color="#0066ff"><?php // if($aaro[total_inc]==0){echo "-";}else{echo number_format($aaro[total_inc]);}?></font></td>
							<td class="center"></td>
							<td class="center"></td>
						</tr>


						<tr><td height="15"></td></tr>
						<!-- 출금 내역 -->
						<tr bgcolor="#f5f5f5">
							<td colspan="5"> <b>출 금 내 역</b> </td>
						</tr>
						<tr bgcolor="#f8f8f3">
							<td class="center">거래처</td>
							<td class="center">적 요</td>
							<td class="center">금 액</td>
							<td class="center">계정과목</td>
							<td class="center">비 고 <?php var_dump($da_ex); ?> </td>
						</tr>
						<?
							// $da_ex_qry="SELECT account, cont, acc, exp, note FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date' order by seq_num";
							// $da_ex_rlt=mysql_query($da_ex_qry, $connect);
							//
							$ex_num = $da_in['num'];
							if($ex_num<4) $num = 4; else $num = $ex_num;
							//
							for($i=0;$i<=$num;$i++){
							// 	$da_ex_rows=mysql_fetch_array($da_ex_rlt);
							// 	if($da_ex_rows[exp]==0){ $exp="";}else{$exp=number_format($da_ex_rows[exp]);}
						?>
						<tr>
							<td><?php // echo cut_string($da_ex_rows[acc],16,"")?>a</td>
							<td><?php // echo cut_string($da_ex_rows[cont],20,"")?>a</td>
							<td class="right"><?php // echo $exp?>a</td>
							<td class="center"><?php // echo cut_string($da_ex_rows[account],10,"")?>a</td>
							<td class="center"><?php // echo cut_string($da_ex_rows[note],20,"")?>a</td>
						</tr>
						<? } ?>
						<tr bgcolor="#f6f6f6">
						<?
							// $bbq="SELECT SUM(exp) AS total_exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date'";
							// $bbr=mysql_query($bbq, $connect);
							// $bbro=mysql_fetch_array($bbr);
						?>
							<td class="center" colspan="2">출 금 합 계</td>
							<td class="right"><font color="#ff3300"><?php // if($bbro[total_exp]==0){echo "-";}else{echo number_format($bbro[total_exp]);}?></font></td>
							<td class="center"></td>
							<td class="center"></td>
						</tr>
					</table>

				</div>
			</div>
