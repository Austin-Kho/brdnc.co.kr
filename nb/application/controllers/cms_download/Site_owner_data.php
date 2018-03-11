<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_owner_data extends CB_Controller {
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
		$project = urldecode($this->input->get('pj')); // 프로젝트 ID
		$pj_title = $this->cms_main_model->sql_row(" SELECT pj_name FROM cb_cms_project WHERE seq='$project' "); // 프로젝트 명

		$w_qry = "WHERE cb_cms_site_ownership.pj_seq = ". $project;
		if($this->input->get('search_word')){
			switch ($this->input->get('search_con')) {
				case '1': $w_qry.= " AND cb_cms_site_status.lot_num LIKE '%".$this->input->get('search_word')."%' "; break;
				case '2': $w_qry.= " AND cb_cms_site_ownership.owner LIKE '%".$this->input->get('search_word')."%' "; break;
				default: $w_qry.= " AND cb_cms_site_status.lot_num LIKE '%".$this->input->get('search_word')."%'  OR cb_cms_site_ownership.owner LIKE '%".$this->input->get('search_word')."%' "; break;
			}
		}
		// 실제 출력할 데이터
		$own_data = $this->cms_main_model->sql_result(
			" SELECT cb_cms_site_ownership.*,
          cb_cms_site_status.admin_dong AS admin_dong,
          cb_cms_site_status.land_mark AS land_mark,
          cb_cms_site_status.area_official AS area_official,
          cb_cms_site_status.area_returned AS area_returned
          FROM cb_cms_site_ownership JOIN cb_cms_site_status
          ON cb_cms_site_ownership.lot_seq = cb_cms_site_status.seq
          $w_qry
          ORDER BY cb_cms_site_ownership.seq, lot_order, lot_seq "
		);

		$row_opt = explode("-", urldecode($this->input->get('row'))); // 출력할 데이터 열 정보
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
	      ->setTitle('Site_owner_data')
	      ->setSubject('소유자별 토지목록 조서')
	      ->setDescription('소유자별 토지 지번목록 및 소유자 관련 필터링 데이터');
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
		$spreadsheet->getActiveSheet()->setTitle('소유자별 토지목록 조서'); // 워크시트 이름 지정

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
		$spreadsheet->getActiveSheet()->getStyle('A3:'.toAlpha(count($row_opt)).(count($own_data)+4))->applyFromArray($allBorder);

		$spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(19.5); // 전체 기본 셀 높이 설정
		$spreadsheet->getActiveSheet()->getRowDimension(1)->setRowHeight(37.5); // 1행의 셀 높이 설정
		// $spreadsheet->getActiveSheet()->getRowDimension(2)->setRowHeight(9.5); // 2행의 셀 높이 설정

		$spreadsheet->getActiveSheet()->mergeCells('A1:'.toAlpha(count($row_opt)).'1');// A1부터 해당 열까지 셀을 합칩니다.

		$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);// A1의 폰트를 변경 합니다.
		$spreadsheet->getActiveSheet()->setCellValue('A1', $pj_title->pj_name.' 소유자별 토지목록');// 해당 셀의 내용을 입력 합니다.
		$spreadsheet->getActiveSheet()->getStyle(toAlpha(count($row_opt)).'2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		$spreadsheet->getActiveSheet()->setCellValue(toAlpha(count($row_opt)).'2', date('Y-m-d')." 현재");// 해당 셀의 내용을 입력 합니다.

		$spreadsheet->getActiveSheet()->getStyle('A3:'.toAlpha(count($row_opt)).'3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFEAEAEA');
		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth('5'); // 열의 셀 넓이 설정
		$spreadsheet->getActiveSheet()->mergeCells('A3:A4');// A1부터 해당 열까지 셀을 합칩니다.
		$spreadsheet->getActiveSheet()->setCellValue('A3', '번호');

		for($k=0; $k<count($row_opt); $k++){
			switch ($row_opt[$k]) {
				case '1': $wn = 12; $title = "소유자"; break; // 소유자
				case '2': $wn = 12; $title = "생년월일(성별)";  // 생년월일
				case '3': $wn = 14; $title = "연락처[1]"; break; // 연락처1
				case '4': $wn = 14; $title = "연락처[2]"; break; // 연락처2
				case '5': $wn = 40; $title = "주 소"; break; // 주소
				case '6': $wn = 8; $title = "소유구분"; break; // 소유구분
				case '7': $wn = 10; $title = "행정동"; break; // 행정동
				case '8': $wn = 12; $title = "지 번"; break; // 지번
				case '9': $wn = 9; $title = "지 목"; break; // 지목
				case '10': $wn = 14; $title = "공부상면적(㎡)"; break; // 공부상면적/m2
				case '11': $wn = 13; $title = "공부상면적(평)"; break; // 공부상면적/평
				case '12': $wn = 14; $title = "환지면적(㎡)"; break; // 환지면적/m2
				case '13': $wn = 13; $title = "환지면적(평)"; break; // 환지먼적/평
				case '14': $wn = 10; $title = "소유지분(%)"; break; // 소유지분
				case '15': $wn = 14; $title = "소유면적(㎡)"; break; // 소유면적/m2
				case '16': $wn = 13; $title = "소유면적(평)"; break; // 소유면적/평
				case '17': $wn = 12; $title = "은행명"; break; // 은행명
				case '18': $wn = 18; $title = "계좌번호"; break; // 계좌번호
				case '19': $wn = 12; $title = "예금주"; break; // 예금주
				case '20': $wn = 8; $title = "계약여부"; break; //
				case '21': $wn = 15; $title = "총 계약금액"; break; //
				case '22': $wn = 14; $title = "계약금(1)"; break; //
				case '23': $wn = 13; $title = "지급일"; break; //
				case '24': $wn = 8; $title = "지급여부"; break; //
				case '25': $wn = 14; $title = "계약금(2)"; break; //
				case '26': $wn = 13; $title = "지급일"; break; //
				case '27': $wn = 8; $title = "지급여부"; break; //
				case '28': $wn = 14; $title = "중도금(1)"; break; //
				case '29': $wn = 13; $title = "지급일"; break; //
				case '30': $wn = 8; $title = "지급여부"; break; //
				case '31': $wn = 14; $title = "중도금(2)"; break; //
				case '32': $wn = 13; $title = "지급일"; break; //
				case '33': $wn = 8; $title = "지급여부"; break; //
				case '34': $wn = 14; $title = "잔 금"; break; //
				case '35': $wn = 13; $title = "지급일"; break; //
				case '36': $wn = 8; $title = "지급여부"; break; //
				case '37': $wn = 8; $title = "소유권이전등기"; break; //
				case '38': $wn = 60; $title = "권리제한사항"; break; //
				case '39': $wn = 60; $title = "상담 기록"; break; //
				default: $wn = 5; break; // 번호
			}

			$spreadsheet->getActiveSheet()->getColumnDimension(toAlpha($k+1))->setWidth($wn); // 열의 셀 넓이 설정
			$spreadsheet->getActiveSheet()->mergeCells(toAlpha($k+1).'3:'.toAlpha($k+1).'4'); // 세로 2열 병합
			$spreadsheet->getActiveSheet()->setCellValue(toAlpha($k+1).'3', $title);// 해당 셀의 내용을 입력 합니다.
		}

		$i=1;
		foreach ($own_data as $lt) {

			$owner_addr = str_replace("|", " ", $lt->owner_addr);
			switch ($lt->own_sort) {
				case '1': $own_sort = "개인"; break;
				case '1': $own_sort = "법인"; break;
				case '1': $own_sort = "국공유지"; break;
				default: $own_sort = ""; break;
			}
			$bank_account = explode("|", $lt->payment_acc);
			$is_contract = ($lt->is_contract=='1') ? "완료" : "";
			$down_pay1_is_paid = ($lt->down_pay1_is_paid) ? "완료" : "";
			$down_pay2_is_paid = ($lt->down_pay2_is_paid) ? "완료" : "";
			$inter_pay1_is_paid = ($lt->inter_pay1_is_paid) ? "완료" : "";
			$inter_pay2_is_paid = ($lt->inter_pay2_is_paid) ? "완료" : "";
			$remain_pay_is_paid = ($lt->remain_pay_is_paid) ? "완료" : "";
			$ownership_is_take = ($lt->ownership_is_take) ? "완료" : "";

			$total_price = ($lt->total_price !='0') ?$lt->total_price : "-";

			$down_pay1 = ($lt->down_pay1 !='0') ?$lt->down_pay1 : "-";
			$down_pay2 = ($lt->down_pay2 !='0') ?$lt->down_pay2 : "-";
			$inter_pay1 = ($lt->inter_pay1 !='0') ?$lt->inter_pay1 : "-";
			$inter_pay2 = ($lt->inter_pay2 !='0') ?$lt->inter_pay2 : "-";
			$remain_pay = ($lt->remain_pay !='0') ?$lt->remain_pay : "-";

			$down_pay1_date = ($lt->down_pay1_date !=='0000-00-00') ?$lt->down_pay1_date : "";
			$down_pay2_date = ($lt->down_pay2_date !=='0000-00-00') ?$lt->down_pay2_date : "";
			$inter_pay1_date = ($lt->inter_pay1_date !=='0000-00-00') ?$lt->inter_pay1_date : "";
			$inter_pay2_date = ($lt->inter_pay2_date !=='0000-00-00') ?$lt->inter_pay2_date : "";
			$remain_pay_date = ($lt->remain_pay_date !=='0000-00-00') ?$lt->remain_pay_date : "";

			$spreadsheet->getActiveSheet()->setCellValue('A'.(4+$i), $i);

			for($j=0; $j<count($row_opt); $j++){
				switch ($row_opt[$j]) {
					case '1': $content = $lt->owner; $align=""; $num=""; break; // 소유자
					case '2': $content = $lt->owner_id_birth; $align=""; $num=""; break; // 생년월일
					case '3': $content = $lt->owner_tel_1; $align=""; $num=""; break; // 연락처1
					case '4': $content = $lt->owner_tel_2; $align=""; $num=""; break; // 연락처2
					case '5': $content = $owner_addr; $align="left"; $num=""; break; // 주소
					case '6': $content = $own_sort; $align=""; $num=""; break; // 소유구분
					case '7': $content = $lt->admin_dong; $align=""; $num=""; break; // 행정동
					case '8': $content = $lt->lot_num; $align = ""; $num=""; break; // 지번
					case '9': $content = $lt->land_mark; $align=""; $num=""; break; // 지목
					case '10': $content = $lt->area_official; $align="right"; $num="2"; break; // 공부상면적/m2
					case '11': $content = $lt->area_official*0.3025; $align = "right"; $num="2"; break; // 공부상면적/평
					case '12': $content = $lt->area_returned; $align = "right"; $num="2"; break; // 환지실권리면적(m2)
					case '13': $content = $lt->area_returned*0.3025; $align="right"; $num="2"; break; // 환지실권리면적(평)
					case '14': $content = $lt->owned_percent; $align="right"; $num="2"; break; // 소유지분
					case '15': $content = $lt->owned_area; $align="right"; $num="2"; break; // 지분면적(m2)
					case '16': $content = $lt->owned_area*0.3025; $align="right"; $num="2"; break; // 지분면적(평)
					case '17': $content = $bank_account[0]; $align=""; $num=""; break; // 은행
					case '18': $content = $bank_account[1]; $align=""; $num=""; break; // 계좌번호
					case '19': $content = $bank_account[2]; $align=""; $num=""; break; // 예금주
					case '20': $content = $is_contract; $align=""; $num=""; break; // 계약여부
					case '21': $content = $total_price; $align="right"; $num="1"; break; // 총 계약금액
					case '22': $content = $down_pay1; $align="right"; $num="1"; break; // 계약금1
					case '23': $content = $down_pay1_date; $align=""; $num=""; break; // 지급일
					case '24': $content = $down_pay1_is_paid; $align=""; $num=""; break; // 지급여부
					case '25': $content = $down_pay2; $align="right"; $num="1"; break; // 계약금2
					case '26': $content = $down_pay2_date; $align=""; $num=""; break; // 지급일
					case '27': $content = $down_pay2_is_paid; $align=""; $num=""; break; // 지급여부
					case '28': $content = $inter_pay1; $align="right"; $num="1"; break; // 중도금1
					case '29': $content = $inter_pay1_date; $align=""; $num=""; break; // 지급일
					case '30': $content = $inter_pay1_is_paid; $align=""; $num=""; break; // 지급여부
					case '31': $content = $inter_pay2; $align="right"; $num="1"; break; // 중도금2
					case '32': $content = $inter_pay2_date; $align=""; $num=""; break; // 지급일
					case '33': $content = $inter_pay2_is_paid; $align=""; $num=""; break; // 지급여부
					case '34': $content = $remain_pay; $align="right"; $num="1"; break; // 잔금
					case '35': $content = $remain_pay_date; $align=""; $num=""; break; // 지급일
					case '36': $content = $remain_pay_is_paid; $align=""; $num=""; break; // 지급여부
					case '37': $content = $ownership_is_take; $align=""; $num=""; break; // 소유권이전 여부
					case '38': $content = $lt->rights_restrictions; $align="left"; $num=""; break; // 권리제한 사항
					case '39': $content = $lt->counsel_record; $align="left"; $num=""; break; // 상담 기록
				}
				$spreadsheet->getActiveSheet()->setCellValue(toAlpha($j+1).(4+$i), $content);// 해당 셀의 내용을 입력 합니다.
				if($align == "right") {
					$spreadsheet->getActiveSheet()->getStyle(toAlpha($j+1).(4+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
					if($num==="0") {$spreadsheet->getActiveSheet()->getStyle(toAlpha($j+1).(4+$i))->getNumberFormat()->setFormatCode('#,##0');} // 셀 숫자형 변환 (1000 -> 1,000)
					if($num==="2") {$spreadsheet->getActiveSheet()->getStyle(toAlpha($j+1).(4+$i))->getNumberFormat()->setFormatCode('#,##0.00');} // 셀 숫자형 변환 (1000 -> 1,000)
				}
				if($align == "left") {$spreadsheet->getActiveSheet()->getStyle(toAlpha($j+1).(4+$i))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);}
			}
			$i++;
		}

		// set right to left direction
    // $spreadsheet->getActiveSheet()->setRightToLeft(true);

		// 본문 내용 ---------------------------------------------------------------//

		$filename='소유자별_토지목록.xlsx'; // 엑셀 파일 이름

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
}
// End of File
