<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if($_SERVER['SERVER_NAME'] == 'localhost'){
    $config['protocol']='smtp';
   	$config['smtp_host']='ssl://smtp.googlemail.com';
	$config['smtp_port']='465';
	// $config['smtp_timeout']='30';
	$config['smtp_user']="";
	$config['smtp_pass']="";
	$config['charset']='utf-8';
	$config['newline']="\r\n";
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';
}else{
	$config['charset']='utf-8';
	$config['newline']="\r\n";
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';
}

?>
