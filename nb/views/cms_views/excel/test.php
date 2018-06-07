<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
Header("Content-Disposition: attachment; filename=".iconv("UTF-8","cp949//IGNORE", "_다운로드.xls"));
Header("Content-Description: PHP7 Generated Data" );
Header("Pragma: no-cache");
Header("Expires: 0");

// $sql = "select * from tblName order by reg_date desc";
// $result = mysql_query($sql);

// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr align='center' height='48'>
  <td colspan='3' style='font-size:15pt; text-align:center;'><b>".$project->pj_name." 수납 데이터</b></td>
</tr>
<tr><td  colspan='3' align='right' height='20' style='font-size:9pt;'>".date('Y-m-d')." 현재</td></tr>
<tr align='center' height='20' style='font-size:9pt;'>
  <td width='50' bgcolor='#EAEAEA'>번호</td>
  <td width='90' bgcolor='#EAEAEA'>코드</td>
  <td width='100' bgcolor='#EAEAEA'>내용</td>
</tr>";

// while($row = mysql_fetch_array($result)) {
//    $EXCEL_STR .= "
//    <tr>
//        <td align='center'>".$row['idx']."</td>
//        <td align='center'>".$row['code']."</td>
//        <td align='center'>".$row['contents']."</td>
//    </tr>
//    ";
// }

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;
?>
