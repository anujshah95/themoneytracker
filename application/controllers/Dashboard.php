<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Dashboard
 *
 * @author Anuj (http://anujshah.in)
 */

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Dashboard');
    }

	public function index()
	{
        if($this->session->userdata('is_site_user_logged_in')==true){
        	$dashboard_data						= $this->M_Dashboard->get_dashboard_count();
        	$data['exp_categories']				= $this->M_Dashboard->get_category_analytics();
        	$data['final_amount']				= $dashboard_data['final_amount'];
        	$data['fund_amount']				= $dashboard_data['fund_amount'];
        	$data['debitors_amount']			= $dashboard_data['debitors_amount'];
        	$data['creditors_amount']			= $dashboard_data['creditors_amount'];
        	$data['income_amount']				= $dashboard_data['income_amount'];
        	$data['exp_amount']				= $dashboard_data['exp_amount'];
        	$data['investment_amount']			= $dashboard_data['investment_amount'];
        	$data['header_title']				= 'Dashboard | '.$this->site_name;
        	$data['sSideBarDashboardActive']	= 'active';

        	display_view('dashboard/dashboard',$data,'true');
       	}else{
       		redirect('login');
       	}
	}

	public function final_amount()
	{
		$data['header_title']='Final amount | '.$this->site_name;
		$current_month_condition=FALSE;
		$dashboard_data=$this->M_Dashboard->get_dashboard_count($current_month_condition);
    	$data['final_amount']=$dashboard_data['final_amount'];
    	$data['fund_amount']=$dashboard_data['fund_amount'];
    	$data['debitors_amount']=$dashboard_data['debitors_amount'];
    	$data['creditors_amount']=$dashboard_data['creditors_amount'];
    	$data['income_amount']=$dashboard_data['income_amount'];
    	$data['exp_amount']=$dashboard_data['exp_amount'];
    	$data['sSideBarDashboardActive']	= 'active';
		display_view('dashboard/final_amount',$data,'true');
	}

	public function category_analytics()
	{
		if(!$this->input->post()) redirect();
		$get_category=$this->M_Dashboard->get_category_analytics();
		echo json_encode(array('category'=>$get_category));
	}

	public function profile()
	{
		$data['header_title']='Profile | '.$this->site_name;
		$data['sSideBarDashboardActive']	= 'active';
		display_view('dashboard/profile',$data,'true');
	}

	public function update_profile()
	{
		$data['header_title']='Profile | '.$this->site_name;
		$data['sSideBarDashboardActive']	= 'active';
		$data['edit_profile']="edit_profile";
		display_view('dashboard/profile',$data,'true');
	}

	public function update_profile_data()
	{
		$this->form_validation->set_rules('user_name', 'User Name', 'trim|required');
		$this->form_validation->set_rules('opening_balance', 'Opening Balance', 'trim|required|numeric');
   
    	if ($this->form_validation->run() == FALSE){
			$this->update_profile();
		}else{
			$update_data = array(
				'user_name' => $this->input->post('user_name'),
				'user_opening_balance' => $this->input->post('opening_balance'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);
			if (!empty($_FILES['user_image']['name'])){
				$field_name='user_image'; $path='./assets/images/users/';
				$upload_file_status=single_file_upload($field_name,$path); //field_name,path

				if($upload_file_status['status']=='error'){
					$this->session->set_flashdata('error_message',$upload_file_status['message']);
					redirect("update-profile");
				}else{
					$file_name=$upload_file_status['message']['file_name'];
					$update_data['user_image']=$file_name;
					$session_array['user_image']=$file_name;
				}
			}
			$session_array['user_name']=$this->input->post('user_name');
			$session_array['user_opening_balance']=$this->input->post('opening_balance');
			$result=$this->M_Dashboard->update_profile_f($update_data);

			if($result===TRUE){
				$this->session->set_userdata($session_array);
				$this->session->set_flashdata('success_message', "Profile updated successfully.");	
			} 
			if($result===FALSE) $this->session->set_flashdata('error_message',"Profile cannot be updated.");
			redirect('profile');
		}
	}

	public function change_password()
	{
		$data['header_title']='Change Password | '.$this->site_name;
		$data['sSideBarDashboardActive']	= 'active';
		display_view('dashboard/change_password',$data,'true');
	}

	public function change_password_data()
	{
		$this->form_validation->set_rules('txtOldPwd', 'Old Password', 'trim|required|min_length[6]|max_length[12]');			
		$this->form_validation->set_rules('txtNewPwd', 'New Password', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('txtNewPwd2', 'Confirm Password', 'trim|required|matches[txtNewPwd]|min_length[6]|max_length[12]');
			
		if ($this->form_validation->run() == FALSE) {
			$this->change_password();
		}else{
			$user_email=$this->user_email;
			$user_password=$this->input->post("txtNewPwd"); 
			$user_old_password=$this->input->post("txtOldPwd"); 

			$result=$this->M_Dashboard->check_old_password_validation($user_old_password);

			if($result===TRUE){
				$cp_result=$this->M_Dashboard->change_password_f($user_password);
				if($cp_result===TRUE){
					$this->session->set_flashdata('success_message','Successfully change password..');
					redirect('change-password');
				}else{
					$this->session->set_flashdata('error_message','Fail to change password.');
					redirect('change-password');
				}
			}
			if($result===FALSE){
				$this->session->set_flashdata('error_message','The old password is incorrect.');
				redirect('change-password');
			}
		}
	}

	public function common_delete_module()
	{
		if(empty($_POST['id']) && empty($_POST['tbl_name']) && empty($_POST['page_name'])){
			echo json_encode(array('status'=>'false','message'=>'Something went wrong..!!'));
		}

		if($this->session->userdata('is_site_user_logged_in')==true){
			$status=$this->M_Dashboard->common_delete_module_f($_POST['id'],$_POST['tbl_name']);

			if($status===TRUE){
				echo json_encode(array('status'=>'true','message'=>'Successfully Deleted..'));
			}else{
				echo json_encode(array('status'=>'false','message'=>'Something went wrong..!!'));
			}
		}else{
			echo json_encode(array('status'=>'false','message'=>'Something went wrong..!!'));
		}
	}

	function toDoList()
	{
		if(!$this->input->post()) redirect();
		if(empty($_POST['value']) && empty($_POST['to_do_list'])){
			echo json_encode(array('status'=>'false','message'=>'Something went wrong..!!'));
		}

		if($this->session->userdata('is_site_user_logged_in')==true){
			$update_data = array(
				'to_do_list'=>$this->input->post('to_do_list'),
				'updated_date'=>date('Y-m-d H:i:s'),
			);

			$status=$this->M_Common->update_f('users',$update_data);
			$user_data=$this->M_Common->get_data_f('users');

			if($status===TRUE && !empty($user_data[0])){
				$updated_to_do_list=$user_data[0]->to_do_list;
				$this->session->set_userdata('user_to_do_list',$updated_to_do_list);
				echo json_encode(array('status'=>'true','message'=>'Success','updated_to_do_list'=>$updated_to_do_list));
			}else{
				echo json_encode(array('status'=>'false','message'=>'Something went wrong..!!'));
			}
		}else{
			echo json_encode(array('status'=>'false','message'=>'Something went wrong..!!'));
		}
	}

	public function _404()
	{
		$data['header_title']='Page not found | '.$this->site_name;
		display_view('dashboard/404',$data,'true');
		// redirect();
	}

	public function cron_job_report()
	{
    	$dashboard_data=$this->M_Dashboard->get_dashboard_count();
    	$data['exp_categories']=$this->M_Dashboard->get_category_analytics();

    	$data['final_amount']=$dashboard_data['final_amount'];
    	$data['fund_amount']=$dashboard_data['fund_amount'];
    	$data['debitors_amount']=$dashboard_data['debitors_amount'];
    	$data['creditors_amount']=$dashboard_data['creditors_amount'];
    	$data['income_amount']=$dashboard_data['income_amount'];
    	$data['exp_amount']=$dashboard_data['exp_amount'];
    	$data['investment_amount']=$dashboard_data['investment_amount'];

    	$this->load->view(VIEW_FOLDER_NAME.'/emails/cron_job_report',$data);
	}

	public function s3()
	{
  // 		// Load Library
  // 		$this->load->library('s3');
  // 		if(isset($_POST['Submit'])){
  //   		//retreive post variables
  //   		$fileName = $_FILES['theFile']['name'];
  //   		$fileTempName = $_FILES['theFile']['tmp_name'];
  //   		// $this->s3->putBucket("themoneytracker", S3::ACL_PUBLIC_READ);
		// 	if ($this->s3->putObjectFile($fileTempName, "themoneytracker", $fileName, S3::ACL_PUBLIC_READ)) {
		// 	    echo "We successfully uploaded your file.";
		// 	}else{
		// 	    echo "Something went wrong while uploading your file... sorry.";
		// 	}
		// }
		// echo "<br>";
  // 		// Create a Bucket
  // 		// var_dump($this->s3->putBucket('My-Bucket', $this->s3->ACL_PUBLIC_READ));

  // 		// List Buckets
  // 		var_dump($this->s3->listBuckets());


  		$this->load->library('aws/aws3');
  		p($_FILES);
		// $config['upload_path'] = './uploads';
		// $config['allowed_types'] = 'gif|jpg|png';
		// $this->load->library('upload', $config);
		// $this->upload->initialize($config); 
		// if ( ! $this->upload->do_upload())
		// {
		// 	$error = array('error' => $this->upload->display_errors());
		// 	p($error);
		// 	// $this->mytemplate->loadAmin('view_aws', $error);
		// }
		// else
		// {
			// $image_data = $this->upload->data();
			$image_data['file_name'] = $this->aws3->sendFile('themoneytrackers',$_FILES['theFile']);	
			$data = array('upload_data' => $image_data['file_name']);
			p($data);
			// $this->mytemplate->loadAmin('view_aws', $data);
		// }
		exit;
	}
}

?>