<?php 
	
	// Panggil class PHPExcel nya
	$excel = new PHPExcel();

	// Settingan awal fil excel
	$excel->getProperties()->setCreator('DISKOMINFO')
							->setLastModifiedBy('Erdeft')
							->setTitle("Cetak Label Aset ".date('dmY'))
							->setSubject("Aset Diskominfo Kab. Magelang")
							->setDescription("Cetak Label Aset Diskominfo")
							->setKeywords("Cetak Label Aset");

	// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	$style1 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => TRUE,
	      	'size' => (10)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		// 'fill' => array(
        //     'type' => PHPExcel_Style_Fill::FILL_SOLID,
        //     'color' => array('rgb' => 'ffffff')
        // )
	);

    $style2 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => FALSE,
	      	'size' => (8)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			// 'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			// 'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		// 'fill' => array(
        //     'type' => PHPExcel_Style_Fill::FILL_SOLID,
        //     'color' => array('rgb' => 'ffffff')
        // )
	);

    $style3 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => FALSE,
	      	'size' => (8)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			// 'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		// 'fill' => array(
        //     'type' => PHPExcel_Style_Fill::FILL_SOLID,
        //     'color' => array('rgb' => 'ffffff')
        // )
	);

    $style4 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => FALSE,
	      	'size' => (6)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		),
		// 'fill' => array(
        //     'type' => PHPExcel_Style_Fill::FILL_SOLID,
        //     'color' => array('rgb' => 'ffffff')
        // )
	);

    $style5 = array(
		'font' => array(
			'name'  => 'Arial',
	      	'bold' => FALSE,
	      	'size' => (6)
		),
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP // Set text jadi di tengah secara vertical (middle)
        ),
        // 'borders' => array(
		// 	'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		// 	'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		// 	'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		// 	'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		// ),
		// 'fill' => array(
        //     'type' => PHPExcel_Style_Fill::FILL_SOLID,
        //     'color' => array('rgb' => 'ffffff')
        // )
	);
	

	// BARIS HEADER
	// $excel->setActiveSheetIndex(0)->setCellValue('A'.$row_first, "NO");
	// $excel->setActiveSheetIndex(0)->getStyle('A'.$row_first)->getAlignment()->setWrapText(true);

	// $excel->setActiveSheetIndex(0)->setCellValue('B'.$row_first, "TANGGAL");
	// $excel->setActiveSheetIndex(0)->getStyle('B'.$row_first)->getAlignment()->setWrapText(true);

	// $excel->setActiveSheetIndex(0)->setCellValue('C'.$row_first, "RINCIAN SETORAN");
	// $excel->setActiveSheetIndex(0)->getStyle('C'.$row_first)->getAlignment()->setWrapText(true);

	// $excel->setActiveSheetIndex(0)->setCellValue('D'.$row_first, "JUMLAH (Rp)");
	// $excel->setActiveSheetIndex(0)->getStyle('D'.$row_first)->getAlignment()->setWrapText(true);

	// $excel->setActiveSheetIndex(0)->setCellValue('E'.$row_first, "SUB TOTAL (Rp)");
	// $excel->setActiveSheetIndex(0)->getStyle('E'.$row_first)->getAlignment()->setWrapText(true);

	// Apply style 
	// $excel->getActiveSheet()->getStyle('A'.$row_first)->applyFromArray($style_header1);
	// $excel->getActiveSheet()->getStyle('B'.$row_first)->applyFromArray($style_header1);
	// $excel->getActiveSheet()->getStyle('C'.$row_first)->applyFromArray($style_header1);
	// $excel->getActiveSheet()->getStyle('D'.$row_first)->applyFromArray($style_header1);
	// $excel->getActiveSheet()->getStyle('E'.$row_first)->applyFromArray($style_header2);

	// Set Repeat Header
	// $excel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1,4);

	// Set width column
    $addwith = 0.7;
	// $excel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
	// $excel->getActiveSheet()->getColumnDimension('B')->setWidth(9.3);
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(11.2);
	// $excel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
	$excel->getActiveSheet()->getColumnDimension('D')->setWidth(1.4);
	$excel->getActiveSheet()->getColumnDimension('E')->setWidth(26.2);
	// $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20.7);
	$excel->getActiveSheet()->getColumnDimension('F')->setWidth(3);
	$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

    // Set height all row
	$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(14);

    // Set margin
    $excel->getActiveSheet()->getPageMargins()->setTop(0.5);
    $excel->getActiveSheet()->getPageMargins()->setRight(0.5);
    $excel->getActiveSheet()->getPageMargins()->setLeft(0.5);
    // $excel->getActiveSheet()->getPageMargins()->setBottom(1);

    // Setting the print area
    $jml_data_aset      = count($dataAset);
    $jml_data_per_page  = 8;
    $jml_page           = ceil($jml_data_aset / $jml_data_per_page);
    $first_column       = 'A';
    $first_row          = 1;
    $last_column        = 'H';
    $last_row           = 56;

    $param_print = array();
    for ($i=1; $i <= $jml_page; $i++) { 
        $param_print[] = $first_column.$first_row.':'.$last_column.($last_row * $i);
        $first_row += $last_row;
    }
    
    $excel->getActiveSheet()->getPageSetup()->setPrintArea(implode(',', $param_print));

    // ==============================================================

	// BARIS BODY / ISI DATA
    $row         = 1;
    $merge_1     = 5;
    $row_merge_1 = 5;
    $merge_2     = 3;
    $row_merge_2 = 3;
    $space_row   = 1;
	foreach ($dataAset as $val) { 
		$no++;

        $kode_aset = explode('-', $val->kode_baru_aset);
        $kode_lokasi = $kode_aset[0];
        $kode_barang = $kode_aset[1];

        $imgCode = new PHPExcel_Worksheet_Drawing();
        $imgCode->setName('Kode Aset');
        $imgCode->setDescription('Kode Aset');
        $imgCode->setPath(FCPATH.'assets/img/qrcode/'.$val->id_aset.'_code.png');
        $imgCode->setCoordinates('A'.$row); 

        //setOffsetX works properly
        $imgCode->setOffsetX(3); 
        $imgCode->setOffsetY(3);   
                     
        //set width, height
        $imgCode->setWidth(85); 
        // $imgCode->setHeight(80); 

        $imgCode->setWorksheet($excel->getActiveSheet());

        // =================================================
        $imgLogo = new PHPExcel_Worksheet_Drawing();
        $imgLogo->setName('Logo Kab Mgl');
        $imgLogo->setDescription('Logo Kab Mgl');
        $imgLogo->setPath(FCPATH.'assets/img/logo/logo_kab_md.png');
        $imgLogo->setCoordinates('B'.$row);         

        //setOffsetX works properly
        $imgLogo->setOffsetX(5); 
        $imgLogo->setOffsetY(9);        

        //set width, height
        // $imgLogo->setWidth(70); 
        $imgLogo->setHeight(75); 

        $imgLogo->setWorksheet($excel->getActiveSheet());

        // ==================================================

        $excel->getActiveSheet()->mergeCells('A'.$row.':A'.$row_merge_1);
        $excel->getActiveSheet()->mergeCells('B'.$row.':B'.$row_merge_1);

        $excel->getActiveSheet()->mergeCells('C'.$row.':E'.$row_merge_2);
		$excel->getActiveSheet()->setCellValue('C'.$row, "PEMERINTAH KABUPATEN MAGELANG\nDINAS KOMUNIKASI DAN INFORMATIKA");
        $excel->getActiveSheet()->getStyle('C'.$row)->getAlignment()->setWrapText(true);
        
        $excel->getActiveSheet()->setCellValue('C'.($row+$merge_2), 'KODE LOKASI');
        $excel->getActiveSheet()->setCellValue('D'.($row+$merge_2), ':');
        $excel->getActiveSheet()->setCellValue('E'.($row+$merge_2), $kode_lokasi);

        $excel->getActiveSheet()->setCellValue('C'.($row+$merge_2+1), 'KODE BARANG');
        $excel->getActiveSheet()->setCellValue('D'.($row+$merge_2+1), ':');
        $excel->getActiveSheet()->setCellValue('E'.($row+$merge_2+1), $kode_barang);

        $excel->getActiveSheet()->mergeCells('A'.($row_merge_1 + 1).':E'.($row_merge_1 + 1));
		$excel->getActiveSheet()->setCellValue('A'.($row_merge_1 + 1), $val->nama_aset);
        $excel->getActiveSheet()->getStyle('A'.($row_merge_1 + 1))->getAlignment()->setWrapText(true);

        // Set Row auto height according to content
        $row_name_aset = $row_merge_1 + 1;
        $excel->getActiveSheet()->getRowDimension($row_name_aset)->setRowHeight(-1);

        $excel->getActiveSheet()->mergeCells('G'.$row.':H'.($row_merge_1 + 1));
		$excel->getActiveSheet()->setCellValue('G'.$row, "$val->nama_aset\n$val->merk_aset\n$val->sn_aset\n".nominal($val->harga_aset)."\n$kode_barang");
        $excel->getActiveSheet()->getStyle('G'.$row.':H'.($row_merge_1 + 1))->getAlignment()->setWrapText(true);


		// Apply style
		$excel->getActiveSheet()->getStyle('A'.$row.':A'.$row_merge_1)->applyFromArray($style4);
		$excel->getActiveSheet()->getStyle('B'.$row.':B'.$row_merge_1)->applyFromArray($style4);
		$excel->getActiveSheet()->getStyle('C'.$row.':E'.$row_merge_2)->applyFromArray($style1);
		$excel->getActiveSheet()->getStyle('C'.($row+$merge_2))->applyFromArray($style2);
		$excel->getActiveSheet()->getStyle('D'.($row+$merge_2))->applyFromArray($style2);
		$excel->getActiveSheet()->getStyle('E'.($row+$merge_2))->applyFromArray($style3);
        $excel->getActiveSheet()->getStyle('C'.($row+$merge_2+1))->applyFromArray($style2);
		$excel->getActiveSheet()->getStyle('D'.($row+$merge_2+1))->applyFromArray($style2);
		$excel->getActiveSheet()->getStyle('E'.($row+$merge_2+1))->applyFromArray($style3);
		$excel->getActiveSheet()->getStyle('A'.($row_merge_1 + 1).':E'.($row_merge_1 + 1))->applyFromArray($style4);
		$excel->getActiveSheet()->getStyle('G'.$row.':H'.($row_merge_1 + 1))->applyFromArray($style5);

        $row         += $merge_1 + $space_row + 1;
        $row_merge_1 += $merge_1 + $space_row + 1;
        $row_merge_2 += $merge_1 + $space_row + 1;
	}


	// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	// $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

	// Set orientasi kertas jadi PORTRAIT
	$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
	$excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

	// Set Footer
	$excel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R Halaman Ke-&P dari &N');
	$excel->getActiveSheet()->getHeaderFooter()->setEvenFooter('&R Halaman Ke-&P dari &N');

	// Set judul file excel nya
	$excel->getActiveSheet(0)->setTitle("Cetak Label Aset ".date('dmY'));
	$excel->setActiveSheetIndex(0);
	// Proses file excel
	ob_end_clean();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="Cetak Label Aset '.date('dmY').'.xlsx"'); // Set nama file excel nya
	header('Cache-Control: max-age=0');
	ob_end_clean();
	$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	$write->save('php://output');

 ?>