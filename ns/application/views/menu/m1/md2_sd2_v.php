    <div class="main_start">&nbsp;</div>
    <!-- 1. 분양관리 -> 2. 수납 관리 ->2. 수납 등록 -->

	<form method="get" name="form1" action="<?php echo current_url(); ?>">
		<div class="row bo-top bo-bottom font12" style="margin: 0;">
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
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">입금자 성명</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-8" style="padding: 0px;">
					<label for="who_name" class="sr-only">입금자 성명</label>
					<input type="text" name="who_name" value="<?php if($this->input->get('who_name')) echo $this->input->get("who_name"); ?>" class="form-control input-sm">
				</div>
				<div class="col-xs-4">
					<input type="button" class="btn btn-primary btn-sm" onclick="submit();" value="검 색">
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
						<option value="">선 택</option>
<?php foreach($ho_list as $lt) : ?>
						<option value="<?php echo $lt->ho; ?>" <?php if($lt->ho==$this->input->get('ho')) echo "selected"; ?>><?php echo $lt->ho." 호"; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>

<?php if($this->input->get('who_name') && empty($now_who)): ?>
			<div class="col-xs-12 col-sm-12 col-md-4" style="padding: 8px; 0">
				<div class="col-xs-12 center" style="padding-top: 5px;">조회 결과가 없습니다.</div>
			</div>
<?php elseif( !empty($now_who)) : ?>
			<div class="col-xs-11 col-sm-11 col-md-3" style="padding: 12px 10px 6px; margin: 0;">
<?php foreach($now_who as $lt) :
 $dong_ho = explode("-", $lt->unit_dong_ho);
 echo "<a href='".base_url('m1/sales/2/2?project='.$project.'&who_name='.$this->input->get('who_name').'&dong='.$dong_ho[0].'&ho='.$dong_ho[1])."'>".$lt->paid_who."</a>";
?>&nbsp;<?php endforeach; ?>
			</div>
			<div class="col-xs-1" style="padding: 8px;">
				<button type="button" class="close" aria-label="Close" style="padding-left: 5px;" onclick="location.href='<?php echo base_url('m1/sales/2/2?project='.$project.'&dong='.$dong_ho[0].'&ho='.$dong_ho[1]) ?>'"><span aria-hidden="true">&times;</span></button>
			</div>
<?php endif; ?>
		</div>
		<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
			<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-info" style="padding: 13px 20px; margin: 0;"><?php echo $contractor_info; ?>&nbsp;</p></div>
		</div>
	</form>
	<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-프로젝트 선택 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->


	<div class="row font12" style="margin: 0; padding: 0;">
		<div class="col-sm-12 col-sm-12 col-md-7" style="padding: 0 10px;">
			<div class="col-sm-12 table-responsive" style="padding: 0;">
				<table class="table table-bordered  table-hover table-condensed center">
					<thead>
						<tr class="active">
							<td>수납일자</td>
							<td>회차구분</td>
							<td>수납금액</td>
							<td>수납계좌</td>
							<td>입금자</td>
						</tr>
					</thead>
					<tbody>
<?php if($this->input->get('ho')) : ?>
<?php foreach($received as $lt):
	$paid_sche = $this->main_m->sql_row(" SELECT pay_name FROM cms_sales_pay_sche WHERE pj_seq='$project' AND pay_code='$lt->pay_sche_code' ");
	$paid_acc_nick = $this->main_m->sql_row(" SELECT acc_nick FROM cms_sales_bank_acc WHERE pj_seq='$project' AND seq='$lt->paid_acc' ");
?>
						<tr style="background-color: #F9FAD9;">
							<td><?php echo $lt->paid_date; ?></td>
							<td><?php echo $paid_sche->pay_name; ?></td>
							<td class="right"><a href="?modi=1&project=<?php echo $project; ?>&dong=<?php echo $this->input->get('dong'); ?>&ho=<?php echo $this->input->get('ho'); ?>&rec_seq=<?php echo $lt->seq; ?>" data-toggle="tooltip" title="입력 내용 수정하기"><?php echo number_format($lt->paid_amount); ?></a></td>
							<td><?php echo $paid_acc_nick->acc_nick ; ?></td>
							<td><?php echo $lt->paid_who; ?></td>
						</tr>
<?php endforeach; ?>
<?php endif; ?>
					</tbody>
					<tfoot>
						<tr>
							<td>합 계</td>
							<td></td>
							<td class="right" style="color: #0427A4; font-weight: bold;"><?php if( !empty($total_paid)) echo number_format($total_paid->total_paid); ?></td>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>

			<form class="" name="form2" action="<?php echo current_url(); ?>" method="post">
				<input type="hidden" name="modi" value="<?php echo $this->input->get('modi'); ?>">
				<input type="hidden" name="dong" value="<?php echo $this->input->get('dong'); ?>">
				<input type="hidden" name="ho" value="<?php echo $this->input->get('ho'); ?>">
<?php $cont_seq = ( !empty($cont_data)) ? $cont_data->seq : ""; // 계약 아이디 ?>
				<input type="hidden" name="cont_seq" value="<?php echo $cont_seq; ?>">
<?php $rec_seq = ( !empty($this->input->get('rec_seq'))) ? $this->input->get('rec_seq') : ""; // 계약 아이디 ?>
				<input type="hidden" name="rec_seq" value="<?php echo $rec_seq; ?>">
				<div class="row" style="margin: 0; padding: 0;">
					<div class="col-sm-12 bo-top" style="padding: 0;">
						<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">수납일자</div>
						<div class="col-xs-8 col-md-4" style="padding: 0;">
							<label for="paid_date" class="sr-only">수납일자</label>
							<div class="col-xs-10" style="padding: 4px;">
								<input type="text" name="paid_date" id="paid_date" class="form-control input-sm" value="<?php if($this->input->get('modi')=='1') echo $modi_rec->paid_date; else echo set_value('paid_date'); ?>" placeholder="입금일 (0000-00-00)" onclick="cal_add(this); event.cancelBubble=true">
							</div>
							<div class="col-xs-2" style="padding: 10px 5px;">
								<a href="javascript:" onclick="cal_add(document.getElementById('paid_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="row" style="margin: 0; padding: 0;">
					<div class="col-sm-12 bo-top" style="padding: 0;">
						<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">회차구분</div>
						<div class="col-xs-8 col-md-4" style="padding:  4px;">
							<label for="pay_sche_code" class="sr-only">납부회차</label>
							<select class="form-control input-sm" name="pay_sche_code">
								<option value="">납부회차</option>
<?php foreach ($pay_sche_code as $lt) : ?>
								<option value="<?php echo $lt->pay_code; ?>" <?php if($this->input->get('modi')=='1' && $modi_rec->pay_sche_code==$lt->pay_code) echo "selected"; else echo set_select('pay_sche_code', $lt->pay_code); ?>><?php echo $lt->pay_name; ?></option>
<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">수납금액</div>
						<div class="col-xs-8 col-md-4" style="padding: 4px;">
							<label for="paid_amount" class="sr-only">수납금액</label>
							<input type="text" class="form-control input-sm en_only" name="paid_amount" value="<?php if($this->input->get('modi')=='1') echo $modi_rec->paid_amount; else echo set_value('paid_amount'); ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]">
						</div>
					</div>
				</div>

				<div class="row" style="margin: 0; padding: 0;">
					<div class="col-sm-12 bo-top  bo-bottom" style="padding: 0; margin-bottom: 20px;">
						<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">수납계좌</div>
						<div class="col-xs-8 col-md-4" style="padding: 4px;">
							<label for="paid_acc" class="sr-only">수납계좌</label>
							<select class="form-control input-sm" name="paid_acc">
								<option value="">입금계좌</option>
<?php foreach ($paid_acc as $lt) : ?>
								<option value="<?php echo $lt->seq ?>" <?php if($this->input->get('modi')=='1' && $modi_rec->paid_acc==$lt->seq) echo "selected"; echo set_select('paid_acc', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">입금자</div>
						<div class="col-xs-8 col-md-4" style="padding: 4px;">
							<label for="paid_who" class="sr-only">입금자</label>
							<input type="text" class="form-control input-sm" name="paid_who" value="<?php if($this->input->get('modi')=='1') echo $modi_rec->paid_who; else echo set_value('paid_who'); ?>" placeholder="입금자">
						</div>
					</div>
				</div>
	<?php if( !$this->input->get('ho')) : ?>
				<div class="row">
					<div class="col-sm-12 center" style="padding: 70px 0  86px;"><?php echo validation_errors('<div class="error">', '</div>'); ?>등록할 동 호수를 선택하여 주세요.</div>
				</div>
	<?php endif; ?>
	<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="receive_chk();";} ?>
				<div class="form-group btn-wrap" style="margin: ;">
<?php if($this->input->get('modi')=='1') : ?>
					<input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo base_url('m1/sales/2/2').'?modi=0&project='.$project.'&dong='.$this->input->get('dong').'&ho='.$this->input->get('ho'); ?>'"  value="지우기">
<?php endif;
	$btn_val = ($this->input->get('modi')=='1') ? "변경 등록" : "신규 등록";
?>
					<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str?>" value="<?php echo $btn_val; ?>">
				</div>
			</form>
		</div>



		<div class="col-sm-12 col-sm-12 col-md-5" style="padding: 0 10px;">
			<div class="col-xs-12 table-responsive" style="padding: 0;">
				<table class="table table-bordered  table-hover table-condensed center">
					<thead>
						<tr class="active">
							<td>약정일자</td>
							<td>구 분</td>
							<td>약정금액</td>
							<td>수납금액</td>
							<td>미(과오)납</td>
						</tr>
					</thead>
					<tbody>
<?php
foreach($pay_sche_code as $lt) :
	if(($lt->pay_code=='3' OR $lt->pay_code=='4') && !empty($cont_data)) :
		$due_date = date('Y-m-d', strtotime('+1 month', strtotime($cont_data->cont_date)));
	elseif($lt->pay_code>'3' && !empty($cont_data->pay_due_date)) :
		$due_date = $cont_data->pay_due_date;
	else :
		$due_date = "";
	endif;
	if( !empty($cont_data)) {
		$ppsche = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS pps FROM cms_sales_received WHERE pj_seq='$project' AND cont_seq='$cont_data->seq' AND pay_sche_code='$lt->pay_code' ");
		$paid_per_sche = (empty($ppsche->pps) OR $ppsche->pps=='0') ? "-" : number_format($ppsche->pps); // 수납금액
		$payment = $this->main_m->sql_row(" SELECT * FROM cms_sales_payment WHERE pj_seq='$project' AND price_seq='$cont_data->price_seq' AND pay_sche_seq='$lt->seq' "); // 약정금액
		$col = ($ppsche->pps-$payment->payment<0) ? "#A80505" : "#0427A4";
		$compair = ($ppsche->pps-$payment->payment===0) ? "-" : number_format($ppsche->pps-$payment->payment);
	}

?>
						<tr class="<?php if(empty($cont_data)) echo "active"; ?>">
							<td style="color: <?php if(date('Y-md')>$due_date) echo '#d00202' ?>;"><?php echo $due_date; ?></td>
							<td><?php echo $lt->pay_name; ?></td>
							<td class="right"><?php if( !empty($payment))echo number_format($payment->payment); ?></td>
							<td class="right" style="color: #0427A4;"><?php if( !empty($ppsche)) echo $paid_per_sche; ?></td>
							<td class="right" style="color: <?php if( !empty($ppsche)) echo $col; ?>;"><?php if(( !empty($ppsche) && $lt->pay_code<3) OR !empty($due_date)) echo $compair; ?></td>
						</tr>
<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr class="active">
							<td>합 계</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
	<?php // endif; ?>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
