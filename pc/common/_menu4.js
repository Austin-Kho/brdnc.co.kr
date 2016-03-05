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
	var s2_sub=confirm('프로젝트 정보를 등록/수정하시겠습니까?');
	if(s2_sub==true){
		form.submit();
	}
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

	if(!form.min_floor_1.value&&!form.min_floor_2.value&&!form.min_floor_3.value&&!form.min_floor_4.value&&!form.min_floor_5.value&&!form.min_floor_6.value){
		alert("하나 이상의 데이터를 입력하십시요!");
		form.min_floor_1.focus();
		return;
	}


	if(form.min_floor_1.value){
		if(!form.type_1.value){alert("타입 정보를 선택하십시요!"); form.type_1.focus(); return;}
		if(!form.dong_1.value){alert("동 정보를 선택하십시요!"); form.dong_1.focus(); return;}
		if(!form.line_1.value){alert("라인 정보를 선택하십시요!"); form.line_1.focus(); return;}
	}
	if(form.min_floor_1.value){	if(!form.max_floor_1.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.max_floor_1.focus(); return;}}
	if(form.max_floor_1.value){	if(!form.min_floor_1.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.min_floor_1.focus(); return;}}

	if(form.min_floor_2.value){
		if(!form.type_2.value){alert("타입 정보를 선택하십시요!"); form.type_2.focus(); return;}
		if(!form.dong_2.value){alert("동 정보를 선택하십시요!"); form.dong_2.focus(); return;}
		if(!form.line_2.value){alert("라인 정보를 선택하십시요!"); form.line_2.focus(); return;}
	}
	if(form.min_floor_2.value){	if(!form.max_floor_2.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.max_floor_2.focus(); return;}}
	if(form.max_floor_2.value){	if(!form.min_floor_2.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.min_floor_2.focus(); return;}}

	if(form.min_floor_3.value){
		if(!form.type_3.value){alert("타입 정보를 선택하십시요!"); form.type_3.focus(); return;}
		if(!form.dong_3.value){alert("동 정보를 선택하십시요!"); form.dong_3.focus(); return;}
		if(!form.line_3.value){alert("라인 정보를 선택하십시요!"); form.line_3.focus(); return;}
	}
	if(form.min_floor_3.value){	if(!form.max_floor_3.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.max_floor_3.focus(); return;}}
	if(form.max_floor_3.value){	if(!form.min_floor_3.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.min_floor_3.focus(); return;}}

	if(form.min_floor_4.value){
		if(!form.type_4.value){alert("타입 정보를 선택하십시요!"); form.type_4.focus(); return;}
		if(!form.dong_4.value){alert("동 정보를 선택하십시요!"); form.dong_4.focus(); return;}
		if(!form.line_4.value){alert("라인 정보를 선택하십시요!"); form.line_4.focus(); return;}
	}
	if(form.min_floor_4.value){	if(!form.max_floor_4.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.max_floor_4.focus(); return;}}
	if(form.max_floor_4.value){	if(!form.min_floor_4.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.min_floor_4.focus(); return;}}

	if(form.min_floor_5.value){
		if(!form.type_5.value){alert("타입 정보를 선택하십시요!"); form.type_5.focus(); return;}
		if(!form.dong_5.value){alert("동 정보를 선택하십시요!"); form.dong_5.focus(); return;}
		if(!form.line_5.value){alert("라인 정보를 선택하십시요!"); form.line_5.focus(); return;}
	}
	if(form.min_floor_5.value){	if(!form.max_floor_5.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.max_floor_5.focus(); return;}}
	if(form.max_floor_5.value){	if(!form.min_floor_5.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.min_floor_5.focus(); return;}}

	if(form.min_floor_6.value){
		if(!form.type_6.value){alert("타입 정보를 선택하십시요!"); form.type_6.focus(); return;}
		if(!form.dong_6.value){alert("동 정보를 선택하십시요!"); form.dong_6.focus(); return;}
		if(!form.line_6.value){alert("라인 정보를 선택하십시요!"); form.line_6.focus(); return;}
	}
	if(form.min_floor_6.value){	if(!form.max_floor_6.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.max_floor_6.focus(); return;}}
	if(form.max_floor_6.value){	if(!form.min_floor_6.value){ alert("입력할 층의 범위를 지정 하십시요!"); form.min_floor_6.focus(); return;}}
	form.submit();
}



function dong_reg_bc(self){
	var form=document.form1;

	if(self.checked==true){

		if(!form.dong_1.value){
		alert("동을 입력하십시요!");
		self.checked=false;
		form.dong_1.focus();
		return;
		}
		form.dong_2.value=form.dong_1.value;
		form.dong_3.value=form.dong_1.value;
		form.dong_4.value=form.dong_1.value;
		form.dong_5.value=form.dong_1.value;
		form.dong_6.value=form.dong_1.value;
	}else{
		form.dong_2.value=null;
		form.dong_3.value=null;
		form.dong_4.value=null;
		form.dong_5.value=null;
		form.dong_6.value=null;
	}
}