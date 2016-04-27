      <div class="main_start">&nbsp;</div>
<!-- 3. 프로젝트 -> 2. 신규 프로젝트 ->1. 신규 등록 -->
      <div class="row" style="margin: 0; padding: 0;">
		<form name="form1" class="" action="" method="post">
			<fieldset class="font12">
				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="pj_name">프로젝트 명 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="pj_name" name="pj_name" maxlength="30" value="" required autofocus placeholder="프로젝트 명">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="sort">프로젝트 종류 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<select class="form-control input-sm" id="sort" name="sort" required autofocus>
								<option value="">선택</option>
                                                <option value="1"> 아파트(일반분양)</option>
                                                <option value="2"> 아파트(조합)</option>
                                                <option value="3"> 주상복합(아파트)</option>
                                                <option value="4"> 주상복합(오피스텔)</option>
                                                <option value="5"> 도시형생활주택</option>
                                                <option value="6"> 근린생활시설</option>
                                                <option value="7"> 레저(숙박)시설</option>
                                                <option value="8"> 기 타</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label>대지위치(주소) <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
						<div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="javascript:ZipWindow('/popup/zip_/')">
						</div>
						<div class="col-xs-3 col-sm-5 col-md-1" style="padding-right: 0;">
                                          <label for="zipcode" class="sr-only">우편번호</label>
							<input type="text" class="form-control input-sm" id="zipcode" name="zipcode" maxlength="5" value="" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
							<label for="address1" class="sr-only">회사주소1</label>
							<input type="text" class="form-control input-sm" id="address1" name="address1" maxlength="100" value="" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3" style="padding-right: 0;">
							<label for="address2" class="sr-only">회사주소2</label>
							<input type="text" class="form-control input-sm" id="address2" maxlength="100" value="" name="address2">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 glyphicon-wrap" style="padding: 11px;">나머지 주소</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="buy_land_extent">대지 매입면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="buy_land_extent" name="buy_land_extent" maxlength="30" value="" required autofocus placeholder="대지 매입면적 (㎡)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="scheme_land_extent">계획 대지면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<input type="text" class="form-control input-sm han" id="scheme_land_extent" name="scheme_land_extent" maxlength="30" value="" required autofocus placeholder="계획 대지면적 (㎡)">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">건축규모 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">세대수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">건축면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">총 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">지상층 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">지하층 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">용적율 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">건폐율 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">법정 주차대수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">계획 주차대수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8 font13" style="padding: 18px 0 5px 15px; color: #d60740">
							<strong>타입 등록</strong>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">타입별 정보등록 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus placeholder="타입">
						</div>
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<input type="color" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus placeholder="컬러">
						</div>
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus placeholder="수량">
						</div>
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="0">단위</option>
								<option value="1">세대</option>
								<option value="2">실</option>
								<option value="3">호</option>
								<option value="4">㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-4 form-inline" style="padding: 10px 0 0 8px;">
							<input type="checkbox" class="checkbox" id="co_name" name="co_name" maxlength="30" value="" required autofocus placeholder="수량"><span> 타입추가</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8 font13" style="padding: 18px 0 5px 15px; color: #d60740">
							<strong>추가 정보</strong>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">토지 매입비 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">평당 건축비 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">설계 용역비 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">감리 용역비 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">시행사 초기투자금 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">시행사 세대당 이윤 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">브릿지 차입규모 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">PF 차입규모 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_name">공사 소요기간 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">사업 개시 월 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<label for="co_form" class="sr-only">사업자종류 </label>
							<select class="form-control input-sm" id="co_form" name="co_form" required autofocus>
								<option value="">선택</option>
								<option value="1">법인</option>
								<option value="2">개인(일반)</option>
								<option value="3">개인(간이)</option>
							</select>
						</div>
					</div>
				</div>
                        <div class="form-group">
                              &nbsp;
                        </div>

<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="com_submit('1');";} ?>
				<div class="form-group btn-wrap" style="margin: 0;">
					<input type="button" class="btn btn-primary btn-sm" onclick="<?=$submit_str?>" value="등록하기">
				</div>

			</fieldset>
		</form>
      </div>
