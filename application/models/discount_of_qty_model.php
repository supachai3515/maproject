<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount_of_qty_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_discount_of_qty_count($searchText = '')
	{

		$sql =" SELECT COUNT(r.discount_of_qty_id) as connt_id FROM  discount_of_qty r WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (r.from_number  LIKE '%".$searchText."%' OR  r.to_number  LIKE '%".$searchText."%' OR  r.discount  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}

  function get_discount_of_qty($searchText = '', $page, $segment)
  {
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_of_qty r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      if(!empty($searchText)) {
  				$sql = $sql." AND (r.from_number  LIKE '%".$searchText."%' OR  r.to_number  LIKE '%".$searchText."%' OR  r.discount  LIKE '%".$searchText."%')";
  		}
			$sql = $sql." LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	function get_discount_of_qty_all()
  {
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_of_qty r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_discount_of_qty_id($id)
	{
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  discount_of_qty r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
						 WHERE r.discount_of_qty_id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_discount_of_qty($discount_of_qty_info)
	{
			$this->db->trans_start();
			$this->db->insert('discount_of_qty', $discount_of_qty_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
	}

	function update_discount_of_qty($discount_of_qty_info,$id)
	{
			$this->db->where('discount_of_qty_id', $id);
			$this->db->update('discount_of_qty', $discount_of_qty_info);
			return TRUE;
	}

	public function get_discount_of_qty_detail($id)
	{
			$sql ="SELECT m.menu_id,m.`name`, md.is_add ,md.is_edit, md.is_view, md.is_active
				FROM menu m
				LEFT JOIN discount_of_qty_detail md ON m.menu_id = md.menu_id
				WHERE md.discount_of_qty_id = ".$id."";

			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function get_menu($id)
	{
			$sql ="SELECT m.* FROM menu m
				WHERE is_active = 1  AND  m.menu_id NOT IN (SELECT menu_id FROM  discount_of_qty_detail WHERE discount_of_qty_id = ".$id." ) ";
			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function save_discount_of_qty_detail ($value){
		 $sql ="INSERT INTO `discount_of_qty_detail` (`menu_id`, `discount_of_qty_id`, `is_add`, `is_view`, `is_edit`) VALUES ('".$value->menu_id."', '".$value->discount_of_qty_id."','0', '1', '0') ";
		 $this->db->query($sql);
	}

	public function update_discount_of_qty_detail ($value){
		 $sql = "UPDATE discount_of_qty_detail SET ".$value->case_update." =  '".$value->edit_valus."'  WHERE menu_id  = '".$value->menu_id."' AND  discount_of_qty_id = '".$value->discount_of_qty_id."' ";
		 $this->db->query($sql);
	}

}

/* End of file discount_of_qty_model.php */
/* Location: ./application/models/discount_of_qty_model.php */
