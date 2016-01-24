					<!-- ===== subject table end ===== -->


					<!-- ===== subject table end ===== -->
					<?
						$_m4_1_1_rlt = mysql_query("select _m4_1_1 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m4_1_1_row = mysql_fetch_array($_m4_1_1_rlt);

						if(!$_m4_1_1_row[_m4_1_1]||$_m4_1_1_row[_m4_1_1]==0){
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
							<!-- <a href="javascript:" onClick="excel_pop(<?=$ca_1_2_row[ca_1_2]?>,2);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL 출력</a> -->
						</div>
						<?
							$mode=$_REQUEST['mode']; // ???
							$new_pj=$_REQUEST['new_pj']; // 신규 프로젝트 ??
							$reg_pj=$_REQUEST['reg_pj']; // 등록 프로젝트 ??
						?>
						<form method="post" name="pj_data_reg" action="<?$_SERVER['PHP_SELF']?>">
						<input type="hidden" name="mode">
						<div style="height:35px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid;">
							<div style="float:left; height:28px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">
								계 약 년 도
							</div>
							<div style="float:left; height:28px; padding:7px 20px 0 10px;">
								<select name="year_frm" onchange="submit();" class="inputstyle2" style="height:22px; width:100px;"> <!-- =================== pj_data_reg - 1 - year_frm =================== -->
									<option value="1"> 전 체
									<?
										// if(!$year_frm) $year_frm=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
										$year=range(date('Y')-4,date('Y'));
										for($i=(count($year)-1); $i>=0; $i--){
									?>
									<option value="<?=$year[$i]?>" <?if($year_frm==$year[$i]) echo "selected"; ?>><?=$year[$i]."년"?>
									<? } ?>
								</select>
							</div>
							<div style="float:left; height:28px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">
								미 등록 프로젝트 [<font color="#0000cc">신규등록</font>]
							</div>
							<div style="float:left; height:28px; padding:6px 20px 0 10px;">
								<select name="new_pj" onchange="select_ch('reg');" class="inputstyle2" style="height:22px; width:170px;"> <!-- =================== pj_data_reg - 2 - new_pj =================== -->
									<option value=""<?if(!$new_pj) echo "selected"?>> 선 택
									<?
										$where="WHERE is_data_reg = '0' ";
										if($year_frm>1){
											$where.=" AND start_date LIKE '$year_frm%' ";
										}
										$qry = "SELECT * FROM cms_project1_info $where ORDER BY start_date DESC ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($new_pj==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
									<? } ?>
								</select>
							</div>
							<div style="float:left; height:28px; background-color:#F8F8F8; padding:7px 20px 0 20px; color:black;">
								기 등록 프로젝트 [<font color="#cc6666">데이터수정</font>]
							</div>
							<div style="float:left; height:28px; padding:7px 20px 0 30px;">
								<select name="reg_pj" onchange="select_ch('modify');" class="inputstyle2" style="height:22px; width:170px;"> <!-- =================== pj_data_reg - 3 - reg_pj =================== -->
									<option value="" <?if(!$reg_pj) echo "selected"?>> 선 택
									<?
										$where="WHERE is_data_reg = '1' ";
										if($year_frm>1){
											$where.=" AND start_date LIKE '$year_frm%' ";
										}
										$qry = "SELECT * FROM cms_project1_info $where ORDER BY start_date DESC ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[seq]?>" <?if($reg_pj==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
									<? } ?>
								</select>
							</div>
						</div>
						</form><!-- ==================================================================== pj_data_reg - end ==================================================================== -->

						<form name="form1" method="post" action="progress_post.php"><!-- 메인폼(form1) 시작 -->
						<input type="hidden" name="mode" value="<?=$mode?>">
						<?
							if($new_pj) $pre_pj_seq = $new_pj; // 신규 등록인지
							if($reg_pj) $pre_pj_seq = $reg_pj; // 등록 수정인지
							$p_qry = "SELECT pj_name, sort, data_cr, type_name FROM cms_project1_info WHERE seq = '$pre_pj_seq' ";
							$p_rlt = mysql_query($p_qry, $connect);
							$p_row = mysql_fetch_array($p_rlt);
							if($p_row[sort]==1) $sort="아파트(일반분양)";
							if($p_row[sort]==2) $sort="아파트(조합)";
							if($p_row[sort]==3) $sort="주상복합(아파트)";
							if($p_row[sort]==4) $sort="주상복합(오피스텔)";
							if($p_row[sort]==5) $sort="도시형생활주택";
							if($p_row[sort]==6) $sort="근린생활시설";
							if($p_row[sort]==7) $sort="레저(숙박)시설";
							if($p_row[sort]==8) $sort="기 타";

							$type=explode("-", $p_row[type_name]);
							$t_count=count($type);
							if($p_row[pj_name]) $pj_name ="<font color='#000099'>".$p_row[pj_name]."</font>";
							if($sort) $pj_sort = "<font color='#000099'>".$sort."</font>";
						?>
						<input type="hidden" name="pj_seq" value="<?=$pre_pj_seq?>">
						<input type="hidden" name="pj_sort" value="<?=$p_row[sort]?>">
						<div style="height:32px; border-width:1px 0 1px 0;border-color:#cccccc; border-style:solid; margin-top:18px;">
							<div style="float:left; height:27px; width:150px; background-color:#f4f4f4; padding-top:5px; text-align:center">
								현 장 명 :
							</div>
							<div style="float:left; height:27px; width:200px; padding:5px 0 0 15px; ">
								<?=$pj_name?>
							</div>
							<div style="float:left; height:27px; width:150px; background-color:#f4f4f4; padding-top:5px; text-align:center">
								프로젝트 종류 :
							</div>
							<div style="float:left; height:27px; width:200px; padding:5px 0 0 15px; ">
								<?=$pj_sort?>
							</div>
							<?
								if($reg_pj){ // 등록 수정이면
							?>
							<div style="float:right; height:27px; width:120px; padding:5px 0 0 15px; ">
								<input type="button" value="재 등록하기" onclick="data_move('re_reg','<?=$reg_pj?>');" class="inputstyle_bt" style="height:22px;">
							</div>
							<? } ?>
						</div>

						<!------------------------------------동호수 별 입력 시작--------------------------------------------->

						<!-- 등록 마감 된 기 등록 데이터 수정일 때는 안보임 시작 -->
							<div style="height:22px; padding:8px 0 0 8px;">
								<font color="#cc0000">*</font> 라인(동) 별 정보 등록
							</div>
							<?
								// 현재 몇동 몇라인 만 표시 쿼리 // 향후 미니멈 몇층부터 맥시멈 몇층까지 해당라인에 등록된 데이타 몇개 까지 표시할 것
								$chk_qry = "SELECT dong, ho FROM cms_project2_indi_table, cms_project1_info WHERE pj_seq = '$pre_pj_seq' AND pj_seq = cms_project1_info.seq AND is_data_reg != 1 ORDER BY reg_time DESC";
								$chk_rlt = mysql_query($chk_qry, $connect);
								$chk_row = mysql_fetch_array($chk_rlt);
								$total_n = mysql_num_rows($chk_rlt);
								$line = substr($chk_row[ho], -2, 2);
								if($chk_row){
							?>

							<div style="height:22px; padding:8px 0 0 8px;">
								<div style="float:left;">
									최근 등록 정보 : <font color="#cc0000"><?=$chk_row[dong]?>동 <?=$line?>호 라인 (총 <?=$total_n?> 세대 등록)</font>
								</div>
								<div style="float:left; padding-left:15px;">
									<input type="button" value="등록마감" onclick="data_move('end','<?=$new_pj?>');" class="inputstyle_bt" style="height:22px; padding-bottom:3px;">
								</div>
								<div style="float:left; padding-left:15px;">
									( 해당 프로젝트에 대한 데이터를 모두 등록한 후에 등록마감 처리하여 주십시요! )
								</div>
							</div>
							<? } ?>

							<div style="height:32px; border-width:1px 0 1px 0;border-color:#cccccc; border-style:solid; margin-top:5px; background-color:#F0F0E8;">
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									동 등록
								</div>
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									라인 등록
								</div>
								<div style="float:left; height:27px; width:200px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									타입 (Type) 등록
								</div>
								<div style="float:left; height:27px; width:353px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									층 등록 (등록 라인에 해당하는 층 등록)
								</div>
								<div style="float:left; height:27px; width:130px; padding-top:5px; text-align:center; border-width:0 0 0 0; border-color:#cccccc; border-style:solid;">
									기분양(제외) 세대
								</div>
							</div>

							<!-- =============================================== line batch 1 start ================================================ -->
							<div style="height:32px; border-width:0 0 1px 0;border-color:#cccccc; border-style:solid;">
								<div style="float:left; height:27px; width:160px; padding:5px 0 0 20px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="dong_1" class="inputstyle2" size="5"> 동 <input type="checkbox" name="dong_ik" onclick="dong_reg_bc(this);"> 일괄등록
								</div>
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="line_1" class="inputstyle2" size="5"> 호 라인
								</div>
								<div style="float:left; height:27px; width:200px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<select name="type_1" style="width:60px;">
										<option value="" selected> 선택
										<?
											if($p_row[type_name]){
												for($i=0; $i<$t_count; $i++){
										?>
										<option value="<?=$type[$i]?>"> <?=$type[$i]?>
										<? }} ?>
									</select>  TYPE
								</div>
								<div style="float:left; height:27px; width:340px; padding:5px 0 0 13px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="text" name="min_floor_1" class="inputstyle2" size="5"> 층 부터 ~ <input type="text" name="max_floor_1" class="inputstyle2" size="5"> 층 (일괄 등록)
								</div>
								<div style="float:left; height:27px; width:130px; padding-top:5px; border-width:0 0 0 0; border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="checkbox" name="except_batch_1">
								</div>
							</div>
							<!-- =============================================== line batch 1 end ================================================ -->
							<!-- =============================================== line batch 2 start ================================================ -->
							<div style="height:32px; border-width:0 0 1px 0;border-color:#cccccc; border-style:solid;">
								<div style="float:left; height:27px; width:160px; padding:5px 0 0 20px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="dong_2" class="inputstyle2" size="5"> 동
								</div>
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="line_2" class="inputstyle2" size="5"> 호 라인
								</div>
								<div style="float:left; height:27px; width:200px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<select name="type_2" style="width:60px;">
										<option value="" selected> 선택
										<?
											if($p_row[type_name]){
												for($i=0; $i<$t_count; $i++){
										?>
										<option value="<?=$type[$i]?>"> <?=$type[$i]?>
										<? }} ?>
									</select>  TYPE
								</div>
								<div style="float:left; height:27px; width:340px; padding:5px 0 0 13px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="text" name="min_floor_2" class="inputstyle2" size="5"> 층 부터 ~ <input type="text" name="max_floor_2" class="inputstyle2" size="5"> 층 (일괄 등록)
								</div>
								<div style="float:left; height:27px; width:130px; padding-top:5px; border-width:0 0 0 0; border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="checkbox" name="except_batch_2">
								</div>
							</div>
							<!-- =============================================== line batch 2 end ================================================ -->
							<!-- =============================================== line batch 3 start ================================================ -->
							<div style="height:32px; border-width:0 0 1px 0;border-color:#cccccc; border-style:solid;">
								<div style="float:left; height:27px; width:160px; padding:5px 0 0 20px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="dong_3" class="inputstyle2" size="5"> 동
								</div>
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="line_3" class="inputstyle2" size="5"> 호 라인
								</div>
								<div style="float:left; height:27px; width:200px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<select name="type_3" style="width:60px;">
										<option value="" selected> 선택
										<?
											if($p_row[type_name]){
												for($i=0; $i<$t_count; $i++){
										?>
										<option value="<?=$type[$i]?>"> <?=$type[$i]?>
										<? }} ?>
									</select>  TYPE
								</div>
								<div style="float:left; height:27px; width:340px; padding:5px 0 0 13px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="text" name="min_floor_3" class="inputstyle2" size="5"> 층 부터 ~ <input type="text" name="max_floor_3" class="inputstyle2" size="5"> 층 (일괄 등록)
								</div>
								<div style="float:left; height:27px; width:130px; padding-top:5px; border-width:0 0 0 0; border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="checkbox" name="except_batch_3">
								</div>
							</div>
							<!-- =============================================== line batch 3 end ================================================ -->
							<!-- =============================================== line batch 4 start ================================================ -->
							<div style="height:32px; border-width:0 0 1px 0;border-color:#cccccc; border-style:solid;">
								<div style="float:left; height:27px; width:160px; padding:5px 0 0 20px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="dong_4" class="inputstyle2" size="5"> 동
								</div>
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="line_4" class="inputstyle2" size="5"> 호 라인
								</div>
								<div style="float:left; height:27px; width:200px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<select name="type_4" style="width:60px;">
										<option value="" selected> 선택
										<?
											if($p_row[type_name]){
												for($i=0; $i<$t_count; $i++){
										?>
										<option value="<?=$type[$i]?>"> <?=$type[$i]?>
										<? }} ?>
									</select>  TYPE
								</div>
								<div style="float:left; height:27px; width:340px; padding:5px 0 0 13px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="text" name="min_floor_4" class="inputstyle2" size="5"> 층 부터 ~ <input type="text" name="max_floor_4" class="inputstyle2" size="5"> 층 (일괄 등록)
								</div>
								<div style="float:left; height:27px; width:130px; padding-top:5px; border-width:0 0 0 0; border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="checkbox" name="except_batch_4">
								</div>
							</div>
							<!-- =============================================== line batch 4 end ================================================ -->
							<!-- =============================================== line batch 5 start ================================================ -->
							<div style="height:32px; border-width:0 0 1px 0;border-color:#cccccc; border-style:solid;">
								<div style="float:left; height:27px; width:160px; padding:5px 0 0 20px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="dong_5" class="inputstyle2" size="5"> 동
								</div>
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="line_5" class="inputstyle2" size="5"> 호 라인
								</div>
								<div style="float:left; height:27px; width:200px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<select name="type_5" style="width:60px;">
										<option value="" selected> 선택
										<?
											if($p_row[type_name]){
												for($i=0; $i<$t_count; $i++){
										?>
										<option value="<?=$type[$i]?>"> <?=$type[$i]?>
										<? }} ?>
									</select>  TYPE
								</div>
								<div style="float:left; height:27px; width:340px; padding:5px 0 0 13px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="text" name="min_floor_5" class="inputstyle2" size="5"> 층 부터 ~ <input type="text" name="max_floor_5" class="inputstyle2" size="5"> 층 (일괄 등록)
								</div>
								<div style="float:left; height:27px; width:130px; padding-top:5px; border-width:0 0 0 0; border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="checkbox" name="except_batch_5">
								</div>
							</div>
							<!-- =============================================== line batch 5 end ================================================ -->
							<!-- =============================================== line batch 6 start ================================================ -->
							<div style="height:32px; border-width:0 0 1px 0;border-color:#cccccc; border-style:solid;">
								<div style="float:left; height:27px; width:160px; padding:5px 0 0 20px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="dong_6" class="inputstyle2" size="5"> 동
								</div>
								<div style="float:left; height:27px; width:180px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<input type="text" name="line_6" class="inputstyle2" size="5"> 호 라인
								</div>
								<div style="float:left; height:27px; width:200px; padding-top:5px; text-align:center; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid;">
									<select name="type_6" style="width:60px;">
										<option value="" selected> 선택
										<?
											if($p_row[type_name]){
												for($i=0; $i<$t_count; $i++){
										?>
										<option value="<?=$type[$i]?>"> <?=$type[$i]?>
										<? }} ?>
									</select>  TYPE
								</div>
								<div style="float:left; height:27px; width:340px; padding:5px 0 0 13px; border-width:0 1px 0 0;border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="text" name="min_floor_6" class="inputstyle2" size="5"> 층 부터 ~ <input type="text" name="max_floor_6" class="inputstyle2" size="5"> 층 (일괄 등록)
								</div>
								<div style="float:left; height:27px; width:130px; padding-top:5px; border-width:0 0 0 0; border-color:#cccccc; border-style:solid; text-align:center;">
									<input type="checkbox" name="except_batch_6">
								</div>
							</div>
							<!-- =============================================== line batch 6 end ================================================ -->

							<div style="height:60px; padding-top:15px; text-align:center; color:#3e3e3e; line-height:180%;">
								각 동의 <font color="#cc0000">1개 라인별로 정보를 입력</font> 하십시요! 공급가격 정보가 다른 층 (예를 들어 1,2층의 공급가격이 기준층과 다른 경우) 은 층별로 <br>
								개별 등록하고 같은 라인의 기준층과 같이 타입이나 공급가격이 동일한 호수의 경우 최저층부터 최고층까지 일괄등록 할 수 있습니다.<br>
								(<font color="#7A7A7A">단, 이 경우 1, 2층을 개별 등록하였다면, 3층부터 입력하여야 중복이 되지 않으며 3층부터 15층까지로 설정하였다면 해당 구간의 모든 층이 등록됩니다.</font>)
							</div>
							<?
								if($_m4_1_1_row[_m4_1_1]<2){
									$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
								}else{
									$submit_str="pj_data_put_0()";
								}
							?>
							<div style="height:48px; padding-top:23px; text-align:center;">
								<input type="button" value="데이터 입력" onclick="<?=$submit_str?>" class="submit_bt">
							</div>
						<?								
							}
						?>
						<!-- 등록 마감 된 기 등록 데이터 수정일 때는 안보임 끝 -->
						</form>
						<!------------------------------------동호수 별 입력 종료------------------------------------------//--->
						
						<!--------------------------동호수별 데이터 시작-------------------------//-->
						<?
							$new_pj = $_REQUEST['new_pj'];
							$reg_pj = $_REQUEST['reg_pj'];

							if($new_pj||$reg_pj||$pj_seq){
								$type_data_ = $_REQUEST['type_data_'];
								$dong_data_ = $_REQUEST['dong_data_'];
								$reg_ad = $_REQUEST['reg_ad'];
								$dong_ad = $_REQUEST['dong_ad'];
								$ho_ad = $_REQUEST['ho_ad'];
								$limit = $_REQUEST['limit'];

								if($new_pj) $pj_seq = $new_pj;
								if($reg_pj) $pj_seq = $reg_pj;
						?>
						<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
							<input type="hidden" name="new_pj" value="<?=$new_pj?>">
							<input type="hidden" name="reg_pj" value="<?=$reg_pj?>">
							<div style="height:28px; margin-top:15px; padding:3px 10px 0 0;">
							<div style="float:right; width:60px; text-align:right;">
								<input type="button" value=" 검 색 " class="inputstyle_bt" onclick="submit()">
							</div>
							<div style="float:right; width:220px; text-align:center;">
								<b>호수별 (</b>오름차순 <input type="radio" value="1" name="ho_ad" id="ho_ad_" onclick="ad_control('2');" <?if($ho_ad==1) echo "checked";?>>	내림차순 <input type="radio" name="ho_ad" id="ho_ad_" value="2" onclick="ad_control('2');" <?if($ho_ad==2) echo "checked";?>><b>)</b>
							</div>
							<div style="float:right; width:220px; text-align:center;">
								<b>동별 (</b>오름차순 <input type="radio" value="1" name="dong_ad" id="dong_ad_" onclick="ad_control('2');" <?if($dong_ad==1) echo "checked";?>> 내림차순 <input type="radio" value="2" name="dong_ad" id="dong_ad_" onclick="ad_control('2');" <?if($dong_ad==2) echo "checked";?>><b>)</b>
							</div>
							<div style="float:right; width:180px; text-align:center;">
								<b>표시 개수</b><b>(</b>30개 <input type="radio" value="1" name="limit" <?if(!$limit||$limit==1) echo "checked";?>> 전체 <input type="radio" value="2" name="limit" <?if($limit==2) echo "checked";?>><b>)</b>
							</div>
							<div style="float:right; width:70px; text-align:center;">
								<b>등록순</b> <input type="checkbox" name="reg_ad" id="reg_ad_" value="1" onclick="ad_control('1');" <?if($reg_ad==1||(!$reg_ad&&(!$dong_ad&&!$ho_ad))) echo "checked"?>>
							</div>
							<div style="float:right; padding-right:20px;">
								<select name="dong_data_" style="width:70px;">
									<option value="" selected> 선 택
									<?
										if(!$type_data_||$type_data_==0) {
											$type_sel_qry = "";
										} else {
											$type_sel_qry = " AND type = '$type_data_' ";
										}
										$query = "SELECT dong FROM cms_project2_indi_table WHERE pj_seq = '$pj_seq' $type_sel_qry GROUP BY dong";
										$result = mysql_query($query, $connect);
										while($rows = mysql_fetch_array($result)){
									?>
									<option value="<?=$rows[dong]?>" <?if($dong_data_==$rows[dong]) echo "selected";?>> <?=$rows[dong]?>
									<? } ?>
								</select>
							</div>
							<div style="float:right; padding:0 10px; 0 15px;">
								<b>동 별</b> :
							</div>
							<div style="float:right; padding-right:10px;">
								<select name="type_data_" style="width:70px;" onchange="submit();">
									<option value="" <?if(!$type_data_) echo "selected";?>> 선 택
									<?
										$query = "SELECT type FROM cms_project2_indi_table WHERE pj_seq = '$pj_seq' GROUP BY type ORDER BY type";
										$result = mysql_query($query, $connect);
										while($rows = mysql_fetch_array($result)){
									?>
									<option value="<?=$rows[type]?>" <?if($type_data_==$rows[type]) echo "selected";?>> <?=$rows[type]?>
									<? } ?>
								</select>
							</div>
							<div style="float:right; padding-right:10px;">
								<b>타입별</b> :
							</div>
						</div>
						<div style="height:26px; border-width:1px 0 1px; border-color:#ccc; border-style:solid; background-color:#f4f4f4;" class="form2">
							<div style="float:left; height:24px; width:100px; text-align:center; padding-top:2px;">
								동
							</div>
							<div style="float:left; height:24px; width:100px; text-align:center; padding-top:2px;">
								호 수
							</div>
							<div style="float:left; height:24px; width:150px; text-align:center; padding-top:2px;">
								타입 (TYPE)
							</div>
							<div style="float:left; height:24px; width:150px; text-align:center; padding-top:2px;">
								구 분
							</div>
							<div style="float:left; height:24px; width:250px; text-align:center; padding-top:2px;">
								공 급 가
							</div>
							<div style="float:left; height:24px; width:165px; text-align:center; padding-top:2px;">
								수 수 료 (세대당 / VAT별도)
							</div>
							<div style="float:left; height:24px; width:60px; text-align:center; padding-top:2px; text-align:center;">
								수 정
							</div>
							<div style="float:left; height:24px; width:60px; text-align:center; padding-top:2px; text-align:center;">
								삭 제
							</div>
						</div>
						</form>
						<?
							$where = " WHERE pj_seq ='$pj_seq' ";
							if($type_data_) $where.= " AND type = '$type_data_' ";
							if($dong_data_) $where.= " AND dong = '$dong_data_' ";

							if(!$dong_ad&&!$ho_ad&&!$reg_ad) $priority = " ORDER BY reg_time DESC ";
							if($reg_ad){
								$priority = " ORDER BY reg_time DESC ";
								if($dong_ad==1) $priority .= " , dong ";
								if($dong_ad==2) $priority .= " , dong DESC ";
								if($ho_ad==1) $priority .= " , ho ";
								if($ho_ad==2) $priority .= " , ho DESC ";
							}else{
								if($dong_ad&&$ho_ad){
									if($dong_ad==1) $priority = " ORDER BY dong ASC ";
									if($dong_ad==2) $priority = " ORDER BY dong DESC ";
									if($ho_ad==1) $priority .= " , ho ASC ";
									if($ho_ad==2) $priority .= " , ho DESC ";
								}else{
									if($dong_ad==1) $priority = " ORDER BY dong ASC ";
									if($dong_ad==2) $priority = " ORDER BY dong DESC ";
									if($ho_ad==1) $priority = " ORDER BY ho ASC ";
									if($ho_ad==2) $priority = " ORDER BY ho DESC ";
								}
							}
							if(!$limit||$limit==1) $limit_q = " LIMIT 30 ";
							if($limit==2) $limit_q = "";

							$query = "SELECT seq, type, dong, ho FROM cms_project2_indi_table $where $priority $limit_q";
							$result = mysql_query($query, $connect);
							while($rows = mysql_fetch_array($result)){
								if($rows[is_except]==1) $except_str = "<font color='#939593'>기분양 세대</font>"; else $except_str = "<font color='#000033'>분양대상 세대</font>";
						?>
						<div style="height:26px;" class="form2">
							<div style="float:left; height:24px; width:62px; text-align:left; padding:2px 0 0 38px;">
								<?=$rows[dong]." 동"?>
							</div>
							<div style="float:left; height:24px; width:78px; text-align:right; padding:2px 22px 0 0;">
								<?=$rows[ho]." 호"?>
							</div>
							<div style="float:left; height:24px; width:150px; text-align:center; padding-top:2px;">
								<?=$rows[type]." TYPE"?>
							</div>
							<div style="float:left; height:24px; width:150px; text-align:center; padding-top:2px;">
								<?=$except_str?>
							</div>
							<div style="float:left; height:24px; width:200px; text-align:right; padding:2px 50px 0 0;">
								<?=number_format($rows[price_ho]*1000)." 원"?>
							</div>
							<div style="float:left; height:24px; width:155px; text-align:center; padding:2px 10px 0 0; text-align:right;">
								<?=number_format($rows[pay_ho]*1000)." 원"?>
							</div>
							<div style="float:left; height:24px; width:60px; text-align:center; padding-top:2px; text-align:center;">
								<? if($_m4_1_1_row[_m4_1_1]<2){?><a href="javascript:" onclick="alert('등록 권한이 없습니다.')">수 정</a>
								<?}else{?>
								<a href="javascript:" onclick="popUp('progress1_edit.php?data=<?=$rows[seq]?>&info=<?=$pj_seq?>','progress1_edit')">수 정</a>
								<? } ?>
							</div>
							<div style="float:left; height:24px; width:60px; text-align:center; padding-top:2px; text-align:center;">
								<? if($_m4_1_1_row[_m4_1_1]<2){?><a href="javascript:" onclick="alert('삭제 권한이 없습니다.')">삭 제</a>
								<?}else{?>
								<a href="javascript:" onclick="alert('준비중 입니다.');">삭 제</a>
								<? } ?>
							</div>
						</div>
						<? } ?>
						<!--------------------------동호수별 데이터 종료------------------------- -->
						</td>
					</tr>
					</table>
					</div>
					<? } ?>