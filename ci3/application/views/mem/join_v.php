		<div style="width:758px; height:100%; margin:0px auto;"><!-- wrap div -->
			<div style="height:10px;"></div>
			<article style="width:750px; border:2px solid #96ABE5; background-color:white;">
				<header style="width:746px; height:80px; border-bottom:2px solid #96ABE5; background-color:#D9EAF8; padding:19px 0 0 18px;">
					<img src="/ci3/static/img/cms_main_logo.png" alt="" width="154px">
				</header>
				<div style="height:95px; text-align:center; padding-top:25px; font-size:14px; color:#b0b0b0; margin-bottom:15px;">
					<b>CMS 솔루션을 사용하기 위한 <span style="color:#6D6363">직원 계정을 등록</span>해 주시기 바랍니다.<br>
					계정 등록은 <span style="color:#6D6363">[주] 바램디앤씨</span> 임직원에 한해서만 해 주시기 바라며, 등록 뒤 관리자의<br>
					승인을 얻은 후 사용이 가능합니다.<span style="font-size:12px; color:#6D6363;"> (당사 임직원 또는 관계자인 경우에만 승인됩니다.)</span></b>
				</div>

				<div style="margin: 0 20px 3px 20px; padding: 5px 0 0 30px; height: 50px; border-width:1px 0 1px 0; border-style:solid; border-color: #D5D5D5; background-color: #F3F3F3;">		<h4>회원가입</h4>
				</div>

<?php
	$attributes = array('name' => 'join', 'class'=>'form-horizontal');
	echo form_open('http://brdnc.cafe24.com/ci3/member/', $attributes);
?>

				<fieldset>
					<!-- <legend style="padding: 0 0 10px 30px; margin: 0 20px 0 20px;">회원가입</legend> -->
					<!-- <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">등록코드 구분</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="Small input">
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">담당부서 선택</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="Small input">
				    </div>
				  </div> -->
				  <div class="form-group form-group-sm" style="margin: 10px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">아 이 디</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="ID"  style="width: 150px;">
				      <p style="padding-top: 3px; color: #999999;">특수문자, 한글, 공백을 포함할 수 없으며<br>모두 소문자로 처리됩니다. (5-15자 사이)</p>
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">비밀번호</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="Password" style="width: 260px;">
				      <p style="padding-top: 3px; color: #999999;">특수문자, 한글, 공백을 포함할 수 있으며<br>대 소문자를 구분합니다.</p>
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">비밀번호 확인</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="" style="width: 260px;">
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">이 름</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="" style="width: 260px;">
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">Email</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="Email address" style="width: 260px;">
							<label class="checkbox-inline">
								<input type="checkbox" id="input03" name="id_rem"> <span style="color: #999999;">메일수신에 동의합니다.</span>
							</label>
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">우편번호</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="" style="width: 60px;">
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">주 소</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="기본 주소" style="width: 350px;"> <!-- 동까지 입력 -->
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall"></label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="상세 주소"  style="width: 350px;"> <!-- 나머지 입력 -->
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">전화번호</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="" style="width: 260px;">
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="margin: 13px 20px 13px 20px;">
				    <label class="col-sm-3 control-label" for="formGroupInputSmall">휴대전화(Mobile)</label>
				    <div class="col-sm-9">
				      <input class="form-control" type="text" id="formGroupInputSmall" placeholder="" style="width: 260px;">
				    </div>
				  </div>
				  <div class="form-group form-group-sm" style="padding-top: 25px; margin: 15px 20px 30px 20px; text-align: center; border-top:1px solid #D5D5D5;">
				    <div class="col-sm-12" style="">
				    	<span class="btn btn-primary btn-sm" onclick="location.href('/ci3/member/join/');">회원가입</span>
				    	<span class="btn btn-default btn-sm" onclick="history.go(-1);">취소</span>
				    </div>
				  </div>
				</fieldset>

				</form>
 			</article>
 		</div>