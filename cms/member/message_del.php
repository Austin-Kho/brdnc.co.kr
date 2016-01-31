<?
	include '../php/config.php';
	include '../php/util.php';
	$connect=dbconn();
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div style="position:absolute; top:0px; right:0px; left:0px; bottom:0px; background:#000; z-index:100000; opacity: 0.5; text-align:center;"></div>
<?
	// 이름가 아이디에 해당하는 세션이 있는지 확인
	if(!isset($_SESSION['p_id'])||!isset($_SESSION['p_name'])){
		err_msg('로그인 정보가 없습니다. 다시 로그인해 주세요.');
	}

		$mode=$_REQUEST['mode'];
		$gb=$_REQUEST['gb'];
		$mnum=$_REQUEST['mnum'];

	// 보기 화면에서 삭제
	if($mode=='view'){
		if($gb=='1'){          // 받은 편지함 내용 보기에서 삭제
			$qry="update cms_message_info set receive_del='Y' where mnum='$mnum' ";
			$res=mysql_query($qry, $connect);

			echo ("<meta http-equiv='Refresh' content='0; URL=message_1.php'>");

		} else if($gb=='2'){   // 보낸 편지함 내용 보기에서 삭제
			$qry="update cms_message_info set send_del='Y' where mnum='$mnum' ";
			$res=mysql_query($qry, $connect);

			echo ("<meta http-equiv='Refresh' content='0; URL=message_2.php'>");
		}
	} else {
		// 받은 편지함 목록에서 삭제
		$mnum[]=$_REQUEST['mnum[]'];
		if($gb=='1'){
			for($i=0;$i<count($mnum);$i++){
				if($mnum[$i]){
					$qry="update cms_message_info set receive_del='Y' where mnum='$mnum[$i]' ";
					$res=mysql_query($qry, $connect);
				}
			}
			 echo ("<meta http-equiv='Refresh' content='0; URL=message_1.php'>");

		// 보낸 편지함 목록에서 삭제
		} else if($gb=='2'){
			for($i=0;$i<sizeof($mnum);$i++){
				if($mnum[$i]){
					$qry="update cms_message_info set send_del='Y' where mnum='$mnum[$i]' ";
					$res=mysql_query($qry, $connect);
				}
			}
			 echo ("<meta http-equiv='Refresh' content='0; URL=message_2.php'>");
		}
	}
?>
