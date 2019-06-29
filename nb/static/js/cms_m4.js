/**
 * MENU3 - 재무회계 페이지 함수 모음
 */


// 구분 목록상자 선택1 (capital2.php // capital_edit.php // capital3.php)
function inoutSel(form, no, pj){ // ==capital2.php 와 capital_edit.php => form // capital3.php => no // 현장전도금일때 pj 인자활용
	var class1_str = "class1_"; var class1 = class1_str+no;  // 구분1
	var class2_str = "class2_"; var class2 = class2_str+no;  // 구분2
	var pj_seq_str = "pj_seq_"; var pj_seq = pj_seq_str+no;  // 현장코드
	var jh_loan_str = "jh_loan_"; var jh_loan = jh_loan_str+no;  // 조합대여 여부

	var d1_1_str = "d1_1_";  var d1_1 = d1_1_str+no;   // 자산계정 td
	var d1_2_str = "d1_2_";  var d1_2 = d1_2_str+no;   // 부채계정 td
	var d1_3_str = "d1_3_";   var d1_3 = d1_3_str+no;  // 자본계정 td
	var d1_4_str = "d1_4_";   var d1_4 = d1_4_str+no;  // 수익계정 td
	var d1_5_str = "d1_5_";   var d1_5 = d1_5_str+no;  // 비용계정 td

	var d1_acc1_str = "d1_acc1_";   var d1_acc1 = d1_acc1_str+no;  // 자산 계정과목
	var d1_acc2_str = "d1_acc2_";   var d1_acc2 = d1_acc2_str+no;  // 부채 계정과목
	var d1_acc3_str = "d1_acc3_";   var d1_acc3 = d1_acc3_str+no;  // 자본 계정과목
	var d1_acc4_str = "d1_acc4_";   var d1_acc4 = d1_acc4_str+no;  // 수익 계정과목
	var d1_acc5_str = "d1_acc5_";   var d1_acc5 = d1_acc5_str+no;  // 비용 계정과목

	var in_str = "in_";   var iin = in_str+no;   // 입금처
	var inc_str = "inc_";  var inc = inc_str+no; // 입금액
	var out_str = "out_"; var out = out_str+no;  // 출금처
	var exp_str = "exp_"; var exp = exp_str+no;  // 출금액

	var class1_id = document.getElementById(class1); if( !no) var class1_id = form.class1;
	var class2_id = document.getElementById(class2); if( !no) var class2_id = form.class2;
	var pj_seq_id = document.getElementById(pj_seq); if( !no) var pj_seq_id = form.any_jh;
	var jh_loan_id = document.getElementById(jh_loan); if( !no) var jh_loan_id = form.is_jh;

	var d1_1_id = document.getElementById(d1_1);
	var d1_2_id = document.getElementById(d1_2);
	var d1_3_id = document.getElementById(d1_3);
	var d1_4_id = document.getElementById(d1_4);
	var d1_5_id = document.getElementById(d1_5);

	var d1_acc1_id = document.getElementById(d1_acc1); if( !no) var d1_acc1_id = document.getElementById('d1_1');
	var d1_acc2_id = document.getElementById(d1_acc2); if( !no) var d1_acc2_id = document.getElementById('d1_2');
	var d1_acc3_id = document.getElementById(d1_acc3); if( !no) var d1_acc3_id = document.getElementById('d1_3');
	var d1_acc4_id = document.getElementById(d1_acc4); if( !no) var d1_acc4_id = document.getElementById('d1_4');
	var d1_acc5_id = document.getElementById(d1_acc5); if( !no) var d1_acc5_id = document.getElementById('d1_5');

	var in_id = document.getElementById(iin);  if(!no) var in_id = form.ina;
	var inc_id = document.getElementById(inc); if(!no) var inc_id = form.inc;
	var out_id = document.getElementById(out); if(!no) var out_id = form.out;
	var exp_id = document.getElementById(exp); if(!no) var exp_id = form.exp;

	class2_id.disabled=0;

	if(class1_id.value==1){   //1번째 셀렉트바 입금이면
		class2_id.length=5;    //2번째 셀렉트바 목록 5개
		class2_id.options[0].text = '선 택';//2-1번째 셀렉트바 텍스트 정의
		class2_id.options[0].value = '0';//2-1번째 셀렉트바 값 정의
		class2_id.options[1].text = '자 산';//2-1번째 셀렉트바 텍스트 정의
		class2_id.options[1].value = '1';//2-1번째 셀렉트바 값 정의
		class2_id.options[2].text = '부 채';//2-2번째 셀렉트바 텍스트 정의
		class2_id.options[2].value = '2';//2-2번째 셀렉트바 값 정의
		class2_id.options[3].text = '자 본';//2-3번째 셀렉트바 텍스트 정의
		class2_id.options[3].value = '3';//2-3번째 셀렉트바 값 정의
		class2_id.options[4].text = '수 익';//2-4번째 셀렉트바 텍스트 정의
		class2_id.options[4].value = '4';//2-4번째 셀렉트바 값 정의
		if( !jh_loan_id || jh_loan_id.checked==0){
			class2_id.options[4].selected =1; // 수익을 선택하고 ///////
			if(d1_1_id)d1_1_id.style.display='none';   //자산계정 비활성
			if(d1_2_id)d1_2_id.style.display='none';   //부채계정 비활성
			if(d1_3_id)d1_3_id.style.display='none';   //자본계정 비활성
			if(d1_4_id)d1_4_id.style.display='';       //수익계정 활성화
			if(d1_5_id)d1_5_id.style.display='none';   //비용계정 비활성

			d1_acc1_id.disabled=1;  d1_acc1_id.style.display='none';
			d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
			d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
			d1_acc4_id.disabled=0;  d1_acc4_id.style.display=''; /// 수익계정 활성화
			d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';
		}else{
			class2_id.options[1].selected =1; // 자산을 선택하고 ///////
			if(d1_1_id)d1_1_id.style.display='';   //자산계정 활성
			if(d1_2_id)d1_2_id.style.display='none';   //부채계정 비활성
			if(d1_3_id)d1_3_id.style.display='none';   //자본계정 비활성
			if(d1_4_id)d1_4_id.style.display='none';   //수익계정 비활성
			if(d1_5_id)d1_5_id.style.display='none';   //비용계정 비활성

			d1_acc1_id.disabled=0;  d1_acc1_id.style.display='';
			d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
			d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
			d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none'; /// 수익계정 활성화
			d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';
		}

		in_id.disabled=0;
		inc_id.disabled=0;
		out_id.disabled=1;  out_id.options[0].selected =1;
		exp_id.disabled=1;  exp_id.value=null;



	}else if(class1_id.value==2){    //1번째 셀렉트바 출금이면
		class2_id.length=5;
		class2_id.options[0].text = '선 택';
		class2_id.options[0].value = '0';
		class2_id.options[1].text = '자 산';
		class2_id.options[1].value = '1';
		class2_id.options[2].text = '부 채';
		class2_id.options[2].value = '2';
		class2_id.options[3].text = '자 본';
		class2_id.options[3].value = '3';
		class2_id.options[4].text = '비 용';
		class2_id.options[4].value = '5';
		if(!jh_loan_id||jh_loan_id.checked==0){
			class2_id.options[4].selected =1; // 비용을 선택하고 ///////
			if(d1_1_id)d1_1_id.style.display='none';   //자산계정 비활성
			if(d1_2_id)d1_2_id.style.display='none';   //부채계정 비활성
			if(d1_3_id)d1_3_id.style.display='none';   //자본계정 비활성
			if(d1_4_id)d1_4_id.style.display='none';   //수익계정 비활성
			if(d1_5_id)d1_5_id.style.display='';       //비용계정 활성화

			d1_acc1_id.disabled=1;  d1_acc1_id.style.display='none';
			d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
			d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
			d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
			d1_acc5_id.disabled=0;  d1_acc5_id.style.display='';  /// 비용계정 활성화
		}else{
			class2_id.options[1].selected =1; // 자산을 선택하고 ///////
			if(d1_1_id)d1_1_id.style.display='';         //자산계정 활성화
			if(d1_2_id)d1_2_id.style.display='none';     //부채계정 비활성
			if(d1_3_id)d1_3_id.style.display='none';     //자본계정 비활성
			if(d1_4_id)d1_4_id.style.display='none';     //수익계정 비활성
			if(d1_5_id)d1_5_id.style.display='none';     //비용계정 비활성

			d1_acc1_id.disabled=0;  d1_acc1_id.style.display='';    //자산계정 활성화
			d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
			d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
			d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
			d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';
		}

		in_id.disabled=1;   in_id.options[0].selected =1;
		inc_id.disabled=1;  inc_id.value=null;
		out_id.disabled=0;
		exp_id.disabled=0;


	}else if(class1_id.value==3){
		class2_id.length=3;
		if(pj=='pj'){
			class2_id.options[0].text = '선 택';
			class2_id.options[0].value = '0';
			class2_id.options[1].text = '현 장';
			class2_id.options[1].value = '7';
			class2_id.options[1].selected =1; // 현장을 선택하고
			class2_id.options[2].text = '본 사';
			class2_id.options[2].value = '6';
		}else{
			class2_id.options[0].text = '선 택';
			class2_id.options[0].value = '0';
			class2_id.options[1].text = '본 사';
			class2_id.options[1].value = '6';
			class2_id.options[1].selected =1; // 본사를 선택하고
			class2_id.options[2].text = '현 장';
			class2_id.options[2].value = '7';
		}
		//////////////////////////////
		pj_seq_id.options[0].selected =1;
		pj_seq_id.disabled=1;
		jh_loan_id.checked=0;
		jh_loan_id.disabled=1;

		if(d1_1_id)d1_1_id.style.display='';   //첫번째 활성화
		if(d1_2_id)d1_2_id.style.display='none';   //부채계정 비활성화
		if(d1_3_id)d1_3_id.style.display='none';   //자본계정 비활성화
		if(d1_4_id)d1_4_id.style.display='none';   //수익계정 비활성화
		if(d1_5_id)d1_5_id.style.display='none';   //비용계정 비활성화

		d1_acc1_id.options[0].selected =1; // 선택을 선택하고

		d1_acc1_id.disabled=1;  d1_acc1_id.style.display='';    //자산계정 활성화
		d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
		d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
		d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
		d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';

		in_id.disabled=0;
		inc_id.disabled=0;
		out_id.disabled=0;
		exp_id.disabled=0;

	}else{ // 선택(값이 '0')을 선택하면
		class2_id.disabled=1;

		class2_id.length=1;
		class2_id.options[0].text = '선 택';
		class2_id.options[0].value = '';
		class2_id.options[0].selected =1; // 선택을 선택하고

		pj_seq_id.options[0].selected=1;
		pj_seq_id.disabled=1;
		jh_loan_id.checked=0;
		jh_loan_id.disabled=1;

		//////////////////////////////
		if(d1_1_id)d1_1_id.style.display='';   //수익계정 활성화
		if(d1_2_id)d1_2_id.style.display='none';   //부채계정 비활성화
		if(d1_3_id)d1_3_id.style.display='none';   //자본계정 비활성화
		if(d1_4_id)d1_4_id.style.display='none';   //수익계정 비활성화
		if(d1_5_id)d1_5_id.style.display='none';   //비용계정 비활성화

		d1_acc1_id.disabled=1;  d1_acc1_id.style.display='';    //자산계정 활성화
		d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
		d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
		d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
		d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';

		in_id.disabled=1; // 입금계정
		inc_id.disabled=0; // 입금금액
		out_id.disabled=1; // 출금계정
		exp_id.disabled=0; // 출금금액
	}
}

// 구분목록 상자선택2 (capital2.php // capital_edit.php // capital3.php)
function inoutSel2(form, no){ // ==capital2.php 와 capital_edit.php => form // capital3.php => no 인자

	var class1_str = "class1_"; var class1 = class1_str+no;  // 구분1
	var class2_str = "class2_"; var class2 = class2_str+no;  // 구분2
	var pj_seq_str = "pj_seq_"; var pj_seq = pj_seq_str+no;  // 현장코드
	var jh_loan_str = "jh_loan_"; var jh_loan = jh_loan_str+no;  // 조합대여 여부

	var d1_1_str = "d1_1_";  var d1_1 = d1_1_str+no;   // 자산계정 td
	var d1_2_str = "d1_2_";  var d1_2 = d1_2_str+no;   // 부채계정 td
	var d1_3_str = "d1_3_";   var d1_3 = d1_3_str+no;  // 자본계정 td
	var d1_4_str = "d1_4_";   var d1_4 = d1_4_str+no;  // 수익계정 td
	var d1_5_str = "d1_5_";   var d1_5 = d1_5_str+no;  // 비용계정 td

	var d1_acc1_str = "d1_acc1_";   var d1_acc1 = d1_acc1_str+no;  // 자산 계정과목
	var d1_acc2_str = "d1_acc2_";   var d1_acc2 = d1_acc2_str+no;  // 부채 계정과목
	var d1_acc3_str = "d1_acc3_";   var d1_acc3 = d1_acc3_str+no;  // 자본 계정과목
	var d1_acc4_str = "d1_acc4_";   var d1_acc4 = d1_acc4_str+no;  // 수익 계정과목
	var d1_acc5_str = "d1_acc5_";   var d1_acc5 = d1_acc5_str+no;  // 비용 계정과목

	var in_str = "in_";   var iin = in_str+no;   // 입금처
	var inc_str = "inc_";  var inc = inc_str+no; // 입금액
	var out_str = "out_"; var out = out_str+no;  // 출금처
	var exp_str = "exp_"; var exp = exp_str+no;  // 출금액

	var class1_id = document.getElementById(class1); if(!no) var class1_id = form.class1;
	var class2_id = document.getElementById(class2); if(!no) var class2_id = form.class2;
	var pj_seq_id = document.getElementById(pj_seq); if(!no) var pj_seq_id = form.any_jh;
	var jh_loan_id = document.getElementById(jh_loan); if(!no) var jh_loan_id = form.is_jh;

	var d1_1_id = document.getElementById(d1_1);//////////// 자산계정 TD
	var d1_2_id = document.getElementById(d1_2);          // 부채계정 TD
	var d1_3_id = document.getElementById(d1_3);          // 자본계정 TD
	var d1_4_id = document.getElementById(d1_4);          // 수익계정 TD
	var d1_5_id = document.getElementById(d1_5);//////////// 비용계정 TD

	var d1_acc1_id = document.getElementById(d1_acc1); if(!no) var d1_acc1_id = document.getElementById('d1_1');////// 자산계정 FORM
	var d1_acc2_id = document.getElementById(d1_acc2); if(!no) var d1_acc2_id = document.getElementById('d1_2');    // 부채계정 FORM
	var d1_acc3_id = document.getElementById(d1_acc3); if(!no) var d1_acc3_id = document.getElementById('d1_3');    // 자본계정 FORM
	var d1_acc4_id = document.getElementById(d1_acc4); if(!no) var d1_acc4_id = document.getElementById('d1_4');    // 수익계정 FORM
	var d1_acc5_id = document.getElementById(d1_acc5); if(!no) var d1_acc5_id = document.getElementById('d1_5');////// 비용계정 FORM

	var in_id = document.getElementById(iin);  if(!no) var in_id = form.ina;
	var inc_id = document.getElementById(inc); if(!no) var inc_id = form.inc;
	var out_id = document.getElementById(out); if(!no) var out_id = form.out;
	var exp_id = document.getElementById(exp); if(!no) var exp_id = form.exp;


	if(class2_id.value>0&&class2_id.value<=3) { // 자산, 부채, 자본 항목들 선택 시
		//if(class1_id.value==3) class1_id.options[0].selected=1;
		if(class2_id.value==1){ // 자산을 선택하면
			if(d1_1_id) d1_1_id.style.display='';   // 자산계정과목 보이기
	 		if(d1_2_id)d1_2_id.style.display='none';
	 	 	if(d1_3_id)d1_3_id.style.display='none';
	 	 	if(d1_4_id)d1_4_id.style.display='none';
	 	 	if(d1_5_id)d1_5_id.style.display='none';

		  	d1_acc1_id.disabled=0;  d1_acc1_id.style.display=''; // 자산계정과목 보이기
		  	d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
		  	d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
		  	d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
		  	d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';

		}else if(class2_id.value==2){ // 부채 선택하면
			if(d1_1_id) d1_1_id.style.display='none';
			if(d1_2_id)d1_2_id.style.display='';     // 부채계정과목 보이고
			if(d1_3_id)d1_3_id.style.display='none';
			if(d1_4_id)d1_4_id.style.display='none';
			if(d1_5_id)d1_5_id.style.display='none';

			d1_acc1_id.disabled=1;  d1_acc1_id.style.display='none';
		  	d1_acc2_id.disabled=0;  d1_acc2_id.style.display='';   // 부채계정과목 보이기
		  	d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
		  	d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
		  	d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';

		}else if(class2_id.value==3){ // 자본 선택하면
			if(d1_1_id) d1_1_id.style.display='none';
		  	if(d1_2_id)d1_2_id.style.display='none';
		  	if(d1_3_id)d1_3_id.style.display='';  // 자본계정과목 보이고
		  	if(d1_4_id)d1_4_id.style.display='none';
		  	if(d1_5_id)d1_5_id.style.display='none';

			d1_acc1_id.disabled=1;  d1_acc1_id.style.display='none';
		  	d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
		  	d1_acc3_id.disabled=0;  d1_acc3_id.style.display='';  // 자본계정과목 보이고
		  	d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
		  	d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';
		}

	}else if(class2_id.value==4) { // 수익 항목을 선택하면

		class1_id.options[1].selected=1; // 1번째 셀렉트도 입금을 선택
		in_id.disabled=0; // 입금처 열고
		inc_id.disabled=0; // 입금액 열고
		out_id.disabled=1; // 출금처 닫고
		exp_id.disabled=1; // 출금액 닫고

		if(d1_1_id) d1_1_id.style.display='none';
		if(d1_2_id)d1_2_id.style.display='none';
		if(d1_3_id)d1_3_id.style.display='none';
		if(d1_4_id)d1_4_id.style.display='';  // 수익계정과목 보이고
		if(d1_5_id)d1_5_id.style.display='none';

		d1_acc1_id.disabled=1;  d1_acc1_id.style.display='none';
		d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
		d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
		d1_acc4_id.disabled=0;  d1_acc4_id.style.display='';    // 수익계정과목 보이고
		d1_acc5_id.disabled=1;  d1_acc5_id.style.display='none';

	}else if(class2_id.value==5){ // 비용 항목을 선택하면
		class1_id.options[2].selected=1; // 1번째 셀렉트도 출금을 선택
		in_id.disabled=1; // 입금처 닫고
		inc_id.disabled=1; // 입금액 닫고
		out_id.disabled=0; // 출금처 열고
		exp_id.disabled=0; // 출금액 열고

		if(d1_1_id) d1_1_id.style.display='none';
		if(d1_2_id)d1_2_id.style.display='none';
		if(d1_3_id)d1_3_id.style.display='none';
		if(d1_4_id)d1_4_id.style.display='none';
		if(d1_5_id)d1_5_id.style.display='';  // 비용계정과목 보이고

		d1_acc1_id.disabled=1;  d1_acc1_id.style.display='none';
		d1_acc2_id.disabled=1;  d1_acc2_id.style.display='none';
		d1_acc3_id.disabled=1;  d1_acc3_id.style.display='none';
		d1_acc4_id.disabled=1;  d1_acc4_id.style.display='none';
		d1_acc5_id.disabled=0;  d1_acc5_id.style.display='';   // 비용계정과목 보이고

	}else if(class2_id.value>5){   ///////////////////// 대체관련 항목이면
		class1_id.options[3].selected=1; // 1번째 셀렉트도 대체를 선택
		in_id.disabled=0; // 입금처 열고
		inc_id.disabled=0; // 입금액 열고
		out_id.disabled=0; // 출금처 열고
		exp_id.disabled=0; // 출금액 열고

		if(d1_1_id) d1_1_id.style.display='';
	    if(d1_2_id)d1_2_id.style.display='none';
	    if(d1_3_id)d1_3_id.style.display='none';
	    if(d1_4_id)d1_4_id.style.display='none';
	    if(d1_5_id)d1_5_id.style.display='none';

	    d1_acc1_id.style.disabled=1;
	    d1_acc2_id.style.disabled=1;
	    d1_acc3_id.style.disabled=1;
	    d1_acc4_id.style.disabled=1;
	    d1_acc5_id.style.disabled=1;
	}

	if(class2_id.value==1){
		if(jh_loan_id)jh_loan_id.disabled=0;
	}else{
		if(jh_loan_id)jh_loan_id.disabled=1;// 대여 선택 시 조합대여금 체크박스 열기
		if(jh_loan_id)jh_loan_id.checked=0;
	}
	if(class2_id.value==7)	{
		if(pj_seq_id)pj_seq_id.disabled=false; // 현장 대체 선택 시 현장 선택 열기
	}else{
		if(pj_seq_id)pj_seq_id.options[0].selected=1;
		if(pj_seq_id)pj_seq_id.disabled=true; // 현장 대체 선택 시 현장 선택 닫기
	}
}


/**
 * // 조합대여금 여부 체크박스 체크 시
 * @param  {[type]} no [description]
 * @return {[type]}    [description]
 */
function jh_chk(no){
	var pj_seq_str = "pj_seq_"; // 현장코드
	var pj_seq = pj_seq_str+no;
	var jh_loan_str = "jh_loan_"; // 조합대여 여부
	var jh_loan = jh_loan_str+no;

	var pj_seq_id = document.getElementById(pj_seq);
	var jh_loan_id = document.getElementById(jh_loan);



	if(jh_loan_id.checked===true){
		pj_seq_id.disabled=0;
	}else{
		pj_seq_id.disabled=1;
		pj_seq_id.options[0].selected=1;
	}
}

// Edit 파일 조합 체크박스 체크 시
function edit_jh_chk(){

	var any_jh = document.getElementById('any_jh');
	var is_jh = document.getElementById('is_jh');
	//
	if(is_jh.checked===true){
		any_jh.disabled=0;
	}else{
		any_jh.disabled=1;
		any_jh.options[0].selected=1;
	}
}

// 서브밋 체크
function inout_frm_chk(com){

	var form1 = document.base_frm;

	if(form1.com_sel.value==='0'){
		alert('회사정보를 선택하세요!');
		form1.com_sel.focus();
		return;
	}

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

	for(i=1; i<=10; i++){ // 총 10행 행수만큼 반복

		var d1_acc1 = "d1_acc1_"+i;   // 자산 계정과목
		var d1_acc2 = "d1_acc2_"+i;   // 부채 계정과목
		var d1_acc3 = "d1_acc3_"+i;   // 자본 계정과목
		var d1_acc4 = "d1_acc4_"+i;   // 수익 계정과목
		var d1_acc5 = "d1_acc5_"+i;   // 비용 계정과목
		var d1_acc1_id = document.getElementById(d1_acc1);////// 자산계정 FORM
		var d1_acc2_id = document.getElementById(d1_acc2);    // 부채계정 FORM
		var d1_acc3_id = document.getElementById(d1_acc3);    // 자본계정 FORM
		var d1_acc4_id = document.getElementById(d1_acc4);    // 수익계정 FORM
		var d1_acc5_id = document.getElementById(d1_acc5);////// 비용계정 FORM

		if(eval('form.class1_'+i).value){

			if(eval('form.class2_'+i).value==='7'){
				if(eval('form.pj_seq_'+i).value==='0'){
					alert('전도금을 대체(이체)할 현장(프로젝트)을 선택하여 주십시요!');
					eval('form.pj_seq_'+i).focus();
					return;
				}
			}
			if(eval('form.class2_'+i).value<6){
				if(d1_acc1_id.value==='0'&&d1_acc2_id.value==='0'&&d1_acc3_id.value==='0'&&d1_acc4_id.value==='0'&&d1_acc5_id.value==='0'){
					alert('계정과목을 선택하여 주십시요!');
					return;
				}
			}
			if(eval('form.jh_loan_'+i).checked===true){ // 조합여부 체크박스
				if(eval('form.pj_seq_'+i).value==='0'){ // 조합현장 선택목록
					alert('대여금 또는 사업비를 지급하는 프로젝트를 선택하세요!');
					eval('form.pj_seq_'+i).focus();
					return;
				}
			}
			if(!eval('form.cont_'+i).value){
				alert('적요 항목을 입력하세요!');
				eval('form.cont_'+i).focus();
				return;
			}
			if(eval('form.class1_'+i).value==1){
				if(!eval('form.in_'+i).value){
					alert('입금 계정 항목을 선택하세요!');
					eval('form.in_'+i).focus();
					return;
				}
				if(!eval('form.inc_'+i).value){
					alert('입금 금액을 입력하세요!');
					eval('form.inc_'+i).focus();
					return;
				}
			}
			if(eval('form.class1_'+i).value==2){
				if(!eval('form.out_'+i).value){
					alert('출금 계정 항목을 선택하세요!');
					eval('form.out_'+i).focus();
					return;
				}
				if(!eval('form.exp_'+i).value){
					alert('출금 금액을 입력하세요!');
					eval('form.exp_'+i).focus();
					return;
				}
			}
			if(eval('form.class1_'+i).value==3){ // 대체거래인 경우

				if(!eval('form.in_'+i).value){
					alert('입금 계정 항목을 선택하세요!');
					eval('form.in_'+i).focus();
					return;
				}
				if(!eval('form.inc_'+i).value){
					alert('입금 금액을 입력하세요!');
					eval('form.inc_'+i).focus();
					return;
				}
				if(!eval('form.out_'+i).value){
					alert('출금 계정 항목을 선택하세요!');
					eval('form.out_'+i).focus();
					return;
				}
				var out_val = eval('form.out_'+i).value.split("-");
				if(eval('form.in_'+i).value==out_val[0]){
					alert('대체 거래인 경우 입금계정과 출금계정을 다르게 선택하여 주십시요!');
					eval('form.out_'+i).focus();
					return;
				}
				if(!eval('form.exp_'+i).value){
					alert('출금 금액을 입력하세요!');
					eval('form.exp_'+i).focus();
					return;
				}
			}
		}
	}

	if(confirm('거래내용을 등록하시겠습니까???')==true){
		form.submit();
	}
}

//// 현장 서브밋
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

	if(no==1){	if(nobj[0]<=1 || !obj){	form.char1_1.disabled=1; form.char2_1.disabled=1; form.char1_1.checked=0; form.char2_1.value=''; }else{	form.char1_1.disabled=0;	}	}
	if(no==2){	if(nobj[0]==1 || !obj){	form.char1_2.disabled=1; form.char2_2.disabled=1; form.char1_2.checked=0; form.char2_2.value=''; }else{	form.char1_2.disabled=0;	}	}
	if(no==3){	if(nobj[0]==1 || !obj){	form.char1_3.disabled=1; form.char2_3.disabled=1; form.char1_3.checked=0; form.char2_3.value=''; }else{	form.char1_3.disabled=0;	}	}
	if(no==4){	if(nobj[0]==1 || !obj){	form.char1_4.disabled=1; form.char2_4.disabled=1; form.char1_4.checked=0; form.char2_4.value=''; }else{	form.char1_4.disabled=0;	}	}
	if(no==5){	if(nobj[0]==1 || !obj){	form.char1_5.disabled=1; form.char2_5.disabled=1; form.char1_5.checked=0; form.char2_5.value=''; }else{	form.char1_5.disabled=0;	}	}
	if(no==6){	if(nobj[0]==1 || !obj){	form.char1_6.disabled=1; form.char2_6.disabled=1; form.char1_6.checked=0; form.char2_6.value=''; }else{	form.char1_6.disabled=0;	}	}
	if(no==7){	if(nobj[0]==1 || !obj){	form.char1_7.disabled=1; form.char2_7.disabled=1; form.char1_7.checked=0; form.char2_7.value=''; }else{	form.char1_7.disabled=0;	}	}
	if(no==8){	if(nobj[0]==1 || !obj){	form.char1_8.disabled=1; form.char2_8.disabled=1; form.char1_8.checked=0; form.char2_8.value=''; }else{	form.char1_8.disabled=0;	}	}
	if(no==9){	if(nobj[0]==1 || !obj){	form.char1_9.disabled=1; form.char2_9.disabled=1; form.char1_9.checked=0; form.char2_9.value=''; }else{	form.char1_9.disabled=0;	}	}
	if(no==10){	if(nobj[0]==1 || !obj){	form.char1_10.disabled=1;  form.char2_10.disabled=1; form.char1_10.checked=0; form.char2_10.value='';  }else{	form.char1_10.disabled=0;   }   }
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
