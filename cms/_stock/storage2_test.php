<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	$qry = "SELECT no, style, color, SUM(qty) AS st_qty 
             FROM (SELECT no, style, color,
																				( CASE division WHEN '1' THEN qty ELSE (- qty) END )
											  AS qty FROM stock) AS stock 
             GROUP BY style, color";

	$rlt= mysql_query($qry, $connect);
	// $t = mysql_num_rows($rlt);

	echo $t;
?>
<table border=1>
<tr>
	<td>번 호</td>
	<td>스타일</td>
	<td>컬 러</td>
	<td>재고수량</td>
</tr>
<?
	while($rows=mysql_fetch_array($rlt)){
?>
<tr>
	<td><?=$rows[no]?>&nbsp;</td>
	<td><?=$rows[style]?>&nbsp;</td>
	<td><?=$rows[color]?>&nbsp;</td>
	<td align="right"><?=number_format($rows[st_qty])?>&nbsp;</td>
</tr>
<? } ?>
<tr><td align="center" colspan="3">total 수량</td><td align="right">&nbsp;</td></tr>
</table>
