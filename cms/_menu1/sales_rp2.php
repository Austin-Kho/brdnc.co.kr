					<!-- ============================= subject table end ============================= -->
					<div style=" height:18px; background-color:#F4F4F4" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 현장별 계약등록(수정)</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
						</div>
					</div>
					<!-- ============================= subject table end ============================= -->
					<?
						$_m1_2_2_rlt = mysql_query("select _m1_2_2 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m1_2_2_row = mysql_fetch_array($_m1_2_2_rlt);

						if(!$_m1_2_2_row[_m1_2_2]||$_m1_2_2_row[_m1_2_2]==0){
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
						<td height="570" valign="top">
						<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;">
							<!-- <a href="javascript:" onClick="excel_pop('<?=$_m1_2_1_row[_m1_2_1]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
						<?
							$pj_list=$_REQUEST['pj_list'];
							$data_cr=$_REQUEST['data_cr'];

							$result=mysql_query("SELECT data_cr FROM cms_project_info WHERE seq='$pj_list' ", $connect);
							$row=mysql_fetch_array($result);
							$data_cr = $row[data_cr];
						?>
						<form method="post" name="set1" action="">
						<div style="height:35px; border-width:1px 0 0 0; border-style:solid; border-color:#D6D6D6;">
							<div style="float:left;  width:120px; height:28px; padding-top:7px; background-color:#F4F4F4; text-align:center; color:#000000;">관리 구분</div>
							<div style="float:left; width:338px; height:28px; padding:7px 0 0 22px;">
								<input type="radio" name="data_cr" value="0" <?if($data_cr==0) echo "checked";?> onclick = "submit();"> 동호수별 관리
								<input type="radio" name="data_cr" value="1" <?if($data_cr==1) echo "checked";?> onclick = "submit();"> 계약관리번호별 관리
							</div>
						</div>
						<div style="height:35px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid;">
							<!-- ============ 본사 직원일 때 프로젝트 선택 가능 시작 ============  -->
							<?
								if($member_row[is_company]==1){
								$pj_rlt = mysql_query("SELECT seq FROM cms_project_info ORDER BY seq DESC LIMIT 1", $connect);
								$pj_row = mysql_fetch_array($pj_rlt);
								$year_frm=$_REQUEST['year_frm'];
							?>
							<div style="float:left;  width:120px; height:28px; padding-top:7px; background-color:#F4F4F4; text-align:center; color:#000000;">년도 별</div>
							<div style="float:left; width:238px; height:28px; padding:7px 0 0 22px;">
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
							<div style="float:left;  width:120px; height:28px; padding-top:7px; background-color:#F4F4F4; text-align:center; color:#000000;">프로젝트</div>
							<div style="float:left; width:238px; height:28px; padding:7px 0 0 22px;">
								<select name="pj_list" onchange="submit();" class="inputstyle2" style="height:22px; width:150px;"><!-- ==================================== 프로젝트 리스트 ===================================== -->
									<option value=""<?if(!$pj_list) echo "selected"?>> 선 택
									<?
										if($year_frm>1){
											$where=" WHERE pr_sd LIKE '$year_frm%' ";
										}
										$qry = "SELECT * FROM cms_project_info $where ORDER BY pr_sd DESC ";
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
						<?
							$mode=$_REQUEST['mode'];

							$cont_sort1 = $_REQUEST['cont_sort1']; // 계약 / 해지 선택
							$cont_sort2 = $_REQUEST['cont_sort2']; // 청약 / 계약 여부
							$cont_sort3 = $_REQUEST['cont_sort3']; // 청약해지 / 계약해지 여부

							$diff_no = $_REQUEST['diff_no'];
							$type = $_REQUEST['type'];
							$con_no = $_REQUEST['con_no'];
							$dong = $_REQUEST['dong'];
							$ho = $_REQUEST['ho'];

							if($mode=="modi"){ // 계약물건 정보 수정일 때
								$mo_qry = "SELECT * FROM cms_project_data WHERE pj_seq='$pj_list' AND con_no='$con_no' LIMIT 1";
								$mo_rlt = mysql_query($mo_qry, $connect);
								$mo_row = mysql_fetch_array($mo_rlt);

								if(!$cont_sort1){ // 거래구분을 손대지 않았으면
									if($mo_row[cancel]==1){ // 해지물건인 경우
										$cont_sort1=2; $cont_sort3=3; // 거래구분은 해지 //  청약해지
									}else{ // 해지 물건이 아닌 경우
										$cont_sort1 = 1; // 계약에 체크함
									}
								}
								if(!$cont_sort2&&$mo_row[is_pro_cont]==1) $cont_sort2=1; // 청약상태 손안댔고 청약물건이면 // 청약상태로
								if(!$cont_sort2&&$mo_row[is_cont]==1) $cont_sort2=2; // 청약상태 손안댔고 계약물건이면 // 계약상태로
								$diff_no = $mo_row[diff_no];
							}
						?>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#D6D6D6;">
							<div style="float:left;  width:120px; height:28px; padding-top:7px; background-color:#F4F4F4; text-align:center; color:#000000;">거래구분</div>
							<div style="float:left;  width:115px; height:26px; padding:9px 0 0 15px;; text-align:center;">
								<input type="radio" name="cont_sort1" value="1" <?if(!$cont_sort1||$cont_sort1==1) echo "checked";?> onclick="submit();"> 계약 <!-- 온클릭일 때 다음 셀렉트바 값 변경 -->
								<input type="radio" name="cont_sort1" value="2" <?if($cont_sort1==2) echo "checked";?> onclick="submit();"> 해지 <!-- 온클릭일 때 다음 셀렉트바 값 변경 -->
							</div>
							<?if(!$cont_sort1||$cont_sort1==1){?>
							<div style="float:left;  width:130px; height:28px; padding-top:7px; text-align:center;">
								<select name="cont_sort2" class="inputstyle2" style="height:22px; width:100px;" onchange="submit();"><!-- 온 체인지일때 DB 변수 적용 // 계약 가능리스트 또는 해지 가능리스트 불러옴 -->
									<option value="" <?if(!$cont_sort2) echo "selected"; ?>> 선 택
									<option value="1" <?if($cont_sort2==1) echo "selected"; ?>> 청약(가계약)
									<option value="2" <?if($cont_sort2==2) echo "selected"; ?>> 계약(정계약)
								</select>
							</div>
							<?}else if($cont_sort1==2){?>
							<div style="float:left;  width:130px; height:28px; padding-top:7px; text-align:center;">
								<select name="cont_sort3" class="inputstyle2" style="height:22px; width:100px;" onchange="submit();"><!-- 온 체인지일때 DB 변수 적용 // 계약 가능리스트 또는 해지 가능리스트 불러옴 -->
									<option value="" <?if(!$cont_sort3) echo "selected"; ?>> 선 택
									<option value="3" <?if($cont_sort3==3||$mo_row[cancel]==1) echo "selected"; ?>> 청약 해지
									<option value="4" <?if($cont_sort3==4) echo "selected"; ?>> 계약 해지
								</select>
							</div>
							<?}?>
							<div style="float:left; width:120px; height:26px; padding-top:9px; color:black; text-align:center; background-color:#F4F4F4;">차 수</div>
							<div style="float:left; width:138px; height:28px; padding:7px 0 0 22px;">
								<select name="diff_no" class="inputstyle2" style="height:22px; width:100px;" onchange="submit();">
									<option value="" <?if(!$diff_no) echo 'selected'?>> 선 택
									<?
										$where_add = " WHERE pj_seq='$pj_list' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==1)) $where_add .= " AND is_pro_cont='0' AND is_contract='0' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==2)) $where_add .= " AND is_contract='0' ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==3) $where_add .= " AND is_pro_cont='1' ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==4) $where_add .= " AND is_contract='1' ";
										if($mode=="modi")  $where_add .= " AND con_no = '$mo_row[con_no]' ";

										$diff_qry = "SELECT diff_no FROM cms_project_data $where_add GROUP BY diff_no ORDER BY diff_no ";
										$diff_rlt = mysql_query($diff_qry, $connect);
										while($diff_rows = mysql_fetch_array($diff_rlt)){
									?>
									<option value="<?=$diff_rows[diff_no]?>" <?if($diff_no==$diff_rows[diff_no]) echo 'selected'?>><?=$diff_rows[diff_no]." 차"?>
									<? } ?>
								</select>
							</div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#D6D6D6;">
							<div style="float:left;  width:120px; height:28px; padding-top:7px; background-color:#F4F4F4; text-align:center; color:#000000;">타입선택</div>
							<div style="float:left; width:238px; height:28px; padding:7px 0 0 22px;">
								<select name="type" class="inputstyle2" style="height:22px; width:100px;" onchange="submit();">
									<option value="" <?if(!$type) echo 'selected'?>> 선 택
									<?
										$where_add = " WHERE pj_seq='$pj_list' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==1)) $where_add .= " AND is_pro_cont='0' AND is_contract='0' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==2)) $where_add .= " AND is_contract='0' ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==3) $where_add .= " AND is_pro_cont='1' ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==4) $where_add .= " AND is_contract='1' ";
										if($mode=="modi")  $where_add .= " AND con_no = '$mo_row[con_no]' ";

										$type_qry = "SELECT type_ho FROM cms_project_data $where_add GROUP BY type_ho ORDER BY type_ho ";
										$type_rlt = mysql_query($type_qry, $connect);
										while($type_rows = mysql_fetch_array($type_rlt)){
									?>
									<option value="<?=$type_rows[type_ho]?>" <?if($type==$type_rows[type_ho]) echo 'selected'?>><?=$type_rows[type_ho]?>
									<? } ?>
								</select>
							</div>
							<?if($data_cr==0){ // 동호수별 관리일 때?>
							<div style="float:left; width:120px; height:26px; padding-top:9px; color:black; text-align:center; background-color:#F4F4F4;">동 선택</div>
							<div style="float:left; width:138px; height:28px; padding:7px 0 0 22px;">
								<select name="dong" class="inputstyle2" style="height:22px; width:100px;" onchange="submit();">
									<option value="" <?if(!$dong) echo 'selected'?>> 선 택
									<?
										$where_add = " WHERE pj_seq='$pj_list' AND type_ho = '$type' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==1)) $where_add .= " AND is_pro_cont='0' AND is_contract='0' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==2)) $where_add .= " AND is_contract='0' ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==3) $where_add .= " AND is_pro_cont=1 ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==4) $where_add .= " AND is_contract=1 ";

										$dong_qry="SELECT pj_dong FROM cms_project_data $where_add GROUP BY pj_dong ORDER BY pj_dong ";
										$dong_rlt = mysql_query($dong_qry, $connect);
										while($dong_rows = mysql_fetch_array($dong_rlt)){
									?>
									<option value="<?=$dong_rows[pj_dong]?>"  <?if($dong==$dong_rows[pj_dong]) echo 'selected'?>><?=$dong_rows[pj_dong]?>동
									<? } ?>
								</select>
							</div>
							<div style="float:left; width:120px; height:26px; padding-top:9px; color:black; text-align:center; background-color:#F4F4F4;">호수 선택</div>
							<div style="float:left; width:138px; height:28px; padding:7px 0 0 22px;">
								<select name="ho" class="inputstyle2" style="height:22px; width:100px;" onchange="submit();">
									<option value="" <?if(!$dong) echo 'selected'?>> 선 택
									<?
										$where_add = " WHERE pj_seq='$pj_list' AND type_ho = '$type' AND pj_dong = '$dong' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==1)) $where_add .= " AND is_pro_cont='0' AND is_contract='0' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==2)) $where_add .= " AND is_contract='0' ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==3) $where_add .= " AND is_pro_cont=1 ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==4) $where_add .= " AND is_contract=1 ";

										$ho_qry="SELECT pj_ho FROM cms_project_data $where_add ORDER BY pj_ho DESC ";
										$ho_rlt = mysql_query($ho_qry, $connect);
										while($ho_rows = mysql_fetch_array($ho_rlt)){
									?>
									<option value="<?=$ho_rows[pj_ho]?>"  <?if($ho==$ho_rows[pj_ho]) echo 'selected'?>><?=$ho_rows[pj_ho]?>호
									<? } ?>
								</select>
							</div>
							<? }else{ // 동호수별 관리일 때 종료 // 계약관리번호별 관리일 때 시작?>
							<div style="float:left; width:120px; height:26px; padding-top:9px; color:black; text-align:center; background-color:#F4F4F4;">계약관리번호</div>
							<div style="float:left; width:138px; height:28px; padding:7px 0 0 22px;">
								<select name="con_no" class="inputstyle2" style="height:22px; width:100px;" onchange="submit();">
									<option value="" <?if(!$con_no) echo 'selected'?>> 선 택
									<?
										$where_add = " WHERE pj_seq='$pj_list' AND diff_no = '$diff_no' AND type_ho = '$type' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==1)) $where_add .= " AND is_pro_cont='0' AND is_contract='0' ";
										if(!$mode&&$cont_sort1==1&&($cont_sort2==2)) $where_add .= " AND is_contract='0' ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==3) $where_add .= " AND is_pro_cont=1 ";
										if(!$mode&&$cont_sort1==2&&$cont_sort3==4) $where_add .= " AND is_contract=1 ";
										if($mode=="modi")  $where_add .= " AND con_no = '$mo_row[con_no]' ";

										$con_qry="SELECT con_no FROM cms_project_data $where_add ORDER BY con_no LIMIT 15";
										$con_rlt = mysql_query($con_qry, $connect);
										while($con_rows = mysql_fetch_array($con_rlt)){
									?>
									<option value="<?=$con_rows[con_no]?>"  <?if($con_no==$con_rows[con_no]) echo 'selected'?>><?=$con_rows[con_no]?>
									<? } ?>
								</select>
							</div>
							<? } ?>
						</div>
						</form>
						<!-- ===================계약물건 검색 종료================== -->




						<!-- ===================계약내용 기록 시작================== -->
						<form method="post" name="form1" action="sales_rp_post.php">
							<input type="hidden" name="pj_seq" value="<?=$pj_list?>">
							<input type="hidden" name="data_cr" value="<?=$data_cr?>">
							<input type="hidden" name="cont_sort1" value="<?=$cont_sort1?>"><!-- 계약(1) 해지(2) 여부 -->
							<input type="hidden" name="cont_sort2" value="<?=$cont_sort2?>"><!-- 청약(1) 계약(2) 여부 -->
							<input type="hidden" name="cont_sort3" value="<?=$cont_sort3?>"><!-- 청약해지(1) 계약해지(2) 여부 -->
							<input type="hidden" name="type" value="<?=$type?>">
							<input type="hidden" name="diff_no" value="<?=$diff_no?>">
							<input type="hidden" name="dong" value="<?=$dong?>">
							<input type="hidden" name="ho" value="<?=$ho?>">
							<input type="hidden" name="con_no" value="<?=$con_no?>">

						<?
							if($data_cr==0) $query = "SELECT * FROM cms_project_data WHERE pj_seq='$pj_list' AND type_ho='$type' AND pj_dong='$dong' AND pj_ho='$ho' ";// 동호수별 관리일 때
							if($data_cr==1) $query = "SELECT * FROM cms_project_data WHERE pj_seq='$pj_list' AND con_no='$con_no' "; /////////////////////////////////////// 계약관리번호별 관리일 때
							$c_result = mysql_query($query, $connect);
							$cont_row = mysql_fetch_array($c_result);

							if($cont_row[is_except]==1){
								$condition = "<font color='#000000'>기 분양 세대</font>";
							}else if(($ho||$con_no)&&$cont_row[is_pro_cont]==1&&$cont_row[cancel]<>1){
								$condition = "<font color='#009900'>현재 청약 상태</font>";
								$cust_name = $cont_row[pro_contractor];
								$tel_1 = $cont_row[pro_cont_tel_1];
								$tel_2 = $cont_row[pro_cont_tel_2];
								$de_11 = $cont_row[pro_deposit];
							}else if(($ho||$con_no)&&$cont_row[is_contract]==1){
								$condition = "<font color='#0066ff'>현재 계약 상태</font>";
								$cust_name = $cont_row[contractor];
								$tel_1 = $cont_row[cont_tel_1];
								$tel_2 = $cont_row[cont_tel_2];
								$id_addr = explode(":", $cont_row[cont_id_addr]);
								$dm_addr = explode(":", $cont_row[cont_dm_addr]);
								$de_11 = $cont_row[deposit_1st_1];
							}else if($cont_row[cancel]==1&&$cont_row[refund]==0){
								$condition = "<font color='#ff0000'>현재 청약 해지 / 환불 전 상태</font>";
								if($cont_row[is_pro_cont]==1){
									$cust_name = $cont_row[pro_contractor];
									$tel_1 = $cont_row[pro_cont_tel_1];
									$tel_2 = $cont_row[pro_cont_tel_2];
									$de_11 = $cont_row[pro_deposit];
								}else{
									$cust_name = $cont_row[contractor];
									$tel_1 = $cont_row[cont_tel_1];
									$tel_2 = $cont_row[cont_tel_2];
									$id_addr = explode(":", $cont_row[cont_id_addr]);
									$dm_addr = explode(":", $cont_row[cont_dm_addr]);
									$de_11 = $cont_row[deposit_1st_1];
								}
							}else if(($ho||$con_no)&&$cont_row[is_pro_cont]==0&&$cont_row[is_contract]==0){
								$condition = "<font color='#ff0000'>현재 계약가능 상태</font>";
							}
							$worker_where=explode("-", $cont_row[worker_where]);
							if($cont_sort2==1||$cont_sort3==3)$cont_date = $cont_row[pro_cont_date]; else $cont_date = $cont_row[cont_date];
						?>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#707070; background-color:#ecefe7">
							<div style="float:left; padding:7px 0 0 20px; font-size:13px; color:#000000;"><?if($diff_no) echo "<b>".$diff_no." 차<b>"; ?></div>
							<div style="float:left; padding:7px 0 0 20px; font-size:13px; color:#000000;"><?if($type) echo "<b>".$type." 타입(TYPE)</b>"; ?></div>
							<?	if($data_cr==0){ // 동호수별 관리일 때 ///?>
							<div style="float:left; padding:7px 0 0 30px; font-size:13px; color:#000000;"><? if($dong) echo "<b>".$dong."동</b>"; ?></div>
							<div style="float:left; padding:7px 0 0 30px; font-size:13px; color:#000000;"><? if($ho) echo "<b>".$ho."</b>"; ?></div>
							<?}else{?>
							<div style="float:left; padding:7px 0 0 30px; font-size:13px; color:#000000;"><? if($con_no) echo "<b>".$con_no."</b>"; ?></div>
							<div style="float:left; padding:7px 30px 0 30px; font-size:13px; color:#000000;"><?=$condition?></div>
							<?if($cont_sort2==2){?>
							<div style="float:right; padding:7px 30px 0 0; font-size:13px; color:#000000;"><input type="checkbox" name="dongho_put" onclick="dong_ho_put();"> 동호수 입력</div>
							<div style="float:right; padding:7px 10px 0 ; display:none;" id="ho"><input type="text" name="ho" value="<?=$cont_row[pj_ho]?>" style="width:50px;"> 호</div>
							<div style="float:right; padding:7px 10px 0 ; display:none;" id="dong"><input type="text" name="dong" value="<?=$cont_row[pj_dong]?>" style="width:50px;"> 동</div>
							<?}}?>

						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">계약고객명</div>
							<div style="float:left; width:250px; height:28px; padding:7px 0 0 10px;"><input type="text" name="cust_name" value="<?=$cust_name?>" class="inputstyle2"></div>
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;"><?if($cont_sort2==1||$cont_sort3==3){echo "청약";} else {echo "계약";}?>일자</div>
							<div style="float:left; padding:8px 35px 0 10px; ">
								<!-- <div style="float:left;"> -->
									<input type="text" name="cont_date" id="cont_date" value="<?if($cont_date>0) echo $cont_date;?>" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('cont_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('cont_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								<!-- </div> -->
							</div>
						</div>

						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">연락처1</div>
							<div style="float:left; width:250px; height:28px; padding:7px 0 0 10px;"><input type="text" name="tel_1" value="<?=$tel_1?>" class="inputstyle2"></div>
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">연락처2</div>
							<div style="float:left; padding:8px 20px 0 10px; "><input type="text" name="tel_2" value="<?=$tel_2?>" class="inputstyle2"></div>
						</div>
						<?if($cont_sort2==2||$cont_sort3==4){ // 계약일 경우 ///?>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">주민등록 주소</div>
							<div style="float:left; padding:8px 20px 0 10px; ">
							<!-- <input type="text" name="addr" class="inputstyle2" style="width:436px;"> -->
							<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('../member/zip_search.php', 'id_zip', 'id_addr');" class="inputstyle_bt">
								<input type="text" name="id_zip" value="<?=$id_addr[0]?>" size="8" class="inputstyle2" onKeydown="ZipWindow('../member/zip_search.php', 'id_zip', 'id_addr');" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">



								<input type="text" name="id_addr1" value="<?=$id_addr[1]?>" size="30" style="width:297px;" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="width:310px;">
								<input type="text" name="id_addr2" value="<?=$id_addr[2]?>" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <font color="#788be2">나머지 주소</font>
							</div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">우편송부 주소</div>
							<div style="float:left; padding:8px 20px 0 10px; ">
							<!-- <input type="text" name="addr" class="inputstyle2" style="width:436px;"> -->
							<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('../member/zip_search.php', 'dm_zip', 'dm_addr');" class="inputstyle_bt">
								<input type="text" name="dm_zip" value="<?=$dm_addr[0]?>" size="8" class="inputstyle2" onKeydown="ZipWindow('../member/zip_search.php', 'dm_zip', 'dm_addr');" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">


								<input type="text" name="dm_addr1" value="<?=$dm_addr[1]?>" size="30" style="width:297px;" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="width:310px;">
								<input type="text" name="dm_addr2" value="<?=$dm_addr[2]?>" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <font color="#788be2">나머지 주소</font>
								<input type="checkbox" name="sa_addr" onclick="same_addr();"> 위와 같음
							</div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">미비서류 항목</div>
							<div style="float:left; width:850px; height:28px; padding:7px 0 0 10px;">
								<input type="checkbox" name="doc_1" value="1" <?if($cont_row[doc_1]==1) echo "checked";?> onclick="alert(this.value);"> 각서9종
								<input type="checkbox" name="doc_2" value="1" <?if($cont_row[doc_2]==1) echo "checked";?>> 주민등록등본
								<input type="checkbox" name="doc_3" value="1" <?if($cont_row[doc_3]==1) echo "checked";?>> 주민등록초본
								<input type="checkbox" name="doc_4" value="1" <?if($cont_row[doc_4]==1) echo "checked";?>> 가족관계증명서
								<input type="checkbox" name="doc_5" value="1" <?if($cont_row[doc_5]==1) echo "checked";?>> 인감증명서(날인)
								<input type="checkbox" name="doc_6" value="1" <?if($cont_row[doc_6]==1) echo "checked";?>> 사용인감(막도장)
								<input type="checkbox" name="doc_7" value="1" <?if($cont_row[doc_7]==1) echo "checked";?>> 신분증
								<input type="checkbox" name="doc_8" value="1" <?if($cont_row[doc_8]==1) echo "checked";?>> 배우자 등본
							</div>
						</div>
						<?}?>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; <?if($cont_sort2==2||$cont_sort3==4) echo 'padding-top:6px;'?>">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">
								<?if($cont_sort2==1||$cont_sort3==3){echo "청약금";} else {echo "1차 계약금1";}?></div>
							<div style="float:left; <?if($cont_sort2==1||$cont_sort3==3) {echo 'width:250px;';} else {echo 'width:170px;';}?> height:28px; padding:7px 0 0 10px;"><input type="text" name="de_11" value="<?if($de_11>0) echo $de_11?>" class="inputstyle2"> 원</div>
							<?if($cont_sort2==2||$cont_sort3==4){?>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
								입금일 : <input type="text" name="de_11_date" id="de_11_date" value="<?if($cont_row[deposit_1st_1_date]==0&&$cont_row[pro_cont_date]) echo $cont_row[pro_cont_date]; else if($cont_row[deposit_1st_1_date]>0) echo $cont_row[deposit_1st_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_11_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('de_11_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_11_who" value="<?=$cont_row[deposit_1st_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							<?}?>
							<?if($cont_sort2==1){?>
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">계약 예정일</div>
							<div style="float:left; padding:8px 20px 0 10px; ">
								<input type="text" name="due_date" id="due_date" value="<?if($cont_row[pro_due_date]>0) echo $cont_row[pro_due_date]; else echo "";?>" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('due_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<!-- <a href="javascript:" onclick=" to_del('due_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a> -->
							</div>
							<?}else if($cont_sort3==3){?>
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">청약금 환불여부 </div>
							<div style="float:left; padding:8px 20px 0 10px; "><input type="checkbox" name="refund" value="1" class="inputstyle2" <?if($cont_row[refund]==1) echo "checked";?>> 환불 완료</div>
							<?}?>
						</div>
						<?if($cont_sort2==2||$cont_sort3==4){?>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">1차 계약금2</div>
							<div style="float:left; <?if($cont_sort2==1||$cont_sort3==3) {echo 'width:250px;';} else {echo 'width:170px;';}?> height:28px; padding:7px 0 0 10px;"><input type="text" name="de_12" value="<?if($cont_row[deposit_1st_2]>0) echo $cont_row[deposit_1st_2]?>" class="inputstyle2"> 원</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
								입금일 : <input type="text" name="de_12_date" id="de_12_date" value="<?if($cont_row[deposit_1st_2_date]>0) echo $cont_row[deposit_1st_2_date]?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_12_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('de_12_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_12_who" value="<?=$cont_row[deposit_1st_2_who]?>" style="width:76px;" class="inputstyle2"></div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">1차 계약금3</div>
							<div style="float:left; <?if($cont_sort2==1||$cont_sort3==3) {echo 'width:250px;';} else {echo 'width:170px;';}?> height:28px; padding:7px 0 0 10px;"><input type="text" name="de_13" value="<?if($cont_row[deposit_1st_3]>0) echo $cont_row[deposit_1st_3];?>" class="inputstyle2"> 원</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
								입금일 : <input type="text" name="de_13_date" id="de_13_date" value="<?if($cont_row[deposit_1st_3_date]>0) echo $cont_row[deposit_1st_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"> <a href="javascript:" onclick="cal_add(document.getElementById('de_13_date'),this); event.cancelBubble=true"><img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('de_13_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_13_who" value="<?=$cont_row[deposit_1st_3_who]?>" style="width:76px;" class="inputstyle2"></div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">업무대행비1</div>
							<div style="float:left; <?if($cont_sort2==1||$cont_sort3==3) {echo 'width:250px;';} else {echo 'width:170px;';}?> height:28px; padding:7px 0 0 10px;"><input type="text" name="cha_1" value="<?if($cont_row[charge_1]>0) echo $cont_row[charge_1];?>" class="inputstyle2"> 원</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
								입금일 : <input type="text" name="cha_1_date" id="cha_1_date" value="<?if($cont_row[charge_1_date]>0) echo $cont_row[charge_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('cha_1_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('cha_1_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="cha_1_who" value="<?=$cont_row[charge_1_who]?>" style="width:76px;" class="inputstyle2"></div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">업무대행비2</div>
							<div style="float:left; <?if($cont_sort2==1||$cont_sort3==3) {echo 'width:250px;';} else {echo 'width:170px;';}?> height:28px; padding:7px 0 0 10px;"><input type="text" name="cha_2" value="<?if($cont_row[charge_2]>0) echo $cont_row[charge_2];?>" class="inputstyle2"> 원</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
								입금일 : <input type="text" name="cha_2_date" id="cha_2_date" value="<?if($cont_row[charge_2_date]>0) echo $cont_row[charge_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('cha_2_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('cha_2_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="cha_2_who" value="<?=$cont_row[charge_2_who]?>" style="width:76px;" class="inputstyle2"></div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">업무대행비3</div>
							<div style="float:left; <?if($cont_sort2==1||$cont_sort3==3) {echo 'width:250px;';} else {echo 'width:170px;';}?> height:28px; padding:7px 0 0 10px;"><input type="text" name="cha_3" value="<?if($cont_row[charge_3]>0) echo $cont_row[charge_3];?>" class="inputstyle2"> 원</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
								입금일 : <input type="text" name="cha_3_date" id="cha_3_date" value="<?if($cont_row[charge_3_date]>0) echo $cont_row[charge_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('cha_3_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('cha_3_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="cha_3_who" value="<?=$cont_row[charge_3_who]?>" style="width:76px;" class="inputstyle2"></div>
						</div>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">업무대행비4</div>
							<div style="float:left; <?if($cont_sort2==1||$cont_sort3==3) {echo 'width:250px;';} else {echo 'width:170px;';}?> height:28px; padding:7px 0 0 10px;"><input type="text" name="cha_4" value="<?if($cont_row[charge_4]>0) echo $cont_row[charge_4];?>" class="inputstyle2"> 원</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
								입금일 : <input type="text" name="cha_4_date" id="cha_4_date" value="<?if($cont_row[charge_4_date]>0) echo $cont_row[charge_4_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('cha_4_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('cha_4_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="cha_4_who" value="<?=$cont_row[charge_4_who]?>" style="width:76px;" class="inputstyle2"></div>
						</div>

						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">MGM 지급대상</div>
							<div style="float:left; width:250px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mgm_to" value="<?=$cont_row[cont_mgm_who]?>" class="inputstyle2"></div>
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">MGM 지급금액 </div>
							<div style="float:left; padding:8px 20px 0 10px; ">
								<input type="text" name="mgm_sum"  value="<?=$cont_row[cont_mgm_sum]?>" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"> 원
							</div>
						</div>
						<? } ?>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">계약담당직원</div>
							<div style="float:left; width:190px; padding:8px 0px 0 10px;">소속본부 :
								<select name="headq" class="inputstyle2" style="height:22px; width:100px;">
									<option value="" selected> 선 택
									<?
										$where_add = " WHERE 1=1 ";
										if($pj_list) $where_add.=" AND pj_seq='$pj_list' ";
										$qry = "SELECT seq, headq FROM cms_resource_headq $where_add GROUP BY headq ORDER BY headq";
										$rlt = mysql_query($qry, $connect);
										while($row = mysql_fetch_array($rlt)){
									?>
									<option value="<?=$row[headq]?>" <?if($row[headq]==$worker_where[0]) echo "selected";?>><?=$row[headq]?>
									<? } ?>
								</select>
							</div>
							<div style="float:left; width:160px; padding:8px 0px 0 10px;">소속 팀 :
								<select name="team" class="inputstyle2" style="height:22px; width:100px;">
									<option value="" selected> 선 택
									<?
										$where_add = " WHERE 1=1 ";
										if($pj_list) $where_add.=" AND pj_seq='$pj_list' ";
										$qry = "SELECT seq, team FROM cms_resource_team $where_add GROUP BY team ORDER BY team";
										$rlt = mysql_query($qry, $connect);
										while($row = mysql_fetch_array($rlt)){
									?>
									<option value="<?=$row[team]?>" <?if($row[team]==$worker_where[1]) echo "selected";?>><?=$row[team]?>
									<? } ?>
								</select>
							</div>
							<div style="float:left; width:190px; padding:8px 0px 0 10px;">이 름 : <input type="text" name="worker" value="<?=$cont_row[cont_worker]?>" class="inputstyle2" style="width:102px;"></div>
						</div>
						<div style="height:115px; border-width:0 0 1px 0; border-style:solid; border-color:#B2BCDE;">
							<div style="float:left; width:105px; height:108px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">비 고</div>
							<div style="float:left; padding:8px 20px 0 10px; ">
								<textarea name="note" rows="5" cols="20" class="inputstyle2" style="height:80px; width:511px;"><?=$cont_row[note]?></textarea>
							</div>
						</div>
						<?if($cont_sort2==2||$cont_sort3==4){?>
						<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B2BCDE; padding:6px 0 6px 0;">
							<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">
								추가입력항목 -
							</div>
							<div style="float:left; width:926px; height:28px; padding-top:7px; margin-left:1px; background-color:#F4F4F4; color:#000000; text-align:center;">
								<input type="checkbox" name="de_2c" onclick="frm_view();"> 2차계약금
								<input type="checkbox" name="de_3c" onclick="frm_view();"> 3차계약금
								<input type="checkbox" name="de_4c" onclick="frm_view();"> 4차계약금
								<input type="checkbox" name="mp_1c" onclick="frm_view();"> 1차중도금
								<input type="checkbox" name="mp_2c" onclick="frm_view();"> 2차중도금
								<input type="checkbox" name="mp_3c" onclick="frm_view();"> 3차중도금
								<input type="checkbox" name="mp_4c" onclick="frm_view();"> 4차중도금
								<input type="checkbox" name="mp_5c" onclick="frm_view();"> 5차중도금
								<input type="checkbox" name="mp_6c" onclick="frm_view();"> 6차중도금
								<input type="checkbox" name="mp_7c" onclick="frm_view();"> 7차중도금
								<input type="checkbox" name="lp_c" onclick="frm_view();"> 잔 금
							</div>
						</div>
						<!-- 2차 계약금 시작 -->
						<div id="de_2" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">2차 계약금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_21" value="<?if($cont_row[deposit_2nd_1]>0) echo $cont_row[deposit_2nd_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_21_date" id="de_21_date" value="<?if($cont_row[deposit_2nd_1_date]>0) echo $cont_row[deposit_2nd_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_21_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_21_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_21_who" value="<?=$cont_row[deposit_2nd_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">2차 계약금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_22" value="<?if($cont_row[deposit_2nd_2]>0) echo $cont_row[deposit_2nd_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_22_date" id="de_22_date" value="<?if($cont_row[deposit_2nd_2_date]>0) echo $cont_row[deposit_2nd_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_22_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_22_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_22_who" value="<?=$cont_row[deposit_2nd_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">2차 계약금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_23" value="<?if($cont_row[deposit_2nd_3]>0) echo $cont_row[deposit_2nd_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_23_date" id="de_23_date" value="<?if($cont_row[deposit_2nd_3_date]>0) echo $cont_row[deposit_2nd_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_23_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_23_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_23_who" value="<?=$cont_row[deposit_2nd_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 2차 계약금 종료 -->

						<!-- 3차 계약금 시작 -->
						<div id="de_3" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">3차 계약금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_31" value="<?if($cont_row[deposit_3rd_1]>0) echo $cont_row[deposit_3rd_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_31_date" id="de_31_date" value="<?if($cont_row[deposit_3rd_1_date]>0) echo $cont_row[deposit_3rd_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_31_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_31_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_31_who" value="<?=$cont_row[deposit_3rd_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">3차 계약금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_32" value="<?if($cont_row[deposit_3rd_2]>0) echo $cont_row[deposit_3rd_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_32_date" id="de_32_date" value="<?if($cont_row[deposit_3rd_2_date]>0) echo $cont_row[deposit_3rd_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_32_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_32_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_32_who" value="<?=$cont_row[deposit_3rd_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">3차 계약금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_33" value="<?if($cont_row[deposit_3rd_3]>0) echo $cont_row[deposit_3rd_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_33_date" id="de_33_date" value="<?if($cont_row[deposit_3rd_3_date]>0) echo $cont_row[deposit_3rd_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_33_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_33_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_33_who" value="<?=$cont_row[deposit_3rd_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 3차 계약금 종료 -->

						<!-- 4차 계약금 시작 -->
						<div id="de_4" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">4차 계약금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_41" value="<?if($cont_row[deposit_4th_1]>0) echo $cont_row[deposit_4th_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_41_date" id="de_41_date" value="<?if($cont_row[deposit_4th_1_date]>0) echo $cont_row[deposit_4th_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_41_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_41_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_41_who" value="<?=$cont_row[deposit_4th_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">4차 계약금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_42" value="<?if($cont_row[deposit_4th_2]>0) echo $cont_row[deposit_4th_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_42_date" id="de_42_date" value="<?if($cont_row[deposit_4th_2_date]>0) echo $cont_row[deposit_4th_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_42_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_42_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_42_who" value="<?if($cont_row[deposit_4th_2_who]>0) echo $cont_row[deposit_4th_2_who];?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">4차 계약금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="de_43" value="<?if($cont_row[deposit_4th_3]>0) echo $cont_row[deposit_4th_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="de_43_date" id="de_43_date" value="<?if($cont_row[deposit_4th_3_date]>0) echo $cont_row[deposit_4th_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('de_43_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('de_43_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="de_43_who" value="<?=$cont_row[deposit_4th_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 4차 계약금 종료 -->

						<!-- 1차 중도금 시작 -->
						<div id="mp_1" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">1차 중도금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_11" value="<?if($cont_row[m_pay_1st_1]>0) echo $cont_row[m_pay_1st_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_11_date" id="mp_11_date" value="<?if($cont_row[m_pay_1st_1_date]>0) echo $cont_row[m_pay_1st_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_11_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_11_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_11_who" value="<?=$cont_row[m_pay_1st_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">1차 중도금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_12" value="<?if($cont_row[m_pay_1st_2]>0) echo $cont_row[m_pay_1st_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_12_date" id="mp_12_date" value="<?if($cont_row[m_pay_1st_2_date]>0) echo $cont_row[m_pay_1st_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_12_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_12_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_12_who" value="<?=$cont_row[m_pay_1st_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">1차 중도금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_13" value="<?if($cont_row[m_pay_1st_3]>0) echo $cont_row[m_pay_1st_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_13_date" id="mp_13_date" value="<?if($cont_row[m_pay_1st_3_date]>0) echo $cont_row[m_pay_1st_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_13_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_13_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_13_who" value="<?=$cont_row[m_pay_1st_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 1차 중도금 종료 -->

						<!-- 2차 중도금 시작 -->
						<div id="mp_2" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">2차 중도금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_21" value="<?if($cont_row[m_pay_2nd_1]>0) echo $cont_row[m_pay_2nd_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_21_date" id="mp_21_date" value="<?if($cont_row[m_pay_2nd_1_date]>0) echo $cont_row[m_pay_2nd_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_21_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_21_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_21_who" value="<?=$cont_row[m_pay_2nd_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">2차 중도금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_22" value="<?if($cont_row[m_pay_2nd_2]>0) echo $cont_row[m_pay_2nd_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_22_date" id="mp_22_date" value="<?if($cont_row[m_pay_2nd_2_date]>0) echo $cont_row[m_pay_2nd_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_22_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_22_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_22_who" value="<?=$cont_row[m_pay_2nd_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">2차 중도금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_23" value="<?if($cont_row[m_pay_2nd_3]>0) echo $cont_row[m_pay_2nd_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_23_date" id="mp_23_date" value="<?if($cont_row[m_pay_2nd_3_date]>0) echo $cont_row[m_pay_2nd_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_23_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_23_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_23_who" value="<?=$cont_row[m_pay_2nd_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 2차 중도금 종료 -->

						<!-- 3차 중도금 시작 -->
						<div id="mp_3" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">3차 중도금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_31" value="<?if($cont_row[m_pay_3rd_1]>0) echo $cont_row[m_pay_3rd_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_31_date" id="mp_31_date" value="<?if($cont_row[m_pay_3rd_1_date]>0) echo $cont_row[m_pay_3rd_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_31_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_31_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_31_who" value="<?=$cont_row[m_pay_3rd_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">3차 중도금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_32" value="<?if($cont_row[m_pay_3rd_2]>0) echo $cont_row[m_pay_3rd_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_32_date" id="mp_32_date" value="<?if($cont_row[m_pay_3rd_2_date]>0) echo $cont_row[m_pay_3rd_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_32_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_32_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_32_who" value="<?=$cont_row[m_pay_3rd_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">3차 중도금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_33" value="<?if($cont_row[m_pay_3rd_3]>0) echo $cont_row[m_pay_3rd_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_33_date" id="mp_33_date" value="<?if($cont_row[m_pay_3rd_3_date]>0) echo $cont_row[m_pay_3rd_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_33_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_33_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_33_who" value="<?=$cont_row[m_pay_3rd_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 3차 중도금 종료 -->

						<!-- 4차 중도금 시작 -->
						<div id="mp_4" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">4차 중도금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_41" value="<?if($cont_row[m_pay_4th_1]>0) echo $cont_row[m_pay_4th_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_41_date" id="mp_41_date" value="<?if($cont_row[m_pay_4th_1_date]>0) echo $cont_row[m_pay_4th_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_41_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_41_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_41_who" value="<?=$cont_row[m_pay_4th_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">4차 중도금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_42" value="<?if($cont_row[m_pay_4th_2]>0) echo $cont_row[m_pay_4th_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_42_date" id="mp_42_date" value="<?if($cont_row[m_pay_4th_2_date]>0) echo $cont_row[m_pay_4th_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_42_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_42_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_42_who" value="<?=$cont_row[m_pay_4th_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">4차 중도금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_43" value="<?if($cont_row[m_pay_4th_3]>0) echo $cont_row[m_pay_4th_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_43_date" id="mp_43_date" value="<?if($cont_row[m_pay_4th_3_date]>0) echo $cont_row[m_pay_4th_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_43_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_43_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_43_who" value="<?=$cont_row[m_pay_4th_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 4차 중도금 종료 -->

						<!-- 5차 중도금 시작 -->
						<div id="mp_5" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">5차 중도금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_51" value="<?if($cont_row[m_pay_5th_1]>0) echo $cont_row[m_pay_5th_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_51_date" id="mp_51_date" value="<?if($cont_row[m_pay_5th_1_date]>0) echo $cont_row[m_pay_5th_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_51_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_51_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_51_who" value="<?=$cont_row[m_pay_5th_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">5차 중도금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_52" value="<?if($cont_row[m_pay_5th_2]>0) echo $cont_row[m_pay_5th_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_52_date" id="mp_52_date" value="<?if($cont_row[m_pay_5th_2_date]>0) echo $cont_row[m_pay_5th_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_52_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_52_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_52_who" value="<?=$cont_row[m_pay_5th_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">5차 중도금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_53" value="<?if($cont_row[m_pay_5th_3]>0) echo $cont_row[m_pay_5th_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_53_date" id="mp_53_date" value="<?if($cont_row[m_pay_5th_3_date]>0) echo $cont_row[m_pay_5th_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_53_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_53_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_53_who" value="<?=$cont_row[m_pay_5th_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 5차 중도금 종료 -->

						<!-- 6차 중도금 시작 -->
						<div id="mp_6" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">6차 중도금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_61" value="<?if($cont_row[m_pay_6th_1]>0) echo $cont_row[m_pay_6th_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_61_date" id="mp_61_date" value="<?if($cont_row[m_pay_6th_1_date]>0) echo $cont_row[m_pay_6th_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_61_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_61_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_61_who" value="<?=$cont_row[m_pay_6th_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">6차 중도금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_62" value="<?if($cont_row[m_pay_6th_2]>0) echo $cont_row[m_pay_6th_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_62_date" id="mp_62_date" value="<?if($cont_row[m_pay_6th_2_date]>0) echo $cont_row[m_pay_6th_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_62_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_62_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_62_who" value="<?=$cont_row[m_pay_6th_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">6차 중도금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_63" value="<?if($cont_row[m_pay_6th_3]>0) echo $cont_row[m_pay_6th_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_63_date" id="mp_63_date" value="<?if($cont_row[m_pay_6th_3_date]>0) echo $cont_row[m_pay_6th_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_63_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_63_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_63_who" value="<?=$cont_row[m_pay_6th_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 6차 중도금 종료 -->

						<!-- 7차 중도금 시작 -->
						<div id="mp_7" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">7차 중도금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_71" value="<?if($cont_row[m_pay_7th_1]>0) echo $cont_row[m_pay_7th_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_71_date" id="mp_71_date" value="<?if($cont_row[m_pay_7th_1_date]>0) echo $cont_row[m_pay_7th_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_71_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_71_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_71_who" value="<?=$cont_row[m_pay_7th_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">7차 중도금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_72" value="<?if($cont_row[m_pay_7th_2]>0) echo $cont_row[m_pay_7th_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_72_date" id="mp_72_date" value="<?if($cont_row[m_pay_7th_2_date]>0) echo $cont_row[m_pay_7th_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_72_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_72_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_72_who" value="<?=$cont_row[m_pay_7th_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">7차 중도금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="mp_73" value="<?if($cont_row[m_pay_7th_3]>0) echo $cont_row[m_pay_7th_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="mp_73_date" id="mp_73_date" value="<?if($cont_row[m_pay_7th_3_date]>0) echo $cont_row[m_pay_7th_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('mp_73_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('mp_73_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="mp_73_who" value="<?=$cont_row[m_pay_7th_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 7차 중도금 종료 -->

						<!-- 잔 금 시작 -->
						<div id="lp" style="display:none;">
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6; padding-top:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">잔 금1</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="lp_1" value="<?if($cont_row[last_pay_1]>0) echo $cont_row[last_pay_1];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="lp_1_date" id="lp_1_date" value="<?if($cont_row[last_pay_1_date]>0) echo $cont_row[last_pay_1_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('lp_1_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('lp_1_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="lp_1_who" value="<?=$cont_row[last_pay_1_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#e6e6e6;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">잔 금2</div>
								<div style="float:left;width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="lp_2" value="<?if($cont_row[last_pay_2]>0) echo $cont_row[last_pay_2];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="lp_2_date" id="lp_2_date" value="<?if($cont_row[last_pay_2_date]>0) echo $cont_row[last_pay_2_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('lp_2_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('lp_2_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="lp_2_who" value="<?=$cont_row[last_pay_2_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
							<div style="height:35px; border-width:0 0 1px 0; border-style:solid; border-color:#B9B9B9; padding-bottom:6px;">
								<div style="float:left;  width:105px; height:28px; padding:7px 0 0 15px; background-color:#F4F4F4; color:#000000;">잔 금3</div>
								<div style="float:left; width:170px; height:28px; padding:7px 0 0 10px;"><input type="text" name="lp_3" value="<?if($cont_row[last_pay_3]>0) echo $cont_row[last_pay_3];?>" class="inputstyle2"> 원</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">
									입금일 : <input type="text" name="lp_3_date" id="lp_3_date" value="<?if($cont_row[last_pay_3_date]>0) echo $cont_row[last_pay_3_date];?>" style="width:90px;" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"><a href="javascript:" onclick="cal_add(document.getElementById('lp_3_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									<a href="javascript:" onclick=" to_del('lp_3_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
								</div>
								<div style="float:left; width:200px; height:28px; padding:7px 0 0 10px;">입금자 : <input type="text" name="lp_3_who" value="<?=$cont_row[last_pay_3_who]?>" style="width:76px;" class="inputstyle2"></div>
							</div>
						</div>
						<!-- 잔 금 종료 -->

						<?}?>

						<div class="form2" style="height:36px; padding:12px 20px 0 0; text-align:right;">
							<?
								if($_m1_2_2_row[_m1_2_2]<2){
									$submit_str="alert('등록 권한이 없습니다!')";
								}else{
									 $submit_str="cont_check(".$member_row[is_company].");";
								}
							?>
							<input type="button" value=" 등 록 하 기 " onclick="<?=$submit_str?>" class="submit_bt" style="height='28'">
						</div>
						</form>
						</td>
					</tr>
					</table>
					</div>
					<? } ?>