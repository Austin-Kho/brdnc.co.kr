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
							<input type="text" class="form-control input-sm en_only" id="zipcode" name="zipcode" maxlength="5" value="" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
							<label for="address1" class="sr-only">회사주소1</label>
							<input type="text" class="form-control input-sm han" id="address1" name="address1" maxlength="100" value="" readonly required autofocus>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
							<label for="address2" class="sr-only">회사주소2</label>
							<input type="text" class="form-control input-sm han" id="address2" maxlength="100" value="" name="address2" placeholder="나머지 주소">
						</div>
						<!-- <div class="col-xs-12 col-sm-12 col-md-3 glyphicon-wrap" style="padding: 11px;">나머지 주소</div> -->
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="buy_land_extent">대지 매입면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="buy_land_extent" name="buy_land_extent" maxlength="10" value="" required autofocus placeholder="대지 매입면적 (㎡)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="scheme_land_extent">계획 대지면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="scheme_land_extent" name="scheme_land_extent" maxlength="10" value="" required autofocus placeholder="계획 대지면적 (㎡)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="build_size">건축 규모</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="build_size" name="build_size" maxlength="30" value="" placeholder="건축 규모 (동수/최고층 등)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="num_unit">세대(호/실) 수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="num_unit" name="num_unit" maxlength="6" value="" required autofocus placeholder="세대(호/실) 수">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>세대(호/실)</span></div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="build_area">건축 면적</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="build_area" name="build_area" maxlength="10" value=""  placeholder="건축 면적 (㎡)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="gr_floor_area">총 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="gr_floor_area" name="gr_floor_area" maxlength="10" value="" required autofocus placeholder="총 연면적 (㎡)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="on_floor_area">지상 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="on_floor_area" name="on_floor_area" maxlength="10" value="" required autofocus placeholder="지상 연면적 (㎡)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="co_no1">지하 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="ba_floor_area" name="ba_floor_area" maxlength="10" value="" required autofocus placeholder="지하 연면적 (㎡)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="floor_ar_rat">용적율 (%) <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="floor_ar_rat" name="floor_ar_rat" maxlength="6" value="" required autofocus placeholder="용적율 (%)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>%</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="bu_to_la_rat">건폐율</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="bu_to_la_rat" name="bu_to_la_rat" maxlength="6" value=""  placeholder="건폐율 (%)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>%</span></div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="law_num_parking">법정 주차대수</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="law_num_parking" name="law_num_parking" maxlength="6" value=""  placeholder="법정 주차대수">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>대</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="plan_num_parking">계획 주차대수</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="plan_num_parking" name="plan_num_parking" maxlength="6" value=""  placeholder="계획 주차대수">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>대</span></div>
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
						<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name" name="type_name" maxlength="10" value="" required autofocus placeholder="타입">
						</div>
                                    <div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>타입</span></div>
						<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
							<label for="type_color" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color" name="type_color" maxlength="7" value=""  placeholder="컬러">
						</div>
						<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
							<label for="type_quantity" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity" name="type_quantity" maxlength="5" value="" required autofocus placeholder="타입별 단위 수량">
						</div>
                                    <div class="col-xs-1" style="padding: 11px 0 0 8px;"><span>세대</span></div>
						<div class="col-xs-2 col-sm-2" style="padding-right: 0;">
							<label for="type_q_unit" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="type_q_unit" name="type_q_unit">
								<option value="0">단위</option>
								<option value="1">세대</option>
								<option value="2">실</option>
								<option value="3">호</option>
								<option value="4">㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2">
                                          <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                                                <label>
            							<input type="checkbox" class="checkbox" name="ck2_1" id="ck2_1" onclick="type_reg('2',this,1);">
                                                      <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                                                </label>
                                          </div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-12 col-md-12 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8 font13" style="padding: 25px 0 5px 15px;">
							<strong>* <span style="color: #d60740;">추가 정보</span></strong>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="land_cost">토지 매입비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="land_cost" name="land_cost" maxlength="10" value="" placeholder="토지 매입비 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="build_cost">평당 건축비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="build_cost" name="build_cost" maxlength="5" value="" placeholder="평당 건축비 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="arc_design_cost">설계 용역비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="arc_design_cost" name="arc_design_cost" maxlength="8" value="" placeholder="설계 용역비 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="supervision_cost">감리 용역비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="supervision_cost" name="supervision_cost" maxlength="8" value="" placeholder="감리 용역비 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="initial_inves">시행사 초기투자금</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="initial_inves" name="initial_inves" maxlength="10" value="" placeholder="시행사 초기 투자금 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="dev_agency_charge">시행대행 용역비 (세대당)</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="dev_agency_charge" name="dev_agency_charge" maxlength="5" value="" placeholder="시행대행 용역비 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="bridge_loan">브리지 차입규모</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="bridge_loan" name="bridge_loan" maxlength="10" value="" placeholder="브리지 차입규모 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="pf_loan">PF 차입규모</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="pf_loan" name="pf_loan" maxlength="10" value="" placeholder="PF 차입규모 (단위:천원)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>

					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="con_lead_time">공사 소요기간</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="con_lead_time" name="con_lead_time" maxlength="4" value="" placeholder="공사 소요기간 (개월)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>개월</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="biz_start_year">사업 개시 년</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-5 col-sm-4">
							<input type="text" class="form-control input-sm en_only" id="biz_start_year" name="biz_start_year" maxlength="4" value="" placeholder="YYYY">
						</div>
                                    <div class="col-xs-1" style="padding: 11px 0;"><span>년</span></div>
                                    <div class="col-xs-4 col-sm-3">
                                          <label for="biz_start_month" class="sr-only">사업개시 월</span></label>
							<input type="text" class="form-control input-sm en_only" id="biz_start_month" name="biz_start_month" maxlength="2" value="" placeholder="MM">
						</div>
                                    <div class="col-xs-1 col-sm-2" style="padding: 11px 0;"><span>월</span></div>
					</div>
				</div>
                  <div class="form-group">
                      <?php echo validation_errors('<div class="error">', '</div>'); ?>&nbsp;
                  </div>

<?php // if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="com_submit('1');";} ?>
				<div class="form-group btn-wrap" style="margin: 0;">
					<input type="button" class="btn btn-primary btn-sm" onclick="submit();" value="등록하기">
				</div>

			</fieldset>
		</form>
      </div>
