<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of CronJob
 *
 * @author Anuj (http://anujshah.in)
 */

class Reports extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Reports');
        $this->load->model('M_Txn');
    }

    public function index()
    {
        $arrData['header_title']            = 'Reports | '.$this->site_name;
        $arrData['arrReportsDetails']       = $this->M_Reports->reports();
        $arrData['sSideBarReportActive']    = 'active';
        // p($arrData,TRUE);
        display_view('reports/index',$arrData,'true');
  	}

    public function monthly_report_details()
    {
        // p($this->input->post());
        if(!$this->input->post('dMonthYear')){
            $arrReturnPara['iStatus']=FALSE;
            $arrReturnPara['sMsg']='Input parameter is invalid';
            echo json_encode($arrReturnPara);
        }else{
            $dMonthYear = $this->input->post('dMonthYear');
            $arrMonth   = explode('-',$dMonthYear);
            if(!isset($arrMonth[1]) || empty($arrMonth[1])){
                $arrReturnPara['iStatus']=FALSE;
                $arrReturnPara['sMsg']='Input parameter is missing';
                echo json_encode($arrReturnPara);
            }
            $bMonthValidation = validateDate($arrMonth[0],'F'); //e.g. January
            $bYearValidation  = validateDate($arrMonth[1],'Y'); // e.g. 2017(Year)
            if($bMonthValidation===FALSE || $bYearValidation===FALSE){
                $arrReturnPara['iStatus']=FALSE;
                $arrReturnPara['sMsg']='Month name is invalid';
                echo json_encode($arrReturnPara);
            }
            $arrResponse = $this->M_Reports->monthlyReport($dMonthYear);

            if($arrResponse['iStatus']===TRUE){
                $arrData['arrReports'] = get_object_vars($arrResponse['arrData'][0]); //convert stdclass to array
                $sReportView=$this->load->view(VIEW_FOLDER_NAME.'/reports/monthly-report-ajax',$arrData,TRUE);
                echo json_encode(array('iStatus'=>TRUE,'sMsg'=>$sReportView));
            }else{
                //false
                $arrReturnPara['sMsg']=$arrResponse['sMsg'];
                echo json_encode($arrReturnPara);
            }
        }
    }

    public function generatePDF()
    {
        if(!$this->input->get()) redirect();
        $sSource            = $this->input->get('source');
        $sTarget            = $this->input->get('target');
        $arrAllowedSource   = array('income','expenditure','expenses_category','fund','debitors','creditors','investment','monthly-report');
        if(!in_array($sSource,$arrAllowedSource)){
            $this->session->set_flashdata('error_message','Souce is invalid.');
            redirect();
        }
        $arrData['arrReportData']   = "";
        $arrData['sTitle']          = $sSource;
        $sUserName                  = $this->session->userdata('user_name');
        $sUserEmail                 = $this->session->userdata('user_email');
        if(!empty($sTarget)){
            //For monthly report module
            $arrMonth   = explode('-',$sTarget);
            if(!isset($arrMonth[1]) || empty($arrMonth[1])){
                $this->session->set_flashdata('error_message','Input parameter is missing');
                redirect("reports");
            }
            $bMonthValidation = validateDate($arrMonth[0],'F'); //e.g. January
            $bYearValidation  = validateDate($arrMonth[1],'Y'); // e.g. 2017(Year)
            if($bMonthValidation===FALSE || $bYearValidation===FALSE){
                $this->session->set_flashdata('error_message','Input parameter is invalid.');
                redirect("reports");
            }
            $arrResponse                = $this->M_Reports->monthlyReport($sTarget);
            $arrData['arrReportData']   = get_object_vars($arrResponse['arrData'][0]); //convert stdclass to array
            custom_write_log('info',$sUserName.'['.$sUserEmail.']'.' requested for '.$sSource.'-'.$sTarget.' pdf report');
            monthly_report_tcpdf($arrData['arrReportData'],$arrData['sTitle']);
        }else{
            //For individual page module
            $arrReportData  = $this->M_Reports->generateReport($sSource,$sTarget);
            if($arrReportData['iStatus']===FALSE){
                $this->session->set_flashdata('error_message',$arrReportData['sMessage']);
                redirect();
            }
            if($arrReportData['iStatus']===TRUE){
                $arrData['arrReportData']=$arrReportData['arrData'];   
            }
            custom_write_log('info',$sUserName.'['.$sUserEmail.']'.' requested for '.$sSource.' pdf report');
            report_tcpdf($arrData['arrReportData'],$arrData['sTitle']);
        }
        // $sPDFView=$this->load->view(VIEW_FOLDER_NAME.'/reports/pdfReport',$arrData,TRUE);
        // tcpdf($sPDFView,$arrData['arrReportData'],$arrData['sTitle']);   
    }

    public function generateExcel()
    {
        if(!$this->input->get()) redirect();
        $sSource            = $this->input->get('source');
        $sTarget            = $this->input->get('target');
        $arrAllowedSource   = array('income','expenditure','expenses_category','fund','debitors','creditors','investment','monthly-report');
        if(!in_array($sSource,$arrAllowedSource)){
            $this->session->set_flashdata('error_message','Souce is invalid.');
            redirect();
        }
        $arrData['arrReportData']   = "";
        $arrData['sTitle']          = $sSource;
        $sUserName                  = $this->session->userdata('user_name');
        $sUserEmail                 = $this->session->userdata('user_email');

        if(!empty($sTarget)){
            //For monthly report module
            $arrMonth   = explode('-',$sTarget);
            if(!isset($arrMonth[1]) || empty($arrMonth[1])){
                $this->session->set_flashdata('error_message','Input parameter is missing');
                redirect("reports");
            }
            $bMonthValidation = validateDate($arrMonth[0],'F'); //e.g. January
            $bYearValidation  = validateDate($arrMonth[1],'Y'); // e.g. 2017(Year)
            if($bMonthValidation===FALSE || $bYearValidation===FALSE){
                $this->session->set_flashdata('error_message','Input parameter is invalid.');
                redirect("reports");
            }
            $arrResponse                = $this->M_Reports->monthlyReport($sTarget);
            $arrData['arrReportData']   = get_object_vars($arrResponse['arrData'][0]); //convert stdclass to array
            custom_write_log('info',$sUserName.'['.$sUserEmail.']'.' requested for '.$sSource.'-'.$sTarget.' excel report');
            monthly_excel_report($arrData['arrReportData'],$arrData['sTitle']);
        }else{
            //For individual page module
            $arrReportData  = $this->M_Reports->generateReport($sSource,$sTarget);
            if($arrReportData['iStatus']===FALSE){
                $this->session->set_flashdata('error_message',$arrReportData['sMessage']);
                redirect();
            }
            if($arrReportData['iStatus']===TRUE){
                $arrData['arrReportData']=$arrReportData['arrData'];   
            }
            custom_write_log('info',$sUserName.'['.$sUserEmail.']'.' requested for '.$sSource.' excel report');
            excel_report($arrData['arrReportData'],$arrData['sTitle']);
        }
        // $sPDFView=$this->load->view(VIEW_FOLDER_NAME.'/reports/pdfReport',$arrData,TRUE);
        // tcpdf($sPDFView,$arrData['arrReportData'],$arrData['sTitle']);   
    }

    function test()
    {
        /*
        $sUserName=$this->session->userdata('user_name');
        $sUserEmail=$this->session->userdata('user_email');
        p(custom_write_log('info','adasdasdd'));
        */
        /*       
        $sSource='income';
        $sTarget="";
        $data='INFO - '.date('d-m-y h:i:s').' --> '.$this->session->userdata('user_name').'['.$this->session->userdata('user_email').'] requested '.$sSource.' report['.$sTarget.']';
         $myfile = file_put_contents('logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);

        if (!write_file(APPPATH."user-activity/user-site-activity.txt", $data)){ 
            echo 'Unable to write the file';
        }else{ 
            echo 'File written!';
        }
        */
    }
}

?>