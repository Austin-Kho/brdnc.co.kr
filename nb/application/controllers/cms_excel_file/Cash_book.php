<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_book extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
		$this->load->model('cms_m4_model'); //모델 파일 로드
		$this->load->helper('cms_cut_string');
	}

	/**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->excel_file();
	}

	public function excel_file(){

    Header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
    Header("Content-Disposition: attachment; filename=cash_book.xls");
    Header("Content-Description: PHP7 Generated Data" );
    Header("Pragma: no-cache");
    Header("Expires: 0");

		// 회사명 : 회사이름이 등록되어 있지 않으면 '회사'로 표기
    $com_title = ($this->cms_main_model->select_data_row('cb_cms_com_info', array(1=>1))) ? $this->cms_main_model->select_data_row('cb_cms_com_info', array(1=>1)) : "회사";

    // 테이블 상단 만들기
    echo $EXCEL_STR1 = "
    <table border='1'>
    <tr align='center' height='45'>
      <td colspan='12' style='font-size:15pt; text-align:center;'><b>".$com_title->co_name." 자금 출납부</b></td>
    </tr>
    <tr align='center' height='35' style='font-size:9pt;'>
			<td width='80' bgcolor='#EAEAEA'>거래일자</td>
			<td width='80' bgcolor='#EAEAEA'> 구 분</td>
			<td width='100' bgcolor='#EAEAEA'> 계정과목</td>
			<td width='250' bgcolor='#EAEAEA'>적 요</td>
			<td width='100' bgcolor='#EAEAEA'>거 래 처</td>
			<td width='100' bgcolor='#EAEAEA'>입금처</td>
			<td width='100' bgcolor='#EAEAEA'>입금금액</td>
			<td width='100' bgcolor='#EAEAEA'>지출처</td>
			<td width='100' bgcolor='#EAEAEA'>지출금액</td>
			<td width='100' bgcolor='#EAEAEA'>현금시재</td>
			<td width='100' bgcolor='#EAEAEA'>예금잔고</td>
			<td width='100' bgcolor='#EAEAEA'>비 고</td>
	</tr>
    ";
		$add_where = $this->input->get('add_where');
		// $s_date = $this->input->get('s_date');
		// $e_date = $this->input->get('e_date');
		// $sc = $this->input->get('sc');
		// $where = ' WHERE '.$add_where;
    //
		// $add_start = (!$s_date) ? " AND deal_date<'2015-05-01' " : " AND deal_date<'$s_date' "; // 시작일이 있으면 시작일 이후 없으면 2015-05-01부터 시작
		// $add_end = (!$e_date) ? "" : " and deal_date<='$e_date' ";

		$table = ' cb_cms_capital_cash_book, cb_cms_capital_bank_account ';

		$cash_data = $this->cms_m4_model->cash_book_list($table, $where, '', '', 'num', '');

		// foreach ($cash_data as $lt => $value) :
			// if($sc==0):
			// 	$i=0;
			// 	if($i==0) :
			// 		// 현금 최초 시재 구한다.
			// 		$c_in_qry = " SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE in_acc = '1' AND deal_date < '".$rows1[deal_date]."'" ;
			// 		$c_in_row = $this->cms_main_model->sql_row($c_in_qry);
      //
			// 		$c_ex_qry = " SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE out_acc = '1' AND deal_date < '".$rows1[deal_date]."'";
			// 		$c_ex_row = $this->cms_main_model->sql_row($c_ex_qry);
      //
			// 		$fcash = $c_in_row->inc-$c_ex_row->exp;
      //
			// 		// 예금 최초 시재 구한다.
			// 		$b_in_qry = " SELECT SUM(inc) AS inc FROM cms_capital_cash_book WHERE in_acc > '1' AND deal_date < '".$rows1[deal_date]."'";
			// 		$b_in_row = $this->cms_main_model->sql_row($b_in_qry);
      //
			// 		$b_ex_qry = " SELECT SUM(exp) AS exp FROM cms_capital_cash_book WHERE out_acc > '1' AND deal_date < '".$rows1[deal_date]."'";
			// 		$b_ex_row = $this->cms_main_model->sql_row($b_ex_qry);
      //
			// 		$fbank = $b_in_row->inc-$b_ex_row->exp;
			// 		$cash_hand = '=SUMIF(F3,"현금",G3)-SUMIF(H3,"현금",I3)+'.$fcash;
			// 		$bank_balance = '=SUMIF(F3,"<>현금",G3)-SUMIF(H3,"<>현금",I3)+'.$fbank;
			// 	elseif($i>0) :
			// 		$cash_hand = '=J'.($i+2).'+SUMIF(F'.($i+3).',"현금",G'.($i+3).')-SUMIF(H'.($i+3).',"현금",I'.($i+3).')';
			// 		$bank_balance = '=K'.($i+2).'+SUMIF(F'.($i+3).',"<>현금",G'.($i+3).')-SUMIF(H'.($i+3).',"<>현금",I'.($i+3).')';
			// 	endif;
			// 	$i++;
			// endif;
			// switch ($lt->class1) :
			// 	case '1': $cla1="<font color='#0066ff'>[입금]</font>"; break;
			// 	case '2': $cla1="<font color='#ff3333'>[출금]</font>"; break;
			// 	case '3': $cla1="<font color='#669900'>[대체]</font>"; break;
			// endswitch;
      //
			// switch ($lt->class2) :
			// 	case '1': $cla2="<font color='#0066ff'>[자산]</font>"; break;
			// 	case '2': $cla2="<font color='#6600ff'>[부채]</font>"; break;
			// 	case '3': $cla2="<font color='#0066ff'>[자본]</font>"; break;
			// 	case '4': $cla2="<font color='#009900'>[수익]</font>"; break;
			// 	case '5': $cla2="<font color='#ff3333'>[비용]</font>"; break;
			// 	case '6': $cla2="<font color='#009900'>[본사]</font>"; break;
			// 	case '7': $cla2="<font color='#669900'>[현장]</font>"; break;
			// endswitch;
      //
			// $cla = $cla1."-".$cla2;
			// if($lt->account==""){ $account = "-"; }else{ $account = "[".$lt->account."]"; }
			// if($lt->inc==0 or ($lt->class1==3&&$lt->out_acc==$lt->no)){ $inc=""; }else{ $inc=number_format($lt->inc); }
			// if($lt->exp==0 or ($lt->class1==3&&$lt->in_acc==$lt->no)){ $exp=""; }else{ $exp=number_format($lt->exp); }
			// if($lt->acc) {$acc=$lt->acc;}else{$acc="-";}
			// if($lt->in_acc==0 or ($lt->class1==3&&$lt->out_acc==$lt->no)){ $in_acc=""; }else{ $in_acc=$lt->name; }
			// if($lt->out_acc==0 or ($lt->class1==3&&$lt->in_acc==$lt->no)){ $out_acc=""; }else{ $out_acc=$lt->name; }

			echo $EXCEL_STR2 = "
			<tr  style='font-size:9pt;'>
				 <td align='center' height='30'>".$a."</td>
				 <td align='center'>".$a."</td>
				 <td align='center'>".$a."</td>
				 <td align='left'>".$a."</td>
				 <td align='left'>".$a."</td>
				 <td align='center' bgcolor=''#ECECFF'>".$a."</td>
				 <td align='right' bgcolor='#ECECFF'>".$a."</td>
				 <td align='center' bgcolor='#FFF0F0'>".$a."</td>
				 <td align='right' bgcolor='#FFF0F0'>".$a."</td>
				 <td align='right'>".$a."</td>
				 <td align='right'>".$a."</td>
				 <td align='right'>".$a."</td>
			</tr>
	       ";
		// endforeach;

    echo $EXCEL_STR3 = "</table>";

    echo "<meta content='application/vnd.ms-excel; charset=UTF-8' name='Content-type'> ";
  }
}
// End of this file
