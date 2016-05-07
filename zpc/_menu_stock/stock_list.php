<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸리티 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();

	// 이름과 아이디에 해당하는 세션이 있는지 확인
	if(!isset($_SESSION[p_id])||!isset($_SESSION[p_name])){
		err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
	}

	$fn = $_REQUEST['fn'];
	$category = $_REQUEST['category'];
	$brand = $_REQUEST['brand'];
	$_search = $_REQUEST['_search'];

	// echo $category." / ".$brand." / ".$_search." / ".$total_bnum;

	function page_avg_st($total_post,$page_num, $index_num,$start){       //(1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 3. 시작페이지)
			 if(!$start) $start = 1;                                      // 현재 페이지
			 $total_pages = ceil($total_post/$index_num);						 // 총 페이지 수
			 $pages=$total_pages;
			 if($pages>$page_num) $pages = $page_num;

			 $a=ceil($start/$page_num)*$page_num-($page_num-1);
			 $b=$total_pages;
			 if($b>($a+$page_num-1)) $b=$a+$page_num-1;

			 $pre=$page_num*ceil($start/$page_num)-($page_num*2)+1;
			 $nex=ceil($start/$page_num)*$page_num+1;
			 if($pre<1) $pre =1;
			 if($nex>$total_pages) $nex =$total_pages;

			 $category=$_REQUEST['category'];
			 $brand=urlencode($_REQUEST['brand']);
			 $_search = $_REQUEST['_search'];
			 $fn=$_REQUEST['fn'];
			 $frm=$_REQUEST['frm'];

			 if($start==1 ){
					echo "<a href='#'><img src='http://cigiko.cafe24.com/cms/images/btn_fir_2.gif' width=14 border=0></a>";
			 } else {
					echo "<a href='$_SERVER[PHP_SELF]?start=1&category=$category&brand=$brand&_search=$_search&fn=$fn&frm=$frm'><img src='http://cigiko.cafe24.com/cms/images/btn_fir_1.gif' width=14 border=0></a>";
			 }
			 if($start<=$page_num){
					echo "<a href='#'><img src='http://cigiko.cafe24.com/cms/images/btn_pre_2.gif' width=14 border=0></a> &nbsp;";
			 } else {
					echo "<a href='$_SERVER[PHP_SELF]?start=$pre&category=$category&brand=$brand&_search=$_search&fn=$fn&frm=$frm'><img src='http://cigiko.cafe24.com/cms/images/btn_pre_1.gif' width=14 border=0></a> &nbsp;";
			 }
		   for($i=$a; $i<=$b; $i++){
			 		if($i==$start){
			 			 echo " <font color='#ff3300'><b>$i</b></font> ";
			 	  } else {
			 			 echo " <a href='$_SERVER[PHP_SELF]?start=$i&category=$category&brand=$brand&_search=$_search&fn=$fn&frm=$frm'>[$i]</a> ";
			 	  }
			 }
			 if($start<=ceil($total_pages/$page_num)*$page_num-$page_num){
					echo "&nbsp; <a href='$_SERVER[PHP_SELF]?start=$nex&category=$category&brand=$brand&_search=$_search&fn=$fn&frm=$frm'><img src='http://cigiko.cafe24.com/cms/images/btn_nex_1.gif' width=14 border=0></a>";
			 } else {
					echo "&nbsp; <a href='#'><img src='http://cigiko.cafe24.com/cms/images/btn_nex_2.gif' width=14 border=0></a>";
			 }
			 if($start==$total_pages||$total_pages==0){
					echo "<a href='#'><img src='http://cigiko.cafe24.com/cms/images/btn_las_2.gif' width=14 border=0></a>";
			 } else {
					echo "<a href='$_SERVER[PHP_SELF]?start=$total_pages&category=$category&brand=$brand&_search=$_search&fn=$fn&frm=$frm'><img src='http://cigiko.cafe24.com/cms/images/btn_las_1.gif' width=14 border=0></a>";
			 }
		}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?$doc_title?></title>
	<link rel="stylesheet" href="../common/cms.css">
	<script language="JavaScript" src="../common/global.js"></script>
	<script type="text/javascript">
	<!--


		function value_put(obj1,obj2,obj3,obj4,obj5,obj6,obj7,obj8){
			 var fn = '<?=$fn?>';
			 var form_obj = opener.document.<?=$frm?>;

			 if(fn==1){
					form_obj.category_1.value=obj1;
					form_obj.brand_1.value=obj2;
					form_obj.style_1.value=obj3;
					form_obj.color_1.value=obj4;
					form_obj.comp_1.value=obj5;
					form_obj.stock_1.value=obj6;
					form_obj.price_in_1.value=obj7;
					form_obj.set_price_1.value=obj8;
			 }
			 if(fn==2){
					form_obj.category_2.value=obj1;
					form_obj.brand_2.value=obj2;
					form_obj.style_2.value=obj3;
					form_obj.color_2.value=obj4;
					form_obj.comp_2.value=obj5;
					form_obj.stock_2.value=obj6;
					form_obj.price_in_2.value=obj7;
					form_obj.set_price_2.value=obj8;
			 }
			 if(fn==3){
					form_obj.category_3.value=obj1;
					form_obj.brand_3.value=obj2;
					form_obj.style_3.value=obj3;
					form_obj.color_3.value=obj4;
					form_obj.comp_3.value=obj5;
					form_obj.stock_3.value=obj6;
					form_obj.price_in_3.value=obj7;
					form_obj.set_price_3.value=obj8;
			 }
			 if(fn==4){
					form_obj.category_4.value=obj1;
					form_obj.brand_4.value=obj2;
					form_obj.style_4.value=obj3;
					form_obj.color_4.value=obj4;
					form_obj.comp_4.value=obj5;
					form_obj.stock_4.value=obj6;
					form_obj.price_in_4.value=obj7;
					form_obj.set_price_4.value=obj8;
			 }
			 if(fn==5){
					form_obj.category_5.value=obj1;
					form_obj.brand_5.value=obj2;
					form_obj.style_5.value=obj3;
					form_obj.color_5.value=obj4;
					form_obj.comp_5.value=obj5;
					form_obj.stock_5.value=obj6;
					form_obj.price_in_5.value=obj7;
					form_obj.set_price_5.value=obj8;
			 }
			 if(fn==6){
					form_obj.category_6.value=obj1;
					form_obj.brand_6.value=obj2;
					form_obj.style_6.value=obj3;
					form_obj.color_6.value=obj4;
					form_obj.comp_6.value=obj5;
					form_obj.stock_6.value=obj6;
					form_obj.price_in_6.value=obj7;
					form_obj.set_price_6.value=obj8;
			 }
			 if(fn==7){
					form_obj.category_7.value=obj1;
					form_obj.brand_7.value=obj2;
					form_obj.style_7.value=obj3;
					form_obj.color_7.value=obj4;
					form_obj.comp_7.value=obj5;
					form_obj.stock_7.value=obj6;
					form_obj.price_in_7.value=obj7;
					form_obj.set_price_7.value=obj8;
			 }
			 if(fn==8){
					form_obj.category_8.value=obj1;
					form_obj.brand_8.value=obj2;
					form_obj.style_8.value=obj3;
					form_obj.color_8.value=obj4;
					form_obj.comp_8.value=obj5;
					form_obj.stock_8.value=obj6;
					form_obj.price_in_8.value=obj7;
					form_obj.set_price_8.value=obj8;
			 }
			 if(fn==9){
					form_obj.category_9.value=obj1;
					form_obj.brand_9.value=obj2;
					form_obj.style_9.value=obj3;
					form_obj.color_9.value=obj4;
					form_obj.comp_9.value=obj5;
					form_obj.stock_9.value=obj6;
					form_obj.price_in_9.value=obj7;
					form_obj.set_price_9.value=obj8;
			 }
			 if(fn==10){
					form_obj.category_10.value=obj1;
					form_obj.brand_10.value=obj2;
					form_obj.style_10.value=obj3;
					form_obj.color_10.value=obj4;
					form_obj.comp_10.value=obj5;
					form_obj.stock_10.value=obj6;
					form_obj.price_in_10.value=obj7;
					form_obj.set_price_10.value=obj8;
			 }
			 self.close();
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
	//-->
	</script>
</head>

<body leftmargin='0' marginwidth='0' topmargin='0' marginheight='0'>
<div id="p_img_div" style="position:absolute; left:281px; top:11px; width:126px; height:126px; z-index:1; display:none; border:1px solid #9EACC0;">
	<img id="p_img" src="" width="126" height="126" >
</div>
	<table border='0' cellpadding='0' cellspacing='0' width='100%' height="100%">
	<tr>
		<td align="center" style="border-width: 2 0 0 0; border-color:#C5FAC9; border-style: solid; padding:6 0 0 0px">
			<table border="0" width="96%" height="94%" align="center" valign="middle" bgcolor="#96ABE5">
			<tr height="80" bgcolor="#D9EAF8">
				<td align="center" height="32" background="../img/bg.jpg">
				<font color="#4C63BD" style="font-size:11pt"><b>재고(STOCK) 리스트</b></font>
				</td>
			</tr>
			<tr bgcolor="ffffff">
				<td style="padding:13 0 0 0px">
				<table border="0" align="center" width="96%" height="100%" cellspacing="0" cellpadding="0">
				<tr height="10">
					<td></td>
				</tr>
				<tr height="28">
					<td>
					<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
					<tr align="center" height="35">
						<td width="100%" bgcolor="#EAEAEA" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;" colspan="6">
						<form name="form1" action="<?=$_SERVER['PHP_SELF']?>">
						<input type="hidden" name="fn" value="<?=$fn;?>">
						<input type="hidden" name="frm" value="<?=$frm?>">
						<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
							<tr>
								<td style="padding:0 0 0 10;"> 1차 분류 : </td>
								<td align="left">
									<?
										$qry="select classify from cms_stock_1st_classify ORDER BY no";
										$rst=mysql_query($qry, $connect);
									?>
									<select name="category" OnChange="submit();" style="width:110">
										<option value="" <? if(!$category) echo "selected"; ?>> 카테고리
									<?
										while($rs=mysql_fetch_array($rst)){
									?>
										<option value="<?=$rs[classify];?>" <? if($rs[classify]==$category) echo "selected"; ?> ><?=$rs[classify];?>
									<?
										 }
									?>
									</select>
								</td>
								<td> 2차 분류 : </td>
								<td align="left">
									<?
										$qry1="select classify from cms_stock_2nd_classify where 1st_classify = '$category' ORDER BY no";
										$rst1=mysql_query($qry1, $connect);
									?>
									<select name="brand" OnChange="submit();" style="width:110">
										<option value="" <? if(!$brand) echo "selected"; ?>> 브랜드
									<?
										while($rs1=mysql_fetch_array($rst1)){
									?>
										<option value="<?=$rs1[classify];?>" <? if($rs1[classify]==$brand) echo "selected"; ?> ><?=stripslashes($rs1[classify]);?>
									<?
										 }
									?>
									</select>
								</td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan="6" align="center" style="padding:8 0 8 0px">
							<input type="text" name="_search" size="30" class="inputStyle2" style="height:20px" onmouseover="cngClass(this,'inputStyle22')" onmouseout="cngClass(this,'inputStyle2');">
							<input type="button" value=" 검 색 " onclick="submit();" class= "inputStyle1">
						</td>
					</tr>
				<!-- </table>
				<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0"> -->
					<tr align="center" height="30" bgcolor="#EAEAEA" >
						<td width="12%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">이미지</td>
						<td width="12%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">카테고리</td>
						<td width="22%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">브랜드</td>
						<td width="24%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">스타일</td>
						<td width="20%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">컬 러</td>
						<td width="10%" style="border-width: 1 0 1 0; border-color:#CFCFCF; border-style: solid;">재고수</td>
					</tr>
					<?
						// $add_where="";

						$add_where.="where 1=1";

						if($category) $add_where.=" AND category='$category' ";
						if($brand) $add_where.=" AND brand='$brand' ";
						if($_search) $add_where.=" AND (style like '%$_search%' or color like '%$_search%') ";
/*
						$query = "SELECT seq_num, category, brand, style, color,price_in, set_price, st_date, SUM(qty) AS st_qty
														FROM (SELECT seq_num, category, brand, style, color,price_in, set_price, st_date,
																				( CASE division WHEN '1' THEN qty ELSE (- qty) END )
														AS qty FROM cms_stock_main) AS cms_stock_main $add_where
														GROUP BY style, color having st_qty>0 "; */

						$query="select * from cms_stock_main $add_where";
						$result=mysql_query($query, $connect);
						$total_bnum=mysql_num_rows($result);     // 총 게시물 수   11111111111111111111
						mysql_free_result($result);

						$page=$_GET['page'];
						$gb=$_REQUEST['gb'];

						$index_num = 8;                 // 한 페이지 표시할 목록 개수 22222222222222
						$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
						$start=$_REQUEST['start'];
						if(!$start) $start = 1;              // 현재페이지 444444444
						$s = ($start-1)*$index_num;
						$e = $index_num;

						/*
						$query1 = "SELECT seq_num, category, brand, style, color,comp,price_in, set_price, st_date, SUM(qty) AS st_qty
														FROM (SELECT seq_num, category, brand, style, color,comp,price_in, set_price, st_date,
																				( CASE division WHEN '1' THEN qty ELSE (- qty) END )
														AS qty FROM main_stock) AS main_stock $add_where
														GROUP BY style, color HAVING st_qty>0 ORDER BY st_date DESC, seq_num DESC LIMIT $s, $e";

						*/

						$query1="SELECT *, SUM(qty) AS st_qty FROM cms_stock_main $add_where AND division='1' GROUP BY style, color ORDER BY seq_num DESC LIMIT $s, $e";


						// $query1 = "select *, sum(qty) as st_qty from cms_stock_main where division='1' group by style, color";
						$result1=mysql_query($query1, $connect);
						for($i=0; $rows1=mysql_fetch_array($result1); $i++){
					?>
					<tr align="center">
						<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
						</form>
						<td class="line-n" style="padding:0 0 0 3;"><img src="p_img/<?=$rows1[style]?>_<?=$rows1[color]?>.jpg" onError="this.src='p_img/no_image.jpg';" height="26" border="0" onmouseover="imgOver(this.src)" onmouseout="imgOut(this.src)"></td>
						<td class="line-n">
							<a href="javascript:" onclick="value_put('<?=$rows1[category]?>','<?=$rows1[brand]?>','<?=$rows1[style]?>','<?=$rows1[color]?>','<?=$rows1[comp]?>','<?=$rows1[st_qty]?>','<?=$rows1[price_in]?>','<?=$rows1[set_price]?>')"><?=rg_cut_string($rows1[category],6,"..")?></a>
						</td>
						<td align="center" class="line-n">
							<a href="javascript:" onclick="value_put('<?=$rows1[category]?>','<?=$rows1[brand]?>','<?=$rows1[style]?>','<?=$rows1[color]?>','<?=$rows1[comp]?>','<?=$rows1[st_qty]?>','<?=$rows1[price_in]?>','<?=$rows1[set_price]?>')"><?=rg_cut_string(stripslashes($rows1[brand]),6,"..")?></a>
						</td>
						<td align="left" style="border-width: 0 0 1 0; border-color:#E1E1E1; border-style: solid;">
							<a href="javascript:" onclick="value_put('<?=$rows1[category]?>','<?=$rows1[brand]?>','<?=$rows1[style]?>','<?=$rows1[color]?>','<?=$rows1[comp]?>','<?=$rows1[st_qty]?>','<?=$rows1[price_in]?>','<?=$rows1[set_price]?>')"><?=rg_cut_string(stripslashes($rows1[style]),18,"..")?></a>
						</td>
						<td style="border-width: 0 0 1 0; border-color:#E1E1E1; border-style: solid;">
							<a href="javascript:" onclick="value_put('<?=$rows1[category]?>','<?=$rows1[brand]?>','<?=$rows1[style]?>','<?=$rows1[color]?>','<?=$rows1[comp]?>','<?=$rows1[st_qty]?>','<?=$rows1[price_in]?>','<?=$rows1[set_price]?>')"><?=rg_cut_string(stripslashes($rows1[color]),10,"..")?></a>
						</td>
						<td style="border-width: 0 0 1 0; border-color:#E1E1E1; border-style: solid;"><?=number_format($rows1[st_qty])?>&nbsp;</td>
					</tr>
					<?
						}
						mysql_free_result($result1);
					?>
					</table>
					</td>
				</tr>
				<tr>
					<td valign="top" align="center">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="36" align="center">
							<?
								$url="2nd_classify.php?gb=1";
								page_avg_st($total_bnum,$page_num, $index_num,$start);
								//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
							?>
						</td>
					</tr>
					</table>
					</td>
				</tr>
				</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</body>
</html>
