					<!-- ===== subject table end ===== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 자금 일보</font></b>
						<div style="float:right;">
							<!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. -->
						</div>
					</div>
					<!-- ===== subject table end ===== -->
					<?
						$ca_1_1_rlt = mysql_query("SELECT ca_1_1 FROM cms_mem_auth WHERE user_id='$_SESSION[p_id]' ", $connect);
						$ca_1_1_row = mysql_fetch_array($ca_1_1_rlt);

						if(!$ca_1_1_row[ca_1_1]||$ca_1_1_row[ca_1_1]==0){
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
							<a href="javascript:" onClick="window.alert('준비중입니다!');">▲ 손익계산서</a>
						</div>
						<form method="post" name="d_cash_book_frm" action="<?=$_SERVER['PHP_SELF']?>">
						<input type="hidden" name="m_di" value="<?=$m_di?>">
						<input type="hidden" name="s_di" value="1">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="80" class="form2" bgcolor="#F8F8F8" height="38">날 짜 </td>
							<td class="form2" colspan="2">
							<?
								if(!$e_date) $e_date=date('Y-m-d');
							?>
							<input type="text" name="e_date" id="e_date" value="<?=$e_date?>" size="25" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
							<a href="javascript:" onclick="cal_add(document.getElementById('e_date'),this); event.cancelBubble=true"><img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
							<input type="button" value=" 검 색 " onclick="submit();" class="inputstyle11" style="height='20'; width='100';">
							</td>
						</tr>
						</table><div style="height:18px;"></div>


						<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<tr>
							<td>
							<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr bgcolor="#f2f2f9">
								<td colspan="3" style="padding:0 0 0 10px;border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">
								<b><font color="#ee0066">▶</font> <font color="#003399">금 일 수 지 현 황</font></b> (<?=$e_date?> 현재)</td>
							</tr>
							<tr bgcolor="#f5f5f5">
								<td width="264" align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="3" height="28"> 수 입 내 역 </td>
							</tr>
							<tr bgcolor="#f8f8f3">
								<td align="center" width="28%" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">거래처</td>
								<td align="center" width="40%" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;">적 요</td>
								<td align="center" width="32%" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;">금 액</td>
							</tr>
							<?
								$da_in_qry="SELECT cont,acc,inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$e_date' order by seq_num";
								$da_in_rlt=mysql_query($da_in_qry, $connect);

								$da_ex_qry="SELECT class1,cont,acc,inc,exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$e_date' order by seq_num";
								$da_ex_rlt=mysql_query($da_ex_qry, $connect);

								$in_num = mysql_num_rows($da_in_rlt);
								$ex_num = mysql_num_rows($da_ex_rlt);

								if($in_num>$ex_num) $num=$in_num; else $num=$ex_num; // 행수 설정;

								for($i=0;$i<=$num;$i++){
									$da_in_rows=mysql_fetch_array($da_in_rlt);
									if($da_in_rows[inc]==0){ $income="";}else{$income=number_format($da_in_rows[inc]);}

									if(!$da_in_rows[acc]){
										 $da_in_acc="";
									}else{
										 $da_in_acc=$da_in_rows[acc];
									}

									if(!$da_in_rows[cont]){
										 $da_in_cont="";
									}else{
										 $da_in_cont=$da_in_rows[cont];
									}
							?>
							<tr>
								<td style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28"><?=rg_cut_string($da_in_acc,16,"..")?></td>
								<td style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_in_cont,20,"..")?></td>
								<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$income?></td>
							</tr>
							<? } ?>
							<tr bgcolor="#f6f6f6">
							<?
								$aaq="SELECT SUM(inc) AS total_inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND (class1='1' or class1='3') AND deal_date='$e_date'";
								$aar=mysql_query($aaq, $connect);
								$aaro=mysql_fetch_array($aar);
							?>
								<td align="center" style="border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">TOTAL</td>
								<td align="center" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"></td>
								<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#0066ff"><?if($aaro[total_inc]==0){echo "-";}else{echo number_format($aaro[total_inc]);}?></font></td>
							</tr>
							</table>
							</td>
							<td>
							<table border="0" width="100%" cellspacing="0" cellpadding="0">
							<tr bgcolor="#f2f2f9">
								<td align="right" colspan="3" style="padding:0 10px 0 0px;border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">(단위 : 원)</td>
							</tr>
							<tr bgcolor="#f5f5f5">
								<td width="264" align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;" colspan="3" height="28"> 지 출 내 역 </td>
							</tr>
							<tr bgcolor="#f8f8f3">
								<td align="center" width="28%" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;" height="28">거래처</td>
								<td align="center" width="40%" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">적 요</td>
								<td align="center" width="32%" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;">금 액</td>
							</tr>
							<?	
								for($i=0;$i<=$num;$i++){
									$da_ex_rows=mysql_fetch_array($da_ex_rlt);
									if($da_ex_rows[exp]==0){ $exp="";}else{$exp=number_format($da_ex_rows[exp]);}

									if(!$da_ex_rows[acc]){
										 $da_ex_acc="";
									}else{
										 $da_ex_acc=$da_ex_rows[acc];
									}

									if(!$da_ex_rows[cont]){
										 $da_ex_cont="";
									}else{
										 $da_ex_cont=$da_ex_rows[cont];
									}
							?>
							<tr>
								<td style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;" height="28"><?=rg_cut_string($da_ex_acc,16,"..")?></td>
								<td style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=rg_cut_string($da_ex_cont,20,"..")?></td>
								<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$exp?></td>
							</tr>
							<? } ?>
							<tr bgcolor="#f6f6f6">
							<?
								$bbq="SELECT SUM(exp) AS total_exp FROM cms_capital_cash_book WHERE (com_div>0) AND (class1='2' or class1='3') AND deal_date='$e_date'";
								$bbr=mysql_query($bbq, $connect);
								$bbro=mysql_fetch_array($bbr);
							?>
								<td align="center" style="border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;" height="28">TOTAL</td>
								<td align="center" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"></td>
								<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#ff3300"><?if($bbro[total_exp]==0){echo "-";}else{echo number_format($bbro[total_exp]);}?></font></td>
							</tr>
							</table>
							</td>
						</tr>
						<tr><td height="33"></td></tr>
						</table>


						<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<tr bgcolor="#f2f2f9">
							<td colspan="5" style="padding:0 0 0 10px;border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">
							<b><font color="#ee0066">▶</font> <font color="#003399">자 금 현 황</font></b> (<?=$e_date?> 현재)
							</td>
							<td align="right" style="padding:0 10px 0 0px;border-width: 1px 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">(단위 : 원)</td>
						</tr>
						<tr bgcolor="#f5f5f5">
							<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" colspan="2" height="28"> 구 분 </td>
							<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;">전일잔액</td>
							<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;">입금(증가)</td>
							<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;">출금(감소)</td>
							<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;">금일잔액</td>
						</tr>
						<?
							$d_qry=" SELECT * FROM cms_capital_bank_account ";
							$d_rlt=mysql_query($d_qry, $connect);
							$d_num=mysql_num_rows($d_rlt);

							$num=$d_num;  // 행수 설정;

							for($i=0; $i<=$num; $i++){
								 $d_rows=mysql_fetch_array($d_rlt);

								 if($i==0) $td_str="<td align='center' style='padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;'>현금</td>";
								 if($i==1) $td_str="<td align='center' style='padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;' rowspan='$num'>보통예금</td>";
								 if($i>1) $td_str="";

								 $in_qry="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND in_acc='$d_rows[no]' AND deal_date<='$e_date' "; // 계정별 설정일까지 총 수입
								 $in_rlt=mysql_query($in_qry,$connect);
								 $in_row=mysql_fetch_array($in_rlt);
								 $in_qry1="SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE (com_div>0 AND class2<>8) AND in_acc='$d_rows[no]' AND deal_date='$e_date' "; // 계정별 설정당일 수입
								 $in_rlt1=mysql_query($in_qry1,$connect);
								 $in_row1=mysql_fetch_array($in_rlt1);
										 
								 $ex_qry="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date<='$e_date' "; // 계정별 설정일까지 총 지출
								 $ex_rlt=mysql_query($ex_qry,$connect);
								 $ex_row=mysql_fetch_array($ex_rlt);
										 
								 $ex_qry1="SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE (com_div>0) AND out_acc='$d_rows[no]' AND deal_date='$e_date' "; // 계정별 설정당일 지출
								 $ex_rlt1=mysql_query($ex_qry1,$connect);
								 $ex_row1=mysql_fetch_array($ex_rlt1);

								 if(!$d_rows[name]){   // 설정일까지 시재 구하기
									 $balance="";
								 }else	if($in_row[inc]==$ex_row[exp]){
									 $balance="-";
								 }else{
									 $balance=number_format($in_row[inc]-$ex_row[exp]);
								 }
								 if(!$d_rows[name]){   // 설정 당일 수입 구하기
									 $d_inc="";
								 }else	if($in_row1[inc]==0){
									 $d_inc="-";
								 }else{
									 $d_inc=number_format($in_row1[inc]);
								 }
								 if(!$d_rows[name]){   // 설정 당일 지출 구하기
									 $d_exp="";
								 }else	if($ex_row1[exp]==0){
									 $d_exp="-";
								 }else{
									 $d_exp=number_format($ex_row1[exp]);
								 }
										 
								 if(!$d_rows[name]){  // 전일 잔액 구하기
									 $y_bal="";
								 }else if(($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]==0){
									 $y_bal="-";
								 }else{
									 $y_bal=number_format(($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc]);
								 }
										 
								 $total_y_ba+=($in_row[inc]-$ex_row[exp])+$ex_row1[exp]-$in_row1[inc];
								 $total_d_inc+=$in_row1[inc];
								 $total_d_exp+=$ex_row1[exp];
								 $total_ba+=$in_row[inc]-$ex_row[exp];
						?>
						<tr>
							<?=$td_str?>
							<td style="padding:0 0 0 10px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;" height="28"><?=$d_rows[name]?></td><!-- 계정 명 -->
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$y_bal?></td> <!-- 전일 잔액 -->
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$d_inc?></td> <!-- 당일 입금 -->
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$d_exp?></td> <!-- 당일 출금 -->
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?=$balance?></td> <!-- 금일 잔액 -->
						</tr>
						<? } ?>
						<tr bgcolor="#f6f6f6">
							<td align="center" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;" height="28">TOTAL</td>
							<td style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"></td>
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($total_y_ba==0){echo "-";}else{echo number_format($total_y_ba);}?></td>
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#0066ff"><?if($total_d_inc==0){echo "-";}else{echo  number_format($total_d_inc);}?></font></td>
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#ff3300"><?if($total_d_exp==0){echo "-";}else{echo number_format($total_d_exp);}?></font></td>
							<td align="right" style="padding:0 10px 0 0px;border-width: 0 0 1px 1px; border-color:#E1E1E1; border-style: solid;"><font color="#000099"><?if($auth_row[group]>$auth_level){echo "조회 권한 없음";}else if($total_ba==0){echo "-";}else{echo number_format($total_ba);}?></font></td>
						</tr>						
						</table><table><tr><td height="8"></td></tr></table>

						<table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:1px solid #D6D6D6;">
						<tr align="center">
						<?
							 $cash1=" SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0 AND class2<>8) AND in_acc='1' $e_add  "; // 현금시재 구하기
							 $ca_qry1=mysql_query( $cash1, $connect);
							 $ca_row1=mysql_fetch_array($ca_qry1);
							 $cash2="SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND out_acc='1' $e_add ";
							 $ca_qry2=mysql_query( $cash2, $connect);
							 $ca_row2=mysql_fetch_array($ca_qry2);

							 $b_bal1="SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0 AND class2<>8) AND in_acc>'1'  $e_add   "; // 계좌 잔고 구하기
							 $b_qry1=mysql_query($b_bal1, $connect);
							 $b_row1=mysql_fetch_array($b_qry1);
							 $b_bal2="SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND out_acc>'1'  $e_add   ";
							 $b_qry2=mysql_query($b_bal2, $connect);
							 $b_row2=mysql_fetch_array($b_qry2);

							 $dept1=" SELECT SUM(inc) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='2' $e_add   "; // 차용금 합계
							 $de_qry1=mysql_query( $dept1, $connect);
							 $de_row1=mysql_fetch_array($de_qry1);
							 $dept2=" SELECT SUM(exp) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='5'  $e_add   "; // 상환금 합계
							 $de_qry2=mysql_query( $dept2, $connect);
							 $de_row2=mysql_fetch_array($de_qry2);

							 $loan1=" SELECT SUM(exp) AS in_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='6'  $e_add   "; // 대여금 합계
							 $lo_qry1=mysql_query( $loan1, $connect);
							 $lo_row1=mysql_fetch_array($lo_qry1);
							 $loan2=" SELECT SUM(inc) AS out_total FROM cms_capital_cash_book  WHERE (com_div>0) AND class2='3'  $e_add   "; // 회수금 합계
							 $lo_qry2=mysql_query( $loan2, $connect);
							 $lo_row2=mysql_fetch_array($lo_qry2);

							 $cash_hand = number_format($ca_row1[in_total]-$ca_row2[out_total])." 원";
							 $bank_balance=number_format($b_row1[in_total]-$b_row2[out_total])." 원";
							 $dept=number_format($de_row1[in_total]-$de_row2[out_total])." 원";
							 $loan=number_format($lo_row1[in_total]-$lo_row2[out_total])." 원";
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