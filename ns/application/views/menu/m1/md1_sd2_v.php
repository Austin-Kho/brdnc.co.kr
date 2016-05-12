		<div class="main_start">&nbsp;</div>
		<!-- 1. 분양관리 -> 1. 계약 관리 ->2. 계약 등록 -->

		<!-- ===================계약물건 검색 시작================== -->
		<form method="post" name="set1" action="<?php echo current_url(); ?>">
			<div class="row bo-top bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">사업 개시년도</div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="yr" class="sr-only">사업 개시년도</label>
						<select class="form-control input-sm" name="yr" onchange="submit();">
							<option value=""> 전 체</option>
<?php
	$start_year = "2015";
	$year=range($start_year,date('Y'));
	for($i=(count($year)-1); $i>=0; $i--) :
?>
							<option value="<?php echo $year[$i]?>" <?php if($this->input->post('yr')==$year[$i]) echo "selected"; ?>><?php echo $year[$i]."년"?></option>
<?php endfor; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">프로젝트 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="project" class="sr-only">프로젝트 선택</label>
						<select class="form-control input-sm" name="project" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($all_pj as $lt) : ?>
							<option value="<?php echo $lt->seq; ?>" <?php if($this->input->post('project')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">차수 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="diff_no" class="sr-only">차수</label>
						<select class="form-control input-sm" name="diff_no" onchange="submit();">
							<option value=""> 전 체</option>
<?php if($diff_no) : ?>
<?php foreach($diff_no as $lt) : ?>
							<option value="<?php echo $lt->seq; ?>" <?php if($this->input->post('diff_no')==$lt->seq) echo "selected"; ?>><?php echo $lt->pj_name; ?></option>
<?php endforeach; ?>
<?php else : ?>
							<option value="1" <?php if($this->input->post('diff_no')==1) echo "selected"; ?>>1차</option>
<?php endif; ?>
						</select>
					</div>
				</div>
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">거래 구분 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-6" style="padding: 4px 15px;">

					<div class="col-xs-4 col-sm-3 col-md-2 radio" style="margin: 5px 0 0;">
						<label><input type="radio" name="cont_sort1" id="cont_sort1" value="1" <?php if( !$this->input->post('cont_sort1') OR $this->input->post('cont_sort1')=='1') echo "checked";?>  onclick="submit();">계약</label>
					</div>
					<div class="col-xs-4 col-sm-3 col-md-2 radio" style="margin: 5px 0 0;">
						<label><input type="radio" name="cont_sort1" id="cont_sort1" value="2" <?php if($this->input->post('cont_sort1')=='2') echo "checked";?> onclick="submit();">해지</label>
					</div>
<?php if( !$this->input->post('cont_sort1') OR $this->input->post('cont_sort1')=='1') : ?>
					<div class="col-xs-4 col-sm-6 col-md-4" style="padding: 0px;">
						<label for="cont_sort2" class="sr-only">거래구분</label>
						<select class="form-control input-sm" name="cont_sort2" onchange="submit();">
							<option value=""> 전 체</option>
							<option value="1" <?php if($this->input->post('cont_sort2')=="1") echo "selected"; ?>>청약(가계약)</option>
							<option value="2" <?php if($this->input->post('cont_sort2')=="2") echo "selected"; ?>>계약(정계약)</option>
						</select>
					</div>
<?php elseif($this->input->post('cont_sort1')=='2') : ?>
					<div class="col-xs-4 col-sm-6 col-md-4" style="padding: 0px;">
						<label for="cont_sort3" class="sr-only">거래구분</label>
						<select class="form-control input-sm" name="cont_sort3" onchange="submit();">
							<option value=""> 전 체</option>
							<option value="3" <?php if($this->input->post('cont_sort3')=="3") echo "selected"; ?>>청약해지</option>
							<option value="4" <?php if($this->input->post('cont_sort3')=="4") echo "selected"; ?>>계약해지</option>
						</select>
					</div>
<?php endif; ?>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0 0 15px;">

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">타입 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<select class="form-control input-sm" name="type" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($type as $lt) : ?>
							<option value="<?php echo $lt->type; ?>" <?php if($lt->type==$this->input->post('type')) echo "selected"; ?>><?php echo $lt->type; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">동 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dong" class="sr-only">동</label>
						<select class="form-control input-sm" name="dong" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($dong as $lt) : ?>
							<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->post('dong')) echo "selected"; ?>><?php echo $lt->dong; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">호수 선택 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="ho" class="sr-only">호수</label>
						<select class="form-control input-sm" name="ho" onchange="submit();" <?php if( !$this->input->post('dong')) echo "disabled"; ?>>
							<option value=""> 전 체</option>
<?php foreach($ho as $lt) : ?>
							<option value="<?php echo $lt->ho; ?>" <?php if($lt->ho==$this->input->post('ho')) echo "selected"; ?>><?php echo $lt->ho; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="row bo-top bo-bottom font12" style="margin: 0 0 15px;">
				<div class="col-xs-12 font14 bold" style="padding: 10px 50px; background-color: #F5F2C5; color: #0A0E80"> <?php echo $dong_ho; ?>&nbsp;</div>
			</div>
		</form>
		<!-- ===================계약물건 검색 종료================== -->

		<!-- ===================계약내용 기록 시작================== -->
		<form method="post" name="form1" action="<?php echo current_url(); ?>">
			<input type="hidden" name="pj_seq" value="<?//=$pj_list?>">
			<input type="hidden" name="data_cr" value="<?//=$data_cr?>">
			<input type="hidden" name="cont_sort1" value="<?//=$cont_sort1?>"><!-- 계약(1) 해지(2) 여부 -->
			<input type="hidden" name="cont_sort2" value="<?//=$cont_sort2?>"><!-- 청약(1) 계약(2) 여부 -->
			<input type="hidden" name="cont_sort3" value="<?//=$cont_sort3?>"><!-- 청약해지(1) 계약해지(2) 여부 -->
			<input type="hidden" name="type" value="<?//=$type?>">
			<input type="hidden" name="diff_no" value="<?//=$diff_no?>">
			<input type="hidden" name="dong" value="<?//=$dong?>">
			<input type="hidden" name="ho" value="<?//=$ho?>">
			<input type="hidden" name="con_no" value="<?//=$con_no?>">

			<div class="row bo-top bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약 고객명 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<input type="text" class="form-control input-sm" name="name" value="">
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">체결(처리) 일자 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dong" class="sr-only">동</label>
						<select class="form-control input-sm" name="dong" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($dong as $lt) : ?>
							<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->post('dong')) echo "selected"; ?>><?php echo $lt->dong; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">연락처 [1] <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<input type="text" class="form-control input-sm" name="name" value="">
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">연락처 [2] <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dong" class="sr-only">동</label>
						<input type="text" class="form-control input-sm" name="name" value="">
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">주민등록 주소 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-6" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<input type="text" class="form-control input-sm" name="name" value="">
					</div>
				</div>


			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">우편송부 주소  <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-6" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<input type="text" class="form-control input-sm" name="name" value="">
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약 고객명 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<select class="form-control input-sm" name="type" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($type as $lt) : ?>
							<option value="<?php echo $lt->type; ?>" <?php if($lt->type==$this->input->post('type')) echo "selected"; ?>><?php echo $lt->type; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">체결(처리) 일자 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dong" class="sr-only">동</label>
						<select class="form-control input-sm" name="dong" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($dong as $lt) : ?>
							<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->post('dong')) echo "selected"; ?>><?php echo $lt->dong; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약 고객명 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<select class="form-control input-sm" name="type" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($type as $lt) : ?>
							<option value="<?php echo $lt->type; ?>" <?php if($lt->type==$this->input->post('type')) echo "selected"; ?>><?php echo $lt->type; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">체결(처리) 일자 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dong" class="sr-only">동</label>
						<select class="form-control input-sm" name="dong" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($dong as $lt) : ?>
							<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->post('dong')) echo "selected"; ?>><?php echo $lt->dong; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="row bo-bottom font12" style="margin: 0;">
				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">계약 고객명 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="type" class="sr-only">타입</label>
						<select class="form-control input-sm" name="type" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($type as $lt) : ?>
							<option value="<?php echo $lt->type; ?>" <?php if($lt->type==$this->input->post('type')) echo "selected"; ?>><?php echo $lt->type; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-xs-4 col-sm-3 col-md-2 center point-sub" style="padding: 10px; 0">체결(처리) 일자 <span class="red">*</span></div>
				<div class="col-xs-8 col-sm-9 col-md-2" style="padding: 4px 15px;">
					<div class="col-xs-12" style="padding: 0px;">
						<label for="dong" class="sr-only">동</label>
						<select class="form-control input-sm" name="dong" onchange="submit();">
							<option value=""> 전 체</option>
<?php foreach($dong as $lt) : ?>
							<option value="<?php echo $lt->dong; ?>" <?php if($lt->dong==$this->input->post('dong')) echo "selected"; ?>><?php echo $lt->dong; ?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
		</form>

<?php if($auth<2) {$submit_str="alert('등록 권한이 없습니다!')";} else {$submit_str="alert('OK!');";} ?>
		<div class="form-group btn-wrap" style="margin: 30px 0 0 0;">
			<input type="button" class="btn btn-primary btn-sm" onclick="<?=$submit_str?>" value="등록 하기">
		</div>
