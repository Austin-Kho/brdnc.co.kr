<?php

	/**
	 * [cut_string 문자열 자르기 함수]
	 * @param  [String] $string  [자를 문자열]
	 * @param  [Int] $length  [자르려는 문자 길이]
	 * @param  [String] $suffix  [자른 후 붙이는 문자]
	 * @param  [type] $charset [캐릭터셋 - 미지정시 UTF-8]
	 * @return [String]          [함수 적용 문자열]
	 */
	function cut_string($string, $length, $suffix, $charset=NULL) {
	if($charset==NULL) {
		$charset='UTF-8';
	}
	/* 정확한 문자열의 길이를 계산하기 위해, mb_strlen 함수를 이용 */
	 $str_len=mb_strlen($string,'UTF-8');
	 if($str_len>$length) {
	/* mb_substr  PHP 4.0 이상, iconv_substr PHP 5.0 이상 */
	  $string=mb_substr($string, 0, $length, 'UTF-8');
	  $string.=$suffix;
	  }
	    return $string;
	}
?>
