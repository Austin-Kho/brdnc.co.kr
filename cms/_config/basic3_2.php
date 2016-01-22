							<!-- 거래처 신규 수정 등록 파일 -->
								<!-- ================================= 거래처 contents S ================================= -->
								<div style="height:500px;">
									<div style="height:18px; background-color:#e8e8e8; margin-bottom:2px;"></div>
									<div style="float:left; width:15px; height:24px; padding-top:10px;"><img src="../images/list_bt.jpg" border="0" alt=""></div>
									<div style="height:28px; padding-top:8px; color:#000000;"><b><?if($mode=='reg'){?>거래처 신규등록<?}else if($mode=='modify'){?>거래처 수정 등록<?} ?></b></div>
									<?
										if($mode=='modify'){
											$seq = $_REQUEST['seq'];
											$qry = "SELECT * FROM cms_accounts WHERE seq='$seq'";
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

									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">상호(회사명) <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd "><input type="text" name="si_name" value="<?=$row[si_name]?>" class="inputstyle2" style="width:160px;"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">거래처 구분 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd ">
										<select name="acc_cla" class="inputstyle2" style="width:165px; height:22px;">
											<option value="" <?if(!$row[acc_cla]) echo "selected";?>> 선 택
											<option value="1" <?if($row[acc_cla]==1) echo "selected";?>> 매출 거래처
											<option value="2" <?if($row[acc_cla]==2) echo "selected";?>> 매입 거래처
											<option value="3" <?if($row[acc_cla]==3) echo "selected";?>> 매출매입 거래처
										</select>
									</div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">대표전화 <font color="red">*</font></div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="main_tel" value="<?=$row[main_tel]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">대표팩스</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="main_fax" value="<?=$row[main_fax]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">홈페이지 주소</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="main_web" value="<?=$row[main_web]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">웹사이트 명</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="web_name" value="<?=$row[web_name]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">담당 부서</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="res_div" value="<?=$row[res_div]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">담당 직원</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="res_worker" value="<?=$row[res_worker]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">모바일 폰</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="res_mobile" value="<?=$row[res_mobile]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">담당 이메일</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="res_email" value="<?=$row[res_email]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; height:26px; padding:5px 0 0 15px; color:#000000"><b><font color="red">*</font> 세금계산서 관련</b></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">사업자등록번호</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd "><input type="text" name="tax_no" value="<?=$row[tax_no]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:1px 1px 1px 0;" class="blue_title">대표자</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:1px 0 1px 0;" class="bor_ddd "><input type="text" name="tax_ceo" value="<?=$row[tax_ceo]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">주 소</div>
									<div style="float:left; width:660px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd ">
										<input type="button" value="우편번호 검색" onclick="javascript:ZipWindow('../member/zip_search.php',1)" class="inputstyle_bt">
										<input type="text" name="zipcode1" value="<?=$tax_addr[0]?>" class="inputstyle2" readonly onKeydown="ZipWindow('../member/zip_search.php',1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="width:30px;"> -
										<input type="text" name="zipcode2" value="<?=$tax_addr[1]?>" class="inputstyle2" readonly onKeydown="ZipWindow('../member/zip_search.php',1);" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="width:30px;">
										<input type="text" name="address1" value="<?=$tax_addr[2]?>" class="inputstyle2" readonly onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2'); " style="width:226px;">
										<input type="text" name="address2" value="<?=$tax_addr[3]?>" class="inputstyle2" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" style="width:160px;"> <font color="#788be2">나머지 주소</font>
									</div>


									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">업 태</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="tax_uptae" value="<?=$row[tax_uptae]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">종 목</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="tax_jongmok" value="<?=$row[tax_jongmok]?>" class="inputstyle2" style="width:160px"></div>

									<div style="clear:left; float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">세금계산서 담당자</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="tax_worker" value="<?=$row[tax_worker]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:26px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">세금계산서 담당 이메일</div>
									<div style="float:left; width:250px; height:26px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><input type="text" name="tax_email" value="<?=$row[tax_email]?>" class="inputstyle2" style="width:160px"></div>
									<div style="float:left; width:135px; height:56px; padding:5px 0 0 15px; border-width:0 1px 1px 0;" class="blue_title">비 고 (거래계좌 정보 등)</div>
									<div style="float:left; width:660px; height:56px; padding:5px 0 0 10px; border-width:0 0 1px 0;" class="bor_ddd "><textarea name="note" rows="3" cols="76" class="inputstyle2" style="width:572px; height:47px;"><?=$row[note]?></textarea></div>
									</form>
								</div>
								<!-- ================================= 거래처 contents E ================================= -->
								<?
									if($cg_1_3_row[cg_1_3]<2){
										$submit_str="alert('등록 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
										$del_str="alert('삭제 권한이 없습니다. 관리자에게 문의하여 주십시요!')";
									}else{
										$submit_str="acc_submit('$mode');";
										$del_str="if(confirm('해당 거래처정보를 삭제 하시겠습니까?')==1) location.href='basic_post.php?s_di=3&amp;mode=del&amp;seq=$seq'";
									}
								?>
							<div style="float:left; height:30px; width:605px; padding:8px 0 0 10px; border-width:1px 0 0 0;" class="bor_ddd">
								<input type="button" value="<?=$sub_str?>" onclick="<?=$submit_str?>">
								<input type="button" value="목록으로" onclick="location.href='<?=$_SERVER[PHP_SELF]?>?m_di=1&amp;s_di=3&amp;ss_di=1' ">
							</div>
							<div style="float:right; height:30px; width:200px; padding:8px 10px 0 0; border-width:1px 0 0 0; text-align:right;" class="bor_ddd">
								<?if($mode=='modify'){?><input type="button" value="거래처삭제" onclick="<?=$del_str?>"><? } ?>
							</div>
