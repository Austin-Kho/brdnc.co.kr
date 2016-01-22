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

	$edit_code=$_REQUEST['edit_code'];

	$query="select * from cms_accounts where code='$edit_code'";
	$result=mysql_query($query, $connect);
	$rows=mysql_fetch_array($result);

	$co_no=explode("-",$rows[co_no]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="stylesheet" href="../common/cms.css">
	<script language="JavaScript" src="../common/global.js"></script>
	<script type="text/javascript">
	<!--
		function _editChk(){

		var form = document.form1;

		
		if(!form.acc_name.value){
			alert('거래처명을 입력하세요!');
			form.acc_name.focus();
			return;
		}
		
		
		if(!form.co_no1.value){
			alert('사업자등록번호를 입력하세요!');
			form.co_no1.focus();
			return;
		}

		if(form.co_no1.value) {
			if(/*!IsNumber(form.co_no1.value)||*/form.co_no1.value.length<3){
		    alert("첫 번째 사업자등록번호는 세자리 숫자이어야 합니다!");
				 form.co_no1.value="";
			   form.co_no1.focus();
				 return;
		  }	
		}
	
		if(!form.co_no2.value){
			alert('사업자등록번호를 입력하세요!');
			form.co_no2.focus();
			return;
		}

		if(form.co_no2.value) {
			if(/*!IsNumber(form.co_no2.name)||*/form.co_no2.value.length<2){
				 alert("두 번째 사업자등록번호는 두자리 숫자이어야 합니다!");
				 form.co_no2.value="";
				 form.co_no2.focus();
				 return;
			}
		}

		if(!form.co_no3.value){
			alert('사업자등록번호를 입력하세요!');
			form.co_no3.focus();
			return;
		}

		if(form.co_no3.value) {
			if(/*!IsNumber(form.co_no3.name)||*/form.co_no3.value.length<5){
			  alert("세 번째 사업자등록번호는 다섯자리 숫자이어야 합니다!");
				 form.co_no3.value="";
				 form.co_no3.focus();
				 return;
			}
		}

		if(!form.acc_cla.value){
			alert('거래처 분류를 선택하세요!');
			form.acc_cla.focus();
			return;
		}

		if(!form.acc_worker.value){
			alert('담당자를 입력하세요!');
			form.acc_worker.focus();
			return;
		}

		if(!form.phone.value){
			alert('연락처를 입력하세요!');
			form.phone.focus();
			return;
		}
	
		/*
		if(!form.address.value){
			alert('거래처 주소를 입력하세요!');
			form.address.focus();
			return;
		}
		*/

		var a = confirm('거래처 정보를 수정 하시겠습니까?')
		if(a==true){
			form.submit();
		} else {
			return;
		}
	}
	function rate_Op(){
		 var form = document.form1;
		 if(form.acc_cla.value>1){
				form.co_rate.disabled=0;
				form.co_rate.focus();
		 }else{
				form.co_rate.disabled=1;
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
				<font color="#4C63BD" style="font-size:11pt"><b>거래처 정보수정</b></font>
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
					<form name="form1" action="accounts_edit_post.php" method="post">
					<input type="hidden" name="code" value="<?=$rows[0];?>">
					<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr align="center" height="35">
						<td width="100%" bgcolor="#F4F4F4" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;" colspan="3">
							변경할 거래처 정보를 수정해 주십시요. (<font color="#ff0000">*</font>표시는 필수입력 정보)
						</td>
					</tr>
					<tr>
						<td style="padding:18 0 0 16px"> 사이트명(별칭) </td>
						<td style="padding:18 0 0 0px" colspan="2">
							<input type="text" name="si_name" value="<?=$rows[si_name]?>" size="30" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');"> 							
						</td>
					</tr>
					<tr>
						<td style="padding:10 0 0 16px"> 거래처명 <font color="#ff0000">*</font></td>
						<td style="padding:10 0 0 0px" colspan="2">
							<input type="text" name="acc_name" value="<?=$rows[acc_name]?>" size="30" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');"> 							
						</td>
					</tr>
					<tr>
						<td style="padding:10 0 0 16px"> 사업자등록번호 <font color="#ff0000">*</font></td>
						<td style="padding:10 0 0 0px" colspan="2">
							<input type="text" name="co_no1" value="<?=$co_no[0]?>" size="5" maxlength="3" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');"> -
							<input type="text" name="co_no2" value="<?=$co_no[1]?>" size="5" maxlength="2" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');"> -
							<input type="text" name="co_no3" value="<?=$co_no[2]?>" size="9" maxlength="5" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');">
						</td>
					</tr>
					<tr>
						<td style="padding:10 0 0 16px"> 분&nbsp;&nbsp; 류 <font color="#ff0000">*</font></td>
						<td style="padding:10 0 0 0px">
							<select name="acc_cla" onChange="rate_Op()" style="width:80">
								<option value="" <?if($rows[acc_cla]==0) echo "selected";?>> 선 택
								<option value="1" <?if($rows[acc_cla]==1) echo "selected";?>> 매입 거래처
								<option value="2" <?if($rows[acc_cla]==2) echo "selected";?>> 매출 거래처
								<option value="3" <?if($rows[acc_cla]==3) echo "selected";?>> 매입·매출 거래처
							</select> 							
						</td>
						<td style="padding:10 0 0 0px">
							수수료율 : 
							<input type="text" name="co_rate" value="<?=$rows[co_rate]*100?>" size="5" maxlength="5" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');" <?if($rows[acc_cla]<=1) echo "disabled";?>> %
						</td>
					</tr>
					<tr>
						<td style="padding:10 0 0 16px"> 담당자 <font color="#ff0000">*</font></td>
						<td style="padding:10 0 0 0px" colspan="2">
							<input type="text" name="acc_worker" value="<?=$rows[acc_worker];?>" size="30" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');"> 							
						</td>
					</tr>
					<tr>					
						<td style="padding:10 0 0 16px"> 연락처 <font color="#ff0000">*</font></td>
						<td style="padding:10 0 0 0px" colspan="2">
							<input type="text" name="phone" value="<?echo $rows[phone];?>" size="30" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');">
						</td>
					</tr>					
					<tr>					
						<td style="padding:10 0 23 16px; border-width: 0 0 1 0px; border-color:#CFCFCF; border-style: solid;"> 주&nbsp;&nbsp; 소&nbsp;&nbsp;</td>
						<td style="padding:10 0 23 0px; border-width: 0 0 1 0; border-color:#CFCFCF; border-style: solid;" colspan="2">
							<input type="text" name="address" value="<?=$rows[address];?>" size="48" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');"> 							
						</td>
					</tr>
					
					<tr align="center">
						<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
					</tr>
					</table>
					</form>
					</td>
				</tr>									
				<tr>
					<td valign="top" align="center">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="16" align="center"></td>
					</tr>
					<tr>
						<td align="center">
							<input type="button" value=" 수정하기 " onclick="_editChk()" class="inputstyle1">
							<input type="button" value=" 목록으로 " onclick="history.go(-1);" class="inputstyle1">
						</td>
					</tr>
					</table>
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
