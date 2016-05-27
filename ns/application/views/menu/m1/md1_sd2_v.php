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
							<label>
								<input type="radio" name="mode" value="2" <?php if($this->input->get('mode')=="2" OR $this->input->get('cont_sort1')=='2' OR (!empty($is_reg))) echo "checked"; ?> onclick="submit();">변경
							</label>
						</div>
					</div>
					<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">등록 구분 <span class="red">*</span></div>
					<div class="col-xs-8 col-sm-9 col-md-6" style="padding: 4px 15px;">
						<div class="col-xs-4 col-sm-3 col-md-2 radio" style="margin: 0; padding: 5px; padding-right: 0;">
							<label>
								<input type="radio" name="cont_sort1" id="cont_sort1" value="1" <?php if( !$this->input->get('cont_sort1') OR $this->input->get('cont_sort1')=='1') echo "checked";?>  onclick="submit();">계약
							</label>
						</div>
						<div class="col-xs-4 col-sm-3 col-md-2 radio" style="margin: 0; padding-top: 5px; padding-right: 0;">
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
				<div class="row bo-bottom font12" style="margin: 0;">
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
					<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">타입 선택 <span class="red">*</span></div>
					<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
						<div class="col-xs-12" style="padding: 0px;">
							<label for="type" class="sr-only">타입</label>
							<select class="form-control input-sm" name="type" onchange="submit();">
								<option value=""> 선 택</option>
<?php foreach($type_list as $lt) : ?>
								<option value="<?php echo $lt->type; ?>" <?php if($lt->type==$this->input->get('type')) echo "selected"; ?>><?php echo $lt->type; ?></option>
<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row bo-bottom font12" style="margin: 0 0 15px;">
					<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">동 선택 <span class="red">*</span></div>
					<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
						<div class="col-xs-12" style="padding: 0px;">
							<label for="dong" class="sr-only">동</label>
							<select class="form-control input-sm" name="dong" onchange="submit();">
								<option value=""> 선 택</option>
	<?php foreach($dong_list as $lt) : ?>
								<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->get('dong')) echo "selected"; ?>><?php echo $lt->dong." 동"; ?></option>
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
	<?php foreach($ho_list as $lt) : ?>
								<option value="<?php echo $lt->ho; ?>" <?php if($lt->ho==$this->input->get('ho')) echo "selected"; ?>><?php echo $lt->ho." 호"; ?></option>
	<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="row bo-bottom font12" style="margin: 0 0 15px;">
				<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 50px; margin: 0;"><?php echo $dong_ho; ?>&nbsp;<?php echo validation_errors('<div class="error">', '</div>'); ?></p></div>
			</div>
		</form>
		<!-- ===================계약물건 검색 종료================== -->


<?php $disabled = (($this->input->get('cont_sort2') OR $this->input->get('cont_sort3')) && $this->input->get('ho')) ? "" : "disabled"; ?>

		<!-- ===================계약내용 기록 시작================== -->
		<form method="post" name="form1" action="<?php echo current_url(); ?>">

			<input type="hidden" name="mode" value="<?php if( !empty($is_reg)) echo '2'; else echo '1'; ?>">
			<input type="hidden" name="project" value="<?php echo $this->input->get('project'); ?>">
			<input type="hidden" name="cont_sort1" value="<?php echo $this->input->get('cont_sort1'); ?>"><!-- 계약(1) 해지(2) 여부 -->
			<input type="hidden" name="cont_sort2" value="<?php echo $this->input->get('cont_sort2'); ?>"><!-- 청약(1) 계약(2) 여부 -->
			<input type="hidden" name="cont_sort3" value="<?php echo $this->input->get('cont_sort3'); ?>"><!-- 청약해지(1) 계약해지(2) 여부 -->
			<input type="hidden" name="type" value="<?php echo $this->input->get('type'); ?>">
			<input type="hidden" name="dong" value="<?php echo $this->input->get('dong'); ?>">
			<input type="hidden" name="ho" value="<?php echo $this->input->get('ho'); ?>">
<?php $unitseq = ( !empty($unit_seq)) ? $unit_seq->seq : ""; ?>
			<input type="hidden" name="unit_seq" value="<?php echo $unitseq; ?>">
<?php $unit_is_app = ( !empty($unit_seq)) ? $unit_seq->is_application : ""; ?>
			<input type="hidden" name="unit_is_app" value="<?php echo $unit_is_app; ?>">
<?php $unit_is_cont = ( !empty($unit_seq)) ? $unit_seq->is_contract : ""; ?>
			<input type="hidden" name="unit_is_cont" value="<?php echo $unit_is_cont; ?>">
<?php $unit_dong_ho = ( !empty($unit_dong_ho)) ? $unit_dong_ho : ""; ?>
			<input type="hidden" name="unit_dong_ho" value="<?php echo $unit_dong_ho; ?>">
<?php $ctator_seq = ( !empty($is_reg['cont_data'])) ? $is_reg['cont_data']->contractor_seq : ""; ?>
			<input type="hidden" name="contractor_seq" value="<?php echo $ctator_seq; ?>">
<?php $received_1 = ( !empty($received['1'])) ? $received['1']->seq : ""; // 계약금 폼1 입력 데이터 ?>
			<input type="hidden" name="received1" value="<?php echo $received_1; ?>">
<?php $received_2 = ( !empty($received['2'])) ? $received['2']->seq : ""; // 계약금 폼2 입력 데이터?>
			<input type="hidden" name="received2" value="<?php echo $received_2; ?>">
<?php $received_3 = ( !empty($received['3'])) ? $received['3']->seq : ""; // 계약금 폼3 입력 데이터?>
			<input type="hidden" name="received3" value="<?php echo $received_3; ?>">
<?php $received_4 = ( !empty($received['4'])) ? $received['4']->seq : ""; // 계약금 폼4 입력 데이터?>
			<input type="hidden" name="received4" value="<?php echo $received_4; ?>">
<?php $received_5 = ( !empty($received['5'])) ? $received['5']->seq : ""; // 계약금 폼5 입력 데이터?>
			<input type="hidden" name="received5" value="<?php echo $received_5; ?>">
<?php $received_6 = ( !empty($received['6'])) ? $received['6']->seq : ""; // 계약금 폼6 입력 데이터?>
			<input type="hidden" name="received6" value="<?php echo $received_6; ?>">
<?php $received_7 = ( !empty($received['7'])) ? $received['7']->seq : ""; // 계약금 폼7 입력 데이터?>
			<input type="hidden" name="received7" value="<?php echo $received_7; ?>">



<!--==================================동호 선택 후 계약 상황판 S======================================-->
<?php if($this->input->get('cont_sort2')=="1" && !empty($is_reg['app_data'])) : // 청약 등록 호수인 경우 ?>
			<div class="row bo-top font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">처리 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px; color: #4a6bbe">
					<div class="col-xs-6 col-sm-4 col-md-2 checkbox" style="margin: 0; padding: 4px 20px;"><label><input type="checkbox" onclick="app_tr_cont(this);">계약전환</label></div>
				</div>
			</div>
<?php endif; ?>
<?php if($this->input->get('cont_sort3')=="3") : // 청약 해지 처리 시 ?>
			<div class="row bo-top font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">처리 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px; color: #4a6bbe">
					<div class="col-xs-6 col-sm-4 col-md-2 checkbox" style="margin: 0; padding: 4px 0 4px 10px;"><label><input type="checkbox" name="is_cancel" value="1">해지신청</label></div>
					<div class="col-xs-6 col-sm-4 col-md-3 checkbox" style="margin: 0; padding: 4px 0 4px 10px;"><label><input type="checkbox" name="is_refund" value="1">환불완료</label></div>
				</div>
			</div>
<?php endif; ?>



<?php if($this->input->get('cont_sort2')=="2") : // 계약 등록 처리 시 ?>
			<div class="row bo-top font12" style="margin: 0;">
<?php if( !empty($is_reg['app_data'])) $dicol = "#f8f9cc;"; if( !empty($is_reg['cont_data'])) $dicol = "#E0E7FB;";   ?>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="height: 60px; padding: 10px; 0">현재 상태 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-10" style="padding: 4px 15px; color: #4a6bbe; background-color: <?php if( !empty($dicol)) echo $dicol; ?>">
<?php if( !empty($is_reg['app_data'])) : // 현재 청약상태 호수이면  ?>
					<div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 0px;">청약 : <?php echo $is_reg['app_data']->app_date; ?></div>
					<div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 0px;">입금 : <?php echo number_format($is_reg['app_data']->app_in_mon)." 원"; ?></div>
					<div class="col-xs-6 col-sm-4 col-md-3" style="padding: 4px 0px;">계좌 : <?php if( !empty($dep_acc[($is_reg['app_data']->app_in_acc-1)]->acc_nick)) echo $dep_acc[($is_reg['app_data']->app_in_acc-1)]->acc_nick; ?></div>
					<div class="col-xs-12 hidden-xs" style="padding: 4px 0px;">&nbsp;</div>
<?php elseif( !empty($is_reg['cont_data'])) : // 현재 청약상태 호수이면  ?>
					<div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 0px;">계약 : <?php echo $is_reg['cont_data']->cont_date; ?></div>
					<!-- <div class="col-xs-6 col-sm-4 col-md-2" style="padding: 4px 0px;">입금 : <?php echo number_format($is_reg['app_data']->app_in_mon)." 원"; ?></div> -->
					<!-- <div class="col-xs-6 col-sm-4 col-md-3" style="padding: 4px 0px;">계좌 : <?php if( !empty($dep_acc[($is_reg['app_data']->app_in_acc-1)]->acc_nick)) echo $dep_acc[($is_reg['app_data']->app_in_acc-1)]->acc_nick; ?></div> -->
					<div class="col-xs-12 hidden-xs" style="padding: 4px 0px;">&nbsp;</div>
<?php else : // 신규 계약 등록 처리 시 ?>
					<div class="col-xs-12" style="padding: 8px 0px;">등록된 청약 데이터 없습니다. 신규 계약 정보를 입력하세요.</div>
					<div class="col-xs-12 hidden-xs" style="padding: 1px;">&nbsp;</div>
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
<!--==================================동호 선택 후 계약 상황판 E======================================-->

<?php //if( !$this->input->get('cont_sort2') OR $this->input->get('cont_sort2')=="1") : // 청약 등록 시

	if($this->input->get('cont_sort2')==1) : $conclu_date_label = "청약일자";
	elseif($this->input->get('cont_sort2')==2) : $conclu_date_label = "계약일자";
	elseif($this->input->get('cont_sort3')==3) : $conclu_date_label = "청약해지일자";
	elseif($this->input->get('cont_sort3')==4) : $conclu_date_label = "계약해지일자";
	else : $conclu_date_label = "청약일자";
	endif;

	if(empty($is_reg['app_data']) && empty($is_reg['cont_data'])) : $conclu_date = set_value('conclu_date');
	elseif( !empty($is_reg['app_data']) && ($this->input->get('cont_sort2')==1 OR  $this->input->get('cont_sort3')==3)) : $conclu_date = $is_reg['app_data']->app_date;  // 청약 데이터 있고 청약이나 청약해지
	elseif( !empty($is_reg['app_data']) && ($this->input->get('cont_sort2')==2 OR  $this->input->get('cont_sort3')==4)) : $conclu_date = "";  // 청약 데이터 있고 계약이나 계약 해지
	else : $conclu_date = $is_reg['cont_data']->cont_date;
	endif;
?>
			<div class="row bo-top font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0"><?php echo $conclu_date_label; ?> <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="conclu_date" class="sr-only">거래일자</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="conclu_date" id="conclu_date" class="form-control input-sm" value="<?php echo $conclu_date; ?>" onclick="cal_add(this); event.cancelBubble=true"  readonly>
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('conclu_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
<?php
	if(empty($is_reg['app_data'])) : $due_date = set_value('due_date');
	else : $due_date = $is_reg['app_data']->due_date;
	endif;

	if(( !$this->input->get('cont_sort2') && !$this->input->get('cont_sort3')) OR ($this->input->get('cont_sort2')!=2 && $this->input->get('cont_sort3')!=4)) :
?>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약 예정일</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">

						<label for="due_date" class="sr-only">계약 예정일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="due_date" id="due_date" class="form-control input-sm" value="<?php echo $due_date; ?>" onclick="cal_add(this); event.cancelBubble=true"  readonly>
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('due_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
<?php else :
	if(empty($is_reg['cont_data'])) : $cont_code = set_value('custom_name');
	else : $cont_code = $is_reg['cont_data']->cont_code;
	endif;
?>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; ">계약 일련번호</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_code" class="sr-only">계약 일련번호</label>
						<input type="text" class="form-control input-sm" name="cont_code" value="<?php echo $cont_code; ?>" maxlength="12" <?php echo $disabled; ?>>
					</div>
				</div>
<?php endif; ?>
			</div>

			<div class="row bo-top bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">차수 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="diff_no" class="sr-only">차수</label>
						<select class="form-control input-sm" name="diff_no" <?php echo $disabled; ?>>
							<option value=""> 선 택</option>
<?php foreach($diff_no as $lt) :
	if( !empty($is_reg['app_data']->app_diff)) : $now_diff = $is_reg['app_data']->app_diff; elseif( !empty($is_reg['cont_data']->cont_diff)) : $now_diff = $is_reg['cont_data']->cont_diff; else : $now_diff = ''; endif; ?>
							<option value="<?php echo $lt->diff_no; ?>" <?php if($now_diff==$lt->diff_no) echo "selected"; ?>><?php echo $lt->diff_name; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약 고객명 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
<?php
	if(empty($is_reg['app_data']) && empty($is_reg['cont_data'])) : $custom_name = set_value('custom_name');
	elseif( !empty($is_reg['app_data'])) : $custom_name = $is_reg['app_data']->applicant;
	else : $custom_name = $is_reg['cont_data']->contractor;
	endif;
?>
						<label for="custom_name" class="sr-only">계약자명</label>
						<input type="text" class="form-control input-sm" name="custom_name" value="<?php echo $custom_name; ?>" maxlength="20" <?php echo $disabled; ?>>
					</div>
				</div>
			</div>

<?php
	if(empty($is_reg['app_data']) && empty($is_reg['cont_data'])) : $tel_1 = set_value('tel_1'); $tel_2 = set_value('tel_2');
	elseif( !empty($is_reg['app_data'])) : $tel_1 = $is_reg['app_data']->app_tel1; $tel_2 = $is_reg['app_data']->app_tel2;
	else : $tel_1 = $is_reg['cont_data']->cont_tel1; $tel_2 = $is_reg['cont_data']->cont_tel2;
	endif;
?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">연락처 [1] <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="tel_1" class="sr-only">연락처1</label>
						<input type="text" class="form-control input-sm" name="tel_1" value="<?php echo $tel_1; ?>" maxlength="20" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">연락처 [2]</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="tel_2" class="sr-only">연락처2</label>
						<input type="text" class="form-control input-sm" name="tel_2" value="<?php echo $tel_2; ?>"  maxlength="20"  <?php echo $disabled; ?>>
					</div>
				</div>
			</div>
<?php if( !($this->input->get('cont_sort2')=='2' && empty($is_reg['app_data']))): // 계약등록 시 청약 데이터가 없는 신규 등록인 경우만 제외하고 ->?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">청약금 <span class="red">*</span>
					<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div>
				</div>
<?php
	if( empty($is_reg['app_data']) && empty($receiv_app)) : $app_in_mon = set_value('app_in_mon');
	elseif( !empty($is_reg['app_data'])) : $app_in_mon =$is_reg['app_data']->app_in_mon;
	else : $app_in_mon = $receiv_app->paid_amount;
	endif;
?>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="app_in_date" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="app_in_date" id="app_in_date" class="form-control input-sm" value="<?php if( !empty($is_reg['app_data'])) echo $is_reg['app_data']->app_in_date; else echo set_value('app_in_date'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('app_in_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="app_in_mon" class="sr-only">청약금</label>
						<input type="text" class="form-control input-sm en_only" name="app_in_mon" onkeyPress ='iNum(this)' placeholder="청약금" value="<?php echo $app_in_mon; ?>" <?php echo $disabled; if($this->input->get('cont_sort2')==2 OR $this->input->get('cont_sort2')==4) echo "readonly"; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="app_in_acc" class="sr-only">입금계좌</label>
						<select class="form-control input-sm" name="app_in_acc" <?php echo $disabled; ?> <?php echo $disabled; if($this->input->get('cont_sort2')==2 OR $this->input->get('cont_sort2')==4) echo "readonly"; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq; ?>" <?php if( (!empty($is_reg['app_data']->app_in_acc)&&$lt->seq==$is_reg['app_data']->app_in_acc) OR (!empty($receiv_app->paid_acc)&&$receiv_app->paid_acc==$lt->seq)) : echo "selected"; else:  echo set_select('app_in_acc', $lt->seq); endif; ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0;">
						<label for="app_in_who" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="app_in_who" placeholder="입금자" value="<?php if( !empty($is_reg['app_data']) && $is_reg['app_data']->app_in_who!="") echo $is_reg['app_data']->app_in_who; else echo set_value('app_in_who'); ?>" <?php echo $disabled; if($this->input->get('cont_sort2')==2 OR $this->input->get('cont_sort2')==4) echo "readonly"; ?>>
					</div>
				</div>
<?php if($this->input->get('cont_sort2')==='2') : ?>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="app_pay_sche" class="sr-only">납부회차</label>
						<select class="form-control input-sm" name="app_pay_sche">
							<option value="">납부회차</option>
<?php foreach ($pay_schedule as $lt) : ?>
							<option value="<?php echo $lt->pay_code; ?>" <?php if( !empty($receiv_app)&&$lt->pay_code==$receiv_app->pay_sche_code){ echo "selected"; }else{ set_select('app_pay_sche', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
<?php endif; ?>
			</div>
<?php endif; ?>
<?php if($this->input->get('cont_sort2')=="2" OR $this->input->get('cont_sort3')==4) : // 계약 등록 시 ?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [1] <span class="red">*</span>
					<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div>
				</div>
<?php
	if(empty($received['1'])) : $deposit_1 = set_value('deposit_1');
	else : $deposit_1 = $received['1']->paid_amount;
	endif;
	$rec_num = ( !empty($rec_num)) ? $rec_num : 0; // 계약금 입금 건(횟)수
?>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_date1" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="cont_in_date1" id="cont_in_date1" class="form-control input-sm" value="<?php if( !empty($received['1'])) echo $received['1']->paid_date; else echo set_value('cont_in_date1'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
							<input type="hidden" name="deposit_1_" value="<?php  if( !empty($received['1'])) echo "1"; else "0"; ?>">
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('cont_in_date1'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_1" class="sr-only">계약금[1]</label>
						<input type="text" class="form-control input-sm en_only" name="deposit_1" value="<?php echo $deposit_1; ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_1" class="sr-only">계약금입금계정1</label>
						<select class="form-control input-sm" name="dep_acc_1" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if( !empty($received['1']->paid_acc)&&$received['1']->paid_acc==$lt->seq) echo "selected"; else echo set_select('dep_acc_1', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_who1" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="cont_in_who1" placeholder="입금자" value="<?php if( !empty($received['1'])) echo $received['1']->paid_who; else echo set_value('cont_in_who1'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_pay_sche1" class="sr-only">납부회차</label>
						<select class="form-control input-sm" name="cont_pay_sche1" <?php echo $disabled; ?>>
							<option value="">납부회차</option>
<?php foreach ($pay_schedule as $lt) : ?>
							<option value="<?php echo $lt->pay_code ?>" <?php if( !empty($received['1'])&&$lt->pay_code==$received['1']->pay_sche_code){ echo "selected"; }else{ set_select('cont_pay_sche1', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
<?php
	if(empty($received['2'])) : $deposit_2 = set_value('deposit_2');
	else : $deposit_2 = $received['2']->paid_amount;
	endif;
?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [2] &nbsp;
				<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_date2" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="cont_in_date2" id="cont_in_date2" class="form-control input-sm" value="<?php if( !empty($received['2'])) echo $received['2']->paid_date; else echo set_value('cont_in_date2'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
							<input type="hidden" name="deposit_2_" value="<?php  if( !empty($received['2'])) echo "1"; else "0"; ?>">
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('cont_in_date2'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_2" class="sr-only">계약금[2]</label>
						<input type="text" class="form-control input-sm en_only" name="deposit_2" value="<?php echo $deposit_2; ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]"  <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_2" class="sr-only">계약금입금계정2</label>
						<select class="form-control input-sm" name="dep_acc_2" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if( !empty($received['2']->paid_acc)&&$received['2']->paid_acc==$lt->seq) echo "selected"; else set_select('dep_acc_2', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_who2" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="cont_in_who2" placeholder="입금자" value="<?php if( !empty($received['2'])) echo $received['2']->paid_who; else echo set_value('cont_in_who2'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_pay_sche2" class="sr-only">납부회차</label>
						<div class="col-xs-10 col-md-8" style="padding: 0;">
							<select class="form-control input-sm" name="cont_pay_sche2" <?php echo $disabled; ?>>
								<option value="">납부회차</option>
	<?php foreach ($pay_schedule as $lt) : ?>
								<option value="<?php echo $lt->pay_code ?>" <?php if( !empty($received['2'])&&$lt->pay_code==$received['2']->pay_sche_code){ echo "selected"; }else{ set_select('cont_pay_sche2', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
	<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-2 col-md-4">
							<div class="checkbox"  style="margin: 0; padding: 4px 0;">
								<label>
									<input type="checkbox" name="chk_2" id="chk_2" onclick="receive_add(this,2);" <?php if( !empty($type_name[1])){echo " checked ";} if( !empty($type_name[2])){echo " disabled ";}?> <?php echo $disabled; ?>>
									<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
	if(empty($received['3'])) : $deposit_3 = set_value('deposit_3');
	else : $deposit_3 = $received['3']->paid_amount;
	endif;
?>
			<div class="row bo-bottom font12" id="rec_3" style="margin: 0; <?php if($rec_num<3) echo "display:none";?>">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [3] &nbsp;
				<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_date3" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="cont_in_date3" id="cont_in_date3" class="form-control input-sm" value="<?php if( !empty($received['3'])) echo $received['3']->paid_date; else echo set_value('cont_in_date3'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
							<input type="hidden" name="deposit_3_" value="<?php  if( !empty($received['3'])) echo "1"; else "0"; ?>">
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('cont_in_date3'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_3" class="sr-only">계약금[3]</label>
						<input type="text" class="form-control input-sm en_only" name="deposit_3" value="<?php echo $deposit_3; ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]"  <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_3" class="sr-only">계약금입금계정3</label>
						<select class="form-control input-sm" name="dep_acc_3" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if( !empty($received['3']->paid_acc)&&$received['3']->paid_acc==$lt->seq) echo "selected"; else set_select('dep_acc_3', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_who3" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="cont_in_who3" placeholder="입금자" value="<?php if( !empty($received['3'])) echo $received['3']->paid_who; else echo set_value('cont_in_who3'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_pay_sche3" class="sr-only">납부회차</label>
						<div class="col-xs-10 col-md-8" style="padding: 0;">
							<select class="form-control input-sm" name="cont_pay_sche3" <?php echo $disabled; ?>>
								<option value="">납부회차</option>
	<?php foreach ($pay_schedule as $lt) : ?>
								<option value="<?php echo $lt->pay_code ?>" <?php if( !empty($received['3'])&&$lt->pay_code==$received['3']->pay_sche_code){ echo "selected"; }else{ set_select('cont_pay_sche3', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
	<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-2 col-md-4">
							<div class="checkbox"  style="margin: 0; padding: 4px 0;">
								<label>
									<input type="checkbox" name="chk_3" id="chk_3" onclick="receive_add(this,3);" <?php if( !empty($type_name[1])){echo " checked ";} if( !empty($type_name[2])){echo " disabled ";}?>>
									<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
	if(empty($received['4'])) : $deposit_4 = set_value('deposit_4');
	else : $deposit_4 = $received['4']->paid_amount;
	endif;
?>
			<div class="row bo-bottom font12" id="rec_4" style="margin: 0; <?php if($rec_num<4) echo "display:none";?>">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [4] &nbsp;
				<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_date4" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="cont_in_date4" id="cont_in_date4" class="form-control input-sm" value="<?php if( !empty($received['4'])) echo $received['4']->paid_date; else echo set_value('cont_in_date4'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
							<input type="hidden" name="deposit_4_" value="<?php  if( !empty($received['4'])) echo "1"; else "0"; ?>">
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('cont_in_date4'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_4" class="sr-only">계약금[4]</label>
						<input type="text" class="form-control input-sm en_only" name="deposit_4" value="<?php echo $deposit_4; ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]"  <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_4" class="sr-only">계약금입금계정4</label>
						<select class="form-control input-sm" name="dep_acc_4" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if( !empty($received['4']->paid_acc)&&$received['4']->paid_acc==$lt->seq) echo "selected"; else set_select('dep_acc_4', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_who4" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="cont_in_who4" placeholder="입금자" value="<?php if( !empty($received['4'])) echo $received['4']->paid_who; else echo set_value('cont_in_who4'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_pay_sche4" class="sr-only">납부회차</label>
						<div class="col-xs-10 col-md-8" style="padding: 0;">
							<select class="form-control input-sm" name="cont_pay_sche4" <?php echo $disabled; ?>>
								<option value="">납부회차</option>
	<?php foreach ($pay_schedule as $lt) : ?>
								<option value="<?php echo $lt->pay_code ?>" <?php if( !empty($received['4'])&&$lt->pay_code==$received['4']->pay_sche_code){ echo "selected"; }else{ set_select('cont_pay_sche4', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
	<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-2 col-md-4">
							<div class="checkbox"  style="margin: 0; padding: 4px 0;">
								<label>
									<input type="checkbox" name="chk_4" id="chk_4" onclick="receive_add(this,4);" <?php if( !empty($type_name[1])){echo " checked ";} if( !empty($type_name[2])){echo " disabled ";}?>>
									<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
	if(empty($received['5'])) : $deposit_5 = set_value('deposit_5');
	else : $deposit_5 = $received['5']->paid_amount;
	endif;
?>
			<div class="row bo-bottom font12" id="rec_5" style="margin: 0; <?php if($rec_num<5) echo "display:none";?>">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [5] &nbsp;
				<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_date5" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="cont_in_date5" id="cont_in_date5" class="form-control input-sm" value="<?php if( !empty($received['5'])) echo $received['5']->paid_date; else echo set_value('cont_in_date5'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
							<input type="hidden" name="deposit_5_" value="<?php  if( !empty($received['5'])) echo "1"; else "0"; ?>">
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('cont_in_date5'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_5" class="sr-only">계약금[5]</label>
						<input type="text" class="form-control input-sm en_only" name="deposit_5" value="<?php echo $deposit_5; ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]"  <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_5" class="sr-only">계약금입금계정5</label>
						<select class="form-control input-sm" name="dep_acc_5" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if( !empty($received['5']->paid_acc)&&$received['5']->paid_acc==$lt->seq) echo "selected"; else set_select('dep_acc_5', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_who5" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="cont_in_who5" placeholder="입금자" value="<?php if( !empty($received['5'])) echo $received['5']->paid_who; else echo set_value('cont_in_who5'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_pay_sche5" class="sr-only">납부회차</label>
						<div class="col-xs-10 col-md-8" style="padding: 0;">
							<select class="form-control input-sm" name="cont_pay_sche5" <?php echo $disabled; ?>>
								<option value="">납부회차</option>
	<?php foreach ($pay_schedule as $lt) : ?>
								<option value="<?php echo $lt->pay_code ?>" <?php if( !empty($received['5'])&&$lt->pay_code==$received['5']->pay_sche_code){ echo "selected"; }else{ set_select('cont_pay_sche5', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
	<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-2 col-md-4">
							<div class="checkbox"  style="margin: 0; padding: 4px 0;">
								<label>
									<input type="checkbox" name="chk_5" id="chk_5" onclick="receive_add(this,5);" <?php if( !empty($type_name[1])){echo " checked ";} if( !empty($type_name[2])){echo " disabled ";}?>>
									<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
	if(empty($received['6'])) : $deposit_6 = set_value('deposit_6');
	else : $deposit_6 = $received['6']->paid_amount;
	endif;
?>
			<div class="row bo-bottom font12" id="rec_6" style="margin: 0; <?php if($rec_num<6) echo "display:none";?>">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [6] &nbsp;
				<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_date6" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="cont_in_date6" id="cont_in_date6" class="form-control input-sm" value="<?php if( !empty($received['6'])) echo $received['6']->paid_date; else echo set_value('cont_in_date6'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
							<input type="hidden" name="deposit_6_" value="<?php  if( !empty($received['6'])) echo "1"; else "0"; ?>">
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('cont_in_date6'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_6" class="sr-only">계약금[6]</label>
						<input type="text" class="form-control input-sm en_only" name="deposit_6" value="<?php echo $deposit_6; ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]"  <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_6" class="sr-only">계약금입금계정6</label>
						<select class="form-control input-sm" name="dep_acc_6" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if( !empty($received['6']->paid_acc)&&$received['6']->paid_acc==$lt->seq) echo "selected"; else set_select('dep_acc_6', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_who6" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="cont_in_who6" placeholder="입금자" value="<?php if( !empty($received['6'])) echo $received['6']->paid_who; else echo set_value('cont_in_who6'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_pay_sche6" class="sr-only">납부회차</label>
						<div class="col-xs-10 col-md-8" style="padding: 0;">
							<select class="form-control input-sm" name="cont_pay_sche6" <?php echo $disabled; ?>>
								<option value="">납부회차</option>
	<?php foreach ($pay_schedule as $lt) : ?>
								<option value="<?php echo $lt->pay_code ?>" <?php if( !empty($received['6'])&&$lt->pay_code==$received['6']->pay_sche_code){ echo "selected"; }else{ set_select('cont_pay_sche6', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
	<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-2 col-md-4">
							<div class="checkbox"  style="margin: 0; padding: 4px 0;">
								<label>
									<input type="checkbox" name="chk_6" id="chk_6" onclick="receive_add(this,6);" <?php if( !empty($type_name[1])){echo " checked ";} if( !empty($type_name[2])){echo " disabled ";}?>>
									<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php
	if(empty($received['7'])) : $deposit_7 = set_value('deposit_7');
	else : $deposit_7 = $received['7']->paid_amount;
	endif;
?>
			<div class="row bo-bottom font12" id="rec_7" style="margin: 0; <?php if($rec_num<7) echo "display:none";?>">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약금 [7] &nbsp;
				<div class="point-sub hidden-md hidden-lg" style="height: 153px;">&nbsp;</div></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_date7" class="sr-only">입금일</label>
						<div class="col-xs-10" style="padding: 0;">
							<input type="text" name="cont_in_date7" id="cont_in_date7" class="form-control input-sm" value="<?php if( !empty($received['7'])) echo $received['7']->paid_date; else echo set_value('cont_in_date7'); ?>" placeholder="입금일" onclick="cal_add(this); event.cancelBubble=true"  readonly>
							<input type="hidden" name="deposit_7_" value="<?php  if( !empty($received['7'])) echo "1"; else "0"; ?>">
						</div>
						<div class="col-xs-2" style="padding: 8px 8px 5px;">
							<a href="javascript:" onclick="cal_add(document.getElementById('cont_in_date7'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
						</div>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="deposit_7" class="sr-only">계약금[7]</label>
						<input type="text" class="form-control input-sm en_only" name="deposit_7" value="<?php echo $deposit_7; ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]"  <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dep_acc_7" class="sr-only">계약금입금계정7</label>
						<select class="form-control input-sm" name="dep_acc_7" <?php echo $disabled; ?>>
							<option value="">입금계좌</option>
<?php foreach ($dep_acc as $lt) : ?>
							<option value="<?php echo $lt->seq ?>" <?php if( !empty($received['7']->paid_acc)&&$received['7']->paid_acc==$lt->seq) echo "selected"; else set_select('dep_acc_7', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_in_who7" class="sr-only">입금자</label>
						<input type="text" class="form-control input-sm" name="cont_in_who7" placeholder="입금자" value="<?php if( !empty($received['7'])) echo $received['7']->paid_who; else echo set_value('cont_in_who7'); ?>" <?php echo $disabled; ?>>
					</div>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="cont_pay_sche7" class="sr-only">납부회차</label>
						<select class="form-control input-sm" name="cont_pay_sche7" <?php echo $disabled; ?>>
							<option value="">납부회차</option>
<?php foreach ($pay_schedule as $lt) : ?>
							<option value="<?php echo $lt->pay_code ?>" <?php if( !empty($received['7'])&&$lt->pay_code==$received['7']->pay_sche_code){ echo "selected"; }else{ set_select('cont_pay_sche7', $lt->pay_code); } ?>><?php echo $lt->pay_name; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>








<?php if( !empty($is_reg['cont_data'])) $addr1 = explode("|", $is_reg['cont_data']->cont_addr1); ?>
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
							<input type="text" class="form-control input-sm en_only" id="zipcode" name="zipcode" style="margin: 4px 0;" maxlength="5" value="<?php if( !empty($addr1)) echo $addr1[0]; else echo set_value('zipcode');  ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4" style="padding-right: 0;">
							<label for="address1" class="sr-only">계약자주소1</label>
							<input type="text" class="form-control input-sm han" id="address1" name="address1" style="margin: 4px 0;" maxlength="100" value="<?php if( !empty($addr1)) echo $addr1[1]; else echo set_value('address1');  ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-3" style="padding-right: 0;">
							<label for="address2" class="sr-only">계약자주소2</label>
							<input type="text" class="form-control input-sm han" id="address2" name="address2" style="margin: 4px 0;" maxlength="93" value="<?php if( !empty($addr1)) echo $addr1[2]; else echo set_value('address2');  ?>" placeholder="나머지 주소" <?php echo $disabled; ?>>
						</div>
					</div>
				</div>
			</div>

<?php if( !empty($is_reg['cont_data'])) $addr2 = explode("|", $is_reg['cont_data']->cont_addr2); ?>
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
							<input type="text" class="form-control input-sm en_only" id="zipcode_" name="zipcode_"  style="margin: 4px 0;" maxlength="5" value="<?php if( !empty($addr2)) echo $addr2[0]; else echo set_value('zipcode_');  ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4" style="padding-right: 0;">
							<label for="address1_" class="sr-only">계약자주소11</label>
							<input type="text" class="form-control input-sm han" id="address1_" name="address1_"  style="margin: 4px 0;" maxlength="100" value="<?php if( !empty($addr2)) echo $addr2[1]; else echo set_value('address1_');  ?>" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-3" style="padding-right: 0;">
							<label for="address2_" class="sr-only">계약자주소22</label>
							<input type="text" class="form-control input-sm han" id="address2_" name="address2_"  style="margin: 4px 0;" maxlength="93" value="<?php if( !empty($addr2)) echo $addr2[2]; else echo set_value('address2_');  ?>" placeholder="나머지 주소" <?php echo $disabled; ?>>
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
<?php if( !empty($is_reg['cont_data'])) $inc_doc = explode("-", $is_reg['cont_data']->incom_doc); ?>
				<div class="col-xs-8 col-sm-9 col-md-8" style="padding: 4px 15px;">
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_1" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[0]=='1') echo "checked";  ?>> 각서9종</label></div>
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_2" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[1]=='1') echo "checked"; ?>> 주민등본</label></div>
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_3" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[2]=='1') echo "checked"; ?>> 주민초본</label></div>
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_4" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[3]=='1') echo "checked"; ?>> 가족관계증명</label></div>
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_5" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[4]=='1') echo "checked"; ?>> 인감증명</label></div>
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_6" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[5]=='1') echo "checked"; ?>> 사용인감</label></div>
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_7" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[6]=='1') echo "checked"; ?>> 신분증</label></div>
					<div class="col-xs-6 col-sm-3 checkbox" style="margin: 5px 0; padding-right: 0;"><label><input type="checkbox" name="incom_doc_8" value="1" <?php echo $disabled; if( !empty($is_reg['cont_data'])&&$inc_doc[7]=='1') echo "checked"; ?>> 배우자등본</label></div>
				</div>
			</div>
<?php endif;

	if(empty($is_reg['app_data']) && empty($is_reg['cont_data'])) : $note = set_value('note');
	elseif( !empty($is_reg['app_data'])) : $note = $is_reg['app_data']->note;
	else : $note = $is_reg['cont_data']->note;
	endif;
?>
			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0; height: 75px;">비 고</div>
				<div class="col-xs-8 col-sm-9 col-md-8" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="note" class="sr-only">타입</label>
						<textarea class="form-control input-sm" id="note" name="note"  rows="3" <?php echo $disabled; ?>><?php echo $note; ?></textarea>
					</div>
				</div>
			</div>
		</form>

<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="cont_check();";} ?>
		<div class="form-group btn-wrap" style="margin: <?php echo $mg = ((( !$this->input->get('cont_sort2') && !$this->input->get('cont_sort3')) OR ($this->input->get('cont_sort2')!=2 && $this->input->get('cont_sort3')!=4)))? '130px' :' 30px'; ?> 0 0 0;">
			<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str?>" value="등록 하기">
		</div>
