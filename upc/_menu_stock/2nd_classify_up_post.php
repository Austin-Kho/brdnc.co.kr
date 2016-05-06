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

	// form(form1-post)에서 받은 데이터
	$category= $_REQUEST['category'];
	$brand = $_REQUEST['brand'];	
	$note = $_POST['note'];
	$fn = $_REQUEST['fn'];

	$brand = strtoupper(addslashes($brand)); // - 소문자를 대문대로 변환하여 반환한다.
	$category = strtoupper(addslashes($category)); // - 소문자를 대문대로 변환하여 반환한다.

	
	####### 같은 정보 존재 여부 확인 #########
	$query="select * from cms_stock_2nd_classify where 1st_classify = '$category' AND classify='$brand'";
	$result=mysql_query($query, $connect);
	$total_num=mysql_num_rows($result);

	if($total_num){            // 같은 정보가 있을 때 이전 페이지로 옮김
		echo ("<script>
						window.alert('중분류 정보 중 중복된 값이 있습니다!');
						history.go(-1);
					 </script>");
		exit;
	} else {

		############# 회원 정보 테이블에 입력 값을 등록한다. #############
		$query="INSERT INTO `cms_stock_2nd_classify` (`1st_classify`, `classify` ,`note` ,`reg_date`)
						 
							 VALUES('$category' ,'$brand','$note' ,now())";
		$result=mysql_query($query, $connect);

		// 저장 과정에서 오류가 생기면

		if(!$result){
			err_msg('데이터베이스 오류가 발생하였습니다.');     // util.php 파일에 선언한 err_msg()함수 호출, 메세지 출력 후 이전페이지로.
		} else {
			echo ("<script>
							var category = encodeURIComponent('$category');
							var brand = encodeURIComponent('$brand');
							var fn = '$fn';
							window.alert('정상적으로 중분류 정보가 등록 되었습니다!');							
							history.go(-2);
						 </script>");
		}
	}
?>
