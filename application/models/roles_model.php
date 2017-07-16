
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function get_roles_count($searchText = '')
	{
		$searchText = $this->db->escape_like_str($searchText);
		$sql =" SELECT COUNT(r.roleId) as connt_id FROM  tbl_roles r WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (r.roleId  LIKE '%".$searchText."%' OR  r.role  LIKE '%".$searchText."%')";
		}
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return  $row['connt_id'];

	}

  function get_roles($searchText = '', $page, $segment)
  {

		$searchText = $this->db->escape_like_str($searchText);
		$page = $this->db->escape_str($page);
		$segment = $this->db->escape_str($segment);

		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  tbl_roles r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by WHERE 1=1 ";
		if(!empty($searchText)) {
				$sql = $sql." AND (r.roleId  LIKE '%".$searchText."%' OR  r.role  LIKE '%".$searchText."%')";
		}
			$sql = $sql." LIMIT ".$page.",".$segment." ";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
  }

	public function get_roles_id($id)
	{
		$id = $this->db->escape_str($id);
		$sql ="SELECT r.* , u1.name create_by_name , u2.name  modified_by_name FROM  tbl_roles r
						LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
						 WHERE r.roleId = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
	}

	function save_roles($roles_info)
	{
			$this->db->trans_start();
			$this->db->insert('tbl_roles', $roles_info);
			$insert_id = $this->db->insert_id();
			$this->db->trans_complete();
			return $insert_id;
	}

	function update_roles($roles_info,$id)
	{
			$this->db->where('roleId', $id);
			$this->db->update('tbl_roles', $roles_info);
			return TRUE;
	}


}

/* End of file roles_model.php */
/* Location: ./application/models/roles_model.php */
