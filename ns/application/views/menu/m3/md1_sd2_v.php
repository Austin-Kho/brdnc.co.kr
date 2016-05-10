		<div class="main_start">&nbsp;</div>
		<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->2. 기본정보 수정 -->
		<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
			<form method="get" name="pj_sel" action="<?php echo base_url(); ?>m3/project/1/2/">

				<div class="col-xs-4 col-sm-3 col-md-2 center" style="background-color: #F4F4F4; padding: 10px; 0">사업 개시년도</div>
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
				<div class="col-xs-4 col-sm-3 col-md-2 center" style="background-color: #F4F4F4; padding: 10px; 0">프로젝트 선택</div>
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

<?php if( !$this->input->get('project')) :  ?>

		<div class="row table-responsive font12" style="margin: 0; padding: 0; height: 573px;">
			<div class="form-group"><!-- 타입등록/제목 -->
				<div class="col-xs-12 form-wrap">
					<div class="col-xs-12 col-sm-8 font13" style="padding: 10px 0 8px;">
						<strong>* <span style="color: #d60740;">프로젝트(현장) 리스트</span></strong>
					</div>
				</div>
			</div>
			<table class="table bo-bottom">
				<tr align="center" style="background-color: #e3e7e0;">
					<td> NO.</td>
					<td> 프로젝트(현장) 명</td>
					<td> 종류 </td>
					<td> 총 세대수(공급물량)  </td>
					<td> 건축 규모</td>
					<td> 사업 개시년월</td>
				</tr>
<?php
	function sort_back($no) {
		switch ($no) {
			case '1': $sort="아파트(일반분양)"; break;
			case '2': $sort="아파트(조합)"; break;
			case '3': $sort="주상복합(아파트)"; break;
			case '4': $sort="주상복합(오피스텔)"; break;
			case '5': $sort="도시형생활주택"; break;
			case '6': $sort="근린생활시설"; break;
			case '7': $sort="레저(숙박)시설"; break;
			case '8': $sort="기타"; break;
		}
		return $sort;
	}
?>
<?php foreach($all_pj as $pj) : ?>
				<tr align="center">
					<td> <?php echo $pj->seq; ?></td>
					<td> <a href="javascript:" onclick="location.href='?project=<?php echo $pj->seq; ?>'"><?php echo $pj->pj_name; ?></a></td>
					<td> <?php echo sort_back($pj->sort); ?> </td>
					<td> <?php echo $pj->num_unit." 세대(호/실)"; ?>  </td>
					<td> <?php echo $pj->build_size; ?></td>
					<td> <?php echo $pj->biz_start_ym; ?></td>
				</tr>
<?php endforeach; ?>
			</table>
			<div class="col-md-12 center" style="margin-top: 0px; padding: 0;">
				<ul class="pagination pagination-sm"><?php echo $pagination;?></ul>
			</div>
		</div>


<?php else :
	$addr = explode("|",$project[0]->local_addr);
	$type_name = explode("-",$project[0]->type_name);
	$type_color = explode("-",$project[0]->type_color);
	$t_count=count($type_name);
	$type_quantity = explode("-",$project[0]->type_quantity);
	$count_unit = explode("-",$project[0]->count_unit);
	$biz_start_ym = explode("-",$project[0]->biz_start_ym);
?>

		<div class="row" style="margin: 0; padding: 0;">
		<?php
			$attributes = array('name' => 'form1', 'class' => '', 'method' => 'post');
			echo form_open(base_url('/m3/project/1/2/'), $attributes);
		?>
				<fieldset class="font12">
					<label for="project" class="sr-only">모드</label>
					<input type="hidden" name="project" value="<?php echo $this->input->get('project'); ?>">
					<div class="form-group"><!-- 프로젝트명/종류 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="pj_name">프로젝트 명 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-12 col-sm-8">
								<input type="text" class="form-control input-sm han" id="pj_name" name="pj_name" maxlength="30" value="<?php if($this->input->post('pj_name')) echo set_value('pj_name'); else echo $project[0]->pj_name; ?>" required autofocus placeholder="프로젝트 명">
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="sort">프로젝트 종류 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-12 col-sm-8">
								<select class="form-control input-sm" id="sort" name="sort" required autofocus>
										<option value="">선택</option>
										<option value="1" <?php if($this->input->post('sort')) echo set_select('sort', '1'); else if($project[0]->sort==1) echo "selected"; ?>> 아파트(일반분양)</option>
										<option value="2" <?php if($this->input->post('sort')) echo set_select('sort', '2'); else if($project[0]->sort==2) echo "selected"; ?>> 아파트(조합)</option>
										<option value="3" <?php if($this->input->post('sort')) echo set_select('sort', '3'); else if($project[0]->sort==3) echo "selected"; ?>> 주상복합(아파트)</option>
										<option value="4" <?php if($this->input->post('sort')) echo set_select('sort', '4'); else if($project[0]->sort==4) echo "selected"; ?>> 주상복합(오피스텔)</option>
										<option value="5" <?php if($this->input->post('sort')) echo set_select('sort', '5'); else if($project[0]->sort==5) echo "selected"; ?>> 도시형생활주택</option>
										<option value="6" <?php if($this->input->post('sort')) echo set_select('sort', '6'); else if($project[0]->sort==6) echo "selected"; ?>> 근린생활시설</option>
										<option value="7" <?php if($this->input->post('sort')) echo set_select('sort', '7'); else if($project[0]->sort==7) echo "selected"; ?>> 레저(숙박)시설</option>
										<option value="8" <?php if($this->input->post('sort')) echo set_select('sort', '8'); else if($project[0]->sort==8) echo "selected"; ?>> 기 타</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group"><!-- 대지주소 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label>대지위치(주소) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
								<input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="javascript:ZipWindow('/popup/zip_/')">
							</div>
							<div class="col-xs-3 col-sm-5 col-md-1" style="padding-right: 0;">
								<label for="zipcode" class="sr-only">우편번호</label>
								<input type="text" class="form-control input-sm en_only" id="zipcode" name="zipcode" maxlength="5" value="<?php if($this->input->post('zipcode')) echo set_value('zipcode'); else echo $addr[0]; ?>" readonly required autofocus>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
								<label for="address1" class="sr-only">회사주소1</label>
								<input type="text" class="form-control input-sm han" id="address1" name="address1" maxlength="100" value="<?php if($this->input->post('address1')) echo set_value('address1'); else echo $addr[1]; ?>" readonly required autofocus>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
								<label for="address2" class="sr-only">회사주소2</label>
								<input type="text" class="form-control input-sm han" id="address2" maxlength="93" value="<?php if($this->input->post('address2')) echo set_value('address2'); else echo $addr[2]; ?>" name="address2" placeholder="나머지 주소">
							</div>
							<!-- <div class="col-xs-12 col-sm-12 col-md-3 glyphicon-wrap" style="padding: 11px;">나머지 주소</div> -->
						</div>
					</div>

					<div class="form-group"><!-- 매입면적/계획면적 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="buy_land_extent">대지 매입면적 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="buy_land_extent" name="buy_land_extent" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('buy_land_extent')) echo set_value('buy_land_extent'); else echo $project[0]->buy_land_extent; ?>" required autofocus placeholder="대지 매입면적 (㎡)">
							</div>
										<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="scheme_land_extent">계획 대지면적 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="scheme_land_extent" name="scheme_land_extent" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('scheme_land_extent')) echo set_value('scheme_land_extent'); else echo $project[0]->scheme_land_extent; ?>" required autofocus placeholder="계획 대지면적 (㎡)">
							</div>
										<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
						</div>
					</div>

					<div class="form-group"><!-- 건축규모/세대수 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="build_size">건축 규모</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-12 col-sm-8">
								<input type="text" class="form-control input-sm han" id="build_size" name="build_size" maxlength="60" value="<?php if($this->input->post('build_size')) echo set_value('build_size'); else echo $project[0]->build_size; ?>" placeholder="건축 규모 (동수/최고층 등)">
							</div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="num_unit">세대(호/실) 수 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="num_unit" name="num_unit" onkeydown="onlyNum(this);" maxlength="6" value="<?php if($this->input->post('num_unit')) echo set_value('num_unit'); else echo $project[0]->num_unit; ?>" required autofocus placeholder="세대(호/실) 수">
							</div>
										<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>세대(호/실)</span></div>
						</div>
					</div>

					<div class="form-group"><!-- 건축면적/총연면적 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="build_area">건축 면적</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="build_area" name="build_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('build_area')) echo set_value('build_area'); else echo $project[0]->build_area; ?>"  placeholder="건축 면적 (㎡)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="gr_floor_area">총 연면적 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="gr_floor_area" name="gr_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('gr_floor_area')) echo set_value('gr_floor_area'); else echo $project[0]->gr_floor_area; ?>" required autofocus placeholder="총 연면적 (㎡)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
						</div>
					</div>

					<div class="form-group"><!-- 지상/지하연면적 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="on_floor_area">지상 연면적 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="on_floor_area" name="on_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('on_floor_area')) echo set_value('on_floor_area'); else echo $project[0]->on_floor_area; ?>" required autofocus placeholder="지상 연면적 (㎡)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="ba_floor_area">지하 연면적 <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="ba_floor_area" name="ba_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('ba_floor_area')) echo set_value('ba_floor_area'); else echo $project[0]->ba_floor_area; ?>" required autofocus placeholder="지하 연면적 (㎡)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
						</div>
					</div>

					<div class="form-group"><!-- 용적율/건폐율 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="floor_ar_rat">용적율 (%) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="floor_ar_rat" name="floor_ar_rat" maxlength="8" value="<?php if($this->input->post('floor_ar_rat')) echo set_value('floor_ar_rat'); else echo $project[0]->floor_ar_rat; ?>" required autofocus placeholder="용적율 (%)">
							</div>
										<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>%</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="bu_to_la_rat">건폐율</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="bu_to_la_rat" name="bu_to_la_rat" maxlength="8" value="<?php if($this->input->post('bu_to_la_rat')) echo set_value('bu_to_la_rat'); else echo $project[0]->bu_to_la_rat; ?>"  placeholder="건폐율 (%)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>%</span></div>
						</div>
					</div>

					<div class="form-group"><!-- 법정/계획주차대수 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="law_num_parking">법정 주차대수</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="law_num_parking" name="law_num_parking" onkeydown="onlyNum(this);" maxlength="6" value="<?php if($this->input->post('law_num_parking')) echo set_value('law_num_parking'); else echo $project[0]->law_num_parking; ?>"  placeholder="법정 주차대수">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>대</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="plan_num_parking">계획 주차대수</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="plan_num_parking" name="plan_num_parking" onkeydown="onlyNum(this);" maxlength="6" value="<?php if($this->input->post('plan_num_parking')) echo set_value('plan_num_parking'); else echo $project[0]->plan_num_parking; ?>"  placeholder="계획 주차대수">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>대</span></div>
						</div>
					</div>

					<div class="form-group"><!-- 타입등록/제목 -->
						<div class="col-xs-12 form-wrap bo-top">
							<div class="col-xs-12 col-sm-8 font13" style="padding: 25px 0 5px 15px;">
								<strong>* <span style="color: #d60740;">타입 등록</span></strong>
							</div>
						</div>
					</div>

					<div class="form-group"><!-- 타입1정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_1">타입별 정보등록(1) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_1" name="type_name_1" maxlength="10" value="<?php if($this->input->post('type_name_1')) echo set_value('type_name_1'); else if($t_count>0) echo $type_name[0]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_1" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_1" name="type_color_1" maxlength="7" value="<?php if($this->input->post('type_color_1')) echo set_value('type_color_1'); else if($t_count>0) echo $type_color[0]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>0) echo $type_color[0]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_1" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_1" name="type_quantity_1" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_1')) echo set_value('type_quantity_1'); else if($t_count>0) echo $type_quantity[0]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_1" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_1" name="count_unit_1">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_1')) echo set_select('count_unit_1', '1'); else if($t_count>0 && $count_unit[0]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_1')) echo set_select('count_unit_1', '2'); else if($t_count>0 && $count_unit[0]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_1')) echo set_select('count_unit_1', '3'); else if($t_count>0 && $count_unit[0]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_1')) echo set_select('count_unit_1', '4'); else if($t_count>0 && $count_unit[0]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_1" id="ck2_1" onclick="type_reg('2',this,1);" <?php if( !empty($type_name[1])){echo " checked ";} if( !empty($type_name[2])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_2" style="<?php if($t_count<2) echo "display:none";?>"><!-- 타입2정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_2">타입별 정보등록(2) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_2" name="type_name_2" maxlength="10" value="<?php if($this->input->post('type_name_2')) echo set_value('type_name_2'); else if($t_count>1)  echo $type_name[1]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_2" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_2" name="type_color_2" maxlength="7" value="<?php if($this->input->post('type_color_2')) echo set_value('type_color_2'); else if($t_count>1) echo $type_color[1]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>1) echo $type_color[1]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_2" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_2" name="type_quantity_2" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_2')) echo set_value('type_quantity_2'); else if($t_count>1) echo $type_quantity[1]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_2" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_2" name="count_unit_2">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_2')) echo set_select('count_unit_2', '1'); else if($t_count>1 && $count_unit[1]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_2')) echo set_select('count_unit_2', '2'); else if($t_count>1 && $count_unit[1]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_2')) echo set_select('count_unit_2', '3'); else if($t_count>1 && $count_unit[1]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_2')) echo set_select('count_unit_2', '4'); else if($t_count>1 && $count_unit[1]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_2" id="ck2_2" onclick="type_reg('2',this,2);" <?php if( !empty($type_name[2])){echo " checked ";} if( !empty($type_name[3])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_3" style="<?php if($t_count<3) echo "display:none";?>"><!-- 타입3정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_3">타입별 정보등록(3) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_3" name="type_name_3" maxlength="10" value="<?php if($this->input->post('type_name_3')) echo set_value('type_name_3'); else if($t_count>2)  echo $type_name[2]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_3" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_3" name="type_color_3" maxlength="7" value="<?php if($this->input->post('type_color_3')) echo set_value('type_color_3'); else if($t_count>2) echo $type_color[2]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>2) echo $type_color[2]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_3" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_3" name="type_quantity_3" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_3')) echo set_value('type_quantity_3'); else if($t_count>2) echo $type_quantity[2]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_3" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_3" name="count_unit_3">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_3')) echo set_select('count_unit_3', '1'); else if($t_count>2 && $count_unit[2]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_3')) echo set_select('count_unit_3', '2'); else if($t_count>2 && $count_unit[2]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_3')) echo set_select('count_unit_3', '3'); else if($t_count>2 && $count_unit[2]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_3')) echo set_select('count_unit_3', '4'); else if($t_count>2 && $count_unit[2]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_3" id="ck2_3" onclick="type_reg('2',this,3);" <?php if( !empty($type_name[3])){echo " checked ";} if( !empty($type_name[4])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_4" style="<?php if($t_count<4) echo "display:none";?>"><!-- 타입4정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_4">타입별 정보등록(4) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_4" name="type_name_4" maxlength="10" value="<?php if($this->input->post('type_name_4')) echo set_value('type_name_4'); else if($t_count>3)  echo $type_name[3]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_4" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_4" name="type_color_4" maxlength="7" value="<?php if($this->input->post('type_color_4')) echo set_value('type_color_4'); else if($t_count>3) echo $type_color[3]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>3) echo $type_color[3]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_4" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_4" name="type_quantity_4" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_4')) echo set_value('type_quantity_4'); else if($t_count>3) echo $type_quantity[3]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_4" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_4" name="count_unit_4">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_4')) echo set_select('count_unit_4', '1'); else if($t_count>3 && $count_unit[3]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_4')) echo set_select('count_unit_4', '2'); else if($t_count>3 && $count_unit[3]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_4')) echo set_select('count_unit_4', '3'); else if($t_count>3 && $count_unit[3]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_4')) echo set_select('count_unit_4', '4'); else if($t_count>3 && $count_unit[3]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_4" id="ck2_4" onclick="type_reg('2',this,4);" <?php if( !empty($type_name[4])){echo " checked ";} if( !empty($type_name[5])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_5" style="<?php if($t_count<5) echo "display:none";?>"><!-- 타입5정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_5">타입별 정보등록(5) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_5" name="type_name_5" maxlength="10" value="<?php if($this->input->post('type_name_5')) echo set_value('type_name_5'); else if($t_count>4)  echo $type_name[4]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_5" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_5" name="type_color_5" maxlength="7" value="<?php if($this->input->post('type_color_5')) echo set_value('type_color_5'); else if($t_count>4) echo $type_color[4]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>4) echo $type_color[4]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_5" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_5" name="type_quantity_5" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_5')) echo set_value('type_quantity_5'); else if($t_count>4) echo $type_quantity[4]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_5" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_5" name="count_unit_5">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_5')) echo set_select('count_unit_5', '1'); else if($t_count>4 && $count_unit[4]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_5')) echo set_select('count_unit_5', '2'); else if($t_count>4 && $count_unit[4]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_5')) echo set_select('count_unit_5', '3'); else if($t_count>4 && $count_unit[4]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_5')) echo set_select('count_unit_5', '4'); else if($t_count>4 && $count_unit[4]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_5" id="ck2_5" onclick="type_reg('2',this,5);" <?php if( !empty($type_name[5])){echo " checked ";} if( !empty($type_name[6])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_6" style="<?php if($t_count<6) echo "display:none";?>"><!-- 타입6정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_6">타입별 정보등록(6) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_6" name="type_name_6" maxlength="10" value="<?php if($this->input->post('type_name_6')) echo set_value('type_name_6'); else if($t_count>5)  echo $type_name[5]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_6" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_6" name="type_color_6" maxlength="7" value="<?php if($this->input->post('type_color_6')) echo set_value('type_color_6'); else if($t_count>5) echo $type_color[5]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>5) echo $type_color[5]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_6" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_6" name="type_quantity_6" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_6')) echo set_value('type_quantity_6'); else if($t_count>5) echo $type_quantity[5]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_6" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_6" name="count_unit_6">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_6')) echo set_select('count_unit_6', '1'); else if($t_count>5 && $count_unit[5]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_6')) echo set_select('count_unit_6', '2'); else if($t_count>5 && $count_unit[5]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_6')) echo set_select('count_unit_6', '3'); else if($t_count>5 && $count_unit[5]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_6')) echo set_select('count_unit_6', '4'); else if($t_count>5 && $count_unit[5]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_6" id="ck2_6" onclick="type_reg('2',this,6);" <?php if( !empty($type_name[6])){echo " checked ";} if( !empty($type_name[7])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_7" style="<?php if($t_count<7) echo "display:none";?>"><!-- 타입7정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_7">타입별 정보등록(7) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_7" name="type_name_7" maxlength="10" value="<?php if($this->input->post('type_name_7')) echo set_value('type_name_7'); else if($t_count>6)  echo $type_name[6]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_7" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_7" name="type_color_7" maxlength="7" value="<?php if($this->input->post('type_color_7')) echo set_value('type_color_7'); else if($t_count>6) echo $type_color[6]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>6) echo $type_color[6]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_7" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_7" name="type_quantity_7" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_7')) echo set_value('type_quantity_7'); else if($t_count>6) echo $type_quantity[6]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_7" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_7" name="count_unit_7">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_7')) echo set_select('count_unit_7', '1'); else if($t_count>6 && $count_unit[6]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_7')) echo set_select('count_unit_7', '2'); else if($t_count>6 && $count_unit[6]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_7')) echo set_select('count_unit_7', '3'); else if($t_count>6 && $count_unit[6]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_7')) echo set_select('count_unit_7', '4'); else if($t_count>6 && $count_unit[6]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_7" id="ck2_7" onclick="type_reg('2',this,7);" <?php if( !empty($type_name[7])){echo " checked ";} if( !empty($type_name[8])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_8" style="<?php if($t_count<8) echo "display:none";?>"><!-- 타입8정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_8">타입별 정보등록(8) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_8" name="type_name_8" maxlength="10" value="<?php if($this->input->post('type_name_8')) echo set_value('type_name_8'); else if($t_count>7)  echo $type_name[7]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_8" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_8" name="type_color_8" maxlength="7" value="<?php if($this->input->post('type_color_8')) echo set_value('type_color_8'); else if($t_count>7) echo $type_color[7]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>7) echo $type_color[7]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_8" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_8" name="type_quantity_8" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_8')) echo set_value('type_quantity_8'); else if($t_count>7) echo $type_quantity[7]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_8" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_8" name="count_unit_8">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_8')) echo set_select('count_unit_8', '1'); else if($t_count>7 && $count_unit[7]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_8')) echo set_select('count_unit_8', '2'); else if($t_count>7 && $count_unit[7]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_8')) echo set_select('count_unit_8', '3'); else if($t_count>7 && $count_unit[7]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_8')) echo set_select('count_unit_8', '4'); else if($t_count>7 && $count_unit[7]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_8" id="ck2_8" onclick="type_reg('2',this,8);" <?php if( !empty($type_name[8])){echo " checked ";} if( !empty($type_name[9])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_9" style="<?php if($t_count<9) echo "display:none";?>"><!-- 타입9정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_9">타입별 정보등록(9) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_9" name="type_name_9" maxlength="10" value="<?php if($this->input->post('type_name_9')) echo set_value('type_name_9'); else if($t_count>8)  echo $type_name[8]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_9" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_9" name="type_color_9" maxlength="7" value="<?php if($this->input->post('type_color_9')) echo set_value('type_color_9'); else if($t_count>8) echo $type_color[8]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>8) echo $type_color[8]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_9" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_9" name="type_quantity_9" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_9')) echo set_value('type_quantity_9'); else if($t_count>8) echo $type_quantity[8]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
							<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_9" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_9" name="count_unit_9">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_9')) echo set_select('count_unit_9', '1'); else if($t_count>8 && $count_unit[8]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_9')) echo set_select('count_unit_9', '2'); else if($t_count>8 && $count_unit[8]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_9')) echo set_select('count_unit_9', '3'); else if($t_count>8 && $count_unit[8]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_9')) echo set_select('count_unit_9', '4'); else if($t_count>8 && $count_unit[8]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_9" id="ck2_9" onclick="type_reg('2',this,9);" <?php if( !empty($type_name[9])){echo " checked ";} if( !empty($type_name[10])){echo " disabled ";}?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_10" style="<?php if($t_count<10) echo "display:none";?>"><!-- 타입10정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_10">타입별 정보등록(10) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_10" name="type_name_10" maxlength="10" value="<?php if($this->input->post('type_name_10')) echo set_value('type_name_10'); else if($t_count>9)  echo $type_name[9]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_10" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_10" name="type_color_10" maxlength="7" value="<?php if($this->input->post('type_color_10')) echo set_value('type_color_10'); else if($t_count>9) echo $type_color[9]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>9) echo $type_color[9]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_10" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_10" name="type_quantity_10" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_10')) echo set_value('type_quantity_10'); else if($t_count>10) echo $type_quantity[10]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
								<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_10" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_10" name="count_unit_10">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_10')) echo set_select('count_unit_10', '1'); else if($t_count>9 && $count_unit[9]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_10')) echo set_select('count_unit_10', '2'); else if($t_count>9 && $count_unit[9]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_10')) echo set_select('count_unit_10', '3'); else if($t_count>9 && $count_unit[9]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_10')) echo set_select('count_unit_10', '4'); else if($t_count>9 && $count_unit[9]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2">
								<div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
									<label>
										<input type="checkbox" name="ck2_10" id="ck2_10" onclick="type_reg('2',this,10);" <?php if( !empty($type_name[10])){echo " checked ";} ?>>
										<a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group" id="type2_11" style="<?php if($t_count<11) echo "display:none";?>"><!-- 타입11정보등록 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="type_name_11">타입별 정보등록(11) <span class="red">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<input type="text" class="form-control input-sm eng" id="type_name_11" name="type_name_11" maxlength="10" value="<?php if($this->input->post('type_name_11')) echo set_value('type_name_11'); else if($t_count>10)  echo $type_name[10]; ?>" required autofocus placeholder="타입">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_color_11" class="sr-only">컬러</span></label>
								<input type="color" class="form-control input-sm en_only" id="type_color_11" name="type_color_11" maxlength="7" value="<?php if($this->input->post('type_color_11')) echo set_value('type_color_11'); else if($t_count>10) echo $type_color[10]; ?>"  placeholder="컬러" style = "background-color: <?php if($t_count>10) echo $type_color[10]; ?>">
							</div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="type_quantity_11" class="sr-only">수량</span></label>
								<input type="text" class="form-control input-sm en_only" id="type_quantity_11" name="type_quantity_11" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('type_quantity_11')) echo set_value('type_quantity_11'); else if($t_count>11) echo $type_quantity[11]; ?>" required autofocus placeholder="타입별 단위 수량">
							</div>
										<div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
							<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
								<label for="count_unit_11" class="sr-only">단위</span></label>
								<select class="form-control input-sm" id="count_unit_11" name="count_unit_11">
									<option value="0">단위</option>
									<option value="1" <?php if($this->input->post('count_unit_11')) echo set_select('count_unit_11', '1'); else if($t_count>10 && $count_unit[10]==1) echo "selected"; ?>>세대</option>
									<option value="2" <?php if($this->input->post('count_unit_11')) echo set_select('count_unit_11', '2'); else if($t_count>10 && $count_unit[10]==2) echo "selected"; ?>>실</option>
									<option value="3" <?php if($this->input->post('count_unit_11')) echo set_select('count_unit_11', '3'); else if($t_count>10 && $count_unit[10]==3) echo "selected"; ?>>호</option>
									<option value="4" <?php if($this->input->post('count_unit_11')) echo set_select('count_unit_11', '4'); else if($t_count>10 && $count_unit[10]==4) echo "selected"; ?>>㎡(면적)</option>
								</select>
							</div>
							<div class="col-xs-2"></div>
						</div>
					</div>



					<div class="form-group"><!-- 추가정보등록/제목 -->
						<div class="col-xs-12 form-wrap bo-top">
							<div class="col-xs-12 col-sm-8 font13" style="padding: 25px 0 5px 15px;">
								<strong>* <span style="color: #d60740;">추가 정보</span></strong>
							</div>
						</div>
					</div>

					<div class="form-group"><!-- 토지매입비/평당건축비 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="land_cost">토지 매입비</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="land_cost" name="land_cost" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('land_cost')) echo set_value('land_cost'); else echo $project[0]->land_cost; ?>" placeholder="토지 매입비 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="build_cost">평당 건축비</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm en_only" id="build_cost" name="build_cost" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('build_cost')) echo set_value('build_cost'); else echo $project[0]->build_cost; ?>" placeholder="평당 건축비 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
					</div>

					<div class="form-group"><!-- 토지매입비/평당건축비 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="arc_design_cost">설계 용역비</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm  en_only" id="arc_design_cost" name="arc_design_cost" onkeydown="onlyNum(this);" maxlength="8" value="<?php if($this->input->post('arc_design_cost')) echo set_value('arc_design_cost'); else echo $project[0]->arc_design_cost; ?>" placeholder="설계 용역비 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="supervision_cost">감리 용역비</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm  en_only" id="supervision_cost" name="supervision_cost" onkeydown="onlyNum(this);" maxlength="8" value="<?php if($this->input->post('supervision_cost')) echo set_value('supervision_cost'); else echo $project[0]->supervision_cost; ?>" placeholder="감리 용역비 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
					</div>
					<div class="form-group"><!-- 토지매입비/평당건축비 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="initial_inves">시행사 초기투자금</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm  en_only" id="initial_inves" name="initial_inves" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('initial_inves')) echo set_value('initial_inves'); else echo $project[0]->initial_inves; ?>" placeholder="시행사 초기 투자금 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="dev_agency_charge">시행대행 용역비 (세대당)</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm  en_only" id="dev_agency_charge" name="dev_agency_charge" onkeydown="onlyNum(this);" maxlength="5" value="<?php if($this->input->post('dev_agency_charge')) echo set_value('dev_agency_charge'); else echo $project[0]->dev_agency_charge; ?>" placeholder="시행대행 용역비 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
					</div>
					<div class="form-group"><!-- 토지매입비/평당건축비 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="bridge_loan">브리지 차입규모</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm  en_only" id="bridge_loan" name="bridge_loan" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('bridge_loan')) echo set_value('bridge_loan'); else echo $project[0]->bridge_loan; ?>" placeholder="브리지 차입규모 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="pf_loan">PF 차입규모</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm  en_only" id="pf_loan" name="pf_loan" onkeydown="onlyNum(this);" maxlength="10" value="<?php if($this->input->post('pf_loan')) echo set_value('pf_loan'); else echo $project[0]->pf_loan; ?>" placeholder="PF 차입규모 (단위:천원)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
						</div>
					</div>
					<div class="form-group"><!-- 토지매입비/평당건축비 -->
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="con_lead_time">공사 소요기간</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-10 col-sm-8">
								<input type="text" class="form-control input-sm  en_only" id="con_lead_time" name="con_lead_time" onkeydown="onlyNum(this);" maxlength="4" value="<?php if($this->input->post('con_lead_time')) echo set_value('con_lead_time'); else echo $project[0]->con_lead_time; ?>" placeholder="공사 소요기간 (개월)">
							</div>
							<div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>개월</span></div>
						</div>
						<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
							<label for="biz_start_year">사업 개시 년</label>
						</div>
						<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
							<div class="col-xs-5 col-sm-4">
								<input type="text" class="form-control input-sm en_only" id="biz_start_year" name="biz_start_year" onkeydown="onlyNum(this);" maxlength="4" value="<?php if($this->input->post('biz_start_year')) echo set_value('biz_start_year'); else echo $biz_start_ym[0]; ?>" placeholder="YYYY">
							</div>
							<div class="col-xs-1" style="padding: 11px 0;"><span>년</span></div>
							<div class="col-xs-4 col-sm-3">
								<label for="biz_start_month" class="sr-only">사업개시 월</span></label>
								<input type="text" class="form-control input-sm en_only" id="biz_start_month" name="biz_start_month" onkeydown="onlyNum(this);" maxlength="2" value="<?php if($this->input->post('biz_start_month')) echo set_value('biz_start_month'); else echo $biz_start_ym[1]; ?>" placeholder="MM">
							</div>
							<div class="col-xs-1 col-sm-2" style="padding: 11px 0;"><span>월</span></div>
						</div>
					</div>
					<div class="form-group" style="color: red;">
						<?php echo validation_errors('<div class="error">', '</div>'); ?>&nbsp;
					</div>

<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="con_formck();";} ?>
					<div class="form-group btn-wrap" style="margin: 0;">
						<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="수정하기">
					</div>
				</fieldset>
			</form>
		</div>
<?php endif; ?>
