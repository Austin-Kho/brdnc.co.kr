<?php
  for($i=0; $i<count($cont_seq); $i++) :
    // 계약자 데이터 구하기 $cont_seq[$i]
    $contractor = $this->cms_main_model->sql_row(
      " SELECT * FROM cb_cms_sales_contract, cb_cms_sales_contractor
        WHERE pj_seq='$project' AND cont_seq = '$cont_seq[$i]' AND cb_cms_sales_contract.seq = cont_seq ");
    // 이 계약 건 총 수납액 구하기
    $cont_recieve = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS total FROM cb_cms_sales_received WHERE cont_seq ='$cont_seq[$i]' ");
    // 가격 컨디션 구하기
    $ho = explode('-', $contractor->unit_dong_ho)[1];

    $n = strlen($ho)-2;
    if((int)substr($ho, 0, $n) == 1) : $floor_con = 1;
    elseif ((int)substr($ho, 0, $n) == 2) : $floor_con = 2;
    elseif ((int)substr($ho, 0, $n) == 3) : $floor_con = 3;
    elseif ((int)substr($ho, 0, $n) >= 4 && (int)substr($ho, 0, $n) <= 5) : $floor_con = 4;
    elseif ((int)substr($ho, 0, $n) >= 6 && (int)substr($ho, 0, $n) <= 10) : $floor_con = 5;
    elseif ((int)substr($ho, 0, $n) > 10) : $floor_con = 6;
    endif;
    $price = $this->cms_main_model->sql_row(" SELECT * FROM cb_cms_sales_price WHERE pj_seq='$project' AND con_diff_seq='$contractor->cont_diff' AND con_type='$contractor->unit_type' AND con_floor_seq='$floor_con' ");
?>
    <table style="width:100%;">
      <tr>
        <th style="height:50px; margin:auto; text-align:center; " colspan="2"><h2><?php echo $bill_issue->host_name_1; ?></h2></th>
      </tr>
      <tr>
        <td style="font-size:10px;"><?php echo str_replace("|", " ", $bill_issue->address); ?></td>
        <td style="font-size:10px; text-align:right;">Tel. <?php echo $bill_issue->tell_1 ?></td>
      </tr>
    </table>
    <table style="width:100%; font-size:11px;" cellpadding=0; cellspacing=0;>
    	<tr>
            <td style="border-top: 2px solid #000; padding: 8px 0 2px 15px;" width="105px;">문서번호 :</td>
            <td style="border-top: 2px solid #000; padding: 8px 15px 2px; text-align: right; " colspan="2"><?php echo $issue_date; ?></td>
        </tr>
    	<tr>
            <td style="padding: 5px 0 2px 15px;">수 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;신 :</td>
            <td style="padding: 5px 0 2px; font-size:12px; "><?php echo $contractor->contractor." 님"; ?></td><td></td>
        </tr>
    	<tr>
            <td style="padding: 5px 0 2px 15px;">참 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;조 :</td><td></td><td></td>
        </tr>
        <tr>
            <td style="padding: 2px 0  8px 15px; border-bottom: 2xp solid #000;">제 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목 :</td>
            <td style="padding: 2px 0 8px; font-size:14px; border-bottom: 2xp solid #000; " colspan="2"><?php echo $bill_issue->title; ?></td>
        </tr>
    </table>
    <table style="width:100%; font-size:12px;" cellpadding=0; cellspacing=0;>
    	<tr>
        <td style="padding: 5px 15px; height:30px; "><?php echo nl2br($bill_issue->content); ?></td>
      </tr>
    </table>
    <table style="margin-top: 10px;"><tr><td style="font-size: 12px;">■ 계약내용</td></tr></table>
    <table style="width:100%; font-size:11px; border-collapse:collapse;" cellpadding=0; cellspacing=0;>
    	<tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">계약자명</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">계 약 일</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">동 / 호수</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">평형(TYPE)</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">총 분담금액</td>
        </tr>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php echo $contractor->contractor; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php echo $contractor->cont_date; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php echo $contractor->unit_dong_ho; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php echo $contractor->unit_type; ?></td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right; "><?php echo number_format($price->unit_price); ?></td>
        </tr>
    </table>
    <table style="margin-top: 10px;"><tr><td style="font-size: 12px;">■ 금회차 분담금 납부 안내</td></tr></table>
    <table style="width:100%; font-size:11px; border-collapse:collapse;" cellpadding=0; cellspacing=0;>
    	<tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="16%;">납 부 회 차</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="16%;">납 부 기 한</td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:center;" width="16%;">금회 약정 금액</td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:center;" width="16%;">미납부금액</td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:center;" width="16%;">연체료</td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:center;" width="20%;">금회 납부 총액</td>
        </tr>
<?php
    $n = 0; // 초기화
    $paid_sum = 0; // 초기화 - 완납회차까지 약정금액
	foreach ($real_sche as $val) : // 실제 납부회차 만큼 반복
		$val->pay_code;
		$time_payment[$n] = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$contractor->price_seq' AND pay_sche_seq<=$val->pay_code ");
		if($cont_recieve->total>=$time_payment[$n]->payment) $is_paid = $val->pay_code; // 완납 회차 구하기 $is_paid
        if($cont_recieve->total>=$time_payment[$n]->payment) $paid_sum += $time_payment[$n]->payment; // 완납회차까지 약정금 총액 $paid_sum
		$n++;
	endforeach;

  $rn = ($is_paid<$bill_issue->pay_code) ? range($is_paid, $bill_issue->pay_code-1) : 0;  // $is_paid; // 현재 계약자 완납 코드 $bill_issue->pay_code; // 금회 납부 코드 5
  $rep = count($rn)<3 ? 3 : count($rn); // 반복회수-> 범위가 3미만이면 3번 // 그렇지 않다면 실제 필요 반복회수

  $pay_sum = 0; // 약정금 합계 초기화
  $non_paid_sum = 0; // 미납금 합계 초기화
  $late_fee_sum = 0; // 연체료 합계 초기화
  $total_pay_sum = 0; // 금회납부총액 합계 초기화
  $total_pay_sum_1 = 0; // 분담금 총액 초기화
  $total_pay_sum_2 = 0; // 대행비 총액 초기화

  for($x=0; $x<$rep; $x++) :
    $sche_name = ($pay_sche[$rn[$x]]->pay_disc) ? $pay_sche[$rn[$x]]->pay_disc : $pay_sche[$rn[$x]]->pay_name; // 금회 약정회차 이름 구하기
    $pseq = $pay_sche[$rn[$x]]->pay_code;
    $pay = $this->cms_main_model->sql_row(" SELECT payment FROM cb_cms_sales_payment WHERE price_seq='$contractor->price_seq' AND pay_sche_seq='$pseq' "); // 금회 약정금 구하기
    $pay_sum += $pay->payment;
    // 납부 기한 구하기
    if($pay_sche[$rn[$x]]->pay_time == 1) $due_date = $contractor->cont_date;
    if($pay_sche[$rn[$x]]->pay_time == 2) $due_date = date('Y-m-d', strtotime($contractor->cont_date."+1months"));
    if($pay_sche[$rn[$x]]->pay_time >= 3) $due_date = ($pay_sche[$rn[$x]]->pay_due_date!=='0000-00-00') ? $pay_sche[$rn[$x]]->pay_due_date : "";

    // 미납1회차 해당 약정금액에서 완납회차까지 총납부금액에서 총 약정금액을 뺀 차액을 반영 한 미납액 계산한다.
    $non_paid = ($x==0) ? ($pay->payment-($cont_recieve->total-$paid_sum)) : $pay->payment; // (금회약정금 - (총 납부액-총 약정금))
    $non_paid_sum += $non_paid;
    $late_fee = 0; // // 연체료 // 추후 필요 시 수식 입력
    $late_fee_sum += $late_fee;
    $total_pay = $non_paid+$late_fee; // 금회납부총액
    $total_pay_sum += $total_pay; // 금회납부총액 합계

    $total_pay_1 = ($pay_sche[$rn[$x]]->pay_code != 2 && $pay_sche[$rn[$x]]->pay_code != 4)  ? $non_paid+$late_fee : 0; // 금회납부총액 중 분담금
    $total_pay_sum_1 += $total_pay_1; // 금회납부총액 중 분담금 합계

    $total_pay_2 = ($pay_sche[$rn[$x]]->pay_code == 2 or $pay_sche[$rn[$x]]->pay_code == 4)  ? $non_paid+$late_fee : 0; // 금회납부총액 중 업무대행비
    $total_pay_sum_2 += $total_pay_2; // 금회납부총액 합계 중 업무대행비
?>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;"><?php echo $sche_name; ?></td><!--납 부 회 차-->
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;"><?php if(isset($sche_name)) echo $due_date; ?></td><!--납 부 기 한-->
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if(isset($sche_name)) {if($pay->payment==0) echo '-'; else echo number_format($pay->payment);}else{echo '&nbsp;';} ?></td><!--금 회 약 정-->
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if(isset($sche_name)) {if($non_paid==0) echo '-'; else echo number_format($non_paid);}else{echo '&nbsp;';} ?></td><!--미 납 금 액-->
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if(isset($sche_name)) {if($late_fee==0) echo '-'; else echo number_format($late_fee);}else{echo '&nbsp;';} ?></td><!--연 체 금 액-->
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if(isset($sche_name)) {if($total_pay==0) echo '-'; else echo number_format($total_pay);}else{echo '&nbsp;';} ?></td><!--납 부 총 액-->
        </tr>
<?php endfor; ?>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" colspan="2">합 계</td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if($pay_sum==0) echo '-'; else echo number_format($pay_sum); ?></td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if($non_paid_sum==0) echo '-'; else echo number_format($non_paid_sum); ?></td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if($late_fee_sum==0) echo '-'; else echo number_format($late_fee_sum); ?></td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if($total_pay_sum==0) echo '-'; else echo number_format($total_pay_sum);?></td>
        </tr>
    </table>
    <table style="margin-top: 10px;"><tr><td style="font-size: 12px;">■ 계좌번호 안내</td></tr></table>
    <table style="width:100%; font-size:11px; border-collapse:collapse;" cellpadding=0; cellspacing=0;>
    	<tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">구 분</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">개설은행명</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">예 금 주</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;" colspan="2">계 좌 번 호</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="20%;">입금하실 금액</td>
        </tr>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;"><?php if(isset($bill_issue->bank_acc_2)) echo "조합 분담금"; else echo "분 양 대 금"; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php echo explode('+', $bill_issue->bank_acc_1)[0]; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php echo $bill_issue->acc_host_1; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; " colspan="2"><?php echo explode('+', $bill_issue->bank_acc_1)[1]; ?></td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if($total_pay_sum_1==0) echo '-'; else echo number_format($total_pay_sum_1); ?></td>
        </tr>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;"><?php if(isset($bill_issue->bank_acc_2)) echo "업무 대행비"; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php if(isset($bill_issue->bank_acc_2)) echo explode('+', $bill_issue->bank_acc_2)[0]; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; "><?php if(isset($bill_issue->bank_acc_2)) echo $bill_issue->acc_host_2; ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center; " colspan="2"><?php if(isset($bill_issue->bank_acc_2)) echo explode('+', $bill_issue->bank_acc_2)[1]; ?></td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if($total_pay_sum_2==0) echo '-'; else echo number_format($total_pay_sum_2); ?></td>
        </tr>
        <tr>
            <td style="padding: 5px 10px; border:1px solid black;" colspan="4">
                ※ 계좌 입금 시 반드시 계약자명과 동호수를 표기하여 납부하여 주시기 바랍니다. <br /> &nbsp;&nbsp;&nbsp;&nbsp;예) 홍길동901-101 or 홍길동901101
            </td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;">합 계</td>
            <td style="padding: 3px 10px; border:1px solid black; text-align:right;"><?php if($total_pay_sum==0) echo '-'; else echo number_format($total_pay_sum);?></td>
        </tr>
    </table>

    <table style="margin-top: 10px;"><tr><td style="font-size: 12px;">■ 조합 분담금 약정 내역 및 납입내역</td></tr></table>
    <table style="width:100%; font-size:11px; border-collapse:collapse;" cellpadding=0; cellspacing=0;>
    	<tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="11%;" rowspan="3">구 분</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="22%;" colspan="2">약 정 사 항</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="60%;" colspan="7">수 납 사 항</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="5%;" rowspan="3">비고</td>
        </tr>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="11%;" rowspan="2">납부기한</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="11%;" rowspan="2">금 액</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="22%;" colspan="2">수납원금</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="14%;" colspan="2">할인료</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="14%;" colspan="2">연체료</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="12%;" rowspan="2">실 수납금액</td>
        </tr>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="11%;">일자</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="11%;">금액</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="4%;">일수</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="10%;">금액</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="4%;">일수</td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;" width="10%;">금액</td>
        </tr>

        <tr>
<?php $tdheight =( 286-(($rep-3)*20)).'px'; ?>
            <td style="padding: 5px 0px; border:1px solid black; height: <?php echo $tdheight; ?>; vertical-align: top;" colspan="11">
              <table width="100%" cellpadding="0" cellspacing="0">
<?php
  $time_cum = 0; //계약건당 약정금 누계 초기화
  $bool = null; // 초기화 - 약정금이 납부액보다 클때 1번만 계산하기 위해
  $total_prepay = 0; // 초기화 누적 선납일수
  $total_delay = 0; // 누적 연체일수 초기화
  $total_discount = 0; // 누적할인금액 초기화
  $total_late_fee = 0; // 누적 연체금액 초기화
  $last_total_paid = 0; // 건당 총 수납액 초기화

  foreach ($pay_sche as $lt) :

    $pay_name = ($lt->pay_disc!=='') ? $lt->pay_disc : $lt->pay_name;
    if($lt->pay_time==1) $due_date = $contractor->cont_date;
    if($lt->pay_time==2) $due_date = date('Y-m-d', strtotime($contractor->cont_date."+1months"));
    if($lt->pay_time>2) $due_date = ($lt->pay_due_date!=='0000-00-00') ? $lt->pay_due_date : "";
    // 약정금액
    $pay = $this->cms_main_model->sql_row(" SELECT payment FROM cb_cms_sales_payment WHERE price_seq='$price->seq' AND pay_sche_seq='$lt->seq' ");
    // 납입금액
	$paid = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS time_paid, MAX(paid_date) AS paid_date FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$contractor->seq' AND pay_sche_code='$lt->pay_code' ");

    $prepay = ($paid->time_paid!==null) ? '-' : ''; // 선납일 수 추후 필요 시 수식 적용
    $discount = ($paid->time_paid!==null) ? '-' : ''; //할인료 추후 필요 시 수식 적용
    $delay = ($paid->time_paid!==null) ? '-' : ''; // 지연(연체)일 수 추후 필요 시 수식 적용
    $late_fee = ($paid->time_paid!==null) ? '-' : ''; // 연체료 추후 필요 시 수식 적용
    $time_total_paid = ($paid->time_paid-$discount+$late_fee!==0) ? number_format($paid->time_paid-$discount+$late_fee) : "";

    // 합계 함수들
    $total_prepay += (int)$prepay; // 누적선납일수
    $total_discount += (int)$discount; // 누적 할인 금액
    $total_delay += (int)$delay; // 누적연체일수
    $total_late_fee += (int)$late_fee; // 누적 연체 금액
    $last_total_paid += (int)$paid->time_paid-$discount+$late_fee; // 누적 수납금액

    $time_cum += $pay->payment; // 회차별 약정액 누계;
    $out_payment = ((int)$cont_recieve->total>=(int)$time_cum) ? $pay->payment : ""; // 완납회차 약정금액

    if($cont_recieve->total<$time_cum){ // 완납회차 후 칸 띄우기
      if(empty($bool)):
        for($k=0; $k<5; $k++):
          echo "<tr><td colspan='11'>&nbsp;</td></tr>";
        endfor;
        $bool = true;
      endif;
    }
?>
                <tr>
                  <td style="text-align:center; " width="120"><?php echo $pay_name; ?></td>
                  <td style="text-align:center; " width="120"><?php echo $due_date; ?></td>
                  <td style="text-align:right; " width="120"><?php echo number_format($pay->payment); ?></td>
                  <td style="text-align:right; padding-right:1px;" width="110"><?php echo $paid->paid_date; ?></td>
                  <td style="text-align:right; " width="110"><?php echo number_format($out_payment); ?></td>
                  <td style="text-align:right;" width="26"><?php echo $prepay; ?></td>
                  <td style="padding-right:5px; text-align:right;" width="64"><?php echo $discount; ?></td>
                  <td style="text-align:right;" width="26"><?php echo $delay; ?></td>
                  <td style="padding-right:10px; text-align:right;" width="64"><?php echo $late_fee; ?></td>
                  <td style="text-align:right;" width="120"><?php echo $time_total_paid; ?></td>
                  <td width="36"></td>
                </tr>
<?php

endforeach;
?>
              </table>
              <!-- <table style="height:100%; background-color:red;">
                  <tr>
                      <td valign="bottom">
                          <span style="font-size: 10px;"><?php if(isset($bill_issue->host_name_2)) echo "※ 미 도래한 납부회차의 납부기한은 예정사항이며 추후 변동 시 변경고지될 수 있습니다." ?><span>
                      </td>
                  </tr>
              </table> -->
            </td>
        </tr>
        <tr>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;">합 계</td>
            <td style="padding: 3px 5px; border:1px solid black; text-align:right; " colspan="2"><?php echo number_format($price->unit_price); ?></td>
            <td style="padding: 3px 5px; border:1px solid black; text-align:right; " colspan="2"><?php echo number_format($cont_recieve->total); ?></td>
            <td style="padding: 3px 5px; border:1px solid black; text-align:right;"><?php if($total_prepay>0) echo $total_prepay; else echo '-'; ?></td>
            <td style="padding: 3px 5px; border:1px solid black; text-align:right;"><?php if($total_discount>0) echo number_format($total_discount); else echo '-'; ?></td>
            <td style="padding: 3px 5px; border:1px solid black; text-align:right;"><?php if($total_delay>0) echo $total_delay; else echo '-'; ?></td>
            <td style="padding: 3px 5px; border:1px solid black; text-align:right;"><?php if($total_late_fee>0) echo number_format($total_late_fee); else echo '-'; ?></td>
            <td style="padding: 3px 5px; border:1px solid black; text-align:right; "><?php echo number_format($last_total_paid); ?></td>
            <td style="padding: 3px 0px; border:1px solid black; text-align:center;"></td>
        </tr>
    </table>
    <table style="width:100%; font-size:10px;" cellpadding=0; cellspacing=0;>
    	<tr>
<?php if(isset($bill_issue->host_name_2)) : ?>
            <td style="padding: 3px 0 0 5px; font-size: 11px;" width="10%">업무대행사</td>
            <td style="padding: 3px 0px; font-size: 12px; " width="20%"><?php echo $bill_issue->host_name_2; ?></td>
<?php endif; ?>
            <td style="padding: 3px 0px; font-size: 12px;" width="10%">문의전화 :</td>
            <td style="padding: 3px 0px; font-size: 12px; " width="15%"><?php if(isset($bill_issue->tell_2)) echo $bill_issue->tell_2; else $bill_issue->tell_1; ?></td>
            <td style="padding: 3px 5px; text-align:right; font-size: 15px; " width="45%"><?php echo $bill_issue->host_name_1; ?></td>
        </tr>
    </table>
<?php endfor; ?>
