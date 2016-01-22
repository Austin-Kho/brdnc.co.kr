							<!-- 거래처 목록 파일 -->
								<div style="height:38px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid; margin:6px 0 10px 0;">
									<?
										$div_seq = $_REQUEST['div_seq'];
										$is_reti = $_REQUEST['is_reti'];
										$sh_con = $_REQUEST['sh_con'];
										$_search = $_REQUEST['_search'];
									?>
									<form method="post" action="">
									<div style="float:left; width:100px; height:28px; background-color:#f4f4f4; padding:10px 0px 0 0px; color:black; text-align:center;">부서 별</div>
									<div style="float:left; width:220px; height:28px; padding:9px 20px 0 10px;">
										<select name="div_seq" style="width:110px; height:21px;" onchange="submit();">
											<option value="" <?if(!$div_seq) echo "selected";?>> 전 체
											<?
												$d_qry = "SELECT seq, div_name FROM cms_com_div ORDER BY seq";
												$d_rlt = mysql_query($d_qry, $connect);
												while($d_rows = mysql_fetch_array($d_rlt)){
											?>
											<option value="<?=$d_rows[seq]?>" <?if($d_rows[seq]==$div_seq) echo "selected";?>><?=$d_rows[div_name]?>
											<? } ?>
										</select>
									</div>
									<div style="float:left; width:150px; height:28px; padding:9px 0 0 0px; text-align:right;"><input type="checkbox" name="is_reti" value="1" <?if($is_reti=='1') echo "checked";?>>퇴사자 포함</div>
									<div style="float:left; width:100px; height:28px; padding:9px 0 0 10px;">
										<select name="sh_con" style="width:90px; height:21px;">
											<option value="" <?if(!$sh_con) echo "selected";?>> 통합검색
											<option value="1" <?if($sh_con=='1') echo "selected";?>> (임)직원명
											<option value="2" <?if($sh_con=='2') echo "selected";?>> 직 급
											<option value="3" <?if($sh_con=='3') echo "selected";?>> 이메일
										</select>
									</div>
									<div style="float:left; width:120px; height:28px; padding:8px 0px 0 10px; text-align:right;">
										<input type="text" name="_search" value="<?=$_search?>" size="20" class="inputstyle2" style="width:115px;" onclick="this.value='' ">
									</div>
									<div style="float:right; width:50px; height:28px; background-color:#F8F8F8; padding:7px 20px 0 10px; color:black;">
										<input type="button" value=" 검 색 " onclick="submit();" class="inputstyle11" style="height:24px;">
									</div>
									</form>
								</div>
								<!-- ================================= 거래처 contents S ================================= -->
								<div style="height:389px;">
									<div style="float:left; width:25px; height:26px; padding-top:5px; border-width:1px 1px 1px 0; text-align:center;" class="blue_title"><input type="checkbox" name="mnum_cont" disabled></div>
									<div style="float:left; width:124px; height:26px; padding-top:5px; border-width:1px 0 1px 0; text-align:center;" class="blue_title">(임)직원명</div>
									<div style="float:left; width:120px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">담당부서</div>
									<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">직 급</div>
									<div style="float:left; width:150px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">직통 전화</div>
									<div style="float:left; width:150px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">비상전화(Mobile)</div>
									<div style="float:left; width:150px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">이메일(Email)</div>

									<?										
										if($is_reti=='1') $add_where = " WHERE 1=1 "; else $add_where = " WHERE is_reti<>'1' ";

										if($div_seq) $add_where.=" AND div_seq='$div_seq' ";

										if(!$sh_con){// 통합검색일 경우
											if($_search) $add_where.=" AND (mem_name LIKE '%$_search%' OR div_posi LIKE '%$_search%' OR  	email LIKE '%$_search%') ";
										}else if($sh_con=='1'){// (임)직원명으로 검색
											if($_search) $add_where.=" AND mem_name LIKE '%$_search%' ";										
										}else if($sh_con=='2'){//직급으로 검색
											if($_search) $add_where.=" AND  	div_posi LIKE '%$_search%' ";
										}else if($sh_con=='3'){//이메일로 검색
											if($_search) $add_where.=" AND  	email LIKE '%$_search%' ";										
										}

										$query="SELECT seq FROM cms_com_div_mem $add_where ORDER BY seq";
										$result=mysql_query($query, $connect);
										$total_bnum=mysql_num_rows($result);     // 총 게시물 수   11111111111111111111
										mysql_free_result($result);
										if($total_bnum==0){
									?>
									<div style="clear:left; height:80px; text-align:center; padding-top:50px; margin-bottom:10px;">등록된 데이터가 없습니다.</div>
									<?
									}else{
										$start=$_REQUEST['start'];
										$index_num = 12;								// 한 페이지 표시할 목록 개수 22222222222222
										$page_num = 10;								    // 한 페이지에 표시할 페이지 수 33333
										if(!$start) $start = 1;							    // 현재페이지 444444444
										$s = ($start-1)*$index_num;
										$e = $index_num;

										$query = "SELECT cms_com_div_mem.seq, div_name, div_posi, mem_name, dir_tel, mobile, email, is_reti
														 FROM cms_com_div_mem, cms_com_div $add_where AND div_seq=cms_com_div.seq
														 ORDER BY cms_com_div_mem.seq LIMIT $s, $e";
										$result = mysql_query($query, $connect);
										while($rows = mysql_fetch_array($result)){
											if($rows[is_reti]==1) $b_color = "background-color:#f0f0f0;";
									?>
									<div style="clear:left; float:left; width:25px; height:24px; padding-top:4px; border-width:0 1px 1px 0; text-align:center;" class="bor_ddd"><input type="checkbox" name="seq[]" value="<?$rows[seq]?>"></div>
									<div style="float:left; width:124px; height:24px; padding-top:4px; border-width:0 0 1px 0; text-align:center; <?=$b_color?>" class="bor_ddd"><a href="<?$cms_url?>?m_di=1&amp;s_di=2&amp;ss_di=2&amp;mode=modify&amp;seq=<?=$rows[seq]?>" class="no_auth"><?=$rows[mem_name]?></a></div>
									<div style="float:left; width:120px; height:24px; padding-top:4px; border-width:0 0 1px 1px; text-align:center; <?=$b_color?>" class="bor_ddd"><?=$rows[div_name]?></div>
									<div style="float:left; width:100px; height:24px; padding-top:4px; border-width:0 0 1px 1px; text-align:center; <?=$b_color?>" class="bor_ddd"><?=$rows[div_posi]?></div>
									<div style="float:left; width:140px; height:24px; padding:4px 0 0 10px; border-width:0 0 1px 1px; text-align:center; <?=$b_color?>" class="bor_ddd"><?=$rows[dir_tel]?></div>
									<div style="float:left; width:140px; height:24px; padding:4px 0 0 10px; border-width:0 0 1px 1px; text-align:center; <?=$b_color?>" class="bor_ddd"><?=$rows[mobile]?></div>
									<div style="float:left; width:140px; height:24px; padding:4px 0 0 10px; border-width:0 0 1px 1px; <?=$b_color?>" class="bor_ddd"><?=$rows[email]?></div>
									<?
											}
										}
									?>
								</div>
								<div style="height:38px; padding-top:17px; text-align:center;">
									<?
										if($total_bnum>$index_num){
											echo "<span>";
											$back_url="&amp;m_di=1&amp;s_di=2";
											page_avg($total_bnum, $page_num, $index_num, $start, $back_url);
											//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지 5. 해당페이지 필요변수
											echo "</span>";
										}
									?>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($cg_1_2_row[cg_1_2]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="location.href='$_SERVER[PHP_SELF]?m_di=1&amp;s_di=2&amp;ss_di=2&amp;mode=reg' ";
										$del_str="alert('준비중..! 현재 해당 직원에 대한 수정 화면에서 개별 퇴사처리만 가능합니다.')";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd"><input type="button" value="신규 등록" onclick="<?=$submit_str?>"></div>
							<div style="float:right; height:30px; width:200px; padding:8px 10px 0 0; border-width:1px 0 0 0; text-align:right;" class="bor_ddd"><input type="button" value="선택 삭제" onclick="<?=$del_str?>"></div>
