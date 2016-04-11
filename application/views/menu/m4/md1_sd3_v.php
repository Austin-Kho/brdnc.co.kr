			<div class="main_start"></div>
<?php
	$attributes = array('name' => 'inout_frm', 'method' => 'post');
	echo form_open('/m4/capital/1/2/', $attributes);
?>
				<label class="sr-only"><input type="hidden" name="cont_1_h" value=""></label> <!-- 수수료 발생 시 - 적요_1 -->
				<label class="sr-only"><input type="hidden" name="cont_2_h" value=""></label> <!-- 수수료 발생 시 - 적요_2 -->
				<label class="sr-only"><input type="hidden" name="cont_3_h" value=""></label> <!-- 수수료 발생 시 - 적요_3 -->
				<label class="sr-only"><input type="hidden" name="cont_4_h" value=""></label> <!-- 수수료 발생 시 - 적요_4 -->
				<label class="sr-only"><input type="hidden" name="cont_5_h" value=""></label> <!-- 수수료 발생 시 - 적요_5 -->
				<label class="sr-only"><input type="hidden" name="cont_6_h" value=""></label> <!-- 수수료 발생 시 - 적요_6 -->
				<label class="sr-only"><input type="hidden" name="cont_7_h" value=""></label> <!-- 수수료 발생 시 - 적요_7 -->
				<label class="sr-only"><input type="hidden" name="cont_8_h" value=""></label> <!-- 수수료 발생 시 - 적요_8 -->
				<label class="sr-only"><input type="hidden" name="cont_9_h" value=""></label> <!-- 수수료 발생 시 - 적요_9 -->
				<label class="sr-only"><input type="hidden" name="cont_10_h" value=""></label> <!-- 수수료 발생 시 - 적요_10 -->

				<div class="row" style="margin: 0 0 20px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #cccccc;">
					<div class="col-xs-3 col-md-2 center" style="background-color: #F4F4F4; height: 40px; padding: 10px; 0">거래일자</div>
					<div class="col-xs-4 col-md-6" style="height: 40px; padding-top: 5px;">
						<div class="col-xs-10 col-md-3" style="padding: 0px;">
							<label for="deal_date" class="sr-only">시작일</label>
							<input type="text" class="form-control input-sm wid-95" id="deal_date" name="deal_date" maxlength="10" value="<?php echo date('Y-m-d')?>" readonly onClick="cal_add(this); event.cancelBubble=true">
						</div>
						<div class="col-xs-2 col-md-1 glyphicon-wrap" style="padding: 6px 0;">
							<a href="javascript:" onclick="cal_add(document.getElementById('deal_date'),this); event.cancelBubble=true">
								<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
							</a>
						</div>
					</div>
					<div class="col-xs-2 col-md-2 center" style="background-color: #F4F4F4; height: 40px; padding: 10px;">담당자</div>
					<div class="col-xs-3 col-md-2" style="height: 40px; padding-top: 10px;"><?php  echo $this->session->userdata['name']; ?></div>
				</div>


				<div class="row table-responsive" style="margin: 0;">
					<table class="table table-bordered table-condensed font12">
						<thead>
							<tr>
								<th style="20px" class="center"><input type="checkbox" disabled></td>
								<th style="120px" class="center">구 분 <font color="red">*</font></td>
								<th style="55px" class="center">현 장 <font color="red">*</font></td>
								<th style="55px" class="center">조합대여</td>
								<th style="75px" class="center">계정과목 <font color="red">*</font> <a href="javascript:" onclick="popUp_size('/pc/_menu3/account_m.php','account',700,800)" title="계정과목 관리"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></td>
								<th style="120px" class="center">적 요 <font color="red">*</font></td>
								<th style="70px" class="center">거 래 처</td>
								<th style="60px" class="center">입금처 <font color="red">*</font> <a href="javascript:" onclick="popUp('/pc/_menu3/acc_list.php?fn=1&amp;frm=out_stock_frm','bank_acc')" title="은행계좌 관리"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></td>
								<th style="50px" class="center">입금금액 <font color="red">*</font></td>
								<th style="60px" class="center">출금처 <font color="red">*</font> <a href="javascript:" onclick="popUp('/pc/_menu3/acc_list.php?fn=1&amp;frm=out_stock_frm','bank_acc')" title="은행계좌 관리"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></td>
								<th style="50px" class="center">출금금액 <font color="red">*</font></td>
								<th style="110px" class="center">이체수수료 <font color="red">*</font></td>
								<th style="70px" class="center">증빙서류 <font color="red">*</font></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _1 -->
								<td class="center" >
									<select name="class1_1" id="class1_1" style="width:52px;" onChange="inoutSel(this.form, 1)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_1" id="class2_1" style="width:52px;" onChange="inoutSel2(this.form, 1)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _1 -->
								<td class="center">
									<select name="pj_seq_1" id="pj_seq_1" style="width:60px;" disabled>
										<option value="" selected> 선 택</option>
										<?php // for($i=0; $i<$pj_num; $i++){ ?>
										<option value="<?php // echo $pj_seq[$i]?>"> <?php // echo $pj_name[$i]?></option>
										<? //} ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _1 -->
								<td class="center">조합 : <input type="checkbox" value="1" name="jh_loan_1" id="jh_loan_1" onClick="jh_chk(1);" disabled></td>
								<!-- 회계계정 _1 -->
								<td class="center" id="d1_1_1"> <!-- 자산 계정 -->
									<select name="account_1" id="d1_acc1_1" style="width:60px;" disabled>
<?php
	// $acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='1' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
	// $acc_rlt = mysql_query($acc_qry, $connect);
?>
										<option value="" selected>선 택</option>
										<?php // while($acc_rows = mysql_fetch_array($acc_rlt)){?>
										<option value="<?php // echo $acc_rows[d3_acc_name]; ?>"> <?php // echo $acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"; ?>
										<?// }?>
									</select>
								</td>
								<td class="center" id="d1_2_1" style="display:none;"> <!-- 부채 계정 -->
									<select name="account_1" id="d1_acc2_1" style="width:60px;" disabled>
<?php
	// $acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='2' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
	// $acc_rlt = mysql_query($acc_qry, $connect);
?>
										<option value="" selected>선 택</option>
										<?php // while($acc_rows = mysql_fetch_array($acc_rlt)){ ?>
										<option value="<?php // echo $acc_rows[d3_acc_name]?>"> <?php // echo $acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"; ?></option>
										<?// }?>
									</select>
								</td>
								<td class="center" id="d1_3_1" style="display:none;"> <!-- 자본 계정 -->
									<select name="account_1" id="d1_acc3_1" style="width:60px;" disabled>
	<?
		// $acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='3' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
		// $acc_rlt = mysql_query($acc_qry, $connect);
	?>
										<option value="" selected>선 택</option>
										<?php // while($acc_rows = mysql_fetch_array($acc_rlt)){?>
										<option value="<?php // echo $acc_rows[d3_acc_name]?>"> <?php // echo $acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"; ?></option>
										<?// }?>
									</select>
								</td>
								<td class="center" id="d1_4_1" style="display:none;"> <!-- 수익 계정 -->
									<select name="account_1" id="d1_acc4_1" style="width:60px;" disabled>
<?
	// $acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
	// $acc_rlt = mysql_query($acc_qry, $connect);
?>
										<option value="" selected>선 택</option>
										<?php // while($acc_rows = mysql_fetch_array($acc_rlt)){?>
										<option value="<?php // echo $acc_rows[d3_acc_name]?>"> <?php // echo $acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?></option>
										<?// }?>
									</select>
								</td>
								<td class="center" id="d1_5_1" style="display:none;"> <!-- 비용 계정 -->
									<select name="account_1" id="d1_acc5_1" style="width:60px;" disabled>
<?
	// $acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
	// $acc_rlt = mysql_query($acc_qry, $connect);
?>
										<option value="" selected>선 택</option>
										<?php // while($acc_rows = mysql_fetch_array($acc_rlt)){?>
										<option value="<?php // echo $acc_rows[d3_acc_name]?>"> <?php // echo $acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?></option>
										<?// }?>
									</select>
								</td>
								<!-- 적 요 _1 -->
								<td class="center"><input type="text" name="cont_1" size="20" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"></td>
								<!-- 거 래 처 _1 -->
								<td class="center"><input type="text" name="acc_1" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"></td>
								<!-- 입금처 _1 -->
								<td class="center">
									<select name="in_1" id="in_1" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php
	// $query="select no, name from cms_capital_bank_account ";
	// $result=mysql_query($query, $connect);
	// while($rows=mysql_fetch_array($result)){
?>
										<option value="<?php // echo $rows[no]?>"> <?php // echo $rows[name]?></option>
<? // } ?>
									</select>
								</td>
								<!-- 입금금액 _1 -->
								<td class="center"><input type="text" name="inc_1" id="inc_1" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_1,this,document.inout_frm.exp_1)"></td>
								<!--출금처 _1 -->
								<td class="center">
									<select name="out_1" id="out_1" style="width:55px;" onChange="charge(1,this.value);" disabled>
										<option value="" selected> 선 택
<?php
	// $query="select no, bank, name from cms_capital_bank_account ";
	// $result=mysql_query($query, $connect);
	// while($rows=mysql_fetch_array($result)){
?>
										<option value="<?php // echo $rows[no]."-".$rows[bank]?>"> <?php // echo $rows[name]?>
<? // } ?>
									</select>
								</td>
								<!-- 출금금액 _1 -->
								<td class="center"><input type="text" name="exp_1" id="exp_1" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _1 -->
								<td class="center"><input type="checkbox" name="char1_1" onclick="char2_chk(document.inout_frm.char2_1,1);" disabled> 금액 : <input type="text" name="char2_1" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _1 -->
								<td class="center">
									<select name="evi_1" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>


						</tbody>
					</table>
				</div>
</form>
				<div class="row" style="margin: 0;">
<?php // if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="com_submit('$mode');";} ?>
					<div class="form-group btn-wrap" style="margin: 0;">
						<input type="button" class="btn btn-primary btn-sm" onclick="<?php //echo $submit_str?>" value="거래등록">
					</div>
				</div>
