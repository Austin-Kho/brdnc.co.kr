	<div class="row font12" style="margin: 0; padding: 0;">
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
		<?php if(empty($all_pj)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">조회할 프로젝트를 선택하여 주십시요.</div>
		<?php // elseif($all_pj && empty($tp_name)) : ?>
		<!-- <div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">등록된 데이터가 없습니다.</div> -->
		<?php else : ?>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed font12">
				<thead class="bo-top center bgf8">
					<tr>
						<td>구 분</td>
		<?php for($i=0; $i<count($pay_sche); $i++): ?>
						<td><?php echo $pay_sche[$i]->pay_name; ?></td>
		<?php endfor; ?>
						<td>계</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">

					<tr class="right" style="background-color: #F0FCCE;">
						<td class="center">총 분양금</td>
		<?php
		for($i=0; $i<count($pay_sche); $i++) :
		$sche_sum = 0;
		foreach($price as $lt) : // 조건 루프
		$cont_sche_pay = $this->main_m->sql_row(" SELECT payment FROM cms_sales_payment WHERE pj_seq='$project' AND price_seq='".$lt->seq."' AND pay_sche_seq='".$pay_sche[$i]->seq."' ");
		$cont_num = $this->main_m->sql_row(" SELECT COUNT(seq) AS num FROM cms_sales_contract WHERE price_seq='".$lt->seq."' "); // 가격조건별 계약건수
		$sche_sum += $cont_sche_pay->payment*$cont_num->num;
		endforeach;
		?>
						<td><?php echo number_format($sche_sum); ?></td>
		<?php endfor; ?>
						<td><?php echo number_format($total_sum); ?></td>
					</tr>

		<?php for($j=0; $j<9; $j++):
		if($j==0) $sub = "미 분양금";
		if($j==1) $sub = "할인료";
		if($j>1 && $j<6) {$sub = "2016-05"; $bgcol = "";} else {$bgcol = "style='background-color: #F0FCCE;'";}
		if($j==6) $sub = "연체료";
		if($j==7) $sub = "수납금액";
		if($j==8) $sub = "미수금";
		// 계약세대 회차별 납부 총액
		//$data['yc_total_per_sche'] = $this->main_m->sql_result(" SELECT * FROM ");
		// 미계약 세대 회차별 납부 총액
		//$data['nc_total_per_sche'] = $this->main_m->sql_result();
		?>
					<tr class="right" <?php echo $bgcol; ?>>
						<td class="center"><?php echo $sub; ?></td>
		<?php for($i=0; $i<count($pay_sche); $i++): ?>
						<td><?php //echo $pay_sche[$i]->pay_name; ?></td>
		<?php endfor; ?>
						<td class="right"><?php //echo number_format($total_sum); ?></td>
					</tr>
		<?php endfor; ?>
				</tbody>
				<tfoot class="right bgf8">
					<tr class="right">
						<td class="center">합 계</td>
		<?php for($i=0; $i<count($pay_sche); $i++): ?>
						<td><?php //echo $pay_sche[$i]->pay_name; ?></td>
		<?php endfor; ?>
						<td>9,391,820,000</td>
					</tr>
				</tfoot>
			</table>
		</div>
<?php endif; ?>
	</div>
