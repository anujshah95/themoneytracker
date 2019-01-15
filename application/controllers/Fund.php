<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Fund
 *
 * @author Anuj (http://anujshah.in)
 */

class Fund extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Fund');
    }

    public function index()
    {
        $data['header_title']='Fund | '.$this->site_name;
        $data['sSideBarFundActive']	= 'active';
    	$data['fund_details']=$this->M_Common->get_data_f('fund');
        display_view('fund/fund/index',$data,'true');
  	}

	public function add_fund()
	{
        $data['header_title']='Add fund | '.$this->site_name;
        $data['sSideBarFundActive']	= 'active';
        display_view('fund/fund/add_fund',$data,'true');
	}

	public function add_fund_data()
	{
		$this->form_validation->set_rules('fund_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('fund_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->add_fund();
		}else{
			$add_data = array(
				'user_id'=>$this->user_id,
				'fund_amount'=>$this->input->post('fund_amount'),
				'fund_desc'=>$this->input->post('fund_desc'),
				'created_date'=>date('Y-m-d H:i:s'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->insert_f('fund',$add_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Added successfully.');
				redirect('fund');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to add.');
				redirect('add-fund');
			}
		}
	}

	public function edit_fund($id="")
	{
		if(empty($id) || !is_numeric($id)) redirect();
        $data['header_title']='Edit fund | '.$this->site_name;
        $data['fund_details']=$this->M_Common->get_data_f('fund',$id);
        $data['sSideBarFundActive']	= 'active';
        if(empty($data['fund_details'])) redirect('fund');
        display_view('fund/fund/edit_fund',$data,'true');
	}

	public function edit_fund_data()
	{
		$fund_id=$this->input->post('fund_id');
		if(empty($fund_id) || !is_numeric($fund_id)) redirect('fund');
		$this->form_validation->set_rules('fund_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('fund_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->edit_fund($fund_id);
		}else{
			$update_data = array(
				'fund_id'=>$fund_id,
				'fund_amount'=>$this->input->post('fund_amount'),
				'fund_desc'=>$this->input->post('fund_desc'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->update_f('fund',$update_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Updated successfully.');
				redirect('fund');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to update.');
				$this->edit_fund($fund_id);
			}
		}
	}

    public function debitors()
    {
        $data['header_title']='Debitors | '.$this->site_name;
    	$data['debitors_details']=$this->M_Common->get_data_f('debitors');
    	$data['sSideBarDebitorsActive']	= 'active';
        display_view('fund/debitors/debitors',$data,'true');
  	}

	public function add_debitors()
	{
        $data['header_title']='Add debitors | '.$this->site_name;
        $data['sSideBarDebitorsActive']	= 'active';
        display_view('fund/debitors/add_debitors',$data,'true');
	}

	public function add_debitors_data()
	{
		$this->form_validation->set_rules('debitors_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('debitors_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->add_debitors();
		}else{
			$add_data = array(
				'user_id'=>$this->user_id,
				'debitors_amount'=>$this->input->post('debitors_amount'),
				'debitors_desc'=>$this->input->post('debitors_desc'),
				'created_date'=>date('Y-m-d H:i:s'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->insert_f('debitors',$add_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Added successfully.');
				redirect('debitors');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to add.');
				redirect('add-debitors');
			}
		}
	}

	public function edit_debitors($id="")
	{
		if(empty($id) || !is_numeric($id)) redirect();
        $data['header_title']='Edit debitors | '.$this->site_name;
        $data['debitors_details']=$this->M_Common->get_data_f('debitors',$id);
        $data['sSideBarDebitorsActive']	= 'active';
        if(empty($data['debitors_details'])) redirect('fund');
        display_view('fund/debitors/edit_debitors',$data,'true');
	}

	public function edit_debitors_data()
	{
		$debitors_id=$this->input->post('debitors_id');
		if(empty($debitors_id) || !is_numeric($debitors_id)) redirect('debitors');
		$this->form_validation->set_rules('debitors_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('debitors_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->edit_debitors($debitors_id);
		}else{
			$update_data = array(
				'debitors_id'=>$debitors_id,
				'debitors_amount'=>$this->input->post('debitors_amount'),
				'debitors_desc'=>$this->input->post('debitors_desc'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->update_f('debitors',$update_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Updated successfully.');
				redirect('debitors');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to update.');
				$this->edit_debitors($debitors_id);
			}
		}
	}

    public function creditors()
    {
        $data['header_title']='Creditors | '.$this->site_name;
    	$data['creditors_details']=$this->M_Common->get_data_f('creditors');
    	$data['sSideBarCreditorsActive']	= 'active';
        display_view('fund/creditors/creditors',$data,'true');
  	}

	public function add_creditors()
	{
        $data['header_title']='Add creditors | '.$this->site_name;
        $data['sSideBarCreditorsActive']	= 'active';
        display_view('fund/creditors/add_creditors',$data,'true');
	}

	public function add_creditors_data()
	{
		$this->form_validation->set_rules('creditors_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('creditors_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->add_creditors();
		}else{
			$add_data = array(
				'user_id'=>$this->user_id,
				'creditors_amount'=>$this->input->post('creditors_amount'),
				'creditors_desc'=>$this->input->post('creditors_desc'),
				'created_date'=>date('Y-m-d H:i:s'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->insert_f('creditors',$add_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Added successfully.');
				redirect('creditors');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to add.');
				redirect('add-creditors');
			}
		}
	}

	public function edit_creditors($id="")
	{
		if(empty($id) || !is_numeric($id)) redirect();
        $data['header_title']='Edit creditors | '.$this->site_name;
        $data['creditors_details']=$this->M_Common->get_data_f('creditors',$id);
        $data['sSideBarCreditorsActive']	= 'active';
        if(empty($data['creditors_details'])) redirect('creditors');
        display_view('fund/creditors/edit_creditors',$data,'true');
	}

	public function edit_creditors_data()
	{
		$creditors_id=$this->input->post('creditors_id');
		if(empty($creditors_id) || !is_numeric($creditors_id)) redirect('creditors');
		$this->form_validation->set_rules('creditors_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('creditors_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->edit_creditors($creditors_id);
		}else{
			$update_data = array(
				'creditors_id'=>$creditors_id,
				'creditors_amount'=>$this->input->post('creditors_amount'),
				'creditors_desc'=>$this->input->post('creditors_desc'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->update_f('creditors',$update_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Updated successfully.');
				redirect('creditors');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to update.');
				$this->edit_creditors($creditors_id);
			}
		}
	}

    public function investment()
    {
        $data['header_title']='Investment | '.$this->site_name;
        $data['sSideBarInvestmentActive']	= 'active';
    	$data['investment_details']=$this->M_Common->get_data_f('investment');
        display_view('fund/investment/investment',$data,'true');
  	}

	public function add_investment()
	{
        $data['header_title']='Add investment | '.$this->site_name;
        $data['sSideBarInvestmentActive']	= 'active';
        display_view('fund/investment/add_investment',$data,'true');
	}

	public function add_investment_data()
	{
		$this->form_validation->set_rules('investment_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('investment_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('investment_date', 'Date', 'trim|required');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->add_investment();
		}else{
			$investment_date=strtotime($this->input->post('investment_date'));
			$investment_date = date('Y-m-d',$investment_date);

			$add_data = array(
				'user_id'=>$this->user_id,
				'investment_amount'=>$this->input->post('investment_amount'),
				'investment_desc'=>$this->input->post('investment_desc'),
				'investment_date'=>$investment_date,
				'created_date'=>date('Y-m-d H:i:s'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->insert_f('investment',$add_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Added successfully.');
				redirect('investment');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to add.');
				redirect('add_investment');
			}
		}
	}

	public function edit_investment($id="")
	{
		if(empty($id) || !is_numeric($id)) redirect();
        $data['header_title']='Edit investment | '.$this->site_name;
        $data['investment_details']=$this->M_Common->get_data_f('investment',$id);
        $data['sSideBarInvestmentActive']	= 'active';
        if(empty($data['investment_details'])) redirect('investment');
        display_view('fund/investment/edit_investment',$data,'true');
	}

	public function edit_investment_data()
	{
		$investment_id=$this->input->post('investment_id');
		if(empty($investment_id) || !is_numeric($investment_id)) redirect('investment');
		$this->form_validation->set_rules('investment_amount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('investment_desc', 'Description', 'trim|required|min_length[2]|max_length[50]');
		$this->form_validation->set_rules('investment_date', 'Date', 'trim|required');
   
    	if ($this->form_validation->run() == FALSE){
    		$this->edit_investment($investment_id);
		}else{
			$investment_date=strtotime($this->input->post('investment_date'));
			$investment_date = date('Y-m-d',$investment_date);

			$update_data = array(
				'investment_id'=>$investment_id,
				'investment_amount'=>$this->input->post('investment_amount'),
				'investment_desc'=>$this->input->post('investment_desc'),
				'investment_date'=>$investment_date,
				'updated_date'=>date('Y-m-d H:i:s'),
			);
				
			$status=$this->M_Common->update_f('investment',$update_data);

			if($status===TRUE){
				$this->session->set_flashdata('success_message','Updated successfully.');
				redirect('investment');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to update.');
				$this->edit_investment($investment_id);
			}
		}
	}
}

?>