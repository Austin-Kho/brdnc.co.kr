<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>[주]바램디앤씨 관리시스템</title>
		<link rel="shortcut icon" href="_static/img/cms.ico">
		<!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="/_static/lib/bootstrap/css/bootstrap.min.css" media="screen">
		<!-- <link type="text/css" rel="stylesheet" href="ref/css/cms.css"> -->
		<script src="_static/lib/calendar/calendar.js"></script>
		<script src="/_static/js/global.js"></script>
		<!--<script src="../common/_menu1.js"></script> //-->
		<script type="text/javascript">
			// $(document).ready(function(){
			// $("#loading").css("display","none");
			// });
		</script>
	</head>
	<body onclick="cal_del();">
		<!-- <div id="loading" style="padding-top:530px;"><img src="../images/loading.gif"><br>loading...</div> -->
		<header>
			<script type="text/javascript">
			<!--
				function message_win(ref) {
					// ref = ref + "?id=" + <?=$_SESSION['p_id']?>;
					var window_left = (screen.width-640)/2;
					var window_top = (screen.height-480)/2;
					window.open(ref,"message",'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
			 	}
			</script>

			<div>
				<div><!-- 첫째 줄 -->
					<a href="/cms_cont"><img src="/_static/img/cms_main_logo_.png" alt="" onmouseover="this.src='/_static/img/cms_main_logo.png' " onmouseout="this.src='/_static/img/cms_main_logo_.png' "></a>
				</div><!-- 로고부분 -->

				<div><!-- 둘째 줄 -->
					<div>
						<a href="/cms/member/login_form.php" style="font-size:11px;">로그인</a>
						&nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>공지사항</b></a> &nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>My Page</b></a> &nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>매뉴얼</b></a>
					</div>

					<nav>
						<a href="/cms/_menu1/work_main.php">메뉴1</a><a href="/cms/_menu2/local_main.php">메뉴2</a><a href="/cms/_menu3/capital_main.php">메뉴3</a><a href="/cms/_menu4/project_main.php">메뉴4</a><a href="/cms/_menu5/config_main.php">메뉴5</a>
					</nav>
				</div>
			</div>
		</header>