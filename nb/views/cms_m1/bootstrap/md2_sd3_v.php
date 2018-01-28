<?php
if($auth23<1) :
	include('no_auth.php');
else :
?>
<script>
	function show_hide(obj){ // 기본설정 숨기거나 보이기
		var show_hide = document.getElementById('show_hide');
		if(obj.checked==true){ // 체크시 보이기
			show_hide.style.display = "block";
		}else{
			show_hide.style.display = "none";
		}
	}
	function checkAll(handle, obj) { // 계약 항목 전체 선택
		var i;
		var chk = document.getElementsByName(obj);
		var tot = chk.length;
		if(handle.checked===true){
			for (i = 0; i < tot; i++) {
				if(chk[i].disabled==false) chk[i].checked = true;
			}
		}else {
			for (i = 0; i < tot; i++) {chk[i].checked = false;}
		}
	}
	function print_bill(obj, p){
		var i;
		var chk = document.getElementsByName(obj);
		var tot = chk.length;
		var seq = '';
		var j = 0;
		for (i = 0; i < tot; i++) { // get에 전달할 계약아이디 변수를 "-"로 연결하기

			if(chk[i].checked == true) {
				sepwd = j==0 ?  "" : "-";
				seq += sepwd+chk[i].value;
				j++;
			}
		}
		if(seq==='') {
			alert('다운로드(출력)할 계약 건을 선택하여 주십시요.');
			return;
		}else if(confirm('선택하신 건별 고지서를 다운로드하시겠습니까?')) {
			var d = document.bill_set.published_date.value;
			var uri = "<?php echo base_url('cms_download/bill_issue/download').'?pj="+p+"&date="+d+"&seq='?>"+seq;
			location.href=uri;
		}
	}
</script>
	<div class="main_start">&nbsp;</div>
	<!-- 1. 분양관리 -> 2. 수납 관리 ->2.   설정 관리 -->

	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
<?php
	$attributes = array('method' => 'get', 'name' => 'pj_sel');
	echo form_open(current_url(), $attributes);
?>
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub1" style="padding: 10px; 0">사업 개시년도</div>
			<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-8" style="padding: 0px;">
					<label for="yr" class="sr-only">사업 개시년도</label>
					<select class="form-control input-sm" name="yr" onchange="submit();">
						<option value=""> 전 체
<?php
	$start_year = "2015";
	// if(!$yr) $yr=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
	$year=range($start_year,date('Y'));
	for($i=(count($year)-1); $i>=0; $i--) :
?>
						<option value="<?php echo $year[$i]?>" <?php if($this->input->get('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?>
<?php endfor; ?>
					</select>
				</div>
			</div>
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub1" style="padding: 10px; 0">프로젝트 선택 </div>
			<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-8" style="padding: 0px;">
					<label for="project" class="sr-only">프로젝트 선택</label>
					<select class="form-control input-sm" name="project" onchange="submit();">
						<option value="0"> 전 체
<?php foreach($all_pj as $lt) : ?>
						<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->post('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?>
<?php endforeach; ?>
					</select>
				</div>
			</div>
		</form>
	</div>

	<div class="row bg-success bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-6 checkbox" style="">
			<h5 style="color:#16125b"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> &nbsp;기본 설정</h5>
		</div>
		<div class="col-xs-6 font14 right checkbox" style="padding-top: 13px;">
			<label>
				<input type="checkbox" onclick="show_hide(this)"> 고지서 관련 세부설정 보기
			</label>
		</div>
	</div>

	<!-- -------------------------------------------------- -->
<?php
	$attributes = array('name' => 'bill_set');
	echo form_open(current_url(), $attributes);
?>

	<div class="row" style="margin: 0; padding: 0;">
		<div class="col-sm-12 bo-top" style="padding: 0;">
			<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="published_date">발 행 일 자</label></div>
			<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
				<div class="col-xs-11" style="padding: 0px;">
					<input type="text" class="form-control input-sm wid-95" id="published_date" name="published_date" maxlength="10" value="<?php echo date('Y-m-d'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="고지서 발행일">
				</div>
				<div class="col-xs-1 col-sm-1 glyphicon-wrap" style="padding: 6px 0;">
					<a href="javascript:" onclick="cal_add(document.getElementById('published_date'),this); event.cancelBubble=true">
						<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
					</a>
				</div>
			</div>
			<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="pay_sche_code">발 행 회 차</label></div>
			<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
				<select class="form-control input-sm" name="pay_sche_code" id="psc">
					<option value="">납부회차</option>
<?php
	foreach ($view['pay_sche'] as $lt) :
		$pay_name = ($lt->pay_disc!=='') ? $lt->pay_name.' ('.$lt->pay_disc.')' : $lt->pay_name;
?>
					<option value="<?php echo $lt->pay_code; ?>" <?php if($view['bill_issue']->pay_code==$lt->pay_code) echo "selected"; else echo set_select('pay_sche_code', $lt->pay_code); ?>><?php echo $pay_name; ?></option>
<?php endforeach; ?>
				</select>
			</div>

		</div>
	</div>
	<div id="show_hide" style="display:none;">
		<div class="row" style="margin: 0; padding: 0;">
			<div class="col-sm-12 bo-top" style="padding: 0;">
				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="host_name_1">발송자명(조 합)</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<div class="col-xs-12" style="padding: 0px;">
						<input type="text" class="form-control input-sm" id="host_name_1" name="host_name_1" value="<?php if(isset($view['bill_issue']->host_name_1)) echo $view['bill_issue']->host_name_1; else echo set_value('host_name_1'); ?>" placeholder="시행자명">
					</div>
				</div>

				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="tell_1">연락처(조 합)</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<input type="text" class="form-control input-sm" id="tell_1" name="tell_1" value="<?php if(isset($view['bill_issue']->tell_1)) echo $view['bill_issue']->tell_1; else echo set_value('tell_1'); ?>" placeholder="02-1234-5678">
				</div>
			</div>
		</div>

		<div class="row" style="margin: 0; padding: 0;">
			<div class="col-sm-12 bo-top" style="padding: 0;">
				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="host_name_2">발송자명(대행사)</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<div class="col-xs-12" style="padding: 0px;">
						<input type="text" class="form-control input-sm" id="host_name_2" name="host_name_2" value="<?php if(isset($view['bill_issue']->host_name_2)) echo $view['bill_issue']->host_name_2; else echo set_value('host_name_2'); ?>" placeholder="시행자명">
					</div>
				</div>

				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="tell_2">연락처(대행사)</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<input type="text" class="form-control input-sm" id="tell_2" name="tell_2" value="<?php if(isset($view['bill_issue']->tell_2)) echo $view['bill_issue']->tell_2; else echo set_value('tell_2'); ?>" placeholder="02-1234-5678">
				</div>
			</div>
		</div>
		<div class="row" style="margin: 0; padding: 0;">
			<div class="col-sm-12 bo-top" style="padding: 0;">
				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="bank_acc_1">수취계좌 1</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<div class="col-xs-12" style="padding: 0px;">
						<input type="text" class="form-control input-sm" id="bank_acc_1" name="bank_acc_1" value="<?php if(isset($view['bill_issue']->bank_acc_1)) echo $view['bill_issue']->bank_acc_1; else echo set_value('bank_acc_1'); ?>" placeholder="예금은행 + 계좌번호">
					</div>
				</div>

				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="acc_host_1">예 금 주 1</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<input type="text" class="form-control input-sm" id="acc_host_1" name="acc_host_1" value="<?php if(isset($view['bill_issue']->acc_host_1)) echo $view['bill_issue']->acc_host_1; else echo set_value('acc_host_1'); ?>" placeholder="예금주">
				</div>
			</div>
		</div>

		<div class="row" style="margin: 0; padding: 0;">
			<div class="col-sm-12 bo-top" style="padding: 0;">
				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="bank_acc_2">수취계좌 2</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<div class="col-xs-12" style="padding: 0px;">
						<input type="text" class="form-control input-sm" id="bank_acc_2" name="bank_acc_2" value="<?php if(isset($view['bill_issue']->bank_acc_2)) echo $view['bill_issue']->bank_acc_2; else echo set_value('bank_acc_2'); ?>" placeholder="예금은행 + 계좌번호">
					</div>
				</div>

				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="acc_host_2">예 금 주 2</label></div>
				<div class="col-xs-8 col-md-4" style="padding: 6px 4px;">
					<input type="text" class="form-control input-sm" id="acc_host_2" name="acc_host_2" value="<?php if(isset($view['bill_issue']->acc_host_2)) echo $view['bill_issue']->acc_host_2; else echo set_value('acc_host_2'); ?>" placeholder="예금주">
				</div>
			</div>
		</div>

		<!-- 다음 우편번호 서비스 - iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
		<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
			<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
		</div>
		<!-- 다음 우편번호 서비스 -------------onclick="execDaumPostcode(1)"-----postcode1-----address1_1-----address2_1------------------------>

		<div class="row" style="margin: 0; padding: 0;">
			<div class="col-sm-12 bo-top" style="padding: 0;">
				<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="address">발송자 주소</label></div>
				<div class="col-xs-8 col-md-10" style="padding: 0px;">
					<div class="col-xs-12" style="padding: 0px;">
						<div class="col-xs-4 col-sm-3 col-md-2" style="padding: 4px;">
							<label for="postcode1" class="sr-only">우편번호</label>
							<input type="text" class="form-control input-sm en_only" id="postcode1" name="postcode1" maxlength="5" value="<?php if( !empty($view['addr'])) echo $view['addr'][0]; else echo set_value('postcode1');  ?>" readonly required placeholder="우편번호">
						</div>
						<div class="col-xs-4 col-sm-2 col-md-1" style="padding: 4px 0;">
							<input type="button" class="btn btn-info btn-sm" value="우편번호" onclick="execDaumPostcode(1)">
						</div>
						<div class="col-xs-12 col-sm-8 col-md-5" style="padding: 4px;">
							<label for="address1_1" class="sr-only">계약자주소1</label>
							<input type="text" class="form-control input-sm han" id="address1_1" name="address1_1" maxlength="100" value="<?php if( !empty($view['addr'])) echo $view['addr'][1]; else echo set_value('address1_1');  ?>" readonly required placeholder="일반주소">
						</div>
						<div class="col-xs-12 col-sm-4 col-md-4" style="padding: 4px;">
							<label for="address2_1" class="sr-only">계약자주소2</label>
							<input type="text" class="form-control input-sm han" id="address2_1" name="address2_1" maxlength="93" value="<?php if( !empty($view['addr'])) echo $view['addr'][2]; else echo set_value('address2_1');  ?>" placeholder="나머지 주소">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="margin: 0; padding: 0;">
		<div class="col-sm-12 bo-top" style="padding: 0;">
			<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px;"><label for="title">고지서 제목</label></div>
			<div class="col-xs-8 col-md-10" style="padding: 4px;">
				<input type="text" class="form-control input-sm" name="title" value="<?php if(isset($view['bill_issue']->title)) echo $view['bill_issue']->title; else echo set_value('title'); ?>" placeholder="제 목">
			</div>
		</div>
	</div>



	<div class="row" style="margin: 0; padding: 0;">
		<div class="col-sm-12 bo-top  bo-bottom" style="padding: 0; margin-bottom: 20px;">
			<div class="col-xs-4 col-md-2 center point-sub3" style="padding: 10px; height: 112px;"><label for="paid_date">고지서 내용</label></div>
			<div class="col-xs-8 col-md-10" style="padding: 0;">

				<div class="col-xs-12" style="padding: 4px;">
					<textarea class="form-control input-sm" id="content" name="content"  rows="5" placeholder="내 용"><?php if(isset($view['bill_issue']->content)) echo $view['bill_issue']->content; else echo set_value('content'); ?></textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group btn-wrap" style="margin: ;">
<?php
	$submit_str = $auth23<2	? "alert('이 페이지에 대한 관리(등록)권한이 없습니다.')" : "if(confirm('고지서 기본사항을 설정하시겠습니까?')) submit();";
?>
		<input type="button" class="btn btn-default btn-sm" onclick="<?php echo $submit_str?>" value="UPDATE">
	</div>
</form>
	<!-- -------------------------------------------------- -->

	<!-- -------------------------------------------------- -->
	<div class="row font12" style="margin: 0; padding: 0;">
    <div class="col-md-12 mb10"><h4><span class="label label-primary">계약자 데이터</span></h4></div>
		<div class="col-md-12 bo-top bo-bottom" style="padding: 0; margin: 0 0 20px 0;">
<?php
	$attributes = array('name' => 'form1', 'method' => 'get');
	$hedden = array('pj' => $project);
	echo form_open(base_url(uri_string()), $attributes, $hedden);
?>
				<div class="col-xs-12 col-sm-2 col-md-1 center bgf8" style="height: 40px; padding: 10px 0;">검색 조건</div>
				<div class="col-xs-6 col-sm-2 col-md-1" style="height: 40px; padding: 5px;">
					<label for="num" class="sr-only">표시개수</label>
					<select class="form-control input-sm" name="num">
						<option value="">표시개수</option>
						<option value="5" <?php if($this->input->get('num')==5) echo "selected"; ?>> 5개</option>
						<option value="10" <?php if($this->input->get('num')==10) echo "selected"; ?>> 10개</option>
						<option value="15" <?php if($this->input->get('num')==15) echo "selected"; ?>> 15개</option>
						<option value="20" <?php if($this->input->get('num')==20) echo "selected"; ?>> 20개</option>
						<option value="25" <?php if($this->input->get('num')==25) echo "selected"; ?>> 25개</option>
						<option value="30" <?php if($this->input->get('num')==30) echo "selected"; ?>> 30개</option>
					</select>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-1" style="height: 40px; padding: 5px;">
					<label for="diff" class="sr-only">차수별</label>
					<select class="form-control input-sm" name="diff">
						<option value=""> 차수별</option>
<?php foreach($sc_cont_diff as $lt) : ?>
						<option value="<?php echo $lt->cont_diff; ?>" <?php if($lt->cont_diff == $this->input->get('diff')) echo "selected"; ?>> <?php echo $lt->cont_diff; ?> 차</option>
<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-1" style="height: 40px; padding: 5px;">
					<label for="type" class="sr-only">타입별</label>
					<select class="form-control input-sm" name="type" onchange="submit();">
						<option value=""> 타입별</option>
<?php foreach($sc_cont_type as $lt) : ?>
						<option value="<?php echo $lt->unit_type; ?>" <?php if($lt->unit_type == $this->input->get('type')) echo "selected"; ?>> <?php echo $lt->unit_type; ?></option>
<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-1" style="height: 40px; padding: 5px;">
					<label for="dong" class="sr-only">동별</label>
					<select class="form-control input-sm" name="dong">
						<option value=""> 동 별</option>
<?php foreach($sc_cont_dong as $lt) : ?>
						<option value="<?php echo $lt->unit_dong; ?>" <?php if($lt->unit_dong==$this->input->get('dong')) echo "selected"; ?>> <?php echo $lt->unit_dong; ?></option>
<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xs-6 col-sm-2 col-md-1" style="height: 40px; padding: 5px;">
					<label for="order" class="sr-only">정 렬</label>
					<select class="form-control input-sm" name="order">
						<option value="">정렬 순서</option>
						<option value="1" <?php if($this->input->get('order')==1) echo "selected"; ?>>일련번호 순</option>
						<option value="2" <?php if($this->input->get('order')==2) echo "selected"; ?>>일련번호 역순</option>
						<!-- <option value="3" <?php if($this->input->get('order')==3) echo "selected"; ?>>계약</option> -->
						<!-- <option value="4" <?php if($this->input->get('order')==4) echo "selected"; ?>>홀딩</option> -->
					</select>
				</div>
				<div class="col-xs-12 col-sm-2 col-md-1 center bgf8" style="height: 40px; padding: 10px 0;">현재 설정회차</div>

				<div class="col-xs-8 col-sm-4 col-md-2">
					<div class="checkbox">
						<label style="color:#c33103">
							<!-- <input type="checkbox" name="filter" value="<?php echo $view['bill_issue']->pay_code; ?>" <?php if($this->input->get('filter')!==null) echo 'checked'; ?>> -->
							<strong>
								<script>
									document.write((document.getElementById('psc').options[document.getElementById('psc').selectedIndex].text).substring(0, 6)+" 납부기준");
								</script>
							</strong>
						</label>
					</div>
				</div>

				<div class="col-xs-10 col-sm-4 col-md-2" style="height: 40px; padding: 5px; text-align: right;">
					<label for="계약자명" class="sr-only">입금자</label>
					<input type="text" class="form-control input-sm" name="sc_name" maxlength="10" value="<?php if($this->input->get('sc_name')) echo $this->input->get('sc_name'); ?>" placeholder="계약자명" onkeydown="if(event.keyCode==13)submit();">
				</div>
				<div class="col-xs-2 col-sm-2 col-md-1 center" style="height: 40px; padding: 5px;">
					<input type="button" value="검 색" class="btn btn-info btn-sm" onclick="submit();">
				</div>
			</form>
		</div>

		<!-- <div class="col-md-12">검색</div> -->
<?php if(empty($cont_data)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 120px 0;">등록된 데이터가 없습니다.</div>
<?php else : ?>
		<!-- <div class="col-xs-12 hidden-xs hidden-sm right" style="padding: 0 20px 0; margin-top: -18px; color: #5E81FE;"><?php echo "[ 결과 : ".number_format($total_rows)." 건 ]"; ?>
			<a href="<?php echo base_url('/cms_download/contract_data/download')."?pj=".$project."&qry=".urlencode($cont_query); ?>" style="padding-left: 30px;">
				<img src="<?php echo base_url(); ?>static/img/excel_icon.jpg" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
			</a>
		</div> -->
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed">
				<thead class="bo-top center bgf8">
					<tr>
						<td width="6%"><div class="checkbox" style="margin:0;"><label><input type="checkbox" onclick="checkAll(this, 'chk[]')"> 전체</label></div></td>
						<td width="10%">계약 일련번호</td>
						<td width="10%">차 수</td>
						<td width="8%">타 입</td>
						<td width="12%">동 호 수</td>
						<td width="10%">계 약 자</td>
						<td width="13%">총 납입금</td>
						<td width="16%">현 회차상태(완납회차)</td>
						<td width="15%">계약 일자</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">
<?php
for($i=0; $i<count($tp_name); $i++) :
	$type_color[$tp_name[$i]] = $tp_color[$i];
endfor;

foreach ($cont_data as $lt) :
	// 차수 구하기
	$nd = $this->cms_main_model->sql_row(" SELECT diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no='$lt->cont_diff' ");
	// 총 납부금액 구하기
	$total_rec = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS received FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$lt->cont_seq' ");
	$n = 0;
	foreach ($view['real_sche'] as $val) { // 실제 납부회차 만큼 반복
		$val->pay_code;
		$time_payment[$n] = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$lt->price_seq' AND pay_sche_seq<=$val->pay_code ");
		if($total_rec->received>=$time_payment[$n]->payment) $is_paid = $val->pay_code;
		$n++;
	}
	$condi = ($view['bill_issue']->pay_code <= $is_paid)
		? "<span style='color: #2205D0;'>".$view['pay_sche']->pay_name." 완납 중</span>"
		: "<span style='color: #CD0505;'>".$view['pay_sche']->pay_name." 미납 중</span>";
	$chk_con = ($view['bill_issue']->pay_code <= $is_paid)
		? "disabled"
		: "";


	$paid_out = $this->cms_main_model->sql_row(" SELECT pay_name FROM cb_cms_sales_pay_sche WHERE pj_seq='$project' AND pay_code='$is_paid' ");

	$dong_ho = explode("-", $lt->unit_dong_ho);
	$unit_dh = explode("-", $lt->unit_dong_ho);
	$cont_edit_link ="<a href ='".base_url('cms_m1/sales/1/2?mode=2&cont_sort1=1&cont_sort2=2&project=').$project."&type=".$lt->unit_type."&dong=".$unit_dh[0]."&ho=".$unit_dh[1]."'>" ;
?>
					<tr>
						<td><div class="checkbox" style="margin:0;"><label><input type="checkbox" name="chk[]" value="<?php echo $lt->cont_seq; ?>" <?php echo $chk_con; ?>> 선택</label></div></td>
						<td><?php echo $cont_edit_link.$lt->cont_code."</a>"; ?></td>
						<td><?php echo $nd->diff_name; ?></td>
						<td class="left" style="padding-left:20px;"><span style="background-color: <?php echo $type_color[$lt->unit_type]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp; <?php echo $lt->unit_type;?></td>
						<td><?php echo $cont_edit_link.$lt->unit_dong_ho."</a>"; ?></td>
						<td><?php echo $cont_edit_link.$lt->contractor."</a>"; ?></td>
						<td class="right"><a href="<?php echo base_url('cms_m1/sales/2/2')."?project=".$project."&dong=".$dong_ho[0]."&ho=".$dong_ho[1]; ?>"><?php echo number_format($total_rec->received); ?></a></td>
						<td><?php echo $condi.' ('.$paid_out->pay_name.')'; ?></td>
						<td><?php echo $new_span." ".$lt->cont_date; ?></span></td>
					</tr>
<?php
	endforeach;
?>
				</tbody>
			</table>
		</div>
<?php endif; ?>
		<div class="col-xs-12 center" style="margin-top: 0px; padding: 0;">
			<ul class="pagination pagination-sm"><?php echo $pagination; ?></ul>
		</div>
  </div>
<?php
	$download_str = $auth23<2 ? "alert('이 페이지에 대한 관리(출력) 권한이 없습니다.');" : "print_bill('chk[]', $project);"; // location.href='".base_url()."'
?>
	<div class="form-group btn-wrap" style="margin: ;">
		<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $download_str?>" value="선택 건별 고지서 다운로드">
	</div>
	<!-- -------------------------------------------------- -->
<?php endif; ?>
