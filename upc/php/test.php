<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
	$file = fopen('../setup/config_set.php','r') or exit("파일을 열 수 없습니다!");

	for($i=0; $i<4; $i++ ){
		if($i==0) $hostname=fgets($file);
		if($i==1) $user_id=fgets($file);
		if($i==2) $passwd=fgets($file);
		if($i==3) $dbname=fgets($file);
	}
	echo $hostname."<br>";
	echo $passwd."<br>";
	echo $dbname."<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "connect=mysql_connect(".$hostname.",".$dbname.",".$passwd.");<br>mysql_select_db(".$dbname.", connect);<br>return connect;";

	// MySQL 연결
	function dbconn(){
		$file = fopen('../setup/config_set.php','r') or exit("파일을 열 수 없습니다!");
		for($i=0; $i<4; $i++ ){
			if($i==0) $hostname=fgets($file);
			if($i==2) $passwd=fgets($file);
			if($i==3) $dbname=fgets($file);
		}
		fclose($file);
		$connect=mysql_connect($hostname,$dbname,$passwd);
		mysql_select_db($dbname, $connect);
		return $connect;
	}
//@fwrite($file,"$hostname\n$user_id\n$passwd\n$dbname\n")
/* End of file Filename.php */
/* Location: ./application/controllers/Filename.php */