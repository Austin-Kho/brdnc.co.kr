			<div class="main_start"></div>

<?php if( !$this->input->get('ss_di') or $this->input->get('ss_di')==1) : ?>
			<div class="row">
				<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 600px;'; ?>">
					<div class="row" style="margin: 0 0 20px 0; border-bottom: 1px solid #ddd;">
						<form name="list_frm" method="post" action="">
							<div class="col-md-2" style="background-color: #F4F4F4; height: 40px; padding-top: 10px;">부서별</div>
							<div class="col-md-2" style="height: 40px; padding-top: 5px;">
								<select class="form-control input-sm" name="div_code" onchange="submit();">
									<option value=''>전 체</option>
<?php foreach($all_div as $lt) : ?>
									<option value="<?php echo $lt->div_code; ?>" <?if($lt->div_code==$this->input->post('div_code')) echo "selected";?>><?php echo $lt->div_name ?></option>
<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-5" style="height: 40px; padding-top: 10px;"></div>
							<div class="col-md-2" style="height: 40px; padding-top: 5px;">
								<input class="form-control input-sm" name="div_search" placeholder="부서 검색">
							</div>
							<div class="col-md-1" style="background-color: #F4F4F4; height: 40px; padding-top: 5px;">
								<button class="btn btn-primary btn-sm center"> 검 색 </button>
							</div>
						</form>
					</div>
					<div class="row table-responsive" style="margin: 0;">
						<table class="table table-bordered font12">
							<thead>
								<tr>
									<th class="col-md-1 center" style="background-color: #ecf3fe; border-left: 0;"><input type="checkbox"></th>
									<th class="col-md-1 center bo-left" style="background-color: #ecf3fe;">부서코드</th>
									<th class="col-md-2 center bo-left" style="background-color: #ecf3fe;">부서명</th>
									<th class="col-md-4 center bo-left" style="background-color: #ecf3fe;">담당업무</th>
									<th class="col-md-4 center bo-left" style="background-color: #ecf3fe; border-right: 0;">비 고</th>
								</tr>
							</thead>
							<tbody>
<?php foreach($list as $lt) : ?>
								<tr>
									<td class="center"><input type="checkbox"></td>
									<td class="center bo-left">
										<a href="javascript:" onclick="location.href='?ss_di=2&amp;mode=modify'"><?php echo $lt->div_code; ?></a>
									</td>
									<td class="center bo-left"><?php echo $lt->div_name; ?></td>
									<td class="bo-left" style="padding-left: 15px;"><?php echo $lt->res_work; ?></td>
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
<?
	if($auth<2){
		$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
		$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
	}else{
		$submit_str="location.href='?ss_di=2&amp;mode=reg' ";
		$del_str="alert('준비중..! 현재 해당 부서에 대한 수정 화면에서 개별 삭제처리만 가능합니다.')";
	}
?>
						<div class="col-xs-6"><button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>">신규등록</button></div>
						<div class="col-xs-6" style="text-align: right;"><button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button></div>
					</div>
				</div>

			</div>



<?php elseif($this->input->get('ss_di')==2) : ?>
			<div class="row">
				<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 600px;'; ?>">
					<div style="height:20px; margin: 5px 0; background-color: #eee;"></div>
					<div style="height: 36px; padding: 8px 0 0 10px; margin-bottom: 10px;">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: green;"></span>
						<strong>부서정보 <?php if($this->input->get('mode')=='reg') echo '신규'; else echo '수정'; ?>등록</strong>
					</div>
<?php
	$attributes = array('name' => 'form1', 'class' => 'form-inline', 'method' => 'post');
	echo form_open('/m5/config/1/1/', $attributes);
?>
					<fieldset class="font12">
						<div class="row" style="border-top: 1px solid #ddd;">
							<div class="form-group col-xs-12 col-sm-4 col-md-2 label-wrap2" >
								<label for="co_name">부서코드 <span class="red">*</span></label>
							</div>
							<div class="form-group col-xs-12 col-sm-8 col-md-4 form-wrap">
								<input type="text" class="form-control input-sm" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
							</div>
							<div class="form-group col-xs-12 col-sm-4 col-md-2 label-wrap2">
								<label for="co_no1">부서명 <span class="red">*</span></label>
							</div>
							<div class="form-group col-xs-12 col-sm-8 col-md-4 form-wrap">
								<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
							</div>
						</div>
						<div class="row" style="border-top: 1px solid #ddd;">
							<div class="form-group col-xs-12 col-sm-4 col-md-2 label-wrap2" >
								<label for="co_name">부서책임자</label>
							</div>
							<div class="form-group col-xs-12 col-sm-8 col-md-4 form-wrap">
								<input type="text" class="form-control input-sm" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
							</div>
							<div class="form-group col-xs-12 col-sm-4 col-md-2 label-wrap2">
								<label for="co_no1">부서전화</label>
							</div>
							<div class="form-group col-xs-12 col-sm-8 col-md-4 form-wrap">
								<input type="text" class="form-control input-sm han" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
							</div>
						</div>
						<div class="row" style="border-top: 1px solid #ddd;">
							<div class="form-group col-xs-12 col-sm-4 col-md-2 label-wrap2" >
								<label for="co_name">담당업무 <span class="red">*</span></label>
							</div>
							<div class="form-group col-xs-12 col-sm-8 col-md-10 form-wrap">
								<input type="text" class="form-control input-sm" id="co_name" name="co_name" maxlength="30" value="" required autofocus>
							</div>
						</div>
						<div class="row" style="border-top: 1px solid #ddd;">
							<div class="form-group col-xs-12 col-sm-4 col-md-2 label-wrap2 bo-bottom" style="height: 80px;">
								<label for="co_name">비 고 <span class="red">*</span></label>
							</div>
							<div class="form-group col-xs-12 col-sm-8 col-md-10 form-wrap bo-bottom" style="height: 80px;">
								<textarea class="form-control input-sm" rows="3" cols="114"></textarea>
							</div>
						</div>
					</fieldset>
				</form>
				</div>
				<div class="row" style="margin: 0 15px;">
					<div class="col-md-12" style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
<?
	if($auth<2){
		$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
		$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
	}else{
		$submit_str="location.href='?ss_di=2&amp;mode=reg' ";
		$del_str="alert('준비중..! 현재 해당 부서에 대한 수정 화면에서 개별 삭제처리만 가능합니다.')";
	}
?>
						<div class="col-xs-6">
							<button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>">등록하기</button>
							<button class="btn btn-info btn-sm" onclick="location.href='?ss_di=1' ">목록으로</button>
						</div>
						<div class="col-xs-6" style="text-align: right;">
							<button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button>
						</div>
					</div>
				</div>
			</div>
<?php endif; ?>
