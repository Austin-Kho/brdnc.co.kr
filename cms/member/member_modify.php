<?
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$doc_title?></title>
  <link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
  <link type="text/css" rel="stylesheet" href="../common/cms.css">
  <script type="text/javascript" src="../common/global.js"></script>
  <script type="text/javascript" src="../common/member.js"></script>
  <script type="text/javascript">
  <!--
	function cn_pass(ck){
		if(ck.checked==1){
			document.getElementById('pass_chn').style.display="";
		}else{
			document.getElementById('pass_chn').style.display="none";
		}
	}
  //-->
  </script>
 </head>

 <body>
 <div style="width:756px; height:100%; margin:0px auto;"><!-- wrap div -->
	<div style="height:38px;"></div>
	<div style="height:80px; background-color:#D9EAF8; border-width:2px; border-color:#96ABE5; border-style:solid;">
		<div style="float:left; padding:20px 0 0 25px;">
			<img src="../images/cms_box_logo.png" alt="">
		</div>
		<div style="float:left; padding:38px 0 0 20px;">
			<!-- <font size="3" color="#718EDB"><b>CMS 솔루션 사용자 정보 변경</b></font> -->
		</div>
		<div style="float:right; padding:39px 30px 0 0px;">
			<font size="2" color="#FFFFFF"><b><?=$com_title?></b></font>
		</div>
	</div>
	<div style="background-color:#FFFFFF; border-width:0 2px 2px 2px; border-color:#96ABE5; border-style:solid; padding:10px;">
		<div style="height:95px; border-width:0 0 3px 0; border-color:#E1E1E1; border-style:solid; text-align:center; padding-top:25px; font-size:14px; color:#b0b0b0; margin-bottom:15px;">
			<b><span style="color:#6D6363">회원 정보 변경사항</span>을 등록해 주십시요.<br>
			특히 보안을 위하여 <span style="color:#6D6363">비밀번호를 주기적으로 변경</span> 하여 주시기 바랍니다. <br>
			계정 등록 후 사용 승인지연과 관련한 문의는 <span style="color:#6D6363"><?=$admin_tel?></span> 로 문의하여 주십시요!</b>
		</div>
		<?
			$query = "SELECT * FROM cms_member_table WHERE user_id = '$_SESSION[p_id]' ";
			$result = mysql_query($query, $connect);
			$rows = mysql_fetch_array($result);

			$pass = explode("-", $rows[id_number]);
			$email = explode("@", $rows[email]);
			$zip = explode("-", $rows[zipcode]);
			$tel = explode("-", $rows[phone]);
			$mobile= explode("-", $rows[mobile]);
			$no = $rows[no];
			$pj_w = explode("-", $rows[pj_where]);
		?>
		<div style="float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:1px 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">등록코드 구분</div>
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
			<input type="radio" name="is_company" value="1" onclick="submit();" <?if($rows[is_company]==1) echo 'checked';?> disabled> 당사 임직원
			<input type="radio" name="is_company" value="2" onclick="submit();" <?if($rows[is_company]==2) echo 'checked';?> disabled> 현장 관리자(상담직원)
		</div>

		<?
			if($rows[is_company]==1){
		?>
		<div id="com_select" >
			<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">본사 담당 부서 선택</div>
			<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				<select name="div_seq" style="width:150px; height:23px;" class="inputstyle2" disabled>
					<option value="" <?if(!$div_seq) echo "selected";?>> 부서선택
					<?
						$d_query="SELECT seq, div_name FROM cms_com_div ";
						$d_result=mysql_query($d_query, $connect);
						for($i=0; $d_rows=mysql_fetch_array($d_result); $i++){
					?>
					<option value="<?=$d_rows[seq]?>" <?if($d_rows[seq]==$rows[div_seq]) echo "selected";?>> <?=$d_rows[div_name]?>
					<? } ?>
				</select>
			</div>
		</div>
		<?
			}else{
		?>
		<div id="pj_select"  <?=$pj_dis?>>
			<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">현장 (담당 프로젝트) 선택</div>


			<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				<select name="pj_seq" style="width:150px; height:23px;" class="inputstyle2" disabled>
					<option value=""> 현장선택
					<?
						$query1="SELECT seq, pj_name FROM cms_project_info WHERE is_end<>1";
						$result1=mysql_query($query1, $connect);
						for($i=0; $rows1=mysql_fetch_array($result1); $i++){
					?>
					<option value="<?=$rows1[seq]?>" <?if($rows1[seq]==$rows[pj_seq]) echo "selected";?>> <?=$rows1[pj_name]?>
					<? } ?>
				</select>
				<select name="headq" style="width:80px; height:23px;" class="inputstyle2" disabled>
					<option value="">본부선택
					<?
						$query2="SELECT seq, headq FROM cms_resource_headq WHERE pj_seq='$rows[pj_seq]' ";
						$result2=mysql_query($query2, $connect);
						for($i=0; $rows2=mysql_fetch_array($result2); $i++){
					?>
					<option value="<?=$rows2[seq]?>" <?if($rows2[seq]==$pj_w[0]) echo "selected";?>> <?=$rows2[headq]?>
					<? } ?>
				</select>
				<select name="team" style="width:80px; height:23px;" class="inputstyle2" disabled>
					<option value=""> 팀선택
					<?
						$query3="SELECT seq, team FROM cms_resource_team WHERE pj_seq='$rows[pj_seq]' AND headq_seq='$pj_w[0]' ";
						$result3=mysql_query($query3, $connect);
						for($i=0; $rows3=mysql_fetch_array($result3); $i++){
					?>
					<option value="<?=$rows3[seq]?>" <?if($rows3[seq]==$pj_w[1]) echo "selected";?>> <?=$rows3[team]?>
					<? } ?>
				</select>
				<select name="posi" style="width:80px; height:23px;" class="inputstyle2" disabled>
					<option value=""> 직급선택
					<option value="1" <?if($rows[pj_posi]==1) echo "selected";?>>본부장
					<option value="2" <?if($rows[pj_posi]==2) echo "selected";?>>팀 장
					<option value="3" <?if($rows[pj_posi]==3) echo "selected";?>>팀 원
				</select>
			</div>
		</div>
		<? } ?>
		</form>
		<form name="form1" method="post" action="member_post.php">
		<input type="hidden" name="mode" value="modify">
		<input type="hidden" name="no" value="<?=$no?>">
		<input type="hidden" name="is_company" value="<?=$is_company?>">
		<input type="hidden" name="div_seq" value="<?=$div_seq?>">
		<input type="hidden" name="pj_seq" value="<?=$pj_seq?>">
		<input type="hidden" name="headq" value="<?=$headq?>">
		<input type="hidden" name="team" value="<?=$team?>">
		<input type="hidden" name="posi" value="<?=$posi?>">



		<div style="clear:left; float:left; width:180px; height:25px; background-color:#F8F8F7; padding:5px 0 0 20px;">아 이 디</div>
		<div style="float:left; width:512px; height:25px; padding:5px 0 0 20px;">
			<input type="text" name="user_id" value="<?=$rows[user_id]?>" style="ime-mode:disabled;" size='22' class='inputstyle2' maxlength="12" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"  readonly>
		</div>

		<div style="clear:left; float:left; width:180px; height:36px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;"></div>
		<div style="float:left; width:512px; height:36px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			아이디는 변경할 수 없습니다. 등록코드 구분과 소속에 관<br>
			한 정보를 변경하시려면 관리자에게 문의하여 주십시요.
		</div>


		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">비밀번호 <span style="color:#cc0000">*</span>
			<input type="checkbox" name="" onclick="cn_pass(this);">변경하기
		</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="password" name="passwd" style="ime-mode:disabled;" size="35" class="inputstyle2" maxlength="10" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><!-- <br>
			특수문자, 공백을 포함할 수 없으며<br>
			대, 소문자를 구분합니다.(6~10자 사이) -->
		</div>
		<div id="pass_chn" style="display:none;">
			<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">새 비밀번호 <span style="color:#cc0000">*</span></div>
			<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				<input type="password" name="new_passwd" style="ime-mode:disabled;" size="35" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			</div>
			<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">새 비밀번호 확인 <span style="color:#cc0000">*</span></div>
			<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
				<input type="password" name="new_passwd2" style="ime-mode:disabled;" size="35" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			</div>
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">이 름 <span style="color:#cc0000">*</span></div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="name" value="<?=$rows[name]?>" size="35" class="inputstyle2" maxlength="12" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
		</div>

		<!-- <div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">주민등록 번호</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="jumin1" value="<?=$pass[0]?>" size="15" class="inputstyle2" maxlength="6" onkeyup="focus_move(this,6,jumin2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" readonly>
			-
			<input type="password" name="jumin2" value="<?=$pass[1]?>" size="16" maxlength="7" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" readonly>
		</div> -->

		<div style="clear:left; float:left; width:180px; height:46px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">전자메일 (Email) <span style="color:#cc0000">*</span></div>
		<div style="float:left; width:512px; height:46px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<div style="float:left;">
				<input type="text" name="email1" value="<?=$email[0]?>" style="ime-mode:disabled;" size="15" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			@
			<input type="text" name="email2" value="<?=$email[1]?>" style="ime-mode:disabled;" size="15" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			</div>
			<div style="float:left; padding-left:3px;">
				<select name="email3" Onchange="email2.value=this.value" class="inputstyle2" style="height:22px;">
				<option value="" <?if(!$email[1]) echo "selected";?>> 직접입력
				<option value="naver.com" <?if($email[1]=="naver.com") echo "selected";?>> 네이버
				<option value="hanmail.net" <?if($email[1]=="hanmail.net") echo "selected";?>> 한메일
				<option value="daum.net" <?if($email[1]=="daum.net") echo "selected";?>> 다음
				<option value="nate.com" <?if($email[1]=="nate.com") echo "selected";?>> 네이트
				<option value="kr.yahoo.com" <?if($email[1]=="kr.yahoo.com") echo "selected";?>> 야후
				<option value="korea.com" <?if($email[1]=="korea.com") echo "selected";?>> 코리아닷컴
				<option value="gmail.com" <?if($email[1]=="gmail.com") echo "selected";?>> 지메일
			</select>
			</div>
			<div style="clear:left;">
				<input type="checkbox" name="rcv_mail" checked> 메일 수신에 동의합니다.
			</div>
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">우편번호</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="zipcode" value="<?=$zip[0]?>" size="5" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">&nbsp;
			<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('zip_search.php', 'zipcode', 'address')" class="inputstyle_bt">
		</div>


		<div style="clear:left; float:left; width:180px; height:22px; background-color:#F8F8F7; padding:5px 0 0 20px;">주 소</div>
		<div style="float:left; width:512px; height:22px; padding:5px 0 0 20px;">
			<input type="text" name="address1" value="<?=$rows[address1]?>" size="45" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> (동까지 입력)
		</div>

		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;"></div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="address2" value="<?=$rows[address2]?>" size="45" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"> (나머지 입력)
		</div>





		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">전화번호</div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<input type="text" name="phone1" value="<?=$tel[0]?>" size="7" class="inputstyle2" maxlength="3" onkeyup="focus_move(this,3,phone2);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			-
			<input type="text" name="phone2" size="6" value="<?=$tel[1]?>" class="inputstyle2" maxlength="4" onkeyup="focus_move(this,4,phone3);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			-
			<input type="text" name="phone3" size="6" value="<?=$tel[2]?>" class="inputstyle2" maxlength="4" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');">
			(자택)
		</div>
		<div style="clear:left; float:left; width:180px; height:28px; background-color:#F8F8F7; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">휴대폰 (Mobile) <span style="color:#cc0000">*</span></div>
		<div style="float:left; width:512px; height:28px; border-width:0 0 1px 0; border-color:#E1E1E1; border-style:solid; padding:5px 0 0 20px;">
			<div style="float:left;">
				<select name="hphone1" class="inputstyle2" onChange="hphone2.focus();" style="height:22px;">
				<option value="" <?if(!$mobile[0]) echo "selected";?>> 선택
				<option value="010" <?if($mobile[0]=="010") echo "selected";?>> 010
				<option value="011" <?if($mobile[0]=="011") echo "selected";?>> 011
				<option value="016" <?if($mobile[0]=="016") echo "selected";?>> 016
				<option value="017" <?if($mobile[0]=="017") echo "selected";?>> 017
				<option value="018" <?if($mobile[0]=="018") echo "selected";?>> 018
				<option value="019" <?if($mobile[0]=="019") echo "selected";?>> 019
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
			<!-- <a href="javascript:checkInput()"><img src="../img/btn_ok.jpg" border='0'></a> --><input type="button" value="사용자 정보변경" onclick="checkInput('modify');" class="submit_bt">
			<!-- <a href="login_form.php"><img src="../img/btn_cancel.jpg" hspace="4" border='0'></a> --><input type="button" value="취 소" onclick="history.go(-1);" class="submit_bt">
		</div>
		</form>
	</div>
</div>
