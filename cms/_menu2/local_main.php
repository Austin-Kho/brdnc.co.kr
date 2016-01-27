<?
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	$m_di=$_REQUEST['m_di'];
	$s_di=$_REQUEST['s_di'];

	$member_query = "SELECT is_company, pj_seq, auth_level FROM cms_member_table WHERE user_id = '$_SESSION[p_id]' ";
	$member_result = mysql_query($member_query, $connect);
	$member_row = mysql_fetch_array($member_result);
?>
<!DOCTYPE HTML>
<html>
 <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<title> <?=$doc_title?> </title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link type="text/css" rel="stylesheet" href="<?=$cms_url?>common/cms.css">
	<script src="../common/global.js"></script>
	<script src="../common/_menu2.js"></script>
	<script src="../common/capital.js"></script>
	<script src="../include/calendar/calendar.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $("#loading").css("display","none");
	  });
   </script>
	<script type="text/javascript">
	<!--
		function term_put(a,b,term){
			if(term=='d')var term="<?=date('Y-m-d')?>";
			if(term=='w')var term="<?=date('Y-m-d',strtotime ('-1 weeks'))?>";
			if(term=='m')var term="<?=date('Y-m-d',strtotime ('-1 months'))?>";
			if(term=='3m')var term="<?=date('Y-m-d',strtotime ('-3 months'))?>";
			document.getElementById(a).value = term;
			document.getElementById(b).value = "<?=date('Y-m-d')?>";
		}
		function _retire(code,a){ // 퇴사 처리 함수
			if(confirm('해당 직원을 업무종료 처리 하시겠습니까?')==true){
				var retire_date = prompt("업무종료일을 입력 또는 수정하여 주십시요!\n(입력란에 입력된 형식으로 날짜를 입력하여 주십시요!)","<?=date('Y-m-d')?>");
				if(retire_date==null){
					return;
				}else{
					var reg = /^\d{4}-\d{2}-\d{2}$/;
					if(!reg.test(retire_date)){
						alert("입력한 날짜의 형식이 맞지 않습니다.\n형식에 맞게 작성해 주십시요!\n\n예) <?=date('Y-m-d')?> (YYYY-mm-dd)");
					}else{
						location.href="resource_post.php?mode=mem_retire&date="+retire_date+"&re_code="+code+"&pj_seq="+a;
					}
				}
			}else{
				return;
			}
		}
		function _del(code){
			if(confirm('정말 삭제하시겠습니까?')==true){
				location.href='advance_post.php?mode=del&del_code='+code;
			}else{
				return;
			}
		}
		function cap_del(code){
			if(aa=confirm('정말 삭제하시겠습니까?')){
				location.href='<?=$cms_url?>_capital/capital_del.php?del_code='+code
			}else{
				return false;
			}
		}
	//-->
	</script>
 </head>
 <body onclick="cal_del();">
  <div id="loading" style="padding-top:530px;"><img src="../images/loading.gif"><br>loading...</div>
  <div id="wrap">
	<div id="header">
	<? include '../include/t_menu.php'; ?>
	</div>
	<div id="content">
		<?
			if(!$_SESSION['p_id']){
		?>
		<div style="width:1080px; height:650px; text-align:center; display: table-cell; vertical-align: middle;">
			<p>로그인 정보가 없습니다. 다시 로그인하여 주십시요!</p>
			<input type="button" value="로그인" class="sub_bt1" onclick="location.href='<?=$cms_url?>member/login_form.php';">
			<input type="button" value=" 닫 기 " class="sub_bt1" onclick="window.self.close()">
		</div>
		<? }else{?>
		<div>
			<!-- ============================= Head end / body start ============================= -->
			<?
				if(!$m_di||$m_di==1) include "advance_m.php";
				if($m_di==2) include "resource_m.php";
			?>
			<!-- ============================= body end / Foot start ============================= -->
		</div>
		<? } ?>
	</div>
 </div>
 <div id="footwrap">
	<div id="footer"><?=$doc_copyright?></div>
 </div>
 </body>
</html>
