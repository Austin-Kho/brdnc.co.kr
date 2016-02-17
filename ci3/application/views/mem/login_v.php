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
 <body>
<?php
	$attributes = array('name' => 'login');
	echo form_open('/member/login', $attributes);
?>
		<div style="width:600px; height:100%; margin:0px auto;"><!-- wrap div -->
			<div style="height:160px;"></div>
			<article style="width:600px; height:420px; border:2px solid #96ABE5; background-color:white;">
				<header style="width:596px; height:80px; border-bottom:2px solid #96ABE5; background-color:#D9EAF8; padding:19px 0 0 18px;">
					<img src="/ci3/static/img/cms_main_logo.png" alt="" width="154px">
				</header>

				<fieldset>
					<!-- <legend>로그인</legend> --><!-- 폼 캡션 -->
					<div class="col-xs-4" style="padding: 26px 0 0 30px;">
						<label class="sr-only" for="input01">아이디</label>
						<div class="">
							<input type="text" name="user_id" id="input01" value="<?php echo set_value('user_id'); ?>" class="form-control  input-sm"  placeholder="ID">
							<p class="help-block"></p>
						</div>
						<label class="sr-only" for="input02">비밀번호</label>
						<div class="">
							<input type="password" name="passwd" id="input02;" value="<?php echo set_value('passwd'); ?>"  class="form-control  input-sm" placeholder="Password">
							<p class="help-block"></p>
						</div>
					</div>
					<div class="col-xs-4" style="padding: 32px 0 0 10px; width: 83px;">
						<button class="btn btn-primary btn-xs" type="submit" style="height: 60px; width: 58px;">로그인</button>
					</div>

					<div class="col-xs-4" style="padding: 32px 0 0 0px; width: 183px;">
						<p class="btn btn-default btn-sm" onclick="location.href('/cms/member/member_join.php');">회원가입</p>
					</div>

					<div class="col-xs-4" style="padding: 3px 0 0 0px;">
						<p class="btn btn-link btn-xs" onclick="alert('준비 중!!');">ID 찾기</p>
						<p class="btn btn-link btn-xs" onclick="alert('준비 중!!');">비밀번호 찾기</p>
					</div>

				</fieldset>
				<fieldset>
					<p style="padding-left: 30px;"><strong><?php echo validation_errors(); ?>영문 입력의 경우 대소문자를 구분하여 입력하여 주십시요.</strong></p>
					<p style="padding-left: 30px;"><input type="checkbox"> ID 저장</p>
				</fieldset>

				<section>
					<header style="border-width:0 0 1px 0; border-style:solid; border-color:#b4b8c5; margin:0 30px 0 30px;">
						<h6 style="padding: 10px 30px 0 0px; font-weight: bold; color: #043893"><span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span> CMS 공지사항</h6>
					</header>
					<article style="height: 112px; border-width:0 0 1px 0; border-style:solid; border-color:#b4b8c5; margin:0 30px 5px 30px; padding: 5px 5px 0 5px;">
						<p>테스트</p>
						<p>테스트</p>
						<p>테스트</p>
						<p>테스트</p>
					</article>
				</section>

			</article>
		</div>
	</form>
 </body>
</html>