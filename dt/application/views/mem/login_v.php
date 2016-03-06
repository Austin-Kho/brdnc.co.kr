		<div style="width:600px; height:100%; margin:0px auto;"><!-- wrap div -->
			<div style="height:180px;"></div>
			<article style="width:600px; height:450px; border:2px solid #96ABE5; background-color:white;">
				<header style="width:596px; height:80px; border-bottom:2px solid #96ABE5; background-color:#D9EAF8; padding:19px 0 0 18px;">
					<img src="/dt/static/img/cms_main_logo.png" alt="" width="154px">
				</header>
<?php
	$attributes = array('name' => 'login');
	echo form_open('http://brdnc.cafe24.com/dt/member/', $attributes);
?>
				<fieldset>
					<!-- <legend>로그인</legend> --><!-- 폼 캡션 -->
					<div class="col-xs-4" style="padding: 26px 0 0 30px; widht: 200px;">
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
						<a class="btn btn-default btn-sm" href="/dt/member/join/">회원가입</a>
					</div>
					<div class="col-xs-4" style="padding: 10px 0 0 0px;">
						<!-- <label class="checkbox-inline">
						  <input type="checkbox" id="input03" name="id_rem"> ID 저장
						</label> -->
						<a class="btn btn-link btn-xs" href="javascript:alert('준비 중!!!')">아이디 찾기</a>
						<a class="btn btn-link btn-xs" href="javascript:alert('준비 중!!!')">비밀번호 찾기</a>
					</div>
					<!-- <div class="col-xs-4" style="padding: 10px 0 0 0px;">

					</div> -->
				</fieldset>
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
								<th colspan="5"><!-- <?php // echo $pagination; ?> --></th>
							</tr>
						</tfoot>
					</table>
				</article>
 			</article>
 		</div>