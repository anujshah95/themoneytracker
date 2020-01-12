<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of M_Reports
 *
 * @author Anuj (http://anujshah.in)
 */

class M_Reports extends CI_Model{

	public function reports($dMonthYear=NULL)
	{
		//---------------------Income data--------------------------
		$this->db->select(
			'i.income_date,i.user_id,count(*) as month_count,
			MONTHNAME(i.income_date) as income_month,
			YEAR(i.income_date) as income_year,
			CONCAT(MONTHNAME(i.income_date)," ",YEAR(i.income_date)) as month_year,
			SUM(i.income_amount) as total_income
		');
		$this->db->where('i.user_id',$this->user_id);
		$this->db->group_by('MONTH(i.income_date),YEAR(i.income_date)');
		$this->db->order_by('income_year DESC, FIELD(income_month, 
			"December", "November", "October", "September", "August", "July", "June", "May", "April", "March", "February", "January")');
		$arrIncome=$this->db->get('income AS i');

		$arrIncomeAmt=array();
		foreach ($arrIncome->result_array() as $arrIncomeRow)
		{
			$dIncomeDate=""; $iMonthNumber=""; $iYear=""; $arrIncomeDetails="";
			$dIncomeDate		= strtotime($arrIncomeRow['income_date']);
			$iMonthNumber		= date("M",$dIncomeDate);
			$iSmallMonthNumber	= date("m",$dIncomeDate);
			$iYear				= date("Y",$dIncomeDate);

			$sMonthYear=$arrIncomeRow['month_year'];
			$iTotalIncome=$arrIncomeRow['total_income'];
			$arrIncomeAmt[$sMonthYear]=array();
			$arrIncomeAmt[$sMonthYear]['month_year']=$sMonthYear;
			$arrIncomeAmt[$sMonthYear]['total_income']=$iTotalIncome;
			/*
			$this->db->where('MONTH(income_date)',$iSmallMonthNumber);
			$this->db->where('YEAR(income_date)',$iYear);
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('income_date','desc');
			$arrEachIncome=$this->db->get('income');
			$arrIncomeDetails=$arrEachIncome->result();
			$arrIncomeAmt[$sMonthYear]['income_details']=$arrIncomeDetails;
			*/
		}
		//-----------------------Expediture data------------------------
		$this->db->select(
			'e.exp_date,e.user_id,count(*) as month_count,
			MONTHNAME(e.exp_date) as exp_month,
			YEAR(e.exp_date) as exp_year,
			CONCAT(MONTHNAME(e.exp_date)," ",YEAR(e.exp_date)) as month_year,
			SUM(e.exp_amount) as total_exp
		');
		$this->db->where('e.user_id',$this->user_id);
		$this->db->group_by('MONTH(e.exp_date),YEAR(e.exp_date)');
		$this->db->order_by('exp_year DESC, FIELD(exp_month, 
			"December", "November", "October", "September", "August", "July", "June", "May", "April", "March", "February", "January")');

		$arrExpResult=$this->db->get('expenditure AS e');

		$arrExpAmt=array();
		foreach ($arrExpResult->result_array() as $arrExpRow)
		{
			$dExpDate=""; $iExpMonthNumber=""; $iExpYear="";

			$dExpDate			= strtotime($arrExpRow['exp_date']);
			$iExpMonthNumber	= date("m",$dExpDate);
			$iExpYear			= date("Y",$dExpDate);

			$sExpMonthYear=$arrExpRow['month_year'];
			$arrExpAmt[$sExpMonthYear]=array();
			$arrExpAmt[$sExpMonthYear]['month_year']=$sExpMonthYear;
			$arrExpAmt[$sExpMonthYear]['total_exp']=$arrExpRow['total_exp'];
	
			/*
			$arrCatData="";
			$this->db->select('sum(exp_amount) as cat_exp_total,expenses_category.cname');
			$this->db->from('expenses_category');
			$this->db->join('expenditure','expenditure.exp_category=expenses_category.expenses_category_id');
			$this->db->where('expenses_category.user_id',$this->user_id);
			$this->db->where('month(`exp_date`) =  '.$iExpMonthNumber.'');  //fetch current month records only
			$this->db->where('year(`exp_date`) =  '.$iExpYear.''); 			//fetch current year records only
			$this->db->group_by('expenses_category.expenses_category_id');
			$this->db->order_by('cat_exp_total','desc');
			$arrExpQuery=$this->db->get();
			$arrCatData=$arrExpQuery->result();
			$arrExpAmt[$sExpMonthYear]['exp_details']=$arrCatData; //if requested for monthly report

			if($arrExpQuery->num_rows()>=1 && isset($arrExpRow['total_exp']) && !empty($arrExpRow['total_exp'])){
				foreach($arrCatData as $iKey=>$arrCat){
					$iPercentage=round(($arrCat->cat_exp_total*100)/$arrExpRow['total_exp']);
					$arrCatData[$iKey]->iPercentage=$iPercentage;
				}
			}
			*/
		}
		//-----------------Combine income and Expediture data--------------------------

		$arrOP = array();
		foreach ($arrIncomeAmt as $iKey => $arrValue){
		    $arrOP[] = (object)array_merge((array)$arrExpAmt[$iKey], (array)$arrValue);
		}
		// p($arrOP);
		return $arrOP;
	}

	public function monthlyReport($dMonthYear=NULL)
	{
        if(empty($dMonthYear)){
            $arrReturnPara['iStatus']=FALSE;
            $arrReturnPara['sMsg']='Input parameter is invalid';
            return array($arrReturnPara);
        }else{
			$arrMonthYear 		= explode('-',$dMonthYear);
			$sMonth 	  		= strtotime($arrMonthYear[0]);
			$dYear 	 	  		= strtotime($arrMonthYear[1]);
			$iSmallMonthNumber	= date("m",$sMonth);
			// $iYear				= date("Y",$dYear);
			$iYear=$arrMonthYear[1];
			// $iYear="2018";
			// p($iYear);
			// exit;
			//-------------------Income-------------------------------
			$arrIncomeAmt[$dMonthYear]=array();
			$arrIncomeAmt[$dMonthYear]['month_year']=$dMonthYear;

			$this->db->where('MONTH(income_date)',$iSmallMonthNumber);
			$this->db->where('YEAR(income_date)',$iYear);
			$this->db->where('user_id',$this->user_id);
			$arrIncome=$this->db->get('income');
			$arrIncomeDetails=$arrIncome->result();
			$arrIncomeAmt[$dMonthYear]['income_details']=$arrIncomeDetails;
			$iTotalIncome=0;
			foreach($arrIncomeDetails as $arrIncome){
				$iTotalIncome+=$arrIncome->income_amount;
			}
			$arrIncomeAmt[$dMonthYear]['total_income']=$iTotalIncome;

			//-------------------Expenditure----------------------------
			$arrExpAmt[$dMonthYear]=array();
			$arrExpAmt[$dMonthYear]['month_year']=$dMonthYear;
		
			$arrCatData="";
			$this->db->select('sum(exp_amount) as cat_exp_total,expenses_category.cname');
			$this->db->from('expenses_category');
			$this->db->join('expenditure','expenditure.exp_category=expenses_category.expenses_category_id');
			$this->db->where('expenses_category.user_id',$this->user_id);
			$this->db->where('month(`exp_date`) =  '.$iSmallMonthNumber.'');  //fetch current month records only
			$this->db->where('year(`exp_date`) =  '.$iYear.''); 			//fetch current year records only
			$this->db->group_by('expenses_category.expenses_category_id');
			$this->db->order_by('cat_exp_total','desc');
			$arrExpQuery=$this->db->get();
			$arrCatData=$arrExpQuery->result();
			$arrExpAmt[$dMonthYear]['exp_details']=$arrCatData;

			$iTotalExp=0;
			foreach($arrCatData as $arrCat){
				$iTotalExp+=$arrCat->cat_exp_total;
			}
			$arrExpAmt[$dMonthYear]['total_exp']=$iTotalExp;

			if($arrExpQuery->num_rows()>=1 && isset($iTotalExp) && !empty($iTotalExp)){
				foreach($arrCatData as $iKey=>$arrCat){
					$iPercentage=round(($arrCat->cat_exp_total*100)/$iTotalExp, 1);
					$arrCatData[$iKey]->iPercentage=$iPercentage;
				}
			}

			//--------------Combine Income and Expenditure Data----------
			$arrOP = array();
			foreach ($arrIncomeAmt as $iKey => $arrValue){
			    $arrOP[] = (object)array_merge((array)$arrExpAmt[$iKey], (array)$arrValue);
			}
			// p($arrOP);
            return array('iStatus'=>TRUE,'arrData'=>$arrOP);
		}
	}

	public function generateReport($sModuleName=NULL,$sTarget=NULL,$sMonth=NULL)
	{
		if($sModuleName=='income')
		{
			$this->db->select("
				income_amount as Income Amount,
				CASE WHEN length(income_desc) > 25
				    THEN CONCAT(SUBSTRING(income_desc, 1, 25),'..')
				    ELSE income_desc END as Description,
				DATE_FORMAT(income_date,'%d-%b-%Y') as Date
			");
			if(!empty($sMonth)){
				$arrMonth		= explode('-',$sMonth);
				$iMonthNumber	= date('m',strtotime($arrMonth[0]));
				$iYear			= $arrMonth[1];
				$this->db->where('MONTH(income_date)',$iMonthNumber);
				$this->db->where('YEAR(income_date)',$iYear);
			}
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('created_date','desc');
			$arrIncomeQuery=$this->db->get('income');
			return array('iStatus'=>TRUE,'arrData'=>$arrIncomeQuery);
		}
		if($sModuleName=='expenses_category')
		{
			$this->db->select("
				cname as Category Name,
				DATE_FORMAT(created_date,'%d-%b-%Y') as Date
			");
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('created_date','desc');
			$arrQuery=$this->db->get('expenses_category');
			return array('iStatus'=>TRUE,'arrData'=>$arrQuery);
		}
		if($sModuleName=='expenditure')
		{
			$this->db->select("
				expenses_category.cname as Category,
				expenditure.exp_amount as Amount,
				CASE WHEN length(expenditure.exp_desc) > 15
				    THEN CONCAT(SUBSTRING(expenditure.exp_desc, 1, 15),'..')
				    ELSE expenditure.exp_desc END as Description,
				DATE_FORMAT(expenditure.exp_date,'%d-%b-%Y') as Date
			");
			$this->db->join('expenses_category','expenses_category.expenses_category_id=expenditure.exp_category');
			if(!empty($sMonth)){
				$arrMonth		= explode('-',$sMonth);
				$iMonthNumber	= date('m',strtotime($arrMonth[0]));
				$iYear			= $arrMonth[1];
				$this->db->where('MONTH(expenditure.exp_date)',$iMonthNumber);
				$this->db->where('YEAR(expenditure.exp_date)',$iYear);
			}
			$this->db->where('expenditure.user_id',$this->user_id);
			$this->db->order_by('expenditure.created_date','desc');
			$arrQuery=$this->db->get('expenditure');
			return array('iStatus'=>TRUE,'arrData'=>$arrQuery);
		}
		if($sModuleName=='fund')
		{
			$this->db->select("
				fund_amount as Amount,
				CASE WHEN length(fund_desc) > 25
				    THEN CONCAT(SUBSTRING(fund_desc, 1, 25),'..')
				    ELSE fund_desc END as Description,
				DATE_FORMAT(created_date,'%d-%b-%Y') as Date
			");
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('created_date','desc');
			$arrQuery=$this->db->get('fund');
			return array('iStatus'=>TRUE,'arrData'=>$arrQuery);
		}
		if($sModuleName=='debitors')
		{
			$this->db->select("
				debitors_amount as Amount,
				CASE WHEN length(debitors_desc) > 25
				    THEN CONCAT(SUBSTRING(debitors_desc, 1, 25),'..')
				    ELSE debitors_desc END as Description,
				DATE_FORMAT(created_date,'%d-%b-%Y') as Date
			");
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('created_date','desc');
			$arrQuery=$this->db->get('debitors');
			return array('iStatus'=>TRUE,'arrData'=>$arrQuery);
		}
		if($sModuleName=='creditors')
		{
			$this->db->select("
				creditors_amount as Amount,
				CASE WHEN length(creditors_desc) > 25
				    THEN CONCAT(SUBSTRING(creditors_desc, 1, 25),'..')
				    ELSE creditors_desc END as Description,
				DATE_FORMAT(created_date,'%d-%b-%Y') as Date
			");
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('created_date','desc');
			$arrQuery=$this->db->get('creditors');
			return array('iStatus'=>TRUE,'arrData'=>$arrQuery);
		}
		if($sModuleName=='investment')
		{
			$this->db->select("
				investment_amount as Amount,
				CASE WHEN length(investment_desc) > 25
				    THEN CONCAT(SUBSTRING(investment_desc, 1, 25),'..')
				    ELSE investment_desc END as Description,
				DATE_FORMAT(investment_date,'%d-%b-%Y') as Date
			");
			$this->db->where('user_id',$this->user_id);
			$this->db->order_by('investment_date','desc');
			$arrQuery=$this->db->get('investment');
			return array('iStatus'=>TRUE,'arrData'=>$arrQuery);
		}
		if($sModuleName=='monthly-report')
		{

		}
		return array('iStatus'=>FALSE,'sMessage'=>'Source is invalid.');
	}
}

?>