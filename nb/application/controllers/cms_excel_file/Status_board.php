<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_board extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

	public function download(){

		/** 엑셀 시트만들기 기초정보 시작 **/
		//----------------------------------------------------------//
    require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

    // Create new Spreadsheet object
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('brinc.co.kr')
      ->setLastModifiedBy($this->session->userdata('mem_username'))
      ->setTitle('Status_board')
      ->setSubject('동호수_현황표')
      ->setDescription('동호수 청/계약 현황표');


		$spreadsheet->setActiveSheetIndex(0); // 워크시트에서 1번째는 활성화
		$spreadsheet->getActiveSheet()->setTitle('동호수_현황표'); // 워크시트 이름 지정

		// 인쇄 관련 옵션
		$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE); // 가로 모드
		$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A3); // 용지 크기

		$spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1); // 1페이지에 모든 열 마추기
		// $spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0); //

		// 인쇄 시 여백
		$spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.8);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.5);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.5);
		$spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.3);

		$spreadsheet->getActiveSheet()->getPageSetup()->setHorizontalCentered(true); // 가로 중앙 true 모드
		$spreadsheet->getActiveSheet()->getPageSetup()->setVerticalCentered(true); // 세로 중앙 true 모드
		//----------------------------------------------------------//
		/** 엑셀 시트만들기 기초정보 종료 **/

		/** 데이터 가져오기 시작 **/
		//----------------------------------------------------------//
		$project = urldecode($this->input->get('pj'));

		// 해당 단지 최 고층 구하기
		$max_fl = $this->cms_main_model->sql_row(" SELECT MAX(ho) AS max_ho FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' ");
		if(strlen($max_fl->max_ho)==3) $view['max_floor'] = substr($max_fl->max_ho, -3,1);
		if(strlen($max_fl->max_ho)==4) $view['max_floor'] = substr($max_fl->max_ho, -4,2);

		// 해당 단지 동 수 및 리스트 구하기
		$dong_data = $view['dong_data'] = $this->cms_main_model->sql_result(" SELECT dong FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' GROUP BY dong ");

		// 총 라인수에 따라 최종 Excel 열 구하기 함수
		function toAlpha($data){
	    $alphabet =   array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	    $alpha_flip = array_flip($alphabet);
      if($data <= 25){
        return $alphabet[$data];
      }elseif($data > 25){
        $dividend = ($data + 1);
        $alpha = '';
        $modulo;
        while ($dividend > 0){
          $modulo = ($dividend - 1) % 26;
          $alpha = $alphabet[$modulo] . $alpha;
          $dividend = floor((($dividend - $modulo) / 26));
        }
        return $alpha;
      }
		}

		// 각 동별 라인 수 구하기
		for($a=0; $a<count($dong_data); $a++) :
			$d = $dong_data[$a]->dong;
			$line_num = $view['line_num'][$a] = $this->cms_main_model->sql_row(" SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$d' ");
			$total_line += $view['line_num'][$a]->to_line;
		endfor;

		$max_col_n = count($dong_data)+$total_line;
		$max_col_a = toAlpha(count($view['dong_data'])+$total_line);

		//----------------------------------------------------------//
		/** 데이터 가져오기 종료 **/



		/** 본문 내용 만들기 시작 **/
		//----------------------------------------------------------//
		// 전체 글꼴 및 정렬
		$spreadsheet->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
			array(
				'font' => array('size' => 6),
				'alignment' => array(
					'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
				)
			),
			'A:'.$max_col_a
		);

		// 헤더 스타일 생성 -- add style to the header
    $styleArray = array(
      'font' => array(
				'size' => 18,
        'bold' => true,
      ),
      'alignment' => array(
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ),
    );
    $spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);

		$outBorder = array(
      'borders' => array(
        'outline' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    ); // 아웃라인 보더
		$allBorder = array(
      'borders' => array(
        'allborders' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    ); // 올 보더
		$diaBorder = array(
      'borders' => array(
        'diagonal' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    ); // 대각선

		$spreadsheet->getActiveSheet()->mergeCells('A1:'.$max_col_a.'1');// 헤더 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(12); // 전체 기본 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(37.5); // 1행의 셀 높이 설정

		$pj_name = $this->cms_main_model->sql_row(" SELECT pj_name FROM cb_cms_project WHERE seq='$project' ");
		$spreadsheet->getActiveSheet()->setCellValue('A1', $pj_name->pj_name.' 동호수 상황표');// 해당 셀의 내용을 입력 합니다.


		// 타입 관련 데이터 구하기
		$type_data = $this->cms_main_model->sql_row(" SELECT type_name, type_color FROM cb_cms_project WHERE seq='$project' ");
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

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(2); // 첫 번째 열의 셀 넓이 설정

		$base_col = 0; // 시작열

		for($j=0; $j<count($dong_data); $j++) : // 1. 동 수만큼 반복

				$d = $dong_data[$j]->dong; // 동 구하기
				$line_num = $view['line_num'][$j] = // 라인수 구하기
						$this->cms_main_model->sql_row(" SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$d' ");

				// 동 표기 셀 병합
				$spreadsheet->getActiveSheet()->mergeCells(toAlpha($base_col+1).((2*$view['max_floor'])+5).":".toAlpha($base_col+$line_num->to_line).((2*$view['max_floor'])+6));
				$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col+1).((2*$view['max_floor'])+5).":".toAlpha($base_col+$line_num->to_line).((2*$view['max_floor'])+6))->applyFromArray($outBorder);
				$spreadsheet->getActiveSheet()->setCellValue(toAlpha($base_col+1).((2*$view['max_floor'])+5), $d.'동');// 해당 셀의 내용을 입력 합니다.
				$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col+1).((2*$view['max_floor'])+5))->getFont()->setSize(9);// A1의 폰트를 변경 합니다.
				$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col+1).((2*$view['max_floor'])+5))->getFont()->setBold(true);// A1의 글씨를 볼드로 변경합니다.
				$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col+1).((2*$view['max_floor'])+5))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFd6d7d5');

				for($k=0; $k<$line_num->to_line; $k++): // 2. 라인수 만큼 반복
						$base_row = 3; // 시작행 초기화
						$base_col++; // 라인수 증가분 만큼 시작열 증가시키기

						// 동 부분 열 너비 지정
						if($j<count($dong_data)) $spreadsheet->getActiveSheet()->getColumnDimension(toAlpha($base_col))->setWidth(5); // 열의 셀 넓이 설정

						$line_no = str_pad($k+1, 2, 0, STR_PAD_LEFT); // 라인 텍스트

						for($l=0; $l<$view['max_floor']; $l++) : // 3. 최고층 만큼 반복

								$floor_no = $view['max_floor']-$l; // 층수 구하기
								$ho_no = $floor_no.$line_no;       // 호수 텍스트

								// 실제 디비에서 가져온 동호수 데이터
								$db_ho = $this->cms_main_model->sql_row(" SELECT seq, type, ho, is_hold, is_application, is_contract FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$d' AND ho='$ho_no' ");

								$now_ho = ($db_ho !==null) ? $db_ho->ho : ''; // 해당 호수
								$type_col = ($db_ho !==null) ? str_replace('#', 'FF', $type_color[$db_ho->type]) : '';

								if($floor_no<3 && $db_ho===null){ // 피로티일 때
									$spreadsheet->getActiveSheet()->mergeCells(toAlpha($base_col).($base_row+2).':'.toAlpha($base_col).($base_row+3)); // 셀을 합칩니다.
									// 피로티 색상
									$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col).($base_row+2).':'.toAlpha($base_col).($base_row+3))
										->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFdbdedc');
									$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col).($base_row+2).':'.toAlpha($base_col).($base_row+3))->applyFromArray($outBorder);
								}


								if($db_ho !==null) : // 세대 상태 확인 소스
									if($db_ho->is_hold==1) :
										$condi = "hold";
										$condi_col = "FFd2d2d5"; // hold  시
									elseif($db_ho->is_application==1) :
										$app_data = $this->cms_main_model->sql_row(" SELECT  applicant, app_date, unit_type, unit_dong_ho FROM cb_cms_sales_application WHERE unit_seq='$db_ho->seq' AND disposal_div<>'3' ");
										$dong_ho = explode("-", $app_data->unit_dong_ho);
										$condi = $app_data->applicant;
										$condi_col = "FFe0fbd7"; // 청약 시
									elseif($db_ho->is_contract==1) :
										$cont_data = $this->cms_main_model->sql_row(" SELECT  cont_diff, contractor, cb_cms_sales_contract.cont_date, unit_type, unit_dong_ho FROM cb_cms_sales_contract, cb_cms_sales_contractor WHERE unit_seq='$db_ho->seq' AND is_rescission='0' AND cb_cms_sales_contract.seq=cont_seq AND is_transfer='0' ");
										$dong_ho = explode("-", $cont_data->unit_dong_ho);
										$condi = $cont_data->contractor;
										$con_diff = $cont_data->cont_diff;
										if($con_diff==1):
											$condi_col = "FFdec1ae"; // 계약 시  1차
										elseif($con_diff==2):
											$condi_col = "FFd7dbff"; // 계약 시  2차
										endif;
									else :
										$condi = "";
										$condi_col = "";
									endif;
								else:
									$condi = "";
									$condi_col = "";
								endif;

								$base_row+=2; // 시작행 부터 최고층 만큼 증가
								if(!empty($now_ho)) {
									$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col).$base_row.':'.toAlpha($base_col).($base_row+1))->applyFromArray($outBorder);
									$spreadsheet->getActiveSheet()->setCellValue(toAlpha($base_col).$base_row, $now_ho);// 해당 셀의 내용을 입력 합니다.
									$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col).$base_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($type_col);

									if($condi!==""){
										$spreadsheet->getActiveSheet()->setCellValue(toAlpha($base_col).($base_row+1), $condi);// 해당 셀의 내용을 입력 합니다.
										$spreadsheet->getActiveSheet()->getStyle(toAlpha($base_col).($base_row+1))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($condi_col);
									}
								}
						endfor;
				endfor;
				$base_col++; // 동 사이 1칸 띄우기
				$spreadsheet->getActiveSheet()->getColumnDimension(toAlpha($base_col))->setWidth(2); // 동 사이 셀 넓이 설정
		endfor;



		// set right to left direction
    // $spreadsheet->getActiveSheet()->setRightToLeft(true);
		//----------------------------------------------------------//
		/** 본문 내용 만들기 종료 **/



		/** 파일 저장 단계 시작 **/
		//----------------------------------------------------------//
		$filename='동호수_현황표.xlsx'; // 엑셀 파일 이름

    // Redirect output to a client's web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // mime 타입
	Header('Content-Disposition: attachment; filename='.iconv('UTF-8','CP949',$filename)); // 브라우저에서 받을 파일 이름
    header('Cache-Control: max-age=0'); // no cache
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

		// Excel5 포맷으로 저장 -> 엑셀 2007 포맷으로 저장하고 싶은 경우 'Excel2007'로 변경합니다.
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
		// 서버에 파일을 쓰지 않고 바로 다운로드 받습니다.
    $writer->save('php://output');
    exit;
		//----------------------------------------------------------//
		/** 파일 저장 단계 종료 **/

    // create new file and remove Compatibility mode from word title
	}
}
// End of File
