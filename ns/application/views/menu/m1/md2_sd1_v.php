    <div class="main_start">&nbsp;</div>
	<!-- 1. 분양관리 -> 2. 수납 관리 ->1. 수납 현황 -->
	<script type="text/javascript">
		function term_put(a,b,term){
			if(term=='d')var term="<?php echo date('Y-m-d'); ?>";
			if(term=='w')var term="<?php echo date('Y-m-d',strtotime ('-1 weeks'));?>";
			if(term=='m')var term="<?php echo date('Y-m-d',strtotime ('-1 months'));?>";
			if(term=='3m')var term="<?php echo date('Y-m-d',strtotime ('-3 months'));?>";
			document.getElementById(a).value = term;
			document.getElementById(b).value = "<?php echo date('Y-m-d');?>";
		}
	</script>

	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
		<form method="get" name="pj_sel" action="<?php echo current_url(); ?>">

			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
			<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-8" style="padding: 0px;">
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
			<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-8" style="padding: 0px;">
					<label for="project" class="sr-only">프로젝트 선택</label>
					<select class="form-control input-sm" name="project" onchange="submit();">
						<option value="0"> 전 체
<?php foreach($all_pj as $lt) : ?>
						<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
<?php endforeach; ?>
					</select>
				</div>
			</div>
		</form>
	</div>

	<div class="row font12" style="margin: 0; padding: 0;">
        <div class="col-xs-5 col-sm-7 col-md-9"><h4><span class="label label-info">요약 집계</span></h4></div>
		<div class="col-xs-3 col-sm-2 col-md-1"><a href="javascript:" onclick="popUp_size('<?php echo base_url('popup/sales_receive?p=').$project; ?>', '약정별 수납현황', 1500, 800);"><h5><span class="label label-default">약정별 수납현황</span></h5></a></div>
		<div class="col-xs-3 col-sm-2 col-md-1"><a href="javascript:" onclick="popUp_size('<?php echo base_url('popup/sales_total_table?p=').$project; ?>', '총괄 집계현황', 1500, 800);"><h5><span class="label label-default">총 괄 집 계 현 황</span></h5></a></div>


<?php if(empty($all_pj)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">조회할 프로젝트를 선택하여 주십시요.</div>
<?php elseif($all_pj && empty($rec_data)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">등록된 데이터가 없습니다.</div>
<?php else : ?>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed">
				<thead>
					<tr class= "active center">
						<td>프로젝트 명</td>
						<td>총 매출액</td>
						<td>분양금액</td>
						<td>수납금액</td>
						<td>할인금액</td>
						<td>연체금액</td>
						<td>실수납금액</td>
						<td>미수금액</td>
					</tr>
				</thead>
<?php $com_fac = 2400640000; // 상가 매출액?>
				<tbody>
					<tr class="active right">
						<td class="left"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> 동춘1구역지역주택조합</td>
						<td style="font-weight: bold;"><?php echo number_format($total_pmt->total+$com_fac); ?></td>
						<td style="font-weight: bold;"><?php echo number_format($sell_data->sell_total); ?></td>
						<td style="font-weight: bold; color: #060EC8;"><?php echo number_format($rec_data->rec_total); ?></td>
						<td style="font-weight: bold; color: #C30505;">-</td>
						<td style="font-weight: bold; color: #060EC8;">-</td>
						<td style="font-weight: bold; color: #060EC8;"><?php echo number_format($rec_data->rec_total); ?></td>
						<td style="font-weight: bold; color: #C30505;"><?php echo number_format($sell_data->sell_total-$rec_data->rec_total); ?></td>
					</tr>
					<tr class="right">
						<td class="left" style="padding-left: 20px;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 아파트</td>
						<td><?php echo number_format($total_pmt->total); ?></td>
						<td><?php echo number_format($sell_data->sell_total); ?></td>
						<td style="color: #060EC8;"><?php echo number_format($rec_data->rec_total); ?></td>
						<td style="color: #C30505;">-</td>
						<td style="color: #060EC8;">-</td>
						<td style="color: #060EC8;"><?php echo number_format($rec_data->rec_total); ?></td>
						<td style="color: #C30505;"><?php echo number_format($sell_data->sell_total-$rec_data->rec_total); ?></td>
					</tr>
					<tr class="right">
						<td class="left" style="padding-left: 20px;"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> 단지내상가</td>
						<td><?php echo number_format($com_fac); ?></td>
						<td>-</td>
						<td style="color: #060EC8;">-</td>
						<td style="color: #C30505;">-</td>
						<td style="color: #060EC8;">-</td>
						<td style="color: #060EC8;">-</td>
						<td style="color: #C30505;">-</td>
					</tr>
				</tbody>
			</table>
		</div>
<?php endif; ?>
    </div>

	<div class="row font12" style="margin: 0; padding: 0;">
        <div class="col-md-12"><h4><span class="label label-success">최근 수납현황</span></h4></div>
		<div class="col-md-12 bo-top bo-bottom" style="padding: 0; margin: 0 0 20px 0;">
<?php
$attributes = array('name' => 'form1', 'method' => 'get');
echo form_open(base_url(uri_string()), $attributes);
?>
				<div class="col-xs-12 col-sm-2 col-md-1 center bgf8" style="height: 40px; padding: 10px 0;">검색 조건</div>
				<div class="col-xs-6 col-sm-2 col-md-1" style="height: 40px; padding: 5px;">
					<label for="con_pay_sche" class="sr-only">회차별</label>
					<select class="form-control input-sm" name="con_pay_sche">
						<option value=""> 회차 전체</option>
<?php foreach($pay_sche as $lt) : ?>
						<option value="<?php echo $lt->pay_code; ?>" <?php if($lt->pay_code == $this->input->get('con_pay_sche')) echo "selected"; ?>> <?php echo $lt->pay_name; ?></option>
<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-1" style="height: 40px; padding: 5px;">
					<label for="con_paid_acc" class="sr-only">계좌별</label>
					<select class="form-control input-sm" name="con_paid_acc">
						<option value=""> 계좌 전체</option>
<?php foreach($paid_acc as $lt) : ?>
						<option value="<?php echo $lt->seq; ?>" <?php if($lt->seq==$this->input->get('con_paid_acc')) echo "selected"; ?>> <?php echo $lt->acc_nick; ?></option>
<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-2" style="height: 40px; padding: 5px;">
					<div class="alert alert-info right" role="alert" style="padding: 6px;"><?php echo "수납 합계 : ".number_format($rec->total_amount)." 원" ?></div>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-1 center bgf8" style="height: 40px; padding: 10px 0;">수납 기간</div>
				<div class="col-xs-12 col-sm-6 col-md-3" style="height: 40px; padding: 5px 0 0 5px;">
					<div class="col-xs-5 col-sm-5" style="padding: 0px;">
						<label for="s_date" class="sr-only">시작일</label>
						<input type="text" class="form-control input-sm wid-95" id="s_date" name="s_date" maxlength="10" value="<?php if($this->input->get('s_date')) echo $this->input->get('s_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="시작일">
					</div>
					<div class="col-xs-1 col-sm-1 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('s_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
					</div>
					<div class="col-xs-5 col-sm-5" style="padding: 0px;">
						<label for="e_date" class="sr-only">종료일</label>
						<input type="text" class="form-control input-sm wid-95" id="e_date" name="e_date" maxlength="10" value="<?php if($this->input->get('e_date')) echo $this->input->get('e_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="종료일">
					</div>
					<div class="col-xs-1 col-sm-1 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('e_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
					</div>
				</div>
				<div class="col-xs-10 col-sm-4 col-md-2" style="height: 40px; padding: 10px 5px; text-align: right;">
					<a href="javascript:" onclick="term_put('s_date', 'e_date', 'd');" title="오늘"><img src="<?php echo base_url(); ?>static/img/to_today.jpg" alt="오늘"></a>
					<a href="javascript:" onclick="term_put('s_date', 'e_date', 'w');" title="일주일"><img src="<?php echo base_url(); ?>static/img/to_week.jpg" alt="일주일"></a>
					<a href="javascript:" onclick="term_put('s_date', 'e_date', 'm');" title="1개월"><img src="<?php echo base_url(); ?>static/img/to_month.jpg" alt="1개월"></a>
					<a href="javascript:" onclick="term_put('s_date', 'e_date', '3m');" title="3개월"><img src="<?php echo base_url(); ?>static/img/to_3month.jpg" alt="3개월"></a>
					<button type="button" class="close" aria-label="Close" style="padding-left: 5px;" onclick="document.getElementById('s_date').value=''; document.getElementById('e_date').value='';"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-1 center" style="height: 40px; padding: 5px;">
					<input type="button" value="검 색" class="btn btn-info btn-sm" onclick="submit();">
				</div>
			</form>
		</div>




		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed">
				<thead>
					<tr class= "active center">
						<td>수납일자</td>
						<td>수납금액</td>
						<td>입금자</td>
						<td>납입회차</td>
						<td>입금계좌</td>
						<td>당 건 총입금액</td>
						<td>타입</td>
						<td>동호수</td>
					</tr>
				</thead>
				<tbody>
<?php
$tp = $this->main_m->sql_row("SELECT type_name, type_color FROM cms_project WHERE seq='$project' ");
$tn = explode("-", $tp->type_name);
$tc = explode("-", $tp->type_color);

for($i=0; $i<count($tn); $i++) :
	$type_color[$tn[$i]] = $tc[$i];
endfor;

foreach($rec_list as $lt) :
	$dong_ho = explode("-", $lt->unit_dong_ho);
	$total_rec = $this->main_m->sql_row(" SELECT SUM(paid_amount) AS pa FROM cms_sales_received WHERE pj_seq='$project' AND cont_seq='$lt->cont_seq' GROUP BY cont_seq ");
?>
					<tr class="center">
						<td><?php echo $lt->paid_date; ?></td>
						<td class="right"><a href="<?php echo  base_url('m1/sales/2/2').'?modi=1&project='.$project.'&dong='.$dong_ho[0].'&ho='.$dong_ho[1].'&rec_seq='.$lt->seq; ?>"><?php echo number_format($lt->paid_amount); ?></a></td>
						<td><?php echo $lt->paid_who; ?></td>
						<td><?php echo $lt->pay_name; ?></td>
						<td><?php echo $lt->acc_nick; ?></td>
						<td class="right"><a href="<?php echo  base_url('m1/sales/2/2').'?modi=1&project='.$project.'&dong='.$dong_ho[0].'&ho='.$dong_ho[1].'&rec_seq='.$lt->seq; ?>"><?php echo number_format($total_rec->pa); ?></a></td>
						<td class="left"><span style="background-color: <?php echo $type_color[$lt->unit_type]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $lt->unit_type; ?></td>
						<td><a href="<?php echo base_url('m1/sales/1/2')."?mode=1&cont_sort1=1&cont_sort2=2&project=".$project."&type=".$lt->unit_type."&dong=".$dong_ho[0]."&ho=".$dong_ho[1]; ?>"><?php echo $lt->unit_dong_ho; ?></a></td>
					</tr>
<?php endforeach; ?>
				</tbody>
			</table>
		</div>
<?php if(empty($rec_list)) :  ?>
		<div class="col-xs-12 center" style="margin-top: 0px; padding: 80px 0;">등록된 데이터가 없습니다.</div>
<?php endif; ?>
		<div class="col-xs-12 center" style="margin-top: 0px; padding: 0;">
			<ul class="pagination pagination-sm"><?php echo $pagination; ?></ul>
		</div>
	</div>
