		<script type="text/javascript">

			function enter_search(form) {// 폼 button에서 엔터키를 눌렀을때 써브밋 해주는 함수
				var keycode = window.event.keyCode;
				if(keycode == 13) $("#addr_put").click();
			}

			function search_con () {
				if(document.getElementById('sw1').checked == true){
					document.getElementById('doro_name').style.display = '';
					document.getElementById('build_name').style.display = 'none';
				}else if(document.getElementById('sw2').checked == true){
					document.getElementById('doro_name').style.display = 'none';
					document.getElementById('build_name').style.display = '';
				}
			}

			function val_put(val) {
				var arr = val.split("|");
				document.getElementById('zipcode').value = arr[0];
				document.getElementById('addr1').value = arr[1];
				document.getElementById('addr3').value = arr[2];
				document.getElementById('addr2').focus();
			}

			function val_put2(zip, adr1, adr2){ // zip = 우편번호, adr = 주소
				var form=opener.document.form1;
				var zip = document.getElementById('zipcode').value;
				var adr1 = document.getElementById('addr1').value;
				var adr2 = document.getElementById('addr2').value+" "+document.getElementById('addr3').value;

				a = eval("form."+"zipcode"); // opener의 우편번호 폼 이름
				b = eval("form."+"address1"); // opener의 기본주소 폼 이름
				c = eval("form."+"address2"); // opener의 나머지주소 폼 이름

				a.value=zip;
				b.value=adr1;
				c.value=adr2;
				c.focus();

				self.close();
			}
		</script>
<?php
	$attributes = array('name' => 'zip_form', 'id' => 'zipsearch', 'class' => 'form-inline', 'method' => 'post');
	echo form_open('/popup/zip_/', $attributes);
?>
			<div class="container">
				<header id="header">
					<h1>주 소 검 색</h1>
				</header><!-- /header -->
				<div class="desc">※ 찾고자 하는 도로명주소 또는 건물명을 선택해 주세요.</div>
				<div class="well">
					<label class="sr-only" for="sw1">도로명주소 검색</label>
					<span>
						<input type="radio" name="sh_what" id="sw1" value="1" onclick="search_con();" <?php if( !$this->input->post('sh_what') or $this->input->post('sh_what') == '1') echo 'checked'; ?>> 도로명주소 검색</input>
					</span>
					<label class="sr-only" for="sw2">건물명 검색</label>
					<span class="ml20">
						<input type="radio" name="sh_what" id="sw2" value="2" onclick="search_con();" <?php if($this->input->post('sh_what') == '2') echo 'checked'; ?>> 건물명 검색</input>
					</span>
				</div>
				<div class="row">
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-3'; else echo 'col-xs-2'; ?>">
						<label for="sido">시 / 도</label>
					</div>
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-9'; else echo 'col-xs-10'; ?>">
						<div class="col-xs-7">
							<select name="sido" class="form-control input-sm">
								<option value="su" <?php if($this->input->post('sido')=='su') echo 'selected'; ?>>서울특별시</option>
								<option value="bs" <?php if($this->input->post('sido')=='bs') echo 'selected'; ?>>부산광역시</option>
								<option value="dg" <?php if($this->input->post('sido')=='dg') echo 'selected'; ?>>대구광역시</option>
								<option value="ic" <?php if( !$this->input->post('sido')=='ic' or $this->input->post('sido')=='ic') echo 'selected'; ?>>인천광역시</option>
								<option value="gj" <?php if($this->input->post('sido')=='gj') echo 'selected'; ?>>광주광역시</option>
								<option value="dj" <?php if($this->input->post('sido')=='dj') echo 'selected'; ?>>대전광역시</option>
								<option value="us" <?php if($this->input->post('sido')=='us') echo 'selected'; ?>>울산광역시</option>
								<option value="sj" <?php if($this->input->post('sido')=='sj') echo 'selected'; ?>>세종특별자치시</option>
								<option value="gg" <?php if($this->input->post('sido')=='gg') echo 'selected'; ?>>경기도</option>
								<option value="gw" <?php if($this->input->post('sido')=='gw') echo 'selected'; ?>>강원도</option>
								<option value="cb" <?php if($this->input->post('sido')=='cb') echo 'selected'; ?>>충청북도</option>
								<option value="cn" <?php if($this->input->post('sido')=='cn') echo 'selected'; ?>>충청남도</option>
								<option value="jb" <?php if($this->input->post('sido')=='jb') echo 'selected'; ?>>전라북도</option>
								<option value="jn" <?php if($this->input->post('sido')=='jn') echo 'selected'; ?>>전라남도</option>
								<option value="gb" <?php if($this->input->post('sido')=='gb') echo 'selected'; ?>>경상북도</option>
								<option value="gn" <?php if($this->input->post('sido')=='gn') echo 'selected'; ?>>경상남도</option>
								<option value="jj" <?php if($this->input->post('sido')=='jj') echo 'selected'; ?>>제주특별자치도</option>
							</select>
						</div>
						<div class="col-xs-5"></div>
					</div>
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-3'; else echo 'col-xs-2'; ?>">
						<label id="doro_name" for="search_text">도로명</label>
						<label id="build_name" for="search_text" style="display: none;">건물명</label>
					</div>
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-9'; else echo 'col-xs-10'; ?>">
						<div class="col-xs-7">
							<input class="form-control input-sm" type="text" name="search_text" id="search_text" value="<?php echo $this->input->post('search_text'); ?>" onclick="this.value=null" required autofocus>
							<?php echo validation_errors(); ?>
						</div>
						<div class="col-xs-5">
							<button class="btn btn-primary btn-sm">검 색</button>
						</div>
					</div>
				</div>

				<div class="mt20">
					<div class="desc pull-left">※ 해당되는 주소를 선택해주세요.</div>
					<div class="num text-right"><?php if(isset($zip_rlt[0])) echo "(".$zip_rlt[0]." 건)" ?>&nbsp;</div>
				</div>
				<div class="zip-tb">
					<table class="table table-bordered table-condensed">
						<tr>
							<th class="<?php if(is_mobile()) echo 'col-xs-3'; else echo 'col-xs-2'; ?> center">우편번호</th>
							<th class="<?php if(is_mobile()) echo 'col-xs-9'; else echo 'col-xs-10'; ?> center">주 소</th>
						</tr>
						<tr>
							<td colspan="2">
								<select name="" class="form-control input-sm" onchange="val_put(this.value);">
<?php if( !$zip_rlt[1]) : ?>
									<option value="">도로명(건물명) 주소를 검색하여 주세요.</option>
<?php else : ?>
									<option value="" selected>해당되는 주소를 선택해주세요.</option>
<?php $term = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?>
<?php foreach ($zip_rlt[1] as $col): ?>
<?php
	if($col->is_jiha==1) $ij = '지하'; else $ij = '';
	if($col->sb_num==null or $col->sb_num==0) $sb_num=''; else $sb_num = '-'.$col->sb_num;

	$ref = '';
	if($col->ld_name!=null && $col->sgg_bd_name==null) $ref = "(".$col->ld_name.")";
	if($col->ld_name==null && $col->sgg_bd_name!=null) $ref = "(".$col->sgg_bd_name.")";
	if($col->ld_name!=null && $col->sgg_bd_name!=null) $ref = "(".$col->ld_name.", ".$col->sgg_bd_name.")";
?>
									<option value="<?php echo $col->zipcode."|".$col->sido." ".$col->sigun." ".$col->epmn." ".$col->doro_name." ".$ij." ".$col->mb_num.$sb_num."|".$ref; ?>"><?php echo $col->zipcode.$term.$col->sido." ".$col->sigun." ".$col->epmn." ".$col->doro_name." ".$ij." ".$col->mb_num.$sb_num." ".$ref; ?></option>
<?php endforeach; ?>
<?php endif; ?>
								</select>
							</td>
						</tr>
					</table>
				</div>

				<div class="desc mt30">
					※ 상세주소 입력 후 '확인'버튼을 눌러주세요.
				</div>
				<div class="zip-tb">
					<table class="table table-bordered table-condensed">
						<tr>
							<th class="<?php if(is_mobile()) echo 'col-xs-3'; else echo 'col-xs-2'; ?> center">
								<div class="pt6">도로명주소</div>
							</th>
							<td class="<?php if(is_mobile()) echo 'col-xs-9'; else echo 'col-xs-10'; ?>">
								<div class="<?php if(is_mobile()) echo 'col-xs-3'; else echo 'col-xs-2'; ?> pl0">
									<label class="sr-only" for="zipcode">우편번호</label>
									<input class="form-control input-sm" type="text" name="zipcode" id="zipcode" readonly>
								</div>
								<div class="<?php if(is_mobile()) echo 'col-xs-9'; else echo 'col-xs-10'; ?> pl0">
									<label class="sr-only" for="addr1">주소1</label>
									<input class="form-control input-sm" type="text" name="addr1" id="addr1" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<th class="center">
								<div class="pt6">상 세 주 소</div>
							</th>
							<td>
								<div class="col-xs-7 pl0">
									<label class="sr-only" for="addr2">주소2</label>
									<input class="form-control input-sm" type="text" name="addr2" id="addr2" onkeypress="enter_search(document.addr2);">
								</div>
								<div class="col-xs-5 pl0">
									<label class="sr-only" for="addr3">주소3</label>
									<input class="form-control input-sm" type="text" name="addr3" id="addr3" readonly>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<footer class="center">
					<a href="javascript:val_put2();" class="btn btn-primary btn-sm" id="addr_put">주소입력</a>
				</footer>
			</div>
		</form>
