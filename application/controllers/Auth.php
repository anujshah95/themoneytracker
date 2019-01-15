<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Auth
 *
 * @author Anuj (http://anujshah.in)
 */

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        $this->load->model('M_Auth');
        $this->form_validation->set_error_delimiters('<p class="error" style="color:#FC0202">', '</p>');
    }

    public function index()
    {
        if($this->session->userdata('is_site_user_logged_in')===TRUE){
        	redirect('Dashboard');
        }else{
        	$data['header_title']='Login';
        	display_view('auth/site_login',$data);
        }
  	}

	public function login()
	{
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|min_length[6]|max_length[12]');
		
		if ($this->form_validation->run() == FALSE){
			$data['header_title']='Login';
			display_view('auth/site_login',$data);
		}else{
			$user_email=$this->input->post("user_email");
			$user_password=$this->input->post("user_password");

			$result=$this->M_Auth->login_f($user_email,$user_password);
			
			if($result === TRUE){
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('error_message',$result);
				redirect('login');
			}
		}
	}

	public function logout()
	{
		logout();
		redirect('login');
	}
}

?>