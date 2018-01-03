function form1_seq_del(seq) {
	var form = document.form1;
	form.mode.value='del';
	form.seq.value=seq;
	if(confirm("해당 데이터가 삭제됩니다. 계속 진행하시겠습니까?")===true) {
		form.submit();
	}else{
		return;
	}
}


/**************  (환경설정 > 기본정보 관리 > 부서정보 관리) S ****************/
function div_submit(mode){
	var form = document.form1;

	if(!form.div_code.value){
		alert('부서코드를 입력 하여 주십시요!');
		form.div_code.focus();
		return;
	}
	if(!form.div_name.value){
		alert('부서명을 입력 하여 주십시요!');
		form.div_name.focus();
		return;
	}
	if(!form.res_work.value){
		alert('담당업무를 입력 하여 주십시요!');
		form.res_work.focus();
		return;
	}
	if(mode=='reg') var msg = '신규등록';
	if(mode=='modify') var msg = '변경등록';

	if(confirm("부서 정보를 "+msg+" 하시겠습니까?")===true){
		form.submit();
	}else{
		return;
	}
}
/**************  (환경설정 > 기본정보 관리 > 부서정보 관리) E ****************/


/**************  (환경설정 > 기본정보 관리 > 직원정보 관리) S ****************/
//////////직원 정보 등록 시 /////////
function div_mem_submit(mode){
	var form = document.form1;

	if(!form.mem_name.value){
		alert('(임)직원명을 입력 하여 주십시요!');
		form.mem_name.focus();
		return;
	}
	if(!form.div_name.value){
		alert('담당부서를 선택 하여 주십시요!');
		form.div_name.focus();
		return;
	}
	if(!form.div_posi.value){
		alert('직급(책)을 입력 하여 주십시요!');
		form.div_posi.focus();
		return;
	}
	if(!form.mobile.value){
		alert('비상전화(Mobile)를 입력 하여 주십시요!');
		form.mobile.focus();
		return;
	}
	if(!form.email.value){
		alert('이메일(Email)을 입력 하여 주십시요!');
		form.email.focus();
		return;
	}
	if(mode=='reg') var msg = '신규등록';
	if(mode=='modify') var msg = '변경등록';
	if(mode=='del') var msg = '삭제';

	if(confirm("직원 정보를 "+msg+" 하시겠습니까?")===true){
		form.submit();
	}else{
		return;
	}
}
/**************  (환경설정 > 기본정보 관리 > 직원정보 관리) E ****************/


/**************  (환경설정 > 기본정보 관리 > 거래처정보 관리) S ****************/
//////////////////////////////거래처 정보 입력 수정 시 !
function acc_submit(mode){
	var form = document.form1;

	if(!form.si_name.value){
		alert('상호(회사명)을 입력 하여 주십시요!');
		form.si_name.focus();
		return;
	}
	if(!form.acc_cla.value){
		alert('거래처 구분을 선택 하여 주십시요!');
		form.acc_cla.focus();
		return;
	}
	if(!form.main_tel.value){
		alert('대표전화를 입력 하여 주십시요!');
		form.main_tel.focus();
		return;
	}
	if(mode=='reg') var msg = '신규등록';
	if(mode=='modify') var msg = '변경등록';

	if(confirm("거래처 정보를 "+msg+" 하시겠습니까?")===true){
		form.submit();
	}else{
		return;
	}
}
/**************  (환경설정 > 기본정보 관리 > 거래처정보 관리) E ****************/


/**************  (환경설정 > 기본정보 관리 > 은행계좌 관리) S ****************/
//////////////////////////////은행계좌 정보 입력 수정 시 !
function bank_submit(mode){
		var form = document.form1;

		if(!form.bank.value){
			alert('거래은행을 선택하세요!');
			form.bank.focus();
			return;
		}
		if(!form.name.value){
			alert('계좌명(별칭)을 입력하세요!');
			form.name.focus();
			return;
		}
		if(!form.number.value){
			alert('계좌번호를 입력하세요!');
			form.number.focus();
			return;
		}
		if(!form.holder.value){
			alert('예금주를 입력하세요!');
			form.holder.focus();
			return;
		}
		// if(form.is_com[0].checked===0&&form.is_com[1].checked===0){
		// 	alert('관리 구분 항목을 선택하세요!');
		// 	form.is_com.focus();
		// 	return;
		// }
		// if(form.is_com[0].checked==1){
		// 	if(!form.div_seq.value){
		// 		alert('관리부서를 선택하세요!');
		// 		form.div_seq.focus();
		// 		return;
		// 	}
		// }
		// if(form.is_com[1].checked==1){
		// 	if(!form.pj_seq.value){
		// 		alert('관리현장을 선택하세요!');
		// 		form.pj_seq.focus();
		// 		return;
		// 	}
		// }
		if( !form.open_date.value){
			alert('계좌 개설일을 입력하세요!');
			form.open_date.focus();
			return;
		}

		if(mode=='reg') var msg = '신규등록';
		if(mode=='modify') var msg = '변경등록';

		var all_msg = '은행계좌 정보를 '+msg+' 하시겠습니까?';
		var a = confirm(all_msg);
		if(a===true){
			form.submit();
		} else {
			return;
		}
	}
/**************  (환경설정 > 기본정보 관리 > 은행계좌 관리) E ****************/





/**************  (환경설정 > 회사정보 관리 > 회사 기본정보) S ****************/
///// 회사 정보 등록 시/////////////////////////////////////////////////////////////////////

function com_submit(mode){

	var form = document.form1;

	if(!form.co_name.value){
		alert('회사명을 입력하세요!');
		form.co_name.focus();
		return;
	}

	if(!form.co_no1.value){
		alert('사업자등록번호를 입력하세요!');
		form.co_no1.focus();
		return;
	}

	if(form.co_no1.value) {
		if(!IsNumber(form.co_no1.value)||form.co_no1.value.length<3){
			alert("첫 번째 사업자등록번호는 세자리 숫자이어야 합니다!");
			form.co_no1.value="";
			form.co_no1.focus();
			return;
		}
	}

	if(!form.co_no2.value){
		alert('사업자등록번호를 입력하세요!');
		form.co_no2.focus();
		return;
	}

	if(form.co_no2.value) {
		if(!IsNumber(form.co_no2.value)||form.co_no2.value.length<2){
			alert("두 번째 사업자등록번호는 두자리 숫자이어야 합니다!");
			form.co_no2.value="";
			form.co_no2.focus();
			return;
		}
	}

	if(!form.co_no3.value){
		alert('사업자등록번호를 입력하세요!');
		form.co_no3.focus();
		return;
	}

	if(form.co_no3.value) {
		if(!IsNumber(form.co_no3.value)||form.co_no3.value.length<5){
			alert("세 번째 사업자등록번호는 다섯자리 숫자이어야 합니다!");
			form.co_no3.value="";
			form.co_no3.focus();
			return;
		}
	}

	if(!form.co_form.value){
		alert('사업자 구분을 선택하세요!');
		form.co_form.focus();
		return;
	}

	if(!form.ceo.value){
		alert('대표자명을 입력하세요!');
		form.ceo.focus();
		return;
	}

	if(!form.or_no1.value){
		alert('법인(주민)등록번호를 입력하세요!');
		form.or_no1.focus();
		return;
	}

	if(form.or_no1.value) {
		if(!IsNumber(form.or_no1.value)||form.or_no1.value.length<6){
			alert("첫 번째 법인(주민)등록번호는 6자리 숫자이어야 합니다!");
			form.or_no1.value="";
			form.or_no1.focus();
			return;
		}
	}

	if(!form.or_no2.value){
		alert('법인(주민)등록번호를 입력하세요!');
		form.or_no2.focus();
		return;
	}

	if(form.or_no2.value) {
		if(!IsNumber(form.or_no2.value)||form.or_no2.value.length<7){
			alert("두 번째 법인(주민)등록번호는 7자리 숫자이어야 합니다!");
			form.or_no2.value="";
			form.or_no2.focus();
			return;
		}
	}

	if(!form.sur.value){
		alert('부가세 신고유형을 선택하세요!');
		form.sur.focus();
		return;
	}

	if(!form.biz_cond.value){
		alert('업태를 입력하세요!');
		form.biz_cond.focus();
		return;
	}

	if(!form.biz_even.value){
		alert('종목을 입력하세요!');
		form.biz_even.focus();
		return;
	}

	if(!form.co_phone1.value){
		alert('대표전화번호를 입력하세요!');
		form.co_phone1.focus();
		return;
	}

	if(form.co_phone1.value) {
		if(!IsNumber(form.co_phone1.value)){
			alert("전화번호는 숫자이어야 합니다!");
			form.co_phone1.value="";
			form.co_phone1.focus();
			return;
		}
	}

	if(!form.co_phone2.value){
		alert('대표전화번로를 입력하세요!');
		form.co_phone2.focus();
		return;
	}

	if(form.co_phone2.value) {
		if(!IsNumber(form.co_phone2.value)){
			alert("전화번호는 숫자이어야 합니다!");
			form.co_phone2.value="";
			form.co_phone2.focus();
			return;
		}
	}

	if(!form.co_phone3.value){
		alert('대표전화번로를 입력하세요!');
		form.co_phone3.focus();
		return;
	}

	if(form.co_phone3.value) {
		if(!IsNumber(form.co_phone3.value)){
			alert("전화번호는 숫자이어야 합니다!");
			form.co_phone3.value="";
			form.co_phone3.focus();
			return;
		}
	}

	if(!form.co_hp1.value){
		alert('휴대전화(비상)번호를 입력하세요!');
		form.co_hp1.focus();
		return;
	}

	if(!form.co_hp2.value){
		alert('휴대전화(비상)번호를 입력하세요!');
		form.co_hp2.focus();
		return;
	}

	if(form.co_hp2.value) {
		if(!IsNumber(form.co_hp2.value)){
			alert("전화번호는 숫자이어야 합니다!");
			form.co_hp2.value="";
			form.co_hp2.focus();
			return;
		}
	}

	if(!form.co_hp3.value){
		alert('휴대전화(비상)번호를 입력하세요!');
		form.co_hp3.focus();
		return;
	}

	if(form.co_hp3.value) {
		if(!IsNumber(form.co_hp3.value)){
			alert("전화번호는 숫자이어야 합니다!");
			form.co_hp3.value="";
			form.co_hp3.focus();
			return;
		}
	}

	if(!form.es_date.value){
		alert('설립일자를 입력하세요!');
		form.es_day.focus();
		return;
	}

	if(!form.op_date.value){
		alert('개업일자를 입력하세요!');
		form.op_day.focus();
		return;
	}

	if(!form.carr_y.value){
		alert('기초잔액 입력년월을 입력하세요!');
		form.carr_y.focus();
		return;
	}

	if(form.carr_y.value) {
		if(!IsNumber(form.carr_y.value)||form.carr_y.value.length<4){
			alert("년도는 네자리 숫자이어야 합니다!");
			form.carr_y.value="";
			form.carr_y.focus();
			return;
		}
	}

	if(!form.carr_m.value){
		alert('기초잔액 입력년월을 입력하세요!');
		form.carr_m.focus();
		return;
	}

	if(form.carr_m.value) {
		if(!IsNumber(form.carr_m.value)){
			alert("기초잔액 입력월을 숫자로 입력하세요!");
			form.carr_m.value="";
			form.carr_m.focus();
			return;
		}
	}

	if(!form.m_wo_st.value){
		alert('업무개시월을 입력하세요!');
		form.m_wo_st.focus();
		return;
	} else if(!form.bl_cycle.value){
		alert('결산주기를 입력하세요!');
		form.bl_cycle.focus();
		return;
	}

	if(!form.email1.value){
		alert('이메일(비상)주소를 입력하세요!');
		form.email1.focus();
		return;
	}

	if(!form.email2.value){
		alert('이메일(비상)주소를 입력하세요!');
		form.email2.focus();
		return;
	}

	if(!form.tax_off1_code.value){
		alert('관할세무서를 입력하세요!');
		form.tax_off1_code.focus();
		return;
	}

	if(!form.postcode1.value){
		alert('회사주소를 입력하세요!');
		form.postcode1.focus();
		return;
	}

	if(mode=='com_reg') var msg = '신규등록';
	if(mode=='com_modify') var msg = '변경등록';

	var a = confirm('회사정보를 '+msg+' 하시겠습니까?');
		if(a===true){
			form.submit();
		} else {
			return;
	}
}
/**************  (환경설정 > 회사정보 관리 > 회사 기본정보) E ****************/


/**************  (환경설정 > 회사정보 관리 > 사용자 권한관리) S ****************/
/////사용자 등록 승인 거부 함수 ///////////
		function permition(no, sf){

			var form=document.form2;
			form.no.value = no;

			if(sf=="승인") {form.sf.value ="1";}
			if(sf=="거부") {form.sf.value ="0";}
      //
			// if(confirm("사용자 등록을 "+sf+"하시겠습니까?") === true){
			// 	form.submit();
			// }else{
			// 	return;
			// }
		}

		/////////////사용자 권한 설정 체크박스 컨트롤 ///////////////
		// function auth_chk(this, box_name){
		// 	var form=document.form3;
		// 	if(!this.checked==true){
		// 		form.box_name.checked=='';
		// 	}
		// }

		/////////////사용자 권한 설정 전송 함수 ///////////////
		function auth_submit(un){
			var form=document.form3;
			if( !un || un===0){
				window.alert("권한을 설정할 직원을 선택하여 주십시요!");
				document.getElementById('user_sel').focus();
				return;
			}
			if(form.user_no.checked !==true){
				window.alert("권한을 설정할 직원을 체크하여 주십시요!");
				form.user_no.focus();
				return;
			}
			if(confirm("사용자 솔루션 이용 권한을 등록(변경) 하시겠습니까?")===true){
				form.submit();
			}else{
				return;
			}
		}
	/**************  (환경설정 > 회사정보 관리 > 사용자 권한관리) E ****************/
