					<!--------------------------------------------------subject table end---------------------------------------------------->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr height="30">
						<td class="d3_sub" bgcolor="#F8F8F8"><b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 재고 현황</font></b></td>
						<td align="right" valign="bottom" class="d3_sub" bgcolor="#F8F8F8"><!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. -->&nbsp;</td>
					</tr>
					</table>
					<!--------------------------------------------------subject table end---------------------------------------------------->
					<div style="height:570px; padding-top:10px;">
					<?
						$add_where="";

							if($classify1||$classify2||$s_date||$e_date||$sh_con||$sh_text||$accounts||$arr){
								 $add_where.="where 1=1";
							}
							if($classify1) $add_where.=" AND category='$classify1' ";
							if($classify2) $add_where.=" AND brand='$classify2' ";
							if($s_date) $add_where.=" AND st_date >='$s_date' ";
							if($e_date) $add_where.=" AND st_date <='$e_date' ";
							if($accounts) $add_where.=" AND accounts='$accounts' ";

							if(!$arr||$arr==1){
								 $add_arr=" order	 by st_date desc, seq_num desc";
							} else if($arr==2){
								 $add_arr=" order	 by price_in ";
							} else {
								 $add_arr=" order	 by price_in desc ";
							}
							if($sh_text){
								 if($sh_con==1) $add_where.=" AND (accounts like '%$sh_text%' OR worker like '%$sh_text%' OR	category like '%$sh_text%' OR brand like '%$sh_text%' OR style like '%$sh_text%' OR color like '%$sh_text%' OR comp like '%$sh_text%') ";
								 if($sh_con==2) $add_where.=" AND (category like '%$sh_text%' OR brand like '%$sh_text%') ";
								 if($sh_con==3) $add_where.=" AND style like '%$sh_text%' ";
								 if($sh_con==4) $add_where.=" AND color like '%$sh_text%' ";
								 if($sh_con==5) $add_where.=" AND comp like '%$sh_text%' ";
							}

							$total_qty=" SELECT SUM(qty) AS total_qty
											 FROM (SELECT seq_num, category, brand, style, color, comp, price_in, accounts, worker, st_date,
													 ( CASE division WHEN '1' THEN qty ELSE (- qty) END ) AS qty FROM cms_stock_main)
											 AS cms_stock_main $add_where ";
							$aaa=mysql_query($total_qty, $connect);
							$bbb=mysql_fetch_array($aaa);

							$total_p_in= " SELECT SUM(qty*price_in) AS total_p_in
												FROM (SELECT seq_num, category, brand, style, color, comp, price_in, accounts, worker, st_date,
													 	( CASE division WHEN '1' THEN qty ELSE (-qty) END ) AS qty
												FROM cms_stock_main) AS cms_stock_main_ $add_where  ";
							$ccc=mysql_query($total_p_in, $connect);
							$ddd=mysql_fetch_array($ccc);

							$total_p_set= " SELECT SUM(qty * set_price) AS total_p_set
												 FROM (SELECT seq_num, category, brand, style, color, comp, price_in, set_price, accounts, worker, st_date,
													 	 ( CASE division WHEN '1' THEN qty ELSE (- qty) END ) AS qty
												 FROM cms_stock_main) AS cms_stock_main $add_where  ";
							$eee=mysql_query($total_p_set, $connect);
							$fff=mysql_fetch_array($eee);
					?>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="right" class="form2" style="padding:0 20px 2px 0;" valign="top">
							<a href="excel_stock_list.php?add_where=<?=urlencode($add_where)?>&add_arr=<?=$add_arr?>&total_qty=<?=$bbb[total_qty]?>&total_p_in=<?=$ddd[total_p_in]?>&total_p_set=<?=$fff[total_p_set]?>"><img src="../images/excel_icon.jpg" height="10" border="0"> EXCEL 출력</a><!--  -->
						</td>
					</tr>
					</table>
					<div id="p_img_div" style="position:absolute; left:944px; top:153px; width:163px; border:1px solid #9EACC0; height:134px; z-index:1; display:none;">
					<img id="p_img" src="" width="190" height="190" border="0">
					</div>

					<table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
					<form method="post" name="st_sh_frm" action="<?$_SERVER['PHP_SELF']?>">
					<input type="hidden" name="start" value="1">
					<tr>
						<td width="80" class="form1"bgcolor="#F8F8F8">분 류 별 </td>
						<td class="form2">
							<select name="classify1" style="width:90" onChange="chk_sel(this.value,1);">
								<option value="" <?if(!$classify1) echo "selected";?>> 1차 분류
								<?
									$qry="select * from cms_stock_1st_classify";
									$rlt=mysql_query($qry, $connect);
									for($i=0; $rs=mysql_fetch_array($rlt); $i++){
								?>
										<option value="<?=$rs[classify]?>" <?if($classify1==$rs[classify]) echo "selected";?>> <?=$rs[classify]?>
								<? } ?>
							</select>
							<select name="classify2" style="width:90" onLoad="chk_sel(classify1.value,1);">
								<option value="" <?if(!$classify2) echo "selected";?>> 2차 분류
								<?
									$qry1="select * from cms_stock_2nd_classify where 1st_classify='$classify1' ";
									$rlt1=mysql_query($qry1, $connect);
									for($i=0; $rs1=mysql_fetch_array($rlt1); $i++){
										 if($classify1){
								?>
										<option value="<?=$rs1[classify]?>" <?if($classify2==$rs1[classify]) echo "selected";?>> <?=stripslashes($rs1[classify])?>
								<? }} ?>
							</select>
						<iframe width='0' height='0' name="sel_frame"></iframe>
						</td>
						<td width="80" class="form1"bgcolor="#F8F8F8">입고기간 </td>
						<td class="form2">
						<input type="text" name="s_date" id="s_date" value="<?=$s_date?>" class="inputStyle2" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; size="18">
						<a href="javascript:" onclick="openCalendar(document.getElementById('s_date'));"><img src="../images/calendar.jpg" border="0"></a> ~

						<input type="text" name="e_date" id="e_date" value="<?=$e_date?>" class="inputStyle2" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; size="18">
						<a href="javascript:" onclick="openCalendar(document.getElementById('e_date'));"><img src="../images/calendar.jpg" border="0"></a> &nbsp;&nbsp;
						<a href="javascript:" onclick="today_();" title="오늘">오늘</a> &nbsp;<a href="#" onclick="to_del_();">
						<img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="삭제"><!-- <font color="#993300"><b>x</b> --></font></a>
						</td>

						<td width="180" bgcolor="#F8F8F8" rowspan="2" style="padding:0 0 0 20px; border-width: 0 0 1px 1px; border-color:#CFCFCF; border-style: solid;">
							<select name="sh_con">
								<option value="1" <?if($sh_con==1) echo "selected";?>> 통합검색
								<option value="2"<?if($sh_con==2) echo "selected";?>> 분 류 별
								<option value="3"<?if($sh_con==3) echo "selected";?>> 상 품 명
								<option value="4"<?if($sh_con==4) echo "selected";?>> 컬 러
								<option value="5"<?if($sh_con==5) echo "selected";?>> 재 질
							</select><br>
							<input type="text" name="sh_text" value="<?=$sh_text?>" size="30" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; onClick="this.value='' ">
						</td>
						<td class="form2" rowspan="2"><input type="button" value=" 검 색 " onclick="submit();" class="inputstyle1" style="height='50'; width='110';"></td>
					</tr>
					<tr>
						<td class="form1"bgcolor="#F8F8F8">입고처별 </td>
						<td class="form2">
						<select name="accounts" style="width:185;">
							<option value="" <?if(!$accounts) echo "selected";?>> 전 체
							<?
								$qry1 = "select * from cms_stock_main, cms_accounts where division='1' and cms_stock_main.accounts=cms_accounts.code group by accounts";
								$rlt1 = mysql_query($qry1, $connect);
								while($rs1 = mysql_fetch_array($rlt1)){
							?>
							<option value="<?=$rs1[code]?>" <?if($accounts==$rs1[code]) echo "selected";?>> <?=$rs1[si_name]?>
							<? } ?>
						</select>
						</td>
						<td class="form1"bgcolor="#F8F8F8">정렬방식 </td>
						<td class="form2">
							<input type="radio" name="arr" value="1" <?if(!$arr||$arr=='1') echo "checked";?>> 최근 입고일순 <input type="radio" name="arr" value="2" <?if($arr=='2') echo "checked";?>> 낮은 가격순 <input type="radio" name="arr" value="3" <?if($arr=='3') echo "checked";?>> 높은 가격순
						</td>
					</tr>
					</form>
					</table>

					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<!-- <tr>
						<td class="form2">&nbsp;</td>
					</tr> -->
					</table><p>


					<table border="0" width="100%" cellspacing="0" cellpadding="0">
						<tr align="center" height="35">
							<td width="30" bgcolor="#EAEAEA" class="tb1">
								<input type="checkbox" name="" disabled>
							</td>
							<td width="100" bgcolor="#EAEAEA" class="tb1">이 미 지</td>
							<td width="100" bgcolor="#EAEAEA" class="tb1">카테고리</td>
							<td width="90" bgcolor="#EAEAEA" class="tb1">브랜드(BRAND)</td>
							<td width="130" bgcolor="#EAEAEA" class="tb1">스타일(STYLE)</td>
							<td width="100" bgcolor="#EAEAEA" class="tb1">컬러(COLOR)</td>
							<td width="152" bgcolor="#EAEAEA" class="tb1">재질(COMP.)</td>
							<td width="60" bgcolor="#EAEAEA" class="tb1">수량(QTY.)</td>
							<td width="100" bgcolor="#EAEAEA" class="tb1">입고 단가</td>
							<td width="100" bgcolor="#EAEAEA" class="tb1">책정 단가</td>
							<td width="100" bgcolor="#EAEAEA" class="tb1">입고 일자</td>
						</tr>
						<?
							$query="SELECT seq_num, category, brand, style, color,comp, price_in, accounts, worker, st_date,  SUM(qty) AS st_qty
													FROM (SELECT seq_num, category, brand, style, color, comp, price_in, accounts, worker, st_date,
																				( CASE division WHEN '1' THEN qty ELSE (- qty) END )
													AS qty FROM cms_stock_main) AS cms_stock_main $add_where
													GROUP BY style, color having st_qty>0";
							$result=mysql_query($query, $connect);
							$total_bnum=mysql_num_rows($result);     // 총 게시물 수   11111111111111111111
							mysql_free_result($result);

							$page=$_GET['page'];
							$gb=$_REQUEST['gb'];

							$index_num = 8;                 // 한 페이지 표시할 목록 개수 22222222222222
							$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
							$start=$_REQUEST['start'];
							if(!$start) $start = 1;              // 현재페이지 444444444
							$s = ($start-1)*$index_num;
							$e = $index_num;

							$query1="SELECT seq_num, category, brand, style, color,comp, price_in, price_out, set_price, accounts, worker, st_date, SUM(qty) AS st_qty
														FROM (SELECT seq_num, category, brand, style, color,comp, price_in, price_out, set_price, accounts, worker, st_date,
																				( CASE division WHEN '1' THEN qty ELSE (- qty) END )
														AS qty FROM cms_stock_main) AS cms_stock_main $add_where
													  GROUP BY style, color having st_qty>0 $add_arr limit $s, $e";
							$result1=mysql_query($query1, $connect);
							if($total_bnum==0){
						?>
						<tr>
							<td align="center" height="38" class="tb2" colspan="11"> 등록 된 데이터가 없습니다. </td>
						</tr>
						<?
							}else{
							for($i=0; $rows1=mysql_fetch_array($result1); $i++){
								 $bunho=$total_bnum-($i+$cline)+1;
						?>
						<tr>
							<td align="center" height="30" class="tb2"><input type="checkbox" name="seq_num[]" value="<?=$rows2[seq_num]?>" disabled></td>
							<td align="center" height="30" class="tb2">
								<img src="p_img/<?=$rows1[style]?>_<?=$rows1[color]?>.jpg" onError="this.src='p_img/no_image.jpg'; " height="28" border="0" alt="" onmouseover="imgOver(this.src)" onmouseout="imgOut(this.src)">
							</td>
							<td height="30" style="padding:0 0 0 10px;border-width: 0 0 1px 0; border-color:#E1E1E1; border-style: solid;"><?=$rows1[category]?>&nbsp;</td>
							<td align="left" height="30" class="tb2"><?=stripslashes($rows1[brand])?>&nbsp;</td>
							<td align="left" height="30" class="tb2"><font color="#3a3a3a"><?=$rows1[style]?></font>&nbsp;</td>
							<td align="left" height="30" class="tb2"><?=$rows1[color]?>&nbsp;</td>
							<td align="left" height="30" class="tb2"><?=$rows1[comp]?>&nbsp;</td>
							<td align="right" height="30" style="padding:0 10px 0 0px;" class="tb2"><?=number_format($rows1[st_qty])?>&nbsp;</td>
							<td align="right" height="30" style="padding:0 10px 0 0px;" class="tb2"><?=number_format($rows1[price_in])?>&nbsp;</td>
							<td align="right" height="30" style="padding:0 10 px0 0px;" class="tb2"><?=number_format($rows1[set_price])?></td>
							<td align="center" height="30" class="tb2"><?=$rows1[st_date]?>&nbsp;</td>
						</tr>
						<?
							 }}
							 mysql_free_result($result1);
						?>
						<tr>
							<td height="32" align="center" colspan="11">
								<?
									$url="message_1.php?gb=1";
									page_avg3($total_bnum,$page_num, $index_num,$start);
									//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 3. 시작페이지
								?>
							</td>
						</tr>
						</table><p>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolor="#D6D6D6" width="250" style="border-collapse:collapse; border:1px solid #D6D6D6">
						<tr height="35" align="center">
							<?
								if($bbb[total_qty]==0){$total_qty_="-";}else{$total_qty_=number_format($bbb[total_qty])." PCS";}
								if($ddd[total_p_in]==0){$total_p_in_="-";}else{$total_p_in_=number_format($ddd[total_p_in])." 원";}
								if($fff[total_p_set]==0){$total_p_set_="-";}else{$total_p_set_=number_format($fff[total_p_set])." 원";}
							?>
							<td width="8%" bgcolor="#f0f0ff"> TOTAL 수량 </td>
							<td width="12%"><?=$total_qty_?></td>
							<td width="8%" bgcolor="#f0f0ff">입고가 기준 합계</td>
							<td width="12%"><?=$total_p_in_?></td>
							<td width="8%" bgcolor="#f0f0ff">책정가 기준 합계</td>
							<td width="12%"><?=$total_p_set_?></td>
						</tr>
						</table>
						</div>
