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

	$s_di = $_REQUEST['s_di'];
	$mode=$_REQUEST['mode'];

	if($s_di==1){ // 부서 정보 관리
		//////////변수 저장//////////
		$seq = $_REQUEST['seq'];

		$com_seq = $_REQUEST['com_seq'];
		$div_code = $_REQUEST['div_code'];
		$div_name = $_REQUEST['div_name'];
		$res_work = $_REQUEST['res_work'];
		$manager = $_REQUEST['manager'];
		$div_tel = $_REQUEST['div_tel'];
		$note = $_REQUEST['note'];

		if($mode=='reg'){ // 부서 정보 등록(1)
			//// 등록 거래처 중 동일한 거래처가 있는지 확인 ///
			$qry = "SELECT seq FROM cms_com_div WHERE div_code='$div_code' OR div_name='$div_name' ";
			$rlt = mysql_query($qry, $connect);
			$row = mysql_fetch_array($rlt);
			if($row) {
				err_msg('이미 등록 된 부서이거나 사용중인 부서명 입니다.');
			}else{
				### 거래처 정보 테이블에 입력 값을 입력한다. ###
				$qry1 = "INSERT INTO `cms_com_div` ( `com_seq`, `div_code`, `div_name`, `res_work`, `manager`, `div_tel`, `note`)
								 VALUES('$com_seq', '$div_code', '$div_name', '$res_work', '$manager', '$div_tel', '$note')";
				$rlt1 = mysql_query($qry1, $connect);

				////저장 과정에서 오류가 생기면
				if(!$rlt1){
					 err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					msg('정상적으로 부서 정보가 등록 되었습니다!');
					echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=1'>";
				}
			}
		}

		if($mode=='modify'){ // 부서 정보 수정(1)

			### 은행계좌 정보 테이블에 입력 값을 수정한다. ###
			$query1 ="UPDATE cms_com_div SET com_seq='$com_seq',
														div_code='$div_code',
														div_name='$div_name ',
														res_work='$res_work',
														manager='$manager',
														div_tel='$div_tel',
														note='$note'
												WHERE seq='$seq' ";

			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면

			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else {
				msg('정상적으로 부서 정보가 변경 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=1'>";
			}
		}
		if($mode=='del'){ // 부서 정보 개별 삭제(1)
			$qry="DELETE FROM cms_com_div WHERE seq='$seq' ";
			$res=mysql_query($qry, $connect);

			if(!$res){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else{
				msg('정상적으로 부서 정보가 삭제 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=1'>";
			}
		}
	}
	else if($s_di==2){ // 직원 정보 관리
		//////////변수 저장//////////
		$seq = $_REQUEST['seq'];

		$mem_name = $_REQUEST['mem_name'];
		$dir_tel = $_REQUEST['dir_tel'];
		$div_seq = $_REQUEST['div_seq'];
		$div_posi = $_REQUEST['div_posi'];
		$mobile = $_REQUEST['mobile'];
		$email = $_REQUEST['email'];
		$id_num = $_REQUEST['id_num1']."-".$_REQUEST['id_num2'];
		$join_date = $_REQUEST['join_date'];

		if($mode=='reg'){ // 직원 정보 등록(2)
			//// 등록 직원 중 동일한 직원이 있는지 확인 ///
			/*
			$qry = "SELECT seq FROM cms_com_div_mem WHERE id_num='$id_num' ";
			$rlt = mysql_query($qry, $connect);
			$row = mysql_fetch_array($rlt);
			if($row) {
				err_msg('이미 등록 된 계좌이거나 사용중인 계좌별칭 입니다.');

			}else{
			*/
				### 직원 정보 테이블에 입력 값을 입력한다. ###
				$qry1 = "INSERT INTO cms_com_div_mem ( `com_seq`, `div_seq`, `div_posi`, `mem_name`, `dir_tel`, `mobile`, `email`, `id_num`, `join_date`)
								 VALUES('$com_seq', '$div_seq', '$div_posi', '$mem_name', '$dir_tel', '$mobile', '$email', '$id_num', '$join_date')";
				$rlt1 = mysql_query($qry1, $connect);

				////저장 과정에서 오류가 생기면
				if(!$rlt1){
					 err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					msg('정상적으로 직원 정보가 등록 되었습니다!');
					echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=2'>";
				}
			//}
		}

		if($mode=='modify'){ // 직원 정보 수정(2)

			### 직원 정보 테이블에 입력 값을 수정한다. ###
			$query1 ="UPDATE cms_com_div_mem SET com_seq='$com_seq',
																			div_seq='$div_seq',
																			div_posi='$div_posi ',
																			mem_name='$mem_name',
																			dir_tel='$dir_tel',
																			mobile='$mobile',
																			email='$email',
																			id_num='$id_num',
																			join_date='$join_date'
														WHERE seq='$seq' ";

			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면

			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else {
				msg('정상적으로 직원 정보가 변경 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=2'>";
			}
		}
		if($mode=='del'){ // 직원 정보 개별 퇴사 처리(2)
			$qry="UPDATE cms_com_div_mem SET is_reti = '1', reti_date='$reti_date'	WHERE seq='$seq' ";
			$res=mysql_query($qry, $connect);

			if(!$res){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else{
				msg('정상적으로 퇴사 등록 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=2'>";
			}
		}
	}
	else if($s_di==3){ // 거래처 정보 관리
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
					echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=3'>";
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
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=3'>";
			}
		}
		if($mode=='del'){ // 거래처 정보 개별 삭제(3)

			$qry="DELETE FROM cms_accounts WHERE seq='$seq' ";
			$res=mysql_query($qry, $connect);

			if(!$res){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else{
				msg('정상적으로 거래처 정보가 삭제 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=3'>";
			}
		}
	}

	else if($s_di==4){ // 은행계좌 관리
		//////////변수 저장//////////
		$no = $_REQUEST['no'];
		$bank_code = $_REQUEST['bank_code'];

		$b_qry = " SELECT 	bank_name FROM cms_capital_bank_code WHERE bank_code = '$bank_code' ";
		$b_rlt = mysql_query($b_qry, $connect);
		$b_row= mysql_fetch_array($b_rlt);
		$bank = $b_row[bank_name];

		$name = addslashes($_REQUEST['name']);
		$number = $_REQUEST['number'];
		$holder = $_REQUEST['holder'];
		$is_com = $_REQUEST['is_com'];
		$div_seq = $_REQUEST['div_seq'];
		$pj_seq = $_REQUEST['pj_seq'];
		$manager = $_REQUEST['manager'];
		$open_date = $_REQUEST['open_date'];
		$note = $_REQUEST['note'];

		if($is_com==1) $pj_seq='0';
		if($is_com==0) $div_seq='0';

		if($mode=='reg'){ // 은행계좌 정보 등록(4)
			//// 등록 거래처 중 동일한 거래처가 있는지 확인 ///
			$qry = "SELECT no FROM cms_capital_bank_account WHERE number='$number' OR name='$name' ";
			$rlt = mysql_query($qry, $connect);
			$row = mysql_fetch_array($rlt);
			if($row) {
				err_msg('이미 등록 된 계좌이거나 사용중인 계좌별칭 입니다.');
			}else{
				### 거래처 정보 테이블에 입력 값을 입력한다. ###
				$qry1 = "INSERT INTO `cms_capital_bank_account` ( `bank`, `bank_code`, `name`, `number`, `holder`, `is_com`, `div_seq`, `pj_seq`, `manager`, `open_date`, `note`)
								 VALUES('$bank', '$bank_code', '$name', '$number', '$holder', '$is_com', '$div_seq', '$pj_seq', '$manager', '$open_date', '$note')";
				$rlt1 = mysql_query($qry1, $connect);

				////저장 과정에서 오류가 생기면
				if(!$rlt1){
					 err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					msg('정상적으로 은행계좌 정보가 등록 되었습니다!');
					echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=4'>";
				}
			}
		}

		if($mode=='modify'){ // 은행계좌 정보 수정(4)

			### 은행계좌 정보 테이블에 입력 값을 수정한다. ###
			$query1 ="UPDATE cms_capital_bank_account SET bank='$bank',
																					  bank_code='$bank_code',
																					  name='$name ',
																					  number='$number',
																					  holder='$holder',
																					  is_com='$is_com',
																					  div_seq='$div_seq',
																					  pj_seq='$pj_seq',
																					  manager='$manager',
																					  open_date='$open_date',
																					  note='$note'
														WHERE no='$no' ";

			$result1=mysql_query($query1, $connect);

			// 저장 과정에서 오류가 생기면

			if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else {
				msg('정상적으로 은행계좌 정보가 변경 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=4'>";
			}
		}
		if($mode=='del'){ // 은행계좌 정보 개별 삭제(4)
			$qry="DELETE FROM cms_capital_bank_account WHERE no='$no' ";
			$res=mysql_query($qry, $connect);

			if(!$res){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
			}else{
				msg('정상적으로 은행계좌 정보가 삭제 되었습니다!');
				echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=1&s_di=4'>";
			}
		}
	}
?>