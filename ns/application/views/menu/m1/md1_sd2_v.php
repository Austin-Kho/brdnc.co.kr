		<div class="main_start">&nbsp;</div>
		<!-- 1. 분양관리 -> 1. 계약 관리 ->2. 계약 등록 -->

		<!-- ===================계약물건 검색 시작================== -->
		<form method="get" name="set1" action="/ns/m1/sales/1/2">
			<div class="row bo-top bo-bottom font12" style="margin: 0;">
				<div class="row bo-bottom font12" style="margin: 0;">
					<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">처리 구분 <span class="red">*</span></div>
					<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
						<div class="col-xs-4 col-sm-3 col-md-6 radio" style="margin: 0; padding: 5px; padding-right: 0;">
							<label>
								<input type="radio" name="mode" value="1" <?php if(( !$this->input->get('mode') OR $this->input->get('mode')=='1') && $this->input->get('cont_sort1')!='2' && empty($is_reg)) echo "checked"; ?> onclick="location.href='<?php echo base_url('m1/sales/1/2?mode=1') ?>'">신규
							</label>
						</div>
						<div class="col-xs-4 col-sm-3 col-md-6 radio" style="margin: 0; padding-top: 5px; padding-right: 0;">
							<label><input type="radio" name="mode" value="2" <?php if($this->input->get('mode')=="2" OR $this->input->get('cont_sort1')=='2' OR (!empty($is_reg))) echo "checked"; ?> onclick="submit();">변경</label>
						</div>
					</div>
					<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
					<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
						<div class="col-xs-12" style="padding: 0px;">
							<label for="yr" class="sr-only">사업 개시년도</label>
							<select class="form-control input-sm" name="yr" onchange="submit();" disabled>
								<option value=""> 선 택</option>
	<?php
		$start_year = "2015";
		$year=range($start_year,date('Y'));
		for($i=(count($year)-1); $i>=0; $i--) :
	?>
								<option value="<?php echo $year[$i]?>" <?php if($this->input->get('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?></option>
	<?php endfor; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="project" class="sr-only">프로젝트 선택</label>
						<select class="form-control input-sm" name="project" onchange="submit();">
							<option value="0" <?php if( !$this->input->get('project')) echo "selected"; ?>> 선 택</option>
<?php foreach($all_pj as $lt) : ?>
							<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->get('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">등록 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-6" style="padding: 4px 15px;">
					<div class="col-xs-4 col-sm-3 col-md-2 radio" style="margin: 5px 0; padding-right: 0;">
						<label><input type="radio" name="cont_sort1" id="cont_sort1" value="1" <?php if( !$this->input->get('cont_sort1') OR $this->input->get('cont_sort1')=='1') echo "checked";?>  onclick="submit();">계약</label>
					</div>
					<div class="col-xs-4 col-sm-3 col-md-2 radio" style="margin: 5px 0; padding-right: 0;">
						<label>
							<input type="radio" name="cont_sort1" id="cont_sort1" value="2" <?php if($this->input->get('cont_sort1')=='2') echo "checked";?> onclick="submit();" <?php if( !$this->input->get('mode') OR $this->input->get('mode')==1) echo "disabled"; ?> >해지
						</label>
					</div>
<?php if( !$this->input->get('cont_sort1') OR $this->input->get('cont_sort1')=='1') : ?>
					<div class="col-xs-4 col-sm-6 col-md-4" style="padding: 0px;">
						<label for="cont_sort2" class="sr-only">거래구분</label>
						<select class="form-control input-sm" name="cont_sort2" onchange="submit();">
							<option value="0"> 선 택</option>
							<option value="1" <?php if($this->input->get('cont_sort2')=="1") echo "selected"; ?>>청약(가계약)</option>
							<option value="2" <?php if($this->input->get('cont_sort2')=="2") echo "selected"; ?>>계약(정계약)</option>
						</select>
					</div>
<?php elseif($this->input->get('cont_sort1')=='2') : ?>
					<div class="col-xs-4 col-sm-6 col-md-4" style="padding: 0px;">
						<label for="cont_sort3" class="sr-only">거래구분</label>
						<select class="form-control input-sm" name="cont_sort3" onchange="submit();">
							<option value="0"> 선 택</option>
							<option value="3" <?php if($this->input->get('cont_sort3')=="3") echo "selected"; ?>>청약해지</option>
							<option value="4" <?php if($this->input->get('cont_sort3')=="4") echo "selected"; ?>>계약해지</option>
						</select>
					</div>
<?php endif; ?>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0 0 15px;">

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">타입 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<select class="form-control input-sm" name="type" onchange="submit();">
							<option value=""> 선 택</option>
<?php foreach($type as $lt) : ?>
							<option value="<?php echo $lt->type; ?>" <?php if($lt->type==$this->input->get('type')) echo "selected"; ?>><?php echo $lt->type; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">동 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dong" class="sr-only">동</label>
						<select class="form-control input-sm" name="dong" onchange="submit();">
							<option value=""> 선 택</option>
<?php foreach($dong as $lt) : ?>
							<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->get('dong')) echo "selected"; ?>><?php echo $lt->dong; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">호수 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="ho" class="sr-only">호수</label>
						<select class="form-control input-sm" name="ho" onchange="submit();" <?php if( !$this->input->get('dong')) echo "disabled"; ?>>
							<option value=""> 선 택</option>
<?php foreach($ho as $lt) : ?>
							<option value="<?php echo $lt->ho; ?>" <?php if($lt->ho==$this->input->get('ho')) echo "selected"; ?>><?php echo $lt->ho; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="row bo-top bo-bottom font12" style="margin: 0 0 15px;">
				<div class="col-xs-12 font14" style="padding: 10px 50px; background-color: #F5F2C5; color: #0b071f"><?php echo $dong_ho; ?>&nbsp;<?php echo validation_errors('<div class="error">', '</div>'); ?></div>
			</div>
		</form>
		<!-- ===================계약물건 검색 종료================== -->


<?php $disabled = (($this->input->get('cont_sort2') OR $this->input->get('cont_sort3')) && $this->input->get('ho')) ? "" : "disabled"; ?>

		<!-- ===================계약내용 기록 시작================== -->
		<form method="post" name="form1" action="<?php echo current_url(); ?>">
			<input type="hidden" name="mode" value="<?php if( !empty($is_reg)) echo '2'; else echo '1'; ?>">
			<input type="hidden" name="project" value="<?php echo $this->input->get('project'); ?>">
			<input type="hidden" name="diff_no" value="<?php echo $this->input->get('diff_no'); ?>">
			<input type="hidden" name="cont_sort1" value="<?php echo $this->input->get('cont_sort1'); ?>"><!-- 계약(1) 해지(2) 여부 -->
			<input type="hidden" name="cont_sort2" value="<?php echo $this->input->get('cont_sort2'); ?>"><!-- 청약(1) 계약(2) 여부 -->
			<input type="hidden" name="cont_sort3" value="<?php echo $this->input->get('cont_sort3'); ?>"><!-- 청약해지(1) 계약해지(2) 여부 -->
<?php $unit_seq = (!empty($is_reg)) ? $is_reg->seq : ''; ?>
			<input type="hidden" name="unit_seq" value="<?php echo $unit_seq; ?>">
			<input type="hidden" name="type" value="<?php echo $this->input->get('type'); ?>">
			<input type="hidden" name="dong" value="<?php echo $this->input->get('dong'); ?>">
			<input type="hidden" name="ho" value="<?php echo $this->input->get('ho'); ?>">

<?php if($this->input->get('cont_sort2')=="1" && !empty($app_data1)) : // 청약 등록 시 ?>
			<div class="row bo-top font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">처리 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px; color: #4a6bbe">
					<div class="col-xs-6 col-sm-4 col-md-2 checkbox" style="margin: 0; padding: 4px 20px;"><label><input type="checkbox" name="incom_doc_1" value="1">계약전환</label></div>
				</div>
			</div>
<?php endif; ?>
<?php if($this->input->get('cont_sort3')=="3") : // 청약 해지 시 ?>
			<div class="row bo-top font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">처리 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px; color: #4a6bbe">
					<div class="col-xs-6 col-sm-4 col-md-2 checkbox" style="margin: 0; padding: 4px 20px;"><label><input type="checkbox" name="incom_doc_1" value="1">해지신청</label></div>
					<div class="col-xs-6 col-sm-4 col-md-3 checkbox" style="margin: 0; padding: 4px 20px;"><label><input type="checkbox" name="incom_doc_1" value="1">환불완료</label></div>
				</div>
			</div>
<?php endif; ?>
<?php if($this->input->get('cont_sort2')=="2") : // 계약 등록 시 ?>
			<div class="row bo-top font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="height: 60px; padding: 10px; 0">청약 내역 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px; color: #4a6bbe">
<?php if( !empty($app_data)) :  ?>
					<div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 0px;">일자 : <?php echo $app_data->app_date; ?></div>
					<div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 0px;">입금 : <?php echo $app_data->app_money; ?></div>
					<div class="col-xs-6 col-sm-4 col-md-3" style="padding: 4px 0px;">계좌 : <?php echo $app_data->app_acc; ?></div>
<?php else : ?>
					<div class="col-xs-12" style="padding: 4px 0px;">등록된 청약 데이터 없습니다. 신규 계약 정보를 입력하세요.</div>
<?php endif; ?>
				</div>
			</div>
<?php endif; ?>
<?php if($this->input->get('cont_sort3')=="4") : // 계약 해지 시 ?>
			<div class="row bo-top font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">처리 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px; color: #4a6bbe">
					<div class="col-xs-6 col-sm-4 col-md-2 checkbox" style="margin: 0; padding: 4px 20px;"><label><input type="checkbox" name="incom_doc_1" value="1">해지신청</label></div>
					<div class="col-xs-6 col-sm-4 col-md-3 checkbox" style="margin: 0; padding: 4px 20px;"><label><input type="checkbox" name="incom_doc_1" value="1">환불완료</label></div>
				</div>
			</div>
<?php endif; ?>
			<div class="row bo-top bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">차수 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="diff_no" class="sr-only">차수</label>
						<select class="form-control input-sm" name="diff_no" <?php echo $disabled; ?>>
							<option value=""> 선 택</option>
<?php foreach($diff_no as $lt) : ?>
							<option value="<?php echo $lt->diff_no; ?>" <?php if($app_data->app_diff==$lt->diff_no) echo "selected"; ?>><?php echo $lt->diff_name; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약 고객명 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
<?php
	if(empty($app_data) && empty($cont_data2)) : $custom_name = set_value('custom_name');
	elseif( !empty($app_data)) : $custom_name = $app_data->applicant;
	else : $custom_name = $cont_data2->contractor_name;
	endif;
?>
						<label for="custom_name" class="sr-only">계약자명</label>
						<input type="text" class="form-control input-sm" name="custom_name" value="<?php echo $custom_name; ?>" <?php echo $disabled; ?>>
					</div>
				</div>
			</div>

<?php
	if(empty($app_data) && empty($cont_data2)) : $tel_1 = set_value('tel_1'); $tel_2 = set_value('tel_2');
	elseif( !empty($app_data)) : $tel_1 = $app_data->app_tel1; $tel_2 = $app_data->app_tel2;
	else : $tel_1 = $cont_data2->cont_tel1; $tel_2 = $cont_data2->cont_tel2;
	endif;
?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">연락처 [1] <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="tel_1" class="sr-only">연락처1</label>
						<input type="text" class="form-control input-sm" name="tel_1" value="<?php echo $tel_1; ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">연락처 [2]</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="tel_2" class="sr-only">연락처2</label>
						<input type="text" class="form-control input-sm" name="tel_2" value="<?php echo $tel_2; ?>" <?php echo $disabled; ?>>
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">청약금 <span class="red">*</span></div>
				<div class="col-xs-5 col-sm-5 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="app_money" class="sr-only">청약금</label>
						<input type="text" class="form-control input-sm" name="app_money" value="<?php if( !empty($app_data) && $app_data->app_money!=0) echo $app_data->app_money; else echo set_value('app_money'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">입금 계정 <span class="red">*</span></div>
				<div class="col-xs-3 col-sm-4 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="app_acc" class="sr-only">입금계정</label>
						<select class="form-control input-sm" name="app_acc" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if($lt->seq==$app_data->app_acc) echo "selected"; ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

<?php //if( !$this->input->get('cont_sort2') OR $this->input->get('cont_sort2')=="1") : // 청약 등록 시

	if($this->input->get('cont_sort2')==1) : $conclu_date_label = "청약일자";
	elseif($this->input->get('cont_sort2')==2) : $conclu_date_label = "계약일자";
	elseif($this->input->get('cont_sort3')==3) : $conclu_date_label = "청약해지일자";
	elseif($this->input->get('cont_sort3')==4) : $conclu_date_label = "계약해지일자";
	else : $conclu_date_label = "청약일자";
	endif;

	if(empty($app_data) && empty($cont_data2)) : $conclu_date = set_value('conclu_date');
	elseif( !empty($app_data)) : $conclu_date = $app_data->app_date;
	else : $conclu_date = $cont_data2->initial_cont_date;
	endif;
?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0"><?php echo $conclu_date_label; ?> <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="conclu_date" class="sr-only">체결일자</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="conclu_date" id="conclu_date" class="form-control input-sm" value="<?php echo $conclu_date; ?>" onclick="cal_add(this); event.cancelBubble=true"  readonly>
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('conclu_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
<?php
	if(empty($app_data)) : $due_date = set_value('due_date');
	else : $due_date = $app_data->due_date;
	endif;
?>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub <?php if(!((( !$this->input->get('cont_sort2') && !$this->input->get('cont_sort3')) OR ($this->input->get('cont_sort2')!=2 && $this->input->get('cont_sort3')!=4)))) echo 'hidden-xs hidden-sm'; ?>" style="padding: 10px; 0">
					<?php if(( !$this->input->get('cont_sort2') && !$this->input->get('cont_sort3')) OR ($this->input->get('cont_sort2')!=2 && $this->input->get('cont_sort3')!=4)) {?>계약 예정일<?php } ?>&nbsp;
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2 <?php if(!((( !$this->input->get('cont_sort2') && !$this->input->get('cont_sort3')) OR ($this->input->get('cont_sort2')!=2 && $this->input->get('cont_sort3')!=4)))) echo 'hidden-xs hidden-sm'; ?>" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
<?php if(( !$this->input->get('cont_sort2') && !$this->input->get('cont_sort3')) OR ($this->input->get('cont_sort2')!=2 && $this->input->get('cont_sort3')!=4)) :?>
						<label for="due_date" class="sr-only">계약 예정일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="due_date" id="due_date" class="form-control input-sm" value="<?php echo $due_date; ?>" onclick="cal_add(this); event.cancelBubble=true"  readonly>
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('due_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
<?php endif; ?>
					</div>
				</div>
			</div>



<?php if($this->input->get('cont_sort2')=="2" OR $this->input->get('cont_sort3')==4) : // 계약 등록 시 ?>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [1] <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_1" class="sr-only">계약금[1]</label>
						<input type="text" class="form-control input-sm" name="deposit_1" value="" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">입금 계정 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_1" class="sr-only">계약금입금계정1</label>
						<select class="form-control input-sm" name="dep_acc_1" <?php echo $disabled; ?>>
							<option value=""> 선 택</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>"><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [2] &nbsp;</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_2" class="sr-only">계약금[2]</label>
						<input type="text" class="form-control input-sm" name="deposit_2" value="" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">입금 계정 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_2" class="sr-only">계약금입금계정2</label>
						<select class="form-control input-sm" name="dep_acc_2" <?php echo $disabled; ?>>
							<option value=""> 선 택</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>"><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">주민등록 주소 <span class="red">*</span>
					<div class="visible-xs" style="height: 39px;">&nbsp;</div>
					<div class="hidden-md hidden-lg" style="height: 39px;">&nbsp;</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 0px;">
					<div class="col-xs-12" style="padding: 0px;">
						<div class="col-xs-4 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="button" class="btn btn-info btn-sm" value="우편번호" style="margin: 4px 0;" onclick="javascript:ZipWindow('<?php echo base_url('/popup/zip_/zipcode/1'); ?>')">
						</div>
						<div class="col-xs-4 col-sm-3 col-md-1" style="padding-right: 0;">
							<label for="zipcode" class="sr-only">우편번호</label>
							<input type="text" class="form-control input-sm en_only" id="zipcode" name="zipcode" style="margin: 4px 0;" maxlength="5" value="<?php if($this->input->post('zipcode')) echo set_value('zipcode'); //else echo $addr[0]; ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4" style="padding-right: 0;">
							<label for="address1" class="sr-only">계약자주소1</label>
							<input type="text" class="form-control input-sm han" id="address1" name="address1" style="margin: 4px 0;" maxlength="100" value="<?php if($this->input->post('address1')) echo set_value('address1'); //else echo $addr[1]; ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-4" style="padding-right: 0;">
							<label for="address2" class="sr-only">계약자주소2</label>
							<input type="text" class="form-control input-sm han" id="address2" name="address2" style="margin: 4px 0;" maxlength="93" value="<?php if($this->input->post('address2')) echo set_value('address2'); //else echo $addr[2]; ?>" placeholder="나머지 주소" <?php echo $disabled; ?>>
						</div>
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">우편송부 주소  <span class="red">*</span>
					<div class="visible-xs" style="height: 39px;">&nbsp;</div>
					<div class="hidden-md hidden-lg" style="height: 78px;">&nbsp;</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 0;">
					<div class="col-xs-12" style="padding: 0px;">
						<div class="col-xs-4 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="button" class="btn btn-info btn-sm" value="우편번호" style="margin: 4px 0;" onclick="javascript:ZipWindow('<?php echo base_url('/popup/zip_/zipcode/2'); ?>')">
						</div>
						<div class="col-xs-4 col-sm-3 col-md-1" style="padding-right: 0;">
							<label for="zipcode_" class="sr-only">우편번호</label>
							<input type="text" class="form-control input-sm en_only" id="zipcode2" name="zipcode_"  style="margin: 4px 0;" maxlength="5" value="<?php if($this->input->post('zipcode_')) echo set_value('zipcode_'); //else echo $addr[0]; ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4" style="padding-right: 0;">
							<label for="address1_" class="sr-only">계약자주소11</label>
							<input type="text" class="form-control input-sm han" id="address1_" name="address1_"  style="margin: 4px 0;" maxlength="100" value="<?php if($this->input->post('address1_')) echo set_value('address1_'); //else echo $addr[1]; ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-4" style="padding-right: 0;">
							<label for="address2_" class="sr-only">계약자주소22</label>
							<input type="text" class="form-control input-sm han" id="address2_" name="address2_"  style="margin: 4px 0;" maxlength="93" value="<?php if($this->input->post('address2_')) echo set_value('address2_'); //else echo $addr[2]; ?>" placeholder="나머지 주소" <?php echo $disabled; ?>>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-2 checkbox" style="margin: 0; padding: 9px;">
							<label><input type="checkbox" name="sa_addr" onclick="same_addr();"> 위와 같음</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">미비서류 항목
					<div class="visible-xs" style="height: 60px;">&nbsp;</div>
					<div class="" style="height: 30px;">&nbsp;</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px;">
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_1" value="1" <?php echo $disabled; ?>>계약서[각서9종]</label></div>
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_2" value="1" <?php echo $disabled; ?>> 주민등본</label></div>
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_3" value="1" <?php echo $disabled; ?>> 주민초본</label></div>
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_4" value="1" <?php echo $disabled; ?>> 가족관계증명</label></div>
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_5" value="1" <?php echo $disabled; ?>> 인감증명</label></div>
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_6" value="1" <?php echo $disabled; ?>> 사용인감</label></div>
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_7" value="1" <?php echo $disabled; ?>> 신분증</label></div>
					<div class="col-xs-6 col-sm-3 col-md-2 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_8" value="1" <?php echo $disabled; ?>> 배우자등본</label></div>
				</div>
			</div>
<?php endif; ?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0; height: 75px;">비 고</div>
				<div class="col-xs-8 col-sm-9 col-md-6" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="note" class="sr-only">타입</label>
						<textarea class="form-control input-sm" id="note" name="note"  rows="3" <?php echo $disabled; ?>></textarea>
					</div>
				</div>
			</div>
		</form>

<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="cont_check();";} ?>
		<div class="form-group btn-wrap" style="margin: <?php echo $mg = ((( !$this->input->get('cont_sort2') && !$this->input->get('cont_sort3')) OR ($this->input->get('cont_sort2')!=2 && $this->input->get('cont_sort3')!=4)))? '130px' :' 30px'; ?> 0 0 0;">
			<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str?>" value="등록 하기">
		</div>
