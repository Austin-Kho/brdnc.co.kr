<div class="container" style="color: #BBBBBB; width: 300px;">
<?php
	$attributes = array('name' => 'join', 'class' => 'form-signup', 'method' => 'post');
	echo form_open($this->config->base_url('member/join/'), $attributes);
?>
		<div id="main_logo" style="margin: 100px 0 50px 0;">
			<img src="<?php echo $this->config->base_url(); ?>static/img/cms_main_logo_.png" alt="" style="cursor: pointer;">
		</div>
		<h3 class="form-signin-heading">신규 계정등록</h3>
		<label for="inputName" class="control-label">Name</label>
			<input type="text" name="name"  value="<?php echo set_value('name'); ?>" id="inputName" class="form-control han" placeholder="이름" required autofocus>
		<label for="inputId" class="control-label">ID</label>
			<input type="text" name="user_id"  value="<?php echo set_value('user_id'); ?>" id="inputId" class="form-control en_only" placeholder="아이디" required autofocus>
		<label for="inputEmail" class="control-label">Email</label>
			<input type="text" name="email"  value="<?php echo set_value('email'); ?>" id="inputEmail" class="form-control en_only" placeholder="이메일" required autofocus>
		<label for="inputPassword" class="control-label">Password</label>
			<input type="password" name="passwd" value="<?php echo set_value('passwd'); ?>" id="inputPassword" class="form-control en_only" placeholder="비밀번호" required>
		<label for="inputPassconf" class="control-label">Password Confirm</label>
			<input type="password" name="passcf"  value="<?php echo set_value('passcf'); ?>" id="inputPassconf" class="form-control" placeholder="비밀번호 확인" required>
		<span style="color: yellow;"><p><?php echo validation_errors(); ?></p></span>
		<button class="btn btn-lg btn-primary btn-block en_only" type="submit" style="margin: 20px 0 8px 0;">등록하기</button>
	</form>
	<a href="<?php echo $this->config->base_url('member/login/'); ?>" style="color: #BBBBBB;" style="padding: 15px 0 60px 0;">돌아가기</a>
</div> <!-- /container -->
