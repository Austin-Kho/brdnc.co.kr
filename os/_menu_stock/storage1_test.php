<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	$add_where = $_REQUEST['add_where'];
	$add_arr = $_REQUEST['add_arr'];

  Header("Content-type: application/vnd.ms-excel");
  Header("Content-type: charset=UTF-8");
  header("Content-Disposition: attachment; filename=stock_list.xls");
  Header("Content-Description: PHP5 Generated Data");
  Header("Pragma: no-cache");
  Header("Expires: 0");
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" height="35">
			<td bgcolor="#EAEAEA">카테고리</td>
			<td bgcolor="#EAEAEA">브랜드(BRAND)</td>
			<td bgcolor="#EAEAEA">IMAGE</td>
			<td bgcolor="#EAEAEA">스타일(STYLE)</td>
			<td bgcolor="#EAEAEA">컬러(COLOR)</td>
			<td bgcolor="#EAEAEA">재질(COMP.)</td>
			<td bgcolor="#EAEAEA">수량(QTY.)</td>
			<td bgcolor="#EAEAEA">입고 단가</td>
			<td bgcolor="#EAEAEA">책정 단가</td>
			<td bgcolor="#EAEAEA">입고 일자</td>
	</tr>
<?
	$query1="SELECT seq_num, category, brand, style, color,comp, price_in, price_out, set_price, accounts, worker, st_date, SUM(qty) AS st_qty
														FROM (SELECT seq_num, category, brand, style, color,comp, price_in, price_out, set_price, accounts, worker, st_date,
																				( CASE division WHEN '1' THEN qty ELSE (- qty) END )
														AS qty FROM main_stock) AS main_stock $add_where
													  GROUP BY style, color having st_qty>0 $add_arr ";
	$result1=mysql_query($query1, $connect);
	for($i=0; $rows1=mysql_fetch_array($result1); $i++){
		 if($rows1[division]==1) $div="<font color='#ff3366'>[입고]</font>";
		 if($rows1[division]==2) $div="<font color='#3366cc'>[출고]</font>";
		 if($rows1[classify]==1) $cla="매입입고";
		 if($rows1[classify]==2) $cla="반품입고";
		 if($rows1[classify]==3) $cla="수탁입고";
		 if($rows1[classify]==4) $cla="위탁회수";
		 if($rows1[classify]==5) $cla="판매출고";
		 if($rows1[classify]==6) $cla="반품출고";
		 if($rows1[classify]==7) $cla="수탁반납";
		 if($rows1[classify]==8) $cla="위탁출고";
		 if($rows1[classify]==9) $cla="재고조정";

		 if($rows1[division]==1&&$rows1[classify]<>2) $price=$rows1[price_in];
 		 if($rows1[division]==2||$rows1[classify]==2) $price=$rows1[price_out];
?>
	<tr>
		<td><?=$rows1[category]?>&nbsp;</td>
		<td align="left" ><?=$rows1[brand]?>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="left"><?=$rows1[style]?>&nbsp;</td>
		<td align="left"><?=$rows1[color]?>&nbsp;</td>
		<td align="left"><?=$rows1[comp]?>&nbsp;</td>
		<td align="right"><?=number_format($rows1[st_qty])?>&nbsp;</td>
		<td align="right"><?=number_format($rows1[price_in])?>&nbsp;</td>
		<td align="right"><?=number_format($rows1[set_price])?></td>
		<td align="center"><?=$rows1[st_date]?>&nbsp;</td>
	</tr>
<?
	 }
	 mysqli_free_result($result1);
?>
</table>
