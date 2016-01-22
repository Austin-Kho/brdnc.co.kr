					<!--------------------------------------------------subject table end---------------------------------------------------->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr height="30">
						<td class="d3_sub" bgcolor="#F8F8F8"><b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 입·출고 현황</font></b></td>
						<td align="right" valign="bottom" class="d3_sub" bgcolor="#F8F8F8"><!-- <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다. --></td>
					</tr>
					</table>
					<!--------------------------------------------------subject table end---------------------------------------------------->
					<div style="height:570px; padding-top:10px;">
					<div id="p_img_div" style="position:absolute; left:944px; top:153px; width:190px; border:1px solid #9EACC0; height:190px; z-index:1; display:none;">
					<img id="p_img" src="" width="190" height="190" border="0">
					</div>
					<div id="p_pr_div" style="position:absolute; left:945px; top:154px; width:190px; border:1px solid #9EACC0; height:20px; z-index:1; display:none; " align="center">
					<input type="text" id="info1" value="" size="30" style="border:0;"><br>
					<input type="text" id="info2" value="" size="30" style="border:0;"><br>
					<input type="text" id="info3" value="" size="30" style="border:0;"><br>
					<input type="text" id="info4" value="" size="30" style="border:0;"><br>
					<input type="text" id="info5" value="" size="30" style="border:0;">
					</div>
					<?
						$auth_qry = "select * from cms_member_table where user_id='$_SESSION[p_id]' ";
						$auth_rlt = mysql_query($auth_qry, $connect);
						$auth_row= mysql_fetch_array($auth_rlt);
						$auth_level=3;

						//echo $auth_row[group];

						$add_where=" where  cms_stock_main.accounts=cms_accounts.code ";

						/*
						if($division||$classify1||$classify2||$s_date||$e_date||$accounts||$sh_con||$sh_text){
							 $add_where.=" ";
						}
						*/
						if($division==2) $add_where.=" AND division=1 ";
						if($division==3) $add_where.=" AND division=2 ";
						if($sep) $add_where.=" AND classify='$sep' ";
						if($classify1) $add_where.=" AND category='$classify1' ";
						if($classify2) $add_where.=" AND brand='$classify2' ";
						if($s_date) $add_where.=" AND st_date >='$s_date' ";
						if($e_date) $add_where.=" AND st_date <='$e_date' ";
						if($accounts) $add_where.=" AND accounts='$accounts' ";

						if(!$arr||$arr==1){
							 $add_arr=" order	 by st_date desc, seq_num desc";
						} else if($arr==2){
							 $add_arr=" order	 by price_out, price_in ";
						} else {
							 $add_arr=" order	 by price_out desc, price_in desc ";
						}
						if($sh_text){
							 if($sh_con==1) $add_where.=" AND (si_name like '%$sh_text%' OR acc_name like '%$sh_text%' OR worker like '%$sh_text%' OR	category like '%$sh_text%' OR brand like '%$sh_text%' OR style like '%$sh_text%' OR color like '%$sh_text%' OR comp like '%$sh_text%') ";
							 if($sh_con==2) $add_where.=" AND (category like '%$sh_text%' OR brand like '%$sh_text%') ";
							 if($sh_con==3) $add_where.=" AND style like '%$sh_text%' ";
							 if($sh_con==4) $add_where.=" AND color like '%$sh_text%' ";
							 if($sh_con==5) $add_where.=" AND comp like '%$sh_text%' ";
						}
					?>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="right" class="form2" style="padding:0 20px 2px 0" valign="absmiddle">
							<a href="excel_storage_list.php?add_where=<?=urlencode($add_where)?>&add_arr=<?=$add_arr?>&total_qty=<?=$bbb[total_qty]?>&total_p_in=<?=$ddd[total_p_in]?>&total_p_set=<?=$fff[total_p_set]?>"><img src="../images/excel_icon.jpg" height="10" border="0"> EXCEL 출력</a>
						</td>
					</tr>
					</table>
					<table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
					<form method="post" name="in_out_frm" action="<?$_SERVER['PHP_SELF']?>">
					<input type="hidden" name="start" value="1">
					<tr>
						<td width="80" class="form1"bgcolor="#F8F8F8">구 분 </td>
						<td class="form2" width="180">
							<select name="division" style="width:72 " onChange="chk_sel(this.value,3)">
								<option value="1" <?if(!$division||$division==1) echo "selected";?>> 전 체
								<option value="2" <?if($division==2) echo "selected";?>> 입 고
								<option value="3" <?if($division==3) echo "selected";?>> 출 고
							</select>
							<select name="sep" style="width:72 ">
								<option value="" <?if(!$class) echo "selected";?>> 선 택
								<?
									$qry0="select classify from cms_stock_main group by classify ";
									$rlt0=mysql_query($qry0, $connect);
									for($i=0; $rs0=mysql_fetch_array($rlt0); $i++){
										 if($rs0[classify]==1) $cla="매입입고";
										 if($rs0[classify]==2) $cla="반품입고";
										 if($rs0[classify]==3) $cla="수탁입고";
										 if($rs0[classify]==4) $cla="위탁회수";
										 if($rs0[classify]==5) $cla="판매출고";
										 if($rs0[classify]==6) $cla="반품출고";
										 if($rs0[classify]==7) $cla="수탁반납";
										 if($rs0[classify]==8) $cla="위탁출고";
										 if($rs0[classify]==9) $cla="재고조정";
								?>
								<option value="<?=$rs0[classify]?>" <?if($sep==$rs0[classify]) echo "selected";?>> <?=$cla?>
								<? } ?>
							</select>
						</td>
						<td width="80" class="form1"bgcolor="#F8F8F8">분 류 별 </td>
						<td class="form2">
							<select name="classify1" style="width:120px" onChange="chk_sel(this.value,2);">
								<option value="" <?if(!$classify1) echo "selected";?>> 1차 분류
								<?
									$qry="select * from cms_stock_1st_classify";
									$rlt=mysql_query($qry, $connect);
									for($i=0; $rs=mysql_fetch_array($rlt); $i++){
								?>
										<option value="<?=$rs[classify]?>" <?if($classify1==$rs[classify]) echo "selected";?>> <?=$rs[classify]?>
								<? } ?>
							</select>&nbsp;
							<select name="classify2" style="width:120px" onLoad="chk_sel(classify1.value,2);">
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
						<iframe width='0' height='0' name="sel_frame" frameborder="0"></iframe>
						</td>
						<td width="80" class="form1"bgcolor="#F8F8F8">거래기간 </td>
						<td class="form2" colspan="2">
						<input type="text" name="s_date" id="s_date" value="<?=$s_date?>" class="inputStyle2" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; size="12">
						<a href="javascript:" onclick="openCalendar(document.getElementById('s_date'));"><img src="../images/calendar.jpg" border="0"></a> ~

						<input type="text" name="e_date" id="e_date" value="<?=$e_date?>" class="inputStyle2" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; size="12">
						<a href="javascript:" onclick="openCalendar(document.getElementById('e_date'));"><img src="../images/calendar.jpg" border="0"></a>
						<a href="#" onclick="today_();" title="오늘">오늘</a> &nbsp;<a href="#" onclick="to_del_();" title="지우기"><font color="#993300"><b>x</b></font></a>
						</td>
					</tr>
					<tr>
						<td class="form1"bgcolor="#F8F8F8">거래처별 </td>
						<td class="form2">
						<input type="hidden" name="acc_con" value="">
						<select name="accounts" style="width:150;">
							<option value="" <?if(!$accounts) echo "selected";?>> 선 택
							<?
								$acc_wh="";
							  if($division==2) $acc_wh="  and (acc_cla = '1' or acc_cla = '3') ";
								if($division==3) $acc_wh="  and acc_cla = '2' ";
								$qry1 = "select * from cms_accounts where si_name<>'LOSS' $acc_wh order by si_name ";
								$rlt1 = mysql_query($qry1, $connect);
								while($rs1 = mysql_fetch_array($rlt1)){
									 if($rs1[si_name]){$acc=$rs1[si_name];}else{$acc=$rs1[acc_name];}
							?>
							<option value="<?=$rs1[code]?>" <?if($accounts==$rs1[code]) echo "selected";?>> <?=$acc?>
							<? } ?>
						</select>
						</td>
						<td class="form1"bgcolor="#F8F8F8">정렬방식 </td>
						<td class="form2">
							<input type="radio" name="arr" value="1" <?if(!$arr||$arr=='1') echo "checked";?>> 최근 거래일순 <input type="radio" name="arr" value="2" <?if($arr=='2') echo "checked";?>> 낮은 가격순 <input type="radio" name="arr" value="3" <?if($arr=='3') echo "checked";?>> 높은 가격순
						</td>
						<td class="form1"bgcolor="#F8F8F8">
							<select name="sh_con">
								<option value="1" <?if($sh_con==1) echo "selected";?>> 통합검색
								<option value="2"<?if($sh_con==2) echo "selected";?>> 분 류 별
								<option value="3"<?if($sh_con==3) echo "selected";?>> 상 품 명
								<option value="4"<?if($sh_con==4) echo "selected";?>> 컬 러
								<option value="5"<?if($sh_con==5) echo "selected";?>> 재 질
							</select>
						</td>
						<td class="form2"><input type="text" name="sh_text" value="<?=$sh_text?>" size="28" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; onClick="this.value='' "></td>
						<td class="form2"><input type="button" value=" 검 색 " onclick="submit();" class="inputstyle1" style="height='23'; width='120';"></td>
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
							<td bgcolor="#EAEAEA" class="tb1">
								<input type="checkbox" name="" disabled>
							</td>
							<td bgcolor="#EAEAEA" class="tb1">거래 구분</td>
							<td bgcolor="#EAEAEA" class="tb1">거래 종류</td>
							<td bgcolor="#EAEAEA" class="tb1">거 래 처</td>
							<td width="90" bgcolor="#EAEAEA" class="tb1">이 미 지</td>
							<td bgcolor="#EAEAEA" class="tb1">카테고리</td>
							<td bgcolor="#EAEAEA" class="tb1">브랜드(BRAND)</td>
							<td bgcolor="#EAEAEA" class="tb1">스타일(STYLE)</td>
							<td width="78" bgcolor="#EAEAEA" class="tb1">컬러(COL)</td>
							<td width="78" bgcolor="#EAEAEA" class="tb1">재질(COMP)</td>
							<td width="58" bgcolor="#EAEAEA" class="tb1">수량(QTY)</td>
							<td bgcolor="#EAEAEA" class="tb1">거래 가격</td>
							<td bgcolor="#EAEAEA" class="tb1">거래 일자</td>
							<td bgcolor="#EAEAEA" class="tb1">등록처리</td>
							<td bgcolor="#EAEAEA" class="tb1">수정</td>
						</tr>
						<?
							$query="select * from cms_stock_main,cms_accounts $add_where";
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

							$query1="select * from cms_stock_main,cms_accounts $add_where $add_arr limit $s, $e";
							$result1=mysql_query($query1, $connect);

							if($total_bnum==0){
						?>
						<tr>
							<td align="center" height="38" class="tb2" colspan="15"> 등록 된 데이터가 없습니다. </td>
						</tr>
						<?
							}else{
							for($i=0; $rows1=mysql_fetch_array($result1); $i++){
								 $bunho=$total_bnum-($i+$cline)+1;

								 if($rows1[division]==1) $div="<font color='#ff3366'>[입고]</font>";
								 if($rows1[division]==2) $div="<font color='#3366cc'>[출고]</font>";

								 if($rows1[classify]==1) $cla="<font color='#ff3366'>매입입고</font>";
								 if($rows1[classify]==2) $cla="<font color='#ff0000'>반품입고</font>";
								 if($rows1[classify]==3) $cla="수탁입고";
								 if($rows1[classify]==4) $cla="위탁회수";
								 if($rows1[classify]==5) $cla="<font color='#3366cc'>판매출고</font>";
								 if($rows1[classify]==6) $cla="반품출고";
								 if($rows1[classify]==7) $cla="수탁반납";
								 if($rows1[classify]==8) $cla="위탁출고";
								 if($rows1[classify]==9) $cla="재고조정";

								 if($rows1[division]==1&&$rows1[classify]<>2){
										if($rows1[price_in]==0){$price="-";}else{$price=number_format($rows1[price_in]);}
								 }
								 if($rows1[division]==2||$rows1[classify]==2){
										if($rows1[price_out]==0){$price="-";}else{$price=number_format($rows1[price_out]);}
								 }
								 $sold_info_1=number_format($rows1[price_out]); // 출고가격
								 $sold_info_2=number_format($rows1[price_out]*$rows1[co_rate]); // 수수료액
								 $sold_info_3=number_format($rows1[price_out]-($rows1[price_out]*$rows1[co_rate])); // 정산예정액
								 $sold_info_4=number_format($rows1[price_in]); // 입고가격
								 $sold_info_5=number_format($rows1[price_out]-($rows1[price_out]*$rows1[co_rate])-$rows1[price_in]); // 판매이익
						?>
						<tr>
							<td align="center" height="30" class="tb2"><input type="checkbox" name="seq_num[]" value="<?=$rows1[seq_num]?>" disabled></td>
							<td height="30" style="padding:0 0 0 10px;" class="tb2"><?=$div?>&nbsp;</td>
							<td align="left" height="30" class="tb2"><?=$cla?>&nbsp;</td>
							<td align="left" height="30" class="tb2"><?=$rows1[si_name]?>&nbsp;</td>
							<td align="center" height="30" class="tb2">
								<img src="p_img/<?=$rows1[style]?>_<?=$rows1[color]?>.jpg" onError="this.src='p_img/no_image.jpg'" height="28" border="0" alt="" onmouseover="imgOver(this.src)" onmouseout="imgOut(this.src)">
							</td>
							<td align="left" height="30" class="tb2"><a href="javascript:" onmouseover="prOver('<?=$rows1[classify]?>','<?=$sold_info_1?>','<?=$sold_info_2?>','<?=$sold_info_3?>','<?=$sold_info_4?>','<?=$sold_info_5?>')" onmouseout="prOut()">
							<?=$rows1[category]?></a>&nbsp;</td>
							<td align="left" height="30" class="tb2"><a href="javascript:" onmouseover="prOver('<?=$rows1[classify]?>','<?=$sold_info_1?>','<?=$sold_info_2?>','<?=$sold_info_3?>','<?=$sold_info_4?>','<?=$sold_info_5?>')" onmouseout="prOut()">
							<?=stripslashes($rows1[brand])?></a>&nbsp;</td>
							<td align="left" height="30" class="tb2"><font color="#3a3a3a" ><a href="javascript:" onmouseover="prOver('<?=$rows1[classify]?>','<?=$sold_info_1?>','<?=$sold_info_2?>','<?=$sold_info_3?>','<?=$sold_info_4?>','<?=$sold_info_5?>')" onmouseout="prOut()"><?=$rows1[style]?></a></font>&nbsp;</td>
							<td align="left" height="30" class="tb2"><a href="javascript:" onmouseover="prOver('<?=$rows1[classify]?>','<?=$sold_info_1?>','<?=$sold_info_2?>','<?=$sold_info_3?>','<?=$sold_info_4?>','<?=$sold_info_5?>')" onmouseout="prOut()">
							<?=$rows1[color]?></a>&nbsp;</td>
							<td align="left" height="30" class="tb2"><?=$rows1[comp]?>&nbsp;</td>
							<td align="right" height="30" style="padding:0 10 0 0px;" class="tb2"><?=number_format($rows1[qty])?>&nbsp;</td>
							<td align="right" height="30" style="padding:0 10 0 0px;" class="tb2"><?=$price?>&nbsp;</td>
							<!-- <td align="right" height="30" style="padding:0 10 0 0px;" class="tb2"><?=number_format($rows1[set_price])?></td> -->
							<td align="center" height="30" class="tb2"><?=$rows1[st_date]?>&nbsp;</td>
							<td align="center" height="30" class="tb2"><?=$rows1[worker]?>&nbsp;</td>
							<td align="center" height="30" class="tb2">
							<a href="javascript:" onClick="edit_pop('storage_edit.php?division=<?=$rows1[division]?>&edit_code=<?=$rows1[seq_num]?>','storage_edit')"><font color="#3366cc">[Edit]</font></a>
							</td>
						</tr>
						<?
							 }}
							 mysql_free_result($result1);
						?>
						<tr>
							<td height="32" align="center" colspan="14">
								<?
									$url="storage1.php?gb=1";
									page_avg3($total_bnum,$page_num, $index_num,$start);
									//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 3. 시작페이지
								?>
							</td>
						</tr>
						</table><p>

						<table width="100%" border="0" cellspacing="0" cellpadding="0" bordercolor="#D6D6D6" width="250" style="border-collapse:collapse; border:1px solid #D6D6D6">
						<tr height="35" align="center">
						<?
							 if($add_where){
									$add_w1=$add_where." and division='1' ";
									$add_w2=$add_where." and division='2' ";
							 } else {
									$add_w1=" where division='1' ";
									$add_w2=" where division='2' ";
							 }
							 $st_in="select sum(qty) AS tl_qty from cms_stock_main,cms_accounts $add_w1 ";
							 $aaa=mysql_query($st_in, $connect);
							 $bbb=mysql_fetch_array($aaa);

							 $total_p_in="select sum(qty*price_in) AS total_p_in from cms_stock_main,cms_accounts $add_w1 ";
							 $ccc=mysql_query($total_p_in, $connect);
							 $ddd=mysql_fetch_array($ccc);

							 $st_out="select sum(qty) AS total_qty from cms_stock_main,cms_accounts $add_w2 ";
							 $eee=mysql_query($st_out, $connect);
							 $fff=mysql_fetch_array($eee);

							 $total_p_out="select sum(qty*price_out) AS total_p_out from cms_stock_main,cms_accounts $add_w2 ";
							 $ggg=mysql_query($total_p_out, $connect);
							 $hhh=mysql_fetch_array($ggg);

							 if($bbb[tl_qty]==0){$tl_qty="-";}else{$tl_qty=number_format($bbb[tl_qty])." PCS";}
							 if($ddd[total_p_in]==0){$total_p_in="-";}else{$total_p_in=number_format($ddd[total_p_in])." 원";}
							 if($fff[total_qty]==0){$total_qty="-";}else{$total_qty=number_format($fff[total_qty])." PCS";}
							 if($hhh[total_p_out]==0){$total_p_out="-";}else{$total_p_out=number_format($hhh[total_p_out])." 원";}

						?>
							<td width="8%" bgcolor="#fff0fc"> 총 입고수량 </td>
							<td width="12%"><?=$tl_qty?></td>
							<td width="8%" bgcolor="#fff0fc">입고합계가액</td>
							<td width="12%"><?=$total_p_in?></td>
							<td width="8%" bgcolor="#f0f0ff"> 총 출고수량 </td>
							<td width="12%"><?=$total_qty?></td>
							<td width="8%" bgcolor="#f0f0ff">출고합계가액</td>
							<td width="12%"><?=$total_p_out?></td>
						</tr>
						</table>
						</div>
