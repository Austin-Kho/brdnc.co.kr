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
	$pj_seq = $_REQUEST['pj_seq'];				 // 프로젝트 고유 코드
	$data_cr = $_REQUEST['data_cr'];           // 관리유형 -- 동호수 / 계약번호
	$cont_date = $_REQUEST['cont_date'];	 // 계약(청약)일자-------------------------------????
	$cont_sort2 = $_REQUEST['cont_sort2'];	 // 청약 / 계약 여부
	$cont_sort3 = $_REQUEST['cont_sort3'];   // 청약해지 / 계약해지 여부
	$diff_no = $_REQUEST['diff_no'];               // 차수
	$type = $_REQUEST['type'];                      // 타입
	$dong = $_REQUEST['dong'];                   // 동
	$ho = $_REQUEST['ho'];                            // 호
	$con_no = $_REQUEST['con_no'];            // 계약관리번호

	/////////////////////////////////////////////////////////
	$cust_name = $_REQUEST['cust_name']; // 계약자 ------------------------------------------------???
	$tel_1 = $_REQUEST['tel_1'];    // 연락처 1 -----------------------------???
	$tel_2 = $_REQUEST['tel_2'];    // 연락처 2	----------------------------???
	$id_addr = $_REQUEST['id_zip'].":".$_REQUEST['id_addr1'].":".$_REQUEST['id_addr2'];    // 계약자 주민등록상 주소
	$dm_addr = $_REQUEST['dm_zip'].":".$_REQUEST['dm_addr1'].":".$_REQUEST['dm_addr2'];    // 계약자 우편송부 주소

	$doc_1 = $_REQUEST['doc_1']; // 각서9중
	$doc_2 = $_REQUEST['doc_2']; // 주민등록등본
	$doc_3 = $_REQUEST['doc_3']; // 주민등록초본
	$doc_4 = $_REQUEST['doc_4']; // 가족관계증명서
	$doc_5 = $_REQUEST['doc_5']; // 인감증명서(날인)
	$doc_6 = $_REQUEST['doc_6']; // 사용인감(막도장)
	$doc_7 = $_REQUEST['doc_7']; // 신분증
	$doc_8 = $_REQUEST['doc_8']; // 배우자 등본

	$cha_1 = $_REQUEST['cha_1'];   // 업무대행비 1차
	$cha_1_date = $_REQUEST['cha_1_date'];
	$cha_1_who = $_REQUEST['cha_1_who'];

	$cha_2 = $_REQUEST['cha_2'];   // 업무대행비 2차
	$cha_2_date = $_REQUEST['cha_2_date'];
	$cha_2_who = $_REQUEST['cha_2_who'];

	$cha_3 = $_REQUEST['cha_3'];   // 업무대행비 3차
	$cha_3_date = $_REQUEST['cha_3_date'];
	$cha_3_who = $_REQUEST['cha_3_who'];

	$cha_4 = $_REQUEST['cha_4'];   // 업무대행비 4차
	$cha_4_date = $_REQUEST['cha_4_date'];
	$cha_4_who = $_REQUEST['cha_4_who'];


	$de_11 = $_REQUEST['de_11']; // (청약)계약금---------------------------------------------???
	$de_11_date = $_REQUEST['de_11_date'];
	$de_11_who = $_REQUEST['de_11_who'];

	$de_12 = $_REQUEST['de_12'];
	$de_12_date = $_REQUEST['de_12_date'];
	$de_12_who = $_REQUEST['de_12_who'];

	$de_13= $_REQUEST['de_13'];
	$de_13_date = $_REQUEST['de_13_date'];
	$de_13_who = $_REQUEST['de_13_who'];
	//--------------------------------------------------------------------------------계약금1차

	$de_21 = $_REQUEST['de_21']; // ---------------------------------------------------계약금2차
	$de_21_date = $_REQUEST['de_21_date'];
	$de_21_who = $_REQUEST['de_21_who'];

	$de_22 = $_REQUEST['de_22'];
	$de_22_date = $_REQUEST['de_22_date'];
	$de_22_who = $_REQUEST['de_22_who'];

	$de_23= $_REQUEST['de_23'];
	$de_23_date = $_REQUEST['de_23_date'];
	$de_23_who = $_REQUEST['de_23_who'];
	//--------------------------------------------------------------------------------계약금2차
	$de_31 = $_REQUEST['de_31']; // ---------------------------------------------------계약금3차
	$de_31_date = $_REQUEST['de_31_date'];
	$de_31_who = $_REQUEST['de_31_who'];

	$de_32 = $_REQUEST['de_32'];
	$de_32_date = $_REQUEST['de_32_date'];
	$de_32_who = $_REQUEST['de_32_who'];

	$de_33= $_REQUEST['de_33'];
	$de_33_date = $_REQUEST['de_33_date'];
	$de_33_who = $_REQUEST['de_33_who'];
	//--------------------------------------------------------------------------------계약금3차
	$de_41 = $_REQUEST['de_41']; // ---------------------------------------------------계약금4차
	$de_41_date = $_REQUEST['de_41_date'];
	$de_41_who = $_REQUEST['de_41_who'];

	$de_42 = $_REQUEST['de_42'];
	$de_42_date = $_REQUEST['de_42_date'];
	$de_42_who = $_REQUEST['de_42_who'];

	$de_43= $_REQUEST['de_43'];
	$de_43_date = $_REQUEST['de_43_date'];
	$de_43_who = $_REQUEST['de_43_who'];
	//--------------------------------------------------------------------------------계약금4차

	$mp_11 = $_REQUEST['mp_11']; // ---------------------------------------------------중도금1차
	$mp_11_date = $_REQUEST['mp_11_date'];
	$mp_11_who = $_REQUEST['mp_11_who'];

	$mp_12 = $_REQUEST['mp_12'];
	$mp_12_date = $_REQUEST['mp_12_date'];
	$mp_12_who = $_REQUEST['mp_12_who'];

	$mp_13= $_REQUEST['mp_13'];
	$mp_13_date = $_REQUEST['mp_13_date'];
	$mp_13_who = $_REQUEST['mp_13_who'];
	//--------------------------------------------------------------------------------중도금1차
	$mp_21 = $_REQUEST['mp_21']; // ---------------------------------------------------중도금2차
	$mp_21_date = $_REQUEST['mp_21_date'];
	$mp_21_who = $_REQUEST['mp_21_who'];

	$mp_22 = $_REQUEST['mp_22'];
	$mp_22_date = $_REQUEST['mp_22_date'];
	$mp_22_who = $_REQUEST['mp_22_who'];

	$mp_23= $_REQUEST['mp_23'];
	$mp_23_date = $_REQUEST['mp_23_date'];
	$mp_23_who = $_REQUEST['mp_23_who'];
	//--------------------------------------------------------------------------------중도금2차
	$mp_31 = $_REQUEST['mp_31']; // ---------------------------------------------------중도금3차
	$mp_31_date = $_REQUEST['mp_31_date'];
	$mp_31_who = $_REQUEST['mp_31_who'];

	$mp_32 = $_REQUEST['mp_32'];
	$mp_32_date = $_REQUEST['mp_32_date'];
	$mp_32_who = $_REQUEST['mp_32_who'];

	$mp_33= $_REQUEST['mp_33'];
	$mp_33_date = $_REQUEST['mp_33_date'];
	$mp_33_who = $_REQUEST['mp_33_who'];
	//--------------------------------------------------------------------------------중도금3차
	$mp_41 = $_REQUEST['mp_41']; // ---------------------------------------------------중도금4차
	$mp_41_date = $_REQUEST['mp_41_date'];
	$mp_41_who = $_REQUEST['mp_41_who'];

	$mp_42 = $_REQUEST['mp_42'];
	$mp_42_date = $_REQUEST['mp_42_date'];
	$mp_42_who = $_REQUEST['mp_42_who'];

	$mp_43= $_REQUEST['mp_43'];
	$mp_43_date = $_REQUEST['mp_43_date'];
	$mp_43_who = $_REQUEST['mp_43_who'];
	//--------------------------------------------------------------------------------중도금4차
	$mp_51 = $_REQUEST['mp_51']; // ---------------------------------------------------중도금5차
	$mp_51_date = $_REQUEST['mp_51_date'];
	$mp_51_who = $_REQUEST['mp_51_who'];

	$mp_52 = $_REQUEST['mp_52'];
	$mp_52_date = $_REQUEST['mp_52_date'];
	$mp_52_who = $_REQUEST['mp_52_who'];

	$mp_53= $_REQUEST['mp_53'];
	$mp_53_date = $_REQUEST['mp_53_date'];
	$mp_53_who = $_REQUEST['mp_53_who'];
	//--------------------------------------------------------------------------------중도금5차
	$mp_61 = $_REQUEST['mp_61']; // ---------------------------------------------------중도금6차
	$mp_61_date = $_REQUEST['mp_61_date'];
	$mp_61_who = $_REQUEST['mp_61_who'];

	$mp_62 = $_REQUEST['mp_62'];
	$mp_62_date = $_REQUEST['mp_62_date'];
	$mp_62_who = $_REQUEST['mp_62_who'];

	$mp_63= $_REQUEST['mp_63'];
	$mp_63_date = $_REQUEST['mp_63_date'];
	$mp_63_who = $_REQUEST['mp_63_who'];
	//--------------------------------------------------------------------------------중도금6차
	$mp_71 = $_REQUEST['mp_71']; // ---------------------------------------------------중도금7차
	$mp_71_date = $_REQUEST['mp_71_date'];
	$mp_71_who = $_REQUEST['mp_71_who'];

	$mp_72 = $_REQUEST['mp_72'];
	$mp_72_date = $_REQUEST['mp_72_date'];
	$mp_72_who = $_REQUEST['mp_72_who'];

	$mp_73= $_REQUEST['mp_73'];
	$mp_73_date = $_REQUEST['mp_73_date'];
	$mp_73_who = $_REQUEST['mp_73_who'];
	//--------------------------------------------------------------------------------중도금7차

	$lp_1 = $_REQUEST['lp_1']; // ---------------------------------------------------잔금
	$lp_1_date = $_REQUEST['lp_1_date'];
	$lp_1_who = $_REQUEST['lp_1_who'];

	$lp_2 = $_REQUEST['lp_2'];
	$lp_2_date = $_REQUEST['lp_2_date'];
	$lp_2_who = $_REQUEST['lp_2_who'];

	$lp_3= $_REQUEST['lp_3'];
	$lp_3_date = $_REQUEST['lp_3_date'];
	$lp_3_who = $_REQUEST['lp_3_who'];
	//--------------------------------------------------------------------------------잔금

	$due_date = $_REQUEST['due_date'];   // 청약 시 계약 예정일(기한)

	$refund = $_REQUEST['refund'];   // 해지 환불 완료 여부

	$mgm_to = $_REQUEST['mgm_to'];      // MGM 지급대상
	$mgm_sum = $_REQUEST['mgm_sum'];  // MGM 지급금액

	$headq = $_REQUEST['headq'];              // 소속본부
	$team = $_REQUEST['team'];                   // 소속 팀
	$worker_where = $headq."-".$team;        // 담당직원 소속 입력형식 데이터
	$worker = $_REQUEST['worker'];             // 담당직원

	$note = $_REQUEST['note'];                    // 비 고

	if($data_cr==0) { // 동호수별 관리일 때
		$where_qry = "WHERE pj_seq = '$pj_seq'
									AND type_ho = '$type'
									AND pj_dong = '$dong'
									AND pj_ho = '$ho'";
	}else if($data_cr==1){ // 계약서번호별 관리일 때
		$where_qry = "WHERE pj_seq = '$pj_seq'
									AND type_ho = '$type'
									AND con_no = '$con_no' ";
	}
	/////////////////////////////////////////////////////////


	// 변수 다 받았으면 이제부터 시작
	############### DB UPDATE ##############

	if($cont_sort2==1&&$cont_sort3<>3&&$cont_sort3<>4){ // 청약일때
		$query1 = " UPDATE cms_project_data SET is_pro_cont = '1',
													pro_cont_date = '$cont_date',
													pro_contractor = '$cust_name',
													pro_cont_tel_1 = '$tel_1',
													pro_cont_tel_2 = '$tel_2',
													pro_deposit = '$de_11',
													pro_due_date = '$due_date',
													cancel = '0',
													refund = '0',

													is_contract = '',

													cont_date = '',
													contractor = '',
													cont_tel_1 = '',
													cont_tel_2 = '',
													cont_id_addr = '',
													cont_dm_addr = '',
													deposit_1st_1 = '',
													cont_mgm_who = '',
													cont_mgm_sum = '',

													worker_where = '$worker_where',
													cont_worker = '$worker',
													note = '$note',
													updater = '$_SESSION[p_name]',
													reg_time = now() ".$where_qry;

	}else if($cont_sort2==2&&$cont_sort3<>3&&$cont_sort3<>4){ // 계약일때
		$query1 =" UPDATE cms_project_data SET is_pro_cont = '',
													 pj_dong = '$dong',
													 pj_ho = '$ho',
													 pro_deposit = '',
													 is_contract = '1',
													 cont_date = '$cont_date',
													 contractor = '$cust_name',
													 cont_tel_1 = '$tel_1',
													 cont_tel_2 = '$tel_2',
													 cont_id_addr = '$id_addr',
													 cont_dm_addr = '$dm_addr',
													 doc_1 = '$doc_1',
													 doc_2 = '$doc_2',
													 doc_3 = '$doc_3',
													 doc_4 = '$doc_4',
													 doc_5 = '$doc_5',
													 doc_6 = '$doc_6',
													 doc_7 = '$doc_7',
													 doc_8 = '$doc_8',
													 charge_1 = '$cha_1',
													 charge_1_date = '$cha_1_date',
													 charge_1_who = '$cha_1_who',
													 charge_2 = '$cha_2',
													 charge_2_date = '$cha_2_date',
													 charge_2_who = '$cha_2_who',
													 charge_3 = '$cha_3',
													 charge_3_date = '$cha_3_date',
													 charge_3_who = '$cha_3_who',
													 charge_4 = '$cha_4',
													 charge_4_date = '$cha_4_date',
													 charge_4_who = '$cha_4_who',
													 deposit_1st_1 = '$de_11',
													 deposit_1st_1_date = '$de_11_date',
													 deposit_1st_1_who = '$de_11_who',
													 deposit_1st_2 = '$de_12',
													 deposit_1st_2_date = '$de_12_date',
													 deposit_1st_2_who = '$de_12_who',
													 deposit_1st_3 = '$de_13',
													 deposit_1st_3_date = '$de_13_date',
													 deposit_1st_3_who = '$de_13_who',
													 cont_mgm_who = '$mgm_to',
													 cont_mgm_sum = '$mgm_sum',
													 worker_where = '$worker_where',
													 cont_worker = '$worker',
													 deposit_2nd_1 = '$de_21',
													 deposit_2nd_1_date = '$de_21_date',
													 deposit_2nd_1_who = '$de_21_who',
													 deposit_2nd_2 = '$de_22',
													 deposit_2nd_2_date = '$de_22_date',
													 deposit_2nd_2_who = '$de_22_who',
													 deposit_2nd_3 = '$de_23',
													 deposit_2nd_3_date = '$de_23_date',
													 deposit_2nd_3_who = '$de_23_who',
													 deposit_3rd_1 = '$de_31',
													 deposit_3rd_1_date = '$de_31_date',
													 deposit_3rd_1_who = '$de_31_who',
													 deposit_3rd_2 = '$de_32',
													 deposit_3rd_2_date = '$de_32_date',
													 deposit_3rd_2_who = '$de_32_who',
													 deposit_3rd_3 = '$de_33',
													 deposit_3rd_3_date = '$de_33_date',
													 deposit_3rd_3_who = '$de_33_who',
													 deposit_4th_1 = '$de_41',
													 deposit_4th_1_date = '$de_41_date',
													 deposit_4th_1_who = '$de_41_who',
													 deposit_4th_2 = '$de_42',
													 deposit_4th_2_date = '$de_42_date',
													 deposit_4th_2_who = '$de_42_who',
													 deposit_4th_3 = '$de_43',
													 deposit_4th_3_date = '$de_43_date',
													 deposit_4th_3_who = '$de_43_who',

													 m_pay_1st_1 = '$mp_11',
													 m_pay_1st_1_date = '$mp_11_date',
													 m_pay_1st_1_who = '$mp_11_who',
													 m_pay_1st_2 = '$mp_12',
													 m_pay_1st_2_date = '$mp_12_date',
													 m_pay_1st_2_who = '$mp_12_who',
													 m_pay_1st_3 = '$mp_13',
													 m_pay_1st_3_date = '$mp_13_date',
													 m_pay_1st_3_who = '$mp_13_who',

													 m_pay_2nd_1 = '$mp_21',
													 m_pay_2nd_1_date = '$mp_21_date',
													 m_pay_2nd_1_who = '$mp_21_who',
													 m_pay_2nd_2 = '$mp_22',
													 m_pay_2nd_2_date = '$mp_22_date',
													 m_pay_2nd_2_who = '$mp_22_who',
													 m_pay_2nd_3 = '$mp_23',
													 m_pay_2nd_3_date = '$mp_23_date',
													 m_pay_2nd_3_who = '$mp_23_who',

													 m_pay_3rd_1 = '$mp_31',
													 m_pay_3rd_1_date = '$mp_31_date',
													 m_pay_3rd_1_who = '$mp_31_who',
													 m_pay_3rd_2 = '$mp_32',
													 m_pay_3rd_2_date = '$mp_32_date',
													 m_pay_3rd_2_who = '$mp_32_who',
													 m_pay_3rd_3 = '$mp_33',
													 m_pay_3rd_3_date = '$mp_33_date',
													 m_pay_3rd_3_who = '$mp_33_who',

													 m_pay_4th_1 = '$mp_41',
													 m_pay_4th_1_date = '$mp_41_date',
													 m_pay_4th_1_who = '$mp_41_who',
													 m_pay_4th_2 = '$mp_42',
													 m_pay_4th_2_date = '$mp_42_date',
													 m_pay_4th_2_who = '$mp_42_who',
													 m_pay_4th_3 = '$mp_43',
													 m_pay_4th_3_date = '$mp_43_date',
													 m_pay_4th_3_who = '$mp_43_who',

													 m_pay_5th_1 = '$mp_51',
													 m_pay_5th_1_date = '$mp_51_date',
													 m_pay_5th_1_who = '$mp_51_who',
													 m_pay_5th_2 = '$mp_52',
													 m_pay_5th_2_date = '$mp_52_date',
													 m_pay_5th_2_who = '$mp_52_who',
													 m_pay_5th_3 = '$mp_53',
													 m_pay_5th_3_date = '$mp_53_date',
													 m_pay_5th_3_who = '$mp_53_who',

													 m_pay_6th_1 = '$mp_61',
													 m_pay_6th_1_date = '$mp_61_date',
													 m_pay_6th_1_who = '$mp_61_who',
													 m_pay_6th_2 = '$mp_62',
													 m_pay_6th_2_date = '$mp_62_date',
													 m_pay_6th_2_who = '$mp_62_who',
													 m_pay_6th_3 = '$mp_63',
													 m_pay_6th_3_date = '$mp_63_date',
													 m_pay_6th_3_who = '$mp_63_who',

													 m_pay_7th_1 = '$mp_71',
													 m_pay_7th_1_date = '$mp_71_date',
													 m_pay_7th_1_who = '$mp_71_who',
													 m_pay_7th_2 = '$mp_72',
													 m_pay_7th_2_date = '$mp_72_date',
													 m_pay_7th_2_who = '$mp_72_who',
													 m_pay_7th_3 = '$mp_73',
													 m_pay_7th_3_date = '$mp_73_date',
													 m_pay_7th_3_who = '$mp_73_who',

													 last_pay_1 = '$lp_1',
													 last_pay_1_date = '$lp_1_date',
													 last_pay_1_who = '$lp_1_who',
													 last_pay_2 = '$lp_2',
													 last_pay_2_date = '$lp_2_date',
													 last_pay_2_who = '$lp_2_who',
													 last_pay_3 = '$lp_3',
													 last_pay_3_date = '$lp_3_date',
													 last_pay_3_who = '$lp_3_who',

													worker_where = '$worker_where',
													cont_worker = '$worker',
													note = '$note',
													updater = '$_SESSION[p_name]',
													reg_time = now() ".$where_qry;



	}else if($cont_sort3==3&&$cont_sort2<>1&&$cont_sort2<>2){ // 청약해지일때
		if($refund==0||$refund==null){ // 미환불일 때
			$query1 =" UPDATE cms_project_data SET pro_cont_date = '$cont_date',
													pro_contractor = '$cust_name',
													pro_cont_tel_1 = '$tel_1',
													pro_cont_tel_2 = '$tel_2',
													pro_deposit = '$deposit_1',
													pro_due_date = '$due_date',
													cancel = '1',

													is_contract = '',

													cont_date = '',
													contractor = '',
													cont_tel_1 = '',
													cont_tel_2 = '',
													cont_id_addr = '',
													cont_dm_addr = '',
													deposit_1st_1 = '',

													is_contract = '',
													worker_where = '$worker_where',
													cont_worker = '$worker',
													note = '$note',
													updater = '$_SESSION[p_name]',
													reg_time = now() ".$where_qry;

		}else if($refund==1){ // 환불 완료일 때
			$query1 =" UPDATE cms_project_data SET is_pro_cont = '',
													pro_cont_date = '$cont_date',
													pro_contractor = '$cust_name',
													pro_cont_tel_1 = '$tel_1',
													pro_cont_tel_2 = '$tel_2',
													pro_deposit = '',
													pro_due_date = '',
													cancel = '1',
													refund = '1',

													is_contract = '',
													worker_where = '$worker_where',
													cont_worker = '$worker',
													note = '$note',
													updater = '$_SESSION[p_name]',
													reg_time = now() ".$where_qry;
		}


	}else if($cont_sort3==4){ // 계약해지일때
		$query1 =" UPDATE cms_project_data SET is_pro_cont = '',
													pj_dong = '',
													pj_ho = '',
													pro_cont_date = '',
													pro_contractor = '',
													pro_cont_tel_1 = '',
													pro_cont_tel_2 = '',
													 pro_deposit = '',
													 pro_due_date = '',
													 cancel = '1',
													 is_contract = '',
													 cont_date = '',
													 contractor = '$cust_name',
													 cont_tel_1 = '',
													 cont_tel_2 = '',
													 cont_id_addr = '',
													 cont_dm_addr = '',
													 doc_1 = '',
													 doc_2 = '',
													 doc_3 = '',
													 doc_4 = '',
													 doc_5 = '',
													 doc_6 = '',
													 doc_7 = '',
													 doc_8 = '',
													 charge_1 = '',
													 charge_1_date = '',
													 charge_1_who = '',
													 charge_2 = '',
													 charge_2_date = '',
													 charge_2_who = '',
													 charge_3 = '',
													 charge_3_date = '',
													 charge_3_who = '',
													 charge_4 = '',
													 charge_4_date = '',
													 charge_4_who = '',
													 deposit_1st_1 = '',
													 deposit_1st_1_date = '',
													 deposit_1st_1_who = '',
													 deposit_1st_2 = '',
													 deposit_1st_2_date = '',
													 deposit_1st_2_who = '',
													 deposit_1st_3 = '',
													 deposit_1st_3_date = '',
													 deposit_1st_3_who = '',
													 cont_mgm_who = '',
													 cont_mgm_sum = '',
													 worker_where = '',
													 cont_worker = '',
													 deposit_2nd_1 = '',
													 deposit_2nd_1_date = '',
													 deposit_2nd_1_who = '',
													 deposit_2nd_2 = '',
													 deposit_2nd_2_date = '',
													 deposit_2nd_2_who = '',
													 deposit_2nd_3 = '',
													 deposit_2nd_3_date = '',
													 deposit_2nd_3_who = '',
													 deposit_3rd_1 = '',
													 deposit_3rd_1_date = '',
													 deposit_3rd_1_who = '',
													 deposit_3rd_2 = '',
													 deposit_3rd_2_date = '',
													 deposit_3rd_2_who = '',
													 deposit_3rd_3 = '',
													 deposit_3rd_3_date = '',
													 deposit_3rd_3_who = '',
													 deposit_4th_1 = '',
													 deposit_4th_1_date = '',
													 deposit_4th_1_who = '',
													 deposit_4th_2 = '',
													 deposit_4th_2_date = '',
													 deposit_4th_2_who = '',
													 deposit_4th_3 = '',
													 deposit_4th_3_date = '',
													 deposit_4th_3_who = '',
													 m_pay_1st_1 = '',
													 m_pay_1st_1_date = '',
													 m_pay_1st_1_who = '',
													 m_pay_1st_2 = '',
													 m_pay_1st_2_date = '',
													 m_pay_1st_2_who = '',
													 m_pay_1st_3 = '',
													 m_pay_1st_3_date = '',
													 m_pay_1st_3_who = '',
													 m_pay_2nd_1 = '',
													 m_pay_2nd_1_date = '',
													 m_pay_2nd_1_who = '',
													 m_pay_2nd_2 = '',
													 m_pay_2nd_2_date = '',
													 m_pay_2nd_2_who = '',
													 m_pay_2nd_3 = '',
													 m_pay_2nd_3_date = '',
													 m_pay_2nd_3_who = '',
													 m_pay_3rd_1 = '',
													 m_pay_3rd_1_date = '',
													 m_pay_3rd_1_who = '',
													 m_pay_3rd_2 = '',
													 m_pay_3rd_2_date = '',
													 m_pay_3rd_2_who = '',
													 m_pay_3rd_3 = '',
													 m_pay_3rd_3_date = '',
													 m_pay_3rd_3_who = '',
													 m_pay_4th_1 = '',
													 m_pay_4th_1_date = '',
													 m_pay_4th_1_who = '',
													 m_pay_4th_2 = '',
													 m_pay_4th_2_date = '',
													 m_pay_4th_2_who = '',
													 m_pay_4th_3 = '',
													 m_pay_4th_3_date = '',
													 m_pay_4th_3_who = '',
													 m_pay_5th_1 = '',
													 m_pay_5th_1_date = '',
													 m_pay_5th_1_who = '',
													 m_pay_5th_2 = '',
													 m_pay_5th_2_date = '',
													 m_pay_5th_2_who = '',
													 m_pay_5th_3 = '',
													 m_pay_5th_3_date = '',
													 m_pay_5th_3_who = '',
													 m_pay_6th_1 = '',
													 m_pay_6th_1_date = '',
													 m_pay_6th_1_who = '',
													 m_pay_6th_2 = '',
													 m_pay_6th_2_date = '',
													 m_pay_6th_2_who = '',
													 m_pay_6th_3 = '',
													 m_pay_6th_3_date = '',
													 m_pay_6th_3_who = '',
													 m_pay_7th_1 = '',
													 m_pay_7th_1_date = '',
													 m_pay_7th_1_who = '',
													 m_pay_7th_2 = '',
													 m_pay_7th_2_date = '',
													 m_pay_7th_2_who = '',
													 m_pay_7th_3 = '',
													 m_pay_7th_3_date = '',
													 m_pay_7th_3_who = '',
													 last_pay_1 = '',
													 last_pay_1_date = '',
													 last_pay_1_who = '',
													 last_pay_2 = '',
													 last_pay_2_date = '',
													 last_pay_2_who = '',
													 last_pay_3 = '',
													 last_pay_3_date = '',
													 last_pay_3_who = '',
													worker_where = '',
													cont_worker = '',
													note = '',
													updater = '$_SESSION[p_name]',
													reg_time = now() ".$where_qry;
	}

	$result1=mysql_query($query1, $connect);

	// 저장 과정에서 오류가 생기면
	if(!$result1){
		err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	} else {
		echo ("<script>
					window.alert('정상적으로 프로젝트(계약)정보가 변경 되었습니다!');
				 </script>");
		echo "<meta http-equiv='Refresh' content='0; URL=sales_main.php?m_di=2&s_di=1&pj_list=".$pj_seq."&pos_con_=2'>";
	}
?>