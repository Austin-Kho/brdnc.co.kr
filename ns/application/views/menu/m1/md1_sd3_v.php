		<div class="main_start">&nbsp;</div>
		<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->2. 기본정보 수정 -->
		<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
			<form method="get" name="pj_sel" action="<?php echo current_url(); ?>">

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
				<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
					<div class="col-xs-12 col-sm-8" style="padding: 0px;">
						<label for="yr" class="sr-only">사업 개시년도</label>
						<select class="form-control input-sm" name="yr" onchange="submit();">
							<option value=""> 전 체
<?php
	$start_year = "2014";
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
						<label for="project" class="sr-only">사업 개시년도</label>
						<select class="form-control input-sm" name="project" onchange="submit();">
							<option value=""> 전 체
<?php foreach($all_pj as $lt) : ?>
							<option value="<?php echo $lt->seq; ?>" <?php if($this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
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
						<td class="center" style="width: 100px; background-color: #EAEDF4;">총 세대수</td>
						<td class="right" style="width: 120px;"><?php echo number_format($summary_tb->total); ?> 세대</td>
						<td class="center" style="width: 100px; background-color: #EAEDF4; color: #787878">홀딩 세대</td>
						<td class="right" style="width: 120px; background-color: #F6F4F9; color: #787878;"><?php echo number_format($summary_tb->hold); ?> 세대</td>
					</tr>
					<tr>
						<td class="center" style="background-color: #EDFBB4;">청약 세대</td>
						<td class="right" style="color: #10c227;"><?php echo number_format($summary_tb->acn); ?> 세대</td>
						<td class="center" style="background-color: #DADFFE;">계약 세대</td>
						<td class="right" style="color: #0066FF;"><?php echo number_format($summary_tb->cont); ?> 세대</td>
					</tr>
					<tr>
						<td class="center" style="background-color: #C0D2FE;">합 계</td>
						<td class="right" style="color: #0000CD;"><?php echo number_format($summary_tb->acn+$summary_tb->cont); ?> 세대</td>
						<td class="center" style="background-color: #FEE1EE;">잔여 세대</td>
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
						elseif($db_ho->is_application==1) : $condi = "청약";
						elseif($db_ho->is_contract==1) : $condi = "계약";
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
					$piloti = ($floor_no<4 && $db_ho===null) ? "background-color: #ccc" : "";// 피로티일 때 셀 색상
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
						if($db_ho->is_hold==1) : $condi_col = "background-color: #555353;";
						elseif($db_ho->is_application==1) : $condi_col = "background-color: #3a5ba7;"; // 청약 시
						elseif($db_ho->is_contract==1) : $condi_col = "background-color: #990202;"; // 계약 시
						else : $condi_col = "";
						endif;
					else:
						$condi_col = "";
					endif;
?>
									<div style="<?php echo $clear_css; ?> float:left; <?php echo $div_pointer; ?> border: 1px solid #ddd; <?php echo $bo_wid." ".$bo_col." ".$piloti; ?>">
										<div style="width:30px; height:14px; text-align:center; font-size:9px; color:#333; padding: 1px 0; <?php echo $div_col; ?>"  data-toggle="tooltip" title="<?php echo $now_type; ?>">
											<span><?php echo $now_ho; ?></span>
										</div>
										<div style="width:30px; height:14px; text-align:center; font-size:9px; font-weight: bold; color: #fff; <?php echo $condi_col; ?>"><?php echo $condi;?></div>
									</div>
<?php endfor;  endfor; ?>
								</td>
							</tr>
						</table>
					<div class="col-xs-12 center" style="border: 1px solid #3e3e3e; padding: 8px; background-color: #597284; color: #FFF; font-weight: bold;"><?php echo $dong_data[$a]->dong."동"?></div>
				</div>

<?php endfor; ?>




<?php endif; ?>
		</div>
