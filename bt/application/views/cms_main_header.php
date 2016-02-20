<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/bt/static/img/cms.ico">

		<title>[주]바램디앤씨 관리시스템</title>

		<!-- Bootstrap core CSS -->
   	<link rel="stylesheet" href="/bt/static/lib/bootstrap/css/bootstrap.min.css" media="screen">

   	<!-- Custom styles for this template -->
    <link rel="stylesheet" href="/bt/static/css/cms.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/bt/static/js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

		<script src="/bt/static/lib/calendar/calendar.js"></script>
		<script src="/bt/static/js/global.js"></script>
		<!-- <script src="../common/_menu1.js"></script> -->
	</head>

  <body role="document"  onclick="cal_del();">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/bt/"><strong>[주]바램디앤씨</strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!-- <li class="active"><a href="#">Home</a></li> -->
            <li class="<?if( !strpos($this->uri->segment(1), '1')) echo ''; else echo 'active';?>"><a href="/bt/m1/">영업관리</a></li>
            <li class="<?if( !strpos($this->uri->segment(1), '2')) echo ''; else echo 'active';?>"><a href="/bt/m2/">현장관리</a></li>
            <li class="<?if( !strpos($this->uri->segment(1), '3')) echo ''; else echo 'active';?>"><a href="/bt/m3/">자금관리</a></li>
            <li class="<?if( !strpos($this->uri->segment(1), '4')) echo ''; else echo 'active';?>"><a href="/bt/m4/">프로젝트</a></li>
            <li class="<?if( !strpos($this->uri->segment(1), '5')) echo ''; else echo 'active';?>"><a href="/bt/m5/">환경설정</a></li>
            <li class="dropdown">
<?php if(@$this->session->userdata['logged_in'] == TRUE) { ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <span id="top_user_id"><?php  echo $this->session->userdata['user_id'] ?></span> 님<span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/bt/member/logout/">로그아웃</a></li>
                <li><a href="javascript:" onclick="alert('준비 중입니다!');">정보수정</a></li>
                <li><a href="javascript:" onclick="alert('준비 중입니다!');">공지사항</a></li>
<?php   }else{  ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">기타메뉴 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/bt/member/login/">로그인</a></li>
                <li><a href="/bt/member/join/">회원가입</a></li>
                <li><a href="javascript:" onclick="alert('준비 중입니다!');">공지사항</a></li>
<?php  } ?>
                <li class="divider"></li>
                <li class="dropdown-header">관계사이트</li>
                <li><a href="http://www.keb.co.kr/" target="blank">외환은행 간편조회</a></li>
                <li><a href="#" target="blan">동춘1구역조합사이트</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main" id="main_container">
    	<div style="height: 65px;"></div>