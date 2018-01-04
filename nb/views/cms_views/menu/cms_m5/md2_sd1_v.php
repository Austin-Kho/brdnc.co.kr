		<div class="main_start">&nbsp;</div>
		<!-- 5. 환경설정 -> 2. 회사정보관리 ->1. 회사정보 페이지 -->

		<div class="row" style="margin: 0; padding: 0;">
			<div class="point-sub col-xs-4 col-sm-4 col-md-2 bo-top bo-bottom" style="padding-top: 10px; margin-bottom: 20px; height: 40px;">회사 정보</div>
			<div class="col-xs-8 col-sm-8 col-md-10 bo-top bo-bottom" style="height: 40px;">
				<div class="" style="padding: 10px;"></div>
				<!-- <div class="col-xs-12 col-sm-6 col-md-3" style="padding-top: 6px;">
					<select class="form-control input-sm" id="user_sel" name="user_sel" onchange="location.href='<?php echo base_url(); ?>cms_m5/config/2/2/?un='+this.value">
						<option value="">선 택</option>
<?php foreach($user_list as $lt) : ?>
						<option value="<?php echo $lt->no; ?>" <?php if($this->input->get('un')==$lt->no ) echo "selected"; ?>><?php echo $lt->name."(".$lt->user_id.")"; ?></option>
<?php endforeach; ?>
					</select>
				</div> -->
			</div>
		</div>

		<div class="row" style="margin: 0; padding: 0;">
<?php
	$attributes = array('name' => 'form1', 'id' => 'com_reg_form', 'class' => 'form-horizontal');
	echo form_open(current_url(), $attributes);
?>
				<fieldset class="font12">

					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap" >
							<label for="co_name">회사명 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-8">
								<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('co_name');} else {echo $com->co_name;} ?>" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="co_no1">사업자번호 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<input type="text" class="form-control input-sm en_only" id="co_no1" name="co_no1" maxlength="3" value="<?php if($mode=='com_reg') {echo set_value('co_no1');} else {echo substr($com->co_no, 0, 3);} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-2" style="padding-right: 0;">
								<label for="co_no2" class="sr-only">사업자번호2 </label>
								<input type="text" class="form-control input-sm en_only" id="co_no2" name="co_no2" maxlength="2" value="<?php if($mode=='com_reg') {echo set_value('co_no2');} else {echo substr($com->co_no, 4, 2);} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_no3" class="sr-only">사업자번호3 </label>
								<input type="text" class="form-control input-sm wid-90 en_only" id="co_no3" name="co_no3" maxlength="5" value="<?php if($mode=='com_reg') {echo set_value('co_no3');} else {echo substr($com->co_no, 7, 11);} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-4">
								<label for="co_form" class="sr-only">사업자종류 </label>
								<select class="form-control input-sm wid-90" id="co_form" name="co_form" required>
									<option value="">선택</option>
									<option value="1" <?php if($mode=='com_reg'){echo set_select('co_form', '1');}else{if($com->co_form==1) echo 'selected';} ?>>법인</option>
									<option value="2" <?php if($mode=='com_reg'){echo set_select('co_form', '2');}else{if($com->co_form==2) echo 'selected';} ?>>개인(일반)</option>
									<option value="3" <?php if($mode=='com_reg'){echo set_select('co_form', '3');}else{if($com->co_form==3) echo 'selected';} ?>>개인(간이)</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="ceo">
								대표자 <span class="red">*</span>
							</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-8">
								<input type="text" class="form-control input-sm han" id="ceo" name="ceo" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('ceo');} else {echo $com->ceo;} ?>" required>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="or_no1">법인(주민)등록번호 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<input type="text" class="form-control input-sm en_only" id="or_no1" name="or_no1" maxlength="6" value="<?php if($mode=='com_reg') {echo set_value('or_no1');} else {echo substr($com->or_no, 0, 6);} ?>" onkeydown="onlyNum(this);" required>
							</div>
					      	<div class="col-xs-4" style="padding-right: 0;">
					      		<label for="or_no2" class="sr-only">법인(주민)등록번호2 </label>
					      		<input type="text" class="form-control input-sm en_only" id="or_no2" name="or_no2" maxlength="7" value="<?php if($mode=='com_reg') {echo set_value('or_no2');} else {echo substr($com->or_no, 7, 13);} ?>" onkeydown="onlyNum(this);" required>
					      	</div>
					      	<div class="col-xs-5">
					      		<label for="sur" class="sr-only">부가세신고주기</label>
								<select class="form-control input-sm wid-90" id="sur" name="sur" required>
									<option value="">선택</option>
									<option value="1" <?php if($mode=='com_reg'){echo set_select('sur', '1');}else{if($com->sur==1) echo 'selected';} ?>>부가세 분기 신고</option>
									<option value="2" <?php if($mode=='com_reg'){echo set_select('sur', '2');}else{if($com->sur==2) echo 'selected';} ?>>부가세 반기 신고</option>
									<option value="3" <?php if($mode=='com_reg'){echo set_select('sur', '3');}else{if($com->sur==3) echo 'selected';} ?>>부가세 월별 신고</option>
								</select>
							</div>
						</div>
					</div>


					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="biz_cond">업태 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-8">
								<input type="text" class="form-control input-sm han" id="biz_cond" name="biz_cond" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('biz_cond');} else {echo $com->biz_cond;} ?>" required>
							</div>
						</div>

						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="biz_even">종목 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-8">
								<input type="text" class="form-control input-sm han" id="biz_even" name="biz_even" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('biz_even');} else {echo $com->biz_even;} ?>" required>
							</div>
						</div>
					</div>
					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="co_phone1">대표전화 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<input type="text" class="form-control input-sm en_only" id="co_phone1" name="co_phone1" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_phone1');} else {$p = explode('-', $com->co_phone); echo $p[0];} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_phone2" class="sr-only">대표전화2</label>
								<input type="text" class="form-control input-sm en_only" id="co_phone2" name="co_phone2" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_phone2');} else {$p = explode('-', $com->co_phone); echo $p[1];} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_phone3" class="sr-only">대표전화3</label>
								<input type="text" class="form-control input-sm en_only" id="co_phone3" name="co_phone3" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_phone3');} else {$p = explode('-', $com->co_phone); echo $p[2];} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-3"></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="co_hp1">  휴대전화(비상) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<select class="form-control input-sm" id="co_hp1" name="co_hp1" required>
									<option value="">선택</option>
									<option value="010" <?php if($mode=='com_reg'){echo set_select('co_hp1', '010');}else{if(substr($com->co_hp, 0, 3)=='010') echo 'selected';} ?>>010</option>
									<option value="011" <?php if($mode=='com_reg'){echo set_select('co_hp1', '011');}else{if(substr($com->co_hp, 0, 3)=='011') echo 'selected';} ?>>011</option>
									<option value="016" <?php if($mode=='com_reg'){echo set_select('co_hp1', '016');}else{if(substr($com->co_hp, 0, 3)=='016') echo 'selected';} ?>>016</option>
									<option value="017" <?php if($mode=='com_reg'){echo set_select('co_hp1', '017');}else{if(substr($com->co_hp, 0, 3)=='017') echo 'selected';} ?>>017</option>
									<option value="018" <?php if($mode=='com_reg'){echo set_select('co_hp1', '018');}else{if(substr($com->co_hp, 0, 3)=='018') echo 'selected';} ?>>018</option>
									<option value="019" <?php if($mode=='com_reg'){echo set_select('co_hp1', '019');}else{if(substr($com->co_hp, 0, 3)=='019') echo 'selected';} ?>>019</option>
								</select>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_hp2" class="sr-only">휴대전화2</label>
								<input type="text" class="form-control input-sm en_only" id="co_hp2" name="co_hp2" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_hp2');} else {$p = explode('-', $com->co_hp); echo $p[1];} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_hp3" class="sr-only">휴대전화2</label>
								<input type="text" class="form-control input-sm en_only" id="co_hp3" name="co_hp3" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_hp3');} else {$p = explode('-', $com->co_hp); echo $p[2];} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-3"></div>
						</div>
					</div>
					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap"><label for="co_fax1">FAX</label></div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<input type="text" class="form-control input-sm en_only" id="co_fax1" name="co_fax1" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_fax1');} else {$p = explode('-', $com->co_fax); echo $p[0];} ?>" onkeydown="onlyNum(this);">
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_fax2" class="sr-only">FAX2</label>
								<input type="text" class="form-control input-sm en_only" id="co_fax2" name="co_fax2" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_fax2');} else {$p = explode('-', $com->co_fax); echo $p[1];} ?>" onkeydown="onlyNum(this);">
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_fax3" class="sr-only">FAX3</label>
								<input type="text" class="form-control input-sm en_only" id="co_fax3" name="co_fax3" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('co_fax3');} else {$p = explode('-', $com->co_fax); echo $p[2];} ?>" onkeydown="onlyNum(this);">
							</div>
							<div class="col-xs-3"></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap"><label for="co_div1">기업구분</label></div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-4" style="padding-right: 0;">
								<select class="form-control input-sm" id="co_div1" name="co_div1">
									<option value="">선택</option>
									<option value="1" <?php if($mode=='com_reg'){echo set_select('co_div1', '1');}else{if($com->co_div1==1) echo 'selected';} ?>>중소기업</option>
									<option value="2" <?php if($mode=='com_reg'){echo set_select('co_div1', '2');}else{if($com->co_div1==2) echo 'selected';} ?>>비중소기업</option>
								</select>
							</div>
							<div class="col-xs-4" style="padding-right: 0;">
								<label for="co_div2" class="sr-only">기업구분2</label>
								<select class="form-control input-sm" id="co_div2" name="co_div2">
									<option value="">선택</option>
									<option value="1" <?php if($mode=='com_reg'){echo set_select('co_div2', '1');}else{if($com->co_div2==1) echo 'selected';} ?>>중소기업</option>
									<option value="2" <?php if($mode=='com_reg'){echo set_select('co_div2', '2');}else{if($com->co_div2==2) echo 'selected';} ?>>일반</option>
									<option value="3" <?php if($mode=='com_reg'){echo set_select('co_div2', '3');}else{if($com->co_div2==3) echo 'selected';} ?>>상장</option>
									<option value="4" <?php if($mode=='com_reg'){echo set_select('co_div2', '4');}else{if($com->co_div2==4) echo 'selected';} ?>>비상장기업</option>
									<option value="5" <?php if($mode=='com_reg'){echo set_select('co_div2', '5');}else{if($com->co_div2==5) echo 'selected';} ?>>공공</option>
									<option value="6" <?php if($mode=='com_reg'){echo set_select('co_div2', '6');}else{if($com->co_div2==6) echo 'selected';} ?>>비영리</option>
								</select>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="co_div3" class="sr-only">기업구분3</label>
								<select class="form-control input-sm" id="co_div3" name="co_div3">
									<option value="">선택</option>
									<option value="1" <?php if($mode=='com_reg'){echo set_select('co_div3', '1');}else{if($com->co_div3==1) echo 'selected';} ?>>내국</option>
									<option value="2" <?php if($mode=='com_reg'){echo set_select('co_div3', '2');}else{if($com->co_div3==2) echo 'selected';} ?>>외국</option>
									<option value="3" <?php if($mode=='com_reg'){echo set_select('co_div3', '3');}else{if($com->co_div3==3) echo 'selected';} ?>>외투</option>
								</select>
							</div>
							<div class="col-xs-1"></div>
						</div>
					</div>
					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="es_date">설립일자 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-6">
								<input type="text" class="form-control input-sm wid-100" id="es_date" name="es_date" maxlength="10" value="<?php if($mode=='com_reg') {echo set_value('es_date');} else {echo $com->es_date;} ?>" readonly onClick="cal_add(this); event.cancelBubble=true" maxlength="10"  required>
							</div>
							<div class="col-xs-6 glyphicon-wrap">
								<a href="javascript:" onclick="cal_add(document.getElementById('es_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="op_date">개업일자 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-6">
								<input type="text" class="form-control input-sm wid-100" id="op_date" name="op_date" maxlength="10" value="<?php if($mode=='com_reg') {echo set_value('op_date');} else {echo $com->op_date;} ?>" readonly onClick="cal_add(this); event.cancelBubble=true" maxlength="10" required>
							</div>
							<div class="col-xs-6 glyphicon-wrap">
								<a href="javascript:" onclick="cal_add(document.getElementById('op_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
							</div>
						</div>
					</div>
					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="carr_y">기초잔액 입력월 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<input type="text" class="form-control input-sm en_only" id="carr_y" name="carr_y" maxlength="4" value="<?php if($mode=='com_reg') {echo set_value('carr_y');} else {$a = explode('-', $com->carr); echo $a[0];} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-1 text-wrap">년</div>
							<div class="col-xs-2" style="padding-right: 0;">
								<label for="carr_m" class="sr-only">기초잔액 입력월2</label>
								<input type="text" class="form-control input-sm en_only" id="carr_m" name="carr_m" maxlength="2" value="<?php if($mode=='com_reg') {echo set_value('carr_m');} else {$a = explode('-', $com->carr); echo $a[1];} ?>" onkeydown="onlyNum(this);" required>
							</div>
							<div class="col-xs-6 text-wrap">월</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="m_wo_st">업무개시월 <span class="red">*</span>/ 결산주기 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<select class="form-control input-sm" id="m_wo_st" name="m_wo_st" required>
									<option value="">선택</option>
									<option value="01" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '01');}else{if($com->m_wo_st=='01') echo 'selected';} ?>>01</option>
									<option value="02" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '02');}else{if($com->m_wo_st=='02') echo 'selected';} ?>>02</option>
									<option value="03" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '03');}else{if($com->m_wo_st=='03') echo 'selected';} ?>>03</option>
									<option value="04" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '04');}else{if($com->m_wo_st=='04') echo 'selected';} ?>>04</option>
									<option value="05" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '05');}else{if($com->m_wo_st=='05') echo 'selected';} ?>>05</option>
									<option value="06" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '06');}else{if($com->m_wo_st=='06') echo 'selected';} ?>>06</option>
									<option value="07" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '07');}else{if($com->m_wo_st=='07') echo 'selected';} ?>>07</option>
									<option value="08" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '08');}else{if($com->m_wo_st=='08') echo 'selected';} ?>>08</option>
									<option value="09" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '09');}else{if($com->m_wo_st=='09') echo 'selected';} ?>>09</option>
									<option value="10" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '10');}else{if($com->m_wo_st=='10') echo 'selected';} ?>>10</option>
									<option value="11" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '11');}else{if($com->m_wo_st=='11') echo 'selected';} ?>>11</option>
									<option value="12" <?php if($mode=='com_reg'){echo set_select('m_wo_st', '12');}else{if($com->m_wo_st=='12') echo 'selected';} ?>>12</option>
								</select>
							</div>
							<div class="col-xs-1 text-wrap">월/</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="bl_cycle" class="sr-only">결산주기</label>
								<select class="form-control input-sm" id="bl_cycle" name="bl_cycle" required>
									<option value="">선택</option>
									<option value="01" <?php if($mode=='com_reg'){echo set_select('bl_cycle', '01');}else{if($com->bl_cycle=='01') echo 'selected';} ?>>01</option>
									<option value="02" <?php if($mode=='com_reg'){echo set_select('bl_cycle', '02');}else{if($com->bl_cycle=='02') echo 'selected';} ?>>02</option>
									<option value="03" <?php if($mode=='com_reg'){echo set_select('bl_cycle', '03');}else{if($com->bl_cycle=='03') echo 'selected';} ?>>03</option>
									<option value="04" <?php if($mode=='com_reg'){echo set_select('bl_cycle', '04');}else{if($com->bl_cycle=='04') echo 'selected';} ?>>04</option>
									<option value="06" <?php if($mode=='com_reg'){echo set_select('bl_cycle', '06');}else{if($com->bl_cycle=='06') echo 'selected';} ?>>06</option>
									<option value="12" <?php if($mode=='com_reg'){echo set_select('bl_cycle', '12');}else{if($com->bl_cycle=='12') echo 'selected';} ?>>12</option>
								</select>
							</div>
							<div class="col-xs-5 text-wrap">개월</div>
						</div>
					</div>
					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="email1">E-mail(비상) <span class="red">*</span>	</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<input type="text" class="form-control input-sm en_only" id="email1" name="email1" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('email1');} else {$a = explode('@', $com->email); echo $a[0];} ?>" required>
							</div>
							<div class="col-xs-1 text-wrap">@</div>
							<div class="col-xs-4" style="padding-right: 0;">
									<label for="email2" class="sr-only">이메일2</label>
									<input type="text" class="form-control input-sm en_only" id="email2" name="email2" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('email2');} else {$a = explode('@', $com->email); echo $a[1];} ?>" required>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="email3" class="sr-only">이메일3</label>
								<select class="form-control input-sm" id="email3" name="email3" onchange="email2.value=this.value;">
									<option value="">직접입력</option>
									<option value="naver.com">네이버</option>
									<option value="hanmail.net">한메일</option>
									<option value="daum.net">다음</option>
									<option value="gmail.com">지메일</option>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="calc_mail1">전자세금계산서 Email</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap">
							<div class="col-xs-3" style="padding-right: 0;">
								<input type="text" class="form-control input-sm en_only" id="calc_mail1" name="calc_mail1" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('calc_mail1');} else {$a = explode('@', $com->calc_mail); echo $a[0];} ?>" required>
							</div>
							<div class="col-xs-1 text-wrap">@</div>
							<div class="col-xs-4" style="padding-right: 0;">
									<label for="calc_mail2" class="sr-only">세금계산서이메일2</label>
									<input type="text" class="form-control input-sm en_only" id="calc_mail2" name="calc_mail2" maxlength="30" value="<?php if($mode=='com_reg') {echo set_value('calc_mail2');} else {$a = explode('@', $com->calc_mail); echo $a[1];} ?>" required>
							</div>
							<div class="col-xs-3" style="padding-right: 0;">
								<label for="calc_mail3" class="sr-only">세금계산서이메일3</label>
								<select class="form-control input-sm" id="calc_mail3" name="calc_mail3" onchange="calc_mail2.value=this.value;">
									<option value="">직접입력</option>
									<option value="naver.com">네이버</option>
									<option value="hanmail.net">한메일</option>
									<option value="daum.net">다음</option>
									<option value="gmail.com">지메일</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="tax_off1_code">세무서 [1] <span class="red">*</span></label>
						</div>
						<div class="form-inline col-xs-12 col-sm-8 col-md-4 form-wrap" style="padding-left: 15px;">

							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="col-xs-2" style="padding: 0;">
										<div class="col-xs-11 input-group">
											<input type="text" class="form-control input-sm" id="tax_off1_code" name="tax_off1_code" value="<?php if($mode=='com_reg') {echo set_value('tax_off1_code');} else {echo $com->tax_off1_code; } ?>" readonly required>
											<span class="input-group-btn">
											      <button class="btn btn-default btn-sm" type="button" onclick="javascript:open_Win('<?php echo base_url('cms_popup/tax_off/lists/1/'); ?>', 'tax_search', 500, 616)"> &nbsp;
													<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
											      </button>
											</span>
										</div>
									</td>
									<td class="col-xs-3" style="padding: 0;">
										<div class="col-xs-10" style="padding-left: 0;">
											<label for="tax_off1_name" class="sr-only">세무서1 이름</label>
											<input type="text" class="form-control input-sm" id="tax_off1_name" name="tax_off1_name" value="<?php if($mode=='com_reg') {echo set_value('tax_off1_name');} else {echo $com->tax_off1_name; } ?>" readonly required>
										</div>
									</td>
								</tr>
							</table>
							<!-- <div class="col-xs-5"></div> -->
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="tax_off2_code">세무서 [2]</label>
						</div>
						<div class="form-inline col-xs-12 col-sm-8 col-md-4 form-wrap" style="padding-left: 15px;">
							<table cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td class="col-xs-2" style="padding: 0;">
										<div class="col-xs-11  input-group">
											<input type="text" class="form-control input-sm" id=tax_off2_code"" name="tax_off2_code" value="<?php if($mode=='com_reg') {echo set_value('tax_off2_code');} else if($com->tax_off2_code>0) {echo $com->tax_off2_code; } ?>" readonly>
											<span class="input-group-btn">
										      	<button class="btn btn-default btn-sm" type="button" onclick="javascript:open_Win('<?php echo base_url('/cms_popup/tax_off/lists/2/'); ?>', 'tax_search', 500, 616)"> &nbsp;
										      		<span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
										      	</button>
										      </span>
										</div>
									</td>
									<td class="col-xs-3" style="padding: 0;">
										<div class="col-xs-10" style="padding-left: 0;">
											<label for="tax_off2_name" class="sr-only">세무서2 이름</label>
											<input type="text" class="form-control input-sm" id="tax_off2_name" name="tax_off2_name" value="<?php if($mode=='com_reg') {echo set_value('tax_off2_name');} else {echo $com->tax_off2_name; } ?>" readonly>
										</div>
									</td>
								</tr>
							</table>
							<!-- <div class="col-xs-5  input-group"></div> -->
						</div>
					</div>

					<!-- 다음 우편번호 서비스 - iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
					<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:2;-webkit-overflow-scrolling:touch;">
						<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
					</div>
					<!-- 다음 우편번호 서비스 -------------onclick="execDaumPostcode(1)"-----postcode1-----address1_1-----address2_1------------------------>

					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="address">회사주소 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap">
							<div class="col-xs-3 col-sm-5 col-md-1" style="padding-right: 0;">
								<input type="text" class="form-control input-sm" id="postcode1" name="postcode1" maxlength="5" value="<?php if($mode=='com_reg') {echo set_value('zipcode');} else {echo $com->zipcode; } ?>" readonly required>
							</div>
							<div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
								<input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="execDaumPostcode(1)">
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
								<label for="address1_1" class="sr-only">회사주소1</label>
								<input type="text" class="form-control input-sm" id="address1_1" name="address1_1" maxlength="100" value="<?php if($mode=='com_reg') {echo set_value('address1');} else {echo $com->address1; } ?>" readonly required>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3" style="padding-right: 0;">
								<label for="address2_1" class="sr-only">회사주소2</label>
								<input type="text" class="form-control input-sm" id="address2_1" name="address2_1" maxlength="100" value="<?php if($mode=='com_reg') {echo set_value('address2');} else {echo $com->address2; } ?>" name="address2">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-3 glyphicon-wrap" style="padding: 12px 12px 5px 15px;">나머지 주소</div>
						</div>
					</div>
					<div class="form-group bo-top" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="en_co_name">회사 영문명</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap">
							<div class="col-md-6 col-xs-12" style="padding-right: 0;"><input type="text" class="form-control input-sm en_only" id="en_co_name" name="en_co_name" maxlength="50" value="<?php if($mode=='com_reg') {echo set_value('en_co_name');} else {echo $com->en_co_name; } ?>"></div>
							<div class="col-md-6 col-xs-12 text-wrap" style="padding: 12px 12px 5px 15px;">기타소득 지급조서 신고가 있는 경우 입력</div>
						</div>
					</div>
					<div class="form-group pb20" style="margin: 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap">
							<label for="addressEnglish">회사 영문주소</label>
							<div class="col-xs-12">&nbsp;</div>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap">
							<div class="col-md-10 col-xs-12"><input type="text" class="form-control input-sm wid-100 en_only" id="addressEnglish" name="addressEnglish" maxlength="200"  value="<?php if($mode=='com_reg') {echo set_value('en_address');} else {echo $com->en_address; } ?>"></div>
							<div class="col-md-2">&nbsp;</div>
							<div class="col-xs-12">상세주소, 번지(number), 거리(street), 시군구(city), 광역시도(state), 국가(country) 순으로 기재</div>
							<div><?php echo validation_errors(); ?></div>
						</div>
					</div>
<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="com_submit('$mode');";} ?>
					<div class="form-group btn-wrap" style="margin: 0;">
						<input type="button" class="btn btn-primary btn-sm" onclick="<?=$submit_str?>" value="<?php if($mode=='com_reg') echo '등록'; else echo '수정' ?>하기">
					</div>

				</fieldset>
			</form>
		</div>
