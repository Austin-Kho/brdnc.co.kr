							<!-- 거래처 목록 파일 -->
								<div style="height:38px; border-width:1px 0 1px 0; border-color:#D6D6D6; border-style:solid; margin:6px 0 10px 0;">
									<?
										$acc_cla = $_REQUEST['acc_cla'];
										$sh_con = $_REQUEST['sh_con'];
										$_search = $_REQUEST['_search'];
									?>
									<form method="post" action="">
									<div style="float:left; width:100px; height:28px; background-color:#f4f4f4; padding:10px 0px 0 0px; color:black; text-align:center;">업체 구분</div>
									<div style="float:left; width:350px; height:28px; padding:9px 20px 0 10px;">
										<select name="acc_cla" style="width:110px; height:21px;" onchange="submit();">
											<option value="" <?if(!$acc_cla) echo "selected";?>> 전 체
											<option value="1" <?if($acc_cla=='1') echo "selected";?>>매출 거래처
											<option value="2" <?if($acc_cla=='2') echo "selected";?>>매입 거래처
											<option value="3" <?if($acc_cla=='3') echo "selected";?>>매출매입 거래처
										</select>
									</div>
									<div style="float:left; width:100px; height:28px; padding:9px 0 0 30px;">
										<select name="sh_con" style="width:90px; height:21px;">
											<option value="" <?if(!$sh_con) echo "selected";?>> 통합검색
											<option value="1" <?if($sh_con=='1') echo "selected";?>> 상호(회사명)
											<option value="2" <?if($sh_con=='2') echo "selected";?>> 웹사이트명
											<option value="3" <?if($sh_con=='3') echo "selected";?>> 대표자명
											<option value="4" <?if($sh_con=='4') echo "selected";?>> 담당자명
											<option value="5" <?if($sh_con=='5') echo "selected";?>> 비 고
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
									<div style="float:left; width:135px; height:26px; padding-top:5px; border-width:1px 0 1px 0; text-align:center;" class="blue_title">상호(회사명)</div>
									<div style="float:left; width:90px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">업체구분</div>
									<div style="float:left; width:100px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">전화번호</div>
									<div style="float:left; width:353px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">주 소</div>
									<div style="float:left; width:117px; height:26px; padding-top:5px; border-width:1px 0 1px 1px; text-align:center;" class="blue_title">비 고</div>

									<?
										$add_where = " WHERE 1=1 ";
										if($acc_cla) $add_where.=" AND acc_cla='$acc_cla' ";
										if(!$sh_con){// 통합검색일 경우
											if($_search) $add_where.=" AND (si_name LIKE '%$_search%' OR web_name LIKE '%$_search%' OR tax_ceo LIKE '%$_search%' OR res_worker LIKE '%$_search%' OR note LIKE '%$_search%') ";
										}else if($sh_con=='1'){// 상호(회사명)으로 검색
											if($_search) $add_where.=" AND si_name LIKE '%$_search%' ";
										}else if($sh_con=='2'){// 웹사이트명으로 검색
											if($_search) $add_where.=" AND web_name LIKE '%$_search%' ";
										}else if($sh_con=='3'){//대표자명으로 검색
											if($_search) $add_where.=" AND tax_ceo LIKE '%$_search%' ";
										}else if($sh_con=='4'){//담당자명으로 검색
											if($_search) $add_where.=" AND res_worker LIKE '%$_search%' ";
										}else if($sh_con=='5'){//비고 항목으로 검색
											if($_search) $add_where.=" AND note LIKE '%$_search%' ";
										}

										$query="SELECT seq FROM cms_accounts $add_where ORDER BY seq";
										$result=mysql_query($query, $connect);
										$total_bnum=mysql_num_rows($result);     // 총 게시물 수   11111111111111111111
										mysqli_free_result($result);
										if($total_bnum==0){
									?>
									<div style="clear:left; height:80px; text-align:center; padding-top:50px; margin-bottom:10px;">등록된 데이터가 없습니다.</div>
									<?
									}else{
										$start=$_REQUEST['start'];
										$index_num = 12;								// 한 페이지 표시할 목록 개수 22222222222222
										$page_num = 10;								// 한 페이지에 표시할 페이지 수 33333
										if(!$start) $start = 1;							// 현재페이지 444444444
										$s = ($start-1)*$index_num;
										$e = $index_num;

										$query = "SELECT seq, si_name, acc_cla, main_tel, tax_addr, note FROM cms_accounts $add_where ORDER BY seq LIMIT $s, $e";
										$result = mysql_query($query, $connect);
										while($rows = mysql_fetch_array($result)){
											if($rows[acc_cla]==1) $acc_cla = "매출 거래처";
											if($rows[acc_cla]==2) $acc_cla = "매입 거래처";
											if($rows[acc_cla]==3) $acc_cla = "매출매입 거래처";
											$a = explode("/", $rows[tax_addr]);
											$tax_addr = str_replace("/"," ",substr($rows[tax_addr],7));
									?>
									<div style="clear:left; float:left; width:25px; height:24px; padding-top:4px; border-width:0 1px 1px 0; text-align:center;" class="bor_ddd"><input type="checkbox" name="seq[]" value="<?$rows[seq]?>"></div>
									<div style="float:left; width:135px; height:24px; padding-top:4px; border-width:0 0 1px 0; text-align:center;" class="bor_ddd"><a href="<?$cms_url?>?m_di=1&amp;s_di=3&amp;ss_di=2&amp;mode=modify&amp;seq=<?=$rows[seq]?>" class="no_auth" title="<?=$rows[si_name]?>"><?=rg_cut_string($rows[si_name],8,"..")?></a></div>
									<div style="float:left; width:90px; height:24px; padding-top:4px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$acc_cla?></div>
									<div style="float:left; width:100px; height:24px; padding-top:4px; border-width:0 0 1px 1px; text-align:center;" class="bor_ddd"><?=$rows[main_tel]?></div>
									<div style="float:left; width:343px; height:24px; padding:4px 0 0 10px; border-width:0 0 1px 1px;" class="bor_ddd"><?=rg_cut_string($tax_addr, 50, "..")?></div>
									<div style="float:left; width:107px; height:24px; padding:4px 0 0 10px; border-width:0 0 1px 1px; cursor:pointer;" class="bor_ddd" title="<?=$rows[note]?>"><?=rg_cut_string($rows[note], 8, "..")?></div>
									<?
											}
										}
									?>
								</div>
								<div style="height:38px; padding-top:17px; text-align:center;">
										<?
										if($total_bnum>$index_num){
											echo "<span>";
											$back_url="&amp;m_di=1&amp;s_di=3";
											page_avg($total_bnum, $page_num, $index_num, $start, $back_url);
											//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지 5. 해당페이지 필요변수
											echo "</span>";
										}
										?>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($_m5_1_3_row[_m5_1_3]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="location.href='$_SERVER[PHP_SELF]?m_di=1&amp;s_di=3&amp;ss_di=2&amp;mode=reg' ";
										$del_str="alert('준비중..! 현재 해당 거래처에 대한 수정 화면에서 개별 삭제만 가능합니다.')";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd"><input type="button" value="신규 등록" onclick="<?=$submit_str?>"></div>
							<div style="float:right; height:30px; width:200px; padding:8px 10px 0 0; border-width:1px 0 0 0; text-align:right;" class="bor_ddd"><input type="button" value="선택 삭제" onclick="<?=$del_str?>"></div>
