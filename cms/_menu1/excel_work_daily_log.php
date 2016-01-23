<?
session_start();
// Header("Content-type: application/vnd.ms-excel");
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
Header("Content-type: charset=UTF-8");
	$date_ = $_REQUEST['date_'];
	$pj_where=$_REQUEST['pj_where'];
header("Content-Disposition: attachment; filename=".$date_." 업무일지(".$pj_where.").xls");
Header("Content-Description: PHP5 Generated Data");
Header("Pragma: no-cache");
Header("Expires: 0");

//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//header('Content-Disposition: attachment;filename="01simple.xlsx"');
//header('Cache-Control: max-age=0');
	
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	$seq = $_REQUEST['seq'];
	// seq 만 받고 나머지 구하기
	

	$qry = "SELECT * FROM cms_work_log WHERE seq='$seq'";
	$rlt = mysql_query($qry, $connect);
	$row = mysql_fetch_array($rlt);

	$h_t = explode("-", $pj_where);

	// 현장명 구하기
	$pj_name_rlt = mysql_query("SELECT pj_name FROM cms_project_info WHERE seq='$row[pj_seq]' ", $connect);
	$pj_name_row = mysql_fetch_array($pj_name_rlt);
	// 소속본부 구하기
	$headq_rlt = mysql_query("SELECT headq FROM cms_resource_headq WHERE seq='$h_t[0]' ", $connect);
	$headq_row = mysql_fetch_array($headq_rlt);
	// 소속 팀 구하기
	$team_rlt = mysql_query("SELECT team FROM cms_resource_team WHERE seq='$h_t[1]' ", $connect);
	$team_row = mysql_fetch_array($team_rlt);



	/***************** 당일(가)계약 내용 *******************/
	$co_sort = explode("/", $row[co_sort]);
	$c_cust_name = explode("/", $row[c_cust_name]);
	$dong_ho = explode("/", $row[dong_ho]);
	$due_date = explode("/", $row[due_date]);
	$c_worker = explode("/", $row[c_worker]);
	/***************** 당일(가)계약 내용 *******************/

	/***************** 주요고객 진행사항 *******************/
	$d_cust_name = explode("/", $row[d_cust_name]);
	$d_content = explode("/", $row[d_content]);
	$d_worker = explode("/", $row[d_worker]);
	/***************** 주요고객 진행사항 *******************/

	/***************** 익일방문예정 고객 *******************/
	$n_cust_name = explode("/", $row[n_cust_name]);
	$n_content = explode("/", $row[n_content]);
	$n_worker = explode("/", $row[n_worker]);
	/***************** 익일방문예정 고객 *******************/

	switch (date('w', strtotime($row[work_date]))){
		case 0 : $day = "일요일"; break;
		case 1 : $day = "월요일"; break;
		case 2 : $day = "화요일"; break;
		case 3 : $day = "수요일"; break;
		case 4 : $day = "목요일"; break;
		case 5 : $day = "금요일"; break;
		case 6 : $day = "토요일"; break;
	}
?>
<style type="text/css">
	td{ font-family:맑은 고딕;  font-size: 12px; }
</style>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<table border="1" cellpadding="0" cellspacing="0">	
	<tr height="24">
		<td colspan="7" rowspan="2" style="font-size:24px;" align="center"><b><?=$pj_name_row[pj_name]?> 현장 업무일지</b></td>
		<td rowspan="2" style="width:37px; text-align:center;">결<br>재</td>
		<td style="width:93px; text-align:center;">팀장</td>
		<td style="width:93px; text-align:center;">본부장</td>
	</tr>
	<tr height="76">
		<td></td>
		<td></td>
	</tr>
	<tr height="31">
		<td colspan="7" style="padding-left:20px;"><?=date('Y년 m월 d일 ', strtotime($row[work_date])).$day?></td>		
		<td colspan="3" style="text-align:center;"><?=$pj_name_row[pj_name]?> 현장</td>
	</tr>
	<tr height="26">
		<td style="width:117px; text-align:center; background-color:#DCE6F1;">소 속</td>
		<td style="width:93px; text-align:center;"><?=$headq_row[headq]?></td>
		<td colspan="2" style="text-align:center;"><?=$team_row[team]?></td>
		<td colspan="3" style="text-align:center; background-color:#DCE6F1;">출근인원(팀장포함)</td>
		<td colspan="3" style="text-align:right; padding-right:20px;"><?=$row[work_num]?> 명</td>
	</tr>	


	<!-- ======================================= 당일 계약사항 ======================================= -->
	<tr height="31">
		<td colspan="10" style="padding-left:20px;"><font color="red"><b>*</b></font> <b>계 약 사 항</b></td>
	</tr>
	<tr height="26">
		<td style="width:117px; text-align:center; background-color:#DCE6F1;">당일 가계약 건</td>
		<td style="width:93px; text-align:center;">청약 : <?=$row[pro_cont_num]?> 건</td>
		<td colspan="2" style="text-align:center;">청약 해지 : <?=$row[pro_cont_c_num]?> 건</td>
		<td colspan="3" style="text-align:center; background-color:#DCE6F1;">당일 정계약 건</td>
		<td colspan="3" style="text-align:right; padding-right:20px;"><?=$row[cont_num]?> 건</td>
	</tr>
	<!-- ======================================= 당일 계약사항 ======================================= -->



	<!-- ======================================= 당일 (가)계약 내용 ======================================= -->
	<tr height="26">
		<td rowspan="<?=count($co_sort)+1?>" style="width:117px; text-align:center; background-color:#DCE6F1;">당일 (가)계약 내용</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">구 분</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">고객명</td>
		<td colspan="3" style="text-align:center; background-color:#EEECE1;">동호수</td>
		<td colspan="3" style="text-align:center; background-color:#EEECE1;">계약 예정일</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">담당자</td>
	</tr>	
	<?		
		for($i=0; $i<count($co_sort); $i++){
			switch ($co_sort[$i]){
				case 1 : $co_sort_ = "청약(가계약)"; break;
				case 2 : $co_sort_ = "청약해지"; break;
				case 3 : $co_sort_ = "계약(정계약)"; break;
				default : $co_sort_ = "-"; break;
			}
	?>
	<tr height="26">
		<td style="width:93px; text-align:center;"><?=$co_sort_?></td>
		<td style="width:93px; text-align:center;"><?=$c_cust_name[$i]?></td>
		<td colspan="3" style="width:37px; text-align:center;"><?=$dong_ho[$i]?></td>
		<td colspan="3" style="width:21px; text-align:center;"><?=$due_date[$i]?></td>
		<td style="width:93px; text-align:center;"><?=$c_worker[$i]?></td>
	</tr>
	<? } ?>
	<!-- ======================================= 당일 (가)계약 내용 ======================================= -->



	<!-- ======================================= 당일 업무 내용 ======================================= -->
	<tr height="31">
		<td colspan="10" style="padding-left:20px;"><font color="red"><b>*</b></font> <b>당일 업무내용</b></td>
	</tr>
	<tr height="26">
		<td rowspan="2" style="width:117px; text-align:center; background-color:#DCE6F1;">당일 영업현황</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">지명콜수(팀)</td>
		<td style="width:93px; text-align:right; padding-right:20px;"><?=$row[t_ca_num]?> 건</td>
		<td colspan="2" style="text-align:center; background-color:#EEECE1;">지명방문자수</td>
		<td colspan="3" style="text-align:right; padding-right:20px;"><?=$row[t_wa_num]?> 건</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">TM 건수</td>
		<td style="width:93px; text-align:right; padding-right:20px;"> <?=$row[tm_num]?> 건</td>
	</tr>
	<tr height="26">
		<td style="width:93px; text-align:center; background-color:#EEECE1;">일반콜수(본부)</td>
		<td style="width:93px; text-align:right; padding-right:20px;"><?=$row[h_ca_num]?> 건</td>
		<td colspan="2" style="text-align:center; background-color:#EEECE1;">일반방문자수</td>
		<td colspan="3" style="text-align:right; padding-right:20px;"><?=$row[h_wa_num]?> 건</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">DM/SMS 발송</td>
		<td style="width:93px; text-align:right; padding-right:20px;"> <?=$row[dm_sms_num]?> 건</td>
	</tr>

	<tr height="26">
		<? 
			$d_limit = 9-count($co_sort);
			if(count($d_cust_name)<$d_limit){
				$d_rowspan = $d_limit;
			}else{
				$d_rowspan = count($d_cust_name);
			}
		?>
		<td rowspan="<?=$d_rowspan+1?>" style="width:117px; text-align:center; background-color:#DCE6F1;">주요고객 진행사항</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">고객명</td>
		<td colspan="7" style="text-align:center; background-color:#EEECE1;">진 행 사 항</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">담당자</td>
	</tr>
	<?
		for($i=0; $i<$d_rowspan; $i++){
	?>
	<tr height="26">
		<td style="width:93px; text-align:center;"><?=$d_cust_name[$i]?></td>
		<td colspan="7" style="padding-left:20px;"><?=$d_content[$i]?></td>
		<td style="width:93px; text-align:center;"><?=$d_worker[$i]?></td>
	</tr>
	<? } ?>

	<tr height="78">
		<td style="width:117px; text-align:center; background-color:#DCE6F1;">홍보 영업활동</td>
		<td colspan="9" style="padding-left:20px;"><?=nl2br($row[d_sale_act])?></td>
	</tr>
	<!-- ======================================= 당일 업무 내용 ======================================= -->




	<!-- ======================================= 익일 업무 예정 ======================================= -->
	<tr height="31">
		<td colspan="10" style="padding-left:20px;"><font color="red"><b>*</b></font> <b>익일 업무예정</b></td>
	</tr>
	<tr height="26">
		<?
			$n_limit = 15-(count($co_sort)+$d_rowspan);
			if(count($n_cust_name)<$n_limit){
				$n_rowspan = $n_limit;
			}else{
				$n_rowspan = count($n_cust_name);
			}
		?>
		<td rowspan="<?=$n_rowspan+1?>" style="width:117px; text-align:center; background-color:#DCE6F1;">익일 방문예정 고객</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">고객명</td>
		<td colspan="7" style="text-align:center; background-color:#EEECE1;">진행 내용 / 방문 예정시간 / 연락처</td>
		<td style="width:93px; text-align:center; background-color:#EEECE1;">담당자</td>
	</tr>
	<?
		for($i=0; $i<$n_rowspan; $i++){
	?>
	<tr height="26">
		<td style="width:93px; text-align:center;"><?=$n_cust_name[$i]?></td>
		<td colspan="7" style="padding-left:20px;"><?=$n_content[$i]?></td>
		<td style="width:93px; text-align:center;"><?=$n_worker[$i]?></td>
	</tr>
	<? } ?>
	<tr height="78">
		<td style="width:117px; text-align:center; background-color:#DCE6F1;">익일 영업계획</td>
		<td colspan="9" style="padding-left:20px;"><?=nl2br($row[n_sale_plan])?></td>
	</tr>
	<tr height="0">
		<td style="width:117px;"></td>
		<td style="width:93px;"></td>
		<td style="width:93px;"></td>
		<td style="width:37px;"></td>
		<td style="width:61px;"></td>
		<td style="width:45px;"></td>
		<td style="width:21px;"></td>
		<td style="width:37px;"></td>
		<td style="width:93px;"></td>
		<td style="width:93px;"></td>
	</tr>
	<!-- ======================================= 익일 업무 예정 ======================================= -->	
<?	 
	// mysql_free_result($rlt);
?>
</table>
