					<!-- ===== subject table end ===== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 신규계약 등록</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
							<font color="red">*</font> 종류가 2종 이상인 경우 각각의 건으로 분리 등록하십시요.(예: 아파트 + 근린생활시설)
						</div>
					</div>
					<!-- ===== subject table end ===== -->
					<?
						$ct_2_2_rlt = mysql_query("select ct_2_2 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$ct_2_2_row = mysql_fetch_array($ct_2_2_rlt);

						if(!$ct_2_2_row[ct_2_2]||$ct_2_2_row[ct_2_2]==0){
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

						<form name="form1" method="post" action="contract_post.php">
						<input type="hidden" name="page_code" value="new_reg">





						<table border="0" width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td width="15%" class="form1" style="border-width:1px 0 1px 0; border-style:solid;" bgcolor="#F8F8F8" height="25"> 프로젝트 명 <font color="red">*</font></td>
							<td width="35%" class="form2" style="border-width:1px 0 1px 0; border-style:solid;">
								<input type="text" name="pj_name" value="" size="54" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							</td>
							<td width="15%" class="form1" style="border-width:1px 0 1px 0; border-style:solid;" bgcolor="#F8F8F8"> 프로젝트 종류 <font color="red">*</font></td>
							<td width="35%" class="form2" style="border-width:1px 0 1px 0; border-style:solid;">
								<select name="sort" class="inputstyle2" style="height:20px; width:90px;">
									<option value="" selected> 선 택
									<option value="1"> 아파트(일반분양)
									<option value="2"> 아파트(조합)
									<option value="3"> 주상복합(아파트)
									<option value="4"> 주상복합(오피스텔)
									<option value="5"> 도시형생활주택
									<option value="6"> 근린생활시설
									<option value="7"> 레저(숙박)시설
									<option value="8"> 기 타
								</select>
								&nbsp;&nbsp;데이터정렬기준 <font color="red">*</font> : 동호수<input type="radio" name="data_cr" value="0">
								관리번호<input type="radio" name="data_cr" value="1">
							</td>
						</tr>
						<tr>
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 현장 주소 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('../member/zip_search.php','zipcode','address')" class="inputstyle_bt">
								<input type="text" name="zipcode1" value="" size="5" class="inputstyle2" readonly onKeydown="ZipWindow('../member/zip_search.php',1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
								<input type="text" name="zipcode2" value="" size="5" class="inputstyle2" readonly onKeydown="ZipWindow('../member/zip_search.php',1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<input type="text" name="address1" value="" size="51" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<input type="text" name="address2" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <font color="#788be2">나머지 주소</font>
							</td>
						</tr>
						<tr>
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 현장 연락처 </td>
							<td class="form2">
								Tel :
								<input type="text" name="local_tel" value="" size="20" maxlength="20" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								Fax :
								<input type="text" name="local_fax" value="" size="20" maxlength="20" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							</td>
							<td width="150" class="form1" bgcolor="#F8F8F8"> 현장 관리 책임자 </td>
							<td class="form2">
								<input type="text" name="pj_manager" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							</td>
						</tr>
						<tr>
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_1" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_1" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_1" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_1" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_1" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_1" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_1" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_1" id="ck2_1" onclick="type_reg('2',this,1);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_2" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_2" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_2" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_2" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_2" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_2" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_2" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_2" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_2" id="ck2_2" onclick="type_reg('2',this,2);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_3" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_3" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_3" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_3" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_3" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_3" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_3" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_3" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_3" id="ck2_3" onclick="type_reg('2',this,3);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_4" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_4" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_4" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_4" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_4" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_4" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_4" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_4" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_4" id="ck2_4" onclick="type_reg('2',this,4);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_5" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_5" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_5" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_5" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_5" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_5" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_5" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_5" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_5" id="ck2_5" onclick="type_reg('2',this,5);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_6" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_6" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_6" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_6" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_6" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_6" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_6" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_6" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_6" id="ck2_6" onclick="type_reg('2',this,6);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_7" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_7" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_7" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_7" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_7" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_7" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_7" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_7" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_7" id="ck2_7" onclick="type_reg('2',this,7);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_8" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_8" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_8" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_8" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_8" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_8" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_8" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_8" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_8" id="ck2_8" onclick="type_reg('2',this,8);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_9" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_9" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_9" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_9" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_9" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_9" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_9" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_9" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_9" id="ck2_9" onclick="type_reg('2',this,9);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_10" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_10" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_10" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_10" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_10" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_10" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_10" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_10" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
								<input type="checkbox" name="ck2_10" id="ck2_10" onclick="type_reg('2',this,10);"> 타입 추가
							</td>
						</tr>
						<tr id="type2_11" style="display:none">
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 타입별 물량 / 수수료 <font color="red">*</font></td>
							<td class="form2" colspan="3">
								타입 : <input type="text" name="type_11" size="5" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								타입컬러 : <input type="text" name="color_11" size="7" class="inputstyle2"  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								전체물량 : <input type="text" name="total_count_11" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								계약물량 : <input type="text" name="sell_count_11" size="5" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="count_unit_11" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대
									<option value="2"> 실
									<option value="3"> 호
									<option value="4"> ㎡
								</select> /
								수수료(<font color="#cc0000">천원</font>) : <input type="text" name="pay_11" size="8" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
								<select name="pay_con_11" class="inputstyle2" style="height:22px;">
									<option value="" selected> 선 택
									<option value="1"> 세대당
									<option value="2"> 공급가대비(%)
								</select>
							</td>
						</tr>
						<tr>
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 발주사명 <font color="red">*</font></td>
							<td  class="form2">
								<input type="text" name="client" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							</td>
							<td width="150" class="form1" bgcolor="#F8F8F8"> 발주사 담당자 <!-- <font color="red">*</font> --></td>
							<td  class="form2">
								<input type="text" name="client_res" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							</td>
						</tr>
						<tr>
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 발주사 담당자 연락처 <!-- <font color="red">*</font> --></td>
							<td  class="form2">
								<input type="text" name="client_res_tel" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							</td>
							<td width="150" class="form1" bgcolor="#F8F8F8"> 발주사 담당자 이메일 <!-- <font color="red">*</font> --></td>
							<td  class="form2">
								<input type="text" name="client_res_mail" value="" size="30" style="ime-mode:disabled;" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							</td>
						</tr>
						<tr>
							<td width="150" class="form1" bgcolor="#F8F8F8" height="25"> 계약 기간 <!-- <font color="red">*</font> --></td>
							<td  class="form2">
								<div style="float:left;">
									<input type="text" name="start_date" id="start_date" value="" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
									<a href="javascript:" onclick="cal_add(document.getElementById('start_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a> ~
								</div>
								<div style="float:left; padding-left:5px; margin-right:5px;">
									<input type="text" name="expiry_date" id="expiry_date" value="" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
									<a href="javascript:" onclick="cal_add(document.getElementById('expiry_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
								</div>
							</td>
							<td width="150" class="form1" bgcolor="#F8F8F8"> 계약 체결일 <font color="red">*</font></td>
							<td  class="form2">
								<input type="text" name="cont_date" id="cont_date" value="" size="25" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
								<a href="javascript:" onclick="cal_add(document.getElementById('cont_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
							</td>
						</tr>
						<tr>
							<td width="150" class="form1" bgcolor="#F8F8F8" style="padding:15px 0 30px 10px; border-width: 0 0 1xp 0; border-color:#B2BCDE; border-style: solid;"> 용역 수수료 특별조건<br>(Special Condition) <!-- <font color="red">*</font> --></td>
							<td  class="form2" colspan="3" style="padding:15px 0 30px 10px; border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;">
								<textarea name="pay_sp_con" rows="8" cols="120" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="height:100px;"></textarea>
							</td>
						</tr>
						<tr align="right" bgcolor="#F8F8F8">
							<td colspan="3" class="form2" height="48"></td>
							<?
								if($ct_2_2_row[ct_2_2]<2){
									$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
								}else{
									 $submit_str="con_formck();";
								}
							?>
							<td class="form2" style="padding:0 20px 0 0px"><input type="button" value=" 저장하기 " onclick="<?=$submit_str?>" class="submit_bt" style="height='28'"></td>
						</tr>
						</table>
						</form>
						</td>
					</tr>
					</table>
					</div>
					<? } ?>
