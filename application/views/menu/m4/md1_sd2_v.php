<?php
	if($auth<1){ $excel_pop = "alert('출력 권한이 없습니다!');";
	}else{
		$url_date = urlencode('$sh_date');
		$excel_pop = "location.href='".base_url()."excel_daily_money_report.php?sh_date=".$url_date."' ";
	}
 ?>
			<div class="main_start"><a href="javascript:" onclick="<?php echo $excel_pop; ?>">
				<img src="/static/img/excel_icon.jpg" height="10" border="0" alt="EXCEL 아이콘" /> EXCEL로 출력</a>
			</div>

			<div class="row" style="margin: 0 0 20px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #cccccc;">
				<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding-top: 10px;">구 분</div>
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
						<option value=""></option>
						<option value=""></option>
						<option value=""></option>
						<option value=""></option>
					</select>
				</div>
				<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding-top: 10px;">거래기간</div>
				<div class="col-md-3" style="height: 40px; padding: 5px;">
					<div class="col-xs-5" style="padding: 0px;">
						<input type="text" class="form-control input-sm wid-95" id="es_date" name="es_date" maxlength="10" value="" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="시작일">
					</div>
					<div class="col-xs-1 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('es_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
					</div>
					<div class="col-xs-5" style="padding: 0px;">
						<input type="text" class="form-control input-sm wid-95" id="es_date" name="es_date" maxlength="10" value="" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="종료일">
					</div>
					<div class="col-xs-1 glyphicon-wrap" style="padding: 6px 0;">
						<a href="javascript:" onclick="cal_add(document.getElementById('es_date'),this); event.cancelBubble=true">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
						</a>
					</div>
				</div>
				<div class="col-md-2">
					<img src="/static/images/to_today.jpg" alt="">
				</div>
				<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding: 5px;">
					<select class="form-control input-sm" name="">
						<option value="">통합검색</option>
					</select>
				</div>
				<div class="col-md-1" style="height: 40px; padding: 5px 0 0 5px;"><input type="text" name="name" value="" class="form-control input-sm"></div>
				<div class="col-md-1 center" style="height: 40px; padding: 3px;"><input type="button" name="name" value="검 색" class="btn btn-primary btn-sm"></div>
			</div>
			<div class="row">
				<div class="col-md-12 table-responsive" style="<?php if( !$this->agent->is_mobile()) echo 'height: 432px;'; ?>">
					<!-- <div class="center" style="padding-top: 100px;">등록된 데이터가 없습니다.</div> -->
					<table class="table table-condensed">
						<thead>
							<tr>
								<th class="col-md-1 center"><input type="checkbox"></th>
								<th class="col-md-1 center">부서코드</th>
								<th class="col-md-3 center">부서명</th>
								<th class="col-md-4 center">담당업무</th>
								<th class="col-md-3 center">비고</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="center"></td>
								<td class="center" >001</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center" >002</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center" >003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="center"></td>
								<td class="center">003</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						</tbody>
					</table>
				</div>
				<div class="col-md-12 center"><?php echo 'pagination'; ?></div>
			</div>
			<div class="row" style="margin: 0;">
				<div class="col-md-12" style="height: 56px; padding: 10px 15px; margin-top: 18px; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
					<div class="col-xs-6"><button class="btn btn-success btn-sm">신규등록</button></div>
					<div class="col-xs-6" style="text-align: right;"><button class="btn btn-danger btn-sm">선택삭제</button></div>
				</div>
			</div>
