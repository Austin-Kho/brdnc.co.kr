<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=UTF-8">
<?
	$add_where = stripslashes($_REQUEST['add_where']);
	$add_arr = $_REQUEST['add_arr'];
	$total_qty = $_REQUEST['total_qty'];
	$total_p_in = $_REQUEST['total_p_in'];
	$total_p_set = $_REQUEST['total_p_set'];

  Header("Content-type: application/vnd.ms-excel");
  Header("Content-type: charset=UTF-8");
  header("Content-Disposition: attachment; filename=stock_list.xls");
  Header("Content-Description: PHP5 Generated Data");
  Header("Pragma: no-cache");
  Header("Expires: 0");
?>


<table border="1" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" height="35">
			<td bgcolor="#EAEAEA">번호</td>
			<td bgcolor="#EAEAEA">카테고리</td>
			<td bgcolor="#EAEAEA">브랜드(BRAND)</td>
			<!-- <td>IMAGE</td> -->
			<td bgcolor="#EAEAEA">스타일(STYLE)</td>
			<td bgcolor="#EAEAEA">컬러(COLOR)</td>
			<td bgcolor="#EAEAEA">재질(COMP)</td>
			<td bgcolor="#EAEAEA">수량(QTY)</td>
			<td bgcolor="#EAEAEA">입고 단가</td>
			<td bgcolor="#EAEAEA">책정 단가</td>
			<td bgcolor="#EAEAEA">입고 일자</td>
	</tr>
<?
	$query1="SELECT seq_num, category, brand, style, color,comp, price_in, price_out, set_price, accounts, worker, st_date, SUM(qty) AS st_qty
						 FROM (SELECT seq_num, category, brand, style, color,comp, price_in, price_out, set_price, accounts, worker, st_date,
					 				( CASE division WHEN '1' THEN qty ELSE (- qty) END )
						 AS qty FROM cms_stock_main) AS cms_stock_main $add_where
						 GROUP BY style, color having st_qty>0 $add_arr ";
		 $result1=mysql_query($query1, $connect);
		 for($i=1; $rows1=mysql_fetch_array($result1); $i++){
?>
	<tr>
		<td align="center"><?=$i?></td>
		<td><?=$rows1[category]?></td>
		<td align="left" ><?=$rows1[brand]?></td>
		<!-- <td align="center"></td> -->
		<td align="left"><?=$rows1[style]?></td>
		<td align="left"><?=$rows1[color]?>&nbsp;</td>
		<td align="left"><?=$rows1[comp]?></td>
		<td align="right"><?=$rows1[st_qty]?></td>
		<td align="right"><?=$rows1[price_in]?></td>
		<td align="right"><?=$rows1[set_price]?></td>
		<td align="center"><?=$rows1[st_date]?></td>
	</tr>
<?
	 }
	 mysqli_free_result($result1);
?>
<tr>
		<td bgcolor="#EAEAEA"> 합 계 </td>
		<td bgcolor="#EAEAEA"></td>
		<td bgcolor="#EAEAEA"></td>
		<!-- <td align="center"></td> -->
		<td bgcolor="#EAEAEA">&nbsp;</td>
		<td bgcolor="#EAEAEA">&nbsp;</td>
		<td bgcolor="#EAEAEA">&nbsp;</td>
		<td align="right" bgcolor="#EAEAEA"><?=$total_qty?></td>
		<td align="right" bgcolor="#EAEAEA"><?=$total_p_in?></td>
		<td align="right" bgcolor="#EAEAEA"><?=$total_p_set?></td>
		<td align="center" bgcolor="#EAEAEA"></td>
	</tr>
</table>
