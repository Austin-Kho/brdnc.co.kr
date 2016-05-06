<?php
	###### 데이터베이스 연결 ######
	// 데이터베이스 연결 정보와 기타 설정
	include 'cms/php/config.php';
	// 각종 유틸 함수
	include 'cms/php/util.php';
	// MySQL 연결
	$connect=dbconn();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
	ini_set("display_errors", "1");
	$mode = $_REQUEST[mode]; // 모드
	// $s_id = $_SESSION[speedmail_id]; //??

		if($mode =="ins" ) {
			$table_name=$_REQUEST['table_name']; // 테이블 명
			$table_name_qry=" `".$_REQUEST['table_name']."` "; // 테이블 명
			$deli = $_REQUEST['deli']; // 구분 자

			$colom1 = $_REQUEST['colom1'];
			$colom2 = $_REQUEST['colom2'];
			$colom3 = $_REQUEST['colom3'];
			$colom4 = $_REQUEST['colom4'];
			$colom5 = $_REQUEST['colom5'];
			$colom6 = $_REQUEST['colom6'];
			$colom7 = $_REQUEST['colom7'];
			$colom8 = $_REQUEST['colom8'];
			$colom9 = $_REQUEST['colom9'];
			$colom10 = $_REQUEST['colom10'];
			$colom11 = $_REQUEST['colom11'];
			$colom12 = $_REQUEST['colom12'];
			$colom13 = $_REQUEST['colom13'];
			$colom14 = $_REQUEST['colom14'];
			$colom15 = $_REQUEST['colom15'];
			$colom16 = $_REQUEST['colom16'];
			$colom17 = $_REQUEST['colom17'];
			$colom18 = $_REQUEST['colom18'];
			$colom19 = $_REQUEST['colom19'];
			$colom20 = $_REQUEST['colom20'];
			$colom21 = $_REQUEST['colom21'];
			$colom22 = $_REQUEST['colom22'];
			$colom23 = $_REQUEST['colom23'];
			$colom24 = $_REQUEST['colom24'];
			$colom25 = $_REQUEST['colom25'];
			$colom26 = $_REQUEST['colom26'];

			$db_file = $_REQUEST[db_file]; // 업로드 파일


			if($colom1) $field_name = "  `".$colom1."` ";
			if($colom2) $field_name.= ", `".$colom2."` ";
			if($colom3) $field_name.= ", `".$colom3."` ";
			if($colom4) $field_name.= ", `".$colom4."` ";
			if($colom5) $field_name.= ", `".$colom5."` ";
			if($colom6) $field_name.= ", `".$colom6."` ";
			if($colom7) $field_name.= ", `".$colom7."` ";
			if($colom8) $field_name.= ", `".$colom8."` ";
			if($colom9) $field_name.= ", `".$colom9."` ";
			if($colom10) $field_name.= ", `".$colom10."` ";
			if($colom11) $field_name.= ", `".$colom11."` ";
			if($colom12) $field_name.= ", `".$colom12."` ";
			if($colom13) $field_name.= ", `".$colom13."` ";
			if($colom14) $field_name.= ", `".$colom14."` ";
			if($colom15) $field_name.= ", `".$colom15."` ";
			if($colom16) $field_name.= ", `".$colom16."` ";
			if($colom17) $field_name.= ", `".$colom17."` ";
			if($colom18) $field_name.= ", `".$colom18."` ";
			if($colom19) $field_name.= ", `".$colom19."` ";
			if($colom20) $field_name.= ", `".$colom20."` ";
			if($colom21) $field_name.= ", `".$colom21."` ";
			if($colom22) $field_name.= ", `".$colom22."` ";
			if($colom23) $field_name.= ", `".$colom23."` ";
			if($colom24) $field_name.= ", `".$colom24."` ";
			if($colom25) $field_name.= ", `".$colom25."` ";
			if($colom26) $field_name.= ", `".$colom26."` ";



			$file = $_FILES['db_file']['tmp_name'];

			$fp = fopen($file, "r");

			if (!$fp) {
				err_msg("파일이 첨부되지 않았습니다!");
			}else{

				while($data = fgets($fp)) {

					$a = explode($deli, $data);

					if($colom1){ $value_arr = "  '".$a[0]."'"; }
					if($colom2){ $value_arr.= ", '".$a[1]."'"; }
					if($colom3){ $value_arr.= ", '".$a[2]."'"; }
					if($colom4){ $value_arr.= ", '".$a[3]."'"; }
					if($colom5){ $value_arr.= ", '".$a[4]."'"; }
					if($colom6){ $value_arr.= ", '".$a[5]."'"; }
					if($colom7){ $value_arr.= ", '".$a[6]."'"; }
					if($colom8){ $value_arr.= ", '".$a[7]."'"; }
					if($colom9){ $value_arr.= ", '".$a[8]."'"; }
					if($colom10){ $value_arr.= ", '".$a[9]."'"; }
					if($colom11){ $value_arr.= ", '".$a[10]."'"; }
					if($colom12){ $value_arr.= ", '".$a[11]."'"; }
					if($colom13){ $value_arr.= ", '".$a[12]."'"; }
					if($colom14){ $value_arr.= ", '".$a[13]."'"; }
					if($colom15){ $value_arr.= ", '".$a[14]."'"; }
					if($colom16){ $value_arr.= ", '".$a[15]."'"; }
					if($colom17){ $value_arr.= ", '".$a[16]."'"; }
					if($colom18){ $value_arr.= ", '".$a[17]."'"; }
					if($colom19){ $value_arr.= ", '".$a[18]."'"; }
					if($colom20){ $value_arr.= ", '".$a[19]."'"; }
					if($colom21){ $value_arr.= ", '".$a[20]."'"; }
					if($colom22){ $value_arr.= ", '".$a[21]."'"; }
					if($colom23){ $value_arr.= ", '".$a[22]."'"; }
					if($colom24){ $value_arr.= ", '".$a[23]."'"; }
					if($colom25){ $value_arr.= ", '".$a[24]."'"; }
					if($colom26){ $value_arr.= ", '".$a[25]."'"; }

					//db query 설정 부분..
					$query="INSERT INTO $table_name_qry ($field_name)
												 VALUES ($value_arr);";
					$result=mysql_query($query, $connect);
				}

				if(!$result){
					echo "<script>
							alert('데이터베이스 에러입니다!');
						  </script>";
				}else{
					echo "<script>
							alert('정상적으로 디비에 입력 되었습니다!');
						  </script>";
				}
				fclose($fp);
			}
		}
?>
<html>
	<title>구분자로 분리된 데이터 텍스트 파일 디비 인서트 </title>
	<body>
		<h1><font color="blue">[파일입력]</font></h1>
		<form name="insform2" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="mode" value="ins">
		<table>
			<tr><td>테이블명(table)</td>	<td><input type="text" name="table_name" value="<?=$table_name?>"></td></tr>
			<tr><td>구분자</td>	<td><input type="text" name="deli" value="<?=$deli?>"></td></tr>
			<tr><td>컬럼명1(colom1)</td><td><input type="text" name="colom1" value="<?=$colom1?>"></td></tr>
			<tr><td>컬럼명2(colom2)</td><td><input type="text" name="colom2" value="<?=$colom2?>"></td></tr>
			<tr><td>컬럼명3(colom3)</td><td><input type="text" name="colom3" value="<?=$colom3?>"></td></tr>
			<tr><td>컬럼명4(colom4)</td><td><input type="text" name="colom4" value="<?=$colom4?>"></td></tr>
			<tr><td>컬럼명5(colom5)</td><td><input type="text" name="colom5" value="<?=$colom5?>"></td></tr>
			<tr><td>컬럼명6(colom6)</td><td><input type="text" name="colom6" value="<?=$colom6?>"></td></tr>
			<tr><td>컬럼명7(colom7)</td><td><input type="text" name="colom7" value="<?=$colom7?>"></td></tr>
			<tr><td>컬럼명8(colom8)</td><td><input type="text" name="colom8" value="<?=$colom8?>"></td></tr>
			<tr><td>컬럼명9(colom9)</td><td><input type="text" name="colom9" value="<?=$colom9?>"></td></tr>
			<tr><td>컬럼명10(colom10)</td><td><input type="text" name="colom10" value="<?=$colom10?>"></td></tr>
			<tr><td>컬럼명11(colom11)</td><td><input type="text" name="colom11" value="<?=$colom11?>"></td></tr>
			<tr><td>컬럼명12(colom12)</td><td><input type="text" name="colom12" value="<?=$colom12?>"></td></tr>
			<tr><td>컬럼명13(colom13)</td><td><input type="text" name="colom13" value="<?=$colom13?>"></td></tr>
			<tr><td>컬럼명14(colom14)</td><td><input type="text" name="colom14" value="<?=$colom14?>"></td></tr>
			<tr><td>컬럼명15(colom15)</td><td><input type="text" name="colom15" value="<?=$colom15?>"></td></tr>
			<tr><td>컬럼명16(colom16)</td><td><input type="text" name="colom16" value="<?=$colom16?>"></td></tr>
			<tr><td>컬럼명17(colom17)</td><td><input type="text" name="colom17" value="<?=$colom17?>"></td></tr>
			<tr><td>컬럼명18(colom18)</td><td><input type="text" name="colom18" value="<?=$colom18?>"></td></tr>
			<tr><td>컬럼명19(colom19)</td><td><input type="text" name="colom19" value="<?=$colom19?>"></td></tr>
			<tr><td>컬럼명20(colom20)</td><td><input type="text" name="colom20" value="<?=$colom20?>"></td></tr>
			<tr><td>컬럼명21(colom21)</td><td><input type="text" name="colom21" value="<?=$colom21?>"></td></tr>
			<tr><td>컬럼명22(colom22)</td><td><input type="text" name="colom22" value="<?=$colom22?>"></td></tr>
			<tr><td>컬럼명23(colom23)</td><td><input type="text" name="colom23" value="<?=$colom23?>"></td></tr>
			<tr><td>컬럼명24(colom24)</td><td><input type="text" name="colom24" value="<?=$colom24?>"></td></tr>
			<tr><td>컬럼명25(colom25)</td><td><input type="text" name="colom25" value="<?=$colom25?>"></td></tr>
			<tr><td>컬럼명26(colom26)</td><td><input type="text" name="colom26" value="<?=$colom26?>"></td></tr>
			<tr>
				<td><strong>파일</strong>(file)</td>
				<td><input type="file" name="db_file"><input type="submit" value=" 파일 업로드 "></td>
			</tr>
		</table>
		</form>
	</body>
</html>
