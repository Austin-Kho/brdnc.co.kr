				<div id="div1" style="<?=$m_dis1?>">   <!----------------Div1-----------------//-->
				<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
					<table width="100%" height="50" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="15%" class="d2_sub2"></td>
						<td align="center" width="162" class="d2_sub1">
							<a href="javascript:" onclick="div_link('<?=$_SERVER['PHP_SELF']?>','1');"><img src="../images/sub_menu_stock1.png" border="0"><!-- <font size="2" color=""><b>재고현황</b></font> --></a>
						</td>
						<td align="center" width="162" class="d2_sub2">
							<a href="javascript:" onclick="div_link('<?=$_SERVER['PHP_SELF']?>','2');"><img src="../images/sub_menu_stock2_.png" border="0"><!-- <font size="2" color=""><b>입출고 관리</b></font> --></a>
						</td>
						<td width="55%" class="d2_sub2"></td>
					</tr>
					</table>
					</td>
				</tr>
				<tr height="100%">
					<td class="main_content" valign="top">
					<!--------------------------------------------------template start---------------------------------------------------->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr height="35" align="center">
						<td width="120" class="bottom">
							<b><font size="12"><a href="javascript:" onclick="div_link('<?=$_SERVER['PHP_SELF']?>','<?=$m_di?>','1');" class="menu1">재고 현황</a></font></b>
						</td>
						<td class="bottom"></td>
					</tr>
					</table>
					<!--------------------------------------------------sub menu end---------------------------------------------------->
					<div id="stock1" style="<?=$s_dis1?>">
						<?
							include "stock1.php";
						?>
					</div>
					<div id="stock2" style="<?=$s_dis1?>">
						<?
							include "stock2.php";
						?>
					</div>
					<!--------------------------------------------------template end---------------------------------------------------->
					</td>
				</tr>
				</table>
				</div>






