			<div class="main_start"></div>

<?php if( !$this->input->get('ss_di') or $this->input->get('ss_di')==1) : ?>
			<div class="row">
				<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 490px;'; ?>">
					<div class="row" style="margin: 0 0 20px 0; border-bottom: 1px solid #ddd;">
						<form name="list_frm" method="get" action="">
							<div class="col-xs-4 col-md-2" style="background-color: #F4F4F4; height: 40px; padding-top: 10px;">부서별</div>
							<div class="col-xs-8 col-md-2" style="height: 40px; padding-top: 5px;">
								<select class="form-control input-sm" name="div_sel" onchange="submit();">
									<option value=''>전 체</option>
<?php foreach($all_div as $lt) : ?>
									<option value="<?php echo $lt->div_code; ?>" <?if($lt->div_code==$this->input->get('div_sel')) echo "selected";?>><?php echo $lt->div_name ?></option>
<?php endforeach; ?>
								</select>
							</div>
							<div class="col-xs-12 col-md-5" style="height: 40px; padding-top: 10px;"></div>
							<div class="col-xs-8 col-md-2" style="height: 40px; padding-top: 5px;">
								<input class="form-control input-sm" name="div_search" placeholder="부서 검색" value="<?php if($this->input->get('div_search')) echo $this->input->get('div_search'); ?>">
							</div>
							<div class="col-xs-4 col-md-1" style="background-color: #F4F4F4; height: 40px; padding-top: 5px;">
								<button class="btn btn-primary btn-sm center"> 검 색 </button>
							</div>
						</form>
					</div>
					<div class="row table-responsive" style="margin: 0;">
						<table class="table table-bordered table-condensed table-hover font12">
							<thead style="background-color: #F2F2F9;">
								<tr>
									<th class="col-md-1 center"><input type="checkbox"></th>
									<th class="col-md-1 center bo-left">부서코드</th>
									<th class="col-md-2 center bo-left">부서명</th>
									<th class="col-md-4 center bo-left">담당업무</th>
									<th class="col-md-4 center bo-left">비 고</th>
								</tr>
							</thead>
							<tbody>
<?php foreach($list as $lt) : ?>
								<tr>
									<td class="center"><input type="checkbox"></td>
									<td class="center bo-left">
										<a href="javascript:" onclick="location.href='?ss_di=2&amp;mode=modify&amp;seq=<?php echo $lt->seq; ?>'"><?php echo $lt->div_code; ?></a>
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

<?php
	$attributes = array('name' => 'form1', 'class' => '', 'method' => 'post');
	echo form_open('/m5/config/1/1/', $attributes);
?>
					<fieldset class="font12">
						<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 490px;'; ?>">
							<div style="height:20px; margin: 5px 0; background-color: #eee;"></div>
							<div style="height: 36px; padding: 8px 0 0 10px; margin-bottom: 10px;">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: green;"></span>
								<strong>부서정보 <?php if($this->input->get('mode')=='reg') echo '신규'; else echo '수정'; ?>등록</strong>
							</div>

								<label for="mode" class="sr-only">모드</label>
								<input type="hidden" name="mode" value="<?php echo $this->input->get('mode'); ?>">
<?php if($this->input->get('seq')) : ?>
								<label for="seq" class="sr-only">키</label>
								<input type="hidden" name="seq" value="<?php echo $sel_div->seq; ?>">
<?php endif; ?>
								<div class="row bo-top">
									<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
										<label for="div_code">부서코드 <span class="red">*</span></label>
									</div>
									<div class="col-xs-8 col-sm-8 col-md-4 form-wrap">
										<input type="text" class="form-control input-sm" id="div_code" name="div_code" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_div->div_code; ?>" required autofocus>
									</div>
									<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
										<label for="div_name">부서명 <span class="red">*</span></label>
									</div>
									<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap">
										<input type="text" class="form-control input-sm han" id="div_name" name="div_name" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_div->div_name; ?>" required autofocus>
									</div>
								</div>
								<div class="row" style="border-top: 1px solid #ddd;">
									<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
										<label for="manager">부서책임자</label>
									</div>
									<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap">
										<input type="text" class="form-control input-sm" id="manager" name="manager" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_div->manager; ?>">
									</div>
									<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
										<label for="div_tel">부서전화</label>
									</div>
									<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap">
										<input type="text" class="form-control input-sm han" id="div_tel" name="div_tel" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_div->div_tel; ?>">
									</div>
								</div>
								<div class="row" style="border-top: 1px solid #ddd;">
									<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
										<label for="res_work">담당업무 <span class="red">*</span></label>
									</div>
									<div class=" col-xs-8 col-sm-8 col-md-10 form-wrap">
										<input type="text" class="form-control input-sm" id="res_work" name="res_work" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_div->res_work; ?>" required autofocus>
									</div>
								</div>
								<div class="row" style="border-top: 1px solid #ddd;">
									<div class=" col-xs-12 col-sm-12 col-md-2 label-wrap2 bo-bottom" style="height: 80px;">
										<label for="note">비 고</label>
									</div>
									<div class=" col-xs-12 col-sm-12 col-md-10 form-wrap bo-bottom" style="height: 80px;">
										<textarea class="form-control input-sm" id="note" name="note"  rows="3" cols="114"><?php if($this->input->get('seq')) echo $sel_div->note; ?></textarea>
									</div>
								</div>
							</div>

					</fieldset>
				</form>

				<div class="row" style="margin: 0 15px;">
					<div class="col-md-12" style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
<?
	if($auth<2){
		$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
		$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
	}else{
		$submit_str="div_submit('".$this->input->get('mode')."');";
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
