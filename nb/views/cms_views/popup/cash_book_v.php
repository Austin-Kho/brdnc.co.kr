	<script src="<?php echo base_url('static/js/global.js'); ?>"></script>
	<script src="<?php echo base_url('static/js/cms_m4.js'); ?>"></script>
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
	<div class="well" style="padding: 13px; margin-bottom: 9px;">변경 할 입출금 거래정보를 수정해 주십시요. (<font color="#ff0000">*</font>표시는 필수 정보)</div>

<?php
	$attributes = array('name' => 'form1', 'class' => 'form-horizontal');
	$hidden = array('seq_num' => $this->uri->segment(4));
	echo form_open(current_full_url(), $attributes, $hidden);
?>
		<div class="row" style="padding: 0 15px; margin-bottom: 15px;">
			<div class="form-group" style="padding-top: 15px;">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="deal_date">거래일자 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-5" style="padding-right: 0;">
					<div>
						<input type="text" name="deal_date" id="deal_date" class="form-control input-sm" value="<?php echo $row->deal_date; ?>" onclick="cal_add(this); event.cancelBubble=true">
					</div>
				</div>
				<div class="col-xs-1" style="padding: 7px; 0;">
					<a href="javascript:" onclick="cal_add(document.getElementById('deal_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="class1">계정과목 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-2"  style="padding-right: 0;">
					<select name="class1" id="class1" class="form-control input-sm" onChange="inoutSel(this.form)">
						<option value=""> 선 택</option>
						<option value="1"  <?php if($row->class1==1) echo 'selected' ?>> 입 금</option>
						<option value="2"  <?php if($row->class1==2) echo 'selected' ?>> 출 금</option>
						<option value="3"  <?php if($row->class1==3) echo 'selected' ?>> 대 체</option>
					</select>
				</div>
				<div class="col-xs-2"  style="padding-right: 0;">
					<label for="class2" class="sr-only">세부 계정과목</label>
					<select name="class2" id="class2" class="form-control input-sm" onChange="inoutSel2(this.form)" <?php if(!$row->class2) echo 'disabled'; ?>>
<?php if( !$row->class2) : ?>
						<option value="" selected> 선 택</option>
<?php elseif($row->class1==1) : ?>
						<option value="1" <?if($row->class2==1) echo "selected";?>> 자 산</option>
						<option value="2" <?if($row->class2==2) echo "selected";?>> 부 채</option>
						<option value="3" <?if($row->class2==3) echo "selected";?>> 자 본</option>
						<option value="4" <?if($row->class2==4) echo "selected";?>> 수 익</option>
<?php elseif($row->class1==2) : ?>
						<option value="1" <?if($row->class2==1) echo "selected";?>> 자 산</option>
						<option value="2" <?if($row->class2==2) echo "selected";?>> 부 채</option>
						<option value="3" <?if($row->class2==3) echo "selected";?>> 자 본</option>
						<option value="5" <?if($row->class2==5) echo "selected";?>> 비 용</option>
<?php elseif($row->class1==3) : ?>
						<option value="6" <?if($row->class2==6) echo "selected";?>> 본 사</option>
						<option value="7" <?if($row->class2==7) echo "selected";?>> 현 장</option>
<?php endif; ?>
					</select>
				</div>
<?php $sel_style = ($row->class1==3&&$row->class2!=1) ?  'disabled' : ''; ?>
				<div class="col-xs-3"  style="padding-right: 0;">
					<!-- 자산 계정 목록 시작--> <!-- 입금/출금 -->
					<select name="account_1" id="d1_1" class="form-control input-sm" style="<?php if($row->class1!=3&&$row->class2!=1) echo 'display:none;';?>" <?php echo $sel_style; ?>>
						<option value=""> 선 택</option>
<?php foreach($acnt1 as $lt) : ?>
						<option value="<?php echo $lt->d3_acc_name; ?>" <?php if($row->account==$lt->d3_acc_name) echo 'selected'; ?>><?php echo $lt->d3_acc_name."(".$lt->d3_code.")"?></option>
<?php endforeach; ?>
					</select>
					<!-- 자산 계정 목록 종료-->

					<!-- 부채 계정 목록 시작--> <!-- 입금/출금 -->
					<select name="account_2" id="d1_2" class="form-control input-sm" style="<?php if($row->class2!=2) echo 'display:none; disabled;';?>">
						<option value=""> 선 택</option>
<?php foreach($acnt2 as $lt) : ?>
						<option value="<?php echo $lt->d3_acc_name; ?>" <?php if($row->account==$lt->d3_acc_name) echo 'selected'; ?>><?php echo $lt->d3_acc_name."(".$lt->d3_code.")"?></option>
<?php endforeach; ?>
					</select>
					<!-- 부채 계정 목록 종료-->

					<!-- 자본 계정 목록 시작--> <!-- 입금/출금 -->
					<select name="account_3" id="d1_3" class="form-control input-sm" style="<?php if($row->class2!=3) echo 'display:none; disabled;';?>">
						<option value=""> 선 택 </option>
<?php foreach($acnt3 as $lt) : ?>
						<option value="<?php echo $lt->d3_acc_name; ?>" <?php if($row->account==$lt->d3_acc_name) echo 'selected'; ?>><?php echo $lt->d3_acc_name."(".$lt->d3_code.")"?></option>
<?php endforeach; ?>
					</select>
					<!-- 자본 계정 목록 종료-->

					<!-- 수익 계정 목록 시작--> <!-- 입금 -->
					<select name="account_4" id="d1_4" class="form-control input-sm" style="<?php if($row->class2!=4) echo 'display:none; disabled;';?>">
						<option value=""> 선 택 </option>
<?php foreach($acnt4 as $lt) : ?>
						<option value="<?php echo $lt->d3_acc_name; ?>" <?php if($row->account==$lt->d3_acc_name) echo 'selected'; ?>><?php echo $lt->d3_acc_name."(".$lt->d3_code.")"?></option>
<?php endforeach; ?>
					</select>
					<!-- 수익 계정 목록 종료-->

					<!-- 비용 계정 목록 시작--> <!-- 출금 -->
					<select name="account_5" id="d1_5" class="form-control input-sm" style="<?php if($row->class2!=5) echo 'display:none; disabled;';?>">
						<option value=""> 선 택 </option>
<?php foreach($acnt5 as $lt) : ?>
						<option value="<?php echo $lt->d3_acc_name; ?>" <?php if($row->account==$lt->d3_acc_name) echo 'selected'; ?>><?php echo $lt->d3_acc_name."(".$lt->d3_code.")"?></option>
<?php endforeach; ?>
					</select>
					<!-- 비용 계정 목록 종료-->
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="">조합대여금 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-2 checkbox">
					<label><input type="checkbox" name="is_jh" id="is_jh" value="1" onClick="edit_jh_chk();" <?php if($row->is_jh_loan) echo 'checked';?> <?php if(!$row->is_jh_loan&&$row->class2!=1) echo  'disabled';?>> 조합</label>
				</div>
				<div class="col-xs-4 checkbox"  style="padding-right: 0;">
					<select name="any_jh" id="any_jh" class="form-control input-sm" <?php if(!$row->any_jh) echo "disabled";?>>
						<option value=""> 선 택</option>
<?php foreach($pj as $lt) :?>
						<option value="<?php echo $lt->seq; ?>" <?php if($row->any_jh==$lt->seq) echo "selected";?>> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="cont">적 요 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-8"  style="padding-right: 0;">
					<input type="text" name="cont" id="cont" class="form-control input-sm" value="<?php echo $row->cont; ?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="acc">거래처 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-8"  style="padding-right: 0;">
					<input type="text" name="acc" id="acc" class="form-control input-sm" value="<?php echo $row->acc;?>">
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="inc">입금내역 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-4"  style="padding-right: 0;">
					<input type="text" name="inc" id="inc" class="form-control input-sm" value="<?php if($row->inc!=0)echo $row->inc; ?>" <?php if($row->class1==2) echo "disabled";?>>
				</div>
				<div class="col-xs-3"  style="padding-right: 0;">
					<label for="ina" class="sr-only">입금처</label>
					<select name="ina" id="ina" class="form-control input-sm">
						<option value="" selected> 선 택</option>
<?php foreach($bank_acc as $lt) : ?>
						<option value="<?php echo $lt->no;?>" <?php if($lt->no==$row->in_acc) echo "selected";?>> <?php echo $lt->name;?></option>
<?php endforeach;  ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="exp">출금내역 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-4"  style="padding-right: 0;">
					<input type="text" name="exp" id="exp" class="form-control input-sm" value="<?php if($row->exp!=0) echo $row->exp; ?>" <?php if($row->class1==1) echo "disabled";?>>
				</div>
				<div class="col-xs-3"  style="padding-right: 0;">
					<label for="out" class="sr-only">출금처</label>
					<select name="out" id="out" class="form-control input-sm">
						<option value="" selected> 선 택
<?php foreach($bank_acc as $lt) : ?>
						<option value="<?php echo $lt->no;?>" <?php if($lt->no==$row->out_acc) echo "selected";?>> <?php echo $lt->name;?></option>
<?php endforeach;  ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="evi">증빙서류 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-6"  style="padding-right: 0;">
					<select name="evi" id="evi" class="form-control input-sm">
						<option value="1" <?if($row->evidence==1) echo "selected";?>> 증빙 없음
						<option value="2" <?if($row->evidence==2) echo "selected";?>> 세금계산서
						<option value="3" <?if($row->evidence==3) echo "selected";?>> 계산서
						<option value="4" <?if($row->evidence==4) echo "selected";?>> 신용(체크)카드전표
						<option value="5" <?if($row->evidence==5) echo "selected";?>> 현금영수증
						<option value="6" <?if($row->evidence==6) echo "selected";?>> 간이영수증
					</select>
				</div>
			</div>
			<div class="form-group" style="margin-bottom: 10px;">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="note">비 고 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-8"  style="padding-right: 0;">
					<textarea class="form-control input-sm" id="note" name="note"  rows="3"><?php echo $row->note;?></textarea>
				</div>
			</div>
			<footer style=" border-top: 1px solid #ddd;">
				<div class="col-xs-12" style="text-align: right; padding: 10px;">
					<input type="button" name="name" class="btn btn-primary btn-sm" value="수정하기" onclick="_editChk();">
					<input type="button" name="name" class="btn btn-danger btn-sm" value="닫기" onclick="opener.location.reload(); self.close();">
				</div>
			</footer>
		</div>
	</form>
</div>
