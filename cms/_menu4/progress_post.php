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

	// 신규등록인지 수정인지 체크변수
	$mode=$_REQUEST['mode'];
	if(!$mode) $mode="reg";

	// 등록 현장 구분
	$pj_seq = $_REQUEST['pj_seq'];
	$pj_sort = $_REQUEST['pj_sort'];
	$seq = $_REQUEST['seq'];

	//계약관리번호별 or 동호수별 관리 여부
	$data_cr = $_REQUEST['data_cr'];

	// 공통변수	
	$type_batch = $_REQUEST['type_batch'];
	$price_batch = $_REQUEST['price_batch'];
	$pay_batch = $_REQUEST['pay_batch'];
	$except_batch = $_REQUEST['except_batch'];
	if($except_batch=='on') $except_batch = 1;


	if($data_cr == '0'){ // 동호수별 관리데이터
		// form(form1-post)에서 받은 데이터
		$dong = $_REQUEST['dong'];
		$line = str_pad($_REQUEST['line'], 2, "0", STR_PAD_LEFT);

		$type_1 = strtoupper($_REQUEST['type_1']);   $type_2 = strtoupper($_REQUEST['type_2']);	$type_3 = strtoupper($_REQUEST['type_3']);	$type_4 = strtoupper($_REQUEST['type_4']);
		$type_5 = strtoupper($_REQUEST['type_5']);	$type_6 = strtoupper($_REQUEST['type_6']);	$type_7 = strtoupper($_REQUEST['type_7']);	$type_8 = strtoupper($_REQUEST['type_8']);

		$ho_1 = $_REQUEST['floor_1'].$line;	$ho_2 = $_REQUEST['floor_2'].$line;	$ho_3 = $_REQUEST['floor_3'].$line;	$ho_4 = $_REQUEST['floor_4'].$line;
		$ho_5 = $_REQUEST['floor_5'].$line;	$ho_6 = $_REQUEST['floor_6'].$line;	$ho_7 = $_REQUEST['floor_7'].$line;	$ho_8 = $_REQUEST['floor_8'].$line;

		$except_1 = $_REQUEST['except_1'];	if($except_1=='on') $except_1 = 1;
		$except_2 = $_REQUEST['except_2'];  if($except_2=='on') $except_2 = 1;
		$except_3 = $_REQUEST['except_3'];	if($except_3=='on') $except_3 = 1;
		$except_4 = $_REQUEST['except_4'];  if($except_4=='on') $except_4 = 1;
		$except_5 = $_REQUEST['except_5'];  if($except_5=='on') $except_5 = 1;
		$except_6 = $_REQUEST['except_6'];  if($except_6=='on') $except_6 = 1;
		$except_7 = $_REQUEST['except_7'];  if($except_7=='on') $except_7 = 1;
		$except_8 = $_REQUEST['except_8'];  if($except_8=='on') $except_8 = 1;

		$price_1 = $_REQUEST['price_1'];	$price_2 = $_REQUEST['price_2'];	$price_3 = $_REQUEST['price_3'];	$price_4 = $_REQUEST['price_4'];
		$price_5 = $_REQUEST['price_5'];	$price_6 = $_REQUEST['price_6'];	$price_7 = $_REQUEST['price_7'];	$price_8 = $_REQUEST['price_8'];

		$pay_1 = $_REQUEST['pay_1'];   $pay_2 = $_REQUEST['pay_2'];	$pay_3 = $_REQUEST['pay_3'];	$pay_4 = $_REQUEST['pay_4'];
		$pay_5 = $_REQUEST['pay_5'];	$pay_6 = $_REQUEST['pay_6'];	$pay_7 = $_REQUEST['pay_7'];	$pay_8 = $_REQUEST['pay_8'];
	

		$min_floor = $_REQUEST['min_floor'];
		$max_floor = $_REQUEST['max_floor'];
		
		$price_batch = $_REQUEST['price_batch'];	

		// 변수 다 받았으면 이제부터 시작
		if($mode=='reg'){ // 신규 등록이면
			 //기존에 등록되어 있는 동호수가 있는지 체크
			$ck_qry = "SELECT seq
						FROM cms_project_data
						WHERE pj_seq='$pj_seq' AND pj_dong='$dong' AND
							pj_ho IN ('$ho_1','$ho_2','$ho_3','$ho_4','$ho_5','$ho_6','$ho_7','$ho_8','$ho_9','$ho_10') ";
			$ck_rlt = mysql_query($ck_qry, $connect);
			$ck_row = mysql_fetch_array($ck_rlt);
			if($ck_row)err_msg('이미 등록되어 있는 동호수와 중복되는 동호수가 있습니다.');

			############# DB INSERT. #############
			if($_REQUEST['floor_1']){
				// echo "개별층 1 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_1', '$type_1', '$price_1', '$pay_1', '$except_1', now())";
				$result=mysql_query($query, $connect);
				if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.1');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($_REQUEST['floor_2']){
				// echo "개별층 2 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							 VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_2', '$type_2', '$price_2', '$pay_2', '$except_2', now())";
				 $result=mysql_query($query, $connect);
				 if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.2');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($_REQUEST['floor_3']){
				// echo "개별층 3 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							 VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_3', '$type_3', '$price_3', '$pay_3', '$except_3', now())";
				$result=mysql_query($query, $connect);
				if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.3');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($_REQUEST['floor_4']){
				// echo "개별층 4 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_4', '$type_4', '$price_4', '$pay_4', '$except_4', now())";
				$result=mysql_query($query, $connect);
				 if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.4');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($_REQUEST['floor_5']){
				// echo "개별층 5 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							 VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_5', '$type_5', '$price_5', '$pay_5', '$except_5', now())";
				$result=mysql_query($query, $connect);
				if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.5');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($_REQUEST['floor_6']){
				// echo "개별층 6 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							 VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_6', '$type_6', '$price_6', '$pay_6', '$except_6', now())";
				$result=mysql_query($query, $connect);
				if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.6');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($_REQUEST['floor_7']){
				// echo "개별층 7 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							 VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_7', '$type_7', '$price_7', '$pay_7', '$except_7', now())";
				$result=mysql_query($query, $connect);
				if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.7');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($_REQUEST['floor_8']){
				// echo "개별층 8 에 대한 쿼리 실행<br>";
				$query="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							 VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_8', '$type_8', '$price_8', '$pay_8', '$except_8', now())";
				$result=mysql_query($query, $connect);
				if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.8');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}

			if($min_floor&&$max_floor){
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range = range($min_floor, $max_floor);
				$fn= count($fl_range);  // 입력된 층의 개수

				for($i=0; $i<$fn; $i++){
					$ho_batch = $fl_range[$i].$line;

					$bat_qry="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong', '$ho_batch', '$type_batch', '$price_batch', '$pay_batch', '$except_batch', now())";
					$bat_rlt=mysql_query($bat_qry, $connect);
					if(!$bat_rlt) err_msg('데이터베이스 오류가 발생하였습니다.10');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			echo ("<script>
						window.alert('정상적으로 프로젝트 데이터 정보가 등록 되었습니다!');
					</script>");
			echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?m_di=1&s_di=1&new_pj=$pj_seq'>";



		}else if($mode=="end"){ // 데이터 등록 마감시

			$query1 =" UPDATE cms_project_info SET is_data_reg = '1' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 등록 마감 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?reg_pj=$seq'>";
			}


		}else if($mode=="re_reg"){ // 데이터 재등록 시

			$query1 =" UPDATE cms_project_info SET is_data_reg = '0' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 재등록 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?new_pj=$seq'>";
			}
		}else if($mode=="individual_reg"){ // 신규수주 프로그레스1 개별 등록 수정일 경우			
			$data = $_REQUEST['data'];
			$info = $_REQUEST['info'];
			// $data_cr = $_REQUEST['data_cr'];
			$dong = $_REQUEST['dong'];
			$ho = $_REQUEST['ho'];
			$type = $_REQUEST['type'];
			$price = $_REQUEST['price'];
			$pay = $_REQUEST['pay'];
			$is_except = $_REQUEST['is_except'];

			$query1 =" UPDATE cms_project_data SET pj_dong = '$dong',
														 pj_ho = '$ho',
														 type_ho = '$type',
														 price_ho = '$price',
														 pay_ho = '$pay',
														 is_except = '$is_except'

					WHERE seq = '$data' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터가 수정등록 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=progress1_edit.php?data=$data&info=$info'>";
			}
		}

	}else{ // 계약관리번호별 관리 데이터
		$sort_batch = $_REQUEST['sort_batch'];
		$diff_no = $_REQUEST['diff_no'];
		$min_con_no = $_REQUEST['min_con_no'];
		$max_con_no = $_REQUEST['max_con_no'];

		// 계약관리번호별 관리일 경우 DB작업 시작
		if($mode=='reg'){ // 신규 등록이면
			 
			 
			//기존에 등록되어 있는 계약관리번호가 있는지 체크 /// <----나중에 다시 체크
			$ck_qry = "SELECT seq FROM cms_project_data WHERE pj_seq='$pj_seq' AND con_no='$con_no' ";
			$ck_rlt = mysql_query($ck_qry, $connect);
			$ck_row = mysql_fetch_array($ck_rlt);
			 if($ck_row)err_msg('이미 등록되어 있는 계약관리번호와 중복되는 관리번호가 있습니다.');




			############# DB INSERT. #############
			if($min_con_no&&$max_con_no){

				$no_range = range($min_con_no, $max_con_no);
				$fn= count($no_range);  // 입력된 계약번호의 개수

				for($i=0; $i<$fn; $i++){
					$no_batch = $no_range[$i];

					$bat_qry="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `con_no`, `type_ho`, `sa_sort`, `diff_no`, `is_except`, `price_ho`, `pay_ho`, `reg_time`)

									VALUES('$pj_seq', '$pj_sort', '$no_batch', '$type_batch', '$sort_batch', '$diff_no', '$except_batch', '$price_batch', '$pay_batch', now())";
					$bat_rlt=mysql_query($bat_qry, $connect);
					if(!$bat_rlt) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			echo ("<script>
						window.alert('정상적으로 프로젝트 데이터 정보가 등록 되었습니다!');
					</script>");
			echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?m_di=1&s_di=1&new_pj=$pj_seq'>";



		}else if($mode=="end"){ // 데이터 등록 마감시

			$query1 =" UPDATE cms_project_info SET is_data_reg = '1' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 등록 마감 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?reg_pj=$seq'>";
			}


		}else if($mode=="re_reg"){ // 데이터 재등록 시

			$query1 =" UPDATE cms_project_info SET is_data_reg = '0' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 재등록 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?new_pj=$seq'>";
			}

		}else if($mode=="individual_reg"){ // 신규수주 프로그레스1 개별 등록 수정일 경우		
			$data = $_REQUEST['data'];
			$info = $_REQUEST['info'];
			// $data_cr = $_REQUEST['data_cr'];
			$con_no = $_REQUEST['con_no'];
			$sa_sort = $_REQUEST['sa_sort'];
			$diff_no = $_REQUEST['diff_no'];			
			$type = $_REQUEST['type'];	
			$is_except = $_REQUEST['is_except'];
			$price = $_REQUEST['price'];
			$pay = $_REQUEST['pay'];
			

			$query1 =" UPDATE cms_project_data SET con_no = '$con_no',
														sa_sort = '$sa_sort',
														diff_no = '$diff_no',
														type_ho = '$type',
														is_except = '$is_except',
														price_ho = '$price',
														pay_ho = '$pay'
					WHERE seq = '$data' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터가 수정등록 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=progress1_edit.php?data=$data&info=$info'>";
			}
		}
	}
?>