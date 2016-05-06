					<!--------------------------------------------------subject table end---------------------------------------------------->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr height="30">
						<td class="d3_sub" bgcolor="#F8F8F8"><b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> 입고 등록</font></b></td>
						<td align="right" valign="bottom" class="d3_sub" bgcolor="#F8F8F8"> <font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.</td>
					</tr>
					</table>
					<!--------------------------------------------------subject table end---------------------------------------------------->
					<div style="height:570px; padding-top:10px;">
					<script type="text/javascript">
					<!--
						/*
						function cate_chk(ref,name,obj) {
							 var window_left = (screen.width-640)/2;
							 var window_top = (screen.height-480)/2;
							 window.open(ref,name,'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
						}
						*/

						function brand_chk(ref,ca_form,win_name){
							 var form=document.in_stock_frm;
							 var window_left = (screen.width-640)/2;
							 var window_top = (screen.height-480)/2;
							 var ca_form = eval('form.'+ca_form);

							 if(!ca_form.value){
									alert('대분류 항목을 먼저 입력하여 주세요!');
									ca_form.focus();
							 } else {
									var category = encodeURIComponent(ca_form.value);
									window.open(ref+'&category='+category,win_name,'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
							 }
						}

						function style_chk(obj){
							 var ca = eval('document.in_stock_frm.category_'+obj);
							 var br = eval('document.in_stock_frm.brand_'+obj);

							 if(!ca.value){
									alert('대분류 항목을 먼저 입력하여 주세요!');
									ca.focus();
									return;
							 }
							 if(!br.value){
									alert('브랜드 항목을 먼저 입력하여 주세요!');
									br.focus();
									return;
							 }
						}

						/*
						function iNum(obj){
							 if (event.keyCode >= 48 && event.keyCode <= 57) {                     //숫자일때 스크립트
							 }else{                                                        				 //숫자가 아닐때 스크립트
									event.returnValue = false;
									alert('숫자만 입력 가능합니다!');
							 }
						}
						*/

						function re_list(){
							 var form=document.in_stock_frm;
							 // form.reset();
							 var window_left = (screen.width-640)/2;
							 var window_top = (screen.height-480)/2;
							 window.open('release_list.php','release_list','width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
						}

						function sel_re_list(obj){
							 var form=document.in_stock_frm;
							 if(obj==2||obj==4) {
									if(!form.category_1.value||!form.brand_1.value||!form.style_1.value||!form.color_1.value||!form.comp_1.value||!form.price_in_1.value||!form.set_price_1.value){
										 form.category_1.value="";
										 form.brand_1.value="";
										 form.style_1.value="";
										 form.color_1.value="";
										 form.comp_1.value="";
										 form.qty_1.value="";
										 form.price_in_1.value="";
										 form.set_price_1.value="";
									}
									if(!form.category_2.value||!form.brand_2.value||!form.style_2.value||!form.color_2.value||!form.comp_2.value||!form.price_in_2.value||!form.set_price_2.value){
										 form.category_2.value="";
										 form.brand_2.value="";
										 form.style_2.value="";
										 form.color_2.value="";
										 form.comp_2.value="";
										 form.qty_2.value="";
										 form.price_in_2.value="";
										 form.set_price_2.value="";
									}
									if(!form.category_3.value||!form.brand_3.value||!form.style_3.value||!form.color_3.value||!form.comp_3.value||!form.price_in_3.value||!form.set_price_3.value){
										 form.category_3.value="";
										 form.brand_3.value="";
										 form.style_3.value="";
										 form.color_3.value="";
										 form.comp_3.value="";
										 form.qty_3.value="";
										 form.price_in_3.value="";
										 form.set_price_3.value="";
									}
									if(!form.category_4.value||!form.brand_4.value||!form.style_4.value||!form.color_4.value||!form.comp_4.value||!form.price_in_4.value||!form.set_price_4.value){
										 form.category_4.value="";
										 form.brand_4.value="";
										 form.style_4.value="";
										 form.color_4.value="";
										 form.comp_4.value="";
										 form.qty_4.value="";
										 form.price_in_4.value="";
										 form.set_price_4.value="";
									}
									if(!form.category_5.value||!form.brand_5.value||!form.style_5.value||!form.color_5.value||!form.comp_5.value||!form.price_in_5.value||!form.set_price_5.value){
										 form.category_5.value="";
										 form.brand_5.value="";
										 form.style_5.value="";
										 form.color_5.value="";
										 form.comp_5.value="";
										 form.qty_5.value="";
										 form.price_in_5.value="";
										 form.set_price_5.value="";
									}
									if(!form.category_6.value||!form.brand_6.value||!form.style_6.value||!form.color_6.value||!form.comp_6.value||!form.price_in_6.value||!form.set_price_6.value){
										 form.category_6.value="";
										 form.brand_6.value="";
										 form.style_6.value="";
										 form.color_6.value="";
										 form.comp_6.value="";
										 form.qty_6.value="";
										 form.price_in_6.value="";
										 form.set_price_6.value="";
									}
									if(!form.category_7.value||!form.brand_7.value||!form.style_7.value||!form.color_7.value||!form.comp_7.value||!form.price_in_7.value||!form.set_price_7.value){
										 form.category_7.value="";
										 form.brand_7.value="";
										 form.style_7.value="";
										 form.color_7.value="";
										 form.comp_7.value="";
										 form.qty_7.value="";
										 form.price_in_7.value="";
										 form.set_price_7.value="";
									}
									if(!form.category_8.value||!form.brand_8.value||!form.style_8.value||!form.color_8.value||!form.comp_8.value||!form.price_in_8.value||!form.set_price_8.value){
										 form.category_8.value="";
										 form.brand_8.value="";
										 form.style_8.value="";
										 form.color_8.value="";
										 form.comp_8.value="";
										 form.qty_8.value="";
										 form.price_in_8.value="";
										 form.set_price_8.value="";
									}
									if(!form.category_9.value||!form.brand_9.value||!form.style_9.value||!form.color_9.value||!form.comp_9.value||!form.price_in_9.value||!form.set_price_9.value){
										 form.category_9.value="";
										 form.brand_9.value="";
										 form.style_9.value="";
										 form.color_9.value="";
										 form.comp_9.value="";
										 form.qty_9.value="";
										 form.price_in_9.value="";
										 form.set_price_9.value="";
									}
									if(!form.category_10.value||!form.brand_10.value||!form.style_10.value||!form.color_10.value||!form.comp_10.value||!form.price_in_10.value||!form.set_price_10.value){
										 form.category_10.value="";
										 form.brand_10.value="";
										 form.style_10.value="";
										 form.color_10.value="";
										 form.comp_10.value="";
										 form.qty_10.value="";
										 form.price_in_10.value="";
										 form.set_price_10.value="";
									}

									re_list();
							 }
						}

						function row_reset(no){
							 var form = document.in_stock_frm;

							 if(no==1){form.category_1.value="";form.brand_1.value="";form.style_1.value="";form.color_1.value="";form.comp_1.value="";form.qty_1.value="";form.price_in_1.value="";form.set_price_1.value="";form.p_img_1.value="";}
							 if(no==2){form.category_2.value="";form.brand_2.value="";form.style_2.value="";form.color_2.value="";form.comp_2.value="";form.qty_2.value="";form.price_in_2.value="";form.set_price_2.value="";form.p_img_2.value="";}
							 if(no==3){form.category_3.value="";form.brand_3.value="";form.style_3.value="";form.color_3.value="";form.comp_3.value="";form.qty_3.value="";form.price_in_3.value="";form.set_price_3.value="";form.p_img_3.value="";}
							 if(no==4){form.category_4.value="";form.brand_4.value="";form.style_4.value="";form.color_4.value="";form.comp_4.value="";form.qty_4.value="";form.price_in_4.value="";form.set_price_4.value="";form.p_img_4.value="";}
							 if(no==5){form.category_5.value="";form.brand_5.value="";form.style_5.value="";form.color_5.value="";form.comp_5.value="";form.qty_5.value="";form.price_in_5.value="";form.set_price_5.value="";form.p_img_5.value="";}
							 if(no==6){form.category_6.value="";form.brand_6.value="";form.style_6.value="";form.color_6.value="";form.comp_6.value="";form.qty_6.value="";form.price_in_6.value="";form.set_price_6.value="";form.p_img_6.value="";}
							 if(no==7){form.category_7.value="";form.brand_7.value="";form.style_7.value="";form.color_7.value="";form.comp_7.value="";form.qty_7.value="";form.price_in_7.value="";form.set_price_7.value="";form.p_img_7.value="";}
							 if(no==8){form.category_8.value="";form.brand_8.value="";form.style_8.value="";form.color_8.value="";form.comp_8.value="";form.qty_8.value="";form.price_in_8.value="";form.set_price_8.value="";form.p_img_8.value="";}
							 if(no==9){form.category_9.value="";form.brand_9.value="";form.style_9.value="";form.color_9.value="";form.comp_9.value="";form.qty_9.value="";form.price_in_9.value="";form.set_price_9.value="";form.p_img_9.value="";}
							 if(no==10){form.category_10.value="";form.brand_10.value="";form.style_10.value="";form.color_10.value="";form.comp_10.value="";form.qty_10.value="";form.price_in_10.value="";form.set_price_10.value="";form.p_img_10.value="";}
						}

						function in_stock_chk(){
							 var form = document.in_stock_frm;

							 if(!form.st_date.value){
									alert('입고 일자를 입력하세요!');
									form.st_date.focus();
									return;
							 }
							 if(!form.account_in.value){
									alert('입고업체를 입력하세요!');
									form.account_in.focus();
									return;
							 }
							 if(!form.classify.value){
									alert('입고사유를 입력하세요!');
									form.classify.focus();
									return;
							 }
							 if(!form.style_1.value&&!form.style_2.value&&!form.style_3.value&&!form.style_4.value&&!form.style_5.value&&!form.style_6.value&&!form.style_7.value&&!form.style_8.value&&!form.style_9.value&&!form.style_10.value){
									alert('하나 이상의 상품 목록을 기재하세요!');
									if(!form.category_1.value){
										 form.category_1.focus();
										 return;
									} else if(!form.brand_1.value){
										 form.brand_1.focus();
										 return;
									} else if(!form.style_1.value){
										 form.style_1.focus();
										 return;
									}
							 }
							 if(form.style_1.value){
									if(!form.color_1.value){
										 alert('컬러코드를 입력하세요!');form.color_1.focus();return;
									}
									if(!form.comp_1.value){
										 alert('재질을 입력하세요!');form.comp_1.focus();return;
									}
									if(!form.qty_1.value){
										 alert('입고수량을 입력하세요!');form.qty_1.focus();return;
									}
									if(!form.price_in_1.value){
										 alert('입고단가를 입력하세요!');form.price_in_1.focus();return;
									}
									if(!form.set_price_1.value){
										 alert('판매책정단가를 입력하세요!');form.set_price_1.focus();return;
									}
									/*
									if(form.classify.value==1&&!form.p_img_1.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');
										 form.p_img_1.focus();return;
									}
									*/
							 }

							 if(form.style_2.value){
									if(!form.color_2.value){
										 alert('컬러코드를 입력하세요!');form.color_2.focus();return;
									}if(!form.comp_2.value){
										 alert('재질을 입력하세요!');form.comp_2.focus();return;
									}if(!form.qty_2.value){alert('입고수량을 입력하세요!');form.qty_2.focus();return;}if(!form.price_in_2.value){alert('입고단가를 입력하세요!');form.price_in_2.focus();return;}if(!form.set_price_2.value){alert('판매책정단가를 입력하세요!');form.set_price_2.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_2.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_2.focus();return;
									}
									*/
									}

							 if(form.style_3.value){
									if(!form.color_3.value){
										 alert('컬러코드를 입력하세요!');form.color_3.focus();return;
									}if(!form.comp_3.value){
										 alert('재질을 입력하세요!');form.comp_3.focus();return;
									}if(!form.qty_3.value){alert('입고수량을 입력하세요!');form.qty_3.focus();return;}if(!form.price_in_3.value){alert('입고단가를 입력하세요!');form.price_in_3.focus();return;}if(!form.set_price_3.value){alert('판매책정단가를 입력하세요!');form.set_price_3.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_3.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_3.focus();return;
									}
									*/
									}

							 if(form.style_4.value){
									if(!form.color_4.value){
										 alert('컬러코드를 입력하세요!');form.color_4.focus();return;
									}if(!form.comp_4.value){
										 alert('재질을 입력하세요!');form.comp_4.focus();return;
									}if(!form.qty_4.value){alert('입고수량을 입력하세요!');form.qty_4.focus();return;}if(!form.price_in_4.value){alert('입고단가를 입력하세요!');form.price_in_4.focus();return;}if(!form.set_price_4.value){alert('판매책정단가를 입력하세요!');form.set_price_4.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_4.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_4.focus();return;
									}
									*/}

							 if(form.style_5.value){
									if(!form.color_5.value){
										 alert('컬러코드를 입력하세요!');form.color_5.focus();return;
									}if(!form.comp_5.value){
										 alert('재질을 입력하세요!');form.comp_5.focus();return;
									}if(!form.qty_5.value){alert('입고수량을 입력하세요!');form.qty_5.focus();return;}if(!form.price_in_5.value){alert('입고단가를 입력하세요!');form.price_in_5.focus();return;}if(!form.set_price_5.value){alert('판매책정단가를 입력하세요!');form.set_price_5.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_5.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_5.focus();return;
									}
									*/}

							 if(form.style_6.value){
									if(!form.color_6.value){
										 alert('컬러코드를 입력하세요!');form.color_6.focus();return;
									}if(!form.comp_6.value){
										 alert('재질을 입력하세요!');form.comp_6.focus();return;
									}if(!form.qty_6.value){alert('입고수량을 입력하세요!');form.qty_6.focus();return;}if(!form.price_in_6.value){alert('입고단가를 입력하세요!');form.price_in_6.focus();return;}if(!form.set_price_6.value){alert('판매책정단가를 입력하세요!');form.set_price_6.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_6.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_6.focus();return;
									}
									*/}

							 if(form.style_7.value){
									if(!form.color_7.value){
										 alert('컬러코드를 입력하세요!');form.color_7.focus();return;
									}if(!form.comp_7.value){
										 alert('재질을 입력하세요!');form.comp_7.focus();return;
									}if(!form.qty_7.value){alert('입고수량을 입력하세요!');form.qty_7.focus();return;}if(!form.price_in_7.value){alert('입고단가를 입력하세요!');form.price_in_7.focus();return;}if(!form.set_price_7.value){alert('판매책정단가를 입력하세요!');form.set_price_7.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_7.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_7.focus();return;
									}
									*/}

							 if(form.style_8.value){
									if(!form.color_8.value){
										 alert('컬러코드를 입력하세요!');form.color_8.focus();return;
									}if(!form.comp_8.value){
										 alert('재질을 입력하세요!');form.comp_8.focus();return;
									}if(!form.qty_8.value){alert('입고수량을 입력하세요!');form.qty_8.focus();return;}if(!form.price_in_8.value){alert('입고단가를 입력하세요!');form.price_in_8.focus();return;}if(!form.set_price_8.value){alert('판매책정단가를 입력하세요!');form.set_price_8.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_8.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_8.focus();return;
									}
									*/}

							 if(form.style_9.value){
									if(!form.color_9.value){
										 alert('컬러코드를 입력하세요!');form.color_9.focus();return;
									}if(!form.comp_9.value){
										 alert('재질을 입력하세요!');form.comp_9.focus();return;
									}if(!form.qty_9.value){alert('입고수량을 입력하세요!');form.qty_9.focus();return;}if(!form.price_in_9.value){alert('입고단가를 입력하세요!');form.price_in_9.focus();return;}if(!form.set_price_9.value){alert('판매책정단가를 입력하세요!');form.set_price_9.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_9.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_9.focus();return;
									}
									*/}

							 if(form.style_10.value){
									if(!form.color_10.value){
										 alert('컬러코드를 입력하세요!');form.color_10.focus();return;
									}if(!form.comp_10.value){
										 alert('재질을 입력하세요!');form.comp_10.focus();return;
									}if(!form.qty_10.value){alert('입고수량을 입력하세요!');form.qty_10.focus();return;}if(!form.price_in_10.value){alert('입고단가를 입력하세요!');form.price_in_10.focus();return;}if(!form.set_price_10.value){alert('판매책정단가를 입력하세요!');form.set_price_10.focus();return;}
									/*
									if(form.classify.value==1&&!form.p_img_10.value){
										 alert('매입입고인 경우 리스트 이미지를 등록하여야 합니다!');form.p_img_10.focus();return;
									}
									*/}

							  var s2_sub=confirm('입고상품을 등록하시겠습니까?');
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
					<table width="100%" height="60" border="0" cellpadding="0" cellspacing="0">
					<form method="post" name="in_stock_frm" action="storage3_post.php" enctype="multipart/form-data">
					<tr>
						<input type="hidden" name="price_out_1" value="">
						<input type="hidden" name="price_out_2" value="">
						<input type="hidden" name="price_out_3" value="">
						<input type="hidden" name="price_out_4" value="">
						<input type="hidden" name="price_out_5" value="">
						<input type="hidden" name="price_out_6" value="">
						<input type="hidden" name="price_out_7" value="">
						<input type="hidden" name="price_out_8" value="">
						<input type="hidden" name="price_out_9" value="">
						<input type="hidden" name="price_out_10" value="">

						<td width="10%" class="form1"bgcolor="#F8F8F8">입고일자 <font color="red">*</font></td>
						<td width="35%" class="form2">&nbsp;<input type="text" name="st_date" id="st_date_2" value="<?=date('Y-m-d')?>" class="inputStyle2" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')";> <a href="javascript:" onclick="openCalendar(document.getElementById('st_date_2'));"><img src="../images/calendar.jpg" border="0"></a>
						<td width="10%" class="form1"bgcolor="#F8F8F8">입 고 처 <font color="red">*</font></td>
						<td width="30%" class="form2" colspan="2">&nbsp;<input type="text" name="account_in" readonly class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; class="bt_form"  onclick="open_Win('<?=$cms_url?>_stock/accounts_in.php?frm=in_stock_frm','accounts')"><a href="javascript:open_Win('<?=$cms_url?>_stock/accounts_in.php','accounts')"><img src="../images/form_serch.jpg" height="18" border="0"></a>
						</td>
					</tr>
					<tr>
						<td class="form1"bgcolor="#F8F8F8">담 당 자 <font color="red">*</font></td>
						<td class="form2">&nbsp;<?=$_SESSION['p_name']?><input type="hidden" name="worker" value="<?=$_SESSION['p_name']?>">
						</td>
						<td class="form1"bgcolor="#F8F8F8">입고사유 <font color="red">*</font></td>
						<td class="form2">&nbsp;
						<select name="classify" onChange="sel_re_list(this.value);">
							<option selected> 선 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;택&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<option value="1"> 매 입 입 고
							<option value="2"> 반 품 입 고
							<option value="3"> 수 탁 입 고
							<option value="4"> 위 탁 회 수
						</select>
						</td>
						<td width="20%" class="form2" align="left"><a href="javascript:" onClick="re_list();">최근 출고리스트</a></td>
					</tr>
					</table><p>
					<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#D6D6D6" width="250" style="border-collapse:collapse; border:1px solid #D6D6D6">
					<tr height="25" align="center" bgcolor="#f0f0e8">
						<td><input type="checkbox" name="" class="InputCheck" disabled onClick="checkAll();"></td>
						<td>카테고리(분류1) <font color="red">*</font></td>
						<td>브랜드(분류2) <font color="red">*</font></td>
						<td>스 타 일 <font color="red">*</font></td>
						<td>컬러 코드 <font color="red">*</font></td>
						<td>재 질 <font color="red">*</font></td>
						<td>수 량 <font color="red">*</font></td>
						<td>입고 단가 <font color="red">*</font></td>
						<td>판매책정단가 <font color="red">*</font></td>
						<td>리스트 이미지</td>
						<td width="20"><!-- <font color="#000099"> --><b>x</b><!-- </font> --></td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류 (카테고리) -->
						<td><input type="text" name="category_1" size="12" readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_1&frm=in_stock_frm','category')"  onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_1&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류 (브랜드) -->
						<td><input type="text" name="brand_1" size="12" readonly class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_1&frm=in_stock_frm','category_1','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_1&frm=in_stock_frm','category_1','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보 -->
						<td><input type="text" name="style_1" onclick="style_chk('1');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_1"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_1"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_1"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_1"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_1"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_1"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(1);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류2 (카테고리) -->
						<td><input type="text" name="category_2" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_2&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_2&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류2 (브랜드) -->
						<td><input type="text" name="brand_2" readonly size="12" class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_2&frm=in_stock_frm','category_2','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_2&frm=in_stock_frm','category_2','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보2 -->
						<td><input type="text" name="style_2" onclick="style_chk('2');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_2"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_2"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_2"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_2"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_2"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_2"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(2);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류3 (카테고리) -->
						<td><input type="text" name="category_3" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_3&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_3&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류3 (브랜드) -->
						<td><input type="text" name="brand_3" readonly size="12" class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_3&frm=in_stock_frm','category_3','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_3&frm=in_stock_frm','category_3','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보3 -->
						<td><input type="text" name="style_3" onclick="style_chk('3');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_3"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_3"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_3"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_3"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_3"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_3"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(3);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류4 (카테고리) -->
						<td><input type="text" name="category_4" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_4&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_4&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류4 (브랜드) -->
						<td><input type="text" name="brand_4" readonly size="12" class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_4&frm=in_stock_frm','category_4','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_4&frm=in_stock_frm','category_4','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보4 -->
						<td><input type="text" name="style_4" onclick="style_chk('4');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_4"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_4"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_4"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_4"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_4"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_4"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(4);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류5 (카테고리) -->
						<td><input type="text" name="category_5" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_5&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_5&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류5 (브랜드) -->
						<td><input type="text" name="brand_5" readonly size="12" class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_5&frm=in_stock_frm','category_5','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_5&frm=in_stock_frm','category_5','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보5 -->
						<td><input type="text" name="style_5" onclick="style_chk('5');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_5"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_5"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_5"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_5"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_5"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_5"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(5);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류6 (카테고리) -->
						<td><input type="text" name="category_6" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_6&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_6&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류6 (브랜드) -->
						<td><input type="text" name="brand_6" size="12" readonly class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_6&frm=in_stock_frm','category_6','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_6&frm=in_stock_frm','category_6','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보6 -->
						<td><input type="text" name="style_6" onclick="style_chk('6');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_6"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_6"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_6"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_6"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_6"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_6"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(6);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류7 (카테고리) -->
						<td><input type="text" name="category_7" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_7&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_7&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류7 (브랜드) -->
						<td><input type="text" name="brand_7" size="12" readonly class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_7&frm=in_stock_frm','category_7','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_7&frm=in_stock_frm','category_7','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보7 -->
						<td><input type="text" name="style_7" onclick="style_chk('7');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_7"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_7"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_7"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_7"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_7"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_7"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(7);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류8 (카테고리) -->
						<td><input type="text" name="category_8" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_8&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_8&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류8 (브랜드) -->
						<td><input type="text" name="brand_8" size="12" readonly class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_8&frm=in_stock_frm','category_8','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_8&frm=in_stock_frm','category_8','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보8 -->
						<td><input type="text" name="style_8" onclick="style_chk('8');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_8"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_8"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_8"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_8"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_8"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_8"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(8);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류9 (카테고리) -->
						<td><input type="text" name="category_9" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_9&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_9&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>
						<!-- 중분류9 (브랜드) -->
						<td><input type="text" name="brand_9" size="12" readonly class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_9&frm=in_stock_frm','category_9','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_9&frm=in_stock_frm','category_9','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보9 -->
						<td><input type="text" name="style_9" onclick="style_chk('9');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_9"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_9"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_9"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_9"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_9"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_9"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(9);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>
					<tr align="center" height="25">
						<td><input type="checkbox" name="" disabled  class="InputCheck"></td>
						<!-- 대분류10 (카테고리) -->
						<td><input type="text" name="category_10" size="12"  readonly class="inputStyle2" class="bt_form" onclick="cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_10&frm=in_stock_frm','category')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:cate_chk('<?=$cms_url?>_stock/1st_classify.php?fn=category_10&frm=in_stock_frm','category')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 중분류10 (브랜드) -->
						<td><input type="text" name="brand_10" size="12" readonly class="inputStyle2" class="bt_form" onclick="brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_10&frm=in_stock_frm','category_10','brand')" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"><a href="javascript:brand_chk('<?=$cms_url?>_stock/2nd_classify.php?fn=brand_10&frm=in_stock_frm','category_10','brand')"><img src="../images/form_serch.jpg" height="17" border="0"></a></td>

						<!-- 기타 등록 정보10 -->
						<td><input type="text" name="style_10" onclick="style_chk('10');"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="color_10"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="comp_10"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td><input type="text" name="qty_10"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="price_in_10"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="text" name="set_price_10"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'></td>
						<td><input type="file" name="p_img_10"  size="13" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"></td>
						<td> <a href="javascript:" onclick="row_reset(10);"><img src="../img/bt_del.jpg" width="10" height="10" border="0" alt="x"></a> </td>
					</tr>


					</table><br>
					<!-- <table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#D6D6D6" width="250" style="border-collapse:collapse; border:1px solid #D6D6D6">
						<tr height="28" align="center">
							<td width="80" bgcolor="#E2F0FC"> 수 량 </td>
							<td><input type="text" name="sdf" class="InputStyle2"></td>
							<td width="80" bgcolor="#E2F0FC">공급가액</td>
							<td><input type="text" name="sdf" class="InputStyle2"></td>
							<td width="80" bgcolor="#E2F0FC">부가세</td>
							<td><input type="text" name="sdf" class="InputStyle2"></td>
							<td width="80" bgcolor="#E2F0FC">합계금액</td>
							<td><input type="text" name="sdf" class="InputStyle2"></td>
						</tr> -->
					</form>
					<!-- </table> --><p>

					<table width="100%">
					<tr height="43" align="right">
						<td style="border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid; padding:0 20px 0 0px;">
							<input type="button" value=" 입 고 등 록 " onclick="in_stock_chk();" class="inputstyle1" style="height='28'">
						</td>
					</tr>
					</table>
					</div>
