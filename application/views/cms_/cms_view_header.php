<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<title>[주]바램디앤씨 관리시스템</title>
		<link rel="shortcut icon" href="ref/img/cms.ico">
		<link type="text/css" rel="stylesheet" href="ref/css/cms.css">
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="ref/js/global.js"></script>
		<script src="ref/js/calendar.js"></script>
		<!--<script src="../common/_menu1.js"></script> //-->
		<script type="text/javascript">
			$(document).ready(function(){
			$("#loading").css("display","none");
			});
		</script>
	</head>
	<body onclick="cal_del();">
		<div id="loading" style="padding-top:530px;"><img src="../images/loading.gif"><br>loading...</div>
		<div id="wrap">
			<header>
				<script type="text/javascript">
				<!--
					function message_win(ref) {
						// ref = ref + "?id=" + <?=$_SESSION['p_id']?>;
						var window_left = (screen.width-640)/2;
						var window_top = (screen.height-480)/2;
						window.open(ref,"message",'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
				 	}

					function img_over(n){
						 img = new Array();
						 img[0]=tm_img0;
						 img[1]=tm_img1;
						 img[2]=tm_img2;
						 img[3]=tm_img3;
						 img[4]=tm_img4;

						 for(i=0; i<=4; i++){

								if(n==i){
									 img[n].src="ref/img/t_menu_"+(n+1)+"_.png";
								} else {
									 img[i].src="ref/img/t_menu_"+(i+1)+".png";
								}
						 }
					}
					function img_out(page_no){
						for(i=0; i<=4; i++){
							if((i+1)==page_no){
								img[i].src="ref/img/t_menu_"+(i+1)+"_.png";
							} else {
								img[i].src="ref/img/t_menu_"+(i+1)+".png";
							}
						}
					}
				//-->
				</script>

				<div style="height:95px;">
					<div style="float:left; width:180px; height:70px; padding:25px 0 0 10px;"><!-- 첫째 줄 -->
						<a href="/cms_cont"><img src="/ref/img/cms_main_logo_.png" alt="" onmouseover="this.src='/ref/img/cms_main_logo.png' " onmouseout="this.src='/ref/img/cms_main_logo_.png' "></a>
					</div><!-- 로고부분 -->
					<div style="float:left; width:890px; text-align:right;"><!-- 둘째 줄 -->
						<div style="font-size:11px; height:15px; padding-top:5px;">

							<a href="/cms/member/login_form.php" style="font-size:11px;">로그인</a>
							&nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>공지사항</b></a> &nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>My Page</b></a> &nbsp;|&nbsp; <a href="javascript:" onclick="alert('준비 중입니다!');" style="font-size:11px;"><b>매뉴얼</b></a>
						</div>
						<?
							if(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')!==false){
								$padding = "padding:43px 170px 0 0px;";
							}else{
								$padding = "padding:45px 170px 0 0px;";
							}
						?>
						<nav style="text-align:right; height:30px; <?=$padding?>">
							<?
								$a = $_SERVER['PHP_SELF'];   // ereg ..로...폴더단위까지만 비교해서 동일 폴더내 다른 파일까지 적용 시킬 것.//또는 동일 폴더 내 파일 전체를 해당 메인페이지 안에 Div로 넣을 것.
								$url_0 = "/cms/cms.php";															///////////////////////////
								$url_1 = "/cms/_menu1/work_main.php";											///////////////////////////
								$url_2 = "/cms/_menu2/local_main.php";											///////////////////////////
								// $url_2_2 = "/cms/_stock/stock_main2.php";										///////////////////////////
								$url_3 = "/cms/_menu3/capital_main.php";											///////////////////////////
								$url_4 = "/cms/_menu4/project_main.php";											///////////////////////////
								$url_5 = "/cms/_menu5/config_main.php";											///////////////////////////

								if( !$a or $a==$url_0) {
									$a0="_";
									$b=0;
								}else{
									$a0="";
								}
								if($a==$url_1) {
									$a1="_";
									$b=1;
								}else{
									$a1="";
								}
								if($a==$url_2) {
									$a2="_";
									$b=2;
								}else{
									$a2="";
								}
								if($a==$url_3) {
									$a3="_";
									$b=3;
								}else{
									$a3="";
								}
								if($a==$url_4) {
									$a4="_";
									$b=4;
								}else{
									$a4="";
								}
								if($a==$url_5) {
									$a5="_";
									$b=5;
								}else{
									$a5="";
								}
							?>
							<a href="/cms/_menu1/work_main.php"><img src="/ref/img/t_menu_1.png" id="tm_img0" onmouseover="img_over(0)" onmouseout="img_out(0)" alt=""></a><a href="/cms/_menu2/local_main.php"><img src="ref/img/t_menu_2.png" id="tm_img1" onmouseover="img_over(1)" onmouseout="img_out(1)" alt=""></a><a href="/cms/_menu3/capital_main.php"><img src="ref/img/t_menu_3.png" id="tm_img2" onmouseover="img_over(2)" onmouseout="img_out(2)" alt=""></a><a href="/cms/_menu4/project_main.php"><img src="ref/img/t_menu_4.png" id="tm_img3" onmouseover="img_over(3)" onmouseout="img_out(3)" alt=""></a><a href="/cms/_menu5/config_main.php"><img src="ref/img/t_menu_5.png" id="tm_img4" onmouseover="img_over(4)" onmouseout="img_out(4)" alt=""></a>
						</nav>
					</div>
				</div>
			</header>