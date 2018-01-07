			<div class="main_start">&nbsp;</div>
			<!-- 5. 환경설정 -> 1. 기본정보관리 ->3. 거래처 정보 관리 페이지 -->

<?php if( !$this->input->get('ss_di') or $this->input->get('ss_di')==1) : ?>
			<div class="row">
				<div class="col-md-12" style="<?php if( !$this->agent->is_mobile()) echo 'height: 490px;'; ?>">
					<div class="row bo-top bo-bottom" style="margin: 0 0 20px 0;">
						<!-- <form name="list_frm" method="get" action=""> -->
<?php
	$attributes = array('method' => 'get', 'name' => 'list_frm');
	echo form_open(current_url(), $attributes);
?>
							<div class="point-sub col-md-2" style="height: 40px; padding-top: 10px;">업체구분</div>
							<div class="col-md-7" style="height: 40px; padding-top: 5px;">
								<div class="col-md-3" style="padding: 0;">
									<select class="form-control input-sm" name="acc_sort" onchange="submit();">
										<option value="">전 체</option>
										<option value="1" <?php if($this->input->get('acc_sort')==1) echo 'selected'; ?>>매입거래처</option>
										<option value="2" <?php if($this->input->get('acc_sort')==2) echo 'selected'; ?>>매출거래처</option>
										<option value="3" <?php if($this->input->get('acc_sort')==3) echo 'selected'; ?>>매입매출거래처</option>
									</select>
								</div>
							</div>
							<div class="col-md-2" style="height: 40px; padding-top: 5px;">
								<input type="text" class="form-control input-sm" name="acc_search" placeholder="거래처 검색" value="<?php if($this->input->get('acc_search')) echo $this->input->get('acc_search'); ?>" onkeydown="if(event.keyCode==13)submit();">
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
									<th class="col-md-2 center bo-left">상호(회사명)</th>
									<th class="col-md-1 center bo-left">업체구분</th>
									<th class="col-md-2 center bo-left">전화번호</th>
									<th class="col-md-4 center bo-left">주 소</th>
									<th class="col-md-2 center bo-left">비 고</th>
								</tr>
							</thead>
							<tbody>
<?php foreach($list as $lt) : ?>
<?php if($lt->acc_cla==1) $acc_cla = '매입거래처' ?>
<?php if($lt->acc_cla==2) $acc_cla = '매출거래처' ?>
<?php if($lt->acc_cla==3) $acc_cla = '매입매출거래처' ?>
<?php $tax_addr = explode("-", $lt->tax_addr); ?>
								<tr>
									<td class="center"><input type="checkbox"></td>
									<td class="center bo-left"><a href="javascript:" onclick="location.href='?ss_di=2&amp;mode=modify&amp;seq=<?php echo $lt->seq; ?>'"><?php echo $lt->si_name; ?></a></td>
									<td class="center bo-left"><?php echo $acc_cla; ?></td>
									<td class="bo-left" style="padding-left: 15px;"><?php echo $lt->main_tel; ?></td>
									<td class="bo-left" style="padding-left: 15px;"><?php echo $tax_addr[0]." ".$tax_addr[1]." ".$tax_addr[2]; ?></td>
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
			<div class="row">

<?php
	$attributes = array('name' => 'form1', 'class' => 'form-horizontal');
	echo form_open(current_url(), $attributes);
?>
					<fieldset class="font12">
						<div class="col-md-12">
							<div style="height:20px; margin: 5px 0; background-color: #eee;"></div>
							<div style="height: 36px; padding: 8px 0 0 10px; margin-bottom: 10px;">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: green;"></span>
								<strong>거래처 <?php if($this->input->get('mode')=='reg') echo '신규'; else echo '수정'; ?>등록</strong>
							</div>
							<label for="mode" class="sr-only">모드</label>
							<input type="hidden" name="mode" value="<?php echo $this->input->get('mode'); ?>">
<?php if($this->input->get('seq')) : ?>
						<label for="seq" class="sr-only">키</label>
						<input type="hidden" name="seq" value="<?php echo $sel_acc->seq; ?>">
<?php endif; ?>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="si_name">상호(회사명) <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm han" id="si_name" name="si_name" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->si_name; ?>" required autofocus>
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="acc_cla">거래처구분 <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<select class="form-control input-sm" name="acc_cla">
									<option value="0">전 체</option>
									<option value="1" <?php if($this->input->get('seq')&&$sel_acc->acc_cla =='1') echo 'selected'; ?>>매입거래처</option>
									<option value="2" <?php if($this->input->get('seq')&&$sel_acc->acc_cla =='2') echo 'selected'; ?>>매출거래처</option>
									<option value="3" <?php if($this->input->get('seq')&&$sel_acc->acc_cla =='3') echo 'selected'; ?>>매입매출거래처</option>
								</select>
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="main_tel">대표전화 <span class="red">*</span></label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm han" id="main_tel" name="main_tel" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->main_tel; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="main_fax">대표팩스</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm han" id="main_fax" name="main_fax" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->main_fax; ?>">
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="main_web">홈페이지 주소</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="main_web" name="main_web" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->main_web; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="web_name">웹 사이트명</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="web_name" name="web_name" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->web_name; ?>">
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="res_div">담당 부서</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="res_div" name="res_div" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->res_div; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="res_worker">담당 직원</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="res_worker" name="res_worker" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->res_worker; ?>">
							</div>
						</div>
						<div class="row bo-top bo-bottom">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="res_mobile">모바일폰</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="res_mobile" name="res_mobile" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->res_mobile; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2">
								<label for="res_email">담당 이메일</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm han" id="res_email" name="res_email" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->res_email; ?>">
							</div>
						</div>

						<div class="row" style="padding: 10px; font-weight: bold;">
							<span class="red">*</span> 세금계산서 관련
						</div>

						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="tax_no">사업자등록번호</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="tax_no" name="tax_no" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->tax_no; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="tax_ceo">대표자</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="tax_ceo" name="tax_ceo" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->tax_ceo; ?>">
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-12 col-sm-4 col-md-2 label-wrap2" >
								<label for="zipcode">주 소</label>
							</div>
							<div class=" col-xs-12 col-sm-8 col-md-10 form-wrap2">

								<!-- 다음 우편번호 서비스 - iOS에서는 position:fixed 버그가 있음, 적용하는 사이트에 맞게 position:absolute 등을 이용하여 top,left값 조정 필요 -->
								<div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
									<img src="//t1.daumcdn.net/localimg/localimages/07/postcode/320/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
								</div>
								<!-- 다음 우편번호 서비스 -------------onclick="execDaumPostcode(1)"-----postcode1-----address1_1-----address2_1------------------------>

<?php if($this->input->get('seq')) $tax_addr = explode("-", $sel_acc->tax_addr); ?>
								<div class="col-xs-3 col-sm-5 col-md-1" style="padding: 0;">
									<label for="postcode1" class="sr-only">우편번호</label>
									<input type="text" class="form-control input-sm wid-95" id="postcode1" name="postcode1" maxlength="5" readonly required autofocus value="<?php if($this->input->get('seq')) echo $tax_addr[0]; ?>">
								</div>
								<div class="col-xs-3 col-sm-2 col-md-1" style="padding: 0;">
									<input type="button" class="btn btn-info btn-sm wid-90" value="우편번호" onclick="execDaumPostcode(1)">
								</div>
								<div class="col-xs-12 col-sm-6 col-md-4" style="padding: 0;">
									<label for="address1_1" class="sr-only">회사주소1</label>
									<input type="text" class="form-control input-sm wid-98" id="address1_1" name="address1_1" maxlength="100" readonly required autofocus value="<?php if($this->input->get('seq')) echo $tax_addr[1]; ?>">
								</div>
								<div class="col-xs-12 col-sm-6 col-md-3" style="padding: 0;">
									<label for="address2_1" class="sr-only">회사주소2</label>
									<input type="text" class="form-control input-sm wid-98" id="address2_1" maxlength="100" name="address2_1" value="<?php if($this->input->get('seq')) echo $tax_addr[2]; ?>">
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12 glyphicon-wrap">나머지 주소</div>
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="tax_uptae">업 태</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="tax_uptae" name="tax_uptae" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->tax_uptae; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="tax_jongmok">종 목</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="tax_jongmok" name="tax_jongmok" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->tax_jongmok; ?>">
							</div>
						</div>
						<div class="row bo-top">
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="tax_worker">셰금계산서 담당자</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="tax_worker" name="tax_worker" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->tax_worker; ?>">
							</div>
							<div class=" col-xs-4 col-sm-4 col-md-2 label-wrap2" >
								<label for="tax_email">세금계산서 이메일</label>
							</div>
							<div class=" col-xs-8 col-sm-8 col-md-4 form-wrap2">
								<input type="text" class="form-control input-sm en_only" id="tax_email" name="tax_email" maxlength="30" value="<?php if($this->input->get('seq')) echo $sel_acc->tax_email; ?>">
							</div>
						</div>

						<div class="row bo-top bo-bottom">
							<div class=" col-xs-12 col-sm-12 col-md-2 label-wrap2" style="height: 80px;">
								<label for="note">비 고</label>
							</div>
							<div class=" col-xs-12 col-sm-12 col-md-10 form-wrap2" style="height: 80px;">
								<textarea class="form-control input-sm" id="note" name="note"  rows="3" cols="114"><?php if($this->input->get('seq')) echo $sel_acc->note; ?></textarea>
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
		$submit_str="acc_submit('".$this->input->get('mode')."');";
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
