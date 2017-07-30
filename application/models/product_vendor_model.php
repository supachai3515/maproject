
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_vendor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_product_vendor_count($searchText = '')
    {
        $searchText = $this->db->escape_like_str($searchText);
        $sql =" SELECT COUNT(m.product_vendor_id) as connt_id FROM  product_vendor m WHERE 1=1 ";
        if (!empty($searchText)) {
            $sql = $sql." AND (m.product_vendor_id  LIKE '%".$searchText."%'
												OR  m.name  LIKE '%".$searchText."%'
												OR  m.model  LIKE '%".$searchText."%'
												OR  m.description  LIKE '%".$searchText."%'
												OR  b.name  LIKE '%".$searchText."%')";
        }
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return  $row['connt_id'];
    }

    public function get_product_vendor($searchText = '', $page, $segment)
    {
        $searchText = $this->db->escape_like_str($searchText);
        $page = $this->db->escape_str($page);
        $segment = $this->db->escape_str($segment);

        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name ,b.name product_brand_name FROM  product_vendor m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						LEFT JOIN product_brand b ON m.product_brand_id = b.product_brand_id
						WHERE 1=1 ";
        if (!empty($searchText)) {
            $sql = $sql." AND (m.product_vendor_id  LIKE '%".$searchText."%'
													OR  m.name  LIKE '%".$searchText."%'
													OR  m.model  LIKE '%".$searchText."%'
													OR  m.description  LIKE '%".$searchText."%'
													OR  b.name  LIKE '%".$searchText."%')";
        }
        $sql = $sql." LIMIT ".$page.",".$segment." ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_product_vendor_all()
    {
        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_vendor m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by WHERE 1=1 ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_part_number($id)
    {
        $id = $this->db->escape_str($id);
        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_vendor m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						 WHERE m.part_number = '".$id."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }

    public function save_product_vendor($product_vendor_info)
    {
        $this->db->trans_start();
        $this->db->insert('product_vendor', $product_vendor_info);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function update_product_vendor($product_vendor_info, $id)
    {
        $this->db->where('product_vendor_id', $id);
        $this->db->update('product_vendor', $product_vendor_info);
        return true;
    }


    public function get_product_vendor_id($id)
    {
        $id = $this->db->escape_str($id);
        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  product_vendor m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						 WHERE m.product_vendor_id = '".$id."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }
    public function upload_product_vendor($data_product, $user_id)
    {
        $this->db->trans_begin();
        if ($data_product['product_vendor_id'] == 0) {
            $product_vendor_info = array('product_vendor_id' => $data_product['product_vendor_id'],
                                        'model' => $data_product['model'],
                                        'name'=>$data_product['name'],
                                        'description'=>$data_product['description'],
                                        'product_brand_id'=>$data_product['product_brand_id'],
                                        'dealer_price'=>$data_product['dealer_price'],
                                        'is_active'=> 1 ,
                                        'create_by'=>$user_id,
                                        'create_date'=>date('Y-m-d H:i:s'),
                                        'modified_by'=>$user_id,
                                        'modified_date'=>date('Y-m-d H:i:s'));
            $this->db->insert('product_vendor', $product_vendor_info);
            $data_product['product_vendor_id'] = $this->db->insert_id();
            //insert
        } else {
            //update
            $product_vendor_info =array('model' => $data_product['model'],
                                        'name'=>$data_product['name'],
                                        'description'=>$data_product['description'],
                                        'product_brand_id'=>$data_product['product_brand_id'],
                                        'dealer_price'=>$data_product['dealer_price'],
                                        'modified_by'=>$user_id,
                                        'modified_date'=>date('Y-m-d H:i:s'));
            $where = array('product_vendor_id' => $data_product['product_vendor_id'] );
            $this->db->update('product_vendor', $product_vendor_info, $where);
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

/* End of file product_vendor_model.php */
/* Location: ./application/models/product_vendor_model.php */
