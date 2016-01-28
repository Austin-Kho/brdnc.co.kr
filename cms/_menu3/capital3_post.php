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
	$deal_date = $_POST['deal_date'];
	$worker = $_SESSION['p_name'];

	// 본사 거래 등록 시
	$com_div_1 = $_POST['com_div_1']; $com_div_2 = $_POST['com_div_2'];	$com_div_3 = $_POST['com_div_3']; $com_div_4 = $_POST['com_div_4'];	$com_div_5 = $_POST['com_div_5'];
	$com_div_6 = $_POST['com_div_6']; $com_div_7 = $_POST['com_div_7'];	$com_div_8 = $_POST['com_div_8']; $com_div_9 = $_POST['com_div_9'];	$com_div_10 = $_POST['com_div_10'];
	if(!$com_div_1) $com_div_1=1;
	if(!$com_div_2) $com_div_2=1;
	if(!$com_div_3) $com_div_3=1;
	if(!$com_div_4) $com_div_4=1;
	if(!$com_div_5) $com_div_5=1;
	if(!$com_div_6) $com_div_6=1;
	if(!$com_div_7) $com_div_7=1;
	if(!$com_div_8) $com_div_8=1;
	if(!$com_div_9) $com_div_9=1;
	if(!$com_div_10) $com_div_10=1;

	// 입출대체 구분
	$class1_1 = $_POST['class1_1']; $class1_2 = $_POST['class1_2'];	$class1_3 = $_POST['class1_3']; $class1_4 = $_POST['class1_4'];	$class1_5 = $_POST['class1_5'];
	$class1_6 = $_POST['class1_6']; $class1_7 = $_POST['class1_7'];	$class1_8 = $_POST['class1_8']; $class1_9 = $_POST['class1_9'];	$class1_10 = $_POST['class1_10'];

	// 입출금 세부 구분
	$class2_1 = $_POST['class2_1']; $class2_2 = $_POST['class2_2'];	$class2_3 = $_POST['class2_3']; $class2_4 = $_POST['class2_4'];	$class2_5 = $_POST['class2_5'];
	$class2_6 = $_POST['class2_6']; $class2_7 = $_POST['class2_7'];	$class2_8 = $_POST['class2_8']; $class2_9 = $_POST['class2_9'];	$class2_10 = $_POST['class2_10'];

	// 현장으로 전도금 송금시 현장 코드
	$pj_seq_1=$_REQUEST['pj_seq_1']; $pj_seq_2=$_REQUEST['pj_seq_2']; $pj_seq_3=$_REQUEST['pj_seq_3']; $pj_seq_4=$_REQUEST['pj_seq_4']; $pj_seq_5=$_REQUEST['pj_seq_5'];
	$pj_seq_6=$_REQUEST['pj_seq_6']; $pj_seq_7=$_REQUEST['pj_seq_7']; $pj_seq_8=$_REQUEST['pj_seq_8']; $pj_seq_9=$_REQUEST['pj_seq_9']; $pj_seq_10=$_REQUEST['pj_seq_10'];

	// 조합 대여금 여부
	$jh_loan_1=$_REQUEST['jh_loan_1']; $jh_loan_2=$_REQUEST['jh_loan_2']; $jh_loan_3=$_REQUEST['jh_loan_3']; $jh_loan_4=$_REQUEST['jh_loan_4']; $jh_loan_5=$_REQUEST['jh_loan_5'];
	$jh_loan_6=$_REQUEST['jh_loan_6']; $jh_loan_7=$_REQUEST['jh_loan_7']; $jh_loan_8=$_REQUEST['jh_loan_8']; $jh_loan_9=$_REQUEST['jh_loan_9']; $jh_loan_10=$_REQUEST['jh_loan_10'];

	// 계정과목
	$account_1=$_REQUEST['account_1'];	$account_2=$_REQUEST['account_2'];	$account_3=$_REQUEST['account_3'];	$account_4=$_REQUEST['account_4'];	$account_5=$_REQUEST['account_5'];
	$account_6=$_REQUEST['account_6'];	$account_7=$_REQUEST['account_7'];	$account_8=$_REQUEST['account_8'];	$account_9=$_REQUEST['account_9'];	$account_10=$_REQUEST['account_10'];

	// 적요
	$cont_1 = $_POST['cont_1']; $cont_2 = $_POST['cont_2']; $cont_3 = $_POST['cont_3']; $cont_4 = $_POST['cont_4'];	$cont_5 = $_POST['cont_5'];
	$cont_6 = $_POST['cont_6']; $cont_7 = $_POST['cont_7']; $cont_8 = $_POST['cont_8']; $cont_9 = $_POST['cont_9']; $cont_10 = $_POST['cont_10'];

	// 거래처
	$acc_1 = $_POST['acc_1']; $acc_2 = $_POST['acc_2']; $acc_3 = $_POST['acc_3']; $acc_4 = $_POST['acc_4']; $acc_5 = $_POST['acc_5'];
	$acc_6 = $_POST['acc_6'];	$acc_7 = $_POST['acc_7'];	$acc_8 = $_POST['acc_8'];	$acc_9 = $_POST['acc_9'];	$acc_10 = $_POST['acc_10'];

	// 입금계정
	$in_1 = $_POST['in_1']; $in_2 = $_POST['in_2']; $in_3 = $_POST['in_3']; $in_4 = $_POST['in_4']; $in_5 = $_POST['in_5'];
	$in_6 = $_POST['in_6']; $in_7 = $_POST['in_7']; $in_8 = $_POST['in_8']; $in_9 = $_POST['in_9']; $in_10 = $_POST['in_10'];

	// 입금액
	$inc_1 = $_POST['inc_1']; $inc_2 = $_POST['inc_2'];	$inc_3 = $_POST['inc_3']; $inc_4 = $_POST['inc_4']; $inc_5 = $_POST['inc_5'];
	$inc_6 = $_POST['inc_6']; $inc_7 = $_POST['inc_7'];	$inc_8 = $_POST['inc_8']; $inc_9 = $_POST['inc_9'];	$inc_10 = $_POST['inc_10'];

	// 출금액
	$exp_1 = $_POST['exp_1']; 	$exp_2 = $_POST['exp_2'];	$exp_3 = $_POST['exp_3'];	$exp_4 = $_POST['exp_4'];	$exp_5 = $_POST['exp_5'];
	$exp_6 = $_POST['exp_6'];	$exp_7 = $_POST['exp_7'];	$exp_8 = $_POST['exp_8'];	$exp_9 = $_POST['exp_9'];	$exp_10 = $_POST['exp_10'];

	// 출금계정(seq코드와 은행명을 분리하여 사용)
	$out_1 = explode("-", $_POST['out_1']);
	$out_2 = explode("-", $_POST['out_2']);
	$out_3 = explode("-", $_POST['out_3']);
	$out_4 = explode("-", $_POST['out_4']);
	$out_5 = explode("-", $_POST['out_5']);
	$out_6 = explode("-", $_POST['out_6']);
	$out_7 = explode("-", $_POST['out_7']);
	$out_8 = explode("-", $_POST['out_8']);
	$out_9 = explode("-", $_POST['out_9']);
	$out_10 = explode("-", $_POST['out_10']);

	// 증빙서류
	$evi_1 = $_POST['evi_1']; $evi_2 = $_POST['evi_2'];	$evi_3 = $_POST['evi_3']; $evi_4 = $_POST['evi_4'];	$evi_5 = $_POST['evi_5'];
	$evi_6 = $_POST['evi_6']; $evi_7 = $_POST['evi_7'];	$evi_8 = $_POST['evi_8']; $evi_9 = $_POST['evi_9'];	$evi_10 = $_POST['evi_10'];

	// 수수료 체크 여부 확인
	$char1_1 = $_REQUEST['char1_1']; $char1_2 = $_REQUEST['char1_2']; $char1_3 = $_REQUEST['char1_3']; $char1_4 = $_REQUEST['char1_4']; $char1_5 = $_REQUEST['char1_5'];
	$char1_6 = $_REQUEST['char1_6']; $char1_7 = $_REQUEST['char1_7']; $char1_8 = $_REQUEST['char1_8']; $char1_9 = $_REQUEST['char1_9']; $char1_10 = $_REQUEST['char1_10'];

	// 수수료 발생 시 - 적요
	$cont_1_h = rg_cut_string($_POST['cont_1_h'],16,"..")." - 수수료";
	$cont_2_h = rg_cut_string($_POST['cont_2_h'],16,"..")." - 수수료";
	$cont_3_h = rg_cut_string($_POST['cont_3_h'],16,"..")." - 수수료";
	$cont_4_h = rg_cut_string($_POST['cont_4_h'],16,"..")." - 수수료";
	$cont_5_h = rg_cut_string($_POST['cont_5_h'],16,"..")." - 수수료";
	$cont_6_h = rg_cut_string($_POST['cont_6_h'],16,"..")." - 수수료";
	$cont_7_h = rg_cut_string($_POST['cont_7_h'],16,"..")." - 수수료";
	$cont_8_h = rg_cut_string($_POST['cont_8_h'],16,"..")." - 수수료";
	$cont_9_h = rg_cut_string($_POST['cont_9_h'],16,"..")." - 수수료";
	$cont_10_h = rg_cut_string($_POST['cont_10_h'],16,"..")." - 수수료";

	// 수수료 발생 시 - 출금액
	$char2_1 = $_POST['char2_1']; $char2_2 = $_POST['char2_2']; $char2_3 = $_POST['char2_3']; $char2_4 = $_POST['char2_4']; $char2_5 = $_POST['char2_5'];
	$char2_6 = $_POST['char2_6']; $char2_7 = $_POST['char2_7']; $char2_8 = $_POST['char2_8']; $char2_9 = $_POST['char2_9']; $char2_10 = $_POST['char2_10'];


		############# CASH BOOK 테이블에 입력 값을 등록한다. #############
		if($class1_1&&$class2_1){
			 $query1="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `pj_seq`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_1', '$class1_1', '$class2_1', '$jh_loan_1', '$account_1', '$pj_seq_1', '$cont_1', '$acc_1', '$in_1', '$inc_1', '$out_1[0]', '$exp_1', '$evi_1', '$worker', '$deal_date')";
			 $result1=mysql_query($query1, $connect);
			 if(!$result1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_1=='on'){
			 $query1="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_1', '2', '5', '지급수수료', '$cont_1_h', '$out_1[1]', '$out_1[0]', '$char2_1', '1', '$worker', '$deal_date')";
			 $result1=mysql_query($query1, $connect);
			 if(!$result1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($class1_2&&$class2_2){
			 $query2="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_2', '$class1_2', '$class2_2', '$jh_loan_2', '$account_2', '$cont_2', '$acc_2', '$in_2', '$inc_2', '$out_2[0]', '$exp_2', '$evi_2', '$worker', '$deal_date')";
			 $result2=mysql_query($query2, $connect);
			 if(!$result2) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_2=='on'){
			 $query2="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_2', '2', '5', '지급수수료', '$cont_2_h', '$out_2[1]', '$out_2[0]', '$char2_2', '1', '$worker', '$deal_date')";
			 $result2=mysql_query($query2, $connect);
			 if(!$result2) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_3&&$class2_3){
			 $query3="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_3', '$class1_3', '$class2_3', '$jh_loan_3', '$account_3', '$cont_3', '$acc_3', '$in_3', '$inc_3', '$out_3[0]', '$exp_3', '$evi_3', '$worker', '$deal_date')";
			 $result3=mysql_query($query3, $connect);
			 if(!$result3) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_3=='on'){
			 $query3="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_3', '2', '5', '지급수수료', '$cont_3_h', '$out_3[1]', '$out_3[0]', '$char2_3', '1', '$worker', '$deal_date')";
			 $result3=mysql_query($query3, $connect);
			 if(!$result3) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_4&&$class2_4){
			 $query4="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_4', '$class1_4', '$class2_4', '$jh_loan_4', '$account_4', '$cont_4', '$acc_4', '$in_4', '$inc_4', '$out_4[0]', '$exp_4', '$evi_4', '$worker', '$deal_date')";
			 $result4=mysql_query($query4, $connect);
			 if(!$result4) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_4=='on'){
			 $query4="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_4', '2', '5', '지급수수료', '$cont_4_h', '$out_4[1]', '$out_4[0]', '$char2_4', '1', '$worker', '$deal_date')";
			 $result4=mysql_query($query4, $connect);
			 if(!$result4) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_5&&$class2_5){
			 $query5="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_5', '$class1_5', '$class2_5', '$jh_loan_5', '$account_5', '$cont_5', '$acc_5', '$in_5', '$inc_5', '$out_5[0]', '$exp_5', '$evi_5', '$worker', '$deal_date')";
			 $result5=mysql_query($query5, $connect);
			 if(!$result5) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_5=='on'){
			 $query5="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_5', '2', '5', '지급수수료', '$cont_5_h', '$out_5[1]', '$out_5[0]', '$char2_5', '1', '$worker', '$deal_date')";
			 $result5=mysql_query($query5, $connect);
			 if(!$result5) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_6&&$class2_6){
			 $query6="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_6', '$class1_6', '$class2_6', '$jh_loan_6', '$account_6', '$cont_6', '$acc_6', '$in_6', '$inc_6', '$out_6[0]', '$exp_6', '$evi_6', '$worker', '$deal_date')";
			 $result6=mysql_query($query6, $connect);
			 if(!$result6) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_6=='on'){
			 $query6="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_6', '2', '5', '지급수수료', '$cont_6_h', '$out_6[1]', '$out_6[0]', '$char2_6', '1', '$worker', '$deal_date')";
			 $result6=mysql_query($query6, $connect);
			 if(!$result6) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_7&&$class2_7){
			 $query7="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_7', '$class1_7', '$class2_7', '$jh_loan_7', '$account_7', '$cont_7', '$acc_7', '$in_7', '$inc_7', '$out_7[0]', '$exp_7', '$evi_7', '$worker', '$deal_date')";
			 $result7=mysql_query($query7, $connect);
			 if(!$result7) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_7=='on'){
			 $query7="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_7', '2', '5', '지급수수료', '$cont_7_h', '$out_7[1]', '$out_7[0]', '$char2_7', '1', '$worker', '$deal_date')";
			 $result7=mysql_query($query7, $connect);
			 if(!$result7) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_8&&$class2_8){
			 $query8="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_8', '$class1_8', '$class2_8', '$jh_loan_8', '$account_8', '$cont_8', '$acc_8', '$in_8', '$inc_8', '$out_8[0]', '$exp_8', '$evi_8', '$worker', '$deal_date')";
			 $result8=mysql_query($query8, $connect);
			 if(!$result8) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_8=='on'){
			 $query8="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_8', '2', '5', '지급수수료', '$cont_8_h', '$out_8[1]', '$out_8[0]', '$char2_8', '1', '$worker', '$deal_date')";
			 $result8=mysql_query($query8, $connect);
			 if(!$result8) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_9&&$class2_9){
			 $query9="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_9', '$class1_9', '$class2_9', '$jh_loan_9', '$account_9', '$cont_9', '$acc_9', '$in_9', '$inc_9', '$out_9[0]', '$exp_9', '$evi_9', '$worker', '$deal_date')";
			 $result9=mysql_query($query9, $connect);
			 if(!$result9) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_9=='on'){
			 $query9="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_9', '2', '5', '지급수수료', '$cont_9_h', '$out_9[1]', '$out_9[0]', '$char2_9', '1', '$worker', '$deal_date')";
			 $result9=mysql_query($query9, $connect);
			 if(!$result9) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		if($class1_10&&$class2_10){
			 $query10="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `is_jh_loan`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_10', '$class1_10', '$class2_10', '$jh_loan_10', '$account_10', '$cont_10', '$acc_10', '$in_10', '$inc_10', '$out_10[0]', '$exp_10', '$evi_10', '$worker', '$deal_date')";
			 $result10=mysql_query($query10, $connect);
			 if(!$result10) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}
		if($char1_10=='on'){
			 $query10="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div_10', '2', '5', '지급수수료', '$cont_10_h', '$out_10[1]', '$out_10[0]', '$char2_10', '1', '$worker', '$deal_date')";
			 $result10=mysql_query($query10, $connect);
			 if(!$result10) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		}

		echo ("<script>
					window.alert('정상적으로 거래정보가 등록 되었습니다!');
					location.href='capital_main.php?m_di=1&s_di=2';
				</script>");
?>
