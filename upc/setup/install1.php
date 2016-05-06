<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?
	include "setup_lib.php";
	head();
	if(file_exists("config_set.php")) err_msg("이미 config_set.php가 생성되어 있습니다.<br><br>재설치하려면 해당 파일을 지우세요");
?>

<script>
	function check_submit(){
		 if(!write.hostname.value){
				alert("HostName을 입력하세요");
				write.hostname.focus();
				return false;
		 }
		 if(!write.user_id.value){
		 	  alert("USER ID 를 입력하세요");
			  write.user_id.focus();
			  return false;
		 }
		 if(!write.passwd.value){
		 	  alert("PASSWORD 를 입력하세요");
			  write.passwd.focus();
			  return false;
		 }
		 if(!write.dbname.value){
			  alert("DB Name를 입력하세요");
			  write.dbname.focus();
			  return false;
		 }
		 return true;
	}
</script> 
<body bgcolor=#000000 text=#ffffff>
<br><br><br>
<div align=center>
<table cellpadding=0 cellspacing=0 width=600 border=0>

<tr>
  <td height='80' valign='top'><!-- <img src=../../bbs/images/inst_top.gif><br> -->
	<font size="5" color=""><b>CIGIKO MANAGEMENT SYSTEM</b></font> ver 1.0 Installation<br>[CMS] 1.0 설치</td>
</tr>

<tr>
  <td>
	<table width='100%' border='0'>
	<tr>
		<td width='120'>
    <!-- <img src=../../bbs/images/inst_step2.gif><br> -->
		<b>MySQL DB설정</b></td>
		<td valign="bottom"><font size="1" color="#7b7b7b">[CMS]를 사용하기 위하여 MySQL DB설정을 하여야 합니다.</font></td>
	</tr>
	<tr>
		<td></td>
		<td><font size="1" color="#7b7b7b">(DB서버에 대한 문의는 관리자에 하시면 됩니다.)</font></td>
	</tr>
	</table>
	</td>
</tr>

<tr>
  <td>
  <br>
	<form name='write' method='post' action='install1_post.php' onsubmit="return check_submit();">
	<table border='0' cellpadding='2' cellspacing='0'>
	<tr>
		<td width='90' align='right' style='font-family:Tahoma;font-size:8pt;'>Host Name</td>
		<td width='90'><input type=text name='hostname' value='localhost' style='font-family:Tahoma;font-size:8pt;'></td>
		<td width='300'>MySQL DB의 호스트네임을 입력하세요.</font></td>
	</tr>
	<tr>
		<td align='right' style='font-family:Tahoma;font-size:8pt;'>SQL User ID</td>
		<td><input type=text name='user_id' style='font-family:Tahoma;font-size:8pt;'></td>
		<td>MySQL계정의 ID를 입력하세요</font></td>
	</tr>
	<tr>
		<td align='right' style='font-family:Tahoma;font-size:8pt;'>Password</td>
		<td><input type='password' name='passwd' style='font-family:Tahoma;font-size:8pt;'></td>
		<td>Mysql DB의 패스워드를 입력하세요</font></td>
	</tr>
	<tr>
		<td align='right' style='font-family:Tahoma;font-size:8pt;'>DB Name</td>
		<td><input type=text name='dbname' style='font-family:Tahoma;font-size:8pt;'></td>
		<td>Mysql DB의 Name을 입력하세요</font></td>
	</tr>
	<tr>
		<td colspan='3' align='center'><br><br><!-- <input type=image src=../../bbs/images/inst_b_2.gif border=0 align=absmiddle> --><input type='submit' value='설정 완료' style='height:30px;'></td>
	</tr>
	</form>
	</table><br>
	</td>
</tr>
</table>
