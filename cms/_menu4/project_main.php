<?
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	$m_di=$_REQUEST['m_di'];
	$s_di=$_REQUEST['s_di'];

	$year_frm=$_REQUEST['year_frm'];
	$pj = $_REQUEST['pj'];
?>
<!DOCTYPE HTML>
<html>
 <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <title><?=$doc_title?></title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link type="text/css" rel="stylesheet" href="<?=$cms_url?>common/cms.css">
	<script src="../common/global.js"></script>
	<script src="../common/contract.js"></script>
	<script src="../include/calendar/calendar.js"></script>
 </head>

 <body onclick="cal_del();">
 <!-- ============================ 3 ============================ -->
 <div id="wrap">
	<div id="header">
	<? include '../include/t_menu.php'; ?>
	</div>
	<div id="content">
		<?
			if(!$_SESSION['p_id']){
		?>
		<div style="width:1080px; height:650px; text-align:center; display: table-cell; vertical-align: middle;">
			<p>로그인 정보가 없습니다. 다시 로그인하여 주십시요!</p>
			<input type="button" value="로그인" class="sub_bt1" onclick="location.href='<?=$cms_url?>member/login_form.php';">
			<input type="button" value=" 닫 기 " class="sub_bt1" onclick="window.self.close()">
		</div>
		<? }else{?>
		<div>
			<!-- ============================ Head end / body start ============================ -->
			<?
				if(!$m_di||$m_di==1) include "progress.php";
				if($m_di==2) include "contract.php";
			?>
			<!-- ============================ body end / Foot start ============================ -->
		</div>
		<? } ?>
	</div>
 </div>
 <div id="footwrap">
	<div id="footer"><?=$doc_copyright?></div>
 </div>
 </body>
</html>
