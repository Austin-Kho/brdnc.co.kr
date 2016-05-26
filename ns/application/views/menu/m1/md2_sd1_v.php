    <div class="main_start">&nbsp;</div>
	<!-- 1. 분양관리 -> 2. 수납 관리 ->1. 수납 현황 -->

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
        <div class="col-md-12" style="padding: 0;">
			<div class="col-xs-2"><h4><span class="label label-info">1. 수납현황</span></h4></div>
			<div class="col-xs-1"><h4><span class="label label-default">월 별</span></h4></div>
			<div class="col-xs-1"><h4><span class="label label-default">일 별</span></h4></div>
		</div>
<?php if(empty($all_pj)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">조회할 프로젝트를 선택하여 주십시요.</div>
<?php // elseif($all_pj && empty($tp_name)) : ?>
		<!-- <div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">등록된 데이터가 없습니다.</div> -->
<?php else : ?>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed font10">
				<thead class="bo-top center bgf8">
					<tr>
						<td width="7%">구 분</td>
						<td width="7%">계약금1차</td>
						<td width="7%">계약금2차</td>
						<td width="7%">토지분담1차</td>
						<td width="7%">토지분담2차</td>
						<td width="7%">중도금1차</td>
						<td width="7%">중도금2차</td>
						<td width="7%">중도금3차</td>
						<td width="7%">중도금4차</td>
						<td width="7%">중도금5차</td>
						<td width="7%">중도금6차</td>
						<td width="7%">중도금7차</td>
						<td width="7%">잔 금</td>
						<td width="9%">계</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">

					<tr class="right">
						<td class="center">총분양금</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>9,391,820,000</td>
						<td>187,729,340,000</td>
					</tr>
<?php for($i=0; $i<8; $i++):
	if($i==0) $sub = "미분양금";
	if($i==1) $sub = "할인료";
	if($i>1 OR $i<6) $sub = "2016-05";
	if($i==6) $sub = "연체료";
	if($i==7) $sub = "수납금액";
	if($i==8) $sub = "미수금";
?>
					<tr class="right">
						<td class="center"><?php echo $sub; ?></td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td>9,391,820,000</td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
<?php endfor; ?>
				</tbody>
				<tfoot class="right bgf8">
					<tr class="right">
						<td class="center">합 계</td>
						<td></td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td></td>
						<td></td>
						<td>9,391,820,000</td>
						<td></td>
						<td style="color: #273169; font-weight: bold;"></td>
						<td style="color: #a60202; font-weight: bold;"></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="col-md-12" style="padding: 0;">
			<div class="col-xs-2"><h4><span class="label label-info">2. 총괄집계표</span></h4></div>
		</div>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed font10">
				<thead class="bo-top center bgf8">
					<tr>
						<td width="9%" colspan="3">구 분</td>
						<td width="7%">계약금1차</td>
						<td width="7%">계약금2차</td>
						<td width="7%">토지분담1차</td>
						<td width="7%">토지분담2차</td>
						<td width="7%">중도금1차</td>
						<td width="7%">중도금2차</td>
						<td width="7%">중도금3차</td>
						<td width="7%">중도금4차</td>
						<td width="7%">중도금5차</td>
						<td width="7%">중도금6차</td>
						<td width="7%">중도금7차</td>
						<td width="7%">잔 금</td>
						<td width="7%">계</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">

					<tr class="right">
						<td class="center" colspan="3">기본약정일</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td>187,729,340,000</td>
					</tr>
					<tr class="right">
						<td class="center" rowspan="4" width="2%">분양</td>
						<td class="center" colspan='2'>분양 ( 496 )</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>미분양 ( 100 )</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>총계 ( 596 )</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>분양율</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" rowspan="5">입금</td>
						<td class="center" colspan='2'>입금액</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>할인액</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>연체료</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>실수납액</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>납입율</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" rowspan="8">미수금</td>
						<td class="center" rowspan="5" width="2%">기간도래</td>
						<td class="center">약정금액</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center">미수금</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center">미수율</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center">연체료</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center">소 계</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>기간미도래</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>총 계</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
					<tr class="right">
						<td class="center" colspan='2'>총미수율</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
				</tbody>
			</table>

		</div>
<?php endif; ?>
    </div>
