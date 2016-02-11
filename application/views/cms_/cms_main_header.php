<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/_static/img/cms.ico">

		<title>[주]바램디앤씨 관리시스템</title>

		<!-- Bootstrap core CSS -->
    		<link type="text/css" href="/_static/lib/bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet">
		<link type="text/css" href="_static/css/cms.css" rel="stylesheet">
		<!--[if lt IE 9]>
  		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="_static/lib/calendar/calendar.js"></script>
		<script src="/_static/js/global.js"></script>
		<script src="../common/_menu1.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			$("#loading").css("display","none");
			});
		</script>
	</head>
	<body onclick="cal_del();">
		<div class="main_container">
		<!-- <div id="loading" style="padding-top:530px;"><img src="../images/loading.gif"><br>loading...</div> -->
			<header id="top">
				<script type="text/javascript">
				<!--
					function message_win(ref) {
						// ref = ref + "?id=" + <?=$_SESSION['p_id']?>;
						var window_left = (screen.width-640)/2;
						var window_top = (screen.height-480)/2;
						window.open(ref,"message",'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
				 	}
				</script>

				<div id="header_wrap">
					<div id="main_logo"><!-- 첫째 줄 -->
						<a href="/cms_cont"><img src="/_static/img/cms_main_logo_.png" alt="" onmouseover="this.src='/_static/img/cms_main_logo.png' " onmouseout="this.src='/_static/img/cms_main_logo_.png' "></a>
					</div><!-- main_logo -->

					<nav class="top_nav_wrap"><!-- 둘째 줄 -->
						<ul>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>매뉴얼</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>My Page</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>공지사항</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>회원정보수정</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>새 쪽지 : 0개</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>로그아웃</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="/cms/member/login_form.php">고창균 님</a></li>
						</ul>
					</nav>
					<nav class="main_nav_wrap"><!-- 세째 줄 -->
						<ul>
							<li><a class="main_nav" href="/cms/_menu1/work_main.php">영업관리</a></li>
							<li><a class="main_nav" href="/cms/_menu2/local_main.php">현장관리</a></li>
							<li><a class="main_nav" href="/cms/_menu3/capital_main.php">자금회계</a></li>
							<li><a class="main_nav" href="/cms/_menu4/project_main.php">프로젝트</a></li>
							<li><a class="main_nav" href="/cms/_menu5/config_main.php">환경설정</a></li>
						</ul>
					</nav>
				</div><!-- header_wrap -->
			</header>