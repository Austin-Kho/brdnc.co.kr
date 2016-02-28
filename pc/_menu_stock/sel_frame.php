<?
	include '../php/config.php';
	include '../php/util.php';
	$connect=dbconn();

	$tmp = $_GET['tmp'];
	$no = $_GET['no'];
?>
<script>
<?
	if($no==3){
		 if($tmp==1) $add_where="";
		 if($tmp==2) $add_where=" and division = '1' ";
		 if($tmp==3) $add_where=" and division = '2' ";

		 $qry="select * from cms_stock_main,cms_accounts where accounts=code and si_name<>'LOSS' $add_where group by accounts order by si_name ";
		 $qry1="select classify from cms_stock_main where 1='1' $add_where group by classify order by classify";
		 $rlt=mysql_query($qry, $connect);
		 $rlt1=mysql_query($qry1, $connect);
		 $tot = mysql_num_rows($rlt)+1;
		 $tot1 = mysql_num_rows($rlt1)+1;
?>
		parent.in_out_frm.accounts.length = <?=$tot?>;
		parent.in_out_frm.accounts.options[0].text = '선 택';
		parent.in_out_frm.accounts.options[0].value = '';
		parent.in_out_frm.accounts.options[0].selected =1;

		parent.in_out_frm.sep.length = <?=$tot1?>;
		parent.in_out_frm.sep.options[0].text = '선 택';
		parent.in_out_frm.sep.options[0].value = '';
		parent.in_out_frm.sep.options[0].selected =1;
<?
	 $i=1;
   while($rs=mysql_fetch_array($rlt)){
?>
	 parent.in_out_frm.accounts.options[<?=$i?>].text = '<?=$rs[si_name]?>';
	 parent.in_out_frm.accounts.options[<?=$i?>].value ='<?=$rs[code]?>';
<?
	 $i++;
	 }
	 $j=1;
	 while($rs1=mysql_fetch_array($rlt1)){
			if($rs1[classify]==1) $c="매입입고";
			if($rs1[classify]==2) $c="반품입고";
			if($rs1[classify]==3) $c="수탁입고";
			if($rs1[classify]==4) $c="위탁회수";
			if($rs1[classify]==5) $c="판매출고";
			if($rs1[classify]==6) $c="반품출고";
			if($rs1[classify]==7) $c="수탁반납";
			if($rs1[classify]==8) $c="위탁출고";
			if($rs1[classify]==9) $c="재고조정";
?>
	 parent.in_out_frm.sep.options[<?=$j?>].text = '<?=$c?>';
	 parent.in_out_frm.sep.options[<?=$j?>].value ='<?=$rs1[classify]?>';

<?
	 	 $j++;
	 }

	}else{
		 $qry1="select * from cms_stock_2nd_classify where 1st_classify = '$tmp' ";
		 $rlt1=mysql_query($qry1, $connect);
		 $total = mysql_affected_rows()+1;

	if($no==1){
?>
		parent.st_sh_frm.classify2.length = <?=$total?>;
		parent.st_sh_frm.classify2.options[0].text = '2차 분류';
		parent.st_sh_frm.classify2.options[0].value = '';
		parent.st_sh_frm.classify2.options[0].selected = 1;
<?
		 $i=1;
		 while($rs1 = mysql_fetch_array($rlt1)){
?>
	 parent.st_sh_frm.classify2.options[<?=$i?>].text = '<?=$rs1[classify]?>';
	 parent.st_sh_frm.classify2.options[<?=$i?>].value ='<?=$rs1[classify]?>';
<?
		$i++;
		}
	}
	if($no==2){
?>
		parent.in_out_frm.classify2.length = <?=$total?>;
		parent.in_out_frm.classify2.options[0].text = '2차 분류';
		parent.in_out_frm.classify2.options[0].value = '';
		parent.in_out_frm.classify2.options[0].selected = 1;
<?
		 $i=1;
		 while($rs1 = mysql_fetch_array($rlt1)){
?>
	 parent.in_out_frm.classify2.options[<?=$i?>].text = '<?=$rs1[classify]?>';
	 parent.in_out_frm.classify2.options[<?=$i?>].value ='<?=$rs1[classify]?>';
<?
		$i++;
		}
	}}
?>
</script>
