			<div class="main_start"></div>
<?php
	$attributes = array('name' => 'inout_frm', 'method' => 'post');
	echo form_open('/m4/capital/1/3/', $attributes);
?>
				<label class="sr-only"><input type="hidden" name="cont_1_h" value=""></label> <!-- 수수료 발생 시 - 적요_1 -->
				<label class="sr-only"><input type="hidden" name="cont_2_h" value=""></label> <!-- 수수료 발생 시 - 적요_2 -->
				<label class="sr-only"><input type="hidden" name="cont_3_h" value=""></label> <!-- 수수료 발생 시 - 적요_3 -->
				<label class="sr-only"><input type="hidden" name="cont_4_h" value=""></label> <!-- 수수료 발생 시 - 적요_4 -->
				<label class="sr-only"><input type="hidden" name="cont_5_h" value=""></label> <!-- 수수료 발생 시 - 적요_5 -->
				<label class="sr-only"><input type="hidden" name="cont_6_h" value=""></label> <!-- 수수료 발생 시 - 적요_6 -->
				<label class="sr-only"><input type="hidden" name="cont_7_h" value=""></label> <!-- 수수료 발생 시 - 적요_7 -->
				<label class="sr-only"><input type="hidden" name="cont_8_h" value=""></label> <!-- 수수료 발생 시 - 적요_8 -->
				<label class="sr-only"><input type="hidden" name="cont_9_h" value=""></label> <!-- 수수료 발생 시 - 적요_9 -->
				<label class="sr-only"><input type="hidden" name="cont_10_h" value=""></label> <!-- 수수료 발생 시 - 적요_10 -->

				<div class="row" style="margin: 0 0 20px 0; border-width: 0 0 1px 0; border-style: solid; border-color: #cccccc;">
					<div class="col-xs-3 col-md-2 center" style="background-color: #F4F4F4; height: 40px; padding: 10px; 0">거래일자</div>
					<div class="col-xs-4 col-md-6" style="height: 40px; padding-top: 5px;">
						<div class="col-xs-10 col-md-3" style="padding: 0px;">
							<label for="deal_date" class="sr-only">시작일</label>
							<input type="text" class="form-control input-sm wid-95" id="deal_date" name="deal_date" maxlength="10" value="<?php echo date('Y-m-d')?>" readonly onClick="cal_add(this); event.cancelBubble=true">
						</div>
						<div class="col-xs-2 col-md-1 glyphicon-wrap" style="padding: 6px 0;">
							<a href="javascript:" onclick="cal_add(document.getElementById('deal_date'),this); event.cancelBubble=true">
								<span class="glyphicon glyphicon-calendar" aria-hidden="true" id="glyphicon"></span>
							</a>
						</div>
					</div>
					<div class="col-xs-2 col-md-2 center" style="background-color: #F4F4F4; height: 40px; padding: 10px;">담당자</div>
					<div class="col-xs-3 col-md-2" style="height: 40px; padding-top: 10px;"><?php  echo $this->session->userdata['name']; ?></div>
				</div>
<?php echo validation_errors(); ?>

				<div class="row table-responsive" style="margin: 0;">
					<table class="table table-condensed table-hover font12" style="border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;">
						<thead>
							<tr style="background-color: #EAEAEA;">
								<th style="20px" class="center"><input type="checkbox" disabled></td>
								<th style="120px" class="center">구 분 <font color="red">*</font></td>
								<th style="55px" class="center">현 장 <font color="red">*</font></td>
								<th style="55px" class="center">조합대여</td>
								<th style="75px" class="center">계정과목 <font color="red">*</font> <a href="javascript:" onclick="popUp_size('/pc/_menu3/account_m.php','account',700,800)" title="계정과목 관리"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></td>
								<th style="120px" class="center">적 요 <font color="red">*</font></td>
								<th style="70px" class="center">거 래 처</td>
								<th style="60px" class="center">입금처 <font color="red">*</font> <a href="javascript:" onclick="popUp('/pc/_menu3/acc_list.php?fn=1&amp;frm=out_stock_frm','bank_acc')" title="은행계좌 관리"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></td>
								<th style="50px" class="center">입금금액 <font color="red">*</font></td>
								<th style="60px" class="center">출금처 <font color="red">*</font> <a href="javascript:" onclick="popUp('/pc/_menu3/acc_list.php?fn=1&amp;frm=out_stock_frm','bank_acc')" title="은행계좌 관리"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></a></td>
								<th style="50px" class="center">출금금액 <font color="red">*</font></td>
								<th style="110px" class="center">이체수수료 <font color="red">*</font></td>
								<th style="70px" class="center">증빙서류 <font color="red">*</font></td>
							</tr>
						</thead>
						<tbody>


							<!-- ------------------------------------1col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _1 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_1"  id="class1_1" style="width:52px;" onChange="inoutSel(this.form, 1)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_1" id="class2_1" style="width:52px;" onChange="inoutSel2(this.form, 1)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _1 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_1" id="pj_seq_1" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _1 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_1" id="jh_loan_1" onClick="jh_chk(1);" disabled></td>
								<!-- 회계계정 _1 -->
								<td class="center" id="d1_1_1" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_1" id="d1_acc1_1" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_1" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_1" id="d1_acc2_1" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_1" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_1" id="d1_acc3_1" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_1" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_1" id="d1_acc4_1" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_1" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_1" id="d1_acc5_1" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _1 -->
								<td class="center"><input type="text" name="cont_1" size="20"></td>
								<!-- 거 래 처 _1 -->
								<td class="center"><input type="text" name="acc_1" size="10"></td>
								<!-- 입금처 _1 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_1" id="in_1" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _1 -->
								<td class="center"><input type="text" name="inc_1" id="inc_1" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_1,this,document.inout_frm.exp_1)"></td>
								<!--출금처 _1 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_1" id="out_1" style="width:55px;" onChange="charge(1,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _1 -->
								<td class="center"><input type="text" name="exp_1" id="exp_1" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _1 -->
								<td class="center"><input type="checkbox" name="char1_1" onclick="char2_chk(document.inout_frm.char2_1,1);" disabled> 금액 : <input type="text" name="char2_1" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _1 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_1" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------1col------------------------------------------ -->
							<!-- ------------------------------------2col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _2 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_2"  id="class1_2" style="width:52px;" onChange="inoutSel(this.form, 2)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_2" id="class2_2" style="width:52px;" onChange="inoutSel2(this.form, 2)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _2 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_2" id="pj_seq_2" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _2 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_2" id="jh_loan_2" onClick="jh_chk(2);" disabled></td>
								<!-- 회계계정 _2 -->
								<td class="center" id="d1_1_2" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_2" id="d1_acc1_2" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_2" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_2" id="d1_acc2_2" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_2" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_2" id="d1_acc3_2" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_2" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_2" id="d1_acc4_2" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_2" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_2" id="d1_acc5_2" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _2 -->
								<td class="center"><input type="text" name="cont_2" size="20"></td>
								<!-- 거 래 처 _2 -->
								<td class="center"><input type="text" name="acc_2" size="10"></td>
								<!-- 입금처 _2 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_2" id="in_2" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _2 -->
								<td class="center"><input type="text" name="inc_2" id="inc_2" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_2,this,document.inout_frm.exp_2)"></td>
								<!--출금처 _2 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_2" id="out_2" style="width:55px;" onChange="charge(2,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _2 -->
								<td class="center"><input type="text" name="exp_2" id="exp_2" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _2 -->
								<td class="center"><input type="checkbox" name="char1_2" onclick="char2_chk(document.inout_frm.char2_2,2);" disabled> 금액 : <input type="text" name="char2_2" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _2 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_2" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------2col------------------------------------------ -->
							<!-- ------------------------------------3col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _3 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_3"  id="class1_3" style="width:52px;" onChange="inoutSel(this.form, 3)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_3" id="class2_3" style="width:52px;" onChange="inoutSel2(this.form, 3)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _3 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_3" id="pj_seq_3" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _3 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_3" id="jh_loan_3" onClick="jh_chk(3);" disabled></td>
								<!-- 회계계정 _3 -->
								<td class="center" id="d1_1_3" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_3" id="d1_acc1_3" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_3" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_3" id="d1_acc2_3" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_3" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_3" id="d1_acc3_3" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_3" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_3" id="d1_acc4_3" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_3" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_3" id="d1_acc5_3" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _3 -->
								<td class="center"><input type="text" name="cont_3" size="20"></td>
								<!-- 거 래 처 _3 -->
								<td class="center"><input type="text" name="acc_3" size="10"></td>
								<!-- 입금처 _3 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_3" id="in_3" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _3 -->
								<td class="center"><input type="text" name="inc_3" id="inc_3" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_3,this,document.inout_frm.exp_3)"></td>
								<!--출금처 _3 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_3" id="out_3" style="width:55px;" onChange="charge(3,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _3 -->
								<td class="center"><input type="text" name="exp_3" id="exp_3" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _3 -->
								<td class="center"><input type="checkbox" name="char1_3" onclick="char2_chk(document.inout_frm.char2_3,3);" disabled> 금액 : <input type="text" name="char2_3" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _3 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_3" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------3col------------------------------------------ -->
							<!-- ------------------------------------4col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _4 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_4"  id="class1_4" style="width:52px;" onChange="inoutSel(this.form, 4)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_4" id="class2_4" style="width:52px;" onChange="inoutSel2(this.form, 4)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _4 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_4" id="pj_seq_4" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _4 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_4" id="jh_loan_4" onClick="jh_chk(4);" disabled></td>
								<!-- 회계계정 _4 -->
								<td class="center" id="d1_1_4" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_4" id="d1_acc1_4" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_4" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_4" id="d1_acc2_4" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_4" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_4" id="d1_acc3_4" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_4" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_4" id="d1_acc4_4" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_4" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_4" id="d1_acc5_4" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _4 -->
								<td class="center"><input type="text" name="cont_4" size="20"></td>
								<!-- 거 래 처 _4 -->
								<td class="center"><input type="text" name="acc_4" size="10"></td>
								<!-- 입금처 _4 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_4" id="in_4" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _4 -->
								<td class="center"><input type="text" name="inc_4" id="inc_4" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_4,this,document.inout_frm.exp_4)"></td>
								<!--출금처 _4 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_4" id="out_4" style="width:55px;" onChange="charge(4,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _4 -->
								<td class="center"><input type="text" name="exp_4" id="exp_4" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _4 -->
								<td class="center"><input type="checkbox" name="char1_4" onclick="char2_chk(document.inout_frm.char2_4,4);" disabled> 금액 : <input type="text" name="char2_4" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _4 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_4" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------4col------------------------------------------ -->
							<!-- ------------------------------------5col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _1 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_5"  id="class1_5" style="width:52px;" onChange="inoutSel(this.form, 5)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_5" id="class2_5" style="width:52px;" onChange="inoutSel2(this.form, 5)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _5 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_5" id="pj_seq_5" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _5 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_5" id="jh_loan_5" onClick="jh_chk(5);" disabled></td>
								<!-- 회계계정 _5 -->
								<td class="center" id="d1_1_5" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_5" id="d1_acc1_5" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_5" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_5" id="d1_acc2_5" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_5" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_5" id="d1_acc3_5" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_5" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_5" id="d1_acc4_5" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_5" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_5" id="d1_acc5_5" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _5 -->
								<td class="center"><input type="text" name="cont_5" size="20"></td>
								<!-- 거 래 처 _5 -->
								<td class="center"><input type="text" name="acc_5" size="10"></td>
								<!-- 입금처 _5 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_5" id="in_5" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _5 -->
								<td class="center"><input type="text" name="inc_5" id="inc_5" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_5,this,document.inout_frm.exp_5)"></td>
								<!--출금처 _5 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_5" id="out_5" style="width:55px;" onChange="charge(5,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _5 -->
								<td class="center"><input type="text" name="exp_5" id="exp_5" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _5 -->
								<td class="center"><input type="checkbox" name="char1_5" onclick="char2_chk(document.inout_frm.char2_5,5);" disabled> 금액 : <input type="text" name="char2_5" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _5 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_5" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------5col------------------------------------------ -->
							<!-- ------------------------------------6col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _6 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_6"  id="class1_6" style="width:52px;" onChange="inoutSel(this.form, 6)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_6" id="class2_6" style="width:52px;" onChange="inoutSel2(this.form, 6)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _6 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_6" id="pj_seq_6" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _6 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_6" id="jh_loan_6" onClick="jh_chk(6);" disabled></td>
								<!-- 회계계정 _6 -->
								<td class="center" id="d1_1_6" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_6" id="d1_acc1_6" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_6" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_6" id="d1_acc2_6" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_6" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_6" id="d1_acc3_6" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_6" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_6" id="d1_acc4_6" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_6" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_6" id="d1_acc5_6" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _6 -->
								<td class="center"><input type="text" name="cont_6" size="20"></td>
								<!-- 거 래 처 _6 -->
								<td class="center"><input type="text" name="acc_6" size="10"></td>
								<!-- 입금처 _6 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_6" id="in_6" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _6 -->
								<td class="center"><input type="text" name="inc_6" id="inc_6" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_6,this,document.inout_frm.exp_6)"></td>
								<!--출금처 _6 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_6" id="out_6" style="width:55px;" onChange="charge(6,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _6 -->
								<td class="center"><input type="text" name="exp_6" id="exp_6" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _6 -->
								<td class="center"><input type="checkbox" name="char1_6" onclick="char2_chk(document.inout_frm.char2_6,6);" disabled> 금액 : <input type="text" name="char2_6" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _6 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_6" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------6col------------------------------------------ -->
							<!-- ------------------------------------7col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _7 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_7"  id="class1_7" style="width:52px;" onChange="inoutSel(this.form, 7)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_7" id="class2_7" style="width:52px;" onChange="inoutSel2(this.form, 7)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _7 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_7" id="pj_seq_7" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _7 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_7" id="jh_loan_7" onClick="jh_chk(7);" disabled></td>
								<!-- 회계계정 _7 -->
								<td class="center" id="d1_1_7" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_7" id="d1_acc1_7" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_7" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_7" id="d1_acc2_7" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_7" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_7" id="d1_acc3_7" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_7" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_7" id="d1_acc4_7" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_7" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_7" id="d1_acc5_7" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _7 -->
								<td class="center"><input type="text" name="cont_7" size="20"></td>
								<!-- 거 래 처 _7 -->
								<td class="center"><input type="text" name="acc_7" size="10"></td>
								<!-- 입금처 _7 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_7" id="in_7" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _7 -->
								<td class="center"><input type="text" name="inc_7" id="inc_7" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_7,this,document.inout_frm.exp_7)"></td>
								<!--출금처 _7 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_7" id="out_7" style="width:55px;" onChange="charge(7,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _7 -->
								<td class="center"><input type="text" name="exp_7" id="exp_7" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _7 -->
								<td class="center"><input type="checkbox" name="char1_7" onclick="char2_chk(document.inout_frm.char2_7,7);" disabled> 금액 : <input type="text" name="char2_7" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _7 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_7" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------7col------------------------------------------ -->
							<!-- ------------------------------------8col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _8 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_8"  id="class1_8" style="width:52px;" onChange="inoutSel(this.form, 8)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_8" id="class2_8" style="width:52px;" onChange="inoutSel2(this.form, 8)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _8 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_8" id="pj_seq_8" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _8 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_8" id="jh_loan_8" onClick="jh_chk(8);" disabled></td>
								<!-- 회계계정 _8 -->
								<td class="center" id="d1_1_8" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_8" id="d1_acc1_8" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_8" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_8" id="d1_acc2_8" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_8" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_8" id="d1_acc3_8" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_8" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_8" id="d1_acc4_8" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_8" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_8" id="d1_acc5_8" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _8 -->
								<td class="center"><input type="text" name="cont_8" size="20"></td>
								<!-- 거 래 처 _8 -->
								<td class="center"><input type="text" name="acc_8" size="10"></td>
								<!-- 입금처 _8 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_8" id="in_8" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _8 -->
								<td class="center"><input type="text" name="inc_8" id="inc_8" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_8,this,document.inout_frm.exp_8)"></td>
								<!--출금처 _8 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_8" id="out_8" style="width:55px;" onChange="charge(8,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _8 -->
								<td class="center"><input type="text" name="exp_8" id="exp_8" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _8 -->
								<td class="center"><input type="checkbox" name="char1_8" onclick="char2_chk(document.inout_frm.char2_8,8);" disabled> 금액 : <input type="text" name="char2_8" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _8 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_8" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------8col------------------------------------------ -->
							<!-- ------------------------------------9col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _9 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_9"  id="class1_9" style="width:52px;" onChange="inoutSel(this.form, 9)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_9" id="class2_9" style="width:52px;" onChange="inoutSel2(this.form, 9)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _9 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_9" id="pj_seq_9" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _9 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_9" id="jh_loan_9" onClick="jh_chk(9);" disabled></td>
								<!-- 회계계정 _9 -->
								<td class="center" id="d1_1_9" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_9" id="d1_acc1_9" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_9" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_9" id="d1_acc2_9" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_9" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_9" id="d1_acc3_9" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_9" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_9" id="d1_acc4_9" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_9" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_9" id="d1_acc5_9" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _9 -->
								<td class="center"><input type="text" name="cont_9" size="20"></td>
								<!-- 거 래 처 _9 -->
								<td class="center"><input type="text" name="acc_9" size="10"></td>
								<!-- 입금처 _9 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_9" id="in_9" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _9 -->
								<td class="center"><input type="text" name="inc_9" id="inc_9" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_9,this,document.inout_frm.exp_9)"></td>
								<!--출금처 _9 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_9" id="out_9" style="width:55px;" onChange="charge(9,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _9 -->
								<td class="center"><input type="text" name="exp_9" id="exp_9" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _9 -->
								<td class="center"><input type="checkbox" name="char1_9" onclick="char2_chk(document.inout_frm.char2_9,9);" disabled> 금액 : <input type="text" name="char2_9" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _9 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_9" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------9col------------------------------------------ -->
							<!-- ------------------------------------10col------------------------------------------ -->
							<tr>
								<td class="center"><input type="checkbox" disabled></td>
								<!-- 구분 _10 -->
								<td class="center" style="padding-top: 7px;">
									<select name="class1_10"  id="class1_10" style="width:52px;" onChange="inoutSel(this.form, 10)">
										<option value="" selected> 선 택
										<option value="1"> 입 금
										<option value="2"> 출 금
										<option value="3"> 대 체
									</select>
									<select name="class2_10" id="class2_10" style="width:52px;" onChange="inoutSel2(this.form, 10)" disabled>
										<option value="" selected> 선 택
										<option value="1"> 자 산
										<option value="2"> 부 채
										<option value="3"> 자 본
										<option value="4"> 수 익
										<option value="5"> 비 용
										<option value="6"> 본 사
										<option value="7"> 현 장
									</select>
								</td>
								<!-- 현장코드 _10 -->
								<td class="center" style="padding-top: 7px;">
									<select name="pj_seq_10" id="pj_seq_10" style="width:60px;" disabled>
										<option value="0" selected> 선 택</option>
<?php foreach($pj_dt as $lt) : ?>
										<option value="<?php echo $lt->seq; ?>"> <?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 조합 대여금여부 _10 -->
								<td class="center" style="padding-top: 7px;">조합 : <input type="checkbox" value="1" name="jh_loan_10" id="jh_loan_10" onClick="jh_chk(10);" disabled></td>
								<!-- 회계계정 _10 -->
								<td class="center" id="d1_1_10" style="padding-top: 7px;"> <!-- 자산 계정 -->
									<select name="account_10" id="d1_acc1_10" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d11 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_2_10" style="display: none; padding-top: 7px;"> <!-- 부채 계정 -->
									<select name="account_10" id="d1_acc2_10" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d12 as $lt) : ?>
										<option value="<?php echo $lt->d3_acc_name; ?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<td class="center" id="d1_3_10" style="display:none; padding-top: 7px;"> <!-- 자본 계정 -->
									<select name="account_10" id="d1_acc3_10" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d13 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_4_10" style="display:none; padding-top: 7px;"> <!-- 수익 계정 -->
									<select name="account_10" id="d1_acc4_10" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d14 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<td class="center" id="d1_5_10" style="display:none; padding-top: 7px;"> <!-- 비용 계정 -->
									<select name="account_10" id="d1_acc5_10" style="width:60px;" disabled>
										<option value="0" selected>선 택</option>
<?php foreach($d3_d15 as $lt) :?>
										<option value="<?php echo $lt->d3_acc_name;?>"> <?php echo $lt->d3_acc_name."(".$lt->d3_code.")"; ?></option>
<?php endforeach;?>
									</select>
								</td>
								<!-- 적 요 _10 -->
								<td class="center"><input type="text" name="cont_10" size="20"></td>
								<!-- 거 래 처 _10 -->
								<td class="center"><input type="text" name="acc_10" size="10"></td>
								<!-- 입금처 _10 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="in_10" id="in_10" style="width:55px;" disabled>
										<option value="" selected> 선 택</option>
<?php foreach($in_out as $lt) : ?>
										<option value="<?php echo $lt->no; ?>"> <?php echo $lt->name; ?></option>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 입금금액 _10 -->
								<td class="center"><input type="text" name="inc_10" id="inc_10" size="10" onkeyPress ='iNum(this)' onChange="transfer(document.inout_frm.class1_10,this,document.inout_frm.exp_10)"></td>
								<!--출금처 _10 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="out_10" id="out_10" style="width:55px;" onChange="charge(10,this.value);" disabled>
										<option value="1-1" selected> 선 택
<?php foreach ($in_out as $lt) : ?>
										<option value="<?php echo $lt->no."-".$lt->bank; ?>"> <?php echo $lt->name; ?>
<?php endforeach; ?>
									</select>
								</td>
								<!-- 출금금액 _10 -->
								<td class="center"><input type="text" name="exp_10" id="exp_10" size="10" onkeyPress ='iNum(this)'></td>
								<!-- 수수료 _10 -->
								<td class="center"><input type="checkbox" name="char1_10" onclick="char2_chk(document.inout_frm.char2_10,10);" disabled> 금액 : <input type="text" name="char2_10" size="3" onkeyPress ='iNum(this)' disabled></td>
								<!-- 증빙서류 _10 -->
								<td class="center" style=" padding-top: 7px;">
									<select name="evi_10" style="width:75px">
										<option value="1" selected> 증빙 없음
										<option value="2"> 세금계산서
										<option value="3"> 계산서(면세)
										<option value="4"> 신용(체크)카드전표
										<option value="5"> 현금영수증
										<option value="6"> 간이영수증
									</select>
								</td>
							</tr>
							<!-- ------------------------------------10col------------------------------------------ -->
						</tbody>
					</table>
				</div>
			</form>
			<div class="row" style="margin: 0 0 92px 0;">
<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="inout_frm_chk('com');";} ?>
				<div class="form-group btn-wrap" style="margin: 0;">
					<input type="button" class="btn btn-primary btn-sm" onclick="<?php echo $submit_str; ?>" value="거래등록">
				</div>
			</div>
