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
	//$bank = $_REQUEST['bank'];
	$e_date = $_REQUEST['e_date'];
	$_search = $_REQUEST['_search'];
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
	<script type="text/JavaScript" language="JavaScript" src="../include/calendar/calendar.js"></script>
</head>

<body onclick="cal_del();">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f; background-color: white;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b>대여금 잔액 현황</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<form name="form1" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<input type="hidden" name="start" value="1">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; padding-top:7px;">
					<div style="float:left; padding-left:10px; width:54px;">
						시 점 :
					</div>
					<div style="float:left; padding-left:10px;">
						<!-- <input type="text" name="e_date" id="e_date" value="<?=$e_date?>" class="inputstyle2" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" size="25"> <a href="javascript:" onclick="openCalendar(document.getElementById('e_date'));"><img src="../images/calendar.jpg" border="0" alt="" /> </a> -->

						<input type="text" name="e_date" id="e_date" value="<?=$e_date?>" size="25" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
						<a href="javascript:" onclick="cal_add(document.getElementById('e_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>



						<a href="javascript:" onClick="document.form1.e_date.value=null">지우기</a>
					</div>
				</div>
				<div style="height:28px; text-align:center; padding-top:7px;">
					<input type="text" name="_search" size="30" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					<input type="button" value=" 검 색 " onclick="submit();" style="height:20px;" class= "inputstyle_bt">
				</div>
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:3px; text-align:center; width:60px;">거 래 처</div>
					<div style="float:left; padding-top:3px; text-align:center; width:100px;">적 요</div>
					<div style="float:left; padding-top:3px; text-align:center; width:70px;">거래금액</div>
					<div style="float:left; padding-top:3px; text-align:center; width:83px;">대여금 잔액</div>
					<div style="float:left; padding-top:3px; text-align:center; width:70px;">거래일자</div>
				</div>
				<?
					$add_where=" where (class2='3' or class2='6') ";
					$add_date="";

					if($e_date) $add_date=" AND deal_date<='$e_date' ";
					if($_search) $add_where.=" AND (cont like '%$_search%' or acc like '%$_search%' or worker like '%$_search%') ";

					$query = "select * from cms_capital_cash_book $add_where $add_date";

					$result=mysql_query($query, $connect);
					$total_bnum=mysql_num_rows($result);     // 총 게시물 수   11111111111111111111
					if($total_bnum==0){
				?>
				<div style="height:50px; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:30px;">
					해당 데이터가 없습니다.
				</div>
				<?
					}else{
					while($rows=mysql_fetch_array($result)){
						 $total_ba+=$rows[exp]-$rows[inc];
					}
					if($result) mysql_free_result($result);

					$index_num = 5;                 // 한 페이지 표시할 목록 개수 22222222222222
					$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
					$start=$_REQUEST['start'];
					if(!$start) $start = 1;         // 현재페이지 444444444
					$s = ($start-1)*$index_num;
					$e = $index_num;

					$query1 = "select * from cms_capital_cash_book $add_where $add_date order	by deal_date desc, seq_num desc limit $s, $e";
					$result1=mysql_query($query1, $connect);
					for($i=0; $rows1=mysql_fetch_array($result1); $i++){

						 if($rows1[class2]==3){
								$cla="<font color='#0066ff'>[회수]</font>";
								$inc_exp=number_format($rows1[inc]);
						 }else{
								$cla="<font color='#ff3300'>[대여]</font>";
								$inc_exp=number_format($rows1[exp]);
						 }

						 $in_qry="select sum(inc) as inc from cms_capital_cash_book where class2='3' and deal_date<='$rows1[deal_date]' ";
						 $in_rlt=mysql_query($in_qry,$connect);
						 $in_row=mysql_fetch_array($in_rlt);

						 $ex_qry="select sum(exp) as exp from cms_capital_cash_book where class2='6' and deal_date<='$rows1[deal_date]' ";
						 $ex_rlt=mysql_query($ex_qry,$connect);
						 $ex_row=mysql_fetch_array($ex_rlt);

						 if($in_row[inc]==$ex_row[exp]){$balance="-";}else{$balance=number_format($ex_row[exp]-$in_row[inc]);}
				?>
				<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
				<div style="height:28px; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:3px; text-align:center; width:60px;"><?=rg_cut_string($rows1[acc],3,"..")?></div>
					<div style="float:left; padding-top:3px; width:100px; cursor:pointer;" title="<?=$rows1[cont]?>"><?=$cla." - ".rg_cut_string($rows1[cont],5,"..")?></div>
					<div style="float:left; padding-top:3px; text-align:right; width:70px;"><?=$inc_exp?></div>
					<div style="float:left; padding:3px 3px 0 0; text-align:right; width:80px;"><?=$balance?></div>
					<div style="float:left; padding-top:3px; text-align:center; width:70px;"><?=$rows1[deal_date]?></div>
				</div>
					<?
						}
						mysql_free_result($result1);
					?>
				<div style="height:35; text-align:center; padding-top:10px;">
					<span>
						<?
							$back_url="&amp;e_date=$e_date&amp;_search=$_search";
							page_avg($total_bnum,$page_num, $index_num,$start, $back_url);
							//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
						?>
					</span>
				</div>
				<? } ?>
				</form>
				<div style="height:50px; text-align:center; padding:20px 0 0 39px;">
					<div style="float:left; height:26px; width:130px; border:1px solid #cccccc; background-color:#E2F0FC; padding-top:6px;">대여금 잔액 :
					</div>
					<div style="float:left; height:26px; width:150px; padding:6px 20px 0 0; border-width:1px 1px 1px 0; border-style:solid;  border-color:#cccccc; text-align:right;" >
						<font color="#000066"><?if($total_ba==0){echo "-";}else{echo number_format($total_ba);}?></font> 원
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
