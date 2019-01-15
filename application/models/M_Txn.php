<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of M_Txn
 *
 * @author Anuj (http://anujshah.in)
 */

class M_Txn extends CI_Model{

	public function check_unique_cname($cname)
	{
		if($cname){
			$this->db->where('cname',$cname);
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('created_date','desc');
			$result=$this->db->get('expenses_category');
			if($result->num_rows()>=1){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function get_exp_data_f($id="",$sMonth="",$cname="")
	{
		$this->db->select('expenses_category.expenses_category_id,expenses_category.cname,expenses_category.cname_slug,
			expenditure.expenditure_id,expenditure.exp_amount,expenditure.exp_desc,expenditure.exp_date,expenditure.created_date');
		$this->db->join('expenses_category','expenses_category.expenses_category_id=expenditure.exp_category');
		if(!empty($id) && is_numeric($id)) $this->db->where('expenditure_id',$id);
		if(!empty($cname)) $this->db->where('expenses_category.cname_slug',$cname);
		if(!empty($sMonth)){
			$arrMonth		= explode('-',$sMonth);
			$iMonthNumber	= date('m',strtotime($arrMonth[0]));
			$iYear			= $arrMonth[1];
			$this->db->where('MONTH(expenditure.exp_date)',$iMonthNumber);
			$this->db->where('YEAR(expenditure.exp_date)',$iYear);
		}
		$this->db->where('expenditure.user_id',$this->user_id);
		$this->db->order_by('expenditure.created_date','desc');
		$result=$this->db->get('expenditure');
		return $result->result();
	}
}

?>