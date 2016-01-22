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

	$r_id = $_GET['r_id'];
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
	<script type="text/JavaScript" language="JavaScript" src="../common/member.js"></script>
	<script language="JavaScript" type="text/JavaScript">
		<!--
			function send_chk(){
				var form=document.form1;

				if(!form.receive_id.value){
					alert('받는 사람을 선택하세요!');
					form.receive_id.focus();
					return;
				}

				if(!form.msg.value){
					alert('보낼 내용을 입력하세요!');
					form.msg.focus();
					return;
				}
				form.submit();
			}
		//-->
	</script>
</head>
<body style="background-color:white;">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b>쪽지 쓰기</b></font>
			</div>
			<div style="text-align:right; padding:15px 20px 6px 0;">
				<a href="message_1.php"> 받은쪽지함 </a> |
				<a href="message_2.php"> 보낸쪽지함 </a> |
				<b> <font color="#0066cc">쪽지쓰기</font> </b>
			</div>
			<div style="padding:0 10px 0 10px;">
				<form method="post" name="form1" action="message_send_post.php">
				<input type="hidden" name="gb">
				<div style="height:45px; background-color:#EAEAEA; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:8px; text-align:center; width:70px;">받는사람</div>
					<div style="float:left; padding-top:8px; text-align:center; width:130px;">
						<select name="receive_id" style="width:120 ">
							<option value="" selected> 선 택
							<?
								$query = "select * from cms_member_table order by no";
								$result = mysql_query($query, $connect);
								while($rows = mysql_fetch_array($result)){
							?>
							<option value="<?=$rows[user_id]?>" <?if($rows[user_id]==$r_id) echo "selected"?>> <?=$rows[name]?>
							<? } ?>
						</select>
					</div>
				</div>
				<div style="height:200px;">
					<div style="height:150px; width:40px; float:left; text-align:center; padding-top:70px;">
						내 용
					</div>
					<div style="height:200px; float:left; padding:5px 5px 5px 5px;">
						<textarea name="msg" class="inputstyle2" style="width:310px; height:180px; overflow-y:scroll;"></textarea>
					</div>
				</div>
				<div style="height:45px; background-color:#EAEAEA; text-align:center; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<!-- <a href="javascript:send_chk()"><img src="../img/bt_ok2.gif" border="0"></a> -->
					<input type="button" value="보내기" onclick="send_chk()" class="inputstyle_bt" style="height:20px;">
					<!-- <a href="javascript:history.go(-1)"><img src="../img/bt_list2.gif" border="0"></a> -->
					<input type="button" value="취 소" onclick="history.go(-1)" class="inputstyle_bt" style="height:20px;">
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
