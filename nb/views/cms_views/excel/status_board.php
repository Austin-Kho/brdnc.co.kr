<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Header("Content-type: application/vnd.ms-excel; charset=UTF-8" );
Header("Content-Disposition: attachment; filename=".iconv("UTF-8","cp949//IGNORE", $project->pj_name."_동호수_현황표(".date('Y-m-d').").xls"));
Header("Content-Description: PHP7 Generated Data" );
Header("Pragma: no-cache");
Header("Expires: 0");

//------------------- 데이터 가져오기 시작 -------------------//
// 해당 단지 최 고층 구하기
$max_fl = $this->cms_main_model->sql_row(" SELECT MAX(ho) AS max_ho FROM cb_cms_project_all_housing_unit WHERE pj_seq='$pj_seq' ");
if(strlen($max_fl->max_ho)==3) $view['max_floor'] = substr($max_fl->max_ho, -3,1);
if(strlen($max_fl->max_ho)==4) $view['max_floor'] = substr($max_fl->max_ho, -4,2);

// 해당 단지 동 수 및 리스트 구하기
$dong_data = $this->cms_main_model->sql_result(" SELECT dong FROM cb_cms_project_all_housing_unit WHERE pj_seq='$pj_seq' GROUP BY dong ");

// 총 라인 수 구하기
for($a=0; $a<count($dong_data); $a++) :
  $d = $dong_data[$a]->dong;
  $line_num = $view['line_num'][$a] = $this->cms_main_model->sql_row(
    " SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line
      FROM cb_cms_project_all_housing_unit
      WHERE pj_seq='$pj_seq' AND dong='$d' "
  );
  $total_line += $view['line_num'][$a]->to_line;
endfor;

// 동 수 및 라인 수에 따른 총 열 계산 및 컬럼 텍스트 구하기
$max_col = (count($dong_data)+$total_line+1);

// 타입 관련 데이터 구하기
$type_data = $this->cms_main_model->sql_row(" SELECT type_name, type_color FROM cb_cms_project WHERE seq='$pj_seq' ");
if($type_data) {
  $type = array(
    'name' => explode("-", $type_data->type_name),
    'color' => explode("-", $type_data->type_color)
  );
}
if(!empty($type)) :
  for($i=0; $i<count($type['name']); $i++) :
    $type_color[$type['name'][$i]] = $type['color'][$i];
  endfor;
endif;

$type_num = count($type[name]);

// ------------------- 데이터 가져오기 종료 -------------------//

// 테이블 상단 만들기
$EXCEL_STR = "
<table>
  <tr align='center' height='48'>
    <td colspan='".$max_col."' style='font-size:20pt; text-align:center;'><b>".$project->pj_name." 동호수 현황표</b></td>
  </tr>
  <tr align='right' height='20'>
    <td colspan='".($max_col-1)."' style='font-size:8pt;'>".date('Y-m-d')."</td>
  </tr>
";
$EXCEL_STR .= "<tr height='20'>";
for($a=0; $a<$max_col; $a++) :
  $EXCEL_STR .= "<td width='20' style='text-align:right;'></td>";
endfor;
$EXCEL_STR .= "
  </tr>
  <tr height='20' align='center'>
    <td></td>
    <td colspan='2' style='font-size:8pt; border: 1px solid black;'>범 례</td>
  </tr>
";

for($a=0; $a<$type_num; $a++) :
  $EXCEL_STR .= "
  <tr height='20' align='center'>
    <td></td>
    <td bgcolor='".$type_color[$type['name'][$a]]."' style='border: 1px solid black;'>&nbsp;</td>
    <td style='font-size:8pt; border: 1px solid black;'>".$type['name'][$a]."</td>
  </tr>
  ";
endfor;

$EXCEL_STR .= "<tr height='20'><td></td></tr>"; // 한 줄 띄우기

//------------------------------------- 유니트 시작 ---------------------------------------//
for($l=0; $l<$view['max_floor']; $l++) { // 1. 최고층 만큼 반복
  $floor_no = $view['max_floor']-$l; // 층수 구하기

  for($b=0; $b<2; $b++){
    $EXCEL_STR .= "<tr height='20' align='center'><td></td>";

    for($j=0; $j<count($dong_data); $j++) { // 2. 동 수만큼 반복
      $d = $dong_data[$j]->dong; // 동 구하기
      $line_num = $view['line_num'][$j] = $this->cms_main_model->sql_row(  // 라인수 구하기
          " SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line
            FROM cb_cms_project_all_housing_unit
            WHERE pj_seq='$pj_seq' AND dong='$d' "
        );

      for($k=0; $k<$line_num->to_line; $k++) {  // 3. 라인수 만큼 반복
        $line_no = str_pad($k+1, 2, 0, STR_PAD_LEFT); // 라인 텍스트
        $ho_no = $floor_no.$line_no;       // 호수 텍스트

        // 실제 디비에서 가져온 동호수 데이터
        $db_ho = $this->cms_main_model->sql_row(
          " SELECT seq, type, ho, is_hold, is_application, is_contract
            FROM cb_cms_project_all_housing_unit
            WHERE pj_seq='$pj_seq' AND dong='$d' AND ho='$ho_no' "
        );

        $now_ho = ($db_ho !==null) ? $db_ho->ho : ''; // 해당 호수
        $now_bo = ($db_ho !==null) ? "border: 1px solid black;" : ''; // 테두리
        $now_tp_co = ($db_ho !==null) ? "bgcolor='".$type_color[$db_ho->type]."'" : ''; // 타입컬러


        if($db_ho !==null) { // 세대 상태 확인 소스
          if($db_ho->is_hold==1) {
            $condi = "hold";
            $condi_fc = "";
            $condi_col = "#c6c5c5"; // hold  시
          }elseif($db_ho->is_application==1) {
            // $app_data = $this->cms_main_model->sql_row(" SELECT  applicant, app_date, unit_type, unit_dong_ho FROM cb_cms_sales_application WHERE unit_seq='$db_ho->seq' AND disposal_div<>'3' ");
            // $dong_ho = explode("-", $app_data->unit_dong_ho);
            $condi = "청약";
            $condi_fc = "";
            // $condi = $app_data->applicant;
            $condi_col = "#e5ff44"; // 청약 시
          }elseif($db_ho->is_contract==1) {
            // $cont_data = $this->cms_main_model->sql_row(" SELECT  cont_diff, contractor, cb_cms_sales_contract.cont_date, unit_type, unit_dong_ho FROM cb_cms_sales_contract, cb_cms_sales_contractor WHERE unit_seq='$db_ho->seq' AND is_rescission='0' AND cb_cms_sales_contract.seq=cont_seq AND is_transfer='0' ");
            // $dong_ho = explode("-", $cont_data->unit_dong_ho);
            $condi = "계약";
            $condi_fc = "color:#fff;";
            $condi_col = "#51657e"; // 계약 시
            // $condi = $cont_data->contractor;
            // $con_diff = $cont_data->cont_diff;
            // if($con_diff==1):
            // 	$condi_col = "#855c43"; // 계약 시  1차
            // elseif($con_diff==2):
            // 	$condi_col = "#5c5a5a"; // 계약 시  2차
            // endif;
          }else{
            $condi = "";
            $condi_fc = "";
            $condi_col = "";
          }
        }else{
          $condi = "";
          $condi_fc = "";
          $condi_col = "";
        }

        $condi_box = ($db_ho !==null) ? "<td style='font-size:8pt; ".$condi_fc." ".$now_bo."' bgcolor='".$condi_col."'>".$condi."</td>" : "<td></td>";

        if($floor_no<3 && $db_ho===null) { // 피로티일 때
          if($b==0) { $EXCEL_STR .= "<td rowspan='2' bgcolor='#cccccc' style='font-size:8pt; border: 1px solid black;'>&nbsp;</td>";  }
        }else{ // 피로티가 아닐 때
          if($b==0) { $EXCEL_STR .= "<td ".$now_tp_co." width='38' style='font-size:8pt; ".$now_bo."'>".$now_ho."</td>";  }
          if($b==1) { $EXCEL_STR .= $condi_box; }
        }
      }
      $EXCEL_STR .= "<td></td>"; // 동사이 1칸 띄우기
    }
    $EXCEL_STR .= "</tr>";
  }
}
$EXCEL_STR .= "<tr align='center' height='40'><td></td>";
for($j=0; $j<count($dong_data); $j++) { // 2. 동 수만큼 반복
  $d = $dong_data[$j]->dong; // 동 구하기
  $line_num = $view['line_num'][$j] = $this->cms_main_model->sql_row(  // 라인수 구하기
      " SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line
        FROM cb_cms_project_all_housing_unit
        WHERE pj_seq='$pj_seq' AND dong='$d' "
    );
  $EXCEL_STR .= "<td bgcolor='#838383' colspan='".$line_num->to_line."' style='font-size:9pt; border: 1px solid black; color:white;'><b>".$d."동</b></td>";
  $EXCEL_STR .= "<td></td>";
}
$EXCEL_STR .= "</tr>";
// ------------------------------------- 유니트 종료 ---------------------------------------//

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;
?>
