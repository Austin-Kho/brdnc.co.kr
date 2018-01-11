<script type="text/javascript">
		function add_toggle(n){
			var obj = eval(document.getElementById('acc'+n));
			if(obj.style.display=='none') {
				obj.style.display = '';
			}else{
				obj.style.display = 'none';
			}
		}
</script>
	<div class="container">
<?php
	$attributes = array('name' => 'form1');
	echo form_open(current_url(), $attributes);
?>
		<div class="row">
			<header id="header">
				<h1>회 계 계 정 과 목</h1>
			</header>
			<div class="desc">&nbsp;</div>
			<div class="well" style="padding: 13px; margin-bottom: 20px;">※ 검색할 계정과목 명칭을 선택하여 주십시요.</div>
				<div class="row" style="padding-top:0;">
					<!-- <div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>">
						<label id="doro_name" for="acc_d1">계정과목 [대분류] :</label>
					</div>
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>" style="border-top: 0;">
						<div class="col-xs-12" style="padding-left:0;">
							<select name="acc_d1" class="form-control input-sm" onChange = "submit();">
								<option value="1" <?php echo set_select('acc_d1', '1');?>> 자 산
								<option value="2" <?php echo set_select('acc_d1', '2');?>> 부 채
								<option value="3" <?php echo set_select('acc_d1', '3');?>> 자 본
								<option value="4" <?php echo set_select('acc_d1', '4');?>> 수 익
								<option value="5" <?php echo set_select('acc_d1', '5');?>> 비 용
							</select>
						</div>
					</div> -->
					<div class="form-group <?php if(is_mobile()) echo 'col-xs-6'; else echo 'col-xs-3'; ?>">
						<label>희귀 계정과목 표시 : &nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="is_sp" value="1" <?php echo set_checkbox('is_sp', '1'); ?> onClick="submit();" <?php // if($this->input->post_get('is_sp')=='on') echo 'checked'; ?>>
						</label>
					</div>
				</div>
				<div class="mt10">
					<div class="desc">&nbsp;</div>
				</div>
				<div class="sub_header" id="acc1_handler" onclick="add_toggle(1);"><h5>자 산 계 정</h5></div>
				<div class="tb-h5">
					<table id="acc1" class="table table-bordered table-hover table-condensed" style="display: <?// if($this->input->post_get('acc_d1')==='1' or empty($this->input->post_get('acc_d1'))) echo ''; else echo 'none';?>">
<?php
	foreach($d2_acc_1 as $lt1) : // 1-d2 계정 나열 시작
?>
					<tr><th colspan="2"><?=$lt1->d2_acc_name?></th></tr>
<?php
		$d3_acc1 = $this->cms_popup_model->d3_acc('1', $lt1->d2_code, $this->input->post('is_sp'));
		foreach ($d3_acc1 as $nt1) : // 1-d3 계정 나열 시작
?>
					<tr>
						<td width="20%" style="<?if($nt1->is_sp_acc==0)echo "color:#003366;"; else echo "color:#a8a8a8;";?>"><?=$nt1->d3_acc_name?></td>
						<td width="80%" title="<?=$nt1->note?>"><?=cut_string($nt1->note,40,"...")?></td>
					</tr>
<?php
endforeach; // 1-d3 계정 나열 종료
?>

<?php
endforeach; //1-d2 계정 나열 종료
?>
					</table>
				</div>
				<div class="sub_header" onclick="add_toggle(2);"><h5>부 채 계 정</h5></div>
				<div class="tb-h5">
					<table id="acc2" class="table table-bordered table-hover table-condensed" style="display:none;<?// if($this->input->post_get('acc_d1')==='2') echo ''; else echo 'none';?>">
<?php
	foreach($d2_acc_2 as $lt2) : // 2-d2 계정 나열 시작
?>
					<tr><th colspan="2"><?=$lt2->d2_acc_name?></th></tr>
<?php
		$d3_acc2 = $this->cms_popup_model->d3_acc('2', $lt2->d2_code, $this->input->post('is_sp'));
		foreach ($d3_acc2 as $nt2) : // 2-d3 계정 나열 시작
?>
					<tr>
						<td width="20%" style="<?if($nt2->is_sp_acc==0)echo "color:#003366;"; else echo "color:#a8a8a8;";?>"><?=$nt2->d3_acc_name?></td>
						<td width="80%" title="<?=$nt2->note?>"><?=cut_string($nt2->note,40,"...")?></td>
					</tr>
<?php
endforeach; // 2-d3 계정 나열 종료
?>

<?php
endforeach;  //2-d2 계정 나열 종료
?>
					</table>
				</div>
				<div class="sub_header" onclick="add_toggle(3);"><h5>자 본 계 정</h5></div>
				<div class="tb-h5">
					<table id="acc3" class="table table-bordered table-hover table-condensed" style="display:none;<?// if($this->input->post_get('acc_d1')==='3') echo ''; else echo 'none';?>">
<?php
	foreach($d2_acc_3 as $lt3) : // 3-d2 계정 나열 시작
?>
					<tr><th colspan="2"><?=$lt3->d2_acc_name?></th></tr>
<?php
		$d3_acc3 = $this->cms_popup_model->d3_acc('3', $lt3->d2_code, $this->input->post('is_sp'));
		foreach ($d3_acc3 as $nt3) : // 3-d3 계정 나열 시작
?>
					<tr>
						<td width="20%" style="<?if($nt3->is_sp_acc==0)echo "color:#003366;"; else echo "color:#a8a8a8;";?>"><?=$nt3->d3_acc_name?></td>
						<td width="80%" title="<?=$nt3->note?>"><?=cut_string($nt3->note,40,"...")?></td>
					</tr>
<?php
endforeach; // 3-d3 계정 나열 종료
?>

<?php
endforeach;  // 3-d2 계정 나열 종료
?>
					</table>
				</div>
				<div class="sub_header" onclick="add_toggle(4);"><h5>수 익 계 정</h5></div>
				<div class="tb-h5">
					<table id="acc4" class="table table-bordered table-hover table-condensed" style="display:none;<?// if($this->input->post_get('acc_d1')==='4') echo ''; else echo 'none';?>">
<?php
	foreach($d2_acc_4 as $lt4) : // 4-d2 계정 나열 시작
?>
					<tr><th colspan="2"><?=$lt4->d2_acc_name?></th></tr>
<?php
		$d3_acc4 = $this->cms_popup_model->d3_acc('4', $lt4->d2_code, $this->input->post('is_sp'));
		foreach ($d3_acc4 as $nt4) : // 4-d3 계정 나열 시작
?>
					<tr>
						<td width="20%" style="<?if($nt4->is_sp_acc==0)echo "color:#003366;"; else echo "color:#a8a8a8;";?>"><?=$nt4->d3_acc_name?></td>
						<td width="80%" title="<?=$nt4->note?>"><?=cut_string($nt4->note,40,"...")?></td>
					</tr>
<?php
endforeach; // 4-d3 계정 나열 종료
?>

<?php
endforeach;  // 4-d2 계정 나열 종료
?>
					</table>
				</div>
				<div class="sub_header" onclick="add_toggle(5);"><h5>비 용 계 정</h5></div>
				<div class="tb-h5">
					<table id="acc5" class="table table-bordered table-hover table-condensed" style="display:none;<?// if($this->input->post_get('acc_d1')==='5') echo ''; else echo 'none';?>">
<?php
	foreach($d2_acc_5 as $lt5) : // 5-d2 계정 나열 시작
?>
					<tr><th colspan="2"><?=$lt5->d2_acc_name?></th></tr>
<?php
		$d3_acc5 = $this->cms_popup_model->d3_acc('5', $lt5->d2_code, $this->input->post('is_sp'));
		foreach ($d3_acc5 as $nt5) : // 5-d3 계정 나열 시작
?>
					<tr>
						<td width="20%" style="<?if($nt5->is_sp_acc==0)echo "color:#003366;"; else echo "color:#a8a8a8;";?>"><?=$nt5->d3_acc_name?></td>
						<td width="80%" title="<?=$nt5->note?>"><?=cut_string($nt5->note,40,"...")?></td>
					</tr>
<?php
endforeach; // 5-d3 계정 나열 종료
?>

<?php
endforeach;  // 5-d2 계정 나열 종료
?>
					</table>
				</div>
				<footer class="center"><a href="javascript:self.close();" class="btn btn-danger btn-sm">닫 기</a></footer>
			</form>
		</div>
	</div>
