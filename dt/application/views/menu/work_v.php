<?php

$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTP'] == "on") ? "https" : "http");
$base_url .= "://".$_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
	echo $base_url;
?>