<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/dt/static/img/cms.ico">

		<title>[주]바램디앤씨 관리시스템</title>

		<!-- Bootstrap core CSS -->
   	<link type="text/css" rel="stylesheet" href="/dt/static/lib/bootstrap/css/bootstrap.min.css" media="screen">

   	<!-- Custom styles for this template -->
    <link type="text/css" rel="stylesheet" href="/dt/static/css/cms.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/dt/static/js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

		<script src="/dt/static/lib/calendar/calendar.js"></script>
		<script src="/dt/static/js/global.js"></script>
		<!-- <script src="../common/_menu1.js"></script> -->
	</head>
	<body onclick="cal_del();">
		<div class="main_container">
		<script type="text/javascript">
			// jQuery(document).ready(function(){
			// 	jQuery("#loading").css("display","none");
			// });
		</script>
		<!-- <div id="loading" style="padding-top:530px;"><img src="../images/loading.gif"><br>loading...</div> -->
			<header id="top">
				<div id="header_wrap">
					<div id="main_logo"><!-- 첫째 줄 -->
						<a href="/dt/main/"><img src="/dt/static/img/cms_main_logo_.png" alt="" onmouseover="this.src='/dt/static/img/cms_main_logo.png' " onmouseout="this.src='/dt/static/img/cms_main_logo_.png' "></a>
					</div><!-- main_logo -->
					<nav id="top_nav_wrap"><!-- 둘째 줄 -->
						<ul>
<?php if(@$this->session->userdata['logged_in'] == TRUE) { ?>
							<li><a class="menuLink" href=""><span style="color: #1F52DA;"><strong><?php 	echo $this->session->userdata['user_id'] ?></strong></span> 님</a></li>
							<li>|</li>
							<li><a class="menuLink" href="/dt/member/logout/"><strong>로그아웃</strong></a></li>
							<li>|</li>
							<li><a class="menuLink" href="/dt/member/modify/"><strong>회원정보수정</strong></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><strong>공지사항</strong></a></li>

<?php 	}else{  ?>
							<li><a class="menuLink" href="/dt/member/login/">로그인</a></li>
							<li>|</li>
							<li><a class="menuLink" href="/dt/member/join/"><b>회원가입</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>공지사항</b></a></li>
<?php 	} ?>
						</ul>
					</nav>
					<nav id="main_nav_wrap"><!-- 세째 줄 -->
						<ol>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '1')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/dt/m1/">영업관리</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '2')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/dt/m2/">현장관리</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '3')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/dt/m3/">자금회계</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '4')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/dt/m4/">프로젝트</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '5')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/dt/m5/">환경설정</a>
							</li>
						</ol>
					</nav>
				</div><!-- header_wrap -->
			</header>