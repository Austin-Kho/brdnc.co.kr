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
	 	img,input {vertical-align:middle;}
	 	.on_1 {font-size:8pt; color:#7A7A7A; border:#8eb4d9 1px solid; width:170px;height:22px; padding:1px 0 0 5px;}
	 	.on_2 {font-size:8pt; color:#6073D1; border: #8eb4d9 1px solid; width:170px;height:22px; padding:1px 0 0 5px;}
	 	.off_1 {font-size:8pt; color:#6073D1; border: #D2D2D2 1px solid; width:170px;height:22px; padding:1px 0 0 5px;}
	 	.off_2 {font-size:8pt; color:#7A7A7A; border: #D2D2D2 1px solid; width:170px;height:22px; padding:1px 0 0 5px;}
	 </style>
	 <script type="text/javascript" src="../common/global.js"></script>
 </head>
 <body>
	 <form name="login" method="post" action="login_process.php" onsubmit="JavaScript:return(login_check());">
	 <div style="width:600px; height:100%; margin:0px auto;"><!-- wrap div -->
		<div style="height:150px;"></div>

			<div style="width:600px; height:420px; border:2px solid #96ABE5; background-color:white;"><!-- box div -->
				<div style="width:580px; height:60px; border-bottom:2px solid #96ABE5; background-color:#D9EAF8; padding:20px 0 0 20px;"><!-- 로고 제목 div -->
					<img src="../images/cms_box_logo.png" alt="">
				</div>
			<div style="height:80px; padding:30px 0 0 50px;">
				<div style="width:185px; float:left;"><!-- 로그인 폼 -->
					<div style="height:30px;">
						<input type="text" name="user_id" value="<? if($_COOKIE[id_rem]) echo $_COOKIE[p_id]; ?>" style="ime-mode:disabled;" size="26" maxlength="12" class="<? if($_COOKIE[id_rem]){ echo "off_2"; } else { echo "off_1"; }?>" onfocus="this.className='on_1';" onBlur="this.className='off_2';">
					</div>
					<div style="height:30px; padding-top:0px;">
						<input type="password" name="pwd" style="ime-mode:disabled;" size="26" maxlength="15" class="off_1"  onfocus="this.className='on_1';" onBlur="this.className='off_2';">
					</div>
				</div>
				<div style="width:60px; float:left;"> <!-- 로그인 버튼 -->
					<input type="image" src="../images/login_bt.jpg">
				</div>
				<div style="width:100px; float:left;">
					<div style="height:28px;">
						<a href="member_join.php"><!-- <img src="../img/join_bt.jpg" border="0"> -->회원가입</a>
					</div>
					<div style="height:28px;">
						<a href="#"><!-- <img src="../img/find_id.jpg" border="0"> -->ID찾기</a>
					</div>
				</div>
				<div style="width:100px; float:left;">
					<div style="height:28px;">

					</div>
					<div style="height:28px;">
						<a href="#"><!-- <img src="../img/find_pw.jpg" border="0"> -->PW찾기</a>
					</div>
				</div>
			<div style="clear:left;">
				<b> 영문입력의 경우 대소문자를 구분하여 입력해 주십시오.</b>
			</div>
			<div style="height:50px;">
				<input type="checkbox" name="id_re"  <? if($_COOKIE[id_rem]) echo "checked"; ?>> <font color="#4b4b4b">ID 저장</font>
			</div>
			<div style="border-bottom:1px solid #707070; margin-right:50px; padding-bottom:5px;">
				<font size="2" color="#000066"><b>CMS 공지사항</b></font>
			</div>
			<div style="border-bottom:1px solid #d0d0d0; margin-right:50px; height:120px; padding:8px 0 5px 0;">
				<?
							$noti_qry="SELECT * FROM cms_board_post ORDER BY post_id DESC LIMIT 0, 5";
							$noti_rlt=mysql_query($noti_qry, $connect);
							for($i=0; $noti_rows=mysql_fetch_array($noti_rlt); $i++){
								 if($noti_rows[division]==1) $division="<b>[안내사항]</b>";
								 if($noti_rows[division]==2) $division="<b>[일반공지]</b>";
								 if($noti_rows[division]==3) $division="<b>[변경공지]</b>";
								 if($noti_rows[division]==4) $division="<b>[기타공지]</b>";
				?>
				<div style="clear:left; height:24px;">
					<div style="float:left; padding-left:5px;"><font color="#000000"><?=$division?></font></div>
					<div style="float:left; width:360px; padding-left:5px;"><a href="#"><?=rg_cut_string($noti_rows[subject],38,"..")?></a></div>
					<div style="float:left; text-align:right;"><?=date('Y-m-d',$noti_rows[reg_date])?></div>
				</div>
				<? } ?>
			</div>
			</div>
		</div>
		<div style="text-align:center; padding-top:8px;">
			<font color="#B5B5B5"><b>회원정보와 관련하여 문의가 있으신 경우</b></font> <font color="#6E87DB"><a href="mailto:cigiko@naver.com" class="upme"><b>관리자(cigiko@naver.com)</b></a></font><font color="#B5B5B5"><b>에게 문의하여 주시기 바랍니다.</b></font>
		</div>
	 </div>
	 </form>
 </body>
</html>
