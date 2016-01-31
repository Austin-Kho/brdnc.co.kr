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
	/********* 공통변수 **********/
	$s_di = $_REQUEST['s_di'];
	$mode=$_REQUEST['mode'];
	$pj_seq = $_REQUEST['pj_seq'];
	$headq = $_REQUEST['headq'];
	$team = $_REQUEST['team'];

	$writer = $_SESSION['p_id']; //작성자
	$writer_where = $headq."-".$team; //작성자 소속

	$work_date = $_REQUEST['work_date']; //작성일

	$seq = $_REQUEST['seq'];  // 수정 시 공통변수
	/********* 공통변수 **********/


	if($s_di==1){ // 고객 상담일지
		//////////변수 저장//////////
		$cust_name = $_REQUEST['cust_name'];
		$cust_tel1 = $_REQUEST['cust_tel1'];
		$cust_tel2 = $_REQUEST['cust_tel2'];
		$coun_route = $_REQUEST['coun_route'];
		$favor_type = $_REQUEST['favor_type'];
		$live_where = $_REQUEST['live_where'];
		$inte_degree = $_REQUEST['inte_degree'];
		$content = $_REQUEST['content'];
		$memo = $_REQUEST['memo'];
		$coun_date = $_REQUEST['coun_date'];
		$worker_where = $_REQUEST['worker_where'];



		if($mode=='reg'){ // 고객 상담일지 등록(1)
			// 등록 고객 중 동일한 연락처 고객이 있는지 확인 ///
			$qry = "SELECT seq FROM cms_work_coun_log WHERE cust_tel1='$cust_tel1' OR cust_tel1='$cust_tel2' OR  cust_tel2='$cust_tel1' OR cust_tel2='$cust_tel2'";
			//$rlt = mysql_query($qry, $connect);
			//$row = mysql_fetch_array($rlt);

			if($row) {
				//err_msg('이미 등록 된 고객 연락처 입니다.');
			}else{
				### 고객 상담일지 테이블에 입력 값을 입력한다. ###


				 $qry1 = "INSERT INTO `cms_work_coun_log` ( `cust_name`, `cust_tel1`, `cust_tel2`, `coun_route`, `favor_type`, `live_where`, `inte_degree`, `content`, `memo`, `coun_date`, `worker_id`, `worker_name`, `worker_where`  )
							 VALUES('$cust_name', '$cust_tel1', '$cust_tel2', '$coun_route', '$favor_type', '$live_where', '$inte_degree', '$content', '$memo', '$coun_date', '$_SESSION[p_id]', '$_SESSION[p_name]', '$worker_where' )";


				$rlt1 = mysql_query($qry1, $connect);

				////저장 과정에서 오류가 생기면
				if(!$rlt1){
					 err_msg('데이터베이스 오류가 발생하였습니다.dddd.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					msg('정상적으로 고객 상담일지가 등록 되었습니다!');
					echo "<meta http-equiv='Refresh' content='0; URL=work_main.php?m_di=1&s_di=1'>";
				}
			}
		}



		if($mode=='modify'){ // 고객 상담일지 내용 추가(1)

			### 고객 상담일지 테이블에 추가 상담 내용을 입력한다. ###
			$query1 ="UPDATE cms_work_coun_log SET cust_name='$cust_name',
																		 cust_tel1='$cust_tel1',
																		 cust_tel2='$cust_tel2 ',
																		 coun_route='$coun_route',
																		 favor_type='$favor_type',
																		 live_where='$live_where',
																		 inte_degree='$inte_degree',
																		 content='$content',
																		 memo='$memo',
																		 coun_date='$coun_date',
																		 worker_id='$_SESSION[p_id]',
																		 worker_name='$_SESSION[p_name]',
																		 worker_where='$worker_where'
															WHERE seq='$seq' ";

			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면

			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else {
				msg('정상적으로 고객 상담일지의 내용이 추가 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=work_main.php?m_di=1&s_di=1'>";
			}
		}

	}


	else if($s_di==2){ // 업무일지(2)
		//////////변수 저장//////////
		$work_num = $_REQUEST['work_num']; //출근인원
		$pro_cont_num = $_REQUEST['pro_cont_num']; // 당일 청약건수
		$pro_cont_c_num = $_REQUEST['pro_cont_c_num']; //당일 청약해지건수
		$cont_num = $_REQUEST['cont_num']; //당일 계약건수

		// 청약/청약해지/계약 구분
		$co_sort = $co_sort_1 = $_REQUEST['co_sort_1'];
		if($_REQUEST['co_sort_2']) $co_sort .= "/".$_REQUEST['co_sort_2'];
		if($_REQUEST['co_sort_3']) $co_sort .= "/".$_REQUEST['co_sort_3'];
		if($_REQUEST['co_sort_4']) $co_sort .= "/".$_REQUEST['co_sort_4'];
		if($_REQUEST['co_sort_5']) $co_sort .= "/".$_REQUEST['co_sort_5'];
		if($_REQUEST['co_sort_6']) $co_sort .= "/".$_REQUEST['co_sort_6'];
		if($_REQUEST['co_sort_7']) $co_sort .= "/".$_REQUEST['co_sort_7'];
		if($_REQUEST['co_sort_8']) $co_sort .= "/".$_REQUEST['co_sort_8'];
		if($_REQUEST['co_sort_9']) $co_sort .= "/".$_REQUEST['co_sort_9'];
		if($_REQUEST['co_sort_10']) $co_sort .= "/".$_REQUEST['co_sort_10'];
		if($_REQUEST['co_sort_11']) $co_sort .= "/".$_REQUEST['co_sort_11'];
		if($_REQUEST['co_sort_12']) $co_sort .= "/".$_REQUEST['co_sort_12'];

		//청약/청약해지/계약 고객명
		$c_cust_name = str_replace("/",", ", $_REQUEST['c_cust_name_1']);
		if($_REQUEST['co_sort_2']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_2']);
		if($_REQUEST['co_sort_3']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_3']);
		if($_REQUEST['co_sort_4']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_4']);
		if($_REQUEST['co_sort_5']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_5']);
		if($_REQUEST['co_sort_6']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_6']);
		if($_REQUEST['co_sort_7']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_7']);
		if($_REQUEST['co_sort_8']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_8']);
		if($_REQUEST['co_sort_9']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_9']);
		if($_REQUEST['co_sort_10']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_10']);
		if($_REQUEST['co_sort_11']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_11']);
		if($_REQUEST['co_sort_12']) $c_cust_name .= "/".str_replace("/",", ", $_REQUEST['c_cust_name_12']);

		// 청약/청약해지/계약 동호수
		$dong_ho = $_REQUEST['dong_1']."-".$_REQUEST['ho_1'];
		if($_REQUEST['co_sort_2']) $dong_ho .= "/".$_REQUEST['dong_2']."-".$_REQUEST['ho_2'];
		if($_REQUEST['co_sort_3']) $dong_ho .= "/".$_REQUEST['dong_3']."-".$_REQUEST['ho_3'];
		if($_REQUEST['co_sort_4']) $dong_ho .= "/".$_REQUEST['dong_4']."-".$_REQUEST['ho_4'];
		if($_REQUEST['co_sort_5']) $dong_ho .= "/".$_REQUEST['dong_5']."-".$_REQUEST['ho_5'];
		if($_REQUEST['co_sort_6']) $dong_ho .= "/".$_REQUEST['dong_6']."-".$_REQUEST['ho_6'];
		if($_REQUEST['co_sort_7']) $dong_ho .= "/".$_REQUEST['dong_7']."-".$_REQUEST['ho_7'];
		if($_REQUEST['co_sort_8']) $dong_ho .= "/".$_REQUEST['dong_8']."-".$_REQUEST['ho_8'];
		if($_REQUEST['co_sort_9']) $dong_ho .= "/".$_REQUEST['dong_9']."-".$_REQUEST['ho_9'];
		if($_REQUEST['co_sort_10']) $dong_ho .= "/".$_REQUEST['dong_10']."-".$_REQUEST['ho_10'];
		if($_REQUEST['co_sort_11']) $dong_ho .= "/".$_REQUEST['dong_11']."-".$_REQUEST['ho_11'];
		if($_REQUEST['co_sort_12']) $dong_ho .= "/".$_REQUEST['dong_12']."-".$_REQUEST['ho_12'];

		//청약시 계약 예정일
		$due_date = $_REQUEST['due_date_1'];
		if($_REQUEST['co_sort_2']) $due_date .= "/".$_REQUEST['due_date_2'];
		if($_REQUEST['co_sort_3']) $due_date .= "/".$_REQUEST['due_date_3'];
		if($_REQUEST['co_sort_4']) $due_date .= "/".$_REQUEST['due_date_4'];
		if($_REQUEST['co_sort_5']) $due_date .= "/".$_REQUEST['due_date_5'];
		if($_REQUEST['co_sort_6']) $due_date .= "/".$_REQUEST['due_date_6'];
		if($_REQUEST['co_sort_7']) $due_date .= "/".$_REQUEST['due_date_7'];
		if($_REQUEST['co_sort_8']) $due_date .= "/".$_REQUEST['due_date_8'];
		if($_REQUEST['co_sort_9']) $due_date .= "/".$_REQUEST['due_date_9'];
		if($_REQUEST['co_sort_10']) $due_date .= "/".$_REQUEST['due_date_10'];
		if($_REQUEST['co_sort_11']) $due_date .= "/".$_REQUEST['due_date_11'];
		if($_REQUEST['co_sort_12']) $due_date .= "/".$_REQUEST['due_date_12'];

		// 청약/청약해지/계약 담당직원
		$c_worker = str_replace("/",", ", $_REQUEST['c_worker_1']);
		if($_REQUEST['co_sort_2']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_2']);
		if($_REQUEST['co_sort_3']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_3']);
		if($_REQUEST['co_sort_4']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_4']);
		if($_REQUEST['co_sort_5']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_5']);
		if($_REQUEST['co_sort_6']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_6']);
		if($_REQUEST['co_sort_7']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_7']);
		if($_REQUEST['co_sort_8']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_8']);
		if($_REQUEST['co_sort_9']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_9']);
		if($_REQUEST['co_sort_10']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_10']);
		if($_REQUEST['co_sort_11']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_11']);
		if($_REQUEST['co_sort_12']) $c_worker .= "/".str_replace("/",", ", $_REQUEST['c_worker_12']);


		$h_wa_num = $_REQUEST['h_wa_num']; // 당일 일반방문자수
		$h_ca_num = $_REQUEST['h_ca_num']; // 당일 본부 콜수
		$tm_num = $_REQUEST['tm_num']; // 당일 TM 건수
		$t_wa_num = $_REQUEST['t_wa_num']; // 당일 지명방문자수
		$t_ca_num = $_REQUEST['t_ca_num']; // 당일 팀 콜수
		$dm_sms_num = $_REQUEST['dm_sms_num']; // 당일 디엠/SMS 발송건수

		//당일 주요고객 진행사항 고객명
		$d_cust_name = str_replace("/",", ", $_REQUEST['d_cust_name_1']);
		if($_REQUEST['d_cust_name_2']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_2']);
		if($_REQUEST['d_cust_name_3']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_3']);
		if($_REQUEST['d_cust_name_4']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_4']);
		if($_REQUEST['d_cust_name_5']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_5']);
		if($_REQUEST['d_cust_name_6']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_6']);
		if($_REQUEST['d_cust_name_7']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_7']);
		if($_REQUEST['d_cust_name_8']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_8']);
		if($_REQUEST['d_cust_name_9']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_9']);
		if($_REQUEST['d_cust_name_10']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_10']);
		if($_REQUEST['d_cust_name_11']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_11']);
		if($_REQUEST['d_cust_name_12']) $d_cust_name .= "/".str_replace("/",", ", $_REQUEST['d_cust_name_12']);

		//당일 주요고객 진행사항 진행사항
		$d_content = str_replace("/",", ", $_REQUEST['d_content_1']);
		if($_REQUEST['d_cust_name_2']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_2']);
		if($_REQUEST['d_cust_name_3']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_3']);
		if($_REQUEST['d_cust_name_4']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_4']);
		if($_REQUEST['d_cust_name_5']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_5']);
		if($_REQUEST['d_cust_name_6']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_6']);
		if($_REQUEST['d_cust_name_7']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_7']);
		if($_REQUEST['d_cust_name_8']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_8']);
		if($_REQUEST['d_cust_name_9']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_9']);
		if($_REQUEST['d_cust_name_10']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_10']);
		if($_REQUEST['d_cust_name_11']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_11']);
		if($_REQUEST['d_cust_name_12']) $d_content .= "/".str_replace("/",", ", $_REQUEST['d_content_12']);

		//당일 주요고객 진행사항 담당자
		$d_worker = str_replace("/",", ", $_REQUEST['d_worker_1']);
		if($_REQUEST['d_cust_name_2']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_2']);
		if($_REQUEST['d_cust_name_3']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_3']);
		if($_REQUEST['d_cust_name_4']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_4']);
		if($_REQUEST['d_cust_name_5']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_5']);
		if($_REQUEST['d_cust_name_6']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_6']);
		if($_REQUEST['d_cust_name_7']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_7']);
		if($_REQUEST['d_cust_name_8']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_8']);
		if($_REQUEST['d_cust_name_9']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_9']);
		if($_REQUEST['d_cust_name_10']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_10']);
		if($_REQUEST['d_cust_name_11']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_11']);
		if($_REQUEST['d_cust_name_12']) $d_worker .= "/".str_replace("/",", ", $_REQUEST['d_worker_12']);

		$d_sale_act = $_REQUEST['d_sale_act']; // 당일 영업 활동

		//익일 방문예정고객 고객명
		$n_cust_name = str_replace("/",", ", $_REQUEST['n_cust_name_1']);
		if($_REQUEST['n_cust_name_2']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_2']);
		if($_REQUEST['n_cust_name_3']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_3']);
		if($_REQUEST['n_cust_name_4']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_4']);
		if($_REQUEST['n_cust_name_5']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_5']);
		if($_REQUEST['n_cust_name_6']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_6']);
		if($_REQUEST['n_cust_name_7']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_7']);
		if($_REQUEST['n_cust_name_8']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_8']);
		if($_REQUEST['n_cust_name_9']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_9']);
		if($_REQUEST['n_cust_name_10']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_10']);
		if($_REQUEST['n_cust_name_11']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_11']);
		if($_REQUEST['n_cust_name_12']) $n_cust_name .= "/".str_replace("/",", ", $_REQUEST['n_cust_name_12']);

		//익일 방문예정고객 진행내용/예정시간/연락처
		$n_content = str_replace("/",", ", $_REQUEST['n_content_1']);
		if($_REQUEST['n_cust_name_2']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_2']);
		if($_REQUEST['n_cust_name_3']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_3']);
		if($_REQUEST['n_cust_name_4']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_4']);
		if($_REQUEST['n_cust_name_5']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_5']);
		if($_REQUEST['n_cust_name_6']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_6']);
		if($_REQUEST['n_cust_name_7']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_7']);
		if($_REQUEST['n_cust_name_8']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_8']);
		if($_REQUEST['n_cust_name_9']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_9']);
		if($_REQUEST['n_cust_name_10']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_10']);
		if($_REQUEST['n_cust_name_11']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_11']);
		if($_REQUEST['n_cust_name_12']) $n_content .= "/".str_replace("/",", ", $_REQUEST['n_content_12']);

		//익일 방문예정고객 담당자
		$n_worker = str_replace("/",", ", $_REQUEST['n_worker_1']);
		if($_REQUEST['n_cust_name_2']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_2']);
		if($_REQUEST['n_cust_name_3']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_3']);
		if($_REQUEST['n_cust_name_4']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_4']);
		if($_REQUEST['n_cust_name_5']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_5']);
		if($_REQUEST['n_cust_name_6']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_6']);
		if($_REQUEST['n_cust_name_7']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_7']);
		if($_REQUEST['n_cust_name_8']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_8']);
		if($_REQUEST['n_cust_name_9']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_9']);
		if($_REQUEST['n_cust_name_10']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_10']);
		if($_REQUEST['n_cust_name_11']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_11']);
		if($_REQUEST['n_cust_name_12']) $n_worker .= "/".str_replace("/",", ", $_REQUEST['n_worker_12']);

		$n_sale_plan = $_REQUEST['n_sale_plan']; // 익일 영업 계획

		if($mode=='reg'){ // 업무일지 등록(2)
			//동일한 날짜에 등록된 데이터가 있는지 확인 ///

			$qry = "SELECT seq FROM cms_work_log WHERE pj_seq='$pj_seq' AND pj_where='$writer_where' AND work_date='$work_date' ";
			$rlt = mysql_query($qry, $connect);
			$row = mysql_fetch_array($rlt);
			if($row) {
				err_msg('해당 일자의 업무일지는 이미 작성되어 있습니다.');

			}else{

				### 직원 정보 테이블에 입력 값을 입력한다. ###
				$qry1 = "INSERT INTO `cms_work_log` (`pj_seq`, `writer`, `pj_where`, `work_date`, `work_num`, `pro_cont_num`, `pro_cont_c_num`, `cont_num`, `co_sort`, `c_cust_name`, `dong_ho`, `due_date`, `c_worker`, `h_wa_num`, `h_ca_num`, `tm_num`, `t_wa_num`, `t_ca_num`, `dm_sms_num`, `d_cust_name`, `d_content`, `d_worker`, `d_sale_act`, `n_cust_name`, `n_content`, `n_worker`, `n_sale_plan`)
								 VALUES('$pj_seq', '$writer', '$writer_where', '$work_date', '$work_num', '$pro_cont_num', '$pro_cont_c_num', '$cont_num', '$co_sort', '$c_cust_name', '$dong_ho', '$due_date', '$c_worker', '$h_wa_num', '$h_ca_num', '$tm_num', '$t_wa_num', '$t_ca_num', '$dm_sms_num', '$d_cust_name', '$d_content', '$d_worker', '$d_sale_act', '$n_cust_name', '$n_content', '$n_worker', '$n_sale_plan')";
				$rlt1 = mysql_query($qry1, $connect);

				////저장 과정에서 오류가 생기면
				if(!$rlt1){
					 err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					msg('정상적으로 업무일지가 등록 되었습니다!');
					echo "<meta http-equiv='Refresh' content='0; URL=work_main.php?m_di=1&s_di=2'>";
				}
			}
		}




		if($mode=='modify'){ // 업무일지 수정(2)

			### 직원 정보 테이블에 입력 값을 수정한다. ###
			$query1 ="UPDATE cms_work_log SET pj_seq='$pj_seq',
																			  writer='$writer',
																			  pj_where='$writer_where ',
																			  work_date='$work_date',
																			  work_num='$work_num',
																			  pro_cont_num='$pro_cont_num',
																			  pro_cont_c_num='$pro_cont_c_num',
																			  cont_num='$cont_num',
																				co_sort='$co_sort',
																				c_cust_name='$c_cust_name',
																				dong_ho='$dong_ho',
																				due_date='$due_date',
																				c_worker='$c_worker',
																				h_wa_num='$h_wa_num',
																				h_ca_num='$h_ca_num',
																				tm_num='$tm_num',
																				t_wa_num='$t_wa_num',
																				t_ca_num='$t_ca_num',
																				dm_sms_num='$dm_sms_num',
																				d_cust_name='$d_cust_name',
																				d_content='$d_content',
																				d_worker='$d_worker',
																				d_sale_act='$d_sale_act',
																				n_cust_name='$n_cust_name',
																				n_content='$n_content',
																				n_worker='$n_worker',
																				n_sale_plan='$n_sale_plan'
														WHERE seq='$seq' ";

			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면

			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else {
				msg('정상적으로 업무일지가 수정 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=work_main.php?m_di=1&s_di=2'>";
			}
		}
	}

	/*

	else if($s_di==3){ // 시행사 업무보고
		//////////변수 저장//////////
		$seq = $_REQUEST['seq'];

		$si_name = $_REQUEST['si_name'];
		$acc_cla = $_REQUEST['acc_cla'];
		$main_tel = $_REQUEST['main_tel'];
		$main_fax = $_REQUEST['main_fax'];
		$main_web = $_REQUEST['main_web'];
		$web_name = $_REQUEST['web_name'];
		$res_div = $_REQUEST['res_div'];
		$res_worker = $_REQUEST['res_worker'];
		$res_mobile = $_REQUEST['res_mobile'];
		$res_email = $_REQUEST['res_email'];
		$tax_no = $_REQUEST['tax_no'];
		$tax_ceo = $_REQUEST['tax_ceo'];
		$tax_addr = $_REQUEST['zipcode1']."/".$_REQUEST['zipcode2']."/".$_REQUEST['address1']."/".$_REQUEST['address2'];
		$tax_uptae = $_REQUEST['tax_uptae'];
		$tax_jongmok = $_REQUEST['tax_jongmok'];
		$tax_worker = $_REQUEST['tax_worker'];
		$tax_email = $_REQUEST['tax_email'];
		$note = $_REQUEST['note'];

		if($mode=='reg'){ // 거래처 정보 등록(3)
			//// 등록 거래처 중 동일한 거래처가 있는지 확인 ///
			if($tax_no) $tax_no_add = " OR tax_no='$tax_no' ";
			$qry = "SELECT seq FROM cms_accounts WHERE si_name='$si_name' AND main_tel='$main_tel' $tax_no_add ";
			$rlt = mysql_query($qry, $connect);
			$row = mysql_fetch_array($rlt);
			if($row) {
				err_msg('이미 등록 된 거래처 입니다.');
			}else{
				### 거래처 정보 테이블에 입력 값을 입력한다. ###
				$qry1 = "INSERT INTO `cms_accounts` ( `si_name`, `acc_cla`, `main_tel`, `main_fax`, `main_web`, `web_name`, `res_div`, `res_worker`, `res_mobile`, `res_email`, `tax_no`, `tax_ceo`, `tax_addr`, `tax_uptae`, `tax_jongmok`, `tax_worker`, `tax_email`, `note`, `reg_date`)
								 VALUES('$si_name', '$acc_cla', '$main_tel', '$main_fax', '$main_web', '$web_name', '$res_div', '$res_worker', '$res_mobile', '$res_email', '$tax_no', '$tax_ceo', '$tax_addr', '$tax_uptae', '$tax_jongmok', '$tax_worker', '$tax_email', '$note', now())";
				$rlt1 = mysql_query($qry1, $connect);

				////저장 과정에서 오류가 생기면
				if(!$rlt1){
					 err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					msg('정상적으로 거래처 정보가 등록 되었습니다!');
					echo "<meta http-equiv='Refresh' content='0; URL=work_main.php?m_di=1&s_di=3'>";
				}
			}
		}

		if($mode=='modify'){ // 거래처 정보 수정(3)

			### 거래처 정보 테이블에 입력 값을 수정한다. ###
			$query1 =" UPDATE cms_accounts SET si_name='$si_name',
														acc_cla='$acc_cla',
														main_tel='$main_tel',
														main_fax='$main_fax',
														main_web='$main_web',
														web_name='$web_name',
														res_div='$res_div',
														res_worker='$res_worker',
														res_mobile='$res_mobile',
														res_email='$res_email',
														tax_no='$tax_no',
														tax_ceo='$tax_ceo',
														tax_addr='$tax_addr',
														tax_uptae='$tax_uptae',
														tax_jongmok='$tax_jongmok',
														tax_worker='$tax_worker',
														tax_email='$tax_email',
														note='$note',
														reg_date=now()
							    WHERE seq='$seq' ";

			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면

			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else {
				msg('정상적으로 거래처 정보가 변경 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=work_main.php?m_di=1&s_di=3'>";
			}
		}
		if($mode=='del'){ // 거래처 정보 개별 삭제(3)

			$qry="DELETE FROM cms_accounts WHERE seq='$seq' ";
			$res=mysql_query($qry, $connect);

			if(!$res){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else{
				msg('정상적으로 거래처 정보가 삭제 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=work_main.php?m_di=1&s_di=3'>";
			}
		}
	}
	*/
?>
