<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Txn
 *
 * @author Anuj (http://anujshah.in)
 */

class Txn extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Txn');
    }

    public function index($sMonth="")
    {
        $data['header_title']='Income | '.$this->site_name;
        if(!empty($sMonth)){
        	$arrMonth	= explode('-',$sMonth);
        	if(!isset($arrMonth[1]) || empty($arrMonth[1])) redirect('income');
        	$bMonthValidation	= validateDate($arrMonth[0],'F'); //e.g. January
        	$bYearValidation	= validateDate($arrMonth[1],'Y'); // e.g. 2017(Year)
        	if($bMonthValidation===FALSE || $bYearValidation===FALSE) redirect('income');
        }
    	$data['income_details']=$this->M_Common->get_data_f('income',"",$sMonth);
    	$data['sSideBarIncomeActive']	= 'active';
        display_view('txn/income/index',$data,'true');
  	}

	public function add_income()
	{
        if($this->input->post()){
			$this->form_validation->set_rules('income_amount', 'Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('income_desc', 'Description', 'trim|required|min_length[2]|max_length[128]');
			$this->form_validation->set_rules('income_date', 'Date', 'trim|required');
	   
	    	if($this->form_validation->run() === TRUE){
				$income_date=strtotime($this->input->post('income_date'));
				$income_date = date('Y-m-d',$income_date);

				$add_data = array(
					'user_id'=>$this->user_id,
					'income_amount'=>$this->input->post('income_amount'),
					'income_desc'=>$this->input->post('income_desc'),
					'income_date'=>$income_date,
					'created_date'=>date('Y-m-d H:i:s'),
					'updated_date'=>date('Y-m-d H:i:s'),
				);
					
				$status=$this->M_Common->insert_f('income',$add_data);

				if($status===TRUE){
					$this->session->set_flashdata('success_message','Added successfully.');
					redirect('income');
				}
				if($status===FALSE){
					$this->session->set_flashdata('error_message','Fail to add.');
					redirect('add-income');
				}
			}
        }
        $data['header_title']='Add income | '.$this->site_name;
        $data['sSideBarIncomeActive']	= 'active';
        display_view('txn/income/add_income',$data,'true');
	}

	public function update_income($id="")
	{
		if($this->input->post()){
			$id=$this->input->post('income_id');
			if(empty($id) || !is_numeric($id)) redirect('income');
			$this->form_validation->set_rules('income_amount', 'Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('income_desc', 'Description', 'trim|required|min_length[2]|max_length[128]');
			$this->form_validation->set_rules('income_date', 'Date', 'trim|required');
	   
	    	if ($this->form_validation->run() === TRUE){
				$income_date=strtotime($this->input->post('income_date'));
				$income_date = date('Y-m-d',$income_date);

				$update_data = array(
					'income_id'=>$id,
					'income_amount'=>$this->input->post('income_amount'),
					'income_date'=>$income_date,
					'income_desc'=>$this->input->post('income_desc'),
					'updated_date'=>date('Y-m-d H:i:s'),
				);
					
				$status=$this->M_Common->update_f('income',$update_data);

				if($status===TRUE){
					$this->session->set_flashdata('success_message','Updated successfully.');
					redirect('income');
				}
				if($status===FALSE){
					$this->session->set_flashdata('error_message','Fail to update.');
					redirect('update-income/'.$id);
				}
			}
		}else{
			if(empty($id)) redirect();
		}

        $data['header_title']='Edit Income | '.$this->site_name;
        $data['sSideBarIncomeActive']	= 'active';
        $data['income_details']=$this->M_Common->get_data_f('income',$id);
        if(empty($data['income_details'])) redirect('income');
        display_view('txn/income/edit_income',$data,'true');
	}

    public function expenses_category()
    {
        $data['header_title']='Expenses Category | '.$this->site_name;
        $data['sSideBarExpensesActive']='active';
        $data['sSideBarExpCatActive']='active';
    	$data['expenses_category']=$this->M_Common->get_data_f('expenses_category');
        display_view('txn/expenses_category/expenses_category',$data,'true');
  	}

	public function add_expenses_category()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('cname','Category Name','trim|required|min_length[4]|callback_form_validate[customAlpha]');
	   
	    	if ($this->form_validation->run() === TRUE){
				$cname=$this->input->post('cname');
				$unique_cname=$this->M_Txn->check_unique_cname($cname);

				if($unique_cname===TRUE){
					$this->session->set_flashdata('error_message','Category name already exists.');
					redirect('add-expenses-category');
				}
				$add_data = array(
					'user_id'=>$this->user_id,
					'cname'=>$cname,
					'cname_slug'=>clean_url($cname),
					'created_date'=>date('Y-m-d H:i:s'),
					'updated_date'=>date('Y-m-d H:i:s'),
				);
					
				$status=$this->M_Common->insert_f('expenses_category',$add_data);

				if($status===TRUE){
					$this->session->set_flashdata('success_message','Added successfully.');
					redirect('expenses-category');
				}
				if($status===FALSE){
					$this->session->set_flashdata('error_message','Fail to add.');
					redirect('add-expenses-category');
				}
			}
		}
        $data['header_title']='Add Expenses Category | '.$this->site_name;
        $data['sSideBarExpensesActive']='active';
        $data['sSideBarExpCatActive']='active';
        display_view('txn/expenses_category/add_expenses_category',$data,'true');
	}

	public function update_expenses_category($id="")
	{
		if($this->input->post()){
			$expenses_category_id=$this->input->post('expenses_category_id');
			if(empty($expenses_category_id) || !is_numeric($expenses_category_id)) redirect('expenses-category');
			$this->form_validation->set_rules('cname', 'Category Name', 'trim|required|min_length[4]|callback_form_validate[customAlpha]');
	   
	    	if ($this->form_validation->run() === TRUE){
				$cname=$this->input->post('cname');
				$unique_cname=$this->M_Txn->check_unique_cname($cname);

				if($unique_cname===TRUE){
					$this->session->set_flashdata('error_message','Category name already exists.');
					redirect('update-expenses-category/'.$expenses_category_id);
				}
				$update_data = array(
					'expenses_category_id'=>$expenses_category_id,
					'cname'=>$this->input->post('cname'),
					'cname_slug'=>clean_url($this->input->post('cname')),
					'updated_date'=>date('Y-m-d H:i:s'),
				);
					
				$status=$this->M_Common->update_f('expenses_category',$update_data);

				if($status===TRUE){
					$this->session->set_flashdata('success_message','Updated successfully.');
					redirect('expenses-category');
				}
				if($status===FALSE){
					$this->session->set_flashdata('error_message','Fail to update.');
					redirect('update-expenses-category/'.$expenses_category_id);
				}
			}			
		}else{
			if(empty($id)) redirect();
		}

        $data['header_title']='Edit Expenses Category | '.$this->site_name;
        $data['expenses_category']=$this->M_Common->get_data_f('expenses_category',$id);
        $data['sSideBarExpensesActive']='active';
        $data['sSideBarExpCatActive']='active';
        if(empty($data['expenses_category'])) redirect('expenses-category');
        display_view('txn/expenses_category/edit_expenses_category',$data,'true');
	}

    public function expenditure($sMonth="",$sCname="")
    {
        $arrData['header_title']='Expenditure | '.$this->site_name;
        if(!empty($sMonth)){
        	$arrMonth	= explode('-',$sMonth);
        	if(!isset($arrMonth[1]) || empty($arrMonth[1])) redirect('expenditure');
        	$bMonthValidation	= validateDate($arrMonth[0],'F'); //e.g. may
        	$bYearValidation	= validateDate($arrMonth[1],'Y'); // e.g. 2017(Year)
        	if($bMonthValidation===FALSE || $bYearValidation===FALSE) redirect('expenditure');
        }
    	$arrData['expenditure']=$this->M_Txn->get_exp_data_f('',$sMonth,$sCname);
        $arrData['sSideBarExpensesActive']='active';
        $arrData['sSideBarExpenditureActive']='active';
        display_view('txn/expenditure/expenditure',$arrData,'true');
  	}

	public function add_expenditure()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('exp_amt', 'Expenditure Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('exp_desc', 'Expenditure Description', 'trim|required|min_length[2]|max_length[128]');
			$this->form_validation->set_rules('exp_cat', 'Expenditure Category', 'trim|required');
			$this->form_validation->set_rules('exp_date', 'Payment Date', 'trim|required');
	   
	    	if ($this->form_validation->run() === TRUE){
				$payment_date=strtotime($this->input->post('exp_date'));
				$payment_date = date('Y-m-d',$payment_date);

				$add_data = array(
					'user_id'=>$this->user_id,
					'exp_amount'=>$this->input->post('exp_amt'),
					'exp_desc'=>$this->input->post('exp_desc'),
					'exp_category'=>$this->input->post('exp_cat'),
					'exp_date'=>$payment_date,
					'created_date'=>date('Y-m-d H:i:s'),
					'updated_date'=>date('Y-m-d H:i:s'),
				);
					
				$status=$this->M_Common->insert_f('expenditure',$add_data);

				if($status===TRUE){
					$this->session->set_flashdata('success_message','Added successfully.');
					redirect('expenditure/'.date('F-Y'));
				}
				if($status===FALSE){
					$this->session->set_flashdata('error_message','Fail to add.');
					redirect('add-expenditure');
				}
			}
		}
        $data['header_title']='Add Expenditure | '.$this->site_name;
        $data['exp_cat']=$this->M_Common->get_data_f('expenses_category');
        $data['sSideBarExpensesActive']='active';
        $data['sSideBarExpenditureActive']='active';
        display_view('txn/expenditure/add_expenditure',$data,'true');
	}

	public function update_expenditure($id="")
	{
		if($this->input->post()){
			$exp_id=$this->input->post('exp_id');
			if(empty($exp_id) || !is_numeric($exp_id)) redirect('expenditure');
			$this->form_validation->set_rules('exp_amt', 'Expenditure Amount', 'trim|required|numeric');
			$this->form_validation->set_rules('exp_desc', 'Expenditure Description', 'trim|required|min_length[2]|max_length[128]');
			$this->form_validation->set_rules('exp_cat', 'Expenditure Category', 'trim|required');
			$this->form_validation->set_rules('exp_date', 'Payment Date', 'trim|required');
	   
	    	if ($this->form_validation->run() === TRUE){
				$exp_date=strtotime($this->input->post('exp_date'));
				$exp_date = date('Y-m-d',$exp_date);

				$update_data = array(
					'expenditure_id'=>$exp_id,
					'exp_amount'=>$this->input->post('exp_amt'),
					'exp_desc'=>$this->input->post('exp_desc'),
					'exp_category'=>$this->input->post('exp_cat'),
					'exp_date'=>$exp_date,
					'updated_date'=>date('Y-m-d H:i:s'),
				);
					
				$status=$this->M_Common->update_f('expenditure',$update_data);

				if($status===TRUE){
					$this->session->set_flashdata('success_message','Updated successfully.');
					redirect('expenditure');
				}
				if($status===FALSE){
					$this->session->set_flashdata('error_message','Fail to update.');
					redirect('update_expenditure/'.$exp_id);
				}
			}
		}else{
			if(empty($id)) redirect();
		}

        $data['header_title']='Edit Expenditure | '.$this->site_name;
        $data['expenditure']=$this->M_Txn->get_exp_data_f($id);
        $data['exp_cat']=$this->M_Common->get_data_f('expenses_category');
        $data['sSideBarExpensesActive']='active';
        $data['sSideBarExpenditureActive']='active';
        if(empty($data['expenditure'])) redirect('expenditure');
        display_view('txn/expenditure/edit_expenditure',$data,'true');
	}
}

?>