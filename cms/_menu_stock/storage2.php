					<!--------------------------------------------------subject table end---------------------------------------------------->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr height="30">
						<td class="d3_sub" bgcolor="#F8F8F8"><b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 출고 등록</font></b></td>
						<td align="right" valign="bottom" class="d3_sub" bgcolor="#F8F8F8"><font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.</td>
					</tr>
					</table>
					<!--------------------------------------------------subject table end---------------------------------------------------->
					<div style="height:570px; padding-top:10px;">
					<?
						$java_qry="select * from cms_accounts where code='18'";
						$java_rlt=mysql_query($java_qry, $connect);
						$java_rows=mysql_fetch_array($java_rlt);
					?>
					<script type="text/javascript">
					<!--
						function cate_chk(ref,name) {
							 var window_left = (screen.width-640)/2;
							 var window_top = (screen.height-480)/2;
							 window.open(ref,name,'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
						}

						function row_reset2(no){
							 var form = document.out_stock_frm;

							 if(no==1){form.category_1.value="";form.brand_1.value="";form.style_1.value="";form.color_1.value="";form.comp_1.value="";form.qty_1.value="";form.classify_1.options[0].selected =1;	form.account_out_1.value="";form.price_out_1.value="";}
							 if(no==2){form.category_2.value="";form.brand_2.value="";form.style_2.value="";form.color_2.value="";form.comp_2.value="";form.qty_2.value="";form.classify_2.options[0].selected =1;	form.account_out_2.value="";form.price_out_2.value="";}
							 if(no==3){form.category_3.value="";form.brand_3.value="";form.style_3.value="";form.color_3.value="";form.comp_3.value="";form.qty_3.value="";form.classify_3.options[0].selected =1;	form.account_out_3.value="";form.price_out_3.value="";}
							 if(no==4){form.category_4.value="";form.brand_4.value="";form.style_4.value="";form.color_4.value="";form.comp_4.value="";form.qty_4.value="";form.classify_4.options[0].selected =1;	form.account_out_4.value="";form.price_out_4.value="";}
							 if(no==5){form.category_5.value="";form.brand_5.value="";form.style_5.value="";form.color_5.value="";form.comp_5.value="";form.qty_5.value="";form.classify_5.options[0].selected =1;	form.account_out_5.value="";form.price_out_5.value="";}
							 if(no==6){form.category_6.value="";form.brand_6.value="";form.style_6.value="";form.color_6.value="";form.comp_6.value="";form.qty_6.value="";form.classify_6.options[0].selected =1;	form.account_out_6.value="";form.price_out_6.value="";}
							 if(no==7){form.category_7.value="";form.brand_7.value="";form.style_7.value="";form.color_7.value="";form.comp_7.value="";form.qty_7.value="";form.classify_7.options[0].selected =1;	form.account_out_7.value="";form.price_out_7.value="";}
							 if(no==8){form.category_8.value="";form.brand_8.value="";form.style_8.value="";form.color_8.value="";form.comp_8.value="";form.qty_8.value="";form.classify_8.options[0].selected =1;	form.account_out_8.value="";form.price_out_8.value="";}
							 if(no==9){form.category_9.value="";form.brand_9.value="";form.style_9.value="";form.color_9.value="";form.comp_9.value="";form.qty_9.value="";form.classify_9.options[0].selected =1;	form.account_out_9.value="";form.price_out_9.value="";}
							 if(no==10){form.category_10.value="";form.brand_10.value="";form.style_10.value="";form.color_10.value="";form.comp_10.value="";form.qty_10.value="";form.classify_10.options[0].selected =1;	form.account_out_10.value="";form.price_out_10.value="";}
						}

						function price_in(fn){
							 var form = document.out_stock_frm;
							 switch(fn){
									case 1 : if(form.classify_1.value==9){form.account_out_1.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_1.value=form.price_in_1.value;}else if(form.classify_1.value==6){form.account_out_1.value="";form.price_out_1.value=form.price_in_1.value;}else{form.account_out_1.value="";form.price_out_1.value="";}
										 break;
									case 2 : if(form.classify_2.value==9){form.account_out_2.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_2.value=form.price_in_2.value;}else if(form.classify_2.value==6){form.account_out_2.value="";form.price_out_2.value=form.price_in_2.value;}else{form.account_out_2.value="";form.price_out_2.value="";}
										 break;
									case 3 : if(form.classify_3.value==9){form.account_out_3.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_3.value=form.price_in_3.value;}else if(form.classify_3.value==6){form.account_out_3.value="";form.price_out_3.value=form.price_in_3.value;}else{form.account_out_3.value="";form.price_out_3.value="";}
										 break;
									case 4 : if(form.classify_4.value==9){form.account_out_4.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_4.value=form.price_in_4.value;}else if(form.classify_4.value==6){form.account_out_4.value="";form.price_out_4.value=form.price_in_4.value;}else{form.account_out_4.value="";form.price_out_4.value="";}
										 break;
									case 5 : if(form.classify_5.value==9){form.account_out_5.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_5.value=form.price_in_5.value;}else if(form.classify_5.value==6){form.account_out_5.value="";form.price_out_5.value=form.price_in_5.value;}else{form.account_out_5.value="";form.price_out_5.value="";}
										 break;
									case 6 : if(form.classify_6.value==9){form.account_out_6.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_6.value=form.price_in_6.value;}else if(form.classify_6.value==6){form.account_out_6.value="";form.price_out_6.value=form.price_in_6.value;}else{form.account_out_6.value="";form.price_out_6.value="";}
										 break;
									case 7 : if(form.classify_7.value==9){form.account_out_7.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_7.value=form.price_in_7.value;}else if(form.classify_7.value==6){form.account_out_7.value="";form.price_out_7.value=form.price_in_7.value;}else{form.account_out_7.value="";form.price_out_7.value="";}
										 break;
									case 8 : if(form.classify_8.value==9){form.account_out_8.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_8.value=form.price_in_8.value;}else if(form.classify_8.value==6){form.account_out_8.value="";form.price_out_8.value=form.price_in_8.value;}else{form.account_out_8.value="";form.price_out_8.value="";}
										 break;
									case 9 : if(form.classify_9.value==9){form.account_out_9.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_9.value=form.price_in_9.value;}else if(form.classify_9.value==6){form.account_out_9.value="";form.price_out_9.value=form.price_in_9.value;}else{form.account_out_9.value="";form.price_out_9.value="";}
										 break;
									case 10 : if(form.classify_10.value==9){form.account_out_10.value="<?=$java_rows[si_name]?>"+"-"+"<?=$java_rows[code]?>";form.price_out_10.value=form.price_in_10.value;}else if(form.classify_10.value==6){form.account_out_10.value="";form.price_out_10.value=form.price_in_10.value;}else{form.account_out_10.value="";form.price_out_10.value="";}
										 break;
							 }
						}

						function out_stock_chk(){
							 var form = document.out_stock_frm;

							 if(!form.st_date.value){
									alert('출고 일자를 입력하세요!');
									form.st_date.focus();
									return;
							 }
							 if(!form.style_1.value&&!form.style_2.value&&!form.style_3.value&&!form.style_4.value&&!form.style_5.value&&!form.style_6.value&&!form.style_7.value&&!form.style_8.value&&!form.style_9.value&&!form.style_10.value){
									alert('하나 이상의 상품 목록을 기재하세요!');
									if(!form.style_1.value){
										 form.style_1.focus();
										 return;
									}
									form.style_1.focus();
							 }

							 if(form.style_1.value){if(!form.qty_1.value){alert('출고수량을 입력하세요!');form.qty_1.focus();return;}if(form.qty_1.value==0||form.qty_1.value>form.stock_1.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_1.focus();return;}if(!form.classify_1.value){alert('출고사유를 선택하세요!');form.classfy_1.focus();return;}if(form.classify_1.value<9&&!form.account_out_1.value){alert('출고처를 선택하세요!');form.account_out_1.focus();return;}if(form.classify_1.value==1&&!form.price_out_1.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_1.focus();return;}}

							 if(form.style_2.value){if(!form.qty_2.value){alert('출고수량을 입력하세요!');form.qty_2.focus();return;}if(form.qty_2.value==0||form.qty_2.value>form.stock_2.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_2.focus();return;}if(!form.classify_2.value){alert('출고사유를 선택하세요!');form.classfy_2.focus();return;}if(form.classify_2.value<9&&!form.account_out_2.value){alert('출고처를 선택하세요!');form.account_out_2.focus();return;}if(form.classify_2.value==1&&!form.price_out_2.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_2.focus();return;}}

							 if(form.style_3.value){if(!form.qty_3.value){alert('출고수량을 입력하세요!');form.qty_3.focus();return;}if(form.qty_3.value==0||form.qty_3.value>form.stock_3.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_3.focus();return;}if(!form.classify_3.value){alert('출고사유를 선택하세요!');form.classfy_3.focus();return;}if(form.classify_3.value<9&&!form.account_out_3.value){alert('출고처를 선택하세요!');form.account_out_3.focus();return;}if(form.classify_3.value==1&&!form.price_out_3.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_3.focus();return;}}

							 if(form.style_4.value){if(!form.qty_4.value){alert('출고수량을 입력하세요!');form.qty_4.focus();return;}if(form.qty_4.value==0||form.qty_4.value>form.stock_4.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_4.focus();return;}if(!form.classify_4.value){alert('출고사유를 선택하세요!');form.classfy_4.focus();return;}if(form.classify_4.value<9&&!form.account_out_4.value){alert('출고처를 선택하세요!');form.account_out_4.focus();return;}if(form.classify_4.value==1&&!form.price_out_4.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_4.focus();return;}}

							 if(form.style_5.value){if(!form.qty_5.value){alert('출고수량을 입력하세요!');form.qty_5.focus();return;}if(form.qty_5.value==0||form.qty_5.value>form.stock_5.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_5.focus();return;}if(!form.classify_5.value){alert('출고사유를 선택하세요!');form.classfy_5.focus();return;}if(form.classify_5.value<9&&!form.account_out_5.value){alert('출고처를 선택하세요!');form.account_out_5.focus();return;}if(form.classify_5.value==1&&!form.price_out_5.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_5.focus();return;}}

							 if(form.style_6.value){if(!form.qty_6.value){alert('출고수량을 입력하세요!');form.qty_6.focus();return;}if(form.qty_6.value==0||form.qty_6.value>form.stock_6.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_6.focus();return;}if(!form.classify_6.value){alert('출고사유를 선택하세요!');form.classfy_6.focus();return;}if(form.classify_6.value<9&&!form.account_out_6.value){alert('출고처를 선택하세요!');form.account_out_6.focus();return;}if(form.classify_6.value==1&&!form.price_out_6.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_6.focus();return;}}

							 if(form.style_7.value){if(!form.qty_7.value){alert('출고수량을 입력하세요!');form.qty_7.focus();return;}if(form.qty_7.value==0||form.qty_7.value>form.stock_7.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_7.focus();return;}if(!form.classify_7.value){alert('출고사유를 선택하세요!');form.classfy_7.focus();return;}if(form.classify_7.value<9&&!form.account_out_7.value){alert('출고처를 선택하세요!');form.account_out_7.focus();return;}if(form.classify_7.value==1&&!form.price_out_7.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_7.focus();return;}}

							 if(form.style_8.value){if(!form.qty_8.value){alert('출고수량을 입력하세요!');form.qty_8.focus();return;}if(form.qty_8.value==0||form.qty_8.value>form.stock_8.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_8.focus();return;}if(!form.classify_8.value){alert('출고사유를 선택하세요!');form.classfy_8.focus();return;}if(form.classify_8.value<9&&!form.account_out_8.value){alert('출고처를 선택하세요!');form.account_out_8.focus();return;}if(form.classify_8.value==1&&!form.price_out_8.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_8.focus();return;}}

							 if(form.style_9.value){if(!form.qty_9.value){alert('출고수량을 입력하세요!');form.qty_9.focus();return;}if(form.qty_9.value==0||form.qty_9.value>form.stock_9.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_9.focus();return;}if(!form.classify_9.value){alert('출고사유를 선택하세요!');form.classfy_9.focus();return;}if(form.classify_9.value<9&&!form.account_out_9.value){alert('출고처를 선택하세요!');form.account_out_9.focus();return;}if(form.classify_9.value==1&&!form.price_out_9.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_9.focus();return;}}

							 if(form.style_10.value){if(!form.qty_10.value){alert('출고수량을 입력하세요!');form.qty_10.focus();return;}if(form.qty_10.value==0||form.qty_10.value>form.stock_10.value){alert('출고가능한 수량보다 크거나 부정확한 숫자입니다!');form.qty_10.focus();return;}if(!form.classify_10.value){alert('출고사유를 선택하세요!');form.classfy_10.focus();return;}if(form.classify_10.value<9&&!form.account_out_10.value){alert('출고처를 선택하세요!');form.account_out_10.focus();return;}if(form.classify_10.value==1&&!form.price_out_10.value){alert('판매출고인 경우 반드시\n\n판매가격을 입력해야 합니다!');form.price_out_10.focus();return;}}

							  var s2_sub=confirm('출고상품을 등록하시겠습니까?');
			 					if(s2_sub==true){
									form.submit();
			 					}
						}
					//-->
					</script>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="form2">&nbsp;</td>
					</tr>
					</table>
					<table width="100%" height="30" border="0" cellpadding="0" cellspacing="0">
					<form method="post" name="out_stock_frm" action="storage2_post.php">
					<input type="hidden" name="price_in_1" value="">
					<input type="hidden" name="price_in_2" value="">
					<input type="hidden" name="price_in_3" value="">
					<input type="hidden" name="price_in_4" value="">
					<input type="hidden" name="price_in_5" value="">
					<input type="hidden" name="price_in_6" value="">
					<input type="hidden" name="price_in_7" value="">
					<input type="hidden" name="price_in_8" value="">
					<input type="hidden" name="price_in_9" value="">
					<input type="hidden" name="price_in_10" value="">

					<input type="hidden" name="set_price_1" value="">
					<input type="hidden" name="set_price_2" value="">
					<input type="hidden" name="set_price_3" value="">
					<input type="hidden" name="set_price_4" value="">
					<input type="hidden" name="set_price_5" value="">
					<input type="hidden" name="set_price_6" value="">
					<input type="hidden" name="set_price_7" value="">
					<input type="hidden" name="set_price_8" value="">
					<input type="hidden" name="set_price_9" value="">
					<input type="hidden" name="set_price_10" value="">

					<input type="hidden" name="stock_1" value="">
					<input type="hidden" name="stock_2" value="">
					<input type="hidden" name="stock_3" value="">
					<input type="hidden" name="stock_4" value="">
					<input type="hidden" name="stock_5" value="">
					<input type="hidden" name="stock_6" value="">
					<input type="hidden" name="stock_7" value="">
					<input type="hidden" name="stock_8" value="">
					<input type="hidden" name="stock_9" value="">
					<input type="hidden" name="stock_10" value="">
					<tr>
						<td width="100" class="form1"bgcolor="#F8F8F8">출고일자 <font color="red">*</font></td>
						<td class="form2">&nbsp;<input type="text" name="st_date" id="st_date" value="<?=date('Y-m-d')?>" class="inputStyle2" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')";> <a href="javascript:" onclick="openCalendar(document.getElementById('st_date'));"><img src="../images/calendar.jpg" border="0"></a>
						<td class="form1"bgcolor="#F8F8F8">담 당 자 <font color="red">*</font></td>
						<td class="form2">&nbsp;<?=$_SESSION['p_name']?><input type="hidden" name="worker" value="<?=$_SESSION['p_name']?>"></td>
					</tr>
					</table><p />
					<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#D6D6D6" width="250" style="border-collapse:collapse; border:1px solid #D6D6D6">
					<tr height="25" align="center" bgcolor="#f0f0e8">
						<td><input type="checkbox" name="" class="InputCheck" disabled onClick="checkAll();"></td>
						<td>카테고리(분류1)</td>
						<td>브랜드(분류2)</td>
						<td>스 타 일 <font color="red">*</font></td>
						<td>컬러 코드</td>
						<td>재 질</td>
						<td>수 량 <font color="red">*</font></td>
						<td>출고사유 <font color="red">*</font></td>
						<td>출 고 처 <font color="red">*</font></td>
						<td>출고가격<br>(판매출고일 경우<font color='red'>*</font>)
						</td>
						<td width="20"><a href="javascript:" onclick="alert(p_out.value);"> <font color="#660000"><b>x</b></font></a></td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 1 -->
						<td><input type="text" name="category_1" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 1 -->
						<td><input type="text" name="brand_1" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 1 -->
						<td><input type="text" name="style_1" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=1&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=1&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 1 -->
						<td><input type="text" name="color_1" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 1 -->
						<td><input type="text" name="comp_1" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 1 -->
						<td><input type="text" name="qty_1" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 1 -->
						<td>
							<select name="classify_1" style="width:90px;" onChange="price_in(1)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 1 -->
						<td><input type="text" name="account_out_1" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_1','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_1','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 1 -->
						<td><input type="text" name="price_out_1" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(1);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 2 -->
						<td><input type="text" name="category_2" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 2 -->
						<td><input type="text" name="brand_2" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 2 -->
						<td><input type="text" name="style_2" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=2&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=2&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 2 -->
						<td><input type="text" name="color_2" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 2 -->
						<td><input type="text" name="comp_2" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 2 -->
						<td><input type="text" name="qty_2" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 2 -->
						<td>
							<select name="classify_2" style="width:90px;" onChange="price_in(2)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 2 -->
						<td><input type="text" name="account_out_2" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_2','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_2','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 2 -->
						<td><input type="text" name="price_out_2" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(2);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 3 -->
						<td><input type="text" name="category_3" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 3 -->
						<td><input type="text" name="brand_3" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 3 -->
						<td><input type="text" name="style_3" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=3&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=3&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 3 -->
						<td><input type="text" name="color_3" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 3 -->
						<td><input type="text" name="comp_3" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 3 -->
						<td><input type="text" name="qty_3" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 3 -->
						<td>
							<select name="classify_3" style="width:90px;" onChange="price_in(3)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 3 -->
						<td><input type="text" name="account_out_3" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_3','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_3','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 3 -->
						<td><input type="text" name="price_out_3" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(3);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 4 -->
						<td><input type="text" name="category_4" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 4 -->
						<td><input type="text" name="brand_4" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 4 -->
						<td><input type="text" name="style_4" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=4&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=4&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 4 -->
						<td><input type="text" name="color_4" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 4 -->
						<td><input type="text" name="comp_4" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 4 -->
						<td><input type="text" name="qty_4" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 4 -->
						<td>
							<select name="classify_4" style="width:90px;" onChange="price_in(4)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 4 -->
						<td><input type="text" name="account_out_4" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_4','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_4','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 4 -->
						<td><input type="text" name="price_out_4" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(4);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 5 -->
						<td><input type="text" name="category_5" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 5 -->
						<td><input type="text" name="brand_5" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 5 -->
						<td><input type="text" name="style_5" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=5&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=5&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 5 -->
						<td><input type="text" name="color_5" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 5 -->
						<td><input type="text" name="comp_5" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 5 -->
						<td><input type="text" name="qty_5" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 5 -->
						<td>
							<select name="classify_5" style="width:90px;" onChange="price_in(5)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 5 -->
						<td><input type="text" name="account_out_5" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_5','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_5','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 5 -->
						<td><input type="text" name="price_out_5" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(5);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 6 -->
						<td><input type="text" name="category_6" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 6 -->
						<td><input type="text" name="brand_6" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 6 -->
						<td><input type="text" name="style_6" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=6&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=6&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 6 -->
						<td><input type="text" name="color_6" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 6 -->
						<td><input type="text" name="comp_6" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 6 -->
						<td><input type="text" name="qty_6" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 6 -->
						<td>
							<select name="classify_6" style="width:90px;" onChange="price_in(6)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 6 -->
						<td><input type="text" name="account_out_6" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_6','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_6','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 6 -->
						<td><input type="text" name="price_out_6" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(6);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 7 -->
						<td><input type="text" name="category_7" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 7 -->
						<td><input type="text" name="brand_7" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 7 -->
						<td><input type="text" name="style_7" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=7&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=7&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 7 -->
						<td><input type="text" name="color_7" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 7 -->
						<td><input type="text" name="comp_7" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 7 -->
						<td><input type="text" name="qty_7" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 7 -->
						<td>
							<select name="classify_7" style="width:90px;" onChange="price_in(7)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 7 -->
						<td><input type="text" name="account_out_7" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_7','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_7','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 7 -->
						<td><input type="text" name="price_out_7" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(7);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 8 -->
						<td><input type="text" name="category_8" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 8 -->
						<td><input type="text" name="brand_8" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 8 -->
						<td><input type="text" name="style_8" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=8&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=8&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 8 -->
						<td><input type="text" name="color_8" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 8 -->
						<td><input type="text" name="comp_8" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 8 -->
						<td><input type="text" name="qty_8" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 8 -->
						<td>
							<select name="classify_8" style="width:90px;" onChange="price_in(8)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 8 -->
						<td><input type="text" name="account_out_8" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_8','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_8','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 8 -->
						<td><input type="text" name="price_out_8" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(8);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 9 -->
						<td><input type="text" name="category_9" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 9 -->
						<td><input type="text" name="brand_9" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 9 -->
						<td><input type="text" name="style_9" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=9&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=9&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 9 -->
						<td><input type="text" name="color_9" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 9 -->
						<td><input type="text" name="comp_9" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 9 -->
						<td><input type="text" name="qty_9" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 9 -->
						<td>
							<select name="classify_9" style="width:90px;" onChange="price_in(9)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 9 -->
						<td><input type="text" name="account_out_9" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_9','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_9','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 9 -->
						<td><input type="text" name="price_out_9" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(9);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) 10 -->
						<td><input type="text" name="category_10" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 중분류 (브랜드) 10 -->
						<td><input type="text" name="brand_10" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>

						<!-- 스타일 10 -->
						<td><input type="text" name="style_10" readonly onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=10&frm=out_stock_frm','style')" size="15" class="inputStyle2" style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:" onclick="cate_chk('<?=$cms_url?>_stock/stock_list.php?fn=10&frm=out_stock_frm','style')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 컬러코드 10 -->
						<td><input type="text" name="color_10" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 재 질 10 -->
						<td><input type="text" name="comp_10" readonly size="15" class="inputStyle2" style="background-color:#eaeaea;"></td>
						<!-- 수량 10 -->
						<td><input type="text" name="qty_10" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<!-- 출고사유 10 -->
						<td>
							<select name="classify_10" style="width:90px;" onChange="price_in(10)">
							<option selected> 선 택
							<option value="5"> 판 매 출 고
							<option value="6"> 반 품 출 고
							<option value="7"> 수 탁 반 납
							<option value="8"> 위 탁 출 고
							<option value="9"> 재고조정(불량파손)
						</select>
						</td>
						<!-- 출고처 10 -->
						<td><input type="text" name="account_out_10" size="15" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; style="border-width: 1px 0 1px 1px; border-color:#cccccc; border-style: solid;"  onclick="open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_10','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_out.php?fn=account_out_10','accounts')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 출고가격 10 -->
						<td><input type="text" name="price_out_10" size="15" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td> <a href="javascript:" onclick="row_reset2(10);"><img src="../images/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>

					</table><br>
					</form>
					<p>

					<table width="100%">
					<tr height="43" align="right">
						<td style="border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid; padding:0 20px 0 0px">
							<input type="button" value=" 출 고 등 록 " onclick="out_stock_chk();" class="inputstyle1" style="height='28'">
						</td>
					</tr>
					</table>
					</div>
