							<!-- 부서 신규 수정 등록 파일 -->
								<!-- ================================= 거래처 contents S ================================= -->
								<div style="height:500px;">
									<div style="height:18px; background-color:#e8e8e8; margin-bottom:2px;"></div>
									<div style="float:left; width:15px; height:24px; padding-top:10px;"><img src="../images/list_bt.jpg" border="0" alt=""></div>
									<div style="height:28px; padding-top:8px; color:#000000;"><b><?if($mode=='reg'){?>부서정보 신규등록<?}else if($mode=='modify'){?>부서정보 수정 등록<?} ?></b></div>
									<?
										if($mode=='modify'){
											$seq = $_REQUEST['seq'];
											$qry = "SELECT * FROM cms_com_div WHERE seq='$seq'";
											$rlt = mysql_query($qry, $connect);
											$row = mysql_fetch_array($rlt);
											$tax_addr = explode("/", $row[tax_addr]);
											$sub_str = "저장하기";
										}else{
											$sub_str = "등록하기";
										}
									?>
									<form name="form1" method="post" action="basic_post.php">
									<input type="hidden" name="s_di" value="<?=$s_di?>">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<?if($mode=='modify'){?><input type="hidden" name="seq" value="<?=$row[seq]?>"><? } ?>

									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">부서코드 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd "><input type="text" name="div_code" value="<?=$row[div_code]?>" class="inputstyle2" style="width:160px;"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">부서명 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd "><input type="text" name="div_name" value="<?=$row[div_name]?>" class="inputstyle2" style="width:160px;"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">부서 책임자</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="manager" value="<?=$row[manager]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">부서전화</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="div_tel" value="<?=$row[div_tel]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">담당업무 <font color="red">*</font></div>
									<div style="float:left; width:660px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="res_work" value="<?=$row[res_work]?>" class="inputstyle2" style="width:572px"></div>

									<div style="float:left; width:135px; height:56px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">비 고</div>
									<div style="float:left; width:660px; height:56px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><textarea name="note" rows="3" cols="76" class="inputstyle2" style="width:572px; height:47px;"><?=$row[note]?></textarea></div>
									</form>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($cg_1_1_row[cg_1_1]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="div_submit('$mode');";
										$del_str="if(confirm('해당 부서정보를 삭제 하시겠습니까?')==1) location.href='basic_post.php?s_di=1&amp;mode=del&amp;seq=$seq'";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd">
								<input type="button" value="<?=$sub_str?>" onclick="<?=$submit_str?>">
								<input type="button" value="목록으로" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=1&amp;ss_di=1' ">
							</div>
							<div style="float:right; height:30px; width:200px; padding:8px 10px 0 0; border-width:1px 0 0 0; text-align:right;" class="bor_ddd">
								<?if($mode=='modify'){?><input type="button" value="부서삭제" onclick="<?=$del_str?>"><? } ?>
							</div>
