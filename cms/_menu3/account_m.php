<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸리티 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	// 이름과 아이디에 해당하는 세션이 있는지 확인
	if(!isset($_SESSION[p_id])||!isset($_SESSION[p_name])){
		err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
	}
	$pj=$_REQUEST['pj'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link type="text/css" rel="stylesheet" href="../common/cms.css">
	<link type="text/css" rel="stylesheet" href="../common/cms.css">
	<script type="text/JavaScript" language="JavaScript" src="../common/global.js"></script>
	<script type="text/javascript">
	<!--
		function acc_d1_sub(){
			var form = document.form1;
			form.acc_d2.value = "";
			form.submit();
		}
	//-->
	</script>
</head>
<?
	$acc_d1 = $_REQUEST['acc_d1'];
	$acc_d2 = $_REQUEST['acc_d2'];
	$is_sp = $_REQUEST['is_sp'];
?>
<body style="background-color:white;">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
	<table border="0" cellspacing="0" cellpadding="0" style="height:96%; margin:0 auto; width:98%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5; margin-bottom:8px;">
	<tr>
		<td valign="top">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b> 회계 계정과목(ACCOUNT) 관리</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#f4f4f4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					검색할 계정과목 명칭을 선택하여 주십시요.
				</div>
				<form name="form1" action="<?=$_SERVER['PHP_SELF']?>">
				<div style="float:left; height:28px; text-align:center; padding:7px 0 0 10px; ;">
					수익비용 :
					<select name="acc_d1" class="inputstyle2" style="width:80px; height:22px;" onChange = "acc_d1_sub();">
						<option value="" <?if(!$acc_d1) echo "selected";?>> 전 체
						<option value="1" <?if($acc_d1=='1') echo " selected";?>> 수 익
						<option value="2" <?if($acc_d1=='2') echo "selected";?>> 비 용
					</select>
				</div>
				<div style="float:left; height:28px; text-align:center; padding:7px 0 0 10px;">
					중분류 계정과목 :
					<select name="acc_d2" class="inputstyle2" style="width:150px; height:22px;" onChange = "submit();">
					<?
						// d2 계정 분류
						$acc_d2_wr = " WHERE 1=1 ";
						if($acc_d1) $acc_d2_wr .= " AND d1_seq = '$acc_d1' ";
						$acc_d2_qry = "SELECT * FROM cms_capital_account_d2 $acc_d2_wr ";
						$acc_d2_rlt = mysql_query($acc_d2_qry, $connect);
					?>
						<option value="" <?if(!$acc_d2) echo "selected";?>> 전 체
						<?
							while($acc_d2_rows = mysql_fetch_array($acc_d2_rlt)){
						?>
						<option value="<?=$acc_d2_rows[seq]?>" <?if($acc_d2_rows[seq]==$acc_d2) echo "selected";?>> <?=$acc_d2_rows[d2_acc_name]?>
						<?}?>
					</select>
				</div>
				<div style="float:left; height:28px; text-align:center; padding:7px 0 0 10px;"> 희귀 계정과목 표시 <input type="checkbox" name="is_sp" value="1" <?if($is_sp) echo "checked";?> onClick="submit();"></div>
				<?	if(!$acc_d1||$acc_d1==1){ // 수익계정 표시 시작 ?>
				<div style="clear:left; height:30px; background-color:#e0e3e9; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding:6px 0 0 10px;"><strong>수익 계정</strong></div>
				</div>
				<?
						$qry = " SELECT seq, d1_seq, d2_acc_name FROM cms_capital_account_d2  WHERE d1_seq='1' ";
						$rlt = mysql_query($qry, $connect);
						while($rows = mysql_fetch_array($rlt)){ // d2 계정 나열 시작
							if(!$acc_d2||$acc_d2==$rows[seq]){ // d2 계정 필터 시작
				?>
				<div style="clear:left; height:30px; background-color:#f9faf5; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding:6px 0 0 20px;"><?=$rows[d2_acc_name]?></div>
				</div>
				<?
								$add_w = " WHERE d2_seq = '$rows[seq]' ";
								if($is_sp==0) $add_w .= " AND is_sp_acc='0' "; else $add_w .= "";
								$d3_qry = " SELECT * FROM cms_capital_account_d3 $add_w ";
								$d3_rlt = mysql_query($d3_qry, $connect);
								while($d3_rows = mysql_fetch_array($d3_rlt)){ // d3 계정 나열 시작
				?>
				<div style="height:30px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:6px 0 0 30px; <?if($d3_rows[is_sp_acc]==0)echo "color:#003366;"; else echo "color:#a8a8a8;";?> width:120px; cursor:pointer;"  title="<?=$d3_rows[note]?>"><?=$d3_rows[d3_acc_name]?></div>
					<div style="float:left; padding:6px 0 0 15px; color:#737373; cursor:pointer;" title="<?=$d3_rows[note]?>"><?=rg_cut_string($d3_rows[note],40,"...")?></div>
				</div>
				<?
								} // d3 계정 나열 종료
							}// d2 계정 필터 종료
						}//d2 계정 나열 종료
					} // 수익 계정 표시 종료
				?>
				<?if(!$acc_d1||$acc_d1==2){ // 비용계정 표시 시작?>
				<div style="clear:left; height:30px; background-color:#e1e4ea; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding:6px 0 0 10px;"><strong>비용 계정</strong></div>
				</div>
				<?
						$qry = " SELECT seq, d1_seq, d2_acc_name FROM cms_capital_account_d2 WHERE d1_seq='2' ";
						$rlt = mysql_query($qry, $connect);
						while($rows = mysql_fetch_array($rlt)){ // d2 계정 나열 시작
							if(!$acc_d2||$acc_d2==$rows[seq]){ // d2 계정 필터 시작
				?>
				<div style="clear:left; height:30px; background-color:#f9faf5; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding:6px 0 0 20px;"><?=$rows[d2_acc_name]?></div>
				</div>
				<?
								$add_w = " WHERE d2_seq = '$rows[seq]' ";
								if($is_sp==0) $add_w .= " AND is_sp_acc='0' "; else $add_w .= "";
								$d3_qry = " SELECT * FROM cms_capital_account_d3 $add_w ";
								$d3_rlt = mysql_query($d3_qry, $connect);
								while($d3_rows = mysql_fetch_array($d3_rlt)){ // d3 계정 나열 시작
				?>
				<div style="height:30px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:6px 0 0 30px; <?if($d3_rows[is_sp_acc]==0)echo "color:#003366;"; else echo "color:#a8a8a8;";?> width:120px; cursor:pointer;"  title="<?=$d3_rows[note]?>"><?=$d3_rows[d3_acc_name]?></div>
					<div style="float:left; padding:6px 0 0 15px; color:#737373; cursor:pointer;" title="<?=$d3_rows[note]?>"><?=rg_cut_string($d3_rows[note],40,"...")?></div>
				</div>
				<?
								} // d3 계정 나열 종료
							} // d2 계정 필터 종료
						}//d2 계정 나열 종료
					} // 비용 계정 표시 종료
				?>

				</form>
			</div>
		</td>
	</tr>
	</table>
	</div>
</div>
</body>
</html>