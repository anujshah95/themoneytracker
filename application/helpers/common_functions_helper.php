<?php

function p($arrData,$bExit=FALSE){
	echo "<pre>";
		print_r($arrData);
	echo "</pre>";
	if($bExit===TRUE) exit;
}

// ------------------------------------------------------------------------

function ps($keyword=""){
	$ci =& get_instance();
	if(empty($keyword)){
		p($ci->session->userdata());
	}else{
		echo $ci->session->userdata($keyword);
	}
}

// ------------------------------------------------------------------------

function short_date($date_time,$dmy_format=FALSE)
{
	if(empty($date_time)) return FALSE;

    if($dmy_format===FALSE){
        return date("d-M-y", strtotime($date_time));
    }else{
        return date("d-M-y h:i", strtotime($date_time));
    }
}


// ------------------------------------------------------------------------

if (!function_exists('check_logged_in_user_status')){
	/**
	    * Function Name : check_logged_in_user_status
	    * check_logged_in_user_status is used to check whether logged in user have rights to access his/her account.
	    *
	    * @return mixed depends on condition
	*/
	function check_logged_in_user_status(){
		//Check logged in user status because what if admin deactivates user who is already logged in.
		$ci =& get_instance();

		if($ci->session->userdata('is_site_user_logged_in')=='true'){
			$user_email=$ci->session->userdata('user_email');
			$user_name=$ci->session->userdata('user_name');
			$user_id=$ci->session->userdata('user_id');

			if(empty($user_email) || empty($user_name) || empty($user_id)){
				logout();
				$ci->session->set_flashdata('error_message','Something went wrong with your account, please login again.');
				redirect("login");
			}

			if(isset($user_email) && !empty($user_email)){
				$status=$ci->M_Auth->check_logged_in_user_status_f();
				if($status===TRUE){
					return TRUE;
				}else{
					logout();
					$ci->session->set_flashdata('error_message','Something went wrong with your account, please login again.');
					redirect("login");
				}
			}
		}else{
			return FALSE;
		}
	}
}

// ------------------------------------------------------------------------

if (!function_exists('logout')){
	/**
	    * Function Name : logout
	    * logout is used to destroy session and redirect user to home page.
	    *
	    * @return void
	*/
	function logout()
	{
		$ci =& get_instance();
		$ci->session->unset_userdata('is_site_user_logged_in');
		$ci->session->unset_userdata('user_id');
		$ci->session->unset_userdata('user_name');
		$ci->session->unset_userdata('user_email');
		$ci->session->unset_userdata('user_image');
		$ci->session->unset_userdata('user_opening_balance');
		$ci->session->unset_userdata('user_to_do_list');
		$ci->session->unset_userdata('created_date');
		$ci->session->unset_userdata('updated_date');
		// $ci->session->sess_destroy();
	}
}

// ------------------------------------------------------------------------

if (!function_exists('clean_url')){
	/**
	    * Function Name : clean_url
	    * clean_url is used to remove special char from string and return appropriate string.
	    *
	    * @return string
	*/
	function clean_url($string)
	{
		$url_title = url_title($string, 'dash', TRUE);
		return $url_title;
	}
}

// ------------------------------------------------------------------------

function display_view($page_name="",$data="",$sidebar=""){
	$ci =& get_instance();
	$ci->load->view(VIEW_FOLDER_NAME.'/layouts/header', $data);
	if($sidebar=='true') $ci->load->view(VIEW_FOLDER_NAME.'/layouts/sidebar');
	$ci->load->view(VIEW_FOLDER_NAME.'/'.$page_name, $data);
	$ci->load->view(VIEW_FOLDER_NAME.'/layouts/footer');
}

// ------------------------------------------------------------------------

function display_session_msg(){
	$ci =& get_instance();
    if ($ci->session->flashdata('error_message')){
        echo "<div class='alert alert-danger'>";
            echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            echo "<strong>"; print_r($ci->session->flashdata('error_message')); echo "</strong>";
        echo "</div>";
    }

    if ($ci->session->flashdata('success_message')) {
        echo "<div class='alert alert-success'>";
            echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
            echo "<strong>"; print_r($ci->session->flashdata('success_message')); echo "</strong>";
        echo "</div>";
    }
}

// ------------------------------------------------------------------------

if (!function_exists('social_share')){
	/**
	    * Function Name : social_share
	    * social_share is used to generate URL for requested website
	    *
	    * @return string
	*/
	function social_share($social_site="")
	{
		$ci =& get_instance();
		if(!empty($social_site)){
			if($social_site=='facebook'){
				$share_url='http://www.facebook.com/share.php?u='.base_url().'&amp;title='.$ci->site_name;
				$share_button_class='fa fa-facebook-square fa-3x';
			}elseif($social_site=='twitter'){
				$share_url='http://twitter.com/home?status=['.$ci->site_name.']+['.base_url().']';
				$share_button_class='fa fa-twitter-square fa-3x';
			}elseif($social_site=='linkedin'){
				$share_url='https://www.linkedin.com/shareArticle?mini=true&url='.base_url().'&title='.$ci->site_name;
				$share_button_class='fa fa-linkedin-square fa-3x';
			}elseif($social_site=='google_plus'){
				$share_url='https://plus.google.com/share?url='.base_url().'&title='.$ci->site_name;
				$share_button_class='fa fa-google-plus-square fa-3x';
			}elseif($social_site=='pinterest'){
				$share_url='http://pinterest.com/pin/create/button/?url='.base_url().'&description='.$ci->site_name;
				$share_button_class='fa fa-pinterest-square fa-3x';
			}elseif($social_site=='tumblr'){
				$share_url='http://www.tumblr.com/share/link?url='.base_url().'&amp;name='.$ci->site_name.'&amp;description=';
				$share_button_class='fa fa-tumblr-square fa-3x';
			}elseif($social_site=='whatsapp'){
                return 
					"<a href='whatsapp://send?text=".$ci->site_name.", See More: ".base_url()."' data-action='share/whatsapp/share' 
						target='_blank' class='hidden-md hidden-lg'>
						<i class='fa fa-whatsapp fa-3x' aria-hidden='true'></i>
					</a>";
			}else{
				return FALSE;
			}
            return 
				"<a href=".$share_url." class='text-center' target='_blank'>
					<i class='".$share_button_class."' aria-hidden='true'></i>
				</a>";
		}else{
			return FALSE;
		}
	}
}

// ------------------------------------------------------------------------

if (!function_exists('single_file_upload')){
	/**
	    * Function Name : single_file_upload
	    * single_file_upload is used to upload single file.
	    * @param field_name        Use to upload file
	    * @param file_name         To sanitize before save to db.
	    * @param path              Specify path.
	    * @param allowed_types     Specifies if file will be other than image else optional.
	    * @return array
	*/
	function single_file_upload($field_name,$path,$allowed_type=""){
	    $ci =& get_instance();
	    $ci->load->library('upload');
	    
	    if(!empty($field_name) && !empty($path)){
		    $config['upload_path']   = $path;
		    if(isset($allowed_type) && !empty($allowed_type) && $allowed_type=='doc'){
		    	$config['allowed_types'] = 'pdf|doc|docx';
		    }else{
		    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
		    }
		    $config['max_size']      = 1024 * 5;
		    $config['remove_spaces'] = TRUE;
		    $config['encrypt_name']  = TRUE;

		   	$ci->upload->initialize($config);
		    if (!$ci->upload->do_upload($field_name)) {
		        $error_upload_file=$ci->upload->display_errors();
		        return array('status'=>'error','message'=>$error_upload_file);
		    }else{
		        $upload_data = $ci->upload->data();
		        return array('status'=>'success','message'=>$upload_data);
		    }
		}else{
			return FALSE;
		}
	}
}

// ------------------------------------------------------------------------

if (!function_exists('send_email')){
	/**
	    * Function Name : send_email
	    * send_email is used to send email.
	    *
	    * @return true false
	*/
	function send_email($to,$from="",$subject,$message){
	    $ci =& get_instance();
	    // $ci->load->library('email',$config);
	    $ci->email->set_mailtype("html");
	    $ci->email->from($ci->from_email,$ci->site_name);
	    $ci->email->to($to); 
	    $ci->email->bcc(array('anuj.shah95@gmail.com','info@themoneytracker.in'));
	    $ci->email->subject($subject);
	    $ci->email->message($message); 
		$ci->email->send();
		$ci->email->clear(TRUE);
	    return TRUE;
	}
}
// ------------------------------------------------------------------------

if (!function_exists('validateDate')){
	/**
	    * Function Name : validateDate
	    * validateDate is used to checks the format of the date.
	    *
	    * @return true false
	*/
	function validateDate($sDate, $sFormat = 'Y-m-d H:i:s'){
	    $bDateFormatResult = DateTime::createFromFormat($sFormat,$sDate);
	    return $bDateFormatResult && $bDateFormatResult->format($sFormat) == $sDate;
	}
}

// ------------------------------------------------------------------------

function post_value_or($key, $default = NULL) {
    return isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : $default;
}

// ------------------------------------------------------------------------

if (!function_exists('text_cut'))
{
	/**
	    * Function Name : text_cut
	    * text_cut is used to check the length and cut the text if necessary.
	    *
	    * @return string
	*/
	function text_cut($sContent,$iLength)
	{
	    if(!empty($sContent) && !empty($iLength))
	    {
	        $sCutString=strip_tags(substr($sContent,0,$iLength));
	        if(strlen($sContent)>=$iLength)
	        {
	            return $sCutString.'...';
	        }
	        return $sCutString;
	    }
	    return FALSE;
	}
}

// ------------------------------------------------------------------------

if (!function_exists('custom_write_log'))
{
	/**
	    * Function Name : custom_write_log
	    * custom_write_log is used to add log messages to file for future reference
	    *
	    * @return string
	*/

	function custom_write_log($sLevel,$sMsg){
		$ci =& get_instance();

		$arrLevels 	 		= array('ERROR','INFO');
		$dDateFormat 		= date('d-m-y H:i:s');
		$sLogFilePermission = 0644;

		$sLevel = strtoupper($sLevel);

		if(!in_array($sLevel,$arrLevels)){
			return FALSE;
		}

		$sFilePath = CUSTOM_LOG_PATH;
		$sMessage = '';

		if ( ! file_exists($sFilePath))
		{
			$bNewFile = TRUE;
			$sMessage .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
		}

		if ( ! $fp = @fopen($sFilePath, 'ab'))
		{
			return FALSE;
		}
		flock($fp, LOCK_EX);

		$sMessage .= $sLevel.' - '.$dDateFormat.' --> '.$sMsg."\n";

		for ($written = 0, $length = strlen($sMessage); $written < $length; $written += $result)
		{
			if (($result = fwrite($fp, substr($sMessage, $written))) === FALSE)
			{
				break;
			}
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		if (isset($bNewFile) && $bNewFile === TRUE)
		{
			chmod($sFilePath, $sLogFilePermission);
		}

		return is_int($result);  
	}
}