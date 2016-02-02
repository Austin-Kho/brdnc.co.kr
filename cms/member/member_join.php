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
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$doc_title?></title>
  <link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
  <link type="text/css" rel="stylesheet" href="../common/cms.css">
  <script type="text/javascript" src="../common/global.js"></script>
  <script type="text/javascript" src="../common/member.js"></script>
 </head>

 <body>
 <div style="width:756px; height:100%; margin:0px auto;"><!-- wrap div -->
	<div style="height:38px;"></div>
	<div style="height:80px; background-color:#D9EAF8; border-width:2px; border-color:#96ABE5; border-style:solid;">
		<div style="float:left; padding:20px 0 0 25px;">
			<img src="../images/cms_box_logo.png" alt="">
		</div>
		<div style="float:left; padding:38px 0 0 20px;">
			<!-- <font size="3" color="#718EDB"><b>CMS 솔루션 사용자 등록</b></font> -->
		</div>
		<div style="float:right; padding:39px 30px 0 0px;">
			<font size="2" color="#FFFFFF"><?=$com_title?></font>
		</div>
	</div>
	<div style="background-color:#FFFFFF; border-width:0 2px 2px 2px; border-color:#96ABE5; border-style:solid; padding:10px;">
		<div style="height:95px; border-width:0 0 3px 0; border-color:#E1E1E1; border-style:solid; text-align:center; padding-top:25px; font-size:14px; color:#b0b0b0; margin-bottom:15px;">
			<b>CMS 솔루션을 사용하기 위한 <span style="color:#6D6363">직원 계정을 등록</span>해 주시기 바랍니다.<br>
			계정 등록은 <span style="color:#6D6363"><?=$com_title?></span> 임직원에 한해서만 해 주시기 바라며, 등록 뒤 관리자의<br>
			승인을 얻은 후 사용이 가능합니다.<span style="font-size:12px; color:#6D6363;"> (당사 임직원 또는 관계자인 경우에만 승인됩니다.)</span></b>
		</div>



		<div style="float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:1px 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			등록코드 구분 <span style="color:#cc0000">*</span>
		</div>
		<?
			$is_company=$_REQUEST['is_company'];
			$div_seq=$_REQUEST['div_seq'];
			$pj_seq=$_REQUEST['pj_seq'];
			$headq=$_REQUEST['headq'];
			$team=$_REQUEST['team'];
			$posi=$_REQUEST['posi'];
		?>
		<form name="frm" method="post" action="">
		<div style="float:left; width:512px; height:28px; border-width:1px 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="radio" name="is_company" value="1" onclick="submit();" <?if($is_company==1) echo 'checked';?>> 당사 임직원
			<input type="radio" name="is_company" value="2" onclick="submit();" <?if($is_company==2) echo 'checked';?> disabled> 현장 관리자(상담직원)
		</div>

		<div id="com_select"  <?if(!$is_company||$is_company==2) echo "style='display:none;'";?>>
			<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				본사 담당 부서 선택 <!-- <span style="color:#cc0000">*</span> -->
			</div>
			<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				<select name="div_seq" style="width:150px; height:23px;" class="inputstyle2">
					<option value="" <?if(!$div_seq) echo "selected";?>> 부서선택
					<?
						$query="SELECT seq, div_name FROM cms_com_div ORDER BY div_name";
						$result=mysql_query($query, $connect);
						for($i=0; $rows=mysql_fetch_array($result); $i++){
					?>
					<option value="<?=$rows[seq]?>" <?if($rows[seq]==$div_seq) echo "selected";?>> <?=$rows[div_name]?>
					<? } ?>
				</select>
			</div>
		</div>

		<div id="pj_select"  <?if(!$is_company||$is_company==1) echo "style='display:none;'";?>>
			<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				현장 (담당 프로젝트) 선택 <span style="color:#cc0000">*</span>
			</div>
			<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				<select name="pj_seq" style="width:150px; height:23px;" class="inputstyle2" onchange="submit();">
					<option value="" <?if(!$pj_seq) echo "selected";?>> 현장선택
					<?
						$query1="SELECT seq, pj_name FROM cms_project1_info WHERE is_end<>1 ORDER BY seq DESC";
						$result1=mysql_query($query1, $connect);
						for($i=0; $rows1=mysql_fetch_array($result1); $i++){
					?>
					<option value="<?=$rows1[seq]?>" <?if($rows1[seq]==$pj_seq) echo "selected";?>> <?=$rows1[pj_name]?>
					<? } ?>
				</select>
				<select name="headq" style="width:80px; height:23px;" class="inputstyle2" onchange="submit();" >
					<option value="" <?if(!$headq) echo "selected";?>>본부선택
					<?
						$query2="SELECT seq, headq FROM cms_resource_headq WHERE pj_seq='$pj_seq' ORDER BY headq";
						$result2=mysql_query($query2, $connect);
						for($i=0; $rows2=mysql_fetch_array($result2); $i++){
					?>
					<option value="<?=$rows2[seq]?>" <?if($rows2[seq]==$headq) echo "selected";?>> <?=$rows2[headq]?>
					<? } ?>
				</select>
				<select name="team" style="width:80px; height:23px;" class="inputstyle2" onchange="submit();">
					<option value="" <?if(!$team) echo "selected";?>> 팀선택
					<?
						$query3="SELECT seq, team FROM cms_resource_team WHERE pj_seq='$pj_seq' AND headq_seq='$headq' ORDER BY team";
						$result3=mysql_query($query3, $connect);
						for($i=0; $rows3=mysql_fetch_array($result3); $i++){
					?>
					<option value="<?=$rows3[seq]?>" <?if($rows3[seq]==$team) echo "selected";?>> <?=$rows3[team]?>
					<? } ?>
				</select>
				<select name="posi" style="width:80px; height:23px;" class="inputstyle2" onchange="submit();">
					<option value="" <?if(!$posi) echo "selected";?>> 직급선택
					<option value="1" <?if($posi==1) echo "selected";?>>본부장
					<option value="2" <?if($posi==2) echo "selected";?>>팀 장
					<option value="3" <?if($posi==3) echo "selected";?>>팀 원
				</select>
			</div>
		</div>
		</form>
		<form name="form1" method="post" action="member_post.php">
		<input type="hidden" name="mode" value="join">
		<input type="hidden" name="is_company" value="<?=$is_company?>">
		<input type="hidden" name="div_seq" value="<?=$div_seq?>">
		<input type="hidden" name="pj_seq" value="<?=$pj_seq?>">
		<input type="hidden" name="headq" value="<?=$headq?>">
		<input type="hidden" name="team" value="<?=$team?>">
		<input type="hidden" name="posi" value="<?=$posi?>">

		<div style="clear:left; float:left; width:180px; height:25px; background-color:#F8F8F7; padding:5px 0 0 20px;">
			아 이 디 <span style="color:#cc0000">*</span>
		</div>
		<div style="float:left; width:512px; height:25px; padding:5px 0 0 20px;">
			<input type="text" name="user_id" style="ime-mode:disabled;" size='23' class='inputstyle2' maxlength="12" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			<input type="button" value="중복확인" onclick="javascript:check_ID_Window('id_check.php')" class="inputstyle_bt">
		</div>
		<div style="clear:left; float:left; width:180px; height:36px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;"></div>
		<div style="float:left; width:512px; height:36px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			특수문자, 한글 공백을 포함할 수 없으며<br>
			모두 소문자로 처리됩니다.(4 - 12자 사이)
		</div>
		<div style="clear:left; float:left; width:180px; height:25px; background-color:#F8F8F7; padding:5px 0 0 20px;">
			비밀번호 <span style="color:#cc0000">*</span>
		</div>
		<div style="float:left; width:512px; height:25px; padding:5px 0 0 20px;">
			<input type="password" name="passwd" style="ime-mode:disabled;" size="35" class="inputstyle2" maxlength="10" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><br>
		</div>
		<div style="clear:left; float:left; width:180px; height:35px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;"></div>
		<div style="float:left; width:512px; height:36px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			특수문자, 숫자를 포함할 수 있으며<br>
			대, 소문자를 구분합니다.(6 - 10자 사이)
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			비밀번호 확인 <span style="color:#cc0000">*</span>
		</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="password" name="passwd2" style="ime-mode:disabled;" size="35" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			이 름 <span style="color:#cc0000">*</span>
		</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="name" size="35" class="inputstyle2" maxlength="12" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
		</div>

		<!-- <div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			주민등록 번호
		</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="jumin1" size="15" class="inputstyle2" maxlength="6" onkeyup="focus_move(this,6,jumin2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			-
			<input type="password" name="jumin2" size="16" maxlength="7" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
		</div> -->

		<div style="clear:left; float:left; width:180px; height:46px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			전자메일 (Email) <span style="color:#cc0000">*</span>
		</div>
		<div style="float:left; width:512px; height:46px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<div style="float:left;">
				<input type="text" name="email1" value="<?=$email[0]?>" style="ime-mode:disabled;" size="13" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			@
			<input type="text" name="email2" value="<?=$email[1]?>" style="ime-mode:disabled;" size="14" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			</div>
			<div style="float:left; padding-left:3px;">
				<select name="email3" Onchange="email2.value=this.value" class="inputstyle2" style="height:22px;">
				<option value="" selected> 직접입력
				<option value="naver.com"> 네이버
				<option value="hanmail.net"> 한메일
				<option value="daum.net"> 다음
				<option value="nate.com"> 네이트
				<option value="kr.yahoo.com"> 야후
				<option value="korea.com"> 코리아닷컴
				<option value="gmail.com"> 지메일
			</select>
			</div>
			<div style="clear:left;">
				<input type="checkbox" name="rcv_mail" checked> 메일 수신에 동의합니다.
			</div>
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			우편번호
		</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="zipcode" size="5" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">&nbsp;
			<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('zip_search.php', 'zipcode', 'address')" class="inputstyle_bt">
		</div>
		<div style="clear:left; float:left; width:180px; height:22px; background-color:#F8F8F7; padding:5px 0 0 20px;">
			주 소
		</div>
		<div style="float:left; width:512px; height:22px; padding:5px 0 0 20px;">
			<input type="text" name="address1" size="45" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> (동까지 입력)
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;"></div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="address2" size="45" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> (나머지 입력)
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			전화번호
		</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="phone1" size="4" class="inputstyle2" maxlength="3" onkeyup="focus_move(this,3,phone2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			-
			<input type="text" name="phone2" size="6" class="inputstyle2" maxlength="4" onkeyup="focus_move(this,4,phone3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			-
			<input type="text" name="phone3" size="6" class="inputstyle2" maxlength="4" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			(자택)
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			휴대폰 (Mobile) <span style="color:#cc0000">*</span>
		</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<div style="float:left;">
				<select name="hphone1" class="inputstyle2" onChange="hphone2.focus();" style="height:22px;">
				<option value="" selected> 선택
				<option value="010"> 010
				<option value="011"> 011
				<option value="016"> 016
				<option value="017"> 017
				<option value="018"> 018
				<option value="019"> 019
			</select>
			</div>
			<div style="float:left; padding-left:3px;">
				-
				<input type="text" name="hphone2" value="<?=$mobile[1]?>" size="6" class="inputstyle2" maxlength="4" onKeyup="focus_move(this,4,hphone3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
				-
				<input type="text" name="hphone3" value="<?=$mobile[2]?>" size="6" class="inputstyle2" maxlength="4" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			</div>
		</div>
		<div style="clear:left; height:60px; text-align:center; padding-top:20px;">
			<!-- <a href="javascript:checkInput()"><img src="../img/btn_ok.jpg" border='0'></a> -->
			<input type="button" value="사용자 등록" onclick="checkInput('join');" class="submit_bt">
			<!-- <a href="login_form.php"><img src="../img/btn_cancel.jpg" hspace="4" border='0'></a> -->
			<input type="button" value="취 소" onclick="location.href='login_form.php' " class="submit_bt">
		</div>
		</form>
	</div>
</div>
