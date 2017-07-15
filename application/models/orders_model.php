
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class orders_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_orders_count($searchText = '')
	{
		// $this->db->escape() ใส่ '' ให้
		// $this->db->escape_str()  ไม่ใส่ '' ให้
		// $this->db->escape_like_str($searchText) like
		$searchText = $this->db->escape_like_str($searchText);
		$sql =" SELECT COUNT(r.order_id) as connt_id FROM  orders  r
    LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
    LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
    LEFT JOIN order_status  os ON os.order_status_id = r.order_status_id WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND ( r.order_id  LIKE '%".$searchText."%'
														OR  r.company  LIKE '%".$searchText."%'
                            OR  r.ref_id  LIKE '%".$searchText."%'
                            OR  r.tel  LIKE '%".$searchText."%'
														OR  r.email  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}


  public function get_order($order_id)
	{
		$order_id = $this->db->escape_str($order_id);
		$sql =" SELECT r.* , u1.name create_by_name , u2.name  modified_by_name ,os.`name` status_name
						FROM  orders  r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
						LEFT JOIN order_status  os ON os.order_status_id = r.order_status_id
						WHERE r.order_id  =  '".$order_id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	public function get_order_detail($order_id)
	{
		$order_id = $this->db->escape_str($order_id);
		$sql =" SELECT pw.part_number,pw.`name` product_name, pw.description product_description, od.* FROM order_detail od
				LEFT JOIN product_owner pw ON pw.product_owner_id = od.product_owner_id
				LEFT JOIN product_vendor pv ON pv.product_vendor_id = od.product_vendor_id
				WHERE od.order_id  =  '".$order_id."'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}


  function get_orders($searchText = '', $page, $segment)
  {
		$searchText = $this->db->escape_like_str($searchText);
		$page = $this->db->escape_str($page);
		$segment = $this->db->escape_str($segment);

		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name ,
		 			u3.name  assign_by_name,
		  		u4.name  assign_to_name,
					os.`name` status_name
						FROM  orders  r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
						LEFT JOIN tbl_users u3 ON u3.userId = r.assign_by
						LEFT JOIN tbl_users u4 ON u4.userId = r.assign_to
						LEFT JOIN order_status  os ON os.order_status_id = r.order_status_id
						WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (m.orders_id  LIKE '%".$searchText."%'
													OR  m.name  LIKE '%".$searchText."%'
													OR  m.description  LIKE '%".$searchText."%')";
		}
			$sql = $sql."ORDER BY r.create_date DESC  LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	function get_orders_all()
  {
		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  orders m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by WHERE 1=1 ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_orders_id($id)
	{

		$id = $this->db->escape($id);

		$sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  orders m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						WHERE m.orders_id = ".$id;
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_orders($orders_info)
	{
			$this->db->trans_start();
			$this->db->insert('orders', $orders_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
	}

	function update_orders($orders_info,$id)
	{
			$this->db->where('orders_id', $id);
			$this->db->update('orders', $orders_info);
			return TRUE;
	}

}

/* End of file orders_model.php */
/* Location: ./application/models/orders_model.php */
