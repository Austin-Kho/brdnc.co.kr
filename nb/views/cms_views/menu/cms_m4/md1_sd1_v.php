			<div class="main_start">
				<a href="<?php echo base_url('/cms_excel_file/daily_money_report?sh_date=').$sh_date; ?>">
					<img src="<?php echo base_url('static/img/excel_icon.jpg'); ?>" height="10" border="0" alt="EXCEL 아이콘" /> EXCEL로 출력
				</a>
			</div>

			<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">날 짜</div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding-top: 5px;">
					<!-- <form method="post" name="d_cash_book_frm" action=""> -->
<?php
	$attributes = array('name' => 'd_cash_book_frm');
	echo form_open(current_url(), $attributes);
?>
						<div class="col-xs-8 col-sm-5 col-md-3 glyphicon-wrap" style="padding: 0px;">
							<label for="sh_date" class="sr-only">시작일</label>
							<input type="text" class="form-control input-sm wid-95" id="sh_date" name="sh_date" maxlength="10" value="<?php echo $sh_date;?>" readonly onClick="cal_add(this); event.cancelBubble=true">
						</div>
						<div class="col-xs-1 glyphicon-wrap" style="padding: 6px 0;">
							<a href="javascript:" onclick="cal_add(document.getElementById('sh_date'),this); event.cancelBubble=true">
								<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
							</a>
						</div>
						<div class="col-xs-2" style="padding-left: 0;">
							<input type="button" class="btn btn-primary btn-sm" name="name" value="검 색" onclick="submit();">
						</div>
					</form>
				</div>
			</div>

			<div class="row table-responsive" style="margin: 0;">

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
<?php for($i=0; $i<=$bank_acc['num']; $i++): // 현금계정 + 은행계좌 수 만큼 반복 한다.
		if($i==0) $td_str="<td class='center' style='".$hk_bgcolor."'>현금</td>";
		if($i==1) $td_str="<td class='center' rowspan='".$bank_acc['num']."'>보통예금</td>";
		if($i>1) $td_str="";

		if(empty($bank_acc['result'][$i]->name)) $bank_acc_name = '&nbsp;'; else $bank_acc_name = $bank_acc['result'][$i]->name;
		if(empty($cum_in[$i][0]->inc)) $cum_inc = "0"; else $cum_inc = $cum_in[$i][0]->inc;
		if(empty($date_in[$i][0]->inc)) $date_inc = "0"; else $date_inc = $date_in[$i][0]->inc;
		if(empty($cum_ex[$i][0]->exp)) $cum_exp = "0"; else $cum_exp = $cum_ex[$i][0]->exp;
		if(empty($date_ex[$i][0]->exp)) $date_exp = "0"; else $date_exp = $date_ex[$i][0]->exp;

		$balance = $cum_inc-$cum_exp; // 계정별 최종 금일 시재(잔고)
		$y_bal = $cum_inc-$cum_exp+$date_exp-$date_inc;
?>
					<tr>
						<?php echo $td_str?>
						<td class="center" width="185" style="<?php if($i==0) echo $hk_bgcolor?>"><?php echo $bank_acc_name; ?></td><!-- 계정 명 -->
						<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>"><?php if($i==$bank_acc['num']) echo ''; else if($y_bal==0) echo "-"; else echo number_format($y_bal);?></td> <!-- 전일 잔액 -->
						<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>"><?php if($i==$bank_acc['num']) echo ''; else if($date_inc==0) echo "-"; else echo number_format($date_inc);?></td> <!-- 당일 입금 -->
						<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>"><?php if($i==$bank_acc['num']) echo ''; else if($date_exp==0) echo "-"; else echo number_format($date_exp);?></td> <!-- 당일 출금 -->
						<td class="right" style="<?php if($i==0) echo $hk_bgcolor?>;"><?php if($i==$bank_acc['num']) echo ''; else if($balance==0) echo "-"; else echo number_format($balance);?></td> <!-- 금일 잔액 -->
					</tr>
<?php endfor;// 현금 / 보통예금 수만큼 반복 for문 종료 ?>
					<tr bgcolor="#f6f6f6">
						<td class="center" colspan="2">현금성자산 계</td>
						<td class="right"><?php if($yd_tot==0){echo "-";}else{echo number_format($yd_tot);}?></td>
						<td class="right"><font color="#0066ff"><?php if($td_inc==0){echo "-";}else{echo  number_format($td_inc);}?></font></td>
						<td class="right"><font color="#ff3300"><?php if($td_exp==0){echo "-";}else{echo number_format($td_exp);}?></font></td>
						<td class="right"><font color="#000099"><?php if($td_tot==0){echo "-";}else{echo number_format($td_tot);}?></font></td>
					</tr>

					<!-- -----------------------------------------대여금 집계 시작------------------------------------ -->
<?php $col_num = $jh_data['num']+1; ?>
<?php for($i=0; $i<=$jh_data['num']; $i++):
	if($i==0) $td_str2="<td class='center bo-bottom' rowspan='$col_num'>조합대여금</td>";
	if($i>0) $td_str2="";

	if(empty($jh_name[$i][$i])) $jh_name = '&nbsp;'; else $jh_name = $jh_name[$i][$i]->pj_name;

	if(empty($jh_cum_in[$i][$i]->inc)) $jh_cum_inc = "0"; else $jh_cum_inc = $jh_cum_in[$i][$i]->inc;
	if(empty($jh_date_in[$i][$i]->inc)) $jh_date_inc = "0"; else $jh_date_inc = $jh_date_in[$i][$i]->inc;
	if(empty($jh_cum_ex[$i][$i]->exp)) $jh_cum_exp = "0"; else $jh_cum_exp = $jh_cum_ex[$i][$i]->exp;
	if(empty($jh_date_ex[$i][$i]->exp)) $jh_date_exp = "0"; else $jh_date_exp = $jh_cum_ex[$i][$i]->exp;

	$jh_balance = $jh_cum_exp-$jh_cum_inc; // 계정별 최종 금일 시재(잔고)
	$jh_y_bal = $jh_cum_exp-$jh_cum_inc+$jh_date_exp-$jh_date_inc;
?>
					<tr>
						<?php echo $td_str2; ?>
						<td><?php echo $jh_name; ?></td><!-- 조합 명 -->
						<td class="right"><?php if($i==$jh_data['num']) echo ''; else if($jh_y_bal==0) echo '-'; else echo number_format($jh_y_bal);?></td> <!-- 전일 대여금 잔액 -->
						<td class="right"><?php if($i==$jh_data['num']) echo ''; else if($jh_date_exp==0) echo '-'; else echo number_format($jh_date_exp);?></td> <!-- 당일 대여금 출금 -->
						<td class="right"><?php if($i==$jh_data['num']) echo ''; else if($jh_date_inc==0) echo '-'; else echo number_format($jh_date_inc);?></td> <!-- 당일 대여금 회수 -->
						<td class="right"><?php if($i==$jh_data['num']) echo ''; else if($jh_balance==0) echo '-'; else echo number_format($jh_balance);?></td> <!-- 금일 대여금 잔액 -->
					</tr>
<? endfor; // 조합 구하기 for 문 종료 ?>
					<tr bgcolor="#f6f6f6">
						<td class="center" colspan="2">
							조합대여금 계
						</td>
						<td class="right"><?php  if($jh_yd_tot==0){echo "-";}else{echo number_format($jh_yd_tot);}?></td>
						<td class="right"><font color="#ff3300"><?php if($jh_td_exp==0){echo "-";}else{echo  number_format($jh_td_exp);}?></font></td>
						<td class="right"><font color="#0066ff"><?php if($jh_td_inc==0){echo "-";}else{echo number_format($jh_td_inc);}?></font></td>
						<td class="right"><font color="#000099"><?php if($jh_td_tot==0){echo "-";}else{echo number_format($jh_td_tot);}?></font></td>
					</tr>
					<!-- -----------------------------------------대여금 집계 종료------------------------------------ -->
				</table>
			</div>

			<div class="row table-responsive" style="margin: 0; padding-top: 5px;">

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
						<td class="center" width="200">비 고</td>
					</tr>
<?php
	$in_num = $da_in['num'];
	if($in_num<2) $num=2; else $num=$in_num; // 행수 설정;
?>
<?php	for($i=0;$i<=$num;$i++):
	if(empty($da_in['result'][$i]->acc)) $da_in_acc = '&nbsp;'; else $da_in_acc = $da_in['result'][$i]->acc;
	if(empty($da_in['result'][$i]->cont)) $da_in_cont = '&nbsp;'; else $da_in_cont = $da_in['result'][$i]->cont;
	if(empty($da_in['result'][$i]->inc) OR $da_in['result'][$i]->inc==0){ $income = "";}else{$income = number_format($da_in['result'][$i]->inc);}
	if(empty($da_in['result'][$i]->account)) $da_in_account = '&nbsp;'; else $da_in_account = $da_in['result'][$i]->account;
	if(empty($da_in['result'][$i]->note)) $da_in_note = '&nbsp;'; else $da_in_note = $da_in['result'][$i]->note;
?>
					<tr>
						<td><?php echo cut_string($da_in_acc,16,""); ?></td>
						<td><?php echo cut_string($da_in_cont,20,""); ?></td>
						<td class="right"><?php echo $income; ?></td>
						<td class="center"><?php echo cut_string($da_in_account,10,"")?></td>
						<td class="center"><?php echo cut_string($da_in_note,20,"")?></td>
					</tr>
<?php endfor; ?>
					<tr bgcolor="#f6f6f6">
						<td class="center" colspan="2">입 금 합 계</td>
						<td class="right"><font color="#0066ff"><?php if($da_in_total[0]->total_inc==0){echo "-";}else{echo number_format($da_in_total[0]->total_inc);}?></font></td>
						<td class="center"></td>
						<td class="center"></td>
					</tr>

					<tr><td colspan="5" style="height: 20px; background-color: white;"></td></tr>

					<!-- 출금 내역 -->
					<tr bgcolor="#f5f5f5">
						<td colspan="5"> <b>출 금 내 역</b> </td>
					</tr>
					<tr bgcolor="#f8f8f3">
						<td class="center">거래처</td>
						<td class="center">적 요</td>
						<td class="center">금 액</td>
						<td class="center">계정과목</td>
						<td class="center">비 고</td>
					</tr>
<?
$ex_num = $da_ex['num'];
if($ex_num<4) $num = 4; else $num = $ex_num;

for($i=0;$i<=$num;$i++):
	if(empty($da_ex['result'][$i]->acc)) $da_ex_acc = '&nbsp;'; else $da_ex_acc = $da_ex['result'][$i]->acc;
	if(empty($da_ex['result'][$i]->cont)) $da_ex_cont = ''; else $da_ex_cont = $da_ex['result'][$i]->cont;
	if(empty($da_ex['result'][$i]->exp) OR $da_ex['result'][$i]->exp==0){ $exp = ""; }else{ $exp = number_format($da_ex['result'][$i]->exp); }
	if(empty($da_ex['result'][$i]->account)) $da_ex_account = ''; else $da_ex_account = $da_ex['result'][$i]->account;
	if(empty($da_ex['result'][$i]->note)) $da_ex_note = ''; else $da_ex_note = $da_ex['result'][$i]->note;
?>
					<tr>
						<td><?php echo cut_string($da_ex_acc,16,"")?></td>
						<td><?php echo cut_string($da_ex_cont,20,"")?></td>
						<td class="right"><?php echo $exp?></td>
						<td class="center"><?php echo cut_string($da_ex_account,10,"")?></td>
						<td class="center"><?php echo cut_string($da_ex_note,20,"")?></td>
					</tr>
<?php endfor; ?>
					<tr bgcolor="#f6f6f6">
						<td class="center" colspan="2">출 금 합 계</td>
						<td class="right"><font color="#ff3300"><?php if($da_ex_total[0]->total_exp==0){echo "-";}else{echo number_format($da_ex_total[0]->total_exp); }?></font></td>
						<td class="center"></td>
						<td class="center"></td>
					</tr>
				</table>
			</div>
