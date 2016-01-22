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

	if($mode=="com_reg"||$mode=="com_modify"){
		// form(form1-post)에서 받은 데이터
		$seq = $_REQUEST['seq'];
		$co_name = $_POST['co_name'];
		$co_no1 = $_POST['co_no1'];
		$co_no2 = $_POST['co_no2'];
		$co_no3 = $_POST['co_no3'];
		$co_form = $_POST['co_form'];
		$ceo = $_POST['ceo'];
		$or_no1 = $_POST['or_no1'];
		$or_no2 = $_POST['or_no2'];
		$sur = $_POST['sur'];
		$biz_cond = $_POST['biz_cond'];
		$biz_even = $_POST['biz_even'];
		$co_phone1 = $_POST['co_phone1'];
		$co_phone2 = $_POST['co_phone2'];
		$co_phone3 = $_POST['co_phone3'];
		$co_hp1 = $_POST['co_hp1'];
		$co_hp2 = $_POST['co_hp2'];
		$co_hp3 = $_POST['co_hp3'];
		$co_fax1 = $_POST['co_fax1'];
		$co_fax2 = $_POST['co_fax2'];
		$co_fax3 = $_POST['co_fax3'];
		$co_div1 = $_POST['co_div1'];
		$co_div2 = $_POST['co_div2'];
		$co_div3 = $_POST['co_div3'];
		$es_day = $_POST['es_day'];
		$op_day = $_POST['op_day'];
		$carr_y = $_POST['carr_y'];
		$carr_m = $_POST['carr_m'];
		$m_wo_st = $_POST['m_wo_st'];          // 업무 개시 월
		$bl_cycle = $_POST['bl_cycle'];           // 결산 주기
		$email1 = $_POST['email1'];
		$email2 = $_POST['email2'];
		$calc_mail1 = $_POST['calc_mail1'];
		$calc_mail2 = $_POST['calc_mail2'];
		$tax_off1_code = $_POST['tax_off1_code'];
		$tax_off1_name = $_POST['tax_off1_name'];
		$tax_off2_code = $_POST['tax_off2_code'];
		$tax_off2_name = $_POST['tax_off2_name'];
		$zipcode1 = $_POST['zipcode1'];
		$zipcode2 = $_POST['zipcode2'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$en_co_name = $_POST['en_co_name'];
		$en_address = $_POST['en_address'];

		######## 회사 정보 데이터를 가공한다.########
		$co_name = addslashes($co_name);         // 회사명
		$co_no = $co_no1."-".$co_no2."-".$co_no3;  // 사업자번호
		$or_no = $or_no1."-".$or_no2;
		$co_phone = $co_phone1.'-'.$co_phone2.'-'.$co_phone3;
		$co_hp = $co_hp1.'-'.$co_hp2.'-'.$co_hp3;
		$co_fax = $co_fax1.'-'.$co_fax2.'-'.$co_fax3;
		$carr = $carr_y.'-'.$carr_m;
		$email = $email1.'@'.$email2;
		$email = addslashes($email);
		$calc_mail = $calc_mail1.'@'.$calc_mail2;
		$calc_mail = addslashes($calc_mail);
		$zipcode = $zipcode1.'-'.$zipcode2;
		$address1 = addslashes($address1);
		$address2 = addslashes($address2);
		$en_co_name = addslashes($en_co_name);
		$en_address = addslashes($en_address);
	}

		############# 회사 정보 신규 등록 시 #############
		if($mode=="com_reg"){

		 ### 같은 정보 존재 여부 확인###
		 $query="select * from cms_com_info where co_name='$co_name' or co_no='$co_no'";
		 $result=mysql_query($query, $connect);
		 $total_num=mysql_num_rows($result);

		 if($total_num){            // 같은 정보가 있을 때 이전 페이지로 옮김
				echo ("<script>
				     		window.alert('회사명, 사업자등록번호 중 중복된 값이 있습니다!');
						    history.go(-1)
					    </script>");
				exit;
		 } else {

				# 회원 정보 테이블에 입력 값을 등록한다. #
				$query="INSERT INTO `cms_com_info` ( `co_name`, `co_no`, `co_form`, `ceo`, `or_no`, `sur`, `biz_cond`, `biz_even`, `co_phone`, `co_hp`, `co_fax`, `co_div1`, `co_div2`, `co_div3`, `es_date`, `op_date`, `carr`, `m_wo_st`, `bl_cycle`, `email`, `calc_mail`, `tax_off1_code`, `tax_off1_name`, `tax_off2_code`, `tax_off2_name`, `zipcode`, `address1`, `address2`, `en_co_name`, `en_address`, `red_date`)

							 VALUES('$co_name', '$co_no', '$co_form', '$ceo', '$or_no', '$sur', '$biz_cond', '$biz_even', '$co_phone', '$co_hp', '$co_fax', '$co_div1', '$co_div2', '$co_div3', '$es_day', '$op_day', '$carr', '$m_wo_st', '$bl_cycle', '$email', '$calc_mail', '$tax_off1_code', '$tax_off1_name', '$tax_off2_code', '$tax_off2_name', '$zipcode', '$address1', '$address2', '$en_co_name', '$en_address', now())";
				$result=mysql_query($query, $connect);

				// 저장 과정에서 오류가 생기면

				if(!$result){
					 err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
				} else {
					 echo ("<script>
											window.alert('정상적으로 회사(기업)정보가 등록 되었습니다!');
									</script>");
					 echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=2'>";
				}
		 }


	############# 회사 정보 수정 시 #############
	}else if($mode=="com_modify"){


		 ### 회사 정보 테이블에 입력 값을 수정한다. ###
		 $query1 =" UPDATE cms_com_info SET co_name='$co_name',
														co_no='$co_no',
														co_form='$co_form',
														ceo='$ceo',
														or_no='$or_no',
														sur='$sur',
														biz_cond='$biz_cond',
														biz_even='$biz_even',
														co_phone='$co_phone',
														co_hp='$co_hp',
														co_fax='$co_fax',
														co_div1='$co_div1',
														co_div2='$co_div2',
														co_div3='$co_div3',
														es_date='$es_day',
														op_date='$op_day',
														carr='$carr',
														m_wo_st='$m_wo_st',
														bl_cycle='$bl_cycle',
														email='$email',
														calc_mail='$calc_mail',
														tax_off1_code='$tax_off1_code',
														tax_off1_name='$tax_off1_name',
														tax_off2_code='$tax_off2_code',
														tax_off2_name='$tax_off2_name',
														zipcode='$zipcode',
														address1='$address1',
														address2='$address2',
														en_co_name='$en_co_name',
														en_address='$en_address',
														up_date=now()
							    WHERE seq='$seq' ";

		 $result1=mysql_query($query1, $connect);

		 // 저장 과정에서 오류가 생기면

		 if(!$result1){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		 } else {
				echo ("<script>
				    			window.alert('정상적으로 회사(기업)정보가 변경 되었습니다!');
						   </script>");
			  echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=2'>";
		 }



	############# 신규 멤버 가입 후 솔루션 사용 승인 #############
	}else if($mode=="perm"){

		$mem =$_REQUEST['mem'];
		$sf=$_REQUEST['sf'];
		//echo $mem.$sf;

		 $p_result = mysql_query("UPDATE cms_member_table SET request='$sf', auth_level='9' WHERE no='$mem' ", $connect);

		 // 저장 과정에서 오류가 생기면

		 if(!$p_result){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		 }else{
				echo ("<script>
				    			window.alert('사용자 등록이 처리 되었습니다!');
						   </script>");
			  echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=2&s_di=2'>";
		 }




	############# 기존 멤버 솔루션 사용 권한 설정 #############
	}else if($mode=="auth_m"){  //
		$user_no=$_REQUEST['user_no'];
		$user_id=$_REQUEST['user_id'];
		$ms = $_REQUEST['ms'];
		$mn = $_REQUEST['mn'];

		$sa_1_1 = $_REQUEST['sa_1_1']; 	$sa_1_1_m=$_REQUEST['sa_1_1_m'];
		$sa_1_2 = $_REQUEST['sa_1_2'];	$sa_1_2_m=$_REQUEST['sa_1_2_m'];
		$sa_1_3 = $_REQUEST['sa_1_3'];	$sa_1_3_m=$_REQUEST['sa_1_3_m'];
		$sa_2_1 = $_REQUEST['sa_2_1'];	$sa_2_1_m=$_REQUEST['sa_2_1_m'];
		$sa_2_2 = $_REQUEST['sa_2_2'];	$sa_2_2_m=$_REQUEST['sa_2_2_m'];
		$sa_2_3 = $_REQUEST['sa_2_3'];	$sa_2_3_m=$_REQUEST['sa_2_3_m'];

		$pr_1_1 = $_REQUEST['pr_1_1'];	$pr_1_1_m=$_REQUEST['pr_1_1_m'];
		$pr_1_2 = $_REQUEST['pr_1_2'];	$pr_1_2_m=$_REQUEST['pr_1_2_m'];
		$pr_1_3 = $_REQUEST['pr_1_3'];	$pr_1_3_m=$_REQUEST['pr_1_3_m'];
		$pr_2_1 = $_REQUEST['pr_2_1'];	$pr_2_1_m=$_REQUEST['pr_2_1_m'];
		$pr_2_2 = $_REQUEST['pr_2_2'];	$pr_2_2_m=$_REQUEST['pr_2_2_m'];
		$pr_2_3 = $_REQUEST['pr_2_3'];	$pr_2_3_m=$_REQUEST['pr_2_3_m'];

		$ca_1_1 = $_REQUEST['ca_1_1']; 	$ca_1_1_m=$_REQUEST['ca_1_1_m'];
		$ca_1_2 = $_REQUEST['ca_1_2'];	$ca_1_2_m=$_REQUEST['ca_1_2_m'];
		$ca_1_3 = $_REQUEST['ca_1_3'];	$ca_1_3_m=$_REQUEST['ca_1_3_m'];
		$ca_2_1 = $_REQUEST['ca_2_1'];	$ca_2_1_m=$_REQUEST['ca_2_1_m'];
		$ca_2_2 = $_REQUEST['ca_2_2'];	$ca_2_2_m=$_REQUEST['ca_2_2_m'];

		$ct_1_1 = $_REQUEST['ct_1_1'];	$ct_1_1_m=$_REQUEST['ct_1_1_m'];
		$ct_1_2 = $_REQUEST['ct_1_2'];	$ct_1_2_m=$_REQUEST['ct_1_2_m'];
		$ct_2_1 = $_REQUEST['ct_2_1'];	$ct_2_1_m=$_REQUEST['ct_2_1_m'];
		$ct_2_2 = $_REQUEST['ct_2_2'];	$ct_2_2_m=$_REQUEST['ct_2_2_m'];

		$cg_1_1 = $_REQUEST['cg_1_1'];	$cg_1_1_m=$_REQUEST['cg_1_1_m'];
		$cg_1_2 = $_REQUEST['cg_1_2'];	$cg_1_2_m=$_REQUEST['cg_1_2_m'];
		$cg_1_3 = $_REQUEST['cg_1_3'];	$cg_1_3_m=$_REQUEST['cg_1_3_m'];
		$cg_1_4 = $_REQUEST['cg_1_4'];	$cg_1_4_m=$_REQUEST['cg_1_4_m'];
		$cg_2_1 = $_REQUEST['cg_2_1'];	$cg_2_1_m=$_REQUEST['cg_2_1_m'];
		$cg_2_2 = $_REQUEST['cg_2_2'];	$cg_2_2_m=$_REQUEST['cg_2_2_m'];

		if($sa_1_1==on&&$sa_1_1_m==on){$sa_1_1=2;}else if($sa_1_1==on||$sa_1_1_m==on){$sa_1_1=1;}else{$sa_1_1=0;}
		if($sa_1_2==on&&$sa_1_2_m==on){$sa_1_2=2;}else if($sa_1_2==on||$sa_1_2_m==on){$sa_1_2=1;}else{$sa_1_2=0;}
		if($sa_1_3==on&&$sa_1_3_m==on){$sa_1_3=2;}else if($sa_1_3==on||$sa_1_3_m==on){$sa_1_3=1;}else{$sa_1_3=0;}
		if($sa_2_1==on&&$sa_2_1_m==on){$sa_2_1=2;}else if($sa_2_1==on||$sa_2_1_m==on){$sa_2_1=1;}else{$sa_2_1=0;}
		if($sa_2_2==on&&$sa_2_2_m==on){$sa_2_2=2;}else if($sa_2_2==on||$sa_2_2_m==on){$sa_2_2=1;}else{$sa_2_2=0;}
		if($sa_2_3==on&&$sa_2_3_m==on){$sa_2_3=2;}else if($sa_2_3==on||$sa_2_3_m==on){$sa_2_3=1;}else{$sa_2_3=0;}
		if($pr_1_1==on&&$pr_1_1_m==on){$pr_1_1=2;}else if($pr_1_1==on||$pr_1_1_m==on){$pr_1_1=1;}else{$pr_1_1=0;}
		if($pr_1_2==on&&$pr_1_2_m==on){$pr_1_2=2;}else if($pr_1_2==on||$pr_1_2_m==on){$pr_1_2=1;}else{$pr_1_2=0;}
		if($pr_1_3==on&&$pr_1_3_m==on){$pr_1_3=2;}else if($pr_1_3==on||$pr_1_3_m==on){$pr_1_3=1;}else{$pr_1_3=0;}
		if($pr_2_1==on&&$pr_2_1_m==on){$pr_2_1=2;}else if($pr_2_1==on||$pr_2_1_m==on){$pr_2_1=1;}else{$pr_2_1=0;}
		if($pr_2_2==on&&$pr_2_2_m==on){$pr_2_2=2;}else if($pr_2_2==on||$pr_2_2_m==on){$pr_2_2=1;}else{$pr_2_2=0;}
		if($pr_2_3==on&&$pr_2_3_m==on){$pr_2_3=2;}else if($pr_2_3==on||$pr_2_3_m==on){$pr_2_3=1;}else{$pr_2_3=0;}
		if($ca_1_1==on&&$ca_1_1_m==on){$ca_1_1=2;}else if($ca_1_1==on||$ca_1_1_m==on){$ca_1_1=1;}else{$ca_1_1=0;}
		if($ca_1_2==on&&$ca_1_2_m==on){$ca_1_2=2;}else if($ca_1_2==on||$ca_1_2_m==on){$ca_1_2=1;}else{$ca_1_2=0;}
		if($ca_1_3==on&&$ca_1_3_m==on){$ca_1_3=2;}else if($ca_1_3==on||$ca_1_3_m==on){$ca_1_3=1;}else{$ca_1_3=0;}
		if($ca_2_1==on&&$ca_2_1_m==on){$ca_2_1=2;}else if($ca_2_1==on||$ca_2_1_m==on){$ca_2_1=1;}else{$ca_2_1=0;}
		if($ca_2_2==on&&$ca_2_2_m==on){$ca_2_2=2;}else if($ca_2_2==on||$ca_2_2_m==on){$ca_2_2=1;}else{$ca_2_2=0;}
		if($ct_1_1==on&&$ct_1_1_m==on){$ct_1_1=2;}else if($ct_1_1==on||$ct_1_1_m==on){$ct_1_1=1;}else{$ct_1_1=0;}
		if($ct_1_2==on&&$ct_1_2_m==on){$ct_1_2=2;}else if($ct_1_2==on||$ct_1_2_m==on){$ct_1_2=1;}else{$ct_1_2=0;}
		if($ct_2_1==on&&$ct_2_1_m==on){$ct_2_1=2;}else if($ct_2_1==on||$ct_2_1_m==on){$ct_2_1=1;}else{$ct_2_1=0;}
		if($ct_2_2==on&&$ct_2_2_m==on){$ct_2_2=2;}else if($ct_2_2==on||$ct_2_2_m==on){$ct_2_2=1;}else{$ct_2_2=0;}
		if($cg_1_1==on&&$cg_1_1_m==on){$cg_1_1=2;}else if($cg_1_1==on||$cg_1_1_m==on){$cg_1_1=1;}else{$cg_1_1=0;}
		if($cg_1_2==on&&$cg_1_2_m==on){$cg_1_2=2;}else if($cg_1_2==on||$cg_1_2_m==on){$cg_1_2=1;}else{$cg_1_2=0;}
		if($cg_1_3==on&&$cg_1_3_m==on){$cg_1_3=2;}else if($cg_1_3==on||$cg_1_3_m==on){$cg_1_3=1;}else{$cg_1_3=0;}
		if($cg_1_4==on&&$cg_1_4_m==on){$cg_1_4=2;}else if($cg_1_4==on||$cg_1_4_m==on){$cg_1_4=1;}else{$cg_1_4=0;}
		if($cg_2_1==on&&$cg_2_1_m==on){$cg_2_1=2;}else if($cg_2_1==on||$cg_2_1_m==on){$cg_2_1=1;}else{$cg_2_1=0;}
		if($cg_2_2==on&&$cg_2_2_m==on){$cg_2_2=2;}else if($cg_2_2==on||$cg_2_2_m==on){$cg_2_2=1;}else{$cg_2_2=0;}


		 ### 이미 권한 설정 테이블에 등록 된 회원인지 확인###
		 $query4="select * from cms_mem_auth where user_no='$user_no' or user_id='$user_id'";
		 $result4=mysql_query($query4, $connect);
		 $total_num4=mysql_num_rows($result4);

		 if($total_num4){   // 같은 정보가 있을 때 쿼리를 UPDATE
			 $auth_qry= " UPDATE cms_mem_auth SET user_id='$user_id',
															  sa_1_1='$sa_1_1',
															  sa_1_2='$sa_1_2',
															  sa_1_3='$sa_1_3',
															  sa_2_1='$sa_2_1',
															  sa_2_2='$sa_2_2',
															  sa_2_3='$sa_2_3',
															  pr_1_1='$pr_1_1',
															  pr_1_2='$pr_1_2',
															  pr_1_3='$pr_1_3',
															  pr_2_1='$pr_2_1',
															  pr_2_2='$pr_2_2',
															  pr_2_3='$pr_2_3',
															  ca_1_1='$ca_1_1',
															  ca_1_2='$ca_1_2',
															  ca_1_3='$ca_1_3',
															  ca_2_1='$ca_2_1',
															  ca_2_2='$ca_2_2',
															  ct_1_1='$ct_1_1',
															  ct_1_2='$ct_1_2',
															  ct_2_1='$ct_2_1',
															  ct_2_2='$ct_2_2',
															  cg_1_1='$cg_1_1',
															  cg_1_2='$cg_1_2',
															  cg_1_3='$cg_1_3',
															  cg_1_4='$cg_1_4',
															  cg_2_1='$cg_2_1',
															  cg_2_2='$cg_2_2'
							    WHERE user_no='$user_no' ";


		 } else {       // 처음 등록일 때는 쿼리를 INSERT
			 $auth_qry= "INSERT INTO `cms_mem_auth` ( `user_no`, `user_id`, `sa_1_1`, `sa_1_2`, `sa_1_3`, `sa_2_1`, `sa_2_2`, `sa_2_3`, `pr_1_1`, `pr_1_2`, `pr_1_3`, `pr_2_1`, `pr_2_2`, `pr_2_3`, `ca_1_1`, `ca_1_2`, `ca_1_3`, `ca_2_1`, `ca_2_2`, `ct_1_1`, `ct_1_2`, `ct_2_1`, `ct_2_2`, `cg_1_1`, `cg_1_2`, `cg_1_3`, `cg_1_4`, `cg_2_1`, `cg_2_2`)

							 VALUES('$user_no', '$user_id', '$sa_1_1', '$sa_1_2', '$sa_1_3', '$sa_2_1', '$sa_2_2', '$sa_2_3', '$pr_1_1', '$pr_1_2', '$pr_1_3', '$pr_2_1', '$pr_2_2', '$pr_2_3', '$ca_1_1', '$ca_1_2', '$ca_1_3', '$ca_2_1', '$ca_2_2', '$ct_1_1', '$ct_1_2', '$ct_2_1', '$ct_2_2', '$cg_1_1', '$cg_1_2', '$cg_1_3', '$cg_1_4', '$cg_2_1', '$cg_2_2')";
		 }
		 $auth_rlt=mysql_query($auth_qry, $connect);

		 // 저장 과정에서 오류가 생기면

		 if(!$auth_rlt){
				err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		 } else {
				echo ("<script>
				    			window.alert('정상적으로 사용자 권한정보가 등록(변경) 되었습니다!');
						   </script>");
			  echo "<meta http-equiv='Refresh' content='0; URL=config_main.php?m_di=2&s_di=2&ms=$ms&mn=$mn'>";
		 }
	}
?>
