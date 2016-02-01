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

	$edit_code = $_REQUEST['edit_code'];
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
	<script type="text/JavaScript" language="JavaScript" src="../common/_menu3.js"></script>
	<script type="text/JavaScript" language="JavaScript" src="../include/calendar/calendar.js"></script>
	<script type="text/javascript">
	<!--
		function _editChk(){

			var form = document.form1;

			var d1_1 = document.getElementById('d1_1');
			var d1_2 = document.getElementById('d1_2');
			var d1_3 = document.getElementById('d1_3');
			var d1_4 = document.getElementById('d1_4');
			var d1_5 = document.getElementById('d1_5');

			if(!form.deal_date.value){ // 거래일자
				alert('거래 일자를 입력하세요!');
				form.deal_date.focus();
				return;
			}
			if(!form.class1.value){ // 구분1(대분류)
			 	alert('구분1을 입력하세요!');
			 	form.class1.focus();
			 	return;
			}
			if(!form.class2.value){ // 구분2(중분류)
			 	alert('구분2를 입력하세요!');
			 	form.class2.focus();
			 	return;
			}

			if(form.class1.value!=3&&!d1_1.value&&!d1_2.value&&!d1_3.value&&!d1_4.value&&!d1_5.value){ // 구분3(계정과목)
			 	alert('계정과목을 선택하세요!');
			 	form.account.focus();
			 	return;
			}

			if(form.is_jh.checked==true){ // 조합여부 체크박스
				if(!form.any_jh.value){ // 조합현장 선택목록
					alert('대여금 지급 현장을 선택하세요!');
					form.any_jh.focus();
					return;
				}
			}

			if(!form.cont.value){ // 적요
				alert('적요 항목을 입력하세요!');
				form.cont.focus();
				return;
			}

			if(form.class1.value==1){ // 입금 시
				if(!form.inc.value){ // 입금액
					 alert('입금 금액을 입력하세요!');
					 form.inc.focus();
					 return;
				}
				if(!form.ina.value){ // 입금처
					 alert('입금 계정을 입력하세요!');
					 form.ina.focus();
					 return;
				}
			}

			if(form.class1.value==2){ // 출금 시
				if(!form.exp.value){ // 출금액
					 alert('출금 금액을 입력하세요!');
					 form.exp.focus();
					 return;
				}
				if(!form.out.value){
					 alert('출금 계정을 입력하세요!');
					 form.out.focus();
					 return;
				}
			}
			if(form.class1.value==3){ // 대체 시
				if(!form.inc.value){
					 alert('입금 금액을 입력하세요!');
					 form.inc.focus();
					 return;
				}
				if(!form.ina.value){
					 alert('입금 계정을 입력하세요!');
					 form.ina.focus();
					 return;
				}
				if(!form.exp.value){
					 alert('출금 금액을 입력하세요!');
					 form.exp.focus();
					 return;
				}
				if(!form.out.value){
					 alert('출금 계정을 입력하세요!');
					 form.out.focus();
					 return;
				}
			}
			var s2_sub=confirm('입출금 거래정보를 수정하시겠습니까?');
			if(s2_sub==true){
				form.submit();
			}
		}
	//-->
	</script>
</head>
<?
	$query="select * from cms_capital_cash_book where seq_num='$edit_code'";
	$result=mysql_query($query, $connect);
	$rows=mysql_fetch_array($result);
?>

<body style="background-color:white;" onclick="cal_del();">
<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b>입출금 거래건별 수정</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<form name="form1" action="capital_edit_post.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="seq_num" value="<?=$edit_code?>">
				<div style="height:28px; background-color:#F4F4F4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					변경 할 입출금 거래정보를 수정해 주십시요. (<font color="#ff0000">*</font>표시는 필수입력 정보)
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						거래일자  <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:5px; text-align:left;">
						<!-- <input type="text" name="deal_date" id="deal_date" value="<?=$rows[deal_date]?>" class="inputstyle2" size="31" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')"> <a href="javascript:" onclick="openCalendar(document.getElementById('deal_date'));"><img src="../images/calendar.jpg" border="0" alt="" /></a> -->

						<input type="text" name="deal_date" id="deal_date" value="<?=$rows[deal_date]?>" size="25" class="inputstyle2" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
						<a href="javascript:" onclick="cal_add(document.getElementById('deal_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						계정과목 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<select name="class1" style="width:88;" onChange="inoutSel_(this.form)">
							<option value="" <?if(!$rows[class1]) echo "selected";?>> 선 택
							<option value="1" <?if($rows[class1]==1) echo "selected";?>> 입 금
							<option value="2" <?if($rows[class1]==2) echo "selected";?>> 출 금
							<option value="3" <?if($rows[class1]==3) echo "selected";?>> 대 체
						</select>
						<select name="class2" style="width:88;" onChange="inoutSel2_(this.form)">
						<?if(!$rows[class1]){?>
							<option value="" <?if(!$rows[class2]) echo "selected";?>> 선 택
							<option value="1" <?if($rows[class2]==1) echo "selected";?>> 수 익
							<option value="2" <?if($rows[class2]==2) echo "selected";?>> 차 입
							<option value="3" <?if($rows[class2]==3) echo "selected";?>> 회 수
							<option value="4" <?if($rows[class2]==4) echo "selected";?>> 출 자
							<option value="5" <?if($rows[class2]==5) echo "selected";?>> 비 용
							<option value="6" <?if($rows[class2]==6) echo "selected";?>> 상 환
							<option value="7" <?if($rows[class2]==7) echo "selected";?>> 대 여
							<option value="8" <?if($rows[class2]==8) echo "selected";?>> 배 당
							<option value="9" <?if($rows[class2]==9) echo "selected";?>> 본 사
							<option value="10" <?if($rows[class2]==10) echo "selected";?>> 현 장
						<?}else if($rows[class1]==1){?>
							<option value="" <?if(!$rows[class2]) echo "selected";?>> 선 택
							<option value="1" <?if($rows[class2]==1) echo "selected";?>> 수 익
							<option value="2" <?if($rows[class2]==2) echo "selected";?>> 차 입
							<option value="3" <?if($rows[class2]==3) echo "selected";?>> 회 수
							<option value="4" <?if($rows[class2]==4) echo "selected";?>> 출 자
						<?}else if($rows[class1]==2){?>
							<option value="5" <?if($rows[class2]==5) echo "selected";?>> 비 용
							<option value="6" <?if($rows[class2]==6) echo "selected";?>> 상 환
							<option value="7" <?if($rows[class2]==7) echo "selected";?>> 대 여
							<option value="8" <?if($rows[class2]==8) echo "selected";?>> 배 당
						<?}else if($rows[class1]==3){?>
							<option value="9" <?if($rows[class2]==9) echo "selected";?>> 본 사
							<option value="10" <?if($rows[class2]==10) echo "selected";?>> 현 장
						<?}?>
						</select>



						<!-- 자산 계정 목록 시작--> <!-- 대여/회수 -->
						<select name="account_1" id="d1_1" style="width:105px; <?if($rows[class2]!=3&&$rows[class2]!=7) echo 'display:none; disabled;';?>" onChange="alert(self);">
							<?
								$acc_qry = "SELECT * FROM cms_capital_account_d3 WHERE d1_code='1' AND is_sp_acc !='1' ORDER BY d3_code ASC";
								$acc_rlt = mysql_query($acc_qry, $connect);
							?>
							<option value=""> 선 택
							<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
							<option value="<?=$acc_rows[d3_acc_name]?>" <?if($rows[account]==$acc_rows[d3_acc_name]) echo "selected";?>> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
							<?}?>
						</select>
						<!-- 자산 계정 목록 종료-->
						<!-- 부채 계정 목록 시작--> <!-- 차입/상환 -->
						<select name="account_2" id="d1_2" style="width:105px; <?if($rows[class2]!=2&&$rows[class2]!=6) echo 'display:none; disabled;';?>">
							<?
								$acc_qry = "SELECT * FROM cms_capital_account_d3 WHERE d1_code='2' AND is_sp_acc !='1' ORDER BY d3_code ASC";
								$acc_rlt = mysql_query($acc_qry, $connect);
							?>
							<option value=""> 선 택
							<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
							<option value="<?=$acc_rows[d3_acc_name]?>" <?if($rows[account]==$acc_rows[d3_acc_name]) echo "selected";?>> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
							<?}?>
						</select>
						<!-- 부채 계정 목록 종료-->
						<!-- 자본 계정 목록 시작--> <!-- 출자/배당 -->
						<select name="account_3" id="d1_3" style="width:105px; <?if($rows[class2]!=4&&$rows[class2]!=8) echo 'display:none; disabled;';?>">
							<?
								$acc_qry = "SELECT * FROM cms_capital_account_d3 WHERE d1_code='3' AND is_sp_acc !='1' ORDER BY d3_code ASC";
								$acc_rlt = mysql_query($acc_qry, $connect);
							?>
							<option value=""> 선 택
							<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
							<option value="<?=$acc_rows[d3_acc_name]?>" <?if($rows[account]==$acc_rows[d3_acc_name]) echo "selected";?>> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
							<?}?>
						</select>
						<!-- 자본 계정 목록 종료-->
						<!-- 수익 계정 목록 시작--> <!-- 수익 -->
						<select name="account_4" id="d1_4" style="width:105px; <?if($rows[class2]!=1) echo 'display:none; disabled;';?>">
							<?
								$acc_qry = "SELECT * FROM cms_capital_account_d3 WHERE d1_code='4' AND is_sp_acc !='1' ORDER BY d3_code ASC";
								$acc_rlt = mysql_query($acc_qry, $connect);
							?>
							<option value=""> 선 택
							<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
							<option value="<?=$acc_rows[d3_acc_name]?>" <?if($rows[account]==$acc_rows[d3_acc_name]) echo "selected";?>> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
							<?}?>
						</select>
						<!-- 수익 계정 목록 종료-->
						<!-- 비용 계정 목록 시작--> <!-- 비용 -->
						<select name="account_5" id="d1_5" style="width:105px; <?if($rows[class2]!=5) echo 'display:none; disabled;';?>">
							<?
								$acc_qry = "SELECT * FROM cms_capital_account_d3 WHERE d1_code='5' AND is_sp_acc !='1' ORDER BY d3_code ASC";
								$acc_rlt = mysql_query($acc_qry, $connect);
							?>
							<option value=""> 선 택
							<?while($acc_rows = mysql_fetch_array($acc_rlt)){?>
							<option value="<?=$acc_rows[d3_acc_name]?>" <?if($rows[account]==$acc_rows[d3_acc_name]) echo "selected";?>> <?=$acc_rows[d3_acc_name]."(".$acc_rows[d3_code].")"?>
							<?}?>
						</select>
						<!-- 비용 계정 목록 종료-->
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						조합대여금 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<input type="checkbox" name="is_jh" id="is_jh" value="1" onClick="edit_jh_chk();" <?if($rows[is_jh_loan]) echo 'checked';?> <? if(!$rows[is_jh_loan]&&$rows[class2]!=3&&$rows[class2]!=7) echo  'disabled';?>> 조합
					</div>
					<div style="float:left; padding:6px 0 0 10px;">
						<?
							// 현장 목록 가져오기
							$pj_qry = "SELECT seq, pj_name FROM cms_project1_info WHERE is_end!='1' ORDER BY start_date DESC, seq DESC";
							$pj_rlt = mysql_query($pj_qry, $connect);
							$pj_num = mysql_num_rows($pj_rlt);
							for($i=0; $pj_rows = mysql_fetch_array($pj_rlt); $i++){
								$pj_seq[$i]= $pj_rows[seq];
								$pj_name[$i]= $pj_rows[pj_name];
							}
						?>
						<select name="any_jh" id="any_jh" style="width:160px;" <?if(!$rows[any_jh]) echo "disabled";?>>
							<option value=""> 선 택
							<? for($i=0; $i<$pj_num; $i++){ ?>
							<option value="<?=$pj_seq[$i]?>" <?if($rows[any_jh]==$pj_seq[$i]) echo "selected";?>> <?=$pj_name[$i]?>
							<? } ?>
						</select>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						적 요 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:5px; text-align:left;">
						<input type="text" name="cont" value="<?=$rows[cont]?>" size="35" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" >
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						거 래 처
					</div>
					<div style="float:left; padding-top:5px; text-align:left;">
						<input type="text" name="acc" value="<?=$rows[acc]?>" size="35" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						입금내역 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:5px; text-align:left;">
						<input type="text" name="inc" value="<?if($rows[inc]>0) echo $rows[inc]?>" size="15" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if($rows[class1]==2) echo "disabled";?>>
					</div>
					<div style="float:left; padding:6px 0 0 5px; text-align:left;">
						<select name="ina" style="width:78;" <?if($rows[class1]==2) echo "disabled";?>>
							<option value="" <?if(!$rows[in_acc]) echo "selected";?>> 선 택
							<?
								$query1="select * from cms_capital_bank_account ";
								$result1=mysql_query($query1, $connect);
								while($rows1=mysql_fetch_array($result1)){
							?>
							<option value="<?=$rows1[no]?>" <?if($rows1[no]==$rows[in_acc]) echo "selected";?>> <?=$rows1[name]?>
							<? } ?>
						</select>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						출금내역 <font color="#ff0000">*</font>
					</div>
					<div style="float:left; padding-top:5px; text-align:left;">
						<input type="text" name="exp" value="<?=$rows[exp]?>" size="15" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if($rows[class1]==1) echo "disabled";?>>
					</div>
					<div style="float:left; padding:6px 0 0 5px; text-align:left;">
						<select name="out" style="width:78;" <?if($rows[class1]==1) echo "disabled";?>>
							<option value="" <?if(!$rows[out_acc]) echo "selected";?>> 선 택
							<?
								$query1="select * from cms_capital_bank_account ";
								$result1=mysql_query($query1, $connect);
								while($rows1=mysql_fetch_array($result1)){
							?>
							<option value="<?=$rows1[no]?>" <?if($rows1[no]==$rows[out_acc]) echo "selected";?>> <?=$rows1[name]?>
							<? } ?>
						</select>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						증빙서류
					</div>
					<div style="float:left; padding-top:6px; text-align:left;">
						<select name="evi" style="width:190">
							<option value="1" <?if($rows[evidence]==1) echo "selected";?>> 증빙 없음
							<option value="2" <?if($rows[evidence]==2) echo "selected";?>> 세금계산서
							<option value="3" <?if($rows[evidence]==3) echo "selected";?>> 계산서
							<option value="4" <?if($rows[evidence]==4) echo "selected";?>> 신용(체크)카드전표
							<option value="5" <?if($rows[evidence]==5) echo "selected";?>> 현금영수증
							<option value="6" <?if($rows[evidence]==6) echo "selected";?>> 간이영수증
						</select>
					</div>
				</div>
				<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
						비 고
					</div>
					<div style="float:left; padding-top:5px; text-align:left;">
						<textarea name="note" rows="2" cols="36" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"><?=$rows[note]?></textarea>
					</div>
				</div>
				</form>
				<div style="height:50px; text-align:center; padding-top:15px;">
					<input type="button" value=" 수정하기 " onclick="_editChk();" style="height:20px;" class="inputstyle_bt">
					<input type="button" value=" 닫 기 " onclick="self.close();" style="height:20px;" class="inputstyle_bt">
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>