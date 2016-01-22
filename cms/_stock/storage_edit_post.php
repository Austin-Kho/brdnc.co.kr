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


	$seq_num=$_REQUEST['seq_num'];


	// form(form1-post)에서 받은 데이터
	$division= $_POST['division'];
	$st_date = $_POST['st_date'];
	$account = explode("-",$_POST['account']);
	$worker = $_SESSION['p_name'];
	$classify = $_POST['classify'];

	$category_1 = $_POST['category_1'];
	$brand_1 = $_POST['brand_1'];
	$style_1 =  strtoupper($_POST['style_1']);
	$color_1 = strtoupper($_POST['color_1']);
	$comp_1 = strtoupper($_POST['comp_1']);
	$qty_1 = $_POST['qty_1'];
	$price_in_1 = $_POST['price_in_1'];
	$set_price_1 = $_POST['set_price_1'];
	$price_out_1 = $_POST['price_out_1'];
	$p_img_1 = $_FILES['p_img_1'];
	$img_1=explode(".",$p_img_1[name]);
	if($p_img_1) move_uploaded_file($p_img_1[tmp_name],"p_img/".$style_1."_".$color_1.".".$img_1[1]);


	############# 회원 정보 테이블에 입력 값을 등록한다. #############

	$query1="UPDATE cms_stock_main SET division='$division',
																	classify='$classify',
																	category='$category_1',
																	brand='$brand_1',
																	style='$style_1',
																	color='$color_1',
																	comp='$comp_1',
																	qty='$qty_1',
																	price_in='$price_in_1',
																	set_price='$set_price_1',
																	price_out='$price_out_1',
																	accounts='$account[1]',
																	worker='$worker',
																	st_date='$st_date'
						               WHERE seq_num='$seq_num' ";
	$result1=mysql_query($query1, $connect);
	if(!$result1) err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.

	echo ("<script>
					window.alert('정상적으로 상품입출고 정보가 수정 되었습니다!');
					opener.location.reload();
					self.close();
				 </script>");
?>
