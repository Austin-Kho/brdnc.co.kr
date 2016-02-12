<div style="height:95px;">
	<div style="float:left; width:180px; height:70px; padding:25px 0 0 10px;"><!-- 첫째 줄 -->
		  <a href="<?=$cms_url?>cms.php"><img src="<?=$cms_url?>images/cms_main_logo_.png" alt="" onmouseover="this.src='<?=$cms_url?>images/cms_main_logo.png' " onmouseout="this.src='<?=$cms_url?>images/cms_main_logo_.png' "></a>
	</div><!-- 로고부분 -->
	<div style="float:left; width:890px; text-align:right;"><!-- 둘째 줄 -->
		<div style="font-size:11px; height:15px; padding-top:5px;">
			<?
			   if(!$_SESSION['p_id']){
			?>
			<a href="<?=$cms_url?>member/login_form.php" style="font-size:11px;">로그인</a>
			<?
				} else {
			?>
			 <span style="font-size: 11px; color:#6699ff;"><?=$_SESSION['p_name']?></span> <span style="font-size: 11px; color:#4b4b4b;">님</span>&nbsp;|&nbsp;
			 <a href="<?=$cms_url?>member/logout_process.php" style="font-size:11px;"><b>로그아웃</b></a>&nbsp;|&nbsp;
			 <?
			 	// 아직 확인하지 않은 쪽지 수 파악
		   	$t_qry4="select count(mnum) as cnt_1 from cms_message_info where receiveid_fk='$_SESSION[p_id]' And receive_del='N' And receive_chk='N'";
			  $t_res4=mysql_query($t_qry4, $connect);
			  $t_rows4=mysql_fetch_array($t_res4);

			  mysql_free_result($t_res4);

			  if($t_rows4[cnt_1]==0){
				  $bt_msg="images/bt_msg_0.gif";
				  $color_msg="#7A7A7A";
			  } else {
				  $bt_msg="images/bt_msg.gif";
				  $color_msg="#0088ff";
			  }
			?>
			<a href="javascript:message_win('<?=$cms_url?>member/message_1.php');"><img src="<?=$cms_url?><?=$bt_msg?>" width="13" alt=""></a>
			<a href="javascript:message_win('<?=$cms_url?>member/message_1.php');"><b style="font-size:11px;"> 새 쪽지</b></a><span   style="font-size:11px;"> : </span>
			<b><a href="javascript:message_win('<?=$cms_url?>member/message_1.php');"><span style="font-size: 11px; color:<?=$color_msg?>;"><?=number_format($t_rows4[cnt_1])?></span></a> 개</b>

			&nbsp;|&nbsp;<a href="<?=$cms_url?>member/member_modify.php"><b style="font-size:11px;">회원정보수정</b></a>
			<? } ?>
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
				$a = $_SERVER['PHP_SELF'];                   /////// ereg ..로...폴더단위까지만 비교해서 동일 폴더내 다른 파일까지 적용 시킬 것.//또는 동일 폴더 내 파일 전체를 해당 메인페이지 안에 Div로 넣을 것.
				$url_0 = "/cms/cms.php";							/////////////////////////////
				$url_1 = "/cms/_menu1/work_main.php";			/////////////////////////////
				$url_2 = "/cms/_menu2/local_main.php";			/////////////////////////////
				// $url_2_2 = "/cms/_stock/stock_main2.php";		/////////////////////////////
				$url_3 = "/cms/_menu3/capital_main.php";		/////////////////////////////
				$url_4 = "/cms/_menu4/project_main.php";		/////////////////////////////
				$url_5 = "/cms/_menu5/config_main.php";			/////////////////////////////

				if($a==$url_0) {$a0="_"; $b=0;}else{$a0="";}
				if($a==$url_1) {$a1="_"; $b=1;}else{$a1="";}
				if($a==$url_2) {$a2="_"; $b=2;}else{$a2="";}
				if($a==$url_3) {$a3="_"; $b=3;}else{$a3="";}
				if($a==$url_4) {$a4="_"; $b=4;}else{$a4="";}
				if($a==$url_5) {$a5="_"; $b=5;}else{$a5="";}
			?>
			<a href="<?=$cms_url?>_menu1/work_main.php"><img src="<?=$cms_url?>images/t_menu_1<?=$a1?>.png" id="tm_img0" onmouseover="img_over(0)" onmouseout="img_out(<?=$b?>)" alt=""></a><a href="<?=$cms_url?>_menu2/local_main.php"><img src="<?=$cms_url?>images/t_menu_2<?=$a2?>.png" id="tm_img1" onmouseover="img_over(1)" onmouseout="img_out(<?=$b?>)" alt=""></a><a href="<?=$cms_url?>_menu3/capital_main.php"><img src="<?=$cms_url?>images/t_menu_3<?=$a3?>.png" id="tm_img2" onmouseover="img_over(2)" onmouseout="img_out(<?=$b?>)" alt=""></a><a href="<?=$cms_url?>_menu4/project_main.php"><img src="<?=$cms_url?>images/t_menu_4<?=$a4?>.png" id="tm_img3" onmouseover="img_over(3)" onmouseout="img_out(<?=$b?>)" alt=""></a><a href="<?=$cms_url?>_menu5/config_main.php"><img src="<?=$cms_url?>images/t_menu_5<?=$a5?>.png" id="tm_img4" onmouseover="img_over(4)" onmouseout="img_out(<?=$b?>)" alt=""></a>
		</nav>
	</div>
</div>