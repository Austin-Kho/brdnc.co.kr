					<!-- ===== subject table end ===== -->
					<div style=" height:18px; background-color:#F4F4F4" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 기본정보 수정</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
						</div>
					</div>
					<!-- ===== subject table end ===== -->
					<?
						$ct_1_2_rlt = mysql_query("select ct_1_2 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$ct_1_2_row = mysql_fetch_array($ct_1_2_rlt);

						if(!$ct_1_2_row[ct_1_2]||$ct_1_2_row[ct_1_2]==0){
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
						<table border="0" width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td valign="top" height="570">
							<form name="pj_sel" method="post" action="<?=$_SERVER['PHP_SELF']?>">
								<input type="hidden" name="modi_field" value="ok">
								<input type="hidden" name="s_di" value="2">
							<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="#F4F4F4">
							<tr>
								<td width="100" style="border-width: 1px 0 1px 0; border-color:#D6D6D6; border-style: solid; padding-left:20px;" height="35">
									<font color="#000000">계 약 년 도</font> </td>
								<td width="150" style="border-width: 1px 0 1px 0; border-color:#D6D6D6; border-style: solid; padding:0 0 0 12px;">
								<div>
									<select name="year_frm" onchange="submit();" class="inputstyle2" style="height:22px; width:100px;">
										<option value="1"> 전 체
										<?
											$start_year = "2010";
											// if(!$year_frm) $year_frm=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
											$year=range($start_year,date('Y'));

											for($i=(count($year)-1); $i>=0; $i--){
										?>
										<option value="<?=$year[$i]?>" <?if($year_frm==$year[$i]) echo "selected"; ?>><?=$year[$i]."년"?>
										<? } ?>
									</select>
								</div>
								</td>
								<td width="150" style="border-width: 1px 0 1px 0; border-color:#D6D6D6; border-style: solid; padding-left:20px;">
									<font color="#000000"><b>프로젝트 선택</b></font> </td>
								<td style="border-width: 1px 0 1px 0; border-color:#D6D6D6; border-style: solid; padding:0 0 0 12px;">
								<div>
									<select name="pj" class="inputstyle2" style="height:22px; width:180px;" onchange="submit();">
										<option value="" <?if(!$pj) echo "selected"?>> 목 록
										<?
											$where="";
											if($year_frm>1){
												$where=" WHERE pr_sd LIKE '$year_frm%' ";
											}
											$qry = "SELECT * FROM cms_project_info $where ORDER BY pr_sd DESC ";
											$rlt = mysql_query($qry, $connect);
											for($i=0; $rows=mysql_fetch_array($rlt); $i++){
										?>
										<option value="<?=$rows[seq]?>" <?if($pj==$rows[seq]) echo "selected"; ?>><?=$rows[pj_name]?>
										<? } ?>
									</select>
								</div>
								</td>
							</tr>
							</table>
							<table border="0" width="100%" cellpadding="0" cellspacing="0" id="list_tb" style="<?if($pj) echo 'display:none'?>">
							<tr>
								<td colspan="9"  height="35"> <font color="#cc0000">＊</font> 프로젝트(현장) 리스트</td>
							</tr>
							<tr align="center" bgcolor="#e3e7e0">
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;" height="35"> NO.</td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 프로젝트(현장) 명</td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 종류 </td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 총 세대수(공급물량)  </td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 발주사명</td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 발주사 담당자</td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 발주사 연락처</td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 발주사 이메일</td>
								<td style="border-width: 1px 0 0 0; border-color:#a5a5a5; border-style: solid;"> 계약 체결일</td>
							</tr>
							<?
								$qry1 = "select * from cms_project_info $where order by pr_sd desc ";
								$rlt1 = mysql_query($qry1, $connect);
								for($i=0; $rows1=mysql_fetch_array($rlt1); $i++){
									if($rows1[sort]==1) $sort="아파트(일반분양)";
									if($rows1[sort]==2) $sort="아파트(조합)";
									if($rows1[sort]==3) $sort="주상복합(아파트)";
									if($rows1[sort]==4) $sort="주상복합(오피스텔)";
									if($rows1[sort]==5) $sort="도시형생활주택";
									if($rows1[sort]==6) $sort="근린생활시설";
									if($rows1[sort]==7) $sort="레저(숙박)시설";
									if($rows1[sort]==8) $sort="기 타";

									if($rows1[count_unit]==1) $unit = " 세대";
									if($rows1[count_unit]==2) $unit = " 실";
									if($rows1[count_unit]==3) $unit = " 호";
									if($rows1[count_unit]==4) $unit = " ㎡";

									$total_count = array_sum(explode("-",$rows1[total_count_type])).$unit;
							?>
							<tr align="center">
								<td height="30"> <?=$rows1[seq]?> </td>
								<td> <a href="javascript:" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=2&amp;pj=<?=$rows1[seq]?>'"><?=$rows1[pj_name]?></a> </td>
								<td> <?=$sort?> </td>
								<td> <?=$total_count?>  </td>
								<td> <?=$rows1[client]?> </td>
								<td> <?=$rows1[client_res]?> </td>
								<td> <?=$rows1[client_res_tel]?> </td>
								<td> <?=$rows1[client_res_fax]?> </td>
								<td> <?=$rows1[cont_date]?> </td>
							</tr>
							<? } ?>
							<tr>
								<td colspan="9" style="border-width: 0 0 1px 0; border-color:#a5a5a5; border-style: solid;"></td>
							</tr>
							</table>
							</form>

							<form name="form1" method="post" action="contract_post.php">
							<?
								if($pj){
									$query="select * from cms_project_info where seq=$pj";
									$result=mysql_query($query, $connect);
									$row = mysql_fetch_array($result);

									$addr = explode("/",$row[local_addr]);
									$type = explode("-",$row[type_info]);
									$color = explode("-",$row[color_type]);
									$t_count=count($type);
									$total_count = explode("-",$row[total_count_type]);
									$sell_count = explode("-",$row[sell_count_type]);
									$unit = explode("-",$row[count_unit]);
									$pay = explode("-",$row[per_pay_type]);
									$pay_con = explode("-",$row[pay_con]);
								}
							?>
							<input type="hidden" name="page_code" value="modify">
							<input type="hidden" name="seq" value="<?=$row[seq]?>">
							<?
								if($pj){
							?>
							<table border="0" width="100%" cellpadding="0" cellspacing="0" style="margin-top:15px;">
							<tr>
								<td width="15%" class="form1" bgcolor="#F4F4F4" height="25"> 프로젝트 명 <font color="red">*</font></td>
								<td width="35%" class="form2">
									<input type="text" name="pj_name" value="<?=$row[pj_name]?>" size="54" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								</td>
								<td width="15%" class="form1" bgcolor="#F4F4F4"> 프로젝트 종류 <font color="red">*</font></td>
								<td width="35%" class="form2">
									<select name="sort" class="inputstyle2" style="height:22px; width:90px;">
										<option value="" <?if(!$pj) echo "selected";?>> 선 택
										<option value="1" <?if($row[sort]==1) echo "selected";?>> 아파트(일반분양)
										<option value="2" <?if($row[sort]==2) echo "selected";?>> 아파트(조합)
										<option value="3" <?if($row[sort]==3) echo "selected";?>> 주상복합(아파트)
										<option value="4" <?if($row[sort]==4) echo "selected";?>> 주상복합(오피스텔)
										<option value="5" <?if($row[sort]==5) echo "selected";?>> 도시형생활주택
										<option value="6" <?if($row[sort]==6) echo "selected";?>> 근린생활시설
										<option value="7" <?if($row[sort]==7) echo "selected";?>> 레저(숙박)시설
										<option value="8" <?if($row[sort]==8) echo "selected";?>> 기 타
									</select>
									&nbsp;&nbsp;데이터정렬기준 <font color="red">*</font> : 동호수<input type="radio" name="data_cr" value="0" <?if($row[data_cr]=='0') echo "checked"?>>
								관리번호<input type="radio" name="data_cr" value="1" <?if($row[data_cr]=='1') echo "checked"?>>
								</td>
							</tr>
							<tr>
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 현장 주소 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('../member/zip_search.php',1)" class="inputstyle_bt" style="height:20px;">
									<input type="text" name="zipcode" value="<?=$addr[0]?>" size="5" class="inputstyle2" readonly onKeydown="ZipWindow('../member/zip_search.php',1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<input type="text" name="address1" value="<?=$addr[1]?>" size="51" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<input type="text" name="address2" value="<?=$addr[2]?>" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <font color="#788be2">나머지 주소</font>
								</td>
							</tr>
							<tr>
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 현장 연락처 </td>
								<td class="form2">
									Tel :
									<input type="text" name="local_tel" value="<?=$row[local_tel]?>" size="20" maxlength="20" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									Fax :
									<input type="text" name="local_fax" value="<?=$row[local_fax]?>" size="20" maxlength="20" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								</td>
								<td width="150" class="form1" bgcolor="#F4F4F4"> 현장 관리 책임자 </td>
								<td class="form2">
									<input type="text" name="pj_manager" value="<?=$row[pj_manager]?>" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								</td>
							</tr>
							<tr>
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_1" value="<?=$type[0]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_1" value="<?=$color[0]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[0]?>">
									전체물량 : <input type="text" name="total_count_1" value="<?=$total_count[0]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_1" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[0]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[0]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[0]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[0]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[0]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_1" id="ck1_1" onclick="type_reg('1',this,1);" <?if($type[1]){echo " checked ";} if($type[2]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_2" style="<?if($t_count<2) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_2" value="<?=$type[1]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_2" value="<?=$color[1]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[1]?>">
									전체물량 : <input type="text" name="total_count_2" value="<?=$total_count[1]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_2" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[1]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[1]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[1]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[1]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[1]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_2" id="ck1_2" onclick="type_reg('1',this,2);" <?if($type[2]){echo " checked ";} if($type[3]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_3" style="<?if($t_count<3) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_3" value="<?=$type[2]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_3" value="<?=$color[2]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[2]?>">
									전체물량 : <input type="text" name="total_count_3" value="<?=$total_count[2]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_3" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[2]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[2]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[2]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[2]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[2]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_3" id="ck1_3" onclick="type_reg('1',this,3);" <?if($type[3]){echo " checked ";} if($type[4]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_4" style="<?if($t_count<4) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_4" value="<?=$type[3]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_4" value="<?=$color[3]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[3]?>">
									전체물량 : <input type="text" name="total_count_4" value="<?=$total_count[3]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_4" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[3]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[3]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[3]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[3]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[3]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_4" id="ck1_4" onclick="type_reg('1',this,4);" <?if($type[4]){echo " checked ";} if($type[5]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_5" style="<?if($t_count<5) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_5" value="<?=$type[4]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_5" value="<?=$color[4]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[4]?>">
									전체물량 : <input type="text" name="total_count_5" value="<?=$total_count[4]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_5" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[4]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[4]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[4]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[4]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[4]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_5" id="ck1_5" onclick="type_reg('1',this,5);" <?if($type[5]){echo " checked ";} if($type[6]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_6" style="<?if($t_count<6) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_6" value="<?=$type[5]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_6" value="<?=$color[5]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[5]?>">
									전체물량 : <input type="text" name="total_count_6" value="<?=$total_count[5]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_6" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[5]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[5]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[5]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[5]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[5]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_6" id="ck1_6" onclick="type_reg('1',this,6);" <?if($type[6]){echo " checked ";} if($type[7]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_7" style="<?if($t_count<7) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_7" value="<?=$type[6]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_7" value="<?=$color[6]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[6]?>">
									전체물량 : <input type="text" name="total_count_7" value="<?=$total_count[6]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_7" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[6]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[6]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[6]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[6]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[6]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_7" id="ck1_7" onclick="type_reg('1',this,7);" <?if($type[7]){echo " checked ";} if($type[8]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_8" style="<?if($t_count<8) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_8" value="<?=$type[7]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_8" value="<?=$color[7]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[7]?>">
									전체물량 : <input type="text" name="total_count_8" value="<?=$total_count[7]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_8" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[7]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[7]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[7]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[7]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[7]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_8" id="ck1_8" onclick="type_reg('1',this,8);" <?if($type[8]){echo " checked ";} if($type[9]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_9" style="<?if($t_count<9) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_9" value="<?=$type[8]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_9" value="<?=$color[8]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[8]?>">
									전체물량 : <input type="text" name="total_count_9" value="<?=$total_count[8]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_9" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[8]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[8]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[8]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[8]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[8]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_9" id="ck1_9" onclick="type_reg('1',this,9);" <?if($type[9]){echo " checked ";} if($type[10]){echo " disabled ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_10" style="<?if($t_count<10) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_10" value="<?=$type[9]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_10" value="<?=$color[9]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[9]?>">
									전체물량 : <input type="text" name="total_count_10" value="<?=$total_count[9]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_10" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[9]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[9]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[9]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[9]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[9]==4) echo "selected";?>> ㎡
									</select>
									<input type="checkbox" name="ck1_10" id="ck1_10" onclick="type_reg('1',this,10);" <?if($type[10]){echo " checked ";}?>> 타입 추가
								</td>
							</tr>
							<tr id="type1_11" style="<?if($t_count<11) echo "display:none";?>">
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
								<td class="form2" colspan="3">
									타입 : <input type="text" name="type_11" value="<?=$type[10]?>" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									타입컬러 : <input type="text" name="color_11" value="<?=$color[10]?>" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="background-color:<?=$color[10]?>">
									전체물량 : <input type="text" name="total_count_11" value="<?=$total_count[10]?>" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
									<select name="count_unit_11" class="inputstyle2" style="height:22px;">
										<option value="" <?if($unit[10]==0) echo "selected";?>> 선 택
										<option value="1" <?if($unit[10]==1) echo "selected";?>> 세대
										<option value="2" <?if($unit[10]==2) echo "selected";?>> 실
										<option value="3" <?if($unit[10]==3) echo "selected";?>> 호
										<option value="4" <?if($unit[10]==4) echo "selected";?>> ㎡
									</select>
									<!-- <input type="checkbox" name="ck1_10" id="ck1_10" onclick="type_reg('1',this,11);" <?if($type[10]){echo " checked ";}?>> 타입 추가 -->
								</td>
							</tr>
							<tr>
								</td>
								<td width="150" class="form1" bgcolor="#F4F4F4"> 수행 개시일 <font color="red">*</font></td>
								<td  class="form2">
									<input type="text" name="pr_sd" id="pr_sd" value="<?=$row[pr_sd]?>" size="25" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
									<a href="javascript:" onclick="cal_add(document.getElementById('pr_sd'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								</td>
								<td width="150" class="form1" bgcolor="#F4F4F4" height="25"> 수행 기간 <!-- <font color="red">*</font> --></td>
								<td  class="form2">

									<div style="float:left;">
										<input type="text" name="start_date" id="start_date" value="<?=$row[start_date]?>" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
										<a href="javascript:" onclick="cal_add(document.getElementById('start_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a> ~
									</div>
									<div style="float:left; padding-left:5px; margin-right:5px;">
										<input type="text" name="expiry_date" id="expiry_date" value="<?=$row[expiry_date]?>" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
										<a href="javascript:" onclick="cal_add(document.getElementById('expiry_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									</div>
							</tr>
							<tr>
								<td width="150" class="form1" bgcolor="#F4F4F4" style="padding:15px 0 30px 10px; border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;"> 프로젝트 특별조건<br>(Special Condition) <!-- <font color="red">*</font> --></td>
								<td  class="form2" colspan="3" style="padding:15px 0 30px 10px; border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;">
									<textarea name="pr_sp_con" rows="8" cols="120" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="height:100px;"><?=$row[pr_sp_con]?></textarea>
								</td>
							</tr>
							<tr align="right" bgcolor="#F4F4F4">
								<td colspan="3" class="form2" height="48"></td>
								<?
									if($ct_1_2_row[ct_1_2]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										 $submit_str="con_formck();";
									}
								?>
								<td class="form2" style="padding:0 20 0 0px"><input type="button" value=" 변경등록 " onclick="<?=$submit_str?>" class="submit_bt"><input type="button" value=" 취 소 " onclick="pj_('cancel')" class="submit_bt"></td>
							</tr>
							</table>
							<? } ?>
							</form>
							</td>
						</tr>
						</table>
						</td>
					</tr>
					</table>
					</div>
					<? } ?>
