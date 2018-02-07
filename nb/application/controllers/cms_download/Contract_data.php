<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract_data extends CB_Controller {
	/**
	 * [__construct 이 클래스의 생성자]
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('cms_main_model'); //모델 파일 로드
	}

	public function download(){

		/** 데이터 가져오기 시작 **/
		//----------------------------------------------------------//
		$project = urldecode($this->input->get('pj'));
		$cont_query = urldecode($this->input->get('qry'));
		$cont_data = $this->cms_main_model->sql_result($cont_query); // 계약 및 계약자 데이터
		$row_opt = explode("-", urldecode($this->input->get('row')));

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
      ->setTitle('Contract_data')
      ->setSubject('계약자_데이터')
      ->setDescription('계약자 필터링 데이터');
		//----------------------------------------------------------//
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

		$spreadsheet->setActiveSheetIndex(0); // 워크시트에서 1번째는 활성화
		$spreadsheet->getActiveSheet()->setTitle('계약자_데이터'); // 워크시트 이름 지정

		// 본문 내용 ---------------------------------------------------------------//

		// 전체 글꼴 및 정렬
		$spreadsheet->getActiveSheet()->duplicateStyleArray( // 전체 글꼴 및 정렬
			array(
				'font' => array('size' => 9),
				'alignment' => array(
					'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					'horizontal'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
				)
			),
			'A:'.toAlpha(count($row_opt))
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
        'allborders' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    );
    $spreadsheet->getActiveSheet()->getStyle('A1:'.toAlpha(count($row_opt)).'1')->applyFromArray($styleArray);

		$outBorder = array(
      'borders' => array(
        'outline' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    );
		$spreadsheet->getActiveSheet()->getStyle('A2:'.toAlpha(count($row_opt)).'2')->applyFromArray($outBorder);

		$allBorder = array(
      'borders' => array(
        'allborders' => array(
          'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ),
      ),
    );
		$spreadsheet->getActiveSheet()->getStyle('A3:'.toAlpha(count($row_opt)).(count($cont_data)+3))->applyFromArray($allBorder);

		$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19.5); // 전체 기본 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(37.5); // 1행의 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(2)->setRowHeight(9.5); // 2행의 셀 높이 설정

		$spreadsheet->getActiveSheet()->mergeCells('A1:'.toAlpha(count($row_opt)).'1');// A1부터 해당 열까지 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('A1', '계약자 데이터');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->getStyle(toAlpha(count($row_opt)).'2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue(toAlpha(count($row_opt)).'2', date('Y-m-d')." 현재");// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->getStyle('A3:'.toAlpha(count($row_opt)).'3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth('5'); // 열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->setCellValue('A3', '번호');

		for($k=0; $k<count($row_opt); $k++){
			switch ($row_opt[$k]) {
				case '1': $wn = 10; $title = "일련번호"; break; // 일련번호
				case '2': $wn = 10; $title = "차수"; break; // 차수
				case '3': $wn = 10; $title = "타입"; break; // 타입
				case '4': $wn = 10; $title = "동호수"; break; // 동호수
				case '5': $wn = 10; $title = "계약자"; break; // 계약자
				case '6': $wn = 10; $title = "계약일자"; break; // 계약일자
				case '7': $wn = 10; $title = "총납입금"; break; // 총납입금
				case '8': $wn = 15; $title = "연락처[1]"; break; // 연락처
				case '9': $wn = 15; $title = "연락처[2]"; break; // 연락처
				case '10': $wn = 30; $title = "주소[신분증]"; break; // 등본주소
				case '11': $wn = 30; $title = "주소[우편물]"; break; // 우편주소
				case '12': $wn = 20; $title = "미비서류"; break; // 미비서류
				case '13': $wn = 10; $title = "명의변경 횟수"; break; // 명의변경 횟수
				case '14': $wn = 50; $title = "비 고"; break; // 비고
				default: $wn = 5; break; // 번호
			}
			$spreadsheet->getActiveSheet()->getColumnDimension(toAlpha($k+1))->setWidth($wn); // 열의 셀 넓이 설정
			$spreadsheet->getActiveSheet()->setCellValue(toAlpha($k+1).'3', $title);// 해당 셀의 내용을 입력 합니다.
		}

		$i=1;
		foreach ($cont_data as $lt) {
			$nd = $this->cms_main_model->sql_row(" SELECT diff_name FROM cb_cms_sales_con_diff WHERE pj_seq='$project' AND diff_no='$lt->cont_diff' ");
			$total_rec = $this->cms_main_model->sql_row(" SELECT SUM(paid_amount) AS received FROM cb_cms_sales_received WHERE pj_seq='$project' AND cont_seq='$lt->cont_seq' ");

			$deposit1 = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$lt->price_seq' AND pay_sche_seq<3 ");
			$deposit2 = $this->cms_main_model->sql_row(" SELECT SUM(payment) AS payment FROM cb_cms_sales_payment WHERE price_seq='$lt->price_seq' AND pay_sche_seq<5 ");

			$addr1 = str_replace("|", " ", $lt->cont_addr1);
			$addr2 = str_replace("|", " ", $lt->cont_addr2);

			$idoc = explode("-", $lt->incom_doc); // 미비 서류
			$incom_doc = "";
			if($idoc[0]==1) $incom_doc .= " 각서9종/";
			if($idoc[1]==1) $incom_doc .= " 주민등본/";
			if($idoc[2]==1) $incom_doc .= " 주민초본/";
			if($idoc[3]==1) $incom_doc .= " 가족관계증명/";
			if($idoc[4]==1) $incom_doc .= " 인감증명/";
			if($idoc[5]==1) $incom_doc .= " 사용인감/";
			if($idoc[6]==1) $incom_doc .= " 신분증/";
			if($idoc[7]==1) $incom_doc .= " 배우자등본/";

			$spreadsheet->getActiveSheet()->setCellValue('A'.(3+$i), $i);

			for($j=0; $j<count($row_opt); $j++){
				switch ($row_opt[$j]) {
					case '1': $wn = 10; $content = $lt->cont_code; $align =""; break; // 일련번호
					case '2': $wn = 10; $content = $nd->diff_name; $align =""; break; // 차수
					case '3': $wn = 7; $content = $lt->unit_type; $align =""; break; // 타입
					case '4': $wn = 10; $content = $lt->unit_dong_ho; $align =""; break; // 동호수
					case '5': $wn = 8; $content = $lt->contractor; $align =""; break; // 계약자
					case '6': $wn = 12; $content = $lt->cont_date; $align =""; break; // 계약일자
					case '7': $wn = 12; $content = number_format($total_rec->received); $align = "right"; break; // 총납입금
					case '8': $wn = 15; $content = $lt->cont_tel1; $align =""; break; // 연락처
					case '9': $wn = 15; $content = $lt->cont_tel2; $align =""; break; // 연락처
					case '10': $wn = 70; $content = $addr1; $align = "left"; break; // 등본주소
					case '11': $wn = 70; $content = $addr2; $align = "left"; break; // 우편주소
					case '12': $wn = 30; $content = $incom_doc; $align =""; break; // 미비서류
					case '13': $wn = 10; $content = number_format($lt->transfer_number); $align ="right"; break; // 명의변경 횟수
					case '14': $wn = 80; $content = $lt->note; $align = "left"; break; // 비고
					default: $wn = 5; break; // 번호
				}
				$spreadsheet->getActiveSheet()->setCellValue(toAlpha($j+1).(3+$i), $content);// 해당 셀의 내용을 입력 합니다.
				if($align == "right") {$spreadsheet->getActiveSheet()->getStyle(toAlpha($j+1).(3+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);}
				if($align == "left") {$spreadsheet->getActiveSheet()->getStyle(toAlpha($j+1).(3+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);}
			}
			$i++;
		}

		// set right to left direction
    // $spreadsheet->getActiveSheet()->setRightToLeft(true);

		// 본문 내용 ---------------------------------------------------------------//

		$filename='계약자_데이터.xlsx'; // 엑셀 파일 이름

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

    // create new file and remove Compatibility mode from word title
	}
}
// End of File
