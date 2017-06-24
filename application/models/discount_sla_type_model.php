<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_sla_type_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_discount_sla_type_count($searchText = '')
	{

		$sql =" SELECT COUNT(r.discount_sla_type_id) as connt_id FROM  discount_sla_type r WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (r.discount_sla_type_id  LIKE '%".$searchText."%' OR  r.name  LIKE '%".$searchText."%' OR  r.min  LIKE '%".$searchText."%' OR r.max  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}

  function get_discount_sla_type($searchText = '', $page, $segment)
  {
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_sla_type r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      if(!empty($searchText)) {
  				$sql = $sql." AND (r.discount_sla_type_id  LIKE '%".$searchText."%' OR  r.name  LIKE '%".$searchText."%' OR  r.min  LIKE '%".$searchText."%' OR r.max  LIKE '%".$searchText."%')";
  		}
			$sql = $sql." LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	function get_discount_sla_type_all()
  {
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_sla_type r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_discount_sla_type_id($id)
	{
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_sla_type r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
						 WHERE r.discount_sla_type_id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_discount_sla_type($discount_sla_type_info)
	{
			$this->db->trans_start();
			$this->db->insert('discount_sla_type', $discount_sla_type_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
	}

	function update_discount_sla_type($discount_sla_type_info,$id)
	{
			$this->db->where('discount_sla_type_id', $id);
			$this->db->update('discount_sla_type', $discount_sla_type_info);
			return TRUE;
	}

	public function get_discount_sla_type_detail($id)
	{
			$sql ="SELECT m.menu_id,m.`name`, md.is_add ,md.is_edit, md.is_view, md.is_active
				FROM menu m
				LEFT JOIN discount_sla_type_detail md ON m.menu_id = md.menu_id
				WHERE md.discount_sla_type_id = ".$id."";

			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function get_menu($id)
	{
			$sql ="SELECT m.* FROM menu m
				WHERE is_active = 1  AND  m.menu_id NOT IN (SELECT menu_id FROM  discount_sla_type_detail WHERE discount_sla_type_id = ".$id." ) ";
			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function save_discount_sla_type_detail ($value){
		 $sql ="INSERT INTO `discount_sla_type_detail` (`menu_id`, `discount_sla_type_id`, `is_add`, `is_view`, `is_edit`) VALUES ('".$value->menu_id."', '".$value->discount_sla_type_id."','0', '1', '0') ";
		 $this->db->query($sql);
	}

	public function update_discount_sla_type_detail ($value){
		 $sql = "UPDATE discount_sla_type_detail SET ".$value->case_update." =  '".$value->edit_valus."'  WHERE menu_id  = '".$value->menu_id."' AND  discount_sla_type_id = '".$value->discount_sla_type_id."' ";
		 $this->db->query($sql);
	}

}

/* End of file discount_sla_type_model.php */
/* Location: ./application/models/discount_sla_type_model.php */
