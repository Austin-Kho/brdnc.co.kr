		<script>
			function enter_search(form) {// 폼 button에서 엔터키를 눌렀을때 써브밋 해주는 함수
				var keycode = window.event.keyCode;
				if(keycode == 13) $("#search_btn").click();
			}

			function value_put(a,b,n){
			 var form_obj=opener.document.form1;
			eval("form_obj.tax_off"+n+"_code").value=a;
			eval("form_obj.tax_off"+n+"_name").value=b;
			 self.close();
		}
		</script>
		<form action="" name="taxsearch" id="taxsearch" class="form-inline" method="post">
			<div class="container">
				<header id="header">
					<h1>관 할 세 무 서 검 색</h1>
				</header><!-- /header -->
				<div class="desc">※ 찾고자 하는 세무서를 입력해 주세요.</div>
				<div class="well">세무서를 제외한 <b>[관할 지역명]</b> 만 입력하세요.</div>
				<div class="row">
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-4'; else echo 'col-xs-3'; ?>">
						<label id="doro_name" for="search_text">관할세무서</label>
						<label id="build_name" for="search_text" style="display: none;">건물명</label>
					</div>
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-8'; else echo 'col-xs-9'; ?>">
						<div class="col-xs-7">
							<input class="form-control input-sm han" type="text" name="search_text" id="q" value="<?php echo $this->input->post('search_text'); ?>" onclick="this.value=null" onkeypress="enter_search(this);">
						</div>
						<div class="col-xs-5">
							<button class="btn btn-primary btn-sm" id="search_btn">검 색</button>
						</div>
					</div>
				</div>

				<div class="mt20">
					<div class="desc">&nbsp;</div>
				</div>
				<div class="zip-tb">
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
								<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서', 2);"><?php echo $lt->code; ?></a>
							</td>
							<td class="center">
								<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서', 2);"><?php echo $lt->chung; ?></a>
							</td>
							<td class="pl20" style="padding-left: 20px;">
								<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서', 2);"><?php echo $lt->office. '세무서'; ?></a>
							</td>
							<td class="center">
								<?php echo $lt->tel; ?>
							</td>
						</tr>
<?php endforeach; ?>
					</table>
				</div>
				<nav class="center">
					<ul class="pagination pagination-sm"><?php echo $pagination; ?></ul>
				</nav>
				<footer class="center">
					<a href="javascript:self.close();" class="btn btn-danger btn-sm">닫 기</a>
				</footer>
			</div>
		</form>