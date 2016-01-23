<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?

	$division=1;

	// form(form1-post)에서 받은 데이터
	$st_date = $_POST['st_date'];
	$account_in = explode("-",$_POST['account_in']);
	$worker = $_SESSION['p_name'];
	$classify = $_POST['classify'];

	$category_1 = $_POST['category_1'];
	$category_2 = $_POST['category_2'];
	$category_3 = $_POST['category_3'];
	$category_4 = $_POST['category_4'];
	$category_5 = $_POST['category_5'];
	$category_6 = $_POST['category_6'];
	$category_7 = $_POST['category_7'];
	$category_8 = $_POST['category_8'];
	$category_9 = $_POST['category_9'];
	$category_10 = $_POST['category_10'];

	$brand_1 = addslashes($_POST['brand_1']);
	$brand_2 = addslashes($_POST['brand_2']);
	$brand_3 = addslashes($_POST['brand_3']);
	$brand_4 = addslashes($_POST['brand_4']);
	$brand_5 = addslashes($_POST['brand_5']);
	$brand_6 = addslashes($_POST['brand_6']);
	$brand_7 = addslashes($_POST['brand_7']);
	$brand_8 = addslashes($_POST['brand_8']);
	$brand_9 = addslashes($_POST['brand_9']);
	$brand_10 = addslashes($_POST['brand_10']);

	$style_1 =  strtoupper($_POST['style_1']);
	$style_2 = strtoupper($_POST['style_2']);
	$style_3 = strtoupper($_POST['style_3']);
	$style_4 = strtoupper($_POST['style_4']);
	$style_5 = strtoupper($_POST['style_5']);
	$style_6 = strtoupper($_POST['style_6']);
	$style_7 = strtoupper($_POST['style_7']);
	$style_8 = strtoupper($_POST['style_8']);
	$style_9 = strtoupper($_POST['style_9']);
	$style_10 = strtoupper($_POST['style_10']);

	$color_1 = strtoupper($_POST['color_1']);
	$color_2 = strtoupper($_POST['color_2']);
	$color_3 = strtoupper($_POST['color_3']);
	$color_4 = strtoupper($_POST['color_4']);
	$color_5 = strtoupper($_POST['color_5']);
	$color_6 = strtoupper($_POST['color_6']);
	$color_7 = strtoupper($_POST['color_7']);
	$color_8 = strtoupper($_POST['color_8']);
	$color_9 = strtoupper($_POST['color_9']);
	$color_10 = strtoupper($_POST['color_10']);

	$comp_1 = strtoupper($_POST['comp_1']);
	$comp_2 = strtoupper($_POST['comp_2']);
	$comp_3 = strtoupper($_POST['comp_3']);
	$comp_4 = strtoupper($_POST['comp_4']);
	$comp_5 = strtoupper($_POST['comp_5']);
	$comp_6 = strtoupper($_POST['comp_6']);
	$comp_7 = strtoupper($_POST['comp_7']);
	$comp_8 = strtoupper($_POST['comp_8']);
	$comp_9 = strtoupper($_POST['comp_9']);
	$comp_10 = strtoupper($_POST['comp_10']);

	$qty_1 = $_POST['qty_1'];
	$qty_2 = $_POST['qty_2'];
	$qty_3 = $_POST['qty_3'];
	$qty_4 = $_POST['qty_4'];
	$qty_5 = $_POST['qty_5'];
	$qty_6 = $_POST['qty_6'];
	$qty_7 = $_POST['qty_7'];
	$qty_8 = $_POST['qty_8'];
	$qty_9 = $_POST['qty_9'];
	$qty_10 = $_POST['qty_10'];

	$price_in_1 = $_POST['price_in_1'];
	$price_in_2 = $_POST['price_in_2'];
	$price_in_3 = $_POST['price_in_3'];
	$price_in_4 = $_POST['price_in_4'];
	$price_in_5 = $_POST['price_in_5'];
	$price_in_6 = $_POST['price_in_6'];
	$price_in_7 = $_POST['price_in_7'];
	$price_in_8 = $_POST['price_in_8'];
	$price_in_9 = $_POST['price_in_9'];
	$price_in_10 = $_POST['price_in_10'];

	$set_price_1 = $_POST['set_price_1'];
	$set_price_2 = $_POST['set_price_2'];
	$set_price_3 = $_POST['set_price_3'];
	$set_price_4 = $_POST['set_price_4'];
	$set_price_5 = $_POST['set_price_5'];
	$set_price_6 = $_POST['set_price_6'];
	$set_price_7 = $_POST['set_price_7'];
	$set_price_8 = $_POST['set_price_8'];
	$set_price_9 = $_POST['set_price_9'];
	$set_price_10 = $_POST['set_price_10'];

	$price_out_1 = $_POST['price_out_1'];
	$price_out_2 = $_POST['price_out_2'];
	$price_out_3 = $_POST['price_out_3'];
	$price_out_4 = $_POST['price_out_4'];
	$price_out_5 = $_POST['price_out_5'];
	$price_out_6 = $_POST['price_out_6'];
	$price_out_7 = $_POST['price_out_7'];
	$price_out_8 = $_POST['price_out_8'];
	$price_out_9 = $_POST['price_out_9'];
	$price_out_10 = $_POST['price_out_10'];

	$p_img_1 = $_FILES['p_img_1'];
	$p_img_2 = $_FILES['p_img_2'];
	$p_img_3 = $_FILES['p_img_3'];
	$p_img_4 = $_FILES['p_img_4'];
	$p_img_5 = $_FILES['p_img_5'];
	$p_img_6 = $_FILES['p_img_6'];
	$p_img_7 = $_FILES['p_img_7'];
	$p_img_8 = $_FILES['p_img_8'];
	$p_img_9 = $_FILES['p_img_9'];
	$p_img_10 = $_FILES['p_img_10'];

	$img_1=explode(".",$p_img_1[name]);
	$img_2=explode(".",$p_img_2[name]);
	$img_3=explode(".",$p_img_3[name]);
	$img_4=explode(".",$p_img_4[name]);
	$img_5=explode(".",$p_img_5[name]);
	$img_6=explode(".",$p_img_6[name]);
	$img_7=explode(".",$p_img_7[name]);
	$img_8=explode(".",$p_img_8[name]);
	$img_9=explode(".",$p_img_9[name]);
	$img_10=explode(".",$p_img_10[name]);

	if($p_img_1) move_uploaded_file($p_img_1[tmp_name],"p_img/".$style_1."_".$color_1.".".$img_1[1]);
	if($p_img_2) move_uploaded_file($p_img_2[tmp_name],"p_img/".$style_2."_".$color_2.".".$img_2[1]);
	if($p_img_3) move_uploaded_file($p_img_3[tmp_name],"p_img/".$style_3."_".$color_3.".".$img_3[1]);
	if($p_img_4) move_uploaded_file($p_img_4[tmp_name],"p_img/".$style_4."_".$color_4.".".$img_4[1]);
	if($p_img_5) move_uploaded_file($p_img_5[tmp_name],"p_img/".$style_5."_".$color_5.".".$img_5[1]);
	if($p_img_6) move_uploaded_file($p_img_6[tmp_name],"p_img/".$style_6."_".$color_6.".".$img_6[1]);
	if($p_img_7) move_uploaded_file($p_img_7[tmp_name],"p_img/".$style_7."_".$color_7.".".$img_7[1]);
	if($p_img_8) move_uploaded_file($p_img_8[tmp_name],"p_img/".$style_8."_".$color_8.".".$img_8[1]);
	if($p_img_9) move_uploaded_file($p_img_9[tmp_name],"p_img/".$style_9."_".$color_9.".".$img_9[1]);
	if($p_img_10) move_uploaded_file($p_img_10[tmp_name],"p_img/".$style_10."_".$color_10.".".$img_10[1]);

	// echo $division."-".$classify."-".$category_1."-".$brand_1."-".$style_1."-".$color_1."-".$comp_1."-".$qty_1."-".$price_in_1."-".$set_price_1."-".$price_out_1."-".$account_in[1]."-".$worker."-".$st_date;

	############# 재고 정보 테이블에 입력 값을 등록한다. #############


	if($style_1){
		 $query1="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_1', '$brand_1', '$style_1', '$color_1', '$comp_1', '$qty_1', '$price_in_1', '$set_price_1', '$price_out_1', '$account_in[1]', '$worker', '$st_date')";
		 $result1=mysql_query($query1, $connect);
		 if(!$result1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_2){
		 $query2="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_2', '$brand_2', '$style_2', '$color_2', '$comp_2', '$qty_2', '$price_in_2', '$set_price_2', '$price_out_2', '$account_in[1]', '$worker', '$st_date')";
		 $result2=mysql_query($query2, $connect);
		 if(!$result2) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_3){
		 $query3="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_3', '$brand_3', '$style_3', '$color_3', '$comp_3', '$qty_3', '$price_in_3', '$set_price_3', '$price_out_3', '$account_in[1]', '$worker', '$st_date')";
		 $result3=mysql_query($query3, $connect);
		 if(!$result3) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_4){
		 $query4="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_4', '$brand_4', '$style_4', '$color_4', '$comp_4', '$qty_4', '$price_in_4', '$set_price_4', '$price_out_4', '$account_in[1]', '$worker', '$st_date')";
		 $result4=mysql_query($query4, $connect);
		 if(!$result4) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_5){
		 $query5="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_5', '$brand_5', '$style_5', '$color_5', '$comp_5', '$qty_5', '$price_in_5', '$set_price_5', '$price_out_5', '$account_in[1]', '$worker', '$st_date')";
		 $result5=mysql_query($query5, $connect);
		 if(!$result5) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_6){
		 $query6="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_6', '$brand_6', '$style_6', '$color_6', '$comp_6', '$qty_6', '$price_in_6', '$set_price_6', '$price_out_6', '$account_in[1]', '$worker', '$st_date')";
		 $result6=mysql_query($query6, $connect);
		 if(!$result6) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_7){
		 $query7="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_7', '$brand_7', '$style_7', '$color_7', '$comp_7', '$qty_7', '$price_in_7', '$set_price_7', '$price_out_7', '$account_in[1]', '$worker', '$st_date')";
		 $result7=mysql_query($query7, $connect);
		 if(!$result7) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_8){
		 $query8="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_8', '$brand_8', '$style_8', '$color_8', '$comp_8', '$qty_8', '$price_in_8', '$set_price_8', '$price_out_8', '$account_in[1]', '$worker', '$st_date')";
		 $result8=mysql_query($query8, $connect);
		 if(!$result8) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_9){
		 $query9="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					 VALUES('$division', '$classify', '$category_9', '$brand_9', '$style_9', '$color_9', '$comp_9', '$qty_9', '$price_in_9', '$set_price_9', '$price_out_9', '$account_in[1]', '$worker', '$st_date')";
		 $result9=mysql_query($query9, $connect);
		 if(!$result9) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_10){
		 $query10="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `comp`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
					  VALUES('$division', '$classify', '$category_10', '$brand_10', '$style_10', '$color_10', '$comp_10', '$qty_10', '$price_in_10', '$set_price_10', '$price_out_10', '$account_in[1]', '$worker', '$st_date')";
		 $result10=mysql_query($query10, $connect);
		 if(!$result10) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	echo ("<script>
					window.alert('정상적으로 상품입고 정보가 등록 되었습니다!');
					location.href='stock_main2.php';
			</script>");
?>
