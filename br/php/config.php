<?php
session_start();
$host="localhost";
$dbid="brdnc";     /// 셋업 파일에서 설정할 수 있도록 수정 요망
$dbpass="qkfoa5928";     /// 셋업 파일에서 설정해서 넘어올 수 있도록 수정 요망
$dbname="brdnc";    /// 셋업 파일에서 설정해서 넘어올 수 있도록 수정 요망
$com_title="[주] 바램디앤씨";
$doc_title="[주]바램디앤씨 _ 관리시스템";
$doc_charset="UTF-8";
$doc_copyright="
			<b>[주] 바램디앤씨</b> | 인천광역시 연수구 인천타워대로323 B-1506(송도동, 송도센트로드오피스) | 전화 : 032-858-9556 | 문의하기 : <a href='mailto:cigiko@naver.com' class='under'>cigiko@naver.com</a><br>
			Copyright 2015~".date('Y')." by BARAEM D&C Co.,LTD All rights reserved.";
$admin_id="cigiko ";
$admin_tel=" 010-3320-0088 ";
global $cms_url, $cms_path;
$cms_url="http://brdnc.cafe24.com/br/";
$cms_path= "/home2/hosting_users/brdnc/www/br/";
$is_johap=0; // 조합 업무대행사 여부 - 조합 업무대행사이고 현장관리 별도로 하지 않을 경우 '1' // 그렇지 않을 경우 '0'; 입력 할 것

// MySQL 연결
	function dbconn(){
		$connect=mysql_connect($host,$dbname,"qkfoa5928"); // 비번을 변수로 넣었을때 에러나는 이유 찾아서 수정하기
		mysql_select_db("brdnc", $connect); // 아이디를 변수로 넣었을때 에러나는 이유 찾아서 수정하기
		return $connect;
	}