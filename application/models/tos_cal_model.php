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
      if($i < count($product_list)){
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
}
