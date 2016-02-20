<body class='ui_charcoal login-page application navless'>
	<header class='navbar navbar-fixed-top navbar-empty'>
		<div class='container'>
			<div class='center-logo'>
				<svg width="36" height="36" id="tanuki-logo">
				  <path id="tanuki-right-ear" class="tanuki-shape" fill="#e24329" d="M2 14l9.38 9v-9l-4-12.28c-.205-.632-1.176-.632-1.38 0z"/>
				  <path id="tanuki-left-ear" class="tanuki-shape" fill="#e24329" d="M34 14l-9.38 9v-9l4-12.28c.205-.632 1.176-.632 1.38 0z"/>
				  <path id="tanuki-nose" class="tanuki-shape" fill="#e24329" d="M18,34.38 3,14 33,14 Z"/>
				  <path id="tanuki-right-eye" class="tanuki-shape" fill="#fc6d26" d="M18,34.38 11.38,14 2,14 6,25Z"/>
				  <path id="tanuki-left-eye" class="tanuki-shape" fill="#fc6d26" d="M18,34.38 24.62,14 34,14 30,25Z"/>
				  <path id="tanuki-right-cheek" class="tanuki-shape" fill="#fca326" d="M2 14L.1 20.16c-.18.565 0 1.2.5 1.56l17.42 12.66z"/>
				  <path id="tanuki-left-cheek" class="tanuki-shape" fill="#fca326" d="M34 14l1.9 6.16c.18.565 0 1.2-.5 1.56L18 34.38z"/>
				</svg>
			</div>
		</div>
	</header>



<div class='container navless-container'>
<div class='content'>
<div class='flash-container'>
<div class='flash-notice'>
Signed out successfully.
</div>
</div>

<div class='row'>
<div class='col-sm-5 pull-right'>
<div>
<div class='login-box'>
<div class='login-heading'>
<h3>Existing user? Sign in</h3>
</div>
<div class='login-body'>
<form class="new_user" id="new_user" action="/users/sign_in" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="1DaN5Inm0tYfoUVXGAQeItxSaKuempaFiG4+GFOfzUtfPNdwOeMjmNDq34viqPbVCxdeiuzHONeE5SKi8d9Fjg==" /><input class="form-control top" placeholder="Username or Email" autofocus="autofocus" autocapitalize="off" autocorrect="off" type="text" name="user[login]" id="user_login" />
<input class="form-control bottom" placeholder="Password" type="password" name="user[password]" id="user_password" />
<div class='remember-me checkbox'>
<label for='user_remember_me'>
<input name="user[remember_me]" type="hidden" value="0" /><input type="checkbox" value="1" name="user[remember_me]" id="user_remember_me" />
<span>Remember me</span>
</label>
<div class='pull-right'>
<a href="/users/password/new">Forgot your password?</a>
</div>
</div>
<div>
<input type="submit" name="commit" value="Sign in" class="btn btn-save" />
</div>
</form>

</div>
</div>

<div class='clearfix prepend-top-20'>
<p>
<span class='light'>
Sign in with &nbsp;
</span>
<span class='light'>
<a class="oauth-image-link" data-no-turbolink="true" rel="nofollow" data-method="post" href="/users/auth/google_oauth2"><img alt="Google" title="Sign in with Google" src="/assets/auth_buttons/google_64-af7db1f61dfb1a74abab9ed8285bde6a.png" /></a>
</span>
<span class='light'>
<a class="oauth-image-link" data-no-turbolink="true" rel="nofollow" data-method="post" href="/users/auth/twitter"><img alt="Twitter" title="Sign in with Twitter" src="/assets/auth_buttons/twitter_64-69c381e1cee71cb75e458ae1e6828ba2.png" /></a>
</span>
<span class='light'>
<a class="oauth-image-link" data-no-turbolink="true" rel="nofollow" data-method="post" href="/users/auth/github"><img alt="GitHub" title="Sign in with GitHub" src="/assets/auth_buttons/github_64-93c6eb739ee4d6e27937c4b14aea5e8f.png" /></a>
</span>
<span class='light'>
<a class="oauth-image-link" data-no-turbolink="true" rel="nofollow" data-method="post" href="/users/auth/bitbucket"><img alt="Bitbucket" title="Sign in with Bitbucket" src="/assets/auth_buttons/bitbucket_64-f7e97e09f46a9fdcdebad633a26815ce.png" /></a>
</span>
</p>

</div>
<div class='prepend-top-20'>
<div class='login-box'>
<div class='login-heading'>
<h3>New user? Create an account</h3>
</div>
<div class='login-body'>
<form class="new_user" id="new_user" action="/users" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="sHMkA2ZwpFvGAdxOcxISb4jQ5AQ5C+wVAqDy6e6L1ZA7eX6X1nVVFQlKRpKJvvqYX5XSJUtWQkcOK+5TTMtdVQ==" /><div class='devise-errors'>

</div>
<div>
<input class="form-control top" placeholder="Name" required="required" type="text" name="user[name]" id="user_name" />
</div>
<div>
<input class="form-control middle" placeholder="Username" required="required" type="text" name="user[username]" id="user_username" />
</div>
<div>
<input class="form-control middle" placeholder="Email" required="required" type="email" name="user[email]" id="user_email" />
</div>
<div class='form-group append-bottom-20' id='password-strength'>
<input class="form-control bottom" id="user_password_sign_up" placeholder="Password" required="required" type="password" name="user[password]" />
</div>
<div></div>
<script src="//www.google.com/recaptcha/api.js" async defer></script>
<div class="g-recaptcha" data-sitekey="6LfAERQTAAAAAL4GYSiAMGLbcLyUIBSfPrDNJgeC" data-stoken="3jCcr_Fyo5RZVB4ce6ITcWsmc0tjruBGfvbIzI652veOpdZoBovoSGouLiQ4dARV58kRGekazB11a8USLNttJSGuSwcN5CQpDYTJ36fLCeE"></div>
          <noscript>
            <div style="width: 302px; height: 352px;">
              <div style="width: 302px; height: 352px; position: relative;">
                <div style="width: 302px; height: 352px; position: absolute;">
                  <iframe
                    src="//www.google.com/recaptcha/api/fallback?k=6LfAERQTAAAAAL4GYSiAMGLbcLyUIBSfPrDNJgeC"
                    frameborder="0" scrolling="no"
                    style="width: 302px; height:352px; border-style: none;">
                  </iframe>
                </div>
                <div style="width: 250px; height: 80px; position: absolute; border-style: none;
                  bottom: 21px; left: 25px; margin: 0px; padding: 0px; right: 25px;">
                  <textarea id="g-recaptcha-response" name="g-recaptcha-response"
                    class="g-recaptcha-response"
                    style="width: 250px; height: 80px; border: 1px solid #c1c1c1;
                    margin: 0px; padding: 0px; resize: none;" value="">
</textarea>
                </div>
              </div>
            </div>
          </noscript>

<div>
<input type="submit" name="commit" value="Sign up" class="btn-create btn" />
</div>
</form>
</div>
</div>
<div class='clearfix prepend-top-20'>
<p>
<span class='light'>Didn't receive a confirmation email?</span>
<a href="/users/confirmation/new">Request a new one</a>.
</p>
</div>

</div>
</div>

</div>
<div class='col-sm-7 brand-holder pull-left'>
<h1>
GitLab.com
</h1>

<p><strong>GitLab.com offers free unlimited (private) repositories and unlimited collaborators, please sign up or in on the right.</strong></p>

<ul>
<li>
<a href="https://gitlab.com/explore/projects/trending">Explore projects on GitLab.com</a> (no login needed)</li>
<li><a href="https://about.gitlab.com/gitlab-com/" rel="nofollow">More information about GitLab.com</a></li>
<li><a href="https://gitlab.com/gitlab-com/support-forum/issues">GitLab.com Support Forum</a></li>
</ul>

<p>By signing up for and by signing in to this service you accept our:</p>

<ul>
<li><a href="https://about.gitlab.com/privacy/" rel="nofollow">Privacy policy</a></li>
<li>
<a href="https://about.gitlab.com/terms/#gitlab_com" rel="nofollow">GitLab.com Terms</a>.</li>
</ul>
</div>
</div>
</div>
</div>
<hr>
<div class='container'>
<div class='footer-links'>
<a href="/explore">Explore</a>
<a href="/help">Help</a>
<a href="https://about.gitlab.com/">About GitLab</a>
</div>
</div>
</body>






 		<!-- <div class="container" style="background-color: white;">
<?php
	$attributes = array('name' => 'login');
	echo form_open('http://brdnc.cafe24.com/bt/member/', $attributes);
?>

      <form class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> --> <!-- /container -->



		<!-- <div style="width:600px; height:100%; margin:0px auto;"> --><!-- wrap div -->
			<!-- <div style="height:180px;"></div>
			<article style="width:600px; height:450px; border:2px solid #96ABE5; background-color:white;">
				<header style="width:596px; height:80px; border-bottom:2px solid #96ABE5; background-color:#D9EAF8; padding:19px 0 0 18px;">
					<img src="/bt/static/img/cms_main_logo.png" alt="" width="154px">
				</header>
<?php
	$attributes = array('name' => 'login');
	echo form_open('http://brdnc.cafe24.com/bt/member/', $attributes);
?>
				<fieldset> -->
					<!-- <legend>로그인</legend> --><!-- 폼 캡션 -->
					<!-- <div class="col-xs-4" style="padding: 26px 0 0 30px; widht: 200px;">
						<label class="sr-only" for="input01">아이디</label>
						<div>
							<input type="text" name="user_id" id="input01" value="<?php echo set_value('user_id'); ?>" class="form-control  input-sm"  placeholder="ID">
							<p class="help-block"></p>
						</div>
						<label class="sr-only" for="input02">비밀번호</label>
						<div class="">
							<input type="password" name="passwd" id="input02;" value="<?php echo set_value('passwd'); ?>"  class="form-control  input-sm" placeholder="Password">
							<p class="help-block"></p>
						</div>
					</div>
					<div class="col-xs-4" style="padding: 32px 0 0 12px; width: 80px;">
						<button class="btn btn-primary btn-xs" type="submit" style="height: 60px; width: 58px;">로그인</button>
					</div>
					<div class="col-xs-4" style="padding: 32px 0 0 0px; width: 310px; background-color: yollow;">
						<a class="btn btn-default btn-sm" href="/bt/member/join/">회원가입</a>
					</div>
					<div class="col-xs-4" style="padding: 10px 0 0 0px;"> -->
						<!-- <label class="checkbox-inline">
						  <input type="checkbox" id="input03" name="id_rem"> ID 저장
						</label> -->
						<!-- <a class="btn btn-link btn-xs" href="javascript:alert('준비 중!!!')">아이디 찾기</a>
						<a class="btn btn-link btn-xs" href="javascript:alert('준비 중!!!')">비밀번호 찾기</a>
					</div> -->
					<!-- <div class="col-xs-4" style="padding: 10px 0 0 0px;">

					</div> -->
				<!-- </fieldset>
				</form>
				<div style="margin: 0 20px 0 20px; padding: 5px 0 0 10px; height: 60px; border-top:1px solid #D5D5D5;">
<?php if(validation_errors()) {?>
					<font color=#D70000>
<?php echo validation_errors();?></font>
<?php } else { ?><font color=#6C6A6A>
영문 입력의 경우 대소문자를 구분하여 입력하여 주십시요.</font>
<?php } ?>
				</div>
				<article style="padding: 0 20px 0 20px;">
					<table class="table table-striped" cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th scope="co1" colspan="2">
									<span class="glyphicon glyphicon-volume-up" aria-hidden="true"></span> CMS 공지사항
								</th>
							</tr>
						</thead>
						<tbody>
<?php for($i=0; $i<4; $i++) : ?>
							<tr>
								<td class="col-sm-9 col-md-10">테스트</td>
								<td class="col-sm-3 col-md-2">2016-02-16</td>
							</tr>
<?php endfor; ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="5"> --><!-- <?php // echo $pagination; ?> --></th>
							<!-- </tr>
						</tfoot>
					</table>
				</article>
 			</article>
 		</div> -->



