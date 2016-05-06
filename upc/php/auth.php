<?
	function authenticate(){
		Header("WWW-authenticate: basic realm=\"관리자 영역\"");
		Header("HTTP/1.0 401 Unauthorized");

		echo ("관리자 아이디와 암호가 필요합니다!");
		exit;
	}

	if(!isset($_SERVER['PHP_AUTH_USER'])||($_SERVER['PHP_AUTH_USER']!='cigiko'||$_SERVER['PHP_AUTH_PW']!='sc1965112')){
		authenticate();
	}
?>