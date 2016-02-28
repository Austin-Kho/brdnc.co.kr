<!--
function resc_chk(pj,ref) {
	var form=document.pj_sel;
	if(!pj){
		alert('프로젝트를 선택하여 주십시요!');
		form.pj_list.focus();
		return;
	}
	var window_left = (screen.width-640)/2;
	var window_top = (screen.height-480)/2;
	window.open(ref,name,'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
}

function resc_reg_chk(){
	var frm=document.pj_sel;
	if(!frm.pj_list.value){
		alert('프로젝트를 선택하여 주십시요!');
		frm.pj_list.focus();
		return;
	}
	if(!frm.headq.value){
		alert('소속 본부를 선택하여 주십시요!');
		frm.headq.focus();
		return;
	}
	var form=document.resc_reg;
	if(!form.name_1.value&&!form.name_2.value&&!form.name_3.value&&!form.name_4.value&&!form.name_5.value&&!form.name_6.value&&!form.name_7.value&&!form.name_8.value&&!form.name_9.value&&!form.name_10.value){
		alert('하나 이상의 데이터를 입력하십시요!');
		form.name_1.focus();
		return;
	}
	if(form.name_1.value){
		if(!form.position_1.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_1.focus();
			return;
		}
		if(form.position_1.value!=1&&!form.team_1.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_1.focus();
			return;
		}
		if(!form.tel1_1.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_1.focus();
			return;
		}
		if(!form.tel2_1.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_1.focus();
			return;
		}
		if(!form.tel3_1.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_1.focus();
			return;
		}
	}
	if(form.name_2.value){
		if(!form.position_2.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_2.focus();
			return;
		}
		if(form.position_2.value!=1&&!form.team_2.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_2.focus();
			return;
		}
		if(!form.tel1_2.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_2.focus();
			return;
		}
		if(!form.tel2_2.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_2.focus();
			return;
		}
		if(!form.tel3_2.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_2.focus();
			return;
		}
	}
	if(form.name_3.value){
		if(!form.position_3.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_3.focus();
			return;
		}
		if(form.position_3.value!=1&&!form.team_3.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_3.focus();
			return;
		}
		if(!form.tel1_3.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_3.focus();
			return;
		}
		if(!form.tel2_3.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_3.focus();
			return;
		}
		if(!form.tel3_3.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_3.focus();
			return;
		}
	}
	if(form.name_4.value){
		if(!form.position_4.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_4.focus();
			return;
		}
		if(form.position_4.value!=1&&!form.team_4.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_4.focus();
			return;
		}
		if(!form.tel1_4.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_4.focus();
			return;
		}
		if(!form.tel2_4.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_4.focus();
			return;
		}
		if(!form.tel3_4.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_4.focus();
			return;
		}
	}
	if(form.name_5.value){
		if(!form.position_5.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_5.focus();
			return;
		}
		if(form.position_5.value!=1&&!form.team_5.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_5.focus();
			return;
		}
		if(!form.tel1_5.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_5.focus();
			return;
		}
		if(!form.tel2_5.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_5.focus();
			return;
		}
		if(!form.tel3_5.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_5.focus();
			return;
		}
	}
	if(form.name_6.value){
		if(!form.position_6.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_6.focus();
			return;
		}
		if(form.position_6.value!=1&&!form.team_6.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_6.focus();
			return;
		}
		if(!form.tel1_6.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_6.focus();
			return;
		}
		if(!form.tel2_6.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_6.focus();
			return;
		}
		if(!form.tel3_6.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_6.focus();
			return;
		}
	}
	if(form.name_7.value){
		if(!form.position_7.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_7.focus();
			return;
		}
		if(form.position_7.value!=1&&!form.team_7.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_7.focus();
			return;
		}
		if(!form.tel1_7.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_7.focus();
			return;
		}
		if(!form.tel2_7.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_7.focus();
			return;
		}
		if(!form.tel3_7.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_7.focus();
			return;
		}
	}
	if(form.name_8.value){
		if(!form.position_8.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_8.focus();
			return;
		}
		if(form.position_8.value!=1&&!form.team_8.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_8.focus();
			return;
		}
		if(!form.tel1_8.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_8.focus();
			return;
		}
		if(!form.tel2_8.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_8.focus();
			return;
		}
		if(!form.tel3_8.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_8.focus();
			return;
		}
	}
	if(form.name_9.value){
		if(!form.position_9.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_9.focus();
			return;
		}
		if(form.position_9.value!=1&&!form.team_9.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_9.focus();
			return;
		}
		if(!form.tel1_9.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_9.focus();
			return;
		}
		if(!form.tel2_9.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_9.focus();
			return;
		}
		if(!form.tel3_9.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_9.focus();
			return;
		}
	}
	if(form.name_10.value){
		if(!form.position_10.value){
			alert('해당 직원의 직위를 선택하여 주십시요!');
			form.position_10.focus();
			return;
		}
		if(form.position_10.value!=1&&!form.team_10.value){
			alert('소속 팀을 선택하여 주십시요!');
			form.team_10.focus();
			return;
		}
		if(!form.tel1_10.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel1_10.focus();
			return;
		}
		if(!form.tel2_10.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel2_10.focus();
			return;
		}
		if(!form.tel3_10.value){
			alert('연락처를 입력하여 주십시요!');
			form.tel3_10.focus();
			return;
		}
	}
	if(confirm('현장 인원 정보를 등록하시겠습니까?')==true){
		form.submit();
	}else{
		return;
	}
}
//-->
