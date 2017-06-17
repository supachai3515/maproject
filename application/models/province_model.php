<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Province_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_province_count($searchText = '')
	{

		$sql =" SELECT COUNT(r.province_id) as connt_id FROM  province r WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (r.province_id  LIKE '%".$searchText."%' OR  r.province_name  LIKE '%".$searchText."%' OR  r.lb_year  LIKE '%".$searchText."%' OR r.pm_time  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}

  function get_province($searchText = '', $page, $segment)
  {
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  province r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      if(!empty($searchText)) {
  				$sql = $sql." AND (r.province_id  LIKE '%".$searchText."%' OR  r.province_name  LIKE '%".$searchText."%' OR  r.lb_year  LIKE '%".$searchText."%' OR r.pm_time  LIKE '%".$searchText."%')";
  		}
			$sql = $sql." LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	function get_province_all()
  {
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  province r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_province_id($id)
	{
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  province r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
						 WHERE r.province_id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_province($province_info)
	{
			$this->db->trans_start();
			$this->db->insert('province', $province_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
	}

	function update_province($province_info,$id)
	{
			$this->db->where('province_id', $id);
			$this->db->update('province', $province_info);
			return TRUE;
	}

	public function get_province_detail($id)
	{
			$sql ="SELECT m.menu_id,m.`name`, md.is_add ,md.is_edit, md.is_view, md.is_active
				FROM menu m
				LEFT JOIN province_detail md ON m.menu_id = md.menu_id
				WHERE md.province_id = ".$id."";

			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function get_menu($id)
	{
			$sql ="SELECT m.* FROM menu m
				WHERE is_active = 1  AND  m.menu_id NOT IN (SELECT menu_id FROM  province_detail WHERE province_id = ".$id." ) ";
			$re = $this->db->query($sql);
			return $re->result_array();
	}

	public function save_province_detail ($value){
		 $sql ="INSERT INTO `province_detail` (`menu_id`, `province_id`, `is_add`, `is_view`, `is_edit`) VALUES ('".$value->menu_id."', '".$value->province_id."','0', '1', '0') ";
		 $this->db->query($sql);
	}

	public function update_province_detail ($value){
		 $sql = "UPDATE province_detail SET ".$value->case_update." =  '".$value->edit_valus."'  WHERE menu_id  = '".$value->menu_id."' AND  province_id = '".$value->province_id."' ";
		 $this->db->query($sql);
	}

}

/* End of file province_model.php */
/* Location: ./application/models/province_model.php */
