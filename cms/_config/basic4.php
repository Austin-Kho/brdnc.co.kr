					<!-- =====subject table end===== -->
					<div style=" height:18px; background-color:#F8F8F8" class="d3_sub">
						<b><font size="2" color="#cc0099">◈</font><font size="2" color="#6666cc"> <?=$s_di_4?></font></b>
						<div style="float:right;">
							<?if($ss_di=='2'){?><font color="red">*</font> 필수 항목은 반드시 입력하시기 바랍니다.<? } ?>
						</div>
					</div>
					<!-- =====subject table end===== -->
					<?
						$cg_1_4_rlt = mysql_query("select cg_1_4 from cms_mem_auth where user_id='$_SESSION[p_id]' ", $connect);
						$cg_1_4_row = mysql_fetch_array($cg_1_4_rlt);

						if(!$cg_1_4_row[cg_1_4]||$cg_1_4_row[cg_1_4]==0){
					?>
					<div style="display:inline;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center" valign="middle" style="font-size:13px; color:black;" height="580">
								<p>해당 페이지에 대한 조회 권한이 없습니다. 관리자(<?=$admin_tel?>)에게 문의하여 주십시요!</p>
								<p>또는 <a href="javascript:message_win('<?=$cms_url?>member/message_3.php?r_id=<?=$admin_id?>')" class="no_auth">관리자나 해당 직원에게 메세지</a>를 보낼 수 있습니다.</p>
							</td>
						</tr>
					</table>
					</div>
					<? }else{ ?>
					<div style="display:inline;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td height="580" valign="top">
						<div style="height:18px; text-align:right; padding:0 20px 2px 0; margin-top:10px;">
							<!-- <a href="javascript:" onClick="excel_pop('<?=$sa_2_1_row[sa_2_1]?>',1);"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> EXCEL로 출력</a> -->
						</div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td height="538" style="width:200px; border-width:1px 1px 1px 0; border-style:solid; border-color:#cccccc; background-color:#f8f8f8; padding:5px 5px 5px 5px;" valign="top">
								<div style="height:50px; margin-bottom:6px; background-color:#f2eaed;"></div>
								<div style="height: 25px; padding:5px 5px 0 5px; margin:0px 5px 0 5px; border-width:1px 0 1px 0;" class="bottom">
									<a href="<?$_SERVER['PHP_SELF']?>?m_di=1&amp;s_di=1">부서정보 관리</a>
								</div>
								<div style="height: 25px; padding:5px 5px 0 5px; margin:0 5px 0 5px;" class="bottom">
									<a href="<?$_SERVER['PHP_SELF']?>?m_di=1&amp;s_di=2">직원정보 관리</a>
								</div>
								<div style="height: 25px; padding:5px 5px 0 5px; margin:0 5px 0 5px;" class="bottom">
									<a href="<?$_SERVER['PHP_SELF']?>?m_di=1&amp;s_di=3">거래처정보 관리</a>
								</div>
								<div style="height: 25px; padding:5px 5px 0 5px; margin:0 5px 0 5px;" class="bottom">
									<a href="<?$_SERVER['PHP_SELF']?>?m_di=1&amp;s_di=4" style="color:#000000;"><b>은행계좌 관리</b></a>
								</div>
							</td>
							<td style="width:825px; border-width:1px 0 1px 0; border-style:solid; border-color:#cccccc; padding:5px 5px 5px 5px;" valign="top">
								<div style="height:435px;">
									<?
										$ss_di = $_REQUEST['ss_di'];
										$mode = $_REQUEST['mode'];

										if(!$ss_di||$ss_di==1){// 초기 화면이나 리스트 불러올 때
											include "basic4_1.php";
										}else if($ss_di==2){ // 신규 수정등록 화면일 때
											include "basic4_2.php";
										}
									?>
								</div>
							</td>
						</tr>
						</table>
						</td>
					</tr>
					</table>
					</div>
					<? } ?>
