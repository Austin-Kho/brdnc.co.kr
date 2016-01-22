<?
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
<!DOCTYPE HTML>
<?
	$z_form=$_REQUEST['z_form']; // 우편번호 폼 이름
	$a_form=$_REQUEST['a_form']; // 주소 폼 이름
?>
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$doc_title?></title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link type="text/css" rel="stylesheet" href="../common/cms.css">
	<script type="text/JavaScript" language="JavaScript" src="../common/global.js"></script>
	<script type="text/JavaScript">
		<!--
			function checkInput(form){
				var form=document.zipsearch;
				if(!form.dong.value){
					alert('찾기를 원하는 동을 입력하세요!');
					form.dong.focus();
					return false;
				} else {
					form.submit();
				}
			}
			function open_move(zip, adr){

				var form=opener.document.form1;

				var z = document.zipsearch.z_form.value;
				var a1 = document.zipsearch.a_form.value+"1";
				var a2 = document.zipsearch.a_form.value+"2";

				zip=zip.substring(0, 5);

				a = eval("form."+z); // 우편번호 앞에 세자리 폼
				c = eval("form."+a1); // 기본주소 폼 이름
				d = eval("form."+a2); // 나머지주소 폼 이름

				a.value=zip;
				c.value=adr;
				d.focus();

				self.close();
			}
		//-->
	</script>
</head>
<body style="background-color:white;">
<div style="border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 6px 0;">
		<div style="margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5; padding-bottom:8px; position:relative;">
			<div style="height:38px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:24px;">
				<font color="#4C63BD" style="font-size:11pt"><b>우편번호 찾기</b></font>
			</div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td>
				<div style="padding:0 10px 0 10px;">
				<form name="zipsearch" method="post" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return checkInput()">
				<input type="hidden" name="mode" value="search">
				<input type="hidden" name="z_form" value="<?=$z_form?>">
				<input type="hidden" name="a_form" value='<?=$a_form?>'>

				<div style="height:34px; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; margin-top:10px;">
					<div style="float:left; height:28px; padding-top:6px; width: 100px; background-color:#F8F8F8; text-align:center;">
						도 로 명
					</div>
					<div style="float:left; height:28px; width:160px; padding-top:7px; text-align:center;">
						<input type="text" name="dong" size="22" class="inputstyle2" value=<?=$dong?> onFocus="this.value=''"; onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
					</div>
					<div style="float:left; height:28px; width:50px; padding-top:7px; text-align:center;">
						<input type="submit" value="우편번호 찾기" class="inputstyle_bt"><!-- <input type="image" src="../images/chk.jpg"> -->
					</div>
				</div>
				</form>
				<?
					$dong=$_POST['dong'];
					$mode=$_POST['mode'];

					if($mode=="search"){

					## 주소 데이터베이스에서 사용자가 입력한 주소와 일치하는 레코드를 검색한다. ##
					$query="SELECT zipcode, sido, gugun, eupmn,  doro, b_no_main, b_no_sub, law_dn, gugun_bn FROM cms_zipcode WHERE (eupmn LIKE '%$dong%') OR (eupmn_en LIKE '%$dong%') OR (doro LIKE '%$dong%') OR (doro_en LIKE '%$dong%') OR (gugun_bn LIKE '%$dong%') OR (law_dn LIKE '%$dong%') OR (rin LIKE '%$dong%') OR (admin_dn LIKE '%$dong%') OR (gugun_en LIKE '%$dong%') OR (gugun_en LIKE '%$dong%') OR (gugun_en LIKE '%$dong%');";
					$result=mysql_query($query, $connect);
					$total_num=mysql_num_rows($result);
					## 검색 결과가 있으면 목록 상자 형태로 출력한다. ##
					if(!$total_num){
				?>
				<div style="height:78px; padding-top:35px; text-align:center;">
						<b>해당하는 주소가 없습니다.</b>
				</div>
				<? }else{ ?>
				<div style="height:38px; text-align:center; padding-top:20px; border-width:0 0 1px 0; border-style:solid; border-color:#CFCFCF;">
					<font color="#4b4b4b"> 해당 주소를 클릭하시면 자동입력 됩니다. </font>
				</div>
					<div>
						<?
							while($rows = mysql_fetch_array($result)){
								//if()
								$addr1=$rows[sido]." ".$rows[gugun]." ".$rows[eupmn]." ".$rows[doro]." ".$rows[b_no_main]."-".$rows[b_no_sub];
								$address1="$addr1";
								// $addr_code=explode("-", $rows[zipcode]);
						?>
						<div style="clear:left; float:left; width:53px; height:25px; text-align:center; padding-top:5px; background-color:#F9F9F9;">
							<a href="javascript:" onclick="open_move('<?=$rows[zipcode]?>', '<?=$address1?>')"><?=$rows[zipcode]?></a>
						</div>
						<div style="float:left; width:308px; height:25px; border-width:1px 0 0 0; border-style:solid; border-color:#EEEEEE; padding:5px 0 0 2px; background-color:#F9F9F9;">
							<a href="javascript:" onclick="open_move('<?=$rows[zipcode]?>', '<?=$address1?>')"><?=$address1?><?=$rows[bunji]?></a>
						</div>
						<?	} ?>
						<div style="height:50px; border-width:1px 0 0 0; border-color:#EEEEEE; border-style:solid; background-color:#F9F9F9;"> </div>
					<? } ?>
					</div>
					<? }else{ ?>
					<div style="height:78px; padding-top:35px; text-align:center;">
						<b>검색하려는 주소의 동/읍/면/리/건물명을 입력하세요.</b>
					</div>
					<? } ?>
				</div>
				</td>
			</tr>
			</table>
		</div>
	</div>
</div>
</body>
</html>
