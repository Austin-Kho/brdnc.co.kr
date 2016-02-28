<?
	######### 데이터베이스에 연결 ##########
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸리티 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?
	// 이름과 아이디에 해당하는 세션이 있는지 확인
	if(!isset($_SESSION['p_id'])||!isset($_SESSION['p_name'])){
		err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
	}

	// register_global= off <--설정에 따른 변수 수신
	$receive_id=$_POST['receive_id'];
	$msg=$_POST['msg'];

	// 데이터베이스에 있는 아이디인지 확인
	$query="select user_id from cms_member_table where user_id='$receive_id'";
	$result=mysql_query($query, $connect);
	$total_num=mysql_num_rows($result);

	if(!$total_num){
		err_msg('존재하지 않는 아이디입니다. 아이디를 확인하세요.');
	} else {
		$msg=addslashes($msg);

		$qry1="insert into cms_message_info(sendid_fk, receiveid_fk, message, send_reg)
				  values('$_SESSION[p_id]', '$receive_id', '$msg', now())";
		$res1=mysql_query($qry1, $connect);
		if(!$res1){
			err_msg('데이터베이스 오류가 발생하였습니다.');
		} else {
			echo "<script>
							window.alert('정상적으로 메시지가 전달되었습니다.');
						</script>";
			echo "<meta http-equiv='Refresh' content='0; URL=../member/message_2.php'>";
		}
	}
?>
