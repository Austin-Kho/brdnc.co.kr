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
        <div class="col-md-12"><h4><span class="label label-info">1. 요약 집계</span></h4></div>
<?php if(empty($all_pj)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">조회할 프로젝트를 선택하여 주십시요.</div>
<?php // elseif($all_pj && empty($tp_name)) : ?>
		<!-- <div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">등록된 데이터가 없습니다.</div> -->
<?php else : ?>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed">
				<thead class="bo-top center bgf8">
					<tr>
						<td width="10%">프로젝트명</td>
						<td width="10%">계약금1차</td>
						<td width="10%">업무대행비1차</td>
						<td width="10%">계약금2차</td>
						<td width="10%">업무대행비2차</td>
						<td width="10%">토지분담금1차</td>
						<td width="10%">토지분담금2차</td>
						<td width="10%">중도금1차</td>
						<!-- <td width="10%">중도금2차</td>
						<td width="10%">중도금3차</td>
						<td width="10%">중도금4차</td>
						<td width="10%">중도금5차</td>
						<td width="10%">중도금6차</td>
						<td width="10%">중도금7차</td>
						<td width="10%">잔 금</td> -->
					</tr>
				</thead>
				<tbody class="bo-bottom center">

					<tr>
						<?php //echo $first_td; ?>
						<td rowspan="4" style="background-color: ;">1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
<?php for($i=0; $i<3; $i++): ?>
					<tr>
						<?php //echo $first_td; ?>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
<?php endfor; ?>
				</tbody>
				<tfoot class="right bgf8">
					<tr>
						<td class="center">합 계</td>
						<td></td>
						<td></td>
						<td></td>
						<td style="color: #273169; font-weight: bold;"></td>
						<td style="color: #a60202; font-weight: bold;"></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed">
				<thead class="bo-top center bgf8">
					<tr>
						<td width="10%">프로젝트명</td>
						<!-- <td width="10%">계약금1차</td>
						<td width="10%">업무대행비1차</td>
						<td width="10%">계약금2차</td>
						<td width="10%">업무대행비2차</td>
						<td width="10%">토지분담금1차</td>
						<td width="10%">토지분담금2차</td>
						<td width="10%">중도금1차</td> -->
						<td width="10%">중도금2차</td>
						<td width="10%">중도금3차</td>
						<td width="10%">중도금4차</td>
						<td width="10%">중도금5차</td>
						<td width="10%">중도금6차</td>
						<td width="10%">중도금7차</td>
						<td width="10%">잔 금</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">

					<tr>
						<?php //echo $first_td; ?>
						<td rowspan="4" style="background-color: ;">1</td>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
<?php for($i=0; $i<3; $i++): ?>
					<tr>
						<?php //echo $first_td; ?>
						<td style="background-color: ;">1</td>
						<td class="right"></td>
						<td class="right"></td>
						<td class="right" style="color: #273169;"></td>
						<td class="right" style="color: #a60202;"></td>
						<td class="right"></td>
						<td class="right"></td>
					</tr>
<?php endfor; ?>
				</tbody>
				<tfoot class="right bgf8">
					<tr>
						<td class="center">합 계</td>
						<td></td>
						<td></td>
						<td></td>
						<td style="color: #273169; font-weight: bold;"></td>
						<td style="color: #a60202; font-weight: bold;"></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</table>
		</div>
<?php endif; ?>
    </div>
