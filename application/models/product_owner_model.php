
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class product_owner_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_product_owner_count($searchText = '')
	{

		$sql =" SELECT COUNT(m.part_number) as connt_id FROM  product_owner m WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (m.part_number  LIKE '%".$searchText."%' OR  m.name  LIKE '%".$searchText."%' OR OR  m.description  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}

  function get_product_owner($searchText = '', $page, $segment)
  {
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_owner m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (m.part_number  LIKE '%".$searchText."%' OR  m.name  LIKE '%".$searchText."%' OR OR  m.description  LIKE '%".$searchText."%')";
		}
			$sql = $sql." LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	function get_product_owner_all()
  {
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_owner m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by WHERE 1=1 ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_part_number($id)
	{
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_owner m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						 WHERE m.part_number = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_product_owner($product_owner_info)
	{
			$this->db->trans_start();
			$this->db->insert('product_owner', $product_owner_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
	}

	function update_product_owner($product_owner_info,$id)
	{
			$this->db->where('part_number', $id);
			$this->db->update('product_owner', $product_owner_info);
			return TRUE;
	}

}

/* End of file product_owner_model.php */
/* Location: ./application/models/product_owner_model.php */
