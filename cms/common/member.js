/**
 * checkInput(val) // 멤버 조인 폼 첵 
 */

function checkInput(val){
	var frm = document.frm;
	var form = document.form1;


	if(!frm.elements['is_company'][0].checked&&!frm.elements['is_company'][1].checked){
		alert("등록코드를 선택하여 주십시요!");
		frm.is_company.focus();
		return;
	}
	if(frm.elements['is_company'][1].checked&&!frm.pj_seq.value){
		alert("프로젝트 코드를 선택하여 주십시요!");
		form.pj_seq.focus();
		return;
	}

	if(!form.user_id.value) {
		alert("아이디(ID)를 입력하세요!");
		form.user_id.focus();
		return ;
	}
	// if(!IsID(form.user_id.name)) {
	// 	alert("아이디는 4~10자의 영문자나 숫자 또는 조합된 문자열이어야 합니다!");
	// 	form.user_id.focus();
	// 	form.user_id.select();
	// 	return ;
	// }

	if(!form.passwd.value) {
		alert("비밀번호를 입력하세요!");
		form.passwd.focus();
		return ;
	}
	if(!IsPW(form.passwd.name)) {
			alert("비밀번호는 4~10자의 영문자나 숫자 또는 조합된 문자열이어야 합니다!");
			form.passwd.focus();
			form.passwd.select();
			return;
	}
	if(val=="join"){
		if(form.passwd.value != form.passwd2.value) {
			alert("입력하신 비밀번호가 일치하지 않습니다.\n다시 확인하시고 입력하여 주십시오!");
			form.passwd2.focus();
			form.passwd2.select();
			return;
		}
	}

	if(val=='modify'){
		if(form.new_passwd.value){
			if(!form.new_passwd2.value||(form.new_passwd.value != form.new_passwd2.value)){
				alert("새 비밀번호가 일치하지 않습니다. \n다시 확인하고 입력하여 주십시요!");
				form.new_passwd2.focus();
				return;
			}
		}

	}
	if(!form.name.value) {
		alert("이름을 입력하세요!");
		form.name.focus();
		return;
	}
	/*
	if(!form.jumin1.value) {
		alert("주민등록번호를 입력하세요!");
		form.jumin1.focus();
		return;
	}

	if(form.jumin1.value) {
		if(!IsNumber(form.jumin1.name)){
			alert("주민등록번호는 숫자이어야 합니다!");
			form.jumin1.focus();
			return;
		}
	}

	if(!form.jumin2.value) {
		alert("주민등록번호를 입력하세요!");
		form.jumin2.focus();
		return;
	}


	if(form.jumin2.value) {
		if(!IsNumber(form.jumin2.name)){
			alert("주민등록번호는 숫자이어야 합니다!");
			form.jumin2.focus();
			return;
		}
	}
	var chk =0
	var yy = form.jumin1.value.substring(0,2)
	var mm = form.jumin1.value.substring(2,4)
	var dd = form.jumin1.value.substring(4,6)
	var sex = form.jumin2.value.substring(0,1)

	if ((form.jumin1.value.length!=6)||(yy <0||mm <1||mm>12||dd<1)){
		alert ("주민등록번호를 바로 입력하여 주십시오.");
		form.jumin1.focus();
		return ;
	}

	if ((sex != 1 && sex !=2 && sex !=3 && sex !=4)||(form.jumin2.value.length != 7)){
		alert ("주민등록번호를 바로 입력하여 주십시오.");
		form.jumin2.focus();
		return;
	}

	// 주민등록번호 체크
	for (var i=0; i<=5 ; i++){
		chk = chk + ((i%8+2) * parseInt(form.jumin1.value.substring(i,i+1)))
	}

	for (var i = 6; i <=11 ; i++){
		chk = chk + ((i%8+2) * parseInt(form.jumin2.value.substring(i-6,i-5)))
	}

	chk = 11 - (chk %11)
	chk = chk % 10

	if (chk != form.jumin2.value.substring(6,7)) {
		alert ("유효하지 않은 주민등록번호입니다.");
		form.jumin1.focus();
		return;
	}
	*/

	if(!form.email1.value) {
		alert("이메일을 입력하세요!");
		form.email1.focus();
		return;
	}
	if(!form.email2.value) {
		alert("이메일을 입력하세요!");
		form.email2.focus();
		return;
	}
	/*
	if(!form.address1.value) {
		alert("주소를 입력하세요!");
		form.zipcode1.focus();
		return;
	}
	*/

	if(!form.hphone1.value) {
		alert("휴대폰 번호를 입력하세요!");
		form.hphone1.focus();
		return;
	}

	if(!form.hphone2.value) {
		alert("휴대폰 번호를 입력하세요!");
		form.hphone2.focus();
		return;
	}
	if(!form.hphone3.value) {
		alert("휴대폰 번호를 입력하세요!");
		form.hphone3.focus();
		return;
	}

	if(form.hphone1.value) {
		if(!IsNumber(form.hphone1.name)){
			alert("휴대폰 번호는 숫자이어야 합니다!");
			form.hphone1.focus();
			return;
		}
	}

	if(form.hphone2.value) {
		if(!IsNumber(form.hphone2.name)){
			alert("휴대폰 번호는 숫자이어야 합니다!");
			form.hphone2.focus();
			return;
		}
	}

	if(form.hphone3.value) {
		if(!IsNumber(form.hphone3.name)){
			alert("휴대폰 번호는 숫자이어야 합니다!");
			form.hphone3.focus();
			return;
		}
	}
	form.submit();
}



function checkEdit(){
   var form = document.form1;

  if(!form.passwd.value) {
     alert("비밀번호를 입력하세요!");
	 form.passwd.focus();
	 return ;
  }
    if(!IsPW(form.passwd.name)) {
     alert("비밀번호는 4 ~ 10자의 영문자나 숫자 또는 조합된 문자열이어야 합니다!");
	 form.passwd.focus();
	 form.passwd.select();
	 return;
  }

  if(form.passwd.value != form.passwd2.value) {
     alert("입력하신 비밀번호가 일치하지 않습니다.\n다시 확인하시고 넣어주십시오!");
	 form.passwd2.focus();
	 form.passwd2.select();
	 return;
  }


  if(!form.phone1.value) {
     alert("전화번호를 입력하세요!");
     form.phone1.focus();
	 return;
  }

  if(!form.phone2.value) {
     alert("전화번호를 입력하세요!");
     form.phone2.focus();
	 return;
  }
  if(!form.phone3.value) {
     alert("전화번호를 입력하세요!");
     form.phone3.focus();
	 return;
  }

  if(form.phone1.value) {
     if(!IsNumber(form.phone1.name)){
         alert("전화번호는 숫자이어야 합니다!");
	     form.phone1.focus();
	     return;
	  }
   }

  if(form.phone2.value) {
     if(!IsNumber(form.phone2.name)){
         alert("전화번호는 숫자이어야 합니다!");
	     form.phone2.focus();
	     return;
	  }
  }

   if(form.phone3.value) {
     if(!IsNumber(form.phone3.name)){
         alert("전화번호는 숫자이어야 합니다!");
	     form.phone3.focus();
	     return;
	  }
   }


  if(!form.email.value) {
     alert("이메일을 입력하세요!");
     form.email.focus();
	 return;
   }

   if (form.email.value.indexOf("@") < 0){
    alert('이메일 주소 형식이 틀립니다.');
    form.email.focus();
	return;
   }

   if (form.email.value.indexOf("/") >= 0){
     alert('이메일 주소 형식이 틀립니다.');
     form.email.focus();
     return;
    }

  form.submit();

 }


function lost_checkInput1(){
   var form = document.form1;

  if(!form.name.value) {
     alert("이름을 입력하세요!");
	 form.name.focus();
	 return ;
  }


 if(!form.jumin1.value) {
     alert("주민등록번호를 입력하세요!");
	 form.jumin1.focus();
	 return;
  }
    if(form.jumin1.value) {
	  if(!IsNumber(form.jumin1.name)){
         alert("주민등록번호는 숫자이어야 합니다!");
	     form.jumin1.focus();
	     return;
	  }
  }
 if(!form.jumin2.value) {
     alert("주민등록번호를 입력하세요!");
	 form.jumin2.focus();
	 return;
  }
  if(form.jumin2.value) {
      if(!IsNumber(form.jumin2.name)){
         alert("주민등록번호는 숫자이어야 합니다!");
	     form.jumin2.focus();
	     return;
	  }
  }
	var chk =0
	var yy = form.jumin1.value.substring(0,2)
	var mm = form.jumin1.value.substring(2,4)
	var dd = form.jumin1.value.substring(4,6)
	var sex = form.jumin2.value.substring(0,1)

	if ((form.jumin1.value.length!=6)||(yy <0||mm <1||mm>12||dd<1)){
	alert ("주민등록번호를 바로 입력하여 주십시오.");
	form.jumin1.focus();
	return ;
	}

	if ((sex != 1 && sex !=2 && sex !=3 && sex !=4)||(form.jumin2.value.length != 7 )){
	alert ("주민등록번호를 바로 입력하여 주십시오.");
	form.jumin2.focus();
	return;
	}

	// 주민등록번호 체크

	for (var i = 0; i <=5 ; i++){
	chk = chk + ((i%8+2) * parseInt(form.jumin1.value.substring(i,i+1)))
	}

	for (var i = 6; i <=11 ; i++){
	chk = chk + ((i%8+2) * parseInt(form.jumin2.value.substring(i-6,i-5)))
	}

	chk = 11 - (chk %11)
	chk = chk % 10

	if (chk != form.jumin2.value.substring(6,7))
	{
	alert ("유효하지 않은 주민등록번호입니다.");
	form.jumin1.focus();
	return;
	}

	   form.submit();
	  }



	function lost_checkInput2(){
	   var form = document.form2;

	  if(!form.id.value) {
		 alert("ID를 입력하세요!");
		 form.id.focus();
		 return ;
	  }

	  if(!form.name.value) {
		 alert("이름을 입력하세요!");
		 form.name.focus();
		 return ;
	  }


	 if(!form.jumin1.value) {
		 alert("주민등록번호를 입력하세요!");
		 form.jumin1.focus();
		 return;
	  }

	 if(!form.jumin2.value) {
		 alert("주민등록번호를 입력하세요!");
		 form.jumin2.focus();
		 return;
	  }

	var chk =0
	var yy = form.jumin1.value.substring(0,2)
	var mm = form.jumin1.value.substring(2,4)
	var dd = form.jumin1.value.substring(4,6)
	var sex = form.jumin2.value.substring(0,1)

	if ((form.jumin1.value.length!=6)||(yy <25||mm <1||mm>12||dd<1)){
	alert ("주민등록번호를 바로 입력하여 주십시오.");
	form.jumin1.focus();
	return ;
	}

	if ((sex != 1 && sex !=2 )||(form.jumin2.value.length != 7 )){
	alert ("주민등록번호를 바로 입력하여 주십시오.");
	form.jumin2.focus();
	return;
	}

  // 주민등록번호 체크

	for (var i = 0; i <=5 ; i++){
	chk = chk + ((i%8+2) * parseInt(form.jumin1.value.substring(i,i+1)))
	}

	for (var i = 6; i <=11 ; i++){
	chk = chk + ((i%8+2) * parseInt(form.jumin2.value.substring(i-6,i-5)))
	}

	chk = 11 - (chk %11)
	chk = chk % 10

	if (chk != form.jumin2.value.substring(6,7))
	{
	alert ("유효하지 않은 주민등록번호입니다.");
	form.jumin1.focus();
	return;
	}

  form.submit()
  }


function focus_move(frm,n,focus){
	if(frm.value.length==n){
		focus.focus();
	}
}



function focus_move2(){
 var str = document.form2.jumin1.value.length;
  if(str == 6)
	document.form2.jumin2.focus();
}
function focus_move3(){
 var str1 = document.form1.phone1.value.length;
 var str2 = document.form1.phone2.value.length;
	if(str1==3) document.form1.phone2.focus();
	if(str2==4) document.form1.phone3.focus();
}



 function IsID(formname) {
     var form=eval("document.form1." + formname);

     if(form.value.length < 4 || form.value.length > 10) {
         return false;
     }
     for(var i=0; i < form.value.length; i++) {
         var chr = form.value.substr(i,1);
         if((chr < '0' || chr > '9') && (chr < 'a' || chr > 'z')) {
            return false;
         }
     }
     return true;
  }

  function IsPW(formname) {
     var form=eval("document.form1." + formname);

     if(form.value.length < 4 || form.value.length > 10) {
         return false;
     }
     for(var i=0; i < form.value.length; i++) {
         var chr = form.value.substr(i,1);
         if((chr < '0' || chr > '9') && (chr < 'a' || chr > 'z') && ( chr < 'A' || chr > 'Z')) {
            return false;
         }
     }
     return true;
  }


  function IsNumber(formname) {
     var form=eval("document.form1." + formname);

	 for(var i=0; i < form.value.length; i++) {
	     var chr = form.value.substr(i,1);
		 if((chr < '0' || chr > '9')) {
		    return false;
		 }
     }
     return true;
  }


 function check_ID_Window(ref) {
   var user_id= eval(document.form1.user_id);
	 var str=user_id.value.length;

	 if(!user_id.value) {
      alert('아이디(ID)를 입력하신 후에 확인하세요!');
	  user_id.focus();
	  return;
	 }else if(str<4){
		 alert('아이디는 4~10자의 영문자 숫자 \n또는 조합된 문자열이어야 합니다!');
		 user_id.focus();
		 return;
   }else {
      ref = ref + "?user_id=" + user_id.value;
	  var window_left = (screen.width-640)/2;
	  var window_top = (screen.height-480)/2;
	  window.open(ref,"checkIDWin",'width=372,height=220,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
   }
}

function search_ID_Window(url){
	var receive_id=eval(document.form1.receive_id);

	if(!receive_id.value){
		alert('아이디(ID)를 입력하신 후에 확인하세요!');
		receive_id.focus();
		return;
	} else {
      url = url+"?receive_id="+receive_id.value;
	  var window_left = (screen.width-640)/2;
	  var window_top = (screen.height-480)/2;
	  window.open(url,"checkIDWin",'width=400,height=200,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
  }
}

//-->
