<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

  Header("Content-type: application/vnd.ms-excel");
  Header("Content-type: charset=UTF-8");
  header("Content-Disposition: attachment; filename=in_out_list.xls");
  Header("Content-Description: PHP5 Generated Data");
  Header("Pragma: no-cache");
  Header("Expires: 0");

	$add_where = stripslashes($_REQUEST['add_where']);
	$add_arr = $_REQUEST['add_arr'];
?>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=UTF-8">
<table border="1" width="100%" cellspacing="0" cellpadding="0">
	<tr align="center" height="35">
			<td bgcolor="#EAEAEA">번호</td>
			<td bgcolor="#EAEAEA">거래 구분</td>
			<td bgcolor="#EAEAEA">거래 종류</td>
			<td bgcolor="#EAEAEA">거 래 처</td>
			<td bgcolor="#EAEAEA">카테고리</td>
			<td bgcolor="#EAEAEA">브랜드(BRAND)</td>
			<td bgcolor="#EAEAEA">스타일(STYLE)</td>
			<td bgcolor="#EAEAEA">컬러(COL)</td>
			<td bgcolor="#EAEAEA">수량(QTY)</td>
			<td bgcolor="#EAEAEA">거래 가격</td>
			<td bgcolor="#EAEAEA">거래 일자</td>
	</tr>
<?
	$query1="select * from cms_stock_main,cms_accounts $add_where $add_arr ";
	$result1=mysql_query($query1, $connect);
	for($i=1; $rows1=mysql_fetch_array($result1); $i++){
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
		<td align="center"><?=$i?></td>
		<td align="center"><?=$div?></td>
		<td align="center"><?=$cla?></td>
		<td><?=$rows1[si_name]?></td>
		<td><?=$rows1[category]?></td>
		<td><?=stripslashes($rows1[brand])?></td>
		<td><?=$rows1[style]?></td>
		<td><?=$rows1[color]?>&nbsp;</td>
		<td align="right"><?=$rows1[qty]?></td>
		<td align="right"><?=$price?></td>
		<td align="center"><?=$rows1[st_date]?></td>
	</tr>
<?
	 }
	 mysqli_free_result($result1);
?>
<tr>
		<td colspan='2' bgcolor="#EAEAEA"> 합 계 </td>
		<td bgcolor="#EAEAEA">&nbsp;</td>
		<td align="center" bgcolor="#EAEAEA">&nbsp;</td>
		<td bgcolor="#EAEAEA"><?=$rows1[style]?>&nbsp;</td>
		<td bgcolor="#EAEAEA"><?=$rows1[color]?>&nbsp;</td>
		<td bgcolor="#EAEAEA"><?=$rows1[comp]?>&nbsp;</td>
		<td align="right" bgcolor="#EAEAEA"><?=$total_qty?>&nbsp;</td>
		<td align="right" bgcolor="#EAEAEA"><?=$total_p_in?>&nbsp;</td>
		<td align="right" bgcolor="#EAEAEA"><?=$total_p_set?></td>
		<td align="center" bgcolor="#EAEAEA">&nbsp;</td>
	</tr>
</table>
