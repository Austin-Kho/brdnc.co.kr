							<!-- 업무일지 신규 수정 등록 파일 -->
								<!-- ================================= 거래처 contents S ================================= -->
								<div>
									<?
										if($mode=='modify'){ // 수정인 경우 해당 데이터 가져 오기
											$seq = $_REQUEST['seq'];
											$qry = "SELECT * FROM cms_work_log WHERE seq='$seq'";
											$rlt = mysql_query($qry, $connect);
											$row = mysql_fetch_array($rlt);	
											$sub_str = "저장하기";
											$w_date = $row[work_date];

											$pj_where = explode("-", $row[pj_where]);

											//현장명 구하기
											$pj_name_rlt = mysql_query("SELECT pj_name FROM cms_project_info WHERE seq='$row[pj_seq]' ", $connect);
											$pj_name_row = mysql_fetch_array($pj_name_rlt);
											// 소속본부 구하기
											$headq_rlt = mysql_query("SELECT headq FROM cms_resource_headq WHERE seq='$pj_where[0]' ", $connect);
											$headq_row = mysql_fetch_array($headq_rlt);
											// 소속 팀 구하기										
											$team_rlt = mysql_query("SELECT team FROM cms_resource_team WHERE seq='$pj_where[1]' ", $connect);
											$team_row = mysql_fetch_array($team_rlt);
											/***************** 당일청계약 내용 *******************/
											$co_sort = explode("/", $row[co_sort]);
											$c_cust_name = explode("/", $row[c_cust_name]);
											$dong_ho = explode("/", $row[dong_ho]);
											$due_date = explode("/", $row[due_date]);
											$c_worker = explode("/", $row[c_worker]);
											/***************** 당일청계약 내용 *******************/

											/***************** 주요고객 진행사항 *******************/
											$d_cust_name = explode("/", $row[d_cust_name]);
											$d_content = explode("/", $row[d_content]);
											$d_worker = explode("/", $row[d_worker]);
											/***************** 주요고객 진행사항 *******************/

											/***************** 익일방문예정 고객 *******************/
											$n_cust_name = explode("/", $row[n_cust_name]);
											$n_content = explode("/", $row[n_content]);
											$n_worker = explode("/", $row[n_worker]);
											/***************** 익일방문예정 고객 *******************/

										}else{
											// 현장명 구하기
											$pj_name_rlt = mysql_query("SELECT pj_name FROM cms_project_info WHERE seq='$pj_list' ", $connect);
											$pj_name_row = mysql_fetch_array($pj_name_rlt);

											$sub_str = "등록하기";
											$w_date = date('Y-m-d');
										}
									?>
									<div style="height:18px; background-color:#e8e8e8; margin-bottom:2px;"></div>
									<div style="clear:left; float:left; width:15px; height:24px; padding-top:10px;"><img src="../images/list_bt.jpg" border="0" alt=""></div>
									<div style="float:left; width:265px; height:28px; padding-top:8px; color:#000000;"><b><?if($mode=='reg'){?>업무일지 신규등록<?}else if($mode=='modify'){ echo $w_date." [ <font color='#000099'>".$headq_row[headq]."-".$team_row[team]."</font> ] 업무일지"; } ?></b></div>
									<div style="float:left; width:250px; height:28px; padding-top:8px; text-align:center; color:#000000;"><b><?if($pj_list) echo "[ ".$pj_name_row[pj_name]." 현장 ]";?></b></div>
									
									<form name="form1" method="post" action="work_rp_post.php">
									<input type="hidden" name="s_di" value="<?=$s_di?>">
									<input type="hidden" name="mode" value="<?=$mode?>">
									<input type="hidden" name="pj_seq" value="<?=$pj_list?>">
									<input type="hidden" name="headq" value="<?=$headq?>">
									<input type="hidden" name="team" value="<?=$team?>">
									<?if($mode=='modify'){?><input type="hidden" name="seq" value="<?if($mode=='reg'){ echo date('Y-m-d');} else{ echo $row[seq];}?>"><? } ?>

									<div style="clear:left; width:120px; padding:7px 0 0 15px;" class="blue_title">작성일자 <font color="red">*</font></div>
									<div style="width:240px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd">
										<div style="float:left;">
											<input type="text" name="work_date" id="work_date" value="<?=$w_date?>" size="30" class="inputstyle2" style="height:17px; width:140px;" onclick="cal_add(this); event.cancelBubble=true"  readonly  onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')">
											<a href="javascript:" onclick="cal_add(document.getElementById('work_date'),this); event.cancelBubble=true"> <img src="http://cigiko.cafe24.com/cms/images/calendar.jpg" border="0" alt="" /></a>
											<!-- <a href="javascript:" onclick=" to_del('work_date');" title="지우기"><img src="../images/del.jpg" border="0" alt=""></a> -->
										</div>
										
									</div>
									<div style="width:120px; padding:7px 0 0 15px;" class="blue_title">출근인원(팀장포함) <font color="red">*</font></div>
									<div style="width:240px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd"><input type="text" name="work_num" value="<?=$row[work_num]?>" class="inputstyle2" style="width:130px;"> 명</div>
									
									<div style="clear:left; height:26px; padding:8px 0 0 15px; color:#000000"><b><font color="red">*</font> 계약 사항</b></div>

									<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:1px 1px 0 0;" class="blue_title">당일 청약(가계약)건 </div>
									<div style="width:240px; height:26px; padding:5px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd">
										<div style="float:left; width:100px;"> 청약 : <input type="text" name="pro_cont_num" value="<?=$row[pro_cont_num]?>" class="inputstyle2" style="width:30px; <?if($row[pro_cont_num]) echo "background-color:#ddffdd;";?>"> 건 </div>
										<div style="float:left; padding-left:10px;"> 청약해지 : <input type="text" name="pro_cont_c_num" value="<?=$row[pro_cont_c_num]?>" class="inputstyle2" style="width:30px; <?if($row[pro_cont_c_num]) echo "background-color:#ffd9dd;";?>"> 건 </div>
									</div>
									<div style="width:120px; padding:7px 0 0 15px; border-width:1px 1px 0 0;" class="blue_title">당일 계약(정계약)건</div>
									<div style="width:240px; height:26px; padding:5px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd"><input type="text" name="cont_num" value="<?=$row[cont_num]?>" class="inputstyle2" style="width:130px; <?if($row[cont_num]) echo "background-color:#ddeaff;";?>"> 건</div>

									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd;">
											<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 0 1px 0; border-color:#E2F0FC;" class="blue_title">당일 (청)계약 내용</div>				
											<div style="width:110px; padding-top:7px; border-width:0 1px 1px 1px; background-color:#eef3eb; text-align:center;" class="blue_title">구 분</div>
											<div style="width:100px; padding-top:7px; border-width:0 1px 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">고객명</div>
											<div style="width:110px; padding-top:7px; border-width:0 1px 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">동호수</div>
											<div style="width:120px; padding-top:7px; border-width:0 1px 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">계약 예정일</div>
											<div style="width:110px; padding-top:7px; border-width:0 1px 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">담당자</div>
											<div style="width:84px; padding-top:7px; border-width:0 0 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">입력란 추가</div>
											

											<!-- ================================================================== (청)계약 내용 입력 폼1 ====================================================================== -->
											<div id="cont_1">
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_1" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_1.disabled=0; else this.form.due_date_1.disabled=1; this.form.due_date_1.value='' ">
															<option value="" <?if(!$co_sort[0]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[0]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[0]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[0]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_1" value="<?=$c_cust_name[0]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[0]) $obj_1 = explode("-", $dong_ho[0]) ?>
														<input type="text" name="dong_1" value="<?=$obj_1[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_1" value="<?=$obj_1[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_1" value="<?=$due_date[0]?>" id="due_date_1" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[0]||$co_sort[0]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_1'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_1" value="<?=$c_worker[0]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_1" id="add_1" onclick="cont_add(this,2,1);" <? if(count($co_sort)>1) echo "checked "; if(count($co_sort)>2) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼1 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼2 ====================================================================== -->
											<div id="cont_2" <?if(count($co_sort)<2) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_2" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_2.disabled=0; else this.form.due_date_2.disabled=1; this.form.due_date_2.value='' ">
															<option value="" <?if(!$co_sort[1]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[1]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[1]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[1]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_2" value="<?=$c_cust_name[1]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[1]) $obj_2 = explode("-", $dong_ho[1]) ?>
														<input type="text" name="dong_2" value="<?=$obj_2[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_2" value="<?=$obj_2[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_2" value="<?=$due_date[1]?>" id="due_date_2" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[1]||$co_sort[1]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_2'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_2" value="<?=$c_worker[1]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_2" id="add_2" onclick="cont_add(this,3,1);" <? if(count($co_sort)>2) echo "checked "; if(count($co_sort)>3) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼2 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼3 ====================================================================== -->
											<div id="cont_3" <?if(count($co_sort)<3) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_3" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_3.disabled=0; else this.form.due_date_3.disabled=1; this.form.due_date_3.value='' ">
															<option value="" <?if(!$co_sort[2]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[2]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[2]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[2]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_3" value="<?=$c_cust_name[2]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[2]) $obj_3 = explode("-", $dong_ho[2]) ?>
														<input type="text" name="dong_3" value="<?=$obj_3[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_3" value="<?=$obj_3[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_3" value="<?=$due_date[2]?>" id="due_date_3" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[2]||$co_sort[2]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_3'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_3" value="<?=$c_worker[2]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_3" id="add_3" onclick="cont_add(this,4,1);" <? if(count($co_sort)>3) echo "checked "; if(count($co_sort)>4) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼3 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼4 ====================================================================== -->
											<div id="cont_4" <?if(count($co_sort)<4) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_4" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_4.disabled=0; else this.form.due_date_4.disabled=1; this.form.due_date_4.value='' ">
															<option value="" <?if(!$co_sort[3]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[3]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[3]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[3]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_4" value="<?=$c_cust_name[3]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[3]) $obj_4 = explode("-", $dong_ho[3]) ?>
														<input type="text" name="dong_4" value="<?=$obj_4[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_4" value="<?=$obj_4[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_4" value="<?=$due_date[3]?>" id="due_date_4" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[3]||$co_sort[3]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_4'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_4" value="<?=$c_worker[3]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_4" id="add_4" onclick="cont_add(this,5,1);" <? if(count($co_sort)>4) echo "checked "; if(count($co_sort)>5) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼4 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼5 ====================================================================== -->
											<div id="cont_5" <?if(count($co_sort)<5) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_5" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_5.disabled=0; else this.form.due_date_5.disabled=1; this.form.due_date_5.value='' ">
															<option value="" <?if(!$co_sort[4]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[4]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[4]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[4]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_5" value="<?=$c_cust_name[4]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[4]) $obj_5 = explode("-", $dong_ho[4]) ?>
														<input type="text" name="dong_5" value="<?=$obj_5[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_5" value="<?=$obj_5[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_5" value="<?=$due_date[4]?>" id="due_date_5" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[4]||$co_sort[4]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_5'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_5" value="<?=$c_worker[4]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_5" id="add_5" onclick="cont_add(this,6,1);" <? if(count($co_sort)>5) echo "checked "; if(count($co_sort)>6) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼5 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼6 ====================================================================== -->
											<div id="cont_6" <?if(count($co_sort)<6) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_6" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_6.disabled=0; else this.form.due_date_6.disabled=1; this.form.due_date_6.value='' ">
															<option value="" <?if(!$co_sort[5]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[5]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[5]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[5]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_6" value="<?=$c_cust_name[5]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[5]) $obj_6 = explode("-", $dong_ho[5]) ?>
														<input type="text" name="dong_6" value="<?=$obj_6[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_6" value="<?=$obj_6[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_6" value="<?=$due_date[5]?>" id="due_date_6" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[5]||$co_sort[5]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_6'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_6" value="<?=$c_worker[5]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_6" id="add_6" onclick="cont_add(this,7,1);" <? if(count($co_sort)>6) echo "checked "; if(count($co_sort)>7) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼6 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼7 ====================================================================== -->
											<div id="cont_7" <?if(count($co_sort)<7) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_7" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_7.disabled=0; else this.form.due_date_7.disabled=1; this.form.due_date_7.value='' ">
															<option value="" <?if(!$co_sort[6]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[6]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[6]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[6]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_7" value="<?=$c_cust_name[6]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[6]) $obj_7 = explode("-", $dong_ho[6]) ?>
														<input type="text" name="dong_7" value="<?=$obj_7[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_7" value="<?=$obj_7[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_7" value="<?=$due_date[6]?>" id="due_date_7" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[6]||$co_sort[6]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_7'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_7" value="<?=$c_worker[6]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_7" id="add_7" onclick="cont_add(this,8,1);" <? if(count($co_sort)>7) echo "checked "; if(count($co_sort)>8) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼7 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼8 ====================================================================== -->
											<div id="cont_8" <?if(count($co_sort)<8) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_8" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_8.disabled=0; else this.form.due_date_8.disabled=1; this.form.due_date_8.value='' ">
															<option value="" <?if(!$co_sort[7]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[7]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[7]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[7]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_8" value="<?=$c_cust_name[7]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[7]) $obj_8 = explode("-", $dong_ho[7]) ?>
														<input type="text" name="dong_8" value="<?=$obj_8[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_8" value="<?=$obj_8[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_8" value="<?=$due_date[7]?>" id="due_date_8" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[7]||$co_sort[7]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_8'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_8" value="<?=$c_worker[7]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_8" id="add_8" onclick="cont_add(this,9,1);" <? if(count($co_sort)>8) echo "checked "; if(count($co_sort)>9) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼8 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼9 ====================================================================== -->
											<div id="cont_9" <?if(count($co_sort)<9) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_9" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_9.disabled=0; else this.form.due_date_9.disabled=1; this.form.due_date_9.value='' ">
															<option value="" <?if(!$co_sort[8]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[8]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[8]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[8]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_9" value="<?=$c_cust_name[8]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[8]) $obj_9 = explode("-", $dong_ho[8]) ?>
														<input type="text" name="dong_9" value="<?=$obj_9[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_9" value="<?=$obj_9[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_9" value="<?=$due_date[8]?>" id="due_date_9" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[8]||$co_sort[8]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_9'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_9" value="<?=$c_worker[8]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_9" id="add_9" onclick="cont_add(this,10,1);" <? if(count($co_sort)>9) echo "checked "; if(count($co_sort)>10) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼9 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼10 ====================================================================== -->
											<div id="cont_10" <?if(count($co_sort)<10) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_10" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_10.disabled=0; else this.form.due_date_10.disabled=1; this.form.due_date_10.value='' ">
															<option value="" <?if(!$co_sort[9]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[9]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[9]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[9]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_10" value="<?=$c_cust_name[9]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[9]) $obj_10 = explode("-", $dong_ho[9]) ?>
														<input type="text" name="dong_10" value="<?=$obj_10[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_10" value="<?=$obj_10[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_10" value="<?=$due_date[9]?>" id="due_date_10" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[9]||$co_sort[9]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_10'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_10" value="<?=$c_worker[9]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_10" id="add_10" onclick="cont_add(this,11,1);" <? if(count($co_sort)>10) echo "checked "; if(count($co_sort)>11) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼10 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼11 ====================================================================== -->
											<div id="cont_11" <?if(count($co_sort)<11) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_11" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_11.disabled=0; else this.form.due_date_11.disabled=1; this.form.due_date_11.value='' ">
															<option value="" <?if(!$co_sort[10]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[10]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[10]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[10]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_11" value="<?=$c_cust_name[10]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[10]) $obj_11 = explode("-", $dong_ho[10]) ?>
														<input type="text" name="dong_11" value="<?=$obj_11[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_11" value="<?=$obj_11[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_11" value="<?=$due_date[10]?>" id="due_date_11" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[10]||$co_sort[10]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_11'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_11" value="<?=$c_worker[10]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><input type="checkbox" name="add_11" id="add_11" onclick="cont_add(this,12,1);" <? if(count($co_sort)>11) echo "checked "; if(count($co_sort)>12) echo "disabled";?>> 추가</div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼11 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼12 ====================================================================== -->
											<div id="cont_12" <?if(count($co_sort)<12) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:625px;">
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<select name="co_sort_12" class="inputstyle2" style="height:22px; width:90px;" onchange="if(this.value==1) this.form.due_date_12.disabled=0; else this.form.due_date_12.disabled=1; this.form.due_date_12.value='' ">
															<option value="" <?if(!$co_sort[11]) echo "selected";?>> 선 택
															<option value="1" <?if($co_sort[11]==1) echo "selected";?>> 청약(가계약)
															<option value="2" <?if($co_sort[11]==2) echo "selected";?>> 청약해지
															<option value="3" <?if($co_sort[11]==3) echo "selected";?>> 계약(정계약)
														</select>
													</div>
													<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_cust_name_12" value="<?=$c_cust_name[11]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[11]) $obj_12 = explode("-", $dong_ho[11]) ?>
														<input type="text" name="dong_12" value="<?=$obj_12[0]?>" class="inputstyle2" style="width:30px"> - <input type="text" name="ho_12" value="<?=$obj_12[1]?>" class="inputstyle2" style="width:35px">
													</div>
													<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<input type="text" name="due_date_12" value="<?=$due_date[11]?>" id="due_date_12" size="30" class="inputstyle2" style="height:17px; width:80px;" onclick="openCalendar(this)" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2')" <?if(!$co_sort[11]||$co_sort[11]<>1) echo "disabled";?>><a href="javascript:" onclick="openCalendar(document.getElementById('due_date_12'));"> <img src="../images/calendar.jpg" border="0" alt="" /></a>
													</div>
													<div style="float:left; width:110px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><input type="text" name="c_worker_12" value="<?=$c_worker[11]?>" class="inputstyle2" style="width:70px"></div>
													<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><!-- <input type="checkbox" name="add_12" id="add_12" onclick="cont_add(this,2,1);" <? if($co_sort>1) echo "checked "; if($co_sort>2) echo "disabled";?>> 추가 --></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼12 ====================================================================== -->
										</td>
									</tr>
									</table>


									<div style="clear:left; height:26px; padding:8px 0 0 15px; color:#000000"><b><font color="red">*</font> 당일 업무 내용</b></div>

									<div style="clear:left; width:120px; height:56px; padding:7px 0 0 15px;" class="blue_title">당일 영업현황 </div>
									<div style="float:left; width:638px; border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<div style="float:left; width:100px; height:26px; padding-top:5px; color:#000000; text-align:center; background-color:#eef3eb;">지명콜수(팀) </div>
										<div style="float:left; width:100px;  height:26px; padding:5px 0 0 10px;"><input type="text" name="t_ca_num" value="<?=$row[t_ca_num]?>" class="inputstyle2" style="width:38px"> 건</div>
										<div style="float:left; width:100px; height:26px; padding-top:5px; color:#000000; text-align:center; background-color:#eef3eb;">지명방문자수 </div>
										<div style="float:left; width:100px;  height:26px; padding:5px 0 0 10px;"><input type="text" name="t_wa_num" value="<?=$row[t_wa_num]?>" class="inputstyle2" style="width:38px"> 건</div>
										<div style="float:left; width:100px; height:26px; padding-top:5px; color:#000000; text-align:center; background-color:#eef3eb;"> TM 건수 </div>
										<div style="float:left; width:100px;  height:26px; padding:5px 0 0 10px;"><input type="text" name="tm_num" value="<?=$row[tm_num]?>" class="inputstyle2" style="width:38px"> 건</div>

									</div>
									<div style="float:left; width:638px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd;">
										<div style="float:left; width:100px; height:26px; padding-top:5px; color:#000000; text-align:center; background-color:#eef3eb;">일반콜수(본부) </div>
										<div style="float:left; width:100px;  height:26px; padding:5px 0 0 10px;"><input type="text" name="h_ca_num" value="<?=$row[h_ca_num]?>" class="inputstyle2" style="width:38px"> 건</div>
										<div style="float:left; width:100px; height:26px; padding-top:5px; color:#000000; text-align:center; background-color:#eef3eb;">일반방문자수 </div>
										<div style="float:left; width:100px;  height:26px; padding:5px 0 0 10px;  "><input type="text" name="h_wa_num" value="<?=$row[h_wa_num]?>" class="inputstyle2" style="width:38px"> 건</div>
										<div style="float:left; width:100px;  height:26px; padding-top:5px;color:#000000; text-align:center; background-color:#eef3eb;">DM/SMS 발송 </div>
										<div style="float:left; width:100px;  height:26px; padding:5px 0 0 10px;"><input type="text" name="dm_sms_num" value="<?=$row[dm_sms_num]?>" class="inputstyle2" style="width:38px"> 건</div>
									</div>

									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="border-width:0 0 1px 0; border-style:solid; border-color:#dddddd;">
											<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 0 1px 0; border-color:#E2F0FC;" class="blue_title">주요고객 진행사항 <font color="red">*</font></div>
											<div style="float:left; width:90px; height:24px; padding-top:7px; border-width:0 1px 1px 1px; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">고객명</div>
											<div style="float:left; width:370px; height:24px; padding-top:7px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">진 행 사 항</div>
											<div style="float:left; width:90px; height:24px; padding-top:7px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">담당자</div>
											<div style="float:left; width:84px; height:24px; padding-top:7px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">입력란 추가</div>
											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼1 ====================================================================== -->
											<div id="coun_1">
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_1" value="<?=$d_cust_name[0]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_1" value="<?=$d_content[0]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_1" value="<?=$d_worker[0]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_1" id="add_c_1" onclick="cont_add(this,2,2);" <? if(count($d_cust_name)>1) echo "checked "; if(count($d_cust_name)>2) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼1 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼2 ====================================================================== -->
											<div id="coun_2" <?if(count($d_cust_name)<2) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_2" value="<?=$d_cust_name[1]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_2" value="<?=$d_content[1]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_2" value="<?=$d_worker[1]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_2" id="add_c_2" onclick="cont_add(this,3,2);" <? if(count($d_cust_name)>2) echo "checked "; if(count($d_cust_name)>3) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼2 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼3 ====================================================================== -->
											<div id="coun_3" <?if(count($d_cust_name)<3) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_3" value="<?=$d_cust_name[2]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_3" value="<?=$d_content[2]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_3" value="<?=$d_worker[2]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_3" id="add_c_3" onclick="cont_add(this,4,2);" <? if(count($d_cust_name)>3) echo "checked "; if(count($d_cust_name)>4) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼3 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼4 ====================================================================== -->
											<div id="coun_4" <?if(count($d_cust_name)<4) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_4" value="<?=$d_cust_name[3]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_4" value="<?=$d_content[3]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_4" value="<?=$d_worker[3]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_4" id="add_c_4" onclick="cont_add(this,5,2);" <? if(count($d_cust_name)>4) echo "checked "; if(count($d_cust_name)>5) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼4 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼5 ====================================================================== -->
											<div id="coun_5" <?if(count($d_cust_name)<5) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_5" value="<?=$d_cust_name[4]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_5" value="<?=$d_content[4]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_5" value="<?=$d_worker[4]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_5" id="add_c_5" onclick="cont_add(this,6,2);" <? if(count($d_cust_name)>5) echo "checked "; if(count($d_cust_name)>6) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼5 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼6 ====================================================================== -->
											<div id="coun_6" <?if(count($d_cust_name)<6) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_6" value="<?=$d_cust_name[5]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_6" value="<?=$d_content[5]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_6" value="<?=$d_worker[5]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_6" id="add_c_6" onclick="cont_add(this,7,2);" <? if(count($d_cust_name)>6) echo "checked "; if(count($d_cust_name)>7) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼6 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼7 ====================================================================== -->
											<div id="coun_7" <?if(count($d_cust_name)<7) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_7" value="<?=$d_cust_name[6]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_7" value="<?=$d_content[6]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_7" value="<?=$d_worker[6]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_7" id="add_c_7" onclick="cont_add(this,8,2);" <? if(count($d_cust_name)>7) echo "checked "; if(count($d_cust_name)>8) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼7 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼8 ====================================================================== -->
											<div id="coun_8" <?if(count($d_cust_name)<8) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_8" value="<?=$d_cust_name[7]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_8" value="<?=$d_content[7]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_8" value="<?=$d_worker[7]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_8" id="add_c_8" onclick="cont_add(this,9,2);" <? if(count($d_cust_name)>8) echo "checked "; if(count($d_cust_name)>9) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼8 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼9 ====================================================================== -->
											<div id="coun_9" <?if(count($d_cust_name)<9) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_9" value="<?=$d_cust_name[8]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_9" value="<?=$d_content[8]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_9" value="<?=$d_worker[8]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_9" id="add_c_9" onclick="cont_add(this,10,2);" <? if(count($d_cust_name)>9) echo "checked "; if(count($d_cust_name)>10) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼9 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼10 ====================================================================== -->
											<div id="coun_10" <?if(count($d_cust_name)<10) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_10" value="<?=$d_cust_name[9]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_10" value="<?=$d_content[9]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_10" value="<?=$d_worker[9]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_10" id="add_c_10" onclick="cont_add(this,11,2);" <? if(count($d_cust_name)>10) echo "checked "; if(count($d_cust_name)>11) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼10 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼11 ====================================================================== -->
											<div id="coun_11" <?if(count($d_cust_name)<11) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_11" value="<?=$d_cust_name[10]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_11" value="<?=$d_content[10]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_11" value="<?=$d_worker[10]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_c_11" id="add_c_11" onclick="cont_add(this,12,2);" <? if(count($d_cust_name)>11) echo "checked "; if(count($d_cust_name)>12) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼11 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼12 ====================================================================== -->
											<div id="coun_12" <?if(count($d_cust_name)<12) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_cust_name_12" value="<?=$d_cust_name[11]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_content_12" value="<?=$d_content[11]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="d_worker_12" value="<?=$d_worker[11]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"></div>
											</div>											
											<!-- ================================================================== 주요고객 진행 사항 입력 폼12 ====================================================================== -->
										</td>
									</tr>
									</table>
									<div style="clear:left; width:120px; height:88px; padding:7px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">홍보 영업활동 <font color="red">*</font></div>
									<div style="float:left; width:625px; height:90px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<textarea name="d_sale_act" rows="3" cols="76" class="inputstyle2" style="width:539px; height:80px;" onfocus="this.select();"><?=$row[d_sale_act]?></textarea>
									</div>

									<div style="clear:left; height:26px; padding:8px 0 0 15px; color:#000000"><b><font color="red">*</font> 익일 업무 예정</b></div>

									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd;">
											<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 0 1px 0; border-color:#E2F0FC;" class="blue_title">익일 방문예정 고객 <font color="red">*</font></div>
											<div style="float:left; width:90px; height:24px; padding-top:7px; border-width:0 1px 1px 1px; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">고객명</div>
											<div style="float:left; width:370px; height:24px; padding-top:7px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">진행 내용 / 방문 예정시간 / 연락처</div>
											<div style="float:left; width:90px; height:24px; padding-top:7px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">담당자</div>
											<div style="float:left; width:84px; height:24px; padding-top:7px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">입력란 추가</div>
											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼1 ====================================================================== -->
											<div id="tomo_1">
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_1" value="<?=$n_cust_name[0]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_1" value="<?=$n_content[0]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_1" value="<?=$n_worker[0]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_1" id="add_t_1" onclick="cont_add(this,2,3);" <? if(count($n_cust_name)>1) echo "checked "; if(count($n_cust_name)>2) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼1 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼2 ====================================================================== -->
											<div id="tomo_2" <?if(count($n_cust_name)<2) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_2" value="<?=$n_cust_name[1]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_2" value="<?=$n_content[1]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_2" value="<?=$n_worker[1]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_2" id="add_t_2" onclick="cont_add(this,3,3);" <? if(count($n_cust_name)>2) echo "checked "; if(count($n_cust_name)>3) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼2 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼3 ====================================================================== -->
											<div id="tomo_3" <?if(count($n_cust_name)<3) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_3" value="<?=$n_cust_name[2]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_3" value="<?=$n_content[2]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_3" value="<?=$n_worker[2]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_3" id="add_t_3" onclick="cont_add(this,4,3);" <? if(count($n_cust_name)>3) echo "checked "; if(count($n_cust_name)>4) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼3 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼4 ====================================================================== -->
											<div id="tomo_4" <?if(count($n_cust_name)<4) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_4" value="<?=$n_cust_name[3]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_4" value="<?=$n_content[3]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_4" value="<?=$n_worker[3]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_4" id="add_t_4" onclick="cont_add(this,5,3);" <? if(count($n_cust_name)>4) echo "checked "; if(count($n_cust_name)>5) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼4 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼5 ====================================================================== -->
											<div id="tomo_5" <?if(count($n_cust_name)<5) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_5" value="<?=$n_cust_name[4]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_5" value="<?=$n_content[4]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_5" value="<?=$n_worker[4]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_5" id="add_t_5" onclick="cont_add(this,6,3);" <? if(count($n_cust_name)>5) echo "checked "; if(count($n_cust_name)>6) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼5 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼6 ====================================================================== -->
											<div id="tomo_6" <?if(count($n_cust_name)<6) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_6" value="<?=$n_cust_name[5]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_6" value="<?=$n_content[5]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_6" value="<?=$n_worker[5]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_6" id="add_t_6" onclick="cont_add(this,7,3);" <? if(count($n_cust_name)>6) echo "checked "; if(count($n_cust_name)>7) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼6 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼7 ====================================================================== -->
											<div id="tomo_7" <?if(count($n_cust_name)<7) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_7" value="<?=$n_cust_name[6]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_7" value="<?=$n_content[6]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_7" value="<?=$n_worker[6]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_7" id="add_t_7" onclick="cont_add(this,8,3);" <? if(count($n_cust_name)>7) echo "checked "; if(count($n_cust_name)>8) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼7 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼8 ====================================================================== -->
											<div id="tomo_8" <?if(count($n_cust_name)<8) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_8" value="<?=$n_cust_name[7]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_8" value="<?=$n_content[7]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_8" value="<?=$n_worker[7]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_8" id="add_t_8" onclick="cont_add(this,9,3);" <? if(count($n_cust_name)>8) echo "checked "; if(count($n_cust_name)>9) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼8 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼9 ====================================================================== -->
											<div id="tomo_9" <?if(count($n_cust_name)<9) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_9" value="<?=$n_cust_name[8]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_9" value="<?=$n_content[8]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_9" value="<?=$n_worker[8]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_9" id="add_t_9" onclick="cont_add(this,10,3);" <? if(count($n_cust_name)>9) echo "checked "; if(count($n_cust_name)>10) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼9 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼10 ====================================================================== -->
											<div id="tomo_10" <?if(count($n_cust_name)<10) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_10" value="<?=$n_cust_name[9]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_10" value="<?=$n_content[9]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_10" value="<?=$n_worker[9]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_10" id="add_t_10" onclick="cont_add(this,11,3);" <? if(count($n_cust_name)>10) echo "checked "; if(count($n_cust_name)>11) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼10 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼11 ====================================================================== -->
											<div id="tomo_11" <?if(count($n_cust_name)<11) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_11" value="<?=$n_cust_name[10]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_11" value="<?=$n_content[10]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_11" value="<?=$n_worker[10]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;">
													<input type="checkbox" name="add_t_11" id="add_t_11" onclick="cont_add(this,12,3);" <? if(count($n_cust_name)>11) echo "checked "; if(count($n_cust_name)>12) echo "disabled";?>> 추가
												</div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼11 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼12 ====================================================================== -->
											<div id="tomo_12" <?if(count($n_cust_name)<12) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_cust_name_12" value="<?=$n_cust_name[11]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:370px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_content_12" value="<?=$n_content[11]?>" class="inputstyle2" style="width:350px">
												</div>
												<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
													<input type="text" name="n_worker_12" value="<?=$n_worker[11]?>" class="inputstyle2" style="width:70px">
												</div>
												<div style="float:left; width:70px; height:26px; padding-top:5px; text-align:center;"><!-- <input type="checkbox" name="add_t_12" id="add_t_12" onclick="cont_add(2,3);"> 추가 --></div>
											</div>											
											<!-- ================================================================== 익일 방문 예정고객 입력 폼12 ====================================================================== -->
										</td>
									</tr>
									</table>
									<div style="clear:left; width:120px; height:88px; padding:7px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">익일 영업계획 <font color="red">*</font></div>
									<div style="float:left; width:625px; height:90px; padding:5px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<textarea name="n_sale_plan" rows="3" cols="76" class="inputstyle2" style="width:539px; height:80px;" onfocus="this.select();"><?=$row[n_sale_plan]?></textarea>
									</div>

									
									</form>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($mode=="reg") $str = "등록";
									if($mode=="modify") $str = "수정";
									if($sa_1_2_row[sa_1_2]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										if($mode=="reg"){
											$submit_str="work_log_sub('$member_row[is_company]', '$str');";
										}else if($mode=="modify"){
											$cd = strtotime($w_date);
											$retDAY = date('Y-m-d', mktime(0,0,0,date('m',$cd),date('d',$cd)+1,date('Y',$cd)));

											if(($member_row[is_admin]==1||date('Y-m-d')<=$retDAY)){// 관리자가 아니면 작성 익일 까지만 수정 가능
												$submit_str="work_log_sub('$member_row[is_company]', '$str');";
											}else{
												$submit_str = "alert('당일 또는 익일까지만 수정 가능합니다!');";												
											}											
										}
										// $del_str="if(confirm('해당 상담내용을 삭제 하시겠습니까?')==1) location.href='basic_post.php?s_di=1&amp;mode=del&amp;seq=$seq'";
									}
								?>
							<div style="clear:left; float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd; margin-top:10px;">
								<input type="button" value="<?=$sub_str?>" onclick="<?=$submit_str?>">
								<input type="button" value="목록으로" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=2&amp;ss_di=1' ">
							</div>
							<div style="float:right; height:30px; width:150px; padding:8px 10px 0 0; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd; text-align:right; margin-top:10px;">
								<?if($mode=='modify'){?><!-- <input type="button" value="내용삭제" onclick="<?=$del_str?>"> --><? } ?>
							</div>
