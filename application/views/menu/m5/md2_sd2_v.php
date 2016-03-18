		<div class="main_start"></div>
		<!-- 5. 환경설정 -> 2. 회사정보관리 ->2. 사용자 권한 관리 페이지 -->

		<div class="row <?php if( !$this->agent->is_mobile()) echo 'no-mobile';?>">

		<!-- 신규 사용자 등록자가 있을 때 처리 시작 -->
<?php if($new_rq) : ?>
			<form name="form2" method="post" action="com_post.php">
				<input type="hidden" name="no">
				<input type="hidden" name="sf">
				<div class="row" style="margin: 0 15px; border-width: 0 0 1px 0; border-style: solid; border-color: #ddd;">
					<div class="col-md-12" style="height: 40px; padding-top: 10px;">
						<b><font color="red">*</font> <font color="black">신규 사용자 등록 신청 건이 있습니다.</font></b>
					</div>
				</div>
				<div class="row" style="margin: 0 15px; background-color: #F4F4F4; border-bottom: 1px solid #ddd;">
					<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">성 명</div>
					<div class="col-md-3 center" style="height: 40px; padding-top: 10px;">구 분</div>
					<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">Email</div>
					<div class="col-md-3 center" style="height: 40px; padding-top: 10px;">등록 신청일시</div>
					<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">승인처리</div>
				</div>
<?php foreach($new_rq as $lt) : ?>
<?php if($auth<2) $perm_str="alert('승인(거부) 권한이 없습니다!')"; else $perm_str="permition('$lt->no',this.value);"; ?>
				<div class="row" style="margin: 0 15px; border-width: 0 0 1px 0; border-style: solid; border-color: #ddd;">
					<div class="col-md-2 center" style="height: 40px; padding-top: 10px;"><?php echo $lt->name." (".$lt->user_id.")"; ?></div>
					<div class="col-md-3 center" style="height: 40px; padding-top: 10px;">(주) 바램디앤씨</div>
					<div class="col-md-2 center" style="height: 40px; padding-top: 10px;"><?php echo $lt->email; ?></div>
					<div class="col-md-3 center" style="height: 40px; padding-top: 10px;"><?php echo $lt->reg_date; ?></div>
					<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">
						<button class="btn btn-success btn-xs" value="승인" onclick="<?php echo $perm_str; ?>">승인</button>
						<button class="btn btn-danger btn-xs" value="거부" onclick="<?php echo $perm_str; ?>">거부</button>
					</div>
				</div>
<?php endforeach; ?>
			</form>
<?php endif; ?>
		<!-- 신규 사용자 등록자가 있을 때 처리 종료 -->

			<div class="form-group" style="margin: 0 15px 0px;">
				<div class="col-xs-12 col-sm-4 col-md-3 bo-bottom" style="padding-top: 10px; height: 43px; background-color: #f8f8f8;">
					<b><font color="red">*</font> <font color="black">권한 설정할 직원 선택</font></b>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-9 bo-bottom" style="padding-top: 10px; height: 43px; background-color: #f8f8f8;">
					<span style="margin-right: 20px;">(주) 바램디앤씨</span>
					<select id="user_sel" name="user_sel" onchange="location.href='/m5/config/2/2/?un='+this.value">
						<option value="">선 택</option>
<?php foreach($user_list as $lt) : ?>
						<option value="<?php echo $lt->no; ?>" <?php if($this->input->get('un')==$lt->no ) echo "selected"; ?>><?php echo $lt->name."(".$lt->user_id.")"; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
<?php
	$attributes = array('name' => 'form3', 'class' => 'form-inline', 'method' => 'post');
	echo form_open('/m5/config/2/2/?un='.$this->input->get('un'), $attributes);
?>
			<fieldset>
				<div class="row" style="padding-top: 15px;">
<?php if($this->input->get('un')) : ?>
					<input type="hidden" name="user_id" value="<?php echo $sel_user->user_id; ?>">
					<div class="row bo-tb" style="margin: 0 15px 15px;">
						<div class="col-sm-12 col-xs-6" style="padding: 0;">
							<div class="col-xs-12 col-sm-2 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">성 명</div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">구 분</div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">Email</div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">등록 신청일시</div>
							<div class="col-xs-12 col-sm-1 center" style="height:38px; padding-top:8px; background-color:#f6f6f6;">선 택</div>
						</div>
						<div class="col-sm-12 col-xs-6" style="padding: 0;">
							<div class="col-xs-12 col-sm-2 center" style="height:38px; padding-top:8px;"><?php echo $sel_user->name; ?></div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px;">(주) 바램디앤씨</div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px;"><?php echo $sel_user->email; ?></div>
							<div class="col-xs-12 col-sm-3 center" style="height:38px; padding-top:8px;"><?php echo $sel_user->reg_date; ?></div>
							<div class="col-xs-12 col-sm-1 center" style="height:38px; padding-top:8px;">
								<input type="checkbox" name="user_no" value="<?php echo $sel_user->no; ?>" <? if($sel_user->no==$this->input->get('un')) echo "checked"?>>
							</div>
						</div>
					</div>
<?php endif; ?>
				</div>
				<div class="row" style="margin: 0;">
					<div class="col-md-12 table-responsive" style="padding: 0">
						<table class="table auth-table">
							<tbody>
								<tr>
									<th  class="col-md-1 center" rowspan="2" style="vertical-align: middle; border-right: 1px solid #ddd; border-top: 1px solid #B2BCDE; background-color: #f0f0f0;">분양관리</th>
									<td class="col-md-1" style="border-top: 1px solid #B2BCDE;"><strong>계약현황</strong></td>
									<td class="col-md-2" style="border-top: 1px solid #B2BCDE;">계약현황
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_1_1" name="_m1_1_1" <?php if(isset($user_auth->_m1_1_1) && $user_auth->_m1_1_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_1_1_m" name="_m1_1_1_m" <?php if(isset($user_auth->_m1_1_1) && $user_auth->_m1_1_1>1) echo 'checked'; ?> disabled>등록
										</label>
									</td>
										<td class="col-md-2" style="border-top: 1px solid #B2BCDE;">계약등록
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_1_2" name="_m1_1_2" <?php if(isset($user_auth->_m1_1_2) && $user_auth->_m1_1_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_1_2_m" name="_m1_1_2_m" <?php if(isset($user_auth->_m1_1_2) && $user_auth->_m1_1_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td class="col-md-2" style="border-top: 1px solid #B2BCDE;">동호수 현황
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_1_3" name="_m1_1_3" <?php if(isset($user_auth->_m1_1_3) && $user_auth->_m1_1_3>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_1_3_m" name="_m1_1_3_m" <?php if(isset($user_auth->_m1_1_3) && $user_auth->_m1_1_3>1) echo 'checked'; ?> disabled>등록
										</label>
									</td>
									<td class="col-md-2" style="border-top: 1px solid #B2BCDE;"></td>
								</tr>
								<tr>
									<td style="border-top: 0;"><strong>수납현황</strong></td>
									<td style="border-top: 0;">수납현황
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_2_1" name="_m1_2_1" <?php if(isset($user_auth->_m1_2_1) && $user_auth->_m1_2_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_2_1_m" name="_m1_2_1_m" <?php if(isset($user_auth->_m1_2_1) && $user_auth->_m1_2_1>1) echo 'checked'; ?> disabled>등록
										</label>
									</td>
									<td style="border-top: 0;">수납등록
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_2_2" name="_m1_2_2" <?php if(isset($user_auth->_m1_2_2) && $user_auth->_m1_2_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_2_2_m" name="_m1_2_2_m" <?php if(isset($user_auth->_m1_2_2) && $user_auth->_m1_2_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;">요약집계
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_2_3" name="_m1_2_3" <?php if(isset($user_auth->_m1_2_3) && $user_auth->_m1_2_3>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m1_2_3_m" name="_m1_2_3_m" <?php if(isset($user_auth->_m1_2_3) && $user_auth->_m1_2_3>1) echo 'checked'; ?> disabled>등록
										</label>
									</td>
									<td style="border-top: 0;"></td>
								</tr>
								<tr>
									<th class="center" rowspan="2"  style="vertical-align: middle; border-right: 1px solid #ddd; background-color: #f0f0f0;">사업관리</th>
									<td><strong>예산집행 관리</strong></td>
									<td>집행현황
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_1_1" name="_m2_1_1" <?php if(isset($user_auth->_m2_1_1) && $user_auth->_m2_1_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_1_1_m" name="_m2_1_1_m" <?php if(isset($user_auth->_m2_1_1) && $user_auth->_m2_1_1>1) echo 'checked'; ?> disabled>등록
										</label>
									</td>
									<td>집행등록
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_1_2" name="_m2_1_2" <?php if(isset($user_auth->_m2_1_2) && $user_auth->_m2_1_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_1_2_m" name="_m2_1_2_m" <?php if(isset($user_auth->_m2_1_2) && $user_auth->_m2_1_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td>사업수지
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_1_3" name="_m2_1_3" <?php if(isset($user_auth->_m2_1_3) && $user_auth->_m2_1_3>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_1_3_m" name="_m2_1_3_m" <?php if(isset($user_auth->_m2_1_3) && $user_auth->_m2_1_3>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td></td>
								</tr>
								<tr>
									<td style="border-top: 0;"><strong>프로세스 관리</strong></td>
									<td style="border-top: 0;">진행현황
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_2_1" name="_m2_2_1" <?php if(isset($user_auth->_m2_2_1) && $user_auth->_m2_2_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_2_1_m" name="_m2_2_1_m" <?php if(isset($user_auth->_m2_2_1) && $user_auth->_m2_2_1>1) echo 'checked'; ?> disabled>등록
										</label>
									</td>
									<td style="border-top: 0;">일정관리
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_2_2" name="_m2_2_2" <?php if(isset($user_auth->_m2_2_2) && $user_auth->_m2_2_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_2_2_m" name="_m2_2_2_m" <?php if(isset($user_auth->_m2_2_2) && $user_auth->_m2_2_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;">프로세스
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_2_3" name="_m2_2_3" <?php if(isset($user_auth->_m2_2_3) && $user_auth->_m2_2_3>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m2_2_3_m" name="_m2_2_3_m" <?php if(isset($user_auth->_m2_2_3) && $user_auth->_m2_2_3>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;"></td>
								</tr>
								<tr>
									<th class="center" rowspan="2" style="vertical-align: middle; border-right: 1px solid #ddd; background-color: #f0f0f0;">프로젝트</th>
									<td><strong>프로젝트 관리</strong></td>
									<td>데이터 등록
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_1_1" name="_m3_1_1" <?php if(isset($user_auth->_m3_1_1) && $user_auth->_m3_1_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_1_1_m" name="_m3_1_1_m" <?php if(isset($user_auth->_m3_1_1) && $user_auth->_m3_1_1>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td>데이터 수정
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_1_2" name="_m3_1_2" <?php if(isset($user_auth->_m3_1_2) && $user_auth->_m3_1_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_1_2_m" name="_m3_1_2_m" <?php if(isset($user_auth->_m3_1_2) && $user_auth->_m3_1_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td style="border-top: 0;"><strong>신규 프로젝트</strong></td>
									<td style="border-top: 0;">검토 프로젝트
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_2_1" name="_m3_2_1" <?php if(isset($user_auth->_m3_2_1) && $user_auth->_m3_2_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_2_1_m" name="_m3_2_1_m" <?php if(isset($user_auth->_m3_2_1) && $user_auth->_m3_2_1>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;">프로젝트 등록
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_2_2" name="_m3_2_2" <?php if(isset($user_auth->_m3_2_2) && $user_auth->_m3_2_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m3_2_2_m" name="_m3_2_2_m" <?php if(isset($user_auth->_m3_2_2) && $user_auth->_m3_2_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;"></td>
									<td style="border-top: 0;"></td>
								</tr>
								<tr>
									<th  class="center"rowspan="2" style="vertical-align: middle; border-right: 1px solid #ddd; background-color: #f0f0f0;">자금회계</th>
									<td><strong>자금현황</strong></td>
									<td>자금일보
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_1_1" name="_m4_1_1" <?php if(isset($user_auth->_m4_1_1) && $user_auth->_m4_1_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_1_1_m" name="_m4_1_1_m" <?php if(isset($user_auth->_m4_1_1) && $user_auth->_m4_1_1>1) echo 'checked'; ?> disabled>등록
										</label>
									</td>
									<td>입출금 내역
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_1_2" name="_m4_1_2" <?php if(isset($user_auth->_m4_1_2) && $user_auth->_m4_1_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_1_2_m" name="_m4_1_2_m" <?php if(isset($user_auth->_m4_1_2) && $user_auth->_m4_1_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td>입출금 등록
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_1_3" name="_m4_1_3" <?php if(isset($user_auth->_m4_1_3) && $user_auth->_m4_1_3>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_1_3_m" name="_m4_1_3_m" <?php if(isset($user_auth->_m4_1_3) && $user_auth->_m4_1_3>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td></td>
								</tr>
								<tr>
									<td style="border-top: 0;"><strong>회계관리</strong></td>
									<td style="border-top: 0;">분개장
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_2_1" name="_m4_2_1" <?php if(isset($user_auth->_m4_2_1) && $user_auth->_m4_2_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_2_1_m" name="_m4_2_1_m" <?php if(isset($user_auth->_m4_2_1) && $user_auth->_m4_2_1>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;">일/월계표
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_2_2" name="_m4_2_2" <?php if(isset($user_auth->_m4_2_2) && $user_auth->_m4_2_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_2_2_m" name="_m4_2_2_m" <?php if(isset($user_auth->_m4_2_2) && $user_auth->_m4_2_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;">제무제표
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_2_3" name="_m4_2_3" <?php if(isset($user_auth->_m4_2_3) && $user_auth->_m4_2_3>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m4_2_3_m" name="_m4_2_3_m" <?php if(isset($user_auth->_m4_2_3) && $user_auth->_m4_2_3>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;"></td>
								</tr>
								<tr>
									<th class="center" rowspan="2" style="vertical-align: middle; border-right: 1px solid #ddd; background-color: #f0f0f0;">환경설정</th>
									<td><strong>기본정보 관리</strong></td>
									<td>부서정보 관리
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_1" name="_m5_1_1" <?php if(isset($user_auth->_m5_1_1) && $user_auth->_m5_1_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_1_m" name="_m5_1_1_m" <?php if(isset($user_auth->_m5_1_1) && $user_auth->_m5_1_1>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td>직원정보 관리
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_2" name="_m5_1_2" <?php if(isset($user_auth->_m5_1_2) && $user_auth->_m5_1_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_2_m" name="_m5_1_2_m" <?php if(isset($user_auth->_m5_1_2) && $user_auth->_m5_1_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td>거래처정보관리
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_3" name="_m5_1_3" <?php if(isset($user_auth->_m5_1_3) && $user_auth->_m5_1_3>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_3_m" name="_m5_1_3_m" <?php if(isset($user_auth->_m5_1_3) && $user_auth->_m5_1_3>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td>은행계좌 관리
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_4" name="_m5_1_4" <?php if(isset($user_auth->_m5_1_4) && $user_auth->_m5_1_4>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_1_4_m" name="_m5_1_4_m" <?php if(isset($user_auth->_m5_1_4) && $user_auth->_m5_1_4>1) echo 'checked'; ?>>등록
										</label>
									</td>
								</tr>
								<tr>
									<td style="border-top: 0;"><strong>회사정보 관리</strong></td>
									<td style="border-top: 0;">회사 기본정보
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_2_1" name="_m5_2_1" <?php if(isset($user_auth->_m5_2_1) && $user_auth->_m5_2_1>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_2_1_m" name="_m5_2_1_m" <?php if(isset($user_auth->_m5_2_1) && $user_auth->_m5_2_1>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;">사용자권한관리
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_2_2" name="_m5_2_2" <?php if(isset($user_auth->_m5_2_2) && $user_auth->_m5_2_2>0) echo 'checked'; ?>>조회
										</label>
										<label class="checkbox-inline">
											<input type="checkbox" id="_m5_2_2_m" name="_m5_2_2_m" <?php if(isset($user_auth->_m5_2_2) && $user_auth->_m5_2_2>1) echo 'checked'; ?>>등록
										</label>
									</td>
									<td style="border-top: 0;"></td>
									<td style="border-top: 0;"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
<?php if($auth<2) {$submit_str = "alert('등록 권한이 없습니다!')"; } else {$submit_str = "auth_submit('".$this->input->get('un')."');";} ?>
				<div class="row btn-wrap" style="height:62px; padding-top: 15px; margin:0 0 50px 0; background-color: #f8f8f8; border-top:1px solid #B2BCDE; border-bottom: 1px solid #ddd; text-align: right; padding-right: 15px;">
					<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str?>" value=" 권한 설정 ">
				</div>
			</fieldset>
		</form>
