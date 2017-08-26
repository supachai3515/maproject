<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tos_cal_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_cal_product($product_list)
    {
        $sql = "";
        $i=0;
        foreach ($product_list as $product) {
            if (ctype_digit($product->product_owner_id)) {
                $sql =  $sql." SELECT 1 is_product_owner,
											 1 is_have_product,
											 '' comment,
						       		 v.product_owner_id,
					       			 '0' product_vendor_id,
						           v.type_name type_name,
						           v.type_des type_description,
						           v.full_price,
						           0 dealer_price,
						           v.discount_sla_type_id,
						           v.total_type discount_sla_type_value,
						           c.discount discount_of_contract_value,
						           v.discount_of_qty_value,
						           v.province_id,
						           v.province_name,
						           v.pm_time_value,
						           v.lb_year_value,
						           v.pm_time_qty,
						           v.lb_year_qty,
											 $product->contract contract_qty,
						           v.qty,
						           ((v.total * (100 - c.discount)/100) * $product->qty) * $product->contract AS total
						FROM discount_of_contract c,

						  (SELECT q.product_owner_id,
						          q.discount_sla_type_id,
						          q.total_type,
						          q.type_name,
						          q.type_des,
						          q.full_price,
						          q.discount_of_qty_value,
						          v1.province_id,
						          v1.province_name,
						          v1.pm_time pm_time_value,
						          v1.lb_year lb_year_value,
						          $product->pm pm_time_qty,
						          $product->pm lb_year_qty,
						          q.qty,
						          (v1.pm_time * $product->pm) + (v1.lb_year * $product->pm) + q.total AS total
						   FROM province v1,

						     (SELECT t.product_owner_id,
						             t.discount_sla_type_id,
						             q.discount discount_of_qty_value,
						             t.total_type,
						             t.full_price,
						             t.type_name,
						             t.type_des,
						             $product->qty qty,
						             t.total * (100 - q.discount)/100 AS total
						      FROM discount_of_qty q,

						        (SELECT p.product_owner_id,
						                t.discount_sla_type_id,
						                t.min total_type,
						                t.`name` type_name,
						                t.description type_des,
						                p.full_price,
						                p.full_price * (100-t.min)/100 AS total
						         FROM discount_sla_type t,
						              product_owner p
						         WHERE t.is_owner = 1
						           AND p.product_owner_id = $product->product_owner_id ) t
						      WHERE $product->qty BETWEEN q.from_number AND q.to_number ) q
						   WHERE v1.province_id = $product->province ) v
						WHERE c.number = $product->contract

						UNION

						SELECT 0 is_product_owner,
									 1 is_have_product,
									 '' comment,
						       q.product_owner_id,
						       q.product_vendor_id,
						       q.type_name,
						       q.type_des type_description,
						       0 full_price,
						       q.dealer_price,
						       q.discount_sla_type_id,
						       q.discount_sla_type_value,
						       0 discount_of_contract_value,
						       0 discount_of_qty_value,
						       v1.province_id,
						       v1.province_name,
						       v1.pm_time pm_time_value,
						       v1.lb_year lb_year_value,
						       $product->pm pm_time_qty,
						       $product->pm lb_year_qty,
									 $product->contract contract_qty,
						       $product->qty qty,
						       (((v1.pm_time * $product->pm) + (v1.lb_year * $product->pm) + q.total) * $product->qty ) * $product->contract AS total
						FROM province v1,

						  (SELECT pv.product_vendor_id,
						          pw.product_owner_id,
						          t.discount_sla_type_id,
						          t.min total_type,
						          t.`name` type_name,
						          pv.description type_des,
						          pv.dealer_price,
						          t.min discount_sla_type_value,
						          pv.dealer_price + (pv.dealer_price * t.min)/100 total
						   FROM product_vendor pv
						   INNER JOIN product_owner pw ON pv.model = pw.model, discount_sla_type t
						   WHERE pw.product_owner_id = $product->product_owner_id
						     AND t.is_owner = 0 ) q
						WHERE v1.province_id = $product->province ";
            }
            $i++;
            if ($i < count($product_list) && $sql != "") {
                $sql =  $sql." UNION ";
            }
        }

        foreach ($product_list as $product) {
            if (isset($product->is_have_product) && $product->is_have_product == "0") {
                if ($sql != "") {
                    $sql =  $sql." UNION ";
                }

                $sql =  $sql."  SELECT 0 is_product_owner,
														0 is_have_product,
														CONCAT('Name: $product->name',' , part_number: $product->part_number') comment,
														0	product_owner_id,
														0 product_vendor_id,
														'' type_name,
														'' type_description,
														0 full_price,
														0 dealer_price,
														0 discount_sla_type_id,
														0 discount_sla_type_value,
														0 discount_of_contract_value,
														0 discount_of_qty_value,
														v.province_id,
														v.province_name,
														'' pm_time_value,
														''  lb_year_value,
														$product->pm pm_time_qty,
														$product->pm lb_year_qty,
														$product->contract contract_qty,
														$product->qty  qty ,
														0 AS total
														FROM province v
														WHERE v.province_id = $product->province ";
            }

            $i++;
            if ($i < count($product_list) && $sql != "") {
                $sql =  $sql." UNION ";
            }
        }
        //print($sql);

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        //echo "<pre>";
    //print_r ($list);
    //echo "</pre>";
    //list owner cal
    }

    public function save_order($data_info, $product_list)
    {
        $order_id = 0;
        $total_cal = 0;
        $total_qty = 0;
        $ref_order_id = md5("wisadev".date("YmdHis")."tos");

        foreach ($product_list as $row) {
            $total_cal  = $total_cal  + $row->total;
            $total_qty  = $total_qty  + $row->qty;
        }
        // transection
        $this->db->trans_begin();
        date_default_timezone_set("Asia/Bangkok");
        $data = array(
                'ref_id'=>$ref_order_id,
                'order_date' => date("Y-m-d H:i:s"),
                'company' =>$data_info['name'],
                'address' =>'',
                'tel' => $data_info['tel'],
                'email' =>$data_info['email'],
                'order_status_id' => '1',
                'qty' => $total_qty ,
                'total' => $total_cal,
                'is_active' => '1',
                'create_date' =>date("Y-m-d H:i:s"),
                'create_by' => '1',
                'modified_date' => date("Y-m-d H:i:s"),
                'modified_by' =>'1'
            );

        $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();
        $line_number =1;

        foreach ($product_list as $row) {
            $data_detail = array(
                        'order_id' => $order_id ,
                        'line_number' => $line_number,
                        'is_product_owner' => $row->is_product_owner,
                        'is_have_product' => $row->is_have_product,
                        'comment' => $row->comment,
                        'product_owner_id' => $row->product_owner_id,
                        'product_vendor_id' => $row->product_vendor_id,
                        'type_name' => $row->type_name,
                        'type_description' => $row->type_description,
                        'full_price' => $row->full_price,
                        'dealer_price' => $row->dealer_price,
                        'discount_sla_type_id' => $row->discount_sla_type_id,
                        'discount_sla_type_value' => $row->discount_sla_type_value,
                        'discount_of_contract_value' => $row->discount_of_contract_value,
                        'discount_of_qty_value' => $row->discount_of_qty_value,
                        'province_id' => $row->province_id,
                        'province_name' => $row->province_name,
                        'pm_time_value' => $row->pm_time_value,
                        'lb_year_value' => $row->lb_year_value,
                        'pm_time_qty' => $row->pm_time_qty,
                        'lb_year_qty' => $row->lb_year_qty,
                        'contract_qty' => $row->contract_qty,
                        'qty' => $row->qty,
                        'total' => $row->total,
                    );

            $this->db->insert('order_detail', $data_detail);
            $line_number++;
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return $order_id;
        } else {
            $this->db->trans_commit();
            //destroy  session
            $this->session->unset_userdata('info_email');
            $this->session->unset_userdata('info_name');
            $this->session->unset_userdata('info_tel');
            $this->session->unset_userdata('product_list');
            return $order_id;
        }
    }

    public function get_order_id_by_ref($ref_id)
    {
        $ref_id = $this->db->escape($ref_id);
        $sql =" SELECT * FROM  orders r WHERE ref_id = $ref_id ";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        if ($row != null) {
            return  $row['order_id'];
        }
    }
    public function get_order_status_id_by_ref($ref_id)
    {
        $ref_id = $this->db->escape($ref_id);
        $sql =" SELECT order_status_id FROM  orders WHERE ref_id = $ref_id ";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        if ($row != null) {
            return  $row['order_status_id'];
        }
    }

    public function update_request_spacial_price($id)
    {
      $order_id = $this->db->escape_str($id);
      $sql =" UPDATE orders SET order_status_id = 2 WHERE order_status_id < 2 AND order_id = $order_id ";
      $this->db->query($sql);

      $sql =" INSERT INTO order_status_history VALUES($id,2,'Request special price',NOW()) ";
      $this->db->query($sql);

      return true;
    }

    public function update_accept_special_price($id)
    {
      $order_id = $this->db->escape_str($id);
      $sql =" UPDATE orders SET order_status_id = 5 WHERE order_status_id < 5 AND order_id = $order_id ";
      $this->db->query($sql);

      $sql =" INSERT INTO order_status_history VALUES($id,5,'Request special price',NOW()) ";
      $this->db->query($sql);

      return true;
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
}
