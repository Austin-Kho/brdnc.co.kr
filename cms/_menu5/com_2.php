					<!-- =====subject table end===== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 사용자 권한관리</font></b>
						<div style="float:right;">
							<!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. -->
						</div>
					</div>
					<!--===== subject table end===== -->
					<?
						$_m5_2_2_rlt = mysql_query("select _m5_2_2 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m5_2_2_row = mysql_fetch_array($_m5_2_2_rlt);

						if(!$_m5_2_2_row[_m5_2_2]||$_m5_2_2_row[_m5_2_2]==0){
					?>
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
						<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;" class="form2">
							<!-- <a href="javascript:" onClick="excel_pop('<?=$_m1_2_1_row[_m1_2_1]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
						<!-- 신규 사용자 등록자가 있을 때 처리 시작 -->
						<?
							$q = "select request from cms_member_table where request='2' ";
							$rl=mysql_query($q, $connect);
							$rs=mysql_fetch_array($rl);
							if($rs){
						?>
						<form name="form2" method="post" action="com_post.php">
							<input type="hidden" name="mode" value="perm">
							<input type="hidden" name="mem">
							<input type="hidden" name="sf">
						<table border="0" width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td colspan="8" style="padding: 0 0 0 10px;" height="30"> <b><font color="red">*</font> <font color="black">신규 사용자 등록 신청 건이 있습니다.</font></b></td>
						</tr>
						<tr align="center" bgcolor="#f6f6f6">
							<td width="5%" class="top" height="35"> NO. </td>
							<td width="10%" class="top"> 성 명 </td>
							<td width="10%" class="top"> 구 분 </td>
							<td width="20%" class="top"> 프로젝트 명 </td>
							<td width="15%" class="top"> 전화번호 </td>
							<td width="15%" class="top"> email </td>
							<td width="15%" class="top"> 등록 신청일시 </td>
							<td width="10%" class="top"> 승인 처리 </td>
						</tr>
						<?
							$q1 = " SELECT no, name, is_company, email, mobile, pj_seq, reg_date
								   FROM cms_member_table WHERE request='2' GROUP BY no ORDER BY no";
							$rl1=mysql_query($q1, $connect);
							for($i=0; $rs1=mysql_fetch_array($rl1); $i++){
								$q2 = "SELECT pj_name FROM cms_project1_info WHERE seq='$rs1[pj_seq]'";
								$rl2 = mysql_query($q2, $connect);
								$rs2 = mysql_fetch_array($rl2);
								if($rs1[is_company]==1) {$sort=$com_title;} else {$sort="현장 관계직원";}
						?>
						<tr align="center">
							<td height="30"> <?=$rs1[no]?> </td>
							<td> <?=$rs1[name]?> </td>
							<td> <?=$sort?> </td>
							<td> <?=$rs2[pj_name]?> </td>
							<td> <?=$rs1[mobile]?> </td>
							<td> <?=$rs1[email]?> </td>
							<td> <?=$rs1[reg_date]?> </td>
							<?
								if($_m5_2_2_row[_m5_2_2]<2){
									$perm_str="alert('승인(거부) 권한이 없습니다!')";
								}else{
									$perm_str="permition('$rs1[no]',this.value);";
								}
							?>
							<td> <input type="button" value="승인" onclick="<?=$perm_str?>"><input type="button" value="거부" onclick="<?=$perm_str?>"> </td>
						</tr>
						<? } ?>
						<tr>
							<td colspan="8" class="bottom" height="10"></td>
						</tr>
						</table>
						</form>
						<? } ?>
						<!-- 신규 사용자 등록자가 있을 때 처리 종료 -->

						<!-- 권한 설정 직원(관계자) 셀렉트 폼 시작 -->
						<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#F8F8F8">
						<tr>
							<td width="230" align="center" style="border-width: 0 0 1px 0; border-color:#D6D6D6; border-style: solid;" height="38">
							<font color="red"><b>*</b></font> <font color="#000000"><b>권한 설정할 직원(관계자) 선택</b></font> </td>

							<td width="230" style="border-width: 0 0 1px 0; border-color:#D6D6D6; border-style: solid;">
							<input type="radio" name="is_com" value="1" onclick = "location.href='config_main.php?m_di=2&s_di=2&ms=1' " <?if($ms=='1') echo "checked";?>> <?=$com_title?>
							<input type="radio" name="is_com" value="2" onclick = "location.href='config_main.php?m_di=2&s_di=2&ms=2' " <?if($ms=='2') echo "checked";?>> 현장 관계자
							</td>
							<td style="border-width: 0 0 1px 0; border-color:#D6D6D6; border-style: solid;">
								<select id="mem_sel" name="mem_sel" class="inputstyle2" style="width:100px; height:20px;" onchange="location.href='config_main.php?m_di=2&s_di=2&ms=<?=$ms?>&mn='+this.value">
									<option value="0" <?if(!$mem_sel) echo "selected"?>> 선 택
									<?
										$qry = "SELECT * FROM cms_member_table WHERE request='1' AND is_company='$ms' ORDER BY no ";
										$rlt = mysql_query($qry, $connect);
										for($i=0; $rows=mysql_fetch_array($rlt); $i++){
									?>
									<option value="<?=$rows[no]?>" <?if($mn==$rows[no]) echo "selected"; ?>><?=$rows[name]?>
									<? } ?>
								</select>
							</td>
						</tr>
						</table>
						<div style="height:35px; margin-top:13px; background-color:#f6f6f6;">
							<div style="width:30px; float:left; padding-top:8px; text-align:center;" class="top">NO.</div>
							<div style="width:88px; float:left; padding-top:8px; text-align:center;" class="top">성 명</div>
							<div style="width:150px; float:left; padding-top:8px; text-align:center;" class="top">구 분</div>
							<div style="width:380px; float:left; padding-top:8px; text-align:center;" class="top">프로젝트 명</div>
							<div style="width:120px; float:left; padding-top:8px; text-align:center;" class="top">전화번호</div>
							<div style="width:120px; float:left; padding-top:8px; text-align:center;" class="top">Email</div>
							<div style="width:110px; float:left; padding-top:8px; text-align:center;" class="top">등록 신청일시</div>
							<div style="width:50px; float:left; padding-top:8px; text-align:center;" class="top">선 택</div>
						</div>

						<!-- ======================권한 설정 항목 선택 폼 시작=========================== -->
						<form name="form3" method="post" action="com_post.php">
							<input type="hidden" name="mode" value="auth_m">
							<input type="hidden" name="ms" value="<?=$ms?>">
							<input type="hidden" name="mn" value="<?=$mn?>">
						<?
							if(!$mn||$mn=='0') $mem_sel_dis="display:none;"; else $mem_sel_dis="display:block;";
							if($mn){
								if($ms=='1') $mem_qry = "SELECT * FROM cms_member_table WHERE request='1' AND is_company='$ms' AND no='$mn' ORDER BY no ASC"; // 본사 직원일때 쿼리
								if($ms=='2') $mem_qry = "SELECT no, user_id, name, is_company, pj_name, mobile, email, cms_project1_info.seq, cms_member_table.reg_date AS r_date
														 FROM cms_member_table, cms_project1_info
														 WHERE no='$mn' AND cms_member_table.pj_seq=cms_project1_info.seq ORDER BY no ASC";               // 현장 관계 직원일 때 쿼리
								$mem_rlt = mysql_query($mem_qry, $connect);
								$mem_row = mysql_fetch_array($mem_rlt);
							}

							if($mem_row){
								if($mem_row[is_company]=='2'){
									$color="<font color='#003399'>";
									$pj_name = $color.$mem_row[pj_name]."</font>";
									$r_date = $mem_row[r_date];
									$mem_sort = "<font color='#003399'>현장 관계자</font>";
								 } else {
									$color="<font color='#000066'>";
									$pj_name = $color."본사 직원</font>";
									$r_date = $mem_row[reg_date];
									$mem_sort = "<font color='#000066'>".$com_title."</font>";
								 }
						?>
						<div style="height:35px; margin-bottom:13px; <?=$mem_sel_dis?>" class="bottom">
							<div style="width:30px; float:left; padding-top:8px; text-align:center;"><?=$mem_row[no]?></div>
							<div style="width:88px; float:left; padding-top:8px; text-align:center;"><?=$color.$mem_row[name]."</font>"?></div>
							<div style="width:150px; float:left; padding-top:8px; text-align:center;"><?=$mem_sort?></div>
							<div style="width:380px; float:left; padding-top:8px; text-align:center;"><?=$pj_name?></div>
							<div style="width:120px; float:left; padding-top:8px; text-align:center;"><?=$mem_row[mobile]?></div>
							<div style="width:120px; float:left; padding-top:8px; text-align:center;"><?=$mem_row[email]?></div>
							<div style="width:110px; float:left; padding-top:8px; text-align:center;"><?=$r_date?></div>
							<div style="width:50px; float:left; padding-top:8px; text-align:center;"><input type="checkbox" name="user_no" value="<?=$mem_row[no]?>" <?if($mn) echo "checked"?>></div>
						</div>
						<?  } ?>
						<!-- 권한 설정 직원(관계자) 셀렉트 폼 시작 -->
						<table><tr><td height="8"></td></tr></table>
						<?
							$asq = "select * from cms_mem_auth where user_no='$mem_row[no]' ";
							$ast = mysql_query($asq, $connect);
							$asr = mysql_fetch_array($ast);
						?>
						<input type="hidden" name="user_id" value="<?=$mem_row[user_id]?>">
						<table border="0" width="100%" cellpadding="0" cellspacing="0">
						<!-- 영업관리 파트 시작 -->
						<tr valign="middle">
							<td width="120" rowspan="2" class="top2" align="center" <?if($is_com==2) echo "bgcolor='#d8d8d8'"; else "bgcolor='#f8f8f8'";?>><font size="2" color="black"><b>영업관리</b></font></td>
							<td height="34" class="top2" align="right"><font color="black"><b onclick="auth_chk('1-1');">계약현황</b></font></td>
							<td height="34" width="20" class="top2"><!-- <input type="checkbox" name="_m1_1" onclick="checksel();"> --></td>

							<td class="top2" align="right"><font color="black">계약현황</font></td>
							<td class="top2">
								<input type="checkbox" name="_m1_1_1" <?if($asr[_m1_1_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m1_1_1_m" <?if($asr[_m1_1_1]>1) echo "checked";?> disabled>등록</td>
							<td class="top2" align="right"><font color="black">계약등록</font></td>
							<td class="top2">
								<input type="checkbox" name="_m1_1_2" <?if($asr[_m1_1_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m1_1_2_m" <?if($asr[_m1_1_2]>1) echo "checked";?>>등록</td>
							<td class="top2" align="right"><font color="black">동호수 조회</font></td>
							<td class="top2">
								<input type="checkbox" name="_m1_1_3" <?if($asr[_m1_1_3]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m1_1_3_m" <?if($asr[_m1_1_3]>1) echo "checked";?> disabled>등록</td>
							<td class="top2"></td>
							<td class="top2"></td>
						</tr>
						<tr valign="middle">
							<td height="34" align="right"><font color="black"><b onclick="auth_chk('1-2');">업무현황</b></font></td>
							<td height="34"><!-- <input type="checkbox" name="_m1_2"> --></td>

							<td align="right"><font color="black">고객 상담일지</font></td>
							<td>
								<input type="checkbox" name="_m1_2_1" <?if($asr[_m1_2_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m1_2_1_m"<?if($asr[_m1_2_1]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">업무일지</font></td>
							<td>
								<input type="checkbox" name="_m1_2_2" <?if($asr[_m1_2_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m1_2_2_m" <?if($asr[_m1_2_2]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">업무보고</font></td>
							<td>
								<input type="checkbox" name="_m1_2_3" <?if($asr[_m1_2_3]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m1_2_3_m" <?if($asr[_m1_2_3]>1) echo "checked";?>>등록</td>
							<td></td>
							<td></td>
						</tr>
						<!-- 영업관리 파트 종료 -->

						<!-- 현장관리 파트 시작 -->
						<tr valign="middle">
							<td rowspan="2" bgcolor="#f8f8f8" style="border-width: 1px 0 1px 0; border-color:#D6D6D6; border-style: solid;" align="center"><font size="2" color="black"><b>현장관리</b></font></td>

							<td height="34" class="top" align="right"><font color="black"><b onclick="auth_chk('2-1');">전도금 관리</b></font></td>
							<td height="34" class="top"><!-- <input type="checkbox" name="_m2_1"> --></td>
							<td class="top" align="right"><font color="black">전도금 내역</font></td>
							<td class="top">
								<input type="checkbox" name="_m2_1_1" <?if($asr[_m2_1_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m2_1_1_m" <?if($asr[_m2_1_1]>1) echo "checked";?>>등록</td>
							<td class="top" align="right"><font color="black">전도금 입출등록</font></td>
							<td class="top">
								<input type="checkbox" name="_m2_1_2" <?if($asr[_m2_1_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m2_1_2_m" <?if($asr[_m2_1_2]>1) echo "checked";?>>등록</td>
							<td class="top" align="right"><font color="black">전체 전도금 현황</font></td>
							<td class="top">
								<input type="checkbox" name="_m2_1_3" <?if($asr[_m2_1_3]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m2_1_3_m" <?if($asr[_m2_1_3]>1) echo "checked";?> disabled>등록</td>
							<td class="top"></td>
							<td class="top"></td>
						</tr>
						<tr valign="middle">
							<td height="34" class="bottom" align="right"><font color="black"><b onclick="auth_chk('2-2');">투입자원 관리</b></font></td>
							<td height="34" class="bottom"><!-- <input type="checkbox" name="_m2_2"> --></td>
							<td class="bottom" align="right"><font color="black">현장 인원현황</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m2_2_1" <?if($asr[_m2_2_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m2_2_1_m" <?if($asr[_m2_2_1]>1) echo "checked";?>>등록</td>
							<td class="bottom" align="right"><font color="black">현장 인원등록</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m2_2_2" <?if($asr[_m2_2_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m2_2_2_m" <?if($asr[_m2_2_2]>1) echo "checked";?>>등록</td>
							<td class="bottom" align="right"><font color="black">사용자 소속관리</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m2_2_3" <?if($asr[_m2_2_3]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m2_2_3_m" <?if($asr[_m2_2_3]>1) echo "checked";?>>등록</td>
							<td class="bottom"></td>
							<td class="bottom"></td>
						</tr>
						<!-- 현장관리 파트 종료 -->

						<!-- 자금관리 파트 시작 -->
						<tr valign="middle">
							<td rowspan="2" bgcolor="#f8f8f8" class="bottom" align="center"><font size="2" color="black"><b>자금회계</b></font></td>
							<td height="34" align="right"><font color="black"><b onclick="auth_chk('3-1');">자금현황</b></font></td>
							<td height="34"><!-- <input type="checkbox" name="_m3_1"> --></td>
							<td align="right"><font color="black">자금일보</font></td>
							<td>
								<input type="checkbox" name="_m3_1_1" <?if($asr[_m3_1_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m3_1_1_m" <?if($asr[_m3_1_1]>1) echo "checked";?> disabled>등록</td>
							<td align="right"><font color="black">입출금 내역</font></td>
							<td>
								<input type="checkbox" name="_m3_1_2" <?if($asr[_m3_1_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m3_1_2_m" <?if($asr[_m3_1_2]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">입출금 등록</font></td>
							<td>
								<input type="checkbox" name="_m3_1_3" <?if($asr[_m3_1_3]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m3_1_3_m" <?if($asr[_m3_1_3]>1) echo "checked";?>>등록</td>
							<td></td>
							<td></td>
						</tr>
						<tr valign="middle">
							<td height="34" class="bottom" align="right"><font color="black"><b onclick="auth_chk('3-2');">회계관리</b></font></td>
							<td height="34" class="bottom"><!-- <input type="checkbox" name="_m3_2"> --></td>
							<td class="bottom" align="right"><font color="black">분개장</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m3_2_1" <?if($asr[_m3_2_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m3_2_1_m" <?if($asr[_m3_2_1]>1) echo "checked";?>>등록</td>
							<td class="bottom" align="right"><font color="black">일/월계표</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m3_2_2" <?if($asr[_m3_2_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m3_2_2_m" <?if($asr[_m3_2_2]>1) echo "checked";?>>등록</td>
								<td class="bottom" align="right"><font color="black">제무제표</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m3_2_3" <?if($asr[_m3_2_3]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m3_2_3_m" <?if($asr[_m3_2_3]>1) echo "checked";?>>등록</td>
							<td class="bottom"></td>
							<td class="bottom"></td>
						</tr>
						<!-- 자금관리 파트 종료 -->

						<!-- 프로젝트 파트 시작 -->
						<tr valign="middle">
							<td rowspan="2" bgcolor="#f8f8f8" class="bottom" align="center"><font size="2" color="black"><b>프로젝트</b></font></td>
							<td height="34" align="right"><font color="black"><b onclick="auth_chk('4-1');">프로젝트 관리</b></font></td>
							<td height="34"><!-- <input type="checkbox" name="_m4_1"> --></td>
							<td align="right"><font color="black">데이터 등록</font></td>
							<td>
								<input type="checkbox" name="_m4_1_1" <?if($asr[_m4_1_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m4_1_1_m" <?if($asr[_m4_1_1]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">기본정보 수정</font></td>
							<td>
								<input type="checkbox" name="_m4_1_2" <?if($asr[_m4_1_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m4_1_2_m" <?if($asr[_m4_1_2]>1) echo "checked";?>>등록</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr valign="middle">
							<td height="34" class="bottom" align="right"><font color="black"><b onclick="auth_chk('4-2');">신규 프로젝트</b></font></td>
							<td height="34" class="bottom"><!-- <input type="checkbox" name="_m4_2"> --></td>
							<td class="bottom" align="right"><font color="black">검토 프로젝트</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m4_2_1" <?if($asr[_m4_2_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m4_2_1_m" <?if($asr[_m4_2_1]>1) echo "checked";?>>등록</td>
							<td class="bottom" align="right"><font color="black">프로젝트 등록</font></td>
							<td class="bottom">
								<input type="checkbox" name="_m4_2_2" <?if($asr[_m4_2_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m4_2_2_m" <?if($asr[_m4_2_2]>1) echo "checked";?>>등록</td>
							<td class="bottom"></td>
							<td class="bottom"></td>
							<td class="bottom"></td>
							<td class="bottom"></td>
						</tr>
						<!-- 수주관리 파트 종료 -->

						<!-- 환경설정 파트 시작 -->
						<tr valign="middle">
							<td rowspan="2" bgcolor="#f8f8f8" align="center"><font size="2" color="black"><b>환경설정</b></font></td>
							<td height="34" align="right"><font color="black"><b onclick="auth_chk('5-1');">기본정보 관리</b></font></td>
							<td height="34"><!-- <input type="checkbox" name="_m5_1"> --></td>

							<td align="right"><font color="black">부서정보 관리</font></td>
							<td>
								<input type="checkbox" name="_m5_1_1" <?if($asr[_m5_1_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m5_1_1_m" <?if($asr[_m5_1_1]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">직원정보 관리</font></td>
							<td>
								<input type="checkbox" name="_m5_1_2" <?if($asr[_m5_1_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m5_1_2_m" <?if($asr[_m5_1_2]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">거래처정보 관리</font></td>
							<td>
								<input type="checkbox" name="_m5_1_3" <?if($asr[_m5_1_3]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m5_1_3_m" <?if($asr[_m5_1_3]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">은행계좌 관리</font></td>
							<td>
								<input type="checkbox" name="_m5_1_4" <?if($asr[_m5_1_4]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m5_1_4_m" <?if($asr[_m5_1_4]>1) echo "checked";?>>등록</td>
						</tr>
						<tr valign="middle">
							<td height="34" align="right"><font color="black"><b onclick="auth_chk('5-2');">회사정보 관리</b></font></td>
							<td height="34"><!-- <input type="checkbox" name="_m5_2"> --></td>
							<td align="right"><font color="black">회사 기본정보</font></td>
							<td>
								<input type="checkbox" name="_m5_2_1" <?if($asr[_m5_2_1]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m5_2_1_m" <?if($asr[_m5_2_1]>1) echo "checked";?>>등록</td>
							<td align="right"><font color="black">사용자 권한관리</font></td>
							<td>
								<input type="checkbox" name="_m5_2_2" <?if($asr[_m5_2_2]>0) echo "checked";?>>조회
								<input type="checkbox" name="_m5_2_2_m" <?if($asr[_m5_2_2]>1) echo "checked";?>>등록</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<!-- 환경설정 파트 종료 -->

						<tr>
							<td colspan="11" align="right" style="border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;" height="28"></td>
						</tr>
						<tr bgcolor="#F8F8F8">
							<td colspan="11" align="right" style="border-width: 0 0 1px 0; border-color:#D6D6D6; border-style: solid; padding:0 20px 0 0;" height="50">
							<?
								if($_m5_2_2_row[_m5_2_2]<2){
									 $submit_str="alert('등록 권한이 없습니다!')";
								}else{
									 $submit_str="auth_submit('$mn');";
								}
							?>
							<input type="button" value=" 권 한 설 정 " onclick="<?=$submit_str?>" class="submit_bt">
							</td>
						</tr>
						</table>
						</form>
						</td>
					</tr>
					</table>
					</div>
					<!-- 권한 설정 항목 선택 폼 종료 -->
					<? } ?>