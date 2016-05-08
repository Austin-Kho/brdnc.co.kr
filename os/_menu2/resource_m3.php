					<!-- ============== subject table end ============== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 현장 관계자 소속 관리</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
						</div>
					</div>
					<!-- ============== subject table end ============== -->
					<?
						$_m2_2_3_rlt = mysql_query("select _m2_2_3 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m2_2_3_row = mysql_fetch_array($_m2_2_3_rlt);

						if(!$_m2_2_3_row[_m2_2_3]||$_m2_2_3_row[_m2_2_3]==0){
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
						<td valign="top">
						<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;">
							<!-- <a href="javascript:" onClick="excel_pop('<?=$_m2_2_3_row[_m2_2_3]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
						<?
							$headq = $_REQUEST['headq'];
							$team = $_REQUEST['team'];
						?>
						<form method="post" action="">
						<div style="height:35px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid;">
							<!-- ============ 본사 직원일 때 프로젝트 선택 가능 시작 ============  -->
							<?
								if($member_row[is_company]==1){
								$year_frm=$_REQUEST['year_frm'];
								$pj_list=$_REQUEST['pj_list'];
							?>
							<form method="post" action="<?=$_SERVER['PHP_SELF']?>"><!-- ================ 본사 직원용 폼 시작 ================ -->
							<input type="hidden" name="m_di" value="<?=$m_di?>">
							<input type="hidden" name="s_di" value="<?=$s_di?>">
							<div style="float:left; height:28px; width:50px; background-color:#F4F4F4; padding:7px 20px 0 20px; color:black;">
								년도 별
							</div>
							<div style="float:left; height:28px; padding:7px 20px 0 10px;">
								<select name="year_frm" onchange="submit();" class="inputstyle2" style="height:22px; width:100px;"><!-- ==================================== 계약년도 폼 ===================================== -->
									<option value="1"> 전 체
									<?
										$start_year = "2013";
										if(!$year_frm) $year_frm=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
										$year=range($start_year,date('Y'));
										for($i=(count($year)-1); $i>=0; $i--){
									?>
									<option value="<?=$year[$i]?>" <?if($year_frm==$year[$i]) echo "selected"; ?>><?=$year[$i]."년"?>
									<?	} ?>
								</select>
							</div>
							<div style="float:left; height:28px; background-color:#F4F4F4; padding:7px 20px 0 20px; color:black;">
								프로젝트
							</div>
							<div style="float:left; height:28px; padding:6px 20px 0 10px;">
								<select name="pj_list" onchange="submit();" class="inputstyle2" style="height:22px; width:150px;"><!-- ==================================== 프로젝트 리스트 ===================================== -->
									<option value="" <?if(!$pj_list) echo "selected"?>> 선 택
									<?
										if($year_frm>1){
											$where=" WHERE start_date LIKE '$year_frm%' ";
										}
										$qry = "SELECT seq, pj_name FROM cms_project1_info $where ORDER BY start_date DESC ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($pj_list==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
									<? } ?>
								</select>
							</div>
							<!-- ================ 본사 직원용 폼 종료 ================ -->
							<? } ?>
							<!-- ============ 본사 직원일 때 프로젝트 선택 가능 종료 ============   -->
							<!--  ============ 현장 담당자일 때 담당 프로젝트만 시작 ============  -->
							<?
								if($member_row[is_company]==2){
									$pj_list=$member_row[pj_seq];
							?>
							<div style="float:left; height:28px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">
							<?
								$result = mysql_query("SELECT seq, pj_name FROM cms_project1_info, cms_member_table WHERE pj_seq=seq ", $connect);
								$row = mysql_fetch_array($result);
								echo "<font color='#cc0000'>*</font> ".$row[pj_name]."  현장 인원 현황";
							?>
							</div>
							<? } ?>
							<!--  ============ 현장 담당자일 때 담당 프로젝트만 종료 ============  -->
						</div>
						</form>
						<div style="float:left; width:15px; height:24px; padding:4px 0 0 5px; margin-top:20px;"><img src="../images/list_bt.jpg" border="0" alt=""></div>
						<div style="height:28px; padding-left:8px; margin-top:20px;  color:#000000;"><b>현장별 사용자 목록</b></div>
						<div style="height:403px; border-width:0 0 1px 0;" class="bor_ddd">
							<div style="clear:left; width:200px; border-width:1px 0 1px 0; text-align:center" class="blue_title"> 현장 명</div>
							<div style="width:100px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">소속본부</div>
							<div style="width:100px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">소 속 팀</div>
							<div style="width:100px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">직위</div>
							<div style="width:100px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">아이디</div>
							<div style="width:100px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">성 명</div>
							<div style="width:150px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">이메일</div>
							<div style="width:150px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">핸드폰(Mobile)</div>
							<div style="width:36px; border-width:1px 0 1px 1px; text-align:center" class="blue_title">수정</div>
							<?
								$add_where = " WHERE is_company<>'1' AND seq=pj_seq ";
								if($pj_list) $add_where .= " AND pj_seq='$pj_list' ";

								$query = "SELECT no FROM cms_member_table, cms_project1_info $add_where ";
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
								$query = "SELECT no, user_id, name, email, mobile, pj_seq, pj_where, pj_posi, pj_name FROM cms_member_table, cms_project1_info $add_where  LIMIT $s, $e";
								$result = mysql_query($query, $connect);
								while($rows = mysql_fetch_array($result)){
									$posi = explode("-", $rows[pj_where]);
							?>
							<div style="clear:left; width:200px; border-width:0 0 1px 0; text-align:center" class="bor_ddd"> <?=$rows[pj_name]?></div>
							<div style="width:100px; border-width:0 0 1px 1px; text-align:center" class="bor_ddd">
								<select name="headq" class="inputstyle2" style="height:20px; width:70px;" disabled>
									<option value="" selected> 선 택
									<?
										$h_qry = "SELECT * FROM cms_resource_headq WHERE pj_seq='$rows[pj_seq]' ORDER BY headq ";
										$h_rlt = mysql_query($h_qry, $connect);
										while($h_rows = mysql_fetch_array($h_rlt)){
									?>
									<option value="<?=$h_rows[seq]?>" <?if($h_rows[seq]==$posi[0]) echo "selected";?>><?=$h_rows[headq]?>
									<? } ?>
								</select>
							</div>
							<div style="width:100px; border-width:0 0 1px 1px; text-align:center" class="bor_ddd">
								<select name="team" class="inputstyle2" style="height:20px; width:70px;" disabled>
									<option value="" selected class="inputstyle2" style="height:20px; width:70px;"> 선 택
									<?
										$t_qry = "SELECT * FROM cms_resource_team WHERE pj_seq='$rows[pj_seq]' GROUP BY team ORDER BY team ";
										$t_rlt = mysql_query($t_qry, $connect);
										while($t_rows = mysql_fetch_array($t_rlt)){
									?>
									<option value="<?=$t_rows[seq]?>" <?if($t_rows[seq]==$posi[1]) echo "selected";?>><?=$t_rows[team]?>
									<? } ?>
								</select>
							</div>
							<div style="width:100px; border-width:0 0 1px 1px; text-align:center" class="bor_ddd">
								<select name="posi" class="inputstyle2" style="height:20px; width:70px;" disabled>
									<option value="" selected> 선 택
									<option value="1" <?if($rows[pj_posi]=='1') echo 'selected';?>> 본부장
									<option value="2" <?if($rows[pj_posi]=='2') echo 'selected';?>> 팀장
									<option value="3" <?if($rows[pj_posi]=='3') echo 'selected';?>> 팀원
								</select>
							</div>
							<div style="width:100px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$rows[user_id]?></div>
							<div style="width:100px; border-width:0 0 1px 1px; text-align:center; color:#003399" class="bor_ddd"><?=$rows[name]?></div>
							<div style="width:150px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$rows[email]?></div>
							<div style="width:150px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$rows[mobile]?></div>
							<div style="width:36px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><a href="javascript:" onclick="popUp('resource_m3_modi.php?edit_code=<?=$rows[no]?>','r3_modi');">수정</a></div>
							<? }} ?>
						</div>
						<div style="clear:left; height:38px; padding-top:17px; text-align:center;">
							<?
								if($total_bnum>$index_num){
									echo "<span>";
									$back_url="&amp;m_di=2&amp;s_di=3";
									page_avg($total_bnum, $page_num, $index_num, $start, $back_url);
									//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지 5. 해당페이지 필요변수
									echo "</span>";
								}
							?>
						</div>
						</td>
					</tr>
					</table>
					</div>
					<? } ?>
