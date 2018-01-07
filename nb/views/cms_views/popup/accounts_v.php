	<script type="text/javascript">
	<!--
		function acc_d1_sub(){
			var form = document.form1;
			form.acc_d2.value = "";
			form.submit();
		}

		function show_hide(id){
			var obj = eval("document.getElementById('"+id+"')");
			if(obj.style.display=='none') {
				obj.style.display = '';
			}else{
				obj.style.display = 'none';
			}
		}

		function d2_show(acc){
			var val = acc.value;
			var d1_val = val.substr(0,1);
			var d1_obj = eval("document.getElementById('acc"+(eval(d1_val)+1)+"')");
			var d2_obj = eval("document.getElementById('"+val+"')");

			for(i=1; i>=5; i++){
				eval("document.getElementById('acc"+i+"')").style.display="none";
			}
			d1_obj.style.display="";
			d2_obj.style.display="";
		}
	//-->
	</script>

	<div class="container">
		<header id="header">
			<h1>회계 계정과목(Account) 관리</h1>
		</header>
		<div class="desc">※ 검색할 계정과목 명칭을 선택하여 주십시요.</div>
		<div class="well" style="padding: 13px; margin-bottom: 20px;">세무서를 제외한 <b>[관할 지역명]</b> 만 입력하세요.</div>
		<div class="row" style="padding-top: 0;">

			<div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>">
				<label id="doro_name" for="acc_d1">계정과목 [대분류] :</label>
			</div>
			<div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>" style="border-top: 0;">
				<div class="col-xs-12">
					<select name="acc_d1" class="form-control input-sm" onChange = "acc_d1_sub();">
						<option value="0"> 전 체
						<option value="1" <?php echo set_select('acc_d1', '1');?>> 자 산
						<option value="2" <?php echo set_select('acc_d1', '2');?>> 부 채
						<option value="3" <?php echo set_select('acc_d1', '3');?>> 자 본
						<option value="4" <?php echo set_select('acc_d1', '4');?>> 수 익
						<option value="5" <?php echo set_select('acc_d1', '5');?>> 비 용
					</select>
				</div>
			</div>
			<div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>" style="background-color:yellow;">
				<label id="doro_name" for="acc_d2">계정과목 [중분류] :</label>
			</div>
			<div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>" style="border-top: 0;">
				<div class="col-xs-12">
					<select name="acc_d2" class="form-control input-sm" onChange = "d2_show(this);">
						<option value=""> 전 체
<?php foreach($d2_acc as $lt) : ?>
						<option value="<?php echo $lt->d2_code; ?>" <?php echo set_select('acc_d2'); ?>> <?php echo $lt->d2_acc_name; ?>
<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>">
				<label>희귀 계정과목 표시 : <input type="checkbox" name="is_sp" value="1" <?php echo set_checkbox('is_sp', '1'); ?> onClick="submit();"></label>
			</div>
		</div>

		<div class="mt10">
			<div class="desc">&nbsp;</div>
		</div>
		<div class="tb-h5">
			
		</div>
		<footer class="center"><a href="javascript:self.close();" class="btn btn-danger btn-sm">닫 기</a></footer>
	</div>
