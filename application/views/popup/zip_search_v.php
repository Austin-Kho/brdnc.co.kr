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
		<link rel="stylesheet" href="/static/css/cms.css">
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
			<div style="background-color: white; height: 544px;">
				<div class="container" style="border: 1px solid #99B0FF; margin: 0 3px; height: 540px; padding: 0;">
					<header id="header" class="" style="background-color: #aaaeee; margin: 3px; text-align: center; padding: 1px; height: 38px; border: 1px solid #3e3e3e;">
						<h1 style="font-size: 15px; color: white; padding: 0; margin: 0; padding-top: 8px;">주소검색</h1>
					</header><!-- /header -->
					<div style="padding: 5px 10px;">
						※ 찾고자 하는 도로명주소 또는 건물명을 선택해 주세요.
					</div>
					<div class="well" style="margin: 0 10px; padding: 5px 10px;">
						<input type="radio" checked> 도로명주소 검색</input>
						<input type="radio"> 건물명 검색</input>
					</div>
					<div class="row" style="margin: 5px 10px; padding: 10px 10px; border: 1px solid #eaeaea;">
						<div style="float: left;">
							<label style="width: 60px; ">시/도</label>
							<select name="" class="">
								<option value="">서울특별시</option>
								<option value="">부산광역시</option>
								<option value="">대구광역시</option>
								<option value="">인천광역시</option>
								<option value="">광주광역시</option>
								<option value="">대전광역시</option>
								<option value="">울산광역시</option>
								<option value="">세종특별자치시</option>
								<option value="">경기도</option>
								<option value="">강원도</option>
								<option value="">충청북도</option>
								<option value="">충청남도</option>
								<option value="">전라북도</option>
								<option value="">전라남도</option>
								<option value="">경상북도</option>
								<option value="">경상남도</option>
								<option value="">제주특별자치도</option>
							</select>
						</div>
						<div style="clear: both; float: left;">
							<label style="width: 60px; ">도로명</label>
							<input type="text">
						</div>
						<div style="float: left;">
							<label style="width: 60px; ">건물번호</label>
							<input type="text" style="width: 50px;"> - <input type="text" style="width: 50px;">
							<input type="button" value="검색">
						</div>
					</div>
					<div style="padding: 5px 10px;">
						※ 해당되는 주소를 선택해주세요.
					</div>
					<div style="border: 1px solid $eaeaea; margin: 5px 10px;">
						<table>
							<thead>
								<th>우편번호</th>
								<th>주 소</th>
							</thead>
							<tr>
								<th>d</th>
								<th>d</th>
							</tr>
							<tr>
								<th>a</th>
								<th>a</th>
							</tr>
							<tr>
								<th>a</th>
								<th>a</th>
							</tr>
							<tr>
								<th>a</th>
								<th>d</th>
							</tr>
							<tr>
								<th>a</th>
								<th>a</th>
							</tr>
						</table>
					</div>
					<div style="text-align: center;">
						pagenation
					</div>
					<div style="padding: 5px 10px; margin-top: 30px;">
						※ 상세주소 입력 후 '확인'버튼을 눌러주세요.
					</div>
					<div style="border: 1px solid $eaeaea; margin: 5px 10px;">
						<table>
							<tr>
								<th>도로명주소</th>
								<th>d</th>
							</tr>
							<tr>
								<th>상세주소입력</th>
								<th>a</th>
							</tr>
						</table>
					</div>
					<div style="padding: 5px 10px; margin-bottom: 10xp; text-align: center;">
						<a href="" class="btn btn-primary btn-sm"> 확 인 </a>
					</div>
				</div>
			</div>
		</form>
	</body>
</html>