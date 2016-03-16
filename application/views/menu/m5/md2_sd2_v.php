		<div class="main_start"></div>
		<!-- 5. 환경설정 -> 2. 회사정보관리 ->2. 사용자 권한 관리 페이지 -->

		<div class="row <?php if( !$this->agent->is_mobile()) echo 'no-mobile';?>">
			<!-- 신규 사용자 등록자가 있을 때 처리 시작 -->
<?php if($new_rq) : ?>
					<input type="hidden" name="mem">
					<input type="hidden" name="sf">
					<div class="row" style="margin: 0 15px; border-width: 0 0 1px 0; border-style: solid; border-color: #cccccc;">
						<div class="col-md-12" style="height: 40px; padding-top: 10px;">
							<b><font color="red">*</font> <font color="black">신규 사용자 등록 신청 건이 있습니다.</font></b>
						</div>
					</div>
					<div class="row" style="background-color: #F4F4F4; margin: 0 15px; border-width: 0 0 1px 0; border-style: solid; border-color: #cccccc;">
						<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">성 명</div>
						<div class="col-md-3 center" style="height: 40px; padding-top: 10px;">구 분</div>
						<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">Email</div>
						<div class="col-md-3 center" style="height: 40px; padding-top: 10px;">등록 신청일시</div>
						<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">승인처리</div>
					</div>
<?php foreach($new_rq as $lt) : ?>
<?php if($auth<2) $perm_str="alert('승인(거부) 권한이 없습니다!')"; else $perm_str="permition('$lt->no',this.value);"; ?>
			<div class="row" style="margin: 0 15px; border-width: 0 0 1px 0; border-style: solid; border-color: #cccccc;">
				<div class="col-md-2 center" style="height: 40px; padding-top: 10px;"><?php echo $lt->user_id."-".$lt->no; ?></div>
				<div class="col-md-3 center" style="height: 40px; padding-top: 10px;">(주) 바램디앤씨</div>
				<div class="col-md-2 center" style="height: 40px; padding-top: 10px;"><?php echo $lt->email; ?></div>
				<div class="col-md-3 center" style="height: 40px; padding-top: 10px;"><?php echo $lt->reg_date; ?></div>
				<div class="col-md-2 center" style="height: 40px; padding-top: 10px;">
					<button class="btn btn-success btn-xs" value="승인" onclick="<?php echo $perm_str; ?>">승인</button>
					<button class="btn btn-danger btn-xs" value="거부" onclick="<?php echo $perm_str; ?>">거부</button>
				</div>
			</div>
<?php endforeach; ?>
<?php endif; ?>
			<!-- 신규 사용자 등록자가 있을 때 처리 종료 -->






			<div class="form-group" style="height:50px; padding-top: 15px; margin:0 15px 20px 15px; background-color: #f8f8f8; border-width:0 0 1px 0; border-color:#cccccc; border-style: solid;">
				<div class="col-xs-3 col-sm-3 col-md-2 center">
					<b><font color="red">*</font> <font color="black">권한 설정할 직원 선택</font></b>
				</div>
				<div class="col-xs-9 col-sm-9 col-md-10">
					<span>(주) 바램디앤씨</span>&nbsp;
					 <select>
					 	<option>선 택</option>
					 	<option>선 택</option>
					 	<option>선 택</option>
					 	<option>선 택</option>
					 </select>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-md-12 table-responsive">
				<table class="table auth-table">
					<thead>
						<tr>
							<th class="col-md-1">대분류</th>
							<th class="col-md-1">소분류</th>
							<th class="col-md-10" colspan="4">사용자 권한 관리</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th rowspan="2">분양관리</th>
							<td>계약현황</td>
							<td class="col-md-2">계약현황
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_1_1" name="_m1_1_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_1_1" name="_m1_1_1">등록
								</label>
							</td>
								<td class="col-md-2">계약등록
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_1_2" name="_m1_1_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_1_2" name="_m1_1_2">등록
								</label>
							</td>
							<td class="col-md-2">동호수 현황
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_1_3" name="_m1_1_3">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_1_3" name="_m1_1_3">등록
								</label>
							</td>
							<td class="col-md-2"></td>
						</tr>
						<tr>
								<!-- <td>2</td> -->
							<td>수납현황</td>
							<td>수납현황
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_2_1" name="_m1_2_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_2_1" name="_m1_2_1">등록
								</label>
							</td>
							<td>수납등록
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_2_2" name="_m1_2_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_2_2" name="_m1_2_2">등록
								</label>
							</td>
							<td>요약집계
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_2_3" name="_m1_2_3">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m1_2_3" name="_m1_2_3">등록
								</label>
							</td>
							<td></td>
						</tr>
						<tr>
							<th rowspan="2">사업관리</th>
							<td>예산집행 관리</td>
							<td>집행현황
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_1_1" name="_m2_1_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_1_1" name="_m2_1_1">등록
								</label>
							</td>
							<td>집행등록
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_1_2" name="_m2_1_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_1_2" name="_m2_1_2">등록
								</label>
							</td>
							<td>사업수지
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_1_3" name="_m2_1_3">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_1_3" name="_m2_1_3">등록
								</label>
							</td>
							<td></td>
						</tr>
						<tr>
							<!-- <td>3</td> -->
							<td>프로세스 관리</td>
							<td>진행현황
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_2_1" name="_m2_2_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_2_1" name="_m2_2_1">등록
								</label>
							</td>
							<td>일정관리
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_2_2" name="_m2_2_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_2_2" name="_m2_2_2">등록
								</label>
							</td>
							<td>프로세스
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_2_3" name="_m2_2_3">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m2_2_3" name="_m2_2_3">등록
								</label>
							</td>
							<td></td>
						</tr>
						<tr>
							<th rowspan="2">프로젝트</th>
							<td>프로젝트 관리</td>
							<td>데이터 등록
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_1_1" name="_m3_1_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_1_1" name="_m3_1_1">등록
								</label>
							</td>
							<td>데이터 수정
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_1_2" name="_m3_1_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_1_2" name="_m3_1_2">등록
								</label>
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<!-- <td>3</td> -->
							<td>신규 프로젝트</td>
							<td>검토 프로젝트
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_2_1" name="_m3_2_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_2_1" name="_m3_2_1">등록
								</label>
							</td>
							<td>프로젝트 등록
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_2_2" name="_m3_2_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m3_2_2" name="_m3_2_2">등록
								</label>
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<th rowspan="2">자금회계</th>
							<td>자금현황</td>
							<td>자금일보
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_1_1" name="_m4_1_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_1_1" name="_m4_1_1">등록
								</label>
							</td>
							<td>입출금 내역
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_1_2" name="_m4_1_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_1_2" name="_m4_1_2">등록
								</label>
							</td>
							<td>입출금 등록
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_1_3" name="_m4_1_3">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_1_3" name="_m4_1_3">등록
								</label>
							</td>
							<td></td>
						</tr>
						<tr>
							<!-- <td>3</td> -->
							<td>회계관리</td>
							<td>분개장
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_2_1" name="_m4_2_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_2_1" name="_m4_2_1">등록
								</label>
							</td>
							<td>일/월계표
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_2_2" name="_m4_2_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_2_2" name="_m4_2_2">등록
								</label>
							</td>
							<td>제무제표
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_2_3" name="_m4_2_3">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m4_2_3" name="_m4_2_3">등록
								</label>
							</td>
							<td></td>
						</tr>
						<tr>
							<th rowspan="2">환경설정</th>
							<td>기본정보 관리</td>
							<td>부서정보 관리
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_1" name="_m5_1_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_1" name="_m5_1_1">등록
								</label>
							</td>
							<td>직원정보 관리
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_2" name="_m5_1_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_2" name="_m5_1_2">등록
								</label>
							</td>
							<td>거래처정보관리
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_3" name="_m5_1_3">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_3" name="_m5_1_3">등록
								</label>
							</td>
							<td>은행계좌 관리
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_4" name="_m5_1_4">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_1_4" name="_m5_1_4">등록
								</label>
							</td>
						</tr>
						<tr>
							<!-- <td>3</td> -->
							<td>회사정보 관리</td>
							<td>회사 기본정보
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_2_1" name="_m5_2_1">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_2_1" name="_m5_2_1">등록
								</label>
							</td>
							<td>사용자권한관리
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_2_2" name="_m5_2_2">조회
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="_m5_2_2" name="_m5_2_2">등록
								</label>
							</td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row btn-wrap" style="height:62px; padding-top: 15px; margin:0 0 50px 0; background-color: #f8f8f8; border-width:1px 0 1px 0; border-color:#CCCCCC; border-style: solid; text-align: right; padding-right: 15px;">
			<input type="button" class="btn btn-primary btn-sm" onclick="" value="등록하기">
		</div>
