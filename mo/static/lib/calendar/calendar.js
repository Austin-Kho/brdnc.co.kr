//**********************************************************************************************************//
 //** 프로그램 설명 : createElement을 이용한 웹표준(IE, 크롬, 파폭, 사파리, 오페라 호환) 달력 출력 자바스크립트. **//
 //*********************************************************************************************************//


var g_target;
var g_cal_Day;     // 폼에 날짜 값이 없을 경우 '오늘' 또는 날짜 값이 있을 경우 '해당 날짜' 의 값을 가지는 변수
var g_cssAddr = "/bt/static/lib/calendar/calendar.css";

var back_url = "/bt/static/img/to_left.jpg";
var back_url_ = "/bt/static/img/to_left_.jpg";
var next_url = "/bt/static/img/to_right.jpg";
var next_url_ = "/bt/static/img/to_right_.jpg";

var sel_width=184;                                                     //div 넓이

function slideCalScroll(what) {
	var cal = document.getElementById("calendar");

	if(cal!=null){
		if (cal.heightPos==null || (cal.isDone && cal.isOn==false)) {   //div 오픈 크기 지정 (cal.heightPos 가 없음 - 첫클릭 이거나 / (cal.isDone-- 이 있고 cal.isOn 설정 크기에 도달하면 트루...진행중일때는 펄스) 이면....
			cal.isDone = false;                      // 이스돈은 꺼져 있는 상태로 설정하고
			cal.heightPos = 1;                      // 현재 높이는 1px 로 설정하고
			cal.heightTo = sel_height;           // 최대 목표 높이를 설정한 높이로 하고
			cal.widthPos = 1;                       // 현재 넓이는 1px 로 설정하고
			cal.widthTo = sel_width;            // 최대 목표 넓이를 설정한 넓이로 하라
		} else if (cal.isDone && cal.isOn){                                    //div 닫기 닫힐때 크기 지정
			cal.isDone = false;
			cal.heightTo = 1;
			cal.widthTo = 1;
		}
		if(Math.abs(cal.heightTo-cal.heightPos) >1){ // 절대값(cal.heightTo - cal.heightPos) 가 1보다 크면 // 즉 설정한 크기보다 현재 디브가 작으면
			cal.heightPos+=(cal.heightTo-cal.heightPos)/5;
			cal.style.height=cal.heightPos+"px";
			cal.widthPos+=(cal.widthTo-cal.widthPos)/6;
			cal.style.width=cal.widthPos+"px";
			startCateScrollScroll();
		} else {  // 절대값(cal.heightTo - cal.heightPos) 가 1보다 작으면  // 즉 설정한 크기보다 1px 작거나 같아지면 ---- 설정한 크기가 다 되었다면.....
			if (cal.heightTo==sel_height) { // 다 커졌으면 ..
				cal.isOn = true;                     // 이스온은 트루 --- 같아졌을 땐 켜고
			} else {                                    // 그렇지 않으면
				cal.isOn = false;                   // 이스온은 펄스 --- 1px 작을 땐 아직 켜지말고
			}
			cal.heightPos = cal.heightTo;                    // 현재 높이를 설정한 높이로 동일하게 하고
			cal.style.height = cal.heightPos + "px";     // cal 의 높이를 설정한 크기 px 로 하고
			cal.widthPos = cal.widthTo;                      // 현재 넓이를 설정한 넓이로 동일하게 하고
			cal.style.width = cal.widthPos + "px";          // cal 의 넓이를 설정한 넓이 px 로 하고
			cal.isDone = true;                                      // 이스돈을 켜라  -- (설정한 크기로 변경 완료를 선언하라)
			if(cal.heightTo==1&&cal.isDone==true){ // 디브의 축소 이벤트가 완료되면
				var parent = cal.parentNode;
				var grandp = parent.parentNode;
				grandp.removeChild(cal.parentNode);  // 지정한 디브를 소멸하라
			}
		}
	}
}
function startCateScrollScroll() {
    setTimeout("slideCalScroll()", 5);                                 //div 내려오는 시간 (1/1,000 초 단위)
}
/////////////////////////////////////////////////////////////////////////
function cal_add(frm, obj){ // 달력 호출 함수
	var pos = frm.parentNode; // 새로 생성할 디브의 부모 노드
	var cal = document.getElementById('calendar'); // 생성된 달력 디브

	if(cal!=null){ // 달력 디브가 생성 되어 있으면
		var parent = cal.parentNode;            // 그 부모노드는 페어런트이고
		var grandp = parent.parentNode;     // 그 부모의 부모 노드는 그랜드피이다..
	}
	if(obj!=null&&(grandp==pos)){ // 이미지 버튼 클릭이면서  그 자리가 디브가 있는 자리이면..
		if(cal!=null){                        // 그러면서 달력이 있다면
			cal_del();                        // 달력 닫기 함수를 실행하고----애니실행 필요
			return;                            // 함수를 빠져나간다...
		}
	}else if(obj==null&&((grandp==pos))){  // 그렇지 않고 폼 클릭이면서 그자리 그대로이면
		if(cal!=null){                           // 그러면서 달력이 있으면
			return;                                // 그냥 함수를 빠져나간다...
		}
	}
	if(cal!=null) {	grandp.removeChild(cal.parentNode);	}  // 새 디브를 열기 전에 기존에 열려있는 디브가 있으면 애니 효과 없이 그냥 닫고....

	var newdiv =document.createElement("div");     // newdiv 라는 변수에 div 엘리먼트 생성소스를 할당...(div)
	pos.appendChild(newdiv); // 폼의 부모 노드에 newdiv 엘리먼트를 생성........//

	var content = "<link type='text/css' rel='stylesheet' href='"+g_cssAddr+"'><div id='calendar' style='position:absolute; height:1px; width:1px; padding:3px; overflow: hidden; border:2px solid #768ECD; background-color:white; margin-top:1px; z-index: 100000;' onclick='event.cancelBubble=true'></div>";
	newdiv.innerHTML = content; // newdiv 엘리면트 안에 content HTML 소스(calendar - div) 를 추가 생성 하고

	g_target   = frm;
	var l_now = frm.value.split('-'); // 현재 폼의 값을 가져와서 '-' 로 분리한 후 배열로 저장

	if (l_now.length == 3 && frm.value.length == 10)	{ // 폼의 값이 배열이 3개이고 값의 글자 수가 10개 ('0000-00-00'의 형식) 이면
	    if(checkNumber(l_now[0] + l_now[1] + l_now[2]) == true){ // checkNumber 함수를 실행해서 true 값이 나올경우
	        g_cal_Day = frm.value;                                                       // g_cal_Day 변수에 폼 값을 대입하고
	        Show_cal(l_now[0], l_now[1], l_now[2]);                         // Show_cal 함수를 폼 값(년, 월, 일)로 실행하라
	    }
	}
	else {                                // 현재 폼 값이 없으면
		l_now = new Date();          // 폼 값 대신 '오늘' 날짜를 호출 하여 다음 함수들을 실행하라
		g_cal_Day = l_now.getFullYear() + "-" + day2(l_now.getMonth()+1) + "-" + day2(l_now.getDate()); // g_cal_Day 변수에 '오늘'을 대입하고
		Show_cal(l_now.getFullYear(), l_now.getMonth()+1, l_now.getDate());                                       // Show_cal 함수를 '오늘'(년, 월, 일)로 실행하라
	}
	slideCalScroll();                  // 슬라이드 칼 스크롤 함수를 실행....
}

function cal_del(){ // 달력 소멸 함수
	var cal = document.getElementById('calendar');
	if(cal!=null){
		slideCalScroll();
	}
}
/////////////////////////////////////////////////////////////////////////


function checkNumber(frm){ // ?? 날짜 입력 폼 의 렝스가 0이면...리턴펄스 그리고 ....???
    var l_str = frm;
    if(l_str.length == 0)
        return false;

    for(var i=0; i < l_str.length; i++) {
        if(!('0' <= l_str.charAt(i) && l_str.charAt(i) <= '9'))
            return false;
    }
    return true;
}

function Calendar_Click(arg_e){ // 날짜 클릭 시 입력폼에 값을 푸쉬하고 자신(크리에이트브 디브로 생성된 디브)은 하이드
	g_cal_Day = arg_e.title;
	if (g_cal_Day.length == 10)
		g_target.value = g_cal_Day;

	// document.body.removeChild(g_oPopup); // g_oPopup.hide();
	cal_del();
}

function day2(arg_d){ // 월일 ???
	var l_str = new String();

	if (parseInt(arg_d) < 10)
		l_str = "0" + parseInt(arg_d);
	else
		l_str = "" + parseInt(arg_d);
	return l_str;
}


function fnChangeYearD(arg_sYear,arg_sMonth,arg_sDay){ // 년도가 바뀌면.... (달력)내용을 다시 출력
	Show_cal(arg_sYear, arg_sMonth, arg_sDay);
}


function Show_cal(arg_sYear, arg_sMonth, arg_sDay) {  // 달력 내용을 출력
	var cal = document.getElementById('calendar'); // 생성된 달력 디브
	if(arg_sYear%4==0){
		var l_intaMonths_day = new Array(0,31,29,31,30,31,30,31,31,30,31,30,31);
	}else{
		var l_intaMonths_day = new Array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	}

	var l_straMonth_Val  = new Array("01월","02월","03월","04월","05월","06월","07월","08월","09월","10월","11월","12월");

	var l_intThisYear  = new Number();
	var l_intThisMonth = new Number();
	var l_intThisDay   = new Number();
	l_intThisYear      = parseInt(arg_sYear,10);
	l_intThisMonth     = parseInt(arg_sMonth,10);
	l_intThisDay       = parseInt(arg_sDay,10);

	var l_datToday = new Date();
	if (l_intThisYear == 0)
	    l_intThisYear = l_datToday.getFullYear();
	if (l_intThisMonth == 0)
	    l_intThisMonth = parseInt(l_datToday.getMonth(),10)+1;
	if (l_intThisDay == 0)
	    l_intThisDay = l_datToday.getDate();

	switch(l_intThisMonth){
		case 1:
				l_intPrevYear  = l_intThisYear -1;
				l_intPrevMonth = 12;
				l_intNextYear  = l_intThisYear;
				l_intNextMonth = 2;
				break;
		case 12:
				l_intPrevYear  = l_intThisYear;
				l_intPrevMonth = 11;
				l_intNextYear  = l_intThisYear + 1;
				l_intNextMonth = 1;
				break;
		default:
				l_intPrevYear  = l_intThisYear;
				l_intPrevMonth = parseInt(l_intThisMonth,10) - 1;
				l_intNextYear  = l_intThisYear;
				l_intNextMonth = parseInt(l_intThisMonth,10) + 1;
				break;
	}//close switch

	l_datFirstDay = new Date(l_intThisYear, l_intThisMonth-1, 1);
	l_intFirstWeekday = l_datFirstDay.getDay();

	if ((l_intThisYear % 4) == 0)
		if ((l_intThisYear % 100) == 0)
			if ((l_intThisYear % 400) == 0)
				l_intaMonths_day[2] = 29;
			else
				l_intaMonths_day[2] = 29;

	l_firstPrintDay = 1;
	l_intLastDay = l_intaMonths_day[l_intThisMonth];

	var l_strCal_HTML = "<form name='calendar'>";
	l_strCal_HTML += "<div style='width:"+sel_width+"px;'><table id='Cal_Table' border='0' cellspacing='0' cellpadding='0' style='width:"+(sel_width-9)+"px'>";
	l_strCal_HTML += "<tr><td colspan=7 valign='top'><table id='Cal_Header' border='0' cellspacing='0' cellpadding='0' style='width:"+(sel_width-9)+"px'><tr><td>";
	l_strCal_HTML += "<a style='cursor:pointer;' OnClick='parent.Show_cal("+l_intPrevYear+","+l_intPrevMonth+","+l_intThisDay+");'><img src="+back_url+" name=img1 alt=이전달 border=0 onmouseover=this.src='"+back_url_+"' onmouseout=this.src='"+back_url+"'></a></td><td> ";
	l_strCal_HTML += "<select name='selYear' id='Cal_Select' OnChange='parent.fnChangeYearD(this.form.selYear.value, this.form.selMonth.value, "+l_intThisDay+")';>";
	for (var l_optYear=(l_intThisYear-3); l_optYear<(l_intThisYear+4); l_optYear++)
	{
		l_strCal_HTML += "<option value='"+l_optYear+"' ";
		if (l_optYear == l_intThisYear)
		    l_strCal_HTML += " selected>";
		else
		    l_strCal_HTML += ">";
		l_strCal_HTML += l_optYear+"</option>";
	}
	l_strCal_HTML += "</select>&nbsp;";
	l_strCal_HTML += "<select name='selMonth' id='Cal_Select' OnChange='parent.fnChangeYearD(this.form.selYear.value, this.form.selMonth.value, "+l_intThisDay+")';>";
	for (var i=1; i<13; i++)
	{
		l_strCal_HTML += "<option value='"+l_straMonth_Val[i-1]+"' ";
		if (l_intThisMonth == parseInt(l_straMonth_Val[i-1],10))
		    l_strCal_HTML += " selected>";
		else
		    l_strCal_HTML += ">";
		l_strCal_HTML += l_straMonth_Val[i-1]+"</option>";
	}
	l_strCal_HTML += "</select></td><td> ";
	l_strCal_HTML += "<a style='cursor:pointer;' OnClick='parent.Show_cal("+l_intNextYear+","+l_intNextMonth+","+l_intThisDay+");'><img src='"+next_url+"' name='img1' alt='다음달' border='0' onmouseover=this.src='"+next_url_+"' onmouseout=this.src='"+next_url+"'></a></td></tr></table>";


	l_strCal_HTML += "</td></tr><tr id='Cal_Week'>";
	l_strCal_HTML += "	<td><font color='#CE2D24'>일</font></td>";
	l_strCal_HTML += "	<td>월</td>";
	l_strCal_HTML += "	<td>화</td>";
	l_strCal_HTML += "	<td>수</td>";
	l_strCal_HTML += "	<td>목</td>";
	l_strCal_HTML += "	<td>금</td>";
	l_strCal_HTML += "	<td>토</td>";
	l_strCal_HTML += "</tr>";

	for (l_intLoopWeek=1; l_intLoopWeek <= 6; l_intLoopWeek++) {
		l_strCal_HTML += "<tr id='Cal_Day'>"
		for (l_intLoopDay=1; l_intLoopDay <= 7; l_intLoopDay++) {
			if (l_intFirstWeekday > 0) {
				l_strCal_HTML += "<td style='padding:2px'><table width='100%' height='18' cellspacing='0' cellpadding='0'><tr align='center' valign='middle'><td class='Cal_EmptyDay'>";
				l_intFirstWeekday--;
			}
			else {
				if (l_firstPrintDay > l_intLastDay)
					l_strCal_HTML += "<td style='padding:2px'><table width='100%' height='18' cellspacing='0' cellpadding='0'><tr align='center' valign='middle'><td class='Cal_Empty'>";
				else {
					var l_strID = "";
					var l_strClass = "";
					if (l_intThisDay==l_firstPrintDay && l_intThisMonth==parseInt(g_cal_Day.split('-')[1], 10) && l_intThisYear==parseInt(g_cal_Day.split('-')[0], 10))
				        l_strID = "Cal_Today";

					switch(l_intLoopDay) {
					    case 1:
					        l_strClass = "Cal_Sunday";
						    break;
					    case 7:
						    l_strClass = "Cal_Saturday";
						    break;
					    default:
						    l_strClass = "Cal_Weekday";
				  }
					l_strCal_HTML += "<td style='padding:2px'><table width='100%' height='18' cellspacing='0' cellpadding='0'><tr align='center' valign='middle'><td id='" + l_strID + "' class='" + l_strClass + "' onClick='parent.Calendar_Click(this);' title=" + l_intThisYear + "-" + day2(l_intThisMonth).toString() + "-" + day2(l_firstPrintDay).toString() + " onmouseover=\"this.id='Cal_MouseOver'\" onmouseout=\"this.id='" + l_strID + "'\">" + l_firstPrintDay;
				}
				l_firstPrintDay++;
			}
			l_strCal_HTML += "</td></tr></table></td>";
		}
		l_strCal_HTML += "</tr>";

		if (l_firstPrintDay > l_intLastDay)
			break;
	}
	l_strCal_HTML += "</table></div></form>";

	cal.innerHTML =  l_strCal_HTML;

	var l_calHeight;
    switch(l_intLoopWeek){
        case 4:
	        l_calHeight = 153;
	        break;
        case 6:
	        l_calHeight = 193;
	        break;
	    default:
	        l_calHeight = 171;
    }
	cal.style.height = l_calHeight+'px';
	sel_height = l_calHeight;
}
//**********************************************************************************************************//
 //** 프로그램 설명 : createElement을 이용한 웹표준(IE, 크롬, 파폭, 사파리, 오페라 호환) 달력 출력 자바스크립트. **//
 //*********************************************************************************************************//
