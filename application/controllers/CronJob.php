<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of CronJob
 *
 * @author Anuj (http://anujshah.in)
 */

class CronJob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	redirect();
  	}

    public function truncate_demo_user_data($sHashValue="")
    {
        if($sHashValue!=HASH_FOR_CRONJOB_TRUNCATE) redirect();
        $this->load->model('M_CronJob');
        $this->M_CronJob->truncate_demo_user_data();
        redirect();
    }
}

?>