							<!-- 업무일지 열람 파일 -->
								<!-- ================================= 거래처 contents S ================================= -->
								<div>
									<?
										$seq = $_REQUEST['seq'];
										$qry = "SELECT * FROM cms_work_log WHERE seq='$seq'";
										$rlt = mysql_query($qry, $connect);
										$row = mysql_fetch_array($rlt);

										$pj_where = explode("-", $row[pj_where]);

										//현장명 구하기
										$pj_name_rlt = mysql_query("SELECT pj_name FROM cms_project1_info WHERE seq='$row[pj_seq]' ", $connect);
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

										/**************** Excel 출력 권한 및 데이터 관리 ****************/
											// 출력 권한
											if($_m1_1_2_row[_m1_1_2]<1){ // 해당 페이지에 대한 조회 권한이 없는 경우
												$excel_pop = "alert('출력 권한이 없습니다. 관리자에게 문의하여 주십시요!');";
											}else{
												$excel_pop = "location.href='excel_work_daily_log.php?seq=".$seq."&amp;date_=".$row[work_date]."&amp;pj_where=".$row[pj_where]." ' ";
											}
										/**************** Excel 출력 권한 및 데이터 관리 ****************/
									?>
									<div style="height:18px; background-color:#e8e8e8; margin-bottom:2px;"></div>
									<?
										$move_q = "SELECT MAX(work_date) AS x, MIN(work_date) AS n FROM cms_work_log WHERE pj_seq='$row[pj_seq]' AND pj_where='$row[pj_where]' ";
										$move_rlt = mysql_query($move_q, $connect);
										$move_row = mysql_fetch_array($move_rlt);

										$cd = strtotime($row[work_date]);
										$pre_date = date('Y-m-d', mktime(0,0,0,date('m',$cd),date('d',$cd)-1,date('Y',$cd)));
										$nex_date = date('Y-m-d', mktime(0,0,0,date('m',$cd),date('d',$cd)+1,date('Y',$cd)));

										// 어제 업무일지 seq 구하기
										$pre_rlt = mysql_query("SELECT seq FROM cms_work_log WHERE pj_seq='$row[pj_seq]' AND pj_where='$row[pj_where]' AND work_date='$pre_date' ", $connect);
										$pre_row = mysql_fetch_array($pre_rlt);
										// 내일 업무일지 seq 구하기
										$nex_rlt = mysql_query("SELECT seq FROM cms_work_log WHERE pj_seq='$row[pj_seq]' AND pj_where='$row[pj_where]' AND work_date='$nex_date' ", $connect);
										$nex_row = mysql_fetch_array($nex_rlt);
									?>
									<div style="clear:left; float:left; width:50px; height:31px; padding-top:5px; text-align:center;">
										<input type="button" value="Pre" onclick="location.href='sales_main.php?m_di=1&amp;s_di=2&amp;ss_di=3&amp;pj_list=<?=$pj_list?>&amp;headq=<?=$pj_where[0]?>&amp;team=<?=$pj_where[1]?>&amp;seq=<?=$pre_row[seq]?>' " <?if(trim($move_row[n])==trim($row[work_date])) echo "disabled";?>>
									</div>
									<div style="float:left; width:220px; height:28px; padding-top:8px; text-align:center; color:#000000;"><b><?=$row[work_date]." [ <font color='#000099'>".$headq_row[headq]."-".$team_row[team]."</font> ] 업무일지";?></b></div>
									<div style="float:left; width:50px; height:31px; padding-top:5px; text-align:center;">
										<input type="button" value="Nex" onclick="location.href='sales_main.php?m_di=1&amp;s_di=2&amp;ss_di=3&amp;pj_list=<?=$pj_list?>&amp;headq=<?=$pj_where[0]?>&amp;team=<?=$pj_where[1]?>&amp;seq=<?=$nex_row[seq]?>' " <?if(trim($move_row[x])==trim($row[work_date])) echo "disabled";?>>
									</div>
									<div style="float:left; width:250px; height:28px; padding:8px 0 0 20px; color:#000000;"><b><?="[ ".$pj_name_row[pj_name]." 현장 ]"?></b></div>



									<div style="float:right; height:18px; padding:18px 10px 0 0;">
										<a href="javascript:" onClick="<?=$excel_pop;?>"><img src="../images/excel_icon.jpg" height="10" border="0" alt="" /> <span style="font-size:12px">EXCEL로 출력</span></a>
									</div>
									<?
										switch (date('w', strtotime($row[work_date]))){
											 case 0 : $day = "일요일"; break;
											 case 1 : $day = "월요일"; break;
											 case 2 : $day = "화요일"; break;
											 case 3 : $day = "수요일"; break;
											 case 4 : $day = "목요일"; break;
											 case 5 : $day = "금요일"; break;
											 case 6 : $day = "토요일"; break;
										}
									?>
									<div style="clear:left; width:120px; padding:7px 0 0 15px;" class="blue_title">작성일자 <font color="red">*</font></div>
									<div style="width:250px; height:24px; padding-top:7px; border-width:1px 0 1px 0; text-align:center;" class="bor_ddd"><?=date('Y년 m월 d일 ', strtotime($row[work_date])).$day?></div>
									<div style="width:120px; padding:7px 0 0 15px;" class="blue_title">출근인원(팀장포함) <font color="red">*</font></div>
									<div style="width:220px; height:24px; padding:7px 30px 0 0; border-width:1px 0 1px 0; text-align:right;" class="bor_ddd"><?=$row[work_num]?> 명</div>
									<div style="clear:left; height:24px; padding:8px 0 0 15px; color:#000000"><b><font color="red">*</font> 계약 사항</b></div>
									<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:1px 1px 0 0;" class="blue_title">당일 청약(가계약)건 </div>
									<div style="width:240px; height:24px; padding:7px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd">
										<div style="float:left; width:100px; padding-right:10px; text-align:right;"> 청약 : <?=$row[pro_cont_num]?> 건 </div>
										<div style="float:left; width:100px; padding-right:10px; text-align:right;"> 청약해지 : <?=$row[pro_cont_c_num]?> 건 </div>
									</div>
									<div style="width:120px; padding:7px 0 0 15px; border-width:1px 1px 0 0;" class="blue_title">당일 계약(정계약)건</div>
									<div style="width:220px; height:24px; padding:7px 30px 0 0; border-width:1px 0 0 0; text-align:right;" class="bor_ddd"> <?=$row[cont_num]?> 건
									</div>

									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd;">
											<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 0 1px 0; border-color:#E2F0FC;" class="blue_title">당일 (청)계약 내용</div>
											<div style="width:100px; padding-top:7px; border-width:0 1px 1px 1px; background-color:#eef3eb; text-align:center;" class="blue_title">구 분</div>
											<div style="width:110px; padding-top:7px; border-width:0 1px 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">고객명</div>
											<div style="width:155px; padding-top:7px; border-width:0 1px 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">동호수</div>
											<div style="width:155px; padding-top:7px; border-width:0 1px 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">계약 예정일</div>
											<div style="width:115px; padding-top:7px; border-width:0 0 1px 0; background-color:#eef3eb; text-align:center;" class="blue_title">담당자</div>


											<!-- ================================================================== (청)계약 내용 입력 폼1 ====================================================================== -->
											<div id="cont_1">
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[0]) echo "-";?><?if($co_sort[0]==1) echo "청약(가계약)";?><?if($co_sort[0]==2) echo "청약해지";?><?if($co_sort[0]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[0]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[0]) $obj_1 = explode("-", $dong_ho[0]) ?><?=$obj_1[0]?> - <?=$obj_1[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[0]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[0]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼1 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼2 ====================================================================== -->
											<div id="cont_2" <?if(count($co_sort)<2) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[1]) echo "-";?><?if($co_sort[1]==1) echo "청약(가계약)";?><?if($co_sort[1]==2) echo "청약해지";?><?if($co_sort[1]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[1]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[1]) $obj_2 = explode("-", $dong_ho[1]) ?><?=$obj_2[0]?> - <?=$obj_2[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[1]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[1]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼2 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼3 ====================================================================== -->
											<div id="cont_3" <?if(count($co_sort)<3) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[2]) echo "-";?><?if($co_sort[2]==1) echo "청약(가계약)";?><?if($co_sort[2]==2) echo "청약해지";?><?if($co_sort[2]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[2]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[2]) $obj_3 = explode("-", $dong_ho[2]) ?><?=$obj_3[0]?> - <?=$obj_3[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[2]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[2]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼3 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼4 ====================================================================== -->
											<div id="cont_4" <?if(count($co_sort)<4) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[3]) echo "-";?><?if($co_sort[3]==1) echo "청약(가계약)";?><?if($co_sort[3]==2) echo "청약해지";?><?if($co_sort[3]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[3]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[3]) $obj_4 = explode("-", $dong_ho[3]) ?><?=$obj_4[0]?> - <?=$obj_4[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[3]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[3]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼4 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼5 ====================================================================== -->
											<div id="cont_5" <?if(count($co_sort)<5) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[4]) echo "-";?><?if($co_sort[4]==1) echo "청약(가계약)";?><?if($co_sort[4]==2) echo "청약해지";?><?if($co_sort[4]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[4]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[4]) $obj_5 = explode("-", $dong_ho[4]) ?><?=$obj_5[0]?> - <?=$obj_5[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[4]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[4]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼5 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼6 ====================================================================== -->
											<div id="cont_6" <?if(count($co_sort)<6) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[5]) echo "-";?><?if($co_sort[5]==1) echo "청약(가계약)";?><?if($co_sort[5]==2) echo "청약해지";?><?if($co_sort[5]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[5]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[5]) $obj_6 = explode("-", $dong_ho[5]) ?><?=$obj_6[0]?> - <?=$obj_6[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[5]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[5]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼6 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼7 ====================================================================== -->
											<div id="cont_7" <?if(count($co_sort)<7) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[6]) echo "-";?><?if($co_sort[6]==1) echo "청약(가계약)";?><?if($co_sort[6]==2) echo "청약해지";?><?if($co_sort[6]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[6]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[6]) $obj_7 = explode("-", $dong_ho[6]) ?><?=$obj_7[0]?> - <?=$obj_7[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[6]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[6]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼7 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼8 ====================================================================== -->
											<div id="cont_8" <?if(count($co_sort)<8) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[7]) echo "-";?><?if($co_sort[7]==1) echo "청약(가계약)";?><?if($co_sort[7]==2) echo "청약해지";?><?if($co_sort[7]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[7]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[7]) $obj_8 = explode("-", $dong_ho[7]) ?><?=$obj_8[0]?> - <?=$obj_8[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[7]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[7]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼8 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼9 ====================================================================== -->
											<div id="cont_9" <?if(count($co_sort)<9) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[8]) echo "-";?><?if($co_sort[8]==1) echo "청약(가계약)";?><?if($co_sort[8]==2) echo "청약해지";?><?if($co_sort[8]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[8]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[8]) $obj_9 = explode("-", $dong_ho[8]) ?><?=$obj_9[0]?> - <?=$obj_9[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[8]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[8]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼9 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼10 ====================================================================== -->
											<div id="cont_10" <?if(count($co_sort)<10) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[9]) echo "-";?><?if($co_sort[9]==1) echo "청약(가계약)";?><?if($co_sort[9]==2) echo "청약해지";?><?if($co_sort[9]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[9]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[9]) $obj_10 = explode("-", $dong_ho[9]) ?><?=$obj_10[0]?> - <?=$obj_10[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[9]?></div>
													<div style="float:left; width:115px; height:24px; text-align:center;"><?=$c_worker[9]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼10 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼11 ====================================================================== -->
											<div id="cont_11" <?if(count($co_sort)<11) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[10]) echo "-";?><?if($co_sort[10]==1) echo "청약(가계약)";?><?if($co_sort[10]==2) echo "청약해지";?><?if($co_sort[10]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[10]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[10]) $obj_11 = explode("-", $dong_ho[10]) ?><?=$obj_11[0]?> - <?=$obj_11[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[10]?></div>
													<div style="float:left; width:115px; height:24px; text-align:center;"><?=$c_worker[10]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼11 ====================================================================== -->
											<!-- ================================================================== (청)계약 내용 입력 폼12 ====================================================================== -->
											<div id="cont_12" <?if(count($co_sort)<12) echo "style='display:none;' ";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left;">
													<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<?if(!$co_sort[11]) echo "-";?><?if($co_sort[11]==1) echo "청약(가계약)";?><?if($co_sort[11]==2) echo "청약해지";?><?if($co_sort[11]==3) echo "계약(정계약)";?>
													</div>
													<div style="float:left; width:110px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$c_cust_name[11]?></div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;">
														<? if($dong_ho[11]) $obj_12 = explode("-", $dong_ho[11]) ?><?=$obj_12[0]?> - <?=$obj_12[1]?>
													</div>
													<div style="float:left; width:155px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$due_date[11]?></div>
													<div style="float:left; width:115px; height:24px; padding-top:7px; text-align:center;"><?=$c_worker[11]?></div>
												</div>
											</div>
											<!-- ================================================================== (청)계약 내용 입력 폼12 ====================================================================== -->
										</td>
									</tr>
									</table>


									<div style="clear:left; height:24px; padding:8px 0 0 15px; color:#000000"><b><font color="red">*</font> 당일 업무 내용</b></div>

									<div style="clear:left; width:120px; height:56px; padding:7px 0 0 15px;" class="blue_title">당일 영업현황 </div>
									<div style="float:left; width:638px; border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd; ">
										<div style="float:left; width:100px; height:24px; padding-top:7px; color:#000000; text-align:center; background-color:#eef3eb;">지명콜수(팀) </div>
										<div style="float:left; width:100px;  height:24px; padding:7px 10px 0 0; border-width:0 1px 0 1px; text-align:right;" class="bor_ddd"><?=$row[t_ca_num]?> 건</div>
										<div style="float:left; width:100px; height:24px; padding-top:7px; color:#000000; text-align:center; background-color:#eef3eb;">지명방문자수 </div>
										<div style="float:left; width:100px;  height:24px;  padding:7px 10px 0 0; border-width:0 1px 0 1px; text-align:right;" class="bor_ddd"><?=$row[t_wa_num]?> 건</div>
										<div style="float:left; width:100px; height:24px; padding-top:7px; color:#000000; text-align:center; background-color:#eef3eb;"> TM 건수 </div>
										<div style="float:left; width:100px;  height:24px;  padding:7px 10px 0 0; border-width:0 0 0 1px; text-align:right;" class="bor_ddd"><?=$row[tm_num]?> 건</div>
									</div>
									<div style="float:left; width:638px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd;">
										<div style="float:left; width:100px; height:24px; padding-top:7px; color:#000000; text-align:center; background-color:#eef3eb;">일반콜수(본부) </div>
										<div style="float:left; width:100px;  height:24px;  padding:7px 10px 0 0; border-width:0 1px 0 1px; text-align:right;" class="bor_ddd"><?=$row[h_ca_num]?> 건</div>
										<div style="float:left; width:100px; height:24px; padding-top:7px; color:#000000; text-align:center; background-color:#eef3eb;">일반방문자수 </div>
										<div style="float:left; width:100px;  height:24px;  padding:7px 10px 0 0; border-width:0 1px 0 1px; text-align:right;" class="bor_ddd"><?=$row[h_wa_num]?> 건</div>
										<div style="float:left; width:100px;  height:24px; padding-top:7px;color:#000000; text-align:center; background-color:#eef3eb;">DM/SMS 발송 </div>
										<div style="float:left; width:100px;  height:24px;  padding:7px 10px 0 0; border-width:0 0 0 1px; text-align:right;" class="bor_ddd"><?=$row[dm_sms_num]?> 건</div>
									</div>

									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="border-width:0 0 1px 0; border-style:solid; border-color:#dddddd;">
											<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 0 1px 0; border-color:#E2F0FC;" class="blue_title">주요고객 진행사항 <font color="red">*</font></div>
											<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 1px 1px; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">고객명</div>
											<div style="float:left; width:423px; height:24px; padding-top:7px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">진 행 사 항</div>
											<div style="float:left; width:113px; height:24px; padding-top:7px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">담당자</div>

											<!-- ================================================================== 주요고객 진행 사항 입력 폼1 ====================================================================== -->
											<div id="coun_1">
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[0]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[0]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[0]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼1 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼2 ====================================================================== -->
											<div id="coun_2" <?if(count($d_cust_name)<2) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[1]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[1]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[1]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼2 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼3 ====================================================================== -->
											<div id="coun_3" <?if(count($d_cust_name)<3) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[2]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[2]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[2]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼3 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼4 ====================================================================== -->
											<div id="coun_4" <?if(count($d_cust_name)<4) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[3]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[3]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[3]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼4 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼5 ====================================================================== -->
											<div id="coun_5" <?if(count($d_cust_name)<5) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[4]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[4]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[4]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼5 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼6 ====================================================================== -->
											<div id="coun_6" <?if(count($d_cust_name)<6) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[5]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[5]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[5]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼6 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼7 ====================================================================== -->
											<div id="coun_7" <?if(count($d_cust_name)<7) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[6]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[6]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[6]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼7 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼8 ====================================================================== -->
											<div id="coun_8" <?if(count($d_cust_name)<8) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[7]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[7]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[7]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼8 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼9 ====================================================================== -->
											<div id="coun_9" <?if(count($d_cust_name)<9) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[8]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[8]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[8]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼9 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼10 ====================================================================== -->
											<div id="coun_10" <?if(count($d_cust_name)<10) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[9]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[9]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[9]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼10 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼11 ====================================================================== -->
											<div id="coun_11" <?if(count($d_cust_name)<11) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[10]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[10]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[10]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼11 ====================================================================== -->
											<!-- ================================================================== 주요고객 진행 사항 입력 폼12 ====================================================================== -->
											<div id="coun_12" <?if(count($d_cust_name)<12) echo "style='display:none;'";?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$d_cust_name[11]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$d_content[11]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$d_worker[11]?></div>
											</div>
											<!-- ================================================================== 주요고객 진행 사항 입력 폼12 ====================================================================== -->
										</td>
									</tr>
									</table>
									<div style="clear:left; width:120px; height:90px; padding:7px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">홍보 영업활동 <font color="red">*</font></div>
									<div style="float:left; width:625px; height:90px; padding:7px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><?=nl2br($row[d_sale_act])?></div>

									<div style="clear:left; height:24px; padding:8px 0 0 15px; color:#000000"><b><font color="red">*</font> 익일 업무 예정</b></div>

									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="border-width:1px 0 1px 0; border-style:solid; border-color:#dddddd;">
											<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 0 1px 0; border-color:#E2F0FC;" class="blue_title">익일 방문예정 고객 <font color="red">*</font></div>
											<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 1px 1px; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">고객명</div>
											<div style="float:left; width:423px; height:24px; padding-top:7px; border-width:0 1px 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">진행 내용 / 방문 예정시간 / 연락처</div>
											<div style="float:left; width:113px; height:24px; padding-top:7px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; background-color:#eef3eb; color:#003366; text-align:center;">담당자</div>

											<!-- ================================================================== 익일 방문 예정고객 입력 폼1 ====================================================================== -->
											<div id="tomo_1">
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[0]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[0]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[0]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼1 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼2 ====================================================================== -->
											<div id="tomo_2" <?if(count($n_cust_name)<2) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[1]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[1]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[1]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼2 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼3 ====================================================================== -->
											<div id="tomo_3" <?if(count($n_cust_name)<3) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[2]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[2]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[2]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼3 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼4 ====================================================================== -->
											<div id="tomo_4" <?if(count($n_cust_name)<4) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[3]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[3]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[3]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼4 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼5 ====================================================================== -->
											<div id="tomo_5" <?if(count($n_cust_name)<5) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[4]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[4]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[4]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼5 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼6 ====================================================================== -->
											<div id="tomo_6" <?if(count($n_cust_name)<6) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[5]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[5]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[5]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼6 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼7 ====================================================================== -->
											<div id="tomo_7" <?if(count($n_cust_name)<7) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[6]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[6]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[6]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼7 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼8 ====================================================================== -->
											<div id="tomo_8" <?if(count($n_cust_name)<8) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[7]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[7]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[7]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼8 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼9 ====================================================================== -->
											<div id="tomo_9" <?if(count($n_cust_name)<9) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[8]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[8]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[8]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼9 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼10 ====================================================================== -->
											<div id="tomo_10" <?if(count($n_cust_name)<10) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[9]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[9]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[9]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼10 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼11 ====================================================================== -->
											<div id="tomo_11" <?if(count($n_cust_name)<11) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[10]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[10]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[10]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼11 ====================================================================== -->
											<!-- ================================================================== 익일 방문 예정고객 입력 폼12 ====================================================================== -->
											<div id="tomo_12" <?if(count($n_cust_name)<12) echo "style='display:none;'"?>>
												<div style="clear:left; width:120px; padding:7px 0 0 15px; border-width:0 1px 0 0;" class="blue_title"></div>
												<div style="float:left; width:100px; height:24px; padding-top:7px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd; text-align:center;"><?=$n_cust_name[11]?></div>
												<div style="float:left; width:413px; height:24px; padding:7px 0 0 10px; border-width:0 1px 0 0; border-style:solid; border-color:#dddddd;"><?=$n_content[11]?></div>
												<div style="float:left; width:113px; height:24px; padding-top:7px; text-align:center;"><?=$n_worker[11]?></div>
											</div>
											<!-- ================================================================== 익일 방문 예정고객 입력 폼12 ====================================================================== -->
										</td>
									</tr>
									</table>
									<div style="clear:left; width:120px; height:90px; padding:7px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">익일 영업계획 <font color="red">*</font></div>
									<div style="float:left; width:625px; height:90px; padding:7px 0 0 10px; border-width:0 0 1px 0; border-style:solid; border-color:#dddddd; "><?=nl2br($row[n_sale_plan])?></div>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($_m1_1_2_row[_m1_1_2]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="location.href='sales_main.php?m_di=1&amp;s_di=2&amp;ss_di=2&amp;mode=modify&amp;pj_list=".$row[pj_seq]."&amp;headq=".$pj_where[0]."&amp;team=".$pj_where[1]."&amp;seq=".$seq."' ";
									}
								?>
							<div style="clear:left; float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd; margin-top:10px;">
								<input type="button" value="수정하기" onclick="<?=$submit_str?>">
								<input type="button" value="목록으로" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=2&amp;ss_di=1' ">
							</div>
							<div style="float:right; height:30px; width:150px; padding:8px 10px 0 0; border-width:1px 0 0 0; border-style:solid; border-color:#dddddd; text-align:right; margin-top:10px;"></div>
