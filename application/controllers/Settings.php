<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Settings
 *
 * @author Anuj (http://anujshah.in)
 */

class Settings extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	if($this->admin_login!=TRUE) redirect('dashboard');
        $data['header_title']='Site Content | '.$this->site_name;
        $data['sSideBarSettingsActive'] = 'active';
        $data['site_content']=$this->M_Common->get_data_f('site_content');
        display_view('settings/site_content',$data,'true');
  	}

	public function update_site_content()
	{
		if($this->admin_login!=TRUE) redirect('dashboard');
		if(empty($_POST['site_logo_name'])) redirect();
		if(empty($_POST['site_content_id']) || !is_numeric($_POST['site_content_id'])) redirect();

		$this->form_validation->set_rules('site_name', 'Site Name', 'trim|required|callback_form_validate[customAlpha]');
		$this->form_validation->set_rules('from_email', 'From Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('mobile_number', 'Mobile No', 'trim|required|numeric|exact_length[10]');
		$this->form_validation->set_rules('facebook_url', 'Facebook URL', 'trim|required|callback_form_validate[validURL]');
		$this->form_validation->set_rules('twitter_url', 'Twitter URL', 'trim|required|callback_form_validate[validURL]');
		$this->form_validation->set_rules('google_url', 'Google URL', 'trim|required|callback_form_validate[validURL]');
		$this->form_validation->set_rules('linkedin_url', 'Linkedin URL', 'trim|required|callback_form_validate[validURL]');
		
		if ($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			$site_logo_name=$this->input->post('site_logo_name');
			$site_content_id=$this->input->post('site_content_id');

			$update_data = array(
				'site_content_id'=>$site_content_id,
				'site_name' => $this->input->post('site_name'),
				'admin_email' => $this->input->post('admin_email'),
				'from_email' => $this->input->post('from_email'),
				'fb_link' => $this->input->post('facebook_url'),
				'twitter_link' => $this->input->post('twitter_url'),
				'google_link' => $this->input->post('google_url'),
				'linkedin_link' => $this->input->post('linkedin_url'),
				'mobile_number' => $this->input->post('mobile_number'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);

			if (!empty($_FILES['site_logo']['name'])){
				$field_name='site_logo'; $path='./assets/images/site_logo/';
				$upload_file_status=single_file_upload($field_name,$path); //field_name,path

				if($upload_file_status['status']=='error'){
					$this->session->set_flashdata('error_message',$upload_file_status['message']);
					redirect("site-content");
				}else{
					$file_name=$upload_file_status['message']['file_name'];
					$update_data['site_logo']=$file_name;
				}
			}
			$result=$this->M_Common->update_f('site_content',$update_data);

			if($result===TRUE){
				$this->session->set_flashdata('success_message', "Content updated successfully.");	
			} 
			if($result===FALSE) $this->session->set_flashdata('error_message',"Fail to update.");
			redirect('site-content');
		}
	}

	public function share()
	{
		$data['header_title']='Share | '.$this->site_name;
		$data['sSideBarShareActive'] = 'active';
		display_view('settings/share',$data,'true');
	}

	public function feedback()
	{
        $data['header_title']='Feedback | '.$this->site_name;
        $data['sSideBarFeedbackActive'] = 'active';
        display_view('settings/feedback',$data,'true');
	}

	public function add_feedback()
	{
		$this->form_validation->set_rules('feedback_message', 'Feedback Message', 'trim|required|min_length[2]|max_length[1024]');
		if (!empty($_FILES['feedback_image']['name'])){
			$this->form_validation->set_rules('feedback_image', 'Feedback Image', 'callback_form_validate[feedback_image]');
		}
    	if ($this->form_validation->run() == FALSE){
    		$this->feedback();
		}else{
			$feedback_message=$this->input->post('feedback_message');
			$add_feedback_array = array(
				'user_id'			=> $this->user_id,
				'feedback_message'	=> $feedback_message,
				'created_date'		=> date('Y-m-d H:i:s')
			);

			if(!empty($_FILES['feedback_image']['name'])){
				$file_name=$this->session->userdata('temp_feedback_image_name');
				$add_feedback_array['feedback_image']=$file_name;
				/*
				$field_name='feedback_image'; $path='./assets/images/feedback/';
				$upload_file_status=single_file_upload($field_name,$path); //field_name,path

				if($upload_file_status['status']=='error'){
					$this->session->set_flashdata('error_message',$upload_file_status['message']);
					redirect("add-feedback");
				}else{
					$file_name=$upload_file_status['message']['file_name'];
					$add_feedback_array['feedback_image']=$file_name;
				}
				*/
	       	}
			$status=$this->M_Common->insert_f('feedback',$add_feedback_array);

			if($status===TRUE){
				$this->session->unset_userdata('temp_feedback_image_name');
				$feedback_image_link=isset($add_feedback_array['feedback_image']) && !empty($add_feedback_array['feedback_image']) ? "Feedback Image : <a href='".base_url('assets/images/feedback/'.$file_name)."'>Click here.</a>" : "";

				//Send mail to user to notify about feedback message.
				$data['email_page_title']="Thanks for your feedback ".$this->user_name;
				$data['message_title']="Thanks for your feedback ".$this->user_name;
				$data['body_message']="Hi ".$this->user_name.", thanks for the feedback, we will look into on prior.";
				$mail_subject="Thanks for your feedback ".$this->user_name;
				$message=$this->load->view(VIEW_FOLDER_NAME.'/emails/notify_message',$data,TRUE);
				$mail_status=send_email($this->user_email,'',$mail_subject,$message); //to,from,subject,message

				//Send mail to admin to notify about feedback message.
				$data['email_page_title']=$this->user_name." have some feedback for ".$this->site_name;
				$data['message_title']=$this->user_name." have some feedback for ".$this->site_name;
				$data['body_message']='Hi Admin, '.$this->user_name.' have some feedback for '.$this->site_name.
				"<br><br>Feedback message : ".$feedback_message."<br>".$feedback_image_link;;
				$mail_subject=$this->user_name." have some feedback for ".$this->site_name;
				$message=$this->load->view(VIEW_FOLDER_NAME.'/emails/notify_message',$data,TRUE);
				$mail_status=send_email($this->admin_email,'',$mail_subject,$message); //to,from,subject,message

				$sUserName  = $this->session->userdata('user_name');
        		$sUserEmail = $this->session->userdata('user_email');
				custom_write_log('info',$sUserName.'['.$sUserEmail.']'.' submitted feedback');
				$this->session->set_flashdata('success_message','Thank you for your feedback, we will get back to you as soon as possible.');
				redirect('feedback');
			}
			if($status===FALSE){
				$this->session->set_flashdata('error_message','Fail to add.');
				redirect('add-feedback');
			}
		}
	}
}

?>