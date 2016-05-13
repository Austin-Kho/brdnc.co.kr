<div class="container">
	<header id="header">
		<h1>단위세대 정보 개별 수정</h1>
	</header>
	<div class="desc"></div>
	<div class="well" style="padding: 13px; margin-bottom: 9px;">
		<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> <span style="padding-left: 10px; <?php if($modi_data->is_application==1 OR $modi_data->is_contract==1) echo "color: blue;"; ?>">청약 또는 계약 체결 상태에서는 수정할 수 없습니다. (<font color="#ff0000">*</font>표시는 필수 정보)</span>
	</div>

	<form name="form1" class="form-horizontal" action="" method="post">
		<label><input type="hidden" name="seq" value="<?php echo $this->uri->segment(5); ?>"></label>

		<div class="row" style="padding: 0 15px; margin-bottom: 15px;">
			<div class="form-group" style="padding-top: 15px;">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="pj_seq">프로젝트 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-6" style="padding-right: 0;">
					<select name="pj_seq" id="pj_seq" class="form-control input-sm" <?php if($modi_data->is_application==1 OR $modi_data->is_contract==1) echo "disabled"; ?>>
						<option value="" selected> 선 택</option>
<?php foreach($all_pj as $lt) : ?>
						<option value="<?php echo $lt->seq; ?>" <?php if($lt->seq==$modi_data->pj_seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right">
					<label for="type">타 입 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-6"  style="padding-right: 0;">
					<select name="type" id="type" class="form-control input-sm" <?php if($modi_data->is_application==1 OR $modi_data->is_contract==1) echo "disabled"; ?>>
						<option value=""> 선 택</option>
<?php foreach($type as $lt) : ?>
						<option value="<?php echo $lt; ?>" <?php if($lt==$modi_data->type) echo "selected"; ?>><?php echo $lt; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right">
					<label for="dong">동 호수 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-3" style="padding-right: 0;">
					<select name="dong" id="dong" class="form-control input-sm" <?php if($modi_data->is_application==1 OR $modi_data->is_contract==1) echo "disabled"; ?>>
						<option value="" selected> 동 선택</option>
<?php foreach($dong as $lt) : ?>
						<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$modi_data->dong) echo "selected"; ?>><?php echo $lt->dong." 동"; ?></option>
<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xs-3" style="padding-right: 0;">
					<input type="text" name="ho" id="ho" class="form-control input-sm" value="<?php echo $modi_data->ho; ?>" <?php if($modi_data->is_application==1 OR $modi_data->is_contract==1) echo "disabled"; ?>>
				</div>
				<div class="col-xs-3" style="padding-top: 6px;">호</div>



			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="is_application">청약 여부 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-6 checkbox" style="padding-top: 0;">
					<label><input type="checkbox" name="is_application" id="is_application" value="1" <?php if($modi_data->is_application==1) echo "checked"; ?> disabled>청약 체결상태</label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="is_contract">계약 여부 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-6 checkbox" style="padding-top: 0;">
					<label><input type="checkbox" name="is_contract" is_contract="acc" value="1" <?php if($modi_data->is_contract==1) echo "checked"; ?> disabled >계약 체결상태</label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="is_hold">홀딩 여부 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-6 checkbox" style="padding-top: 0;">
					<label><input type="checkbox" name="is_hold" id="is_hold" value="1" <?php if($modi_data->is_hold=='1') echo "checked"; ?> <?php if($modi_data->is_application==1 OR $modi_data->is_contract==1) echo "disabled"; ?>>분양 대상 세대에서 제외됩니다.</label>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-3 right" style="text-align: right;">
					<label for="hold_reason">홀딩 사유 <font color="#ff0000">*</font></label>
				</div>
				<div class="col-xs-7"  style="padding-right: 0;">
					<textarea class="form-control input-sm" id="hold_reason" name="hold_reason"  rows="3" <?php if($modi_data->is_application==1 OR $modi_data->is_contract==1) echo "disabled"; ?>><?php echo $modi_data->hold_reason; ?></textarea>
				</div>
			</div>
			<div class="row center" style="padding: 3px; color: #8f8f91;">
				<div class="col-xs-3 col-sm-3">최초 등록일</div>
				<div class="col-xs-3 col-sm-3">최초 등록자</div>
				<div class="col-xs-3 col-sm-3">마지막 수정일</div>
				<div class="col-xs-3 col-sm-3">마지막 수정자</div>
			</div>
			<div class="row center" style="padding: 3px; margin-bottom: 10px; color: #8f8f91;">
				<div class="col-xs-3 col-sm-3"><?php echo mb_substr($modi_data->reg_time, 0, 10); ?></div>
				<div class="col-xs-3 col-sm-3"><?php echo $modi_data->reg_worker; ?></div>
				<div class="col-xs-3 col-sm-3"><?php echo $modi_data->modi_date; ?></div>
				<div class="col-xs-3 col-sm-3"><?php echo $modi_data->modi_worker; ?></div>
			</div>
			<footer style=" border-top: 1px solid #ddd;">
				<div class="col-xs-12" style="text-align: right; padding: 10px;">
					<input type="button" name="name" class="btn btn-primary btn-sm" value="수정하기" onclick="if(confirm('해당 단위세대 정보를 수정하시겠습니까?')==true) submit(); else return;">
					<input type="button" name="name" class="btn btn-danger btn-sm" value="닫기" onclick="opener.location.reload(); self.close();">
				</div>
			</footer>
		</div>
	</form>
</div>
