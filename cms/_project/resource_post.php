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

	$mode = $_REQUEST['mode'];
	$pj=$_REQUEST['pj'];
	$headq = $_REQUEST['headq'];
	$team=$_REQUEST['team'];
	$edit_code = $_REQUEST['edit_code'];
	$del_code=$_REQUEST['del_code'];

	if($mode=='mem_reg'){
	// form(form1-post)에서 받은 데이터

	// 현장 등록 팀
	$team_1 = $_REQUEST['team_1']; $team_2 = $_REQUEST['team_2']; $team_3 = $_REQUEST['team_3']; $team_4 = $_REQUEST['team_4']; $team_5 = $_REQUEST['team_5'];
	$team_6 = $_REQUEST['team_6']; $team_7 = $_REQUEST['team_7']; $team_8 = $_REQUEST['team_8']; $team_9 = $_REQUEST['team_9']; $team_10 = $_REQUEST['team_10'];

	// 직위
	$position_1 = $_REQUEST['position_1']; $position_2 = $_REQUEST['position_2']; $position_3 = $_REQUEST['position_3']; $position_4 = $_REQUEST['position_4']; $position_5 = $_REQUEST['position_5'];
	$position_6 = $_REQUEST['position_6']; $position_7 = $_REQUEST['position_7']; $position_8 = $_REQUEST['position_8']; $position_9 = $_REQUEST['position_9']; $position_10 = $_REQUEST['position_10'];

	// 성명
	$name_1 = $_REQUEST['name_1']; $name_2 = $_REQUEST['name_2']; $name_3 = $_REQUEST['name_3']; $name_4 = $_REQUEST['name_4']; $name_5 = $_REQUEST['name_5'];
	$name_6 = $_REQUEST['name_6']; $name_7 = $_REQUEST['name_7']; $name_8 = $_REQUEST['name_8']; $name_9 = $_REQUEST['name_9']; $name_10 = $_REQUEST['name_10'];

	// 주민등록번호
	$id_num_1 = $_REQUEST['id_num1_1']."-".$_REQUEST['id_num2_1'];
	$id_num_2 = $_REQUEST['id_num1_2']."-".$_REQUEST['id_num2_2'];
	$id_num_3 = $_REQUEST['id_num1_3']."-".$_REQUEST['id_num2_3'];
	$id_num_4 = $_REQUEST['id_num1_4']."-".$_REQUEST['id_num2_4'];
	$id_num_5 = $_REQUEST['id_num1_5']."-".$_REQUEST['id_num2_5'];
	$id_num_6 = $_REQUEST['id_num1_6']."-".$_REQUEST['id_num2_6'];
	$id_num_7 = $_REQUEST['id_num1_7']."-".$_REQUEST['id_num2_7'];
	$id_num_8 = $_REQUEST['id_num1_8']."-".$_REQUEST['id_num2_8'];
	$id_num_9 = $_REQUEST['id_num1_9']."-".$_REQUEST['id_num2_9'];
	$id_num_10 = $_REQUEST['id_num1_10']."-".$_REQUEST['id_num2_10'];

	// 전화번호
	$tel_1 = $_REQUEST['tel1_1']."-".$_REQUEST['tel2_1']."-".$_REQUEST['tel3_1'];
	$tel_2 = $_REQUEST['tel1_2']."-".$_REQUEST['tel2_2']."-".$_REQUEST['tel3_2'];
	$tel_3 = $_REQUEST['tel1_3']."-".$_REQUEST['tel2_3']."-".$_REQUEST['tel3_3'];
	$tel_4 = $_REQUEST['tel1_4']."-".$_REQUEST['tel2_4']."-".$_REQUEST['tel3_4'];
	$tel_5 = $_REQUEST['tel1_5']."-".$_REQUEST['tel2_5']."-".$_REQUEST['tel3_5'];
	$tel_6 = $_REQUEST['tel1_6']."-".$_REQUEST['tel2_6']."-".$_REQUEST['tel3_6'];
	$tel_7 = $_REQUEST['tel1_7']."-".$_REQUEST['tel2_7']."-".$_REQUEST['tel3_7'];
	$tel_8 = $_REQUEST['tel1_8']."-".$_REQUEST['tel2_8']."-".$_REQUEST['tel3_8'];
	$tel_9 = $_REQUEST['tel1_9']."-".$_REQUEST['tel2_9']."-".$_REQUEST['tel3_9'];
	$tel_10 = $_REQUEST['tel1_10']."-".$_REQUEST['tel2_10']."-".$_REQUEST['tel3_10'];

	// 은행명
	$bank_acc_1 = $_REQUEST['bank_acc_1']; $bank_acc_2 = $_REQUEST['bank_acc_2']; $bank_acc_3 = $_REQUEST['bank_acc_3']; $bank_acc_4 = $_REQUEST['bank_acc_4']; $bank_acc_5 = $_REQUEST['bank_acc_5'];
	$bank_acc_6 = $_REQUEST['bank_acc_6']; $bank_acc_7 = $_REQUEST['bank_acc_7']; $bank_acc_8 = $_REQUEST['bank_acc_8']; $bank_acc_9 = $_REQUEST['bank_acc_9']; $bank_acc_10 = $_REQUEST['bank_acc_10'];

	// 계좌번호
	$bank_acc_num_1 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_1']);
	$bank_acc_num_2 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_2']);
	$bank_acc_num_3 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_3']);
	$bank_acc_num_4 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_4']);
	$bank_acc_num_5 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_5']);
	$bank_acc_num_6 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_6']);
	$bank_acc_num_7 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_7']);
	$bank_acc_num_8 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_8']);
	$bank_acc_num_9 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_9']);
	$bank_acc_num_10 = preg_replace("/-/", "", $_REQUEST['bank_acc_num_10']);

	// 예금주
	$bank_acc_holder_1 = $_REQUEST['bank_acc_holder_1']; $bank_acc_holder_2 = $_REQUEST['bank_acc_holder_2']; $bank_acc_holder_3 = $_REQUEST['bank_acc_holder_3']; $bank_acc_holder_4 = $_REQUEST['bank_acc_holder_4']; $bank_acc_holder_5 = $_REQUEST['bank_acc_holder_5'];
	$bank_acc_holder_6 = $_REQUEST['bank_acc_holder_6']; $bank_acc_holder_7 = $_REQUEST['bank_acc_holder_7']; $bank_acc_holder_8 = $_REQUEST['bank_acc_holder_8']; $bank_acc_holder_9 = $_REQUEST['bank_acc_holder_9']; $bank_acc_holder_10 = $_REQUEST['bank_acc_holder_10'];

	// 입사일
	$join_date_1=$_REQUEST['join_date_1'];	$join_date_2=$_REQUEST['join_date_2'];	$join_date_3=$_REQUEST['join_date_3'];	$join_date_4=$_REQUEST['join_date_4'];	$join_date_5=$_REQUEST['join_date_5'];
	$join_date_6=$_REQUEST['join_date_6'];	$join_date_7=$_REQUEST['join_date_7'];	$join_date_8=$_REQUEST['join_date_8'];	$join_date_9=$_REQUEST['join_date_9'];	$join_date_10=$_REQUEST['join_date_10'];



	############# cms_resource_team_member 테이블에 입력 값을 등록한다. #############

	if($name_1){
		 $query_1="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_1', '$position_1', '$name_1', '$id_num_1', '$tel_1', '$bank_acc_1', '$bank_acc_num_1', '$bank_acc_holder_1', '$join_date_1')";
		 $result_1=mysql_query($query_1, $connect);
		 if(!$result_1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_2){
		 $query_2="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_2', '$position_2', '$name_2', '$id_num_2', '$tel_2', '$bank_acc_2', '$bank_acc_num_2', '$bank_acc_holder_2', '$join_date_2')";
		 $result_2=mysql_query($query_2, $connect);
		 if(!$result_2) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_3){
		 $query_3="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_3', '$position_3', '$name_3', '$id_num_3', '$tel_3', '$bank_acc_3', '$bank_acc_num_3', '$bank_acc_holder_3', '$join_date_3')";
		 $result_3=mysql_query($query_3, $connect);
		 if(!$result_3) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_4){
		 $query_4="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_4', '$position_4', '$name_4', '$id_num_4', '$tel_4', '$bank_acc_4', '$bank_acc_num_4', '$bank_acc_holder_4', '$join_date_4')";
		 $result_4=mysql_query($query_4, $connect);
		 if(!$result_4) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_5){
		 $query_5="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_5', '$position_5', '$name_5', '$id_num_5', '$tel_5', '$bank_acc_5', '$bank_acc_num_5', '$bank_acc_holder_5', '$join_date_5')";
		 $result_5=mysql_query($query_5, $connect);
		 if(!$result_5) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_6){
		 $query_6="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_6', '$position_6', '$name_6', '$id_num_6', '$tel_6', '$bank_acc_6', '$bank_acc_num_6', '$bank_acc_holder_6', '$join_date_6')";
		 $result_6=mysql_query($query_6, $connect);
		 if(!$result_6) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_7){
		 $query_7="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_7', '$position_7', '$name_7', '$id_num_7', '$tel_7', '$bank_acc_7', '$bank_acc_num_7', '$bank_acc_holder_7', '$join_date_7')";
		 $result_7=mysql_query($query_7, $connect);
		 if(!$result_7) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_8){
		 $query_8="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_8', '$position_8', '$name_8', '$id_num_8', '$tel_8', '$bank_acc_8', '$bank_acc_num_8', '$bank_acc_holder_8', '$join_date_8')";
		 $result_8=mysql_query($query_8, $connect);
		 if(!$result_8) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_9){
		 $query_9="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_9', '$position_9', '$name_9', '$id_num_9', '$tel_9', '$bank_acc_9', '$bank_acc_num_9', '$bank_acc_holder_9', '$join_date_9')";
		 $result_9=mysql_query($query_9, $connect);
		 if(!$result_9) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($name_10){
		 $query_10="INSERT INTO `cms_resource_team_member` (`pj_seq`, `headq_seq`, `team_seq`, `position`, `name`, `id_num`, `tel`, `bank_acc`, `bank_acc_num`, `bank_acc_holder`, `join_date`)
															VALUES('$pj', '$headq', '$team_10', '$position_10', '$name_10', '$id_num_10', '$tel_10', '$bank_acc_10', '$bank_acc_num_10', '$bank_acc_holder_10', '$join_date_10')";
		 $result_10=mysql_query($query_10, $connect);
		 if(!$result_10) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}


	echo ("<script>
				window.alert('정상적으로 인원 정보가 등록 되었습니다!');
				location.href='project_main.php?m_di=2&s_di=1';
			 </script>");

	}else if($mode=='mem_modify'){ // 멤버 정보 수정 시

		$pj_seq = $_REQUEST['pj_seq'];
		$headq = $_REQUEST['headq'];
		$team = $_REQUEST['team'];
		$position = $_REQUEST['position'];
		$name = $_REQUEST['name'];
		$id_num = $_REQUEST['id_num1']."-".$_REQUEST['id_num2'];
		$tel = $_REQUEST['tel1']."-".$_REQUEST['tel2']."-".$_REQUEST['tel3'];
		$bank_acc = $_REQUEST['bank_acc'];
		$bank_acc_num =  preg_replace("/-/", "", $_REQUEST['bank_acc_num']);
		$bank_acc_holder = $_REQUEST['bank_acc_holder'];
		$join_date = $_REQUEST['join_date'];
		$edit_code = $_REQUEST['edit_code'];

		$query = "UPDATE cms_resource_team_member SET pj_seq='$pj_seq',
																	  headq_seq = '$headq',
																	  team_seq = '$team',
																	  position = '$position',
																	  name = '$name',
																	  id_num = '$id_num',
																	  tel = '$tel',
																	  bank_acc = '$bank_acc',
																	  bank_acc_num = '$bank_acc_num',
																	  bank_acc_holder = '$bank_acc_holder',
																	  join_date = '$join_date'
					WHERE seq='$edit_code' ";

		$result = mysql_query($query, $connect);
		if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 현장 직원정보가 수정 되었습니다!');
					location.href='resc_mem_modify.php?pj_seq=$pj_seq&headq_seq=$headq&team_seq=$team&edit_code=$edit_code';
				</script>");

	}else if($mode=='mem_retire'){ // 현장 인원 퇴사 처리 시
		$date = $_REQUEST['date'];
		$re_code = $_REQUEST['re_code'];
		$pj_seq = $_REQUEST['pj_seq'];

		//검사
		$qry = "SELECT is_retire FROM cms_resource_team_member WHERE seq='$re_code' ";
		$rlt = mysql_query($qry, $connect);
		$row = mysql_fetch_array($rlt);
		if($row[is_retire]==1) err_msg('이미 퇴사처리 된 직원입니다!');

		$query = "UPDATE cms_resource_team_member SET is_retire='1', retire_date='$date' WHERE seq='$re_code' ";
		$result = mysql_query($query, $connect);
		if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 퇴사 정보가 처리 되었습니다!');
					location.href='project_main.php?m_di=2&s_di=1&pj_list=$pj_seq';
				</script>");


	}else if($mode=='headq_reg'){ // 본부 신규 등록 시

		$query = "INSERT INTO `cms_resource_headq` (`pj_seq`, `headq`) VALUES('$pj', '$headq') ";
		$result = mysql_query($query, $connect);
		if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 본부정보가 등록 되었습니다!');
					location.href='resc_basic.php?pj=$pj&sort=headq_list';
				</script>");

	}else if($mode=='headq_modify'){ // 본부 정보 수정 시

		$query = "UPDATE cms_resource_headq SET headq='$headq' WHERE seq='$edit_code' ";
		$result = mysql_query($query, $connect);
		if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 본부정보가 등록 되었습니다!');
					location.href='resc_basic.php?pj=$pj&sort=headq_list';
				</script>");

	}else if($mode=='headq_del'){ // 본부 정보 삭제 시

		$qry="DELETE FROM cms_resource_headq WHERE seq='$del_code' ";
		$res=mysql_query($qry, $connect);
		$qry1="DELETE FROM cms_resource_team WHERE headq_seq='$del_code' ";
		$res1=mysql_query($qry1, $connect);
		if(!$res||!$res1) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 삭제되었습니다!');
					history.go(-1);
				</script>");

	}else if($mode=='team_reg'){ // 팀 정보 신규 등록 시

		$qry="INSERT INTO `cms_resource_team` (`pj_seq`, `headq_seq`, `team`) VALUES('$pj', '$headq', '$team') ";
		$res=mysql_query($qry, $connect);
		if(!$res) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 팀 정보가 등록 되었습니다!');
					location.href='resc_basic.php?pj=$pj&sort=team_list&headq_sel=$headq';
				</script>");

	}else if($mode=='team_modify'){ // 팀 정보 수정 시

		$qry="UPDATE cms_resource_team SET pj_seq='$pj', headq_seq='$headq', team='$team' WHERE seq='$edit_code' ";
		$res=mysql_query($qry, $connect);
		if(!$res) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 팀 정보가 수정 되었습니다!');
					location.href='resc_basic.php?pj=$pj&sort=team_list&headq_sel=$headq';
				</script>");

	}else if($mode=='team_del'){ // 팀 정보 삭제 시

		$qry="DELETE FROM cms_resource_team WHERE seq='$del_code' ";
		$res=mysql_query($qry, $connect);
		if(!$res) err_msg('데이터베이스 오류가 발생하였습니다.');
		echo ("<script>
					window.alert('정상적으로 삭제되었습니다!');
					history.go(-1);
				</script>");
	}
?>
