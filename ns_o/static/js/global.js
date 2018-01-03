/**
 *
 */
// 링크 점선 없애기
function bluring(){
	if(event.srcElement.tagName=="a"||event.srcElement.tagName=="img") document.body.focus();
}
document.onfocusin=bluring;

// 우편번호 검색창 열기
function ZipWindow(ref) { // ref = 파일경로, z_form = 우편번호 폼, a_form = 주소폼)
	var window_left = (screen.width-640)/2;
	var window_top = (screen.height-480)/2;
	window.open(ref, "zipWin","scrollbars=no,width=530, height=618, status=no, top="+window_top+",left="+window_left);
}

// 오픈 윈도우2
function open_Win(ref,name, wid, hei) {
	var window_left = (screen.width-640)/2;
	var window_top = (screen.height-480)/2;
	window.open(ref,name,'width='+wid+',height='+hei+',scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
}

// 쪽지창 열기
function message_win(ref) {
  // ref = ref + "?id=" + ;
  var window_left = (screen.width-640)/2;
  var window_top = (screen.height-480)/2;
  window.open(ref,"message",'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
}

//팝업
function popUp(url,name){
	var window_left = (screen.width-640)/2;
	var window_top = (screen.height-480)/2;
	window.open(url,name,'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
}
// 사이즈 지정 팝업
function popUp_size(url,name,w,h){ // 주소, 팝업명, 가로사이즈, 세로사이즈
	var window_left = (screen.width-640)/2;
	var window_top = (screen.height-480)/2;
	window.open(url,name,'width='+w+',height='+h+', scrollbars=yes, status=no, top='+window_top+', left='+window_left);
}

// class change
function cngClass(obj,cng){
	obj.className=cng;
}

// 기간 지우기
function to_del(a, b){
	if(a!==null) document.getElementById(a).value=null;
	if(b!==null) document.getElementById(b).value=null;
}

// 동호수 검색 결과 정렬 순서 폼 컨트롤
function  ad_control(val){
	var ad1=document.getElementById('reg_ad_');
	var ad2=document.getElementById('dong_ad_');
	var ad3=document.getElementById('ho_ad_');
	if(val==1){
		ad2.checked=false;
		ad3.checked=false;
	}
	if(val==2) ad1.checked=false;
}

// 숫자 이외의 키 입력 불가
function iNum(obj){

	if((event.keyCode<48)||(event.keyCode>57)){
		alert('숫자만 입력 가능합니다!');
		event.returnValue=false;
	}
	// onkeyPress 로 호출 -> 한글과 숫자만 입력 가능
	// onkeyDown 으로 호출 -> 절대 숫자키만 입력 가능
}

// 숫자만 입력 ..<input type='text' ....onkeypress='isMum();'....//
function isNum(){
   var key = event.keyCode;
   var messageArea = document.getElementById("ssnMessage");
   if(!(key==8||key==9||key==13||key==46||key==144||(key>=48&&key<=57)||key==110||key==190)){
        alert('숫자만 입력 가능합니다');
        event.returnValue = false;
   }
}

// 숫자인지 체크
function numChk(chk_frm){

	var pattern = /^[0-9]+$/;       //숫자패턴을 정해줌
	var chk = chk_frm.value;

	if(!pattern.test(chk)){        //만약 값이 숫자가 아니면~
		alert("숫자로만 입력할 수 있습니다!");
		chk_frm.value = "";
		chk_frm.focus();
		return;
   }
}

// 숫자로만 입력
function onlyNum(form_name){
   for(var i=0; i<form_name.value.length; i++) {
	    var chr = form_name.value.substr(i, 1);
		if(chr!=='.'){
			if(chr < '0' || chr > '9') {
				alert("숫자 또는 소숫점 자리로만 입력하셔야 합니다!");
				form_name.focus();
				form_name.value="";
			}
		}
   }
}
//숫자인지 체크하기
function IsNumber(s) {
	s += ''; // 문자열로 변환
	s = s.replace(/^\s*|\s*$/g, ''); // 좌우 공백 제거
	if (s === '' || isNaN(s)) return false;
	return true;
}

function login_check(form_name){
	var form = document.login;
	if(!form.user_id.value||form.user_id.value=='아이디') {
		alert("아이디를 입력하세요!");
    form.user_id.focus();
    return false;
  }
  if(!form.pwd.value) {
		alert("패스워드를 입력하세요!");
    form.pwd.focus();
    return false;
  }
}

// 달력 팝업1
function _Focus(div1,div2){
	div1.style.display='inline'	;
	// div2.style.display='none';
}

// 달력 팝업2
function _Blur(div){
	div.style.display='none';
}

function focusOn(frm,div1,div2){
	if(div1.style.display=='none'){
		div1.style.display='inline';
		div2.style.display='none';
	} else {
		div1.style.display='none';
	}
}

divcon=false;
function calDiv(div){
	divcon=true;
}




// 다음 우편번호 서비스 1 ---------------------//
function closeDaumPostcode() {
		// iframe을 넣은 element를 안보이게 한다.
		element_layer.style.display = 'none';
}

function execDaumPostcode(n) {
		new daum.Postcode({
				oncomplete: function(data) {
						// 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

						// 각 주소의 노출 규칙에 따라 주소를 조합한다.
						// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
						var fullAddr = data.address; // 최종 주소 변수
						var extraAddr = ''; // 조합형 주소 변수

						// 기본 주소가 도로명 타입일때 조합한다.
						if(data.addressType === 'R'){
								//법정동명이 있을 경우 추가한다.
								if(data.bname !== ''){
										extraAddr += data.bname;
								}
								// 건물명이 있을 경우 추가한다.
								if(data.buildingName !== ''){
										extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
								}

								// 상세 주소란에 입력할 괄호안 주소 데이터를 만든다.
								dtleAddr = (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
						}

						// 우편번호와 주소 정보를 해당 필드에 넣는다.
						document.getElementById('postcode'+n).value = data.zonecode; //5자리 새우편번호 사용
						document.getElementById('address1_'+n).value = fullAddr;
						document.getElementById('address2_'+n).value = dtleAddr;
						if(document.getElementById('addressEnglish'))  document.getElementById('addressEnglish').value = data.addressEnglish;

						// 커서를 상세주소 필드로 이동한다.
						document.getElementById('address2_'+n).focus();

						// iframe을 넣은 element를 안보이게 한다.
						// (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
						element_layer.style.display = 'none';
				},
				width : '100%',
				height : '100%',
				maxSuggestItems : 5
		}).embed(element_layer);

		// iframe을 넣은 element를 보이게 한다.
		element_layer.style.display = 'block';

		// iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
		initLayerPosition();
}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition(){
		var width = 420; //우편번호서비스가 들어갈 element의 width
		var height = 420; //우편번호서비스가 들어갈 element의 height
		var borderWidth = 5; //샘플에서 사용하는 border의 두께

		// 위에서 선언한 값들을 실제 element에 넣는다.
		element_layer.style.width = width + 'px';
		element_layer.style.height = height + 'px';
		element_layer.style.border = borderWidth + 'px solid';
		// 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
		element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
		element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}
// 다음 우편번호 서비스 1 ---------------------//
//-->
