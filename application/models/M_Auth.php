<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of M_Auth
 *
 * @author Anuj (http://anujshah.in)
 */

class M_Auth extends CI_Model{

	public function login_f($user_email,$user_password)
	{
        $this->db->where(array('user_email'=>$user_email));
        $user_data = $this->db->get('users')->row_array();
        if(empty($user_data)){
          	return "Email address doesn't exists.";
		}else if($user_data["user_status"] != '1' ){
            return "Your account is deactive, please contact to adminstrator.";
        }else if($user_data['user_password'] != md5($user_password)){
          	return "Combination are incorrect.";
        }else{
        	$arrUpdateData=array('user_last_login'=>date('Y-m-d H:i:s'));
        	$this->db->where(array(
        		'user_email'	=> $user_email,
        		'user_password'	=> md5($user_password),
        		'user_status'	=> '1'
        	));
        	$this->db->update('users',$arrUpdateData);
        	$user_image=!empty($user_data['user_image']) ? $user_data['user_image'] : 'default_profile.png';
			$arrUserData = array(
                'user_image' 			=> 	$user_image,
                'user_id' 				=> 	$user_data['user_id'],
				'user_name'				=> 	$user_data['user_name'],
                'user_email'			=> 	$user_data['user_email'],
                'user_opening_balance'	=> 	$user_data['user_opening_balance'],
                'user_to_do_list'		=> 	$user_data['to_do_list'],
                'created_date' 			=> 	$user_data['created_date'],
                'updated_date' 			=>	$user_data['updated_date'],
                'is_site_user_logged_in'=> 	TRUE,
                'user_last_login'		=>	date('Y-m-d H:i:s')
			);
			$this->session->set_userdata($arrUserData);
			return TRUE;
       	}
	}

	public function check_logged_in_user_status_f()
	{
		$user_email=$this->session->userdata('user_email');
		$this->db->where(array('user_email'=>$user_email,'user_status'=>'1'));
		$query=$this->db->get('users');
		if($query->num_rows()>=1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

?>