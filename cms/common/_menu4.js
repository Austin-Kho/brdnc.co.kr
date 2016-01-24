///// 계약정보 등록 시/////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

function data_move(mode,seq){
	if(mode=="re_reg") var word="재등록 처리";
	if(mode=="end") var word="등록마감 처리";
	if(confirm(word+" 하시겠습니까?")==true){
		location.href='progress_post.php?mode='+mode+'&seq='+seq;
	}else{
		return;
	}
}

/////////타입 등록 체크박스 추가 함수
function type_reg(frm,val, no, n){  // 체크박스 // 넘버  id="type_10"
	if(frm=='1'){
		var str1="type1_";
		var str2="ck1_";
	}
	if(frm=='2'){
		var str1="type2_";
		var str2="ck2_";
	}
	if(frm=='3'){
		var str1="floor_";
		var str2="fc_";
	}
	var np=parseInt(no)+1;
	var nm=parseInt(no)-1;
	var type_n=str1+np;
	var ck_n=str2+nm;

	var type=document.getElementById(type_n);
	var ckbox=document.getElementById(ck_n);

	if(val.checked==true){
		type.style.display="";
		if(!n)ckbox.disabled=true;
	}else{
		type.style.display="none";
		if(!n)ckbox.disabled=false;
	}
}
function pj_data_reg(frm,val, no){  // 체크박스 // 넘버  id="type_10"
	if(frm=='1'){
		var str1="type1_";
		var str2="ck1_";
	}
	if(frm=='2'){
		var str1="type2_";
		var str2="ck2_";
	}
	var np=parseInt(no)+1;
	var nm=parseInt(no)-1;
	var type_n=str1+np;
	var ck_n=str2+nm;

	var type=document.getElementById(type_n);
	var ckbox=document.getElementById(ck_n);

	if(val.checked==true){
		type.style.display="";
		ckbox.style.display="none";
	}else{
		type.style.display="none";
		ckbox.style.display="";
	}
}

function con_formck(){
	var form=document.form1;

	if(!form.pj_name.value){
		alert("프로젝트 명을 입력하여 주세요!");
		form.pj_name.focus();
		return;
	}
	if(!form.sort.value){
		alert('프로젝트 종류를 선택하여 주세요!');
		form.sort.focus();
		return;
	}

	if(!form.address1.value){
		alert('현장 주소를 입력하여 주세요!');
		form.zipcode1.focus();
		return;
	}
	if(!form.type_1.value){
		alert('최소한 하나 이상의 타입정보를 입력하여야 합니다!');
		form.type_1.focus();
		return;
	}
	//////////////////////////////////////////////////
	if(form.type_1.value){
		if(!form.total_count_1.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_1.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_2.value){
		if(!form.total_count_2.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_2.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_3.value){
		if(!form.total_count_3.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_3.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_4.value){
		if(!form.total_count_4.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_4.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_5.value){
		if(!form.total_count_5.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_5.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_6.value){
		if(!form.total_count_6.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_6.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_7.value){
		if(!form.total_count_7.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_7.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_8.value){
		if(!form.total_count_8.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_8.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_9.value){
		if(!form.total_count_9.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_9.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(form.type_10.value){
		if(!form.total_count_10.value){
			alert('해당 TYPE 의 전체물량 정보를 입력하여 주세요');
			form.total_count_10.focus();
			return;
		}
	}
	//////////////////////////////////////////////////
	if(!form.start_date.value){
		alert('수행 개시일을 입력하여 주세요!');
		form.start_date.focus();
		return;
	}
	form.submit();
}

function select_ch(obj){
	var form=document.pj_data_reg;
	if(obj=='reg') {form.reg_pj.value="";}
	if(obj=='modify') {form.new_pj.value="";}
	form.mode.value=obj;
	form.submit();
}

function reg_end(){
	if(confirm("해당 프로젝트의 데이터 등록을 마감하시겠습니까?\n\n마감 후에는 데이터 수정만 가능합니다.")==true){ // 확인 시
		location.href="progress_post.php?mode=end&is_data_reg=1"; // 해당 프로젝트 seq 정보 확인하여 붙여줄 것 -> &seq=seq
	}else{ // 취소 시
		return;
	}
}

// 동호수 데이터로 입력 시
function pj_data_put_0(){
	var form=document.form1;

	if(!document.pj_data_reg.new_pj.value){
		alert("등록할 프로젝트를 선택하여 주십시요!");
		document.pj_data_reg.new_pj.focus();
		return;
	}

	if(!form.floor_1.value&&!form.floor_2.value&&!form.floor_3.value&&!form.floor_4.value&&!form.floor_5.value&&!form.floor_6.value&&!form.floor_7.value&&!form.floor_8.value&&!form.min_floor.value){
		alert("하나 이상의 데이터를 입력하십시요!");
		form.floor_1.focus();
		return;
	}
	if(!form.dong.value){
		alert("동 데이터를 입력하십시요!");
		form.dong.focus();
		return;
	}
	if(!form.line.value){
		alert("라인 데이터를 입력하십시요!");
		form.line.focus();
		return;
	}
	if(form.floor_1.value){
		if(!form.type_1.value){
			alert("타입 정보를 선택하십시요!");
			form.type_1.focus();
			return;
		}
		if(!form.price_1.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_1.focus();
			return;
		}

		// if(!form.pay_1.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_1.focus();
		// 	return;
		// }
	}
	if(form.floor_2.value){
		if(!form.type_2.value){
			alert("타입 정보를 선택하십시요!");
			form.type_2.focus();
			return;
		}
		if(!form.price_2.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_2.focus();
			return;
		}
		// if(!form.pay_2.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_2.focus();
		// 	return;
		// }
	}
	if(form.floor_3.value){
		if(!form.type_3.value){
			alert("타입 정보를 선택하십시요!");
			form.type_3.focus();
			return;
		}
		if(!form.price_3.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_3.focus();
			return;
		}
		// if(!form.pay_3.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_3.focus();
		// 	return;
		// }
	}
	if(form.floor_4.value){
		if(!form.type_4.value){
			alert("타입 정보를 선택하십시요!");
			form.type_4.focus();
			return;
		}
		if(!form.price_4.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_4.focus();
			return;
		}
		// if(!form.pay_4.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_4.focus();
		// 	return;
		// }
	}
	if(form.floor_5.value){
		if(!form.type_5.value){
			alert("타입 정보를 선택하십시요!");
			form.type_5.focus();
			return;
		}
		if(!form.price_5.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_5.focus();
			return;
		}
		// if(!form.pay_5.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_5.focus();
		// 	return;
		// }
	}
	if(form.floor_6.value){
		if(!form.type_6.value){
			alert("타입 정보를 선택하십시요!");
			form.type_6.focus();
			return;
		}
		if(!form.price_6.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_6.focus();
			return;
		}
		// if(!form.pay_6.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_6.focus();
		// 	return;
		// }
	}
	if(form.floor_7.value){
		if(!form.type_7.value){
			alert("타입 정보를 선택하십시요!");
			form.type_7.focus();
			return;
		}
		if(!form.price_7.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_7.focus();
			return;
		}
		// if(!form.pay_7.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_7.focus();
		// 	return;
		// }
	}
	if(form.floor_8.value){
		if(!form.type_8.value){
			alert("타입 정보를 선택하십시요!");
			form.type_8.focus();
			return;
		}
		if(!form.price_8.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_8.focus();
			return;
		}
		// if(!form.pay_8.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_8.focus();
		// 	return;
		// }
	}
	if(form.min_floor.value){
		if(!form.type_batch.value){
			alert("타입 정보를 선택하십시요!");
			form.type_batch.focus();
			return;
		}
		if(!form.price_batch.value){
			alert("해당 층의 공급가격을 입력하십시요!");
			form.price_batch.focus();
			return;
		}
		// if(!form.pay_batch.value){
		// 	alert("해당 호수의 수수료를 입력하십시요!");
		// 	form.pay_batch.focus();
		// 	return;
		// }
	}
	if(form.min_floor.value){
		if(!form.max_floor.value){
			alert("입력할 층의 범위를 지정 하십시요!");
			form.max_floor.focus();
			return;
		}
	}
	if(form.max_floor.value){
		if(!form.min_floor.value){
			alert("입력할 층의 범위를 지정 하십시요!");
			form.min_floor.focus();
			return;
		}
	}
	form.submit();
}

// 계약관리번호로 입력 시
function pj_data_put_1(){
	var form=document.form1;

	if(!document.pj_data_reg.new_pj.value){
		alert("등록할 프로젝트를 선택하여 주십시요!");
		document.pj_data_reg.new_pj.focus();
		return;
	}
	if(!form.min_con_no.value&&!form.max_con_no.value){
		alert("하나 이상의 데이터를 입력하십시요!");
		form.min_con_no.focus();
		return;
	}
	if(form.min_con_no.value>form.max_con_no.value){
		alert("입력한 범위의 숫자를 확인하여 주십시요!");
		form.max_con_no.focus();
		return;
	}
	if(form.min_con_no.value){
		if(!form.max_con_no.value){
			alert("입력할 계약관리번호의 범위를 지정 하십시요!");
			form.max_con_no.focus();
			return;
		}

		if(!form.sort_batch.value){
			alert("공급방식을 선택하십시요!");
			form.sort_batch.focus();
			return;
		}
		if(!form.diff_no.value){
			alert("차수 정보를 입력하십시요!");
			form.diff_no.focus();
			return;
		}
		if(!form.type_batch.value){
			alert("타입 정보를 선택하십시요!");
			form.type_batch.focus();
			return;
		}
		if(!form.price_batch.value){
			alert("해당 호수의 공급가격을 입력하십시요!");
			form.price_batch.focus();
			return;
		}
		if(!form.pay_batch.value){
			alert("해당 호수의 수수료를 입력하십시요!");
			form.pay_batch.focus();
			return;
		}
	}
	if(form.max_con_no.value){
		if(!form.min_con_no.value){
			alert("입력할 계약관리번호의 범위를 지정 하십시요!");
			form.min_con_no.focus();
			return;
		}
	}
	if(confirm("계약관리번호 "+form.min_con_no.value+ "-" +form.max_con_no.value+"\n총"+(form.max_con_no.value-form.min_con_no.value+1)+"개의 데이터를 입력하시겠습니까?")){
		form.submit();
	}else{
		return false;
	}
}

function pay_reg_bc(self){
	var form=document.form1;

	if(self.checked==true){

		if(!form.pay_1.value){
		alert("수수료를 입력하십시요!");
		self.checked=false;
		form.pay_1.focus();
		return;
		}
		form.pay_2.value=form.pay_1.value;
		form.pay_3.value=form.pay_1.value;
		form.pay_4.value=form.pay_1.value;
		form.pay_5.value=form.pay_1.value;
		form.pay_6.value=form.pay_1.value;
		form.pay_7.value=form.pay_1.value;
		form.pay_8.value=form.pay_1.value;
		form.pay_batch.value=form.pay_1.value;
	}
}
