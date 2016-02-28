<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="<?php echo $this->config->base_url(); ?>static/img/cms.ico">

		<title>[주]바램디앤씨 관리시스템</title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>static/lib/bootstrap/css/bootstrap.min.css" media="screen">

		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="<?php echo $this->config->base_url(); ?>static/css/cms.css">

		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="<?php echo $this->config->base_url(); ?>static/js/ie-emulation-modes-warning.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></scrit>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<script src="/static/lib/calendar/calendar.js"></script>
		<script src="/static/js/global.js"></script>
<?php
	switch ($this->uri->segment(1)) {
		case 'm1':
			$menu_js = 'm1.js';
			break;
		case 'm2':
			$menu_js = 'm2.js';
			break;
		case 'm3':
			$menu_js = 'm3.js';
			break;
		case 'm4':
			$menu_js = 'm4.js';
			break;
		case 'm5':
			$menu_js = 'm5.js';
			break;
	}
?>
		<script src="/static/js/<?php echo $menu_js;?>"></script>
		<script type="text/javascript">
	    $(document).ready(function(){
	     $("#loading").css("display","none");
	    });
    </script>
		<script type="text/JavaScript">
			<!--
				function checkInput(form){
					var form=document.zipsearch;
					if(!form.dong.value){
						alert('찾기를 원하는 동을 입력하세요!');
						form.dong.focus();
						return false;
					} else {
						form.submit();
					}
				}
				function open_move(zip, adr1, adr2){ // zip = 우편번호, adr = 주소

					var form=opener.document.form1;

					var z = document.zipsearch.z_form.value;
					var a1 = document.zipsearch.a_form.value+"1";
					var a2 = document.zipsearch.a_form.value+"2";

					a = eval("form."+z); // 우편번호 폼 이름
					b = eval("form."+a1); // 기본주소 폼 이름
					c = eval("form."+a2); // 나머지주소 폼 이름

					a.value=zip;
					b.value=adr1;
					c.value=adr2;
					c.focus();

					self.close();
				}
			//-->
		</script>
	</head>
	<body>
		<form class="form-inline" id="zipsearch" name="form1">
			<fieldset style="background-color: white; padding: 30px;">
				<div class="row">
					<div class="form-group col-xs-3">
						<label for="co_name">
							시도<span class="red">*</span>
						</label>
					</div>
					<div class="form-group col-xs-9">
						<select class="form-control" id="co_form" name="co_form">
							<option value="1">서울특별시</option>
							<option value="2">부산광역시</option>
							<option value="3">대구광역시</option>
							<option value="4">인천광역시</option>
							<option value="4">광주광역시</option>
							<option value="4">대전광역시</option>
							<option value="4">울산광역시</option>
							<option value="4">세종특별자치시</option>
							<option value="4">경기도</option>
							<option value="4">강원도</option>
							<option value="4">충청북도</option>
							<option value="4">충청남도</option>
							<option value="4">전라북도</option>
							<option value="4">전라남도</option>
							<option value="4">경상북도</option>
							<option value="4">경상남도</option>
							<option value="4">제주특별자치도</option>
						</select>
					</div>
					<div class="form-group col-xs-3">
						<label for="co_no1">도로명 <span class="red">*</span></label>
					</div>
					<div class="form-group col-xs-9">
						<input type="text" class="form-control input-sm" id="co_no1" name="co_no1" maxlength="3">
					</div>

					<div class="form-group col-xs-3">
						<label for="co_no1">건물번호 <span class="red">*</span></label>
					</div>

					<div class="form-group col-xs-9">
						<div class="col-xs-3">
							<input type="text" class="form-control input-sm" id="co_no1" name="co_no1" maxlength="4">
						</div>
						<div class="col-xs-1">-</div>
						<div class="col-xs-3">
			        <label for="co_no3" class="sr-only">건물번호 부번 </label>
			        <input type="text" class="form-control input-sm" id="co_no3" name="co_no3" maxlength="4">
		        </div>
					</div>
					<div class="form-group col-xs-3">
						<label for="co_no1">건물명 <span class="red">*</span></label>
					</div>

					<div class="form-group col-xs-9">
						<div class="col-xs-9">
							<input type="text" class="form-control input-sm" id="co_no1" name="co_no1" maxlength="4">
						</div>
						<div class="col-xs-3">
		        	<label for="co_form" class="sr-only">검색버튼 </label>
							<input type="button" class="btn btn-primary btn-sm" value="검 색">
						</div>
					</div>
				</div>
				<div style="height: 76px; ">
					검색결과 화면
				</div>
			</fieldset>
		</form>
	</body>
</html>
