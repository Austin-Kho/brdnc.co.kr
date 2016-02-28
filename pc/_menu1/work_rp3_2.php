							<!-- 부서 신규 수정 등록 파일 -->
								<!-- ================================= 거래처 contents S ================================= -->
								<div style="height:447px;">
									<div style="height:18px; background-color:#e8e8e8; margin-bottom:2px;"></div>
									<div style="float:left; width:15px; height:24px; padding-top:10px;"><img src="../images/list_bt.jpg" border="0" alt=""></div>
									<div style="height:28px; padding-top:8px; color:#000000;"><b><?if($mode=='reg'){?>업무일지 신규등록<?}else if($mode=='modify'){?>고객상담내용 추가 등록<?} ?></b></div>
									<?
										if($mode=='modify'){
											$seq = $_REQUEST['seq'];
											$qry = "SELECT * FROM cms_work_coun_log WHERE seq='$seq'";
											$rlt = mysql_query($qry, $connect);
											$row = mysql_fetch_array($rlt);
											$sub_str = "추가등록";
										}else{
											$sub_str = "등록하기";
										}
									?>
									<form name="form1" method="post" action="work_rp_post.php">
									<input type="hidden" name="s_di" value="<?=$s_di?>">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<input type="hidden" name="coun_worker" value="<?=$coun_worker?>">
									<input type="hidden" name="worker_where" value="<?=$worker_where?>">
									<?if($mode=='modify'){?><input type="hidden" name="seq" value="<?=$row[seq]?>"><? } ?>

									<div style="clear:left; float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">작성일자 <font color="red">*</font></div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<div style="float:left;">
											<input type="text" name="coun_date" id="coun_date" value="<?=$row[coun_date]?>" size="30" class="inputstyle2" style="height:17px; width:140px;" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
											<a href="javascript:" onclick="cal_add(document.getElementById('coun_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
										</div>
									</div>
									<div style="float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">출근인원(팀장포함) <font color="red">*</font></div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="cust_name" value="<?=$row[cust_name]?>" class="inputstyle2" style="width:160px;"></div>

									<div style="clear:left; float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">계약사항 </div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<div style="float:left;">
											<select name="">
											<option value="" selected> 선 택
											<option value="1"> 청약
											<option value="2"> 청약해지
											<option value="3"> 계약
										</select>
										</div>
										<div style="float:left; padding-left:10px;">
											<input type="text" name="cust_tel1" value="<?=$row[cust_tel1]?>" class="inputstyle2" style="width:55px"> 건
										</div>
									</div>
									<div style="float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">dd</div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="cust_tel2" value="<?=$row[cust_tel2]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">금일 계약건 </div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<select name="coun_route" class="inputstyle2" style="height:22px; width:100px;">
											<option value="" <?if(!$row[coun_route]) echo "selected";?>> 선 택
											<option value="1" <?if($row[coun_route]==1) echo "selected";?>> 대표콜
											<option value="2" <?if($row[coun_route]==2) echo "selected";?>> 지명콜
											<option value="3" <?if($row[coun_route]==3) echo "selected";?>> 본부방문(워킹)
											<option value="4" <?if($row[coun_route]==4) echo "selected";?>> 지명방문
										</select>
									</div>
									<div style="float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">관심타입</div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="favor_type" value="<?=$row[favor_type]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">거주지역 (형태)</div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="live_where" value="<?=$row[live_where]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">관 심 도</div>
									<div style="float:left; width:240px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<input type="radio" name="inte_degree" value="1" <?if($row[inte_degree]==1) echo "checked";?>> [보통]
										<input type="radio" name="inte_degree" value="2" <?if($row[inte_degree]==2) echo "checked";?>> [높음]
										<input type="radio" name="inte_degree" value="3" <?if($row[inte_degree]==3) echo "checked";?>> [매우높음]
									</div>


									<div style="clear:left; float:left; width:120px; height:210px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">상담내용 <font color="red">*</font></div>
									<div style="float:left; width:625px; height:210px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><textarea name="content" rows="3" cols="76" class="inputstyle2" style="width:546px; height:200px;"><?=$row[content]?></textarea></div>

									<div style="clear:left; float:left; width:120px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#E2F0FC; color:#003366;">메 모 </div>
									<div style="float:left; width:625px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><input type="text" name="memo" value="<?=$row[memo]?>" class="inputstyle2" style="width:546px"></div>
									</form>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($_m1_2_1_row[_m1_2_1]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="coun_log_sub('$mode');";
										// $del_str="if(confirm('해당 상담내용을 삭제 하시겠습니까?')==1) location.href='basic_post.php?s_di=1&amp;mode=del&amp;seq=$seq'";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd;">
								<input type="button" value="<?=$sub_str?>" onclick="<?=$submit_str?>">
								<input type="button" value="목록으로" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=3&amp;ss_di=1' ">
							</div>
							<div style="float:right; height:30px; width:150px; padding:8px 10px 0 0; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd; text-align:right;">
								<?if($mode=='modify'){?><!-- <input type="button" value="내용삭제" onclick="<?=$del_str?>"> --><? } ?>
							</div>
