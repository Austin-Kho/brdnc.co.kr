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
	$pj_seq=$_REQUEST['pj_seq'];
	$headq_seq=$_REQUEST['headq_seq'];
	$team_seq=$_REQUEST['team_seq'];
	$edit_code = $_REQUEST['edit_code'];
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
	<script type="text/JavaScript" language="JavaScript" src="../include/calendar/calendar.js"></script>
	<script type="text/javascript">
	<!--
		function mem_modi(){
			var form = document.form1;
			if(!form.headq.value){
				alert('소속 본부를 선택하여 주십시요!');
				frm.headq.focus();
				return;
			}
			if(!form.name.value){
				alert('이름을 입력하여 주십시요!');
				form.name.focus();
				return;
			}
			if(form.name.value){
				if(!form.position.value){
					alert('해당 직원의 직위를 선택하여 주십시요!');
					form.position.focus();
					return;
				}
				if(form.position.value!=1&&!form.team.value){
					alert('소속 팀을 선택하여 주십시요!');
					form.team.focus();
					return;
				}
				if(!form.tel1.value){
					alert('연락처를 입력하여 주십시요!');
					form.tel1.focus();
					return;
				}
				if(!form.tel2.value){
					alert('연락처를 입력하여 주십시요!');
					form.tel2.focus();
					return;
				}
				if(!form.tel3.value){
					alert('연락처를 입력하여 주십시요!');
					form.tel3.focus();
					return;
				}
			}
			if(confirm('현장 인원 정보를 등록하시겠습니까?')==true){
				form.submit();
			}else{
				return;
			}
		}
		function close_(){
			opener.location.reload();
			self.close();
		}
	//-->
	</script>
</head>
<body style="background-color:white;">
<!-- ======================== 수정 start======================== -->
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b> 현장 인원정보 건별 수정</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					변경할 현장 인원정보를 수정해 주십시요! (<font color="red">*</font> 표시는 필수입력 정보)
				</div>
				<form name="form1" action="resource_post.php">
				<input type="hidden" name="mode" value="mem_modify">
				<input type="hidden" name="pj_seq" value="<?=$pj_seq?>">
				<input type="hidden" name="edit_code" value="<?=$edit_code?>">
				<?
					$query = "SELECT headq_seq, team_seq, position, name, id_num, tel, bank_acc, bank_acc_num, bank_acc_holder, join_date,
										  pj_name
										  FROM cms_resource_team_member, cms_project1_info
										  WHERE cms_resource_team_member.seq='$edit_code' AND pj_seq=cms_project1_info.seq ";
					$result = mysql_query($query, $connect);
					$row = mysql_fetch_array($result);
					$id_num = explode("-",$row[id_num]);
					$tel = explode("-", $row[tel]);
				?>
				<div style="height:259px; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea;">현장명 : </div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;"><?=$row[pj_name]?></div>
					<div style="clear:left; float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea;">본부명 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<select name="headq" class="inputstyle2" style="height:20px; width:100px;">
							<option value="" <?if(!$row[headq_seq]) echo "selected"; ?>> 선 택
							<?
								$qry = "SELECT seq, headq FROM cms_resource_headq WHERE pj_seq='$pj_seq' GROUP BY headq ORDER BY headq";
								$rlt = mysql_query($qry, $connect);
								while($rows = mysql_fetch_array($rlt)){
							?>
							<option value="<?=$rows[seq]?>" <?if($rows[seq]==$row[headq_seq]) echo "selected"; ?>> <?=$rows[headq]?>
							<? } ?>
						</select>
					</div>
					<div style="clear:left; float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea">팀 명 / 직 위 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<select name="team" class="inputstyle2" style="height:20px; width:100px;">
							<option value="" <?if(!$row[team_seq]) echo "selected"; ?>> 선 택
							<?
								$qry1 = "SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_seq' AND headq_seq='$headq_seq' GROUP BY team ORDER BY team";
								$rlt1 = mysql_query($qry1, $connect);
								while($rows1 = mysql_fetch_array($rlt1)){
							?>
							<option value="<?=$rows1[seq]?>" <?if($rows1[seq]==$row[team_seq]) echo "selected"; ?>> <?=$rows1[team]?>
							<? } ?>
						</select>
						<select name="position" class="inputstyle2" style="height:20px; width:100px;">
							<option value="" <?if(!$row[position]) echo "selected";?>> 선 택
							<option value="1" <?if($row[position]==1) echo "selected"; ?>> 본부장
							<option value="2" <?if($row[position]==2) echo "selected"; ?>> 팀 장
							<option value="3" <?if($row[position]==3) echo "selected"; ?>> 팀 원
						</select>
					</div>
					<div style="float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea;">성 명 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<input type="text" name="name" value="<?=$row[name]?>" class="inputstyle2" style="width:140px; height:16px;">
					</div>
					<div style="clear:left; float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea">주민등록번호 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<input type="text" name="id_num1" value="<?=$id_num[0]?>" class="inputstyle2" style="width:55px; height:16px;"> -
						<input type="text" name="id_num2" value="<?=$id_num[1]?>" class="inputstyle2" style="width:70px; height:16px;">
					</div>
					<div style="clear:left; float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea;">연락처 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<input type="text" name="tel1" value="<?=$tel[0]?>" class="inputstyle2" style="width:30px; height:16px;"> -
						<input type="text" name="tel2" value="<?=$tel[1]?>" class="inputstyle2" style="width:40px; height:16px;"> -
						<input type="text" name="tel3" value="<?=$tel[2]?>" class="inputstyle2" style="width:40px; height:16px;">
					</div>
					<div style="float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea;">은 행 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<select name="bank_acc" class="inputstyle2" style="height:20px; width:145px;">
							<option value="" <?if(!$row[bank_acc]) echo "selected"; ?>> 선 택
							<?
								$qry = "SELECT bank_name FROM cms_capital_bank_code ORDER BY bank_code";
								$rlt = mysql_query($qry, $connect);
								while($rows = mysql_fetch_array($rlt)){
							?>
							<option value="<?=$rows[bank_name]?>" <?if($rows[bank_name]==$row[bank_acc]) echo "selected"; ?>> <?=$rows[bank_name]?>
							<? } ?>
						</select>
					</div>
					<div style="clear:left; float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea">계좌번호 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<input type="text" name="bank_acc_num" value="<?=$row[bank_acc_num]?>" class="inputstyle2" style="width:140px; height:16px;">
					</div>
					<div style="clear:left; float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea">예금주 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:200px;">
						<input type="text" name="bank_acc_holder" value="<?=$row[bank_acc_holder]?>" class="inputstyle2" style="width:140px; height:16px;">
					</div>
					<div style="clear:left; float:left; height:23px; padding:2px 10px 0 0; text-align:right; width:90px; background-color:#eaeaea;">근무 시작일 :</div>
					<div style="float:left; height:23px; padding:2px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;">
						<input type="text" name="join_date" id="j_date" value="<?=$row[join_date]?>" class="inputstyle2" style="width:120px; height:16px;" onclick="openCalendar(this)">
						<a href="javascript:" onclick="openCalendar(document.getElementById('j_date'));"><img src="../images/calendar.jpg" border="0" alt="" /></a>
					</div>
				</div>
				<div style="height:50px; text-align:center; padding-top:10px;">
					<input type="button" value=" 저장하기" onclick="mem_modi();" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 닫 기 " onclick="close_();" class="inputstyle_bt" style="height:20px;">
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- ======================== 수정 end======================== -->
</body>
</html>
