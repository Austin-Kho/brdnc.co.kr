<?php
  if($auth12<1) :
  	include('no_auth.php');
  else :
?>
			<div class="main_start">&nbsp;</div>
			<!-- 5. 환경설정 -> 1. 기본정보관리 ->2. 직원 정보 관리 페이지 -->

<?php if( !$this->input->get('ss_di') or $this->input->get('ss_di')==1) : ?>
			<div class="row">
				<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 490px;'; ?>">
					<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
						<!-- <form name="list_frm" method="get" action=""> -->
<?php
	$attributes = array('method' => 'get', 'name' => 'list_frm');
	echo form_open(current_full_url(), $attributes);
?>
							<div class="bg-success col-md-2" style="height: 40px; padding-top: 10px;">부서별</div>
							<div class="col-md-7" style="height: 40px; padding-top: 5px;">
								<div class="col-md-3" style="padding: 0;">
									<select class="form-control input-sm" name="div_sel" onchange="submit();">
										<option value="">전 체</option>
<?php foreach($all_div as $lt) : ?>
										<option value="<?php echo $lt->div_name; ?>" <?if($lt->div_name==$this->input->get('div_sel')) echo "selected";?>><?php echo $lt->div_name ?></option>
<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-2" style="height: 40px; padding-top: 5px;">
								<input type="text" class="form-control input-sm" name="mem_search" placeholder="(임)직원 검색" value="<?php if($this->input->get('mem_search')) echo $this->input->get('mem_search'); ?>" onkeydown="if(event.keyCode==13)submit();">
							</div>
							<div class="col-md-1 right" style="background-color: #F4F4F4; height: 40px; padding-top: 5px;">
								<button class="btn btn-primary btn-sm"> 검 색 </button>
							</div>
						</form>
					</div>
					<div class="row table-responsive" style="margin: 0;">
						<table class="table table-bordered table-condensed table-hover font12">
							<thead style="background-color: #F2F2F9;">
								<tr>
									<th class="col-md-1 center"><input type="checkbox"></th>
									<th class="col-md-2 center bo-left">(임)직원명</th>
									<th class="col-md-2 center bo-left">담당부서</th>
									<th class="col-md-1 center bo-left">직 급</th>
									<th class="col-md-2 center bo-left">직통전화</th>
									<th class="col-md-2 center bo-left">비상전화(Mobile)</th>
									<th class="col-md-2 center bo-left">이메일(Email)</th>
								</tr>
							</thead>
							<tbody>
<?php foreach($list as $lt) : ?>
								<tr>
									<td class="center"><input type="checkbox"></td>
									<td class="center bo-left"><a href="?ss_di=2&amp;mode=modify&amp;seq=<?php echo $lt->seq; ?>"><?php echo $lt->mem_name; ?></a></td>
									<td class="center bo-left"><?php echo $lt->div_name; ?></td>
									<td class="center bo-left"><?php echo $lt->div_posi; ?></td>
									<td class="center bo-left"><?php echo $lt->dir_tel; ?></td>
									<td class="bo-left" style="padding-left: 15px;"><?php echo $lt->mobile; ?></td>
									<td class="bo-left" style="padding-left: 15px;"><?php echo $lt->email; ?></td>
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
	if($auth12<2){
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
	$attributes = array('name' => 'form1', 'class' => 'form-horizontal');
  if($this->input->get('seq')) :
		$hidden = array('mode' => $this->input->get('mode'), 'seq' => $sel_mem->seq);
  else :
		$hidden = array('mode' => $this->input->get('mode'));
	endif;
	echo form_open(current_full_url(), $attributes, $hidden);
?>
					<fieldset class="font12">
						<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 490px;'; ?>">
							<div style="height:20px; margin: 5px 0; background-color: #eee;"></div>
							<div style="height: 36px; padding: 8px 0 0 10px; margin-bottom: 10px;">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: green;"></span>
								<strong>직원정보 <?php if($this->input->get('mode')=='reg') echo '신규'; else echo '수정'; ?>등록</strong>
							</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="mem_name">(임)직원명 <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm han" id="mem_name" name="mem_name" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_mem->mem_name; ?>" required autofocus>
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="id_num">주민등록번호</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="id_num" name="id_num" maxlength="14" value="<?php if($this->input->get('seq')) echo $sel_mem->id_num; ?>">
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="div_seq">담당부서 <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<select id="div_name" name="div_name" class="form-control input-sm">
									<option value=""> 선 택
<?php foreach($all_div as $lt) : ?>
									<option value="<?php echo $lt->div_name; ?>" <?if( !empty($sel_mem->div_name)==$lt->div_name) echo "selected";?>><?php echo $lt->div_name ?></option>
<?php endforeach; ?>
								</select>
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="div_posi">직 급(책) <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm han" id="div_posi" name="div_posi" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_mem->div_posi; ?>">
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="dir_tel">직통전화</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="dir_tel" name="dir_tel" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_mem->dir_tel; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="mobile">비상전화 (Mobile) <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="mobile" name="mobile" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_mem->mobile; ?>">
							</div>
						</div>
						<div class="row bo-top bo-bottom">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="email">이메일 (Email) <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="email" name="email" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_mem->email; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="join_date">입 사 일 <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<div class="col-xs-10" style="padding-left: 0; padding-right: 0;">
                  <div>
                    <input type="text" class="form-control input-sm wid-100" id="join_date" name="join_date" maxlength="10" value="<?php if($this->input->get('seq')) echo $sel_mem->join_date; ?>" onClick="cal_add(this); event.cancelBubble=true" required>
                  </div>
								</div>
								<div class="col-xs-2 glyphicon-wrap" style="padding-top: 11px;">
									<a href="javascript:" onclick="cal_add(document.getElementById('join_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
								</div>
							</div>
						</div>
<?php  if($this->input->get('seq')) : ?>
						<div class="row checkbox" style="padding: 10px; color: #C3BFBF;">
							<label><input type="checkbox" name="is_reti" value="1" onclick="if(this.checked==0) document.getElementById('reti').style.display='none'; else document.getElementById('reti').style.display=''; "> &nbsp;퇴사등록</label>
						</div>

						<div class="row bo-top bo-bottom" id="reti" style="display: none;">

							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="reti_date">퇴 사 일 <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<div class="col-xs-10" style="padding: 0;">
                  <div>
                    <input type="text" class="form-control input-sm wid-100" id="reti_date" name="reti_date" maxlength="10" value="<?php if($this->input->get('seq')) echo $sel_mem->reti_date; ?>" onClick="cal_add(this); event.cancelBubble=true" maxlength="10" required>
                  </div>
								</div>
								<div class="col-xs-2 glyphicon-wrap" style="padding-top: 11px;">
									<a href="javascript:" onclick="cal_add(document.getElementById('reti_date'),this); event.cancelBubble=true"><span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span></a>
								</div>
							</div>
						</div>
<?php endif; ?>

						</div>
					</fieldset>
				</form>

				<div class="row" style="margin: 0 15px;">
					<div class="col-md-12" style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
<?
	if($auth12<2) :
		$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
		$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
	else :
		$submit_str="div_mem_submit('".$this->input->get('mode')."');";
		$del_str="form1_seq_del(".$this->input->get('seq').");";
	endif;
?>
						<div class="col-xs-8">
							<button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>"><?php if($this->input->get('mode')=='modify') echo '수정하기'; else echo '등록하기'; ?></button>
							<button class="btn btn-info btn-sm" onclick="location.href='?ss_di=1' ">목록으로</button>
						</div>
						<div class="col-xs-4" style="text-align: right;">
<?php if($this->input->get('seq')) : ?>
							<button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">삭제하기</button>
<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
<?php endif; ?>
<?php endif ?>
