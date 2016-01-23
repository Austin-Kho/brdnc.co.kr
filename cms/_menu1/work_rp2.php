					<!-- ============================= subject table end ============================= -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 현장별 업무일지</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
						</div>
					</div>
					<!-- ============================= subject table end ============================= -->
					<?
						$sa_1_2_rlt = mysql_query("select sa_1_2 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$sa_1_2_row = mysql_fetch_array($sa_1_2_rlt);

						if(!$sa_1_2_row[sa_1_2]||$sa_1_2_row[sa_1_2]==0){
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
							<!-- <a href="javascript:" onClick="excel_pop('<?=$sa_2_1_row[sa_2_1]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
						<div style="height:35px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid;">
							<!-- ============ 본사 직원일 때 프로젝트 선택 가능 시작 ============  -->
							<?
								$ss_di = $_REQUEST['ss_di'];
								$mode = $_REQUEST['mode'];

								if($member_row[is_company]==1){
								$year_frm=$_REQUEST['year_frm'];
								$pj_list=$_REQUEST['pj_list'];
								$headq=$_REQUEST['headq'];
								$team=$_REQUEST['team'];
								$writer=$_REQUEST['writer'];								
							?>
							<form name="is_com_sel" method="post" action=""><!-- ================ 본사 직원용 폼 시작 ================ -->
							<input type="hidden" name="m_di" value="<?=$m_di?>">
							<input type="hidden" name="s_di" value="<?=$s_di?>">
							<input type="hidden" name="ss_di" value="<?=$ss_di?>">
							<input type="hidden" name="mode" value="<?=$mode?>">
							
							<!-- <input type="hidden" name="s_date" value="<?=$s_date?>">
							<input type="hidden" name="e_date" value="<?=$e_date?>"> -->
							<div style="float:left; height:28px; width:50px; background-color:#F4F4F4; padding:7px 20px 0 20px; color:black;">
								년도 별
							</div>
							<div style="float:left; height:28px; padding:7px 20px 0 10px;">
								<select name="year_frm" onchange="submit();" class="inputstyle2" style="height:22px; width:100px;" <?if(($ss_di==2&&$mode<>'reg')||$ss_di==3) echo "disabled";?>><!-- ==================================== 계약년도 폼 ===================================== -->
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
								<select name="pj_list" onchange="submit();" class="inputstyle2" style="height:22px; width:150px;" <?if(($ss_di==2&&$mode<>'reg')||$ss_di==3) echo "disabled";?>><!-- ==================================== 프로젝트 리스트 ===================================== -->
									<option value="" <?if(!$pj_list) echo "selected"?>> 선 택
									<?
										if($year_frm>1){
											$where=" WHERE cont_date LIKE '$year_frm%' ";
										}
										$qry = "SELECT seq, pj_name FROM cms_project_info $where ORDER BY cont_date DESC ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($pj_list==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
									<? } ?>
								</select>
							</div>
							<div style="float:left; width:68px; height:28px; background-color:#F4F4F4; padding-top:7px; text-align:center; color:black;">
								본 부
							</div>
							<div style="float:left; height:28px; padding:6px 20px 0 10px;">
								<select name="headq" onchange="submit();" class="inputstyle2" style="height:22px; width:80px;" <?if(($ss_di==2&&$mode<>'reg')||$ss_di==3) echo "disabled";?>><!-- ==================================== 본부 리스트 ===================================== -->
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
								팀
							</div>
							<div style="float:left; height:28px; padding:6px 20px 0 10px;">
								<select name="team" onchange="submit();" class="inputstyle2" style="height:22px; width:80px;" <?if(($ss_di==2&&$mode<>'reg')||$ss_di==3) echo "disabled";?>><!-- ==================================== 팀 리스트 ===================================== -->
									<option value="" <?if(!$team) echo "selected"?>> 선 택
									<?
										$qry = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' ORDER BY seq ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if(trim($team)==trim($rows[seq])) echo "selected"; ?>><?=$rows[team]?>
									<? } ?>
								</select>
							</div>
							<!-- <div style="float:left; width:68px; height:28px; background-color:#F4F4F4; padding-top:7px; text-align:center; color:black;">
								담당자
							</div>
							<div style="float:left; height:28px; padding:6px 10px 0 10px;">
								<select name="worker" onchange="submit();" class="inputstyle2" style="height:22px; width:80px;"> --><!-- ==================================== 담당사용자 리스트 ===================================== -->
									<!-- <option value="" <?if(!$worker) echo "selected"?>> 선 택
									<?
										$p_rlt = mysql_query("SELECT headq, team FROM cms_resource_headq, cms_resource_team WHERE cms_resource_headq.seq='$headq' AND cms_resource_team.seq='$team' ", $connect);
										$p_row = mysql_fetch_array($p_rlt);
										$position = trim($p_row[headq])."-".trim($p_row[team]);

										$qry = "SELECT user_id, name FROM cms_member_table WHERE pj_seq='$pj_list' AND pj_where='$position' ORDER BY no";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[user_id]?>" <?if($worker==$rows[user_id]) echo "selected"; ?>><?=$rows[name]?>
									<? } ?>
								</select>
							</div> -->
							</form><!-- ================ 본사 직원용 폼 종료 ================ -->
							<? } ?>
							<!-- ============ 본사 직원일 때 프로젝트 선택 가능 종료 ============   -->


							<!--  ============ 현장 담당자일 때 담당 프로젝트만 시작 ============  -->
							<?
								if($member_row[is_company]==2){
									$pj_list=$member_row[pj_seq];
									$where = explode("-", $member_row[pj_where]);
									$headq = $where[0];
									$team = $where[1];
							?>
							<div style="float:left; width:120px; height:26px; padding-top:9px; color:black; text-align:center; background-color:#F4F4F4;">
								<font color='#cc0000'>*</font> 프로젝트 명
							<?
								$result = mysql_query("SELECT seq, pj_name FROM cms_project_info, cms_member_table WHERE seq=pj_seq AND user_id='$_SESSION[p_id]' ", $connect);
								$row = mysql_fetch_array($result);
							?>
							</div>
							<div style="float:left; width:260px; height:26px; padding:9px 0px 0 0px; text-align:center;"><? echo "<font color='#cc0000'>*</font> <b>".$row[pj_name]."</b>";?></div>	
							<div style="float:left; width:120px; height:26px; padding-top:9px; color:black; text-align:center; background-color:#F4F4F4;">소 속</div>
							<?
								$w_rlt = mysql_query("SELECT headq, team FROM cms_resource_headq, cms_resource_team WHERE cms_resource_headq.seq='$headq' AND cms_resource_team.seq='$team' ", $connect);
								$w_row = mysql_fetch_array($w_rlt);
							?>
							<div style="float:left; width:160px; height:26px; padding:9px 0px 0 0px; text-align:center;"><?=$w_row[headq]?> <font color="#0066ff">▶</font> <?=$w_row[team]?></div>
							<div style="float:left; width:128px; height:26px; padding-top:9px; color:black; text-align:center; background-color:#F4F4F4;">담당자</div>
							<div style="float:left; height:26px; padding:9px 20px 0 20px;"><font color="#003399"><b><?=$_SESSION['p_name']?></b></font><? $writer = $_SESSION['p_id']; ?></div>
							<? } ?>
							<!--  ============ 현장 담당자일 때 담당 프로젝트만 종료 ============  -->
						</div>
						<div style="height:15px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="width:775px; height:480px; border-width:1px 0 1px 0; border-style:solid; border-color:#cccccc; padding:5px 5px 5px 5px;" valign="top"><!-- A -->
								<div style="height:435px;">
								<?
									if(!$ss_di||$ss_di==1){// 초기 화면이나 리스트 불러올 때
										include "work_rp2_1.php";
									}else if($ss_di==2){ // 등록 수정 화면일 때
										include "work_rp2_2.php";
									}else if($ss_di==3){ // 열람 화면일 때
										include "work_rp2_3.php";
									}
								?>
								</div>
							</td>
							<td style="width:252px; height:480px; border-width:1px 0 1px 1px; border-style:solid; border-color:#cccccc; background-color:#f8f8f8; padding:5px 5px 5px 5px;" valign="top"><!-- B -->
								<div style="height:50px; margin-bottom:6px; background-color:#e0eded;"></div>
								<div style="height: 25px; padding:5px 5px 0 5px; margin:0px 5px 0 5px; border-width:1px 0 1px 0;" class="bottom">
									<a href="<?$_SERVER['PHP_SELF']?>?m_di=1&amp;s_di=1"><?=$s_di_1?></a>
								</div>
								<div style="height: 25px; padding:5px 5px 0 5px; margin:0 5px 0 5px;" class="bottom">
									<a href="<?$_SERVER['PHP_SELF']?>?m_di=1&amp;s_di=2" style="color:#000000;"><b><?=$s_di_2?></b></a>
								</div>
								<div style="height: 25px; padding:5px 5px 0 5px; margin:0 5px 0 5px;" class="bottom">
									<a href="<?$_SERVER['PHP_SELF']?>?m_di=1&amp;s_di=3"><?=$s_di_3?></a>
								</div>							
							</td>
						</tr>
						</table>
						</td>
					</tr>
					</table>
					</div>
					<? } ?>
