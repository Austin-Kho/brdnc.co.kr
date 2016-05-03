    		<div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 1. 프로젝트 관리 ->1. 데이터 등록 -->
			<div class="row font12" style="margin: 0; padding: 0;">
<?php
	$attributes = array('name' => 'pj_data_reg', 'method' => 'get');
	echo form_open('/m3/project/1/1/', $attributes);
?>

					<label for="mode" class="sr-only">모드</label>
					<input type="hidden" name="mode">
					<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
						<div class="col-xs-12 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">사업 개시년도</div>
						<div class="col-xs-12 col-sm-8 col-md-2" style="padding: 3px 5px;">
							<label for="yr" class="sr-only">사업 개시년도</label>
							<select class="form-control input-sm" name="yr" onchange="submit();">
								<option value=""> 전 체</option>
<?php
	$start_year = "2014";
	// if(!$yr) $yr=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
	$year=range($start_year,date('Y'));
	for($i=(count($year)-1); $i>=0; $i--) :
?>
								<option value="<?php echo $year[$i]?>" <?php if($this->input->get('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?></option>
<?php endfor; ?>
							</select>
						</div>

						<div class="col-xs-12 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">미등록현장 [<span style="color: #0c04ab;">신규등록</span>]</div>
						<div class="col-xs-12 col-sm-8 col-md-2" style="padding: 3px 5px;">
							<label for="new_pj" class="sr-only">구분1</label>
							<select class="form-control input-sm" name="new_pj" onchange="select_ch('reg');">
								<option value="">선 택</option>
<?php foreach($new_pj as $lt) : ?>
								<option value="<?php echo $lt->seq; ?>" <?php if($this->input->get('new_pj')==$lt->seq) echo 'selected'; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
							</select>
						</div>

						<div class="col-xs-12 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">기등록현장 [<span style="color: #be032a;">데이터수정</span>]</div>
						<div class="col-xs-12 col-sm-8 col-md-2" style="padding: 3px 5px;">
							<label for="reg_pj" class="sr-only">구분1</label>
							<select class="form-control input-sm" name="reg_pj" onchange="select_ch('modify');">
								<option value="">선 택</option>
<?php foreach($reg_pj as $lt) : ?>
								<option value="<?php echo $lt->seq; ?>" <?php if($this->input->get('reg_pj')==$lt->seq) echo 'selected'; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
							</select>
						</div>
					</div>
				</form>

<?php
	$attributes = array('name' => 'form1', 'method' => 'post', 'class' => 'form-inline');
	echo form_open('/m3/project/1/1/', $attributes);
?><!-- 메인폼(form1) 시작 -->
				<!------------------------------------동호수 별 입력 시작--------------------------------------------->
					<label for="mode" class="sr-only">모드</label><input type="hidden" name="mode" value="<?php echo $this->input->get('mode'); ?>">
					<label for="pj_seq" class="sr-only">모드</label><input type="hidden" name="pj_seq" value="<?php if(isset($pre_pj_seq)) echo $pre_pj_seq; ?>">
					<label for="pj_sort" class="sr-only">모드</label><input type="hidden" name="pj_sort" value="<?php if(isset($pre_pj_seq)) echo $project->sort; ?>">

					<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
						<div class="col-xs-4 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">프로젝트 명</div>
						<div class="col-xs-8 col-sm-8 col-md-4" style="padding: 9px;">
							<span style="color: #000099;"><?php if(isset($pre_pj_seq)) echo $project->pj_name;?>&nbsp;</span>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-2 center" style="background-color: #F4F4F4; padding: 9px 0;">프로젝트 종류</div>
						<div class="col-xs-5 col-sm-6 col-md-3" style="padding: 9px;">
							<span style="color: #000099;"><?php if(isset($pre_pj_seq)) echo $sort;?>&nbsp;</span>
						</div>
<?php if($this->input->get('reg_pj')) : // 등록 수정이면
						?>
						<div class="col-xs-3 col-sm-2 col-md-1" style="padding: 6px;">
							<input type="button" class="btn btn-success btn-xs" value=" 재 등록 " onclick="data_move('re_reg','<?php echo $this->input->get('reg_pj');?>');">
						</div>
<?php endif; ?>
					</div>


					<div class="row" style="margin: 0;">
						<div class="col-xs-12" style="padding: 9px 0 9px 15px;"><strong><span class="red">*</span> 라인(동) 별 데이터 등록</strong></div>
					</div>

<?php if( !empty($reg_chk)) :
	if($reg_chk['num']!=0)$line = substr($reg_chk['result'][0]->ho, -2, 2);
?>
					<div class="row" style="margin: 0;">
						<div class="col-xs-12 col-sm-5 col-md-4" style="padding: 9px  5px 9px 15px;">
							최근 등록 정보 : <font color="#cc0000"><?php if(($reg_chk['num']==0)) {echo "등록세대 없음";} else {echo $reg_chk['result'][0]->dong; ?>동 <?php echo $line; ?>호 라인 (총 <?php echo $reg_chk['num']; ?> 세대 등록)<?php } ?></font>
						</div>
<?php if($reg_chk['num']!=0) : ?>
						<div class="col-xs-3 col-sm-7 col-md-8" style="padding: 6px;" data-toggle="tooltip" data-placement="left" title="  프로젝트의 동호데이터 등록 완료 시 등록마감 처리하여 주십시요! "><input type="button" class="btn btn-warning btn-xs" value="등록마감" onclick="data_move('end','<?//=$new_pj?>');"></div>
<?php endif; ?>
					</div>
<?php endif; ?>
					<div class="row table-responsive" style="margin: 0 0 20px 0;">
						<table class="table table-bordered table-hover table-condensed">
							<thead class="bo-top">
								<tr style="background-color: #F0F0E8;">
									<th class="center" style="width: 210px">동 등록</th>
					                <th class="center" style="width: 130px">라인 등록</th>
					                <th class="center" style="width: 150px">타입(Type) 등록</th>
					                <th class="center" style="width: 323px">층 등록 (등록 라인에 해당하는 층 등록)</th>
 									<th class="center" style="width: 110px">제외 (홀딩) 세대</th>
								</tr>
							</thead>
				            <tbody class="bo-bottom">
<?php
	if(isset($pre_pj_seq)){
		$type=explode("-", $project->type_name);
		$t_count=count($type);
	}
	echo "<div style='color: blue;'>".validation_errors()."</div>";
?>
								<!-- =============================================== line batch 1 start ================================================ -->
								<tr>
					                <td style="padding-left: 15px;"> <div class="checkbox"><input type="text" name="dong_1" size="5" maxlength="5"> 동 <label><input type="checkbox" name="dong_ik" onclick="dong_reg_bc(this);"> 일괄등록</label></div></td>
									<td class="center"><input type="text" name="line_1" maxlength="2" size="5" onkeydown="onlyNum(this);" class="en_only"> 호 라인 </td>
					                <td class="center">
										<select name="type_1" style="width: 65px;">
											<option value="" selected> 선택
<?php if(isset($pre_pj_seq)) : foreach($type as $lt) : ?>
											<option value="<?php echo $lt; ?>"> <?php echo $lt; ?>
<?php endforeach; endif; ?>
										</select> TYPE
					                </td>
					                <td class="center"><input type="text" name="min_floor_1" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 부터 ~ <input type="text" name="max_floor_1" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 (일괄 등록)</td>
									<td class="center"><div class="checkbox"><label><input type="checkbox" name="hold_1">  분양제외</label></div></td>
					            </tr>
								<!-- =============================================== line batch 1 end ================================================ -->
								<!-- =============================================== line batch 2 start ================================================ -->
								<tr>
					                <td style="padding-left: 15px;"><input type="text" name="dong_2" size="5" maxlength="5"> 동 </td>
									<td class="center"><input type="text" name="line_2" maxlength="2" size="5" onkeydown="onlyNum(this);" class="en_only"> 호 라인 </td>
					                <td class="center">
										<select name="type_2" style="width: 65px;">
											<option value="" selected> 선택
<?php if(isset($pre_pj_seq)) : foreach($type as $lt) : ?>
											<option value="<?php echo $lt; ?>"> <?php echo $lt; ?>
<?php endforeach; endif; ?>
										</select> TYPE
					                </td>
					                <td class="center"><input type="text" name="min_floor_2" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 부터 ~ <input type="text" name="max_floor_2" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 (일괄 등록)</td>
									<td class="center"><div class="checkbox"><label><input type="checkbox" name="hold_2"> 분양제외</label></div></td>
					            </tr>
								<!-- =============================================== line batch 2 end ================================================ -->
								<!-- =============================================== line batch 3 start ================================================ -->
								<tr>
					                <td style="padding-left: 15px;"><input type="text" name="dong_3" size="5" maxlength="5"> 동 </td>
									<td class="center"><input type="text" name="line_3" maxlength="2" size="5" onkeydown="onlyNum(this);" class="en_only"> 호 라인 </td>
					                <td class="center">
										<select name="type_3" style="width: 65px;">
											<option value="" selected> 선택
<?php if(isset($pre_pj_seq)) : foreach($type as $lt) : ?>
											<option value="<?php echo $lt; ?>"> <?php echo $lt; ?>
<?php endforeach; endif; ?>
										</select> TYPE
					                </td>
					                <td class="center"><input type="text" name="min_floor_3" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 부터 ~ <input type="text" name="max_floor_3" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 (일괄 등록)</td>
									<td class="center"><div class="checkbox"><label><input type="checkbox" name="hold_3"> 분양제외</label></div></td>
					            </tr>
								<!-- =============================================== line batch 3 end ================================================ -->
								<!-- =============================================== line batch 4 start ================================================ -->
								<tr>
					                <td style="padding-left: 15px;"><input type="text" name="dong_4" size="5" maxlength="5"> 동 </td>
									<td class="center"><input type="text" name="line_4" maxlength="2" size="5" onkeydown="onlyNum(this);" class="en_only"> 호 라인 </td>
					                <td class="center">
										<select name="type_4" style="width: 65px;">
											<option value="" selected> 선택
<?php if(isset($pre_pj_seq)) : foreach($type as $lt) : ?>
											<option value="<?php echo $lt; ?>"> <?php echo $lt; ?>
<?php endforeach; endif; ?>
										</select> TYPE
					                </td>
					                <td class="center"><input type="text" name="min_floor_4" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 부터 ~ <input type="text" name="max_floor_4" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 (일괄 등록)</td>
									<td class="center"><div class="checkbox"><label><input type="checkbox" name="hold_4"> 분양제외</label></div></td>
					            </tr>
								<!-- =============================================== line batch 4 end ================================================ -->
								<!-- =============================================== line batch 5 start ================================================ -->
								<tr>
					                <td style="padding-left: 15px;"><input type="text" name="dong_5" size="5" maxlength="5"> 동 </td>
									<td class="center"><input type="text" name="line_5" maxlength="2" size="5" onkeydown="onlyNum(this);" class="en_only"> 호 라인 </td>
					                <td class="center">
										<select name="type_5" style="width: 65px;">
											<option value="" selected> 선택
<?php if(isset($pre_pj_seq)) : foreach($type as $lt) : ?>
											<option value="<?php echo $lt; ?>"> <?php echo $lt; ?>
<?php endforeach; endif; ?>
										</select> TYPE
					                </td>
					                <td class="center"><input type="text" name="min_floor_5" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 부터 ~ <input type="text" name="max_floor_5" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 (일괄 등록)</td>
									<td class="center"><div class="checkbox"><label><input type="checkbox" name="hold_5"> 분양제외</label></div></td>
					            </tr>
								<!-- =============================================== line batch 5 end ================================================ -->
								<!-- =============================================== line batch 6 start ================================================ -->
								<tr>
					                <td style="padding-left: 15px;"><input type="text" name="dong_6" size="5" maxlength="5"> 동 </td>
									<td class="center"><input type="text" name="line_6" maxlength="2" size="5" onkeydown="onlyNum(this);" class="en_only"> 호 라인 </td>
					                <td class="center">
										<select name="type_6" style="width: 65px;">
											<option value="" selected> 선택
<?php if(isset($pre_pj_seq)) : foreach($type as $lt) : ?>
											<option value="<?php echo $lt; ?>"> <?php echo $lt; ?>
<?php endforeach; endif; ?>
										</select> TYPE
					                </td>
					                <td class="center"><input type="text" name="min_floor_6" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 부터 ~ <input type="text" name="max_floor_6" size="5" maxlength="3" onkeydown="onlyNum(this);" class="en_only"> 층 (일괄 등록)</td>
									<td class="center"><div class="checkbox"><label><input type="checkbox" name="hold_6"> 분양제외</label></div></td>
					            </tr>
								<!-- =============================================== line batch 6 end ================================================ -->



							</tbody>
						</table>
					</div>
					<div class="row font12" style="margin: 0; padding: 0 15px; 0; text-align:center; color:#3e3e3e; line-height:180%;">
						<p style="padding: 0px;">각 동의 <font color="#cc0000">1개 라인별로 정보를 입력</font> 하십시요! 공급가격 정보가 다른 층 (예를 들어 1,2층의 공급가격이 기준층과 다른 경우) 은 층별로
						개별 등록하고 같은 라인의 기준층과 같이 타입이나 공급가격이 동일한 호수의 경우 최저층부터 최고층까지 일괄등록 할 수 있습니다. (<font color="#7A7A7A">단, 이 경우 1, 2층을 개별 등록하였다면, 3층부터 입력하여야 중복이 되지 않으며 3층부터 15층까지로 설정하였다면 해당 구간의 모든 층이 등록됩니다.</font>)</p>
					</div>
					<div class="row font12" style="margin: 0 0 60px 0; padding: 20px 0; text-align:center; color:#3e3e3e; line-height:180%;">
<?
	if($auth<2){
		$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
	}else{
		$submit_str="pj_data_put_0()";
	}
?>
						<div style="row" style="margin: 0; padding: 0;">
							<input type="button" value="데이터 입력" onclick="<?php echo $submit_str; ?>" class="btn btn-primary btn-sm">
						</div>
					</div>
				</form>
				<!------------------------------------동호수 별 입력 종료----------------------------------------------->


<?php if($this->input->get('new_pj') OR $this->input->get('reg_pj')) : ?>
				<!------------------------------------동호수 데이터 불러오기 시작----------------------------------------------->
<?php
	$attributes = array('method' => 'get');
	echo form_open('/m3/project/1/1/', $attributes);
?>
				<label for="mode" class="sr-only">모드</label><input type="hidden" name="mode" value="<?php echo $this->input->get('mode'); ?>">
				<label for="new_pj" class="sr-only">모드</label><input type="hidden" name="new_pj" value="<?php echo $this->input->get('new_pj'); ?>">
				<label for="reg_pj" class="sr-only">모드</label><input type="hidden" name="reg_pj" value="<?php echo $this->input->get('reg_pj'); ?>">




				<div class="row">
					<div class="col-md-12">
						<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
							<div class="col-xs-12 col-sm-3 col-md-1 center" style="height: 40px; background-color: #F4F4F4; padding: 12px 0;">검색 조건</div>
							<div class="col-xs-4 col-sm-3 col-md-1" style="height: 40px; padding: 5px;">
								<label for="type" class="sr-only">구분1</label>
								<select class="form-control input-sm" name="type">
									<option value=""> 타입별</option>
<?php if(isset($pre_pj_seq)) : foreach($type as $lt) : ?>
									<option value="<?php echo $lt; ?>" <?php if($lt == $this->input->get('type')) echo "selected"; ?>> <?php echo $lt; ?>
<?php endforeach; endif; ?>
								</select>
							</div>
							<div class="col-xs-4 col-sm-3 col-md-1" style="height: 40px; padding: 5px;">
								<label for="dong" class="sr-only">구분1</label>
								<select class="form-control input-sm" name="dong">
									<option value=""> 동 별</option>
<?php  if(isset($pre_pj_seq)) : foreach($reg_dong as $lt) : ?>
									<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->get('dong')) echo "selected"; ?>> <?php echo $lt->dong; ?></option>
<?php endforeach; endif; ?>
								</select>
							</div>
							<div class="col-xs-4 col-sm-3 col-md-1" style="height: 40px; padding: 5px;">
								<label for="num" class="sr-only">구분1</label>
								<select class="form-control input-sm" name="num">
									<option value=""> 표시개수</option>
									<option value="5" <?php if($this->input->get('num')==5) echo "selected"; ?>> 5개</option>
									<option value="10" <?php if($this->input->get('num')==10) echo "selected"; ?>> 10개</option>
									<option value="15" <?php if($this->input->get('num')==15) echo "selected"; ?>> 15개</option>
									<option value="20" <?php if($this->input->get('num')==20) echo "selected"; ?>> 20개</option>
									<option value="25" <?php if($this->input->get('num')==25) echo "selected"; ?>> 25개</option>
									<option value="30" <?php if($this->input->get('num')==30) echo "selected"; ?>> 30개</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-1 center" style="height: 40px; background-color: #F4F4F4; padding: 12px 0;">데이터 정렬</div>
							<div class="col-xs-12 col-sm-1 col-md-1 hidden-xs" style="height: 40px; padding: 0 0 0 5px;">
								<div class="checkbox">
									<label><input type="checkbox" name="reg_order"> 등록 순</label>
								</div>
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2" style="height: 40px; padding: 10px 5px;">
								동별 ( <label class="radio-inline"><input type="radio" name="dong_sc">오름차순</label> <label class="radio-inline"><input type="radio" name="dong_sc">내림차순</label> )
							</div>
							<div class="col-xs-6 col-sm-4 col-md-2" style="height: 40px; padding: 10px 5px;">
								호별 ( <label class="radio-inline"><input type="radio" name="ho_sc">오름차순</label>  <label class="radio-inline"><input type="radio" name="ho_sc">내림차순</label> )
							</div>
							<div class="col-xs-12 col-sm-12 col-md-2 right" style="height: 40px; padding: 5px;">
								<input type="button" value="검 색" class="btn btn-info btn-sm" onclick="submit();">
							</div>
						</div>
					</div>
				</div>

				</form>
				<div class="row" style="margin: 0;">
					<table class="table table-hover">
						<thead class="bo-top" style="background-color: #F4F4F4;">
							<tr>
								<td class="center">프로젝트 명</td>
								<td class="center">동</td>
								<td class="center">호수</td>
								<td class="center">타입(Type)</td>
								<td class="center">홀딩 여부</td>
								<td class="center">수정</td>
								<td class="center">삭제</td>
							</tr>
						</thead>
						<tbody class="bo-bottom">
							<tr>
								<td class="center">프로젝트 명</td>
								<td class="center">동</td>
								<td class="center">호수</td>
								<td class="center">타입(Type)</td>
								<td class="center">홀딩 여부</td>
								<td class="center">수정</td>
								<td class="center">삭제</td>
							</tr>
						</tbody>
					</table>

				</div>
				<div class="row" style="margin: 0;">
					<div class="col-md-12 center" style="margin-top: 0px; padding: 0;">
						<ul class="pagination pagination-sm"><?php // echo $pagination; ?></ul>
					</div>
				</div>


				<!------------------------------------동호수 데이터 불러오기 시작----------------------------------------------->
<?php endif; ?>
    		</div>
