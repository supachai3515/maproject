<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tos_cal_model extends CI_Model {
	public function __construct(){
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
						           v.qty,
						           (v.total * (100 - c.discount)/100) * $product->contract AS total
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
						          2 pm_time_qty,
						          2 lb_year_qty,
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
						             2 qty,
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
						      WHERE 2 BETWEEN q.from_number AND q.to_number ) q
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
						       2 pm_time_qty,
						       2 lb_year_qty,
						       $product->contract qty,
						       ((v1.pm_time * $product->pm) + (v1.lb_year * $product->pm) + q.total) * $product->contract AS total
						FROM province v1,

						  (SELECT pv.product_vendor_id,
						          pw.product_owner_id,
						          t.discount_sla_type_id,
						          t.min total_type,
						          t.`name` type_name,
						          pv.description type_des,
						          pv.dealer_price,
						          t.min discount_sla_type_value,
						          pv.dealer_price + (pv.dealer_price * t.min) total
						   FROM product_vendor pv
						   INNER JOIN product_owner pw ON pv.model = pw.model, discount_sla_type t
						   WHERE pw.product_owner_id = $product->product_owner_id
						     AND t.is_owner = 0 ) q
						WHERE v1.province_id = $product->province ";

      }
      $i++;
      if($i < count($product_list) && $sql != ""){
        $sql =  $sql." UNION ";
      }
    }

		foreach ($product_list as $product) {
				if(isset($product->is_have_product) && $product->is_have_product == "0"){
					if($sql != ""){
						$sql =  $sql." UNION ";
					}

						$sql =  $sql."  SELECT 0 is_product_owner,
														0 is_have_product,
														CONCAT('Name: $product->name',' , Model: $product->model') comment,
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
														$product->contract  qty ,
														0 AS total
														FROM province v
														WHERE v.province_id = $product->province ";
			}

			$i++;
      if($i < count($product_list) && $sql != ""){
        $sql =  $sql." UNION ";
      }
		}

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
    //echo "<pre>";
    //print_r ($list);
    //echo "</pre>";
    //list owner cal

  }

	public function save_order($data_info , $product_list)
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
						'qty' => $row->qty,
						'total' => $row->total,
					);

			$this->db->insert('order_detail', $data_detail);
			$line_number++;
		}

		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				return $order_id;
		}
		else
		{
				$this->db->trans_commit();
				//destroy  session
				$this->session->unset_userdata('info_email');
				$this->session->unset_userdata('info_name');
				$this->session->unset_userdata('info_tel');
				$this->session->unset_userdata('product_list');
				return $order_id;
		}

	}

	public function get_order($order_id)
	{
		# code...
	}
}
