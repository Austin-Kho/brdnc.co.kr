<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?


	// form(form1-post)에서 받은 데이터	
	$si_name = $_POST['si_name'];
	if(!$si_name) $si_name = $_POST['acc_name'];
	$acc_name = $_POST['acc_name'];
	$co_no1 = $_POST['co_no1'];
	$co_no2 = $_POST['co_no2'];
	$co_no3 = $_POST['co_no3'];
	$acc_cla = $_POST['acc_cla'];
	$co_rate = $_POST['co_rate']/100;
	$acc_worker = $_POST['acc_worker'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];

	$accounts = addslashes($accounts);         // 거래처 명
	$co_no = $co_no1."-".$co_no2."-".$co_no3;  // 사업자 등록번호

	####### 같은 정보 존재 여부 확인 #########
	$query="select * from cms_accounts where acc_name='$acc_name' or co_no='$co_no'";
	$result=mysql_query($query, $connect);
	$total_num=mysql_num_rows($result);

	if($total_num){            // 같은 정보가 있을 때 이전 페이지로 옮김
		echo ("<script>
						window.alert('거래처명, 사업자등록번호 중 중복된 값이 있습니다!');
						history.go(-1)
					 </script>");
		exit;
	} else {
		

		############# 회원 정보 테이블에 입력 값을 등록한다. #############
		$query="INSERT INTO `cms_accounts` ( `si_name` ,`acc_name` , `co_no` , `acc_cla` , `co_rate` , `acc_worker` , `phone` , `address`, `reg_date`)
						 
							 VALUES( '$si_name', '$acc_name', '$co_no', '$acc_cla', '$co_rate', '$acc_worker', '$phone', '$address', now())";
		$result=mysql_query($query, $connect);

		// 저장 과정에서 오류가 생기면

		if(!$result){
			err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		} else {
			echo ("<script>
							window.alert('정상적으로 거래처 정보가 등록 되었습니다!');
							history.go(-2);
						 </script>");
			// echo "<meta http-equiv='Refresh' content='0; URL=accounts_up.php'>";
		}
	}
?>
