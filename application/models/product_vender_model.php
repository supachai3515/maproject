
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_vender_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_product_vender_count($searchText = '')
	{

		$sql =" SELECT COUNT(m.part_number) as connt_id FROM  product_vender m WHERE 1=1 ";
		if(!empty($searchText)) {
			$sql = $sql." AND (m.part_number  LIKE '%".$searchText."%'
												OR  m.name  LIKE '%".$searchText."%'
												OR  m.description  LIKE '%".$searchText."%'
												OR  b.name  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}

  function get_product_vender($searchText = '', $page, $segment)
  {
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name ,b.name product_brand_name FROM  product_vender m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						LEFT JOIN product_brand b ON m.product_brand_id = b.product_brand_id
						WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (m.part_number  LIKE '%".$searchText."%'
													OR  m.name  LIKE '%".$searchText."%'
													OR  m.description  LIKE '%".$searchText."%'
													OR  b.name  LIKE '%".$searchText."%')";
		}
			$sql = $sql." LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	function get_product_vender_all()
  {
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_vender m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by WHERE 1=1 ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_part_number($id)
	{
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_vender m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						 WHERE m.part_number = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_product_vender($product_vender_info)
	{

		$sql =" SELECT COUNT(m.part_number) as connt_id FROM  product_vender m WHERE part_number ='".$product_vender_info["part_number"]."' ";
		$query = $this->db->query($sql);
		$row = $query->row_array();

		if($row['connt_id'] == 0){
			$this->db->trans_start();
			$this->db->insert('product_vender', $product_vender_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
		}
		else{
			return 0;
		}
	}

	function update_product_vender($product_vender_info,$id)
	{
		$sql =" SELECT COUNT(m.part_number) as connt_id FROM  product_vender m
		WHERE part_number ='".$product_vender_info["part_number"]."' AND product_vender_id != '".$product_vender_info['product_vender_id']."' ";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		if($row['connt_id'] == 0){

			$this->db->where('product_vender_id', $id);
			$this->db->update('product_vender', $product_vender_info);
			return 2;
		}
		else{
			return 0;
		}
	}


	public function get_product_vender_id($id)
	{
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_vender m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						 WHERE m.product_vender_id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}
}

/* End of file product_vender_model.php */
/* Location: ./application/models/product_vender_model.php */
