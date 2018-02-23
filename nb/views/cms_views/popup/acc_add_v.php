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


<div class="container">
<?php
	$attributes = array('name' => 'taxsearch', 'id' => 'taxsearch', 'class' => 'form-inline');
	// $hidden = array('n' => $n);
	echo form_open(current_full_url(), $attributes);//, $hidden);
?>
	<input type="hidden" name="n" value="<?php echo $n; ?>" id="n">
	<header id="header">
		<h3>은 행 계 좌 관 리</h3>
	</header>  <!-- /header -->
	<div class="desc"></div>

	<div class="well" style="padding: 13px; margin-bottom: 20px;">※ 검색할 은행(계좌) 명칭을 입력해 주십시요.</div>
	<div class="row" style="padding-top: 0;">
		<div class="form-group <?php if(is_mobile()) echo 'col-xs-4'; else echo 'col-xs-4'; ?>" style="border-top: 0;">
			<!-- <label for="search_text">목록</label> -->
			<div class="col-xs-12">
				<select class="form-control input-sm" name="a">
					<option value="1" <?php echo set_select('acc_d1', '1');?>> 자 산
					<option value="2" <?php echo set_select('acc_d1', '2');?>> 부 채
					<option value="3" <?php echo set_select('acc_d1', '3');?>> 자 본
					<option value="4" <?php echo set_select('acc_d1', '4');?>> 수 익
					<option value="5" <?php echo set_select('acc_d1', '5');?>> 비 용
				</select>
			</div>
		</div>
		<div class="form-group <?php if(is_mobile()) echo 'col-xs-8'; else echo 'col-xs-8'; ?>" style="border-top: 0;">
			<div class="col-xs-8">
				<input class="form-control input-sm han" type="text" name="search_text" id="q" value="<?php echo $this->input->post('search_text'); ?>" onclick="this.value=null" onkeydown="if(event.keyCode==13)submit();">
			</div>
			<div class="col-xs-4">
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
				<th class="col-xs-2 center">구분</th>
				<th class="col-xs-2 center">별칭</th>
				<th class="col-xs-4 center">은행</th>
				<th class="col-xs-2 center">수정</th>
				<th class="col-xs-2 center">삭제</th>
			</tr>
			<tr>
				<td class="center">ㅁ</td>
				<td class="center">ㅠ</td>
				<td class="center">ㅊ</td>
				<td class="center">ㅇ</td>
				<td class="center">ㄷ</td>
			</tr>
		</table>
	</div>
	<nav class="center"><ul class="pagination pagination-sm"><?php echo $pagination; ?></ul></nav>
	<footer class="center"><a href="javascript:self.close();" class="btn btn-danger btn-sm">닫 기</a></footer>
	</form>
</div>
