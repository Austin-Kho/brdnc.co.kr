    <div class="main_start">&nbsp;</div>
    <!-- 1. 분양관리 -> 2. 수납 관리 ->2. 수납 등록 -->

	<div class="row bo-top bo-bottom font12" style="margin: 0;">
		<form method="get" name="pj_sel" action="<?php echo current_url(); ?>">
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12" style="padding: 0px;">
					<label for="yr" class="sr-only">사업 개시년도</label>
					<select class="form-control input-sm" name="yr" onchange="submit();">
						<option value=""> 전 체
<?php
$start_year = "2015";
// if(!$yr) $yr=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
$year=range($start_year,date('Y'));
for($i=(count($year)-1); $i>=0; $i--) :
?>
						<option value="<?php echo $year[$i]?>" <?php if($this->input->get('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?>
<?php endfor; ?>
					</select>
				</div>
			</div>
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택 </div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12" style="padding: 0px;">
					<label for="project" class="sr-only">프로젝트 선택</label>
					<select class="form-control input-sm" name="project" onchange="submit();">
						<option value="0"> 전 체
<?php foreach($all_pj as $lt) : ?>
						<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
<?php endforeach; ?>
					</select>
				</div>
			</div>

		</div>
		<div class="row bo-bottom font12" style="margin: 0 0 20px;">
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
		</form>
	</div>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 15px;">
		<div class="col-xs-12 font14" style="padding: 10px 50px; background-color: #ebedfc; color: #0b071f"><?php echo $contractor_info; ?>&nbsp;</div>
	</div>
