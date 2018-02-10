<?php
  if($auth22<1) :
  	include('no_auth.php');
  else :
?>
    <div class="main_start">&nbsp;</div>
	  <!-- 3. 프로젝트 -> 2. 신규 프로젝트 -> 1. 신규 등록 -->

    <div class="row" style="margin: 0; padding: 0;">
<?php
	$attributes = array('name' => 'form1', 'class' => '', 'method' => 'post');
	echo form_open(current_url(), $attributes);
?>
			<fieldset class="font12">
				<div class="form-group"><!-- 프로젝트명/종류 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="pj_name">프로젝트 명 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<input type="text" class="form-control input-sm han" id="pj_name" name="pj_name" maxlength="30" value="<?php echo set_value('pj_name'); ?>" required placeholder="프로젝트 명">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="sort">프로젝트 종류 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-12 col-sm-8">
							<select class="form-control input-sm" id="sort" name="sort" required>
								<option value="">선택</option>
  	    			  <option value="1" <?php echo set_select('sort', '1'); ?>> 아파트(일반분양)</option>
	    			    <option value="2" <?php echo set_select('sort', '2'); ?>> 아파트(조합)</option>
	    			    <option value="3" <?php echo set_select('sort', '3'); ?>> 주상복합(아파트)</option>
	    			    <option value="4" <?php echo set_select('sort', '4'); ?>> 주상복합(오피스텔)</option>
	    			    <option value="5" <?php echo set_select('sort', '5'); ?>> 도시형생활주택</option>
	    			    <option value="6" <?php echo set_select('sort', '6'); ?>> 근린생활시설</option>
	    			    <option value="7" <?php echo set_select('sort', '7'); ?>> 레저(숙박)시설</option>
	    			    <option value="8" <?php echo set_select('sort', '8'); ?>> 기 타</option>
    					</select>
						</div>
					</div>
				</div>

        <!-- 다음 우편번호 서비스 - iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
        <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
          <img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
        </div>
        <!-- 다음 우편번호 서비스 -------------onclick="execDaumPostcode(1)"-----postcode1-----address1_1-----address2_1------------------------>

				<div class="form-group"><!-- 대지주소 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label>대지위치(주소) <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">

						<div class="col-xs-3 col-sm-5 col-md-1" style="padding-right: 0;">
              				<label for="postcode1" class="sr-only">우편번호</label>
							<input type="text" class="form-control input-sm en_only" id="postcode1" name="postcode1" maxlength="5" value="<?php echo set_value('zipcode'); ?>" readonly required>
						</div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="execDaumPostcode(1)">
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
							<label for="address1_1" class="sr-only">회사주소1</label>
							<input type="text" class="form-control input-sm han" id="address1_1" name="address1_1" maxlength="100" value="<?php echo set_value('address1'); ?>" readonly required>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-4" style="padding-right: 0;">
							<label for="address2_1" class="sr-only">회사주소2</label>
							<input type="text" class="form-control input-sm han" id="address2_1" name="address2_1" maxlength="93" value="<?php echo set_value('address2'); ?>" name="address2" placeholder="나머지 주소">
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
							<input type="text" class="form-control input-sm en_only" id="buy_land_extent" name="buy_land_extent" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('buy_land_extent'); ?>" required placeholder="대지 매입면적 (㎡)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="scheme_land_extent">계획 대지면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="scheme_land_extent" name="scheme_land_extent" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('scheme_land_extent'); ?>" required placeholder="계획 대지면적 (㎡)">
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
							<input type="text" class="form-control input-sm han" id="build_size" name="build_size" maxlength="60" value="<?php echo set_value('build_size'); ?>" placeholder="건축 규모 (동수/최고층 등)">
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="num_unit">세대(호/실) 수 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="num_unit" name="num_unit" onkeydown="onlyNum(this);" maxlength="6" value="<?php echo set_value('num_unit'); ?>" required placeholder="세대(호/실) 수">
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
							<input type="text" class="form-control input-sm en_only" id="build_area" name="build_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('build_area'); ?>"  placeholder="건축 면적 (㎡)">
						</div>
                        <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="gr_floor_area">총 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="gr_floor_area" name="gr_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('gr_floor_area'); ?>" required placeholder="총 연면적 (㎡)">
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
							<input type="text" class="form-control input-sm en_only" id="on_floor_area" name="on_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('on_floor_area'); ?>" required placeholder="지상 연면적 (㎡)">
						</div>
                        <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>㎡</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="ba_floor_area">지하 연면적 <span class="red">*</span></label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="ba_floor_area" name="ba_floor_area" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('ba_floor_area'); ?>" required placeholder="지하 연면적 (㎡)">
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
							<input type="text" class="form-control input-sm en_only" id="floor_ar_rat" name="floor_ar_rat" maxlength="8" value="<?php echo set_value('floor_ar_rat'); ?>" required placeholder="용적율 (%)">
						</div>
                                    <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>%</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="bu_to_la_rat">건폐율</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="bu_to_la_rat" name="bu_to_la_rat" maxlength="8" value="<?php echo set_value('bu_to_la_rat'); ?>"  placeholder="건폐율 (%)">
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
							<input type="text" class="form-control input-sm en_only" id="law_num_parking" name="law_num_parking" onkeydown="onlyNum(this);" maxlength="6" value="<?php echo set_value('law_num_parking'); ?>"  placeholder="법정 주차대수">
						</div>
                        <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>대</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="plan_num_parking">계획 주차대수</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="plan_num_parking" name="plan_num_parking" onkeydown="onlyNum(this);" maxlength="6" value="<?php echo set_value('plan_num_parking'); ?>"  placeholder="계획 주차대수">
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
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_1" name="type_name_1" maxlength="10" value="<?php echo set_value('type_name_1'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_1" name="type_color_1" maxlength="7" value="<?php echo set_value('type_color_1'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_1" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_1" name="type_quantity_1" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_1'); ?>" required placeholder="타입별 단위 수량">
						</div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="count_unit_1" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_1" name="count_unit_1">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_1', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_1', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_1', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_1', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
                          <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                            <label>
                        			<input type="checkbox" name="ck2_1" id="ck2_1" onclick="type_reg('2',this,1);">
                              <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                            </label>
                          </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_2" style="display: none;"><!-- 타입2정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_2">타입별 정보등록(2) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_2" name="type_name_2" maxlength="10" value="<?php echo set_value('type_name_2'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_2" name="type_color_2" maxlength="7" value="<?php echo set_value('type_color_2'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_1" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_2" name="type_quantity_2" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_2'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_2" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_2" name="count_unit_2">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_2', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_2', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_2', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_2', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_2" id="ck2_2" onclick="type_reg('2',this,2);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_3" style="display: none;"><!-- 타입3정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_3">타입별 정보등록(3) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_3" name="type_name_3" maxlength="10" value="<?php echo set_value('type_name_3'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_3" name="type_color_3" maxlength="7" value="<?php echo set_value('type_color_3'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_1" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_3" name="type_quantity_3" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_3'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_3" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_3" name="count_unit_3">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('sort', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('sort', '1'); ?>>실</option>
								<option value="3" <?php echo set_select('sort', '1'); ?>>호</option>
								<option value="4" <?php echo set_select('sort', '1'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_3" id="ck2_3" onclick="type_reg('2',this,3);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_4" style="display: none;"><!-- 타입4정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_4">타입별 정보등록(4) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_4" name="type_name_4" maxlength="10" value="<?php echo set_value('type_name_4'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_4" name="type_color_4" maxlength="7" value="<?php echo set_value('type_color_4'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_4" name="type_quantity_4" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_4'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_4" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_4" name="count_unit_4">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_4', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_4', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_4', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_4', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_4" id="ck2_4" onclick="type_reg('2',this,4);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_5" style="display: none;"><!-- 타입5정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_5">타입별 정보등록(5) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_5" name="type_name_5" maxlength="10" value="<?php echo set_value('type_name_5'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_5" name="type_color_5" maxlength="7" value="<?php echo set_value('type_color_5'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_5" name="type_quantity_5" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_5'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_5" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_5" name="count_unit_5">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_5', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_5', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_5', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_5', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_5" id="ck2_5" onclick="type_reg('2',this,5);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_6" style="display: none;"><!-- 타입6정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_6">타입별 정보등록(6) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_6" name="type_name_6" maxlength="10" value="<?php echo set_value('type_name_6'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_6" name="type_color_6" maxlength="7" value="<?php echo set_value('type_color_6'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_6" name="type_quantity_6" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_6'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_6" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_6" name="count_unit_6">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_6', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_6', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_6', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_6', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_6" id="ck2_6" onclick="type_reg('2',this,6);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_7" style="display: none;"><!-- 타입7정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_7">타입별 정보등록(7) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_7" name="type_name_7" maxlength="10" value="<?php echo set_value('type_name_7'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_7" name="type_color_7" maxlength="7" value="<?php echo set_value('type_color_7'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_7" name="type_quantity_7" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_7'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_7" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_7" name="count_unit_7">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_7', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_7', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_7', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_7', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_7" id="ck2_7" onclick="type_reg('2',this,7);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_8" style="display: none;"><!-- 타입8정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_8">타입별 정보등록(8) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_8" name="type_name_8" maxlength="10" value="<?php echo set_value('type_name_8'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_8" name="type_color_8" maxlength="7" value="<?php echo set_value('type_color_8'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_8" name="type_quantity_8" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_8'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_8" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_8" name="count_unit_8">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_8', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_8', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_8', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_8', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_8" id="ck2_8" onclick="type_reg('2',this,8);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_9" style="display: none;"><!-- 타입9정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_9">타입별 정보등록(9) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_9" name="type_name_9" maxlength="10" value="<?php echo set_value('type_name_9'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_9" name="type_color_9" maxlength="7" value="<?php echo set_value('type_color_9'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_9" name="type_quantity_9" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_9'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_9" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_9" name="count_unit_9">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_9', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_9', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_9', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_9', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_9" id="ck2_9" onclick="type_reg('2',this,9);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_10" style="display: none;"><!-- 타입10정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_10">타입별 정보등록(10) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_10" name="type_name_10" maxlength="10" value="<?php echo set_value('type_name_10'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_10" name="type_color_10" maxlength="7" value="<?php echo set_value('type_color_10'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_10" name="type_quantity_10" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_10'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_10" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_10" name="count_unit_10">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_10', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_10', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_10', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_10', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2">
              <div class="checkbox" data-toggle="tooltip" title="타입 추가하기">
                <label>
            			<input type="checkbox" name="ck2_10" id="ck2_10" onclick="type_reg('2',this,10);">
                  <a><span class="glyphicon glyphicon-plus" aria-hidden="true" style="padding-top: 2px;"></span></a>
                </label>
              </div>
						</div>
					</div>
				</div>
				<div class="form-group" id="type2_11" style="display: none;"><!-- 타입11정보등록 -->
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="type_name_11">타입별 정보등록(11) <span class="red">*</span></label>
					</div>
          <div class="col-xs-12 col-sm-8 col-md-10 form-wrap bo-top">
            <div class="col-xs-3 col-sm-1" style="padding: 11px 0 0 8px; text-align:right;"><span>타입명 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
							<input type="text" class="form-control input-sm eng" id="type_name_11" name="type_name_11" maxlength="10" value="<?php echo set_value('type_name_11'); ?>" required placeholder="타입">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 컬러 :</span></span></div>
            <div class="col-xs-3 col-sm-1" style="padding-right: 0;">
              <label for="type_color_2" class="sr-only">컬러</span></label>
							<input type="color" class="form-control input-sm en_only" id="type_color_11" name="type_color_11" maxlength="7" value="<?php echo set_value('type_color_11'); ?>"  placeholder="컬러">
						</div>
            <div class="col-xs-3 col-sm-2" style="padding: 11px 0 0 8px; text-align:right;"><span>타입 수량 :</span></div>
            <div class="col-xs-3 col-sm-2 col-md-1" style="padding-right: 0;">
              <label for="type_quantity_2" class="sr-only">수량</span></label>
							<input type="text" class="form-control input-sm en_only" id="type_quantity_11" name="type_quantity_11" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('type_quantity_11'); ?>" required placeholder="타입별 단위 수량">
						</div>

						<div class="col-xs-2 col-sm-1" style="padding-right: 0;">
							<label for="count_unit_11" class="sr-only">단위</span></label>
							<select class="form-control input-sm" id="count_unit_11" name="count_unit_11">
								<option value="0">단위</option>
								<option value="1" <?php echo set_select('count_unit_11', '1'); ?>>세대</option>
								<option value="2" <?php echo set_select('count_unit_11', '2'); ?>>실</option>
								<option value="3" <?php echo set_select('count_unit_11', '3'); ?>>호</option>
								<option value="4" <?php echo set_select('count_unit_11', '4'); ?>>㎡(면적)</option>
							</select>
						</div>
						<div class="col-xs-2 col-sm-1 col-md-2"></div>
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
							<input type="text" class="form-control input-sm en_only" id="land_cost" name="land_cost" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('land_cost'); ?>" placeholder="토지 매입비 (단위:천원)">
						</div>
            <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="build_cost">평당 건축비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm en_only" id="build_cost" name="build_cost" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('build_cost'); ?>" placeholder="평당 건축비 (단위:천원)">
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
							<input type="text" class="form-control input-sm  en_only" id="arc_design_cost" name="arc_design_cost" onkeydown="onlyNum(this);" maxlength="8" value="<?php echo set_value('arc_design_cost'); ?>" placeholder="설계 용역비 (단위:천원)">
						</div>
            <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="supervision_cost">감리 용역비</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="supervision_cost" name="supervision_cost" onkeydown="onlyNum(this);" maxlength="8" value="<?php echo set_value('supervision_cost'); ?>" placeholder="감리 용역비 (단위:천원)">
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
							<input type="text" class="form-control input-sm  en_only" id="initial_inves" name="initial_inves" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('initial_inves'); ?>" placeholder="시행사 초기 투자금 (단위:천원)">
						</div>
            <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="dev_agency_charge">시행대행 용역비 (세대당)</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="dev_agency_charge" name="dev_agency_charge" onkeydown="onlyNum(this);" maxlength="5" value="<?php echo set_value('dev_agency_charge'); ?>" placeholder="시행대행 용역비 (단위:천원)">
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
							<input type="text" class="form-control input-sm  en_only" id="bridge_loan" name="bridge_loan" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('bridge_loan'); ?>" placeholder="브리지 차입규모 (단위:천원)">
						</div>
            <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>천원</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="pf_loan">PF 차입규모</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-10 col-sm-8">
							<input type="text" class="form-control input-sm  en_only" id="pf_loan" name="pf_loan" onkeydown="onlyNum(this);" maxlength="10" value="<?php echo set_value('pf_loan'); ?>" placeholder="PF 차입규모 (단위:천원)">
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
							<input type="text" class="form-control input-sm  en_only" id="con_lead_time" name="con_lead_time" onkeydown="onlyNum(this);" maxlength="4" value="<?php echo set_value('con_lead_time'); ?>" placeholder="공사 소요기간 (개월)">
						</div>
            <div class="col-xs-2 col-sm-4" style="padding: 11px 0;"><span>개월</span></div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 label-wrap bo-top">
						<label for="biz_start_year">사업 개시 년</label>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-4 form-wrap bo-top">
						<div class="col-xs-5 col-sm-4">
							<input type="text" class="form-control input-sm en_only" id="biz_start_year" name="biz_start_year" onkeydown="onlyNum(this);" maxlength="4" value="<?php echo set_value('biz_start_year'); ?>" placeholder="YYYY">
						</div>
            <div class="col-xs-1" style="padding: 11px 0;"><span>년</span></div>
            <div class="col-xs-4 col-sm-3">
              <label for="biz_start_month" class="sr-only">사업개시 월</span></label>
							<input type="text" class="form-control input-sm en_only" id="biz_start_month" name="biz_start_month" onkeydown="onlyNum(this);" maxlength="2" value="<?php echo set_value('biz_start_month'); ?>" placeholder="MM">
						</div>
            <div class="col-xs-1 col-sm-2" style="padding: 11px 0;"><span>월</span></div>
					</div>
				</div>
				<div class="form-group" style="color: red;">
          <?php echo validation_errors('<div class="error">', '</div>'); ?>&nbsp;
        </div>

<?php if($auth22<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="con_formck();";} ?>
				<div class="form-group btn-wrap" style="margin: 0;">
					<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="등록하기">
				</div>
			</fieldset>
		</form>
    </div>
<?php endif ?>
