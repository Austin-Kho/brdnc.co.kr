					<!-- ============== subject table end ============== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 현장별 조직 및 인원 현황</font></b>
						<div style="float:right;">
							<!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. -->
						</div>
					</div>
					<!-- ============== subject table end ============== -->
					<?
						$pr_2_1_rlt = mysql_query("select pr_2_1 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$pr_2_1_row = mysql_fetch_array($pr_2_1_rlt);

						if(!$pr_2_1_row[pr_2_1]||$pr_2_1_row[pr_2_1]==0){
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
						<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;">
							<!-- <a href="javascript:" onClick="excel_pop('<?=$pr_2_1_row[pr_2_1]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
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
								$headq=$_REQUEST['headq'];
								$team=$_REQUEST['team'];
								$worker=$_REQUEST['worker'];
								$is_retire=$_REQUEST['is_retire'];
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
											$where=" WHERE pr_sd LIKE '$year_frm%' ";
										}
										$qry = "SELECT seq, pj_name FROM cms_project_info $where ORDER BY pr_sd DESC ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($pj_list==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
									<? } ?>
								</select>
							</div>
							<div style="float:left; width:68px; height:28px; background-color:#F4F4F4; padding-top:7px; text-align:center; color:black;">
								소속본부
							</div>
							<div style="float:left; height:28px; padding:6px 20px 0 10px;">
								<select name="headq" onchange="submit();" class="inputstyle2" style="height:22px; width:80px;"><!-- ==================================== 본부 리스트 ===================================== -->
									<option value="" <?if(!$headq) echo "selected"?>> 선 택
									<?
										$qry = "SELECT seq, headq FROM cms_resource_headq WHERE pj_seq='$pj_list' ORDER BY seq ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($headq==$rows[seq]) echo "selected"; ?>><?=$rows[headq]?>
									<? } ?>
								</select>
							</div>
							<div style="float:left; width:68px; height:28px; background-color:#F4F4F4; padding-top:7px; text-align:center; color:black;">
								소속 팀
							</div>
							<div style="float:left; height:28px; padding:6px 20px 0 10px;">
								<select name="team" onchange="submit();" class="inputstyle2" style="height:22px; width:80px;"><!-- ==================================== 팀 리스트 ===================================== -->
									<option value="" <?if(!$team) echo "selected"?>> 선 택
									<?
										$qry = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' ORDER BY seq ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($team==$rows[seq]) echo "selected"; ?>><?=$rows[team]?>
									<? } ?>
								</select>
							</div>
							</form><!-- ================ 본사 직원용 폼 종료 ================ -->
							<? } ?>
							<!-- ============ 본사 직원일 때 프로젝트 선택 가능 종료 ============   -->
							<!--  ============ 현장 담당자일 때 담당 프로젝트만 시작 ============  -->
							<?
								if($member_row[is_company]==2){
									$pj_list=$member_row[pj_seq];
							?>
							<div style="float:left; height:28px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">
							<?
								$result = mysql_query("SELECT seq, pj_name FROM cms_project_info, cms_member_table WHERE pj_seq=seq ", $connect);
								$row = mysql_fetch_array($result);
								echo "<font color='#cc0000'>*</font> ".$row[pj_name]."  현장 인원 현황";
							?>
							</div>
							<div style="float:left; height:28px; width:50px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">소속본부</div>
							<div style="float:left; height:28px; padding:7px 20px 0 10px;">
								<select name="headq" onchange="submit();" class="inputstyle2" style="height:22px; width:100px;"><!-- ==================================== 계약년도 폼 ===================================== -->
									<option value="" <?if(!$headq) echo "selected";?>> 전 체
									<?
										$query = "SELECT seq, headq FROM cms_resource_headq WHERE pj_seq='$pj_list' ";
										$result = mysql_query($query, $connect);
										while($rows = mysql_fetch_array($result)){
									?>
									<option value="<?=$rows[seq]?>" <?if($headq==$rows[seq]) echo "selected"; ?>><?=$rows[headq]?>
									<?	} ?>
								</select>
							</div>
							<div style="float:left; height:28px; width:50px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">소속 팀</div>
							<div style="float:left; height:28px; padding:7px 20px 0 10px;">
								<select name="team" onchange="submit();" class="inputstyle2" style="height:22px; width:100px;"><!-- ==================================== 계약년도 폼 ===================================== -->
									<option value="" <?if(!$team) echo "selected";?>> 전 체
									<?
										$query1 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' ";
										$result1 = mysql_query($query1, $connect);
										while($rows1 = mysql_fetch_array($result1)){
									?>
									<option value="<?=$rows1[seq]?>" <?if($team==$rows1[seq]) echo "selected"; ?>><?=$rows1[team]?>
									<?	} ?>
								</select>
							</div>
							<? } ?>
							<!--  ============ 현장 담당자일 때 담당 프로젝트만 종료 ============  -->
							<div style="padding-top:8px;"><input type="checkbox" name="is_retire" value="1" onclick="submit();" <?if($is_retire==1) echo "checked";?>>종료인원 포함</div>
						</div>
						</form>
						<div style="height:28px; margin-top:20px; padding:0 0 0 10px;">
							<?
								if($is_retire==1) $where = " WHERE 1=1 "; else $where = " WHERE is_retire<>1 ";
								if($pj_list) $where.=" AND pj_seq='$pj_list' ";
								if($headq) $where.=" AND headq_seq='$headq' ";
								if($headq&&$team) $where.=" AND team_seq='$team' ";
								$qry = "SELECT seq FROM cms_resource_team_member $where";
								$rlt = mysql_query($qry, $connect);
								$mem_num = mysql_num_rows($rlt);

								$mem_con = "최근 등록 인원 현황";
								if($pj_list) $mem_con = "전체 인원 : ".$mem_num."명";
							?>
							<font color="#000000"><?=$mem_con?></font>
						</div>

						<!-- ====================현장 인원 리스트 스타트====================== -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="border-width:1px 1px 0 1px; border-color:#d6d6d6; border-style:solid;">
							<div style="height:32px; background-color:#F0F0E8; text-align:center;">
								<div style="float:left; width:15px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox" disabled></div>
								<div style="float:left; width:65px; height: 26px; padding-top:6px;" class="form2">소속 본부</div>
								<div style="float:left; width:55px; height: 26px; padding-top:6px;" class="form2">소속 팀</div>
								<div style="float:left; width:55px; height: 26px; padding-top:6px;" class="form2">직 위</div>
								<div style="float:left; width:65px; height: 26px; padding-top:6px;" class="form2">성 명</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">주민등록번호</div>
								<div style="float:left; width:130px; height: 26px; padding-top:6px;" class="form2">연 락 처</div>
								<div style="float:left; width:85px; height: 26px; padding-top:6px;" class="form2">은 행</div>
								<div style="float:left; width:130px; height: 26px; padding-top:6px;" class="form2">계좌번호</div>
								<div style="float:left; width:65px; height: 26px; padding-top:6px;" class="form2">예 금 주</div>
								<div style="float:left; width:81px; height: 26px; padding-top:6px;" class="form2">근무시작일</div>
								<div style="float:left; width:30px; height: 26px; padding-top:6px;" class="form2">수정</div>
								<div style="float:left; width:30px; height: 26px; padding-top:6px;" class="form2">종료</div>
							</div>
							<?
								if($is_retire==1) $where = " WHERE 1=1 "; else $where = " WHERE is_retire<>1 ";
								if($pj_list) $where .= " AND cms_resource_team_member.pj_seq='$pj_list' ";
								if($headq) $where.=" AND cms_resource_team_member.headq_seq='$headq' ";
								if($headq&&$team) $where.=" AND cms_resource_team_member.team_seq='$team' ";
								$qry = "SELECT seq FROM cms_resource_team_member $where";
								$rlt = mysql_query($qry, $connect);
								$total_bnum=mysql_num_rows($rlt);     // 총 게시물 수   11111111111111111111
								mysql_free_result($rlt);

								$page=$_GET['page'];
								$gb=$_REQUEST['gb'];

								$index_num = 10;                 // 한 페이지 표시할 목록 개수 22222222222222
								$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
								$start=$_REQUEST['start'];
								if(!$start) $start = 1;              // 현재페이지 444444444
								$s = ($start-1)*$index_num;
								$e = $index_num;


								if($total_bnum==0){
							?>
							<div style="height:200px; text-align:center; padding-top:120px;" class="form2">
								<?
									echo "등록된 데이터가 없습니다.";
								?>
							</div>
							<?
								}else{
								$query1="SELECT cms_resource_team_member.seq AS seq,
													  cms_resource_team_member.pj_seq AS pj_seq,
													  cms_resource_team_member.headq_seq AS headq_seq,
													  cms_resource_team_member.team_seq AS team_seq,
													  is_retire,
													  position,
													  name,
													  id_num,
													  tel,
													  bank_acc,
													  bank_acc_num,
													  bank_acc_holder,
													  join_date,
													  headq,
													  team
										    FROM cms_resource_team_member, cms_resource_headq, cms_resource_team
										    $where
										    AND cms_resource_team_member.headq_seq=cms_resource_headq.seq
										    AND cms_resource_team_member.team_seq=cms_resource_team.seq
										    ORDER BY cms_resource_team_member.headq_seq, cms_resource_team_member.team_seq, position, cms_resource_team_member.seq
										    LIMIT $s, $e";
								$result1=mysql_query($query1, $connect);

								while($rows1 = mysql_fetch_array($result1)){
									if($rows1[position]==1) $position = "본부장";
									if($rows1[position]==2) $position = "팀장";
									if($rows1[position]==3) $position = "팀원";
							?>
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:15px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:65px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[headq]?></div>
								<div style="float:left; width:55px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[team]?></div>
								<div style="float:left; width:55px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$position?></div>
								<div style="float:left; width:65px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[name]?></div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[id_num]?></div>
								<div style="float:left; width:130px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[tel]?></div>
								<div style="float:left; width:85px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[bank_acc]?></div>
								<div style="float:left; width:130px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[bank_acc_num]?></div>
								<div style="float:left; width:65px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[bank_acc_holder]?></div>
								<div style="float:left; width:81px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><?=$rows1[join_date]?></div>
								<div style="float:left; width:30px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><a href="javascript:" onclick="popUp('resc_mem_modify.php?pj_seq=<?=$rows1[pj_seq]?>&amp;headq_seq=<?=$rows1[headq_seq]?>&amp;team_seq=<?=$rows1[team_seq]?>&amp;edit_code=<?=$rows1[seq]?>','mem_modi')">수정</a></div>
								<div style="float:left; width:30px; height: 26px; padding-top:6px; <?if($rows1[is_retire]==1) echo "background-color:#f1f1f1;";?>" class="form2"><a href="javascript:" onclick="_retire(<?=$rows1[seq]?>,<?=$rows1[pj_seq]?>,<?=$rows1[headq_seq]?>,<?=$rows1[team_seq]?>);">종료</a></div>
							</div>
							<?
								}
								mysql_free_result($result1);
							?>
							</td>
						</tr>
						<tr>
							<td>
							<div style="height:32px; text-align:center; padding-top:10px;">
								<?
									$back_url="&amp;m_di=2&amp;s_di=1&amp;pj_list=$pj_list&amp;headq=$headq&amp;team=$team&amp;is_retire=$is_retire";
									page_avg($total_bnum,$page_num, $index_num,$start, $back_url);
									//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 3. 시작페이지
								?>
							</div>
							<? } ?>
							</td>
						</tr>
						</table>
						<!-- ====================현장 인원 리스트 종료====================== -->

						</td>
					</tr>
					</table>
					</div>
					<? } ?>
