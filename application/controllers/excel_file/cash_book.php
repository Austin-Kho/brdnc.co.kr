
		/** 셀 컨트롤**/
		// $this->excel->setActiveSheetIndex(0)->setCellValue("A1", "셀값"); // 셀 갑 입력
		// $this->excel->getActiveSheet()->mergeCells('A1:C1'); // 셀 합치기
		// $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(6); // 셀 가로크기
		// $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(25); // 셀 높이
		// $this->excel->getActiveSheet()->getStyle('A1:C1')->getNumberFormat()->setFormatCode('#,##0'); // 셀 숫자형 변환 (1000 -> 1,000)

		//
		// 개별 적용
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); // 셀의 text를 굵게
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(13); // 셀의 textsize를 13으로
		//
		//  보더 스타일 지정
		// $defaultBorder = array(
		// 	'style' => PHPExcel_Style_Border::BORDER_THIN,
		// 	'color' => array('rgb'=>'000000')
		// );
		// $headBorder = array(
		// 	'borders' => array(
		// 		'bottom' => $defaultBorder,
		// 		'left'   => $defaultBorder,
		// 		'top'    => $defaultBorder,
		// 		'right'  => $defaultBorder
		// 	)
		// );
		//
		// 다중 셀 보더 스타일 적용
		// foreach(range('A','C') as $i => $cell){
		// 	$this->excel->getActiveSheet()->getStyle($cell.'1')->applyFromArray( $headBorder );
		// }
		//
		// 줄바꿈 허용
		// $this->excel->getActiveSheet()->getStyle('G1')->getAlignment()->setWrapText(true);
		// $this->excel->getActiveSheet()->getStyle('K6')->getAlignment()->setWrapText(true);
		// $this->excel->getActiveSheet()->getStyle('K8')->getAlignment()->setWrapText(true);
		//
		// // 배경색 적용
		// $this->excel->getActiveSheet()->duplicateStyleArray(
		// array(
		// 'fill' => array(
		// 'type'  => PHPExcel_Style_Fill::FILL_SOLID,
		// 'color' => array('rgb'=>'F3F3F3')
		// )
		// ),
		// 'A1:C1'
		// );
		//
		// // 셀 정렬 (다른방식)
		// $this->excel->getActiveSheet()->getStyle('A1')
		// ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		//
		// $this->excel->getActiveSheet()->getStyle('A1:C1')
		// ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		// //테두리
		// //셀 전체(윤곽선 + 안쪽)
		// $this->excel->getActiveSheet()->getStyle('B2:C3')->getBorders()
		// ->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//
		// //윤곽선
		// $this->excel->getActiveSheet()->getStyle('B5:C6')->getBorders()
		// ->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//
		// //안쪽
		// $this->excel->getActiveSheet()->getStyle('B8:C9')->getBorders()
		// ->getInside()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//
		// //세로선
		// $this->excel->getActiveSheet()->getStyle('B11:D13')->getBorders()
		// ->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//
		// //가로선
		// $this->excel->getActiveSheet()->getStyle('B15:D17')->getBorders()
		// ->getHorizontal()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
