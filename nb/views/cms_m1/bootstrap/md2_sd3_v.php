<?php
if($auth23<1) :
	include('no_auth.php');
else :
?>
<script>
	function checkAll(handle, obj) {
		var i;
		var chk = document.getElementsByName(obj);
		var tot = chk.length;
		if(handle.checked===true){
			for (i = 0; i < tot; i++) {chk[i].checked = true;}
		}else {
			for (i = 0; i < tot; i++) {chk[i].checked = false;}
		}
	}
	function print_bill(obj){
		var i;
		var chk = document.getElementsByName(obj);
		var tot = chk.length;
		var seq = '';

		for (i = 0; i < tot; i++) {
			sep = i==0 ?  "" : "-";
			if(chk[i].checked == true) seq += sep+chk[i].value;
		}
		location.href="<?php echo base_url('cms_download/bill_issue/download').'?seq='?>"+seq;
	}
</script>
	<div class="main_start">&nbsp;</div>
	<!-- 1. 분양관리 -> 2. 수납 관리 ->2.   설정 관리 -->

	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
<?php
	$attributes = array('method' => 'get', 'name' => 'pj_sel');
	echo form_open(current_url(), $attributes);
?>
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
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
			<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택 </div>
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

	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px;">
		<div class="col-xs-12 font14" style="padding: 0;"><p class="bg-success" style="padding: 13px 30px; margin: 0;">&nbsp;</p></div>
	</div>
	<!-- -------------------------------------------------- -->
<?php
	$attributes = array('name' => 'bill_set');
	echo form_open(current_url(), $attributes);
?>

	<div class="row" style="margin: 0; padding: 0;">
		<div class="col-sm-12 bo-top" style="padding: 0;">
			<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">발 행 일 자</div>
			<div class="col-xs-8 col-md-4" style="padding: 4px;">
				<div class="col-xs-11 col-sm-11 col-md-11" style="padding: 0px;">
					<label for="published_date" class="sr-only">발행 일자</label>
					<input type="text" class="form-control input-sm wid-95" id="published_date" name="published_date" maxlength="10" value="<?php echo date('Y-m-d'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="고지서 발행일">
				</div>
				<div class="col-xs-1 col-sm-1 glyphicon-wrap" style="padding: 6px 0;">
					<a href="javascript:" onclick="cal_add(document.getElementById('published_date'),this); event.cancelBubble=true">
						<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
					</a>
				</div>
			</div>
			<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">회 차 구 분</div>

			<div class="col-xs-8 col-md-4" style="padding:  4px;">
				<label for="pay_sche_code" class="sr-only">납부회차</label>
				<select class="form-control input-sm" name="pay_sche_code">
					<option value="">납부회차</option>
<?php foreach ($view['pay_sche'] as $lt) : ?>
					<option value="<?php echo $lt->pay_code; ?>" <?php if($view['bill_issue']->pay_code==$lt->pay_code) echo "selected"; else echo set_select('pay_sche_code', $lt->pay_code); ?>><?php echo $lt->pay_name; ?></option>
<?php endforeach; ?>
				</select>
			</div>

		</div>
	</div>

	<div class="row" style="margin: 0; padding: 0;">
		<div class="col-sm-12 bo-top" style="padding: 0;">
			<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px;">고지서 제목</div>
			<div class="col-xs-8 col-md-10" style="padding: 4px;">
				<label for="title" class="sr-only">고지서 제목</label>
				<input type="text" class="form-control input-sm" name="title" value="<?php if(isset($view['bill_issue']->title)) echo $view['bill_issue']->title; else echo set_value('title'); ?>" placeholder="제 목">
			</div>
		</div>
	</div>



	<div class="row" style="margin: 0; padding: 0;">
		<div class="col-sm-12 bo-top  bo-bottom" style="padding: 0; margin-bottom: 20px;">
			<div class="col-xs-4 col-md-2 center point-sub" style="padding: 10px; height: 73px;">고지서 내용</div>
			<div class="col-xs-8 col-md-10" style="padding: 0;">
				<label for="paid_date" class="sr-only">고지서 내용</label>
				<div class="col-xs-12" style="padding: 4px;">
					<textarea class="form-control input-sm" id="content" name="content"  rows="3" placeholder="내 용"><?php if(isset($view['bill_issue']->content)) echo $view['bill_issue']->content; else echo set_value('content'); ?></textarea>
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
				<div class="col-xs-12 col-sm-2 col-md-1 center bgf8" style="height: 40px; padding: 10px 0;">계약 기간</div>
				<div class="col-xs-12 col-sm-6 col-md-3" style="height: 40px; padding: 5px 0 0 5px;">
					<div class="col-xs-5 col-sm-5 col-md-4" style="padding: 0px;">
						<label for="s_date" class="sr-only">시작일</label>
						<input type="text" class="form-control input-sm wid-95" id="s_date" name="s_date" maxlength="10" value="<?php if($this->input->get('s_date')) echo $this->input->get('s_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="시작일">
					</div>
					<div class="col-xs-1 col-sm-1 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('s_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-4" style="padding: 0px;">
						<label for="e_date" class="sr-only">종료일</label>
						<input type="text" class="form-control input-sm wid-95" id="e_date" name="e_date" maxlength="10" value="<?php if($this->input->get('e_date')) echo $this->input->get('e_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="종료일">
					</div>
					<div class="col-xs-1 col-sm-2 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('e_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
						<button type="button" class="close" aria-label="Close" style="padding-left: 5px; margin-top: -2px;" onclick="document.getElementById('s_date').value=''; document.getElementById('e_date').value='';"><span aria-hidden="true">&times;</span></button>
					</div>
				</div>
				<!-- <div class="hidden-xs col-sm-4 col-md-2" style="height: 40px; padding: 10px 5px; text-align: right;">
					<a href="javascript:" onclick="term_put('s_date', 'e_date', 'd');" title="오늘"><img src="<?php echo base_url(); ?>static/img/to_today.jpg" alt="오늘"></a>
					<a href="javascript:" onclick="term_put('s_date', 'e_date', 'w');" title="일주일"><img src="<?php echo base_url(); ?>static/img/to_week.jpg" alt="일주일"></a>
					<a href="javascript:" onclick="term_put('s_date', 'e_date', 'm');" title="1개월"><img src="<?php echo base_url(); ?>static/img/to_month.jpg" alt="1개월"></a>
					<a href="javascript:" onclick="term_put('s_date', 'e_date', '3m');" title="3개월"><img src="<?php echo base_url(); ?>static/img/to_3month.jpg" alt="3개월"></a>
					<button type="button" class="close" aria-label="Close" style="padding-left: 5px;" onclick="document.getElementById('s_date').value=''; document.getElementById('e_date').value='';"><span aria-hidden="true">&times;</span></button>
				</div> -->
				<div class="col-xs-10 col-sm-2 col-md-1" style="height: 40px; padding: 6px 5px; text-align: right;">
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
						<td width="5%"><input type="checkbox" onclick="checkAll(this, 'chk[]')"></td>
						<td width="15%">계약 일련번호</td>
						<td width="10%">차 수</td>
						<td width="10%">타 입</td>
						<td width="10%">동 호 수</td>
						<td width="10%">계 약 자</td>
						<td width="15%">총 납입금</td>
						<td width="10%">계약 완납</td>
						<td width="15%">계약 일자</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">
<?php
foreach ($cont_data as $lt) :
	$nd = $this->cms_main_model->sql_row(" SELECT diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no='$lt->cont_diff' ");
	$total_rec = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS received FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$lt->cont_seq' ");

	$deposit1 = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$lt->price_seq' AND pay_sche_seq<3 ");
	$deposit2 = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$lt->price_seq' AND pay_sche_seq<5 ");
	if($total_rec->received>=$deposit2->payment){
		$is_paid_ok = "<span style='color: #2205D0;'>2차 완납</span>";
	}elseif($total_rec->received>=$deposit1->payment){
		$is_paid_ok = "<span style='color: #03A719;'>1차 완납</span>";
	}else{
		$is_paid_ok = "<span style='color: #CD0505;'>미납</span>";
	}

	$dong_ho = explode("-", $lt->unit_dong_ho);
	$adr1 = ($lt->cont_addr2) ? explode("|", $lt->cont_addr2) : explode("|", $lt->cont_addr1);
	$adr2 = explode(" ", $adr1[1]);
	$addr = $adr2[0]." ".$adr2[1];
	$unit_dh = explode("-", $lt->unit_dong_ho);
	$cont_edit_link ="<a href ='".base_url('cms_m1/sales/1/2?mode=2&cont_sort1=1&cont_sort2=2&project=').$project."&type=".$lt->unit_type."&dong=".$unit_dh[0]."&ho=".$unit_dh[1]."'>" ;
	$new_span = ($lt->cont_date>=date('Y-m-d', strtotime('-3 day')))  ? "<span style='background-color: #2A41DB; color: #fff; font-size: 10px;'>&nbsp;N </span>&nbsp; " : "";
?>
					<tr>
						<td><input type="checkbox" name="chk[]" value="<?php echo $lt->cont_seq; ?>"></td>
						<td><?php echo $cont_edit_link.$lt->cont_code."</a>"; ?></td>
						<td><?php echo $nd->diff_name; ?></td>
						<td class="left"><span style="background-color: <?php echo $type_color[$lt->unit_type]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp; <?php echo $lt->unit_type; ?></td>
						<td><?php echo $cont_edit_link.$lt->unit_dong_ho."</a>"; ?></td>
						<td><?php echo $cont_edit_link.$lt->contractor."</a>"; ?></td>
						<td class="right"><a href="<?php echo base_url('cms_m1/sales/2/2')."?project=".$project."&dong=".$dong_ho[0]."&ho=".$dong_ho[1]; ?>"><?php echo number_format($total_rec->received); ?></a></td>
						<td><?php echo $is_paid_ok; ?></td>
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
	$download_str = $auth23<2 ? "alert('이 페이지에 대한 관리(출력) 권한이 없습니다.');" : "if(confirm('선택하신 건별 고지서를 다운로드하시겠습니까?')) print_bill('chk[]');"; // location.href='".base_url()."'
?>
	<div class="form-group btn-wrap" style="margin: ;">
		<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $download_str?>" value="선택 건별 고지서 다운로드">
	</div>
	<!-- -------------------------------------------------- -->
<?php endif; ?>
