/********************상담일지 등록 시작*******************/
function coun_log_sub(mode){
	var form = document.form1;

	if(!form1.cust_name.value){
		alert('고객명을 입력하여 주십시요!');
		form1.cust_name.focus();
		return;
	}
	if(!form1.coun_date.value){
		alert('상담일자를 입력하여 주십시요!');
		form1.coun_date.focus();
		return;
	}
	if(!form1.cust_tel1.value){
		alert('연락처1 항목을 입력하여 주십시요!');
		form1.cust_tel1.focus();
		return;
	}
	if(!form1.coun_route.value){
		alert('상담경로를 선택하여 주십시요!');
		form1.coun_route.focus();
		return;
	}
	if(!form1.content.value){
		alert('상담내용을 입력하여 주십시요!');
		form1.content.focus();
		return;
	}

	if(mode=='reg') var msg = '신규등록';
	if(mode=='modify') var msg = '추가등록';

	if(confirm("상담내용을 "+msg+" 하시겠습니까?")===true){
		form.submit();
	}else{
		return;
	}
}
/********************상담일지 등록 종료*******************/



/********************업무일지 등록 시작*******************/
////////////청약 계약 입력폼 추가 함수///
function cont_add(self,no,frm){
	var add_num= eval(no-2);
	if(frm==1){
		var obj = eval("document.getElementById('cont_"+no+"')");
		var add = eval("document.getElementById('add_"+add_num+"')");
		if(self.checked==1){      //자신을 체크 하였을 경우
			obj.style.display="";  // 다음 디브를 보이게 하고
			if(add_num>0) add.disabled=1;       // 자신보다 바로 전 체크박스를 비활성
		}else{
			obj.style.display="none";
			if(add_num>0) add.disabled=0;
		}
	}
	if(frm==2){
		var obj = eval("document.getElementById('coun_"+no+"')");
		var add = eval("document.getElementById('add_c_"+add_num+"')");
		if(self.checked==1){
			obj.style.display="";
			if(add_num>0) add.disabled=1;
		}else{
			obj.style.display="none";
			if(add_num>0) add.disabled=0;
		}
	}
	if(frm==3){
		var obj = eval("document.getElementById('tomo_"+no+"')");
		var add = eval("document.getElementById('add_t_"+add_num+"')");
		if(self.checked==1){
			obj.style.display="";
			if(add_num>0) add.disabled=1;
		}else{
			obj.style.display="none";
			if(add_num>0) add.disabled=0;
		}
	}
}
/////////// 업무일지 서브밋 함수 ///////////////
function work_log_sub(is_com, str){
	var form=document.form1;
	var date=form.work_date.value;

	if(is_com==1){ // 본사 직원일 경우 해당 프로젝트 및 소속 선택
		if(!document.is_com_sel.pj_list.value){
			alert("프로젝트를 선택하여 주십시요!");
			document.is_com_sel.pj_list.focus();
			return;
		}
		if(!document.is_com_sel.headq.value){
			alert("소속본부를 선택하여 주십시요!");
			document.is_com_sel.headq.focus();
			return;
		}
		if(!document.is_com_sel.team.value){
			alert("소속 팀을 선택하여 주십시요!");
			document.is_com_sel.team.focus();
			return;
		}
	}
	if(!form.work_date.value){
		alert("작성일자를 입력하여 주십시요!");
		form.work_date.focus();
		return;
	}
	if(!form.work_num.value){
		alert("출근인원을 입력하여 주십시요!");
		form.work_num.focus();
		return;
	}

	var co_sort = [form.co_sort_1, form.co_sort_2, form.co_sort_3, form.co_sort_4, form.co_sort_5, form.co_sort_6, form.co_sort_7, form.co_sort_8, form.co_sort_9, form.co_sort_10, form.co_sort_11, form.co_sort_12];
	var c_cust_name = [form.c_cust_name_1, form.c_cust_name_2, form.c_cust_name_3, form.c_cust_name_4, form.c_cust_name_5, form.c_cust_name_6, form.c_cust_name_7, form.c_cust_name_8, form.c_cust_name_9, form.c_cust_name_10, form.c_cust_name_11, form.c_cust_name_12];
	var dong = [form.dong_1, form.dong_2, form.dong_3, form.dong_4, form.dong_5, form.dong_6, form.dong_7, form.dong_8, form.dong_9, form.dong_10, form.dong_11, form.dong_12];
	var ho = [form.ho_1, form.ho_2, form.ho_3, form.ho_4, form.ho_5, form.ho_6, form.ho_7, form.ho_8, form.ho_9, form.ho_10, form.ho_11, form.ho_12];
	var due_date = [form.due_date_1, form.due_date_2, form.due_date_3, form.due_date_4, form.due_date_5, form.due_date_6, form.due_date_7, form.due_date_8, form.due_date_9, form.due_date_10, form.due_date_11, form.due_date_12];
	var c_worker = [form.c_worker_1, form.c_worker_2, form.c_worker_3, form.c_worker_4, form.c_worker_5, form.c_worker_6, form.c_worker_7, form.c_worker_8, form.c_worker_9, form.c_worker_10, form.c_worker_11, form.c_worker_12];

	for(var i=0; i<12; i++){
		if(co_sort[i].value||c_cust_name[i].value||dong[i].value||ho[i].value||due_date[i].value||c_worker[i].value){
			if(!co_sort[i].value){
				alert("해당 구분을 선택하여 주십시요!");
				co_sort[i].focus();
				return;
			}
			if(!c_cust_name[i].value){
				alert("해당 고객명을 입력하여 주십시요!");
				c_cust_name[i].focus();
				return;
			}
			if(!dong[i].value){
				alert("해당 동을 입력하여 주십시요!");
				dong[i].focus();
				return;
			}
			if(!ho[i].value){
				alert("해당 호를 입력하여 주십시요!");
				ho[i].focus();
				return;
			}
			if(co_sort[i].value==1&&!due_date[i].value){
				alert("계약 예정일을 입력하여 주십시요!");
				due_date[i].focus();
				return;
			}
			if(!c_worker[i].value){
				alert("해당 담당자를 입력하여 주십시요!");
				c_worker[i].focus();
				return;
			}
		}
	}

	var d_cust_name = [form.d_cust_name_1, form.d_cust_name_2, form.d_cust_name_3, form.d_cust_name_4, form.d_cust_name_5, form.d_cust_name_6, form.d_cust_name_7, form.d_cust_name_8, form.d_cust_name_9, form.d_cust_name_10, form.d_cust_name_11, form.d_cust_name_12];
	var d_content = [form.d_content_1, form.d_content_2, form.d_content_3, form.d_content_4, form.d_content_5, form.d_content_6, form.d_content_7, form.d_content_8, form.d_content_9, form.d_content_10, form.d_content_11, form.d_content_12];
	var d_worker = [form.d_worker_1, form.d_worker_2, form.d_worker_3, form.d_worker_4, form.d_worker_5, form.d_worker_6, form.d_worker_7, form.d_worker_8, form.d_worker_9, form.d_worker_10, form.d_worker_11, form.d_worker_12];

	for(var i=0; i<12; i++){
		if(d_cust_name[i].value||d_content[i].value||d_worker[i].value){
			if(!d_cust_name[i].value){
				alert("해당 고객명을 선택하여 주십시요!");
				d_cust_name[i].focus();
				return;
			}
			if(!d_content[i].value){
				alert("해당 진행사항을 입력하여 주십시요!");
				d_content[i].focus();
				return;
			}
			if(!d_worker[i].value){
				alert("해당 담당자를 입력하여 주십시요!");
				d_worker[i].focus();
				return;
			}
		}
	}
	if(!form.d_sale_act.value){
		alert("당일 홍보 영업활동을 입력하여 주십시요!");
		form.d_sale_act.focus();
		return;
	}
	var n_cust_name = [form.n_cust_name_1, form.n_cust_name_2, form.n_cust_name_3, form.n_cust_name_4, form.n_cust_name_5, form.n_cust_name_6, form.n_cust_name_7, form.n_cust_name_8, form.n_cust_name_9, form.n_cust_name_10, form.n_cust_name_11, form.n_cust_name_12];
	var n_content = [form.n_content_1, form.n_content_2, form.n_content_3, form.n_content_4, form.n_content_5, form.n_content_6, form.n_content_7, form.n_content_8, form.n_content_9, form.n_content_10, form.n_content_11, form.n_content_12];
	var n_worker = [form.n_worker_1, form.n_worker_2, form.n_worker_3, form.n_worker_4, form.n_worker_5, form.n_worker_6, form.n_worker_7, form.n_worker_8, form.n_worker_9, form.n_worker_10, form.n_worker_11, form.n_worker_12];

	for(var i=0; i<12; i++){
		if(n_cust_name[i].value||n_content[i].value||n_worker[i].value){
			if(!n_cust_name[i].value){
				alert("해당 고객명을 선택하여 주십시요!");
				n_cust_name[i].focus();
				return;
			}
			if(!n_content[i].value){
				alert("해당 진행내용 등을 입력하여 주십시요!");
				n_content[i].focus();
				return;
			}
			if(!n_worker[i].value){
				alert("해당 담당자를 입력하여 주십시요!");
				n_worker[i].focus();
				return;
			}
		}
	}
	if(!form.n_sale_plan.value){
		alert("익일 영업계획을 입력하여 주십시요!");
		form.n_sale_plan.focus();
		return;
	}
	if(confirm("등록 후 작성일자 익일까지만 수정 가능합니다.\n\n["+date+"] 업무일지를 "+str+" 하시겠습니까?")===true) form.submit(); else return;
}
/********************업무일지 등록 종료*******************/





/********************계약등록 시작*******************/
// 청약 수정 화면에서 계약 전환 시 함수
function app_tr_cont(chk){
	var form = document.set1;
	if(chk.checked===true){
		form.cont_sort2.value='2';
		form.submit();
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
	//alert(form2.app_in_mon.value);
	if( !form1.cont_sort3 && form1.cont_sort2==1 && ( !form2.app_in_mon.value || form2.app_in_mon.value==='')){
		alert('청약금을 입력하여 주십시요!');
		form2.app_in_mon.focus();
		return;
	}
	if(!form1.cont_sort3 && form1.cont_sort2==1 &&  form2.app_in_mon.value && !form2.app_in_acc.value){
		alert('청약금 입금 계좌를 선택하여 주십시요!');
		form2.app_in_acc.focus();
		return;
	}
	if(!form1.cont_sort3 && form1.cont_sort2==1 &&  form2.app_in_mon.value && form2.app_in_date.value==='0000-00-00'){
		alert('청약금 입금 일자를 입력하여 주십시요!');
		form2.app_in_date.focus();
		return;
	}
	if(!form1.cont_sort3 && form1.cont_sort2==1 &&  form2.app_in_mon.value && !form2.app_in_who.value){
		alert('청약금 입금자명을 입력하여 주십시요!');
		form2.app_in_who.focus();
		return;
	}
	if(!form1.cont_sort3 && typeof(form2.app_in_mon)!='undefined' && (form2.app_in_mon.value) && !form2.app_pay_sche.value){
		alert('청약금 납부회차를 선택하여 주십시요!');
		form2.app_in_who.focus();
		return;
	}

	if(form1.cont_sort2){
		if(form1.cont_sort2.value=='1') var cont_sort = "청약(가계약)";
		if(form1.cont_sort2.value=='2') var cont_sort = "계약(정계약)";
	}else if(form1.cont_sort3){
		if(form1.cont_sort3.value=='3') var cont_sort = "청약 해지";
		if(form1.cont_sort3.value=='4') var cont_sort = "계약 해지";
	}
	if(form2.dong&&form2.ho){
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
//-->
