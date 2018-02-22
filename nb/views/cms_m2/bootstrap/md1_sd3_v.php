<?php
if($auth13<1) :
	include('no_auth.php');
else :
?>
<div class="main_start">
<!-- 2. 사업관리 -> 1. 예산 관리 ->3. 수지 예산안 -->
	<a href="<?php echo "javascript:alert('준비 중..입니다!')"; ?>">
		<img src="<?php echo base_url('static/img/excel_icon.jpg'); ?>" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
	</a>
</div>

<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
<?php
	$attributes = array('method' => 'get', 'name' => 'pj_sel');
	echo form_open(current_url(), $attributes);
?>
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
	<div class="col-md-12 table-responsive">
		<table class="table table-bordered table-hover font12">
			<thead>
				<tr>
					<th style="background-color:#BDD5FE; vertical-align: middle;" width="15%" height="50px">사 업 명</th>
					<th colspan="3" style="background-color:#fcf3e4; vertical-align: middle;"><?php echo $pj_info->pj_name." 사업 수지표"; ?></th>
					<th colspan="3" style="font-weight: lighter; font-size: 8pt; vertical-align: middle;"><div class=""><input type="text" class="form-control input-sm" name="" value="조건 : 당사예상, 발코니 확장비 포함, 중도금 후불제(일반=무이자)"></div></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="background-color:#ECF2FB;">부지주소(대표지번)</td>
					<td colspan="5"><?php echo str_replace('|', ' ', $pj_info->local_addr); ?></td>
					<td style="text-align:right;">(단위 : 천원, ㎡, 평)</td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">매입면적(토지)</td>
					<td style="text-align: right;" width="14%"><?php echo number_format($pj_info->buy_land_extent, 2).' ㎡'; ?></td>
					<td style="text-align: right;" width="11%"><?php echo number_format($pj_info->buy_land_extent*0.3025, 2).' 평'; ?></td>
					<td style="background-color:#ECF2FB;" width="15%">용도지역(지구)</td>
					<td width="15%"><?php echo $pj_info->area_usage; ?></td>
					<td style="background-color:#ECF2FB;" width="15%">용적율</td>
					<td style="text-align: right;" width="15%"><?php echo $pj_info->floor_ar_rat."%"; ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">기부면적(도로 등)</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->donation_land_extent, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_info->donation_land_extent*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">토지평단가</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->land_cost/($pj_info->buy_land_extent*0.3025)) ?></td>
					<td style="background-color:#ECF2FB;">건폐율</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->bu_to_la_rat, 2)."%" ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">유휴면적(토지)</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->buy_land_extent-$pj_info->donation_land_extent-$pj_info->scheme_land_extent, 2)." ㎡" ?></td>
					<td style="text-align: right;"><?php echo number_format(($pj_info->buy_land_extent-$pj_info->donation_land_extent-$pj_info->scheme_land_extent)*0.3025, 2)." 평" ?></td>
					<td style="background-color:#ECF2FB;">건축비(평당)</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->build_cost); ?></td>
					<td style="background-color:#ECF2FB;">PF 대출액</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->bridge_loan+$pj_info->pf_loan); ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">사업면적(토지)</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->scheme_land_extent, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_info->scheme_land_extent*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">평당분양가(평균)</td>
					<td style="text-align: right;"></td>
					<td style="background-color:#ECF2FB;">PF율(토지비 대비)</td>
					<td style="text-align: right;"><?php echo number_format(($pj_info->bridge_loan+$pj_info->pf_loan)/$pj_info->land_cost*100, 2)."%"; ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">전체연면적(건물)</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->gr_floor_area, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_info->gr_floor_area*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">건축규모</td>
					<td><?php echo $pj_info->build_size; ?></td>
					<td style="background-color:#ECF2FB;">PF 수수료</td>
					<td style="text-align: right;"></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">지상연면적(건물)</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->on_floor_area, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_info->on_floor_area*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">세 대 수</td>
					<td style="text-align: right;"><?php echo number_format($pj_info->num_unit); ?></td>
					<td style="background-color:#ECF2FB;">PF 이자율</td>
					<td style="text-align: right;"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-md-12 table-responsive">
		<table class="table table-bordered table-condensed table-hover font12">
			<thead>
				<tr>
					<th colspan="4" style="text-align: center; background-color:#BDD5FE;" width="20%">구 분</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="15%">금 액</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="40%">산 출 내 역</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="20%">비 고</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="5%">비 율</th>
				</tr>
			</thead>
			<tbody>
<?php
	$apt_type_row = (count($diff)*(count($type)+1)+1);
	$store_type_row = 1+1;
	$income_title_row = (count($diff)*(count($type)+1))+$store_type_row+2;

	for($i=0; $i<$income_title_row; $i++) :
		echo "<tr>";
		for($j=0; $j<8; $j++):

			if($j==0){ // 수입 지출 구분 열
				// 1열 1행
				if($i==0) {$td_html = "<td style='text-align:center; vertical-align:middle; background-color:#eaecf1;' rowspan='".$income_title_row."'>수<br/><br/><br/>입</td>"; }else{ $td_html = ""; }
			}elseif($j==1){
				// 2열 1행
				if($i==0){$td_html = "<td style='text-align:center; vertical-align:middle; background-color:#f1f5fc;' rowspan='".($apt_type_row)."'>공<br/>동<br/>주<br/>택</td>";
				// 상가 시작행
				}elseif($i==$apt_type_row) {$td_html = "<td style='text-align:center; vertical-align:middle; background-color:#f1f5fc;' rowspan='".$store_type_row."'>상<br/>가</td>";
				// 총계 행
				}elseif($i>$apt_type_row+1){ $td_html="<td style='text-align:center; background-color:#eaecf1;' colspan='3'>총 계</td>";
				}else{ $td_html=""; }

			}elseif($j==2){ // 건축 공종 구분 열
				// 공동주택 행
				if($i<$apt_type_row-1){
					if($i%(count($type)+1)==0){ $td_html = "<td style='text-align:center; vertical-align:middle;' rowspan='".(count($type)+1)."'>".mb_substr($diff[$i%count($type)]->diff_name, 0, 2)."</td>";
					}else{ $td_html = ""; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
					$td_html = "<td style='text-align:center; background-color:#f1f5fc;' colspan='2'>합 계</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
					$td_html = "<td style='text-align:center; background-color:#f1f5fc;' colspan='2'>합 계</td>";
				// 상가 타입 행
				}elseif($i!==$income_title_row-1){ $td_html = "<td style='text-align:center;' colspan='2'>1층</td>";
				}else{ $td_html = ""; }

			}elseif($j==3){ // 차수 구분 열
				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $td_html = "<td style='text-align:center;'>".$type[$i%(count($type)+1)]."</td>";
					// 타입 소계 행
					}else{ $td_html = "<td style='text-align:center; background-color:#f6f8fc;'>소 계</td>"; }
				}else{ $td_html = ""; }

			}elseif($j==4){ // 금액 열
				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $td_html = "<td style='text-align:right;'>".number_format(234234)."</td>";
					// 타입 소계 행
					}else{ $td_html = "<td style='text-align:right; background-color:#f6f8fc;'>".number_format(234234)."</td>"; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".number_format(234234)."</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".number_format(234234)."</td>";
				// 상가 타입 행
				}elseif($i !==$income_title_row-1){ $td_html = "<td style='text-align:right;'>".number_format(234234)."</td>";
				// 총계 행
				}else{ $td_html = "<td style='text-align:right; background-color:#eaecf1;'><strong>".number_format(234234)."</strong></td>"; }

			}elseif($j==5){ // 산출근거 열
				if($i<count($diff)*(count($type)+1)){
					$a_sup = $area_sup[$i%(count($type)+1)]*0.3025;
					$sum += $a; // 해당차수 총 세대수
					$a = 100;   // 해당차수 타입별 세대수
					$per_py = 1000;
					$total_sum = $a_sup*$a*$per_py;
					$unit_price = $a_sup*$per_py;
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $td_html = "<td style='padding-left:30px;'>"." ".number_format($a_sup, 2)." 평형&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp; ".($a)." 세대&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp; ".$per_py." 천원"."</td>";
					// 타입 소계 행
					}else{ $td_html = "<td style='padding-left:30px; background-color:#f6f8fc;'>"."분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; 0,000.00 평&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (".($sum)." 세대)"."</td>"; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>"."분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; 0,000.00 평&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (000 세대)"."</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>"."분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; 0,000.00 평"."</td>";
				// 상가 타입 행
				}elseif($i !==$income_title_row-1){ $td_html = "<td style='padding-left:30px;'>"."000.00 평&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp; 0,000 천원"."</td>";
				// 총계 행
				}else{ $td_html = "<td style='padding-left:30px; background-color:#eaecf1;'>"."총 분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; 0,000.00 평"."</td>"; }

			}elseif($j==6){ // 비고 열
				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $td_html = "<td style='padding-left:30px;'> 세대가격&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".number_format($unit_price)."</td>";
					// 타입 소계 행
					}else{ $td_html = "<td style='padding-left:30px; background-color:#f6f8fc;'>&nbsp;</td>"; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>&nbsp;</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>&nbsp;</td>";
				// 상가 타입 행
				}elseif($i !==$income_title_row-1){ $td_html = "<td style='padding-left:30px;'>&nbsp;</td>";
				// 총계 행
				}else{ $td_html = "<td style='padding-left:30px; background-color:#eaecf1;'>&nbsp;</td>"; }

			}elseif($j==7){ // 비율 열
				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $td_html = "<td style='text-align:right;'>".'00.0%'."</td>";
					// 타입 소계 행
				}else{ $td_html = "<td style='text-align:right; background-color:#f6f8fc;'>".'00.0%'."</td>"; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".'00.0%'."</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".'00.0%'."</td>";
				// 상가 타입 행
				}elseif($i !==$income_title_row-1){ $td_html = "<td style='text-align:right;'>".'00.0%'."</td>";
				// 총계 행
				}else{ $td_html = "<td style='text-align:right; background-color:#eaecf1;'>".'100.0%'."</td>"; }
			}else {
				$td_html = "<td>&nbsp;</td>"; 
			}

			echo $td_html;

		endfor;
		echo "</tr>";
	endfor;
?>
				<tr><td colspan="8"></td></tr>
<?php for($k=0; $k<47; $k++) : ?>
				<tr>
					<td style="background-color:#eaecf1;">&nbsp;</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
<?php endfor; ?>
			</tbody>
		</table>
	</div>
</div>
<?php endif ?>
