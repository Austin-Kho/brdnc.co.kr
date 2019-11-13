<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

// 페이징 알고리즘 //
	function pagenation($total_post, $page_num, $index_num, $start, $back_url){
	//  (1. 총게시물수 2. 설정 페이지수 3. 설정 목록 수 4. 현재페이지. 5. 해당 페이지 필요 변수url)

		if(!$page_num) $page_num = 10;             // 설정 페이지수를 정하지 않았다면 페이지수 '10' 기본설정
		if(!$index_num) $index_num = 10;           // 설정 목록수를 정하지 않았다면 목록수 '10' 기본설정
		$pages = ceil($total_post/$index_num);		 // 총 페이지 수
		if(!$start) $start = 1;										 // 현재 페이지 정보가 없다면 '1' 기본 설정

		//if($pages>$page_num) $pages = $page_num; // 총 페이지수가 설정 페이지수보다 많다면 총 페이지수는 설정 페이지수

		$a=ceil($start/$page_num)*$page_num-($page_num-1);  // 이전, 다음 페이지버튼 클릭시 설정 페이지수만큼 이동할 표적 숫자
		$b=$pages;                                    // 총 페이지 수 변수 단순화 후 // 별도 계산 위한 변수

		if($b>($a+$page_num-1)) $b=$a+$page_num-1;    // 설정 페이지수보다 총 페이지 수가 많다면, 총 페이지 수는 설정페이지에서 변수 a를 더하고 1을 뺀 값
		$pre=$page_num*ceil($start/$page_num)-($page_num*2)+10;  // 이전 페이지 = 설정페이지* 소수점올림(현재페이지/설정페이지)-(설정페이지*2)+10
		$nex=ceil($start/$page_num)*$page_num+1;                 // 다음 페이지 = 소수점올림(현재페이지/설정페이지)*설정페이지+1
		if($pre<1) $pre =1;                         // 만약 이전페이지가 1보다 작으면 이전페이지는 1
		if($nex>$pages) $nex =$pages;					      // 만약 다음페이지가 총 페이지수 보다 많다면 다음페이지는 총 페이지수
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

// End of this File
