<?php
if($auth23<1) :
	include('no_auth.php');
else :
	if($auth23<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="if(confirm('새로운 예산항목을 등록하시겠습니까?')===true) submit();";}
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
	echo form_open(current_full_url(), $attributes);
?>
		<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">사업 개시년도</div>
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
		<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">프로젝트 선택 </div>
		<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
			<div class="col-xs-12 col-sm-8" style="padding: 0px;">
				<label for="project" class="sr-only">프로젝트 선택</label>
				<select class="form-control input-sm" name="project" onchange="submit();">
					<option value="0"> 전 체
<?php foreach($pj_list as $lt) : ?>
					<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='3') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
<?php endforeach; ?>
				</select>
			</div>
		</div>
	</form>
</div>

<div class="row" style="margin: 0;">
	<!-- 사업 요약부분 시작 -->
	<div class="col-md-12 table-responsive" style="padding: 0;">
		<table class="table table-bordered table-hover font12">
			<thead>
				<tr>
					<th style="background-color:#BDD5FE; vertical-align: middle;" width="15%" height="50px">사 업 명</th>
					<th colspan="3" style="background-color:#fcf3e4; vertical-align: middle;"><?php echo $pj_now->pj_name." 사업 수지표"; ?></th>
					<th colspan="3" style="font-weight: lighter; font-size: 8pt; vertical-align: middle;"><div class=""><input type="text" class="form-control input-sm" name="" value="조건 : 당사예상, 발코니 확장비 포함, 중도금 후불제(일반=무이자)"></div></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="background-color:#ECF2FB;">부지주소(대표지번)</td>
					<td colspan="5"><?php echo str_replace('|', ' ', $pj_now->local_addr); ?></td>
					<td style="text-align:right;">(단위 : 천원, ㎡, 평)</td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">매입면적(토지)</td>
					<td style="text-align: right;" width="14%"><?php echo number_format($pj_now->buy_land_extent, 2).' ㎡'; ?></td>
					<td style="text-align: right;" width="11%"><?php echo number_format($pj_now->buy_land_extent*0.3025, 2).' 평'; ?></td>
					<td style="background-color:#ECF2FB;" width="15%">용도지역(지구)</td>
					<td width="15%"><?php echo $pj_now->area_usage; ?></td>
					<td style="background-color:#ECF2FB;" width="15%">용적율</td>
					<td style="text-align: right;" width="15%"><?php echo $pj_now->floor_ar_rat."%"; ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">기부면적(도로 등)</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->donation_land_extent, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_now->donation_land_extent*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">토지평단가</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->land_cost/($pj_now->buy_land_extent*0.3025)) ?></td>
					<td style="background-color:#ECF2FB;">건폐율</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->bu_to_la_rat, 2)."%" ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">유휴면적(토지)</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->buy_land_extent-$pj_now->donation_land_extent-$pj_now->scheme_land_extent, 2)." ㎡" ?></td>
					<td style="text-align: right;"><?php echo number_format(($pj_now->buy_land_extent-$pj_now->donation_land_extent-$pj_now->scheme_land_extent)*0.3025, 2)." 평" ?></td>
					<td style="background-color:#ECF2FB;">건축비(평당)</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->build_cost); ?></td>
					<td style="background-color:#ECF2FB;">PF 대출액</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->bridge_loan+$pj_now->pf_loan); ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">사업면적(토지)</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->scheme_land_extent, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_now->scheme_land_extent*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">평당분양가(평균)</td>
					<td style="text-align: right;"></td>
					<td style="background-color:#ECF2FB;">PF율(토지비 대비)</td>
					<td style="text-align: right;"><?php echo number_format(($pj_now->bridge_loan+$pj_now->pf_loan)/$pj_now->land_cost*100, 2)."%"; ?></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">전체연면적(건물)</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->gr_floor_area, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_now->gr_floor_area*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">건축규모</td>
					<td><?php echo $pj_now->build_size; ?></td>
					<td style="background-color:#ECF2FB;">PF 수수료</td>
					<td style="text-align: right;"></td>
				</tr>
				<tr>
					<td style="background-color:#ECF2FB;">지상연면적(건물)</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->on_floor_area, 2)." ㎡"; ?></td>
					<td style="text-align: right;"><?php echo number_format($pj_now->on_floor_area*0.3025, 2)." 평"; ?></td>
					<td style="background-color:#ECF2FB;">세 대 수</td>
					<td style="text-align: right;"><?php echo number_format($pj_now->num_unit); ?></td>
					<td style="background-color:#ECF2FB;">PF 이자율</td>
					<td style="text-align: right;"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- 사업 요약부분 종료 -->
	<!-- 사업수지 테이블 시작 -->
	<div class="col-md-12 table-responsive" style="padding: 0;">
		<table class="table table-bordered table-condensed table-hover font11">
			<thead>
				<tr>
					<th colspan="4" style="text-align: center; background-color:#BDD5FE;" width="23%">구 분</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="13%">금 액</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="32%">산 출 내 역</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="17%">비 고</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="5%">비 율</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="5%">수 정</th>
					<th style="text-align: center; background-color:#BDD5FE;" width="5%">삭 제</th>
				</tr>
			</thead>
			<tbody>
<?php
	$apt_type_row = (count($diff)*(count($type)+1)+1);
	$store_type_row = 1+1;
	$income_title_row = (count($diff)*(count($type)+1))+$store_type_row+2;
	$sum_total = ($apt_take->total/1000) + $pj_now->inside_arcade_price; // 전체 매출

	// 차수별 타입별 평균 세대가격 구하기(select문)
	$tp_select = "SUM(unit_price * unit_num) AS sum_price, SUM(unit_num) AS type_num";

	for($i=0; $i<$income_title_row; $i++) :
		echo "<tr>";

		// 차수별 타입별 평균 세대가격 구하기(where문)
		// $tp_where = array('pj_seq' => $project, 'con_diff_no' => $diff[(ceil(($i+1)/(count($type)+1))-1)]->diff_no, 'con_type_no' => ($i%(count($type)+1))+1, 'con_direction_no' => 1);
		
		// $cdn = $diff[(ceil(($i+1)/(count($type)+1))-1)]->diff_no;
		// $ctn = ($i%(count($type)+1))+1;
		// $type_price = $this->cms_main_model->sql_row("SELECT {$tp_select} FROM cb_cms_sales_price WHERE pj_seq={$project} AND con_diff_no={$cdn} AND con_type_no={$ctn} AND con_direction_no=1"); // 차수별 타입별 평균 세대가격 구하기
		// $t_price = $type_price->sum_price/1000; // 타입별 세대가격(단위 :천원)

		for($j=0; $j<10; $j++):

			if($j==0){ // 수입 지출 구분 열

				// 1열 1행
				if($i==0) {$income_td_html = "<td style='text-align:center; vertical-align:middle; background-color:#eaecf1;' rowspan='".$income_title_row."'>수<br/><br/><br/>입</td>"; }else{ $income_td_html = ""; }

			}elseif($j==1){ // 건축 공종 구분 열
				// 2열 1행
				if($i==0){$income_td_html = "<td style='text-align:center; vertical-align:middle; background-color:#f1f5fc;' rowspan='".($apt_type_row)."'>공<br/>동<br/>주<br/>택</td>";
				// 상가 시작행
				}elseif($i==$apt_type_row) {$income_td_html = "<td style='text-align:center; vertical-align:middle; background-color:#f1f5fc;' rowspan='".$store_type_row."'>상<br/>가</td>";
				// 총계 행
				}elseif($i>$apt_type_row+1){ $income_td_html="<td style='text-align:center; background-color:#eaecf1;' colspan='3'>총 계</td>";
				}else{ $income_td_html=""; }

			}elseif($j==2){ // 차수 구분 열

				// 공동주택 행
				if($i<$apt_type_row-1){
					if($i%(count($type)+1)==0){ $income_td_html = "<td style='text-align:center; vertical-align:middle;' rowspan='".(count($type)+1)."'>".mb_substr($diff[$i%count($type)]->diff_name, 0, 2)."</td>";
					}else{ $income_td_html = ""; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
					$income_td_html = "<td style='text-align:center; background-color:#f1f5fc;' colspan='2'>합 계</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
					$income_td_html = "<td style='text-align:center; background-color:#f1f5fc;' colspan='2'>합 계</td>";
				// 상가 타입 행
				}elseif($i!==$income_title_row-1){ $income_td_html = "<td style='text-align:center;' colspan='2'>1층</td>";
				}else{ $income_td_html = ""; }

			}elseif($j==3){ // 타입 구분 열

				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $income_td_html = "<td style='text-align:center;'>".$type[$i%(count($type)+1)]."</td>";
					// 타입 소계 행
					}else{ $income_td_html = "<td style='text-align:center; background-color:#f6f8fc;'>소 계</td>"; }
				}else{ $income_td_html = ""; }

			}elseif($j==4){ // 금액 열

				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $income_td_html = "<td style='text-align:right; background-color:#fefde4;'>".number_format($t_price)."</td>"; $rat[$i] = $t_price/$sum_total*100;   $diff_total += $t_price;
					// 타입 소계 행
					}else{ $income_td_html = "<td style='text-align:right; background-color:#f6f8fc;'>".number_format($diff_total)."</td>"; $rat[$i] = $diff_total/$sum_total*100;   $apt_total += $diff_total; $diff_total = 0;   }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$income_td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".number_format($apt_total)."</td>";    $rat[$i] = $apt_total/$sum_total*100;
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$income_td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".number_format($pj_now->inside_arcade_price)."</td>";    $rat[$i] = $pj_now->inside_arcade_price/$sum_total*100;
				// 상가 타입 행
				}elseif($i !==$income_title_row-1){ $income_td_html = "<td style='text-align:right; background-color:#fefde4;'>".number_format($pj_now->inside_arcade_price)."</td>";  $rat[$i] = $pj_now->inside_arcade_price/$sum_total*100;
				// 총계 행
				}else{ $income_td_html = "<td style='text-align:right; background-color:#eaecf1;'><strong>".number_format($apt_total+$pj_now->inside_arcade_price)."</strong></td>";   $rat[$i] = ($apt_total+$pj_now->inside_arcade_price)/$sum_total*100;}

			}elseif($j==5){ // 산출근거 열

				if($i<count($diff)*(count($type)+1)){
					$a_sup = $area_sup[$i%(count($type)+1)]*0.3025; // 타입 공급면적(평)
					$a_num = $type_price->type_num;   // 해당차수 타입별 세대수
					$per_py = $type_price->sum_price/$type_price->type_num/1000/$a_sup;

					$unit_price = $a_sup*$per_py;

					// 각 타입 행
					if($i%(count($type)+1)!==4){
						$income_td_html = "<td style='padding-left:30px;'>"." ".number_format($a_sup, 2)." 평형&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp; ".number_format($a_num)." 세대&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp; ".number_format($per_py)." 천원"."</td>";
						$diff_py += ($a_sup * $a_num); // 차수별 분양면적
						$diff_num += $a_num; // 해당차수 총 세대수
					// 타입 소계 행
					}else{ $income_td_html = "<td style='padding-left:30px; background-color:#f6f8fc;'>"."분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; ".number_format($diff_py, 2)." 평&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (".number_format($diff_num)." 세대)"."</td>";
						$total_diff_py += $diff_py; // 전체 공급면적
						$total_diff_num += $diff_num; // 전체 세대수
						$diff_py = 0; $diff_num = 0;
					}
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$income_td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>"."분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; ".number_format($total_diff_py, 2)." 평&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (".number_format($total_diff_num)." 세대)"."</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$income_td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>"."분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; ".number_format($pj_now->inside_arcade_area*0.3025, 2)." 평"."</td>";
				// 상가 타입 행
				}elseif($i !==$income_title_row-1){ $income_td_html = "<td style='padding-left:30px;'>".number_format($pj_now->inside_arcade_area*0.3025, 2)." 평&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *&nbsp;&nbsp;&nbsp; ".number_format($pj_now->inside_arcade_price/($pj_now->inside_arcade_area*0.3025))." 천원"."</td>";
				// 총계 행
				}else{ $income_td_html = "<td style='padding-left:30px; background-color:#eaecf1;'>"."총 분양면적&nbsp;&nbsp;&nbsp; :&nbsp;&nbsp;&nbsp; ".number_format($total_diff_py+($pj_now->inside_arcade_area*0.3025), 2)." 평"."</td>"; }

			}elseif($j==6){ // 비고 열

				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $income_td_html = "<td style='padding-left:30px;'> 세대가격&nbsp; : &nbsp; ".number_format($type_price->sum_price/$type_price->type_num/1000)."</td>";
					// 타입 소계 행
					}else{ $income_td_html = "<td style='padding-left:30px; background-color:#f6f8fc;'>&nbsp;</td>"; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$income_td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>&nbsp;</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$income_td_html = "<td style='padding-left:30px; background-color:#f1f5fc;'>&nbsp;</td>";
				// 상가 타입 행
				}elseif($i !==$income_title_row-1){ $income_td_html = "<td style='padding-left:30px;'>&nbsp;</td>";
				// 총계 행
				}else{ $income_td_html = "<td style='padding-left:30px; background-color:#eaecf1;'>&nbsp;</td>"; }

			}elseif($j==7){ // 비율 열

				if($i<count($diff)*(count($type)+1)){
					// 각 타입 행
					if($i%(count($type)+1)!==4){ $income_td_html = "<td style='text-align:right;'>".number_format($rat[$i], 2)."%</td>";
					// 타입 소계 행
				}else{ $income_td_html = "<td style='text-align:right; background-color:#f6f8fc;'>".number_format($rat[$i], 2)."%</td>"; }
				// 공동주택 합계 행
				}elseif($i==$apt_type_row-1){
						$income_td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".number_format($rat[$i], 2)."%</td>";
				// 상가 합계 행
				}elseif($i==$apt_type_row+$store_type_row-1){
						$income_td_html = "<td style='text-align:right; background-color:#f1f5fc;'>".number_format($rat[$i], 2)."%</td>";
				// 상가 타입 행
			}elseif($i !==$income_title_row-1){ $income_td_html = "<td style='text-align:right;'>".number_format($rat[$i], 2)."%</td>";
				// 총계 행
			}else{ $income_td_html = "<td style='text-align:right; background-color:#eaecf1;'>".number_format($rat[$i], 2)."%</td>"; }

			}else {
				$income_td_html = "<td>&nbsp;</td>";
			}

			echo $income_td_html;

		endfor;
		echo "</tr>";
	endfor;
?>
				<tr><td colspan="10" style="height: 15px;"></td></tr><!-- 수입 / 지출 구분 행 -->
<?php
				// 1열 1행 --총 항목 수 + 최상위 항목수(소계) + 합계 항목(1) // 총항목수 = 차상위 항목 수 + 차차상위 항목 수 - 차차상위 항목의 차상위 항목 수
				$fir_bun_num = 0; // 최상위 항목
				$sec_bud_num = 0; // 차상위 항목 수
				$third_bud_num = 0; // 차차상위 항목 수
				$ts_num = 0; // 차차상위 항목의 차상위 항목 수

				$total_coln = 0; // 총 항목 수 = 차상위 항목 수 + 차차상위 항목 수 - 차차상위 항목의 차상위 항목 수

				$fir_coln = $total_coln + $fir_bun_num + 1; // 1열1행 세로 결합 행 수
?>
				<tr>
					<td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
			</tbody>
		</table>
	</div>
	<!-- 사업수지 테이블 종료 -->




	<div class="col-xs-12 bo-bottom" style="padding: 10px; margin-top: 20px;"><h5>■ 예산(비용/지출)항목 추가</h5></div>
	<div class="font12 col-xs-12" style="padding: 20px 0 0;">
<?php
	echo validation_errors('<div class="alert alert-warning" role="alert">', '</div>');
	$attributes = array('name' => 'bud_insert');
	$hidden = array('project'=>$project);
	echo form_open(current_full_url(), $attributes, $hidden);
?>
			<div class="col-xs-12" style="padding: 0;">
				<table class="table table-striped">
					<thead>
						<th style="width:11%;">항목 단계</th>
						<th style="width:11%;">최상위 항목</th>
						<th style="width:11%;">차상위 항목</th>
						<th style="width:13%;">항목 명칭</th>
						<th style="width:26%;">산출 내역</th>
						<th style="width:18%;">비 고</th>
						<th style="width:10%;">정렬 순서</th>
					</thead>
					<tbody>
						<tr>
							<td>
								<label for="top_bud" class="sr-only">메뉴 단계</label>
								<select class="form-control input-sm" name="depth" required>
									<option value="">단계 선택</option>
									<option value="1">최 상위 (1단계)</option>
									<option value="2">차 상위 (2단계)</option>
									<option value="3">최 하위 (3단계)</option>
								</select>
							</td>

							<td>
								<label for="top_bud" class="sr-only">최상위 예산항목</label>
								<select class="form-control input-sm" name="top_bud">
									<option value="">항목 선택</option>
<?php foreach($top_bud as $lt) : ?>
									<option value="<?php echo $lt->bud_seq; ?>" <?php echo set_select('top_bud', $lt->bud_seq); ?>><?php echo $lt->bud_name; ?></option>
<?php endforeach; ?>
								</select>
							</td>

							<td>
								<label for="sec_bud" class="sr-only">차상위 예산항목</label>
								<select class="form-control input-sm" name="sec_bud">
									<option value="">항목 선택</option>
<?php foreach($sec_bud as $lt) : ?>
									<option value="<?php echo $lt->bud_seq; ?>" <?php echo set_select('sec_bud', $lt->bud_seq); ?>><?php echo $lt->bud_name; ?></option>
<?php endforeach; ?>
								</select>
							</td>
							<td>
								<label for="bud_name" class="sr-only">예산항목 명</label>
					      <input type="text" name="bud_name" value="<?php echo set_value('bud_name'); ?>" placeholder="예산항목 명" class="form-control input-sm" maxlength="20" required>
							</td>
							<td>
								<label for="bud_name" class="sr-only">산출 내역</label>
					      <input type="text" name="bud_name" value="<?php echo set_value('bud_name'); ?>" placeholder="산출 내역" class="form-control input-sm" maxlength="20" required>
							</td>
							<td>
								<label for="bud_name" class="sr-only">비 고</label>
					      <input type="text" name="bud_name" value="<?php echo set_value('bud_name'); ?>" placeholder="비 고" class="form-control input-sm" maxlength="20" required>
							</td>
							<td>
								<label for="bud_order" class="sr-only">정렬 순서</label>
					      <input type="number" name="bud_order" value="<?php echo set_value('bud_order'); ?>" placeholder="정렬 순서" class="form-control input-sm" maxlength="3">
							</td>
						</tr>
					</tbody>
				</table>
			</div>

	    <div class="col-xs-12 right bo-top" style="padding: 10px 15px;">
	      <input class="btn btn-success btn-sm" type="button" value="예산항목 추가" onclick="<?php echo $submit_str; ?>">
	    </div>

		</form>
  </div>
	<div class="col-xs-12 bo-top" style="padding: 10px;">&nbsp;</div>
</div>
<?php endif ?>
