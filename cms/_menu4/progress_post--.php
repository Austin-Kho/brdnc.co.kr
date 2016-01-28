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
	$type_batch_1 = $_REQUEST['type_batch_1'];
	$except_batch_1 = $_REQUEST['except_batch_1'];
	if($except_batch_1=='on') $except_batch_1 = 1;

	$type_batch_2 = $_REQUEST['type_batch_2'];
	$except_batch_2 = $_REQUEST['except_batch_2'];
	if($except_batch_2=='on') $except_batch_2 = 1;

	$type_batch_3 = $_REQUEST['type_batch_3'];
	$except_batch_3 = $_REQUEST['except_batch_3'];
	if($except_batch_3=='on') $except_batch_3 = 1;

	$type_batch_4 = $_REQUEST['type_batch_4'];
	$except_batch_4 = $_REQUEST['except_batch_4'];
	if($except_batch_4=='on') $except_batch_4 = 1;

	$type_batch_5 = $_REQUEST['type_batch_5'];
	$except_batch_5 = $_REQUEST['except_batch_5'];
	if($except_batch_5=='on') $except_batch_5 = 1;

	$type_batch_6 = $_REQUEST['type_batch_6'];
	$except_batch_6 = $_REQUEST['except_batch_6'];
	if($except_batch_6=='on') $except_batch_6 = 1;



	if($data_cr == '0'){ // 동호수별 관리데이터
		// form(form1-post)에서 받은 데이터
		$dong_1 = $_REQUEST['dong_1']; $dong_2 = $_REQUEST['dong_2']; $dong_3 = $_REQUEST['dong_3'];
		$dong_4 = $_REQUEST['dong_4']; $dong_5 = $_REQUEST['dong_5']; $dong_6 = $_REQUEST['dong_6'];

		$line_1 = str_pad($_REQUEST['line_1'], 2, "0", STR_PAD_LEFT);
		$line_2 = str_pad($_REQUEST['line_2'], 2, "0", STR_PAD_LEFT);
		$line_3 = str_pad($_REQUEST['line_3'], 2, "0", STR_PAD_LEFT);
		$line_4 = str_pad($_REQUEST['line_4'], 2, "0", STR_PAD_LEFT);
		$line_5 = str_pad($_REQUEST['line_5'], 2, "0", STR_PAD_LEFT);
		$line_6 = str_pad($_REQUEST['line_6'], 2, "0", STR_PAD_LEFT);

		$min_floor_1 = $_REQUEST['min_floor_1']; $max_floor_1 = $_REQUEST['max_floor_1'];		
		$min_floor_2 = $_REQUEST['min_floor_2']; $max_floor_2 = $_REQUEST['max_floor_2'];		
		$min_floor_3 = $_REQUEST['min_floor_3']; $max_floor_3 = $_REQUEST['max_floor_3'];
		$min_floor_4 = $_REQUEST['min_floor_4']; $max_floor_3 = $_REQUEST['max_floor_4'];
		$min_floor_5 = $_REQUEST['min_floor_5']; $max_floor_3 = $_REQUEST['max_floor_5'];
		$min_floor_6 = $_REQUEST['min_floor_6']; $max_floor_3 = $_REQUEST['max_floor_6'];

		// 변수 다 받았으면 이제부터 시작
		if($mode=='reg'){ // 신규 등록이면
			 //기존에 등록되어 있는 동호수가 있는지 체크
			$ho_1 = $_REQUEST['floor_1'].$line;	$ho_2 = $_REQUEST['floor_2'].$line;	$ho_3 = $_REQUEST['floor_3'].$line;	$ho_4 = $_REQUEST['floor_4'].$line;
			$ho_5 = $_REQUEST['floor_5'].$line;	$ho_6 = $_REQUEST['floor_6'].$line;	$ho_7 = $_REQUEST['floor_7'].$line;	$ho_8 = $_REQUEST['floor_8'].$line;
			
			$ck_qry = "SELECT seq
						FROM cms_project_data
						WHERE pj_seq='$pj_seq' AND pj_dong='$dong' AND
							  pj_ho IN ('$ho_1','$ho_2','$ho_3','$ho_4','$ho_5','$ho_6','$ho_7','$ho_8','$ho_9','$ho_10') ";
			$ck_rlt = mysql_query($ck_qry, $connect);
			$ck_row = mysql_fetch_array($ck_rlt);
			if($ck_row)err_msg('이미 등록되어 있는 동호수와 중복되는 동호수가 있습니다.');


			############# DB INSERT. #############

			if($min_floor_1&&$max_floor_1){ //_1
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range_1 = range($min_floor_1, $max_floor_1);
				$fn_1= count($fl_range_1);  // 입력된 층의 개수

				for($i=0; $i<$fn_1; $i++){
					$ho_batch_1 = $fl_range_1[$i].$line_1;

					$bat_qry_1="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong_1', '$ho_batch_1', '$type_batch_1', '$price_batch_1', '$pay_batch_1', '$except_batch_1', now())";
					$bat_rlt_1=mysql_query($bat_qry_1, $connect);
					if(!$bat_rlt_1) err_msg('데이터베이스 오류가 발생하였습니다.10');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			if($min_floor_2&&$max_floor_2){ //_2
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range_2 = range($min_floor_2, $max_floor_2);
				$fn_2= count($fl_range_2);  // 입력된 층의 개수

				for($i=0; $i<$fn_2; $i++){
					$ho_batch_2 = $fl_range_2[$i].$line_2;

					$bat_qry_2="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong_2', '$ho_batch_2', '$type_batch_2', '$price_batch_2', '$pay_batch_2', '$except_batch_2', now())";
					$bat_rlt_2=mysql_query($bat_qry_2, $connect);
					if(!$bat_rlt_2) err_msg('데이터베이스 오류가 발생하였습니다.10');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			if($min_floor_3&&$max_floor_3){  //_3
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range_3 = range($min_floor_3, $max_floor_3);
				$fn_3= count($fl_range_3);  // 입력된 층의 개수

				for($i=0; $i<$fn_3; $i++){
					$ho_batch_3 = $fl_range_3[$i].$line_3;

					$bat_qry_3="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong_3', '$ho_batch_3', '$type_batch_3', '$price_batch_3', '$pay_batch_3', '$except_batch_3', now())";
					$bat_rlt_3=mysql_query($bat_qry_3, $connect);
					if(!$bat_rlt_3) err_msg('데이터베이스 오류가 발생하였습니다.10');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			if($min_floor_4&&$max_floor_4){  //_4
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range_4 = range($min_floor_4, $max_floor_4);
				$fn_4= count($fl_range_4);  // 입력된 층의 개수

				for($i=0; $i<$fn_4; $i++){
					$ho_batch_4 = $fl_range_4[$i].$line_4;

					$bat_qry_4="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong_4', '$ho_batch_4', '$type_batch_4', '$price_batch_4', '$pay_batch_4', '$except_batch_4', now())";
					$bat_rlt_4=mysql_query($bat_qry_4, $connect);
					if(!$bat_rlt_4) err_msg('데이터베이스 오류가 발생하였습니다.10');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			if($min_floor_5&&$max_floor_5){  //_5
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range_5 = range($min_floor_5, $max_floor_5);
				$fn_5= count($fl_range_5);  // 입력된 층의 개수

				for($i=0; $i<$fn_5; $i++){
					$ho_batch_5 = $fl_range_5[$i].$line_5;

					$bat_qry_5="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong_5', '$ho_batch_5', '$type_batch_5', '$price_batch_5', '$pay_batch_5', '$except_batch_5', now())";
					$bat_rlt_5=mysql_query($bat_qry_5, $connect);
					if(!$bat_rlt_5) err_msg('데이터베이스 오류가 발생하였습니다.10');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			if($min_floor_6&&$max_floor_6){  //_6
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range_6 = range($min_floor_6, $max_floor_6);
				$fn_6= count($fl_range_6);  // 입력된 층의 개수

				for($i=0; $i<$fn_6; $i++){
					$ho_batch_6 = $fl_range_6[$i].$line_6;

					$bat_qry_6="INSERT INTO `cms_project_data` ( `pj_seq`, `pj_sort`, `pj_dong`, `pj_ho`, `type_ho`, `price_ho`, `pay_ho`, `is_except`, `reg_time`)

							VALUES('$pj_seq', '$pj_sort', '$dong_6', '$ho_batch_6', '$type_batch_6', '$price_batch_6', '$pay_batch_6', '$except_batch_6', now())";
					$bat_rlt_6=mysql_query($bat_qry_6, $connect);
					if(!$bat_rlt_6) err_msg('데이터베이스 오류가 발생하였습니다.10');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}

			echo ("<script>
						window.alert('정상적으로 프로젝트 데이터 정보가 등록 되었습니다!');
					</script>");
			echo "<meta http-equiv='Refresh' content='0; URL=project_main.php?m_di=1&s_di=1&new_pj=$pj_seq'>";



		}else if($mode=="end"){ // 데이터 등록 마감시

			$query1 =" UPDATE cms_project1_info SET is_data_reg = '1' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 등록 마감 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=project_main.php?reg_pj=$seq'>";
			}


		}else if($mode=="re_reg"){ // 데이터 재등록 시

			$query1 =" UPDATE cms_project1_info SET is_data_reg = '0' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 재등록 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=project_main.php?new_pj=$seq'>";
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
			echo "<meta http-equiv='Refresh' content='0; URL=project_main.php?m_di=1&s_di=1&new_pj=$pj_seq'>";



		}else if($mode=="end"){ // 데이터 등록 마감시

			$query1 =" UPDATE cms_project1_info SET is_data_reg = '1' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 등록 마감 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=project_main.php?reg_pj=$seq'>";
			}


		}else if($mode=="re_reg"){ // 데이터 재등록 시

			$query1 =" UPDATE cms_project1_info SET is_data_reg = '0' WHERE seq = '$seq' ";
			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면
			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			} else {
				echo ("<script>
							window.alert('정상적으로 데이터 재등록 처리 되었습니다!');
						</script>");
				echo "<meta http-equiv='Refresh' content='0; URL=project_main.php?new_pj=$seq'>";
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