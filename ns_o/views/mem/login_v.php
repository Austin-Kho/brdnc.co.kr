<div class="container" style="color: #BBBBBB; width: 300px;">
<?php
	$attributes = array('name' => 'login', 'class' => 'form-signin', 'method' => 'post');
	echo form_open(base_url('member'), $attributes);
?>
		<label><input type="hidden" name="returnURL" value="<?php echo $this->input->get('returnURL'); ?>"></label>
		<div id="main_logo" style="margin: 100px 0 50px 0;">
			<img src="<?php echo base_url(); ?>static/img/cms_main_logo_.png" alt="" style="cursor: pointer;">
		</div>
		<h3 class="form-signin-heading">로그인 하세요.</h3>
		<label for="user_data" class="control-label">ID</label>
			<input type="text" name="user_data" value="<?php if(get_cookie('id_r')) echo get_cookie('id'); ?>" id="user_data" class="form-control en_only" placeholder="아이디 또는 이메일" required autofocus>
		<label for="passwd" class="control-label">Password</label>
			<input type="password" name="passwd" value="<?php echo set_value('passwd'); ?>" id="passwd" class="form-control en_only" placeholder="비밀번호" required>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="id_rem" value="rem" <?php if(get_cookie('id_r')=='rem') echo 'checked';?>> 아이디 저장하기
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-bottom: 8px;">로그인</button>
	</form>
	<a href="<?php echo base_url('/member/join/'); ?>" style="color: #BBBBBB;" style="padding-top: 15px;">신규계정 등록하기</a>
</div><!-- /container -->
