							<!--은행계좌 목록 파일 -->
								<div style="height:38px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid; margin:6px 0 10px 0;">
									<?
										$bank = $_REQUEST['bank'];
										$acc_sort = $_REQUEST['acc_sort'];
										$div_seq = $_REQUEST['div_seq'];
										$pj_seq = $_REQUEST['pj_seq'];
										$_search = $_REQUEST['_search'];
									?>
									<form method="post" action="">
									<div style="float:left; width:100px; height:28px; background-color:#f4f4f4; padding:10px 0px 0 0px; color:black; text-align:center;">은행 별</div>
									<div style="float:left; width:90px; height:28px; padding:9px 20px 0 10px;">
										<select name="bank" style="width:80px; height:21px;"">
											<option value="" <?if(!$bank) echo "selected";?>> 선 택
											<?
												$b_qry = "SELECT no, bank FROM cms_capital_bank_account WHERE no<>'1' GROUP BY bank ORDER BY no";
												$b_rlt = mysql_query($b_qry, $connect);
												while($b_rows = mysql_fetch_array($b_rlt)){
											?>
											<option value="<?=trim($b_rows[bank])?>" <?if(trim($b_rows[bank])==$bank) echo 'selected';?>><?=$b_rows[bank]?>
											<? } ?>
										</select>
									</div>
									<div style="float:left; width:110px; height:28px; background-color:#f4f4f4; padding-top:10px; color:black; text-align:center;">관리부서(현장) 별</div>
									<div style="float:left; width:160px; height:28px; padding:10px 0 0 10px;">

										<input type="radio" name="acc_sort" value="1" <?if($acc_sort=='1'||!$acc_sort) echo "checked";?> onclick="document.getElementById('com_sel').style.display='';document.getElementById('pj_sel').style.display='none'; this.form.pj_seq.value='' "> 본사관리
										<input type="radio" name="acc_sort" value="2" <?if($acc_sort=='2') echo "checked";?> onclick="document.getElementById('com_sel').style.display='none';document.getElementById('pj_sel').style.display=''; this.form.div_seq.value='' "> 현장관리
									</div>
									<div id="com_sel" style="float:left; width:100px; height:28px; padding:9px 0 0 10px; <?if($acc_sort=='2') echo "display:none;";?>">
										<select name="div_seq" style="width:80px; height:21px;">
											<option value="" <?if(!$div_seq||$acc_sort==2) echo "selected";?>> 선 택
											<?
												
												
												$qry = "SELECT seq, div_name FROM cms_com_div ORDER BY seq";
												$rlt = mysql_query($qry, $connect);
												while($rows = mysql_fetch_array($rlt)){
											?>
											<option value="<?=$rows[seq]?>" <?if($rows[seq]==$div_seq) echo "selected";?>><?=$rows[div_name]?>
											<? } ?>
										</select>
									</div>
									<div id="pj_sel" style="float:left; width:100px; height:28px; padding:9px 0 0 10px;  <?if($acc_sort=='1'||!$acc_sort) echo "display:none;";?>">
										<select name="pj_seq" style="width:80px; height:21px;">
											<option value="" <?if(!$pj_seq) echo "selected";?>> 선 택
											<?
												$qry = "SELECT seq, pj_name FROM cms_project_info WHERE is_end<>'1' ORDER BY seq";
												$rlt = mysql_query($qry, $connect);
												while($rows = mysql_fetch_array($rlt)){
											?>
											<option value="<?=$rows[seq]?>" <?if($rows[seq]==$pj_seq) echo "selected";?>><?=$rows[pj_name]?>
											<? } ?>
										</select>
									</div>
									<div style="float:left; width:120px; height:28px; padding:8px 0px 0 10px; text-align:right;">
										<input type="text" name="_search" value="<?=$_search?>" size="20" class="inputstyle2" style="width:115px;" onclick="this.value='' ">
									</div>
									<div style="float:right; width:50px; height:28px; background-color:#F8F8F8; padding:7px 20px 0 10px; color:black;">
										<input type="button" value=" 검 색 " onclick="submit();" class="inputstyle11" style="height:24px;">
									</div>
									</form>
								</div>
								<!-- ================================= 거래처 contents S ================================= -->
								<div style="height:389px;">
									<div style="float:left; width:25px; height:26px; padding-top:5px; border-width:1px 1px 1px 0; text-align:center;" class="blue_title"><input type="checkbox" name="mnum_cont" disabled></div>
									<div style="float:left; width:135px; height:26px; padding-top:5px; border-width:1px 0 1px 0; text-align:center;" class="blue_title">거래은행</div>
									<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">은행코드</div>
									<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">계좌별칭</div>
									<div style="float:left; width:183px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">계좌 번호</div>
									<div style="float:left; width:150px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">관리부서(현장)</div>
									<div style="float:left; width:136px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">비 고</div>

									<?
										$add_where = " WHERE no<>1 ";
										if($bank) $add_where.=" AND bank='$bank' ";
										if($div_seq) $add_where.=" AND div_seq='$div_seq' ";
										if($pj_seq) $add_where.=" AND pj_seq='$pj_seq' ";
										if($_search) $add_where.=" AND (bank LIKE '%$_search%' OR name LIKE '%$_search%' OR number LIKE '%$_search%' OR holder LIKE '%$_search%' OR manager LIKE '%$_search%' OR note LIKE '%$_search%') ";

										$query="SELECT no FROM cms_capital_bank_account $add_where ORDER BY no";
										$result=mysql_query($query, $connect);
										$total_bnum=mysql_num_rows($result);     // 총 게시물 수   11111111111111111111
										mysql_free_result($result);
										if($total_bnum==0){
									?>
									<div style="clear:left; height:80px; text-align:center; padding-top:50px; margin-bottom:10px;">등록된 데이터가 없습니다.</div>
									<?
									}else{
										$start=$_REQUEST['start'];
										$index_num = 12;								// 한 페이지 표시할 목록 개수 22222222222222
										$page_num = 10;								// 한 페이지에 표시할 페이지 수 33333
										if(!$start) $start = 1;							// 현재페이지 444444444
										$s = ($start-1)*$index_num;
										$e = $index_num;

										$query = "SELECT no, bank, bank_code, name, number, is_com, div_seq, pj_seq, cms_capital_bank_account.note
													  FROM cms_capital_bank_account $add_where ORDER BY no LIMIT $s, $e";
										$result = mysql_query($query, $connect);
										while($rows = mysql_fetch_array($result)){

											if($rows[is_com]==1) {
												$m_rlt =mysql_query("SELECT div_name FROM cms_com_div WHERE seq='$rows[div_seq]' ", $connect);
												$m_row = mysql_fetch_array($m_rlt);
												$wh_m = "본사 ".$m_row[div_name];
											}
											if($rows[is_com]==0) {
												$m_rlt =mysql_query("SELECT pj_name FROM cms_project_info WHERE seq='$rows[pj_seq]' ", $connect);
												$m_row = mysql_fetch_array($m_rlt);
												$wh_m = $m_row[pj_name]." 현장";
											}
									?>
									<div style="clear:left; float:left; width:25px; height:24px; padding-top:4px; border-width:0 1px 1px 0; text-align:center;" class="bor_ddd"><input type="checkbox" name="no[]" value="<?$rows[no]?>"></div>
									<div style="float:left; width:135px; height:24px; padding-top:4px; border-width:0 0 1px 0; text-align:center;" class="bor_ddd"><a href="<?$cms_url?>?m_di=1&amp;s_di=4&amp;ss_di=2&amp;mode=modify&amp;no=<?=$rows[no]?>" class="no_auth"><?=$rows[bank]?></a></div>
									<div style="float:left; width:90px; height:24px; padding-top:4px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$rows[bank_code]?></div>
									<div style="float:left; width:100px; height:24px; padding-top:4px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$rows[name]?></div>
									<div style="float:left; width:183px; height:24px; padding-top:4px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$rows[number]?></div>
									<div style="float:left; width:140px; height:24px; padding:4px 0 0 10px; border-width:0 0 1px 1px;" class="bor_ddd"><?=$wh_m?></div>
									<div style="float:left; width:126px; height:24px; padding:4px 0 0 10px; border-width:0 0 1px 1px;" class="bor_ddd"><?=rg_cut_string($rows[note], 18, "..")?></div>
									<?
											}
										}
									?>
								</div>
								<div style="height:38px; padding-top:17px; text-align:center;">
									<?
										if($total_bnum>$index_num){
											echo "<span>";
											$back_url="&amp;m_di=1&amp;s_di=4";
											page_avg($total_bnum, $page_num, $index_num, $start, $back_url);
											//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지 5. 해당페이지 필요변수
											echo "</span>";
										}
									?>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($cg_1_4_row[cg_1_4]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="location.href='$_SERVER[PHP_SELF]?m_di=1&amp;s_di=4&amp;ss_di=2&amp;mode=reg'";
										$del_str="alert('준비중..! 현재 해당 계좌에 대한 수정 화면에서 개별 삭제만 가능합니다.')";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd">
								<input type="button" value="신규 등록" onclick="<?=$submit_str?>">
							</div>
							<div style="float:right; height:30px; width:200px; padding:8px 10px 0 0; border-width:1px 0 0 0; text-align:right;" class="bor_ddd"><input type="button" value="선택 삭제" onclick="<?=$del_str?>">
							</div>
