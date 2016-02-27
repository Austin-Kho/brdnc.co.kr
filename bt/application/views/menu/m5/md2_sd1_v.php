<!-- 5. 환경설정 -> 2. 회사정보관리 ->1. 회사정보 페이지 -->
<form class="form-inline">
	<fieldset style="font-size: 12px;">
		<div class="row" style="margin: 0px; <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="co_name" style="width:180px;">
					회사명 <span style="color:#cc0000">*</span>
				</label>
			</div>

			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<input type="text" class="form-control input-sm" id="co_name" name="co_name" style=" margin: 2px 0;">
			</div>

			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="co_no1" style="width:180px;">사업자번호 <span style="color:#cc0000">*</span></label>
			</div>

			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="co_no1" name="co_no1" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-2" style="padding: 0;">
                          <label for="co_no2" class="sr-only">사업자번호2 </label>
                          <input type="text" class="form-control input-sm" id="co_no2" name="co_no2" ime-mode:disabled; style="width:90%; margin: 2px 0;">
                      </div>
				<div class="col-xs-3" style="padding: 0;">
                           <label for="co_no3" class="sr-only">사업자번호3 </label>
                          <input type="text" class="form-control input-sm" id="co_no3" name="co_no3" ime-mode:disabled; style="width:90%; margin: 2px 0;">
                      </div>
				<div class="col-xs-4" style="padding: 0;">
                          	<label for="co_form" class="sr-only">사업자종류 </label>
					<select class="form-control input-sm" id="co_form" name="co_form" style="width:90%; margin: 2px 0;">
						<option value="">선택</option>
						<option value="1">법인</option>
						<option value="2">개인(일반)</option>
						<option value="3">개인(간이)</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row" style="margin: 0px; <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="ceo" style="width:180px;">
					대표자 <span style="color:#cc0000">*</span>
				</label>
			</div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<input type="text" class="form-control input-sm" id="ceo" name="ceo" style=" margin: 2px 0;">
			</div>

			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="or_no1" style="width:180px;">법인(주민)등록번호 <span style="color:#cc0000">*</span></label>
			</div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="or_no1" name="or_no1" ime-mode:disabled; style="width:95%; margin: 2px 0;"></div>
		        	<div class="col-xs-4" style="padding: 0;">
		        		<label for="or_no2" class="sr-only">법인(주민)등록번호2 </label>
		        		<input type="text" class="form-control input-sm" id="or_no2" name="or_no2" ime-mode:disabled; style="width:90%; margin: 2px 0;">
		        	</div>
		        	<div class="col-xs-5" style="padding: 0;">
		        		<label for="sur" class="sr-only">부가세신고주기</label>
					<select class="form-control input-sm" id="sur" name="sur" style="width:90%; margin: 2px 0;">
						<option value="">선택</option>
						<option value="1">부가세 분기 신고</option>
						<option value="2">부가세 반기 신고</option>
						<option value="3">부가세 월별 신고</option>
					</select>
				</div>
			</div>
		</div>



		<!-- -------------------------여기까지 작업 했음 ------------------------------------------------------ -->

		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="biz_cond" style="width:180px;">업태 <span style="color:#cc0000">*</span></label>
			</div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
					<input type="text" class="form-control input-sm" id="biz_cond" name="biz_cond" placeholder="ID" ime-mode:disabled; style="margin: 2px 0;">
			</div>

			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="biz_even" style="width:180px;">종목 <span style="color:#cc0000">*</span></label>
			</div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<input type="text" class="form-control input-sm" id="biz_even" name="biz_even" placeholder="ID" ime-mode:disabled; style="margin: 2px 0;">
			</div>
		</div>

		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="co_phone1" style="width:180px;">대표전화 <span style="color:#cc0000">*</span></label>
			</div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="co_phone1" name="co_phone1" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-3" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="co_phone2" name="co_phone2" ime-mode:disabled; style="width:90%; margin: 2px 0;">
				</div>
				<div class="col-xs-3" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="co_phone3" name="co_phone3" ime-mode:disabled; style="width:90%; margin: 2px 0;">
				</div>
				<div class="col-xs-3" style="padding: 0;"></div>
			</div>

			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">  휴대전화(비상) <span style="color:#cc0000">*</span></label>
			</div>

			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:90%; margin: 2px 0;">
						<option>선택</option>
						<option>010</option>
						<option>011</option>
						<option>016</option>
						<option>017</option>
						<option>018</option>
						<option>019</option>
					</select>
				</div>
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-3" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;">
				</div>
				<div class="col-xs-3" style="padding: 0;"></div>
			</div>
		</div>

		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;"><label for="user_id" style="width:180px;">FAX</label></div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-3" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;">
				</div>
				<div class="col-xs-3" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;">
				</div>
				<div class="col-xs-3" style="padding: 0;"></div>
			</div>

			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px;  background-color: #F8F8F8;"><label for="user_id" style="width:180px;">기업구분</label></div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:90%; margin: 2px 0;">
						<option>선택</option>
						<option>법인</option>
						<option>개인(일반)</option>
						<option>개인(간이)</option>
					</select>
				</div>
				<div class="col-xs-3" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:90%; margin: 2px 0;">
						<option>선택</option>
						<option>법인</option>
						<option>개인(일반)</option>
						<option>개인(간이)</option>
					</select>
				</div>
				<div class="col-xs-3" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:90%; margin: 2px 0;">
						<option>선택</option>
						<option>법인</option>
						<option>개인(일반)</option>
						<option>개인(간이)</option>
					</select>
				</div>
				<div class="col-xs-3" style="padding: 0;"></div>
			</div>
		</div>




		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px;  background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">설립일자 <span style="color:#cc0000">*</span></label>
			</div>
			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px; ">
				<div class="col-xs-6" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="user_id" name="user_id" placeholder="ID" ime-mode:disabled; style="width: 100%; margin: 2px 0;">
				</div>
				<div class="col-xs-6" style="padding: 8px 0 0 8px;"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></div>
			</div>

			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px;  background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">개업일자 <span style="color:#cc0000">*</span></label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px; ">
				<div class="col-xs-6" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="user_id" name="user_id" placeholder="ID" ime-mode:disabled; style="width: 100%; margin: 2px 0;">
				</div>
				<div class="col-xs-6" style="padding: 8px 0 0 8px;"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></div>
			</div>
		</div>



		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">기초잔액 입력월 <span style="color:#cc0000">*</span></label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-1" style="padding: 8px 0 0 0;">년</div>
				<div class="col-xs-2" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-6" style="padding: 8px 0 0 0;">월</div>
			</div>


			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">업무개시월 <span style="color:#cc0000">*</span>/ 결산주기 <span style="color:#cc0000">*</span></label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:90%; margin: 2px 0;">
						<option>선택</option>
						<option>01</option>
						<option>02</option>
						<option>03</option>
						<option>04</option>
						<option>05</option>
						<option>06</option>
						<option>07</option>
						<option>08</option>
						<option>09</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
					</select>
				</div>
				<div class="col-xs-1" style="padding: 8px 0 0 0;">월/</div>
				<div class="col-xs-3" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:90%; margin: 2px 0;">
						<option>선택</option>
						<option>01</option>
						<option>02</option>
						<option>03</option>
						<option>04</option>
						<option>06</option>
						<option>12</option>
					</select>
				</div>
				<div class="col-xs-5" style="padding: 8px 0 0 0;">개월</div>
			</div>
		</div>


		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">E-mail(비상) <span style="color:#cc0000">*</span>	</label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-1" style="padding: 8px 0 0 0;">@</div>
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-5" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:70%; margin: 2px 0;">
						<option>직접입력</option>
						<option>네이버</option>
						<option>다음</option>
						<option>지메일</option>
					</select>
				</div>
			</div>


			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">전자세금계산서 Email</label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-1" style="padding: 8px 0 0 0;">@</div>
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-5" style="padding: 0;">
					<select class="form-control input-sm" id="mobile1" name="mobile1" style="width:70%; margin: 2px 0;">
						<option>직접입력</option>
						<option>네이버</option>
						<option>다음</option>
						<option>지메일</option>
					</select>
				</div>
			</div>
		</div>



		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">세무서[1] <span style="color:#cc0000">*</span></label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-4" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-5" style="padding: 0;"></div>
			</div>


			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">세무서[2]</label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-4" style="padding: 3px 0 3px 10px;">
				<div class="col-xs-3" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-4" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:90%; margin: 2px 0;"></div>
				<div class="col-xs-5" style="padding: 0;"></div>
			</div>
		</div>




		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">회사주소 <span style="color:#cc0000">*</span></label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-10" style="padding: 3px 0 3px 10px;">
				<div class="col-md-1 col-sm-2 col-xs-3" style="padding: 0;"><a href="" class="btn btn-info btn-sm" style="width: 90%; margin: 2px 0;">우편번호</a></div>
				<div class="col-md-1 col-sm-5 col-xs-3" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="zipcode" name="zipcode" ime-mode:disabled; style="width:95%; margin: 2px 0;">
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:98%; margin: 2px 0;">
				</div>

				<div class="col-md-3 col-sm-6 ol-xs-12" style="padding: 0;">
					<input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:98%; margin: 2px 0;">
				</div>
				<div class="col-md-3 col-sm-12 col-xs-12" style="padding: 8px 0 0 8px;">나머지 주소</div>
			</div>
		</div>



		<div class="row" style="margin: 0px;  <?php if( !is_mobile()) echo 'border-width:1px 0 0 0; border-style:solid; border-color:#CACAC1;';?>">
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px; background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">회사 영문명</label>
			</div>


			<div class="form-group col-xs-12 col-sm-8 col-md-10" style="padding: 3px 0 3px 10px;">
				<div class="col-md-6 col-xs-12" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:99%; margin: 2px 0;"></div>
				<div class="col-md-6 col-xs-12" style="padding: 8px 0 0 0;">기타소득 지급조서 신고가 있는 경우 입력</div>
			</div>
		</div>

		<div class="row" style="margin: 0px; padding-bottom: 18px; <?php if( !is_mobile()) echo 'border-width:1px 0 1px 0; border-style:solid; border-color:#CACAC1;';?>" >
			<div class="form-group col-xs-12 col-sm-4 col-md-2" style="padding: 11px 0 3px 15px;  background-color: #F8F8F8;">
				<label for="user_id" style="width:180px;">회사 영문주소</label>
				<div class="col-xs-12">&nbsp;</div>
			</div>
			<div class="form-group col-xs-12 col-sm-8 col-md-10" style="padding: 3px 0 3px 10px; ">
				<div class="col-md-10 col-xs-12" style="padding: 0;"><input type="text" class="form-control input-sm" id="user_id" name="user_id" ime-mode:disabled; style="width:100%; margin: 2px 0;"></div>
				<div class="col-md-2" style="padding: 0;">&nbsp;</div>
				<div class="col-xs-12">번지(number), 거리(street), 시(city), 도(state), 우편번호(postal code), 국가(country) 순으로 기재</div>
			</div>
		</div>


		<div class="row" style="margin: 0px; padding: 15px 20px 0 0; text-align: right; height: 60px; border-width:0 0 1px 0; border-style:solid; border-color:#B2BCDE; background-color: #F8F8F8; margin-bottom: 25px;">
			<button class="btn btn-primary btn-sm">입력하기</button>
		</div>

	</fieldset>
</form>