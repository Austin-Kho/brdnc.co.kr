<?php
  if($auth21<1) :
  	include('no_auth.php');
  else :
?>
			<div class="main_start">&nbsp;</div>
			<!-- 4. 본사관리 -> 2. 인사총무관리 ->1. 인사급여 관리 페이지 -->

			<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
				<div class="col-md-2 point-sub" style="height: 40px; padding-top: 10px;">부서별</div>
				<div class="col-md-10" style="height: 40px; padding-top: 10px;">
					<select>
						<option>전 체</option>
						<option value=""></option>
						<option value=""></option>
						<option value=""></option>
						<option value=""></option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 table-responsive" style="<?php if( !$this->agent->is_mobile()) echo 'height: 432px;'; ?>">
					<!-- <div class="center" style="padding-top: 100px;">등록된 데이터가 없습니다.</div> -->
					<table class="table table-bordered table-condensed">
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
<?php endif ?>
