<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_province()
  	{
		$sql ="SELECT * FROM  province";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  	}
  	function get_tos()
  	{
  		$sql ="SELECT * FROM  discount_of_qty";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  	}
  	function get_contract()
  	{
  		$sql ="SELECT * FROM  discount_of_contract";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  	}
}

/* End of file discount_of_contract_model.php */
/* Location: ./application/models/discount_of_contract_model.php */
