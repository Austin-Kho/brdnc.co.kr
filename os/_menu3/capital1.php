					<!-- ===== subject table end ===== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 자금 일보</font></b>
						<div style="float:right;">
							<!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. -->
						</div>
					</div>
					<!-- ===== subject table end ===== -->
					<?
						$_m3_1_1_rlt = mysqli_query($connect, "SELECT _m3_1_1 FROM cms_mem_auth WHERE user_id='$_SESSION[p_id]' ");
						$_m3_1_1_row = mysqli_fetch_array($_m3_1_1_rlt);

						if(!$_m3_1_1_row[_m3_1_1]||$_m3_1_1_row[_m3_1_1]==0){
					?>
					<div style="display:inline;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center" valign="middle" style="font-size:13px; color:black;" height="580">
								<p>해당 페이지에 대한 조회 권한이 없습니다. 관리자(<?=$admin_tel?>)에게 문의하여 주십시요!</p>
								<p>또는 <a href="javascript:message_win('<?=$cms_url?>member/message_3.php?r_id=<?=$admin_id?>')" class="no_auth">관리자나 해당 직원에게 메세지</a>를 보낼 수 있습니다.</p>
							</td>
						</tr>
					</table>
					</div>
					<? }else{ ?>
					<div style="display:inline;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td height="580" valign="top">
							<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;" class="form2">
							<!-- --------------------------------------------------------------------------------------------------------------------------- -->
							<?
								$auth_qry = "SELECT * FROM cms_member_table WHERE user_id='$_SESSION[p_id]' "; // 멤버테이블에서 모든 제이터를 가져옴
								$auth_rlt = mysqli_query($connect, $auth_qry);
								$auth_row= mysqli_fetch_array($auth_rlt);

								// 이 페이지 쓰기 권한 설정하기
								$auth_level=2; // 이페이지 마스터 쓰기 권한 레벨

								if($auth_row[is_admin]==1){ $w_auth =2;
								}else if($_m3_1_1_row[_m3_1_1]==2){ if($auth_row[auth_level]<=$auth_level){ $w_auth =2; }else{ $w_auth =1;}}else{	$w_auth =0;}

								$sh_date = $_REQUEST['sh_date'];
								if(!$sh_date) $sh_date=date('Y-m-d');


								if($_m3_1_1_row[_m3_1_1]<1){
									$excel_pop = "alert('출력 권한이 없습니다!');";
								}else{
									$url_date = urlencode($sh_date);
									$excel_pop = "location.href='excel_daily_money_report.php?sh_date=$url_date' ";									
								}
							?>
							<a href="javascript:" onClick="<?php echo $excel_pop?>"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> 자금일보 출력</a>
							<!-- --------------------------------------------------------------------------------------------------------------------------- -->
							</div>
							<form method="post" name="d_cash_book_frm" action="<?=$_SERVER['PHP_SELF']?>">
							<input type="hidden" name="m_di" value="<?=$m_di?>">
							<input type="hidden" name="s_di" value="1">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td width="80" class="form2" bgcolor="#F8F8F8" height="38">날 짜 </td>
								<td class="form2" colspan="2">
								<input type="text" name="sh_date" id="sh_date" value="<?=$sh_date?>" size="25" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
								<a href="javascript:" onclick="cal_add(document.getElementById('sh_date'),this); event.cancelBubble=true"><img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<input type="button" value=" 검 색 " onclick="submit();" class="inputstyle11" style="height='20'; width='100';">
								</td>
							</tr>
							</table><div style="height:18px;"></div>

							<!-- 자금현황 테이블 시작 -->
							<table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr bgcolor="#f2f2f9">
									<td colspan="5" style="padding:0 0 0 10px;border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">
									<b><font color="#ee0066">▶</font> <font color="#003399">자 금 현 황</font></b> (<?=$sh_date?> 현재)
									</td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">(단위 : 원)</td>
								</tr>
								<tr bgcolor="#f5f5f5">
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="2" height="28"> 구 분 </td>
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">전일잔액</td>
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">입금(증가)</td>
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">출금(감소)</td>
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">금일잔액</td>
								</tr>
								<?
									$d_qry=" SELECT * FROM cms_capital_bank_account "; // 은행계좌 정보 테이블
									$d_rlt=mysqli_query($connect, $d_qry);
									$d_num=mysqli_num_rows($d_rlt);
									$num=$d_num;  // 행수 설정;
									$hk_bgcolor = "color:#000099; background-color:#FCFDF2;";

									for($i=0; $i<=$num; $i++){ // 현금계정 + 은행계좌 수 만큼 반복 한다.
										 $d_rows=mysqli_fetch_array($d_rlt);

										 if($i==0) $td_str="<td align='center' style='padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid; ".$hk_bgcolor."'>현금</td>";
										 if($i==1) $td_str="<td align='center' style='padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid; ' rowspan='$num'>보통예금</td>";
										 if($i>1) $td_str="";

										 $in_qry="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='$d_rows[no]' AND deal_date<='$sh_date' "; // 계정별 설정일까지 총 수입
										 $in_rlt=mysqli_query($connect, $in_qry);
										 $in_row=mysqli_fetch_array($in_rlt);

										 $in_qry1="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND in_acc='$d_rows[no]' AND deal_date='$sh_date' "; // 계정별 설정당일 수입
										 $in_rlt1=mysqli_query($connect, $in_qry1);
										 $in_row1=mysqli_fetch_array($in_rlt1);

										 $ex_qry="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date<='$sh_date' "; // 계정별 설정일까지 총 지출
										 $ex_rlt=mysqli_query($connect, $ex_qry);
										 $ex_row=mysqli_fetch_array($ex_rlt);

										 $ex_qry1="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date='$sh_date' "; // 계정별 설정당일 지출
										 $ex_rlt1=mysqli_query($connect, $ex_qry1);
										 $ex_row1=mysqli_fetch_array($ex_rlt1);

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
								<tr>
									<?=$td_str?>
									<td width="185" style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid; <?if($i==0) echo $hk_bgcolor?>" height="28"><?=$d_rows[name]?></td><!-- 계정 명 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid; <?if($i==0) echo $hk_bgcolor?>"><?=$y_bal?></td> <!-- 전일 잔액 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid; <?if($i==0) echo $hk_bgcolor?>"><?=$d_inc?></td> <!-- 당일 입금 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid; <?if($i==0) echo $hk_bgcolor?>"><?=$d_exp?></td> <!-- 당일 출금 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid; <?if($i==0) echo $hk_bgcolor?>;"><?=$balance?></td> <!-- 금일 잔액 -->
								</tr>
								<?
										} // 현금 / 보통예금 수만큼 반복 for문 종료
								?>
								<tr bgcolor="#f6f6f6">
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="2" height="28">보통예금(가용자금) 계</td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($yk_total_y_ba==0){echo "-";}else{echo number_format($yk_total_y_ba);}?></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#0066ff"><?if($total_d_inc==0){echo "-";}else{echo  number_format($yk_total_d_inc);}?></font></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#ff3300"><?if($total_d_exp==0){echo "-";}else{echo number_format($yk_total_d_exp);}?></font></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#000099"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($yk_total_ba==0){echo "-";}else{echo number_format($yk_total_ba);}?></font></td>
								</tr>
								<!-- <tr bgcolor="#f6f6f6">
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="2" height="28">TOTAL</td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($total_y_ba==0){echo "-";}else{echo number_format($total_y_ba);}?></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#0066ff"><?if($total_d_inc==0){echo "-";}else{echo  number_format($total_d_inc);}?></font></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#ff3300"><?if($total_d_exp==0){echo "-";}else{echo number_format($total_d_exp);}?></font></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#000099"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($total_ba==0){echo "-";}else{echo number_format($total_ba);}?></font></td>
								</tr> -->
								<!-- -----------------------------------------대여금 집계 시작------------------------------------ -->
								<?
									$jh_qry = "SELECT any_jh FROM cms_capital_cash_book WHERE any_jh<>0 GROUP BY any_jh";// 조합 구하기
									$jh_rlt = mysqli_query($connect, $jh_qry);
									$jh_num=mysqli_num_rows($jh_rlt);
									$col_num = $jh_num+1;

									for($i=0; $i<=$jh_num; $i++){

										$jh_row = mysqli_fetch_array($jh_rlt); // 거래한 조합을 구함// 조합코드 및 조합 수

										$pn_qry = "SELECT pj_name FROM cms_project1_info WHERE seq = '$jh_row[any_jh]' "; // 조합명 구하기 쿼리
										$pn_rlt = mysqli_query($connect, $pn_qry);
										$pn_row = mysqli_fetch_array($pn_rlt); // 조합 명칭을 불러옴

										// 총 회수금
										$in_jh_qry="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date<='$sh_date' "; // 조합별 설정일까지 조합 총 대여금 회수
										$in_jh_rlt=mysqli_query($connect, $in_jh_qry);
										$in_jh_row=mysqli_fetch_array($in_jh_rlt);
										if(!$in_jh_row) $in_jh_row = 0;

										// 당일 회수금
										$in_jh_qry1="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2!=7) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date='$sh_date' "; // 조합별 설정당일 수입
										$in_jh_rlt1=mysqli_query($connect, $in_jh_qry1);
										$in_jh_row1=mysqli_fetch_array($in_jh_rlt1);
										if(!$in_jh_row1) $in_jh_row1 = 0;

										// 총 대여금
										$ex_jh_qry="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh =' $jh_row[any_jh]' AND deal_date<='$sh_date' "; // 조합별 설정일까지 총 지출
										$ex_jh_rlt=mysqli_query($connect, $ex_jh_qry);
										$ex_jh_row=mysqli_fetch_array($ex_jh_rlt);
										if(!$ex_jh_row) $ex_jh_row = 0;

										// 당일 대여금
										$ex_jh_qry1="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND is_jh_loan='1' AND any_jh = '$jh_row[any_jh]' AND deal_date='$sh_date' "; // 조합별 설정당일 지출
										$ex_jh_rlt1=mysqli_query($connect, $ex_jh_qry1);
										$ex_jh_row1=mysqli_fetch_array($ex_jh_rlt1);
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

										if($i==0) $td_str2="<td align='center' style='padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style:solid;' rowspan='$col_num'>조합대여금</td>";
										if($i>0) $td_str2="";
								?>
								<tr>
									<?=$td_str2?>
									<td style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;" height="28"><?=$pn_row[pj_name]?></td><!-- 조합 명 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$y_jh_ba?></td> <!-- 전일 대여금 잔액 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$d_jh_exp?></td> <!-- 당일 대여금 출금 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$d_jh_inc?></td> <!-- 당일 대여금 회수 -->
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$day_loan?></td> <!-- 금일 대여금 잔액 -->
								</tr>
								<?
									} // 조합 구하기 for 문 종료
								?>
								<tr bgcolor="#f6f6f6">
									<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="2" height="28">
										조합대여금 계
									</td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($tot_y_jh_ba==0){echo "-";}else{echo number_format($tot_y_jh_ba);}?></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#ff3300"><?if($tot_d_jh_exp==0){echo "-";}else{echo  number_format($tot_d_jh_exp);}?></font></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#0066ff"><?if($tot_d_jh_inc==0){echo "-";}else{echo number_format($tot_d_jh_inc);}?></font></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#000099"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($tot_jh_ba==0){echo "-";}else{echo number_format($tot_jh_ba);}?></font></td>
								</tr>
								<!-- -----------------------------------------대여금 집계 종료------------------------------------ -->
							</table>

							<table><tr><td height="8"></td></tr></table>


							<!-- 금일 수지 현황 -->
							<table border="0" width="100%" cellspacing="0" cellpadding="0">
								<tr bgcolor="#f2f2f9">
									<td style="padding:0 0 0 10px; border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28"><b><font color="#ee0066">
										▶</font> <font color="#003399">금 일 수 지 현 황</font></b> (<?=$sh_date?> 현재)
									</td>
									<td style="padding:0 10px 0 10px; border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid; text-align:right;">(단위 : 원)</td>
								</tr>
							</table>

							<table border="0" width="100%" cellspacing="0" cellpadding="0">
								<!-- 입금 내역 -->
								<tr bgcolor="#f5f5f5">
									<td style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="5" height="28"> <b>입 금 내 역</b> </td>
								</tr>
								<tr bgcolor="#f8f8f3">
									<td align="center" width="150" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">거 래 처</td>
									<td align="center" width="200" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">적 요</td>
									<td align="center" width="100" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">금 액</td>
									<td align="center" width="100" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style:solid;">계정과목</td>
									<td align="center" width="200" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style:solid;">비 고</td>
								</tr>
								<?
									$da_in_qry="SELECT account, cont, acc, inc, note FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$sh_date' order by seq_num";
									$da_in_rlt=mysqli_query($connect, $da_in_qry);

									$in_num = mysqli_num_rows($da_in_rlt);

									if($in_num<2) $num=2; else $num=$in_num; // 행수 설정;

									for($i=0;$i<=$num;$i++){
										$da_in_rows=mysqli_fetch_array($da_in_rlt);
										if($da_in_rows[inc]==0){ $income="";}else{$income=number_format($da_in_rows[inc]);}
								?>
								<tr>
									<td style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28"><?=rg_cut_string($da_in_rows[acc],16,"")?></td>
									<td style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_in_rows[cont],20,"")?></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$income?></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_in_rows[account],10,"")?></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_in_rows[note],20,"")?></td>
								</tr>
								<? } ?>
								<tr bgcolor="#f6f6f6">
								<?
									$aaq="SELECT SUM(inc) AS total_inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$sh_date'";
									$aar=mysqli_query($connect, $aaq);
									$aaro=mysqli_fetch_array($aar);
								?>
									<td align="center" colspan="2" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">입 금 합 계</td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#0066ff"><?if($aaro[total_inc]==0){echo "-";}else{echo number_format($aaro[total_inc]);}?></font></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"></td>
								</tr>


								<tr><td height="15"></td></tr>
								<!-- 출금 내역 -->
								<tr bgcolor="#f5f5f5">
									<td style="padding:0 0 0 10px; border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="5" height="28"> <b>출 금 내 역</b> </td>
								</tr>
								<tr bgcolor="#f8f8f3">
									<td align="center" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">거래처</td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">적 요</td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">금 액</td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">계정과목</td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">비 고</td>
								</tr>
								<?
									$da_ex_qry="SELECT account, cont, acc, exp, note FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date' order by seq_num";
									$da_ex_rlt=mysqli_query($connect, $da_ex_qry);

									$ex_num = mysqli_num_rows($da_ex_rlt);
									if($ex_num<4) $num = 4; else $num = $ex_num;

									for($i=0;$i<=$num;$i++){
										$da_ex_rows=mysqli_fetch_array($da_ex_rlt);
										if($da_ex_rows[exp]==0){ $exp="";}else{$exp=number_format($da_ex_rows[exp]);}
								?>
								<tr>
									<td style="padding:0 0 0 10px; border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28"><?=rg_cut_string($da_ex_rows[acc],16,"")?></td>
									<td style="padding:0 0 0 10px; border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_ex_rows[cont],20,"")?></td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$exp?></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_ex_rows[account],10,"")?></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_ex_rows[note],20,"")?></td>
								</tr>
								<? } ?>
								<tr bgcolor="#f6f6f6">
								<?
									$bbq="SELECT SUM(exp) AS total_exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$sh_date'";
									$bbr=mysqli_query($connect, $bbq);
									$bbro=mysqli_fetch_array($bbr);
								?>
									<td align="center" colspan="2" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">출 금 합 계</td>
									<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#ff3300"><?if($bbro[total_exp]==0){echo "-";}else{echo number_format($bbro[total_exp]);}?></font></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"></td>
									<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"></td>
								</tr>
							</table>



							<!-- 최종 집계 테이블 -->
							<table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:1px solid #D6D6D6; margin-top:15px;">
								<tr align="center">
								<?
									 $cash1=" SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0 AND class2<>8) AND in_acc='1' $e_add  "; // 현금시재 구하기
									 $ca_qry1=mysqli_query( $connect, $cash1);
									 $ca_row1=mysqli_fetch_array($ca_qry1);
									 $cash2="SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND out_acc='1' $e_add ";
									 $ca_qry2=mysqli_query($connect, $cash2);
									 $ca_row2=mysqli_fetch_array($ca_qry2);

									 $b_bal1="SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0 AND class2<>8) AND in_acc>'1'  $e_add   "; // 계좌 잔고 구하기
									 $b_qry1=mysqli_query($connect, $b_bal1);
									 $b_row1=mysqli_fetch_array($b_qry1);
									 $b_bal2="SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND out_acc>'1'  $e_add   ";
									 $b_qry2=mysqli_query($connect, $b_bal2);
									 $b_row2=mysqli_fetch_array($b_qry2);

									 $dept1=" SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='2' $e_add   "; // 차용금 합계
									 $de_qry1=mysqli_query($connect, $dept1);
									 $de_row1=mysqli_fetch_array($de_qry1);
									 $dept2=" SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='5'  $e_add   "; // 상환금 합계
									 $de_qry2=mysqli_query($connect, $dept2);
									 $de_row2=mysqli_fetch_array($de_qry2);

									 $loan1=" SELECT SUM(exp) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='6'  $e_add   "; // 대여금 합계
									 $lo_qry1=mysqli_query($connect, $loan1);
									 $lo_row1=mysqli_fetch_array($lo_qry1);
									 $loan2=" SELECT SUM(inc) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='3'  $e_add   "; // 회수금 합계
									 $lo_qry2=mysqli_query($connect,  $loan2);
									 $lo_row2=mysqli_fetch_array($lo_qry2);

									 $cash_hand = number_format($ca_row1[in_total]-$ca_row2[out_total])." 원";
									 $bank_balance=number_format($b_row1[in_total]-$b_row2[out_total])." 원";
									 // $dept=number_format($de_row1[in_total]-$de_row2[out_total])." 원";
									 // $loan=number_format($lo_row1[in_total]-$lo_row2[out_total])." 원";
									 if($bank_balance==0) $bank_balance="-";
									 if($cash_hand==0) $cash_hand="-";
									 if($dept==0) $dept="-";
									 if($loan==0) $loan="-";
								?>
									<td width="10%" bgcolor="#f0f0ff" height="35"> 현금시재 </td>
									<td width="15%" align="right" style="padding:0 20px 0 0px"><?=$cash_hand?></td>
									<td width="10%" bgcolor="#f0f0ff">예금잔고</td>
									<td width="15%" align="right" style="padding:0 20px 0 0px"><a href="javascript:" onClick="popUp('bank_balance.php','bank_balance');"><?=$bank_balance;?> <font color="#ff0066"><b>+</b></font></a></td>
									<td width="10%" bgcolor="#f8f0ff"> 차입금잔액 </td>
									<td width="15%" align="right" style="padding:0 20px 0 0px"><a href="javascript:" onClick="popUp('payable_balance.php','payable_balance');"><?=$dept;?> <font color="#ff0066"><b>+</b></font></a></td>
									<td width="10%" bgcolor="#f8f0ff"> 대여금잔액 </td>
									<td width="15%" align="right" style="padding:0 20px 0 0px"><a href="javascript:" onClick="popUp('loan_balance.php','loan_balance');"><?=$loan;?> <font color="#ff0066"><b>+</b></font></a></td>
								</tr>
							</table>
							</form>
							</td>
						</tr>
					</table>
					</div>
					<? } ?>
