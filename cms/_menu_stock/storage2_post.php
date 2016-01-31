<?
	// 데이터베이스 연결 정보와 기타 설정
	include '../php/config.php';
	// 각종 유틸 함수
	include '../php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?

	$division=2;

	// form(form1-post)에서 받은 데이터
	$classify_1 = $_POST['classify_1'];
	$classify_2 = $_POST['classify_2'];
	$classify_3 = $_POST['classify_3'];
	$classify_4 = $_POST['classify_4'];
	$classify_5 = $_POST['classify_5'];
	$classify_6 = $_POST['classify_6'];
	$classify_7 = $_POST['classify_7'];
	$classify_8 = $_POST['classify_8'];
	$classify_9 = $_POST['classify_9'];
	$classify_10 = $_POST['classify_10'];

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

	$style_1 = $_POST['style_1'];
	$style_2 = $_POST['style_2'];
	$style_3 = $_POST['style_3'];
	$style_4 = $_POST['style_4'];
	$style_5 = $_POST['style_5'];
	$style_6 = $_POST['style_6'];
	$style_7 = $_POST['style_7'];
	$style_8 = $_POST['style_8'];
	$style_9 = $_POST['style_9'];
	$style_10 = $_POST['style_10'];

	$color_1 = $_POST['color_1'];
	$color_2 = $_POST['color_2'];
	$color_3 = $_POST['color_3'];
	$color_4 = $_POST['color_4'];
	$color_5 = $_POST['color_5'];
	$color_6 = $_POST['color_6'];
	$color_7 = $_POST['color_7'];
	$color_8 = $_POST['color_8'];
	$color_9 = $_POST['color_9'];
	$color_10 = $_POST['color_10'];

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

	$account_out_1 = explode("-",$_POST['account_out_1']);
	$account_out_2 = explode("-",$_POST['account_out_2']);
	$account_out_3 = explode("-",$_POST['account_out_3']);
	$account_out_4 = explode("-",$_POST['account_out_4']);
	$account_out_5 = explode("-",$_POST['account_out_5']);
	$account_out_6 = explode("-",$_POST['account_out_6']);
	$account_out_7 = explode("-",$_POST['account_out_7']);
	$account_out_8 = explode("-",$_POST['account_out_8']);
	$account_out_9 = explode("-",$_POST['account_out_9']);
	$account_out_10 = explode("-",$_POST['account_out_10']);

	$st_date = $_POST['st_date'];
	$worker = $_SESSION['p_name'];


	############# 재고 정보 테이블에 입력 값을 등록한다. #############

	if($style_1){
		 $query1="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)

						  VALUES('$division', '$classify_1', '$category_1', '$brand_1', '$style_1', '$color_1', '$qty_1', '$price_in_1', '$set_price_1', '$price_out_1', '$account_out_1[1]', '$worker', '$st_date')";
		 $result1=mysql_query($query1, $connect);
		 if(!$result1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_2){
		 $query2="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_2', '$category_2', '$brand_2', '$style_2', '$color_2', '$qty_2', '$price_in_2', '$set_price_2', '$price_out_2', '$account_out_2[1]', '$worker', '$st_date')";
		 $result2=mysql_query($query2, $connect);
		 if(!$result2) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_3){
		 $query3="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_3', '$category_3', '$brand_3', '$style_3', '$color_3', '$qty_3', '$price_in_3', '$set_price_3', '$price_out_3', '$account_out_3[1]', '$worker', '$st_date')";
		 $result3=mysql_query($query3, $connect);
		 if(!$result3) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_4){
		 $query4="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_4', '$category_4', '$brand_4', '$style_4', '$color_4', '$qty_4', '$price_in_4', '$set_price_4', '$price_out_4', '$account_out_4[1]', '$worker', '$st_date')";
		 $result4=mysql_query($query4, $connect);
		 if(!$result4) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_5){
		 $query5="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_5', '$category_5', '$brand_5', '$style_5', '$color_5', '$qty_5', '$price_in_5', '$set_price_5', '$price_out_5', '$account_out_5[1]', '$worker', '$st_date')";
		 $result5=mysql_query($query5, $connect);
		 if(!$result5) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_6){
		 $query6="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_6', '$category_6', '$brand_6', '$style_6', '$color_6', '$qty_6', '$price_in_6', '$set_price_6', '$price_out_6', '$account_out_6[1]', '$worker', '$st_date')";
		 $result6=mysql_query($query6, $connect);
		 if(!$result6) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_7){
		 $query7="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_7', '$category_7', '$brand_7', '$style_7', '$color_7', '$qty_7', '$price_in_7', '$set_price_7', '$price_out_7', '$account_out_7[1]', '$worker', '$st_date')";
		 $result7=mysql_query($query7, $connect);
		 if(!$result7) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_8){
		 $query8="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_8', '$category_8', '$brand_8', '$style_8', '$color_8', '$qty_8', '$price_in_8', '$set_price_8', '$price_out_8', '$account_out_8[1]', '$worker', '$st_date')";
		 $result8=mysql_query($query8, $connect);
		 if(!$result8) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_9){
		 $query9="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_9', '$category_9', '$brand_9', '$style_9', '$color_9', '$qty_9', '$price_in_9', '$set_price_9', '$price_out_9', '$account_out_9[1]', '$worker', '$st_date')";
		 $result9=mysql_query($query9, $connect);
		 if(!$result9) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}
	if($style_10){
		 $query10="INSERT INTO `cms_stock_main` (`division`, `classify`, `category`, `brand`, `style`, `color`, `qty`, `price_in`, `set_price`, `price_out`, `accounts`, `worker`, `st_date`)
						  VALUES('$division', '$classify_10', '$category_10', '$brand_10', '$style_10', '$color_10', '$qty_10', '$price_in_10', '$set_price_10', '$price_out_10', '$account_out_10[1]', '$worker', '$st_date')";
		 $result10=mysql_query($query10, $connect);
		 if(!$result10) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
	}

	echo ("<script>
					window.alert('정상적으로 상품출고 정보가 등록 되었습니다!');
					location.href='stock_main2.php';
				 </script>");
?>
