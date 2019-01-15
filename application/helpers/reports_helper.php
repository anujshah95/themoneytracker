<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Reports Helper
 *
 * @category	Helpers
 * @author		Anuj Shah
*/

// ------------------------------------------------------------------------

if (!function_exists('display_report_btn')){

	function display_report_btn($sSource=NULL){
		if(empty($sSource)) return FALSE;
		$sPDFURL=base_url('generatePDF')."?source=".$sSource;
		$sExcelURL=base_url('generateExcel')."?source=".$sSource;
		$sReturnView="";
        $sReturnView.="<div class='pull-right'>";
            $sReturnView.="<a href='".$sPDFURL."' target='_blank'><button class='btn btn-primary'>PDF</button></a>";
            $sReturnView.="&nbsp;";
            $sReturnView.="<a href='".$sExcelURL."' target='_blank'><button class='btn btn-primary'>Excel</button></a>";
        $sReturnView.="</div>";
        return $sReturnView;
	}
}

if (!function_exists('report_tcpdf')){
	/**
	    * Function Name : report_tcpdf
	    * report_tcpdf is used to display pdf format data.
	    *
	    * @return pdf page
	*/
	function report_tcpdf($arrReportData=NULL,$sSource=NULL)
	{
		$ci =& get_instance();
		if(isset($arrReportData) && isset($sSource) && !empty($sSource)){
		    $sLangPath	= APPPATH.'/libraries/tcpdf/config/lang/eng.php';
		    $sLibPath	= APPPATH.'/libraries/tcpdf/tcpdf.php';

			if(file_exists($sLangPath) && is_readable($sLangPath) && file_exists($sLibPath) && is_readable($sLibPath)){
				require_once($sLangPath); require_once($sLibPath);

				if (!is_object($arrReportData) OR ! method_exists($arrReportData, 'list_fields')){
					$ci->session->set_flashdata('error_message','You must submit a valid result object.');
					redirect($sSource);
				}
				$sPageTitle 	= ucfirst(preg_replace("/[^a-zA-Z]/", " ", $sSource)).' | '.$ci->site_name;
				$sPDFTitle 		= ucfirst(preg_replace("/[^a-zA-Z]/", " ", $sSource)).' Report';
				$sPDFName 		= strtolower(preg_replace("/[^a-zA-Z]/", "-", $sSource)).'-report.pdf';
				// create new PDF document
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Anuj Shah');
				$pdf->SetTitle($sPDFTitle);

				// set default header data
				$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'', PDF_HEADER_STRING);

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				// set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				// set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				// add a page
				$pdf->AddPage();

				//Page title set
				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->Write(0, $sPageTitle, '', 0, 'C', true, 0, false, false, 0);
				$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
				
				// set font
				$pdf->SetFont('helvetica', '', 11);

				//Color Table
		        $pdf->SetFillColor(255, 0, 0);
		        $pdf->SetTextColor(255);
		        $pdf->SetDrawColor(128, 0, 0);
		        $pdf->SetLineWidth(0.3);
		        $pdf->SetFont('', 'B');
		        // Header
		        $iCountHeaders=count($arrReportData->list_fields());
		        if($iCountHeaders==1){
		        	$iWidth=180; 
		        }elseif($iCountHeaders==2){
		        	$iWidth=90; 
		        }elseif($iCountHeaders==3){
		        	$iWidth=60;
		        }elseif($iCountHeaders==4){
		        	$iWidth=45;
		        }elseif($iCountHeaders==5){
		        	$iWidth=35;
		        }else{
		        	$iWidth=30;
		        }

		        $iTotalWidthSum=$iWidth*$iCountHeaders;
				foreach ($arrReportData->list_fields() as $sField){
					$pdf->Cell($iWidth, 10, $sField, 1, 0, 'C', 1);
					//width,height,text,border,fill,align,link
				}
		        $pdf->Ln();
		        // Color and font restoration
		        $pdf->SetFillColor(224, 235, 255);
		        $pdf->SetTextColor(0);
		        $pdf->SetFont('');
		        // Data
		        $fill = 0;
		        if(!empty($arrReportData->result())){
					foreach ($arrReportData->result() as $arrResult){
			    		foreach ($arrReportData->list_fields() as $sField){
				            $pdf->Cell($iWidth, 10, $arrResult->$sField, 'LR', 0, 'L', $fill);
						}
				        $pdf->Ln();
				        $fill=!$fill;
					}
				}else{
					$pdf->Cell($iTotalWidthSum, 10, 'No records found.', 'LR', 0, 'C', $fill);
				    $pdf->Ln();
				    $fill=!$fill;
				}
		        $pdf->Cell($iTotalWidthSum, 0, '', 'T');
				$pdf->Output($sPDFName, 'I');
			}else{
				$ci->session->set_flashdata('error_message','Library path is not proper, please check library path.');
				redirect($sSource);
			}
		}else{
			$ci->session->set_flashdata('error_message','Input parameter is empty');
			redirect($sSource);
		}
	}
}

if (!function_exists('monthly_report_tcpdf')){
	/**
	    * Function Name : monthly_report_tcpdf
	    * monthly_report_tcpdf is used to display pdf format data for particular month.
	    *
	    * @return pdf page
	*/
	function monthly_report_tcpdf($arrReportData=NULL,$sSource=NULL)
	{
		$ci =& get_instance();
		if(isset($arrReportData) && isset($sSource) && !empty($sSource)){
		    $sLangPath	= APPPATH.'/libraries/tcpdf/config/lang/eng.php';
		    $sLibPath	= APPPATH.'/libraries/tcpdf/tcpdf.php';

			if(file_exists($sLangPath) && is_readable($sLangPath) && file_exists($sLibPath) && is_readable($sLibPath)){
				require_once($sLangPath); require_once($sLibPath);

				$sPageTitle 	= $arrReportData['month_year'].' month report'.' | '.$ci->site_name;
				$sPDFTitle 		= $sPageTitle;
				$sPDFName 		= strtolower($arrReportData['month_year'].'-month').'-report.pdf';

				// p($arrReportData);
				// create new PDF document
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

				// set document information
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('Anuj Shah');
				$pdf->SetTitle($sPDFTitle);

				// set default header data
				$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'', PDF_HEADER_STRING);

				// set default monospaced font
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

				// set margins
				$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
				$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

				// set auto page breaks
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

				// set image scale factor
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

				// add a page
				$pdf->AddPage();

				//Page title set
				$pdf->SetFont('helvetica', 'B', 15);
				$pdf->Write(0, $sPageTitle, '', 0, 'C', true, 0, false, false, 0);
				$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
				
				//----------------------------------Income data------------------------------------------------
				//Income title
				$pdf->SetFont('helvetica', 'B', 12);
				$pdf->Write(0, 'Total Income : '.$arrReportData['total_income'], '', 0, 'L', true, 0, false, false, 0);
				$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
				
				// Set font
				$pdf->SetFont('helvetica', '', 11);

				//Color Table
		        $pdf->SetFillColor(255, 0, 0);
		        $pdf->SetTextColor(255);
		        $pdf->SetDrawColor(128, 0, 0);
		        $pdf->SetLineWidth(0.3);
		        $pdf->SetFont('', 'B');

		        // Header
		        $iTotalWidthSum='180';
				$pdf->Cell('60', 10, 'Amount', 1, 0, 'C', 1);
				$pdf->Cell('60', 10, 'Desc', 1, 0, 'C', 1);
				$pdf->Cell('60', 10, 'Date', 1, 0, 'C', 1);
		        $pdf->Ln();

		        // Color and font restoration
		        $pdf->SetFillColor(224, 235, 255);
		        $pdf->SetTextColor(0);
		        $pdf->SetFont('');

		        // Data
		        $fill = 0;
		        if(!empty($arrReportData['income_details'])){
					foreach ($arrReportData['income_details'] as $arrResult){
				        $pdf->Cell('60' ,10, $arrResult->income_amount, 'LR', 0, 'L', $fill);
				        $pdf->Cell('60' ,10, text_cut($arrResult->income_desc,30), 'LR', 0, 'L', $fill);
				        $pdf->Cell('60' ,10, short_date($arrResult->income_date), 'LR', 0, 'L', $fill);
				        $pdf->Ln();
				        $fill=!$fill;
					}
				}else{
					$pdf->Cell($iTotalWidthSum, 10, 'No records found.', 'LR', 0, 'C', $fill);
				    $pdf->Ln();
				    $fill=!$fill;
				}
		        $pdf->Cell($iTotalWidthSum, 0, '', 'T');
		        //------------------------------------------------------------------------------------

		        $pdf->AddPage();

		        //----------------------------------Expenditure data----------------------------------
				//Expenditure title
				$pdf->SetFont('helvetica', 'B', 12);
				$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);
				$pdf->Write(0, 'Total Expenditure : '.$arrReportData['total_exp'], '', 0, 'L', true, 0, false, false, 0);
				$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

				// Set font
				$pdf->SetFont('helvetica', '', 11);

				//Color Table
		        $pdf->SetFillColor(255, 0, 0);
		        $pdf->SetTextColor(255);
		        $pdf->SetDrawColor(128, 0, 0);
		        $pdf->SetLineWidth(0.3);
		        $pdf->SetFont('', 'B');

		        //Header
		        $iTotalWidthSum='180';
				$pdf->Cell('60', 10, 'Category', 1, 0, 'C', 1);
				$pdf->Cell('60', 10, 'Percentage', 1, 0, 'C', 1);
				$pdf->Cell('60', 10, 'Amount', 1, 0, 'C', 1);
		        $pdf->Ln();

		        // Color and font restoration
		        $pdf->SetFillColor(224, 235, 255);
		        $pdf->SetTextColor(0);
		        $pdf->SetFont('');

		        //Expediture Data
		        $fill = 0;
		        if(!empty($arrReportData['exp_details'])){
					foreach ($arrReportData['exp_details'] as $arrResult){
				        $pdf->Cell('60' ,10, $arrResult->cname, 'LR', 0, 'L', $fill);
				        $pdf->Cell('60' ,10, $arrResult->iPercentage, 'LR', 0, 'L', $fill);
				        $pdf->Cell('60' ,10, $arrResult->cat_exp_total, 'LR', 0, 'L', $fill);
				        $pdf->Ln();
				        $fill=!$fill;
					}
				}else{
					$pdf->Cell($iTotalWidthSum, 10, 'No records found.', 'LR', 0, 'C', $fill);
				    $pdf->Ln();
				    $fill=!$fill;
				}
				$pdf->Cell($iTotalWidthSum, 0, '', 'T');

				//Output PDF
				$pdf->Output($sPDFName, 'I');
			}else{
				$ci->session->set_flashdata('error_message','Library path is not proper, please check library path.');
				redirect('reports');
			}
		}else{
			$ci->session->set_flashdata('error_message','Input parameter is empty');
			redirect('reports');
		}
	}
}

if (!function_exists('excel_report')){
	/**
	    * Function Name : excel_report
	    * excel_report is used to generate report in xls format
	    *
	    * @return excel format
	*/
	function excel_report($arrReportData=NULL,$sSource=NULL)
	{
		if(isset($arrReportData) && isset($sSource) && !empty($sSource)){
		    $ci =& get_instance();

			if (!is_object($arrReportData) OR ! method_exists($arrReportData, 'list_fields')){
				$ci->session->set_flashdata('error_message','You must submit a valid result object.');
				redirect($sSource);
			}

			$sPageTitle 	= ucfirst(preg_replace("/[^a-zA-Z]/", " ", $sSource)).' | '.$ci->site_name;
			$sExcelTitle 	= ucfirst(preg_replace("/[^a-zA-Z]/", " ", $sSource)).' Report';
			$sExelFileName 	= strtolower(preg_replace("/[^a-zA-Z]/", "-", $sSource)).'-report.xlsx';
			// $file_name = $module_name."-".date('d-M-y-H:i').".xlsx";
		 	$ci->load->library('excel/PHPExcel');
			$objPHPExcel = new PHPExcel(); // Create new PHPExcel object
			$headerStyle = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 16,
			        'name'  => 'Verdana'
			    ),
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        )
			);

			$contentStyle = array(
			    'font'  => array(
			        'size'  => 10,
			        'name'  => 'Verdana'
			    )
			);
	    	$objPHPExcel->getActiveSheet()->setTitle($sExcelTitle);
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($contentStyle); //Default Style for entrire sheet

			/******* Title ****/
	        $iCountHeaders=count($arrReportData->list_fields());
	        if($iCountHeaders==1){
	        	$sToColumn='A1'; 
	        }elseif($iCountHeaders==2){
	        	$sToColumn='B1';
	        }elseif($iCountHeaders==3){
	        	$sToColumn='C1';
	        }elseif($iCountHeaders==4){
	        	$sToColumn='D1';
	        }elseif($iCountHeaders==5){
	        	$sToColumn='E1';
	        }else{
	        	$sToColumn='C1';
	        }

	    	$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$sToColumn);
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $sPageTitle);
	    	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$sToColumn)->applyFromArray($headerStyle); //Header Cell Style

			/*****Headers*******/
	    	$headerStyle['font']['size'] 			= 12;
	    	$headerStyle['font']['color']['rgb'] 	= 'FFFFFF';
	    	$headerStyle['fill']['type'] 			= PHPExcel_Style_Fill::FILL_SOLID;
	    	$headerStyle['fill']['color']['rgb'] 	= 'FF0000';
	    	$headerStyle['alignment']['horizontal'] = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;

	    	$alpha='A'; $i=3;
			foreach ($arrReportData->list_fields() as $field){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$i, $field);
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha)->setAutoSize(true); //Auto Width
				$objPHPExcel->getActiveSheet()->getStyle($alpha.$i)->applyFromArray($headerStyle); //Header Cell Style
				$alpha++;
			}

			/*****Data*******/
			$headerStyle=array();
			$headerStyle['alignment']=array();
	    	$alpha='A'; $i=4;
	    	if(!empty($arrReportData->result())){
				foreach ($arrReportData->result() as $result){
		    		foreach ($arrReportData->list_fields() as $field){
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$i,$result->$field);
						$objPHPExcel->getActiveSheet()->getStyle($alpha.$i)->applyFromArray($headerStyle); //Header Cell Style
						$alpha++;
					}
					$alpha='A'; $i++;
				}
			}else{
	    		$objPHPExcel->getActiveSheet()->mergeCells('A4:C4');
	    		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'No records found.');
	    		$objPHPExcel->getActiveSheet()->getStyle('A4:C4')->applyFromArray($headerStyle); //Header Cell Style
			}

            $objPHPExcel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$sExelFileName.'"');
	        header('Cache-Control: max-age=0'); // If you're serving to IE 9, then the following may be needed
	        header('Cache-Control: max-age=1'); // If you're serving to IE over SSL, then the following may be needed
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		}else{
			redirect();
		}
	}
}


if (!function_exists('monthly_excel_report')){
	/**
	    * Function Name : monthly_excel_report
	    * monthly_excel_report is used to generate report in xls format for report section
	    *
	    * @return excel format
	*/
	function monthly_excel_report($arrReportData=NULL,$sSource=NULL)
	{
		if(isset($arrReportData) && isset($sSource) && !empty($sSource)){
		    $ci =& get_instance();

			$sPageTitle 	= $arrReportData['month_year'].' month report';
			$sExcelTitle 	= $sPageTitle;
			$sExelFileName 	= strtolower($arrReportData['month_year'].'-month').'-report.xlsx';

			// $file_name = $module_name."-".date('d-M-y-H:i').".xlsx";
		 	$ci->load->library('excel/PHPExcel');
			$objPHPExcel = new PHPExcel(); // Create new PHPExcel object
			$headerStyle = array(
			    'font'  => array(
			        'bold'  => true,
			        'color' => array('rgb' => '000000'),
			        'size'  => 16,
			        'name'  => 'Verdana'
			    ),
		        'alignment' => array(
		            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        )
			);

			$contentStyle = array(
			    'font'  => array(
			        'size'  => 10,
			        'name'  => 'Verdana'
			    )
			);

			$arrIncomeListFields=array('income_amount','income_desc','income_date');
	    	$objPHPExcel->getActiveSheet()->setTitle($sExcelTitle);
			$objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($contentStyle); //Default Style for entrire sheet

			/******* Title ****/
	    	$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $sPageTitle);
	    	$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($headerStyle); //Header Cell Style

	    	$objPHPExcel->getActiveSheet()->mergeCells('A3:C3');
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3','Total Income : '.$arrReportData['total_income']);
	    	$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($headerStyle); //Header Cell Style

			/*****Income Data Headers*******/
	    	$headerStyle['font']['size'] 			= 12;
	    	$headerStyle['font']['color']['rgb'] 	= 'FFFFFF';
	    	$headerStyle['fill']['type'] 			= PHPExcel_Style_Fill::FILL_SOLID;
	    	$headerStyle['fill']['color']['rgb'] 	= 'FF0000';
	    	$headerStyle['alignment']['horizontal'] = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;

	    	/*
	    	$alpha='A'; $i=3;
			foreach ($arrIncomeListFields as $field){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$i, $field);
				$objPHPExcel->getActiveSheet()->getColumnDimension($alpha)->setAutoSize(true); //Auto Width
				$objPHPExcel->getActiveSheet()->getStyle($alpha.$i)->applyFromArray($headerStyle); //Header Cell Style
				$alpha++;
			}
			*/
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5','Amount');
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B5', 'Description');
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', 'Date');
	    	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true); //Auto Width
	    	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); //Auto Width
	    	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); //Auto Width
	    	$objPHPExcel->getActiveSheet()->getStyle('A5:C5')->applyFromArray($headerStyle); //Header Cell Style

			/*****Income Data*******/
			$headerStyle=array();
			$headerStyle['alignment']=array();
	    	$alpha='A'; $i=6;
	    	if(!empty($arrReportData['income_details'])){
				foreach ($arrReportData['income_details'] as $result){
		    		foreach ($arrIncomeListFields as $field){
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$i,$result->$field);
						$objPHPExcel->getActiveSheet()->getStyle($alpha.$i)->applyFromArray($headerStyle); //Header Cell Style
						$alpha++;
					}
					$alpha='A'; $i++;
				}
			}else{
	    		$objPHPExcel->getActiveSheet()->mergeCells('A6:C6');
	    		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', 'No records found.');
	    		$objPHPExcel->getActiveSheet()->getStyle('A6:C6')->applyFromArray($headerStyle); //Header Cell Style
			}
			
			/******* Expenditure Title ****/
			$arrExpListFields=array('cname','iPercentage','cat_exp_total');

	    	$objPHPExcel->getActiveSheet()->mergeCells('E3:G3');
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3','Total Exp : '.$arrReportData['total_exp']);
	    	$objPHPExcel->getActiveSheet()->getStyle('E3:G3')->applyFromArray($headerStyle); //Header Cell Style

	    	/****** Expenditure Headers *******/
	    	$headerStyle['font']['size'] 			= 12;
	    	$headerStyle['font']['bold'] 			= TRUE;
	    	$headerStyle['font']['color']['rgb'] 	= 'FFFFFF';
	    	$headerStyle['fill']['type'] 			= PHPExcel_Style_Fill::FILL_SOLID;
	    	$headerStyle['fill']['color']['rgb'] 	= 'FF0000';
	    	$headerStyle['alignment']['horizontal'] = PHPExcel_Style_Alignment::HORIZONTAL_LEFT;

	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E5','Category');
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F5', 'Percentage');
	    	$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G5', 'Amount');
	    	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); //Auto Width
	    	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); //Auto Width
	    	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); //Auto Width
	    	$objPHPExcel->getActiveSheet()->getStyle('E5:G5')->applyFromArray($headerStyle); //Header Cell Style

			/*****Expenditure Data*******/
			$headerStyle=array();
			$headerStyle['alignment']=array();
	    	$alpha='E'; $i=6;
	    	if(!empty($arrReportData['exp_details'])){
				foreach ($arrReportData['exp_details'] as $result){
		    		foreach ($arrExpListFields as $field){
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue($alpha.$i,$result->$field);
						$objPHPExcel->getActiveSheet()->getStyle($alpha.$i)->applyFromArray($headerStyle); //Header Cell Style
						$alpha++;
					}
					$alpha='E'; $i++;
				}
			}else{
	    		$objPHPExcel->getActiveSheet()->mergeCells('E6:G6');
	    		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E6', 'No records found.');
	    		$objPHPExcel->getActiveSheet()->getStyle('E6:G6')->applyFromArray($headerStyle); //Header Cell Style
			}

            $objPHPExcel->setActiveSheetIndex(0);
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$sExelFileName.'"');
	        header('Cache-Control: max-age=0'); // If you're serving to IE 9, then the following may be needed
	        header('Cache-Control: max-age=1'); // If you're serving to IE over SSL, then the following may be needed
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0
			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		}else{
			redirect();
		}
	}
}