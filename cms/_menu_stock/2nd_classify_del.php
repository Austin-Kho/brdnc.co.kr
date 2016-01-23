<?
	include '../php/config.php';
	include '../php/util.php';
	$connect=dbconn();


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
