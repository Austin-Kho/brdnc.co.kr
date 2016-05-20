		<div class="main_start">&nbsp;</div>
		<!-- 1. 분양관리 -> 1. 계약 관리 ->3. 동호수 현황 -->
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
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택</div>
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

		<div class="row bo-bottom font12" style="margin: 0;">
			<div class="col-xs-12 col-sm-5" style="padding: 10px;">
				<table class="table table-bordered table-condensed" style="margin-bottom: 0;">
					<tr>
						<td class="center" style="width: 100px; background-color: #EBF0FB;">총 세대수</td>
						<td class="right" style="width: 120px;"><?php echo number_format($summary_tb->total); ?> 세대</td>
						<td class="center" style="width: 100px; background-color: #EFF0F2; color: #787878">홀딩 세대</td>
						<td class="right" style="width: 120px; background-color: #F6F4F9; color: #787878;"><?php echo number_format($summary_tb->hold); ?> 세대</td>
					</tr>
					<tr>
						<td class="center" style="background-color: #F5FBDE;">청약 세대</td>
						<td class="right" style="color: #10c227;"><?php echo number_format($summary_tb->acn); ?> 세대</td>
						<td class="center" style="background-color: #E6E9F9;">계약 세대</td>
						<td class="right" style="color: #0066FF;"><?php echo number_format($summary_tb->cont); ?> 세대</td>
					</tr>
					<tr>
						<td class="center" style="background-color: #DDE5F9;">합 계</td>
						<td class="right" style="color: #0000CD;"><?php echo number_format($summary_tb->acn+$summary_tb->cont); ?> 세대</td>
						<td class="center" style="background-color: #F5EAEF;">잔여 세대</td>
						<td class="right" style="color: #DD1C78;"><?php echo number_format($summary_tb->total-$summary_tb->acn-$summary_tb->cont); ?> 세대</td>
					</tr>
				</table>
			</div>
			<div class="col-xs-12 col-sm-7 font10" style="padding: 10px;">
<?php for($i=0; $i<count($type['name']); $i++) :
				$type_color[$type['name'][$i]] = $type['color'][$i];
?>
				<div class="col-xs-6 col-sm-4 col-md-2" style="margin-bottom: 5px; padding: 0;">
					<div style="float:left; background-color: <?php echo $type['color'][$i]; ?>; height: 13px; width: 18px;"></div>
					<div style="float:left; height: 13px; width: 80px; padding-left: 8px;"><?php echo $type['name'][$i]; ?> 타입</div>
				</div>
<?php endfor; ?>
			</div>
		</div>
		<div class="row bo-bottom font12" style="margin: 0; padding: 20px;">
<?php if( !$summary_tb->total OR $summary_tb->total==0) : ?>
			<div class="center" style="padding: 50px; <?php if( !$this-> agent->is_mobile()) echo 'height: 380px;'; ?>">등록된 데이터가 없습니다.</div>
<?php else :
			$base_a = mt_rand(0, 2); // 베이스컬러 첫번 째 난수
			for($a=0; $a<count($dong_data); $a++): // 전체 동 수 만큼 반복
?>
				<div style="float:left; margin:10px;">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td>
<?php for($i=0; $i<$max_floor; $i++) : // 최고층수만큼 반복
				$floor_no = $max_floor-$i;

				for($j=0; $j<$line_num[$a]->to_line; $j++) : // 각 동별 라인수 만큼 반복
					$line_no = str_pad($j+1, 2, 0, STR_PAD_LEFT); // 라인 텍스트
					$line_no_r = str_pad($j+2, 2, 0, STR_PAD_LEFT); // 우측 라인 텍스트
					$ho_no = $floor_no.$line_no;                        // 호수 텍스트
					$ho_no_r = $floor_no.$line_no_r;
					// 실제 디비에서 가져온 동호수 데이터
					$dong = $dong_data[$a]->dong;
					$db_ho = $this->main_m->sql_row(" SELECT seq, type, ho, is_hold, is_application, is_contract FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$dong' AND ho='$ho_no' ");
					// 우측라인 세대 확인
					$db_ho_r = $this->main_m->sql_row(" SELECT ho FROM cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$dong' AND ho='$ho_no_r' ");

					$now_ho = ($db_ho !==null) ? $db_ho->ho : ''; // 해당 호수
					$now_type = ($db_ho !==null) ? $db_ho->type : ''; // 해당 타입
					if($db_ho !==null) : // 세대 상태
						if($db_ho->is_hold==1) : $condi = "홀딩";
						elseif($db_ho->is_application==1) : $condi = "청약"; $app_data = $this->main_m->sql_row(" SELECT  applicant, app_date FROM cms_sales_application WHERE unit_seq='$db_ho->seq' ");
						elseif($db_ho->is_contract==1) : $condi = "계약";  $cont_data = $this->main_m->sql_row(" SELECT  contractor, cms_sales_contract.cont_date FROM cms_sales_contract, cms_sales_contractor WHERE unit_seq='$db_ho->seq' AND cms_sales_contract.seq=cont_seq ");
						else : $condi = "";
						endif;
					else:
						$condi = "";
					endif;

					// CSS 코드들
					$clear_css = ($j==0)  ? "clear:left;" : '';
					$div_pointer = ($db_ho !==null) ? "cursor: pointer;" : "";
					$div_col = ($db_ho !==null) ? "background-color:".$type_color[$now_type].";" : '';
					$bo_col = ($db_ho !==null) ? "border-color: #ccc" : "border-color: #fff";
					$bo_wid = ($j==0) ? "border-width: 1px 1px 0 1px;" : "border-width: 1px 1px 0 0;";
					$piloti = ($floor_no<4 && $db_ho===null) ? "background-color: #B8B5B5" : "";// 피로티일 때 셀 색상
					if($floor_no>4) : // 보더 색상 지정
						if($db_ho===null && $db_ho_r !==null):
							$bo_col = ($j==0) ? "border-color: #fff #ccc #ccc #fff;" : "border-color: #fff #ccc;";
						else :
							$bo_col = ($db_ho !==null) ? "border-color: #ccc;" : "border-color: #fff;";
						endif;
					else :
						if($db_ho===null && $db_ho_r !==null):
							$bo_col = "border-color: #ccc;";
						else :
							$bo_col = ($db_ho !==null) ? "border-color: #ccc;" : "border-color: #fff;";
						endif;
					endif;
					if($db_ho !==null) : // 상태 색상 지정
						if($db_ho->is_hold==1) : $condi_col = "background-color: #728a7d;";
						elseif($db_ho->is_application==1) : $condi_col = "background-color: #2ba220;"; // 청약 시
						elseif($db_ho->is_contract==1) : $condi_col = "background-color: #8b3838;"; // 계약 시
						else : $condi_col = "";
						endif;
					else:
						$condi_col = "";
					endif;
					$base_col = array(
						array('#5D5D8E','#5A5B93',' #4D568B', '#544983', '#534A96', '#524C8B'),
						array('#9F4664','#9C3D5F',' #992C50', '#AB3164', '#9D3646', '#A3305A'),
						array('#554F50','#515C51',' #50515B', '#524747', '#525B55', '#534B53')
					);
?>
									<div style="<?php echo $clear_css; ?> float:left; <?php echo $div_pointer; ?> border: 1px solid #ddd; <?php echo $bo_wid." ".$bo_col." ".$piloti; ?>">
										<div style="width:30px; height:14px; text-align:center; font-size:9px; color:#333; padding: 1px 0; <?php echo $div_col; ?>">
											<span><?php echo $now_ho; ?></span>
										</div>
										<div style="width:30px; height:14px; text-align:center; font-size:9px; color: #fff; <?php echo $condi_col; ?>"><span  data-toggle="tooltip" title="<?php //echo $tooltip; ?>"><?php echo $condi;?></span></div>
									</div>
<?php endfor;  endfor; ?>
								</td>
							</tr>
						</table>
					<div class="col-xs-12 center" style="border: 1px solid #3e3e3e; padding: 8px; background-color: <?php echo $base_col[$base_a][mt_rand(0, 5)]; ?>; color: #FFF; font-weight: bold;"><?php echo $dong_data[$a]->dong."동"?></div>
				</div>
<?php endfor; ?>
<?php endif; ?>
		</div>
