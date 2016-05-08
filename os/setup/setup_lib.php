<?
	// W3C P3P 규약설정
  @header ("P3P : CP=\"ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC\"");


	/*******************************************************************************
 	 * 에러 리포팅 설정과 register_globals_on일때 변수 재 정의
 	 ******************************************************************************/
 	@error_reporting(E_ALL ^ E_NOTICE);
        foreach($_GET as $key=>$val) $$key = del_html($val);
	@extract($HTTP_POST_VARS); 
	@extract($HTTP_SERVER_VARS); 
	@extract($HTTP_ENV_VARS);

	$page = (int)$page;

	$temp_filename=realpath(__FILE__);
	if($temp_filename) $config_dir=eregi_replace("setup_lib.php","",$temp_filename);
	else $config_dir="";

	/*******************************************************************************
 	 * 기본 변수 초기화. (php의 오류같지 않은 오류 때문에;; ㅡㅡ+)
 	 ******************************************************************************/
	unset($member);
	unset($group);
	unset($setup);
	unset($s_que);
    $select_arrange = str_replace(array("'",'"','\\'),'',$select_arrange);
    if(!in_array($desc,array('desc','asc'))) unset($desc);


	//  초기 헤더를 뿌려주는 부분;;;;
	function head($body="",$scriptfile=""){

		 global $group, $setup, $dir,$member, $PHP_SELF, $id, $_head_executived, $HTTP_COOKIE_VARS, $width;

		 if($_head_executived) return;
		 $_head_executived = true;

		 $f = @fopen("license.txt","r");
		 $license = @fread($f,filesize("license.txt"));
		 @fclose($f);

		 print "<!--\n".$license."\n-->\n";

		 if(!eregi("member_",$PHP_SELF)) $stylefile="skin/$setup[skinname]/style.css"; else $stylefile="style.css";

		 if($setup[use_formmail]){
				$f = fopen("script/script_zbLayer.php","r");
				$zbLayerScript = fread($f, filesize("script/script_zbLayer.php"));
				fclose($f);
		 }

		 // html 시작부분 출력
		 if($setup[skinname]){
?>
<html> 
<head>
	<title><?=$setup[title]?></title>
	<meta http-equiv=Content-Type content=text/html; charset=UTF-8>
    <meta http-equiv=imagetoolbar content=no>
	<link rel=StyleSheet HREF=<?=$stylefile?> type=text/css title=style>
	<?if($setup[use_formmail]) echo $zbLayerScript;?>
	<?if($scriptfile) include "script/".$scriptfile;?>
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?><?

			if($setup[bg_color]) echo " bgcolor=".$setup[bg_color]." ";
			if($setup[bg_image]) echo " background=".$setup[bg_image]." ";

			?>>
			<?
			if($group[header_url]) { @include $group[header_url]; }
			if($setup[header_url]) { @include $setup[header_url]; }
			if($group[header]) echo stripslashes($group[header]);
			if($setup[header]) echo stripslashes($setup[header]);
			?>
			<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=1 style="table-layout:fixed;"><col width=100%></col><tr><td><img src=images/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=images/t.gif border=0 name=zb_target_resize width=1 height=1></td></tr></table>
			<?
		 }else{
			?>
<html>
<head>
	<meta http-equiv=Content-Type content=text/html; charset=UTF-8>
	<link rel=StyleSheet HREF=style.css type=text/css title=style>
	<?=$script?>
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?>>
			<?
				if($group[header_url]) { @include $group[header_url]; }
				if($group[header]) echo stripslashes($group[header]);
		}
	}

	// HTML Tag를 제거하는 함수
	function del_html( $str ) {
		$str = str_replace( ">", "&gt;",$str );
		$str = str_replace( "<", "&lt;",$str );
		return $str;
	}

	// 빈문자열 경우 1을 리턴
	function isblank($str) {
		$temp=str_replace("　","",$str);
		$temp=str_replace("\n","",$temp);
		$temp=strip_tags($temp);
		$temp=str_replace("&nbsp;","",$temp);
		$temp=str_replace(" ","",$temp);
		if(eregi("[^[:space:]]",$temp)) return 0;
		return 1;
	}

	// 요청한 메시지를 화면에 출력한 뒤 페이지를 다시 이전 페이지로 옮김.
	function err_msg($msg, $bool="1"){
		if($bool){
			echo "
			<script>
				window.alert('$msg');
				history.go(-1);
			</script>
			";
			exit;
		}
	}

	// 관리자 테이블과 회원관리 테이블의 이름을 미리 변수로 정의	
	$accouts_tb = "cms_accounts"; // 거래처 정보 테이블
	$board_no_tb = "cms_board_notice"; // 공지사항 게시판
	$cap_acc_d1_tb = "cms_capital_account_d1"; // 회계 계정과목 1
	$cap_acc_d2_tb = "cms_capital_account_d2"; // 회계 계정과목 2
	$cap_acc_d3_tb = "cms_capital_account_d3"; // 회계 계정과목 3
	$cap_bank_acc_tb = "cms_capital_bank_account"; // 은행계좌 
	$cap_bank_code_tb = "cms_capital_bank_code"; // 은행코드
	$cap_cash_book_tb = "cms_capital_cash_book"; // 거래기록부//금전출납부
	$com_div_tb = "cms_com_div"; // 회사 부서 테이블
	$com_div_mem_tb = "cms_com_div_mem"; // 회사 부서별 멤버
	$com_info_tb = "cms_com_info"; // 회사 정보
	$customers_tb = "cms_customers_db"; // 고객정보 DB
	$member_tb = "cms_member_table"; // 회원 정보 DB	
	$mem_auth_tb = "cms_mem_auth"; // 회원 권한 설정 디비
	$menu_d1_tb = "cms_memu_d1"; // 메뉴 디비 1
	$menu_d2_tb = "cms_menu_d2"; // 메뉴 디비 2
	$menu_d3_tb = "cms_menu_d3"; // 메뉴 디비3
	$message_tb = "cms_message_info"; // 메세지 디비
	$project_db_tb = "cms_project_data"; // 현장 데이터 디비
	$project_if_tb = "cms_project_info"; // 현장 정보 디비
	$resource_h_tb = "cms_resource_headq"; // 현장 인원 본부 정보
	$resource_t_tb = "cms_resource_team"; // 현장 인원 팀 정보
	$resource_m_tb = "cms_resource_team_member"; // 현장 인원 팀원 정보
	$stock_d1_tb = "cms_stock_1st_classify"; // 재고 1차 분류
	$stock_d2_tb = "cms_stock_2nd_classify"; // 재고 2차 분류
	$stock_d3_tb = "cms_stock_3rd_classify"; // 재고 3차 분류
	$stock_d4_tb = "cms_stock_4th_classify"; // 재고 4차 분류
	$stock_main_tb = "cms_stock_main"; // 재고 메인
	$tax_office_tb = "cms_tax_office"; // 세무서 정보
	$work_coun_log_tb = "cms_work_coun_log"; // 상담일지 기록
	$work_log_tb = "cms_work_log"; // 업무일지 기록
	$work_rep_tb = "cms_work_rep"; // 업무보고 기록
	$zipcode_tb = "cms_zipcode"; // 우편번호 디비
?>