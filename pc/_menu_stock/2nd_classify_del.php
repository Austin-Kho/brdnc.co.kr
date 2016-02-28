<?
	include '../php/config.php';
	include '../php/util.php';
	$connect=dbconn();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?


		$del_code=$_REQUEST['del_code'];
		$category= $_REQUEST['category'];
		$brand = $_REQUEST['brand'];
		$fn = $_REQUEST['fn'];


		$qry="DELETE FROM cms_stock_2nd_classify WHERE no='$del_code' ";
		$res=mysql_query($qry, $connect);

		echo ("<script>
						window.alert('정상적으로 삭제되었습니다!');
						history.go(-1);
					 </script>");
?>
