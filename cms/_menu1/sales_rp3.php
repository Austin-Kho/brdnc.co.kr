<!-- ============================= subject table end ============================= -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 동호수 계약 현황도</font></b>
						<div style="float:right;">
							<!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. -->
						</div>
					</div>
					<!-- ============================= subject table end ============================= -->
					<?
						$_m1_2_3_rlt = mysql_query("select _m1_2_3 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m1_2_3_row = mysql_fetch_array($_m1_2_3_rlt);

						if(!$_m1_2_3_row[_m1_2_3]||$_m1_2_3_row[_m1_2_3]==0){
					?>
					<div style="display:inline;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center" valign="middle" style="font-size:13px; color:#3e3e3e;" height="580">
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
							<!-- <a href="javascript:" onClick="excel_pop('<?=$_m1_2_2_row[_m1_2_2]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
						<form method="post" action="">
						<div style="height:35px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid;">
							<!-- ============ 본사 직원일 때 프로젝트 선택 가능 시작 ============  -->
							<?
								if($member_row[is_company]==1){
								$pj_rlt = mysql_query("SELECT seq FROM cms_project1_info ORDER BY seq DESC LIMIT 1", $connect);
								$pj_row = mysql_fetch_array($pj_rlt);
								$year_frm=$_REQUEST['year_frm'];
								$pj_list=$_REQUEST['pj_list'];
							?>
							<div style="float:left;  width:120px; height:28px; padding-top:7px; background-color:#F4F4F4; text-align:center; color:#000000;">년도 별</div>
							<div style="float:left; width:238px; height:28px; padding:7px 0 0 22px;">
								<select name="year_frm" onchange="submit();" class="inputstyle2" style="height:22px; width:100px;"><!-- ==================================== 계약년도 폼 ===================================== -->
									<option value="1"> 전 체
									<?
										// if(!$year_frm) $year_frm=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
										$year=range(date('Y')-4,date('Y'));
										for($i=(count($year)-1); $i>=0; $i--){
									?>
									<option value="<?=$year[$i]?>" <?if($year_frm==$year[$i]) echo "selected"; ?>><?=$year[$i]."년"?>
									<?	} ?>
								</select>
							</div>
							<div style="float:left;  width:120px; height:28px; padding-top:7px; background-color:#F4F4F4; text-align:center; color:#000000;">프로젝트</div>
							<div style="float:left; width:238px; height:28px; padding:7px 0 0 22px;">
								<select name="pj_list" onchange="submit();" class="inputstyle2" style="height:22px; width:150px;"><!-- ==================================== 프로젝트 리스트 ===================================== -->
									<option value=""<?if(!$pj_list) echo "selected"?>> 선 택
									<?
										if($year_frm>1){
											$where=" WHERE start_date LIKE '$year_frm%' ";
										}
										$qry = "SELECT * FROM cms_project1_info $where ORDER BY start_date DESC ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($pj_list==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
									<? } ?>
								</select>
							</div>
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
								$result = mysql_query("SELECT seq, pj_name FROM cms_project1_info, cms_member_table WHERE seq=pj_seq AND user_id='$_SESSION[p_id]' ", $connect);
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
						</form>
						<div style="margin-top:10px; height:25px;">
							<div style="float:left; height:22px; width:80px;"></div>

							<!-- 이부분 쿼리 향후 다시 작업 할 것 -->
							<?
								// 공공급세대 및 유보세대 구하기
								$data_qry = "SELECT COUNT(*) AS total,
														 SUM(is_hold) AS hold
											   FROM cms_project2_indi_table WHERE pj_seq='$pj_list' ";
								$data_rlt = mysql_query($data_qry, $connect);
								$data_row = mysql_fetch_array($data_rlt);

								// 청약세대 구하기
								$data_qry1 = "SELECT SUM(is_pro_cont) AS pro_cont,
														 				 SUM(is_contract) AS contract
											   FROM cms_project_data WHERE pj_seq='$pj_list' ";
								$data_rlt1 = mysql_query($data_qry1, $connect);
								$data_row1 = mysql_fetch_array($data_rlt1);




							?>
							<div style="float:left; height:22px; width:80px; background-color:#eaedf4; padding-top:2px; text-align:center; border-width:1px 0 0 1px; border-style:solid; border-color:#cdcdcd; color:#000000;">총 세대수</div>
							<div style="float:left; height:22px; width:75px; padding:2px 10px 0 0; text-align:right; border-width:1px 0 0 1px; border-style:solid; border-color:#cdcdcd;"><?if($pj_list) echo number_format($data_row[total])." 세대";?></div>
							<div style="float:left; height:22px; width:80px; background-color:#9e9e9e; color:#DFDFDF; padding-top:2px; text-align:center; border-width:1px 0 0 1px; border-style:solid; border-color:#cdcdcd;">유보 세대</div>
							<div style="float:left; height:22px; width:75px; padding:2px 10px 0 0; text-align:right; border-width:1px 1px 0 1px; border-style:solid; border-color:#cdcdcd; margin-right:30px;"><?if($pj_list) echo number_format($data_row[hold])." 세대";?></div>

							<!-- 타입컬러 범례 1열 표시 시작 -->
							<?
								$color_rlt = mysql_query("SELECT type_name, type_color FROM cms_project1_info WHERE seq='$pj_list' ", $connect); // 타입별 컬러 구하기
								$color_row = mysql_fetch_array($color_rlt);
								$type = explode("-", $color_row[type_name]);
								$color = explode("-", $color_row[type_color]);
								if(count($type)<=6) $roof_num = count($type); else $roof_num = 6;
								for($i=0; $i<$roof_num; $i++){
									$type_color[$type[$i]] = $color[$i];
							?>
							<div style="float:left; height:12px; width:18px; background-color:<?=$color[$i]?>;"></div>
							<div style="float:left; height:12px; width:50px; padding-left:5px; font-size:7pt;"><?=$type[$i]?></div>
							<? } ?>
						</div>
						<!-- 타입컬러 범례 1열 표시 종료 -->

						<div style="clear:left; height:25px;">
							<div style="float:left; height:22px; width:80px;"></div>
							<div style="float:left; height:22px; width:80px; background-color:#C6CEFF; padding-top:2px; text-align:center; border-width:1px 0 0 1px; border-style:solid; border-color:#cdcdcd; color:#000000;">청약 세대</div>
							<div style="float:left; height:22px; width:75px; padding:2px 10px 0 0; text-align:right; color:#009900;  border-width:1px 0 0 1px; border-style:solid; border-color:#cdcdcd;"><?if($pj_list) echo number_format($data_row[pro_cont])." 세대";?></div>
							<div style="float:left; height:22px; width:80px; background-color:#E0FD6C; color:#000000; padding-top:2px; text-align:center; border-width:1px 0 0 1px; border-style:solid; border-color:#cdcdcd;">계약 세대</div>
							<div style="float:left; height:22px; width:75px; padding:2px 10px 0 0; text-align:right; color:#0066ff; border-width:1px 1px 0 1px; border-style:solid; border-color:#cdcdcd; margin-right:30px;"><?if($pj_list) echo number_format($data_row[contract])." 세대";?></div>

							<!-- 타입컬러 범례 2열 표시 시작 -->
							<?
								if(count($type)>6&&count($type)<=12) $roof_num = count($type); else if(count($type)>12) $roof_num = 6;
								for($i=6; $i<$roof_num; $i++){
									$type_color[$type[$i]] = $color[$i];
							?>
							<div style="float:left; height:12px; width:18px; background-color:<?=$color[$i]?>;"></div>
							<div style="float:left; height:12px; width:50px; padding-left:5px; font-size:7pt;"><?=$type[$i]?></div>
							<? } ?>
						</div>
						<!-- 타입컬러 범례 2열 표시 종료 -->

						<div style="clear:left; height:25px;">
							<div style="float:left; height:22px; width:80px;"></div>
							<div style="float:left; height:22px; width:80px; background-color:#d5e2ec; color:#000000; padding-top:2px; text-align:center; border-width:1px 0 1px 1px; border-style:solid; border-color:#cdcdcd;">합 계</div>
							<div style="float:left; height:22px; width:75px; padding:2px 10px 0 0; text-align:right; color:#0000cc; border-width:1px 0 1px 1px; border-style:solid; border-color:#cdcdcd;"><?if($pj_list) echo number_format($data_row[pro_cont]+$data_row[contract])." 세대";?></div>
							<div style="float:left; height:22px; width:80px; background-color:#edffb5; color:#000000; padding-top:2px; text-align:center; border-width:1px 0 1px 1px; border-style:solid; border-color:#cdcdcd;">잔여 세대수</div>
							<div style="float:left; height:22px; width:75px; padding:2px 10px 0 0; text-align:right; color:#00cc00; border-width:1px 1px 1px 1px; border-style:solid; border-color:#cdcdcd; margin-right:30px;"><?if($pj_list) echo number_format($data_row[total]-($data_row[hold]+$data_row[pro_cont]+$data_row[contract]))." 세대";?></div>

							<!-- 타입컬러 범례 3열 표시 시작 -->
							<?
								if(count($type)>13) $roof_num = count($type);
								for($i=13; $i<$roof_num; $i++){
									$type_color[$type[$i]] = $color[$i];
							?>
							<div style="float:left; height:12px; width:18px; background-color:<?=$color[$i]?>;"></div>
							<div style="float:left; height:12px; width:50px; padding-left:5px; font-size:7pt;"><?=$type[$i]?></div>
							<? } ?>
							<!-- 타입컬러 범례 3열 표시 종료 -->

						</div>
						<div style="height:12px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; margin-bottom:10px;"></div>
						<?
							if(!$pj_list){
						?>
						<div style="height:80px; text-align:center; padding-top:80px;">조회 할 프로젝트를 선택하여 주십시요!</div>
						<?
							}
							//
							$max_rlt = mysql_query("SELECT MAX(ho) AS max_ho FROM cms_project2_indi_table WHERE pj_seq='$pj_list' ", $connect); // 해당 단지 최 고층 구하기
							$max_row = mysql_fetch_array($max_rlt);
							if(strlen($max_row[max_ho])==3) $max_floor = substr($max_row[max_ho], -3,1);
							if(strlen($max_row[max_ho])==4) $max_floor = substr($max_row[max_ho], -4,2);

							$dong_qry = " SELECT dong FROM cms_project2_indi_table WHERE pj_seq='$pj_list' GROUP BY dong ";  // 해당 단지 동 수 및 리스트 구하기
							$dong_rlt = mysql_query($dong_qry, $connect);
							$num_rows = mysql_num_rows($dong_rlt);
							while($dong_rows = mysql_fetch_array($dong_rlt)){ // 해당 동 만큼 반복
						?>
						<div style="float:left; margin-top:15px;">
						<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
						<?
								for($j=0; $j<$max_floor; $j++){ // 최고층 수만큼 반복
									$ho_qry = "SELECT MIN(RIGHT(ho,2)) AS st_line, MAX(RIGHT(ho,2)) AS dong_line
												 FROM cms_project2_indi_table WHERE pj_seq='$pj_list' AND dong='$dong_rows[dong]' "; // 각 동별 라인수 구하기
									$ho_rlt = mysql_query($ho_qry, $connect);
									$ho_rows = mysql_fetch_array($ho_rlt);  // 반복하기 위한 각 동별 라인 수
									$floor_num = $max_floor-$j; // 층수

									for($i=0; $i<$ho_rows[dong_line]; $i++){ // 라인수 만큼 반복
										if($i==0){ // 1호라인인 경우
											$clear_css = "clear:left; ";
											$bor_wid = "border-width:1px 1px 0 1px;";
										}else { // 나머지 라인인 경우
											$clear_css = "";
											$bor_wid = "border-width:1px 1px 0 0;";
										}
										$line_num = str_pad($i+1, 2, 0, STR_PAD_LEFT); // 라인 텍스트
										$ho_num = $floor_num.$line_num; // 호수 텍스트


										// 타입, 호수, 유보여부, 청약여부, 계약여부, 청약자, 청약일, 계약자, 계약일 구하기 ???????
										// $ho_ck_qry = "SELECT pj_ho, type_ho, is_except, is_pro_cont, is_contract, pro_contractor, pro_cont_date, contractor, cont_date
										//				 FROM cms_project_data WHERE pj_seq='$pj_list' AND pj_dong='$dong_rows[pj_dong]' AND pj_ho='$ho_num' ";
										$ho_ck_qry = "SELECT type, ho, is_hold
														 FROM cms_project2_indi_table WHERE pj_seq='$pj_list' AND dong='$dong_rows[dong]' AND ho='$ho_num' ";
										$ho_ck_rlt = mysql_query($ho_ck_qry, $connect);
										$ho_ck_row = mysql_fetch_array($ho_ck_rlt);

										/////////////////////////////////////// 동호수 표시칸 css S //////////////////////////////////////////
										if($ho_ck_row) {   // div 번호에 해당 호수가 있으면,
											$bor_col = "border-color:#cccccc;";
											$div_col = "background-color:".$type_color[$ho_ck_row[type]].";";
										}else {
											if($ho_num<400){ // 호수가 없는 4층 이하(피로티)인 경우
												$bor_col = "border-color:#c3c3c3;";
												$div_col = "background-color:#c3c3c3;";
											}else{
												$bor_col = "border-color:#FFFFFF;";
												$div_col = "";
											}
										}
										/////////////////////////////////////// 동호수 표시칸 css E //////////////////////////////////////////



										////---------->> 이 란 추후 수정 할 것
										///////////////////////////////////// 청약 / 계약 상태 표시란 css S ////////////////////////////////////
										if($ho_ck_row[is_pro_cont]==1){ // 청약인 경우
											$condi = "<a href='#;' style='color:#FFFFFF; font-size:8pt;' title='청약자 : ".$ho_ck_row[pro_contractor]." (".$ho_ck_row[pro_cont_date].")'>청약</a>";
											$con_css = "background-color:#ff6600;";
										}else if($ho_ck_row[is_contract]==1){ // 계약인 경우
											$condi = "<a href='#;' style='color:#FFFFFF; font-size:8pt;' title='계약자 : ".$ho_ck_row[contractor]." (".$ho_ck_row[cont_date].")'>계약</a>";
											$con_css = "background-color:#ff0000;";
										}else if($ho_ck_row[is_except]==1){
											$condi = "S.O";
											$con_css = "background-color:#b4b4b4; color:#d7d7d7;";
										}else{
											if($ho_num<400&&!$ho_ck_row){ // 호수가 4층 이하이고 호수가 없는 경우(피로티)
												$condi = "";
												$con_css = "background-color:#c3c3c3; color:#cccccc;";
											}else{
												$condi = "";
												$con_css = "";
											}
										}
										///////////////////////////////////// 청약/ 계약 상태 표시란 css E ///////////////////////////////////////////////
						?>
							<div style="<?=$clear_css?> float:left;">
								<div style="font-size:8pt; width:30px; height:14px; text-align:center; border-style:solid; <?=$bor_wid." ".$bor_col." ".$div_col?>">
									<a href="#;" title="<?=$ho_ck_row[type_ho]." TYPE"?>" style="font-size:8pt; color:#000000;"><?=$ho_ck_row[ho]?></a>
								</div>
								<div style="font-size:7pt; width:30px; height:14px; text-align:center;border-style:solid; <?=$bor_wid." ".$bor_col." ".$con_css?>"><?=$condi?></div>
							</div>
						<?
									}
								}
						?>
							</td>
						</tr>
						</table>
							<div style="height:25px; padding-top:5px; text-align:center; background-color:#4a7da4; margin-bottom:10px; color:white; border:1px; border-style:solid; border-color:#3e3e3e;"><?=$dong_rows[dong]."동"?></div>
						</div>
						<div style="float:left; width:10px; height:20px; padding-top:20px;"></div>
						<?
							}
						?>
						<!-- <input type="button" value="dd" onclick="location.href='sales_imsi_del.php?pj_seq=<?=$pj_list?>' "> 전체 데이터 지우기 버튼 -->
						</td>
					</tr>
					</table>
					</div>
					<? } ?>