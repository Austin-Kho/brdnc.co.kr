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
		//----------------------------------------------------------//
		/** 엑셀 시트만들기 기초정보 종료 **/

		/** 데이터 가져오기 시작 **/
		//----------------------------------------------------------//
		$project = urldecode($this->input->get('pj'));

		// 공급세대 및 유보세대 청약 계약세대 구하기
		$view['summary_tb'] = $this->cms_main_model->sql_row(" SELECT COUNT(*) AS total, SUM(is_hold) AS hold, SUM(is_application) AS acn, SUM(is_contract) AS cont FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project'  ");

		// 타입 관련 데이터 구하기
		$type = $this->cms_main_model->sql_row(" SELECT type_name, type_color FROM cb_cms_project WHERE seq='$project' ");
		if($type) {
			$view['type'] = array(
				'name' => explode("-", $type->type_name),
				'color' => explode("-", $type->type_color)
			);
		}

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
		// 각 동별 라인 수 구하기   //$line_num[6]->to_line
		for($j=0; $j<count($dong_data); $j++) :
			$d = $dong_data[$j]->dong;
			$line_num = $view['line_num'][$j] = $this->cms_main_model->sql_row(" SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$d' ");
			$total_line += $view['line_num'][$j]->to_line;
		endfor;

		$max_col_n = count($dong_data)+$total_line;
		$max_col_a = strtoupper(toAlpha(count($view['dong_data'])+$total_line));

		//----------------------------------------------------------//
		/** 데이터 가져오기 종료 **/

		/** 본문 내용 만들기 시작 **/
		//----------------------------------------------------------//
		// 전체 글꼴 및 정렬
		$spreadsheet->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
			array(
				'font' => array('size' => 8),
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
    $spreadsheet->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);
		$spreadsheet->getActiveSheet()->mergeCells('A1:L1');// A1부터 G1까지 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(10); // 전체 기본 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(37.5); // 1행의 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(2)->setRowHeight(15); // 2행의 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(3)->setRowHeight(15); // 2행의 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(4)->setRowHeight(15); // 2행의 셀 높이 설정

		for($i=0; $i<=$max_col_n; $i++) :
			$spreadsheet->getActiveSheet()->getColumnDimension(strtoupper(toAlpha($i)))->setWidth(5); // A열의 셀 넓이 설정
		endfor;


		// 동호 테이블 시작 열과 행 지정 B(1) // 5행 부터 시작

		// $spreadsheet->getActiveSheet()->setCellValue(toAlpha(1).'5', 'aa');
		// 각 동별 라인 수 구하기   //$line_num[6]->to_line

		$base_col = 0; // 시작열


		for($j=0; $j<count($dong_data); $j++) : // 1. 동 수만큼 반복

				$d = $dong_data[$j]->dong; // 동 구하기
				$line_num = $view['line_num'][$j] = // 라인수 구하기
						$this->cms_main_model->sql_row(" SELECT MIN(RIGHT(ho,2)) AS from_line, MAX(RIGHT(ho,2)) AS to_line FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$d' ");

				for($k=0; $k<$line_num->to_line; $k++): // 2. 라인수 만큼 반복
						$base_row = 5; // 시작행 초기화
						$base_col++; // 라인수 증가분 만큼 시작열 증가시키기

						$line_no = str_pad($k+1, 2, 0, STR_PAD_LEFT); // 라인 텍스트


						for($l=0; $l<$view['max_floor']; $l++) : // 3. 최고층 만큼 반복

								$floor_no = $view['max_floor']-$l; // 층수 구하기
								$ho_no = $floor_no.$line_no;       // 호수 텍스트

								// 실제 디비에서 가져온 동호수 데이터
								$db_ho = $this->cms_main_model->sql_row(" SELECT seq, type, ho, is_hold, is_application, is_contract FROM cb_cms_project_all_housing_unit WHERE pj_seq='$project' AND dong='$dong' AND ho='$ho_no' ");

								$now_ho = ($db_ho !==null) ? $db_ho->ho : ''; // 해당 호수
								$now_type = ($db_ho !==null) ? $db_ho->type : ''; // 해당 타입

								if($db_ho !==null) : // 세대 상태 확인 소스
									if($db_ho->is_hold==1) :
										$condi = "hold";
									elseif($db_ho->is_application==1) :
										$app_data = $this->cms_main_model->sql_row(" SELECT  applicant, app_date, unit_type, unit_dong_ho FROM cb_cms_sales_application WHERE unit_seq='$db_ho->seq' AND disposal_div<>'3' ");
										$dong_ho = explode("-", $app_data->unit_dong_ho);
										$condi = $app_data->applicant;
									elseif($db_ho->is_contract==1) :
										$cont_data = $this->cms_main_model->sql_row(" SELECT  cont_diff, contractor, cb_cms_sales_contract.cont_date, unit_type, unit_dong_ho FROM cb_cms_sales_contract, cb_cms_sales_contractor WHERE unit_seq='$db_ho->seq' AND is_rescission='0' AND cb_cms_sales_contract.seq=cont_seq AND is_transfer='0' ");
										$dong_ho = explode("-", $cont_data->unit_dong_ho);
										$condi = $cont_data->contractor;
										$con_diff = $cont_data->cont_diff;
									else :
										$condi = "";
									endif;
								else:
									$condi = "";
								endif;

								$base_row+=2; // 시작행 부터 최고층 만큼 증가
								$spreadsheet->getActiveSheet()->setCellValue(strtoupper(toAlpha($base_col)).$base_row, $ho_no);// 해당 셀의 내용을 입력 합니다.
								$spreadsheet->getActiveSheet()->setCellValue(strtoupper(toAlpha($base_col)).($base_row+1), $condi);// 해당 셀의 내용을 입력 합니다.

						endfor;
				endfor;
				$base_col++; // 동 사이 1칸 띄우기
		endfor;





		// $spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('A1', '동호수 현황표');// 해당 셀의 내용을 입력 합니다.
		// $spreadsheet->getActiveSheet()->setCellValue('A2', $max_col);// 해당 셀의 내용을 입력 합니다.
		// $spreadsheet->getActiveSheet()->setCellValue('A3', '1234');// 해당 셀의 내용을 입력 합니다.
		// $spreadsheet->getActiveSheet()->setCellValue('A4', '홍길동');// 해당 셀의 내용을 입력 합니다.

		$base = $view['max_floor']+5;









		// set right to left direction
    // $spreadsheet->getActiveSheet()->setRightToLeft(true);
		//----------------------------------------------------------//
		/** 본문 내용 만들기 시작 **/



		/** 파일 저장 단계 시작 **/
		//----------------------------------------------------------//
		$filename='동호수_현황표.xlsx'; // 엑셀 파일 이름

    // Redirect output to a client's web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // mime 타입
    header('Content-Disposition: attachment;filename="'.$filename.'"'); // 브라우저에서 받을 파일 이름
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
