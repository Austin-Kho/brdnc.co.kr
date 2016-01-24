
<?
session_start();
Header("Content-type: application/vnd.ms-excel");
Header("Content-type: charset=UTF-8");
Header("Content-Disposition: attachment; filename=contract_list.xls");
Header("Content-Description: PHP5 Generated Data");
Header("Pragma: no-cache");
Header("Expires: 0");

	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();


	$pj_seq = stripslashes($_REQUEST['pj_seq']);
	$data_cr = stripslashes($_REQUEST['data_cr']);
	$where = stripslashes($_REQUEST['where']);
	$limit = stripslashes($_REQUEST['limit']);
?>
<style type="text/css">
	td{ font-family:맑은 고딕;  font-size: 12px; line-height:150%; }
</style>
<meta http-equiv="Content-Type" content="application/vnd.ms-excel;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<table border="1" cellpadding="0" cellspacing="0">

<?if($data_cr==0){ // 동호수별 관리일 때 ?>
	<tr align="center" height="45">
		<td colspan="15" style="font-size:15pt; text-align:center;"><b>계약 현황 리스트</b></td>
	</tr>
	<tr align="center" height="35">
		<td width="40" bgcolor="#EAEAEA">동</td>
		<td width="40" bgcolor="#EAEAEA">호수</td>
		<td width="40" bgcolor="#EAEAEA">타입</td>
		<td width="60" bgcolor="#EAEAEA">계약자</td>
		<td width="100" bgcolor="#EAEAEA">연락처1</td>
		<td width="100" bgcolor="#EAEAEA">연락처2</td>
		<td width="80" bgcolor="#EAEAEA">청약일</td>
		<td width="75" bgcolor="#EAEAEA">청약금</td>
		<td width="80" bgcolor="#EAEAEA">계약예정일</td>
		<td width="80" bgcolor="#EAEAEA">계약일</td>
		<td width="85" bgcolor="#EAEAEA">계약금</td>
		<td colspan="2" bgcolor="#EAEAEA">MGM</td>
		<td colspan="2" bgcolor="#EAEAEA">담당자</td>
	</tr>
<?
		$color_rlt = mysql_query("SELECT type_name, type_color FROM cms_project_info WHERE seq='$pj_seq'", $connect); /// 타입별 컬러 구분
		$color_row = mysql_fetch_array($color_rlt);
		// 타입별 칼라 지정
		$type_name = explode("-", $color_row[type_name]);
		$type_color = explode("-", $color_row[type_color]);
		///////////////////////////////////////////////////////////////////////
		for($i=0; $i<count($type_name); $i++){
			$color[$type_name[$i]]=$type_color[$i];
		}
		$query1 = "SELECT pj_dong, pj_ho, type_ho, is_except, pro_contractor, is_pro_cont, pro_cont_tel_1, pro_cont_tel_2,
									    pro_cont_date, pro_draufgabe, pro_due_date, is_contract, contractor, cont_tel_1, cont_tel_2,
									    cont_date, draufgabe, cont_mgm_who, cont_mgm_tel, cont_mgm_sum, cont_worker, worker_where
									    FROM cms_project_data
									    $where $limit ";

		$result1 = mysql_query($query1, $connect);
		$data_num=mysql_num_rows($result1);
		$result1=mysql_query($query1, $connect);

		for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
			if($rows1[is_except]==1) { // 기분양 세대인 경우
				$bgcolor=" background-color:#d1d1d1; ";
			}else if($rows1[is_contract]==1) { // 계약상태 물건인 경우
				$bgcolor=" background-color:#ffdd77; ";
				$a=2;
			}else if($rows1[is_pro_cont]==1){ // 청약상태 물건인 경우
				$bgcolor=" background-color:#ffffb5; ";
			}else{ // 미계약 상태인 경우
				$bgcolor="";
			}
			$w_where = explode("-", $rows1[worker_where]);
?>
	<tr>
		<?if($rows1[is_except]==1) $bg_col = "bgcolor='#D1D1D1'"; else $bg_col = "";?>
		<td align="center" height="24" bgcolor="<?=$color[$rows1[type_ho]]?>"><?=$rows1[pj_dong]?></td>
		<td align="center" height="24" bgcolor="<?=$color[$rows1[type_ho]]?>"><?=$rows1[pj_ho]?></td>
		<td align="center" height="24" bgcolor="<?=$color[$rows1[type_ho]]?>"><?=$rows1[type_ho]?></td>
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[is_except]==1) echo "기분양분"; if($rows1[is_contract]==1) echo $rows1[contractor]; else echo $rows1[pro_contractor];?></td><!-- 계약자 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[is_contract]==1) echo $rows1[cont_tel_1]; else echo $rows1[pro_cont_tel_1];?></td><!-- 연락처1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[is_contract]==1) echo $rows1[cont_tel_2]; else echo $rows1[pro_cont_tel_2];?></td><!-- 연락처2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[pro_cont_date]>0)echo $rows1[pro_cont_date];?></td><!-- 청약일 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[pro_draufgabe]>0)echo number_format($rows1[pro_draufgabe]);?></td><!-- 청약금 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[pro_due_date]>0)echo $rows1[pro_due_date];?></td><!-- 계약 예정일 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[cont_date]>0)echo $rows1[cont_date];?></td><!-- 계약일 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[draufgabe]>0)echo number_format($rows1[draufgabe]);?></td><!--계약금 -->
		<td align="center" width="80" height="24" <?=$bg_col?>><?=$rows1[cont_mgm_who]?></td><!-- MGM to -->
		<td align="right" width="80" height="24" <?=$bg_col?>><?if($rows1[cont_mgm_sum]) echo number_format($rows1[cont_mgm_sum])?></td><!-- MGM sum -->
		<td align="center" width="36" height="24" <?=$bg_col?>><?=$w_where[1]?></td><!-- 소속 -->
		<td align="center" width="50" height="24" <?=$bg_col?>><?=$rows1[cont_worker]?></td><!-- 담당자 -->
	</tr>
<?
		}
		mysql_free_result($result1);
	}else if($data_cr==1){ // 계약 번호별 관리일 때
?>
	<tr align="center" height="45">
		<td colspan="15" style="font-size:15pt; text-align:center;"><b>계약 현황 리스트</b></td>
	</tr>
	<tr align="center" height="35">
		<td width="80" bgcolor="#EAEAEA">계약관리번호</td>
		<td width="40" bgcolor="#EAEAEA">타입</td>
		<td width="40" bgcolor="#EAEAEA">구분</td>
		<td width="40" bgcolor="#EAEAEA">차수</td>
		<td width="40" bgcolor="#EAEAEA">동</td>
		<td width="60" bgcolor="#EAEAEA">호수</td>
		<td width="240" bgcolor="#EAEAEA">비 고(특이사항)</td>
		<td width="100" bgcolor="#EAEAEA">업무대행비(합계)</td>
		<td width="100" bgcolor="#EAEAEA">납부분담금(합계)</td>
		<td width="40" bgcolor="#EAEAEA">청약여부</td>
		<td width="80" bgcolor="#EAEAEA">청약(해지)일</td>
		<td width="60" bgcolor="#EAEAEA">청약자</td>
		<td width="100" bgcolor="#EAEAEA">연락처1</td>
		<td width="100" bgcolor="#EAEAEA">연락처2</td>
		<td width="80" bgcolor="#EAEAEA">청약금</td>
		<td width="80" bgcolor="#EAEAEA">계약예정일</td>
		<td width="40" bgcolor="#EAEAEA">해지여부</td>
		<td width="40" bgcolor="#EAEAEA">환불여부</td>
		<td width="40" bgcolor="#EAEAEA">계약여부</td>
		<td width="80" bgcolor="#EAEAEA">계약일</td>
		<td width="60" bgcolor="#EAEAEA">계약자</td>
		<td width="100" bgcolor="#EAEAEA">연락처1</td>
		<td width="100" bgcolor="#EAEAEA">연락처2</td>
		<td width="280" bgcolor="#EAEAEA">주민등록 주소</td>
		<td width="280" bgcolor="#EAEAEA">우편발송 주소</td>
		<td width="40" bgcolor="#EAEAEA">9종</td>
		<td width="40" bgcolor="#EAEAEA">주등</td>
		<td width="40" bgcolor="#EAEAEA">주초</td>
		<td width="40" bgcolor="#EAEAEA">가증</td>
		<td width="40" bgcolor="#EAEAEA">인증</td>
		<td width="40" bgcolor="#EAEAEA">막도</td>
		<td width="40" bgcolor="#EAEAEA">신분</td>
		<td width="40" bgcolor="#EAEAEA">배주</td>
		<td width="80" bgcolor="#EAEAEA">업무대행비1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">업무대행비2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">업무대행비3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>
		<td width="80" bgcolor="#EAEAEA">업무대행비4</td>
		<td width="80" bgcolor="#EAEAEA">입금일4</td>
		<td width="60" bgcolor="#EAEAEA">입금자4</td>

		<td width="100" bgcolor="#EAEAEA">1차 계약금 합계</td>
		<td width="80" bgcolor="#EAEAEA">1차 계약금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">1차 계약금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">1차 계약금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td colspan="2" bgcolor="#EAEAEA">MGM</td>
		<td colspan="2" bgcolor="#EAEAEA">담당자</td>

		<td width="100" bgcolor="#EAEAEA">2차 계약금 합계</td>
		<td width="80" bgcolor="#EAEAEA">2차 계약금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">2차 계약금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">2차 계약금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">3차 계약금 합계</td>
		<td width="80" bgcolor="#EAEAEA">3차 계약금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">3차 계약금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">3차 계약금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">4차 계약금 합계</td>
		<td width="80" bgcolor="#EAEAEA">4차 계약금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">4차 계약금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">4차 계약금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">1차 중도금 합계</td>
		<td width="80" bgcolor="#EAEAEA">1차 중도금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">1차 중도금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">1차 중도금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">2차 중도금 합계</td>
		<td width="80" bgcolor="#EAEAEA">2차 중도금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">2차 중도금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">2차 중도금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">3차 중도금 합계</td>
		<td width="70" bgcolor="#EAEAEA">3차 중도금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">3차 중도금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">3차 중도금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">4차 중도금 합계</td>
		<td width="80" bgcolor="#EAEAEA">4차 중도금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">4차 중도금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">4차 중도금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">5차 중도금 합계</td>
		<td width="80" bgcolor="#EAEAEA">5차 중도금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">5차 중도금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">5차 중도금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">6차 중도금 합계</td>
		<td width="80" bgcolor="#EAEAEA">6차 중도금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">6차 중도금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">6차 중도금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">7차 중도금 합계</td>
		<td width="80" bgcolor="#EAEAEA">7차 중도금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">7차 중도금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">7차 중도금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="100" bgcolor="#EAEAEA">잔금 합계</td>
		<td width="80" bgcolor="#EAEAEA">잔금1</td>
		<td width="80" bgcolor="#EAEAEA">입금일1</td>
		<td width="60" bgcolor="#EAEAEA">입금자1</td>
		<td width="80" bgcolor="#EAEAEA">잔금2</td>
		<td width="80" bgcolor="#EAEAEA">입금일2</td>
		<td width="60" bgcolor="#EAEAEA">입금자2</td>
		<td width="80" bgcolor="#EAEAEA">잔금3</td>
		<td width="80" bgcolor="#EAEAEA">입금일3</td>
		<td width="60" bgcolor="#EAEAEA">입금자3</td>

		<td width="60" bgcolor="#EAEAEA">등록자</td>
		<td width="120" bgcolor="#EAEAEA">등록일시</td>
	</tr>
<?
		$color_rlt = mysql_query("SELECT type_name, type_color FROM cms_project_info WHERE seq='$pj_seq'", $connect); /// 타입별 컬러 구분
		$color_row = mysql_fetch_array($color_rlt);
		// 타입별 칼라 지정
		$type_name = explode("-", $color_row[type_name]);
		$type_color = explode("-", $color_row[type_color]);
		///////////////////////////////////////////////////////////////////////
		for($i=0; $i<count($type_name); $i++){
			$color[$type_name[$i]]=$type_color[$i];
		}
		$query1 = "SELECT * FROM cms_project_data $where $limit ";

		$result1 = mysql_query($query1, $connect);
		$data_num=mysql_num_rows($result1);
		$result1=mysql_query($query1, $connect);

		for($i=0; $rows1 = mysql_fetch_array($result1); $i++){
			if($rows1[is_except]==1) { // 기분양 세대인 경우
				$bgcolor=" background-color:#d1d1d1; ";
				$bg_col=" bgcolor='#D1D1D1' ";
			}else if($rows1[is_contract]==1) { // 계약상태 물건인 경우
				$bgcolor=" background-color:#ffdd77; ";
				$bg_col=" bgcolor='#ffdd77' ";
				$a=2;
			}else if($rows1[is_pro_cont]==1){ // 청약상태 물건인 경우
				$bgcolor=" background-color:#ffffb5; ";
				$bg_col=" bgcolor='#ffffb5' ";
			}else{ // 미계약 상태인 경우
				$bgcolor="";
				$bg_col="";
			}
			$w_where = explode("-", $rows1[worker_where]);
			if($rows[sa_sort]==0) $sa_sort = "조합"; else $sa_sort = "일반";

			$id_ad = explode(":", $rows1[cont_id_addr]);
			$dm_ad = explode(":", $rows1[cont_dm_addr]);

			$id_addr = $id_ad[0]."-".$id_ad[1]."&nbsp;&nbsp;&nbsp;".$id_ad[2]." ".$id_ad[3];
			$dm_addr = $dm_ad[0]."-".$dm_ad[1]."&nbsp;&nbsp;&nbsp;".$dm_ad[2]." ".$dm_ad[3];

			$charge = $rows1[charge_1]+$rows1[charge_2]+$rows1[charge_3]+$rows1[charge_4]; // 업무대행비 합계
			$deposit_1st = $rows1[deposit_1st_1]+$rows1[deposit_1st_2]+$rows1[deposit_1st_3]; // 1차 계약금 합계
			$deposit_2nd = $rows1[deposit_2nd_1]+$rows1[deposit_2nd_2]+$rows1[deposit_2nd_3]; // 2차 계약금 합계
			$deposit_3rd = $rows1[deposit_3rd_1]+$rows1[deposit_3rd_2]+$rows1[deposit_3rd_3]; // 3차 계약금 합계
			$deposit_4th = $rows1[deposit_4th_1]+$rows1[deposit_4th_2]+$rows1[deposit_4th_3];   // 4차 계약금 합계
			$m_pay_1st = $rows1[m_pay_1st_1]+$rows1[m_pay_1st_2]+$rows1[m_pay_1st_3];   // 1차 중도금 합계
			$m_pay_2nd = $rows1[m_pay_2nd_1]+$rows1[m_pay_2nd_2]+$rows1[m_pay_2nd_3];   // 2차 중도금 합계
			$m_pay_3rd = $rows1[m_pay_3rd_1]+$rows1[m_pay_3rd_2]+$rows1[m_pay_3rd_3];   // 3차 중도금 합계
			$m_pay_4th = $rows1[m_pay_4th_1]+$rows1[m_pay_4th_2]+$rows1[m_pay_4th_3];   // 4차 중도금 합계
			$m_pay_5th = $rows1[m_pay_5th_1]+$rows1[m_pay_5th_2]+$rows1[m_pay_5th_3];   // 5차 중도금 합계
			$m_pay_6th = $rows1[m_pay_6th_1]+$rows1[m_pay_6th_2]+$rows1[m_pay_6th_3];   // 6차 중도금 합계
			$m_pay_7th = $rows1[m_pay_7th_1]+$rows1[m_pay_7th_2]+$rows1[m_pay_7th_3];   // 7차 중도금 합계
			$last_pay = $rows1[last_pay_1]+$rows1[last_pay_2]+$rows1[last_pay_3]; // 잔금 합계
			$total_pay = $deposit_1st+$deposit_2nd+$deposit_3rd+$deposit_4th+$m_pay_1st+$m_pay_2nd+$m_pay_3rd+$m_pay_4th+$m_pay_5th+$m_pay_6th+$m_pay_7th+$last_pay; // 분담금 총 합계
?>
	<tr>
		<td align="center" height="24" bgcolor="<?=$color[$rows1[type_ho]]?>"><?=$rows1[con_no]?></td><!-- 계약관리번호 -->
		<td align="center" height="24" bgcolor="<?=$color[$rows1[type_ho]]?>"><?=$rows1[type_ho]?></td><!-- 타입 -->
		<td align="center" height="24" <?=$bg_col?>><?=$sa_sort?></td><!-- 조합/일반 구분 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[diff_no]."차"?></td><!-- 차수 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[pj_dong]>0) echo $rows1[pj_dong];?></td><!-- 동 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[pj_ho]>0) echo $rows1[pj_ho];?></td><!-- 호수 -->
		<td height="24" <?=$bg_col?>><?=$rows1[note]?></td><!-- 비 고(특이사항) -->

		<td align="right" height="24"><?=number_format($charge)?></td><!-- 업무대행비(합계) -->
		<td align="right" height="24"><?=number_format($total_pay)?></td><!-- 납부분담금(합계) -->

		<td align="center" height="24" <?=$bg_col?>><?if($rows1[is_pro_cont]==1) echo "청약";?></td><!-- 청약여부 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[pro_cont_date]>0) echo $rows1[pro_cont_date];?></td><!-- 청약(해지)일 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[pro_contractor]?></td><!-- 청약자 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[pro_cont_tel_1]?></td><!-- 연락처1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[pro_cont_tel_2]?></td><!-- 연락처2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[pro_deposit]>0) echo number_format($rows1[pro_deposit]);?></td><!-- 청약금 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[pro_due_date]>0) echo $rows1[pro_due_date];?></td><!-- 계약예정일 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[cancel]==1) echo "해지";?></td><!-- 해지여부 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[refund]==1) echo "환불";?></td><!-- 환불여부 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[is_contract]==1) echo "계약";?></td><!-- 계약여부 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[cont_date]>0) echo $rows1[cont_date];?></td><!-- 계약일 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[contractor]?></td><!-- 계약자 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[cont_tel_1]?></td><!-- 연락처1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[cont_tel_2]?></td><!-- 연락처2 -->

		<td height="24" <?=$bg_col?>><?if(strlen($rows1[cont_id_addr])<6) echo ""; else echo $id_addr;?></td><!-- 주민등록 주소 -->
		<td height="24" <?=$bg_col?>><?if(strlen($rows1[cont_dm_addr])<6) echo ""; else echo $dm_addr;?></td><!-- 우편발송 주소 -->

		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_1]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_1]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 9종 -->
		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_2]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_2]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 주등 -->
		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_3]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_3]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 주초 -->
		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_4]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_4]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 가증 -->
		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_5]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_5]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 인증 -->
		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_6]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_6]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 막도 -->
		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_7]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_7]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 신분 -->
		<td align="center" height="24" <?=$bg_col?> <?if($rows1[doc_8]==1) echo "style='color:red;'";?>><?if($rows1[is_contract]==1){if($rows1[doc_8]==0) {echo "완료";}else{echo "미비";}}?></td><!-- 배주 -->

		<td align="right" height="24" <?=$bg_col?>><?if($rows1[charge_1]>0) echo number_format($rows1[charge_1]);?></td><!-- 업무대행비1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[charge_1_date]>0) echo $rows1[charge_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[charge_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[charge_2]>0) echo number_format($rows1[charge_2]);?></td><!-- 업무대행비2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[charge_2_date]>0) echo $rows1[charge_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[charge_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[charge_3]>0) echo number_format($rows1[charge_3]);?></td><!-- 업무대행비3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[charge_3_date]>0) echo $rows1[charge_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[charge_3_who]?></td><!-- 입금자3 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[charge_4]>0) echo number_format($rows1[charge_4]);?></td><!-- 업무대행비4 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[charge_4_date]>0) echo $rows1[charge_4_date];?></td><!-- 입금일4 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[charge_4_who]?></td><!-- 입금자4 -->

		<td align="right" height="24"><?=number_format($deposit_1st)?></td><!-- 1차 계약금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_1st_1]>0) echo number_format($rows1[deposit_1st_1]);?></td><!-- 1차 계약금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_1st_1_date]>0) echo $rows1[deposit_1st_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_1st_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_1st_2]>0) echo number_format($rows1[deposit_1st_2]);?></td><!-- 1차 계약금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_1st_2_date]>0) echo $rows1[deposit_1st_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_1st_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_1st_3]>0) echo number_format($rows1[deposit_1st_3]);?></td><!-- 1차 계약금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_1st_3_date]>0) echo $rows1[deposit_1st_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_1st_3_who]?></td><!-- 입금자3 -->

		<td align="center" height="24" width="80" <?=$bg_col?>><?=$rows1[cont_mgm_who]?></td><!-- MGM to -->
		<td align="right" height="24" width="80" <?=$bg_col?>><?if($rows1[cont_mgm_sum]>0) echo number_format($rows1[cont_mgm_sum]);?></td><!-- MGM sum -->
		<td align="center" height="24" width="36" <?=$bg_col?>><?=$w_where[1]?></td><!-- 소속 -->
		<td align="center" height="24" width="50" <?=$bg_col?>><?=$rows1[cont_worker]?></td><!-- 담당자 -->

		<td align="right" height="24"><?=number_format($deposit_2nd)?></td><!-- 2차 계약금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_2nd_1]>0) echo number_format($rows1[deposit_2nd_1]);?></td><!-- 2차 계약금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_2nd_1_date]>0) echo $rows1[deposit_2nd_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_2nd_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_2nd_2]>0) echo number_format($rows1[deposit_2nd_2]);?></td><!-- 2차 계약금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_2nd_2_date]>0) echo $rows1[deposit_2nd_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_2nd_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_2nd_3]>0) echo number_format($rows1[deposit_2nd_3]);?></td><!-- 2차 계약금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_2nd_3_date]>0) echo $rows1[deposit_2nd_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_2nd_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($deposit_3rd)?></td><!-- 3차 계약금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_3rd_1]>0) echo number_format($rows1[deposit_3rd_1]);?></td><!-- 3차 계약금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_3rd_1_date]>0) echo $rows1[deposit_3rd_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_3rd_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_3rd_2]>0) echo number_format($rows1[deposit_3rd_2]);?></td><!-- 3차 계약금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_3rd_2_date]>0) echo $rows1[deposit_3rd_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_3rd_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_3rd_3]>0) echo number_format($rows1[deposit_3rd_3]);?></td><!-- 3차 계약금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_3rd_3_date]>0) echo $rows1[deposit_3rd_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_3rd_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($deposit_4th)?></td><!-- 4차 계약금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_4th_1]>0) echo number_format($rows1[deposit_4th_1]);?></td><!-- 4차 계약금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_4th_1_date]>0) echo $rows1[deposit_4th_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_4th_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_4th_2]>0) echo number_format($rows1[deposit_4th_2]);?></td><!-- 4차 계약금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_4th_2_date]>0) echo $rows1[deposit_4th_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_4th_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[deposit_4th_3]>0) echo number_format($rows1[deposit_4th_3]);?></td><!-- 4차 계약금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[deposit_4th_3_date]>0) echo $rows1[deposit_4th_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[deposit_4th_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($m_pay_1st)?></td><!-- 1차 중도금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_1st_1]>0) echo number_format($rows1[m_pay_1st_1]);?></td><!-- 1차 중도금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_1st_1_date]>0) echo $rows1[m_pay_1st_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_1st_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_1st_2]>0) echo number_format($rows1[m_pay_1st_2]);?></td><!-- 1차 중도금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_1st_2_date]>0) echo $rows1[m_pay_1st_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_1st_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_1st_3]>0) echo number_format($rows1[m_pay_1st_3]);?></td><!-- 1차 중도금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_1st_3_date]>0) echo $rows1[m_pay_1st_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_1st_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($m_pay_2nd)?></td><!-- 2차 중도금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_2nd_1]>0) echo number_format($rows1[m_pay_2nd_1]);?></td><!-- 2차 중도금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_2nd_1_date]>0) echo $rows1[m_pay_2nd_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_2nd_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_2nd_2]>0) echo number_format($rows1[m_pay_2nd_2]);?></td><!-- 2차 중도금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_2nd_2_date]>0) echo $rows1[m_pay_2nd_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_2nd_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_2nd_3]>0) echo number_format($rows1[m_pay_2nd_3]);?></td><!-- 2차 중도금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_2nd_3_date]>0) echo $rows1[m_pay_2nd_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_2nd_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($m_pay_3rd)?></td><!-- 3차 중도금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_3rd_1]>0) echo number_format($rows1[m_pay_3rd_1]);?></td><!-- 3차 중도금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_3rd_1_date]>0) echo $rows1[m_pay_3rd_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_3rd_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_3rd_2]>0) echo number_format($rows1[m_pay_3rd_2]);?></td><!-- 3차 중도금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_3rd_2_date]>0) echo $rows1[m_pay_3rd_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_3rd_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_3rd_3]>0) echo number_format($rows1[m_pay_3rd_3]);?></td><!-- 3차 중도금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_3rd_3_date]>0) echo $rows1[m_pay_3rd_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_3rd_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($m_pay_4th)?></td><!-- 4차 중도금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_4th_1]>0) echo number_format($rows1[m_pay_4th_1]);?></td><!-- 4차 중도금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_4th_1_date]>0) echo $rows1[m_pay_4th_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_4th_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_4th_2]>0) echo number_format($rows1[m_pay_4th_2]);?></td><!-- 4차 중도금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_4th_2_date]>0) echo $rows1[m_pay_4th_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_4th_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_4th_3]>0) echo number_format($rows1[m_pay_4th_3]);?></td><!-- 4차 중도금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_4th_3_date]>0) echo $rows1[m_pay_4th_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_4th_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($m_pay_5th)?></td><!-- 5차 중도금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_5th_1]>0) echo number_format($rows1[m_pay_5th_1]);?></td><!-- 5차 중도금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_5th_1_date]>0) echo $rows1[m_pay_5th_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_5th_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_5th_2]>0) echo number_format($rows1[m_pay_5th_2]);?></td><!-- 5차 중도금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_5th_2_date]>0) echo $rows1[m_pay_5th_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_5th_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_5th_3]>0) echo number_format($rows1[m_pay_5th_3]);?></td><!-- 5차 중도금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_5th_3_date]>0) echo $rows1[m_pay_5th_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_5th_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($m_pay_6th)?></td><!-- 6차 중도금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_6th_1]>0) echo number_format($rows1[m_pay_6th_1]);?></td><!-- 6차 중도금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_6th_1_date]>0) echo $rows1[m_pay_6th_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_6th_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_6th_2]>0) echo number_format($rows1[m_pay_6th_2]);?></td><!-- 6차 중도금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_6th_2_date]>0) echo $rows1[m_pay_6th_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_6th_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_6th_3]>0) echo number_format($rows1[m_pay_6th_3]);?></td><!-- 6차 중도금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_6th_3_date]>0) echo $rows1[m_pay_6th_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_6th_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($m_pay_7th)?></td><!-- 7차 중도금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_7th_1]>0) echo number_format($rows1[m_pay_7th_1]);?></td><!-- 7차 중도금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_7th_1_date]>0) echo $rows1[m_pay_7th_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_7th_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_7th_2]>0) echo number_format($rows1[m_pay_7th_2]);?></td><!-- 7차 중도금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_7th_2_date]>0) echo $rows1[m_pay_7th_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_7th_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[m_pay_7th_3]>0) echo number_format($rows1[m_pay_7th_3]);?></td><!-- 7차 중도금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[m_pay_7th_3_date]>0) echo $rows1[m_pay_7th_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[m_pay_7th_3_who]?></td><!-- 입금자3 -->

		<td align="right" height="24"><?=number_format($last_pay)?></td><!-- 잔금 합계 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[last_pay_1]>0) echo number_format($rows1[last_pay_1]);?></td><!-- 잔금1 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[last_pay_1_date]>0) echo $rows1[last_pay_1_date];?></td><!-- 입금일1 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[last_pay_1_who]?></td><!-- 입금자1 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[last_pay_2]>0) echo number_format($rows1[last_pay_2]);?></td><!-- 잔금2 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[last_pay_2_date]>0) echo $rows1[last_pay_2_date];?></td><!-- 입금일2 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[last_pay_2_who]?></td><!-- 입금자2 -->
		<td align="right" height="24" <?=$bg_col?>><?if($rows1[last_pay_3]>0) echo number_format($rows1[last_pay_3]);?></td><!-- 잔금3 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[last_pay_3_date]>0) echo $rows1[last_pay_3_date];?></td><!-- 입금일3 -->
		<td align="center" height="24" <?=$bg_col?>><?=$rows1[last_pay_3_who]?></td><!-- 입금자3 -->

		<td align="center" height="24" <?=$bg_col?>><?=$rows1[updater]?></td><!-- 등록자 -->
		<td align="center" height="24" <?=$bg_col?>><?if($rows1[updater]) echo substr($rows1[reg_time], 2, 14);?></td><!-- 등록일시 -->
	</tr>
<?
		}
		mysql_free_result($result1);
	} // 계약서별 관리일 때 종료
?>
</table>
