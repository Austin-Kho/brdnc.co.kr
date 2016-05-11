							<!-- 직원 신규 수정 등록 파일 -->
								<!-- ================================= 거래처 contents S ================================= -->
								<div style="height:500px;">
									<div style="height:18px; background-color:#e8e8e8; margin-bottom:2px;"></div>
									<div style="float:left; width:15px; height:24px; padding-top:10px;"><img src="../images/list_bt.jpg" border="0" alt=""></div>
									<div style="height:28px; padding-top:8px; color:#000000;"><b><?if($mode=='reg'){?>직원정보 신규등록<?}else if($mode=='modify'){?>직원정보 수정 등록<?} ?></b></div>
									<?
										if($mode=='modify'){
											$seq = $_REQUEST['seq'];
											$qry = "SELECT * FROM cms_com_div_mem WHERE seq='$seq'";
											$rlt = mysql_query($qry, $connect);
											$row = mysql_fetch_array($rlt);
											$id_num = explode("-", $row[id_num]);
											if($row[join_date]<>'0000-00-00') $join_date=$row[join_date];
											$sub_str = "저장하기";
										}else{
											$sub_str = "등록하기";
										}
									?>
									<form name="form1" method="post" action="basic_post.php">
									<input type="hidden" name="s_di" value="<?=$s_di?>">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<?if($mode=='modify'){?><input type="hidden" name="seq" value="<?=$row[seq]?>"><? } ?>

									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">(임)직원명 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="mem_name" value="<?=$row[mem_name]?>" class="inputstyle2" style="width:160px;"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">직통전화 </div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="dir_tel" value="<?=$row[dir_tel]?>" class="inputstyle2" style="width:160px;"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">담당부서 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<select name="div_seq" class="inputstyle2" style="width:165px; height:22px;">
											<option value="" <?if(!$row[div_seq]) echo "selected";?>> 선 택
											<?
												$d_qry = "SELECT seq, div_name FROM cms_com_div ORDER BY seq";
												$d_rlt = mysql_query($d_qry, $connect);
												while($d_rows = mysql_fetch_array($d_rlt)){
											?>
											<option value="<?=$d_rows[seq]?>" <?if($d_rows[seq]==$row[div_seq]&&$d_rows[seq]<>0) echo "selected";?>><?=$d_rows[div_name]?>
											<? } mysqli_free_result($d_rlt);?>
										</select>
									</div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">직 급 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="div_posi" value="<?=$row[div_posi]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">비상전화 (Mobile) <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="mobile" value="<?=$row[mobile]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">이메일 (Email) </div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="email" value="<?=$row[email]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">주민등록번호</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<input type="text" name="id_num1" value="<?=$id_num[0]?>" maxlength="6" class="inputstyle2" style="width:65px"> - <input type="text" name="id_num2" value="<?=$id_num[1]?>" maxlength="7" class="inputstyle2" style="width:78px">
									</div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">입사일</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<input type="text" name="join_date" id="join_date" value="<?=$join_date?>" size="30" class="inputstyle2" style="height:17px; width:140px;" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
										<a href="javascript:" onclick="cal_add(document.getElementById('join_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
									</div>
									</form>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($_m5_1_2_row[_m5_1_2]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="div_mem_submit('$mode');";
										$del_str="_retire('$row[seq]');";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd;">
								<input type="button" value="<?=$sub_str?>" onclick="<?=$submit_str?>">
								<input type="button" value="목록으로" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=2&amp;ss_di=1' ">
							</div>
							<div style="float:right; height:30px; width:200px; padding:8px 10px 0 0; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd; text-align:right;">
								<?if($mode=='modify'){?><input type="button" value="퇴사등록" onclick="<?=$del_str?>"><? } ?>
							</div>
