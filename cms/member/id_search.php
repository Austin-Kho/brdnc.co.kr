<?		
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="stylesheet" href="../common/nsm.css">
	<script language="JavaScript" src="../common/global.js"></script>
	<script language="JavaScript">
	<!--
		function send(){
			var obj=document.id_check;
			var str=obj.receive_id.value;

			if(!str){
				alert('아이디를 입력하세요.');
				obj.receive_id.focus();
				return;
			}
			if(str.length<6){
				 alert('아이디는 띄어쓰기 없이 6~10자 \n영문/숫자를 혼합하여 입력하십시요.');
				 obj.receive_id.focus();
				 return;
			}
			obj.submit();
		}

			function form_send(s_id){
				opener.document.form1.id.value=s_id;
				self.close();
			}
	-->
	</script>
</head>

<body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0'>
	<table border='0' cellpadding='0' cellspacing='0' width='100%' height="100%">
	<tr>
		<td style="border-width: 2 0 0 0; border-color:#C5FAC9; border-style: solid; padding:6 0 0 0px">
			<table border="0" width="96%" height="94%" align="center" valign="middle" bgcolor="#96ABE5">
			<tr height="80" bgcolor="#D9EAF8">
				<td align="center" height="32" background="../img/bg.jpg">
				<font color="#4C63BD" style="font-size:11pt"><b>아이디(ID) 검색</b></font>
				</td>
			</tr>
			<?
				$receive_id=$_GET['receive_id'];

				$query="select id from erp_member where id='$receive_id'";
				$result=mysql_query($query, $connect);
				$total_num=mysql_num_rows($result);
				if($total_num){
			?>
			<tr bgcolor="ffffff">
				<td style="padding:13 0 0 0px">				
				<table align="center" width="96%" height="100%" cellspacing="0" cellpadding="0">
				<form name="id_check" action="<?=$_SERVER['PHP_SELF']?>">
				<tr bgcolor="#EAEAEA" height="40">
					<td style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;" class="emp">
					<table width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td class="emp">&nbsp;&nbsp;&nbsp;입력하신 아이디 <font color="#6073D1"><b><?=$receive_id?></b></font> 는 수신 가능한 아이디(ID) 입니다.</td>
						<td><a href="javascript:form_send('<?=$receive_id?>')"><img src="../img/input.jpg" border="0"></a></td>
					</tr>
					</table>				
					</td>					
				</tr>
				<tr height="10">
					<td></td>
				</tr>
				<tr height="28">
					<td>
					<table width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" width="100" bgcolor="F8F8F8" style="border-width: 1 1 1 1; border-color:#CFCFCF; border-style: solid;" class="bla">아이디 입력</td>
						<td style="border-width: 1 1 1 0; border-color:#CFCFCF; border-style: solid;">&nbsp;
							<input type="text" name="receive_id" size="22" class="inputstyle1" onmouseover="cngClass(this,'inputStyle11')" onmouseout="cngClass(this,'inputStyle1');">&nbsp;&nbsp;<input type="image" src="../img/chk.jpg">
						</td>
					</tr>
					</table>					
					</td>
				</tr>
				<tr>
					<td valign="middle">
					<b>아이디는 6~12자 영문/숫자를 혼합하여 입력하십시요.</b></td>
				</tr>
				</table>
				</form>
			<?
				} else {
			?>
			<tr bgcolor="ffffff">
				<td style="padding:13 0 0 0px">				
				<table align="center" width="96%" height="100%" cellspacing="0" cellpadding="0">
				<form name="id_check" action="<?=$_SERVER['PHP_SELF']?>">
				<tr bgcolor="#EAEAEA" height="40">
					<td style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">
					<table width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td class="emp">&nbsp;&nbsp;&nbsp;입력하신 아이디 <font color="#cc3300"><b><?=$receive_id?></b></font> 는 존재하지 않는 아이디(ID) 입니다.</td>
						<td></td>
					</tr>
					</table>					
					</td>
				</tr>
				<tr height="10">
					<td></td>
				</tr>
				<tr height="28">
					<td>
					<table width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center" width="100" bgcolor="F8F8F8" style="border-width: 1 1 1 1; border-color:#CFCFCF; border-style: solid;" class="bla">아이디 입력</td>
						<td style="border-width: 1 1 1 0; border-color:#CFCFCF; border-style: solid;">&nbsp;
							<input type="text" name="receive_id" size="22" class="inputstyle1">&nbsp;&nbsp;<img src="../img/chk.jpg" border="0" onclick="javascript:send()">
						</td>
					</tr>
					</table>					
					</td>
				</tr>
				<tr>
					<td valign="middle">
					<b>아이디는 6~12자 영문/숫자를 혼합하여 입력하십시요.</b></td>
				</tr>
				</table>
				</form>
				</td>
			<?
				}
			?>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</body>
</html>
