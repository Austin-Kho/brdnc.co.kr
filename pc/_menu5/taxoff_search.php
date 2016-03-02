<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸리티 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	// 이름과 아이디에 해당하는 세션이 있는지 확인
	if(!isset($_SESSION[p_id])||!isset($_SESSION[p_name])){
		err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
	}
	$n=$_REQUEST['n'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link rel="stylesheet" href="../common/cms.css">
	<style type="text/css">
		html { overflow:hidden; }
	</style>
	<script language="JavaScript" src="../common/global.js"></script>
	<script type="text/javascript">
	<!--
		function value_put(a,b,n){
			 var form_obj=eval("opener.document.form1");

			 if(n==1){
				form_obj.tax_off1_code.value=a;
				form_obj.tax_off1_name.value=b;
			 }else if(n==2){
				form_obj.tax_off2_code.value=a;
				form_obj.tax_off2_name.value=b;
			 }
			 self.close();
		}
	//-->
	</script>
</head>

<body>
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f; background-color: white;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b> 관할 세무서 검색</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#f4f4f4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					검색할 세무서를 입력해 주십시요.
				</div>
				<?
					$tax_off = $_REQUEST['tax_off'];
				?>
				<form name="form1" action="<?=$_SERVER['PHP_SELF']?>">
				<input type="hidden" name="start" value="1">
				<input type="hidden" name="n" value=<?=$n?>>
				<div style="height:42px; text-align:center; padding-top:6px; ;">
				<input type="text" name="tax_off" size="30" class="inputstyle2" style="height:18px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
				<input type="button" value=" 검 색 " onclick="submit();" class= "inputstyle_bt"><br>
				세무서를 제외한  <font color="#0088ff">[관할 지역명]</font>만 입력하세요.

				</div>
				<div style="clear:left; height:30px; background-color:#EAEAEA; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:30%;">관할 세무서 코드</div>
					<div style="float:left; padding-top:5px; text-align:center; width:70%;">관할 세무서 명칭</div>
				</div>
				<?
					$total_bnum = $_REQUEST['total_bnum'];
					if(!$tax_off) $where_add=''; else $where_add = " WHERE office like '%$tax_off%' ";

					$query="SELECT code, office FROM cms_tax_office $where_add";
					$result=mysql_query($query, $connect);
					if(!$total_bnum) {
						 $total_bnum = mysql_num_rows($result);
					}     // 총 게시물 수   11111111111111111111
					mysql_free_result($result);
					if($total_bnum==0){
				?>
				<div style="height:60px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid; text-align:center; padding-top:35px;">
					등록 된 데이터가 없습니다.
				</div>
				<?
					}else{
					$page=$_GET['page'];
					$gb=$_REQUEST['gb'];
					$tax_off = $_REQUEST['tax_off'];

					$index_num = 6;                 // 한 페이지 표시할 목록 개수 22222222222222
					$page_num = 10;					// 한 페이지에 표시할 페이지 수 33333
					$start=$_REQUEST['start'];
					if(!$start) $start = 1;              // 현재페이지 444444444
					$s = ($start-1)*$index_num;
					$e = $index_num;

					$query2="SELECT code, office FROM cms_tax_office $where_add ORDER BY office LIMIT $s, $e";
					$result2=mysql_query($query2, $connect);
					$search_bnum=mysql_num_rows($result2);
				?>
				<div style="height:146px;">
				<?
					for($i=0; $rows2=mysql_fetch_array($result2); $i++){
						$bunho=$total_bnum-($i+$cline)+1;
					?>
				<!-- <input type="hidden" name="total_bnum" value="<?=$search_bnum?>"> -->

					<div style="clear:left; height:24px;">
						<div style="float:left; padding-top:2px; text-align:center; width:30%;"><a href="javascript:" onclick="value_put(<?=$rows2[code]?>,'<?=$rows2[office]?> 세무서',<?=$n?>);"><?=$rows2[code]?></a></div>
						<div style="float:left; padding-top:2px; text-align:center; width:70%;"><a href="javascript:" onclick="value_put(<?=$rows2[code]?>,'<?=$rows2[office]?> 세무서',<?=$n?>);"><?=$rows2[office]?> 세무서</a></div>
					</div>
				<?
					}
					mysql_free_result($result2);
				?>
				</div>
				</form>
				<div style="height:35; text-align:center; padding-top:5px; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd;">
					<span>
						<?
							$back_url="&amp;tax_off=$tax_off&amp;n=$n";
							page_avg($total_bnum,$page_num, $index_num, $start, $back_url);
							//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지 5. 매개변수
							}
						?>
					</span>
				</div>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 닫 기 " onclick="self.close()" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
