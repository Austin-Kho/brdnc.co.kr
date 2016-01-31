<?
	include "setup_lib.php";
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?
	$hostname = $_REQUEST['hostname'];
	$user_id = $_REQUEST['user_id'];
	$passwd = $_REQUEST['passwd'];
	$dbname = $_REQUEST['dbname'];

	$admin_id = $_REQUEST['admin_id'];
	$passwd1 = md5($_REQUEST['passwd1']);
	$passwd2 = md5($_REQUEST['passwd2']);
	$name = $_REQUEST['name'];
	

// DB에 커넥트 하고 DB NAME으로 select DB
	$connect = @mysql_connect($hostname,$user_id,$passwd) or err_msg("MySQL-DB Connect<br>Error!!!","");
	mysql_select_db($dbname, $connect ) or err_msg("MySQL-DB Select<br>Error!!!","");


// 관리자가 1명이상 있을경우 바로 로그인 페이지로...
	$temp=mysql_fetch_array(mysql_query("select count(*) from cms_member_table where is_admin='1'",$connect));
	if($temp[0]){
		echo ("<script>
					location.href='../member/login_form.php';
				</script>");
		mysql_close($connect);
		exit;
	}

// 빈문자열인지를 검사
	if(isBlank($admin_id)) err_msg("아이디를 입력하셔야 합니다","");
	if(isBlank($passwd1)) err_msg("비밀번호를 입력하셔야 합니다","");
	if(isBlank($passwd2)) err_msg("비밀번호 확인을 입력하셔야 합니다","");
	if($passwd1!=$passwd2) err_msg("비밀번호와 비밀번호 확인이 일치하지 않습니다","");
	if(isBlank($name)) err_msg("이름을 입력하셔야 합니다","");

// 관리자 정보 입력
	@mysql_query("INSERT INTO cms_member_table (is_admin, user_id, passwd, name, request, is_company, auth_level, reg_date) VALUES ('1', '$admin_id', '$passwd1', '$name', '1', '1', '1', now());",$connect) or err_msg(mysql_error(),"");
	@mysql_query("INSERT INTO cms_mem_auth (user_no, user_id, cg_2_2) VALUES ('1', '$admin_id', '2');",$connect) or err_msg(mysql_error(),"");

	mysql_close($connect);
	echo ("<script>
					location.href='../member/login_form.php';
				</script>");
?>