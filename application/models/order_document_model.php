
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_document_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function get_order_doc_count($searchText = '')
    {
        // $this->db->escape() ใส่ '' ให้
        // $this->db->escape_str()  ไม่ใส่ '' ให้
        // $this->db->escape_like_str($searchText) like
        $searchText = $this->db->escape_like_str($searchText);
        $sql =" SELECT COUNT(m.order_document_id) as connt_id FROM order_document m WHERE 1=1 ";
        if (!empty($searchText)) {
            $sql = $sql." AND (m.order_document_id  LIKE '%".$searchText."%'
                        OR  IFNULL(m.order_description,'')  LIKE '%".$searchText."%')";
        }
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return  $row['connt_id'];
    }

    public function get_order_doc($searchText = '', $page, $segment)
    {
        $searchText = $this->db->escape_like_str($searchText);
        $page = $this->db->escape_str($page);
        $segment = $this->db->escape_str($segment);

        $sql ="SELECT r.* , u1.name create_by_name , 
                            u2.name modified_by_name ,
                            u3.name assign_by_name,
                            u4.name assign_to_name
                        FROM  order_document  r
                        LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
                        LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
                        LEFT JOIN tbl_users u3 ON u3.userId = r.assign_by
                        LEFT JOIN tbl_users u4 ON u4.userId = r.assign_to
                        WHERE 1=1 ";

        if (!empty($searchText)) {
            $sql = $sql." AND (m.order_document_id  LIKE '%".$searchText."%'
                        OR  IFNULL(m.order_description,'')  LIKE '%".$searchText."%')";
        }
        $sql = $sql." ORDER BY r.create_date DESC";
        $sql = $sql." LIMIT ".$page.",".$segment." ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

     public function get_order_doc_detail($id)
    {
        $id = $this->db->escape($id);
        $sql =" SELECT r.* , u1.name create_by_name, 
                            u2.name  modified_by_name,
                            u3.name  assign_by_name,
                            u4.name  assign_to_name
                        FROM  order_document  r
                        LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
                        LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
                        LEFT JOIN tbl_users u3 ON u3.userId = r.assign_by
                        LEFT JOIN tbl_users u4 ON u4.userId = r.assign_to
                        WHERE r.order_document_id  =  ".$id."";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }

    public function save_order_document($orders_data)
    {
        $assign_by = null;
        $assign_to = null;
        $assign_by_date = null;
        $assign_to_date = null;
        
        $this->db->trans_start();
        $data = array(
            'order_description'=>$orders_data->descripttion,
            'document_path' =>$orders_data->order_doc_path,
            'is_active' => '1',
            'create_date' =>date("Y-m-d H:i:s"),
            'create_by' =>'1',
            'modified_date' =>date("Y-m-d H:i:s"),
            'modified_by' =>'1',
            'assign_by' => $assign_by,
            'assign_to' => $assign_to,
            'assign_by_date' => $assign_by_date,
            'assign_to_date' => $assign_to_date,
        );
        $this->db->insert('order_document', $data);
        $order_document_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $order_document_id;
    }

    public function update_order_document($orders_data, $vendorId)
    {
        $data = array(
            'order_description'=>$orders_data->descripttion,
            'document_path' =>$orders_data->order_doc_path,
            'modified_date' =>date("Y-m-d H:i:s"),
            'modified_by' =>$vendorId
        );

        $this->db->where('order_document_id', $orders_data->order_doc_id);
        $this->db->update('order_document', $data);
        return true;
    }
    public function assign_order_document($orders_doc,$orders_doc_id)
    {
        $this->db->where('order_document_id', $orders_doc_id);
        $this->db->update('order_document', $orders_doc);

        return TRUE;
    }
}
