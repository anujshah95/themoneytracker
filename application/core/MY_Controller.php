<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of MY_Controller
 *
 * @author Anuj (http://anujshah.in)
 */

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
        $this->load->model('M_Auth');
        $this->load->model('M_Settings');
        check_logged_in_user_status(); //use to check logged in user have rights to access his/her account.

        $this->user_profile_img=""; $this->user_profile_img_name="";
        $this->user_name="";        $this->user_id="";
        $this->user_email="";       $this->admin_login="";
        $this->user_to_do_list="";  $this->user_last_login="";

		$this->load->library("pagination");
		$this->form_validation->set_error_delimiters('<p class="error" style="color:#FC0202">', '</p>');

		if($this->session->userdata('is_site_user_logged_in')===TRUE){
			$this->user_profile_img      = base_url('assets/images/users/'.$this->session->userdata('user_image'));
			$this->user_profile_img_name = $this->session->userdata('user_image');
			$this->user_name             = $this->session->userdata('user_name');
			$this->user_email            = $this->session->userdata('user_email');
            $this->user_id               = $this->session->userdata('user_id');
            $this->user_opening_balance  = $this->session->userdata('user_opening_balance');
            $this->user_registered_date  = $this->session->userdata('created_date');
            $this->user_last_login       = $this->session->userdata('user_last_login');
		}else{
            redirect("login");
        }

		$site_content=$this->M_Settings->fetch_site_content();
		$this->site_name=isset($site_content[0]->site_name) && !empty($site_content[0]->site_name) ? $site_content[0]->site_name : '';
		$this->site_logo=isset($site_content[0]->site_logo) && !empty($site_content[0]->site_logo) ? $site_content[0]->site_logo : '';
		$this->admin_email=isset($site_content[0]->admin_email) && !empty($site_content[0]->admin_email) ? $site_content[0]->admin_email : '';
		$this->mobile_number=isset($site_content[0]->mobile_number) && !empty($site_content[0]->mobile_number) ? $site_content[0]->mobile_number : '';
		$this->from_email=isset($site_content[0]->from_email) && !empty($site_content[0]->from_email) ? $site_content[0]->from_email : '';
		$this->fb_link=isset($site_content[0]->fb_link) && !empty($site_content[0]->fb_link) ? $site_content[0]->fb_link : '';
		$this->google_link=isset($site_content[0]->google_link) && !empty($site_content[0]->google_link) ? $site_content[0]->google_link : '';
		$this->twitter_link=isset($site_content[0]->twitter_link) && !empty($site_content[0]->twitter_link) ? $site_content[0]->twitter_link : '';
		$this->linkedin_link=isset($site_content[0]->linkedin_link) && !empty($site_content[0]->linkedin_link) ? $site_content[0]->linkedin_link : '';

        if($this->user_email==$this->admin_email){
            $this->admin_login=TRUE;
        }
    }

    /*
        * function form_validate 
        * common function for custom form validation where type(User name) and type_value(Sachin) will be pass.
        *
        * @return TRUE FALSE
    */
    public function form_validate($type_value="",$type="")
    {
        if(isset($type) && !empty($type)){
            $type_value = trim($type_value);
			if($type=='customAlpha'){
                if(empty($type_value)){
                    $this->form_validation->set_message('form_validate', 'The {field} field value is empty.');
                    return FALSE;   
                }
                if (!preg_match('/^[a-z ]+$/i',$type_value)){
                    $this->form_validation->set_message('form_validate', 'The {field} field may only contain alphabetical characters.');
                    return FALSE;
                }
                return TRUE;
            }elseif($type=='validURL'){
                if(empty($type_value)){
                    $this->form_validation->set_message('form_validate', 'The {field} field value is empty.');
                    return FALSE;   
                }
                $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
                if (!preg_match($pattern, $type_value)){
                    $this->form_validation->set_message('form_validate', 'The {field} field may only contain valid URL.');
                    return FALSE;
                }
                return TRUE;
            }elseif($type=='feedback_image'){
                $field_name='feedback_image'; $path='./assets/images/feedback/';
                $upload_file_status=single_file_upload($field_name,$path); //field_name,path
                if($upload_file_status['status']=='error'){
                    $this->form_validation->set_message('form_validate', strip_tags($upload_file_status['message']));
                    return FALSE;
                }
                $file_name=$upload_file_status['message']['file_name'];
                $this->session->set_userdata('temp_feedback_image_name',$file_name);
                return TRUE;
            }else{
                // $this->form_validation->set_message('form_validate', '1');
                return FALSE;
            }
        }else{
            // $this->form_validation->set_message('form_validate', '2');
            return FALSE;
        }
    }

}

?>