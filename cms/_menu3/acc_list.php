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
	$pj=$_REQUEST['pj'];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link type="text/css" rel="stylesheet" href="../common/cms.css">
	<style type="text/css">
		html { overflow:hidden; }
	</style>
	<script type="text/JavaScript" language="JavaScript" src="../common/global.js"></script>
	<script type="text/javascript">
	<!--
		function _edit(code){
			 location.href="bank_acc.php?mode=edit&edit_code="+code;
		}
		function _del(code){
			 var cdel=confirm('정말 삭제하시겠습니까?');
			 if(cdel==true){
				 location.href="bank_acc_post.php?mode=del&del_code="+code;
			 }
		}
	//-->
	</script>
</head>
<body style="background-color:white;">



<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b> 은행계좌(BANK ACCOUNT) 관리</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#f4f4f4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					검색할 은행(계좌) 명칭을 입력해 주십시요.
				</div>
				<?
					$sort = $_REQUEST['sort'];
					$category = $_REQUEST['category'];
				?>
				<form name="form1" action="<?=$_SERVER['PHP_SELF']?>">
				<input type="hidden" name="start" value="1">
				<div style="float:left; height:28px; text-align:center; padding:7px 0 0 55px; ;">
					<select name="sort" class="inputstyle2" style="width:80px; height:22px;">
						<option value="" <?if(!$sort) echo "selected";?>> 전 체
						<option value="com" <?if($sort=='com') echo "selected";?>> 본 사
						<?
							$qry = "SELECT seq, pj_name FROM cms_project_info";
							$rlt = mysql_query($qry, $connect);
							while($rows = mysql_fetch_array($rlt)){
						?>
						<option value="<?=$rows[seq]?>" <?if($sort==$rows[seq]) echo "selected";?>><?=$rows[pj_name]?>
						<? } ?>
					</select>
				</div>
				<div style="float:left; height:28px; text-align:center; padding:7px 0 0 10px;">
					<input type="text" name="category" value="<?=$category?>" size="20" class="inputstyle2" style="height:18px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" onclick="this.value=''">
					<input type="button" value=" 검 색 " onclick="submit();" class= "inputstyle_bt">
				</div>
				<div style="clear:left; height:30px; background-color:#EAEAEA; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:70px;">구분</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">별칭</div>
					<div style="float:left; padding-top:5px; text-align:center; width:80px;">은행</div>
					<div style="float:left; padding-top:5px; text-align:center; width:130px;">계좌번호</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">수정</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">삭제</div>
				</div>
				<?
					$total_bnum = $_REQUEST['total_bnum'];

					$where_add = " WHERE no!=1 ";
					if($sort){
						if($sort=='com'){
							$where_add.=" AND is_com='1' ";
						}else{
							$where_add.=" AND pj_seq='$sort' ";
						}
					}
					if($category) $where_add.=" AND ((bank LIKE '%$category%') OR (note LIKE '%$category%')) ";
					$query="SELECT no FROM cms_capital_bank_account $where_add ";
					$result=mysql_query($query, $connect);
					$total_bnum = mysql_num_rows($result);	// 총 게시물 수   11111111111111111111
					mysql_free_result($result);
					if($total_bnum==0){
				?>
				<div style="height:60px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid; text-align:center; padding-top:35px;">
					등록 된 데이터가 없습니다.
				</div>
				<?
					}else{

					$index_num = 5;                 // 한 페이지 표시할 목록 개수 22222222222222
					$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
					$start=$_REQUEST['start'];
					if(!$start) $start = 1;              // 현재페이지 444444444
					$s = ($start-1)*$index_num;
					$e = $index_num;

					$query2="SELECT no, bank, name, number, is_com, pj_seq
							   FROM cms_capital_bank_account
							   $where_add
							   ORDER BY no ASC LIMIT $s, $e";
					$result2=mysql_query($query2, $connect);
					$search_bnum=mysql_num_rows($result2);
					for($i=0; $rows2=mysql_fetch_array($result2); $i++){
						$bunho=$total_bnum-($i+$cline)+1;
						if($rows2[is_com]=='1'){$sort = "본사";}
						if($rows2[is_com]=='0'){
							$rlt = mysql_query("SELECT pj_name FROM cms_project_info WHERE seq='$rows2[pj_seq]' ", $connect);							
							$row = mysql_fetch_array($rlt);
							$sort = rg_cut_string($row[pj_name],9,"");
						}
				?>
				<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
				<div style="height:30px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:70px;">
						<a href="javascript:" onclick="value_put('<?=$rows2[classify]?>')"><?=$sort?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">
						<a href="javascript:" onclick="value_put('<?=$rows2[classify]?>')"><?=$rows2[name]?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:80px;">
						<a href="javascript:" onclick="value_put('<?=$rows2[classify]?>')"><?=$rows2[bank]?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:130px;">
						<a href="javascript:" onclick="value_put('<?=$rows2[classify]?>');"><?=$rows2[number]?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">
						<?	if($pj){	?>
						<a href="javascript:alert('수정 권한이 없습니다.')">
						<?	}else{	?>
						<a href="javascript:_edit('<?=$rows2[no]?>');"><? } ?>수정</a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">
						<?	if($pj){	?>
						<a href="javascript:alert('삭제 권한이 없습니다.')">
						<?	}else{	?>
						<a href="javascript:_del('<?=$rows2[no]?>');"><? } ?>삭제</a>
					</div>
				</div>
				<?
						}
						mysql_free_result($result2);
				?>
				</form>
				<div style="height:35; text-align:center; padding-top:10px;">
					<span>
						<?
							$back_url="&amp;sort=$sort&amp;category=$category";
							page_avg($total_bnum,$page_num, $index_num,$start, $back_url);
							//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
							}
						?>
					</span>
				</div>
				<?
					if($pj){
						$acc_m_str = "alert('계좌관리 권한이 없습니다.');";
					}else{
						$acc_m_str = "location.href='bank_acc.php?mode=reg';";
					}
				?>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 은행계좌 추가 " onclick="<?=$acc_m_str?>" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 닫 기 " onclick="self.close()" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
