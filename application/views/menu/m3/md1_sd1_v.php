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
	$attributes = array('name' => 'form1', 'method' => 'post');
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
<?php //if($a=='a') : ?>
					<div class="row" style="margin: 0;">
						<div class="col-xs-10" style="padding: 9px  5px 9px 15px;">
							최근 등록 정보 : <font color="#cc0000"><?// =$chk_row[dong]?>동 <?//=$line?>호 라인 (총 <?//=$total_n?> 세대 등록)</font>
						</div>
						<div class="col-xs-2" style="padding: 6px;" data-toggle="tooltip" data-placement="left" title=" 해당 프로젝트에 대한 데이터를 모두 등록한 후에 등록마감 처리하여 주십시요! "><input type="button" class="btn btn-warning btn-xs" value="등록마감" onclick="data_move('end','<?//=$new_pj?>');"></div>
					</div>
<?php //endif; ?>
					<div class="row table-responsive" style="margin: 0 0 20px 0;">
						<table class="table">
				            <thead class="bo-top" style="background-color: #F0F0E8;">
					            <tr>
					                <th class="center" style="width: 210px">동 등록</th>
					                <th class="center" style="width: 130px">라인 등록</th>
					                <th class="center" style="width: 150px">타입(Type) 등록</th>
					                <th class="center" style="width: 323px">층 등록 (등록 라인에 해당하는 층 등록)</th>
 									<th class="center" style="width: 110px">예외 (홀딩) 세대</th>
				            	</tr>
				            </thead>
				            <tbody class="bo-bottom">
								<!-- =============================================== line batch 1 start ================================================ -->
								<tr>
					                <td><input type="text" name="dong_1" class="" size="5">동<input type="checkbox" class="checkbox" name="dong_ik" onclick="dong_reg_bc(this);">일괄등록</td>
									<td><input type="text" name="line_1" class="">호 라인</td>
					                <td>
										<div class="col-xs-8">
											<select name="type_1" class="form-control input-sm">
												<option value="" selected> 선택
												<?
													// if($p_row[type_name]){
													// 	for($i=0; $i<$t_count; $i++){
												?>
												<option value="<?//=$type[$i]?>"> <?//=$type[$i]?>
												<? //}} ?>
											</select>
										</div>
										<div class="col-xs-4"> TYPE</div>
					                </td>
					                <td>
										<div class="col-xs-3"><input type="text" name="min_floor_1" class="form-control input-sm"></div>
										<div class="col-xs-3"> 층 부터 ~ </div>
										<div class="col-xs-3"><input type="text" name="max_floor_1" class="form-control input-sm"></div>
										<div class="col-xs-3"> 층 (일괄 등록)</div>

									</td>
									<td><input type="checkbox" name="hold_1"></td>
					            </tr>
								<!-- =============================================== line batch 1 end ================================================ -->

								<tr>
					                <td>1</td>
					                <td>Mark</td>
					                <td>Otto</td>
					                <td>@mdo</td>
									<td>@mdo</td>
					            </tr>
								<tr>
					                <td>1</td>
					                <td>Mark</td>
					                <td>Otto</td>
					                <td>@mdo</td>
									<td>@mdo</td>
					            </tr>
								<tr>
					                <td>1</td>
					                <td>Mark</td>
					                <td>Otto</td>
					                <td>@mdo</td>
									<td>@mdo</td>
					            </tr>
								<tr>
					                <td>1</td>
					                <td>Mark</td>
					                <td>Otto</td>
					                <td>@mdo</td>
									<td>@mdo</td>
					            </tr>
								<tr>
					                <td>1</td>
					                <td>Mark</td>
					                <td>Otto</td>
					                <td>@mdo</td>
									<td>@mdo</td>
					            </tr>
							</tbody>
						</table>
					</div>
					<div class="row font12" style="margin: 0; padding: 0 15px; 0; text-align:center; color:#3e3e3e; line-height:180%;">
						<p style="padding: 0px;">각 동의 <font color="#cc0000">1개 라인별로 정보를 입력</font> 하십시요! 공급가격 정보가 다른 층 (예를 들어 1,2층의 공급가격이 기준층과 다른 경우) 은 층별로
						개별 등록하고 같은 라인의 기준층과 같이 타입이나 공급가격이 동일한 호수의 경우 최저층부터 최고층까지 일괄등록 할 수 있습니다. (<font color="#7A7A7A">단, 이 경우 1, 2층을 개별 등록하였다면, 3층부터 입력하여야 중복이 되지 않으며 3층부터 15층까지로 설정하였다면 해당 구간의 모든 층이 등록됩니다.</font>)</p>
					</div>
					<div class="row font12" style="margin: 0; padding: 20px 0; text-align:center; color:#3e3e3e; line-height:180%;">
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

    		</div>
