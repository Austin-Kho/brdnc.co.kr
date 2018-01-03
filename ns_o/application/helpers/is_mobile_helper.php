<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

	function is_mobile() {
		$mobile_agent = '/(iPod|iPhone|Android|BlackBerry|SymbianOS|SCH-M\d+|Opera Mini|Windows CE|Nokia|SonyEricsson|webOS|PalmOS)/';
		if(preg_match($mobile_agent, $_SERVER['HTTP_USER_AGENT'])) {
		  return TRUE;
		}	else {
		  return FALSE;
		}
	}
// End of this File