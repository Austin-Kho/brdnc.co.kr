		<div style="width:758px; height:100%; margin:0px auto;"><!-- wrap div -->
			<div style="height:10px;"></div>
			<article style="width:750px; border:2px solid #96ABE5; background-color:white;">
				<header style="width:746px; height:80px; border-bottom:2px solid #96ABE5; background-color:#D9EAF8; padding:19px 0 0 18px;">
					<img src="/bt/static/img/cms_main_logo.png" alt="" width="154px">
				</header>
				<section style="height:100px; text-align:center; padding-top:25px; font-size:14px; color:#818181; margin-bottom:15px;">
					CMS 솔루션을 사용하기 위한 <span style="font-size: 14px; color:#060172">직원 계정을 등록</span>해 주시기 바랍니다.<br>
					계정 등록은 <span style="font-size: 14px; color:#060172">[주] 바램디앤씨</span> 임직원에 한해서만 해 주시기 바라며, 등록 뒤 관리자의<br>
					승인을 얻은 후 사용이 가능합니다.<span style="font-size: 12px; color:#3e3e3e"> (당사 임직원 또는 관계자인 경우에만 승인됩니다.)</span>
				</section>
				<!-- <div style="border-width:1px 0 1px 0; border-style:solid; border-color:#CACAC1; text-align: center; background-color: #eaeaea;"> -->
				<header style="margin: 0 20px 20px 20px; padding: 5px 0 0 10px; height: 50px; border-width:1px 0 1px 0; border-style:solid; border-color: #D5D5D5;  background-color: #eaeaea;">

					<h5 style="font-size: 14px; font-weight: bold; color: #004080;">
						<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 사용자 등록
					</h5>
				</header>
<?php
	$attributes = array('name' => 'join', 'class'=>'form-inline');
	echo form_open($this->config->base_url.'member/', $attributes);
?>
					<fieldset style="padding: 0 20px 0 20px;" class="pale10">
						<div style="border-width:1px 0 0 0; border-style:solid; border-color:#eaeaea;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="user_id" style="width:180px;" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									아 이 디 <span style="color:#cc0000">*</span>
								</label>
								<input type="text" class="form-control input-sm" id="user_id" name="user_id" placeholder="ID" style="width: 180px; ime-mode:disabled;">
							 </div>
							 <a href="" class="btn btn-default btn-sm">중복확인</a>
							 <p style="padding-left: 186px; color: #999999;">특수문자, 한글, 공백을 포함할 수 없으며<br>모두 소문자로 처리됩니다. (5-15자 사이)</p>
						</div>

						<div style="border-width:1px 0 0 0; border-style:solid; border-color:#eaeaea;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="passwd" style="width:180px;" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									비밀번호 <span style="color:#cc0000">*</span>
								</label>
								<input type="password" class="form-control input-sm" id="passwd" name="passwd" placeholder="Password" style="width: 180px; ime-mode:disabled;">
							 </div>
							 <span style="color: #999;"></span>
						</div>
						<div style="border-width:0 0 0 0; border-style:solid; border-color:#eaeaea;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="passcf" style="width:180px;" class="pale10"></label>
								<input type="password" class="form-control input-sm" id="passcf" name="passcf" placeholder="" style="width: 180px; ime-mode:disabled;">
							 </div>
							 <span style="color: #999;">비밀번호를 한번 더 입력하세요.</span>
							 <p style="padding-left: 186px; color: #999999;">특수문자, 한글, 공백을 포함할 수 없으며<br>모두 소문자로 처리됩니다. (5-15자 사이)</p>
						</div>
						<div style="border-width:1px 0 0 0; border-style:solid; border-color:#eaeaea;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="name" style="width:180px;" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									이 름 <span style="color:#cc0000">*</span>
								</label>
								<input type="text" class="form-control input-sm" id="name" placeholder=""  style="width: 180px; ime-mode:active;">
							 </div>
						</div>
						<div style="border-width:1px 0 0 0; border-style:solid; border-color:#eaeaea;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="email" style="width:180px;" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									Email <span style="color:#cc0000">*</span>
								</label>
								<input type="email" class="form-control input-sm" id="email" name="emain" placeholder="Email address" style="width: 180px; ime-mode:disabled;">
							 </div>
							 <p style="padding-left: 186px; color: #999999;">
							 	<!-- <div class="checkbox"> -->
							    <!-- <label> -->
							      <input type="checkbox" checked="true" name="rcv_mail"><span style="color: #999999;"> 메일 수신에 동의합니다.</span>
							    <!-- </label> -->
							  <!-- </div> -->
							 </p>
						</div>
						<div style="border-width:1px 0 0 0; border-style:solid; border-color:#eaeaea;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="zipcode" style="width:180px;" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 주 소
								</label>
								<input type="text" class="form-control input-sm" id="zipcode" style="width: 80px" readonly>
							 </div>
							 <a href="" class="btn btn-default btn-sm">우편번호 검색</a>
						</div>
						<div>
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="address1" style="width:180px;" class="pale10"></label>
								<input type="text" class="form-control input-sm" id="address1" name="address1" style="width: 280px; ime-mode:disabled;" placeholder="기본 주소" readonly>
							 </div>
							 <span style="color: #999;">(동까지 입력)</span>
						</div>
						<div>
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="address2" style="width:180px;" class="pale10"></label>
								<input type="text" class="form-control input-sm" id="address2" name="address2" style="width: 280px; ime-mode:disabled;" placeholder="상세 주소">
							 </div>
							 <span style="color: #999;">(나머지 입력)</span>
						</div>
						<div style="border-width:1px 0 0 0; border-style:solid; border-color:#eaeaea;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="phone1" style="width:180px;" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 전화번호
								</label>
								<input type="text" class="form-control input-sm" id="phone1" name="phone1" placeholder="" style="width: 70px;"> -
								<label for="phone2" style="width:180px;" class="sr-only pale10">전화번호</label>
								<input type="text" class="form-control input-sm" id="phone2" name="phone2" placeholder="" style="width: 80px;"> -
								<label for="phone3" style="width:180px;" class="sr-only pale10">전화번호</label>
								<input type="text" class="form-control input-sm" id="phone3" name="phone3" placeholder="" style="width: 80px;">
							 </div>
						</div>
						<div style="border-width:1px 0 1px 0; border-style:solid; border-color:#eaeaea; margin-bottom: 20px;">
							<div class="form-group" style="padding: 5px 0 5px 0;">
								<label for="mobile1" style="width:180px;" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									휴대전화(Mobile) <span style="color:#cc0000">*</span>
								</label>
								<select class="form-control input-sm" id="mobile1" name="mobile1" style="width: 70px;">
								  <option>010</option>
								  <option>011</option>
								  <option>016</option>
								  <option>017</option>
								  <option>018</option>
								  <option>019</option>
								</select> -
								<label for="mobile2" style="width:180px;" class="sr-only pale10">휴대전화(Mobile)</label>
								<input type="text" class="form-control input-sm" id="mobile2" name="mobile2" placeholder="" style="width: 80px;"> -
								<label for="mobile3" style="width:180px;" class="sr-only pale10">휴대전화(Mobile)</label>
								<input type="text" class="form-control input-sm" id="mobile3" name="mobile3" placeholder="" style="width: 80px;">
							 </div>
						</div>
						<div style="border-width:1px 0 1px 0; border-style:solid; border-color:#CACAC1; text-align: center; background-color: #eaeaea; margin-bottom: 10px;">
							<div class="form-group" style="padding: 20px 0 20px 0;">
								<button href="" class="btn btn-primary btn-sm">사용자등록</button>
								<a href="javascript:history.go(-1);" class="btn btn-default btn-sm">취소</a>
							</div>
						</div>
					</fieldset>
				</form>
 			</article>
 		</div>