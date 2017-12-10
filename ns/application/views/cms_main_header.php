<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="(주)바램디앤씨 관리프로그램">
		<meta name="author" content="(주)바램디앤씨">
<?php if(strpos( $this->agent->mobile(), "Apple")!==FALSE) : ?>
		<link rel="apple-touch-icon" href="<?php echo $this->config->base_url('static/img/apple-touch-icon.png');?>"/>
<?php elseif(strpos( $this->agent->mobile(), "Android")!==FALSE) : ?>
		<link rel="apple-touch-icon" href="<?php echo $this->config->base_url('static/img/android_icon.png');?>"/>
<?php else : ?>
		<link rel="shortcut icon" href="<?php echo $this->config->base_url('static/img/cms.ico');?>"/>
<?php endif; ?>
		<title>[주]바램디앤씨 관리시스템</title>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->base_url('static/lib/bootstrap/css/bootstrap.min.css');?>" media="screen">
		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="<?php echo $this->config->base_url('static/css/cms.css');?>">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="<?php echo $this->config->base_url('static/js/ie-emulation-modes-warning.js');?>"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></scrit>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="<?php echo $this->config->base_url('static/lib/calendar/calendar.js');?>"></script>
		<script src="<?php echo $this->config->base_url('static/js/global.js');?>"></script>
<?php
	switch ($this->uri->segment(1)) {
		case 'm1': $menu_js = 'm1.js';	break;
		case 'm2': $menu_js = 'm2.js';	break;
		case 'm3': $menu_js = 'm3.js';	break;
		case 'm4': $menu_js = 'm4.js';	break;
		case 'm5': $menu_js = 'm5.js';	break;
	}
?>
		<script src="<?php echo $this->config->base_url('static/js')."/".$menu_js;?>"></script>
	</head>

	<body role="document" onclick="cal_del();">

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
					<a class="navbar-brand" href="<?php echo $this->config->base_url(); ?>">
						<strong><small>|주|바램디앤씨</small></strong>
					</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="<?php if( !strpos($this->uri->segment(1), '1')) echo ''; else echo 'active';?>"><a href=<?php echo $this->config->base_url('m1'); ?>>분양관리</a></li>
						<li class="<?php if( !strpos($this->uri->segment(1), '2')) echo ''; else echo 'active';?>"><a href=<?php echo $this->config->base_url('m2'); ?>>사업관리</a></li>
						<li class="<?php if( !strpos($this->uri->segment(1), '3')) echo ''; else echo 'active';?>"><a href=<?php echo $this->config->base_url('m3'); ?>>프로젝트</a></li>
						<li class="<?php if( !strpos($this->uri->segment(1), '4')) echo ''; else echo 'active';?>"><a href=<?php echo $this->config->base_url('m4'); ?>>본사관리</a></li>
						<li class="<?php if( !strpos($this->uri->segment(1), '5')) echo ''; else echo 'active';?>"><a href=<?php echo $this->config->base_url('m5'); ?>>환경설정</a></li>
						<li class="dropdown">
<?php if(@$this->session->userdata['logged_in'] == TRUE) : ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<span id="top_user_id"><?php  echo $this->session->userdata['name']; ?></span> 님<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
<?php if($this->session->userdata['is_admin']==1) : ?>
								<li><a href="<?php echo $this->config->base_url('admin');?>">관리자 <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></li>
<?php endif; ?>
								<li><a href="<?php echo $this->config->base_url()."member/logout?returnURL=".rawurlencode(base_url(uri_string()));?>">로그아웃</a></li>
								<li><a href="<?php echo $this->config->base_url('member/modify');?>">정보수정</a></li>
								<li><a href="javascript:" onclick="alert('준비 중입니다!');">공지사항</a></li>
<?php   else :  ?>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">기타메뉴 <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo $this->config->base_url('member/login');?>">로그인</a></li>
								<li><a href="<?php echo $this->config->base_url('member/join');?>">회원가입</a></li>
								<li><a href="javascript:" onclick="alert('준비 중입니다!');">공지사항</a></li>
<?php  endif; ?>
								<li class="divider"></li>
								<li class="dropdown-header">협업솔루션</li>
								<li><a href="https://brdnc.slack.com/" target="blank">Slack (brdnc)</a></li>
								<li><a href="https://trello.com/" target="blank">Trello</a></li>
							</ul>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>

		<div class="container theme-showcase main_container" role="main">
			<div style="height: 80px;"></div>
