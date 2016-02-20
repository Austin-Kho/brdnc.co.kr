<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

	// 메세지 출력 후 이동
	function alert($msg='이동합니다.', $url=''){

		$CI =& get_instance();
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
		echo "<script type='text/javascript'>
					alert('".$msg."');
				</script>";
		echo "<meta http-equiv='Refresh' content='0; URL=".$url."'>";
			exit;
	}

	// 창 닫기
	function alert_close($msg){

		$CI =& get_instance();
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
		echo "<script type='text/javascript'> alert('".$msg."'); window.close(); </script>";
	}

	// 경고창 만
	function alert_only($msg, $exit=TRUE){
		$CI =& get_instance();
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=".$CI->config->item('charset')."\">";
		echo "<script type='text/javascript'> alert('".$msg."');</script>";
		if($exit) exit;
	}

	function replace($url='/'){
		if($url) echo "<meta http-equiv='Refresh' content='0; URL=".$url."'>";
		exit;
	}
// End of this File