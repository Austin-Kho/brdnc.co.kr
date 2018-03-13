<?php
if($auth11<1) :
	include('no_auth.php');
else :
?>
	<div class="main_start">&nbsp;</div>
	<!-- 1. 분양관리 -> 1. 계약 관리 ->1. 계약 현황 -->

	<script type="text/javascript">
		function excel(url){
			var opt = "1";
			if(document.form1.opt2.checked===true) var opt = opt+"-2";
			if(document.form1.opt3.checked===true) var opt = opt+"-3";
			if(document.form1.opt4.checked===true) var opt = opt+"-4";
			if(document.form1.opt5.checked===true) var opt = opt+"-5";
			if(document.form1.opt6.checked===true) var opt = opt+"-6";
			if(document.form1.opt7.checked===true) var opt = opt+"-7";
			if(document.form1.opt8.checked===true) var opt = opt+"-8";
			if(document.form1.opt9.checked===true) var opt = opt+"-9";
			if(document.form1.opt10.checked===true) var opt = opt+"-10";
			if(document.form1.opt11.checked===true) var opt = opt+"-11";
			if(document.form1.opt12.checked===true) var opt = opt+"-12";
			if(document.form1.opt13.checked===true) var opt = opt+"-13";
			if(document.form1.opt14.checked===true) var opt = opt+"-14";
			if(document.form1.opt15.checked===true) var opt = opt+"-15";
			if(document.form1.opt15.checked===true) var opt = opt+"-16";

			location.href = url+"&row="+opt;
		}
		$(document).ready(function() {
			$(".text_toggle").click( function() {
				if($(".text_toggle").html() == '[청약 데이터 접기]' ) {
					$(".text_toggle").html('[청약 데이터 펼치기]');
				}else{
					$(".text_toggle").html('[청약 데이터 접기]');
				}
			});
		});
	</script>
<?php
for($i=0; $i<count($tp_name); $i++) :
	$type_color[$tp_name[$i]] = $tp_color[$i];
endfor;
?>
	<div class="row bo-top bo-bottom font12" style="margin: 0 0 20px 0;">
<?php
	$attributes = array('method' => 'get', 'name' => 'pj_sel');
	echo form_open(current_full_url(), $attributes);
?>
			<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">사업 개시년도</div>
			<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-8" style="padding: 0px;">
					<label for="yr" class="sr-only">사업 개시년도</label>
					<select class="form-control input-sm" name="yr" onchange="submit();">
						<option value=""> 전 체</option>
<?php
  $start_year = "2015";
  // if(!$yr) $yr=date('Y');  // 첫 화면에 전체 계약 목록을 보이고 싶으면 이 행을 주석 처리
  $year=range($start_year,date('Y'));
  for($i=(count($year)-1); $i>=0; $i--) :
?>
						<option value="<?php echo $year[$i]?>" <?php if($this->input->get('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?></option>
<?php endfor; ?>
					</select>
				</div>
			</div>
			<div class="col-xs-4 col-sm-3 col-md-2 center bg-success" style="line-height:38px;">프로젝트 선택 </div>
			<div class="col-xs-8 col-sm-9 col-md-4" style="padding: 4px 15px;">
				<div class="col-xs-12 col-sm-8" style="padding: 0px;">
					<label for="project" class="sr-only">프로젝트 선택</label>
					<select class="form-control input-sm" name="project" onchange="submit();">
						<option value="0" <?php if( !$this->input->get('project')) echo "selected"; ?>> 선 택</option>
<?php foreach($pj_list as $lt) : ?>
						<option value="<?php echo $lt->seq; ?>" <?php if(( !$this->input->get('project') && $lt->seq=='1') OR $this->input->get('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
					</select>
				</div>
			</div>
		</form>
	</div>

  <div class="row font12" style="margin: 0; padding: 0;">
    <div class="col-md-12 mb10"><h4><span class="label label-info">1. 요약 집계</span></h4></div>
<?php if(empty($pj_list)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">조회할 프로젝트를 선택하여 주십시요.</div>
<?php elseif($pj_list && empty($tp_name)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">등록된 데이터가 없습니다.</div>
<?php else : ?>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed">
				<thead class="bo-top center bgf8">
					<tr>
						<td rowspan="2" style="vertical-align:middle;">프로젝트명</td>
						<td rowspan="2" style="vertical-align:middle;">타 입</td>
						<td rowspan="2" style="vertical-align:middle;">세 대 수</td>
						<td rowspan="2" style="vertical-align:middle;">유보세대</td>
						<td rowspan="2" style="vertical-align:middle;">청약 건수</td>
						<td colspan="<?php echo count($sc_cont_diff)+1; ?>">계약 건수</td>
						<td rowspan="2" style="vertical-align:middle;">계 약 율</td>
						<td rowspan="2" style="vertical-align:middle;">분양율<br>(청약+계약)</td>
					</tr>
					<tr>
<?php foreach($sc_cont_diff as $lt) : ?>
						<td><?php echo $lt->cont_diff; ?> 차</td>
<?php endforeach; ?>
						<td>합계</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">
<?php for($i=0; $i<count($summary); $i++) :
	if($i==0) $first_td = "<td rowspan='".count($summary)."' style='background-color:#FFF; vertical-align:middle;'>".$pj_now->pj_name."</td>"; else $first_td = "";
?>
					<tr>
						<?php echo $first_td; ?>
						<td style="background-color: <?php echo $tp_color[$i].";"; ?>"><?php echo $tp_name[$i]; ?></td>
						<td class="right"><?php echo $summary[$i]->type_num." 세대"; ?></td>
						<td class="right"><?php if(empty($summary[$i]->hold)) echo "0 세대"; else echo $summary[$i]->hold." 세대"; ?></td>
						<td class="right" style="color: #273169;"><?php if(empty($summary[$i]->app)) echo "0 건"; else echo $summary[$i]->app." 건"; ?></td>
	<?php for($j=0; $j<count($sc_cont_diff); $j++):
					$cn = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS cont_num FROM cb_cms_sales_contract WHERE pj_seq='$project' AND unit_type='".$tp_name[$i]."' AND cont_diff='".$sc_cont_diff[$j]->cont_diff."' ");
	?>
						<td class="right"><?php echo $cn->cont_num." 건 "; ?></td>
	<?php endfor; ?>
						<td class="right" style="color: #a60202;"><?php if(empty($summary[$i]->cont)) echo "0 건"; else echo $summary[$i]->cont." 건"; ?></td>
						<td class="right"><?php if(empty($summary[$i]->cont)) echo "0.00 %"; else echo number_format(($summary[$i]->cont/$summary[$i]->type_num*100), 2)." %" ?></td>
						<td class="right"><?php if(empty($summary[$i]->cont)) echo "0.00 %"; else echo number_format((($summary[$i]->app+$summary[$i]->cont)/$summary[$i]->type_num*100), 2)." %" ?></td>
					</tr>
<?php endfor; ?>
				</tbody>
				<tfoot class="right bgf8">
					<tr>
						<td class="center">합 계</td>
						<td></td>
						<td><?php echo $sum_all->unit_num." 세대"; ?></td>
						<td><?php echo $sum_all->hold." 세대"; ?></td>
						<td style="color: #273169; font-weight: bold;"><?php echo $sum_all->app." 건"; ?></td>
<?php for($j=0; $j<count($sc_cont_diff); $j++):
				$cntot = $this->cms_main_model->sql_row(" SELECT COUNT(seq) AS total FROM cb_cms_sales_contract WHERE pj_seq='$project' AND cont_diff='".$sc_cont_diff[$j]->cont_diff."' ");
?>
						<td style="font-weight: bold;"><?php echo $cntot->total." 건"; ?></td>
<?php endfor; ?>
						<td style="color: #a60202; font-weight: bold;"><?php echo $sum_all->cont." 건"; ?></td>


						<td><?php echo number_format(($sum_all->cont/$sum_all->unit_num*100), 2)." %" ?></td>
						<td><?php echo number_format((($sum_all->app+$sum_all->cont)/$sum_all->unit_num*100), 2)." %" ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
<?php endif; ?>
  </div>

	<?php
		$attributes = array('name' => 'form1', 'method' => 'get');
		echo form_open(current_full_url(), $attributes);
	?>
		<div class="row font12" style="margin: 0; padding: 0;">
	    <div class="col-md-12 mt20 mb10"><h4><span class="label label-primary">2. 계약 현황</span></h4></div>
			<div class="col-md-12 bo-top bo-bottom" style="padding: 0; margin: 0 0 20px 0;">
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
						<div>
							<input type="text" class="form-control input-sm wid-95" id="s_date" name="s_date" maxlength="10" value="<?php if($this->input->get('s_date')) echo $this->input->get('s_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="시작일">
						</div>
					</div>
					<div class="col-xs-1 col-sm-1 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('s_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
					</div>
					<div class="col-xs-5 col-sm-5 col-md-4" style="padding: 0px;">
						<label for="e_date" class="sr-only">종료일</label>
						<div>
							<input type="text" class="form-control input-sm wid-95" id="e_date" name="e_date" maxlength="10" value="<?php if($this->input->get('e_date')) echo $this->input->get('e_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="종료일">
						</div>
					</div>
					<div class="col-xs-1 col-sm-2 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('e_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
						<button type="button" class="close" aria-label="Close" style="padding-left: 5px; margin-top: -2px;" onclick="document.getElementById('s_date').value=''; document.getElementById('e_date').value='';"><span aria-hidden="true">&times;</span></button>
					</div>
				</div>
				<div class="col-xs-10 col-sm-2 col-md-1" style="height: 40px; padding: 6px 5px; text-align: right;">
					<label for="sc_name" class="sr-only">계약자명</label>
					<input type="text" class="form-control input-sm" name="sc_name" maxlength="10" value="<?php if($this->input->get('sc_name')) echo $this->input->get('sc_name'); ?>" placeholder="계약자명" onkeydown="if(event.keyCode==13)submit();">
				</div>
				<div class="col-xs-2 col-sm-2 col-md-1 center" style="height: 40px; padding: 5px;">
					<input type="button" value="검 색" class="btn btn-info btn-sm" onclick="submit();">
				</div>
			</div>

	<?php if(empty($cont_data)) : ?>
			<div class="col-xs-12 center bo-top bo-bottom" style="padding: 120px 0;">등록된 데이터가 없습니다.</div>
	<?php else : ?>
			<div class="hidden-xs col-sm-12 right" style="padding: 0 20px 3px; color: #5E81FE;">
				<?php echo "[ 결과 : ".number_format($total_rows)." 건 ]"; ?>
				<a href="javascript:" onclick="$('#output_option').toggle();"  style="margin: 0 10px;">[엑셀 출력항목 선택]</a>
				<?php $url = base_url('/cms_download/contract_data/download')."?pj=".$project."&qry=".urlencode($cont_query); ?>
				<a href="javascript:" onclick="<?php echo 'excel(\''.$url.'\')' ?>">
					<img src="<?php echo base_url(); ?>static/img/excel_icon.jpg" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
				</a>
			</div>
			<div class="hidden-xs col-sm-12 form-inline center bg-info" id="output_option" style="padding: 8px; display:none;">
				<div class="checkbox"><label><input type="checkbox" name="opt2" checked> 일련번호&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt3" checked> 차수&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt4" checked> 타입&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt5" checked> 동호수&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt6" checked> 계약자&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt7" checked> 생년월일(성별)&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt8" checked> 계약일자&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt9"> 총 납입금&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt10" checked> 연락처[1]&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt11"> 연락처[2]&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt12"> 주소[1][등본]&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt13" checked> 주소[2][우편]&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt14"> 미비서류&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt15"> 명의변경 횟수&nbsp;</label></div>
				<div class="checkbox"><label><input type="checkbox" name="opt16"> 비 고</label></div>
			</div>
		</form>
			<div class="col-xs-12 table-responsive" style="padding: 0;">
				<table class="table table-bordered table-hover table-condensed">
					<thead class="bo-top center bgf8">
						<tr>
							<td width="7%">일련번호</td>
							<td width="7%">차 수</td>
							<td width="6%">타 입</td>
							<td width="7%">동 호 수</td>
							<td width="6%">계 약 자</td>
							<td width="10%">계약 일자</td>
							<td width="10%">연락처 [1]</td>
							<td width="8%">총 납입금</td>
							<td width="6%">계약 완납</td>
							<td width="9%">미비 서류</td>
							<td width="14%">비 고</td>
							<td width="10%">계약자 거주지</td>
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

		$idoc = explode("-", $lt->incom_doc); // 미비 서류
		$incom_doc = "";
		if($idoc[0]==1) $incom_doc .= " 각서9종/";
		if($idoc[1]==1) $incom_doc .= " 주민등본/";
		if($idoc[2]==1) $incom_doc .= " 주민초본/";
		if($idoc[3]==1) $incom_doc .= " 가족관계증명/";
		if($idoc[4]==1) $incom_doc .= " 인감증명/";
		if($idoc[5]==1) $incom_doc .= " 사용인감/";
		if($idoc[6]==1) $incom_doc .= " 신분증/";
		if($idoc[7]==1) $incom_doc .= " 배우자등본/";

		$dong_ho = explode("-", $lt->unit_dong_ho);
		$adr1 = ($lt->cont_addr2) ? explode("|", $lt->cont_addr2) : explode("|", $lt->cont_addr1);
		$adr2 = explode(" ", $adr1[1]);
		$addr = $adr2[0]." ".$adr2[1];
		$unit_dh = explode("-", $lt->unit_dong_ho);
		$cont_edit_link ="<a href ='".base_url('cms_m1/sales/1/2?project='.$project.'&mode=2&cont_sort1=1&cont_sort2=2&diff_no='.$lt->cont_diff.'&type='.$lt->unit_type.'&dong='.$unit_dh[0].'&ho='.$unit_dh[1])."'>" ;
		$new_span = ($lt->cont_date>=date('Y-m-d', strtotime('-3 day')))  ? "<span style='background-color: #2A41DB; color: #fff; font-size: 10px;'>&nbsp;N </span>&nbsp; " : "";
	?>
						<tr>
							<td><?php echo $cont_edit_link.$lt->cont_code."</a>"; ?></td>
							<td><?php echo $nd->diff_name; ?></td>
							<td class="left"><span style="background-color: <?php echo $type_color[$lt->unit_type]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp; <?php echo $lt->unit_type; ?></td>
							<td><?php echo $cont_edit_link.$lt->unit_dong_ho."</a>"; ?></td>
							<td><?php echo $cont_edit_link.$lt->contractor."</a>"; ?></td>
							<td><?php echo $new_span." ".$lt->cont_date; ?></span></td>
							<td><?php echo $lt->cont_tel1; ?></td>
							<td class="right"><a href="<?php echo base_url('cms_m1/sales/2/2')."?project=".$project."&dong=".$dong_ho[0]."&ho=".$dong_ho[1]; ?>"><?php echo number_format($total_rec->received); ?></a></td>
							<td><?php echo $is_paid_ok; ?></td>
							<td><div style="cursor: pointer; color: red;" data-toggle="tooltip" data-placement="left" title="<?php echo $incom_doc; ?>"><?php echo cut_string($incom_doc, 9, ".."); ?></div></td>
							<td class="left"><div style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="<?php echo $lt->note; ?>"><?php echo cut_string($lt->note, 12, ".."); ?></div></td>
							<td><?php echo $addr; ?></td>
						</tr>
	<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	<?php endif; ?>
			<div class="col-xs-12 center" style="margin-top: 0px; padding: 0;">
				<ul class="pagination pagination-sm"><?php echo $pagination; ?></ul>
			</div>
	  </div>

	<div class="row font12" style="margin: 0; padding: 0;">
        <div class="col-md-12 mb10"><h4><span class="label label-success">3. 청약 현황</span></h4></div>
<?php if(empty($app_data)) : ?>
		<div class="col-xs-12 center bo-top bo-bottom" style="padding: 50px 0;">등록된 데이터가 없습니다.</div>
<?php else : ?>
		<div class="col-xs-12 hidden-xs hidden-sm right" style="padding: 0 20px 0; margin-top: -18px; color: #5E81FE;">
			<?php echo "[ 결과 : ".number_format($app_num)." 건 ]"; ?>
<?php if(count($app_data)>10): ?>
			<a href="javascript:" onclick="$('.tr_toggle').toggle();" style="margin: 0 10px 3px;" class="btn btn-xs btn-info text_toggle">[청약 데이터 펼치기]</a>
<?php endif; ?>
			<a href="<?php echo base_url('/cms_download/application_data/download')."?pj=".$project; ?>">
				<img src="<?php echo base_url(); ?>static/img/excel_icon.jpg" height="14" border="0" alt="EXCEL 아이콘" style="margin-top: -3px;"/> EXCEL로 출력
			</a>
		</div>
		<div class="col-xs-12 table-responsive" style="padding: 0;">
			<table class="table table-bordered table-hover table-condensed">
				<thead class="bo-top center bgf8">
					<tr>
						<td width="8%">타 입</td>
						<td width="9%">동 호 수</td>
						<td width="9%">청 약 자</td>
						<td width="9%">차 수</td>
						<td width="10%">청 약 금</td>
						<td width="12%">청약 일자</td>
						<td width="9%">상 태</td>
						<td width="12%">상태 변경일</td>
						<td width="22%">비 고</td>
					</tr>
				</thead>
				<tbody class="bo-bottom center">
<?php
$z = 0;
foreach($app_data as $lt) :
	switch ($lt->disposal_div) :
		case '1': $condi = "<font color='#0D069F'>계약전환</font>"; break;
		case '2': $condi = "<font color='#8C1024'>해지신청</font>"; break;
		case '3': $condi = "<font color='#354E62'>환불완료</font>"; break;
		default: $condi = "<font color='#05980F'>정상청약</font>"; break;
	endswitch;
	$unit_dh = explode("-", $lt->unit_dong_ho);
	switch ($lt->disposal_div) {
		case '0': $app_edit_link = "<a href='".base_url('cms_m1/sales/1/2')."?project=".$project."&mode=2&cont_sort1=1&cont_sort2=1&diff_no=".$lt->app_diff."&type=".$lt->unit_type."&dong=".$unit_dh[0]."&ho=".$unit_dh[1]."'>"; break;
		case '2': $app_edit_link = "<a href='".base_url('cms_m1/sales/1/2')."?project=".$project."&mode=2&cont_sort1=2&cont_sort3=3&diff_no=".$lt->app_diff."&type=".$lt->unit_type."&dong=".$unit_dh[0]."&ho=".$unit_dh[1]."'>"; break;
		default: $app_edit_link = ""; break;
	}
	$app_edit = ($lt->disposal_div=='0' OR $lt->disposal_div=='2') ? "</a>" : "";
	$new_span = ($lt->app_date>=date('Y-m-d', strtotime('-3 day')))  ? "<span style='background-color: #AB0327; color: #fff; font-size: 10px;'>&nbsp;N </span>&nbsp; " : "";
?>
					<tr <?php if($z>10) echo "class='tr_toggle'; style='display:none;'" ?>>
						<td class="left"><span style="background-color: <?php echo $type_color[$lt->unit_type] ?>;">&nbsp;&nbsp;</span>&nbsp; <?php echo $lt->unit_type; ?></span></td>
						<td><?php echo $app_edit_link.$lt->unit_dong_ho.$app_edit; ?></td>
						<td><?php echo $app_edit_link.$lt->applicant.$app_edit; ?></td>
<?php $diff = $this->cms_main_model->sql_row(" SELECT diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no = '$lt->app_diff' "); ?>
						<td ><?php echo $diff->diff_name;?></td>
						<td class="right"><?php echo number_format($lt->app_in_mon)." 원"; ?></td>
						<td><?php echo $new_span." ".$lt->app_date; ?></td>
						<td><?php echo $condi; ?></td>
						<td><?php if($lt->disposal_date && $lt->disposal_date!="0000-00-00")echo $lt->disposal_date; ?></td>
						<td class="left"><div style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="<?php echo $lt->note; ?>"><?php echo cut_string($lt->note, 22, ".."); ?></div></td>
					</tr>
<?php $z++; endforeach; ?>
				</tbody>
			</table>
			<div class="center">
<?php if(count($app_data)>10): ?>
				<a href="javascript:" onclick="$('.tr_toggle').toggle();"  class="btn btn-xs btn-info text_toggle" style="padding: 0 10px;">[청약 데이터 펼치기]</a>
<?php endif; ?>
			</div>
		</div>
<?php endif; ?>
  </div>
<?php endif ?>
