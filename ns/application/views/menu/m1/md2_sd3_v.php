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
	<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-프로젝트 /조건선택 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

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
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-조건별 제목 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?php if( !$this->input->get('reg_sort') OR $this->input->get('reg_sort')==='1') : //1. 분양 차수 설정?>
	<div class="row font12" style="margin: 0 0 300px;">
		<div class="col-xs-12 col-sm-12 col-md-8 table-responsive"  style="padding: 0;">
			<table class="table table-hover">
				<thead>
					<tr class="bo-top active">
						<td>등록차수</td>
						<td>차수명</td>
						<td>등록일</td>
						<td>등록자</td>
						<td>수정</td>
						<td>삭제</td>
					</tr>
				</thead>
				<tbody class="bo-bottom">
<?php foreach($con_diff as $lt) :  ?>
					<tr>
						<td><?php echo $lt->diff_no; ?></td>
						<td><?php echo $lt->diff_name; ?></td>
						<td><?php echo $lt->reg_date; ?></td>
						<td><?php echo $lt->reg_worker; ?></td>
						<td>수정</td>
						<td>삭제</td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-1. 분양 차수 설정 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?php elseif($this->input->get('reg_sort')==='2') : //2. 납입 회차 설정 ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14"  style="padding-bottom: 440px;">2. 납입 회차 설정</div>
	</div>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-2. 납입 회차 설정 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?php elseif($this->input->get('reg_sort')==='3') : //3. 층별 조건 설정 ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14"  style="padding-bottom: 440px;">3. 층별 조건 설정</div>
	</div>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-3. 층별 조건 설정 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?php elseif($this->input->get('reg_sort')==='4') : //4. 향별 조건 설정 ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14"  style="padding-bottom: 440px;">4. 향별 조건 설정</div>
	</div>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-4. 향별 조건 설정 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?php elseif($this->input->get('reg_sort')==='5') : //5. 조건별 분양가 설정 ?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14"  style="padding-bottom: 440px;">5. 조건별 분양가 설정</div>
	</div>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-5. 조건별 분양가 설정 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

<?php elseif($this->input->get('reg_sort')==='6') : //6. 회차별 납입가 설정 ?>
	<form method="get" name="get_frm" action="<?php echo current_url(); ?>">
		<input type="hidden" name="yr" value="<?php echo $this->input->get('yr'); ?>">
		<input type="hidden" name="project" value="<?php echo $this->input->get('project'); ?>">
		<input type="hidden" name="reg_sort" value="<?php echo $this->input->get('reg_sort'); ?>">

		<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">차수구분 선택</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-10" style="padding: 0px;">
					<label for="con_diff" class="sr-only">차수구분 선택</label>
					<select class="form-control input-sm" name="con_diff" onchange="submit();">
						<option value="">선 택</option>
<?php foreach($con_diff as $lt) : ?>
						<option value="<?php echo $lt->diff_no; ?>" <?php if($this->input->get('con_diff')==$lt->diff_no) echo "selected"; ?>><?php echo $lt->diff_name; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">회차구분 선택</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-10" style="padding: 0px;">
					<label for="pay_sort" class="sr-only">회차구분 선택</label>
					<select class="form-control input-sm" name="pay_sort" onchange="submit();">
						<option value="">선 택</option>
						<option value="1" <?php if($this->input->get('pay_sort')=='1') echo "selected"; ?>>계약금</option>
						<option value="2" <?php if($this->input->get('pay_sort')=='2') echo "selected"; ?>>중도금</option>
						<option value="3" <?php if($this->input->get('pay_sort')=='3') echo "selected"; ?>>잔 금</option>
					</select>
				</div>
			</div>
		</div>
	</form>

<?php
if( !$this->input->get('con_diff') OR  !$this->input->get('pay_sort'))  :
	if( !$this->input->get('con_diff')) :  $msg = "차수구분을 선택하여 주십시요.";
	elseif( !$this->input->get('pay_sort')) :  $msg = "회차구분을 선택하여 주십시요.";
	endif;
?>
	<div class="row font12" style="margin: 0; padding: 0;">
		<div class="col-xs-12 center" style="padding: 180px 0;"><?php echo $msg; ?></div>
	</div>
<?php else : ?>
	<form class="" action="" method="post">
		<div class="row font12" style="margin: 0; padding: 0;">
			<div class="col-xs-12 table-responsive" style="padding: 0;">
				<table class="table table-bordered center">
					<thead>
						<tr class="active">
							<td width="3%">No.</td>
							<td width="5%">타입</td>
							<td width="8%">층별</td>
							<td width="10%">분양가</td>
<?php foreach($pay_sche as $lt) :  ?>
							<td><?php echo $lt->pay_name ?></td>
<?php endforeach; ?>
						</tr>
					</thead>
					<tbody>
<?php for($i=0; $i<count($price); $i++) :
	$diff_td = ($i===0) ?  "<td rowspan='".$pr_diff[$i]->num_diff."'>".$pr_diff[$i]->diff_name."</td>" : ""; // 차수명
	$type_td = (($i+$pr_type[0]->num_type)%$pr_type[0]->num_type===0) ? "<td rowspan='".$pr_type[0]->num_type."'>".$price[$i]->con_type."</td>" : ""; // 타입명
?>
						<tr>
							<?php echo $diff_td; ?>
							<?php echo $type_td; ?>
							<td><?php echo $price[$i]->floor_name; ?></td>
							<td class="right"><?php echo number_format($price[$i]->unit_price); ?></td>
<?php
for($j=0; $j<count($pay_sche); $j++) :
	$pmt = $this->main_m->sql_row(" SELECT * FROM cms_sales_payment WHERE pj_seq='$project' AND price_seq='".$price[$i]->pr_seq."' AND pay_sche_seq='".$pay_sche[$j]->seq."' ");
?>
							<td style="background-color: ; padding: 3px;">
								<div style="color: #B00447;"><?php echo form_error("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq); ?>
									<input type="text" name="<?php echo "pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq; ?>" value="<?php if( !empty($pmt)) echo $pmt->payment; else echo set_value("pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq) ?>" size="15" placeholder="회차별 납부액">
									<input type="hidden" name="<?php echo "pmt_".$price[$i]->pr_seq."-".$pay_sche[$j]->seq."_h"; ?>" value="<?php if( !empty($pmt)) echo "1"; else "0"; ?>">
								</div>
							</td>
<?php endfor; ?>
						</tr>
<?php endfor; ?>
					</tbody>
				</table>
			</div>
		</div>
<?php endif; ?>
<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="if(confirm('납입금 내역을 등록하시겠습니까?')===true) submit();";} ?>
		<div class="form-group btn-wrap" style="margin: ;">
			<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str?>" value="등록 하기">
		</div>
	</form>

<?php endif; ?>
<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-6. 회차별 납입가 설정 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
