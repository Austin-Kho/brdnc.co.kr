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
	$mode=$_REQUEST['mode'];
	$edit_code=$_REQUEST['edit_code'];
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
	function _subchk(msg){
		var form = document.form1;
		/*
		if(!form.sort.value){
			alert('용도구분을 선택하세요!');
			form.sort.focus();
			return;
		}
		*/
		if(!form.bank_code.value){
			alert('거래은행을 선택하세요!');
			form.bs.focus();
			return;
		}
		if(!form.name.value){
			alert('계좌명(별칭)을 입력하세요!');
			form.name.focus();
			return;
		}
		if(!form.number.value){
			alert('계좌번호를 입력하세요!');
			form.number.focus();
			return;
		}
		if(!form.holder.value){
			alert('예금주를 입력하세요!');
			form.holder.focus();
			return;
		}
		if(!form.open_date.value){
			alert('계좌 개설일을 입력하세요!');
			form.open_date.focus();
			return;
		}
		var all_msg = '은행계좌 정보를 '+msg+' 하시겠습니까?';
		var a = confirm(all_msg)
		if(a==true){
			form.submit();
		} else {
			return;
		}
	}	
	//-->
	</script>
</head>
<?
	if($mode=='reg'){
		$title = '은행계좌(BANK ACCOUNT) 정보등록';
		$info = "등록할 은행계좌 정보를 입력해 주십시요. (<font color='#ff0000'>*</font>표시는 필수입력 정보)";
		$bt_str = "등록하기";
		$alert_msg="등록";
	}else if($mode=='edit'){
		$title = '은행계좌(BANK ACCOUNT) 정보수정';
		$info = "변경할 은행계좌 정보를 수정해 주십시요. (<font color='#ff0000'>*</font>표시는 필수입력 정보)";
		$bt_str = "수정하기";
		$alert_msg="수정";
	}
?>
<body style="background-color:white;" onclick="cal_del();">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b><?=$title?></b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;"><?=$info?></div>
				<?
					if($mode=='edit'){
						$query="SELECT * FROM cms_capital_bank_account WHERE no='$edit_code'";
						$result=mysql_query($query, $connect);
						$rows=mysql_fetch_array($result);
					}
				?>
				<form name="form1" action="bank_acc_post.php" method="post">
				<input type="hidden" name="mode" value="<?=$mode?>">
				<?
					if($mode=='edit'){
				?>
				<input type="hidden" name="no" value="<?=$edit_code?>">
				<? } ?>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">					
					<div style="float:left; padding:7px 15px 0 0; text-align:right; width:100px;">
						용도구분 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<select name="sort" style="width:130px; height:20px;" class="inputstyle2">
							<option value="" <?if($rows[is_com]<>1&&$rows[pj_seq]==0) echo "selected";?>> 선 택
							<option value="com" <?if($rows[is_com]==1) echo "selected"?>> 본 사
							<?
								$pj_qry = "SELECT seq, pj_name FROM cms_project_info WHERE is_end='0' ORDER BY seq ";
								$pj_rlt = mysql_query($pj_qry, $connect);
								while($pj_rows = mysql_fetch_array($pj_rlt)){
							?>
							<option value="<?=$pj_rows[seq]?>" <?if($pj_rows[seq]==$rows[pj_seq]) echo "selected";?>> <?=$pj_rows[pj_name]?>
							<? } ?>
						</select>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">					
					<div style="float:left; padding:7px 15px 0 0; text-align:right; width:100px;">
						거래은행 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<select name="bs" style="width:130px; height:20px;" class="inputstyle2" onchange="this.form.bank_code.value=this.value;">
							<option value="" <?if(!$rows[bank_code]) echo "selected";?>> 전 체
							<?
								$bank_qry = "SELECT* FROM cms_capital_bank_code ORDER BY bank_code ";
								$bank_rlt = mysql_query($bank_qry, $connect);
								while($bank_rows = mysql_fetch_array($bank_rlt)){
							?>
							<option value="<?=$bank_rows[bank_code]?>" <?if($mode=='edit'&&($rows[bank_code]==$bank_rows[bank_code])) echo "selected";?>> <?=$bank_rows[bank_name]?>
							<? } ?>
						</select>
					</div>
					<div style="float:left; padding:6px 0 0 5px; text-align:left;">
						<input type="text" name="bank_code" value="<?if($mode=='edit') echo $rows[bank_code]?>" size="6" class="inputstyle2" style="height:17px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" readonly>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:7px 15px 0 0; text-align:right; width:100px;">
						계좌명(별칭) <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<input type="text" name="name" value="<?if($mode=='edit') echo $rows[name]?>" size="30" class="inputstyle2" style="height:17px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:7px 15px 0 0; text-align:right; width:100px;">
						계좌번호 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<input type="text" name="number" value="<?if($mode=='edit') echo $rows[number]?>" size="30" class="inputstyle2" style="height:17px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:7px 15px 0 0; text-align:right; width:100px;">
						예금주 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<input type="text" name="holder" value="<?if($mode=='edit') echo $rows[holder]?>" size="30" class="inputstyle2" style="height:17px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:7px 15px 0 0; text-align:right; width:100px;">
						개설일 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<input type="text" name="open_date" id="open_date" value="<?if($mode=='edit') echo $rows[open_date]?>" size="30" class="inputstyle2" style="height:17px;" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
						<a href="javascript:" onclick="cal_add(document.getElementById('open_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid; padding-bottom:10px;">
					<div style="float:left; padding:7px 15px 0 0; text-align:right; width:100px;">
						비 고
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<input type="text" name="note" value="<?if($mode=='edit') echo $rows[note]?>" size="30" class="inputstyle2" style="height:17px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					</div>
				</div>
				<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
				</form>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" <?=$bt_str?> " onclick="_subchk('<?=$alert_msg?>')" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 목록으로 " onclick="history.go(-1);" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
