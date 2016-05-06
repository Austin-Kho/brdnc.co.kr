<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?
	include "setup_lib.php";
	head();

	if(file_exists("config_set.php")) err_msg("이미 config_set.php가 생성되어 있습니다.<br>재설치하려면 해당 파일을 지우세요");
?>
<body bgcolor=#000000 text=#FFFFFF>
<script>
function check_submit(){
	if(!document.license.accept.checked) {
		alert("라이센스를 읽으시고 동의하시는 분만 [CMS]를 사용하실수 있습니다.\n라이센스를 모두 읽으신후 라이센스에 동의하시면 체크를 하신후 설치시작하세요");
		return false;
	}
	return true;
}

function check_view() {
	if(document.license.accept.checked) {
		if(confirm("라이센스를 모두 읽으시고 동의를 하십니까?")){
			return true;
		} else {
			return false;
		}
	}
}
</script>
<br><br><br>
<div align=center>
<form name=license>
<table cellpadding=3 cellspacing=0 width=600 border=0>
<tr>
  <td height=30 colspan=3>
	<!-- <img src=../../bbs/images/inst_top.gif><br> -->
	<font size="5" color=""><b>CIGIKO MANAGEMENT SYSTEM</b></font> ver 1.0 Installation<br>[CMS] 1.0 설치
	</td>
</tr>
<tr>
  <td><br>
    <!-- <img src=../../bbs/images/inst_step1.gif><br> -->
		<b>라이센스정보 <font size="1" color="#7b7b7b">설치를 시작하는 것은 동의함으로 간주합니다.</b></font><br><br>
    <textarea cols=90 rows=15 readonly><? include "license.txt"; ?></textarea>
	<br>
	<input type=checkbox name=accept value=1 onclick="return check_view()"> <font size="2" color="">위의 라이센스를 모두 읽었으며 동의합니다</font><br>
  </td>
</tr>
</form>
<tr>
  <td><br>
    <!-- <img src=../../bbs/images/inst_step1-2.gif><br> -->
		<b>설치하기전에 <font size="1" color="#7b7b7b">설치가 가능한 환경</b></font><br>
		&nbsp;&nbsp;&nbsp;<font size="2" color="">1. [CMS] 1.0dms PHP4 이상과 MySQL DB Server 가 설치 되어 있어야 합니다.</font><br>
		&nbsp;&nbsp;&nbsp<font size="2" color="">;2. DB설정전에 [CMS]가 설치된 디렉토리의 퍼미션을 707 이상으로 설정하셔야 합니다.</font><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="1" color="">(DB설정후엔 701로 변경하셔도 무방합니다. 자료실 이용시 data디렉토리의 퍼미션을 707로 하셔야 합니다.)</font>
		<br><br><br><div align=center>
<?
  if(fileperms(".")==16839||fileperms(".")==16895) $check="1";
  if(!$check) echo"
									<font color=red>현재 707로 퍼미션이 되어 있지 않습니다. 텔넷이나 FTP에서 퍼미션을 조정하세요.<font><br><br>
                  <div align=center>
									<table border=0>
										<tr>
										<form method=post action=$PHP_SELF>
											<td align=center height=30><input type=submit value='퍼미션 조정하였습니다' style=height:30px;></td>
										</tr>
									</table>";
  else echo"<br><br>
									<div align=center>
									<table border=0>
										<tr>
										<form method=post action=install1.php onsubmit='return check_submit()'>
											<td align=center height=30><input type=submit value='설치 시작' style='height:30px;'></td>
										</tr>
									</table>";
?>
  <br>
  </td>
</tr>
</form>
</table>
