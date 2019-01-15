<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of M_Common
 *
 * @author Anuj (http://anujshah.in)
 */

class M_Common extends CI_Model{

	public function insert_f($sTableName,$arrData)
	{
		$this->db->insert($sTableName,$arrData);

		if($this->db->affected_rows()>=1){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function get_data_f($sTableName,$iId="",$sMonth="")
	{
		if(!empty($iId) && is_numeric($iId)) $this->db->where($sTableName."_id",$iId);
		if($sTableName!='site_content') $this->db->where('user_id',$this->user_id);
		if(!empty($sMonth)){
			$arrMonth		= explode('-',$sMonth);
			$iMonthNumber	= date('m',strtotime($arrMonth[0]));
			$iYear			= $arrMonth[1];
			$this->db->where('MONTH(income_date)',$iMonthNumber);
			$this->db->where('YEAR(income_date)',$iYear);
		}
		$this->db->order_by('created_date','desc');
		$arrQuery=$this->db->get($sTableName);
		return $arrQuery->result();
	}

	public function update_f($sTableName,$arrUpdateData)
	{
		if($sTableName!='users'){
			$iId=$sTableName.'_id';
			$iEditId=$arrUpdateData[$iId];
			unset($arrUpdateData[$iId]);
		}else{
			$iId='user_id';
			$iEditId=$this->user_id;
		}

		$arrNotAllowedTbl=array('users','site_content');

		$this->db->where($iId,$iEditId);
		if(!in_array($sTableName,$arrNotAllowedTbl)){
			$this->db->where('user_id',$this->user_id);
		}
		$this->db->update($sTableName,$arrUpdateData);

		if($this->db->affected_rows()>=1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

?>