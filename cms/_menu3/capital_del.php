<?
	include '../php/config.php';
	include '../php/util.php';
	$connect=dbconn();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?

	$del_code=$_REQUEST['del_code'];

	$qry="DELETE FROM cms_capital_cash_book WHERE seq_num='$del_code' ";
	$res=mysql_query($qry, $connect);
	if(!$res) err_msg('데이터베이스 오류가 발생하였습니다!');

	echo ("<script>
				window.alert('정상적으로 삭제되었습니다!');
				history.go(-1);
			</script>");
?>
