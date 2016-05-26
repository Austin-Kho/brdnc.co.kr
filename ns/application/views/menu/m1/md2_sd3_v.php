	<div class="main_start">&nbsp;</div>
	<!-- 1. 분양관리 -> 2. 수납 관리 ->2.   설정 관리 -->

	<form method="get" name="get_frm" action="<?php echo current_url(); ?>">
		<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-10" style="padding: 0px;">
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
				<div class="col-xs-12 col-sm-10" style="padding: 0px;">
					<label for="project" class="sr-only">프로젝트 선택</label>
					<select class="form-control input-sm" name="project" onchange="submit();">
						<option value="0"> 전 체</option>
<?php foreach($all_pj as $lt) : ?>
						<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">설정항목 선택 </div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-10" style="padding: 0px;">
					<label for="reg_sort" class="sr-only">설정항목 선택</label>
					<select class="form-control input-sm" name="reg_sort" onchange="submit();">
						<option value=""> 전 체
						<option value="1" <?php if($this->input->get('reg_sort')==='1') echo "selected"; ?>>1. 분양 차수 설정</option>
						<option value="2" <?php if($this->input->get('reg_sort')==='2') echo "selected"; ?>>2. 납입 회차 설정</option>
						<option value="3" <?php if($this->input->get('reg_sort')==='3') echo "selected"; ?>>3. 층별 조건 설정</option>
						<option value="4" <?php if($this->input->get('reg_sort')==='4') echo "selected"; ?>>4. 향별 조건 설정</option>
						<option value="5" <?php if($this->input->get('reg_sort')==='5') echo "selected"; ?>>5. 조건별 분양가 설정</option>
						<option value="6" <?php if($this->input->get('reg_sort')==='6') echo "selected"; ?>>6. 회차별 납입가 설정</option>
					</select>
				</div>
			</div>
		</div>
	</form>

<?php if( !$this->input->get('reg_sort') OR $this->input->get('reg_sort')==='1') : ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">1. 분양 차수 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='2') : ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">2. 납입 회차 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='3') : ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">3. 층별 조건 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='4') : ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">4. 향별 조건 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='5') : ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">5. 조건별 분양가 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='6') : ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">6. 회차별 납입가 설정</p></div>
	</div>
<?php endif; ?>


<?php if( !$this->input->get('reg_sort') OR $this->input->get('reg_sort')==='1') : //1. 분양 차수 설정?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">1. 분양 차수 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='2') : //2. 납입 회차 설정 ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">2. 납입 회차 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='3') : //3. 층별 조건 설정 ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">3. 층별 조건 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='4') : //4. 향별 조건 설정 ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">4. 향별 조건 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='5') : //5. 조건별 분양가 설정?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">5. 조건별 분양가 설정</p></div>
	</div>
<?php elseif($this->input->get('reg_sort')==='6') : //6. 회차별 납입가 설정?>
	<form method="get" name="get_frm" action="<?php echo current_url(); ?>">
		<input type="hidden" name="yr" value="<?php echo $this->input->get('yr'); ?>">
		<input type="hidden" name="project" value="<?php echo $this->input->get('project'); ?>">
		<input type="hidden" name="reg_sort" value="<?php echo $this->input->get('reg_sort'); ?>">
		<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">분양차수 선택</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-10" style="padding: 0px;">
					<label for="diff_no" class="sr-only">분양차수 선택</label>
					<select class="form-control input-sm" name="diff_no" onchange="submit();">
						<option value="">선 택</option>
	<?php foreach($diff_no as $lt) : ?>
						<option value="<?php echo $lt->diff_no; ?>" <?php if($lt->diff_no==$this->input->get('diff_no')) echo "selected"; ?>><?php echo $lt->diff_name; ?></option>
	<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">회차구분 선택</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-10" style="padding: 0px;">
					<label for="pay_sort" class="sr-only">회차구분 선택</label>
					<select class="form-control input-sm" name="pay_sort" onchange="submit();" <?php if( !$this->input->get('diff_no')) echo "disabled"; ?>>
						<option value="">선 택</option>
						<option value="1" <?php if($this->input->get('pay_sort')=='1') echo "selected"; ?>>계약금</option>
						<option value="2" <?php if($this->input->get('pay_sort')=='2') echo "selected"; ?>>중도금</option>
						<option value="3" <?php if($this->input->get('pay_sort')=='3') echo "selected"; ?>>잔 금</option>
					</select>
				</div>
			</div>
		</div>
	</form>

<?php if( !$this->input->get('pay_sort')) : ?>
	<div class="row font12" style="margin: 0; padding: 0;">
		<div class="col-xs-12 center" style="padding: 180px 0;">회차구분을 선택하여 주십시요.</div>
	</div>

<?php else : ?>

	<div class="row font12" style="margin: 0; padding: 0;">
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered center">
				<thead>
					<tr>
						<td colspan="2" width="6%">구 분</td>
<?php for($i=0; $i<count($sche_name); $i++) : ?>
						<td><?php echo $sche_name[$i]->pay_name; ?></td>
<?php endfor; ?>
					</tr>
				</thead>
				<tbody>
<?php foreach($type_name as $lt) :
	$diff_name = ( !empty($diff)) ? $diff->diff_name : "";
	$first_td = ($lt->type_no=='1')  ? "<td rowspan='4' width='3%'>".$diff_name."</td>" : "";
?>
					<tr>
						<?php echo $first_td; ?>
						<td><?php echo $lt->type_name; ?></td>
<?php for($i=0; $i<count($sche_name); $i++) : ?>
						<td>
							<label for="<?php echo "pmt_".$lt->type_no."_".$i; ?>"><input type="text" name="<?php echo "pmt_".$lt->type_no."_".$i; ?>" value="<?php echo "pmt_".$lt->type_no."_".$i; ?>"></label>
						</td>
<?php endfor; ?>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>








<?php endif; ?>
