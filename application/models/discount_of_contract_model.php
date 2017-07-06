<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_of_contract_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_discount_of_contract_count($searchText = '')
	{

		$searchText = $this->db->escape_like_str($searchText);
		$sql =" SELECT COUNT(r.discount_of_contract_id) as connt_id FROM  discount_of_contract r WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (r.number  LIKE '%".$searchText."%' OR  r.discount  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}

  function get_discount_of_contract($searchText = '', $page, $segment)
  {
		$searchText = $this->db->escape_like_str($searchText);
		$page = $this->db->escape_str($page);
		$segment = $this->db->escape_str($segment);

		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_of_contract r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      if(!empty($searchText)) {
  				$sql = $sql." AND (r.number  LIKE '%".$searchText."%' OR  r.discount  LIKE '%".$searchText."%')";
  		}
			$sql = $sql." LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	function get_discount_of_contract_all()
  {
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_of_contract r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_discount_of_contract_id($id)
	{
		$id = $this->db->escape_str($id);
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_of_contract r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
						 WHERE r.discount_of_contract_id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_discount_of_contract($discount_of_contract_info)
	{
			$this->db->trans_start();
			$this->db->insert('discount_of_contract', $discount_of_contract_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
	}

	function update_discount_of_contract($discount_of_contract_info,$id)
	{
			$this->db->where('discount_of_contract_id', $id);
			$this->db->update('discount_of_contract', $discount_of_contract_info);
			return TRUE;
	}

	public function get_discount_of_contract_detail($id)
	{
		  $id = $this->db->escape_str($id);
			$sql ="SELECT m.menu_id,m.`name`, md.is_add ,md.is_edit, md.is_view, md.is_active
				FROM menu m
				LEFT JOIN discount_of_contract_detail md ON m.menu_id = md.menu_id
				WHERE md.discount_of_contract_id = ".$id."";

			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function get_menu($id)
	{
		  $id = $this->db->escape_str($id);
			$sql ="SELECT m.* FROM menu m
				WHERE is_active = 1  AND  m.menu_id NOT IN (SELECT menu_id FROM  discount_of_contract_detail WHERE discount_of_contract_id = ".$id." ) ";
			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function save_discount_of_contract_detail ($value){
		 $sql ="INSERT INTO `discount_of_contract_detail` (`menu_id`, `discount_of_contract_id`, `is_add`, `is_view`, `is_edit`) VALUES ('".$value->menu_id."', '".$value->discount_of_contract_id."','0', '1', '0') ";
		 $this->db->query($sql);
	}

	public function update_discount_of_contract_detail ($value){
		 $sql = "UPDATE discount_of_contract_detail SET ".$value->case_update." =  '".$value->edit_valus."'  WHERE menu_id  = '".$value->menu_id."' AND  discount_of_contract_id = '".$value->discount_of_contract_id."' ";
		 $this->db->query($sql);
	}

}

/* End of file discount_of_contract_model.php */
/* Location: ./application/models/discount_of_contract_model.php */
