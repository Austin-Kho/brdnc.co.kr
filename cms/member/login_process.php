<?
	ob_start();
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
	$domain = explode("/",$cms_url);
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?
	// 회원 테이블에서 정보 확인
	$user_id=$_REQUEST['user_id'];
	$pwd=md5($_REQUEST['pwd']);
	$id_rem = $_REQUEST['id_rem'];
	$ret_url = $_REQUEST['ret_url'];

	$query="select * from cms_member_table where user_id='$user_id' and passwd='$pwd' ";
	$result=mysql_query($query, $connect);
	$rows=mysql_fetch_array($result);

	if(!$rows){
		// util 함수의 err_msg 함수 활용
		err_msg('존재하지 않는 회원 ID이거나 비밀번호가 틀립니다!');
	} else if($rows[request]==2){
		 err_msg('관리자 사용 승인 후 사용이 가능합니다.\n승인 지연 시, 직접 관리자에게 문의하여 주세요.\n\nEmail : cigiko@naver.com / 전화문의 : 010-3320-0088');
	} else {
		$_SESSION['p_id']=$user_id;                              // 로그인 처리 위한 세션 값 부여, 반드시 session_start() 함수 실행 요
		$_SESSION['p_name']=$rows[name];
		$_SESSION['p_email']=$rows[email];
		$_SESSION['p_jnumber']=$rows[jnumber];

		// 아이디 기억 저장용 쿠키 선언
		if($id_rem=='Y'){
			 if(!$_COOKIE[id_rem]){
					setcookie('id_rem', $id_rem,  30000000+time(), "/",".".$domain[2]);
					setcookie('p_id', $user_id,  30000000+time(), "/",".".$domain[2]);
			 }
		} else {
			 setcookie("id_rem", "", time(), '/',".".$domain[2]);
			 setcookie("p_id", "", time(), '/',".".$domain[2]);
		}

		// 이동할 페이지 정보가 있을 경우
		if($ret_url){
			echo "<meta http-equiv='refresh' content='0; URL=$ret_url'>";
		} else {  //  이동할 페이지 정보가 없을 경우
			echo "<meta http-equiv='refresh' content='0; URL=../cms.php'>";
		}
	}
?>