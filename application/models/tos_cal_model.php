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

        $sql =  $sql."SELECT v.product_owner_id,
                     '0' product_vendor_id,
                         v.total_type,
                         v.discount_sla_type_id,
                         v.type_name,
                         v.type_des,
                         v.province_name,
                         v.pm_time,
                         v.lb_year,
                         v.total_pm,
                         v.total_lb,
                         $product->contract as total_contract,
                         v.cal * (100 - c.discount)/100 AS cal,
                         1 is_owner
              FROM discount_of_contract c,

                (SELECT q.product_owner_id,
                        q.discount_sla_type_id,
                        q.total_type,
                        q.type_name,
                        q.type_des,
                        v1.province_name,
                        v1.pm_time,
                        v1.lb_year,
                        2 total_pm,
                        2 total_lb,
                        (v1.pm_time * $product->pm) + (v1.lb_year * $product->pm) + q.cal AS cal
                 FROM province v1,

                   (SELECT t.product_owner_id,
                           t.discount_sla_type_id,
                           t.total_type,
                           t.type_name,
                           t.type_des,
                           t.cal * (100 - q.discount)/100 AS cal
                    FROM discount_of_qty q,

                      (SELECT p.product_owner_id,
                              t.discount_sla_type_id,
                              t.min total_type,
                              t.`name` type_name,
                              t.description type_des,
                              p.full_price * (100-t.min)/100 AS cal
                       FROM discount_sla_type t,
                            product_owner p
                       WHERE t.is_owner = 1
                         AND p.product_owner_id = $product->product_owner_id ) t
                    WHERE $product->qty BETWEEN q.from_number AND q.to_number ) q
                 WHERE v1.province_id = $product->province ) v
              WHERE c.number = $product->contract

              UNION

              SELECT q.product_owner_id,
                     q.product_vendor_id,
                     q.discount_sla_type_id,
                     q.total_type,
                     q.type_name,
                     q.type_des,
                     v1.province_name,
                     v1.pm_time,
                     v1.lb_year,
                     2 total_pm,
                     2 total_lb,
                     $product->contract as total_contract,
                     (v1.pm_time * $product->pm) + (v1.lb_year * $product->pm) + q.cal AS cal,
                     0 is_owner
              FROM province v1,

                ( SELECT pv.product_vendor_id,
                         pw.product_owner_id,
                         t.discount_sla_type_id,
                         t.min total_type,
                         pv.`name` type_name,
                         pv.description type_des,
                         pv.dealer_price + (pv.dealer_price * t.min) cal
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
