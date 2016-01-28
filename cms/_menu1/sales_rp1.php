					<!-- ============================= subject table end ============================= -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 현장별 계약현황</font></b>
						<div style="float:right;">
							<!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. -->
						</div>
					</div>
					<!-- ============================= subject table end ============================= -->
					<?
						$_m1_1_1_rlt = mysql_query("select _m1_1_1 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m1_1_1_row = mysql_fetch_array($_m1_1_1_rlt);

						if(!$_m1_1_1_row[_m1_1_1]||$_m1_1_1_row[_m1_1_1]==0){ // 이 페이지 조회 권한 없을 때
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
					<?
						}else{
							$auth_qry = "SELECT * FROM cms_member_table WHERE user_id='$_SESSION[p_id]' ";
							$auth_rlt = mysql_query($auth_qry, $connect);
							$auth_row= mysql_fetch_array($auth_rlt);

							// 이 페이지 쓰기 권한 설정하기
							$auth_level=2; // 이페이지 마스터 쓰기 권한 레벨

							if($auth_row[is_admin]==1){ $w_auth =2; }else if($_m1_1_1_row[_m1_1_1]==2){ if($auth_row[auth_level]<=$auth_level){ $w_auth =2; }else{ $w_auth =1;}}else{	$w_auth =0;}
							// w_auth = 0 > 쓰기 권한 없음 // w_auth = 1 > 실무자 쓰기 권한 // w_auth = 2 > 마스터 쓰기 권한
					?>
					<div style="display:inline;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td height="580" valign="top">
						<form method="post" action="<?=$_SERVER['PHP_SELF']?>"><!-- ==================================== 폼 시작 ===================================== -->
						<input type="hidden" name="m_di" value="<?=$m_di?>">
						<input type="hidden" name="s_di" value="<?=$s_di?>">
						<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;">
							<!-- <a href="javascript:" onClick="excel_pop('<?=$_m1_1_1_row[_m1_1_1]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
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
						<?
							if(!$pj_list){ $pj_list=$member_row[pj_seq];} // 프로젝트 리스트의 값 [현장 seq 넘버] 가 없으면, 즉 현장 관계자일 때는 담당 현장 프로젝트 seq 넘버 설정
							$pos_con_= $_REQUEST['pos_con_'];       /// 청약 계약 미계약 구분
							$type_data_ =  $_REQUEST['type_data_']; /// 타입
							$dong_data_ =  $_REQUEST['dong_data_']; /// 동
							$diff_data_ =  $_REQUEST['diff_data_']; /// 차수
							$list_limit = $_REQUEST['list_limit'];  /// 한 페이지 표시개수
							$s_date = $_REQUEST['s_date'];  // 검색 시작일
							$e_date = $_REQUEST['e_date'];  // 검색 종료일
						?>
						<div style="height:28px; margin-top:15px; padding:3px 15px 0 0; border-width:0 0 1px 0; border-color:#ccc; border-style:solid;">
							<div style="float:left; padding-left:10px;">
								<span style="background-color:#6666cc; padding:3px 10px 3px 10px;"><b><font color="#ffffff">1. 요 약</font></b></span>
							</div>
						</div>
						<?
							if(!$pj_list){
						?>
						<div style="height:50px; text-align:center; padding-top:30px;">
							조회할 프로젝트를 선택하여 주십시요!
						</div>
						<? }else{?>
						<div style="height:24px; border-width:0 0 1px 0; border-color:#ccc; border-style:solid; background-color:#F4F4F4; padding-top:4px; text-align:center;">
							<div style="float:left; width:200px;">프로젝트명</div>
							<div style="float:left; width:100px;">타 입</div>
							<div style="float:left; width:75px;">공급구분</div>
							<div style="float:left; width:75px;">차 수</div>
							<div style="float:left; width:100px;">전체세대수</div>
							<div style="float:left; width:100px;">분양세대수</div>
							<div style="float:left; width:95px;">청약 건수</div>
							<div style="float:left; width:100px;">계약 건수</div>
							<div style="float:left; width:100px;">계 약 율</div>
							<div style="float:left; width:100px;">분양율(청약+계약)</div>
						</div>
						<?
							$result=mysql_query("SELECT pj_name, data_cr,type_name, type_color FROM cms_project1_info WHERE seq='$pj_list' ", $connect);
							$row=mysql_fetch_array($result);
							$data_cr = $row[data_cr];
							$type_name = explode("-", $row[type_name]);
							$type_color = explode("-", $row[type_color]);

							///////////////////////////////////////////////////////////////////////
							for($i=0; $i<count($type_name); $i++){
								$color[$type_name[$i]]=$type_color[$i];
							}
							///////////////////////////////////////////////////////////////////////
						?>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="border-width:0 1px 1px 0;" class="form3"><div style="float:left; width:199px; height:24px; padding-top:4px;text-align:center;"><?=$row[pj_name]?></div></td>
							<td>
								<div style="float:left;">

								<?
									$query = "SELECT type_ho FROM cms_project_data WHERE pj_seq = '$pj_list' GROUP BY type_ho ORDER BY type_ho";
									$result = mysql_query($query, $connect);
									while($rows = mysql_fetch_array($result)){
								?>
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td style="border-width:0 1px 1px 0;" class="form3"><div style="float:left; width:61px; height:24px; padding:4px 0 0 38px; text-align:left;"><span style="padding:0 5px 0 5px;  background-color:<?=$color[$rows[type_ho]]?>; margin-right:10px;">&nbsp;</span><?=$rows[type_ho]?></div></td>
									<td>
								<?
										$sort_qry = "SELECT sa_sort FROM cms_project_data WHERE pj_seq = '$pj_list' AND type_ho = '$rows[type_ho]' GROUP BY sa_sort ORDER BY sa_sort";
										$sort_rlt = mysql_query($sort_qry, $connect);
										while($sort_rows = mysql_fetch_array($sort_rlt)){
											if($sort_rows[sa_sort]==0) $sort = "조합";
											if($sort_rows[sa_sort]==1) $sort = "<font color='0000ff'>일반</font>";
								?>
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="border-width:0 1px 1px 0;" class="form3"><div style="float:left; width:74px; height:24px; padding-top:4px; text-align:center;"><?=$sort?></div></td>
										<td>
								<?
											$diff_qry = "SELECT diff_no FROM cms_project_data WHERE pj_seq = '$pj_list' AND sa_sort = '$sort_rows[sa_sort]' GROUP BY diff_no ORDER BY diff_no";
											$diff_rlt = mysql_query($diff_qry, $connect);

											while($diff_rows = mysql_fetch_array($diff_rlt)){
												$sub_qry = "SELECT COUNT(*) AS sedae, SUM(is_except) AS is_except, SUM(is_pro_cont) AS pro_cont, SUM(is_contract) AS contract
														FROM cms_project_data
														WHERE pj_seq = '$pj_list' AND type_ho = '$rows[type_ho]' AND sa_sort = '$sort_rows[sa_sort]' AND diff_no = '$diff_rows[diff_no]' ";
												$sub_rlt = mysql_query($sub_qry, $connect);
												$sub_row = mysql_fetch_array($sub_rlt);

												$sale_num = $sub_row[sedae]-$sub_row[is_except];
												if($sale_num==0){
													$rate_con = 0; // 타입별 계약율
													$rete_plus = 0; //타입별 분양율
												}else{
													$rate_con = $sub_row[contract]/$sale_num*100; // 타입별 계약율
													$rete_plus = ($sub_row[pro_cont]+$sub_row[contract])/$sale_num*100; //타입별 분양율
												}
								?>
										<div style="height:28px; text-align:right;">
											<div style="float:left; width:74px; height:24px; padding-top:4px; text-align:center;" class="form3"><?=$diff_rows[diff_no]."차"?></div>
											<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0;" class="form3"><?=number_format($sub_row[sedae])."세대"?></div>
											<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; background-color:#ecf2ff; color:#003366;" class="form3"><?=number_format($sale_num)."세대"?></div>
											<div style="float:left; width:74px; height:24px; padding:4px 20px 0 0;" class="form3"><?=number_format($sub_row[pro_cont])."건"?></div>
											<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0;" class="form3"><?=number_format($sub_row[contract])."건"?></div>
											<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0;" class="form3"><?=number_format($rate_con, 2)."%"?></div>
											<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; border-width:0 0 1px 0;" class="form3"><?=number_format($rete_plus, 2)."%"?></div>
										</div>
								<?	 }?></td><tr></table><?}?></td></tr></table><?}?>
								</div>
							</td>
						</tr>
						</table>
						<?
							$tot_qry = "SELECT COUNT(*) AS sedae, SUM(is_except) AS is_except, SUM(is_pro_cont) AS pro_con, SUM(is_contract) AS contract
											FROM cms_project_data WHERE pj_seq = '$pj_list' ";
							$tot_rlt = mysql_query($tot_qry, $connect);
							$tot_row = mysql_fetch_array($tot_rlt);
							$tot_sale_num = $tot_row[sedae]-$tot_row[is_except];
							if($tot_row[pro_con]==0) $rate_pro=0; else $rate_pro= $tot_row[pro_con]/$tot_sale_num*100;          // 총 청약수
							if($tot_row[contract]==0) $rate_con=0; else $rate_con= $tot_row[contract]/$tot_sale_num*100;         // 총 계약수
						?>
						<div style="clear:left; height:28px; text-align:right; background-color:#f8f8f8;">
							<div style="float:left; width:199px; height:24px; padding-top:4px; border-width:0 1px 0 0; text-align:center;" class="form3">합 계</div>
							<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; border-width:0 1px 0 0; color:#003366;" class="form3"></div>
							<div style="float:left; width:54px; height:24px; padding:4px 20px 0 0;" class="form3"></div>
							<div style="float:left; width:54px; height:24px; padding:4px 20px 0 0;" class="form3"></div>
							<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; border-width:0 1px 0 0; color:#003366;" class="form3"><?=$tot_row[sedae]."세대"?></div>
							<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; border-width:0 1px 0 0; color:#003366;" class="form3"><?=$tot_sale_num."세대"?></div>
							<div style="float:left; width:74px; height:24px; padding:4px 20px 0 0; border-width:0 1px 0 0; color:#003366;" class="form3"><?=$tot_row[pro_con]."건"?></div>
							<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; border-width:0 1px 0 0; color:#003366;" class="form3"><?=$tot_row[contract]."건"?></div>
							<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; border-width:0 1px 0 0; color:#003366;" class="form3"><?=number_format($rate_con,2)."%"?></div>
							<div style="float:left; width:79px; height:24px; padding:4px 20px 0 0; color:#003366;"><?=number_format($rate_pro+$rate_con,2)."%"?></div>
						</div>
						<? } ?>
						<div style="height:28px; padding:18px 0 0 0; border-width:1px 0 0 0; border-color:#ccc; border-style:solid;">
							<div style="float:left; padding-left:10px;">
								<span style="background-color:#993366; padding:3px 10px 3px 10px;"><b><font color="#ffffff">2. 계약현황</font></b></span>
							</div>
							<?
								$where = " WHERE pj_seq = '$pj_list' ";
								if($type_data_) $where.= " AND type_ho = '$type_data_' ";
								if($dong_data_) $where.= " AND pj_dong = '$dong_data_' ";
								if($diff_data_) $where.= " AND diff_no = '$diff_data_' ";

								if($pos_con_==1) $where.=" AND (is_pro_cont = '0' AND is_contract ='0') "; // 미계약인 경우
								if(!$pos_con_||$pos_con_==2) { // 청약+계약인 경우
									$where.=" AND (is_pro_cont = '1' OR is_contract = '1') ";
									if($s_date) $where.=" AND (pro_cont_date>='$s_date' OR cont_date>='$s_date') ";
									if($e_date) $where.=" AND (pro_cont_date<='$e_date' OR cont_date<='$e_date') ";
								}
								if($pos_con_==3) { // 청약만인 경우
									$where.=" AND (is_pro_cont = '1' AND is_contract ='0') ";
									if($s_date) $where.=" AND pro_cont_date>='$s_date' ";
									if($e_date) $where.=" AND pro_cont_date<='$e_date' ";
								}
								if($pos_con_==4) { // 계약만인 경우
									$where.=" AND (is_pro_cont = '0' AND is_contract ='1') ";
									if($s_date) $where.=" AND cont_date>='$s_date' ";
									if($e_date) $where.=" AND cont_date<='$e_date' ";
								}

								if($pos_con_=='all') $where.=""; // 선택이 없거나 전체 선택인 경우
								if(!$pos_con_||$pos_con_=='all'||$pos_con_==1){ // 선택이 없거나 전체 선택이나 미계약인 경우
									if($data_cr==0){ // 동호수별 관리
										$orderby = ' pj_dong, pj_ho ';
									}else{ // 계약번호별 관리
										$orderby = ' con_no ';
									}
								}else{
									if($data_cr==0){ // 동호수별 관리
										$orderby=' cont_date DESC, pro_cont_date DESC, pj_dong DESC, pj_ho DESC ';
									}else{ // 계약번호별 관리
										$orderby=' con_no DESC, cont_date DESC, pro_cont_date DESC ';
									}
								}
								if($list_limit=='all') {
									$limit_qry = "";
								} else if(!$list_limit){
									$limit_qry = " LIMIT 30 ";
								}else{
									$limit_qry = " LIMIT $list_limit ";
								}
								$query1 = "SELECT * FROM cms_project_data $where ORDER BY $orderby $limit_qry ";

								$result1 = mysql_query($query1, $connect);
								$data_num=mysql_num_rows($result1);

								/////////////////////////////////////////////////EXCEL 출력 소스
								if($_m1_1_1_row[_m1_1_1]<1){
									$excel_pop = "alert('출력 권한이 없습니다!');";
								}else{
									$url_where = urlencode($where);
									$excel_pop = "location.href='excel_contract_list.php?pj_seq=$pj_list&amp;data_cr=$data_cr&amp;where=$url_where&amp;limit=$limit_qry' ";
									//$excel_pop = "alert('파일 준비중!');";
								}
								///////////////////////////////////////////////////////////////////
							?>
							<div style="float:right; padding-right:10px;">
								<a href="javascript:" onClick="<?=$excel_pop?>"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL 출력</a>
							</div>
							<div style="float:right; padding-right:10px;">
								<input type="button" value=" 검 색 " onclick="submit();" class="inputstyle_bt">
							</div>
							<div style="float:right; padding-right:10px;">

								<input type="text" name="e_date" id="e_date" value="<?=$e_date?>" size="10" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
								<a href="javascript:" onclick="cal_add(document.getElementById('e_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								<a href="javascript:" onclick=" to_del('s_date', 'e_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a>
							</div>
							<div style="float:right; padding-right:5px;">
								<input type="text" name="s_date" id="s_date" value="<?=$s_date?>" size="10" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
								<a href="javascript:" onclick="cal_add(document.getElementById('s_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a> ~
							</div>
							<div style="float:right; padding-right:10px;">
								<select name="pos_con_" style="width:70px;">
									<option value="all" <?if($pos_con_=='all') echo 'selected';?>> 전 체
									<option value="1" <?if($pos_con_==1) echo 'selected';?>> 미계약
									<option value="2" <?if(!$pos_con_||$pos_con_==2) echo 'selected';?>> 청약+계약
									<option value="3" <?if($pos_con_==3) echo 'selected';?>> 청 약
									<option value="4" <?if($pos_con_==4) echo 'selected';?>> 계 약
								</select>
							</div>
							<div style="float:right; padding:0 10px; 0 10px;">
								<b>계약여부</b> :
							</div>
							<?if($data_cr==0){ // 동호수 관리프로젝트?>
							<div style="float:right;">
								<select name="dong_data_" style="width:70px;">
									<option value="" selected> 선 택
									<?
										if(!$type_data_||$type_data_==0) {
											$type_sel_qry = "";
										} else {
											$type_sel_qry = " AND type_ho = '$type_data_' ";
										}
										$query = "SELECT pj_dong FROM cms_project_data WHERE pj_seq = '$pj_list' $type_sel_qry GROUP BY pj_dong";
										$result = mysql_query($query, $connect) or die (mysql_error());
										while($rows = mysql_fetch_array($result)){
									?>
									<option value="<?=$rows[pj_dong]?>" <?if($dong_data_==$rows[pj_dong]) echo "selected";?>> <?=$rows[pj_dong]?>
									<? } ?>
								</select>
							</div>
							<div style="float:right; padding:0 10px; 0 15px;">
								<b>동 별</b> :
							</div>
							<?}else if($data_cr==1){ // 계약번호별 관리프로젝트?>
							<div style="float:right;">
								<select name="diff_data_" style="width:70px;">
									<option value="" selected> 선 택
									<?
										if(!$diff_data_||$diff_data_==0) {
											$type_sel_qry = "";
										} else {
											$type_sel_qry = " AND type_ho = '$type_data_' ";
										}
										$query = "SELECT diff_no FROM cms_project_data WHERE pj_seq = '$pj_list' $type_sel_qry GROUP BY diff_no";
										$result = mysql_query($query, $connect) or die (mysql_error());
										while($rows = mysql_fetch_array($result)){
									?>
									<option value="<?=$rows[diff_no]?>" <?if($diff_data_==$rows[diff_no]) echo "selected";?>> <?=$rows[diff_no]."차"?>
									<? } ?>
								</select>
							</div>
							<div style="float:right; padding:0 10px; 0 15px;">
								<b>차수별</b> :
							</div>
							<?}?>
							<div style="float:right;">
								<select name="type_data_" style="width:70px;" onchange="submit();">
									<option value="" selected> 선 택
									<?
										$query = "SELECT type_ho FROM cms_project_data WHERE pj_seq = '$pj_list' GROUP BY type_ho ORDER BY type_ho";
										$result = mysql_query($query, $connect);
										while($rows = mysql_fetch_array($result)){
									?>
									<option value="<?=$rows[type_ho]?>" <?if($type_data_==$rows[type_ho]) echo "selected";?>> <?=$rows[type_ho]?>
									<? } ?>
								</select>
							</div>

							<div style="float:right; padding-right:10px;">
								<b>타입별</b> :
							</div>
							<div style="float:right; padding-right:10px;">
								<select name="list_limit" style="width:70px;" onchange="submit();">
									<option value="all" <?if($list_limit=='all') echo 'selected';?>> 전 체
									<option value="30"  <?if(!$list_limit||$list_limit=='30')echo 'selected';?>>30 개
									<option value="50" <?if($list_limit=='50') echo "selected";?>>50 개
									<option value="100" <?if($list_limit=='100') echo 'selected';?>>100 개
								</select>
							</div>
							<div style="float:right; padding-right:10px;">
								<b>표시</b> :
							</div>
						</div>
						<!-------디브 스크롤 스타트-----//-->
						<div style="overflow-x:auto; width:1048px;">
							<div style="text-align:center; padding-top:8px; height:25px; background-color:#f4f4f4; border-width:1px 0 1px 0;  border-color:#ccc; border-style:solid; <?if($data_cr==0) echo "width:1048px;"; else echo "width:12930px;";?>">
							<?
								if($data_cr==0){ // 동호수 관리프로젝트///
							?>
								<div style="float:left; width:41px;">동</div>
								<div style="float:left; width:46px;">호수</div>
								<div style="float:left; width:41px;">타입</div>
								<div style="float:left; width:56px;">계약자</div>
								<div style="float:left; width:91px;">연락처1</div>
								<div style="float:left; width:91px;">연락처2</div>
								<div style="float:left; width:81px;">청약(해지)일</div>
								<div style="float:left; width:81px;">청약금</div>
								<div style="float:left; width:81px;">계약 예정일</div>
								<div style="float:left; width:81px;">계약일</div>
								<div style="float:left; width:86px;">계약금</div>
								<div style="float:left; width:153px;">MGM</div>
								<div style="float:left; width:88px;">담당자</div>
							<?
								}else if($data_cr==1){ // 계약관리번호 관리프로젝트
								$cash_qry = "SELECT SUM(charge_1) AS cha_1, SUM(charge_2) AS cha_2, SUM(charge_3) AS cha_3, SUM(charge_4) AS cha_4,
																   SUM(deposit_1st_1) AS de_11, SUM(deposit_1st_2) AS de_12, SUM(deposit_1st_3) AS de_13,
																   SUM(deposit_2nd_1) AS de_21, SUM(deposit_2nd_2) AS de_22, SUM(deposit_2nd_3) AS de_23,
																   SUM(deposit_3rd_1) AS de_31, SUM(deposit_3rd_2) AS de_32, SUM(deposit_3rd_3) AS de_33,
																   SUM(deposit_4th_1) AS de_41, SUM(deposit_4th_2) AS de_42, SUM(deposit_4th_3) AS de_43,
																   SUM(m_pay_1st_1) AS mp_11, SUM(m_pay_1st_2) AS mp_12, SUM(m_pay_1st_3) AS mp_13,
																   SUM(m_pay_2nd_1) AS mp_21, SUM(m_pay_2nd_2) AS mp_22, SUM(m_pay_2nd_3) AS mp_23,
																   SUM(m_pay_3rd_1) AS mp_31, SUM(m_pay_3rd_2) AS mp_32, SUM(m_pay_3rd_3) AS mp_33,
																   SUM(m_pay_4th_1) AS mp_41, SUM(m_pay_4th_2) AS mp_42, SUM(m_pay_4th_3) AS mp_43,
																   SUM(m_pay_5th_1) AS mp_51, SUM(m_pay_5th_2) AS mp_52, SUM(m_pay_5th_3) AS mp_53,
																   SUM(m_pay_6th_1) AS mp_61, SUM(m_pay_6th_2) AS mp_62, SUM(m_pay_6th_3) AS mp_63,
																   SUM(m_pay_7th_1) AS mp_71, SUM(m_pay_7th_2) AS mp_72, SUM(m_pay_7th_3) AS mp_73,
																   SUM(last_pay_1) AS lp_1, SUM(last_pay_2) AS lp_2, SUM(last_pay_3) AS lp_3
																   FROM cms_project_data WHERE pj_seq = '$pj_list' ";

								$cash_rlt = mysql_query($cash_qry, $connect);
								$cash_row = mysql_fetch_array($cash_rlt);

								$charge_total = $cash_row[cha_1]+$cash_row[cha_2]+$cash_row[cha_3]+$cash_row[cha_4];
								$pay_total = $cash_row[de_11]+$cash_row[de_12]+$cash_row[de_13]+$cash_row[de_21]+$cash_row[de_22]+$cash_row[de_23]+$cash_row[de_31]+$cash_row[de_32]+$cash_row[de_33]+$cash_row[mp_11]+$cash_row[mp_21]+$cash_row[mp_31]+$cash_row[mp_21]+$cash_row[mp_22]+$cash_row[mp_23]+$cash_row[mp_31]+$cash_row[mp_32]+$cash_row[mp_33]+$cash_row[mp_41]+$cash_row[mp_42]+$cash_row[mp_43]+$cash_row[mp_51]+$cash_row[mp_52]+$cash_row[mp_53]+$cash_row[mp_61]+$cash_row[mp_62]+$cash_row[mp_63]+$cash_row[mp_71]+$cash_row[mp_72]+$cash_row[mp_73]+$cash_row[lp_1]+$cash_row[lp_2]+$cash_row[lp_3];
							?>
								<div style="float:left; width:81px;">계약관리번호</div>
								<div style="float:left; width:46px;">타입</div>
								<div style="float:left; width:41px;">구분</div>
								<div style="float:left; width:41px;">차수</div>
								<div style="float:left; width:41px;">동</div>
								<div style="float:left; width:46px;">호수</div>
								<div style="float:left; width:150px;">비 고 [특이사항]</div>
								<div style="float:left; width:90px; cursor:pointer;" title="<?="업무대행비 총계 : ".number_format($charge_total)."원"?>">업무대행비</div>
								<div style="float:left; width:90px; cursor:pointer;" title="<?="납부분담금 총계 : ".number_format($pay_total)."원"?>">납부분담금</div>

								<div style="float:left; width:55px;">청약</div>
								<div style="float:left; width:81px;">청약(해지)일</div>
								<div style="float:left; width:56px;">청약자</div>
								<div style="float:left; width:91px;">연락처1</div>
								<div style="float:left; width:91px;">연락처2</div>
								<div style="float:left; width:81px;">청약금</div>
								<div style="float:left; width:81px;">계약 예정일</div>
								<div style="float:left; width:55px;">해지</div>
								<div style="float:left; width:55px;">환불</div>
								<div style="float:left; width:55px;">계약</div>

								<div style="float:left; width:81px;">계약일</div>
								<div style="float:left; width:56px;">계약자</div>
								<div style="float:left; width:91px;">연락처1</div>
								<div style="float:left; width:91px;">연락처2</div>
								<div style="float:left; width:291px;">주민등록 주소</div>
								<div style="float:left; width:291px;">우편발송 주소</div>

								<div style="float:left; width:38px;">9종</div>
								<div style="float:left; width:38px;">주등</div>
								<div style="float:left; width:38px;">주초</div>
								<div style="float:left; width:38px;">가증</div>
								<div style="float:left; width:38px;">인증</div>
								<div style="float:left; width:38px;">막도</div>
								<div style="float:left; width:38px;">신분</div>
								<div style="float:left; width:38px;">배주</div>

								<div style="float:left; width:86px;">업무대행비1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">업무대행비2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">업무대행비3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>
								<div style="float:left; width:86px;">업무대행비4</div>
								<div style="float:left; width:81px;">입금일4</div>
								<div style="float:left; width:56px;">입금자4</div>

								<div style="float:left; width:90px;">1차계약금</div>
								<div style="float:left; width:86px;">1차계약금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">1차계약금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">1차계약금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:153px;">MGM</div>
								<div style="float:left; width:88px;">담당자</div>

								<div style="float:left; width:90px;">2차계약금</div>
								<div style="float:left; width:86px;">2차계약금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">2차계약금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">2차계약금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">3차계약금</div>
								<div style="float:left; width:86px;">3차계약금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">3차계약금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">3차계약금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">4차계약금</div>
								<div style="float:left; width:86px;">4차계약금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">4차계약금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">4차계약금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">1차중도금</div>
								<div style="float:left; width:86px;">1차중도금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">1차중도금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">1차중도금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">2차중도금</div>
								<div style="float:left; width:86px;">2차중도금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">2차중도금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">2차중도금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">3차중도금</div>
								<div style="float:left; width:86px;">3차중도금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">3차중도금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">3차중도금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">4차중도금</div>
								<div style="float:left; width:86px;">4차중도금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">4차중도금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">4차중도금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">5차중도금</div>
								<div style="float:left; width:86px;">5차중도금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">5차중도금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">5차중도금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">6차중도금</div>
								<div style="float:left; width:86px;">6차중도금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">6차중도금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">6차중도금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">7차중도금</div>
								<div style="float:left; width:86px;">7차중도금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">7차중도금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">7차중도금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>

								<div style="float:left; width:90px;">잔금</div>
								<div style="float:left; width:86px;">잔금1</div>
								<div style="float:left; width:81px;">입금일1</div>
								<div style="float:left; width:56px;">입금자1</div>
								<div style="float:left; width:86px;">잔금2</div>
								<div style="float:left; width:81px;">입금일2</div>
								<div style="float:left; width:56px;">입금자2</div>
								<div style="float:left; width:86px;">잔금3</div>
								<div style="float:left; width:81px;">입금일3</div>
								<div style="float:left; width:56px;">입금자3</div>
								<div style="float:left; width:56px;">등록자</div>
								<div style="float:left; width:100px;">등록일시</div>
							<? } ?>
							</div>
							<?
								if($data_num==0){
							?>
							<div style="clear:left; height:180px; text-align:center; padding-top:70px;">
								등록된 해당 데이터가 없습니다.
							</div>
							<?
								}
								if($data_cr==0){ // 동호수 관리프로젝트 //////////////////////////////////////////////////////////////////////////////////////////
									for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
										if($rows1[is_except]==1) { // 기분양 세대인 경우
											$bgcolor=" background-color:#d1d1d1; ";
										}else if($rows1[is_contract]==1) { // 계약상태 물건인 경우
											$bgcolor=" background-color:#ffdd77; ";
											$cont_sort2=2;
										}else if($rows1[is_pro_cont]==1){ // 청약상태 물건인 경우
											$bgcolor=" background-color:#ffffb5; ";
											$cont_sort2=1;
										}else if($rows1[cancel]==1&&$rows1[refund]==0){ // 해지건인 경우
											$bgcolor=" background-color:#EBEBEB; ";
										}else{ // 미계약 상태인 경우
											$bgcolor="";
										}
										$w_where = explode("-", $rows1[worker_where]);
							?>
							<div style="clear:left; height:24px; text-align:center; <?=$bgcolor?>">
								<div style="clear:left; float:left; width:40px; height:22px; padding-top:2px; background-color:<?=$color[$rows1[type_ho]]?>;" class="form3"><?=$rows1[pj_dong]?> <!-- 동 --></div>
								<div style="float:left; width:45px; height:22px; padding-top:2px;  background-color:<?=$color[$rows1[type_ho]]?>;" class="form3"><?=$rows1[pj_ho]?> <!-- 호 --></div>
								<div style="float:left; width:40px; height:22px; padding-top:2px;  background-color:<?=$color[$rows1[type_ho]]?>;" class="form3"><?=$rows1[type_ho]?> <!-- 타입 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?if($rows1[is_except]==1) echo "기분양분"; if($rows1[is_contract]==1) echo $rows1[contractor]; else echo $rows1[pro_contractor];?><!-- 계약자 --></div>
								<div style="float:left; width:90px; height:22px; padding-top:2px;" class="form3"><?if($rows1[is_contract]==1) echo $rows1[cont_tel_1]; else echo $rows1[pro_cont_tel_1];?><!-- 연락처1 --></div>
								<div style="float:left; width:90px; height:22px; padding-top:2px;" class="form3"><?if($rows1[is_contract]==1) echo $rows1[cont_tel_2]; else echo $rows1[pro_cont_tel_2];?><!-- 연락처2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[pro_cont_date]>0)echo $rows1[pro_cont_date];?><!-- 청약일 --></div>
								<div style="float:left; width:70px; height:22px; padding-top:2px; text-align:right; padding-right:10px;" class="form3"><?if($rows1[pro_draufgabe]>0)echo number_format($rows1[pro_draufgabe]);?><!-- 청약금 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[pro_due_date]>0)echo $rows1[pro_due_date];?><!-- 계약 예정일 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[cont_date]>0)echo $rows1[cont_date];?><!-- 계약일 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[draufgabe]>0)echo number_format($rows1[draufgabe]);?><!--계약금 --></div>
								<div style="float:left; width:79px; height:22px; padding-top:2px;" class="form3"><?="<a href='#;' title='$rows1[cont_mgm_tel]'>".$rows1[cont_mgm_who]."</a>"?><!-- MGM to --></div>
								<div style="float:left; width:65px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[cont_mgm_sum]) echo number_format($rows1[cont_mgm_sum])?><!-- MGM sum --></div>
								<div style="float:left; width:29px; height:22px; padding-top:2px;" class="form3"><?=$w_where[1]?><!-- 소속 --></div>
								<div style="float:left; width:54px; height:22px; padding-top:2px;" class="form3"><?=$rows1[cont_worker]?><!-- 담당자 --></div>
								<?if($w_auth>0){?>
								<div style="float:left; width:30px; height:22px; padding-top:2px; border-width:0 0 1px 0; border-style=solid;" class="form3">
									<?if($w_auth>1||($w_auth>0&&date('Y-m-d')==$rows1[cont_date])) { //관리자와 마스터 쓰기권한이 아니면 당일건에 대해서만 수정 가능 ?>
									<a href="work_main.php?m_di=2&amp;s_di=2&amp;pj_list=<?=$pj_list?>&amp;type=<?=$rows1[type_ho]?>&amp;dong=<?=$rows1[pj_dong]?>&amp;ho=<?=$rows1[pj_ho]?>&amp;mode=modi&amp;cont_sort2=<?=$cont_sort2?>">
									<?}else{?><a href="javascript:" onclick="alert('관리자가 아니면 당일 건에 대해서만 수정 가능합니다.\n\n수정 문의 : <?=$admin_tel?>');"><? } ?>수정</a><!-- 수정 -->
								</div>
								<? } ?>
							</div>
							<?		}
								}else if($data_cr==1){ // 계약관리번호 관리프로젝트 /////////////////////////////////////////////////////////////////////////////

									for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
										if($rows1[is_except]==1) { // 기분양 세대인 경우
											$bgcolor=" background-color:#d1d1d1; ";
										}else if($rows1[is_contract]==1) { // 계약상태 물건인 경우
											$bgcolor=" background-color:#ffdd77; ";
											$cont_sort2=2;
										}else if($rows1[is_pro_cont]==1&&$rows1[cancel]==0){ // 청약상태 물건인 경우
											$bgcolor=" background-color:#ffffb5; ";
											$cont_sort2=1;
										}else if($rows1[cancel]==1&&$rows1[refund]==0){ // 해지건인 경우
											$bgcolor=" background-color:#EBEBEB; ";
										}else{ // 미계약 상태인 경우
											$bgcolor="";
										}
										$w_where = explode("-", $rows1[worker_where]);

										$id_ad = explode(":", $rows1[cont_id_addr]);
										$dm_ad = explode(":", $rows1[cont_dm_addr]);

										$id_addr = $id_ad[0]."-".$id_ad[1]."&nbsp;&nbsp;&nbsp;".$id_ad[2]." ".$id_ad[3];
										$dm_addr = $dm_ad[0]."-".$dm_ad[1]."&nbsp;&nbsp;&nbsp;".$dm_ad[2]." ".$dm_ad[3];


										$charge = number_format($rows1[charge_1]+$rows1[charge_2]+$rows1[charge_3]+$rows1[charge_4]); // 업무대행비 합계
										$deposit_1st = $rows1[deposit_1st_1]+$rows1[deposit_1st_2]+$rows1[deposit_1st_3]; // 1차 계약금 합계
										$deposit_2nd = $rows1[deposit_2nd_1]+$rows1[deposit_2nd_2]+$rows1[deposit_2nd_3]; // 2차 계약금 합계
										$deposit_3rd = $rows1[deposit_3rd_1]+$rows1[deposit_3rd_2]+$rows1[deposit_3rd_3]; // 3차 계약금 합계
										$deposit_4th = $rows1[deposit_4th_1]+$rows1[deposit_4th_2]+$rows1[deposit_4th_3];   // 4차 계약금 합계

										$m_pay_1st = $rows1[m_pay_1st_1]+$rows1[m_pay_1st_2]+$rows1[m_pay_1st_3];   // 1차 중도금 합계
										$m_pay_2nd = $rows1[m_pay_2nd_1]+$rows1[m_pay_2nd_2]+$rows1[m_pay_2nd_3];   // 2차 중도금 합계
										$m_pay_3rd = $rows1[m_pay_3rd_1]+$rows1[m_pay_3rd_2]+$rows1[m_pay_3rd_3];   // 3차 중도금 합계
										$m_pay_4th = $rows1[m_pay_4th_1]+$rows1[m_pay_4th_2]+$rows1[m_pay_4th_3];   // 4차 중도금 합계
										$m_pay_5th = $rows1[m_pay_5th_1]+$rows1[m_pay_5th_2]+$rows1[m_pay_5th_3];   // 5차 중도금 합계
										$m_pay_6th = $rows1[m_pay_6th_1]+$rows1[m_pay_6th_2]+$rows1[m_pay_6th_3];   // 6차 중도금 합계
										$m_pay_7th = $rows1[m_pay_7th_1]+$rows1[m_pay_7th_2]+$rows1[m_pay_7th_3];   // 7차 중도금 합계

										$last_pay = $rows1[last_pay_1]+$rows1[last_pay_2]+$rows1[last_pay_3]; // 잔금 합계
										$total_pay = number_format($deposit_1st+$deposit_2nd+$deposit_3rd+$deposit_4th+$m_pay_1st+$m_pay_2nd+$m_pay_3rd+$m_pay_4th+$m_pay_5th+$m_pay_6th+$m_pay_7th+$last_pay); // 분담금 총 합계
							?>
							<div style="clear:left; height:24px; width:12930px; text-align:center; <?=$bgcolor?>">
								<div style="clear:left; float:left; width:80px; height:22px; padding-top:2px; background-color:<?=$color[$rows1[type_ho]]?>;" class="form3">
									<?if($w_auth>0) { //관리(쓰기)권한이 있는 경우에만 수정 가능 ?>
									<a href="work_main.php?m_di=2&amp;s_di=2&amp;pj_list=<?=$pj_list?>&amp;type=<?=$rows1[type_ho]?>&amp;con_no=<?=$rows1[con_no]?>&amp;mode=modi&amp;cont_sort2=<?=$cont_sort2?>" title="<?=$rows1[con_no].'번 수정등록'?>">
									<? } ?>
									<? echo $rows1[con_no]; if($w_auth>0) {echo "</a>";}?> <!-- 계약관리번호 -->
								</div>
								<div style="float:left; width:46px; height:22px; padding-top:2px;  background-color:<?=$color[$rows1[type_ho]]?>;" class="form3"><?=$rows1[type_ho]?> <!-- 타입 --></div>
								<div style="float:left; width:40px; height:22px; padding-top:2px;" class="form3"><?if($rows1[sa_sort]==0){echo "조합";}else{echo "<font color='0000cc'>일반</font>";}?> <!-- 조합/일반 구분 --></div>
								<div style="float:left; width:40px; height:22px; padding-top:2px;" class="form3"><?=$rows1[diff_no]."차"?> <!-- 차수 --></div>
								<div style="float:left; width:40px; height:22px; padding-top:2px;" class="form3"><?if($rows1[pj_dong]) echo $rows1[pj_dong];?> <!-- 동 --></div>
								<div style="float:left; width:45px; height:22px; padding-top:2px;" class="form3"><?if($rows1[pj_ho]<>0) echo $rows1[pj_ho];?> <!-- 호 --></div>
								<div style="float:left; width:139px; height:22px; padding:2px 5px 0 5px; text-align:left; cursor:pointer;" class="form3" title="<?=$rows1[note]?>"><?=rg_cut_string($rows1[note],11,"...")?> <!-- 비 고 --></div>
								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($charge==0){echo "-";}else{echo $charge;}?><!--업무대행비 합계 --></div>
								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($total_pay==0){echo "-";}else{echo $total_pay;}?><!--납부분담금 합계 --></div>
								<div style="float:left; width:54px; height:22px; padding-top:2px;" class="form3"><?if($rows1[is_pro_cont]==1&&$rows1[cancel]==0) echo "청약";?><!-- 청약신청 여부 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[pro_cont_date]>0)echo $rows1[pro_cont_date];?><!-- 청약일 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[pro_contractor];?><!-- 청약자 --></div>
								<div style="float:left; width:90px; height:22px; padding-top:2px;" class="form3"><?=$rows1[pro_cont_tel_1];?><!-- 청약자 연락처1 --></div>
								<div style="float:left; width:90px; height:22px; padding-top:2px;" class="form3"><?=$rows1[pro_cont_tel_2];?><!--청약자  연락처2 --></div>
								<div style="float:left; width:70px; height:22px; padding-top:2px; text-align:right; padding-right:10px;" class="form3"><?if($rows1[pro_deposit]>0)echo number_format($rows1[pro_deposit]);?><!-- 청약금 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[pro_due_date]>0)echo $rows1[pro_due_date];?><!-- 계약 예정일 --></div>
								<div style="float:left; width:54px; height:22px; padding-top:2px;" class="form3"><?if($rows1[cancel]==1) echo "해지";?><!-- 해지신청 여부 --></div>
								<div style="float:left; width:54px; height:22px; padding-top:2px;" class="form3"><?if($rows1[refund]==1) echo "환불";?><!-- 환불완료 여부 --></div>
								<div style="float:left; width:54px; height:22px; padding-top:2px;" class="form3"><?if($rows1[is_contract]==1) echo "계약";?><!-- 계약체결 여부 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[cont_date]>0) echo $rows1[cont_date]?><!-- 계약일 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[contractor];?><!-- 계약자 --></div>
								<div style="float:left; width:90px; height:22px; padding-top:2px;" class="form3"><?=$rows1[cont_tel_1];?><!-- 계약자 연락처1 --></div>
								<div style="float:left; width:90px; height:22px; padding-top:2px;" class="form3"><?=$rows1[cont_tel_2];?><!--계약자  연락처2 --></div>
								<div style="float:left; width:280px; height:22px; padding:2px 5px 0 5px; text-align:left; cursor:pointer;" class="form3" title="<?=$id_addr?>"><?if(strlen($rows1[cont_id_addr])<6) echo ''; else echo rg_cut_string($id_addr,45,"...");?><!-- 주민등록 주소1 --></div>
								<div style="float:left; width:280px; height:22px; padding:2px 5px 0 5px; text-align:left; cursor:pointer;" class="form3" title="<?=$dm_addr?>"><?if(strlen($rows1[cont_dm_addr])<6) echo ''; else echo rg_cut_string($dm_addr,45,"...");?><!--우편발송 주소2 --></div>

								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_1]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_1]==0) {echo "완료";}else{echo "미비";}}?><!-- 10종 --></div>
								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_2]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_2]==0) {echo "완료";}else{echo "미비";}}?><!--주등 --></div>
								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_3]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_3]==0) {echo "완료";}else{echo "미비";}}?><!-- 주초 --></div>
								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_4]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_4]==0) {echo "완료";}else{echo "미비";}}?><!--가증 --></div>
								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_5]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_5]==0) {echo "완료";}else{echo "미비";}}?><!-- 인증 --></div>
								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_6]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_6]==0) {echo "완료";}else{echo "미비";}}?><!--막도 --></div>
								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_7]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_7]==0) {echo "완료";}else{echo "미비";}}?><!-- 신분 --></div>
								<div style="float:left; width:37px; height:22px; padding-top:2px; <?if($rows1[doc_8]==1) echo 'color:red;'?>" class="form3"><?if($rows1[is_contract]==1){if($rows1[doc_8]==0) {echo "완료";}else{echo "미비";}}?><!--배주 --></div>

								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[charge_1]>0) echo number_format($rows1[charge_1]);?><!--업무대행비 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[charge_1_date]>0) echo $rows1[charge_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[charge_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[charge_2]>0) echo number_format($rows1[charge_2]);?><!--업무대행비 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[charge_2_date]>0) echo $rows1[charge_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[charge_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[charge_3]>0) echo number_format($rows1[charge_3]);?><!--업무대행비 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[charge_3_date]>0) echo $rows1[charge_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[charge_3_who]?><!-- 입금자 3 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[charge_4]>0) echo number_format($rows1[charge_4]);?><!--업무대행비 4 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[charge_4_date]>0) echo $rows1[charge_4_date];?><!-- 입금일 4 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[charge_4_who]?><!-- 입금자 4 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($deposit_1st==0) echo "-"; else echo number_format($deposit_1st);?><!--1차 계약금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_1st_1]>0) echo number_format($rows1[deposit_1st_1]);?><!--1차 계약금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_1st_1_date]>0) echo $rows1[deposit_1st_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_1st_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_1st_2]>0) echo number_format($rows1[deposit_1st_2]);?><!--1차 계약금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_1st_2_date]>0) echo $rows1[deposit_1st_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_1st_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_1st_3]>0) echo number_format($rows1[deposit_1st_3]);?><!--1차 계약금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_1st_3_date]>0) echo $rows1[deposit_1st_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_1st_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding-top:2px;" class="form3"><?="<a href='#;' title='$rows1[cont_mgm_tel]'>".$rows1[cont_mgm_who]."</a>"?><!-- MGM to --></div>
								<div style="float:left; width:65px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[cont_mgm_sum]) echo number_format($rows1[cont_mgm_sum])?><!-- MGM sum --></div>
								<div style="float:left; width:29px; height:22px; padding-top:2px;" class="form3"><?=$w_where[1]?><!-- 소속 --></div>
								<div style="float:left; width:54px; height:22px; padding-top:2px;" class="form3"><?=$rows1[cont_worker]?><!-- 담당자 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($deposit_2nd==0) echo "-"; else echo number_format($deposit_2nd);?><!--2차 계약금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_2nd_1]>0) echo number_format($rows1[deposit_2nd_1]);?><!--2차 계약금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_2nd_1_date]>0) echo $rows1[deposit_2nd_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_2nd_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_2nd_2]>0) echo number_format($rows1[deposit_2nd_2]);?><!--2차 계약금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_2nd_2_date]>0) echo $rows1[deposit_2nd_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_2nd_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_2nd_3]>0) echo number_format($rows1[deposit_2nd_3]);?><!--2차 계약금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_2nd_3_date]>0) echo $rows1[deposit_2nd_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_2nd_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($deposit_3rd==0) echo "-"; else echo number_format($deposit_3rd);?><!--3차 계약금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_3rd_1]>0) echo number_format($rows1[deposit_3rd_1]);?><!--3차 계약금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_3rd_1_date]>0) echo $rows1[deposit_3rd_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_3rd_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_3rd_2]>0) echo number_format($rows1[deposit_3rd_2]);?><!--3차 계약금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_3rd_2_date]>0) echo $rows1[deposit_3rd_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_3rd_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_3rd_3]>0) echo number_format($rows1[deposit_3rd_3]);?><!--3차 계약금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_3rd_3_date]>0) echo $rows1[deposit_3rd_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_3rd_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($deposit_4th==0) echo "-"; else echo number_format($deposit_4th);?><!--4차 계약금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_4th_1]>0) echo number_format($rows1[deposit_4th_1]);?><!--4차 계약금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_4th_1_date]>0) echo $rows1[deposit_4th_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_4th_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_4th_2]>0) echo number_format($rows1[deposit_4th_2]);?><!--4차 계약금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_4th_2_date]>0) echo $rows1[deposit_4th_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_4th_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[deposit_4th_3]>0) echo number_format($rows1[deposit_4th_3]);?><!--4차 계약금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[deposit_4th_3_date]>0) echo $rows1[deposit_4th_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[deposit_4th_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($m_pay_1st==0) echo "-"; else echo number_format($m_pay_1st);?><!--1차 중도금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_1st_1]>0) echo number_format($rows1[m_pay_1st_1]);?><!--1차 중도금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_1st_1_date]>0) echo $rows1[m_pay_1st_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_1st_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_1st_2]>0) echo number_format($rows1[m_pay_1st_2]);?><!--1차 중도금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_1st_2_date]>0) echo $rows1[m_pay_1st_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_1st_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_1st_3]>0) echo number_format($rows1[m_pay_1st_3]);?><!--1차 중도금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_1st_3_date]>0) echo $rows1[m_pay_1st_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_1st_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($m_pay_2nd==0) echo "-"; else echo number_format($m_pay_2nd);?><!--2차 중도금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_2nd_1]>0) echo number_format($rows1[m_pay_2nd_1]);?><!--2차 중도금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_2nd_1_date]>0) echo $rows1[m_pay_2nd_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_2nd_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_2nd_2]>0) echo number_format($rows1[m_pay_2nd_2]);?><!--2차 중도금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_2nd_2_date]>0) echo $rows1[m_pay_2nd_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_2nd_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_2nd_3]>0) echo number_format($rows1[m_pay_2nd_3]);?><!--2차 중도금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_2nd_3_date]>0) echo $rows1[m_pay_2nd_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_2nd_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($m_pay_3rd==0) echo "-"; else echo number_format($m_pay_3rd);?><!--3차 중도금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_3rd_1]>0) echo number_format($rows1[m_pay_3rd_1]);?><!--3차 중도금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_3rd_1_date]>0) echo $rows1[m_pay_3rd_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_3rd_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_3rd_2]>0) echo number_format($rows1[m_pay_3rd_2]);?><!--3차 중도금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_3rd_2_date]>0) echo $rows1[m_pay_3rd_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_3rd_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_3rd_3]>0) echo number_format($rows1[m_pay_3rd_3]);?><!--3차 중도금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_3rd_3_date]>0) echo $rows1[m_pay_3rd_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_3rd_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($m_pay_4th==0) echo "-"; else echo number_format($m_pay_4th);?><!--4차 중도금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_4th_1]>0) echo number_format($rows1[m_pay_4th_1]);?><!--4차 중도금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_4th_1_date]>0) echo $rows1[m_pay_4th_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_4th_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_4th_2]>0) echo number_format($rows1[m_pay_4th_2]);?><!--4차 중도금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_4th_2_date]>0) echo $rows1[m_pay_4th_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_4th_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_4th_3]>0) echo number_format($rows1[m_pay_4th_3]);?><!--4차 중도금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_4th_3_date]>0) echo $rows1[m_pay_4th_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_4th_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($m_pay_5th==0) echo "-"; else echo number_format($m_pay_5th);?><!--5차 중도금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_5th_1]>0) echo number_format($rows1[m_pay_5th_1]);?><!--5차 중도금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_5th_1_date]>0) echo $rows1[m_pay_5th_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_5th_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_5th_2]>0) echo number_format($rows1[m_pay_5th_2]);?><!--5차 중도금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_5th_2_date]>0) echo $rows1[m_pay_5th_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_5th_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_5th_3]>0) echo number_format($rows1[m_pay_5th_3]);?><!--5차 중도금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_5th_3_date]>0) echo $rows1[m_pay_5th_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_5th_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($m_pay_6th==0) echo "-"; else echo number_format($m_pay_6th);?><!--6차 중도금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_6th_1]>0) echo number_format($rows1[m_pay_6th_1]);?><!--6차 중도금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_6th_1_date]>0) echo $rows1[m_pay_6th_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_6th_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_6th_2]>0) echo number_format($rows1[m_pay_6th_2]);?><!--6차 중도금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_6th_2_date]>0) echo $rows1[m_pay_6th_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_6th_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_6th_3]>0) echo number_format($rows1[m_pay_6th_3]);?><!--6차 중도금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_6th_3_date]>0) echo $rows1[m_pay_6th_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_6th_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($m_pay_7th==0) echo "-"; else echo number_format($m_pay_7th);?><!--7차 중도금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_7th_1]>0) echo number_format($rows1[m_pay_7th_1]);?><!--7차 중도금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_7th_1_date]>0) echo $rows1[m_pay_7th_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_7th_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_7th_2]>0) echo number_format($rows1[m_pay_7th_2]);?><!--7차 중도금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_7th_2_date]>0) echo $rows1[m_pay_7th_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_7th_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[m_pay_7th_3]>0) echo number_format($rows1[m_pay_7th_3]);?><!--7차 중도금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[m_pay_7th_3_date]>0) echo $rows1[m_pay_7th_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[m_pay_7th_3_who]?><!-- 입금자 3 --></div>

								<div style="float:left; width:79px; height:22px; padding:2px 10px 0 0; text-align:right; background-color:#FFFFCC;" class="form3"><?if($last_pay==0) echo "-"; else echo number_format($last_pay);?><!--잔금 합계 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[last_pay_1]>0) echo number_format($rows1[last_pay_1]);?><!--잔금 1 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[last_pay_1_date]>0) echo $rows1[last_pay_1_date];?><!-- 입금일 1 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[last_pay_1_who]?><!-- 입금자 1 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[last_pay_2]>0) echo number_format($rows1[last_pay_2]);?><!--잔금 2 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[last_pay_2_date]>0) echo $rows1[last_pay_2_date];?><!-- 입금일 2 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[last_pay_2_who]?><!-- 입금자 2 --></div>
								<div style="float:left; width:75px; height:22px; padding:2px 10px 0 0; text-align:right;" class="form3"><?if($rows1[last_pay_3]>0) echo number_format($rows1[last_pay_3]);?><!--잔금 3 --></div>
								<div style="float:left; width:80px; height:22px; padding-top:2px;" class="form3"><?if($rows1[last_pay_3_date]>0) echo $rows1[last_pay_3_date];?><!-- 입금일 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[last_pay_3_who]?><!-- 입금자 3 --></div>
								<div style="float:left; width:55px; height:22px; padding-top:2px;" class="form3"><?=$rows1[updater]?><!-- 등록직원 --></div>
								<div style="float:left; width:100px; height:22px; padding-top:2px; border-width:0 0 1px 0; border-style=solid;" class="form3"><?if($rows1[updater]) echo substr($rows1[reg_time], 2, 14)?><!-- 등록직원 --></div>
							</div>
							<?
									}
								}
								mysql_free_result($result1);
							?>
						</div>
						<!-------디브 스크롤 엔드------->
						</form>
						</td>
					</tr>
					</table>
					</div>
					<? } ?>