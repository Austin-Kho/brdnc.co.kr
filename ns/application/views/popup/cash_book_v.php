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


<div class="container">
	<header id="header">
		<h1>입출금 거래건별 수정</h1>
	</header>
	<div class="desc"></div>
	<div class="well" style="margin-bottom: 20px;">변경 할 입출금 거래정보를 수정해 주십시요. (<font color="#ff0000">*</font>표시는 필수 정보)</div>

	<form class="form-horizontal" action="index.html" method="post">
		<label><input type="hidden" name="seq_num" value="<?php echo $this->uri->segment(4); ?>"></label>

		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">거래일자 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-5">
				<input type="text" name="deal_date" id="deal_date" class="form-control input-sm" value="" onclick="cal_add(this); event.cancelBubble=true"  readonly>
			</div>
			<div class="col-xs-1">
				<a href="javascript:" onclick="cal_add(document.getElementById('deal_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">계정과목 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-3">
				<!-- <input type="text" name="name" class="form-control input-sm" value=""> -->
				<select name="class1" class="form-control input-sm" onChange="inoutSel(this.form)">
					<option value="" selected> 선 택
					<option value="1" > 입 금
					<option value="2" > 출 금
					<option value="3" > 대 체
				</select>
			</div>
			<div class="col-xs-3">
				<select name="class2" class="form-control input-sm" onChange="inoutSel2(this.form)" disabled>
					<option value="" selected> 선 택
				</select>
				<!-- 자산 계정 목록 시작--> <!-- 입금/출금 -->
				<select name="account_1" id="d1_1" style="width:105px; display:none;" >

					<option value=""> 선 택

				</select>
				<!-- 자산 계정 목록 종료-->
				<!-- 부채 계정 목록 시작--> <!-- 입금/출금 -->
				<select name="account_2" id="d1_2" style="width:105px; display:none; disabled;">

					<option value=""> 선 택

				</select>
				<!-- 부채 계정 목록 종료-->
				<!-- 자본 계정 목록 시작--> <!-- 입금/출금 -->
				<select name="account_3" id="d1_3" style="width:105px; display:none; disabled;">

					<option value=""> 선 택

				</select>
				<!-- 자본 계정 목록 종료-->
				<!-- 수익 계정 목록 시작--> <!-- 입금 -->
				<select name="account_4" id="d1_4" style="width:105px; display:none; disabled;">

					<option value=""> 선 택

				</select>
				<!-- 수익 계정 목록 종료-->
				<!-- 비용 계정 목록 시작--> <!-- 출금 -->
				<select name="account_5" id="d1_5" style="width:105px; display:none; disabled;">

					<option value=""> 선 택

				</select>
				<!-- 비용 계정 목록 종료-->
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">조합대여금 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-2 checkbox">
				<label><input type="checkbox" name="is_jh" id="is_jh" value="1" onClick="edit_jh_chk();"  disabled> 조합</label>
			</div>
			<div class="col-xs-4 checkbox">
				<select name="any_jh" id="any_jh" class="form-control input-sm" disabled>
					<option value=""> 선 택
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">적 요 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-8">
				<input type="text" name="name" class="form-control input-sm" value="">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">거래처 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-8">
				<input type="text" name="name" class="form-control input-sm" value="">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">입금내역 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-4">
				<input type="text" name="name" class="form-control input-sm" value="">
			</div>
			<div class="col-xs-3">
				<select name="ina" class="form-control input-sm">
					<option value="" selected> 선 택

				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">출금내역 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-4">
				<input type="text" name="exp" class="form-control input-sm" value="">
			</div>
			<div class="col-xs-3">
				<select name="out" class="form-control input-sm">
					<option value="" selected> 선 택

				</select>
			</div>
		</div>

		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">증빙서류 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-6">
				<select name="evi" class="form-control input-sm">
					<option value="1" > 증빙 없음
					<option value="2" > 세금계산서
					<option value="3" > 계산서
					<option value="4" > 신용(체크)카드전표
					<option value="5" > 현금영수증
					<option value="6" > 간이영수증
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3 right" style="text-align: right;">
				<label for="">비 고 <font color="#ff0000">*</font></label>
			</div>
			<div class="col-xs-8">
				<textarea class="form-control input-sm" id="note" name="note"  rows="3" cols="114"></textarea>
			</div>
		</div>
		<footer class="form-group">
			<div class="col-xs-12" style="text-align: right;">
				<input type="button" name="name" class="btn btn-primary btn-sm" value="수정하기">
				<input type="button" name="name" class="btn btn-danger btn-sm" value="닫기">
			</div>
		</footer>
	</form>



		<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
			<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
				조합대여금 <font color="#ff0000">*</font>
			</div>
			<div style="float:left; padding-top:6px; text-align:left;">
				<input type="checkbox" name="is_jh" id="is_jh" value="1" onClick="edit_jh_chk();"  disabled> 조합
			</div>
			<div style="float:left; padding:6px 0 0 10px;">

				<select name="any_jh" id="any_jh" style="width:160px;" disabled>
					<option value=""> 선 택
				</select>
			</div>
		</div>
		<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
			<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
				적 요 <font color="#ff0000">*</font>
			</div>
			<div style="float:left; padding-top:5px; text-align:left;">
				<input type="text" name="cont" value="" size="35" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" >
			</div>
		</div>
		<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
			<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
				거 래 처
			</div>
			<div style="float:left; padding-top:5px; text-align:left;">
				<input type="text" name="acc" value="" size="35" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
			</div>
		</div>
		<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
			<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
				입금내역 <font color="#ff0000">*</font>
			</div>
			<div style="float:left; padding-top:5px; text-align:left;">
				<input type="text" name="inc" value="" size="15" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" >
			</div>
			<div style="float:left; padding:6px 0 0 5px; text-align:left;">
				<select name="ina" style="width:78;" >
					<option value="" selected> 선 택

				</select>
			</div>
		</div>
		<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
			<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
				출금내역 <font color="#ff0000">*</font>
			</div>
			<div style="float:left; padding-top:5px; text-align:left;">
				<input type="text" name="exp" value="" size="15" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" >
			</div>
			<div style="float:left; padding:6px 0 0 5px; text-align:left;">
				<select name="out" style="width:78;" >
					<option value="" selected> 선 택

				</select>
			</div>
		</div>
		<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
			<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
				증빙서류
			</div>
			<div style="float:left; padding-top:6px; text-align:left;">
				<select name="evi" style="width:190">
					<option value="1" > 증빙 없음
					<option value="2" > 세금계산서
					<option value="3" > 계산서
					<option value="4" > 신용(체크)카드전표
					<option value="5" > 현금영수증
					<option value="6" > 간이영수증
				</select>
			</div>
		</div>
		<div style="height:32px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
			<div style="float:left; padding:9px 15px 0 0; text-align:right; width:100px;">
				비 고
			</div>
			<div style="float:left; padding-top:5px; text-align:left;">
				<textarea name="note" rows="2" cols="36" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');"></textarea>
			</div>
		</div>
		</form>
		<div style="height:50px; text-align:center; padding-top:15px;">
			<input type="button" value=" 수정하기 " onclick="_editChk();" style="height:20px;" class="inputstyle_bt">
			<input type="button" value=" 닫 기 " onclick="self.close();" style="height:20px;" class="inputstyle_bt">
		</div>
	</div>


</div>
