<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?
	include "setup_lib.php";
	include "schema.sql";

	if(file_exists("config_set.php")) err_msg("이미 config_set.php가 생성되어 있습니다.<br><br>재설치하려면 해당 파일을 지우세요");

	$hostname = $_REQUEST['hostname'];
	$user_id = $_REQUEST['user_id'];
	$passwd = $_REQUEST['passwd'];
	$dbname = $_REQUEST['dbname'];

// 호스트네임, 아이디, DB네임, 비밀번호의 공백여부 검사
	if(isBlank($hostname)) err_msg("HostName을 입력하세요","");
	if(isBlank($user_id)) err_msg("User ID 를 입력하세요","");
	if(isBlank($dbname)) err_msg("DB NAME을 입력하세요","");

// DB에 커넥트 하고 DB NAME으로 select DB
	$connect = @mysql_connect($hostname,$user_id,$passwd) or err_msg("MySQL-DB Connect<br>Error!!!","");
	mysql_select_db($dbname, $connect ) or err_msg("MySQL-DB Select<br>Error!!!","");

// DB 테이블의 생성유무 검사
	function istable($str, $dbname='') {
		global $config_dir;
		if(!$dbname) {
			$f=@file($config_dir."config_set.php") or err_msg("config_set.php파일이 없습니다.<br>DB설정을 먼저 하십시요","install.php");
			for($i=1;$i<=4;$i++) $f[$i]=str_replace("\n","",$f[$i]);
			$dbname=$f[4];
		}
		$result = mysql_list_tables($dbname) or mysql_error();
		$i=0;
		while($i< mysql_num_rows($result)){
			if($str==mysql_tablename ($result, $i)) return 1;
			$i++;
		}
		return 0;
	}

	echo $accouts_tb."<br>";
	echo $accouts_tb_schema."<br>";
	echo $board_no_tb."<br>";
	echo $board_no_tb_schema."<br>";
	echo $cap_acc_d1_tb."<br>";
	echo $cap_acc_d1_tb_schema."<br>";
	echo $cap_acc_d1_tb_insert_schema."<br>";
	echo $cap_acc_d2_tb."<br>";
	echo $cap_acc_d2_tb_schema."<br>";
	echo $cap_acc_d2_tb_insert_schema."<br>";
	echo $cap_acc_d3_tb."<br>";
	echo $cap_acc_d3_tb_schema."<br>";
	echo $cap_acc_d3_tb_insert_schema."<br>";
	echo $cap_bank_acc_tb."<br>";
	echo $cap_bank_acc_tb_schema."<br>";
	echo $cap_bank_acc_tb_insert_schema."<br>";
	echo $cap_bank_code_tb."<br>";
	echo $cap_bank_code_tb_schema."<br>";
	echo $cap_bank_code_tb_insert_schema."<br>";
	echo $cap_cash_book_tb."<br>";
	echo $cap_cash_book_tb_schema."<br>";
	echo $com_div_tb."<br>";
	echo $com_div_tb_schema."<br>";
	echo $com_div_mem_tb."<br>";
	echo $com_div_mem_tb_schema."<br>";
	echo $com_info_tb."<br>";
	echo $com_info_tb_schema."<br>";
	echo $customers_tb."<br>";
	echo $customers_tb_schema."<br>";
	echo $member_tb."<br>";
	echo $member_tb_schema."<br>";
	echo $mem_auth_tb."<br>";
	echo $mem_auth_tb_schema."<br>";
	echo $message_tb."<br>";
	echo $message_tb_schema."<br>";
	echo $project_db_tb."<br>";
	echo $project_db_tb_schema."<br>";
	echo $project_if_tb."<br>";
	echo $project_if_tb_schema."<br>";
	echo $resource_h_tb."<br>";
	echo $resource_h_tb_schema."<br>";
	echo $resource_t_tb."<br>";
	echo $resource_t_tb_schema."<br>";
	echo $resource_m_tb."<br>";
	echo $resource_m_tb_schema."<br>";
	echo $stock_d1_tb."<br>";
	echo $stock_d1_tb_schema."<br>";
	echo $stock_d2_tb."<br>";
	echo $stock_d2_tb_schema."<br>";
	echo $stock_d3_tb."<br>";
	echo $stock_d3_tb_schema."<br>";
	echo $stock_d4_tb."<br>";
	echo $stock_d4_tb_schema."<br>";
	echo $stock_main_tb."<br>";
	echo $stock_main_tb_schema."<br>";
	echo $tax_office_tb."<br>";
	echo $tax_office_tb_schema."<br>";
	echo $tax_office_tb_insert_schema."<br>";
	echo $work_coun_log_tb."<br>";
	echo $work_coun_log_tb_schema."<br>";
	echo $work_log_tb."<br>";
	echo $work_log_tb_schema."<br>";
	echo $work_rep_tb."<br>";
	echo $work_rep_tb_schema."<br>";
	echo $zipcode_tb."<br>";
	echo $zipcode_tb_schema."<br>";
	
//  거래처 정보 테이블 생성
	if(!isTable($accouts_tb,$dbname)) @mysql_query($accouts_tb_schema, $connect) or err_msg("거래처 정보 테이블 생성 실패","");
	else $accouts_tb_exist=1;

//  공지사항 게시판 테이블 생성
	if(!isTable($board_no_tb,$dbname)) @mysql_query($board_no_tb_schema, $connect) or err_msg("공지사항 게시판 테이블 생성 실패","");
	else $board_no_tb_exist=1;

//  회계 계정과목 1 테이블 생성
	if(!isTable($cap_acc_d1_tb,$dbname)) @mysql_query($cap_acc_d1_tb_schema, $connect) or err_msg("회계 계정과목1 테이블 생성 실패","");
	else $cap_acc_d1_tb_exist=1;

// 회계 계정과목 1 데이터 입력
	@mysql_query($cap_acc_d1_tb_insert_schema, $connect) or err_msg("회계 계정과목1 데이터 입력 실패","");

//  회계 계정과목 2 테이블 생성
	if(!isTable($cap_acc_d2_tb,$dbname)) @mysql_query($cap_acc_d2_tb_schema, $connect) or err_msg("회계 계정과목2 테이블 생성 실패","");
	else $cap_acc_d2_tb_exist=1;

// 회계 계정과목 2 데이터 입력
	@mysql_query($cap_acc_d2_tb_insert_schema, $connect) or err_msg("회계 계정과목2 데이터 입력 실패","");

//  회계 계정과목 3 테이블 생성
	if(!isTable($cap_acc_d3_tb,$dbname)) @mysql_query($cap_acc_d3_tb_schema, $connect) or err_msg("회계 계정과목3 테이블 생성 실패","");
	else $cap_acc_d3_tb_exist=1;

// 회계 계정과목 3 데이터 입력
	@mysql_query($cap_acc_d3_tb_insert_schema, $connect) or err_msg("회계 계정과목3 데이터 입력 실패","");

//  은행계좌 테이블 생성
	if(!isTable($cap_bank_acc_tb,$dbname)) @mysql_query($cap_bank_acc_tb_schema, $connect) or err_msg("은행계좌 테이블 생성 실패","");
	else $cap_bank_acc_tb_exist=1;

//  은행계좌 현금계정 데이터 입력
	@mysql_query($cap_bank_acc_tb_insert_schema, $connect) or err_msg("은행계좌 현금계정 데이터 입력 실패","");

//  은행코드 테이블 생성
	if(!isTable($cap_bank_code_tb,$dbname)) @mysql_query($cap_bank_code_tb_schema, $connect) or err_msg("은행코드 테이블 생성 실패","");
	else $cap_bank_code_tb_exist=1;

// 은행코드 테이블 데이터 입력
	@mysql_query($cap_bank_code_tb_insert_schema, $connect) or err_msg("은행코드 데이터 입력 실패","");

//  거래기록부//금전출납부 테이블 생성
	if(!isTable($cap_cash_book_tb,$dbname)) @mysql_query($cap_cash_book_tb_schema, $connect) or err_msg("거래기록부//금전출납부 테이블 생성 실패","");
	else $cap_cash_book_tb_exist=1;

//  회사 부서 테이블 생성
	if(!isTable($com_div_tb,$dbname)) @mysql_query($com_div_tb_schema, $connect) or err_msg("회사 부서 테이블 생성 실패","");
	else $com_div_tb_exist=1;

//  회사 부서별 멤버 테이블 생성
	if(!isTable($com_div_mem_tb,$dbname)) @mysql_query($com_div_mem_tb_schema, $connect) or err_msg("회사 부서별 멤버 테이블 생성 실패","");
	else $com_div_mem_tb_exist=1;

//  회사 정보 테이블 생성
	if(!isTable($com_info_tb,$dbname)) @mysql_query($com_info_tb_schema, $connect) or err_msg("회사 정보 테이블 생성 실패","");
	else $com_info_tb_exist=1;

//  고객정보 DB 테이블 생성
	if(!isTable($customers_tb,$dbname)) @mysql_query($customers_tb_schema, $connect) or err_msg("고객정보 DB 테이블 생성 실패","");
	else $customers_tb_exist=1;

// 회원들의 데이터가 들어있는 직접적인 테이블 생성
	if(!isTable($member_tb,$dbname)) @mysql_query($member_tb_schema, $connect) or err_msg("회원 데이터 테이블 생성 실패","");
	else $member_tb_exist=1;

//  회원 권한 설정 테이블 생성
	if(!isTable($mem_auth_tb,$dbname)) @mysql_query($mem_auth_tb_schema, $connect) or err_msg("회원 권한 설정 테이블 생성 실패","");
	else $mem_auth_tb_exist=1;

//  메세지 테이블 생성
	if(!isTable($message_tb,$dbname)) @mysql_query($message_tb_schema, $connect) or err_msg("메세지 테이블 생성 실패","");
	else $message_tb_exist=1;

//   현장 데이터 테이블 생성
	if(!isTable($project_db_tb,$dbname)) @mysql_query($project_db_tb_schema, $connect) or err_msg(" 현장 데이터 테이블 생성 실패","");
	else $project_db_tb_exist=1;

//  현장 정보 테이블 생성
	if(!isTable($project_if_tb,$dbname)) @mysql_query($project_if_tb_schema, $connect) or err_msg("현장 정보 테이블 생성 실패","");
	else $project_if_tb_exist=1;

//  현장 인원 본부 정보 테이블 생성
	if(!isTable($resource_h_tb,$dbname)) @mysql_query($resource_h_tb_schema, $connect) or err_msg("현장 인원 본부 정보 테이블 생성 실패","");
	else $resource_h_tb_exist=1;

//  현장 인원 팀 정보 테이블 생성
	if(!isTable($resource_t_tb,$dbname)) @mysql_query($resource_t_tb_schema, $connect) or err_msg("현장 인원 팀 정보 테이블 생성 실패","");
	else $resource_t_tb_exist=1;

//  현장 인원 팀원 정보 테이블 생성
	if(!isTable($resource_m_tb,$dbname)) @mysql_query($resource_m_tb_schema, $connect) or err_msg("현장 인원 팀원 정보 테이블 생성 실패","");
	else $resource_m_tb_exist=1;

//  재고 1차 분류 테이블 생성
	if(!isTable($stock_d1_tb,$dbname)) @mysql_query($stock_d1_tb_schema, $connect) or err_msg("재고 1차 분류 테이블 생성 실패","");
	else $stock_d1_tb_exist=1;

//  재고 2차 분류 테이블 생성
	if(!isTable($stock_d2_tb,$dbname)) @mysql_query($stock_d2_tb_schema, $connect) or err_msg("재고 2차 분류 테이블 생성 실패","");
	else $stock_d2_tb_exist=1;

//  재고 3차 분류 테이블 생성
	if(!isTable($stock_d3_tb,$dbname)) @mysql_query($stock_d3_tb_schema, $connect) or err_msg("재고 3차 분류 테이블 생성 실패","");
	else $stock_d3_tb_exist=1;

//  재고 4차 분류 테이블 생성
	if(!isTable($stock_d4_tb,$dbname)) @mysql_query($stock_d4_tb_schema, $connect) or err_msg("재고 4차 분류 테이블 생성 실패","");
	else $stock_d4_tb_exist=1;

//  재고 메인 테이블 생성
	if(!isTable($stock_main_tb,$dbname)) @mysql_query($stock_main_tb_schema, $connect) or err_msg("재고 메인 테이블 생성 실패","");
	else $stock_main_tb_exist=1;

//  세무서 정보 테이블 생성
	if(!isTable($tax_office_tb,$dbname)) @mysql_query($tax_office_tb_schema, $connect) or err_msg("세무서 정보 테이블 생성 실패","");
	else $tax_office_tb_exist=1;

// 세무서 정보 테이블 데이터 입력
	@mysql_query($tax_office_tb_insert_schema, $connect) or err_msg("세무서 정보 데이터 입력 실패","");

//  상담일지 기록 테이블 생성
	if(!isTable($work_coun_log_tb,$dbname)) @mysql_query($work_coun_log_tb_schema, $connect) or err_msg("상담일지 기록 테이블 생성 실패","");
	else $work_coun_log_tb_exist=1;

//  업무일지 기록 테이블 생성
	if(!isTable($work_log_tb,$dbname)) @mysql_query($work_log_tb_schema, $connect) or err_msg("업무일지 기록 테이블 생성 실패","");
	else $work_log_tb_exist=1;

//  업무보고 기록 테이블 생성
	if(!isTable($work_rep_tb,$dbname)) @mysql_query($work_rep_tb_schema, $connect) or err_msg("업무보고 기록 테이블 생성 실패","");
	else $work_rep_tb_exist=1;

//  우편번호 테이블 생성
	if(!isTable($zipcode_tb,$dbname)) @mysql_query($zipcode_tb_schema, $connect) or err_msg("우편번호 테이블 생성 실패","");
	else $zipcode_tb_exist=1;



// 파일로 DB 정보 저장
	$file=@fopen("config_set.php","w") or err_msg("config_set.php 파일 생성 실패<br><br>디렉토리의 퍼미션을 707로 주십시요","");
	@fwrite($file,"$hostname\n$user_id\n$passwd\n$dbname\n") or err_msg("config_set.php 파일 생성 실패<br><br>디렉토리의 퍼미션을 707로 주십시요","");
	@fclose($file);
	// @mkdir("data",0707);
	// @mkdir("icon",0707);
	// @mkdir("icon/member_image_box",0707);
	// @mkdir("icon/private_icon",0707);
	// @mkdir("icon/private_name",0707);
	// @chmod("icon/member_image_box",0707);
	// @chmod("icon/private_icon",0707);
	// @chmod("icon/private_name",0707);
	// @chmod("data",0707);
	// @chmod("icon",0707);
	@chmod("config_set.php",0707);

	$temp=mysql_fetch_array(mysql_query("select count(*) from $member_tb where is_admin = '1'",$connect));



	mysql_close($connect);

	if($temp[0]) {
		 echo "<meta http-equiv='Refresh' content='0; URL=../member/login_form.php'>";
	}
	else {        // 관리자 정보가 없을때 관리자 정보 입력
		 echo "<meta http-equiv='Refresh' content='0; URL=install2.php?hostname=$hostname&user_id=$user_id&passwd=$passwd&dbname=$dbname'>";
	}
?>
