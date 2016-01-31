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

	$seq_num = $_REQUEST['seq_num'];
	$pj_seq=$_REQUEST['pj_seq'];
	$headq_seq = $_REQUEST['headq_seq'];
	$team_seq=$_REQUEST['team_seq'];
	$posi = $_REQUEST['posi'];

	$pj_where = $headq_seq."-".$team_seq;

	$query = "UPDATE cms_member_table SET pj_seq='$pj_seq',
																   pj_where = '$pj_where',
															       pj_posi = '$posi'
													WHERE no='$seq_num' ";

	$result = mysql_query($query, $connect);
	if(!$result) err_msg('데이터베이스 오류가 발생하였습니다.');
	echo ("<script>
				window.alert('정상적으로 현장 직원 소속정보가 수정 되었습니다!');
				location.href='resource_m3_modi.php?edit_code=$seq_num';
			</script>");
?>
