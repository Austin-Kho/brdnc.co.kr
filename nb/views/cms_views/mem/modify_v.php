<div class="container" style="color: #BBBBBB; width: 300px;">
<?php
	$attributes = array('name' => 'modify', 'class' => 'form-signup', 'method' => 'post');
	echo form_open($this->config->base_url().'cms_member/modify/', $attributes);
?>
		<div id="main_logo" style="margin: 100px 0 50px 0;">
			<img src="<?php echo $this->config->base_url(); ?>static/img/cms_main_logo_.png" alt="" style="cursor: pointer;">
		</div>
		<h3 class="form-signin-heading">등록 계정정보 변경</h3>
		<label for="mem_username" class="control-label">Name</label>
			<input type="text" name="mem_username"  value="<?php if($user->mem_username) echo $user->mem_username; ?>" id="mem_username" class="form-control" placeholder="이름" required onkeydown="if(event.keyCode==13)submit();">
		<label for="mem_userid" class="control-label">ID</label>
			<input type="text" name="mem_userid"  value="<?php if($user->mem_userid) echo $user->mem_userid; ?>" id="mem_userid" class="form-control" placeholder="아이디" required onkeydown="if(event.keyCode==13)submit();">
		<label for="mem_email" class="control-label">Email</label>
			<input type="text" name="mem_email"  value="<?php if($user->mem_email) echo $user->mem_email; ?>" id="mem_email" class="form-control" placeholder="이메일" required onkeydown="if(event.keyCode==13)submit();">
		<label for="mem_password" class="control-label">Password</label>
		 <span style="padding-left: 20px;"><input type="checkbox" name="pass_m_ck" onclick="if(this.checked==true) {document.getElementById('pass_modi').style.display=''}else{document.getElementById('pass_modi').style.display='none'}" <?php if($this->input->post('pass_m_ck')=='on') echo 'checked'; ?>> 비밀번호 변경하기</span>
			<input type="password" name="mem_password" value="<?php echo set_value('mem_password'); ?>" id="mem_password" class="form-control" placeholder="비밀번호" required  onkeydown="if(event.keyCode==13)submit();">
		<div id="pass_modi" style="display: <?php if($this->input->post('pass_m_ck')=='on') echo ''; else echo 'none'; ?>;">
		<label for="new_password" class="control-label">New Password</label>
			<input type="password" name="new_password" value="<?php echo set_value('new_password'); ?>" id="new_password" class="form-control" placeholder="새 비밀번호">
		<label for="new_passconf" class="control-label">Password Confirm</label>
			<input type="password" name="new_passconf"  value="<?php echo set_value('new_passconf'); ?>" id="new_passconf" class="form-control" placeholder="비밀번호 확인" onkeydown="if(event.keyCode==13)submit();">
		</div>
		<span style="color: yellow;"><p><?php echo validation_errors(); ?></p></span>
		<button class="btn btn-lg btn-primary btn-block" type="submit" style="margin: 20px 0 8px 0;">변경등록</button>
	</form>
	<a href="<?php echo base_url(); ?>" style="color: #BBBBBB;" style="padding: 15px 0 60px 0;">메인으로</a>
</div> <!-- /container -->
