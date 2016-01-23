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
	$page_code=$_REQUEST['page_code'];

	// form(form1-post)에서 받은 데이터
	$seq = $_REQUEST['seq'];
	$pj_name = $_REQUEST['pj_name'];
	$sort = $_REQUEST['sort'];
	$data_cr = $_REQUEST['data_cr'];
	$address=$_REQUEST['zipcode']."/".$_REQUEST['address1']."/".$_REQUEST['address2'];
	$local_tel = $_REQUEST['local_tel'];
	$local_fax = $_REQUEST['local_fax'];
	$pj_manager = $_REQUEST['pj_manager'];

	// 타입 형
	$type = $_REQUEST['type_1'];
	if($_REQUEST['type_2']) $type .= "-".$_REQUEST['type_2'];
	if($_REQUEST['type_3']) $type .= "-".$_REQUEST['type_3'];
	if($_REQUEST['type_4']) $type .= "-".$_REQUEST['type_4'];
	if($_REQUEST['type_5']) $type .= "-".$_REQUEST['type_5'];
	if($_REQUEST['type_6']) $type .= "-".$_REQUEST['type_6'];
	if($_REQUEST['type_7']) $type .= "-".$_REQUEST['type_7'];
	if($_REQUEST['type_8']) $type .= "-".$_REQUEST['type_8'];
	if($_REQUEST['type_9']) $type .= "-".$_REQUEST['type_9'];
	if($_REQUEST['type_10']) $type .= "-".$_REQUEST['type_10'];
	if($_REQUEST['type_11']) $type .= "-".$_REQUEST['type_11'];

	// 타입 컬러
	$color = $_REQUEST['color_1'];
	if($_REQUEST['color_2']) $color .= "-".$_REQUEST['color_2'];
	if($_REQUEST['color_3']) $color .= "-".$_REQUEST['color_3'];
	if($_REQUEST['color_4']) $color .= "-".$_REQUEST['color_4'];
	if($_REQUEST['color_5']) $color .= "-".$_REQUEST['color_5'];
	if($_REQUEST['color_6']) $color .= "-".$_REQUEST['color_6'];
	if($_REQUEST['color_7']) $color .= "-".$_REQUEST['color_7'];
	if($_REQUEST['color_8']) $color .= "-".$_REQUEST['color_8'];
	if($_REQUEST['color_9']) $color .= "-".$_REQUEST['color_9'];
	if($_REQUEST['color_10']) $color .= "-".$_REQUEST['color_10'];
	if($_REQUEST['color_11']) $color .= "-".$_REQUEST['color_11'];

	// 총 판매물량(세대수)
	$total_count = $_REQUEST['total_count_1'];
	if($_REQUEST['total_count_2']) $total_count .= "-".$_REQUEST['total_count_2'];
	if($_REQUEST['total_count_3']) $total_count .= "-".$_REQUEST['total_count_3'];
	if($_REQUEST['total_count_4']) $total_count .= "-".$_REQUEST['total_count_4'];
	if($_REQUEST['total_count_5']) $total_count .= "-".$_REQUEST['total_count_5'];
	if($_REQUEST['total_count_6']) $total_count .= "-".$_REQUEST['total_count_6'];
	if($_REQUEST['total_count_7']) $total_count .= "-".$_REQUEST['total_count_7'];
	if($_REQUEST['total_count_8']) $total_count .= "-".$_REQUEST['total_count_8'];
	if($_REQUEST['total_count_9']) $total_count .= "-".$_REQUEST['total_count_9'];
	if($_REQUEST['total_count_10']) $total_count .= "-".$_REQUEST['total_count_10'];
	if($_REQUEST['total_count_11']) $total_count .= "-".$_REQUEST['total_count_11'];

	// 계약 판매물량(세대수)
	$sell_count = $_REQUEST['sell_count_1'];
	if($_REQUEST['sell_count_2']) $sell_count .= "-".$_REQUEST['sell_count_2'];
	if($_REQUEST['sell_count_3']) $sell_count .= "-".$_REQUEST['sell_count_3'];
	if($_REQUEST['sell_count_4']) $sell_count .= "-".$_REQUEST['sell_count_4'];
	if($_REQUEST['sell_count_5']) $sell_count .= "-".$_REQUEST['sell_count_5'];
	if($_REQUEST['sell_count_6']) $sell_count .= "-".$_REQUEST['sell_count_6'];
	if($_REQUEST['sell_count_7']) $sell_count .= "-".$_REQUEST['sell_count_7'];
	if($_REQUEST['sell_count_8']) $sell_count .= "-".$_REQUEST['sell_count_8'];
	if($_REQUEST['sell_count_9']) $sell_count .= "-".$_REQUEST['sell_count_9'];
	if($_REQUEST['sell_count_10']) $sell_count .= "-".$_REQUEST['sell_count_10'];
	if($_REQUEST['sell_count_11']) $sell_count .= "-".$_REQUEST['sell_count_11'];

	// 판매물량 단위
	$count_unit = $_REQUEST['count_unit_1'];
	if($_REQUEST['count_unit_2']) $count_unit .= "-".$_REQUEST['count_unit_2'];
	if($_REQUEST['count_unit_3']) $count_unit .= "-".$_REQUEST['count_unit_3'];
	if($_REQUEST['count_unit_4']) $count_unit .= "-".$_REQUEST['count_unit_4'];
	if($_REQUEST['count_unit_5']) $count_unit .= "-".$_REQUEST['count_unit_5'];
	if($_REQUEST['count_unit_6']) $count_unit .= "-".$_REQUEST['count_unit_6'];
	if($_REQUEST['count_unit_7']) $count_unit .= "-".$_REQUEST['count_unit_7'];
	if($_REQUEST['count_unit_8']) $count_unit .= "-".$_REQUEST['count_unit_8'];
	if($_REQUEST['count_unit_9']) $count_unit .= "-".$_REQUEST['count_unit_9'];
	if($_REQUEST['count_unit_10']) $count_unit .= "-".$_REQUEST['count_unit_10'];
	if($_REQUEST['count_unit_11']) $count_unit .= "-".$_REQUEST['count_unit_11'];

	// 수수료
	$pay = $_REQUEST['pay_1'];
	if($_REQUEST['pay_2']) $pay .= "-".$_REQUEST['pay_2'];
	if($_REQUEST['pay_3']) $pay .= "-".$_REQUEST['pay_3'];
	if($_REQUEST['pay_4']) $pay .= "-".$_REQUEST['pay_4'];
	if($_REQUEST['pay_5']) $pay .= "-".$_REQUEST['pay_5'];
	if($_REQUEST['pay_6']) $pay .= "-".$_REQUEST['pay_6'];
	if($_REQUEST['pay_7']) $pay .= "-".$_REQUEST['pay_7'];
	if($_REQUEST['pay_8']) $pay .= "-".$_REQUEST['pay_8'];
	if($_REQUEST['pay_9']) $pay .= "-".$_REQUEST['pay_9'];
	if($_REQUEST['pay_10']) $pay .= "-".$_REQUEST['pay_10'];
	if($_REQUEST['pay_11']) $pay .= "-".$_REQUEST['pay_11'];

	// 수수료 단위
	$pay_con = $_REQUEST['pay_con_1'];
	if($_REQUEST['pay_con_2']) $pay_con .= "-".$_REQUEST['pay_con_2'];
	if($_REQUEST['pay_con_3']) $pay_con .= "-".$_REQUEST['pay_con_3'];
	if($_REQUEST['pay_con_4']) $pay_con .= "-".$_REQUEST['pay_con_4'];
	if($_REQUEST['pay_con_5']) $pay_con .= "-".$_REQUEST['pay_con_5'];
	if($_REQUEST['pay_con_6']) $pay_con .= "-".$_REQUEST['pay_con_6'];
	if($_REQUEST['pay_con_7']) $pay_con .= "-".$_REQUEST['pay_con_7'];
	if($_REQUEST['pay_con_8']) $pay_con .= "-".$_REQUEST['pay_con_8'];
	if($_REQUEST['pay_con_9']) $pay_con .= "-".$_REQUEST['pay_con_9'];
	if($_REQUEST['pay_con_10']) $pay_con .= "-".$_REQUEST['pay_con_10'];
	if($_REQUEST['pay_con_11']) $pay_con .= "-".$_REQUEST['pay_con_11'];

	$client = $_REQUEST['client']; // 발주사
	$client_res = $_REQUEST['client_res'];  //발주사 담당자
	$client_res_tel = $_REQUEST['client_res_tel']; // 발주사 담당자 연락처
	$client_res_mail = $_REQUEST['client_res_mail']; // 발주사 담당자 이메일
	$start_date = $_REQUEST['start_date'];  // 업무 개시일
	$expiry_date = $_REQUEST['expiry_date']; // 계약 만료일
	$cont_date = $_REQUEST['cont_date'];  // 계약 체결일
	$pay_sp_con = $_REQUEST['pay_sp_con']; // 수수료 특별 지급조건


	// 변수 다 받았으면 이제부터 시작
	if($page_code=='new_reg'){ // 신규 등록이면
		############# DB INSERT. #############

		$query="INSERT INTO `cms_project_info` ( `pj_name`, `sort`, `data_cr`, `local_addr`, `local_tel`, `local_fax`, `pj_manager`, `type_info`, `color_type`, `total_count_type`, `sell_count_type`, `count_unit`, `per_pay_type`, `pay_con`, `client`, `client_res`, `client_res_tel`, `client_res_mail`, `start_date`, `expiry_date`, `cont_date`, `pay_sp_condition`, `reg_date`)

							 VALUES('$pj_name', '$sort', '$data_cr', '$address', '$local_tel', '$local_fax', '$pj_manager', '$type', '$color', '$total_count', '$sell_count', '$count_unit', '$pay', '$pay_con', '$client', '$client_res', '$client_res_tel', '$client_res_mail', '$start_date', '$expiry_date', '$cont_date', '$pay_sp_con', now())";
		$result=mysql_query($query, $connect);
		if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.

		echo ("<script>
					window.alert('정상적으로 프로젝트(계약)정보가 등록 되었습니다!');
					</script>");
		echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?m_di=2&s_di=2'>";

	}else if($page_code=='modify'){ // 기존 계약 내용 수정이면

		 ############### DB UPDATE ##############

		 $query1 =" UPDATE cms_project_info SET pj_name = '$pj_name',
																		   sort = '$sort',
																		   data_cr = '$data_cr',
																		   local_addr = '$address',
																		   local_tel = '$local_tel',
																		   local_fax = '$local_fax',
																		   pj_manager = '$pj_manager',
																		   type_info = '$type',
																		   color_type = '$color',
																		   total_count_type = '$total_count',
																		   sell_count_type = '$sell_count',
																		   count_unit = '$count_unit',
																		   per_pay_type = '$pay',
																		   pay_con = '$pay_con',
																		   client = '$client',
																		   client_res = '$client_res',
																		   client_res_tel = '$client_res_tel',
																		   client_res_mail = '$client_res_mail',
																		   start_date = '$start_date',
																		   expiry_date = '$expiry_date',
																		   cont_date = '$cont_date',
																		   pay_sp_condition = '$pay_sp_con',
																		   is_end = '$is_end',
																		   reg_date = now()
									WHERE seq = '$seq' ";

		 $result1=mysql_query($query1, $connect);

		 // 저장 과정에서 오류가 생기면

		 if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		 } else {
				echo ("<script>
							window.alert('정상적으로 프로젝트(계약)정보가 변경 되었습니다!');
						 </script>");
				echo "<meta http-equiv='Refresh' content='0; URL=contract_main.php?m_di=1&s_di=2'>";
		 }
	}

?>
