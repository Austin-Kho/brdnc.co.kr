					<!-- =====subject table end===== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 회사 기본정보</font></b>
						<div style="float:right;">
							<font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.
						</div>
					</div>
					<!-- =====subject table end===== -->
					<?
						$_m5_2_1_rlt = mysql_query("select _m5_2_1 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$_m5_2_1_row = mysql_fetch_array($_m5_2_1_rlt);

						if(!$_m5_2_1_row[_m5_2_1]||$_m5_2_1_row[_m5_2_1]==0){
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
						<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;" class="form2">
							<!-- <a href="javascript:" onClick="excel_pop('<?=$sa_2_1_row[sa_2_1]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
					<?
						$query="select * from cms_com_info";
						$result=mysql_query($query, $connect);
						$rows=mysql_fetch_array($result);

						if(!$rows){
							$mode = 'com_reg';
					?>
					<!-- ===== form1 start ===== -->
					<form name="form1" method="post" action="com_post.php">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="15%" class="form1" bgcolor="#F8F8F8" height="25">회사명 <font color="red">*</font></td>
						<td width="35%" class="form2">
							<input type="text" name="co_name" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td width="15%" class="form1" bgcolor="#F8F8F8">사업자등록번호 <font color="red">*</font></td>
						<td width="35%" class="form2">
							<input type="text" name="co_no1" size="5" maxlength="3" class="inputstyle2" onkeyup="focus_move(this,3,co_no2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_no2" size="4" maxlength="2" class="inputstyle2" onkeyup="focus_move(this,2,co_no3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_no3" size="8" maxlength="5" class="inputstyle2" onkeyup="focus_move(this,5,co_form);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="co_form" class="inputstyle2">
								<option value="" selected> 선택
								<option value="1"> 법인
								<option value="2"> 개인(일반)
								<option value="3"> 개인(간이)
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">대표자 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="ceo" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">법인(주민)등록번호 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="or_no1" size="8" maxlength="6" class="inputstyle2" onkeyup="focus_move(this,6,or_no2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="or_no2" size="9" maxlength="7" class="inputstyle2" onkeyup="focus_move(this,7,sur);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="sur" class="inputstyle2">
								<option value="" selected> 선택
								<option value="1"> 부가세 분기 신고
								<option value="2"> 부가세 반기 신고
								<option value="3"> 부가세 월별 신고
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">업태 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="biz_cond" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">종목 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="biz_even" value="" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">대표전화 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="co_phone1" value="" size="6" maxlength="3" class="inputstyle2" onkeyup="focus_move(this,3,co_phone2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_phone2" value="" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_phone3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_phone3" value="" size="7" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_hp1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">휴대전화(비상) <font color="red">*</font></td>
						<td class="form2">
							<select name="co_hp1" class="inputstyle2" onchange="co_hp2.focus();">
								<option value="" selected> 선택
								<option value="010"> 010
								<option value="011"> 011
								<option value="016"> 016
								<option value="017"> 017
								<option value="018"> 018
								<option value="019"> 019
							</select> -
							<input type="text" name="co_hp2" value="" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_hp3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_hp3" value="" size="7" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_fax1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">FAX</td>
						<td class="form2">
							<input type="text" name="co_fax1" value="" size="6" maxlength="3" class="inputstyle2" onkeyup="focus_move(this,3,co_fax2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_fax2" value="" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_fax3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_fax3" value="" size="7" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_div1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">기업구분</td>
						<td class="form2">
							<select name="co_div1" class="inputstyle2">
								<option value="1" selected> 중소기업
								<option value="2"> 비중소기업
							</select>
							<select name="co_div2" class="inputstyle2">
								<option value="1" selected> 중소기업
								<option value="2"> 일반
								<option value="3"> 상장
								<option value="4"> 비상장기업
								<option value="5"> 공공
								<option value="6"> 비영리
								<option value="7"> 협회등록
							</select>
							<select name="co_div3" class="inputstyle2">
								<option value="1" selected> 내국
								<option value="2"> 외국
								<option value="3"> 외투
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">설립일자 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="es_day" id="es_day" value="" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
							<a href="javascript:" onclick="cal_add(document.getElementById('es_day'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
						</td>
						<td class="form1" bgcolor="#F8F8F8">개업일자 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="op_day" id="op_day" value="" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
							<a href="javascript:" onclick="cal_add(document.getElementById('op_day'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">기초잔액 입력월 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="carr_y" value="" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,carr_m);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> 년
							<input type="text" name="carr_m" value="" size="3" maxlength="2" class="inputstyle2" onkeyup="focus_move(this,2,m_wo_st);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> 월
						</td>
						<td class="form1" bgcolor="#F8F8F8">업무개시월 <font color="red">*</font>/ 결산주기 <font color="red">*</font></td>
						<td class="form2">
							<select name="m_wo_st" class="inputstyle2">
								<option value="" selected> 선택
								<option value="1"> 01
								<option value="2"> 02
								<option value="3"> 03
								<option value="4"> 04
								<option value="5"> 05
								<option value="6"> 06
								<option value="7"> 07
								<option value="8"> 08
								<option value="9"> 09
								<option value="10"> 10
								<option value="11"> 11
								<option value="12"> 12
							</select> 월 /
							<select name="bl_cycle" class="inputstyle2">
								<option value="" selected> 선택
								<option value="1"> 01
								<option value="2"> 02
								<option value="3"> 03
								<option value="4"> 04
								<option value="6"> 06
								<option value="12"> 12
							</select> 개월
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">E-mail(비상) <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="email1" style="ime-mode:disabled;" size="12" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> @ <input type="text" name="email2" style="ime-mode:disabled;" size="12" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="email3" class="inputstyle2" onchange="email2.value=this.value">
								<option value="" selected> 직접입력
								<option value="naver.com"> 네이버
								<option value="hanmail.net"> 한메일
								<option value="daum.net"> 다음
								<option value="nate.com"> 네이트
								<option value="gmail.com"> 지메일
								<option value="kr.yahoo.com"> 야후
								<option value="korea.com"> 코리아닷컴
							</select>
						</td>
						<td class="form1" bgcolor="#F8F8F8">전자세금계산서 수신Email</td>
						<td class="form2">
							<input type="text" name="calc_mail1" style="ime-mode:disabled;" size="12" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> @ <input type="text" name="calc_mail2" style="ime-mode:disabled;" size="12" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="calc_mail3" class="inputstyle2" onchange="calc_mail2.value=this.value">
								<option value="" selected> 직접입력
								<option value="naver.com"> 네이버
								<option value="hanmail.net"> 한메일
								<option value="daum.net"> 다음
								<option value="nate.com"> 네이트
								<option value="gmail.com"> 지메일
								<option value="kr.yahoo.com"> 야후
								<option value="korea.com"> 코리아닷컴
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">세무서[1] <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="tax_off1_code" size="10" class="inputstyle2" readonly onclick="open_Win('<?=$cms_url?>_config/taxoff_search.php?n=1','taxoff')" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><a href="javascript:open_Win('<?=$cms_url?>_config/taxoff_search.php?n=1','taxoff')"><img src="../images/form_serch.jpg" height="20" border="0" alt="" /></a>
							<input type="text" name="tax_off1_name" size="14" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <a href="javascript:" onclick="document.form1.tax_off1_code.value=''; document.form1.tax_off1_name.value=''; ">삭제</a>
						</td>
						<td class="form1" bgcolor="#F8F8F8">세무서[2]</td>
						<td class="form2">
							<input type="text" name="tax_off2_code" size="10" class="inputstyle2" readonly onclick="open_Win('<?=$cms_url?>_config/taxoff_search.php?n=2','taxoff')" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><a href="javascript:open_Win('<?=$cms_url?>_config/taxoff_search.php?n=2','taxoff')"><img src="../images/form_serch.jpg" height="20" border="0" alt="" /></a>
							<input type="text" name="tax_off2_name" size="14" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <a href="javascript:" onclick="document.form1.tax_off2_code.value=''; document.form1.tax_off2_name.value=''; ">삭제</a>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">회사주소 <font color="red">*</font></td>
						<td class="form2" colspan="3">
							<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('../member/zip_search.php','zipcode','address')" class="inputstyle_bt">
							<input type="text" name="zipcode" size="6" class="inputstyle2" readonly onKeydown="ZipWindow('../member/zip_search.php',2)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<input type="text" name="address1" size="46" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<input type="text" name="address2" size="32" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <font color="#788be2">나머지 주소</font>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">회사 영문명</td>
						<td class="form2" colspan="3">
							<input type="text" name="en_co_name" size="40" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<font color="#788be2">기타소득 지급조서 신고가 있는 경우 입력</font>
						</td>
					</tr>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" style="border:0px;" height="45">회사 영문주소</td>
						<td style="color:#4B4B4B; padding:0 0 0 10px;" colspan="3">
							<input type="text" name="en_address" size="120" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><font color="#788be2"> <br>번지(number), 거리(street), 시(city), 도(state), 우편번호(postal code), 국가(country) 순으로 기재 </font>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f8f8f8" style="border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;" height="20"></td>
						<td colspan="3" style="border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;"></td>
					</tr>
					<tr align="right" bgcolor="#F8F8F8">
						<td colspan="3" class="form2" height="48"></td>
						<?
							if($_m5_2_1_row[_m5_2_1]<2){
								 $submit_str="alert('등록 권한이 없습니다!')";
							}else{
								 $submit_str="com_submit('$mode');";
							}
						?>
						<td class="form2" style="padding:0 20px 0 0px"><input type="button" value=" 저 장 하 기 " onclick="<?=$submit_str?>" class="submit_bt" style="height='28'"></td>
					</tr>
					</table>
					</form>
					<!-- ===== form1 end ===== -->



					<?
						} else {
							 $co_no=explode("-",$rows[co_no]);
							 $mode = 'com_modify';
					?>



					<!-- ===== form1 start ===== -->
					<form name="form1" method="post" action="com_post.php">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="seq" value="<?=$rows[seq]?>">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="15%" class="form1" bgcolor="#F8F8F8" height="25">회사명 <font color="red">*</font></td>
						<td width="35%" class="form2">
							<input type="text" name="co_name" value="<?=$rows[co_name]?>" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td width="15%" class="form1" bgcolor="#F8F8F8">사업자등록번호 <font color="red">*</font></td>
						<td width="35%" class="form2">

							<input type="text" name="co_no1" value="<?=$co_no[0]?>" size="5" maxlength="3" class="inputstyle2" onkeyup="focus_move(this,3,co_no2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_no2" value="<?=$co_no[1]?>" size="4" maxlength="2" class="inputstyle2" onkeyup="focus_move(this,2,co_no3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_no3" value="<?=$co_no[2]?>" size="8" maxlength="5" class="inputstyle2" onkeyup="focus_move(this,5,co_form);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="co_form" class="inputstyle2">
								<option value="" <? if(!$rows[co_form]) echo "selected"; ?>> 선택
								<option value="1" <? if($rows[co_form]=='1') echo "selected"; ?>> 법인
								<option value="2" <? if($rows[co_form]=='2') echo "selected"; ?>> 개인(일반)
								<option value="3" <? if($rows[co_form]=='3') echo "selected"; ?>> 개인(간이)
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">대표자 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="ceo" value="<?=$rows[ceo]?>" size="30" class="inputstyle2"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">법인(주민)등록번호 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="or_no1" value="<?=substr($rows[or_no],0,6)?>" size="8" maxlength="6" class="inputstyle2" onkeyup="focus_move(this,6,or_no2);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="or_no2" value="<?=substr($rows[or_no],7,7)?>" size="9" maxlength="7" class="inputstyle2" onkeyup="focus_move(this,7,sur);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="sur" class="inputstyle2">
								<option value="" <? if(!$rows[sur]) echo "selected"; ?>> 선택
								<option value="1" <? if($rows[sur]=='1') echo "selected"; ?>> 부가세 분기 신고
								<option value="2" <? if($rows[sur]=='2') echo "selected"; ?>> 부가세 반기 신고
								<option value="3" <? if($rows[sur]=='3') echo "selected"; ?>> 부가세 월별 신고
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">업태 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="biz_cond" value="<?=$rows[biz_cond]?>" size="30" class="inputstyle2"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">종목 <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="biz_even" value="<?=$rows[biz_even]?>" size="30" class="inputstyle2"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">대표전화 <font color="red">*</font></td>
						<td class="form2">
							<?
								$co_ph=explode("-",$rows[co_phone]);
							?>
							<input type="text" name="co_phone1" value="<?=$co_ph[0]?>" size="6" maxlength="3" class="inputstyle2" onkeyup="focus_move(this,3,co_phone2);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_phone2" value="<?=$co_ph[1]?>" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_phone3);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_phone3" value="<?=$co_ph[2]?>" size="7" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_hp1);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">휴대전화(비상) <font color="red">*</font></td>
						<td class="form2">
							<?
								$co_hp=explode("-",$rows[co_hp]);
							?>
							<select name="co_hp1" class="inputstyle2" onchange="co_hp2.focus();">
								<option value="" <? if(!$co_hp) echo "selected"; ?>> 선택
								<option value="010" <? if($co_hp[0]=='010') echo "selected"; ?>> 010
								<option value="011" <? if($co_hp[0]=='011') echo "selected"; ?>> 011
								<option value="016" <? if($co_hp[0]=='016') echo "selected"; ?>> 016
								<option value="017" <? if($co_hp[0]=='017') echo "selected"; ?>> 017
								<option value="018" <? if($co_hp[0]=='018') echo "selected"; ?>> 018
								<option value="019" <? if($co_hp[0]=='019') echo "selected"; ?>> 019
							</select> -
							<input type="text" name="co_hp2" value="<?=$co_hp[1]?>" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_hp3);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_hp3" value="<?=$co_hp[2]?>" size="7" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_fax1);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">FAX</td>
						<td class="form2">
							<?
								$co_fax=explode("-",$rows[co_fax]);
							?>
							<input type="text" name="co_fax1" value="<?=$co_fax[0]?>" size="6" maxlength="3" class="inputstyle2" onkeyup="focus_move(this,3,co_fax2);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_fax2" value="<?=$co_fax[1]?>" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_fax3);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> -
							<input type="text" name="co_fax3" value="<?=$co_fax[2]?>" size="7" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,co_div1);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
						</td>
						<td class="form1" bgcolor="#F8F8F8">기업구분</td>
						<td class="form2">
							<select name="co_div1" class="inputstyle2">
								<option value="1" <? if($rows[co_div1]=="1") echo "selected";?>> 중소기업
								<option value="2" <? if($rows[co_div1]=="2") echo "selected";?>> 비중소기업
							</select>
							<select name="co_div2" class="inputstyle2">
								<option value="1" <? if($rows[co_div2]=="1") echo "selected";?>> 중소기업
								<option value="2" <? if($rows[co_div2]=="2") echo "selected";?>> 일반
								<option value="3" <? if($rows[co_div2]=="3") echo "selected";?>> 상장
								<option value="4" <? if($rows[co_div2]=="4") echo "selected";?>> 비상장기업
								<option value="5" <? if($rows[co_div2]=="5") echo "selected";?>> 공공
								<option value="6" <? if($rows[co_div2]=="6") echo "selected";?>> 비영리
								<option value="7" <? if($rows[co_div2]=="7") echo "selected";?>> 협회등록
							</select>
							<select name="co_div3" class="inputstyle2">
								<option value="1" <? if($rows[co_div3]=="1") echo "selected";?>> 내국
								<option value="2" <? if($rows[co_div3]=="2") echo "selected";?>> 외국
								<option value="3" <? if($rows[co_div3]=="3") echo "selected";?>> 외투
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">설립일자 <font color="red">*</font></td>
						<td class="form2">
							<!-- <input type="text" name="es_day" id="es_day" value="<?=$rows[es_date]?>" size="15" readonly class="inputstyle2" onclick="openCalendar(this)"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<a href="javascript:" onclick="openCalendar(document.getElementById('es_day'));"><img src="../images/calendar.jpg" alt="날짜선택" border="0"></a> -->

							<input type="text" name="es_day" id="es_day" value="<?=$rows[es_date]?>" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
							<a href="javascript:" onclick="cal_add(document.getElementById('es_day'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>

						</td>
						<td class="form1" bgcolor="#F8F8F8">개업일자 <font color="red">*</font></td>
						<td class="form2">
							<!-- <input type="text" name="op_day" id="op_day" value="<?=$rows[op_date]?>" size="15" readonly class="inputstyle2" onclick="openCalendar(this)"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<a href="javascript:" onclick="openCalendar(document.getElementById('op_day'));"><img src="../images/calendar.jpg"	alt="날짜선택" border="0"></a><br> -->

							<input type="text" name="op_day" id="op_day" value="<?=$rows[op_date]?>" size="15" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
							<a href="javascript:" onclick="cal_add(document.getElementById('op_day'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">기초잔액 입력월 <font color="red">*</font></td>
						<td class="form2">
							<?
								 $carr = explode("-",$rows[carr]);
							?>
							<input type="text" name="carr_y" value="<?=$carr[0]?>" size="6" maxlength="4" class="inputstyle2" onkeyup="focus_move(this,4,carr_m);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> 년
							<input type="text" name="carr_m" value="<?=$carr[1]?>" size="3" maxlength="2" class="inputstyle2" onkeyup="focus_move(this,2,m_wo_st);"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> 월
						</td>
						<td class="form1" bgcolor="#F8F8F8">업무개시월 <font color="red">*</font>/ 결산주기 <font color="red">*</font></td>
						<td class="form2">
							<select name="m_wo_st" class="inputstyle2">
								<option value="" <? if(!$rows[m_wo_st]) echo "selected"; ?>> 선택
								<option value="1" <? if($rows[m_wo_st]=='1') echo "selected"; ?>> 01
								<option value="2" <? if($rows[m_wo_st]=='2') echo "selected"; ?>> 02
								<option value="3" <? if($rows[m_wo_st]=='3') echo "selected"; ?>> 03
								<option value="4" <? if($rows[m_wo_st]=='4') echo "selected"; ?>> 04
								<option value="5" <? if($rows[m_wo_st]=='5') echo "selected"; ?>> 05
								<option value="6" <? if($rows[m_wo_st]=='6') echo "selected"; ?>> 06
								<option value="7" <? if($rows[m_wo_st]=='7') echo "selected"; ?>> 07
								<option value="8" <? if($rows[m_wo_st]=='8') echo "selected"; ?>> 08
								<option value="9" <? if($rows[m_wo_st]=='9') echo "selected"; ?>> 09
								<option value="10" <? if($rows[m_wo_st]=='10') echo "selected"; ?>> 10
								<option value="11" <? if($rows[m_wo_st]=='11') echo "selected"; ?>> 11
								<option value="12" <? if($rows[m_wo_st]=='12') echo "selected"; ?>> 12
							</select> 월 /
							<select name="bl_cycle" class="inputstyle2">
								<option value="" <? if(!$rows[bl_cycle]) echo "selected"; ?>> 선택
								<option value="1" <? if($rows[bl_cycle]=='1') echo "selected"; ?>> 01
								<option value="2" <? if($rows[bl_cycle]=='2') echo "selected"; ?>> 02
								<option value="3" <? if($rows[bl_cycle]=='3') echo "selected"; ?>> 03
								<option value="4" <? if($rows[bl_cycle]=='4') echo "selected"; ?>> 04
								<option value="6" <? if($rows[bl_cycle]=='6') echo "selected"; ?>> 06
								<option value="12" <? if($rows[bl_cycle]=='12') echo "selected"; ?>> 12
							</select> 개월
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">E-mail(비상) <font color="red">*</font></td>
						<td class="form2">
							<?
								$e_mail = explode("@",$rows[email]);
							?>
							<input type="text" name="email1" style="ime-mode:disabled;" value="<?=$e_mail[0]?>" size="12" class="inputstyle2"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> @ <input type="text" name="email2" style="ime-mode:disabled;" value="<?=$e_mail[1]?>" size="12" class="inputstyle2"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="email3" class="inputstyle2" onchange="email2.value=this.value">
								<option value="" selected> 직접입력
								<option value="naver.com"> 네이버
								<option value="hanmail.net"> 한메일
								<option value="daum.net"> 다음
								<option value="nate.com"> 네이트
								<option value="gmail.com"> 지메일
								<option value="kr.yahoo.com"> 야후
								<option value="korea.com"> 코리아닷컴
							</select>
						</td>
						<td class="form1" bgcolor="#F8F8F8">전자세금계산서 수신Email</td>
						<td class="form2">
							<?
								$c_email = explode("@", $rows[calc_mail]);
							?>
							<input type="text" name="calc_mail1" style="ime-mode:disabled;" value="<?=$c_email[0]?>" size="12" class="inputstyle2"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> @ <input type="text" name="calc_mail2" style="ime-mode:disabled;" value="<?=$c_email[1]?>" size="12" class="inputstyle2"onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<select name="calc_mail3" class="inputstyle2" onchange="calc_mail2.value=this.value">
								<option value="" selected> 직접입력
								<option value="naver.com"> 네이버
								<option value="hanmail.net"> 한메일
								<option value="daum.net"> 다음
								<option value="nate.com"> 네이트
								<option value="gmail.com"> 지메일
								<option value="kr.yahoo.com"> 야후
								<option value="korea.com"> 코리아닷컴
							</select>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">세무서[1] <font color="red">*</font></td>
						<td class="form2">
							<input type="text" name="tax_off1_code" value="<?=$rows[tax_off1_code]?>" size="10" class="inputstyle2" readonly onclick="open_Win('<?=$cms_url?>_config/taxoff_search.php?n=1','taxoff')" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><a href="javascript:open_Win('<?=$cms_url?>_config/taxoff_search.php?n=1','taxoff')"><img src="../images/form_serch.jpg" height="20" border="0" alt="" /></a>
							<input type="text" name="tax_off1_name" value="<?=$rows[tax_off1_name]?>" size="14" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <a href="javascript:" onclick="document.form1.tax_off1_code.value=''; document.form1.tax_off1_name.value=''; ">삭제</a>
						</td>
						<td class="form1" bgcolor="#F8F8F8">세무서[2]</td>
						<td class="form2">
							<input type="text" name="tax_off2_code" value="<?if($rows[tax_off2_code]<>0) echo $rows[tax_off2_code];?>" size="10" class="inputstyle2" readonly onclick="open_Win('<?=$cms_url?>_config/taxoff_search.php?n=2','taxoff')" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><a href="javascript:open_Win('<?=$cms_url?>_config/taxoff_search.php?n=2','taxoff')"><img src="../images/form_serch.jpg" height="20" border="0" alt="" /></a>
							<input type="text" name="tax_off2_name" value="<?=$rows[tax_off2_name]?>" size="14" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <a href="javascript:" onclick="document.form1.tax_off2_code.value=''; document.form1.tax_off2_name.value=''; ">삭제</a>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">회사주소 <font color="red">*</font></td>
						<td class="form2" colspan="3">
							<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('../member/zip_search.php','zipcode','address')" class="inputstyle_bt">
							<input type="text" name="zipcode" value="<?=$rows[zipcode]?>" size="6" class="inputstyle2" readonly onKeydown="ZipWindow('../member/zip_search.php',2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<input type="text" name="address1" value="<?=$rows[address1]?>" size="46" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<input type="text" name="address2" value="<?=$rows[address2]?>" size="32" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> <font color="#788be2">나머지 주소</font>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" height="25">회사 영문명</td>
						<td class="form2" colspan="3">
							<input type="text" name="en_co_name" value="<?=$rows[en_co_name]?>" size="40" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<font color="#788be2">기타소득 지급조서 신고가 있는 경우 입력</font>
						</td>
					</tr>
					<tr>
						<td class="form1" bgcolor="#F8F8F8" style="border:0px;" height="45">회사 영문주소</td>
						<td style="color:#4B4B4B; padding:0 0 0 10px;" colspan="3">
							<input type="text" name="en_address" value="<?=$rows[en_address]?>" size="120" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
							<font color="#788be2"> <br>번지(number), 거리(street), 시(city), 도(state), 우편번호(postal code), 국가(country) 순으로 기재 </font>
						</td>
					</tr>
					<tr>
						<td bgcolor="#f8f8f8" style="border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;" height="20"></td>
						<td colspan="3" style="border-width: 0 0 1px 0; border-color:#B2BCDE; border-style: solid;"></td>
					</tr>
					<tr align="right" bgcolor="#F8F8F8">
						<td colspan="3" class="form2" height="48"></td>
						<?
							if($_m5_2_1_row[_m5_2_1]<2){
								 $submit_str="alert('등록 권한이 없습니다!')";
							}else{
								 $submit_str="com_submit('$mode');";
							}
						?>
						<td class="form2" style="padding:0 20px 0 0px"><input type="button" value=" 수 정 하 기 " onclick="<?=$submit_str?>" class="submit_bt" style="height='28'"></td>
					</tr>
					</table>
					</form>
					<? } ?>
					</td>
					</tr>
					</table>
					</div>
					<!-- ===== form1 end===== -->
					<? } ?>