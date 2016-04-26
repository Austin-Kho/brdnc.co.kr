			<div class="main_start"></div>

<?php if( !$this->input->get('ss_di') or $this->input->get('ss_di')==1) : ?>
			<div class="row">
				<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 490px;'; ?>">
					<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
						<form name="list_frm" method="get" action="">
							<div class="col-md-2" style="background-color: #F4F4F4; height: 40px; padding-top: 10px;">은행별</div>
							<div class="col-md-2" style="height: 40px; padding-top: 5px;">
								<select class="form-control input-sm" name="bank_code" onchange="submit();">
									<option value="">전 체</option>
<?php foreach($com_bank as $lt) : ?>
									<option value="<?php echo $lt->bank_code; ?>" <?if($lt->bank_code==$this->input->get('bank_code')) echo "selected";?>><?php echo $lt->bank; ?></option>
<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-5" style="height: 40px; padding-top: 10px;"></div>
							<div class="col-md-2" style="height: 40px; padding-top: 5px;">
								<input class="form-control input-sm" name="bank_search" placeholder="계좌 검색" value="<?php if($this->input->get('bank_search')) echo $this->input->get('bank_search'); ?>">
							</div>
							<div class="col-md-1" style="background-color: #F4F4F4; height: 40px; padding-top: 5px;">
								<button class="btn btn-primary btn-sm center"> 검 색 </button>
							</div>
						</form>
					</div>
					<div class="row table-responsive" style="margin: 0;">
						<table class="table table-bordered table-condensed table-hover font12">
							<thead style="background-color: #F2F2F9;">
								<tr>
									<th class="col-md-1 center"><input type="checkbox"></th>
									<th class="col-md-1 center bo-left">계좌명칭</th>
									<th class="col-md-2 center bo-left">거래은행</th>
									<th class="col-md-1 center bo-left">은행코드</th>
									<th class="col-md-3 center bo-left">계좌번호</th>
									<th class="col-md-2 center bo-left">관리부서(현장)</th>
									<th class="col-md-2 center bo-left">비 고</th>
								</tr>
							</thead>
							<tbody>
<?php foreach($list as $lt) : ?>
								<tr>
									<td class="center"><input type="checkbox"></td>
									<td class="center bo-left"><a href="javascript:" onclick="location.href='?ss_di=2&amp;mode=modify&amp;seq=<?php echo $lt->no; ?>'"><?php echo $lt->name; ?></a></td>
									<td class="center bo-left"><?php echo $lt->bank; ?></td>
									<td class="center bo-left"><?php echo $lt->bank_code; ?></td>
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
<?
	if($auth<2){
		$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
		$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
	}else{
		$submit_str="location.href='?ss_di=2&amp;mode=reg' ";
		$del_str="alert('준비중..! 현재 해당 부서에 대한 수정 화면에서 개별 삭제처리만 가능합니다.')";
}?>
						<div class="col-xs-6"><button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>">신규등록</button></div>
						<div class="col-xs-6" style="text-align: right;"><button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button></div>
					</div>
				</div>

			</div>


<?php elseif($this->input->get('ss_di')==2) : ?>
			<div class="row" style="padding: 0 15px;">
<?php
	$attributes = array('name' => 'form1', 'class' => '', 'method' => 'post');
	echo form_open('/m5/config/1/4/', $attributes);
?>
					<fieldset class="font12">
						<div class="row" style="<?php if( !$this->agent->is_mobile()) echo 'height: 490px;'; ?>">
							<div style="height:20px; margin: 5px 0; background-color: #eee;"></div>
							<div style="height: 36px; padding: 8px 0 0 10px; margin-bottom: 10px;">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: green;"></span>
								<strong>은행계좌 <?php if($this->input->get('mode')=='reg') echo '신규'; else echo '수정'; ?>등록</strong>
							</div>
							<label for="mode" class="sr-only">모드</label>
							<input type="hidden" name="mode" value="<?php echo $this->input->get('mode'); ?>">
<?php if($this->input->get('seq')) : ?>
							<label for="seq" class="sr-only">키</label>
							<input type="hidden" name="seq" value="<?php echo $sel_bank->no; ?>">
<?php endif; ?>




							<div class="row bo-top">
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2">
									<label for="bank">거래은행 <span class="red">*</span></label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
									<div class="col-xs-7 col-md-5" style="padding-left: 0;">
										<select class="form-control input-sm" name="bank" onchange="this.form.bank_code.value=this.value;">
											<option value=''>전 체</option>
<?php foreach($all_bank as $lt) : ?>
											<option value="<?php echo $lt->bank_code; ?>" <?php if($this->input->get('seq')&&$lt->bank_code==$sel_bank->bank_code) echo "selected";?>><?php echo $lt->bank_name; ?></option>
<?php endforeach; ?>
										</select>
									</div>
									<div class="col-xs-5 col-md-3" style="padding-left: 0;">
										<input type="text" class="form-control input-sm han wid-90" id="bank_code" name="bank_code" maxlength="3" value="<?php if($this->input->get('seq')) echo $sel_bank->bank_code; ?>" readonly>
									</div>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2" >
									<label for="name">계좌별칭 <span class="red">*</span></label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
									<input type="text" class="form-control input-sm en_only" id="name" name="name" maxlength="14" value="<?php if($this->input->get('seq')) echo $sel_bank->name; ?>">
								</div>
							</div>
							<div class="row bo-top">
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2">
									<label for="number">계좌번호 <span class="red">*</span></label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
									<input type="text" class="form-control input-sm han" id="number" name="number" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_bank->number; ?>">
								</div>
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2">
									<label for="holder">예금주 <span class="red">*</span></label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
									<input type="text" class="form-control input-sm han" id="holder" name="holder" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_bank->holder; ?>">
								</div>
							</div>
							<div class="row bo-top">
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2">
									<label for="dir_tel">관리 구분 <span class="red">*</span></label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap checkbox" style="margin-bottom: 0">
						      <label><input type="checkbox" name="is_com" value="1" checked>  본사 관리계좌</label>
								</div>
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2">
									<label for="mobile">관리 부서 <span class="red">*</span></label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
									<div class="col-xs12 col-sm-8 col-md-6" style="padding-left: 0;">
										<select class="form-control input-sm" name="div_seq">
											<option value=''>전 체</option>
<?php foreach($all_div as $lt) : ?>
											<option value="<?php echo $lt->div_code; ?>" <?if($this->input->get('seq') && $lt->div_code==$sel_bank->div_seq) echo "selected";?>><?php echo $lt->div_name ?></option>
<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row bo-top bo-bottom">
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2">
									<label for="manager">관리책임자</label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
									<input type="text" class="form-control input-sm en_only" id="manager" name="manager" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_bank->manager; ?>">
								</div>
								<div class="col-xs-4 col-sm-4 col-md-2 label-wrap2">
									<label for="open_date">개설일자 <span class="red">*</span></label>
								</div>
								<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
									<div class="col-xs-10 col-sm-8 col-md-6" style="padding-left: 0;">
										<input type="text" class="form-control input-sm wid-100" id="open_date" name="open_date" maxlength="10" value="<?php if($this->input->get('seq')) echo $sel_bank->open_date; ?>" readonly onClick="cal_add(this); event.cancelBubble=true" maxlength="10" required autofocus>
									</div>
									<div class="col-xs-2 col-sm-4 col-md-6 glyphicon-wrap">
										<a href="javascript:" onclick="cal_add(document.getElementById('open_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
									</div>
								</div>
							</div>

							<div class="row" style="padding: 10px; font-weight: bold;">
								<span class="red">*</span> 기타 사항
							</div>

							<div class="row bo-top">
								<div class="col-xs-12 col-sm-12 col-md-2 label-wrap2 bo-bottom" style="height: 90px;">
									<label for="note">비 고 (거래계좌 정보 등)</label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-10 form-wrap bo-bottom" style="height: 90px; padding: 10px;">
									<textarea class="form-control input-sm" id="note" name="note"  rows="3" cols="114"><?php if($this->input->get('seq')) echo $sel_bank->note; ?></textarea>
								</div>
							</div>

						</div>
					</fieldset>
				</form>

				<div class="row" style="padding: 0 15px;">
					<div class="col-md-12" style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
<?
	if($auth<2){
		$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
		$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
	}else{
		$submit_str="bank_submit('".$this->input->get('mode')."');";
		$del_str="form1_seq_del(".$this->input->get('seq').");";
	}
?>
						<div class="col-xs-6">
							<button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>"><?php if($this->input->get('mode')=='modify') echo '수정하기'; else echo '등록하기'; ?></button>
							<button class="btn btn-info btn-sm" onclick="location.href='?ss_di=1' ">목록으로</button>
						</div>
						<div class="col-xs-6" style="text-align: right;">
<?php if($this->input->get('seq')) : ?>
							<button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button>
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
<?php endif; ?>
