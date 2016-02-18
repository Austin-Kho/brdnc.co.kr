<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/ci3/static/img/cms.ico">

		<title>[주]바램디앤씨 관리시스템</title>

		<!-- Bootstrap core CSS -->
   		<link type="text/css" href="/ci3/static/lib/bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet">
		<link type="text/css" href="/ci3/static/css/cms.css" rel="stylesheet">
		<!--[if lt IE 9]>
  		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="/ci3/static/lib/calendar/calendar.js"></script>
		<script src="/ci3/static/js/global.js"></script>
		<!-- <script src="../common/_menu1.js"></script> -->
		<script type="text/javascript">
			// jQuery(document).ready(function(){
			// 	jQuery("#loading").css("display","none");
			// });
		</script>
	</head>
	<body onclick="cal_del();">
		<div class="main_container">
		<!-- <div id="loading" style="padding-top:530px;"><img src="../images/loading.gif"><br>loading...</div> -->
			<header id="top">
				<div id="header_wrap">
					<div id="main_logo"><!-- 첫째 줄 -->
						<a href="/ci3/main/"><img src="/ci3/static/img/cms_main_logo_.png" alt="" onmouseover="this.src='/ci3/static/img/cms_main_logo.png' " onmouseout="this.src='/ci3/static/img/cms_main_logo_.png' "></a>
					</div><!-- main_logo -->
					<nav id="top_nav_wrap"><!-- 둘째 줄 -->
						<ul>
<?php if(@$this->session->userdata['logged_in'] == TRUE) { ?>
							<li><a class="menuLink" href=""><span style="color: #1F52DA;"><strong><?php 	echo $this->session->userdata['user_id'] ?></strong></span> 님</a></li>
							<li>|</li>
							<li><a class="menuLink" href="/ci3/member/logout"><strong>로그아웃</strong></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('회원 정보 수정 페이지로 이동!');"><strong>회원정보수정</strong></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><strong>공지사항</strong></a></li>

<?php 	}else{  ?>
							<li><a class="menuLink" href="/ci3/member/login">로그인</a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('회원 가입 페이지로 이동!');"><b>회원가입</b></a></li>
							<li>|</li>
							<li><a class="menuLink" href="javascript:" onclick="alert('준비 중입니다!');"><b>공지사항</b></a></li>
<?php 	} ?>
						</ul>
					</nav>
					<nav id="main_nav_wrap"><!-- 세째 줄 -->
						<ul>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '1')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/ci3/m1">영업관리</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '2')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/ci3/m2">현장관리</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '3')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/ci3/m3">자금회계</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '4')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/ci3/m4">프로젝트</a>
							</li>
							<li>
								<a class="<?if( !strpos($this->uri->segment(1), '5')) echo 'main_nav'; else echo 'sel_main_nav';?>" href="/ci3/m5">환경설정</a>
							</li>
						</ul>
					</nav>
				</div><!-- header_wrap -->
			</header>