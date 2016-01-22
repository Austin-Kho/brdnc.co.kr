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

	$mode=$_REQUEST['mode'];

	if($mode=="del"){
		$del_code=$_REQUEST['del_code'];

		$qry="DELETE FROM cms_capital_bank_account WHERE no='$del_code' ";
		$res=mysql_query($qry, $connect);

		if($res){
			echo ("<script>
						window.alert('정상적으로 삭제되었습니다!');
						history.go(-1);
					 </script>");
			// echo ("<meta http-equiv='Refresh' content='0; URL=accounts_in.php'>");
		}else{
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
	}else{
		// form(form1-post)에서 받은 데이터
		$sort=$_REQUEST['sort'];
		$bank_code=$_REQUEST['bank_code'];

		$qry = "SELECT bank_name FROM cms_capital_bank_code WHERE bank_code = '$bank_code' ";
		$rlt = mysql_query($qry, $connect);
		$row= mysql_fetch_array($rlt);
		$bank = $row[bank_name];

		$name= addslashes($_POST['name']); // 계좌별칭
		$number = $_POST['number'];
		$holder = $_POST['holder'];
		$acc_code = $_REQUEST['acc_code'];
		$acc_cms_code = $_REQUEST['acc_cms_code'];
		$open_date = $_POST['open_date'];
		$note = $_POST['note'];
		$worker = $_SESSION['p_name'];

		if($sort=='com'){$is_com='1'; }else{	$pj_seq = $sort; } // 본사 또는 현장일 경우 구분 변수 설정

		if($mode=="reg"){
			####### 같은 정보 존재 여부 확인 #########
			$query="SELECT * FROM cms_capital_bank_account  WHERE name='$name' or (bank='$bank' and number='$number')";
			$result=mysql_query($query, $connect);
			$total_num=mysql_num_rows($result);

			if($total_num){            // 같은 정보가 있을 때 이전 페이지로 옮김
				echo ("<script>
					 		window.alert('이미 사용 중인 계좌명(별칭)이거나, 등록된 계좌입니다!');
							history.go(-1)
						</script>");
				exit;
			} else {
				############# 회원 정보 테이블에 입력 값을 등록한다. #############
				$query="INSERT INTO `cms_capital_bank_account` ( `bank_code`, `bank`, `name` ,`number` , `is_com`, `div_seq`, `pj_seq`, `holder` , `open_date` , `note`)
																		VALUES('$bank_code', '$bank', '$name', '$number', '$is_com', '$com_div', '$pj_seq', '$holder', '$open_date', '$note')";
				$result=mysql_query($query, $connect);

				// 저장 과정에서 오류가 생기면

				if(!$result){
					err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					echo ("<script>
								window.alert('정상적으로 거래처 정보가 등록 되었습니다!');
								history.go(-2);
							</script>");
				}
			}
		}else if($mode=="edit"){
			$no = $_POST['no'];  // 수정 시

			############# 회원 정보 테이블에 입력 값을 업데이트한다. #############
			$query="UPDATE cms_capital_bank_account SET bank_code='$bank_code',
																	 bank='$bank',
																	 name='$name',
																	 number='$number',
																	 is_com='$is_com',
																	 div_seq='$com_div',
																	 pj_seq='$pj_seq',
																	 holder='$holder',
																	 open_date ='$open_date',
																	 note='$note'
								            WHERE no='$no' ";
			$result=mysql_query($query, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 거래처 정보가 수정 되었습니다!');
							history.go(-2);
						</script>");
			}
		}
	}
?>
