<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_site_list extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

    /**
	 * [index 클래스명 생략시 기본 실행 함수]
	 * @return [type] [description]
	 */
	public function index(){
		$this->download();
	}

    /**
	 * 메인 함수
	 * @return [type] [description]
	 */
    public function download(){

        /** 데이터 가져오기 시작 **/
		//----------------------------------------------------------//
		$project = urldecode($this->input->get('pj'));
		$basic_site_data = $this->cms_main_model->data_result('cb_cms_site_status', array('pj_seq'=>$project), 'order_no, seq'); // 토지 지번 목록 데이터
		$pj_title = $this->cms_main_model->data_row('cb_cms_project', array('seq'=>$project), 'pj_name'); // " SELECT pj_name FROM cb_cms_project WHERE seq='$project' ");

		//----------------------------------------------------------//
		/** 데이터 가져오기 종료 **/


		/** 엑셀 시트만들기 시작 **/
		//----------------------------------------------------------//
    	require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

    	// Create new Spreadsheet object
    	$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

		// Set document properties
	    $spreadsheet->getProperties()->setCreator('brinc.co.kr')
	      ->setLastModifiedBy($this->session->userdata('mem_username'))
	      ->setTitle('토지목록 조서')
	      ->setSubject($pj_title.' 토지목록_데이터')
	      ->setDescription('토지 지번/지목/면적 정보');
		//----------------------------------------------------------//

        // 본문 내용 시작---------------------------------------------------------------//

		// 전체 글꼴 및 정렬
		$spreadsheet->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
			array(
				'font' => array('size' => 10),
				'alignment' => array(
					'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
				)
			),
			'A:H'
		);

		// 헤더 스타일 생성 -- add style to the header
	    $styleArray = array(
	      'font' => array(
	        'bold' => true,
	      ),
	      'alignment' => array(
	        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
	        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
	      ),
	      'borders' => array(
	        'top' => array(
	          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
	        ),
	      ),
	    );
    	$spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);

		$allBorder = array(
	      'borders' => array(
	        'allborders' => array(
	          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
	        ),
	      ),
	    );
		$spreadsheet->getActiveSheet()->getStyle('A3:H'.(count($basic_site_data)+5))->applyFromArray($allBorder);

		$spreadsheet->getActiveSheet()->getColumnDimension("A")->setWidth(8); // A열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("B")->setWidth(10); // B열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("C")->setWidth(12); // C열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("D")->setWidth(10); // D열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("E")->setWidth(15); // E열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("F")->setWidth(15); // F열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("G")->setWidth(15); // G열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->getColumnDimension("H")->setWidth(15); // H열의 셀 넓이 설정
		// $spreadsheet->getActiveSheet()->getColumnDimension("I")->setWidth(38); // I열의 셀 넓이 설정

		$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19.5); // 전체 기본 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(37.5); // 1행의 셀 높이 설정

		$spreadsheet->getActiveSheet()->mergeCells('A1:H1');// A1부터 D1까지 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('A1', $pj_title->pj_name.' 토지목록 조서');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->getStyle('H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue('H2', date('Y-m-d')." 현재");// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->getStyle('A3:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');

		$spreadsheet->getActiveSheet()->getStyle('E5:H'.(count($basic_site_data)+5))->getNumberFormat()->setFormatCode('#,##0.00');  // 셀 숫자형 변환 (1000 -> 1,000)

		$spreadsheet->getActiveSheet()->mergeCells('A3:A4');// 해당 셀을 합칩니다.
		$spreadsheet->getActiveSheet()->setCellValue('A3', 'no.');

		$spreadsheet->getActiveSheet()->mergeCells('B3:B4');// 해당 셀을 합칩니다.
		$spreadsheet->getActiveSheet()->setCellValue('B3', '행정동(Lot)');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->mergeCells('C3:C4');// 해당 셀을 합칩니다.
		$spreadsheet->getActiveSheet()->setCellValue('C3', '지 번');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->mergeCells('D3:D4');// 해당 셀을 합칩니다.
		$spreadsheet->getActiveSheet()->setCellValue('D3', '지 목');// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->mergeCells('E3:F3');// 해당 셀을 합칩니다.
		$spreadsheet->getActiveSheet()->setCellValue('E3', '공부상 면적');// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->setCellValue('E4', '면적(㎡)');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('F4', '면적(평)');// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->mergeCells('G3:H3');// 해당 셀을 합칩니다.
		$spreadsheet->getActiveSheet()->setCellValue('G3', '환지(실권리) 면적');// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->setCellValue('G4', '면적(㎡)');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('H4', '면적(평)');// 해당 셀의 내용을 입력 합니다.

		// $spreadsheet->getActiveSheet()->mergeCells('I3:I4');// 해당 셀을 합칩니다.
		// $spreadsheet->getActiveSheet()->setCellValue('I3', '비 고');// 해당 셀의 내용을 입력 합니다.

		$i=1;
		foreach ($basic_site_data as $lt) {

			$spreadsheet->getActiveSheet()->setCellValue('A'.(4+$i), $lt->order_no);
			$spreadsheet->getActiveSheet()->setCellValue('B'.(4+$i), $lt->admin_dong);
			$spreadsheet->getActiveSheet()->setCellValue('C'.(4+$i), $lt->lot_num);
			$spreadsheet->getActiveSheet()->setCellValue('D'.(4+$i), $lt->land_mark);

			$spreadsheet->getActiveSheet()->getStyle('E'.(4+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->setCellValue('E'.(4+$i), $lt->area_official);
			$spreadsheet->getActiveSheet()->getStyle('F'.(4+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->setCellValue('F'.(4+$i), $lt->area_official*0.3025);
			$spreadsheet->getActiveSheet()->getStyle('G'.(4+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->setCellValue('G'.(4+$i), $lt->area_returned);
			$spreadsheet->getActiveSheet()->getStyle('H'.(4+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
			$spreadsheet->getActiveSheet()->setCellValue('H'.(4+$i), $lt->area_returned*0.3025);
			// $spreadsheet->getActiveSheet()->getStyle('I'.(3+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
			// $spreadsheet->getActiveSheet()->setCellValue('I'.(3+$i), '');

			$i++;
		}
		$total_rows = count($basic_site_data)+5;
		$site_sum = $this->cms_main_model->data_row('cb_cms_site_status', array('pj_seq'=>$project), 'SUM(area_official) AS area_o, SUM(area_returned) as area_r');
		$spreadsheet->getActiveSheet()->mergeCells('A'.$total_rows.':B'.$total_rows);// 해당 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->setCellValue('A'.$total_rows, "합 계");

		$spreadsheet->getActiveSheet()->getStyle('E'.$total_rows)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue('E'.$total_rows, $site_sum->area_o);
		$spreadsheet->getActiveSheet()->getStyle('F'.$total_rows)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue('F'.$total_rows, $site_sum->area_o*0.3025);
		$spreadsheet->getActiveSheet()->getStyle('G'.$total_rows)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue('G'.$total_rows, $site_sum->area_r);
		$spreadsheet->getActiveSheet()->getStyle('H'.$total_rows)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue('H'.$total_rows, $site_sum->area_r*0.3025);



        // 본문 내용 종료---------------------------------------------------------------//

		$filename=$pj_title->pj_name. ' 사업 토지목록_조서.xlsx'; // 엑셀 파일 이름

	    // Redirect output to a client's web browser (Excel2007)
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // mime 타입
		header('Content-Disposition: attachment; filename='.iconv('UTF-8','CP949',$filename)); // 브라우저에서 받을 파일 이름
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
    	// create new file and remove Compatibility mode from word title
    }


} // End of this File
