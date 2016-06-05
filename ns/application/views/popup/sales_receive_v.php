	<div class="row font12" style="margin: 0; padding: 0; background-color: #FFF;">
		<div class="col-md-12" style="padding: 0;">
			<div class="col-xs-4 col-sm-3 col-md-2"><h4><span class="label label-info">1. 수납현황</span></h4></div>
			<div class="col-xs-8 col-sm-5 col-md-2">
				<label for="view_sort" class="sr-only">프로젝트 선택</label>
				<select class="form-control input-sm" name="view_sort" onchange="submit();" style="margin: 5px 0;">
					<option value="0"> 전 체
					<option value="1" <?php if( !$this->input->get('view_sort') OR $this->input->get('view_sort')=='1') echo "selected"; ?>>월 별</option>
					<option value="2" <?php if($this->input->get('view_sort')=='2') echo "selected"; ?>>일 별</option>
				</select>
			</div>
		</div>
	</div>
