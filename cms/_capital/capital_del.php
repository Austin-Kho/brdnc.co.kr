<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?
	include '../php/config.php';
	include '../php/util.php';
	$connect=dbconn();

	$del_code=$_REQUEST['del_code'];

	$qry="DELETE FROM cms_capital_cash_book WHERE seq_num='$del_code' ";
	$res=mysql_query($qry, $connect);
	if(!$res) err_msg('데이터베이스 오류가 발생하였습니다!');

	echo ("<script>
				window.alert('정상적으로 삭제되었습니다!');
				history.go(-1);
			</script>");
?>
