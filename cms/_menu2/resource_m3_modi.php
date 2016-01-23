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
	$edit_code = $_REQUEST['edit_code'];
	$pj = $_REQUEST['pj'];
	$headq = $_REQUEST['headq'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link type="text/css" rel="stylesheet" href="../common/cms.css">
	<style type="text/css">
		html { overflow:hidden; }
	</style>
	<script type="text/JavaScript" language="JavaScript" src="../common/global.js"></script>
	<script type="text/JavaScript" language="JavaScript" src="../common/capital.js"></script>
	<script type="text/javascript">
	<!--
		function _editChk(){
			var frm1 = document.pref;
			var form=document.form1;

			if(!frm1.headq.value){
				alert('본부 추가등록 후 소속본부를 선택하여 주세요!');
				frm1.headq.focus();
				return;
			}
			if(!form.team_seq.value){
				alert('팀 추가등록 후 소속팀을 선택하여 주세요!');
				form.team_seq.focus();
				return;
			}
			if(!form.posi.value){
				alert('해당 직위를 선택하여 주세요!');
				form.posi.focus();
				return;
			}
			if(confirm("해당 직원의 소속정보를 변경 등록 하시겠습니까?")==true) form.submit(); else return;
		}
	//-->
	</script>
</head>
<?
	$query="SELECT no, user_id, name, email, mobile, pj_seq, pj_where, pj_posi, pj_name FROM cms_member_table, cms_project_info WHERE no='$edit_code' ";
	$result=mysql_query($query, $connect);
	$row=mysql_fetch_array($result);
	$posi=explode("-", $row[pj_where]);
?>
<body style="background-color:white;">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b>현장 관계자 소속 관리</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">				
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					현장 관계자 소속 정보를 수정해 주십시요. (<font color="#ff0000">*</font>표시는 필수입력 정보)
				</div>
				<?
					if(!$pj) $pj=$row[pj_seq];
					if(!$headq) $headq=$posi[0];
				?>

				<form name="pref" method="post" action="">
					<div style="height:35px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">프로젝트명  <font color="#ff0000">*</font></div>
					<div style="float:left; padding-top:8px; text-align:left;">
						<select name="pj" style="height:20px; width:150px;" class="inputstyle2" onchange="submit();">							
							<?
								$h_qry = "SELECT seq, pj_name FROM cms_project_info WHERE is_end<>'1' ORDER BY seq ";
								$h_rlt = mysql_query($h_qry, $connect);
								while($h_rows = mysql_fetch_array($h_rlt)){
							?>
							<option value="<?=$h_rows[seq]?>" <?if($h_rows[seq]==$pj) echo "selected";?>><?=$h_rows[pj_name]?>
							<? } ?>
						</select>						
					</div>
				</div>			
				<div style="height:35px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">소속본부 <font color="#ff0000">*</font></div>
					<div style="float:left; padding-top:8px; text-align:left;"> 
						<select name="headq" style="height:20px; width:100px;" class="inputstyle2" onchange="submit();">
							<option value="" <?if(!$headq) echo "selected";?>> 선 택
							<?
								$h_qry = "SELECT seq, headq FROM cms_resource_headq WHERE pj_seq='$pj' ORDER BY headq ";
								$h_rlt = mysql_query($h_qry, $connect);
								while($h_rows = mysql_fetch_array($h_rlt)){
							?>
							<option value="<?=$h_rows[seq]?>" <?if($h_rows[seq]==$headq) echo "selected";?>><?=$h_rows[headq]?>
							<? } ?>
						</select>
						<a href='resc_basic.php?pj=<?=$pj?>&sort=headq_list' class='no_auth'>본부 추가등록</a>
					</div>
				</div>
				</form>

				<form name="form1" action="resource_m3_post.php" method="post">
				<input type="hidden" name="seq_num" value="<?=$edit_code?>">
				<input type="hidden" name="pj_seq" value="<?=$pj?>">
				<input type="hidden" name="headq_seq" value="<?=$headq?>">
				<div style="height:35px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">소속 팀 <?=$rows[pj_seq]?><font color="#ff0000">*</font></div>
					<div style="float:left; padding-top:8px; text-align:left;">
						<select name="team_seq" style="height:20px; width:100px;" class="inputstyle2">
							<option value="" selected> 선 택
							<?
								$t_qry = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj' AND headq_seq='$headq'  ORDER BY team ";
								$t_rlt = mysql_query($t_qry, $connect);
								while($t_rows = mysql_fetch_array($t_rlt)){
							?>
							<option value="<?=$t_rows[seq]?>" <?if($t_rows[seq]==$posi[1]) echo "selected";?>><?=$t_rows[team]?>
							<? } ?>
						</select>
						<a href='resc_basic.php?pj=<?=$pj?>&sort=team_list' class='no_auth'>팀 추가등록</a>
					</div>
				</div>
				<div style="height:35px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						직 위 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:8px; text-align:left;">
						<select name="posi" style="height:20px; width:100px;" class="inputstyle2">
							<option value="" selected> 선 택
							<option value="1" <?if($row[pj_posi]=='1') echo 'selected';?>> 본부장
							<option value="2" <?if($row[pj_posi]=='2') echo 'selected';?>> 팀장
							<option value="3" <?if($row[pj_posi]=='3') echo 'selected';?>> 팀원
						</select>
					</div>
				</div>
				<div style="height:35px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">아 이 디</div>
					<div style="float:left; padding-top:8px; text-align:left;"><?=$row[user_id]?></div>
				</div>
				<div style="height:35px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">성 명</div>
					<div style="float:left; padding-top:8px; text-align:left;"><?=$row[name]?></div>
				</div>
				<div style="height:35px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">핸드폰</div>
					<div style="float:left; padding-top:8px; text-align:left;"><?=$row[mobile]?></div>
				</div>
				</form>
				<div style="height:48px; text-align:center; padding-top:15px;">
					<input type="button" value=" 수정하기 " onclick="_editChk()" style="height:20px;" class="inputstyle_bt">
					<input type="button" value=" 닫 기 " onclick="self.close(); opener.location.reload();" style="height:20px;" class="inputstyle_bt">
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>