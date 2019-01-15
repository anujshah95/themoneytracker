<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of M_CronJob
 *
 * @author Anuj (http://anujshah.in)
 */

class M_CronJob extends CI_Model{

	public function truncate_demo_user_data()
	{
		$this->db->where('user_email','demo@themoneytracker.in');
		$arrQuery=$this->db->get('users')->row_array();

		$iDemoUserId=$arrQuery['user_id'];

		$arrTablesName=array('income','expenditure','expenses_category','creditors','debitors','fund','investment');

		foreach($arrTablesName as $arrTblName)
		{
			$this->db->where('user_id',$iDemoUserId);
			$this->db->delete($arrTblName);
		}
		return TRUE;
	}
}

?>