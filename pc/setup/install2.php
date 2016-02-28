<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?
  require "setup_lib.php";
  head();
	$hostname = $_REQUEST['hostname'];
	$user_id = $_REQUEST['user_id'];
	$passwd = $_REQUEST['passwd'];
	$dbname = $_REQUEST['dbname'];
?>
<body bgcolor='#000000' text='#ffffff'>
<br><br><br>
<div align='center'>
<table cellpadding='0' cellspacing='0' width='600' border='0'>
<tr>
  <td height='80' colspan='3'><!-- <img src=../../bbs/images/inst_top.gif> --><font size="5" color=""><b>CIGIKO MANAGEMENT SYSTEM</b></font> ver 1.0 Installation<br>[CMS] 1.0 설치</td></td>
</tr>
<tr>
  <td> 
    <br>
  </td>
</tr>
</table>
<!-- 기본 정보 입력받는곳 -->
<script>
 function check_submit(){
		if(!write.admin_id.value){
			 alert("아이디를 입력하세요");
			 write.admin_id.focus();
			 return false;
		}
		if(!write.passwd1.value){
			 alert("Password를 입력하세요");
			 write.passwd1.focus();
			 return false;
		}
		if(!write.passwd2.value){
			 alert("Confirm Password를 입력하세요");
			 write.passwd2.focus();
			 return false;
		}
		if(write.passwd1.value!=write.passwd2.value){
			 alert("Password가 일치하지 않습니다");
			 write.passwd1.value="";
			 write.passwd2.value="";
			 write.passwd1.focus();
			 return false;
		}
		if(!write.name.value){
			 alert("Name를 입력하세요");
			 write.name.focus();
			 return false;
		}
		return true;
	}
</script>

<table border='0' cellpadding='2' cellspacing='0' width='600'>
<form name='write' method='post' action="install2_post.php" onsubmit="return check_submit();">
<input type="hidden" name="hostname" value="<?=$hostname?>">
<input type="hidden" name="user_id" value="<?=$user_id?>">
<input type="hidden" name="passwd" value="<?=$passwd?>">
<input type="hidden" name="dbname" value="<?=$dbname?>">
<tr>
  <td colspan='2'>
	<table width='100%' border='0'>
	<tr>
		<td width='135'>
    <!-- <img src=../../bbs/images/inst_step3.gif> -->
		<b>관리자 정보 입력</b></td>
		<td valign="bottom"><font size="1" color="#7b7b7b"><b>전체 권한이 부여되는 최고 관리자 Admin 의 기본정보를 입력합니다.</b></font></td>
	</tr>
	<tr>
		<td></td>
		<td><font size="1" color="#7b7b7b"><b>자세한 정보 입력은 설정 후 회원정보수정 페이지에서 추가변경하세요.</b></font></td>
	</tr>
	</table>
  
  </td>
</tr>

<tr>
  <td width='150' align='right' style='font-family:Tahoma;font-size:8pt; padding:18 2 2 2;'>ID&nbsp;</td>
  <td width='450' style='padding:18 2 2 2;'> <input type='text' name='admin_id' size='20' maxlength='20' style='font-family:Tahoma;font-size:8pt;'></td>
</tr>

<tr>
  <td  align='right' style='font-family:Tahoma;font-size:8pt; padding:2 2 2 2;'>Password&nbsp;</td>
  <td > <input type='password' name='passwd1' size='20' maxlength='20' style='font-family:Tahoma;font-size:8pt;  padding:2 2 2 2;'></td>
</tr>

<tr>
  <td  align='right' style='font-family:Tahoma;font-size:8pt; padding:2 2 2 2;'>Confirm Password&nbsp;</td>
  <td > <input type='password' name='passwd2' size='20' maxlength='20' style='font-family:Tahoma;font-size:8pt; padding:2 2 2 2;'></td>
</tr>

<tr>
  <td  align='right' style='font-family:Tahoma;font-size:8pt; padding:2 2 2 2;'>Name&nbsp;</td>
  <td > <input type='text' name='name' size='20' value='<?echo $data[name];?>' maxlength='20' style='font-family:Tahoma;font-size:8pt; padding:2 2 2 2;'></td>
</tr>

<tr>
  <td align='center' colspan=2><br>
<br><input type='submit' value='정보 입력 완료' style='height:30;'>
  </td>
</tr>
</form>
</table>
