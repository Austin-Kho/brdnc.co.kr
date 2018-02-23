		<script>
		<!--
			function value_put(a,b){
				var form_obj=opener.document.form1;
				var n = document.getElementById('n').value;
				eval("form_obj.tax_off"+n+"_code").value=a;
				eval("form_obj.tax_off"+n+"_name").value=b;
				self.close();
			}
		-->
		</script>

	<div class="container">
	<?php
		$attributes = array('name' => 'taxsearch', 'id' => 'taxsearch', 'class' => 'form-inline');
		// $hidden = array('n' => $n);
		echo form_open(current_full_url(), $attributes);//, $hidden);
	?>
		<input type="hidden" name="n" value="<?php echo $n; ?>" id="n">
		<header id="header">
			<h3>관 할 세 무 서 검 색</h3>
		</header><!-- /header -->
		<div class="desc">※ 찾고자 하는 세무서를 입력해 주세요.</div>
		<div class="well" style="padding: 13px; margin-bottom: 20px;">세무서를 제외한 <b>[관할 지역명]</b> 만 입력하세요.</div>
		<div class="row" style="padding-top: 0;">
			<div class="form-group <?php if(is_mobile()) echo 'col-xs-4'; else echo 'col-xs-3'; ?>" style="border-top: 0;">
				<label for="search_text">관할세무서</label>
			</div>
			<div class="form-group <?php if(is_mobile()) echo 'col-xs-8'; else echo 'col-xs-9'; ?>" style="border-top: 0;">
				<div class="col-xs-7">
					<input class="form-control input-sm han" type="text" name="search_text" id="q" value="<?php echo $this->input->post('search_text'); ?>" onclick="this.value=null" onkeydown="if(event.keyCode==13)submit();">
				</div>
				<div class="col-xs-5">
					<button class="btn btn-primary btn-sm" id="search_btn">검 색</button>
				</div>
			</div>
		</div>

		<div class="mt10">
			<div class="desc">&nbsp;</div>
		</div>
		<div class="tb-h5">
			<table class="table table-bordered table-hover table-condensed">
				<tr>
					<th class="col-xs-2 center">코드</th>
					<th class="col-xs-2 center">관할청</th>
					<th class="col-xs-4 center">관할 세무서 명칭</th>
					<th class="col-xs-4 center">전화번호</th>
				</tr>
<?php foreach ($tax_off_list as $lt) : ?>
				<tr>
					<td class="center">
						<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서');"><?php echo $lt->code; ?></a>
					</td>
					<td class="center">
						<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서');"><?php echo $lt->chung; ?></a>
					</td>
					<td class="pl20" style="padding-left: 20px;">
						<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서');"><?php echo $lt->office. '세무서'; ?></a>
					</td>
					<td class="center"><?php echo $lt->tel; ?></td>
				</tr>
<?php endforeach; ?>
			</table>
		</div>
		<nav class="center"><ul class="pagination pagination-sm"><?php echo $pagination; ?></ul></nav>
		<footer class="center"><a href="javascript:self.close();" class="btn btn-danger btn-sm">닫 기</a></footer>
		</form>
	</div>
