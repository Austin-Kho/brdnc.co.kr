<?
  // W3C P3P 규약설정
  @header ("P3P : CP=\"ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC\"");
  //set_error_handler();
  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL);


	/*******************************************************************************
 	 * 에러 리포팅 설정과 register_globals_on일때 변수 재 정의
 	 ******************************************************************************/
 	@error_reporting(E_ALL ^ E_NOTICE);
        foreach($_GET as $key=>$val) $$key = del_html($val);
	@extract($HTTP_POST_VARS);
	@extract($HTTP_SERVER_VARS);
	@extract($HTTP_ENV_VARS);

        $page = (int)$page;

	$temp_filename=realpath(__FILE__);
	if($temp_filename) $config_dir=str_replace("util.php","",$temp_filename);
	else $config_dir="";

	/*******************************************************************************
 	 * 기본 변수 초기화. (php의 오류같지 않은 오류 때문에;; ㅡㅡ+)
 	 ******************************************************************************/
	unset($member);
	unset($group);
	unset($setup);
	unset($s_que);
    $select_arrange = str_replace(array("'",'"','\\'),'',$select_arrange);
    if(!in_array($desc,array('desc','asc'))) unset($desc);

	/**************************************************************************/
	// PC로 접속 했는지 모바일로 접속했는지, 검사 함수
	/**************************************************************************/
	function MobileCheck(){
		//global $_SERVER['HTTP_USER_AGENT'];
		$MobileArray  = array("iphone","iPhone","lgtelecom","Lgtelecom","skt","Skt","mobile","Mobile","samsung","Samsung","nokia","Nokia","blackberry","Blackberry","android","Android","sony","Sony","phone","Phone");
		$checkCount = 0;
		for($i=0; $i<sizeof($MobileArray); $i++){
			if(preg_match("/$MobileArray[$i]/", strtolower($_SERVER['HTTP_USER_AGENT']))){
				$checkCount++; break;
			}
      }
		return ($checkCount >= 1) ? "Mobile" : "Computer";
	}

	//  초기 헤더를 뿌려주는 부분
	function head($body="",$scriptfile=""){
		 global $group, $setup, $dir,$member, $PHP_SELF, $id, $_head_executived, $HTTP_COOKIE_VARS, $width;

		 if($_head_executived) return;
		 $_head_executived = true;

		 $f = @fopen("license.txt","r");
		 $license = @fread($f,filesize("license.txt"));
		 @fclose($f);

		 print "<!--\n".$license."\n-->\n";

		 if(!eregi("member_",$PHP_SELF)) $stylefile="skin/$setup[skinname]/style.css"; else $stylefile="style.css";

		 if($setup[use_formmail]){
				$f = fopen("script/script_zbLayer.php","r");
				$zbLayerScript = fread($f, filesize("script/script_zbLayer.php"));
				fclose($f);
		 }

		 // html 시작부분 출력
		 if($setup[skinname]){
?>
<html>
<head>
	<title><?=$setup[title]?></title>
	<meta http-equiv=Content-Type content=text/html; charset=UTF-8>
    <meta http-equiv=imagetoolbar content=no>
	<link rel=StyleSheet HREF=<?=$stylefile?> type=text/css title=style>
<?if($setup[use_formmail]) echo $zbLayerScript;?>
<?if($scriptfile) include "script/".$scriptfile;?>
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?>
<?
	if($setup[bg_color]) echo " bgcolor=".$setup[bg_color]." ";
	if($setup[bg_image]) echo " background=".$setup[bg_image]." ";

	if($group[header_url]) { @include $group[header_url]; }
	if($setup[header_url]) { @include $setup[header_url]; }
	if($group[header]) echo stripslashes($group[header]);
	if($setup[header]) echo stripslashes($setup[header]);
?>
	<table border=0 cellspacing=0 cellpadding=0 width=<?=$width?> height=1 style="table-layout:fixed;"><col width=100%></col><tr><td><img src=images/t.gif border=0 width=98% height=1 name=zb_get_table_width><br><img src=images/t.gif border=0 name=zb_target_resize width=1 height=1></td></tr></table>
<?
	 }else{
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
	<link rel=StyleSheet HREF=style.css type=text/css title=style>
<?=$script?>
</head>
<body topmargin='0'  leftmargin='0' marginwidth='0' marginheight='0' <?=$body?>>
<?
				if($group[header_url]) { @include $group[header_url]; }
				if($group[header]) echo stripslashes($group[header]);
		}

	}

	// 빈문자열 경우 1을 리턴
	function isblank($str) {
		$temp=str_replace("　","",$str);
		$temp=str_replace("\n","",$temp);
		$temp=strip_tags($temp);
		$temp=str_replace(";","",$temp);
		$temp=str_replace(" ","",$temp);
		if(eregi("[^[:space:]]",$temp)) return 0;
		return 1;
	}
	

	// 요청한 메시지를 화면에 출력한 뒤 페이지를 다시 이전 페이지로 옮김.
	function err_msg($msg, $bool="1"){
		if($bool){
			echo "
			<script>
				window.alert('$msg');
				history.go(-1);
			</script>
			";
			exit;
		}
	}

	// 요청한 메시지를 화면에 출력.
	function msg($msg){
		echo ("
			<script>
				window.alert('$msg');
			</script>
			");
	}

	// 메시지를 출력한 뒤 그 페이지를 닫는다.
	function err_close($msg){
		echo "
			<script>
				window.alert('$msg');
				self.close();
			</script>
			";
			exit;
	}

	// 메시지를 출력한 뒤 새 창을 연다.
	function err_msg2(){
		if($bool){
			echo "
				<script>
					window.alert('$msg');
					window.open('$to', '_self');
				</script>
				";
			exit;
		}
	}

	// 요청하는 페이지로 이동.
	function redirect($re_url){
		echo "<meta http--equiv='Refresh' content='0; URL=$re_url'>";
		exit;
	}

	// HTML 태그를 지우는 함수(html 태그를 치환하여 소스에서 html이 화면에 적용되지 않게 함)
	function del_html($str){
		$str=str_replace(">", "&gt;", $str);
		$str=str_replace("<", "&lt;", $str);
		$str=str_replace("\"", "&quot;", $str);
		return $str;
	}

	// 각종 HTML 태그를 이용한 테러방지
	function avoid_crack($str){
		$str=eregi_replace("<", "&lt;", $str);
		$str=eregi_replace("&lt;div", "<div", $str);
		$str=eregi_replace("&lt;p", "<p", $str);
		$str=eregi_replace("&lt;font", "<font", $str);
		$str=eregi_replace("&lt;b", "<b", $str);
		$str=eregi_replace("&lt;marquee", "<marquee", $str);
		$str=eregi_replace("&lt;img", "<img", $str);
		$str=eregi_replace("&lt;a", "<a", $str);
		$str=eregi_replace("&lt;embed", "<embed", $str);

		$str=eregi_replace("&lt;/div", "</div", $str);
		$str=eregi_replace("&lt;/p", "</p", $str);
		$str=eregi_replace("&lt;/font", "</font", $str);
		$str=eregi_replace("&lt;/b", "</b", $str);
		$str=eregi_replace("&lt;/marquee", "</marquee", $str);
		$str=eregi_replace("&lt;/img", "</img", $str);
		$str=eregi_replace("&lt;/a", "</a", $str);
		$str=eregi_replace("&lt;/embed", "</embed", $str);
		$str=eregi_replace("&gt;", ">", $str);
		return $str;
	}

	// 페이징 알고리즘 //
	function page_avg($total_post, $page_num, $index_num, $start, $back_url){// (1. 총게시물수 2. 설정 페이지수 3. 설정 목록 수 4. 현재페이지. 5. 해당 페이지 필요 변수url)

		if(!$page_num) $page_num = 10;                                             // 설정 페이지수를 정하지 않았다면 페이지수 '10' 기본설정
		if(!$index_num) $index_num = 10;                                            // 설정 목록수를 정하지 않았다면 목록수 '10' 기본설정
		$pages = ceil($total_post/$index_num);						      // 총 페이지 수
		if(!$start) $start = 1;													 // 현재 페이지 정보가 없다면 '1' 기본 설정

		//if($pages>$page_num) $pages = $page_num;                           // 총 페이지수가 설정 페이지수보다 많다면 총 페이지수는 설정 페이지수

		$a=ceil($start/$page_num)*$page_num-($page_num-1);            // 이전, 다음 페이지버튼 클릭시 설정 페이지수만큼 이동할 표적 숫자
		$b=$pages;                                                                                  // 총 페이지 수 변수 단순화 후 // 별도 계산 위한 변수

		if($b>($a+$page_num-1)) $b=$a+$page_num-1;                         // 설정 페이지수보다 총 페이지 수가 많다면, 총 페이지 수는 설정페이지에서 변수 a를 더하고 1을 뺀 값
		$pre=$page_num*ceil($start/$page_num)-($page_num*2)+10;  // 이전 페이지 = 설정페이지* 소수점올림(현재페이지/설정페이지)-(설정페이지*2)+10
		$nex=ceil($start/$page_num)*$page_num+1;                             // 다음 페이지 = 소수점올림(현재페이지/설정페이지)*설정페이지+1
		if($pre<1) $pre =1;                                                                   // 만약 이전페이지가 1보다 작으면 이전페이지는 1
		if($nex>$pages) $nex =$pages;					                	                  // 만약 다음페이지가 총 페이지수 보다 많다면 다음페이지는 총 페이지수
		if($start==1 ){
			echo "<a href='#' title='처음'><img src='http://cigiko.cafe24.com/cms/images/btn_fir_2.gif' height='16' border='0' alt=''></a>";
		} else {
			echo "<a href='$_SERVER[PHP_SELF]?start=1".$back_url."' title='처음'><img src='http://cigiko.cafe24.com/cms/images/btn_fir_1.gif' height='16' border='0' alt=''></a>";
		}
		if($start<=$page_num){
			echo "<a href='#' title='이전'><img src='http://cigiko.cafe24.com/cms/images/btn_pre_2.gif' height='16' border='0' alt=''></a>";
		} else {
			echo "<a href='$_SERVER[PHP_SELF]?start=$pre".$back_url."' title='이전'><img src='http://cigiko.cafe24.com/cms/images/btn_pre_1.gif' height='16' border='0' alt=''></a>";
		}
		for($i=$a; $i<=$b; $i++){
			if($i==$start){
				echo " <font color='#ff3300'><b>$i</b></font> ";
			} else {
				echo " <a href='$_SERVER[PHP_SELF]?start=$i".$back_url."'>[$i]</a> ";
			}
		}

		if($start<=ceil($pages/$page_num)*$page_num-$page_num){
			echo " <a href='$_SERVER[PHP_SELF]?start=$nex".$back_url."' title='다음'><img src='http://cigiko.cafe24.com/cms/images/btn_nex_1.gif' height='16' border='0' alt=''></a>";
		} else {
			echo " <a href='#' title='다음'><img src='http://cigiko.cafe24.com/cms/images/btn_nex_2.gif' height='16' border='0' alt=''></a>";
		}
		if($start==$pages){
			echo "<a href='#' title='끝'><img src='http://cigiko.cafe24.com/cms/images/btn_las_2.gif' height='16' border='0' alt=''></a>";
		} else {
			echo "<a href='$_SERVER[PHP_SELF]?start=$pages".$back_url."' title='끝'><img src='http://cigiko.cafe24.com/cms/images/btn_las_1.gif' height='16' border='0' alt=''></a>";
		}
	}

	function page_avg2($totalpage,$cpage,$url){

  	if(!$pagenumber) {
     		$pagenumber = 10;      // 페이지수를 정하지 않았다면 '10'페이지 기본설정
     	}

     	$startpage=intval(($cpage-1)/$pagenumber)*$pagenumber+1;   // 시작페이지는 ((현재페이지-1)/10)*10+1
     	$endpage=intVal(((($startpage-1)+$pagenumber)/$pagenumber)*$pagenumber);

    	if($totalpage<=$endpage) 	$endpage= $totalpage;    // 총 페이지수가 마지막 페이지보다 작거나 같으면 =

    		if ($cpage > $pagenumber) {          // 현재페이지 > 10(기본설정) 이면

			$curpage = intval($startpage - 1);
			$url_page = "<a href='$url"."&amp;page=$curpage'>";
       		echo ("$url_page");
				echo("◀ [다음] </a> ");
       		}
			else{
			  echo("◀ </a>  ");
			}

      		$curpage = $startpage;

      		while ($curpage<=$endpage){

       			if ($curpage == $cpage) {
       				echo "<b> <font color='#0066cc'>$cpage</font> </b>";
       			} else {
       			  $url_page = "<a href='$url"."&amp;page=$curpage'>";
       			  echo ("$url_page");
				     echo("[ $curpage ]</a>");
       			}
       			$curpage++;
				}

       	if ( $totalpage > $endpage) {
      		$curpage = intval($endpage + 1);
      		$url_page = "  <a href='$url"."&amp;page=$curpage'>";
       		echo ("$url_page");
			echo(" [다음] ▶</a>");
      	}
		else{
		  echo("  ▶");
		}
  }

	// 날짜 데이터 형식 변환 :20020512 -> 2002-05-12
	function shortdate($strvalue){
		$date_str=substr($strvalue, 0, 4)."-".substr($strvalue, 4, 2)."-".substr($strvalue, 6, 2);
		return $date_str;
	}

	// 한글 문자열 자르기
	function rg_cut_string($string, $length, $suffix){
		 $string = strip_tags(stripslashes(trim($string))); //$string의 태그제거 10. 12
		 if (strlen($string) <= $length) return $string;
		 $cpos = $length - 1;
		 $count_2B = 0;
		 $lastchar = $string[$cpos];
		 while (ord($lastchar)>127 && $cpos>=0){
		 		$count_2B++;
		 		$cpos--;
		 		$lastchar = $string[$cpos];
		 }
		 if($count_2B % 2) $length--;
		 return mb_substr($string, 0, $length, 'UTF-8').$suffix;
  }

	// 한글 문자열 자르기 함수...2
	function shortenStr($str, $maxlen){

		if(strlen($str)<=$maxlen)
			return $str;

		$effective_max=$maxlen-3;
		$remained_바이트=$effective_max;
		$retStr="";

		for($i=0;$i<$effective_max;$i++){
			$char=substr($str, $i, 1);

			if(ord($char)<=127){
				$retStr.=$char;
				$remained_바이트--;
				continue;
			}

			if(!$hanStart&&$remained_바이트>1){
				$hanStart=true;
				$retStr.=$char;
				$remained_바이트--;
				continue;
			}

			if($hanStart){
				$hanStart=false;
				$retStr.=$char;
				$remained_바이트--;
			}
		}
		return $retStr.="...";
	}
?>
