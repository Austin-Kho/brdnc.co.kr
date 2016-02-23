<div class="container" style="color: #BBBBBB; width: 300px;">

<?php

	$attributes = array('name' => 'modify', 'class' => 'form-signup');
	echo form_open($this->config->base_url().'member/modify/', $attributes);
?>
		<div id="main_logo" style="margin: 100px 0 50px 0;">
			<img src="<?php echo $this->config->base_url(); ?>static/img/cms_main_logo_.png" alt="" style="cursor: pointer;">
		</div>

		<h3 class="form-signin-heading">등록 계정정보 변경</h3>

		<label for="inputName" class="control-label">Name</label>
			<input type="text" name="name"  value="<?php if($user->name) echo $user->name; ?>" id="inputName" class="form-control" placeholder="이름" required autofocus>
		<label for="inputId" class="control-label">ID</label>
			<input type="text" name="user_id"  value="<?php if($user->user_id) echo $user->user_id; ?>" id="inputId" class="form-control" placeholder="아이디" readonly required autofocus onkeypress="alert('아이디는 변경할 수 없습니다.');">
		<label for="inputEmail" class="control-label">Email</label>
			<input type="text" name="email"  value="<?php if($user->email) echo $user->email; ?>" id="inputEmail" class="form-control" placeholder="이메일" required autofocus>

		<label for="inputPassword" class="control-label">Password</label>
		 <span style="padding-left: 20px;"><input type="checkbox" name="pass_m_ck" onclick="if(this.checked==true) {document.getElementById('pass_modi').style.display=''}else{document.getElementById('pass_modi').style.display='none'}" <?php if($this->input->post('pass_m_ck')=='on') echo 'checked'; ?>>비밀번호 변경하기</span>
			<input type="password" name="passwd" value="<?php echo set_value('passwd'); ?>" id="inputPassword" class="form-control" placeholder="비밀번호" required>

		<div id="pass_modi" style="display: <?php if($this->input->post('pass_m_ck')=='on') echo ''; else echo 'none'; ?>;">


		<label for="inputNewPass" class="control-label">New Password</label>
			<input type="password" name="new_pass" value="<?php echo set_value('new_pass'); ?>" id="inputNewPass" class="form-control" placeholder="새 비밀번호">

		<label for="inputPassconf" class="control-label">Password Confirm</label>
			<input type="password" name="passcf"  value="<?php echo set_value('passcf'); ?>" id="inputPassconf" class="form-control" placeholder="비밀번호 확인">
		</div>

		<span style="color: yellow;"><p><?php echo validation_errors(); ?></p></span>

		<button class="btn btn-lg btn-primary btn-block" type="submit" style="margin: 20px 0 8px 0;">변경등록</button>
	</form>
	<a href="javascript:history.go(-1);" style="color: #BBBBBB;" style="padding: 15px 0 60px 0;">돌아가기</a>
</div> <!-- /container -->