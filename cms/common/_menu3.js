// 구분목록상자 선택1 (capital2.php)
function inoutSel_bu(form, no){

	alert(form.class1.value);


	var inc_account = document.getElementById('inc_account');
	var out_account = document.getElementById('out_account');


	if(form.class1.value==1){
		form.class2.length=4;
		form.class2.options[0].text = '수 익';
		form.class2.options[0].value = '1';
		form.class2.options[1].text = '차 입';
		form.class2.options[1].value = '2';
		form.class2.options[2].text = '회 수';
		form.class2.options[2].value = '3';
		form.class2.options[3].text = '출 자';
		form.class2.options[3].value = '4';

		//inc_account.style.display='';
		//out_account.style.display='none';
		//inc_account.disabled=0;
		//out_account.disabled=1;

	}else if(form.class1.value==2){
		form.class2.length=4;
		form.class2.options[0].text = '비 용'
		form.class2.options[0].value = '5';
		form.class2.options[1].text = '상 환';
		form.class2.options[1].value = '6';
		form.class2.options[2].text = '대 여';
		form.class2.options[2].value = '7';
		form.class2.options[3].text = '배 당';
		form.class2.options[3].value = '8';

		// inc_account.style.display='none';
		// out_account.style.display='';
		// inc_account.disabled=1;
		// out_account.disabled=0;

	}else if(form.class1.value==3){
		form.class2.length=2;
		form.class2.options[0].text = '본 사'
		form.class2.options[0].value = '7';
		form.class2.options[1].text = '현 장'
		form.class2.options[1].value = '8';

		// inc_account.style.display='';
		// out_account.style.display='none';
		// inc_account.disabled=1;
		// out_account.disabled=1;

	}else{
		form.class2.length=11;
		form.class2.options[0].text = '선 택';
		form.class2.options[0].value = '';
		form.class2.options[1].text = '수 익';
		form.class2.options[1].value = '1';
		form.class2.options[2].text = '차 입';
		form.class2.options[2].value = '2';
		form.class2.options[3].text = '회 수';
		form.class2.options[3].value = '3';
		form.class2.options[4].text = '출 자';
		form.class2.options[4].value = '4';
		form.class2.options[5].text = '비 용';
		form.class2.options[5].value = '5';
		form.class2.options[6].text = '상 환';
		form.class2.options[6].value = '6';
		form.class2.options[7].text = '대 여';
		form.class2.options[7].value = '7';
		form.class2.options[8].text = '배 당';
		form.class2.options[8].value = '8';
		form.class2.options[9].text = '본 사';
		form.class2.options[9].value = '9';
		form.class2.options[10].text = '현 장';
		form.class2.options[10].value = '10';

		// inc_account.style.display='';
		// out_account.style.display='none';
		// inc_account.disabled=1;
		// out_account.disabled=1;
	}
}


// 구분목록상자 선택1 (capital2.php)
function inoutSel_(form){

	alert(form.class1.value);

	if(form.class1.value==1){
		form.class2.length=4;
		form.class2.options[0].text = '수 익';
		form.class2.options[0].value = '1';
		form.class2.options[1].text = '차 입';
		form.class2.options[1].value = '2';
		form.class2.options[2].text = '회 수';
		form.class2.options[2].value = '3';
		form.class2.options[3].text = '출 자';
		form.class2.options[3].value = '4';

	}else if(form.class1.value==2){
		form.class2.length=4;
		form.class2.options[0].text = '비 용'
		form.class2.options[0].value = '5';
		form.class2.options[1].text = '상 환';
		form.class2.options[1].value = '6';
		form.class2.options[2].text = '대 여';
		form.class2.options[2].value = '7';
		form.class2.options[3].text = '배 당';
		form.class2.options[3].value = '8';

	}else if(form.class1.value==3){
		form.class2.length=2;
		form.class2.options[0].text = '본 사'
		form.class2.options[0].value = '7';
		form.class2.options[1].text = '현 장'
		form.class2.options[1].value = '8';

	}else{
		form.class2.length=11;
		form.class2.options[0].text = '선 택';
		form.class2.options[0].value = '';
		form.class2.options[1].text = '수 익';
		form.class2.options[1].value = '1';
		form.class2.options[2].text = '차 입';
		form.class2.options[2].value = '2';
		form.class2.options[3].text = '회 수';
		form.class2.options[3].value = '3';
		form.class2.options[4].text = '출 자';
		form.class2.options[4].value = '4';
		form.class2.options[5].text = '비 용';
		form.class2.options[5].value = '5';
		form.class2.options[6].text = '상 환';
		form.class2.options[6].value = '6';
		form.class2.options[7].text = '대 여';
		form.class2.options[7].value = '7';
		form.class2.options[8].text = '배 당';
		form.class2.options[8].value = '8';
		form.class2.options[9].text = '본 사';
		form.class2.options[9].value = '9';
		form.class2.options[10].text = '현 장';
		form.class2.options[10].value = '10';
	}
}
// 구분목록 상자선택2 (capital2.php)
function inoutSel2_(form){
	var inc_account = document.getElementById('inc_account');
	var out_account = document.getElementById('out_account');

	if(form.class2.value==0) {form.class1.options[0].selected=1;}
	if(form.class2.value>0&&form.class2.value<=4) {form.class1.options[1].selected=1;}
	if(form.class2.value>4&&form.class2.value<=8) {form.class1.options[2].selected=1;}
	if(form.class2.value>8){form.class1.options[3].selected=1;}
	if(form.class2.value==1) {
		inc_account.style.display='';
		out_account.style.display='none';
		inc_account.disabled=0;
		out_account.disabled=1;
	}else if(form.class2.value==5) {
		inc_account.style.display='none';
		out_account.style.display='';
		inc_account.disabled=1;
		out_account.disabled=0;
	}else{
		inc_account.style.display='';
		out_account.style.display='none';
		inc_account.disabled=1;
		out_account.disabled=1;
	}
}

// 구분 목록상자 선택1 (capital3.php)
function inoutSel(no, pj){
	var class1_str = "class1_"; // 구분1
	var class1 = class1_str+no;
	var class2_str = "class2_"; // 구분2
	var class2 = class2_str+no;

	var d1_1_str = "d1_1_";   // 자산계정 td
	var d1_1 = d1_1_str+no;
	var d1_2_str = "d1_2_";   // 부채계정 td
	var d1_2 = d1_2_str+no;
	var d1_3_str = "d1_3_";   // 자본계정 td
	var d1_3 = d1_3_str+no;
	var d1_4_str = "d1_4_";   // 수익계정 td
	var d1_4 = d1_4_str+no;
	var d1_5_str = "d1_5_";   // 비용계정 td
	var d1_5 = d1_5_str+no;

	var d1_acc1_str = "d1_acc1_";   // 자산 계정과목
	var d1_acc1 = d1_acc1_str+no;
	var d1_acc2_str = "d1_acc2_";   // 부채 계정과목
	var d1_acc2 = d1_acc2_str+no;
	var d1_acc3_str = "d1_acc3_";   // 자본 계정과목
	var d1_acc3 = d1_acc3_str+no;
	var d1_acc4_str = "d1_acc4_";   // 수익 계정과목
	var d1_acc4 = d1_acc4_str+no;
	var d1_acc5_str = "d1_acc5_";   // 비용 계정과목
	var d1_acc5 = d1_acc5_str+no;

	var in_str = "in_"; // 입금처
	var iin = in_str+no;
	var inc_str = "inc_"; // 입금액
	var inc = inc_str+no;
	var out_str = "out_"; // 출금처
	var out = out_str+no;
	var exp_str = "exp_"; // 출금액
	var exp = exp_str+no;

	var class1_id = document.getElementById(class1);
	var class2_id = document.getElementById(class2);

	var d1_1_id = document.getElementById(d1_1);
	var d1_2_id = document.getElementById(d1_2);
	var d1_3_id = document.getElementById(d1_3);
	var d1_4_id = document.getElementById(d1_4);
	var d1_5_id = document.getElementById(d1_5);

	var d1_acc1_id = document.getElementById(d1_acc1);
	var d1_acc2_id = document.getElementById(d1_acc2);
	var d1_acc3_id = document.getElementById(d1_acc3);
	var d1_acc4_id = document.getElementById(d1_acc4);
	var d1_acc5_id = document.getElementById(d1_acc5);

	var in_id = document.getElementById(iin);
	var inc_id = document.getElementById(inc);
	var out_id = document.getElementById(out);
	var exp_id = document.getElementById(exp);

	if(class1_id.value==1){   //1번째 셀렉트바 입금이면
		class2_id.length=4;    //2번째 셀렉트바 목록 4개
		class2_id.options[0].text = '수 익';//2-1번째 셀렉트바 텍스트 정의
		class2_id.options[0].value = '1';//2-1번째 셀렉트바 값 정의
		class2_id.options[0].selected =1; // 수익을 선택하고 ///////
		class2_id.options[1].text = '차 입';//2-2번째 셀렉트바 텍스트 정의
		class2_id.options[1].value = '2';//2-2번째 셀렉트바 값 정의
		class2_id.options[2].text = '회 수';//2-3번째 셀렉트바 텍스트 정의
		class2_id.options[2].value = '3';//2-3번째 셀렉트바 값 정의
		class2_id.options[3].text = '출 자';//2-4번째 셀렉트바 텍스트 정의
		class2_id.options[3].value = '4';//2-4번째 셀렉트바 값 정의

		//////////////////////////////
		d1_1_id.style.display='none';   //입금처 활성화
		d1_2_id.style.display='none';   //입금처 활성화
		d1_3_id.style.display='none';   //입금처 활성화
		d1_4_id.style.display='';   //수익계정 활성화
		d1_5_id.style.display='none';   //입금처 활성화

		d1_acc1_id.disabled=1;
		d1_acc2_id.disabled=1;
		d1_acc3_id.disabled=1;
		d1_acc4_id.disabled=0; /// 수익계정 활성화
		d1_acc5_id.disabled=1;
		//////////////////////////////

		in_id.disabled=false;
		inc_id.disabled=false;
		out_id.disabled=true;
		exp_id.disabled=true;
	}else if(class1_id.value==2){    //1번째 셀렉트바 출금이면
		class2_id.length=4;
		class2_id.options[0].text = '비 용'
		class2_id.options[0].value = '5';
		class2_id.options[0].selected =1; // 비용을 선택하고
		class2_id.options[1].text = '상 환';
		class2_id.options[1].value = '6';
		class2_id.options[2].text = '대 여';
		class2_id.options[2].value = '7';
		class2_id.options[3].text = '배 당';
		class2_id.options[3].value = '8';

		//////////////////////////////
		d1_1_id.style.display='none';   //입금처 활성화
		d1_2_id.style.display='none';   //입금처 활성화
		d1_3_id.style.display='none';   //입금처 활성화
		d1_4_id.style.display='none';   //입금처 활성화
		d1_5_id.style.display='';   //비용계정 활성화

		d1_acc1_id.disabled=1;
		d1_acc2_id.disabled=1;
		d1_acc3_id.disabled=1;
		d1_acc4_id.disabled=1;
		d1_acc5_id.disabled=0; // 비용계정을을 활성화
		//////////////////////////////
		///
		in_id.disabled=1;
		inc_id.disabled=1;
		out_id.disabled=0;
		exp_id.disabled=0;

	}else if(class1_id.value==3){
		class2_id.length=2;
		if(pj=='pj'){
			class2_id.options[0].text = '현 장'
			class2_id.options[0].value = '10';
			class2_id.options[0].selected =1; // 비용을 선택하고
			class2_id.options[1].text = '본 사'
			class2_id.options[1].value = '9';
		}else{
			class2_id.options[0].text = '본 사'
			class2_id.options[0].value = '9';
			class2_id.options[0].selected =1; // 비용을 선택하고
			class2_id.options[1].text = '현 장'
			class2_id.options[1].value = '10';
		}
		//////////////////////////////
		d1_1_id.style.display='';   //첫번째 활성화
		d1_2_id.style.display='none';   //부채계정 비활성화
		d1_3_id.style.display='none';   //자산계정 비활성화
		d1_4_id.style.display='none';   //수익계정 비활성화
		d1_5_id.style.display='none';   //비용계정 비활성화

		d1_acc1_id.disabled=1;
		d1_acc2_id.disabled=1;
		d1_acc3_id.disabled=1;
		d1_acc4_id.disabled=1;
		d1_acc5_id.disabled=1;
		//////////////////////////////

		in_id.disabled=0;
		inc_id.disabled=0;
		out_id.disabled=0;
		exp_id.disabled=0;
	}else{ // 선택(값이 '0')을 선택하면
		class2_id.length=11;
		class2_id.options[0].text = '선 택';
		class2_id.options[0].value = '';
		class2_id.options[0].selected =1; // 선택을 선택하고
		class2_id.options[1].text = '수 익';
		class2_id.options[1].value = '1';
		class2_id.options[2].text = '차 입';
		class2_id.options[2].value = '2';
		class2_id.options[3].text = '회 수';
		class2_id.options[3].value = '3';
		class2_id.options[4].text = '출 자';
		class2_id.options[4].value = '4';
		class2_id.options[5].text = '비 용';
		class2_id.options[5].value = '5';
		class2_id.options[6].text = '상 환';
		class2_id.options[6].value = '6';
		class2_id.options[7].text = '대 여';
		class2_id.options[7].value = '7';
		class2_id.options[8].text = '배 당';
		class2_id.options[8].value = '8';
		if(pj=='pj'){
			class2_id.options[10].text = '현 장';
			class2_id.options[10].value = '10';
			class2_id.options[9].text = '본 사';
			class2_id.options[9].value = '9';
		}else{
			class2_id.options[9].text = '본 사';
			class2_id.options[9].value = '9';
			class2_id.options[10].text = '현 장';
			class2_id.options[10].value = '10';
		}
		//////////////////////////////
		d1_1_id.style.display='';   //수익계정 활성화
		d1_2_id.style.display='none';   //부채계정 비활성화
		d1_3_id.style.display='none';   //자산계정 비활성화
		d1_4_id.style.display='none';   //수익계정 비활성화
		d1_5_id.style.display='none';   //비용계정 비활성화

		d1_acc1_id.disabled=1;
		d1_acc2_id.disabled=1;
		d1_acc3_id.disabled=1;
		d1_acc4_id.disabled=1;
		d1_acc5_id.disabled=1;
		//////////////////////////////

		in_id.disabled=1; // 입금계정
		inc_id.disabled=0; // 입금금액
		out_id.disabled=1; // 출금계정
		exp_id.disabled=0; // 출금금액
	}
}

// 구분목록 상자선택2 (capital3.php)
function inoutSel2(no){
	var class1_str = "class1_";  //대분류 계정
	var class1 = class1_str+no;
	var class2_str = "class2_";  //세부계정
	var class2 = class2_str+no;
	var pj_seq_str = "pj_seq_"; // 현장코드
	var pj_seq = pj_seq_str+no;
	var jh_loan_str = "jh_loan_"; // 조합대여 여부
	var jh_loan = jh_loan_str+no;

	var d1_1_str = "d1_1_";   // 자산계정 td
	var d1_1 = d1_1_str+no;
	var d1_2_str = "d1_2_";   // 부채계정 td
	var d1_2 = d1_2_str+no;
	var d1_3_str = "d1_3_";   // 자본계정 td
	var d1_3 = d1_3_str+no;
	var d1_4_str = "d1_4_";   // 수익계정 td
	var d1_4 = d1_4_str+no;
	var d1_5_str = "d1_5_";   // 비용계정 td
	var d1_5 = d1_5_str+no;

	var d1_acc1_str = "d1_acc1_";   // 자산 계정과목
	var d1_acc1 = d1_acc1_str+no;
	var d1_acc2_str = "d1_acc2_";   // 부채 계정과목
	var d1_acc2 = d1_acc2_str+no;
	var d1_acc3_str = "d1_acc3_";   // 자본 계정과목
	var d1_acc3 = d1_acc3_str+no;
	var d1_acc4_str = "d1_acc4_";   // 수익 계정과목
	var d1_acc4 = d1_acc4_str+no;
	var d1_acc5_str = "d1_acc5_";   // 비용 계정과목
	var d1_acc5 = d1_acc5_str+no;

	var in_str = "in_"; // 입금처
	var iin = in_str+no;
	var inc_str = "inc_"; // 입금액
	var inc = inc_str+no;
	var out_str = "out_"; // 출금처
	var out = out_str+no;
	var exp_str = "exp_"; // 출금액
	var exp = exp_str+no;

	var class1_id = document.getElementById(class1);
	var class2_id = document.getElementById(class2);
	var pj_seq_id = document.getElementById(pj_seq);
	var jh_loan_id = document.getElementById(jh_loan);

	var d1_1_id = document.getElementById(d1_1);//////////// 자산계정 TD
	var d1_2_id = document.getElementById(d1_2);          // 부채계정 TD
	var d1_3_id = document.getElementById(d1_3);          // 자본계정 TD
	var d1_4_id = document.getElementById(d1_4);          // 수익계정 TD
	var d1_5_id = document.getElementById(d1_5);//////////// 비용계정 TD
                                                        //
	var d1_acc1_id = document.getElementById(d1_acc1);////// 자산계정 FORM
	var d1_acc2_id = document.getElementById(d1_acc2);    // 부채계정 FORM
	var d1_acc3_id = document.getElementById(d1_acc3);    // 자본계정 FORM
	var d1_acc4_id = document.getElementById(d1_acc4);    // 수익계정 FORM
	var d1_acc5_id = document.getElementById(d1_acc5);////// 비용계정 FORM

	var in_id = document.getElementById(iin); // 입금처
	var inc_id = document.getElementById(inc); // 입금액
	var out_id = document.getElementById(out); // 출금처
	var exp_id = document.getElementById(exp); // 출금액


	if(class2_id.value==0) {class1_id.options[0].selected=1;} // 선택을 선택하면 1번째 셀렉트도 선택을 선택
	if(class2_id.value>0&&class2_id.value<=4) { // 입금관련 항목들을 선택하면
		class1_id.options[1].selected=1; // 1번째 셀렉트도 입금을 선택
		in_id.disabled=0; // 입금처 열고
		inc_id.disabled=0; // 입금액 열고
		out_id.disabled=1; // 출금처 닫고
		exp_id.disabled=1; // 출금액 닫고
	}else if(class2_id.value>4&&class2_id.value<=8) { // 출금관련 항목들을 선택하면
		class1_id.options[2].selected=1; // 1번째 셀렉트도 출금을 선택
		in_id.disabled=1; // 입금처 닫고
		inc_id.disabled=1; // 입금액 닫고
		out_id.disabled=0; // 출금처 열고
		exp_id.disabled=0; // 출금액 열고
	}else	if(class2_id.value>8){ // 대체관련 항목들을 선택하면
		class1_id.options[3].selected=1; // 1번째 셀렉트도 대체를 선택
		in_id.disabled=0; // 입금처 열고
		inc_id.disabled=0; // 입금액 열고
		out_id.disabled=0; // 출금처 열고
		exp_id.disabled=0; // 출금액 열고

		d1_1_id.style.display='';
	  d1_2_id.style.display='none';
	  d1_3_id.style.display='none';
	  d1_4_id.style.display='none';
	  d1_5_id.style.display='none';

	  d1_acc1_id.style.disabled=1;
	  d1_acc2_id.style.disabled=1;
	  d1_acc3_id.style.disabled=1;
	  d1_acc4_id.style.disabled=1;
	  d1_acc5_id.style.disabled=1;
	}

if(class2_id.value==1){ // 수익을 선택하면
		d1_1_id.style.display='none';
 		d1_2_id.style.display='none';
 	 	d1_3_id.style.display='none';
 	 	d1_4_id.style.display='';     // 수익계정과목 보이기
 	 	d1_5_id.style.display='none';

  	d1_acc1_id.disabled=1;
  	d1_acc2_id.disabled=1;
  	d1_acc3_id.disabled=1;
  	d1_acc4_id.disabled=false; // 수익계정과목 보이기
  	d1_acc5_id.disabled=1;

	}else if(class2_id.value==2||class2_id.value==6){ // 차입 / 상환  선택하면
		d1_1_id.style.display='none';
  	d1_2_id.style.display='';     // 부채계정과목 보이고
 		d1_3_id.style.display='none';
  	d1_4_id.style.display='none';
  	d1_5_id.style.display='none';

	 	d1_acc1_id.disabled=1;
	 	d1_acc2_id.disabled=0;  // 부채계정과목 보이고
	 	d1_acc3_id.disabled=1;
	 	d1_acc4_id.disabled=1;
	 	d1_acc5_id.disabled=1;

	}else if(class2_id.value==3||class2_id.value==7){ // 대여 / 회수 선택하면
		d1_1_id.style.display=''; // 자산계정과목 보이고
  	d1_2_id.style.display='none';
  	d1_3_id.style.display='none';
  	d1_4_id.style.display='none';
  	d1_5_id.style.display='none';

  	d1_acc1_id.disabled=0;  // 자산계정과목 보이고
  	d1_acc2_id.disabled=1;
  	d1_acc3_id.disabled=1;
  	d1_acc4_id.disabled=1;
  	d1_acc5_id.disabled=1;

	}else if(class2_id.value==4||class2_id.value==8){ //출자 / 배당 선택하면
		d1_1_id.style.display='none';
  	d1_2_id.style.display='none';
  	d1_3_id.style.display='';    // 자본계정과목 보이고
  	d1_4_id.style.display='none';
  	d1_5_id.style.display='none';

  	d1_acc1_id.disabled=1;
  	d1_acc2_id.disabled=1;
  	d1_acc3_id.disabled=0; // 자본계정과목 보이고
  	d1_acc4_id.disabled=1;
  	d1_acc5_id.disabled=1;
	}
	if(class2_id.value==5){ // 비용 선택하면
		d1_1_id.style.display='none';
  	d1_2_id.style.display='none';
  	d1_3_id.style.display='none';
  	d1_4_id.style.display='none';
  	d1_5_id.style.display=''; // 비용계정과목 보이고

	 	d1_acc1_id.disabled=1;
	 	d1_acc2_id.disabled=1;
	 	d1_acc3_id.disabled=1;
	 	d1_acc4_id.disabled=1;
	 	d1_acc5_id.disabled=0; // 비용계정과목 보이고
	}

	if(class2_id.value==3||class2_id.value==7){
		jh_loan_id.disabled=0;
	}else{
		jh_loan_id.disabled=1;// 대여 선택 시 조합대여금 체크박스 열기
		jh_loan_id.checked=0;
	}
	if(class2_id.value==10)	pj_seq_id.disabled=false; else 	pj_seq_id.disabled=true; // 현장 대체 선택 시 현장 선택 열기
}


/**
 * // 조합대여금 여부 체크박스 체크 시
 * @param  {[type]} no [description]
 * @return {[type]}    [description]
 */
function jh_chk(no){
	var jh_loan_str = "jh_loan_";
	var jh_loan = jh_loan_str+no;
	var inc_td_str = "inc_td_"; // 수익계정
	var inc_td = inc_td_str+no;

	var out_td_str = "out_td_"; // 비용계정
	var out_td = out_td_str+no;

	var out_account_str = "out_account_"; // 비용 계정과목
	var out_account = out_account_str+no;

	var jh_loan_id = document.getElementById(jh_loan);
	var inc_td_id = document.getElementById(inc_td);
	var out_td_id = document.getElementById(out_td);
	var out_account_id = document.getElementById(out_account);

	if(jh_loan_id.checked==true){
		inc_td_id.style.display='none';
		out_td_id.style.display='';
		out_account_id.disabled=false;
	}else{
		inc_td_id.style.display='';
		out_td_id.style.display='none';
		out_account_id.disabled=true;
	}
}

// 서브밋 체크
function inout_frm_chk(com){
	var form=document.inout_frm;
	if(!form.deal_date.value){
		alert('거래일자를 입력하세요!');
		form.deal_date.focus();
		return;
	}
	if(!form.class1_1.value&&!form.class1_2.value&&!form.class1_3.value&&!form.class1_4.value&&!form.class1_5.value&&!form.class1_6.value&&!form.class1_7.value&&!form.class1_8.value&&!form.class1_9.value&&!form.class1_10.value){
		alert('하나 이상의 거래를 입력하세요!');
		form.class1_1.focus();
		return;
	}

	if(form.class1_1.value){
		if(com=='com'){
			if(form.class2_1.value=='8'){
				if(!form.pj_seq_1.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_1.focus();
					return;
				}
			}
		}
		if(form.class2_1.value==1||form.class2_1.value==4){
			if(!document.getElementById('inc_account_1').value&&!document.getElementById('out_account_1').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_1.value){
			alert('적요 항목을 입력하세요!');
			form.cont_1.focus();
			return;
		}
		if(form.class1_1.value==1){
			if(!form.in_1.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_1.focus();
				return;
			}
			if(!form.inc_1.value){
				alert('입금 금액을 입력하세요!');
				form.inc_1.focus();
				return;
			}
		}
		if(form.class1_1.value==2){
			if(!form.out_1.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_1.focus();
				return;
			}
			if(!form.exp_1.value){
				alert('출금 금액을 입력하세요!');
				form.exp_1.focus();
				return;
			}
		}
		if(form.class1_1.value==3){

			if(!form.in_1.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_1.focus();
				return;
			}
			if(!form.inc_1.value){
				alert('입금 금액을 입력하세요!');
				form.inc_1.focus();
				return;
			}
			if(!form.out_1.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_1.focus();
				return;
			}
			var out_val = form.out_1.value.split("-");
			if(form.in_1.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_1.focus();
				return;
			}
			if(!form.exp_1.value){
				alert('출금 금액을 입력하세요!');
				form.exp_1.focus();
				return;
			}
		}
	}

	if(form.class1_2.value){
		if(com=='com'){
			if(form.class2_2.value=='8'){
				if(!form.pj_seq_2.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_2.focus();
					return;
				}
			}
		}
		if(form.class2_2.value==1||form.class2_2.value==4){
			if(!document.getElementById('inc_account_2').value&&!document.getElementById('out_account_2').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_2.value){
			alert('적요 항목을 입력하세요!');
			form.cont_2.focus();
			return;
		}
		if(form.class1_2.value==1){
			if(!form.in_2.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_2.focus();
				return;
			}
			if(!form.inc_2.value){
				alert('입금 금액을 입력하세요!');
				form.inc_2.focus();
				return;
			}
		}
		if(form.class1_2.value==2){
			if(!form.out_2.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_2.focus();
				return;
			}
			if(!form.exp_2.value){
				alert('출금 금액을 입력하세요!');
				form.exp_2.focus();
				return;
			}
		}
		if(form.class1_2.value==3){
			if(!form.in_2.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_2.focus();
				return;
			}
			if(!form.inc_2.value){
				alert('입금 금액을 입력하세요!');
				form.inc_2.focus();
				return;
			}
			if(!form.out_2.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_2.focus();
				return;
			}
			var out_val = form.out_2.value.split("-");
			if(form.in_2.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_2.focus();
				return;
			}
			if(!form.exp_2.value){
				alert('출금 금액을 입력하세요!');
				form.exp_2.focus();
				return;
			}
		}
	}
	if(form.class1_3.value){
		if(com=='com'){
			if(form.class2_3.value=='8'){
				if(!form.pj_seq_3.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_3.focus();
					return;
				}
			}
		}
		if(form.class2_3.value==1||form.class2_3.value==4){
			if(!document.getElementById('inc_account_3').value&&!document.getElementById('out_account_3').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_3.value){
			alert('적요 항목을 입력하세요!');
			form.cont_3.focus();
			return;
		}
		if(form.class1_3.value==1){
			if(!form.in_3.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_3.focus();
				return;
			}
			if(!form.inc_3.value){
				alert('입금 금액을 입력하세요!');
				form.inc_3.focus();
				return;
			}
		}
		if(form.class1_3.value==2){
			if(!form.out_3.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_3.focus();
				return;
			}
			if(!form.exp_3.value){
				alert('출금 금액을 입력하세요!');
				form.exp_3.focus();
				return;
			}
		}
		if(form.class1_3.value==3){
			if(!form.in_3.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_3.focus();
				return;
			}
			if(!form.inc_3.value){
				alert('입금 금액을 입력하세요!');
				form.inc_3.focus();
				return;
			}
			if(!form.out_3.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_3.focus();
				return;
			}
			var out_val = form.out_3.value.split("-");
			if(form.in_3.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_3.focus();
				return;
			}
			if(!form.exp_3.value){
				alert('출금 금액을 입력하세요!');
				form.exp_3.focus();
				return;
			}
		}
	}
	if(form.class1_4.value){
		if(com=='com'){
			if(form.class2_4.value=='8'){
				if(!form.pj_seq_4.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_4.focus();
					return;
				}
			}
		}
		if(form.class2_4.value==1||form.class2_4.value==4){
			if(!document.getElementById('inc_account_4').value&&!document.getElementById('out_account_4').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_4.value){
			alert('적요 항목을 입력하세요!');
			form.cont_4.focus();
			return;
		}
		if(form.class1_4.value==1){
			if(!form.in_4.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_4.focus();
				return;
			}
			if(!form.inc_4.value){
				alert('입금 금액을 입력하세요!');
				form.inc_4.focus();
				return;
			}
		}
		if(form.class1_4.value==2){
			if(!form.out_4.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_4.focus();
				return;
			}
			if(!form.exp_4.value){
				alert('출금 금액을 입력하세요!');
				form.exp_4.focus();
				return;
			}
		}
		if(form.class1_4.value==3){
			if(!form.in_4.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_4.focus();
				return;
			}
			if(!form.inc_4.value){
				alert('입금 금액을 입력하세요!');
				form.inc_4.focus();
				return;
			}
			if(!form.out_4.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_4.focus();
				return;
			}
			var out_val = form.out_4.value.split("-");
			if(form.in_4.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_4.focus();
				return;
			}
			if(!form.exp_4.value){
				alert('출금 금액을 입력하세요!');
				form.exp_4.focus();
				return;
			}
		}
	}
	if(form.class1_5.value){
		if(com=='com'){
			if(form.class2_5.value=='8'){
				if(!form.pj_seq_5.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_5.focus();
					return;
				}
			}
		}
		if(form.class2_5.value==1||form.class2_5.value==4){
			if(!document.getElementById('inc_account_5').value&&!document.getElementById('out_account_5').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_5.value){
			alert('적요 항목을 입력하세요!');
			form.cont_5.focus();
			return;
		}
		if(form.class1_5.value==1){
			if(!form.in_5.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_5.focus();
				return;
			}
			if(!form.inc_5.value){
				alert('입금 금액을 입력하세요!');
				form.inc_5.focus();
				return;
			}
		}
		if(form.class1_5.value==2){
			if(!form.out_5.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_5.focus();
				return;
			}
			if(!form.exp_5.value){
				alert('출금 금액을 입력하세요!');
				form.exp_5.focus();
				return;
			}
		}
		if(form.class1_5.value==3){
			if(!form.in_5.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_5.focus();
				return;
			}
			if(!form.inc_5.value){
				alert('입금 금액을 입력하세요!');
				form.inc_5.focus();
				return;
			}
			if(!form.out_5.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_5.focus();
				return;
			}
			var out_val = form.out_5.value.split("-");
			if(form.in_5.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_5.focus();
				return;
			}
			if(!form.exp_5.value){
				alert('출금 금액을 입력하세요!');
				form.exp_5.focus();
				return;
			}
		}
	}
	if(form.class1_6.value){
		if(com=='com'){
			if(form.class2_6.value=='8'){
				if(!form.pj_seq_6.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_6.focus();
					return;
				}
			}
		}
		if(form.class2_6.value==1||form.class2_6.value==4){
			if(!document.getElementById('inc_account_6').value&&!document.getElementById('out_account_6').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_6.value){
			alert('적요 항목을 입력하세요!');
			form.cont_6.focus();
			return;
		}
		if(form.class1_6.value==1){
			if(!form.in_6.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_6.focus();
				return;
			}
			if(!form.inc_6.value){
				alert('입금 금액을 입력하세요!');
				form.inc_6.focus();
				return;
			}
		}
		if(form.class1_6.value==2){
			if(!form.out_6.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_6.focus();
				return;
			}
			if(!form.exp_6.value){
				alert('출금 금액을 입력하세요!');
				form.exp_6.focus();
				return;
			}
		}
		if(form.class1_6.value==3){
			if(!form.in_6.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_6.focus();
				return;
			}
			if(!form.inc_6.value){
				alert('입금 금액을 입력하세요!');
				form.inc_6.focus();
				return;
			}
			if(!form.out_6.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_6.focus();
				return;
			}
			var out_val = form.out_6.value.split("-");
			if(form.in_6.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_6.focus();
				return;
			}
			if(!form.exp_6.value){
				alert('출금 금액을 입력하세요!');
				form.exp_6.focus();
				return;
			}
		}
	}
	if(form.class1_7.value){
		if(com=='com'){
			if(form.class2_7.value=='8'){
				if(!form.pj_seq_7.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_7.focus();
					return;
				}
			}
		}
		if(form.class2_7.value==1||form.class2_7.value==4){
			if(!document.getElementById('inc_account_7').value&&!document.getElementById('out_account_7').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_7.value){
			alert('적요 항목을 입력하세요!');
			form.cont_7.focus();
			return;
		}
		if(form.class1_7.value==1){
			if(!form.in_7.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_7.focus();
				return;
			}
			if(!form.inc_7.value){
				alert('입금 금액을 입력하세요!');
				form.inc_7.focus();
				return;
			}
		}
		if(form.class1_7.value==2){
			if(!form.out_7.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_7.focus();
				return;
			}
			if(!form.exp_7.value){
				alert('출금 금액을 입력하세요!');
				form.exp_7.focus();
				return;
			}
		}
		if(form.class1_7.value==3){
			if(!form.in_7.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_7.focus();
				return;
			}
			if(!form.inc_7.value){
				alert('입금 금액을 입력하세요!');
				form.inc_7.focus();
				return;
			}
			if(!form.out_7.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_7.focus();
				return;
			}
			var out_val = form.out_7.value.split("-");
			if(form.in_7.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_7.focus();
				return;
			}
			if(!form.exp_7.value){
				alert('출금 금액을 입력하세요!');
				form.exp_7.focus();
				return;
			}
		}
	}
	if(form.class1_8.value){
		if(com=='com'){
			if(form.class2_8.value=='8'){
				if(!form.pj_seq_8.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_8.focus();
					return;
				}
			}
		}
		if(form.class2_8.value==1||form.class2_8.value==4){
			if(!document.getElementById('inc_account_8').value&&!document.getElementById('out_account_8').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_8.value){
			alert('적요 항목을 입력하세요!');
			form.cont_8.focus();
			return;
		}
		if(form.class1_8.value==1){
			if(!form.in_8.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_8.focus();
				return;
			}
			if(!form.inc_8.value){
				alert('입금 금액을 입력하세요!');
				form.inc_8.focus();
				return;
			}
		}
		if(form.class1_8.value==2){
			if(!form.out_8.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_8.focus();
				return;
			}
			if(!form.exp_8.value){
				alert('출금 금액을 입력하세요!');
				form.exp_8.focus();
				return;
			}
		}
		if(form.class1_8.value==3){
			if(!form.in_8.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_8.focus();
				return;
			}
			if(!form.inc_8.value){
				alert('입금 금액을 입력하세요!');
				form.inc_8.focus();
				return;
			}
			if(!form.out_8.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_8.focus();
				return;
			}
			var out_val = form.out_8.value.split("-");
			if(form.in_8.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_8.focus();
				return;
			}
			if(!form.exp_8.value){
				alert('출금 금액을 입력하세요!');
				form.exp_8.focus();
				return;
			}
		}
	}
	if(form.class1_9.value){
		if(com=='com'){
			if(form.class2_9.value=='8'){
				if(!form.pj_seq_9.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_9.focus();
					return;
				}
			}
		}
		if(form.class2_9.value==1||form.class2_9.value==4){
			if(!document.getElementById('inc_account_9').value&&!document.getElementById('out_account_9').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_9.value){
			alert('적요 항목을 입력하세요!');
			form.cont_9.focus();
			return;
		}
		if(form.class1_9.value==1){
			if(!form.in_9.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_9.focus();
				return;
			}
			if(!form.inc_9.value){
				alert('입금 금액을 입력하세요!');
				form.inc_9.focus();
				return;
			}
		}
		if(form.class1_9.value==2){
			if(!form.out_9.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_9.focus();
				return;
			}
			if(!form.exp_9.value){
				alert('출금 금액을 입력하세요!');
				form.exp_9.focus();
				return;
			}
		}
		if(form.class1_9.value==3){
			if(!form.in_9.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_9.focus();
				return;
			}
			if(!form.inc_9.value){
				alert('입금 금액을 입력하세요!');
				form.inc_9.focus();
				return;
			}
			if(!form.out_9.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_9.focus();
				return;
			}
			var out_val = form.out_9.value.split("-");
			if(form.in_9.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_9.focus();
				return;
			}
			if(!form.exp_9.value){
				alert('출금 금액을 입력하세요!');
				form.exp_9.focus();
				return;
			}
		}
	}
	if(form.class1_10.value){
		if(com=='com'){
			if(form.class2_10.value=='8'){
				if(!form.pj_seq_10.value){
					alert('전도금을 대체(이체)할 현장을 선택하여 주십시요!');
					form.pj_seq_10.focus();
					return;
				}
			}
		}
		if(form.class2_10.value==1||form.class2_10.value==4){
			if(!document.getElementById('inc_account_10').value&&!document.getElementById('out_account_10').value){
				alert('계정과목을 선택하여 주십시요!');
				return;
			}
		}
		if(!form.cont_10.value){
			alert('적요 항목을 입력하세요!');
			form.cont_10.focus();
			return;
		}
		if(form.class1_10.value==1){
			if(!form.in_10.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_10.focus();
				return;
			}
			if(!form.inc_10.value){
				alert('입금 금액을 입력하세요!');
				form.inc_10.focus();
				return;
			}
		}
		if(form.class1_10.value==2){
			if(!form.out_10.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_10.focus();
				return;
			}
			if(!form.exp_10.value){
				alert('출금 금액을 입력하세요!');
				form.exp_10.focus();
				return;
			}
		}
		if(form.class1_10.value==3){
			if(!form.in_10.value){
				alert('입금 계정 항목을 선택하세요!');
				form.in_10.focus();
				return;
			}
			if(!form.inc_10.value){
				alert('입금 금액을 입력하세요!');
				form.inc_10.focus();
				return;
			}
			if(!form.out_10.value){
				alert('출금 계정 항목을 선택하세요!');
				form.out_10.focus();
				return;
			}
			var out_val = form.out_10.value.split("-");
			if(form.in_10.value==out_val[0]){
				alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
				form.out_10.focus();
				return;
			}
			if(!form.exp_10.value){
				alert('출금 금액을 입력하세요!');
				form.exp_10.focus();
				return;
			}
		}
	}
	var aaa=confirm('거래내용을 등록하시겠습니까?');
	if(aaa==true){
		form.submit();
	}else{
		return;
	}
}

// 현장 서브밋
function pj_inout_frm_chk(){
	var form=document.form1;
	if(!form.pj_list.value){
		alert('프로젝트를 선택하여 주십시요!');
		form.pj_list.focus();
		return;
	}
	inout_frm_chk();
}


// 대체시 체크
function transfer(frm1,frm2,frm3){
	if(frm1.value==3) frm3.value=frm2.value;
}

// 카테첵 윈도오픈
function cate_chk(ref,name) {
	var window_left = (screen.width-640)/2;
	var window_top = (screen.height-480)/2;
	window.open(ref,name,'width=420,height=460,scrollbars=no,status=no,top=' + window_top + ',left=' + window_left + '');
}

//수수료 관련 체크박스 활성화
function charge(no,obj){
	var form=document.inout_frm;
	var nobj = obj.split("-");

	if(no==1){	if(nobj[0]==1||!obj){	form.char1_1.disabled=1;	}else{	form.char1_1.disabled=0;	}	}
	if(no==2){	if(nobj[0]==1||!obj){	form.char1_2.disabled=1;	}else{	form.char1_2.disabled=0;	}	}
	if(no==3){	if(nobj[0]==1||!obj){	form.char1_3.disabled=1;	}else{	form.char1_3.disabled=0;	}	}
	if(no==4){	if(nobj[0]==1||!obj){	form.char1_4.disabled=1;	}else{	form.char1_4.disabled=0;	}	}
	if(no==5){	if(nobj[0]==1||!obj){	form.char1_5.disabled=1;	}else{	form.char1_5.disabled=0;	}	}
	if(no==6){	if(nobj[0]==1||!obj){	form.char1_6.disabled=1;	}else{	form.char1_6.disabled=0;	}	}
	if(no==7){	if(nobj[0]==1||!obj){	form.char1_7.disabled=1;	}else{	form.char1_7.disabled=0;	}	}
	if(no==8){	if(nobj[0]==1||!obj){	form.char1_8.disabled=1;	}else{	form.char1_8.disabled=0;	}	}
	if(no==9){	if(nobj[0]==1||!obj){	form.char1_9.disabled=1;	}else{	form.char1_9.disabled=0;	}	}
	if(no==10){	if(nobj[0]==1||!obj){	form.char1_10.disabled=1; }else{	form.char1_10.disabled=0; } }
}

// 수수료 체크박스
function char2_chk(frm, no){
	var form=document.inout_frm;
	if(frm.disabled==true) {frm.disabled=false; frm.value=500;}else{frm.disabled=true; frm.value="";}
	if(no==1){form.cont_1_h.value=form.cont_1.value;}
	if(no==2){form.cont_2_h.value=form.cont_2.value;}
	if(no==3){form.cont_3_h.value=form.cont_3.value;}
	if(no==4){form.cont_4_h.value=form.cont_4.value;}
	if(no==5){form.cont_5_h.value=form.cont_5.value;}
	if(no==6){form.cont_6_h.value=form.cont_6.value;}
	if(no==7){form.cont_7_h.value=form.cont_7.value;}
	if(no==8){form.cont_8_h.value=form.cont_8.value;}
	if(no==9){form.cont_9_h.value=form.cont_9.value;}
	if(no==10){form.cont_10_h.value=form.cont_10.value;}
}