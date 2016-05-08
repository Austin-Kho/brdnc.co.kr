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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="stylesheet" href="../common/cms.css">
	<script language="JavaScript" src="../common/global.js"></script>
	<script type="text/javascript">
	<!--
		function value_put(obj){
			 var form_obj=eval("opener.document.out_stock_frm.<?=$fn?>");
			 form_obj.value=obj;
			 self.close();
		}

		function _edit(code){
			 location.href="accounts_edit.php?edit_code="+code;
		}
		function _del(code){
			 var cdel=confirm('정말 삭제하시겠습니까?');
			 		if(cdel==true){
						 location.href="accounts_del.php?del_code="+code;
			 		}
		}
	//-->
	</script>
</head>

<body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0'>
	<table border='0' cellpadding='0' cellspacing='0' width='100%' height="100%">
	<tr>
		<td align="center" style="border-width: 2 0 0 0; border-color:#C5FAC9; border-style: solid; padding:6 0 0 0px">
			<table border="0" width="96%" height="94%" align="center" valign="middle" bgcolor="#96ABE5">
			<tr height="80" bgcolor="#D9EAF8">
				<td align="center" height="32" background="../img/bg.jpg">
				<font color="#4C63BD" style="font-size:11pt"><b>출고 거래처 관리</b></font>
				</td>
			</tr>			
			<tr bgcolor="ffffff">
				<td style="padding:13 0 0 0px">				
				<table border="0" align="center" width="96%" height="100%" cellspacing="0" cellpadding="0">
				<tr height="10">
					<td></td>
				</tr>
				<tr height="28">
					<td>					
					<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr align="center" height="35">
						<td width="100%" bgcolor="#EAEAEA" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;" colspan="5">
							검색할 입고 거래처를 입력해 주십시요.
						</td>
					</tr>
					<tr>
						<form name="form1" action="<?=$_SERVER['PHP_SELF']?>">
							<input type="hidden" name="start" value="1">
							<td colspan="5" align="center" style="padding:8 0 8 0px">
							<input type="text" name="accounts" size="30" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');"> 
							<input type="button" value=" 검 색 " onClick="submit();" class= "inputStyle1">
						</td>
					</tr>
					<tr align="center" height="30" bgcolor="#EAEAEA" >
						<td width="20%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">출고처 코드</td>
						<td width="30%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">사이트명(별칭)</td>
						<td width="30%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">출고 거래처</td>						
						<td width="10%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">수정</td>
						<td width="10%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">삭제</td>
					</tr>
					<?
						$total_bnum = $_REQUEST['total_bnum'];

						$query="select * from cms_accounts ";
						$result=mysql_query($query, $connect);
						if(!$total_bnum) {
							 $total_bnum = mysql_num_rows($result);
						}     // 총 게시물 수   11111111111111111111
						mysql_free_result($result);
						
						$page=$_GET['page'];
						$gb=$_REQUEST['gb'];
						$accounts = $_REQUEST['accounts'];
						

						$index_num = 7;                 // 한 페이지 표시할 목록 개수 22222222222222
						$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
						$start=$_REQUEST['start'];	
						if(!$start) $start = 1;              // 현재페이지 444444444
						$s = ($start-1)*$index_num;
						$e = $index_num;

						$query2="select * from cms_accounts where acc_name like '%$accounts%' order by acc_cla desc, acc_name asc limit $s, $e";
						$result2=mysql_query($query2, $connect);
						$search_bnum=mysql_num_rows($result2);

						for($i=0; $rows2=mysql_fetch_array($result2); $i++){
							$bunho=$total_bnum-($i+$cline)+1;
					?>
					<tr align="center">
						<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
						<td class="line-n">
							<a href="javascript:" onclick="value_put('<?=$rows2[si_name]."-".$rows2[code]?>')"><?=$rows2[code]?></a>
						</td>
						<td class="line-n">
							<a href="javascript:" onclick="value_put('<?=$rows2[si_name]."-".$rows2[code]?>')"><font color="#3057c0"><?=$rows2[si_name]?></font></a>
						</td>
						<td align="center" class="line-n">
							<a href="javascript:" onclick="value_put('<?=$rows2[si_name]."-".$rows2[code]?>');"><?=$rows2[acc_name]?></a>
						</td>
							<td style="border-width: 0 0 1 0; border-color:#E1E1E1; border-style: solid;">
							<a href="javascript:_edit('<?=$rows2[code]?>');">수정</a>
						</td>
							<td style="border-width: 0 0 1 0; border-color:#E1E1E1; border-style: solid;">
							<a href="javascript:_del('<?=$rows2[code]?>');">삭제</a>
						</td>
						</form>
					</tr>
					<?
						}
						mysql_free_result($result2);
					?>
					</table>
					</td>
				</tr>									
				<tr>
					<td valign="top" align="center">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="36" align="center">
							<?
								$url="accounts_in.php?gb=1";
								page_avg($total_bnum,$page_num, $index_num,$start);
								//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
							?>
						</td>
					</tr>
					<tr>
						<td align="center">
							<input type="button" value=" 거래처 추가 " onclick="location.href='accounts_up.php';" class="inputstyle1">
							<input type="button" value=" 닫 기 " onclick="self.close()" class="inputstyle1">
						</td>
					</tr>
					</table>
					</td>
				</tr>
				</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</body>
</html>
