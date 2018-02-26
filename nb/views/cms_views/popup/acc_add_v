<?
	$pj= $this->input->post_get('pj');
?>

	<script type="text/javascript">
	<!--
		function _edit(code){
			 location.href="bank_acc.php?mode=edit&edit_code="+code;
		}
		function _del(code){
			 var cdel=confirm('정말 삭제하시겠습니까?');
			 if(cdel==true){
				 location.href="bank_acc_post.php?mode=del&del_code="+code;
			 }
		}
	//-->
	</script>

<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#11ca1f; background-color: white;">
	<div style="height:100%; border-width:1px 0 0 0; border-style: solid; border-color:#C5FAC9; padding:6px 0 0 0;">
		<div style="height:96%; margin:0 auto; width:96%; border-width:2px 2px 2px 2px; border-style: solid; border-color:#96ABE5;">
			<div style="height:50px; border-width:0 0 2px 0; border-style: solid; border-color:#96ABE5; background-color:#D9EAF8; text-align:center; padding-top:30px; margin-bottom:12px;">
				<font color="#4C63BD" style="font-size:11pt"><b> 은행계좌(BANK ACCOUNT) 관리</b></font>
			</div>
			<div style="padding:0 10px 0 10px;">
				<div style="height:28px; background-color:#f4f4f4; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid; text-align:center; padding-top:7px;">
					검색할 은행(계좌) 명칭을 입력해 주십시요.
				</div>
<?php
	$sort = $this->input->post_get('sort');
	$category = $this->input->post_get('category');

	$attributes = array('name' => 'form1');
	$hidden = array('start' => '1');
	echo form_open(current_full_url(), $attributes, $hidden);
?>
				<div style="float:left; height:28px; text-align:center; padding:7px 0 0 55px; ;">
					<select name="sort" class="inputstyle2" style="width:80px; height:22px;">
						<option value="" <?if(!$sort) echo "selected";?>> 전 체
						<option value="com" <?if($sort=='com') echo "selected";?>> 본 사
<? foreach ($pj_now as $lt) : ?>
						<option value="<?=$lt->seq?>" <?if($sort==$lt->seq) echo "selected";?>><?=$lt->pj_name?>
<? endforeach; ?>
					</select>
				</div>
				<div style="float:left; height:28px; text-align:center; padding:7px 0 0 10px;">
					<input type="text" name="category" value="<?=$category?>" size="20" class="inputstyle2" style="height:18px" onmouseover="cngClass(this,'inputstyle22')" onmouseout="cngClass(this,'inputstyle2');" onclick="this.value=''">
					<input type="button" value=" 검 색 " onclick="submit();" class= "inputstyle_bt">
				</div>
				<div style="clear:left; height:30px; background-color:#EAEAEA; border-width: 1px 0 1px 0; border-color:#CFCFCF; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:70px;">구분</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">별칭</div>
					<div style="float:left; padding-top:5px; text-align:center; width:80px;">은행</div>
					<div style="float:left; padding-top:5px; text-align:center; width:130px;">계좌번호</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">수정</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">삭제</div>
				</div>
				<?
					$total_bnum = $_REQUEST['total_bnum'];
					$where_add = " WHERE no!=1 ";
					if($sort){
						if($sort=='com'){
							$where_add.=" AND is_com='1' ";
						}else{
							$where_add.=" AND pj_seq='$sort' ";
						}
					}
					if($category) $where_add.=" AND ((bank LIKE '%$category%') OR (note LIKE '%$category%')) ";
					$query="SELECT no FROM cms_capital_bank_account $where_add ";

					$result= $this->cms_main_model->sql_num_result($query);
					$total_bnum = $result['num'];	// 총 게시물 수   11111111111111111111
					if($total_bnum==0){
				?>
				<div style="height:60px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid; text-align:center; padding-top:35px;">
					등록 된 데이터가 없습니다.
				</div>
<?
					}else{
					$index_num = 5;                 // 한 페이지 표시할 목록 개수 22222222222222
					$page_num = 10;								  // 한 페이지에 표시할 페이지 수 33333
					$start=$this->input->post_get('start');
					if(!$start) $start = 1;              // 현재페이지 444444444
					$s = ($start-1)*$index_num;
					$e = $index_num;
					$query2="SELECT no, bank, name, number, is_com, pj_seq
							   FROM cb_cms_capital_bank_account
							   $where_add
							   ORDER BY no ASC LIMIT $s, $e";

					$result2 = $this->cms_main_model->sql_num_result($query2);
					$search_bnum=$result2['num'];

					// for($i=0; $rows2=mysql_fetch_array($result2); $i++){
					$i=0;
					foreach ($result2 as $lt) :

						$bunho=$total_bnum-($i+$cline)+1;
						if($lt->is_com=='1'){$sort = "본사";}
						if($lt->is_com=='0'){
							$rlt = $this->cms_main_model->sql_row(" SELECT pj_name FROM cms_project_info WHERE seq='$lt->pj_seq' " );
							$sort = rg_cut_string($rlt->pj_name, 9, "");
						}
				?>
				<input type="hidden" name="total_bnum" value="<?=$search_bnum?>">
				<div style="height:30px; border-width: 0 0 1px 0; border-color:#eaeaea; border-style: solid;">
					<div style="float:left; padding-top:5px; text-align:center; width:70px;">
						<a href="javascript:" onclick="value_put('<?=$lt->classify?>')"><?=$sort?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:40px;">
						<a href="javascript:" onclick="value_put('<?=$lt->classify?>')"><?=$lt->name?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:80px;">
						<a href="javascript:" onclick="value_put('<?=$lt->classify?>')"><?=$lt->bank?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:130px;">
						<a href="javascript:" onclick="value_put('<?=$lt->classify?>');"><?=$lt->number?></a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">
						<?	if($pj){	?>
						<a href="javascript:alert('수정 권한이 없습니다.')">
						<?	}else{	?>
						<a href="javascript:_edit('<?=$lt->no?>');"><? } ?>수정</a>
					</div>
					<div style="float:left; padding-top:5px; text-align:center; width:30px;">
						<?	if($pj){	?>
						<a href="javascript:alert('삭제 권한이 없습니다.')">
						<?	}else{	?>
						<a href="javascript:_del('<?=$lt->no?>');"><? } ?>삭제</a>
					</div>
				</div>
				<?
						$i++;
						endforeach;
				?>
				</form>
				<div style="height:35; text-align:center; padding-top:10px;">
					<span>
						<?
							$back_url="&amp;sort=$sort&amp;category=$category";
							page_avg($total_bnum,$page_num, $index_num,$start, $back_url);
							//1. 총게시물수 2. 한페이지 페이지수 3. 한페이지목록 수 4. 시작페이지
							}
						?>
					</span>
				</div>
				<?
					if($pj){
						$acc_m_str = "alert('계좌관리 권한이 없습니다.');";
					}else{
						$acc_m_str = "location.href='bank_acc.php?mode=reg';";
					}
				?>
				<div style="height:50px; text-align:center; padding-top:20px;">
					<input type="button" value=" 은행계좌 추가 " onclick="<?=$acc_m_str?>" class="inputstyle_bt" style="height:20px;">
					<input type="button" value=" 닫 기 " onclick="self.close()" class="inputstyle_bt" style="height:20px;">
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="container">
<?php
	$attributes = array('name' => 'taxsearch', 'id' => 'taxsearch', 'class' => 'form-inline');
	// $hidden = array('n' => $n);
	echo form_open(current_full_url(), $attributes);//, $hidden);
?>
	<input type="hidden" name="n" value="<?php echo $n; ?>" id="n">
	<header id="header">
		<h3>은 행 계 좌 관 리</h3>
	</header>-->  <!-- /header -->
	<!-- <div class="desc">※ 검색할 은행(계좌) 명칭을 입력해 주십시요.</div>

	<div class="well" style="padding: 13px; margin-bottom: 20px;">세무서를 제외한 <b>[관할 지역명]</b> 만 입력하세요.</div>
	<div class="row" style="padding-top: 0;">
		<div class="form-group <?php if(is_mobile()) echo 'col-xs-4'; else echo 'col-xs-3'; ?>" style="border-top: 0;">
			<label for="search_text">관할세무서</label>
		</div>
		<div class="form-group <?php if(is_mobile()) echo 'col-xs-8'; else echo 'col-xs-9'; ?>" style="border-top: 0;">
			<div class="col-xs-7">
				<input class="form-control input-sm han" type="text" name="search_text" id="q" value="<?php echo $this->input->post('search_text'); ?>" onclick="this.value=null" onkeydown="if(event.keyCode==13)submit();">
			</div>
			<div class="col-xs-5">
				<button class="btn btn-primary btn-sm" id="search_btn">검 색</button>
			</div>
		</div>
	</div>

	<div class="mt10">
		<div class="desc">&nbsp;</div>
	</div>
	<div class="tb-h5">
		<table class="table table-bordered table-hover table-condensed">
			<tr>
				<th class="col-xs-2 center">코드</th>
				<th class="col-xs-2 center">관할청</th>
				<th class="col-xs-4 center">관할 세무서 명칭</th>
				<th class="col-xs-4 center">전화번호</th>
			</tr>
<?php foreach ($tax_off_list as $lt) : ?>
			<tr>
				<td class="center">
					<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서');"><?php echo $lt->code; ?></a>
				</td>
				<td class="center">
					<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서');"><?php echo $lt->chung; ?></a>
				</td>
				<td class="pl20" style="padding-left: 20px;">
					<a href="javascript:" onclick="value_put(<?php echo $lt->code;?>, '<?php echo $lt->office; ?> 세무서');"><?php echo $lt->office. '세무서'; ?></a>
				</td>
				<td class="center"><?php echo $lt->tel; ?></td>
			</tr>
<?php endforeach; ?>
		</table>
	</div>
	<nav class="center"><ul class="pagination pagination-sm"><?php echo $pagination; ?></ul></nav>
	<footer class="center"><a href="javascript:self.close();" class="btn btn-danger btn-sm">닫 기</a></footer>
	</form>
</div> -->
