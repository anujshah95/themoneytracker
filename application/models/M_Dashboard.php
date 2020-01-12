<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of M_Auth
 *
 * @author Anuj (http://anujshah.in)
 */

class M_Dashboard extends CI_Model{

  public function get_category_analytics()
  {
    $cat_data="";
    $this->db->select('sum(exp_amount) as cat_exp_total,expenses_category.cname');
    $this->db->from('expenses_category');
    $this->db->join('expenditure','expenditure.exp_category=expenses_category.expenses_category_id');
    $this->db->where('expenses_category.user_id',$this->user_id);
    $this->db->where('month(`exp_date`) =  MONTH(CURRENT_DATE())'); //fetch current month records only
    $this->db->where('year(`exp_date`) =  YEAR(CURRENT_DATE())'); //fetch current year records only
    $this->db->group_by('expenses_category.expenses_category_id');
    $this->db->order_by('cat_exp_total','desc');
    $query=$this->db->get();
    $cat_data=$query->result();

    $this->db->select('sum(exp_amount) as exp_amount');
    $this->db->where('month(`exp_date`) =  MONTH(CURRENT_DATE())'); //fetch current month records only
    $this->db->where('user_id',$this->user_id);
    $expenditure_query=$this->db->get('expenditure');
    if($expenditure_query->num_rows()>=1){
			$iTotalExp=0;
			foreach($cat_data as $cat){
				$iTotalExp+=$cat->cat_exp_total;
			}
    }
    if($query->num_rows()>=1 && isset($iTotalExp) && !empty($iTotalExp)){
      foreach($cat_data as $key=>$cat){
        $percentage = round(($cat->cat_exp_total*100)/$iTotalExp, 1);
        $cat_data[$key]->percentage=$percentage;
      }
    }
    return $cat_data;
  }

  public function update_profile_f($update_data)
  {
    $user_email=$this->user_email;
    if(!empty($user_email)){
      $condition['user_email']=$this->user_email;
      $condition['user_id']=$this->user_id;
      $condition['user_status']='1';
      $this->db->where($condition);
      $query=$this->db->update('users',$update_data);
      if($this->db->affected_rows()>=1){
        return TRUE;
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }

  public function check_old_password_validation($old_pwd)
  {
    if($old_pwd){
      $condition['user_email']=$this->user_email;
      $condition['user_id']=$this->user_id;
      $condition['user_password']=md5($old_pwd);
      $condition['user_status']='1';
      $this->db->where($condition);
      $query=$this->db->get('users');
      if($query->num_rows()>=1){
        return TRUE;
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }

  public function change_password_f($user_password)
  {
    if($user_password){
      $update_data_array=array(
        'user_password'=>md5($user_password),
        'updated_date'=>date('Y-m-d H:i:s')
      );

      $condition['user_email']=$this->user_email;
      $condition['user_id']=$this->user_id;
      $condition['user_status']='1';

      $this->db->where($condition);
      $this->db->update('users',$update_data_array);
      if($this->db->affected_rows()>=1){
        return TRUE;
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }

  public function get_dashboard_count($current_month_condition=TRUE)
  {
    $fund_amount=0; $creditors_amount=0;
    $debitors_amount=0; $exp_amount=0;
    $income_amount=0;

    $this->db->select('sum(fund_amount) as fund_amount');
    $this->db->where('user_id',$this->user_id);
    $fund_amount_query=$this->db->get('fund');
    if($fund_amount_query->num_rows()>=1){
      $fund_amount=$fund_amount_query->result();
      $fund_amount=$fund_amount[0]->fund_amount;
    }

    $this->db->select('sum(debitors_amount) as debitors_amount');
    $this->db->where('user_id',$this->user_id);
    $debitors_amount_query=$this->db->get('debitors');
    if($debitors_amount_query->num_rows()>=1){
      $debitors_amount=$debitors_amount_query->result();
      $debitors_amount=$debitors_amount[0]->debitors_amount;
    }

    $this->db->select('sum(creditors_amount) as creditors_amount');
    $this->db->where('user_id',$this->user_id);
    $creditors_amount_query=$this->db->get('creditors');
    if($creditors_amount_query->num_rows()>=1){
      $creditors_amount=$creditors_amount_query->result();
      $creditors_amount=$creditors_amount[0]->creditors_amount;
    }

    $this->db->select('sum(exp_amount) as exp_amount');
    if($current_month_condition!=FALSE){ //where conditon for dashboard only
      $this->db->where('month(`exp_date`) =  MONTH(CURRENT_DATE())'); //fetch current month records only
      $this->db->where('year(`exp_date`) =  YEAR(CURRENT_DATE())'); //fetch current year records only
    }
    $this->db->where('user_id',$this->user_id);
    $expenditure_query=$this->db->get('expenditure');
    if($expenditure_query->num_rows()>=1){
      $exp_amount=$expenditure_query->result();
      $exp_amount=$exp_amount[0]->exp_amount;
    }

    $this->db->select('sum(income_amount) as income_amount');
    if($current_month_condition!=FALSE){ //where conditon for dashboard only
      $this->db->where('month(`income_date`) =  MONTH(CURRENT_DATE())'); //fetch current month records only
      $this->db->where('year(`income_date`) =  YEAR(CURRENT_DATE())'); //fetch current year records only
    }
    $this->db->where('user_id',$this->user_id);
    $income_query=$this->db->get('income');
    if($income_query->num_rows()>=1){
      $income_amount=$income_query->result();
      $income_amount=$income_amount[0]->income_amount;
    }

    $this->db->select('sum(investment_amount) as investment_amount');
    $this->db->where('user_id',$this->user_id);
    $investment_amount_query=$this->db->get('investment');
    if($investment_amount_query->num_rows()>=1){
      $investment_amount=$investment_amount_query->result();
      $investment_amount=$investment_amount[0]->investment_amount;
    }

    $final_amount=$fund_amount+$debitors_amount-$creditors_amount;

    $dashboard_count_array=array(
      'final_amount'=>$final_amount,
      'fund_amount'=>$fund_amount,
      'debitors_amount'=>$debitors_amount,
      'creditors_amount'=>$creditors_amount,
      'income_amount'=>$income_amount,
      'exp_amount'=>$exp_amount,
      'investment_amount'=>$investment_amount
    );

    return $dashboard_count_array;
  }

  public function common_delete_module_f($id,$tbl_name)
  {
    if($id && $tbl_name){
      $this->db->where($tbl_name.'_id',$id);
      $this->db->where('user_id',$this->user_id);
      $this->db->delete($tbl_name);

      if($this->db->affected_rows()>0){
        return TRUE;
      }else{
        return FALSE;
      }
    }else{
      return FALSE;
    }
  }
}

?>
