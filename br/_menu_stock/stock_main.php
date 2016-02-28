<?
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	$m_di=$_REQUEST['m_di'];
	$s_di=$_REQUEST['s_di'];

	if(!$m_di) $m_di='1';
	if($m_di=='1') $m_dis1 = "display:inline"; else	$m_dis1 = "display:none";
	if($m_di=='2') $m_dis2 = "display:inline"; else  $m_dis2 = "display:none";
	if(!$s_di) $s_di='1';
	if($s_di=='1') $s_dis1 = "display:inline"; else	$s_dis1 = "display:none";
	if($s_di=='2') $s_dis2 = "display:inline"; else	$s_dis2 = "display:none";
	if($s_di=='3') $s_dis3 = "display:inline"; else	$s_dis3 = "display:none";
	if($s_di=='4') $s_dis4 = "display:inline"; else	$s_dis4 = "display:none";
	if($s_di=='5') $s_dis5 = "display:inline"; else	$s_dis5 = "display:none";
	if($s_di=='6') $s_dis6 = "display:inline"; else	$s_dis6 = "display:none";
?>
<!DOCTYPE HTML>
<html>
 <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <title><?=$doc_title?></title>
	<link rel="shortcut icon" href="<?=$cms_url?>images/cms.ico">
	<link rel="stylesheet" href="<?=$cms_url?>common/cms.css" type="text/css">
	<script src="../common/global.js"></script>
	<script src="../common/config.js"></script>
	<script src="../include/calendar/calendar.js"></script>
	<script type="text/javascript">
		<!--
		var checkflag="false";

		function checkAll(){
			 var form=document.form1;
			 if(checkflag=="false"){
					for(var j=0; j<form.elements.length; j++){
						 if(form.elements[j].name=="mnum[]"){
								if(form.elements[j].checked==false)
									 form.elements[j].checked=true;
								}
						 }
						 checkflag="true";
			 } else if(checkflag="true"){
					for(var j=0; j<form.elements.length; j++){
						 if(form.elements[j].name=="mnum[]"){
								if(form.elements[j].checked==true)
									 form.elements[j].checked=false;
							}
					 }
					 checkflag="false";
			 }
		}
		function chk_sel(str,no){
			sel_frame.location.href = "sel_frame.php?tmp="+str+"&no="+no;
		}

		function today_(){
			var form = document.st_sh_frm;
			form.s_date.value = "<?=date('Y-m-d')?>";
			form.e_date.value = "<?=date('Y-m-d')?>";
		}
		function to_del_(){
			var form = document.st_sh_frm;
			form.s_date.value = "";
			form.e_date.value = "";
		}
		function imgOver(img_src){
			var div_n = document.getElementById('p_img_div');
			var img_n = document.getElementById('p_img');
			img_n.src=img_src;
			div_n.style.display="block";
		}
		function imgOut(img_src){
			var div_n = document.getElementById('p_img_div');
			div_n.style.display="none";
		}
		function edit_pop(ref,name){
			var window_left = (screen.width-640)/2;
			var window_top = (screen.height-480)/2;
			window.open(ref,name,'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
		}
		function prOver(obj0,obj1,obj2,obj3,obj4,obj5){
			var div_p = document.getElementById('p_pr_div');

			if(obj0==5){
				document.getElementById('p_pr_div').innerHTML = "<table border=0 width=100% bgcolor=white><tr><td style='padding:0 0 0 10px;'>출     고     가 :</td><td  style='padding:0 10px 0 0;' align='right'>"+obj1+" 원</td></tr><tr><td style='padding:0 0 0 10px;'>예 상 수 수 료 :</td><td style='padding:0 10px 0 0;' align='right'>"+obj2+" 원</td></tr><tr><td style='padding:0 0 0 10px;'>정산 예정금액 :</td><td style='padding:0 10px 0 0;' align='right'>"+obj3+" 원</td></tr><tr><td style='padding:0 0 0 10px;'>입     고     가 :</td><td style='padding:0 10px 0 0;' align='right'>"+obj4+" 원</td></tr><tr><td style='padding:0 0 0 10px;'>예상 판매이익 :</td><td style='padding:0 10px 0 0;' align='right'>"+obj5+" 원</td></tr></table>";
			}else{
				document.getElementById('p_pr_div').innerHTML = "<table border=0 width=100% bgcolor=white><tr><td style='padding:0 0 0 10px;'> - </td><td  style='padding:0 10px 0 0;' align='right'>  </td></tr><tr><td style='padding:0 0 0 10;'> - </td><td style='padding:0 10px 0 0;' align='right'>  </td></tr><tr><td style='padding:0 0 0 10px;'> - </td><td style='padding:0 10px 0 0;' align='right'>  </td></tr><tr><td style='padding:0 0 0 10px;'>입     고     가 :</td><td style='padding:0 10px 0 0;' align='right'>"+obj4+" 원</td></tr><tr><td style='padding:0 0 0 10px;'> - </td><td style='padding:0 10px 0 0;' align='right'>  </td></tr></table>";
			}
			div_p.style.display="block";
		}
		function prOut(){
			var div_p = document.getElementById('p_pr_div');
			div_p.style.display="none";
		}
		//-->
	</script>
 </head>

 <body>
 <div id="wrap">
	<div id="header">
	<? include '../include/t_menu.php'; ?>
	</div>
	<div id="content">
		<?
			if(!$_SESSION['p_id']){
		?>
		<div style="width:1080px; height:650px; text-align:center; display: table-cell; vertical-align: middle;">
			<p>로그인 정보가 없습니다. 다시 로그인하여 주십시요!</p>
			<input type="button" value="로그인" class="sub_bt1" onclick="location.href='<?=$cms_url?>member/login_form.php';">
			<input type="button" value=" 닫 기 " class="sub_bt1" onclick="window.self.close()">
		</div>
		<? }else{?>
		<div>
		<!-- =================== Head end / body start =================== -->
			<?
				include "stock.php";
				include "storage.php";
			?>
		<!-- =================== body end / Foot start-- =================== -->
		</div>
		<? } ?>
	</div>
 </div>
 <div id="footwrap">
	<div id="footer"><?=$doc_copyright?></div>
 </div>
 </body>
</html>
