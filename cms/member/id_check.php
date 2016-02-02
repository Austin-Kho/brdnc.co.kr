<?
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
<!DOCTYPE HTML>
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link type="text/css" rel="stylesheet" href="../common/cms.css">
	<style type="text/css">
		html { overflow:hidden; }
	</style>
	<script type="text/JavaScript" language="JavaScript" src="../common/global.js"></script>
	<script type="text/JavaScript" language="JavaScript">
	<!--
		function send(){
			var obj=document.id_check;
			var str=obj.user_id.value;

			if(!obj.user_id.value){
				alert('아이디를 입력하세요.');
				obj.user_id.focus();
				return;
			}
			if(str.length<4){
				 alert('아이디는 띄어쓰기 없이 4~10자 \n영문/숫자를 혼합하여 입력하십시요.');
				 obj.user_id.focus();
				 return;
			}
			obj.submit();
		}

			function form_send(s_id){
				opener.document.form1.user_id.value=s_id;
				opener.document.form1.passwd.focus();
				self.close();
			}
	-->
	</script>
</head>
<body style="background-color:white;">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:96%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:38px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:24px;">
				<font color="#4C63BD" style="font-size:11pt"><b>ID 중복확인</b></font>
			</div>
			<?
				$user_id=$_REQUEST['user_id'];

				$query="select user_id from cms_member_table where user_id='$user_id'";
				$result=mysql_query($query, $connect);
				$total_num=mysql_num_rows($result);
				if($total_num){
			?>
			<form method="post" name="id_check" action="<?=$PHP_SELF?>">



			<div style="padding:0 10px 0 10px;">
				<input type="hidden" name="gb">
				<div style="height:27px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:8px; margin-top:8px;">
					입력하신 아이디 <font color="#cc3300"><b><?=$user_id?></b></font> 는 이미 사용 중입니다.
				</div>

				<div style="height:34px; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; margin-top:10px;">
					<div style="float:left; height:28px; padding-top:6px; width: 100px; background-color:#F8F8F8; text-align:center;">
						신청 아이디
					</div>
					<div style="float:left; height:28px; width:130px; padding-top:7px; text-align:center;">
						<input type="text" name="user_id" style="ime-mode:disabled;" size="18" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					</div>
					<div style="float:left; height:28px; width:50px; padding-top:6px; text-align:center;">
						<input type="button" value="ID CHECK" onclick="send()"><!-- <input type="image" src="../images/id_chk.jpg"> -->
					</div>
				</div>
			<div style="padding-top:15px;">
				<b>아이디는 4 - 12자 영문 / 숫자를 사용하여 입력하십시요.</b>
			</div>
			</div>
			</form>
			<?
				} else {
			?>
			<form method="post" name="id_check" action="<?=$PHP_SELF?>">



			<div style="padding:0 10px 0 10px;">
				<input type="hidden" name="gb">
				<div style="height:27px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:8px; margin-top:8px;">
					입력하신 아이디 <font color="#6073D1"><b><?=$user_id?></b></font> 는 사용가능합니다. <input type="button" value="사용" onclick="form_send('<?=$user_id?>')"><!-- <a href="javascript:form_send('<?=$user_id?>')"><img src="../img/id_put.jpg" border="0"></a> -->
				</div>

				<div style="height:34px; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; margin-top:10px;">
					<div style="float:left; height:28px; padding-top:6px; width: 100px; background-color:#F8F8F8; text-align:center;">
						신청 아이디
					</div>
					<div style="float:left; height:28px; width:130px; padding-top:7px; text-align:center;">
						<input type="text" name="user_id" style="ime-mode:disabled;" size="18" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					</div>
					<div style="float:left; height:28px; width:50px; padding-top:6px; text-align:center;">
						<input type="button" value="ID CHECK" onclick="send()"><!-- <img src="../img/id_chk.jpg" border="0" onclick="javascript:send()"> -->
					</div>
				</div>
			<div style="padding-top:15px; text-align:center;">
				<b>아이디는 4 - 12자 영문 / 숫자를 사용하여 입력하십시요.</b>
			</div>
			</div>
			</form>
			<?
				}
			?>
		</div>
	</div>
</div>
</body>
</html>
