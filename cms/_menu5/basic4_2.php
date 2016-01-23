							<!-- 은행계좌 신규 수정 등록 파일 -->
								<!-- ================================= 거래처 contents S ================================= -->
								<div style="height:500px;">
									<div style="height:18px; background-color:#e8e8e8; margin-bottom:2px;"></div>
									<div style="float:left; width:15px; height:24px; padding-top:10px;"><img src="../images/list_bt.jpg" border="0" alt=""></div>
									<div style="height:28px; padding-top:8px; color:#000000;"><b><?if($mode=='reg'){?>은행계좌 신규등록<?}else if($mode=='modify'){?>은행계좌 수정 등록<?} ?></b></div>
									<?
										if($mode=='modify'){
											$no = $_REQUEST['no'];
											$qry = "SELECT * FROM cms_capital_bank_account WHERE no='$no'";
											$rlt = mysql_query($qry, $connect);
											$row = mysql_fetch_array($rlt);
											$sub_str = "저장하기";
										}else{
											$sub_str = "등록하기";
										}
									?>
									<form name="form1" method="post" action="basic_post.php">
									<input type="hidden" name="s_di" value="<?=$s_di?>">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<?if($mode=='modify'){?><input type="hidden" name="no" value="<?=$row[no]?>"><? } ?>

									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">거래 은행 <font color="red">*</font></div>
									<div style="float:left; width:120px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd ">
										<select name="bank" class="inputstyle2" style="width:125px; height:22px;"onchange="this.form.bank_code.value=this.value;">
											<option value="" <?if(!$rows[bank_code]) echo "selected";?>> 전 체
											<?
												$bank_qry = "SELECT* FROM cms_capital_bank_code ORDER BY bank_code ";
												$bank_rlt = mysql_query($bank_qry, $connect);
												while($bank_rows = mysql_fetch_array($bank_rlt)){
											?>
											<option value="<?=$bank_rows[bank_code]?>" <?if($row[bank_code]==$bank_rows[bank_code]) echo "selected";?>> <?=$bank_rows[bank_name]?>
											<? } ?>
										</select>
									</div>
									<div style="float:left; width:120px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd ">
										<input type="text" name="bank_code" value="<?=$row[bank_code]?>" class="inputstyle2" style="width:30px;">
									</div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">계좌 별칭 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd "><input type="text" name="name" value="<?=stripslashes($row[name])?>" class="inputstyle2" style="width:160px;"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">계좌 번호 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="number" value="<?=$row[number]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">예 금 주 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="holder" value="<?=$row[holder]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">관리 구분 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd ">
										<input type="radio" name="is_com" value="1" onclick="document.getElementById('com').style.display=''; document.getElementById('pro').style.display='none'" <?if($row[is_com]=='1') echo "checked";?>> 본사 관리계좌
										<input type="radio" name="is_com" value="0" onclick="document.getElementById('pro').style.display=''; document.getElementById('com').style.display='none'" <?if($row[is_com]=='0') echo "checked";?>> 현장 관리계좌
									</div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">관리부서(현장) <font color="red">*</font></div>
									<div id="com" style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd ">
										<select name="div_seq" class="inputstyle2" style="width:165px; height:22px;">
											<option value="" <?if($row[div_seq]==0) echo "selected";?>> 선 택
											<?
												$qry = "SELECT seq, div_name FROM cms_com_div ORDER BY seq";
												$rlt = mysql_query($qry, $connect);
												while($rows = mysql_fetch_array($rlt)){
											?>
											<option value="<?=$rows[seq]?>" <?if($rows[seq]==$row[div_seq]) echo "selected";?>><?=$rows[div_name]?>
											<? } ?>
										</select>
									</div>
									<div id="pro" style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; display:none;" class="bor_ddd">
										<select name="pj_seq" class="inputstyle2" style="width:165px; height:22px;">
											<option value="" <?if($row[pj_seq]==0) echo "selected";?>> 선 택
											<?
												$qry = "SELECT seq, pj_name FROM cms_project_info ORDER BY seq DESC";
												$rlt = mysql_query($qry, $connect);
												while($rows = mysql_fetch_array($rlt)){
											?>
											<option value="<?=$rows[seq]?>" <?if($rows[seq]==$row[pj_seq]) echo "selected";?>><?=$rows[pj_name]?>
											<? } ?>
										</select>
									</div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">관리 책임자</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="manager" value="<?=$row[manager]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">개설 일자 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd ">
										<input type="text" name="open_date" id="open_date" value="<?=$row[open_date]?>" size="30" class="inputstyle2" style="height:17px; width:140px;" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
										<a href="javascript:" onclick="cal_add(document.getElementById('open_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									</div>

									<div style="clear:left; height:26px; padding:5px 0 0 15px; color:#000000"><b><font color="red">*</font> 기타 사항</b></div>
									<div style="float:left; width:135px; height:98px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">비 고</div>
									<div style="float:left; width:660px; height:98px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd "><textarea name="note" rows="3" cols="76" class="inputstyle2" style="width:572px; height:87px;"><?=$row[note]?></textarea></div>
									</form>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($cg_1_4_row[cg_1_4]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="bank_submit('$mode');";
										$del_str="if(confirm('해당 은행계좌 정보를 삭제 하시겠습니까?')==1) location.href='basic_post.php?s_di=4&amp;mode=del&amp;no=$no'";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd">
								<input type="button" value="<?=$sub_str?>" onclick="<?=$submit_str?>">
								<input type="button" value="목록으로" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=4&amp;ss_di=1' ">
							</div>
							<div style="float:right; height:30px; width:200px; padding:8px 10px 0 0; border-width:1px 0 0 0; text-align:right;" class="bor_ddd">
								<?if($mode=='modify'){?><input type="button" value="계좌삭제" onclick="<?=$del_str?>"><? } ?>
							</div>
