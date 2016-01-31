<?
	// 세션을 사용하기 위해 세션 시작
	session_start();

	// 로그인 때 부여한 세션과 쿠키정보 초기화

	session_destroy();

	setcookie("p_sid", "", time(), '/');
?>
<meta http-equiv='refresh' content='0; URL=../member/login_form.php'>
<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
