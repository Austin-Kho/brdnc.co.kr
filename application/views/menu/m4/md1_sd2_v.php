<script type="text/javascript">
	<!--
		function term_put(a,b,term){
			if(term=='d')var term="<?php echo date('Y-m-d'); ?>";
			if(term=='w')var term="<?php echo date('Y-m-d',strtotime ('-1 weeks'));?>";
			if(term=='m')var term="<?php echo date('Y-m-d',strtotime ('-1 months'));?>";
			if(term=='3m')var term="<?php echo date('Y-m-d',strtotime ('-3 months'));?>";
			document.getElementById(a).value = term;
			document.getElementById(b).value = "<?php echo date('Y-m-d');?>";
		}
		function _del(code){
			if(aa=confirm('정말 삭제하시겠습니까?')){
				location.href='capital_del.php?del_code='+code
			}else{
				return false;
			}
		}
	//-->
</script>
<?php
	if($auth<1){ $excel_pop = "alert('출력 권한이 없습니다!');";
	}else{
		$url_date = urlencode('$sh_date');
		$excel_pop = "location.href='".base_url()."excel_daily_money_report.php?sh_date=".$url_date."' ";
	}
 ?>
			<div class="main_start">
				<a href="javascript:" onclick="<?php echo $excel_pop; ?>">
					<img src="/static/img/excel_icon.jpg" height="10" border="0" alt="EXCEL 아이콘" /> EXCEL로 출력
				</a>
			</div>




			<div class="row">
				<div class="col-md-12">
					<div class="row" style="margin: 0 0 20px 0; border-bottom: 1px solid #ddd;">
						<form name="list_frm" method="post" action="">
							<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding: 10px 0;">구 분</div>
							<div class="col-md-1" style="height: 40px; padding: 5px;">
								<select class="form-control input-sm wid-100">
									<option value="">전 체</option>
									<option value="">입금</option>
									<option value="">출금</option>
									<option value="">대체</option>
								</select>
							</div>
							<div class="col-md-1" style="height: 40px; padding: 5px;">
								<select class="form-control input-sm wid-100">
									<option value="">전 체</option>
									<option value="">계정과목</option>
									<option value="">적 요</option>
									<option value="">거래처</option>
									<option value="">입출금처</option>
								</select>
							</div>
							<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding: 10px 0;">거래기간</div>
							<div class="col-md-3" style="height: 40px; padding: 5px;">
								<div class="col-xs-5" style="padding: 0px;">
									<input type="text" class="form-control input-sm wid-95" id="s_date" name="s_date" maxlength="10" value="" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="시작일">
								</div>
								<div class="col-xs-1 glyphicon-wrap" style="padding: 6px 0;">
									<a href="javascript:" onclick="cal_add(document.getElementById('s_date'),this); event.cancelBubble=true">
										<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
									</a>
								</div>
								<div class="col-xs-5" style="padding: 0px;">
									<input type="text" class="form-control input-sm wid-95" id="e_date" name="e_date" maxlength="10" value="" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="종료일">
								</div>
								<div class="col-xs-1 glyphicon-wrap" style="padding: 6px 0;">
									<a href="javascript:" onclick="cal_add(document.getElementById('e_date'),this); event.cancelBubble=true">
										<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
									</a>
								</div>
							</div>
							<div class="col-md-2" style="padding: 9px 6px 0 0; text-align: right;">
								<a href="javascript:" onclick="term_put('s_date', 'e_date', 'd');" title="오늘"><img src="/static/img/to_today.jpg" alt="오늘"></a>
								<a href="javascript:" onclick="term_put('s_date', 'e_date', 'w');" title="일주일"><img src="/static/img/to_week.jpg" alt="일주일"></a>
								<a href="javascript:" onclick="term_put('s_date', 'e_date', 'm');" title="1개월"><img src="/static/img/to_month.jpg" alt="1개월"></a>
								<a href="javascript:" onclick="term_put('s_date', 'e_date', '3m');" title="3개월"><img src="/static/img/to_3month.jpg" alt="3개월"></a>
								<a href="javascript:" onclick="to_del('s_date', 'e_date');" title="지우기">
									<button type="button" class="close" aria-label="Close" style="margin-left: 5px;"><span aria-hidden="true">&times;</span></button>
								</a>
							</div>
							<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding: 5px;">
								<select class="form-control input-sm" name="">
									<option value="">통합검색</option>
									<option value="">계정과목</option>
									<option value="">적 요</option>
									<option value="">거래처</option>
									<option value="">입출금처</option>
								</select>
							</div>
							<div class="col-md-1" style="height: 40px; padding: 5px 0 0 5px;"><input type="text" name="name" value="" class="form-control input-sm" placeholder="검색어"></div>
							<div class="col-md-1 center" style="height: 40px; padding: 3px;"><input type="button" name="name" value="검 색" class="btn btn-info btn-sm"></div>
						</form>
					</div>
					<div class="row table-responsive" style="margin: 0;">
						<table class="table table-bordered table-hover table-condensed">
							<thead>
								<tr style="border-top: 1px solid #ddd; background-color: #EAEAEA;">
									<th style="width: 20px;" class="center"><input type="checkbox" disabled></th>
									<th style="width: 80px;" class="center">거래 일자</th>
									<th style="width: 80px;" class="center"> 구 분</th>
									<th style="width: 110px;" class="center">
										계정과목
										<a href="javascript:" onclick="popUp_size('/_menu3/account_m.php','account',700,800)" title="계정과목 관리">
											<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
										</a>
									</th>
									<th style="width: 190px;" class="center">적 요</th>
									<th style="width: 100px;" class="center">거 래 처</th>
									<th style="width: 50px;" class="center">입금처</th>
									<th style="width: 90px;" class="center">입금 금액</th>
									<th style="width: 50px;" class="center">출금처</th>
									<th style="width: 90px;" class="center">출금 금액</th>
									<th style="width: 90px;" class="center">증빙 서류</th>

									<? // if($auth>0){  //관리자와 자금담당에게만 출력 ?>
									<th style="width: 35px;">수정</th>
									<th style="width: 35px;">삭제</th>
									<?// }?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center" >001</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center" >002</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center" >003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center">003</td>
									<td colspan="11"> </td>
								</tr>

							</tbody>
						</table>
<?php //  if(empty($list)) : ?>
						<!-- <div class="center" style="padding: 100px 0;">등록된 데이터가 없습니다.</div> -->
<?php // endif; ?>
					</div>
					<div class="col-md-12 center" style="margin-top: 0px; padding: 0;">
						<ul class="pagination pagination-sm"><?php // echo $pagination; ?></ul>
					</div>
				</div>
				<div class="row" style="margin: 0 15px;">
					<!-- <div class="col-md-12" style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
						<div class="col-xs-6"><button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>">신규등록</button></div>
						<div class="col-xs-6" style="text-align: right;"><button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button></div>
					</div> -->
				</div>

			</div>
