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
	$sort=$_REQUEST['sort'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link type="text/css" rel="stylesheet" href="../common/cms.css">
	<style type="text/css">
		html { overflow:hidden; }
	</style>
	<script type="text/JavaScript" language="JavaScript" src="../common/global.js"></script>
	<script type="text/javascript">
	<!--
		function _edit(mode,code){
			location.href="<?=$_SERVER[PHP_SELF]?>?sort="+mode+"&pj=<?=$pj?>&headq=<?=$headq_sel?>&edit_code="+code;
		}
		function _del(mode,code){
			var cdel=confirm('정말 삭제하시겠습니까?');
			if(cdel==true){
				location.href="resource_post.php?mode="+mode+"&del_code="+code;
			}
		}
		function headq_sub(frm){
			if(frm=='form1') var form= document.form1;
			if(frm=='form2') var form= document.form2;
			if(!form.headq.value){
				alert('본부명을 입력하여 주십시요!');
				form.headq.focus();
				return;
			}
			form.submit();
		}
		function team_sub(frm){
			if(frm=='form3') var form= document.form3;
			if(frm=='form4') var form= document.form4;
			if(!form.team.value){
				alert('팀 명을 입력하여 주십시요!');
				form.team.focus();
				return;
			}
			form.submit();
		}
		function team_new_reg(){
			var form=document.getElementById('hs1');
			if(!form.value){
				alert('등록할 본부를 선택하여 주십시요!');
				form.focus();
				return;
			}
			location.href="resc_basic.php?sort=team_reg&pj=<?=$pj?>&headq=<?=$headq_sel?>";
		}
	//-->
	</script>
</head>

<body style="background-color:white;">
<?
	if($sort=='headq_list'){
?>
<!-- ========================본부리스트 start======================== -->
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<?
					$qry = "SELECT pj_name FROM cms_project1_info WHERE seq='$pj' ";
					$rlt = mysql_query($qry, $connect);
					$row = mysql_fetch_array($rlt);
				?>
				<font color="#4C63BD" style="font-size:11pt"><b> 현장별 본부 리스트</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					<?=$row[pj_name]?> 현장 본부 리스트
				</div>
				<form name="form1" action="<?=$_SERVER['PHP_SELF']?>">
				<div style="height:28px; text-align:center; padding-top:7px;">
				</div>
				<div style="height:30px; background-color:#F8F8F8; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:60px;">본부코드</div>
					<div style="float:left; padding-top:5px; text-align:center; width:100px;">본부명칭</div>
					<div style="float:left; padding-top:5px; text-align:center; width:140px;">팀 등록</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">수정</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">삭제</div>
				</div>
				<?
					$total_bnum = $_REQUEST['total_bnum'];

					$query="SELECT seq FROM cms_resource_headq WHERE pj_seq='$pj' ";
					$result=mysql_query($query, $connect);
					if(!$total_bnum) {
						 $total_bnum = mysql_num_rows($result);
					}     // 총 게시물 수   11111111111111111111
					mysql_free_result($result);
					if($total_bnum==0){
				?>
				<div style="height:50px; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:20px;">
					등록된 데이터가 없습니다.
				</div>
				<?
					}else{

					$index_num = 5;                 // 한 페이지 표시할 목록 개수 22222222222222
					$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
					$start=$_REQUEST['start'];
					if(!$start) $start = 1;              // 현재페이지 444444444
					$s = ($start-1)*$index_num;
					$e = $index_num;

					$query2="SELECT * FROM cms_resource_headq WHERE pj_seq='$pj' order by seq asc limit $s, $e";
					$result2=mysql_query($query2, $connect);
					$search_bnum=mysql_num_rows($result2);
					for($i=0; $rows2=mysql_fetch_array($result2); $i++){
						$bunho=$total_bnum-($i+$cline)+1;
				?>
				<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
				<div style="height:30px; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:60px;"><?=$rows2[seq]?></div>
					<div style="float:left; padding-top:5px; text-align:center; width:100px;"><font color="black"><?=$rows2[headq]?></font></div>
					<div style="float:left; padding-top:5px; text-align:center; width:140px;"><a href="resc_basic.php?sort=team_list&amp;pj=<?=$pj?>&amp;headq_sel=<?=$rows2[seq]?>"><?=$rows2[headq]." 팀 목록"?></a></div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">
						<a href="javascript:" onclick="_edit('headq_modify','<?=$rows2[seq]?>');">수정</a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">
						<a href="javascript:" onclick="_del('headq_del','<?=$rows2[seq]?>');">삭제</a>
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
							$back_url="&amp;pj=$pj&amp;sort=$sort";
							page_avg($total_bnum,$page_num, $index_num,$start, $back_url);
							//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
						?>
					</span>
				</div>
				<? } ?>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 신규등록 " onclick="location.href='<?=$_SERVER[PHP_SELF]?>?pj=<?=$pj?>&amp;sort=headq_reg' " class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 닫 기 " onclick="self.close()" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ========================본부리스트 end======================== -->
<?
	}
	else if($sort=='headq_reg'){
?>
<!-- ========================본부 등록 start======================== -->
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<?
					$qry = "SELECT pj_name FROM cms_project1_info WHERE seq='$pj' ";
					$rlt = mysql_query($qry, $connect);
					$row = mysql_fetch_array($rlt);
				?>
				<font color="#4C63BD" style="font-size:11pt"><b> 현장별 본부 신규등록</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					<?=$row[pj_name]?> 현장 본부 신규등록
				</div>
				<form name="form1" action="resource_post.php">
				<input type="hidden" name="mode" value="<?=$sort?>">
				<input type="hidden" name="pj" value="<?=$pj?>">

				<div style="height:61px; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; margin-top:35px;">
					<div style="float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea;">현장명 :</div>
					<div style="float:left; height:25px; padding:5px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;"><?=$row[pj_name]?></div>
					<div style="clear:left; float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea">본부명 :</div>
					<div style="float:left; height:25px; padding:4px 0 0 15px; width:200px;"><input type="text" name="headq" id="headq_r" class="inputstyle2"></div>
				</div>
				</form>
				<div style="height:35; text-align:center; padding-top:10px;">
				</div>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 저장하기" onclick="headq_sub('form1');" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 취 소 " onclick="history.back(1)" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ========================본부 등록 end======================== -->
<?
	}
	else if($sort=='headq_modify'){
		$edit_code=$_REQUEST['edit_code'];
?>
<!-- ========================본부 수정 start======================== -->
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<?
					$qry = "SELECT pj_name FROM cms_project1_info WHERE seq='$pj' ";
					$rlt = mysql_query($qry, $connect);
					$row = mysql_fetch_array($rlt);
				?>
				<font color="#4C63BD" style="font-size:11pt"><b> 현장별 본부 수정등록</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					<?=$row[pj_name]?> 현장 본부 정보수정
				</div>
				<form name="form2" action="resource_post.php">
				<input type="hidden" name="mode" value="<?=$sort?>">
				<input type="hidden" name="pj" value="<?=$pj?>">
				<input type="hidden" name="edit_code" value="<?=$edit_code?>">

				<div style="height:61px; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; margin-top:35px;">
					<?
						$q = "SELECT headq FROM cms_resource_headq WHERE seq='$edit_code' ";
						$r = mysql_query($q, $connect);
						$rw = mysql_fetch_array($r);
					?>
					<div style="float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea;">현장명 :</div>
					<div style="float:left; height:25px; padding:5px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;"><?=$row[pj_name]?></div>
					<div style="clear:left; float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea">본부명 :</div>
					<div style="float:left; height:25px; padding:4px 0 0 15px; width:200px;"><input type="text" name="headq" id="headq_m" value="<?=$rw[headq]?>" class="inputstyle2"></div>
				</div>
				</form>
				<div style="height:35; text-align:center; padding-top:10px;">
				</div>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 저장하기 " onclick="headq_sub('form2');" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 취 소 " onclick="history.back(1)" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ========================본부 수정 end======================== -->
<?
	}
	else if($sort=='team_list'){
		$headq_sel=$_REQUEST['headq_sel'];
?>
<!-- ========================팀 리스트 start======================== -->
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<?
					$qry = "SELECT pj_name FROM cms_project1_info WHERE seq='$pj' ";
					$rlt = mysql_query($qry, $connect);
					$row = mysql_fetch_array($rlt);
				?>
				<font color="#4C63BD" style="font-size:11pt"><b> 본부별 팀 리스트</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					<?=$row[pj_name]?> 현장 팀 리스트
				</div>
				<form name="team_list_frm" action="<?=$_SERVER['PHP_SELF']?>">
				<input type="hidden" name="sort" value="<?=$sort?>">
				<input type="hidden" name="pj" value="<?=$pj?>">
				<input type="hidden" name="headq_sel" value="<?=$headq_sel?>">
				<input type="hidden" name="start" value="1">

				<div style="height:28px; padding:7px 0 0 15px;">
					<div style="float:left;">본부 별 :</div>
					<div style="float:left; padding-left:10px;">
						<select name="headq_sel" id="hs1" class="inputstyle2" style="width:100px; height:20px;" onchange="submit();">
						<option value="" <?if(!$headq_sel) echo "selected"; ?>> 선 택
						<?
							$qry = "SELECT seq, headq FROM cms_resource_headq WHERE pj_seq='$pj' ";
							$rlt = mysql_query($qry, $connect);
							while($rows = mysql_fetch_array($rlt)){
								$headq_name = $rows[headq];
						?>
						<option value="<?=$rows[seq]?>" <?if($headq_sel==$rows[seq]) echo "selected"; ?>> <?=$headq_name?>
						<? } ?>
					</select>
					</div>
				</div>
				<div style="height:30px; background-color:#F8F8F8; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:75px;">팀 코드</div>
					<div style="float:left; padding-top:5px; text-align:center; width:75px;">본 부</div>
					<div style="float:left; padding-top:5px; text-align:center; width:150px;">팀 명칭</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">수정</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">삭제</div>
				</div>
				<?
					$total_bnum = $_REQUEST['total_bnum'];
					$where = " WHERE cms_resource_team.pj_seq='$pj' ";
					if($headq_sel) $where.=" AND headq_seq='$headq_sel' ";

					$query="SELECT seq FROM cms_resource_team $where ";
					$result=mysql_query($query, $connect);
					$total_bnum = mysql_num_rows($result);	//// 총 게시물 수   11111111111111111111
					mysql_free_result($result);
					if($total_bnum==0){
				?>
				<div style="height:50px; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:20px;">
					등록된 데이터가 없습니다.
				</div>
				<?
					}else{
					$index_num = 5;                 // 한 페이지 표시할 목록 개수 22222222222222
					$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
					$start=$_REQUEST['start'];
					if(!$start) $start = 1;              // 현재페이지 444444444
					$s = ($start-1)*$index_num;
					$e = $index_num;

					$query2="SELECT cms_resource_team.seq, headq, team FROM cms_resource_team,cms_resource_headq
							   $where AND headq_seq=cms_resource_headq.seq
							   ORDER BY seq ASC LIMIT $s, $e";
					$result2=mysql_query($query2, $connect);
					$search_bnum=mysql_num_rows($result2);
					for($i=0; $rows2=mysql_fetch_array($result2); $i++){
						$bunho=$total_bnum-($i+$cline)+1;
				?>
				<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
				<div style="height:30px; border-width: 0 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:75px;"><?=$rows2[seq]?></div>
					<div style="float:left; padding-top:5px; text-align:center; width:75px;"><?=$rows2[headq]?></div>
					<div style="float:left; padding-top:5px; text-align:center; width:150px;"><font color="black"><?=$rows2[team]?></font></div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">
						<a href="javascript:_edit('team_modify','<?=$rows2[seq]?>');">수정</a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">
						<a href="javascript:_del('team_del','<?=$rows2[seq]?>');">삭제</a>
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
							$back_url="&amp;pj=$pj&amp;sort=$sort&amp;headq_sel=$headq_sel";
							page_avg($total_bnum,$page_num, $index_num,$start, $back_url);
							//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
						?>
					</span>
				</div>
				<? } ?>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 신규등록 " onclick="team_new_reg();" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 닫 기 " onclick="self.close()" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ========================팀 리스트 end======================== -->
<?
	}
	else if($sort=='team_reg'){
		$headq = $_REQUEST['headq'];
?>
<!-- ========================팀 등록 start======================== -->
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<?
					$qry = "SELECT cms_resource_headq.seq AS headq_seq, pj_name, headq FROM cms_project1_info, cms_resource_headq
							WHERE cms_project1_info.seq='$pj' AND cms_project1_info.seq=cms_resource_headq.pj_seq AND cms_resource_headq.seq='$headq' ";
					$rlt = mysql_query($qry, $connect);
					$row = mysql_fetch_array($rlt);
				?>
				<font color="#4C63BD" style="font-size:11pt"><b> 본부별 팀 신규등록</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					<?=$row[pj_name]?> 현장 팀 신규등록
				</div>
				<form name="form3" action="resource_post.php">
				<input type="hidden" name="mode" value="<?=$sort?>">
				<input type="hidden" name="pj" value="<?=$pj?>">
				<input type="hidden" name="headq" value="<?=$row[headq_seq]?>">

				<div style="height:92px; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; margin-top:35px;">
					<div style="float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea;">현장명 :</div>
					<div style="float:left; height:25px; padding:5px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;"><?=$row[pj_name]?></div>
					<div style="float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea;">본부명 :</div>
					<div style="float:left; height:25px; padding:5px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;"><?=$row[headq]?></div>
					<div style="clear:left; float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea">팀 명 :</div>
					<div style="float:left; height:25px; padding:4px 0 0 15px; width:200px;"><input type="text" name="team" class="inputstyle2"></div>
				</div>
				</form>
				<div style="height:35; text-align:center; padding-top:10px;">
				</div>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 저장하기" onclick="team_sub('form3');" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 취 소 " onclick="history.back(1)" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ========================팀 등록 end======================== -->
<?
	}
	else if($sort=='team_modify'){
		$headq = $_REQUEST['headq'];
		$edit_code = $_REQUEST['edit_code'];
?>
<!-- ========================팀 수정 start======================== -->
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<?
					$qry = "SELECT cms_resource_headq.seq AS headq_seq, pj_name, headq, team
							FROM cms_project1_info, cms_resource_headq, cms_resource_team
							WHERE cms_project1_info.seq='$pj'
							AND cms_project1_info.seq=cms_resource_headq.pj_seq
							AND cms_resource_headq.seq='$headq'
							AND cms_resource_team.seq = '$edit_code' ";
					$rlt = mysql_query($qry, $connect);
					$row = mysql_fetch_array($rlt);
				?>
				<font color="#4C63BD" style="font-size:11pt"><b> 본부별 팀 수정등록</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					<?=$row[pj_name]?> 현장 팀 정보수정
				</div>
				<form name="form4" action="resource_post.php">
				<input type="hidden" name="mode" value="<?=$sort?>">
				<input type="hidden" name="pj" value="<?=$pj?>">
				<input type="hidden" name="headq" value="<?=$row[headq_seq]?>">
				<input type="hidden" name="edit_code" value="<?=$edit_code?>">

				<div style="height:92px; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; margin-top:35px;">
					<div style="float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea;">현장명 :</div>
					<div style="float:left; height:25px; padding:5px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;"><?=$row[pj_name]?></div>
					<div style="float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea;">본부명 :</div>
					<div style="float:left; height:25px; padding:5px 0 0 15px; width:260px; border-width:0 0 1px 0; border-style:solid; border-color:#eaeaea;"><?=$row[headq]?></div>
					<div style="clear:left; float:left; height:25px; padding-top:5px; text-align:center; width:100px; background-color:#eaeaea">팀 명 :</div>
					<div style="float:left; height:25px; padding:4px 0 0 15px; width:200px;"><input type="text" name="team" value="<?=$row[team]?>" class="inputstyle2"></div>
				</div>
				</form>
				<div style="height:35; text-align:center; padding-top:10px;">
				</div>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 저장하기" onclick="team_sub('form4');" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 취 소 " onclick="history.back(1)" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ========================팀 수정 end======================== -->
<? } ?>
</body>
</html>
