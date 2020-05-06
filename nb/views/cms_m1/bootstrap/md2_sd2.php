<?php
if($auth22<1) :
	include('no_auth.php');
else :
?>
    <div class="main_start">&nbsp;</div>
    <!-- 1. 분양관리 -> 2. 수납 관리 ->2. 수납 등록 -->

<?php
  $attributes = array('method' => 'get', 'name' => 'form1');
  echo form_open(current_full_url(), $attributes);

  $start_year = "2015";
  $yr = (!$this->input->get('yr')) ? "" :$this->input->get('yr');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
  $year=range($start_year,date('Y'));
?>
		<div class="row bo-top bo-bottom font12" style="margin: 0;">
			<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">사업 개시년도</div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12" style="padding: 0px;">
					<label for="yr" class="sr-only">사업 개시년도</label>
					<select class="form-control input-sm" name="yr" onchange="submit();">
						<option value=""> 전 체
                        <?php for($i=(count($year)-1); $i>=0; $i--) : ?>
                            <option value="<?php echo $year[$i]?>" <?php if($this->input->get('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?>
                        <?php endfor; ?>
                    </select>
				</div>
            </div>
			<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">프로젝트 선택 </div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12" style="padding: 0px;">
					<label for="project" class="sr-only">프로젝트 선택</label>
					<select class="form-control input-sm" name="project" onchange="submit();">
						<option value="0"> 전 체
                        <?php foreach($pj_list as $lt) : ?>
                            <option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='3') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
                        <?php endforeach; ?>
					</select>
				</div>
			</div>
	<!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-프로젝트 선택 종료-|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

            <?php $search_label = ($pj_now->data_cr=='1') ? "계약자(동호수)" : "계약자(계약코드)"; ?>
			<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;"><?php echo $search_label; ?></div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-8" style="padding: 0px;">
					<label for="payer" class="sr-only">계약자(입금자/계약코드)</label>
					<input type="text" name="payer" value="<?php if($this->input->get('payer')) echo $this->input->get("payer"); ?>" class="form-control input-sm" placeholder="입금자/계약자/코드" onkeydown="if(event.keyCode==13)submit();" onclick="this.value=''">
				</div>
				<div class="col-xs-4">
					<input type="button" class="btn btn-primary btn-sm" onclick="submit();" value="검 색">
				</div>
			</div>
		</div>
		<div class="row bo-bottom font12" style="margin: 0 0 20px;">
<?php if ($pj_now->data_cr=='1'): ?>
			<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">동 선택 <span class="red">*</span></div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12" style="padding: 0px;">
					<label for="dong" class="sr-only">동</label>
					<select class="form-control input-sm" name="dong" onchange="dong_sel();">
						<option value=""> 선 택</option>
                        <?php foreach($dong_list as $lt) : ?>
						    <option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->get('dong')) echo "selected"; ?>><?php echo $lt->dong." 동"; ?></option>
                        <?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">호수 선택 <span class="red">*</span></div>
			<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
				<div class="col-xs-12" style="padding: 0px;">
					<label for="ho" class="sr-only">호수</label>
					<select class="form-control input-sm" name="ho" id="ho" onchange="submit();" <?php if( !$this->input->get('dong')) echo "disabled"; ?>>
						<option value="">선 택</option>
                        <?php foreach($ho_list as $lt) : ?>
						    <option value="<?php echo $lt->ho; ?>" <?php if($lt->ho==$this->input->get('ho')) echo "selected"; ?>><?php echo $lt->ho." 호"; ?></option>
                        <?php endforeach; ?>
					</select>
				</div>
			</div>
<?php else: ?>
            <div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">타입 선택 <span class="red">*</span></div>
            <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
                <div class="col-xs-12" style="padding: 0px;">
                    <label for="dong" class="sr-only">타입</label>
                    <select class="form-control input-sm" name="type" onchange="type_sel();">
                        <option value=""> 선 택</option>
				        <?php foreach($type_list as $lt) : ?>
                            <option value="<?php echo $lt; ?>" <?php if($lt==$this->input->get('type')) echo "selected"; ?>><?php echo $lt; ?></option>
				        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">계약코드 선택 <span class="red">*</span></div>
            <div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
                <div class="col-xs-12" style="padding: 0px;">
                    <label for="ho" class="sr-only">계약코드</label>
                    <select class="form-control input-sm" name="cont_code" id="cont_code" onchange="submit();" <?php if( !$this->input->get('type')) echo "disabled"; ?>>
                        <option value="">선 택</option>
				        <?php foreach($cont_code_list as $lt) : ?>
                            <option value="<?php echo $lt->cont_code; ?>" <?php if($lt->cont_code==$this->input->get('cont_code')) echo "selected"; ?>><?php echo $lt->contractor."(".$lt->cont_code.")"; ?></option>
				        <?php endforeach; ?>
                    </select>
                </div>
            </div>
<?php endif ?>

<?php if($this->input->get('payer') && empty($now_payer)): ?>
			<div class="col-xs-12 col-sm-12 col-md-4" style="padding: 8px; 0">
				<div class="col-xs-12 center" style="padding-top: 5px;">조회 결과가 없습니다.</div>
			</div>
<?php elseif( !empty($now_payer)) :
	// 해지인 경우 red 스타일과 환불인 경우 Del 태그 만들기
	if($now_payer[0]->is_rescission>0) {$red_style = "style = 'color : red'"; } else {$red_style = ""; }
	if($now_payer[0]->is_rescission>1) {$del_op = "<del>"; $del_cl = "</del>";} else {$del_op = ""; $del_cl = "";}
 ?>
			<div class="col-xs-11 col-sm-11 col-md-3" style="padding: 12px 10px 6px; margin: 0;">


<?php
$ci = 0;
foreach($now_payer as $lt) :
	$cm = ($ci==0) ? "" : " / ";
 	$dong_ho = explode("-", $lt->unit_dong_ho);
 	$result_list = ($pj_now->data_cr=='1')
        ? $del_op.$cm."<a ".$red_style." href='".base_url('cms_m1/sales/2/2?yr='.$yr.'&project='.$project.'&payer='.$this->input->get('payer').'&dong='.$dong_ho[0].'&ho='.$dong_ho[1])."'>".$lt->contractor."(".$lt->unit_dong_ho.")</a>".$del_cl
        : $del_op.$cm."<a ".$red_style." href='".base_url('cms_m1/sales/2/2?yr='.$yr.'&project='.$project.'&payer='.$this->input->get('payer').'&type='.$lt->unit_type.'&cont_code='.$lt->cont_code)."'>".$lt->contractor."(".$lt->cont_code.")</a>".$del_cl;
 	echo $result_list;
	$ci+=1;
?>
<?php endforeach; ?>
			</div>
			<div class="col-xs-1" style="padding: 8px;">
				<button type="button" class="close" aria-label="Close" style="padding-left: 5px;" onclick="location.href='<?php echo base_url('cms_m1/sales/2/2?project='.$project.'&dong='.$dong_ho[0].'&ho='.$dong_ho[1]) ?>'"><span aria-hidden="true">&times;</span></button>
			</div>
<?php endif; ?>
		</div>
	</form>

	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-info" style="padding: 13px 20px; margin: 0;"><?php echo $contractor_info; ?>&nbsp;</p></div>
	</div>

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
<?php if($this->input->get('ho') OR $this->input->get('cont_code')) : ?>
                    <?php foreach($received as $lt):
	                    $paid_sche = $this->cms_main_model->sql_row(" SELECT pay_name, pay_disc FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' AND pay_code='$lt->pay_sche_code' ");
	                    $paid_acc_nick = $this->cms_main_model->sql_row(" SELECT acc_nick FROM cb_cms_sales_bank_acc WHERE pj_seq='$project' AND seq='$lt->paid_acc' ");
	                    $pay_name = ($paid_sche->pay_disc!=='') ?$paid_sche->pay_disc : $paid_sche->pay_name;

	                    // 해지인 경우 red 스타일과 환불인 경우 Del 태그 만들기
	                    if($cont_data->is_rescission>0) {$red_style = "style = 'color : red'"; } else {$red_style = ""; }
	                    if($cont_data->is_rescission>1) {$del_op = "<del>"; $del_cl = "</del>";} else {$del_op = ""; $del_cl = "";}

	                    $modi_pay_url = ($pj_now->data_cr=='1')
                            ? "?project={$project}&payer={$this->input->get('payer')}&dong={$this->input->get('dong')}&ho={$this->input->get('ho')}&modi=1&rec_seq={$lt->seq}"
                            : "?project={$project}&payer={$this->input->get('payer')}&type={$this->input->get('type')}&cont_code={$this->input->get('cont_code')}&modi=1&rec_seq={$lt->seq}";
                    ?>
						<tr style="background-color: #F9FAD9;">
							<td><?php echo $lt->paid_date; ?></td>
							<td><?php echo $pay_name; ?></td>
							<td class="right">
								<?php echo $del_op; ?>
                                    <a <?php echo $red_style; ?> href="<?php echo $modi_pay_url; ?>" data-toggle="tooltip" title="입력 내용 수정하기"><?php echo number_format($lt->paid_amount); ?></a>
								<?php echo $del_cl; ?>
							</td>
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

<?php
  $attributes = array('name' => 'form2');
  echo form_open(current_full_url(), $attributes);
?>
				<input type="hidden" name="modi" value="<?php echo $this->input->get('modi'); ?>">
				<input type="hidden" name="dong" value="<?php echo $this->input->get('dong'); ?>">
				<input type="hidden" name="ho" value="<?php echo $this->input->get('ho'); ?>">

                <input type="hidden" name="type" value="<?php echo $this->input->get('type'); ?>">
                <input type="hidden" name="cont_code" value="<?php echo $this->input->get('cont_code'); ?>">
            
<?php $cont_seq = ( !empty($cont_data)) ? $cont_data->seq : ""; // 계약 아이디 ?>
				<input type="hidden" name="cont_seq" value="<?php echo $cont_seq; ?>">
<?php $rec_seq = ( !empty($this->input->get('rec_seq'))) ? $this->input->get('rec_seq') : ""; // 수납 아이디 ?>
				<input type="hidden" name="rec_seq" value="<?php echo $rec_seq; ?>">
				<div class="row" style="margin: 0; padding: 0;">
					<div class="col-sm-12 bo-top" style="padding: 0;">
						<div class="col-xs-4 col-md-2 center bgfg" style="line-height:38px;">수납일자</div>
						<div class="col-xs-8 col-md-4" style="padding: 0;">
							<label for="paid_date" class="sr-only">수납일자</label>
							<div class="col-xs-12" style="padding: 4px;">
								<div class="input-group">
									<input type="text" name="paid_date" id="paid_date" class="form-control input-sm" value="<?php if($this->input->get('modi')=='1') echo $modi_rec->paid_date; else echo set_value('paid_date'); ?>" placeholder="입금일 (0000-00-00)" onclick="cal_add(this); event.cancelBubble=true">
									<span class="input-group-addon">
										<a href="javascript:" onclick="cal_add(document.getElementById('paid_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" style="margin: 0; padding: 0;">
					<div class="col-sm-12 bo-top" style="padding: 0;">
						<div class="col-xs-4 col-md-2 center bgfg" style="line-height:38px;">회차구분</div>
						<div class="col-xs-8 col-md-4" style="padding:  4px;">
							<label for="pay_sche_code" class="sr-only">회차구분</label>
							<select class="form-control input-sm" name="pay_sche_code">
								<option value="">납부회차</option>
<?php foreach ($pay_sche as $lt) :
	$pay_name = ($lt->pay_disc!=='') ? $lt->pay_disc : $lt->pay_name;
?>
								<option value="<?php echo $lt->pay_code; ?>" <?php if($this->input->get('modi')=='1' && $modi_rec->pay_sche_code==$lt->pay_code) echo "selected"; else echo set_select('pay_sche_code', $lt->pay_code); ?>><?php echo $pay_name; ?></option>
<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-4 col-md-2 center bgfg" style="line-height:38px;">수납금액</div>
						<div class="col-xs-8 col-md-4" style="padding: 4px;">
							<label for="paid_amount" class="sr-only">수납금액</label>
							<input type="number" class="form-control input-sm en_only" name="paid_amount" value="<?php if($this->input->get('modi')=='1') echo $modi_rec->paid_amount; else echo set_value('paid_amount'); ?>" onkeyPress ='iNum(this)'  placeholder="분담금 [단위:원]">
						</div>
					</div>
				</div>

				<div class="row" style="margin: 0; padding: 0;">
					<div class="col-sm-12 bo-top" style="padding: 0;">
						<div class="col-xs-4 col-md-2 center bgfg" style="line-height:38px;">수납계좌</div>
						<div class="col-xs-8 col-md-4" style="padding: 4px;">
							<label for="paid_acc" class="sr-only">수납계좌</label>
							<select class="form-control input-sm" name="paid_acc">
								<option value="">입금계좌</option>
<?php foreach ($paid_acc as $lt) : ?>
								<option value="<?php echo $lt->seq ?>" <?php if($this->input->get('modi')=='1' && $modi_rec->paid_acc==$lt->seq) echo "selected"; echo set_select('paid_acc', $lt->seq); ?>><?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-4 col-md-2 center bgfg" style="line-height:38px;">입 금 자</div>
						<div class="col-xs-8 col-md-4" style="padding: 4px;">
							<label for="paid_who" class="sr-only">입금자</label>
							<input type="text" class="form-control input-sm" name="paid_who" value="<?php if($this->input->get('modi')=='1') echo $modi_rec->paid_who; else echo set_value('paid_who'); ?>" placeholder="입금자">
						</div>
					</div>
				</div>

				<div class="row" style="margin: 0; padding: 0;">
					<div class="col-sm-12 bo-top  bo-bottom" style="padding: 0; margin-bottom: 20px;">
						<div class="col-xs-4 col-md-2 center bgfg" style="padding: 10px; height: 76px;">비 &nbsp;&nbsp;&nbsp;&nbsp;고</div>
						<div class="col-xs-8 col-md-10" style="padding: 0;">
							<label for="paid_date" class="sr-only">비 고</label>
							<div class="col-xs-12" style="padding: 4px;">
								<textarea class="form-control input-sm" id="note" name="note"  rows="3"><?php if($this->input->get('modi')=='1') echo $modi_rec->note; else echo set_value('note'); ?></textarea>
							</div>
						</div>
					</div>
				</div>

	<?php if( !$this->input->get('ho') && !$this->input->get('cont_code')) : ?>
				<div class="row">
					<div class="col-sm-12 center" style="padding: 70px 0  86px;"><?php echo validation_errors('<div class="error">', '</div>'); ?>등록할 계약 건을 선택하여 주세요.</div>
				</div>
	<?php endif; ?>
	<?php if($auth22<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="receive_chk();";} ?>
				<div class="form-group btn-wrap" style="margin: ;">
<?php if($this->input->get('modi')=='1') : ?>
          <input type="button" class="btn btn-warning btn-sm" onclick="location.href='<?php echo base_url('cms_m1/sales/2/2').'?modi=0&project='.$project.'&dong='.$this->input->get('dong').'&ho='.$this->input->get('ho'); ?>'"  value="뒤로 가기">


<?php   if(date('Y-m-d', strtotime('-3 day')) <= $modi_rec->reg_date) :?>
					<input type="button" class="btn btn-danger btn-sm" onclick="if(confirm('해당 수납 데이터를 삭제하시겠습니까?')===true) location.href='<?php echo base_url('cms_m1/sales/2/2').'?modi=0&project='.$project.'&dong='.$this->input->get('dong').'&ho='.$this->input->get('ho').'&del_code='.$this->input->get('rec_seq'); ?>'"  value="삭제 하기">
<?php   else : ?>
          <input type="button" class="btn btn-default btn-sm" onclick="alert('등록일 기준 3일 이내의 건에 한해서 삭제할 수 있습니다.\n등록일로부터 3일 이후의 건에 대한 삭제는 관리자에게 문의하여 주십시요.')"  value="삭제 하기">
<?php   endif; ?>

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
foreach($pay_sche as $lt) :
	$pay_name = ($lt->pay_disc!=='') ? $lt->pay_disc : $lt->pay_name;
	$due_date = "-";
	$compair = "-";

	if($lt->pay_time==1 && !empty($cont_data)) $due_date = $cont_data->cont_date; // 계약일자
	if($lt->pay_time==2 && !empty($cont_data)) $due_date = date('Y-m-d', strtotime($cont_data->cont_date."+1months")); // 계약 1개월 후
	if($lt->pay_time>2) $due_date = ($lt->pay_due_date=='0000-00-00') ? "-" :$lt->pay_due_date; // DB 기록 없는 경우

	if( !empty($cont_data)) {
		$ppsche = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS pps FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$cont_data->seq' AND pay_sche_code='$lt->pay_code' ");
		$paid_per_sche = (empty($ppsche->pps) OR $ppsche->pps=='0') ? "-" : number_format($ppsche->pps); // 수납금액
		$payment = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_payment WHERE pj_seq='$project' AND price_seq='$cont_data->price_seq' AND pay_sche_seq='$lt->seq' "); // 약정금액
		$col = ($ppsche->pps-$payment->payment<0) ? "#A80505" : "#0427A4";
		$compair = ($ppsche->pps-$payment->payment===0) ? "-" : number_format($ppsche->pps-$payment->payment);
	}

?>
						<tr class="<?php if(empty($cont_data)) echo "active"; ?>">
							<td style="color: <?php if(date('Y-m-d')>$due_date) echo '#d00202' ?>;"><?php echo $due_date; ?></td>
							<td><?php echo $pay_name; ?></td>
							<td class="right"><?php if( !empty($payment))echo number_format($payment->payment); ?></td>
							<td class="right" style="color: #0427A4;"><?php if( !empty($ppsche)) echo $paid_per_sche; ?></td>
							<td class="right" style="color: <?php if( !empty($ppsche)) echo $col; ?>;">
								<?php if(( !empty($ppsche) && $lt->pay_code<3) OR !empty($due_date)) echo $compair; ?>
							</td>
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
<?php endif ?>
