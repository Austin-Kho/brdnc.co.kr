<?php
  if($auth22<1) :
  	include('no_auth.php');
  else :
?>
		<div class="main_start">&nbsp;</div>
		<!-- 5. 환경설정 -> 2. 회사정보관리 ->2. 사용자 권한 관리 페이지 -->

		<div class="row" >

		<!-- 신규 사용자 등록자가 있을 때 처리 시작 -->
<?php if($new_rq) :
		$attributes = array('name' => 'form2');
		echo form_open(current_url(), $attributes);
?>
				<fieldset style="margin-bottom: 15px;">
					<input type="hidden" name="no"><!-- js -> permition	함수로 입력 // 신규 사용자 DB 등록 mem_id //-->
					<input type="hidden" name="sf"><!-- js -> permition	함수로 입력 // member DB request 승인 여부 //-->
					<div class="row new_user">
						<div class="col-md-12 str">
							<b><font color="red">*</font> <font color="black">신규 사용자 등록 신청 건이 있습니다.</font></b>
						</div>
					</div>
					<div class="row new_user" style="background-color:#94FB8B">
						<div class="col-md-2 center str">성 명</div>
						<div class="col-md-3 center str">구 분</div>
						<div class="col-md-2 center str">Email</div>
						<div class="col-md-3 center str">등록 신청일시</div>
						<div class="col-md-2 center str">승인처리</div>
					</div>
<?php foreach($new_rq as $lt) : ?>
<?php
if($auth22 !=='2' && $this->session->userdata['mem_is_admin'] !=='1') :
	 $perm_str="onclick=\"alert('승인(거부) 권한이 없습니다!')\"";
else :
	$perm_str="onclick='if(confirm(\"사용자 등록을 \"+this.value+\"하시겠습니까?\")===true) {permition(".$lt->mem_id.", this.value);} else {return;} '";
endif;?>
<!-- // $perm_str="permition('$lt->mem_id', this.value);"; ?> -->
					<div class="row new_user">
						<div class="col-md-2 center str"><?php echo $lt->mem_username." (".$lt->mem_userid.")"; ?></div>
						<div class="col-md-3 center str">(주) 바램디앤씨</div>
						<div class="col-md-2 center str"><?php echo $lt->mem_email; ?></div>
						<div class="col-md-3 center str"><?php echo $lt->mem_register_datetime; ?></div>
						<div class="col-md-2 center str">
							<button class="btn btn-success btn-xs" value="승인" <?php echo $perm_str; ?>>승인</button>
							<button class="btn btn-danger btn-xs" value="거부" <?php echo $perm_str; ?>>거부</button>
						</div>
					</div>
<?php endforeach; ?>
				</fieldset>
			</form>
<?php endif; ?>
		<!-- 신규 사용자 등록자가 있을 때 처리 종료 -->

			<div class="form-group mg-0-15">
				<div class="point-sub col-xs-12 col-sm-4 col-md-2 bo-top" style="padding-top: 9px; height: 40px;">
					<font color="red">*</font> <font color="black">사용자 선택</font>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-10 bo-top" style="height: 40px;">
					<div class="col-xs-12 col-sm-6 col-md-3" style="padding-top: 4px;">
						<select class="form-control input-sm" id="user_sel" name="user_sel" onchange="location.href='<?php echo base_url(); ?>cms_m5/config/2/2/?un='+this.value">
							<option value="">선 택</option>
<?php foreach($user_list as $lt) : ?>
							<option value="<?php echo $lt->mem_id; ?>" <?php if($this->input->get('un')==$lt->mem_id ) echo "selected"; ?>><?php echo $lt->mem_username."(".$lt->mem_userid.")"; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
		</div>
<?php
	$attributes = array('name' => 'form3');
	echo form_open(base_url('cms_m5/config/2/2?un=').$this->input->get('un'), $attributes);
?>
			<fieldset class="font12">
				<div class="row bo-top" style="padding-top: 15px;">
<?php // if($this->input->get('un')) : ?>
					<input type="hidden" name="user_id" value="<?php echo $sel_user->mem_userid; ?>">
					<div class="row bo-tb" style="margin: 0 0 15px;">
						<div class="col-sm-12 col-xs-6" style="padding: 0;">
							<div class="col-xs-12 col-sm-2 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">성 명</div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">구 분</div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">Email</div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">등록 신청일시</div>
							<div class="col-xs-12 col-sm-1 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">선 택</div>
						</div>
						<div class="col-sm-12 col-xs-6" style="padding: 0;">
							<div class="col-xs-12 col-sm-2 center" style="height:38px; padding-top:8px;"><?php echo $sel_user->mem_username; ?></div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px;"><?php if($this->input->get('un')) echo '(주) 바램디앤씨';?></div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px;"><?php echo $sel_user->mem_email; ?></div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px;"><?php echo $sel_user->mem_register_datetime; ?></div>
							<div class="col-xs-12 col-sm-1 center" style="height:38px; padding-top:8px;">
								<input type="checkbox" name="user_no" value="<?php echo $sel_user->mem_id; ?>" <? if($sel_user->mem_id==$this->input->get('un')) echo "checked"?>>
							</div>
						</div>
					</div>
<?php // endif; ?>
				</div>
				<div class="row" style="margin: 0;">
					<div class="table-responsive" style="padding: 0;">
						<table class="table auth-table table-hover">
							<tbody>
								<tr>
									<th class="head-td center bo-right mbo-top" style="vertical-align: middle; background-color: #FBF9F0; width: 100px;"><div style="width: 90px;">분양관리</div></th>
									<td class="head-td bo-right mbo-top  bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>계약관리</strong></div></td>
									<td class=" mbo-top">계약현황
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_1_1" name="_m1_1_1" <?php if(isset($user_auth->_m1_1_1) && $user_auth->_m1_1_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_1_1_m" name="_m1_1_1_m" <?php if(isset($user_auth->_m1_1_1) && $user_auth->_m1_1_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class=" mbo-top" >계약등록
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_1_2" name="_m1_1_2" <?php if(isset($user_auth->_m1_1_2) && $user_auth->_m1_1_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_1_2_m" name="_m1_1_2_m" <?php if(isset($user_auth->_m1_1_2) && $user_auth->_m1_1_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class=" mbo-top" >동호수 현황
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_1_3" name="_m1_1_3" <?php if(isset($user_auth->_m1_1_3) && $user_auth->_m1_1_3>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_1_3_m" name="_m1_1_3_m" <?php if(isset($user_auth->_m1_1_3) && $user_auth->_m1_1_3>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class=" mbo-top" ></td>

									<td class="sec-td bo-right bo-left bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>수납관리</strong></div></td>
									<td class="sec-td" >수납현황
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_2_1" name="_m1_2_1" <?php if(isset($user_auth->_m1_2_1) && $user_auth->_m1_2_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_2_1_m" name="_m1_2_1_m" <?php if(isset($user_auth->_m1_2_1) && $user_auth->_m1_2_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td" >수납등록
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_2_2" name="_m1_2_2" <?php if(isset($user_auth->_m1_2_2) && $user_auth->_m1_2_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_2_2_m" name="_m1_2_2_m" <?php if(isset($user_auth->_m1_2_2) && $user_auth->_m1_2_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td" >설정관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_2_3" name="_m1_2_3" <?php if(isset($user_auth->_m1_2_3) && $user_auth->_m1_2_3>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m1_2_3_m" name="_m1_2_3_m" <?php if(isset($user_auth->_m1_2_3) && $user_auth->_m1_2_3>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td"></td>
								</tr>
								<tr>
									<th class="center bo-right" style="vertical-align: middle; background-color: #FBF9F0;"><div style="width: 90px;">사업관리</div></th>
									<td class="bo-right bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>예산 관리</strong></div></td>
									<td>집행현황
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_1_1" name="_m2_1_1" <?php if(isset($user_auth->_m2_1_1) && $user_auth->_m2_1_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_1_1_m" name="_m2_1_1_m" <?php if(isset($user_auth->_m2_1_1) && $user_auth->_m2_1_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>집행등록
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_1_2" name="_m2_1_2" <?php if(isset($user_auth->_m2_1_2) && $user_auth->_m2_1_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_1_2_m" name="_m2_1_2_m" <?php if(isset($user_auth->_m2_1_2) && $user_auth->_m2_1_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>수지 예산안
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_1_3" name="_m2_1_3" <?php if(isset($user_auth->_m2_1_3) && $user_auth->_m2_1_3>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_1_3_m" name="_m2_1_3_m" <?php if(isset($user_auth->_m2_1_3) && $user_auth->_m2_1_3>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td></td>

									<td class="sec-td bo-right bo-left bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>진행 관리</strong></div></td>
									<td class="sec-td">문서관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_2_1" name="_m2_2_1" <?php if(isset($user_auth->_m2_2_1) && $user_auth->_m2_2_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_2_1_m" name="_m2_2_1_m" <?php if(isset($user_auth->_m2_2_1) && $user_auth->_m2_2_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td">일정관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_2_2" name="_m2_2_2" <?php if(isset($user_auth->_m2_2_2) && $user_auth->_m2_2_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_2_2_m" name="_m2_2_2_m" <?php if(isset($user_auth->_m2_2_2) && $user_auth->_m2_2_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td">프로세스
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_2_3" name="_m2_2_3" <?php if(isset($user_auth->_m2_2_3) && $user_auth->_m2_2_3>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m2_2_3_m" name="_m2_2_3_m" <?php if(isset($user_auth->_m2_2_3) && $user_auth->_m2_2_3>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td"></td>
								</tr>
								<tr>
									<th class="center bo-right" style="vertical-align: middle; background-color: #FBF9F0;"><div style="width: 90px;">프로젝트</div></th>
									<td class="bo-right bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>프로젝트 관리</strong></div></td>
									<td>동호수 등록
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_1_1" name="_m3_1_1" <?php if(isset($user_auth->_m3_1_1) && $user_auth->_m3_1_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_1_1_m" name="_m3_1_1_m" <?php if(isset($user_auth->_m3_1_1) && $user_auth->_m3_1_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>프로젝트 목록
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_1_2" name="_m3_1_2" <?php if(isset($user_auth->_m3_1_2) && $user_auth->_m3_1_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_1_2_m" name="_m3_1_2_m" <?php if(isset($user_auth->_m3_1_2) && $user_auth->_m3_1_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td></td>
									<td></td>

									<td class="sec-td bo-right bo-left bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>신규 프로젝트</strong></div></td>
									<td class="sec-td">신규 등록
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_2_1" name="_m3_2_1" <?php if(isset($user_auth->_m3_2_1) && $user_auth->_m3_2_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_2_1_m" name="_m3_2_1_m" <?php if(isset($user_auth->_m3_2_1) && $user_auth->_m3_2_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td">검토 자료
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_2_2" name="_m3_2_2" <?php if(isset($user_auth->_m3_2_2) && $user_auth->_m3_2_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m3_2_2_m" name="_m3_2_2_m" <?php if(isset($user_auth->_m3_2_2) && $user_auth->_m3_2_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td"></td>
									<td class="sec-td"></td>
								</tr>
								<tr>
									<th  class="center bo-right"style="vertical-align: middle; background-color: #FBF9F0;"><div style="width: 90px;">본사관리</div></th>
									<td class="bo-right bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>자금관리</strong></div></td>
									<td>자금일보
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_1_1" name="_m4_1_1" <?php if(isset($user_auth->_m4_1_1) && $user_auth->_m4_1_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_1_1_m" name="_m4_1_1_m" <?php if(isset($user_auth->_m4_1_1) && $user_auth->_m4_1_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>입출금 내역
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_1_2" name="_m4_1_2" <?php if(isset($user_auth->_m4_1_2) && $user_auth->_m4_1_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_1_2_m" name="_m4_1_2_m" <?php if(isset($user_auth->_m4_1_2) && $user_auth->_m4_1_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>입출금 등록
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_1_3" name="_m4_1_3" <?php if(isset($user_auth->_m4_1_3) && $user_auth->_m4_1_3>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_1_3_m" name="_m4_1_3_m" <?php if(isset($user_auth->_m4_1_3) && $user_auth->_m4_1_3>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td></td>

									<td class="sec-td bo-right bo-left bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>일반관리</strong></div></td>
									<td class="sec-td">문서관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_2_1" name="_m4_2_1" <?php if(isset($user_auth->_m4_2_1) && $user_auth->_m4_2_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_2_1_m" name="_m4_2_1_m" <?php if(isset($user_auth->_m4_2_1) && $user_auth->_m4_2_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td">인사관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_2_2" name="_m4_2_2" <?php if(isset($user_auth->_m4_2_2) && $user_auth->_m4_2_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_2_2_m" name="_m4_2_2_m" <?php if(isset($user_auth->_m4_2_2) && $user_auth->_m4_2_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td">채권채무
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_2_3" name="_m4_2_3" <?php if(isset($user_auth->_m4_2_3) && $user_auth->_m4_2_3>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m4_2_3_m" name="_m4_2_3_m" <?php if(isset($user_auth->_m4_2_3) && $user_auth->_m4_2_3>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td"></td>
								</tr>
								<tr>
									<th class="center bo-right" style="vertical-align: middle; background-color: #FBF9F0;"><div style="width: 90px;">환경설정</div></th>
									<td class="bo-right bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>기본정보 관리</strong></div></td>
									<td>부서정보 관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_1" name="_m5_1_1" <?php if(isset($user_auth->_m5_1_1) && $user_auth->_m5_1_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_1_m" name="_m5_1_1_m" <?php if(isset($user_auth->_m5_1_1) && $user_auth->_m5_1_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>직원정보 관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_2" name="_m5_1_2" <?php if(isset($user_auth->_m5_1_2) && $user_auth->_m5_1_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_2_m" name="_m5_1_2_m" <?php if(isset($user_auth->_m5_1_2) && $user_auth->_m5_1_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>거래처정보 관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_3" name="_m5_1_3" <?php if(isset($user_auth->_m5_1_3) && $user_auth->_m5_1_3>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_3_m" name="_m5_1_3_m" <?php if(isset($user_auth->_m5_1_3) && $user_auth->_m5_1_3>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td>은행계좌 관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_4" name="_m5_1_4" <?php if(isset($user_auth->_m5_1_4) && $user_auth->_m5_1_4>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_1_4_m" name="_m5_1_4_m" <?php if(isset($user_auth->_m5_1_4) && $user_auth->_m5_1_4>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>

									<td class="sec-td bo-right bo-left bgf8 bgf8" style="vertical-align: middle; padding: 0 0 0 10px;"><div style="width: 80px;"><strong>회사정보 관리</strong></div></td>
									<td class="sec-td">회사 기본정보
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_2_1" name="_m5_2_1" <?php if(isset($user_auth->_m5_2_1) && $user_auth->_m5_2_1>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_2_1_m" name="_m5_2_1_m" <?php if(isset($user_auth->_m5_2_1) && $user_auth->_m5_2_1>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td">사용자권한관리
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_2_2" name="_m5_2_2" <?php if(isset($user_auth->_m5_2_2) && $user_auth->_m5_2_2>0) echo 'checked'; ?>> 조회</label>
										</div>
										<div class="checkbox" style="margin: 0; width: 80px;">
											<label><input type="checkbox" id="_m5_2_2_m" name="_m5_2_2_m" <?php if(isset($user_auth->_m5_2_2) && $user_auth->_m5_2_2>1) echo 'checked'; ?>> 관리</label>
										</div>
									</td>
									<td class="sec-td"></td>
									<td class="sec-td"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
<?php if($auth22<2 && $this->session->userdata['mem_is_admin']!=='1') {$submit_str = "alert('등록 권한이 없습니다!')"; } else {$submit_str = "auth_submit('".$this->input->get('un')."');";} ?>
				<div class="row btn-wrap">
					<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str?>" value=" 권한 설정 ">
				</div>
			</fieldset>
		</form>
<?php if( !$this->agent->is_mobile() && !$new_rq && !$this->input->get('un')) : ?>
	<div class="" style="height: 104px;">

	</div>
<?php endif; ?>
<?php endif ?>
