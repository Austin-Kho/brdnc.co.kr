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
<?php
	$attributes = array('name' => 'cash_book_frm', 'method' => 'get');
	echo form_open('/m4/capital/1/2/', $attributes);
?>
							<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding: 10px 0;">구 분</div>
							<div class="col-md-1" style="height: 40px; padding: 5px;">
								<label for="class1" class="sr-only">구분1</label>
								<select class="form-control input-sm wid-100" name="class1" onChange="inoutSel(this.form);">
									<option value="0">선 택</option>
									<option value="1" <?php if($this->input->get('class1')==1) echo 'selected'; ?>>입 금</option>
									<option value="2" <?php if($this->input->get('class1')==2) echo 'selected'; ?>>출 금</option>
									<option value="3" <?php if($this->input->get('class1')==3) echo 'selected'; ?>>대 체</option>
								</select>
							</div>
							<div class="col-md-1" style="height: 40px; padding: 5px;">
								<label for="class2" class="sr-only">구분2</label>
								<select class="form-control input-sm wid-100" name="class2" onchange = "inoutSel2(this.form)" <?if(!$this->input->get('class1')&&!$this->input->get('class2')) echo "disabled";?>>
<?php if( !$this->input->get('class1') or !$this->input->get('class2')) : ?>
									<option value="0"> 선 택</option>
<?php elseif($this->input->get('class1')==1) : ?>
									<option value="0"> 선 택</option>
									<option value="1" <?if($this->input->get('class2')==1) echo "selected";?>> 자 산</option>
									<option value="2" <?if($this->input->get('class2')==2) echo "selected";?>> 부 채</option>
									<option value="3" <?if($this->input->get('class2')==3) echo "selected";?>> 자 본</option>
									<option value="4" <?if($this->input->get('class2')==4) echo "selected";?>> 수 익</option>
<?php elseif($this->input->get('class1')==2) : ?>
									<option value="0"> 선 택</option>
									<option value="1" <?if($this->input->get('class2')==1) echo "selected";?>> 자 산</option>
									<option value="2" <?if($this->input->get('class2')==2) echo "selected";?>> 부 채</option>
									<option value="3" <?if($this->input->get('class2')==3) echo "selected";?>> 자 본</option>
									<option value="5" <?if($this->input->get('class2')==5) echo "selected";?>> 비 용</option>
<?php elseif($this->input->get('class1')==3) : ?>
									<option value="0"> 선 택</option>
									<option value="6" <?if($this->input->get('class2')==6) echo "selected";?>> 본 사</option>
									<option value="7" <?if($this->input->get('class2')==7) echo "selected";?>> 현 장</option>
<?php endif;?>
								</select>
							</div>
							<div class="col-md-1 center" style="background-color: #F4F4F4; height: 40px; padding: 10px 0;">거래기간</div>
							<div class="col-md-3" style="height: 40px; padding: 5px;">
								<div class="col-xs-5" style="padding: 0px;">
									<label for="s_date" class="sr-only">시작일</label>
									<input type="text" class="form-control input-sm wid-95" id="s_date" name="s_date" maxlength="10" value="<?php if($this->input->get('s_date')) echo $this->input->get('s_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="시작일">
								</div>
								<div class="col-xs-1 glyphicon-wrap" style="padding: 6px 0;">
									<a href="javascript:" onclick="cal_add(document.getElementById('s_date'),this); event.cancelBubble=true">
										<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
									</a>
								</div>
								<div class="col-xs-5" style="padding: 0px;">
									<label for="e_date" class="sr-only">종료일</label>
									<input type="text" class="form-control input-sm wid-95" id="e_date" name="e_date" maxlength="10" value="<?php if($this->input->get('e_date')) echo $this->input->get('e_date'); ?>" readonly onClick="cal_add(this); event.cancelBubble=true" placeholder="종료일">
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
								<label for="search_con" class="sr-only">검색조건</label>
								<select class="form-control input-sm" name="search_con">
									<option value="0">통합검색</option>
									<option value="1" <?php if($this->input->get('search_con')==1) echo 'selected'; ?>>계정과목</option>
									<option value="2" <?php if($this->input->get('search_con')==2) echo 'selected'; ?>>적 요</option>
									<option value="3" <?php if($this->input->get('search_con')==3) echo 'selected'; ?>>거래처</option>
									<option value="4" <?php if($this->input->get('search_con')==4) echo 'selected'; ?>>입출금처</option>
								</select>
							</div>
							<div class="col-md-1" style="height: 40px; padding: 5px 0 0 5px;">
								<label for="search_text" class="sr-only">검색어</label>
								<input type="text" name="search_text" value="<?php if($this->input->get('search_text')) echo $this->input->get('search_text'); ?>" class="form-control input-sm" placeholder="검색어">
							</div>
							<div class="col-md-1 center" style="height: 40px; padding: 3px;">
								<input type="button" value="검 색" class="btn btn-info btn-sm" onclick="submit();">
							</div>
						</form>
					</div>
					<div class="row table-responsive" style="margin: 0;">
						<table class="table table-bordered table-hover table-condensed font12">
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

<?php if($auth>0) :  ?><!-- //관리자와 자금담당에게만 출력 -->
									<th style="width: 35px;" class="center">수정</th>
									<th style="width: 35px;" class="center">삭제</th>
<?php endif; ?>
								</tr>
							</thead>
							<tbody>
<?php foreach($cb_list as $lt) : ?>
<?php if($lt->class1==1) $cla1 = "<font color='#0066ff'>[입금]</font>"; ?>
<?php if($lt->class1==2) $cla1 = "<font color='#ff3333'>[출금]</font>"; ?>
<?php if($lt->class1==3) $cla1 = "<font color='#669900'>[대체]</font>"; ?>

<?php if($lt->class2==1) $cla2 = "<font color='#0066ff'>[자산]</font>"; ?>
<?php if($lt->class2==2) $cla2 = "<font color='#6600ff'>[부채]</font>"; ?>
<?php if($lt->class2==3) $cla2 = "<font color='#0066ff'>[자본]</font>"; ?>
<?php if($lt->class2==4) $cla2 = "<font color='#0066ff'>[수익]</font>"; ?>
<?php if($lt->class2==5) $cla2 = "<font color='#ff3333'>[비용]</font>"; ?>
<?php if($lt->class2==6) $cla2 = "<font color='#669900'>[본사]</font>"; ?>
<?php if($lt->class2==7) $cla2 = "<font color='#009900'>[현장]</font>"; ?>
<?php	if($lt->account==""){ $account = "-"; }else{ $account = "[".$lt->account."]"; } //계정과목 ?>

<?php if($lt->inc==0) $inc = '-'; else $inc = number_format($lt->inc); ?>
<?php if($lt->exp==0) $exp = '-'; else $exp = number_format($lt->exp); ?>

<?php	if($lt->acc) {$acc=$lt->acc;}else{$acc="-";} // 거래처정보가 없을 때 ?>
<?php

	// 대체거래일 때
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($lt->inc==0||($lt->class1==3&&$lt->out_acc==$lt->no)){ // (수입금이 '0' 이거나 대체거래이고, 출금계정이 은행등록계좌와 같으면,
	      $inc="-";
	}else{
	      $inc=number_format($lt->inc); // 수입금
	}
	if($lt->exp==0||($lt->class1==3&&$lt->in_acc==$lt->no)){ // 지출금이 '0' 이거나 대체거래이고 입금계정이 은행등록계좌와 같으면,
	      $exp="-";
	}else{
	      $exp=number_format($lt->exp); // 지출금
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	// 대체거래일 때
	 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 if($lt->in_acc==0||($lt->class1==3&&$lt->out_acc==$lt->no)){ // 입금계정정보가 없거나 대체거래이고 출금계정이 은행등록계좌와 같으면,
		 $in_acc="";
	 }else{
		 $in_acc=$lt->name;  // 입금계정은 계좌별칭
	 }
	 if($lt->out_acc==0||($lt->class1==3&&$lt->in_acc==$lt->no)){ // 출금계정정보가 없거나 대체거래이고 입금계정이 은행등록계좌와 같으면,
		 $out_acc="";
	 }else{
		 $out_acc=$lt->name; // 출금계정은 계좌별칭
	 }
	 ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($lt->evidence==1) $evi="증빙 없음";
 	if($lt->evidence==2) $evi="세금계산서";
 	if($lt->evidence==3) $evi="계산서";
 	if($lt->evidence==4) $evi="카드전표";
 	if($lt->evidence==5) $evi="현금영수증";
 	if($lt->evidence==6) $evi="간이영수증";
?>
								<tr>
									<td class="center"><input type="checkbox" disabled></td>
									<td class="center" ><?php echo $lt->deal_date; ?></td>
									<td class="center"> <?php echo $cla1." - ".$cla2; ?></td>
									<td class="center" style="color: #000099;"> <?php echo $account; ?></td>
									<td class=""> <?php echo cut_string($lt->cont, 20, '..'); ?></td>
									<td class=""><?php echo cut_string($acc, 8, '..'); ?> </td>
									<td class="center" style="background-color: #D0FCCA;"><?php echo $in_acc; ?> </td>
									<td class="right" style="background-color: #D0FCCA;"> <?php echo $inc; ?></td>
									<td class="center" style="background-color: #DEEAFE;"> <?php echo $out_acc; ?></td>
									<td class="right" style="background-color: #DEEAFE;"><?php echo $exp; ?> </td>
									<td class="center"> <?php echo $evi; ?></td>
<?php if($auth>0) :  ?><!-- //관리자와 자금담당에게만 출력 -->
									<td class="center"><a href="#" class="btn btn-info btn-xs">수정</a> </td>
									<td class="center"> <a href="#" class="btn btn-danger btn-xs">삭제</a></td>
<?php endif; ?>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>
<?php  if(empty($cb_list)) : ?>
						<div class="center" style="padding: 100px 0;">등록된 데이터가 없습니다.</div>
<?php endif; ?>
					</div>
					<div class="col-md-12 center" style="margin-top: 0px; padding: 0;">
						<ul class="pagination pagination-sm"><?php echo $pagination; ?></ul>
					</div>
				</div>
				<div class="row" style="margin: 0 15px;">
					<!-- <div class="col-md-12" style="height: 70px; padding: 26px 15px; margin: 18px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #B2BCDE;">
						<div class="col-xs-6"><button class="btn btn-success btn-sm" onclick="<?php echo $submit_str; ?>">신규등록</button></div>
						<div class="col-xs-6" style="text-align: right;"><button class="btn btn-danger btn-sm" onclick="<?php echo $del_str; ?>">선택삭제</button></div>
					</div> -->
				</div>

			</div>
