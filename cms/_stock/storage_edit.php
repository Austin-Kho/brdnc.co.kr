<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸리티 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	// 이름과 아이디에 해당하는 세션이 있는지 확인
	if(!isset($_SESSION[p_id])||!isset($_SESSION[p_name])){
		err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
	}

	$division=$_REQUEST['division'];
	$edit_code=$_REQUEST['edit_code'];

	$query="select * from cms_stock_main, cms_accounts where accounts=code and seq_num='$edit_code'";
	$result=mysql_query($query, $connect);
	$rows=mysql_fetch_array($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="stylesheet" href="../common/cms.css">
	<script language="JavaScript" src="../common/global.js"></script>
	<script language="JavaScript" src="../include/calendar/calendar.js"></script>
	<?
		if($division==1){
	?>
	<script type="text/javascript">
	<!--
		function iNum(obj){
			 if (event.keyCode >= 48 && event.keyCode <= 57) {                     //숫자일때 스크립트
			 }else{                                                        				                  //숫자가 아닐때 스크립트
					event.returnValue = false;
					alert('숫자만 입력 가능합니다!');
			 }
		}

		function _editChk(){
			 var form = document.form1;
			 if(!form.st_date.value){
					alert('입고 일자를 입력하세요!');
					form.st_date.focus();
					return;
			 }

			 if(!form.account.value){
					alert('입고업체를 입력하세요!');
					form.account.focus();
					return;
			 }

			 if(!form.classify.value){
					alert('입고사유를 입력하세요!');
					form.classify.focus();
					return;
			 }

			 if(!form.style_1.value){
					alert('수정할 상품 목록을 기재하세요!');
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
					if(!form.qty_1.value){
						 alert('입고수량을 입력하세요!');
						 form.qty_1.focus();
						 return;
					}
					if(!form.price_in_1.value){
						 alert('입고단가를 입력하세요!');
						 form.price_in_1.focus();
						 return;
					}
					if(!form.set_price_1.value){
						 alert('판매책정단가를 입력하세요!');
					}
					/*
					if(form.classify.value==1&&!form.p_img_1.value){
						 alert('매입입고인 경우 리스트 이미지를 등록해야 합니다!');
						 form.p_img_1.focus();
						 return;
					}
					*/
			 }
			 var s2_sub=confirm('상품입고정보를 수정하시겠습니까?');
			 if(s2_sub==true){
					form.submit();
			 }
		}

	//-->
	</script>
</head>

<body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0'>
	<table border='0' cellpadding='0' cellspacing='0' width='100%' height="100%">
	<tr>
		<td align="center" style="border-width: 2 0 0 0; border-color:#C5FAC9; border-style: solid; padding:6 0 0 0px">
			<table border="0" width="96%" height="94%" align="center" valign="middle" bgcolor="#96ABE5">
			<tr height="80" bgcolor="#D9EAF8">
				<td align="center" height="32" background="../img/bg.jpg">
				<font color="#4C63BD" style="font-size:11pt"><b>입고 상품 수정</b></font>
				</td>
			</tr>
			<tr bgcolor="ffffff">
				<td style="padding:13 0 0 0px">
				<table border="0" align="center" width="96%" height="100%" cellspacing="0" cellpadding="0">
				<tr height="10">
					<td></td>
				</tr>
				<tr height="28">
					<td>
					<form name="form1" action="storage_edit_post.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="division" value="<?=$division?>">
					<input type="hidden" name="seq_num" value="<?=$edit_code?>">
					<input type="hidden" name="$price_out_1" value="<?=$rows[price_out]?>">
					<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr align="center" height="35">
						<td width="100%" bgcolor="#F4F4F4" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;" colspan="2">
							변경 할 입고상품 정보를 수정해 주십시요. (<font color="#ff0000">*</font>표시는 필수입력 정보)
						</td>
					</tr>
					<tr>
						<td width="120" style="padding:8 0 0 16px"> 입고일자  <font color="#ff0000">*</font></td>
						<td style="padding:8 0 0 0px">
							<input type="text" name="st_date" id="st_date" value="<?=$rows[st_date]?>" class="inputStyle2" size="31" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"> <a href="javascript:" onclick="openCalendar(document.getElementById('st_date'));"><img src="../images/calendar.jpg" border="0"></a>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 입 고 처 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="account" value="<?=$rows[si_name]."-".$rows[accounts]?>" size="35" class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; >
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 입고사유 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<select name="classify" style="width:190;" onChange="pop_re_list(this.value);">
							<option <?if(!$rows[classify]) echo "selected";?>> 선 택
							<option value="1" <?if($rows[classify]==1) echo "selected";?>> 매 입 입 고
							<option value="2" <?if($rows[classify]==2) echo "selected";?>> 반 품 입 고
							<option value="3" <?if($rows[classify]==3) echo "selected";?>> 수 탁 입 고
							<option value="4" <?if($rows[classify]==4) echo "selected";?>> 위 탁 회 수
						</select>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 카테고리(분류1)<font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="category_1" value="<?=$rows[category]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 브랜드(중분류1) <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="brand_1" value="<?=$rows[brand]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 스 타 일 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="style_1" value="<?=$rows[style]?>" onclick="style_chk('1');" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 컬러코드 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="color_1" value="<?=$rows[color]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 재 질 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="comp_1" value="<?=$rows[comp]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 수 량 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="qty_1" value="<?=$rows[qty]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 입고단가 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="price_in_1"  value="<?=$rows[price_in]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 책정단가 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="set_price_1"  value="<?=$rows[set_price]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 8 16px; border-width: 0 0 1 0; border-color:#CFCFCF; border-style: solid;"> 리스트이미지 </td>
						<td style="padding:3 0 8 0px; border-width: 0 0 1 0; border-color:#CFCFCF; border-style: solid;">
							<input type="file" name="p_img_1" size="18" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>

					<tr align="center">
					</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td valign="top" align="center">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="10" align="center"></td>
					</tr>
					<tr>
						<td align="center">
							<input type="button" value=" 수정하기 " onclick="_editChk()" class="inputstyle1">
							<input type="button" value=" 닫 기 " onclick="self.close();" class="inputstyle1">
						</td>
					</tr>
					</table>
					</form>
					</td>
				</tr>
				</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</body>
</html>



<?
	}else{
?>



	<script type="text/javascript">
	<!--
		function iNum(obj){
			 if (event.keyCode >= 48 && event.keyCode <= 57) {                     //숫자일때 스크립트
			 }else{                                                        				                  //숫자가 아닐때 스크립트
					event.returnValue = false;
					alert('숫자만 입력 가능합니다!');
			 }
		}

		function _editChk2(){
			 var form = document.form1;
			 if(!form.st_date.value){
					alert('출고 일자를 입력하세요!');
					form.st_date.focus();
					return;
			 }

			 if(!form.account.value){
					alert('출고업체를 입력하세요!');
					form.account.focus();
					return;
			 }

			 if(!form.classify.value){
					alert('출고사유를 입력하세요!');
					form.classify.focus();
					return;
			 }

			 if(!form.style_1.value){
					alert('수정할 상품 목록을 기재하세요!');
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
					if(!form.qty_1.value){
						 alert('출고수량을 입력하세요!');
						 form.qty_1.focus();
						 return;
					}
					if(!form.price_out_1.value){
						 alert('출고가격을 입력하세요!');
						 form.price_in_1.focus();
						 return;
					}
					/*
					if(form.classify.value==1&&!form.p_img_1.value){
						 alert('매입입고인 경우 리스트 이미지를 등록해야 합니다!');
						 form.p_img_1.focus();
						 return;
					}
					*/
			 }
			 var s2_sub=confirm('상품출고정보를 수정하시겠습니까?');
			 if(s2_sub==true){
					form.submit();
			 }
		}

	//-->
	</script>
</head>

<body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0'>
	<table border='0' cellpadding='0' cellspacing='0' width='100%' height="100%">
	<tr>
		<td align="center" style="border-width: 2 0 0 0; border-color:#C5FAC9; border-style: solid; padding:6 0 0 0px">
			<table border="0" width="96%" height="94%" align="center" valign="middle" bgcolor="#96ABE5">
			<tr height="80" bgcolor="#D9EAF8">
				<td align="center" height="32" background="../img/bg.jpg">
				<font color="#4C63BD" style="font-size:11pt"><b>출고 상품 수정</b></font>
				</td>
			</tr>
			<tr bgcolor="ffffff">
				<td style="padding:13 0 0 0px">
				<table border="0" align="center" width="96%" height="100%" cellspacing="0" cellpadding="0">
				<tr height="10">
					<td></td>
				</tr>
				<tr height="28">
					<td>
					<form name="form1" action="storage_edit_post.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="division" value="<?=$division?>">
					<input type="hidden" name="seq_num" value="<?=$edit_code?>">
					<input type="hidden" name="price_in_1" value="<?=$rows[price_in]?>">
					<input type="hidden" name="set_price_1" value="<?=$rows[set_price]?>">
					<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr align="center" height="35">
						<td width="100%" bgcolor="#F4F4F4" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;" colspan="2">
							변경 할 출고상품 정보를 수정해 주십시요. (<font color="#ff0000">*</font>표시는 필수입력 정보)
						</td>
					</tr>
					<tr>
						<td width="120" style="padding:8 0 0 16px"> 출고일자  <font color="#ff0000">*</font></td>
						<td style="padding:8 0 0 0px">
							<input type="text" name="st_date" id="st_date" value="<?=$rows[st_date]?>" class="inputStyle2" size="31" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"> <a href="javascript:" onclick="openCalendar(document.getElementById('st_date'));"><img src="../images/calendar.jpg" border="0"></a>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 출 고 처 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="account" value="<?=$rows[si_name]."-".$rows[accounts]?>" size="35" class="InputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')"; >
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 출고사유 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<select name="classify" style="width:190;" onChange="pop_re_list(this.value);">
							<option <?if(!$rows[classify]) echo "selected";?>> 선 택
							<option value="5" <?if($rows[classify]==5) echo "selected";?>> 판 매 출 고
							<option value="6" <?if($rows[classify]==6) echo "selected";?>> 반 품 출 고
							<option value="7" <?if($rows[classify]==7) echo "selected";?>> 수 탁 반 납
							<option value="8" <?if($rows[classify]==8) echo "selected";?>> 위 탁 출 고
							<option value="9" <?if($rows[classify]==9) echo "selected";?>> 재 고 조 정(불량파손)
						</select>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 카테고리(분류1)<font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="category_1" value="<?=$rows[category]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 브랜드(중분류1) <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="brand_1" value="<?=$rows[brand]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 스 타 일 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="style_1" value="<?=$rows[style]?>" onclick="style_chk('1');" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 컬러코드 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="color_1" value="<?=$rows[color]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 재 질 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="comp_1" value="<?=$rows[comp]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 수 량 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="qty_1" value="<?=$rows[qty]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'>
						</td>
					</tr>
					<tr>
						<td style="padding:3 0 0 16px"> 출고가격 <font color="#ff0000">*</font></td>
						<td style="padding:3 0 0 0px">
							<input type="text" name="price_out_1"  value="<?=$rows[price_out]?>" size="35" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')" onkeyPress ='iNum(this)'>
						</td>
					</tr>

					<tr>
						<td style="padding:3 0 8 16px; border-width: 0 0 1 0; border-color:#CFCFCF; border-style: solid;"> 리스트이미지 </td>
						<td style="padding:3 0 8 0px; border-width: 0 0 1 0; border-color:#CFCFCF; border-style: solid;">
							<input type="file" name="p_img_1" size="18" class="inputStyle2" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2')">
						</td>
					</tr>

					<tr align="center">
					</tr>
					</table>
					</td>
				</tr>
				<tr>
					<td valign="top" align="center">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="20" align="center"></td>
					</tr>
					<tr>
						<td align="center">
							<input type="button" value=" 수정하기 " onclick="_editChk2()" class="inputstyle1">
							<input type="button" value=" 닫 기 " onclick="self.close();" class="inputstyle1">
						</td>
					</tr>
					</table>
					</form>
					</td>
				</tr>
				</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</body>
</html>
<?
	 }
?>
