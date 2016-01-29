					<!-- ===== subject table end ===== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 입출금 등록</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
						</div>
					</div>
					<!-- ===== subject table end ===== -->
					<?
						$_m3_1_3_rlt = mysql_query("select _m3_1_3 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m3_1_3_row = mysql_fetch_array($_m3_1_3_rlt);

						if(!$_m3_1_3_row[_m3_1_3]||$_m3_1_3_row[_m3_1_3]==0){
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
									<!-- <a href="javascript:" onClick="excel_pop(<?=$_m3_1_2_row[_m3_1_2]?>,2);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL 출력</a> -->
								</div>
								<form method="post" name="inout_frm" action="capital3_post.php">

								<input type="hidden" name="cont_1_h" value=""> <!-- 수수료 발생 시 - 적요_1 -->
								<input type="hidden" name="cont_2_h" value=""> <!-- 수수료 발생 시 - 적요_2 -->
								<input type="hidden" name="cont_3_h" value=""> <!-- 수수료 발생 시 - 적요_3 -->
								<input type="hidden" name="cont_4_h" value=""> <!-- 수수료 발생 시 - 적요_4 -->
								<input type="hidden" name="cont_5_h" value=""> <!-- 수수료 발생 시 - 적요_5 -->
								<input type="hidden" name="cont_6_h" value=""> <!-- 수수료 발생 시 - 적요_6 -->
								<input type="hidden" name="cont_7_h" value=""> <!-- 수수료 발생 시 - 적요_7 -->
								<input type="hidden" name="cont_8_h" value=""> <!-- 수수료 발생 시 - 적요_8 -->
								<input type="hidden" name="cont_9_h" value=""> <!-- 수수료 발생 시 - 적요_9 -->
								<input type="hidden" name="cont_10_h" value=""> <!-- 수수료 발생 시 - 적요_10 -->
								<?
									// 현장 목록 가져오기
									$pj_qry = "SELECT seq, pj_name FROM cms_project1_info WHERE is_end!='1' ORDER BY start_date DESC, seq DESC";
									$pj_rlt = mysql_query($pj_qry, $connect);
									$pj_num = mysql_num_rows($pj_rlt);
									for($i=0; $pj_rows = mysql_fetch_array($pj_rlt); $i++){
										$pj_seq[$i]= $pj_rows[seq];
										$pj_name[$i]= $pj_rows[pj_name];
									}
								?>
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100" class="form2" bgcolor="#F8F8F8" height="38">거래일자 <font color="red">*</font></td>
									<td class="form2">
										<input type="text" name="deal_date" id="deal_date" value="<?=date('Y-m-d')?>" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('deal_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<td class="form2" bgcolor="#F8F8F8">담 당 자 <font color="red">*</font></td>
									<td class="form2"><?=$_SESSION['p_name']?><input type="hidden" name="worker" value="<?=$_SESSION['p_name']?>"></td>
								</tr>
								</table><div style="height:18px;"></div>
								<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:1px solid #D6D6D6">
								<tr align="center" bgcolor="#f0f0e8">
									<td width="20" class="bottom" height="20"><input type="checkbox" class="InputCheck" disabled onClick="checkAll();"></td>
									<td width="120" class="bottom">구 분 <font color="red">*</font></td>
									<td width="55" class="bottom">현장대체 <font color="red">*</font></td>
									<td width="55" class="bottom">조합대여</td>
									<td width="75" class="bottom">계정과목 <font color="red">*</font> <a href="javascript:" onclick="popUp_size('<?=$cms_url?>_menu3/account_m.php','account',700,800)" title="계정과목 관리"><img src="../images/set.png" height="10" border="0" alt="설정"></a></td>
									<td width="120" class="bottom">적 요 <font color="red">*</font></td>
									<td width="70" class="bottom">거 래 처</td>
									<td width="60" class="bottom">입금처 <font color="red">*</font> <a href="javascript:" onclick="popUp('<?=$cms_url?>_capital/acc_list.php?fn=1&amp;frm=out_stock_frm','bank_acc')" title="은행계좌 관리"><img src="../images/set.png" height="10" border="0" alt="설정"></a></td>
									<td width="50" class="bottom">입금금액 <font color="red">*</font></td>
									<td width="60" class="bottom">출금처 <font color="red">*</font> <a href="javascript:" onclick="popUp('<?=$cms_url?>_menu3/acc_list.php?fn=1&amp;frm=out_stock_frm','bank_acc')" title="은행계좌 관리"><img src="../images/set.png" height="10" border="0" alt="설정"></a></td>
									<td width="50" class="bottom">출금금액 <font color="red">*</font></td>
									<td width="110" class="bottom">송금수수료 <font color="red">*</font></td>
									<td width="70" class="bottom">증빙서류 <font color="red">*</font></td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _1 -->
									<td align="center" class="bottom">
										<select name="class1_1" id="class1_1" style="width:52px;" onChange="inoutSel(1)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_1" id="class2_1" style="width:52px;" onChange="inoutSel2(1)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _1 -->
									<td class="bottom">
										<select name="pj_seq_1" id="pj_seq_1" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>

									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_1" id="jh_loan_1" onClick="jh_chk(1);" disabled></td>

									<!-- 회계계정 _1 -->
									<td class="bottom" id="inc_td_1">
										<select name="account_1" id="inc_account_1" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_1" style="display:none;">
										<select name="account_1" id="out_account_1" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _1 -->
									<td class="bottom"><input type="text" name="cont_1" size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _1 -->
									<td class="bottom"><input type="text" name="acc_1" size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금처 _1 -->
									<td class="bottom">
									<select name="in_1" id="in_1" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select no, name from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _1 -->
									<td class="bottom"><input type="text" name="inc_1" id="inc_1" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_1,this,document.inout_frm.exp_1)"></td>
									<!--출금처 _1 -->
									<td class="bottom">
									<select name="out_1" id="out_1" style="width:55px;" onChange="charge(1,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select no, bank, name from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _1 -->
									<td class="bottom"><input type="text" name="exp_1" id="exp_1" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _1 -->
									<td class="bottom"><input type="checkbox" name="char1_1" onclick="char2_chk(document.inout_frm.char2_1,1);" disabled> 금액 : <input type="text" name="char2_1" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _1 -->
									<td class="bottom">
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
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _2 -->
									<td class="bottom">
										<select name="class1_2" id="class1_2" style="width:52px;" onChange="inoutSel(2)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_2" id="class2_2" style="width:52px;" onChange="inoutSel2(2)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _2 -->
									<td class="bottom">
										<select name="pj_seq_2" id="pj_seq_2" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_2" id="jh_loan_2" onClick="jh_chk(2);" disabled></td>
									<!-- 회계계정 _2 -->
									<td class="bottom" id="inc_td_2">
										<select name="account_2" id="inc_account_2" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_2" style="display:none;">
										<select name="account_2" id="out_account_2" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _2 -->
									<td class="bottom"><input type="text" name="cont_2"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _2 -->
									<td class="bottom"><input type="text" name="acc_2"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _2 -->
									<td class="bottom">
									<select name="in_2" id="in_2" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _2 -->
									<td class="bottom"><input type="text" name="inc_2" id="inc_2" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_2,this,document.inout_frm.exp_2)"></td>
									<!--출금계정 _2 -->
									<td class="bottom">
									<select name="out_2" id="out_2" style="width:55px;" onChange="charge(2,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _2 -->
									<td class="bottom"><input type="text" name="exp_2" id="exp_2" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _2 -->
									<td class="bottom"><input type="checkbox" name="char1_2" onclick="char2_chk(document.inout_frm.char2_2,2);" disabled> 금액 : <input type="text" name="char2_2" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _2 -->
									<td class="bottom">
										<select name="evi_2" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _3 -->
									<td class="bottom">
										<select name="class1_3" id="class1_3" style="width:52px;" onChange="inoutSel(3)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_3" id="class2_3" style="width:52px;" onChange="inoutSel2(3)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _3 -->
									<td class="bottom">
										<select name="pj_seq_3" id="pj_seq_3" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_3" id="jh_loan_3" onClick="jh_chk(3);" disabled></td>
									<!-- 회계계정 _3 -->
									<td class="bottom" id="inc_td_3">
										<select name="account_3" id="inc_account_3" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_3" style="display:none;">
										<select name="account_3" id="out_account_3" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _3 -->
									<td class="bottom"><input type="text" name="cont_3"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _3 -->
									<td class="bottom"><input type="text" name="acc_3"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _3 -->
									<td class="bottom">
									<select name="in_3" id="in_3" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _3 -->
									<td class="bottom"><input type="text" name="inc_3" id="inc_3" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_3,this,document.inout_frm.exp_3)"></td>
									<!--출금계정 _3 -->
									<td class="bottom">
									<select name="out_3" id="out_3" style="width:55px;" onChange="charge(3,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _3 -->
									<td class="bottom"><input type="text" name="exp_3" id="exp_3" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _3 -->
									<td class="bottom"><input type="checkbox" name="char1_3" onclick="char2_chk(document.inout_frm.char2_3,3);" disabled> 금액 : <input type="text" name="char2_3" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _3 -->
									<td class="bottom">
										<select name="evi_3" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증

										</select>
									</td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _4 -->
									<td class="bottom">
										<select name="class1_4" id="class1_4" style="width:52px;" onChange="inoutSel(4)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_4" id="class2_4" style="width:52px;" onChange="inoutSel2(4)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _4 -->
									<td class="bottom">
										<select name="pj_seq_4" id="pj_seq_4" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_4" id="jh_loan_4" onClick="jh_chk(4);" disabled></td>
									<!-- 회계계정 _4 -->
									<td class="bottom" id="inc_td_4">
										<select name="account_4" id="inc_account_4" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_4" style="display:none;">
										<select name="account_4" id="out_account_4" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _4 -->
									<td class="bottom"><input type="text" name="cont_4"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _4 -->
									<td class="bottom"><input type="text" name="acc_4"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _4 -->
									<td class="bottom">
									<select name="in_4" id="in_4" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _4 -->
									<td class="bottom"><input type="text" name="inc_4" id="inc_4" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_4,this,document.inout_frm.exp_4)"></td>
									<!--출금계정 _4 -->
									<td class="bottom">
									<select name="out_4" id="out_4" style="width:55px;" onChange="charge(4,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _4 -->
									<td class="bottom"><input type="text" name="exp_4" id="exp_4" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _4 -->
									<td class="bottom"><input type="checkbox" name="char1_4" onclick="char2_chk(document.inout_frm.char2_4,4);" disabled> 금액 : <input type="text" name="char2_4" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _4 -->
									<td class="bottom">
										<select name="evi_4" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _5 -->
									<td class="bottom">
										<select name="class1_5" id="class1_5" style="width:52px;" onChange="inoutSel(5)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_5" id="class2_5" style="width:52px;" onChange="inoutSel2(5)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _5 -->
									<td class="bottom">
										<select name="pj_seq_5" id="pj_seq_5" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_5" id="jh_loan_5" onClick="jh_chk(5);" disabled></td>
									<!-- 회계계정 _5 -->
									<td class="bottom" id="inc_td_5">
										<select name="account_5" id="inc_account_5" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_5" style="display:none;">
										<select name="account_5" id="out_account_5" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _5 -->
									<td class="bottom"><input type="text" name="cont_5"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _5 -->
									<td class="bottom"><input type="text" name="acc_5"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _5 -->
									<td class="bottom">
									<select name="in_5" id="in_5" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _5 -->
									<td class="bottom"><input type="text" name="inc_5" id="inc_5" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_5,this,document.inout_frm.exp_5)"></td>
									<!--출금계정 _5 -->
									<td class="bottom">
									<select name="out_5" id="out_5" style="width:55px;" onChange="charge(5,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _5 -->
									<td class="bottom"><input type="text" name="exp_5" id="exp_5" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _5 -->
									<td class="bottom"><input type="checkbox" name="char1_5" onclick="char2_chk(document.inout_frm.char2_5,5);" disabled> 금액 : <input type="text" name="char2_5" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _5 -->
									<td class="bottom">
										<select name="evi_5" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _6 -->
									<td class="bottom">
										<select name="class1_6" id="class1_6" style="width:52px;" onChange="inoutSel(6)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_6" id="class2_6" style="width:52px;" onChange="inoutSel2(6)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _6 -->
									<td class="bottom">
										<select name="pj_seq_6" id="pj_seq_6" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_6" id="jh_loan_6" onClick="jh_chk(6);" disabled></td>
									<!-- 회계계정 _6 -->
									<td class="bottom" id="inc_td_6">
										<select name="account_6" id="inc_account_6" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_6" style="display:none;">
										<select name="account_6" id="out_account_6" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _6 -->
									<td class="bottom"><input type="text" name="cont_6"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _6 -->
									<td class="bottom"><input type="text" name="acc_6"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _6 -->
									<td class="bottom">
									<select name="in_6" id="in_6" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _6 -->
									<td class="bottom"><input type="text" name="inc_6" id="inc_6" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_6,this,document.inout_frm.exp_6)"></td>
									<!--출금계정 _6 -->
									<td class="bottom">
									<select name="out_6" id="out_6" style="width:55px;" onChange="charge(6,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _6 -->
									<td class="bottom"><input type="text" name="exp_6" id="exp_6" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _6 -->
									<td class="bottom"><input type="checkbox" name="char1_6" onclick="char2_chk(document.inout_frm.char2_6,6);" disabled> 금액 : <input type="text" name="char2_6" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _6 -->
									<td class="bottom">
										<select name="evi_6" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _7 -->
									<td class="bottom">
										<select name="class1_7" id="class1_7" style="width:52px;" onChange="inoutSel(7)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_7" id="class2_7" style="width:52px;" onChange="inoutSel2(7)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _7 -->
									<td class="bottom">
										<select name="pj_seq_7" id="pj_seq_7" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_7" id="jh_loan_7" onClick="jh_chk(7);" disabled></td>
									<!-- 회계계정 _7 -->
									<td class="bottom" id="inc_td_7">
										<select name="account_7" id="inc_account_7" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_7" style="display:none;">
										<select name="account_7" id="out_account_7" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _7 -->
									<td class="bottom"><input type="text" name="cont_7"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _7 -->
									<td class="bottom"><input type="text" name="acc_7"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _7 -->
									<td class="bottom">
									<select name="in_7" id="in_7" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _7 -->
									<td class="bottom"><input type="text" name="inc_7" id="inc_7" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_7,this,document.inout_frm.exp_7)"></td>
									<!--출금계정 _7 -->
									<td class="bottom">
									<select name="out_7" id="out_7" style="width:55px;" onChange="charge(7,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _7 -->
									<td class="bottom"><input type="text" name="exp_7" id="exp_7" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _7 -->
									<td class="bottom"><input type="checkbox" name="char1_7" onclick="char2_chk(document.inout_frm.char2_7,7);" disabled> 금액 : <input type="text" name="char2_7" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')"	onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _7 -->
									<td class="bottom">
										<select name="evi_7" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _8 -->
									<td class="bottom">
										<select name="class1_8" id="class1_8" style="width:52px;" onChange="inoutSel(8)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_8" id="class2_8" style="width:52px;" onChange="inoutSel2(8)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _8 -->
									<td class="bottom">
										<select name="pj_seq_8" id="pj_seq_8" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_8" id="jh_loan_8" onClick="jh_chk(8);" disabled></td>
									<!-- 회계계정 _8 -->
									<td class="bottom" id="inc_td_8">
										<select name="account_8" id="inc_account_8" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_8" style="display:none;">
										<select name="account_8" id="out_account_8" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _8 -->
									<td class="bottom"><input type="text" name="cont_8"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _8 -->
									<td class="bottom"><input type="text" name="acc_8"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _8 -->
									<td class="bottom">
									<select name="in_8" id="in_8" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _8 -->
									<td class="bottom"><input type="text" name="inc_8" id="inc_8" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_8,this,document.inout_frm.exp_8)"></td>
									<!--출금계정 _8 -->
									<td class="bottom">
									<select name="out_8" id="out_8" style="width:55px;" onChange="charge(8,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _8 -->
									<td class="bottom"><input type="text" name="exp_8" id="exp_8" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _8 -->
									<td class="bottom"><input type="checkbox" name="char1_8" onclick="char2_chk(document.inout_frm.char2_8,8);" disabled> 금액 : <input type="text" name="char2_8" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _8 -->
									<td class="bottom">
										<select name="evi_8" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								<tr align="center">
									<td class="bottom" height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _9 -->
									<td class="bottom">
										<select name="class1_9" id="class1_9" style="width:52px;" onChange="inoutSel(9)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_9" id="class2_9" style="width:52px;" onChange="inoutSel2(9)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _9 -->
									<td class="bottom">
										<select name="pj_seq_9" id="pj_seq_9" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_9" id="jh_loan_9" onClick="jh_chk(9);" disabled></td>
									<!-- 회계계정 _9 -->
									<td class="bottom" id="inc_td_9">
										<select name="account_9" id="inc_account_9" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_9" style="display:none;">
										<select name="account_9" id="out_account_9" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _9 -->
									<td class="bottom"><input type="text" name="cont_9"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _9 -->
									<td class="bottom"><input type="text" name="acc_9"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _9 -->
									<td class="bottom">
									<select name="in_9" id="in_9" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _9 -->
									<td class="bottom"><input type="text" name="inc_9" id="inc_9" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_9,this,document.inout_frm.exp_9)"></td>
									<!--출금계정 _9 -->
									<td class="bottom">
									<select name="out_9" id="out_9" style="width:55px;" onChange="charge(9,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _9 -->
									<td class="bottom"><input type="text" name="exp_9" id="exp_9" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _9 -->
									<td class="bottom"><input type="checkbox" name="char1_9" onclick="char2_chk(document.inout_frm.char2_9,9);" disabled> 금액 : <input type="text" name="char2_9" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _9 -->
									<td class="bottom">
										<select name="evi_9" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								<tr align="center">
									<td height="30"><input type="checkbox" disabled  class="InputCheck"></td>
									<!-- 구분 _10 -->
									<td class="bottom">
										<select name="class1_10" id="class1_10" style="width:52px;" onChange="inoutSel(10)">
											<option value="" selected> 선 택
											<option value="1"> 입 금
											<option value="2"> 출 금
											<option value="3"> 대 체
										</select>
										<select name="class2_10" id="class2_10" style="width:52px;" onChange="inoutSel2(10)">
											<option value="" selected> 선 택
											<option value="1"> 수 익
											<option value="2"> 차 입
											<option value="3"> 회 수
											<option value="4"> 출 자
											<option value="5"> 비 용
											<option value="6"> 상 환
											<option value="7"> 대 여
											<option value="8"> 배 당
											<option value="9"> 본 사
											<option value="10"> 현 장
										</select>
									</td>
									<!-- 현장코드 _10 -->
									<td class="bottom">
										<select name="pj_seq_10" id="pj_seq_10" style="width:60px;" disabled>
											<option value="" selected> 선 택
											<? for($i=0; $i<$pj_num; $i++){ ?>
											<option value="<?=$pj_seq[$i]?>"> <?=$pj_name[$i]?>
											<? } ?>
										</select>
									</td>
									<td class="bottom">조합:<input type="checkbox" value="1" name="jh_loan_10" id="jh_loan_10" onClick="jh_chk(10);" disabled></td>
									<!-- 회계계정 _10 -->
									<td class="bottom" id="inc_td_10">
										<select name="account_10" id="inc_account_10" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<td class="bottom" id="out_td_10" style="display:none;">
										<select name="account_10" id="out_account_10" style="width:60px;" disabled>
										<?
											$acc_qry = "SELECT d3_code, d3_acc_name FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc <>'1' ORDER BY d3_code ASC";
											$acc_rlt = mysql_query($acc_qry, $connect);
										?>
											<option value="" selected> 선 택
											<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
											<option value="<?=$acc_rows[d3_acc_name]?>"> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
											<?}?>
										</select>
									</td>
									<!-- 적 요 _10 -->
									<td class="bottom"><input type="text" name="cont_10"  size="20" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 거 래 처 _10 -->
									<td class="bottom"><input type="text" name="acc_10"  size="10" class="inputstyle2" style="background-color:#f9f9f9;"></td>
									<!-- 입금계정 _10 -->
									<td class="bottom">
									<select name="in_10" id="in_10" style="width:55px;" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 입금금액 _10 -->
									<td class="bottom"><input type="text" name="inc_10" id="inc_10" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_10,this,document.inout_frm.exp_10)"></td>
									<!--출금계정 _10 -->
									<td class="bottom">
									<select name="out_10" id="out_10" style="width:55px;" onChange="charge(10,this.value);" disabled>
										<option value="" selected> 선 택
										<?
											$query="select * from cms_capital_bank_account ";
											$result=mysql_query($query, $connect);
											while($rows=mysql_fetch_array($result)){
										?>
										<option value="<?=$rows[no]."-".$rows[bank]?>"> <?=$rows[name]?>
										<? } ?>
									</select>
									</td>
									<!-- 출금금액 _10 -->
									<td class="bottom"><input type="text" name="exp_10" id="exp_10" size="10" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)'></td>
									<!-- 수수료 _10 -->
									<td class="bottom"><input type="checkbox" name="char1_10" onclick="char2_chk(document.inout_frm.char2_10,10);" disabled> 금액 : <input type="text" name="char2_10" size="3" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" onkeyPress ='iNum(this)' disabled></td>
									<!-- 증빙서류 _10 -->
									<td class="bottom">
										<select name="evi_10" style="width:75px">
											<option value="1" selected> 증빙 없음
											<option value="2"> 세금계산서
											<option value="3"> 계산서(면세)
											<option value="4"> 신용(체크)카드전표
											<option value="5"> 현금영수증
											<option value="6"> 간이영수증
										</select>
									</td>
								</tr>
								</table>
								<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td style="border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;" height="28"></td>
								</tr>
								<tr align="right" bgcolor="#F8F8F8">
									<td style="border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid; padding:0 20px 0 0px" height="48">
									<?
										if($_m3_1_3_row[_m3_1_3]<2){
											$submit_str="alert('등록 권한이 없습니다!')";
										}else{
											 $submit_str="inout_frm_chk('com');";
										}
									?>
										<input type="button" value=" 거 래 등 록 " onclick="<?=$submit_str?>" class="submit_bt" style="height='28'">
									</td>
								</tr>
								</table>
								</form>
								</td>
							</tr>
						</table>
					</div>
					<? } ?>