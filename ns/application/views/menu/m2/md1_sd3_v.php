<div class="main_start">&nbsp;</div>
<!-- 2. 사업관리 -> 1. 예산집행 관리 ->3. 수지 관리 -->

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

<div class="row">
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="text-align: center; background-color:#BDD5FE;">사 업 명</th>
					<th colspan="4">동춘1구역지역주택조합 공동주택사업 수지표</th>
					<th colspan="2" style="font-weight: lighter; font-size: 5pt">조건: </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="background-color:#ECF2FB;">부지대표지번</td>
					<td colspan="5">인천광역시 동춘1구역 도시개발사업지구 공동주택지 9블럭</td>
					<td style="text-align:right;">(단위 : 천원, ㎡, 평)</td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">매입면적(토지)</td>
					<td style="text-align: right;">30,842.00 ㎡</td>
					<td style="text-align: right;">9,329.71 평</td>
					<td style="background-color:#ECF2FB;">용도지역(지구)</td>
					<td>제2종 일반주거</td>
					<td style="background-color:#ECF2FB;">용적율</td>
					<td style="text-align: right;">208.38%</td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">기부면적(도로 등)</td>
					<td style="text-align: right;">- ㎡</td>
					<td style="text-align: right;">- 평</td>
					<td style="background-color:#ECF2FB;">토지평단가</td>
					<td style="text-align: right;">6,230</td>
					<td style="background-color:#ECF2FB;">건폐율</td>
					<td style="text-align: right;">15.17%</td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">유휴면적(토지)</td>
					<td style="text-align: right;">- ㎡</td>
					<td></td>
					<td style="background-color:#ECF2FB;">건축비(평당)</td>
					<td style="text-align: right;">3,500</td>
					<td style="background-color:#ECF2FB;">PF 대출액</td>
					<td style="text-align: right;"></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">사업면적(토지)</td>
					<td style="text-align: right;">30,842.00 ㎡</td>
					<td style="text-align: right;">9,329.71 평</td>
					<td style="background-color:#ECF2FB;">평당분양가(평균)</td>
					<td style="text-align: right;">9,727</td>
					<td style="background-color:#ECF2FB;">PF율(토지비 대비)</td>
					<td style="text-align: right;">0.00%</td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">기부면적(도로 등)</td>
					<td></td>
					<td></td>
					<td style="background-color:#ECF2FB;">토지평단가</td>
					<td></td>
					<td style="background-color:#ECF2FB;">건폐율</td>
					<td></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">기부면적(도로 등)</td>
					<td></td>
					<td></td>
					<td style="background-color:#ECF2FB;">토지평단가</td>
					<td></td>
					<td style="background-color:#ECF2FB;">건폐율</td>
					<td></td>
				</tr>
			</tbody>
		</table>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th colspan="5" style="text-align: center; background-color:#BDD5FE;">구 분</th>
					<th style="text-align: center; background-color:#BDD5FE;">금 액</th>
					<th style="text-align: center; background-color:#BDD5FE;">산 출 내 역</th>
					<th style="text-align: center; background-color:#BDD5FE;">비 고</th>
					<th style="text-align: center; background-color:#BDD5FE;">비 율</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>ㅁ</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
