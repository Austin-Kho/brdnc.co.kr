/**
 *
 */
// 링크 점선 없애기
function bluring(){
	if(event.srcElement.tagName=="a"||event.srcElement.tagName=="img") document.body.focus();
}
document.onfocusin=bluring;

// 우편번호 검색창 열기
function ZipWindow(ref, z_form, a_form1, a_form2) { // ref = 파일경로, z_form = 우편번호 폼, a_form = 주소폼)
	var window_left = (screen.width-640)/2;
	var window_top = (screen.height-480)/2;
	window.open(ref+"?z_form="+z_form+"&a_form1="+a_form1+"&a_form2="+a_form2, "zipWin","scrollbars=no,width=580, height=586, status=no, top="+window_top+",left="+window_left);
}

// 오픈 윈도우2
<!--
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
	if(a!=null) document.getElementById(a).value=null;
	if(b!=null) document.getElementById(b).value=null;
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
function onlyNumber1(form_name){
   for(var i=0; i < form_name.value.length; i++) {
	     var chr = form_name.value.substr(i,1);
		 if(chr < '0' || chr > '9') {
		    alert("숫자 또는 소숫점 자리로만 입력하셔야 합니다!");
			form_name.focus();
			form_name.value="";
		 }
   }
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
//-->