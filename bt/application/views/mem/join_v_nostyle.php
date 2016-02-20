		<div><!-- wrap div -->
			<div></div>
			<article>
				<header>
					<img src="/bt/static/img/cms_main_logo.png" alt="" width="154px">
				</header>
				<section>
					CMS 솔루션을 사용하기 위한 <span style="font-size: 14px; color:#060172">직원 계정을 등록</span>해 주시기 바랍니다.<br>
					계정 등록은 <span style="font-size: 14px; color:#060172">[주] 바램디앤씨</span> 임직원에 한해서만 해 주시기 바라며, 등록 뒤 관리자의<br>
					승인을 얻은 후 사용이 가능합니다.<span style="font-size: 12px; color:#3e3e3e"> (당사 임직원 또는 관계자인 경우에만 승인됩니다.)</span>
				</section>
				<!-- <div style="border-width:1px 0 1px 0; border-style:solid; border-color:#CACAC1; text-align: center; background-color: #eaeaea;"> -->
				<header>

					<h5>
						<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 사용자 등록
					</h5>
				</header>
<?php
	$attributes = array('name' => 'join', 'class'=>'form-inline');
	echo form_open('http://brdnc.cafe24.com/bt/member/', $attributes);
?>
					<fieldset class="pale10">
						<div>
							<div class="form-group">
								<label for="user_id" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									아 이 디 <span>*</span>
								</label>
								<input type="text" class="form-control input-sm" id="user_id" name="user_id" placeholder="ID">
							 </div>
							 <a href="" class="btn btn-default btn-sm">중복확인</a>
							 <p>특수문자, 한글, 공백을 포함할 수 없으며<br>모두 소문자로 처리됩니다. (5-15자 사이)</p>
						</div>

						<div>
							<div class="form-group">
								<label for="passwd" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									비밀번호 <span>*</span>
								</label>
								<input type="password" class="form-control input-sm" id="passwd" name="passwd" placeholder="Password">
							 </div>
							 <span></span>
						</div>
						<div>
							<div class="form-group">
								<label for="passcf" class="pale10"></label>
								<input type="password" class="form-control input-sm" id="passcf" name="passcf" placeholder="">
							 </div>
							 <span>비밀번호를 한번 더 입력하세요.</span>
							 <p>특수문자, 한글, 공백을 포함할 수 없으며<br>모두 소문자로 처리됩니다. (5-15자 사이)</p>
						</div>
						<div>
							<div class="form-group">
								<label for="name" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									이 름 <span>*</span>
								</label>
								<input type="text" class="form-control input-sm" id="name" placeholder="">
							 </div>
						</div>
						<div>
							<div class="form-group">
								<label for="email" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									Email <span>*</span>
								</label>
								<input type="email" class="form-control input-sm" id="email" name="emain" placeholder="Email address">
							 </div>
							 <p>
							 	<!-- <div class="checkbox"> -->
							    <!-- <label> -->
							      <input type="checkbox" checked="true" name="rcv_mail"><span> 메일 수신에 동의합니다.</span>
							    <!-- </label> -->
							  <!-- </div> -->
							 </p>
						</div>
						<div>
							<div class="form-group">
								<label for="zipcode" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 주 소
								</label>
								<input type="text" class="form-control input-sm" id="zipcode" readonly>
							 </div>
							 <a href="" class="btn btn-default btn-sm">우편번호 검색</a>
						</div>
						<div>
							<div class="form-group">
								<label for="address1" class="pale10"></label>
								<input type="text" class="form-control input-sm" id="address1" name="address1" placeholder="기본 주소" readonly>
							 </div>
							 <span>(동까지 입력)</span>
						</div>
						<div>
							<div class="form-group">
								<label for="address2" class="pale10"></label>
								<input type="text" class="form-control input-sm" id="address2" name="address2" placeholder="상세 주소">
							 </div>
							 <span>(나머지 입력)</span>
						</div>
						<div>
							<div class="form-group">
								<label for="phone1" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 전화번호
								</label>
								<input type="text" class="form-control input-sm" id="phone1" name="phone1" placeholder=""> -
								<label for="phone2" style="width:180px;" class="sr-only pale10">전화번호</label>
								<input type="text" class="form-control input-sm" id="phone2" name="phone2" placeholder=""> -
								<label for="phone3" style="width:180px;" class="sr-only pale10">전화번호</label>
								<input type="text" class="form-control input-sm" id="phone3" name="phone3" placeholder="">
							 </div>
						</div>
						<div>
							<div class="form-group">
								<label for="mobile1" class="pale10">
									<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
									휴대전화(Mobile) <span>*</span>
								</label>
								<select class="form-control input-sm" id="mobile1" name="mobile1">
								  <option>010</option>
								  <option>011</option>
								  <option>016</option>
								  <option>017</option>
								  <option>018</option>
								  <option>019</option>
								</select> -
								<label for="mobile2" class="sr-only pale10">휴대전화(Mobile)</label>
								<input type="text" class="form-control input-sm" id="mobile2" name="mobile2" placeholder=""> -
								<label for="mobile3" class="sr-only pale10">휴대전화(Mobile)</label>
								<input type="text" class="form-control input-sm" id="mobile3" name="mobile3" placeholder="">
							 </div>
						</div>
						<div>
							<div class="form-group">
								<button href="" class="btn btn-primary btn-sm">사용자등록</button>
								<a href="javascript:history.go(-1);" class="btn btn-default btn-sm">취소</a>
							</div>
						</div>
					</fieldset>
				</form>
 			</article>
 		</div>