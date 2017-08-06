
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class product_owner_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_product_owner_count($searchText = '')
    {
        $searchText = $this->db->escape_like_str($searchText);
        $sql =" SELECT COUNT(m.part_number) as connt_id FROM  product_owner m
        LEFT JOIN product_brand b ON m.product_brand_id = b.product_brand_id
        WHERE 1=1 ";
        if (!empty($searchText)) {
            $sql = $sql." AND (m.part_number  LIKE '%".$searchText."%'
												OR  m.model  LIKE '%".$searchText."%'
												OR  m.name  LIKE '%".$searchText."%'
												OR  m.description  LIKE '%".$searchText."%'
												OR  m.name  LIKE '%".$searchText."%')";
        }
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return  $row['connt_id'];
    }

    public function get_product_owner($searchText = '', $page, $segment)
    {
        $searchText = $this->db->escape_like_str($searchText);
        $page = $this->db->escape_str($page);
        $segment = $this->db->escape_str($segment);

        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name ,b.name product_brand_name FROM  product_owner m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						LEFT JOIN product_brand b ON m.product_brand_id = b.product_brand_id
						WHERE 1=1 ";
        if (!empty($searchText)) {
            $sql = $sql." AND (m.part_number  LIKE '%".$searchText."%'
													OR  m.model  LIKE '%".$searchText."%'
													OR  m.name  LIKE '%".$searchText."%'
													OR  m.description  LIKE '%".$searchText."%'
													OR  b.name  LIKE '%".$searchText."%')";
        }
        $sql = $sql." LIMIT ".$page.",".$segment." ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_product_owner_all()
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
        $id = $this->db->escape_str($id);
        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_owner m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						 WHERE m.part_number = '".$id."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }

    public function save_product_owner($product_owner_info)
    {
        $sql =" SELECT COUNT(m.part_number) as connt_id FROM  product_owner m WHERE part_number ='".$product_owner_info["part_number"]."' ";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        if ($row['connt_id'] == 0) {
            $this->db->trans_start();
            $this->db->insert('product_owner', $product_owner_info);
            $insert_id = $this->db->insert_id();
            $this->db->trans_complete();
            return $insert_id;
        } else {
            return 0;
        }
    }

    public function update_product_owner($product_owner_info, $id)
    {
        $sql =" SELECT COUNT(m.part_number) as connt_id FROM  product_owner m
						WHERE part_number ='".$product_owner_info["part_number"]."' AND product_owner_id != '".$product_owner_info['product_owner_id']."' ";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        if ($row['connt_id'] == 0) {
            $this->db->where('product_owner_id', $id);
            $this->db->update('product_owner', $product_owner_info);
            return 2;
        } else {
            return 0;
        }
    }


    public function get_product_owner_id($id)
    {
        $id = $this->db->escape_str($id);
        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_owner m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						 WHERE m.product_owner_id = '".$id."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }
    public function upload_product_owner($data_product, $user_id)
    {
        $this->db->trans_begin();
        $sql = "SELECT COUNT(*)count FROM product_owner WHERE part_number ='".$data_product['part_number']."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        if ($row['count'] == 0) {
            $product_owner_info = array('part_number' => $data_product['part_number'],
																				'model' => $data_product['model'],
																				'name'=>$data_product['name'],
																				'description'=>$data_product['description'],
																				'product_brand_id'=>$data_product['product_brand_id'],
																				'full_price'=>$data_product['full_price'],
																				'is_active'=> 1 ,
																				'create_by'=>$user_id,
																				'create_date'=>date('Y-m-d H:i:s'),
																				'modified_by'=>$user_id,
																				'modified_date'=>date('Y-m-d H:i:s'));
            $this->db->insert('product_owner', $product_owner_info);
            $data_product['comment'] = $this->db->insert_id();
            //insert
        } else {
            //update
						$product_owner_info =array('part_number' => $data_product['part_number'],
																				'model' => $data_product['model'],
																				'name'=>$data_product['name'],
																				'description'=>$data_product['description'],
																				'product_brand_id'=>$data_product['product_brand_id'],
																				'full_price'=>$data_product['full_price'],
																				'modified_by'=>$user_id,
																				'modified_date'=>date('Y-m-d H:i:s'));
						$where = array('part_number' => $data_product['part_number'] );
            $this->db->update('product_owner', $product_owner_info,$where);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
						$data_product['is_error'] = 1;

            return $data_product;
        } else {
            $this->db->trans_commit();
            return $data_product;
        }
    }
}

/* End of file product_owner_model.php */
/* Location: ./application/models/product_owner_model.php */
