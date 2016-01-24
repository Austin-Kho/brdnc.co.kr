					<!-- ============== subject table end ============== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 현장별 조직 및 인원 등록</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
						</div>
					</div>
					<!-- ============== subject table end ============== -->
					<?
						$_m2_2_2_rlt = mysql_query("select _m2_2_2 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m2_2_2_row = mysql_fetch_array($_m2_2_2_rlt);

						if(!$_m2_2_2_row[_m2_2_2]||$_m2_2_2_row[_m2_2_2]==0){
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
							<!-- <a href="javascript:" onClick="excel_pop('<?=$_m2_2_2_row[_m2_2_2]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
						<?
							$headq = $_REQUEST['headq'];
							$team = $_REQUEST['team'];
						?>

						<form name="pj_sel" method="post" action="">
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
											$where=" WHERE start_date LIKE '$year_frm%' ";
										}
										$qry = "SELECT seq, pj_name FROM cms_project_info $where ORDER BY start_date DESC ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($pj_list==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
									<? } ?>
								</select>
							</div>
							</form><!-- ================ 본사 직원용 폼 종료 ================ -->
							<? } ?>
							<!--  ============ 현장 담당자일 때 담당 프로젝트만 시작 ============  -->
							<?
								if($member_row[is_company]==2){
									$pj_list=$member_row[pj_seq];
							?>
							<div style="float:left; height:28px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">
							<?
								$result = mysql_query("SELECT seq, pj_name FROM cms_project_info, cms_member_table WHERE pj_seq=seq ", $connect);
								$row = mysql_fetch_array($result);
								echo "<font color='#cc0000'>*</font> ".$row[pj_name]."  현장 인원 등록";
							?>
							</div>
							<? } ?>

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
							<!--  ============ 현장 담당자일 때 담당 프로젝트만 종료 ============  -->
						</div>
						</form>
						<div style="height:28px; margin-top:20px; padding:0 0 0 10px;">
							<a href="javascript:" onclick="resc_chk('<?=$pj_list?>','resc_basic.php?pj=<?=$pj_list?>&amp;sort=headq_list')" title="본부등록"><font color="black">본부등록</font></a> | <a href="javascript:" onclick="resc_chk('<?=$pj_list?>','resc_basic.php?pj=<?=$pj_list?>&amp;sort=team_list')" title="팀 등록"><font color="black">팀 등록</font></a>
						</div>
						<!-- ====================신규 등록 테이블 스타트====================== -->
						<form method="post" name="resc_reg" action="resource_post.php">
						<input type="hidden" name="mode" value="mem_reg">
						<input type="hidden" name="pj" value="<?=$pj_list?>">
						<input type="hidden" name="headq" value="<?=$headq?>">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="border-width:1px 1px 0 1px; border-color:#d6d6d6; border-style:solid;">
							<div style="height:32px; background-color:#F0F0E8; text-align:center;">
								<div style="float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2">소속 팀 <a href="javascript:" onclick="resc_chk('<?=$pj_list?>','resc_basic.php?pj=<?=$pj_list?>&amp;sort=team_list')" title="팀 등록"><img src="../images/set.png" width="11" border="0" alt="" /></a></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2">직 위</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2">성 명</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2">주민등록번호</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2">연 락 처</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2">은 행</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2">계좌번호</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2">예 금 주</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">근무시작일</div>
							</div>

							<!-- 신규등록 1열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_1" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_1" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_1" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_1" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_1" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_1" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_1" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_1" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_1" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_1" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_1" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_1" id="start_date_1" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_1'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 2열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_2" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_2" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_2" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_2" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_2" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_2" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_2" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_2" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_2" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_2" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_2" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_2" id="start_date_2" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_2'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 3열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_3" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_3" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_3" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_3" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_3" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_3" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_3" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_3" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_3" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_3" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_3" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_3" id="start_date_3" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_3'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 4열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_4" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_4" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_4" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_4" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_4" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_4" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_4" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_4" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_4" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_4" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_4" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_4" id="start_date_4" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_4'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 5열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_5" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_5" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_5" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_5" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_5" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_5" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_5" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_5" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_5" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_5" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_5" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_5" id="start_date_5" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_5'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 6열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_6" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_6" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_6" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_6" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_6" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_6" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_6" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_6" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_6" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_6" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_6" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_6" id="start_date_6" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_6'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 7열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_7" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_7" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_7" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_7" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_7" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_7" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_7" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_7" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_7" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_7" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_7" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_7" id="start_date_7" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_7'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 8열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_8" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_8" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_8" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_8" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_8" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_8" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_8" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_8" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_8" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_8" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_8" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_8" id="start_date_8" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_8'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 9열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_9" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_9" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_9" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_9" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_9" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_9" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_9" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_9" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_9" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_9" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_9" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_9" id="start_date_9" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_9'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>

							<!-- 신규등록 10열 -->
							<div style="height:32px; text-align:center;">
								<div style="clear:left; float:left; width:16px; height: 26px; padding-top:6px;" class="form2"><input type="checkbox"  disabled></div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 소속팀 -->
									<select name="team_10" class="inputstyle2" style="width:65px; height:20px;">
										<option value="" selected> 선 택
										<?
											$qry2 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_list' AND headq_seq='$headq' GROUP BY team";
											$rlt2 = mysql_query($qry2, $connect);
											for($i=0; $rows2=mysql_fetch_array($rlt2); $i++){
										?>
										<option value="<?=$rows2[seq]?>"><?=$rows2[team]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 직 위 -->
									<select name="position_10" class="inputstyle2" style="width:65px; height:20px;">
										<option value=""> 선 택
										<option value="1"> 본부장
										<option value="2"> 팀 장
										<option value="3"> 팀 원
									</select>
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 성 명 -->
									<input type="text" name="name_10" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:150px; height: 26px; padding-top:6px;" class="form2"><!-- 주민등록번호 -->
									<input type="text" name="id_num1_10" maxlength="6" value="" class="inputstyle2" style="width:50px;"> - <input type="text" name="id_num2_10" maxlength="7" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:180px; height: 26px; padding-top:6px;" class="form2"><!-- 연락처 -->
									<input type="text" name="tel1_10" maxlength="3" value="" class="inputstyle2" style="width:30px;"> -
									<input type="text" name="tel2_10" maxlength="4" value="" class="inputstyle2" style="width:40px;"> -
									<input type="text" name="tel3_10" maxlength="4" value="" class="inputstyle2" style="width:40px;">
								</div>
								<div style="float:left; width:90px; height: 26px; padding-top:6px;" class="form2"><!-- 은 행 -->
									<select name="bank_acc_10" class="inputstyle2" style="width:80px; height:20px;">
										<option value="" selected> 선 택
										<?
											$b_qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
											$b_rlt = mysql_query($b_qry, $connect);
											while($b_rows = mysql_fetch_array($b_rlt)){
										?>
										<option value="<?=$b_rows[bank_name]?>"><?=$b_rows[bank_name]?>
										<? } ?>
									</select>
								</div>
								<div style="float:left; width:120px; height: 26px; padding-top:6px;" class="form2"><!-- 계좌번호 -->
									<input type="text" name="bank_acc_num_10" maxlength="25" value="" class="inputstyle2" style="width:110px;">
								</div>
								<div style="float:left; width:70px; height: 26px; padding-top:6px;" class="form2"><!-- 예금주 -->
									<input type="text" name="bank_acc_holder_10" maxlength="10" value="" class="inputstyle2" style="width:60px;">
								</div>
								<div style="float:left; width:110px; height: 26px; padding-top:6px;" class="form2">
									<input type="text" name="join_date_10" id="start_date_10" maxlength="10" value="" class="inputstyle2" style="width:70px;" onclick="openCalendar(this)">
									<a href="javascript:" onclick="openCalendar(document.getElementById('start_date_10'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</div>






















							<div class="form2" style="height:34px; padding:26px 20px 0 0; text-align:right;">
								<input type="button" value=" 등 록 하 기 " onclick="resc_reg_chk();" class="submit_bt" style="height='28'">
							</div>
							</td>
						</tr>
						</table>
						</form>
						<!-- ====================신규 등록 테이블 종료====================== -->
						</td>
					</tr>
					</table>
					</div>
					<? } ?>
