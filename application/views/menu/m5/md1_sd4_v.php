			<div class="main_start"></div>

			<div class="row">
				<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 600px;'; ?>">
					<div class="row" style="margin: 0 0 20px 0; border-bottom: 1px solid #ddd;">
						<div class="col-md-2" style="background-color: #F4F4F4; height: 40px; padding-top: 10px;">은행별</div>
						<div class="col-md-2" style="height: 40px; padding-top: 5px;">
							<select class="form-control input-sm">
								<option>전 체</option>
								<option value=""></option>
								<option value=""></option>
								<option value=""></option>
								<option value=""></option>
							</select>
						</div>
						<div class="col-md-3" style="height: 40px; padding-top: 10px;"></div>
						<div class="col-md-2" style="height: 40px; padding-top: 5px;"></div>
						<div class="col-md-2" style="height: 40px; padding-top: 5px;">
							<input class="form-control input-sm">
						</div>
						<div class="col-md-1" style="background-color: #F4F4F4; height: 40px; padding-top: 5px;">
							<button class="btn btn-primary btn-sm center"> 검 색 </button>
						</div>
					</div>
					<div class="row table-responsive" style="margin: 0;">
						<table class="table table-bordered font12">
							<thead>
								<tr>
									<th class="col-md-1 center" style="background-color: #ecf3fe; border-left: 0;"><input type="checkbox"></th>
									<th class="col-md-2 center bo-left" style="background-color: #ecf3fe;">거래은행</th>
									<th class="col-md-1 center bo-left" style="background-color: #ecf3fe;">은행코드</th>
									<th class="col-md-1 center bo-left" style="background-color: #ecf3fe;">계좌별칭</th>
									<th class="col-md-3 center bo-left" style="background-color: #ecf3fe;">계좌번호</th>
									<th class="col-md-2 center bo-left" style="background-color: #ecf3fe;">관리부서(현장)</th>
									<th class="col-md-2 center bo-left" style="background-color: #ecf3fe; border-right: 0;">비 고</th>
								</tr>
							</thead>
							<tbody>
<?php foreach($list as $lt) : ?>
								<tr>
									<td class="center"><input type="checkbox"></td>
									<td class="center bo-left"><?php echo $lt->bank; ?></td>
									<td class="center bo-left"><?php echo $lt->bank_code; ?></td>
									<td class="center bo-left"><?php echo $lt->name; ?></td>
									<td class="center bo-left"><?php echo $lt->number; ?></td>
									<td class="bo-left" style="padding-left: 15px;"><?php echo $lt->holder; ?></td>
									<td class="bo-left" style="padding-left: 15px;"><?php echo $lt->note; ?></td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>
<?php if(empty($list)) : ?>
						<div class="center" style="padding: 100px 0;">등록된 데이터가 없습니다.</div>
<?php endif; ?>
					</div>
					<div class="col-md-12 center" style="margin-top: 0px; padding: 0;">
						<ul class="pagination pagination-sm"><?php echo $pagination; ?></ul>
					</div>
				</div>
				<div class="row" style="margin: 0 15px;">
					<div class="col-md-12" style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
						<div class="col-xs-6"><button class="btn btn-success btn-sm">신규등록</button></div>
						<div class="col-xs-6" style="text-align: right;"><button class="btn btn-danger btn-sm">선택삭제</button></div>
					</div>
				</div>

			</div>
