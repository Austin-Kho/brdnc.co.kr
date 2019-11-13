<div class="container" style="color: #BBBBBB; width: 300px;">
<?php
	$attributes = array('name' => 'join', 'class' => 'form-signup', 'method' => 'post');
	echo form_open($this->config->base_url('cms_member/join/'), $attributes);
?>
		<div id="main_logo" style="margin: 100px 0 50px 0;">
			<img src="<?php echo $this->config->base_url(); ?>static/img/cms_main_logo_.png" alt="" style="cursor: pointer;">
		</div>
		<h3 class="form-signin-heading">신규 계정등록</h3>
		<details style="cursor: pointer;">이 프로그램은 직원 전용 프로그램입니다. 계정등록 후 별도 인증이 필요하며, 인증을 거치지 않은 경우 계정등록 후에도 로그인 할 수 없습니다.</details><p></p>
		<label for="mem_username" class="control-label">Name</label>
			<input type="text" name="mem_username"  value="<?php echo set_value('mem_username'); ?>" id="mem_username" class="form-control han" placeholder="이름" required onkeydown="if(event.keyCode==13)submit();">
		<label for="mem_userid" class="control-label">ID</label>
			<input type="text" name="mem_userid"  value="<?php echo set_value('mem_userid'); ?>" id="mem_userid" class="form-control en_only" placeholder="아이디" required onkeydown="if(event.keyCode==13)submit();">
		<label for="mem_email" class="control-label">Email</label>
			<input type="text" name="mem_email"  value="<?php echo set_value('mem_email'); ?>" id="mem_email" class="form-control en_only" placeholder="이메일" required onkeydown="if(event.keyCode==13)submit();">
		<label for="mem_password" class="control-label">Password</label>
			<input type="password" name="mem_password" value="<?php echo set_value('mem_password'); ?>" id="mem_password" class="form-control en_only" placeholder="비밀번호" required>
		<label for="mem_passconf" class="control-label">Password Confirm</label>
			<input type="password" name="mem_passconf"  value="<?php echo set_value('mem_passconf'); ?>" id="mem_passconf" class="form-control" placeholder="비밀번호 확인" required>
		<span style="color: yellow;"><p><?php echo validation_errors(); ?></p></span>
		<button class="btn btn-lg btn-primary btn-block en_only" type="submit" style="margin: 20px 0 8px 0;">등록하기</button>
	</form>
	<a href="<?php echo $this->config->base_url('cms_member/login/'); ?>" style="color: #BBBBBB;" style="padding: 15px 0 60px 0;">돌아가기</a>
</div> <!-- /container -->
