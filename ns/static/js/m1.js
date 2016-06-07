
/********************계약등록 시작*******************/
// 계약금 입력란 추가 함수
function receive_add(val, no, n){  // 체크박스 // 넘버  id="receive_10"
	var str1="rec_";
	var str2="chk_";
	var np=parseInt(no)+1;
	var nm=parseInt(no)-1;
	var rec_n=str1+np;
	var chk_n=str2+nm;

	var receiv=document.getElementById(rec_n);
	var ckbox=document.getElementById(chk_n);

	if(val.checked===true){
		receiv.style.display="";
		if(!n)ckbox.disabled=true;
	}else{
		receiv.style.display="none";
		if(!n)ckbox.disabled=false;
	}
}

function cont_check(){
	var form1 = document.set1;
	var form2 = document.form1;

	if( !form1.project.value || form1.project.value===''){
		alert('프로젝트를 선택하여 주십시요!');
		form1.project.focus();
		return;
	}
	if(form1.cont_sort1[0].checked==1){ // 계약 진행시
		if(!form1.cont_sort2.value || form1.cont_sort2.value==='0'){
			alert('세부 등록 구분을 선택하여 주십시요!');
			form1.cont_sort2.focus();
			return;
		}
	}
	if(form1.cont_sort1[1].checked==1){ // 해지 진행시
		if(!form1.cont_sort3.value || form1.cont_sort3.value==='0'){
			alert('세부 등록 구분을 선택하여 주십시요!');
			form1.cont_sort3.focus();
			return;
		}
		if(!form1.cont_sort3.value || form1.cont_sort3.value==='0'){
			alert('세부 등록 구분을 선택하여 주십시요!');
			form1.cont_sort3.focus();
			return;
		}
	}
	if(!form1.type.value){
		alert('타입 정보를 선택하여 주십시요!');
		form1.type.focus();
		return;
	}
	if(form1.dong&& !form1.dong.value){
		alert('동 정보를 선택하여 주십시요!');
		form1.dong.focus();
		return;
	}
	if(form1.ho&&!form1.ho.value){
		alert('호수 정보를 선택하여 주십시요!');
		form1.ho.focus();
		return;
	}

	if(!form1.cont_sort3&&!form2.conclu_date.value){
		alert('거래일자를 입력하여 주십시요!');
		form2.conclu_date.focus();
		return;
	}
	if( !form1.cont_sort3 && !form2.diff_no.value){
		alert('차수구분을 선택하여 주십시요!');
		form2.diff_no.focus();
		return;
	}
	if(!form1.cont_sort3&&!form2.custom_name.value){
		alert('계약 고객명을 입력하여 주십시요!');
		form2.custom_name.focus();
		return;
	}
	if(!form1.cont_sort3&&!form2.tel_1.value){
		alert('고객 연락처를 입력하여 주십시요!');
		form2.tel_1.focus();
		return;
	}

	if(typeof(form1.cont_sort2)!='undefined'  && form1.cont_sort2.value=='1') {
		if( !form2.app_in_mon.value){
			alert('청약금을 입력하여 주십시요!');
			form2.app_in_mon.focus();
			return;
		}
		if( !form2.app_in_acc.value){
			alert('청약금 입금 계좌를 선택하여 주십시요!');
			form2.app_in_acc.focus();
			return;
		}
		if( !form2.app_in_date.value || form2.app_in_date.value==='0000-00-00'){
			alert('청약금 입금 일자를 입력하여 주십시요!');
			form2.app_in_date.focus();
			return;
		}
		if( !form2.app_in_who.value){
			alert('청약금 입금자명을 입력하여 주십시요!');
			form2.app_in_who.focus();
			return;
		}

	}else if(typeof(form1.cont_sort2)!='undefined' &&  form1.cont_sort2.value=='2'){

		if( typeof(form2.app_in_mon)!='undefined' && form2.app_in_mon.value && !form2.app_pay_sche.value){
			alert('청약금이 귀속할 납부회차를 선택하여 주십시요!');
			form2.app_pay_sche.focus();
			return;
		}
		// if(form1.cont_sort2.value=='2'&& !form2.deposit_1.value){
		// 	alert("계약금 항목을 입력하세요.");
		// 	form2.deposit_1.focus();
		// 	return;
		// }
		if(form1.cont_sort2.value=='2'&& form2.deposit_1.value&& !form2.dep_acc_1.value){
			alert("계약금 입금 계좌를 선택하세요.");
			form2.dep_acc_1.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_1.value&& !form2.cont_in_date1.value){
			alert("계약금 입금 일자를 선택하세요.");
			form2.cont_in_date1.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_1.value&& !form2.cont_in_who1.value){
			alert("계약금 실제 납부자 명을 입력하세요.");
			form2.cont_in_who1.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_1.value&& !form2.cont_pay_sche1.value){
			alert("금회 납부 처리 회차를 선택하세요.");
			form2.cont_pay_sche1.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_2.value&& !form2.dep_acc_2.value){
			alert("계약금 입금 계좌를 선택하세요.");
			form2.dep_acc_2.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_2.value&& !form2.cont_in_date2.value){
			alert("계약금 입금 일자를 선택하세요.");
			form2.cont_in_date2.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_2.value&& !form2.cont_in_who2.value){
			alert("계약금 실제 납부자 명을 입력하세요.");
			form2.cont_in_who2.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_2.value&& !form2.cont_pay_sche2.value){
			alert("금회 납부 처리 회차를 선택하세요.");
			form2.cont_pay_sche2.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_3.value&& !form2.dep_acc_3.value){
			alert("계약금 입금 계좌를 선택하세요.");
			form2.dep_acc_3.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_3.value&& !form2.cont_in_date3.value){
			alert("계약금 입금 일자를 선택하세요.");
			form2.cont_in_date3.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_3.value&& !form2.cont_in_who3.value){
			alert("계약금 실제 납부자 명을 입력하세요.");
			form2.cont_in_who3.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_3.value&& !form2.cont_pay_sche3.value){
			alert("금회 납부 처리 회차를 선택하세요.");
			form2.cont_pay_sche3.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_4.value&& !form2.dep_acc_4.value){
			alert("계약금 입금 계좌를 선택하세요.");
			form2.dep_acc_4.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_4.value&& !form2.cont_in_date4.value){
			alert("계약금 입금 일자를 선택하세요.");
			form2.cont_in_date4.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_4.value&& !form2.cont_in_who4.value){
			alert("계약금 실제 납부자 명을 입력하세요.");
			form2.cont_in_who4.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_4.value&& !form2.cont_pay_sche4.value){
			alert("금회 납부 처리 회차를 선택하세요.");
			form2.cont_pay_sche4.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_5.value&& !form2.dep_acc_5.value){
			alert("계약금 입금 계좌를 선택하세요.");
			form2.dep_acc_5.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_5.value&& !form2.cont_in_date5.value){
			alert("계약금 입금 일자를 선택하세요.");
			form2.cont_in_date5.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_5.value&& !form2.cont_in_who5.value){
			alert("계약금 실제 납부자 명을 입력하세요.");
			form2.cont_in_who5.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_5.value&& !form2.cont_pay_sche5.value){
			alert("금회 납부 처리 회차를 선택하세요.");
			form2.cont_pay_sche5.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_6.value&& !form2.dep_acc_6.value){
			alert("계약금 입금 계좌를 선택하세요.");
			form2.dep_acc_6.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_6.value&& !form2.cont_in_date6.value){
			alert("계약금 입금 일자를 선택하세요.");
			form2.cont_in_date6.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_6.value&& !form2.cont_in_who6.value){
			alert("계약금 실제 납부자 명을 입력하세요.");
			form2.cont_in_who6.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_6.value&& !form2.cont_pay_sche6.value){
			alert("금회 납부 처리 회차를 선택하세요.");
			form2.cont_pay_sche6.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_7.value&& !form2.dep_acc_7.value){
			alert("계약금 입금 계좌를 선택하세요.");
			form2.dep_acc_7.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_7.value&& !form2.cont_in_date7.value){
			alert("계약금 입금 일자를 선택하세요.");
			form2.cont_in_date7.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_7.value&& !form2.cont_in_who7.value){
			alert("계약금 실제 납부자 명을 입력하세요.");
			form2.cont_in_who7.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& form2.deposit_7.value&& !form2.cont_pay_sche7.value){
			alert("금회 납부 처리 회차를 선택하세요.");
			form2.cont_pay_sche7.focus();
			return;
		}
		if(form1.cont_sort2.value=='2'&& !form2.zipcode.value){
			alert("계약자 주소 항목을 입력하세요.");
			form2.zipcode.focus();
			return;
		}
	}else if(typeof(form1.cont_sort3)!='undefined' && form1.cont_sort3.value=='3'){
		if(form2.is_cancel.checked===false){
			alert("해지 여부를 체크하여 주십시요.");
			form2.is_cancel.focus();
			return;
		}
	}else if(typeof(form1.cont_sort3)!='undefined'  && form1.cont_sort3.value=='4'){
		if(form2.is_cont_cancel.checked===false){
			alert("해지 여부를 체크하여 주십시요.");
			form2.is_cont_cancel.focus();
			return;
		}
	}

	if(form1.cont_sort2){
		if(form1.cont_sort2.value=='1') var cont_sort = "청약(가계약)";
		if(form1.cont_sort2.value=='2') var cont_sort = "계약(정계약)";
	}else if(form1.cont_sort3){
		if(form1.cont_sort3.value=='3') var cont_sort = "청약 해지";
		if(form1.cont_sort3.value=='4') var cont_sort = "계약 해지";
	}
	if(form2.dong && form2.ho){
		var conf_str = '거래 구분 : '+cont_sort+'\n계약 고객 : '+form2.custom_name.value+'\n거래 일자 : '+form2.conclu_date.value+'\n해당 호수 : '+form2.dong.value+'동 '+form2.ho.value+'호\n\n상기 내용을 등록 하시겠습니까?';
		if(confirm(conf_str)===true){
			form2.submit();
		}else{
			return;
		}
	}
}

function cont_sort(no){
	var form = document.form1;
	if(no=='1') form.cont_sort3.options[0].selected =true;
	if(no=='2') form.cont_sort2.options[0].selected =true;
	form.submit();
}

function same_addr(){
	var form = document.form1;
	if(form.sa_addr.checked===true){
		if(form.zipcode_.value||form.address1_.value||form.address2_.value){
			if(confirm('우편송부 주소를 주민등록 주소로 교체하시겠습니까?')===true){
				form.zipcode_.value = form.zipcode.value;
				form.address1_.value = form.address1.value;
				form.address2_.value = form.address2.value;
			}else{
				form.sa_addr.checked = false;
				return;
			}
		}else{
			form.zipcode_.value = form.zipcode.value;
			form.address1_.value = form.address1.value;
			form.address2_.value = form.address2.value;
		}
	}else{
		form.zipcode_.value = '';
		form.address1_.value = '';
		form.address2_.value = '';
	}
}

function frm_view(){
	var form = document.form1;
	if(form.de_2c.checked===true){document.getElementById("de_2").style.display = "block";}else{document.getElementById("de_2").style.display = "none";}
	if(form.de_3c.checked===true){document.getElementById("de_3").style.display = "block";}else{document.getElementById("de_3").style.display = "none";}
	if(form.de_4c.checked===true){document.getElementById("de_4").style.display = "block";}else{document.getElementById("de_4").style.display = "none";}
	if(form.mp_1c.checked===true){document.getElementById("mp_1").style.display = "block";}else{document.getElementById("mp_1").style.display = "none";}
	if(form.mp_2c.checked===true){document.getElementById("mp_2").style.display = "block";}else{document.getElementById("mp_2").style.display = "none";}
	if(form.mp_3c.checked===true){document.getElementById("mp_3").style.display = "block";}else{document.getElementById("mp_3").style.display = "none";}
	if(form.mp_4c.checked===true){document.getElementById("mp_4").style.display = "block";}else{document.getElementById("mp_4").style.display = "none";}
	if(form.mp_5c.checked===true){document.getElementById("mp_5").style.display = "block";}else{document.getElementById("mp_5").style.display = "none";}
	if(form.mp_6c.checked===true){document.getElementById("mp_6").style.display = "block";}else{document.getElementById("mp_6").style.display = "none";}
	if(form.mp_7c.checked===true){document.getElementById("mp_7").style.display = "block";}else{document.getElementById("mp_7").style.display = "none";}
	if(form.lp_c.checked===true){document.getElementById("lp").style.display = "block";}else{document.getElementById("lp").style.display = "none";}
}

function dong_ho_put(){
	var form = document.form1;
	if(form.dongho_put.checked===true){
		document.getElementById("dong").style.display = "block";
		document.getElementById("ho").style.display = "block";
	}else{
		document.getElementById("dong").style.display = "none";
		document.getElementById("ho").style.display = "none";
	}
}
/********************계약등록 종료*******************/

/********************수납등록 시작 ******************/

// 동선택 시 동작 합수
function dong_seq(){
	var form = document.form1;
	if(form.ho.value){
		form.ho.value = "";
	}
	form.submit();
}

// 수납 등록 폼 체크 함수
function receive_chk(){
	var form1 = document.form1;
	var form2 = document.form2;
	if( !form1.project.value) {
		alert("프로젝트를 선택하여 주세요.");
		form1.project.focus();
		return;
	}
	if( !form1.dong.value){
		alert("수납 입력할 동을 선택하여 주세요.");
		form1.dong.focus();
		return;
	}
	if( !form1.ho.value){
		alert("수납 입력할 호를 선택하여 주세요.");
		form1.ho.focus();
		return;
	}
	if( !form2.paid_date.value){
		alert("수납일자를 입력하여 주세요.");
		form2.paid_date.focus();
		return;
	}
	if( !form2.pay_sche_code.value){
		alert("수납회차를 선택하여 주세요.");
		form2.pay_sche_code.focus();
		return;
	}
	if( !form2.paid_amount.value){
		alert("수납금액을 입력하여 주세요.");
		form2.paid_amount.focus();
		return;
	}
	if( !form2.paid_acc.value){
		alert("수납계좌를 선택하여 주세요.");
		form2.paid_acc.focus();
		return;
	}
	if( !form2.paid_who.value){
		alert("입금자명을 선택하여 주세요.");
		form2.paid_who.focus();
		return;
	}
	var msg = ( !form2.modi.value  || form2.modi.value==='0') ? "신규 수납내역을 등록" : "수납 내역을 변경 등록";
	if(confirm(msg+'하시겠습니까?')===true) {
		form2.submit();
	}
}
