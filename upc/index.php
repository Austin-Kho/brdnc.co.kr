<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?
  if(file_exists("setup/config_set.php")){
		 echo "<table align='center' width='500' height='200' border='0' cellpadding='0' cellspacing='0'>
		 <tr>
			<td align='center' valign='middle'><meta http-equiv='Refresh' content='0; URL=/pc/cms.php'></td>
		 </tr>
		 </table>";
	}else{
		 echo "<table align='center' width='500' height='200' border='0' cellpadding='0' cellspacing='0'>
		 <tr>
			<td align='center' valign='middle'><a href='setup/install.php'>CMS 설치하기</a></td>
		 </tr>
		 </table>";
	}
?>
