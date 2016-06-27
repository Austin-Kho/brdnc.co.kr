	<div class="row font12" style="margin: 0; padding: 0; background-color: #FFF; height: 1000px;">
		<div class="col-md-12" style="padding: 0;">
			<div class="col-xs-12"><h4><span class="label label-info">약정별 수금 현황</span></h4></div>
			<div class="col-xs-8 col-sm-5 col-md-1 right" style="padding-top: 11px;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 프로젝트 : </div>
			<div class="col-xs-8 col-sm-5 col-md-2">
				<label for="view_sort" class="sr-only">프로젝트 선택</label>
				<select class="form-control input-sm" name="view_sort" onchange="submit();" style="margin: 5px 0;">
					<option value="0"> 전 체
<?php foreach($all_pj as $lt) : ?>
							<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
<?php endforeach; ?>
				</select>
			</div>
			<div class="col-xs-8 col-sm-5 col-md-1 right" style="padding-top: 11px;"><span class="glyphicon glyphicon-file" aria-hidden="true"> 분양구분 : </div>
			<div class="col-xs-8 col-sm-5 col-md-2">
				<label for="view_sort" class="sr-only">프로젝트 선택</label>
				<select class="form-control input-sm" name="view_sort" onchange="submit();" style="margin: 5px 0;">
					<option value="1" <?php if( !$this->input->get('view_sort') OR $this->input->get('view_sort')=='1') echo "selected"; ?>>아파트</option>
					<option value="2" <?php if($this->input->get('view_sort')=='2') echo "selected"; ?>>발코니</option>
				</select>
			</div>
			<div class="col-xs-8 col-sm-5 col-md-1 right" style="padding-top: 11px;"><span class="glyphicon glyphicon-file" aria-hidden="true"> 선택 : </div>
			<div class="col-xs-8 col-sm-5 col-md-2">
				<label for="view_sort" class="sr-only">표시 선택</label>
				<select class="form-control input-sm" name="view_sort" onchange="submit();" style="margin: 5px 0;">
					<option value="1" <?php if( !$this->input->get('view_sort') OR $this->input->get('view_sort')=='1') echo "selected"; ?>>월 별</option>
					<option value="2" <?php if($this->input->get('view_sort')=='2') echo "selected"; ?>>일 별</option>
				</select>
			</div>
		</div>
		<div class="col-md-12" style="padding: 0;">

		</div>
	</div>
