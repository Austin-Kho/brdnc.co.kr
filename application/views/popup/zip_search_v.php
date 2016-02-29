<!DOCTYPE HTML>
<html lang="ko">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="/static/img/cms.ico">
		<title>[주]바램디앤씨 관리시스템</title>
		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="/static/lib/bootstrap/css/bootstrap.min.css" media="screen">
		<!-- Custom styles for this template -->
		<link rel="stylesheet" href="/static/css/zipsearch.css">
		<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<script src="/static/js/ie-emulation-modes-warning.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></scrit>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="/static/lib/calendar/calendar.js"></script>
		<script src="/static/js/global.js"></script>
<?php
	switch ($this->uri->segment(1)) {
		case 'm1': $menu_js = 'm1.js';	break;
		case 'm2': $menu_js = 'm2.js';	break;
		case 'm3': $menu_js = 'm3.js';	break;
		case 'm4': $menu_js = 'm4.js';	break;
		case 'm5': $menu_js = 'm5.js';  break;
	}
?>
		<script src="/static/js/<?php echo $menu_js;?>"></script>
		<script type="text/javascript">
			// $(document).ready(function(){
			// 	$("#loading").css("display","none");
			// });
			function search_con () {
				if(document.getElementById('sw1').checked == true){
					document.getElementById('doro_name').style.display = '';
					document.getElementById('build_name').style.display = 'none';
				}else if(document.getElementById('sw2').checked == true){
					document.getElementById('doro_name').style.display = 'none';
					document.getElementById('build_name').style.display = '';
				}
			}
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
<?php
	$attributes = array('name' => 'form1', 'id' => 'zipsearch', 'class' => 'form-inline');
	echo form_open($this->config->base_url().'popup/zip_search/', $attributes);
?>
			<div class="container">
				<header id="header">
					<h1>주 소 검 색</h1>
				</header><!-- /header -->
				<div class="desc">
					※ 찾고자 하는 도로명주소 또는 건물명을 선택해 주세요.
				</div>
				<div class="well">
					<label class="sr-only" for="sw1">도로명주소 검색</label>
					<span>
						<input type="radio" name="sh_what" id="sw1" value="1" onclick="search_con();" checked> 도로명주소 검색</input>
					</span>
					<label class="sr-only" for="sw2">건물명 검색</label>
					<span class="ml20">
						<input type="radio" name="sh_what" id="sw2" value="2" onclick="search_con();"> 건물명 검색</input>
					</span>
				</div>
				<div class="row">
					<div class="form-group col-xs-2">
						<label for="sido">시 / 도</label>
					</div>
					<div class="form-group col-xs-10">
						<div class="col-xs-7">
							<select name="sido" class="form-control input-sm">
								<option value="su">서울특별시</option>
								<option value="bs">부산광역시</option>
								<option value="dg">대구광역시</option>
								<option value="ic">인천광역시</option>
								<option value="gj">광주광역시</option>
								<option value="dj">대전광역시</option>
								<option value="us">울산광역시</option>
								<option value="sj">세종특별자치시</option>
								<option value="gg">경기도</option>
								<option value="gw">강원도</option>
								<option value="cb">충청북도</option>
								<option value="cn">충청남도</option>
								<option value="jb">전라북도</option>
								<option value="jn">전라남도</option>
								<option value="gb">경상북도</option>
								<option value="gn">경상남도</option>
								<option value="jj">제주특별자치도</option>
							</select>
						</div>
						<div class="col-xs-5"></div>
					</div>
					<div class="form-group col-xs-2">
						<label id="doro_name" for="search_text">도로명</label>
						<label id="build_name" for="search_text" style="display: none;">건물명</label>
					</div>
					<div class="form-group col-xs-10">
						<div class="col-xs-7">
							<input class="form-control input-sm" type="text" name="search_text" id="search_text" required autofocus>
						</div>
						<div class="col-xs-5">
							<button class="btn btn-primary btn-sm">검 색</button>
						</div>
					</div>
				</div>

				<div class="mt20">
					<div class="desc pull-left">※ 해당되는 주소를 선택해주세요.<?//php var_dump($result); ?></div>
					<div class="num text-right">(39 건)</div>
				</div>
				<div class="zip-tb">
					<table class="table table-bordered table-condensed">
						<tr>
							<th class="col-xs-2 center">우편번호</th>
							<th class="col-xs-10 center">주 소</th>
						</tr>
					</table>
				</div>
				<div id="main-select">
					<select name="" class="form-control input-sm">
						<!-- <option value="">12345 ----- 서울특별시 강남구 개포로15길 32-8 (개포동, 포이동 현대아파트)</option> -->
					</select>
				</div>
				<div class="desc mt30">
					※ 상세주소 입력 후 '확인'버튼을 눌러주세요.
				</div>
				<div class="zip-tb">
					<table class="table table-bordered table-condensed">
						<tr>
							<th class="col-xs-2 center">
								<div class="pt6">도로명주소</div>
							</th>
							<td class="col-xs-10">
								<div class="col-xs-2 pl0">
									<label class="sr-only" id="doro_name" for="">도로명</label>
									<input class="form-control input-sm" type="text" readonly>
								</div>
								<div class="col-xs-10 pl0">
									<label class="sr-only" id="doro_name" for="">도로명</label>
									<input class="form-control input-sm" type="text" readonly>
								</div>
							</td>
						</tr>
						<tr>
							<th class="center">
								<div class="pt6">상 세 주 소</div>
							</th>
							<td>
								<div class="col-xs-7 pl0">
									<label class="sr-only" id="doro_name" for="">도로명</label>
									<input class="form-control input-sm" type="text">
								</div>
								<div class="col-xs-5 pl0">
									<label class="sr-only" id="doro_name" for="">도로명</label>
									<input class="form-control input-sm" type="text" readonly>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<footer class="center">
					<a href="" class="btn btn-primary btn-sm"> 확 인 </a>
				</footer>
			</div>
		</form>
	</body>
</html>