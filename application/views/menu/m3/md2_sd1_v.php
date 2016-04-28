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
						<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
							<label for="address2" class="sr-only">회사주소2</label>
							<input type="text" class="form-control input-sm" id="address2" maxlength="100" value="" name="address2" placeholder="나머지 주소">
						</div>
						<!-- <div class="col-xs-12 col-sm-12 col-md-3 glyphicon-wrap" style="padding: 11px;">나머지 주소</div> -->
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="buy_land_extent">대지 매입면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="buy_land_extent" name="buy_land_extent" maxlength="30" value="" required autofocus placeholder="대지 매입면적 (㎡)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="scheme_land_extent">계획 대지면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="scheme_land_extent" name="scheme_land_extent" maxlength="30" value="" required autofocus placeholder="계획 대지면적 (㎡)">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="build_size">건축 규모 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="build_size" name="build_size" maxlength="30" value="" required autofocus placeholder="건축 규모 (동수/최고층 등)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="num_unit">세대(호/실) 수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="num_unit" name="num_unit" maxlength="30" value="" required autofocus placeholder="세대(호/실) 수">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="build_area">건축 면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="build_area" name="build_area" maxlength="30" value="" required autofocus placeholder="건축 면적 (㎡)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="gr_floor_area">총 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="gr_floor_area" name="gr_floor_area" maxlength="30" value="" required autofocus placeholder="총 연면적 (㎡)">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="on_floor_area">지상 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="on_floor_area" name="on_floor_area" maxlength="30" value="" required autofocus placeholder="지상 연면적 (㎡)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">지하 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="ba_floor_area" name="ba_floor_area" maxlength="30" value="" required autofocus placeholder="지하 연면적 (㎡)">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="floor_ar_rat">용적율 (%) <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="floor_ar_rat" name="floor_ar_rat" maxlength="30" value="" required autofocus placeholder="용적율 (%)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="bu_to_la_rat">건폐율 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="bu_to_la_rat" name="bu_to_la_rat" maxlength="30" value="" required autofocus placeholder="건폐율 (%)">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="law_num_parking">법정 주차대수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="law_num_parking" name="law_num_parking" maxlength="30" value="" required autofocus placeholder="법정 주차대수">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="plan_num_parking">계획 주차대수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm" id="plan_num_parking" name="plan_num_parking" maxlength="30" value="" required autofocus placeholder="계획 주차대수">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8 font13" style="padding: 25px 0 5px 15px;">
							<strong>* <span style="color: #d60740;">타입 등록</span></strong>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name">타입별 정보등록 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<input type="text" class="form-control input-sm han" id="type_name" name="type_name" maxlength="30" value="" required autofocus placeholder="타입">
						</div>
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<label for="type_color" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm han" id="type_color" name="type_color" maxlength="30" value="" required autofocus placeholder="컬러">
						</div>
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<label for="type_quantity" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm han" id="type_quantity" name="type_quantity" maxlength="30" value="" required autofocus placeholder="타입별 단위 수량">
						</div>
						<div class="col-xs-3 col-sm-2" style="padding-right: 0;">
							<label for="type_q_unit" class="sr-only">수량</span></label>
							<select class="form-control input-sm" id="type_q_unit" name="type_q_unit" required autofocus>
								<option value="0">단위</option>
								<option value="1">세대</option>
								<option value="2">실</option>
								<option value="3">호</option>
								<option value="4">㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-4 form-inline" style="padding: 10px 0 0 8px;">
							<input type="checkbox" class="checkbox" name="ck2_1" id="ck2_1" onclick="type_reg('2',this,1);"><span> 타입추가</span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8 font13" style="padding: 25px 0 5px 15px;">
							<strong>* <span style="color: #d60740;">추가 정보</span</strong>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="land_cost">토지 매입비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="land_cost" name="land_cost" maxlength="30" value="">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="build_cost">평당 건축비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="build_cost" name="build_cost" maxlength="30" value="">
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="arc_design_cost">설계 용역비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="arc_design_cost" name="arc_design_cost" maxlength="30" value="">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="supervision_cost">감리 용역비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="supervision_cost" name="supervision_cost" maxlength="30" value="">
						</div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="initial_inves">시행사 초기투자금</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="initial_inves" name="initial_inves" maxlength="30" value="">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">시행대행 용역비 (세대당)</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="supervision_cost" name="supervision_cost" maxlength="30" value="">
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
							<input type="text" class="form-control input-sm han" id="supervision_cost" name="supervision_cost" maxlength="30" value="">
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
							<input type="text" class="form-control input-sm han" id="supervision_cost" name="supervision_cost" maxlength="30" value="">
						</div>
					</div>
				</div>
                <div class="form-group">
                      &nbsp;
                </div>

<?php // if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="com_submit('1');";} ?>
				<div class="form-group btn-wrap" style="margin: 0;">
					<input type="button" class="btn btn-primary btn-sm" onclick="submit();" value="등록하기">
				</div>

			</fieldset>
		</form>
      </div>
