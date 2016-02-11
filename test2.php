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
			<div id="content_wrap">
				<article style="height: 700px;">
					<section id="index_section_1"> <!-- section 1 -->
						<div><!-- 메인 배너 div -->
							<div class="main_banner"><a href="http://송도양우내안애.kr/" target="_blank"><img class="img-thumbnail" src="/_static/img/main_banner/3.jpg" width="235" height="220" title="양우내안애 에르바체" alt="" /></a></div>
							<div class="main_banner"><a href="http://송도양우내안애.kr/" target="_blank"><img class="img-thumbnail" src="/_static/img/main_banner/2.jpg" width="235" height="220" title="양우내안애 에르바체" alt="" /></a></div>
							<div class="main_banner"><a href="http://송도양우내안애.kr/" target="_blank"><img class="img-thumbnail" src="/_static/img/main_banner/1.jpg" width="235" height="220" title="양우내안애 에르바체" alt="" /></a></div>
						</div>
						<div style="height:28px; text-align:center; padding-top:8px; clear: both;"><a href="#;"><img src="/_static/img/vit_bt.jpg" title="1" alt="" /></a></div>
						<div><!-- 공지 사항 div -->
							<table>
								<caption class="tb_cap_more"><b>+</b> 더보기</caption>
								<thead>
									<tr>
										<th id="index_noti" colspan="2">공 지 사 항</th>
									</tr>
								</thead>
								<tbody>
									<tr class="index_noti">
										<td class="index_noti_sub">·  공지사항 폼 준비 중!</td>
										<td>2013/05/20</td>
									</tr>
									<tr class="index_noti">
										<td>·  공지사항 폼 준비 중!</td>
										<td>2013/05/20</td>
									</tr>
									<tr class="index_noti">
										<td>·  공지사항 폼 준비 중!</td>
										<td>2013/05/20</td>
									</tr>
									<tr class="index_noti">
										<td>·  공지사항 폼 준비 중!</td>
										<td>2013/05/20</td>
									</tr>
									<tr class="index_noti">
										<td>·  공지사항 폼 준비 중!</td>
										<td>2013/05/20</td>
									</tr>
								</tbody>
							</table>
						</div>
					</section> <!-- section 1 -->
					<section  id="index_section_2"> <!-- section 2 -->
						<div id="index_1st_box">
							메인 구성 준비 중..
						</div>
						<div id="index_2nd_box">
							메인 구성 준비 중..2
						</div>
					</section> <!-- section 2 -->
					<section  id="index_section_3"> <!-- section 3 -->
						<div id="index_3rd_box">
							메인 구성 준비 중..3
						</div>
					</section> <!-- section 3 -->
				</article>
			</div>
		</div><!-- container -->
		<footer id="footwrap">
			<div id="footer"><b>[주] 바램디앤씨</b> | 인천광역시 연수구 인천타워대로323 B-1506(송도동, 송도센트로드오피스) | 전화 : 032-858-9556 | 문의하기 : <a href='mailto:cigiko@naver.com' class='under'>cigiko@naver.com</a><br>
			Copyright 2015-2016 by BARAEM D&C Co.,LTD All rights reserved.
			</div>
		</footer>
		<!-- Bootstrap core JavaScript=================================== -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="/static/lib/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>