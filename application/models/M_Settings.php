<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of M_Settings
 *
 * @author Anuj (http://anujshah.in)
 */

class M_Settings extends CI_Model{

	public function fetch_site_content(){
		$this->db->where('site_content_id','1');
		$query=$this->db->get('site_content');
		return $query->result();
	}
}

?>