<div class="container" style="color: #BBBBBB; width: 300px;">
<?php
	$attributes = array('name' => 'login', 'class' => 'form-signin', 'method' => 'post');
	echo form_open($this->config->base_url('member').'?returnURL='.rawurlencode(current_url()), $attributes);
?>
		<div id="main_logo" style="margin: 100px 0 50px 0;">
			<img src="/static/img/cms_main_logo_.png" alt="" style="cursor: pointer;">
		</div>
		<h3 class="form-signin-heading">로그인 하세요.</h3>
		<label for="inputEmail" class="control-label">ID</label>
			<input type="text" name="user_id" value="<? if(get_cookie('id_r')) echo get_cookie('id'); ?>" id="inputEmail" class="form-control en_only" placeholder="아이디" required autofocus>
		<label for="inputPassword" class="control-label">Password</label>
			<input type="password" name="passwd" value="<?php echo set_value('passwd'); ?>" id="inputPassword" class="form-control en_only" placeholder="비밀번호" required>
		<div class="checkbox">
			<label>
				<input type="checkbox" name="id_rem" value="rem" <?php if(get_cookie('id_r')=='rem') echo 'checked';?>> 아이디 저장하기
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-bottom: 8px;">로그인</button>
	</form>
	<a href="/member/join/" style="color: #BBBBBB;" style="padding-top: 15px;">신규계정 등록하기</a>
</div><!-- /container -->
