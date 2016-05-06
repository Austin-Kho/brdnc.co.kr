<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?

	// 신규등록인지 수정인지 체크변수
	$mode=$_REQUEST['mode'];
	if(!$mode) $mode="reg";

	// 등록 현장 구분
	$pj_seq = $_REQUEST['pj_seq'];
	$pj_sort = $_REQUEST['pj_sort'];
	$seq = $_REQUEST['seq'];
	$diff_no = $_REQUEST['diff_no'];

	// form(form1-post)에서 받은 데이터
	if(!$diff_no) $diff_no = 1;
	// 동 데이터
	$dong_1 = $_REQUEST['dong_1']; $dong_2 = $_REQUEST['dong_2']; $dong_3 = $_REQUEST['dong_3'];
	$dong_4 = $_REQUEST['dong_4']; $dong_5 = $_REQUEST['dong_5']; $dong_6 = $_REQUEST['dong_6'];
	$dong = array ($dong_1, $dong_2, $dong_3, $dong_4, $dong_5, $dong_6);

	// 라인 데이터
	$line_1 = str_pad($_REQUEST['line_1'], 2, "0", STR_PAD_LEFT);
	$line_2 = str_pad($_REQUEST['line_2'], 2, "0", STR_PAD_LEFT);
	$line_3 = str_pad($_REQUEST['line_3'], 2, "0", STR_PAD_LEFT);
	$line_4 = str_pad($_REQUEST['line_4'], 2, "0", STR_PAD_LEFT);
	$line_5 = str_pad($_REQUEST['line_5'], 2, "0", STR_PAD_LEFT);
	$line_6 = str_pad($_REQUEST['line_6'], 2, "0", STR_PAD_LEFT);
	$line = array($line_1, $line_2, $line_3, $line_4, $line_5, $line_6);

	// 타입 데이터
	$type_1 = $_REQUEST['type_1'];	$type_2 = $_REQUEST['type_2'];	$type_3 = $_REQUEST['type_3'];
	$type_4 = $_REQUEST['type_4'];	$type_5 = $_REQUEST['type_5'];	$type_6 = $_REQUEST['type_6'];
	$type = array($type_1, $type_2, $type_3, $type_4, $type_5, $type_6);

	// 층 데이터
	$min_floor_1 = $_REQUEST['min_floor_1']; $max_floor_1 = $_REQUEST['max_floor_1'];
	$min_floor_2 = $_REQUEST['min_floor_2']; $max_floor_2 = $_REQUEST['max_floor_2'];
	$min_floor_3 = $_REQUEST['min_floor_3']; $max_floor_3 = $_REQUEST['max_floor_3'];
	$min_floor_4 = $_REQUEST['min_floor_4']; $max_floor_4 = $_REQUEST['max_floor_4'];
	$min_floor_5 = $_REQUEST['min_floor_5']; $max_floor_5 = $_REQUEST['max_floor_5'];
	$min_floor_6 = $_REQUEST['min_floor_6']; $max_floor_6 = $_REQUEST['max_floor_6'];
	$min_floor = array($min_floor_1, $min_floor_2, $min_floor_3, $min_floor_4, $min_floor_5, $min_floor_6);
	$max_floor = array($max_floor_1, $max_floor_2, $max_floor_3, $max_floor_4, $max_floor_5, $max_floor_6);


	for($j=0; $j<6; $j++ ){

		if($min_floor[$j]&&$max_floor[$j]){

			$fl_range[$j] = range($min_floor[$j], $max_floor[$j]);
			$fn[$j]= count($fl_range[$j]);  // 입력된 층의 개수

			for($i=0; $i<$fn[$j]; $i++){
				$ho[$j] = $fl_range[$j][$i].$line[$j];

				//기존에 등록되어 있는 동호수가 있는지 체크
				$ck_qry = "SELECT seq
					FROM cms_project2_indi_table
					WHERE pj_seq='$pj_seq' AND dong='$dong[$j]' AND	ho ='$ho[$j]'";
				$ck_rlt = mysql_query($ck_qry, $connect);
				$ck_row = mysql_fetch_array($ck_rlt);
				if($ck_row)err_msg('이미 등록되어 있는 동호수와 중복되는 동호수가 있습니다.');
			}
		}
	}

	// 기분양(제외세대) 데이터
	$hold_1 = $_REQUEST['hold_1'];	if($hold_1=='on') $hold_1 = 1;
	$hold_2 = $_REQUEST['hold_2'];	if($hold_2=='on') $hold_2 = 1;
	$hold_3 = $_REQUEST['hold_3'];	if($hold_3=='on') $hold_3 = 1;
	$hold_4 = $_REQUEST['hold_4'];	if($hold_4=='on') $hold_4 = 1;
	$hold_5 = $_REQUEST['hold_5'];	if($hold_5=='on') $hold_5 = 1;
	$hold_6 = $_REQUEST['hold_6'];	if($hold_6=='on') $hold_6 = 1;
	$hold = array($hold_1, $hold_2, $hold_3, $hold_4, $hold_5, $hold_6);



	//// 동호수 데이터 입력 이제부터 시작
	if($mode=='reg'){ // 데이터 등록 모드

		############# DB INSERT. #############
		for($j=0; $j<6; $j++){

			if($min_floor[$j]&&$max_floor[$j]){ //[$j]
				// echo "일괄 등록 층에 대한 쿼리 실행<br>";

				$fl_range[$j] = range($min_floor[$j], $max_floor[$j], 1);
				$fn[$j]= count($fl_range[$j]);  // 입력된 층의 개수

				for($i=0; $i<$fn[$j]; $i++){
					$ho[$j] = $fl_range[$j][$i].$line[$j];
					$floor = $fl_range[$j][$i];

					$bat_qry="INSERT INTO `cms_project2_indi_table` ( `pj_seq`, `diff_no`, `type`, `dong`, `ho`, `floor`, `line`, `is_hold`, `reg_time`)
									        VALUES('$pj_seq', '$diff_no', '$type[$j]', '$dong[$j]', '$ho[$j]', '$floor', '$line[$j]', '$hold[$j]', now())";

					//echo $bat_qry."<br>";
					$bat_rlt=mysql_query($bat_qry, $connect);
					if(!$bat_rlt) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				}
			}
		}
		echo ("<script>
					window.alert('정상적으로 프로젝트 데이터 정보가 등록 되었습니다!');
				</script>");
		echo "<meta http-equiv='Refresh' content='0; URL=project_main.php?m_di=1&s_di=1&new_pj=$pj_seq'>";



	}else if($mode=="end"){ // 데이터 등록 마감

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

	}else if($mode=="re_reg"){ // 데이터 재등록

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
		$data = $_REQUEST['data']; // 일련번호
		$info = $_REQUEST['info']; // 되돌아갈 페이지에 전달할 변수
		// $data_cr = $_REQUEST['data_cr'];
		$dong = $_REQUEST['dong'];
		$ho = $_REQUEST['ho'];
		$type = $_REQUEST['type'];
		//$price = $_REQUEST['price'];
		//$pay = $_REQUEST['pay'];
		//$is_except = $_REQUEST['is_except'];

		$query1 =" UPDATE cms_project2_indi_table SET dong = '$dong',
					        				          ho = '$ho',
											          type = '$type'
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
?>
