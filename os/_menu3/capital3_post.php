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

	// form(form1-post)에서 받은 데이터
	$deal_date = $_POST['deal_date'];
	$worker = $_SESSION['p_name'];

	// 본사 거래 등록 시
	$com_div = array($_POST['com_div_1'], $_POST['com_div_2'], $_POST['com_div_3'], $_POST['com_div_4'], $_POST['com_div_5'], $_POST['com_div_6'], $_POST['com_div_7'], $_POST['com_div_8'], $_POST['com_div_9'], $_POST['com_div_10']);

	if(!$com_div[0]) $com_div[0]=1;
	if(!$com_div[1]) $com_div[1]=1;
	if(!$com_div[2]) $com_div[2]=1;
	if(!$com_div[3]) $com_div[3]=1;
	if(!$com_div[4]) $com_div[4]=1;
	if(!$com_div[5]) $com_div[5]=1;
	if(!$com_div[6]) $com_div[6]=1;
	if(!$com_div[7]) $com_div[7]=1;
	if(!$com_div[8]) $com_div[8]=1;
	if(!$com_div[9]) $com_div[9]=1;

	// 입출대체 구분
	$class1 = array($_POST['class1_1'], $_POST['class1_2'], $_POST['class1_3'], $_POST['class1_4'], $_POST['class1_5'],
					$_POST['class1_6'], $_POST['class1_7'], $_POST['class1_8'], $_POST['class1_9'], $_POST['class1_10']);

	// 입출금 세부 구분
	$class2 = array($_POST['class2_1'], $_POST['class2_2'], $_POST['class2_3'], $_POST['class2_4'], $_POST['class2_5'],
					$_POST['class2_6'], $_POST['class2_7'], $_POST['class2_8'], $_POST['class2_9'], $_POST['class2_10']);

	// 현장으로 전도금 송금시 현장 코드
	$pj_seq = array($_POST['pj_seq_1'], $_POST['pj_seq_2'], $_POST['pj_seq_3'], $_POST['pj_seq_4'], $_POST['pj_seq_5'],
					$_POST['pj_seq_6'], $_POST['pj_seq_7'], $_POST['pj_seq_8'], $_POST['pj_seq_9'], $_POST['pj_seq_10']);

	// 조합 대여금 여부
	$jh_loan = array($_POST['jh_loan_1'], $_POST['jh_loan_2'], $_POST['jh_loan_3'], $_POST['jh_loan_4'], $_POST['jh_loan_5'],
					 $_POST['jh_loan_6'], $_POST['jh_loan_7'], $_POST['jh_loan_8'], $_POST['jh_loan_9'], $_POST['jh_loan_10']);

	// 계정과목
	$account = array($_POST['account_1'], $_POST['account_2'], $_POST['account_3'], $_POST['account_4'], $_POST['account_5'],
					 $_POST['account_6'], $_POST['account_7'], $_POST['account_8'], $_POST['account_9'], $_POST['account_10']);

	// 적요
	$cont = array($_POST['cont_1'], $_POST['cont_2'], $_POST['cont_3'], $_POST['cont_4'], $_POST['cont_5'],
				  $_POST['cont_6'], $_POST['cont_7'], $_POST['cont_8'], $_POST['cont_9'], $_POST['cont_10']);

	// 거래처
	$acc = array($_POST['acc_1'], $_POST['acc_2'], $_POST['acc_3'], $_POST['acc_4'], $_POST['acc_5'],
				 $_POST['acc_6'], $_POST['acc_7'], $_POST['acc_8'], $_POST['acc_9'], $_POST['acc_10']);

	// 입금계정
	$ina = array($_POST['in_1'], $_POST['in_2'], $_POST['in_3'], $_POST['in_4'], $_POST['in_5'],
				 $_POST['in_6'], $_POST['in_7'], $_POST['in_8'], $_POST['in_9'], $_POST['in_10']);

	// 입금액
	$inc = array($_POST['inc_1'], $_POST['inc_2'], $_POST['inc_3'], $_POST['inc_4'], $_POST['inc_5'],
				 $_POST['inc_6'], $_POST['inc_7'], $_POST['inc_8'], $_POST['inc_9'], $_POST['inc_10']);

	// 출금액
	$exp = array($_POST['exp_1'], $_POST['exp_2'], $_POST['exp_3'], $_POST['exp_4'], $_POST['exp_5'],
				 $_POST['exp_6'], $_POST['exp_7'], $_POST['exp_8'], $_POST['exp_9'], $_POST['exp_10']);

	// 출금계정(seq코드와 은행명을 분리하여 사용)
	$out[0] = explode("-", $_POST['out_1']);
	$out[1] = explode("-", $_POST['out_2']);
	$out[2] = explode("-", $_POST['out_3']);
	$out[3] = explode("-", $_POST['out_4']);
	$out[4] = explode("-", $_POST['out_5']);
	$out[5] = explode("-", $_POST['out_6']);
	$out[6] = explode("-", $_POST['out_7']);
	$out[7] = explode("-", $_POST['out_8']);
	$out[8] = explode("-", $_POST['out_9']);
	$out[9] = explode("-", $_POST['out_10']);

	$out1 = array($out[0][0] , $out[1][0], $out[2][0], $out[3][0], $out[4][0], $out[5][0], $out[6][0], $out[7][0], $out[8][0], $out[9][0]); // code
	$out2 = array($out[0][1] , $out[1][1], $out[2][1], $out[3][1], $out[4][1], $out[5][1], $out[6][1], $out[7][1], $out[8][1], $out[9][1]); // name


	// 증빙서류
	$evi = array($_POST['evi_1'], $_POST['evi_2'], $_POST['evi_3'], $_POST['evi_4'], $_POST['evi_5'], $_POST['evi_6'], $_POST['evi_7'], $_POST['evi_8'], $_POST['evi_9'], $_POST['evi_10']);

	// 수수료 체크 여부 확인
	$char1 = array($_POST['char1_1'], $_POST['char1_2'], $_POST['char1_3'], $_POST['char1_4'], $_POST['char1_5'], $_POST['char1_6'], $_POST['char1_7'], $_POST['char1_8'], $_POST['char1_9'], $_POST['char1_10']);

	// 수수료 발생 시 - 적요
	$cont_1_h = rg_cut_string($_POST['cont_1_h'],12,"..")."-이체수수료";
	$cont_2_h = rg_cut_string($_POST['cont_2_h'],12,"..")."-이체수수료";
	$cont_3_h = rg_cut_string($_POST['cont_3_h'],12,"..")."-이체수수료";
	$cont_4_h = rg_cut_string($_POST['cont_4_h'],12,"..")."-이체수수료";
	$cont_5_h = rg_cut_string($_POST['cont_5_h'],12,"..")."-이체수수료";
	$cont_6_h = rg_cut_string($_POST['cont_6_h'],12,"..")."-이체수수료";
	$cont_7_h = rg_cut_string($_POST['cont_7_h'],12,"..")."-이체수수료";
	$cont_8_h = rg_cut_string($_POST['cont_8_h'],12,"..")."-이체수수료";
	$cont_9_h = rg_cut_string($_POST['cont_9_h'],12,"..")."-이체수수료";
	$cont_10_h= rg_cut_string($_POST['cont_10_h'],12,"..")."-이체수수료";
	$cont_h = array($cont_1_h, $cont_2_h, $cont_3_h, $cont_4_h, $cont_5_h, $cont_6_h, $cont_7_h, $cont_8_h, $cont_9_h, $cont_10_h);

	// 수수료 발생 시 - 출금액
	$char2 = array($_POST['char2_1'], $_POST['char2_2'], $_POST['char2_3'], $_POST['char2_4'], $_POST['char2_5'], $_POST['char2_6'], $_POST['char2_7'], $_POST['char2_8'], $_POST['char2_9'], $_POST['char2_10']);


		############# CASH BOOK 테이블에 입력 값을 등록한다. #############

		for($i=0; $i<10; $i++){   // 대여/회수 시 조합을 선택하기 위한 함수
			if($class2[$i]<8&&($jh_loan[$i]!=null||$jh_loan[$i]!=0)){
				$any_jh[$i] = $pj_seq[$i];
				$pj_seq[$i] = null;
			}
			if($class1[$i]&&$class2[$i]){

				$query1="INSERT INTO `cms_capital_cash_book` (`com_div`, `pj_seq`, `class1`, `class2`, `is_jh_loan`, `any_jh`, `account`, `cont`, `acc`, `in_acc`, `inc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div[$i]', '$pj_seq[$i]', '$class1[$i]', '$class2[$i]', '$jh_loan[$i]', '$any_jh[$i]', '$account[$i]', '$cont[$i]', '$acc[$i]', '$ina[$i]', '$inc[$i]', '$out1[$i]', '$exp[$i]', '$evi[$i]', '$worker', '$deal_date')";
				$result1=mysql_query($query1, $connect);
				if(!$result1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
			if($char1[$i]=='on'){
				$query1="INSERT INTO `cms_capital_cash_book` (`com_div`, `class1`, `class2`, `account`, `cont`, `acc`, `out_acc`, `exp`, `evidence`, `worker`, `deal_date`)
							  VALUES('$com_div[$i]', '2', '5', '지급수수료', '$cont_h[$i]', '$out2[$i]', '$out1[$i]', '$char2[$i]', '1', '$worker', '$deal_date')";
				$result1=mysql_query($query1, $connect);
				if(!$result1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}
		}
		echo ("<script>
					window.alert('정상적으로 거래정보가 등록 되었습니다!');
					location.href='capital_main.php?m_di=1&s_di=2';
				</script>");
?>
