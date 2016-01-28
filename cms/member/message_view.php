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
	<script type="text/javascript">
	<!--
		function del(a,b){
			var cf= confirm('삭제하시겠습니까?')
			if(cf==true) {
					location.href="message_del.php?mode=view&gb="+a+"&mnum="+b;
			 }
		}
	//-->
	</script>

</head>

<body style="background-color:white;" OnUnload="opener.location.reload();">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b>받은 쪽지함</b></font>
			</div>
			<div style="text-align:right; padding:15px 20px 6px 0;">
				<a href="message_1.php"> 받은쪽지함 </a> |
				<a href="message_2.php"> 보낸쪽지함 </a> |
				<a href="message_3.php"> 쪽지쓰기 </a>
			</div>
			<div style="padding:0 10px 0 10px;">
				<form method="post" name="form1" action="message_del.php">
				<input type="hidden" name="gb">
				<div style="height:28px; background-color:#EAEAEA; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					메 세 지
				</div>
				<?
					$mnum=$_REQUEST['mnum'];

					$query2="select * from cms_message_info where mnum='$mnum' ";
					$result2=mysql_query($query2, $connect);
					$rows2=mysql_fetch_array($result2);


					// 받은 편지함 & 수신 전
					$gb=$_GET['gb'];

					if($gb=='1'&&($rows2[receive_chk]=='N')){
						$query1="update cms_message_info set receive_chk='Y', receive_reg=now() where mnum='$mnum' ";
						$result1=mysql_query($query1, $connect);
					}
				?>
				<div style="height:200px; border-width:0 0 1px 0; border-style:solid; border-color:#cfcfcf;">
					<div style="height:160px; background-color:#feffee; margin:5px 5px 0 5px; padding:5px 5px 5px 5px; border:1px solid #eeeeee;">
						<?=nl2br(stripslashes($rows2[message]))?><!--목록 화면출력과 달리 저장된 모든 내용을 화면에 출력//-->
					</div>
					<div style="float:left; padding:5px 5px 5px 5px; text-align:center;">
						보낸 시간
					</div>
					<div style="float:right; padding:5px 5px 5px 5px; text-align:center;">
						<?=$rows2[send_reg]?>
					</div>
				</div>
				<div style="float:left; padding-top:10px;">
					<input type="button" value="  삭 제 " onclick="del(<?=$gb?>,<?=$mnum?>);" class="inputstyle_bt" style="height:20px;">
				</div>
				<div style="float:right; padding-top:10px;">
					<input type="button" value=" 확 인 " onclick="javascript:history.go(-1)" class="inputstyle_bt" style="height:20px;">
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
