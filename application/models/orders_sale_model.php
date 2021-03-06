
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_sale_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_orders_count($searchText = '', $assign_to)
    {
        // $this->db->escape() ใส่ '' ให้
        // $this->db->escape_str()  ไม่ใส่ '' ให้
        // $this->db->escape_like_str($searchText) like
        $searchText = $this->db->escape_like_str($searchText);
        $sql =" SELECT COUNT(r.order_id) as connt_id FROM  orders  r
    LEFT JOIN tbl_users u1 ON u1.userId = r.create_by
    LEFT JOIN tbl_users u2 ON u2.userId = r.modified_by
    LEFT JOIN order_status  os ON os.order_status_id = r.order_status_id WHERE 1=1 AND r.assign_to = '".$assign_to."' ";
        if (!empty($searchText)) {
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

    public function get_orders($searchText = '', $page, $segment, $assign_to)
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
						WHERE 1=1 AND r.assign_to = '".$assign_to."' ";
        if (!empty($searchText)) {
            $sql = $sql." AND ( r.order_id  LIKE '%".$searchText."%'
															OR  r.company  LIKE '%".$searchText."%'
	                            OR  r.ref_id  LIKE '%".$searchText."%'
	                            OR  r.tel  LIKE '%".$searchText."%'
															OR  r.email  LIKE '%".$searchText."%')";
        }
        $sql = $sql."ORDER BY r.create_date DESC  LIMIT ".$page.",".$segment." ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function update_orders($orders_info, $id)
    {
        $this->db->where('order_id', $id);
        $this->db->update('orders', $orders_info);
        return true;
    }

    public function save_detail($data_info, $user_id)
    {
        if ($data_info->contract_qty == null) {
            $data_info->contract_qty = 1;
        }

        $data_info->pm_time_qty = $data_info->pm_time_qty;
        $data_info->lb_year_qty = $data_info->pm_time_qty;


        if ($data_info->is_product_owner == "1" && $data_info->is_have_product == "1") {
            //product_owner
            $sql = "SELECT
											c.discount discount_of_contract_value,
											v.discount_of_qty_value,
											pv.province_name,
											(
												(
													v.total * (100 - c.discount) / 100
												) * $data_info->qty
											) * $data_info->contract_qty AS total
										FROM
											discount_of_contract c,
											province pv,
											(
												SELECT
													q.discount discount_of_qty_value,
													(
														$data_info->pm_time_value * $data_info->pm_time_qty
													) + (
														$data_info->lb_year_value * $data_info->lb_year_qty
													) + (
														t.total * (100 - q.discount) / 100
													) AS total
												FROM
													discount_of_qty q,
													(
														SELECT
															$data_info->full_price * (
																100 - $data_info->discount_sla_type_value
															) / 100 AS total
													) t
												WHERE
													$data_info->qty BETWEEN q.from_number
												AND q.to_number
											) v
										WHERE
											c.number = $data_info->contract_qty AND pv.province_id = $data_info->province_id
											";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $data_info->total = $row['total'];
            $data_info->discount_of_contract_value = $row['discount_of_contract_value'];
            $data_info->discount_of_qty_value = $row['discount_of_qty_value'];
            $data_info->province_name = $row['province_name'];

            //update
            $result = $this->update_order($data_info, $user_id);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } elseif ($data_info->is_product_owner == "0" && $data_info->is_have_product == "1") {
            //product_vander
            $sql = "SELECT
											pv.province_name,
											(v.total * $data_info->qty) * $data_info->contract_qty AS total
										FROM
											province pv,
											(
												SELECT
													($data_info->pm_time_value * $data_info->pm_time_qty) +
													($data_info->lb_year_value * $data_info->lb_year_qty) +
													($data_info->dealer_price * (100 - $data_info->discount_sla_type_value) / 100) AS total
											) v
										WHERE pv.province_id = $data_info->province_id
										";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $data_info->total = $row['total'];
            $data_info->province_name = $row['province_name'];
            //update
            $result = $this->update_order($data_info, $user_id);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            //not have product
            return false;
        }
    }

    public function update_order($data_info, $user_id)
    {
        $this->load->model('orders_model');
        // transection
        $this->db->trans_begin();
        $data_detail = array(
                        'order_id' => $data_info->order_id ,
                        'line_number' => $data_info->line_number,
                        'is_product_owner' => $data_info->is_product_owner,
                        'is_have_product' => $data_info->is_have_product,
                        'comment' => $data_info->comment,
                        'product_owner_id' => $data_info->product_owner_id,
                        'product_vendor_id' => $data_info->product_vendor_id,
                        'type_name' => $data_info->type_name,
                        'type_description' => $data_info->type_description,
                        'full_price' => $data_info->full_price,
                        'dealer_price' => $data_info->dealer_price,
                        'discount_sla_type_id' => $data_info->discount_sla_type_id,
                        'discount_sla_type_value' => $data_info->discount_sla_type_value,
                        'discount_of_contract_value' => $data_info->discount_of_contract_value,
                        'discount_of_qty_value' => $data_info->discount_of_qty_value,
                        'province_id' => $data_info->province_id,
                        'province_name' => $data_info->province_name,
                        'pm_time_value' => $data_info->pm_time_value,
                        'lb_year_value' => $data_info->lb_year_value,
                        'pm_time_qty' => $data_info->pm_time_qty,
                        'lb_year_qty' => $data_info->lb_year_qty,
                        'contract_qty' => $data_info->contract_qty,
                        'qty' => $data_info->qty,
                        'total' => $data_info->total,
                    );
        $where = array('order_id' => $data_info->order_id,'line_number' => $data_info->line_number);
        $this->db->update('order_detail', $data_detail, $where);

        //update header
        $total_cal = 0;
        $total_qty = 0;
        foreach ($this->orders_model->get_orders_detail($data_info->order_id) as $row) {
            $total_cal  = $total_cal  + $row['total'];
            $total_qty  = $total_qty  + $row['qty'];
        }

        date_default_timezone_set("Asia/Bangkok");
        $data = array(
                'qty' => $total_qty ,
                'total' => $total_cal,
                'modified_date' => date("Y-m-d H:i:s"),
                'modified_by' => $user_id
            );
        $where_order = array('order_id' => $data_info->order_id);
        $this->db->update('orders', $data, $where_order);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function del_detail($data_info, $user_id)
    {
        $this->load->model('orders_model');
        // transection
        $this->db->trans_begin();

        //delete detail
        $sql = "DELETE FROM order_detail WHERE order_id = '$data_info->order_id' AND line_number = '$data_info->line_number' AND product_owner_id = '$data_info->product_owner_id' ";
        $query = $this->db->query($sql);
        $order_list = $this->orders_model->get_orders_detail($data_info->order_id);
        //delete all
        $sql = "DELETE FROM order_detail WHERE order_id = '$data_info->order_id' ";
        $query = $this->db->query($sql);
        $line_number = 1;
        foreach ($order_list as $row) {
            $data_detail = array(
                            'order_id' => $row['order_id'],
                            'line_number' => $line_number,
                            'is_product_owner' => $row['is_product_owner'],
                            'is_have_product' => $row['is_have_product'],
                            'comment' => $row['comment'],
                            'product_owner_id' => $row['product_owner_id'],
                            'product_vendor_id' => $row['product_vendor_id'],
                            'type_name' => $row['type_name'],
                            'type_description' => $row['type_description'],
                            'full_price' => $row['full_price'],
                            'dealer_price' => $row['dealer_price'],
                            'discount_sla_type_id' => $row['discount_sla_type_id'],
                            'discount_sla_type_value' => $row['discount_sla_type_value'],
                            'discount_of_contract_value' => $row['discount_of_contract_value'],
                            'discount_of_qty_value' => $row['discount_of_qty_value'],
                            'province_id' => $row['province_id'],
                            'province_name' => $row['province_name'],
                            'pm_time_value' => $row['pm_time_value'],
                            'lb_year_value' => $row['lb_year_value'],
                            'pm_time_qty' => $row['pm_time_qty'],
                            'lb_year_qty' => $row['lb_year_qty'],
                            'contract_qty' => $row['contract_qty'],
                            'qty' => $row['qty'],
                            'total' => $row['total'],
                                            );
            $this->db->insert('order_detail', $data_detail);
            $line_number++;
        }

        //update header
        $total_cal = 0;
        $total_qty = 0;
        foreach ($this->orders_model->get_orders_detail($data_info->order_id) as $row) {
            $total_cal  = $total_cal  + $row['total'];
            $total_qty  = $total_qty  + $row['qty'];
        }

        date_default_timezone_set("Asia/Bangkok");
        $data = array(
                                'qty' => $total_qty ,
                                'total' => $total_cal,
                                'modified_date' => date("Y-m-d H:i:s"),
                                'modified_by' => $user_id
                        );
        $where_order = array('order_id' => $data_info->order_id);
        $this->db->update('orders', $data, $where_order);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function get_search_product_cal($product)
    {
      $this->load->model('tos_cal_model');
      $json_str = "[".json_encode($product)."]";
      $product_list = json_decode($json_str);
      return  $this->tos_cal_model->get_cal_product($product_list);
    }

    public function get_product_cal($data_info, $user_id)
    {
        if ($data_info->contract_qty == null) {
            $data_info->contract_qty = 1;
        }

        if ($data_info->is_product_owner == "1" && $data_info->is_have_product == "1") {
            //product_owner
            $sql = "SELECT
											c.discount discount_of_contract_value,
											v.discount_of_qty_value,
											pv.province_name,
											(
												(
													v.total * (100 - c.discount) / 100
												) * $data_info->qty
											) * $data_info->contract_qty AS total
										FROM
											discount_of_contract c,
											province pv,
											(
												SELECT
													q.discount discount_of_qty_value,
													(
														$data_info->pm_time_value * $data_info->pm_time_qty
													) + (
														$data_info->lb_year_value * $data_info->lb_year_qty
													) + (
														t.total * (100 - q.discount) / 100
													) AS total
												FROM
													discount_of_qty q,
													(
														SELECT
															$data_info->full_price * (
																100 - $data_info->discount_sla_type_value
															) / 100 AS total
													) t
												WHERE
													$data_info->qty BETWEEN q.from_number
												AND q.to_number
											) v
										WHERE
											c.number = $data_info->contract_qty AND pv.province_id = $data_info->province_id
											";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $data_info->total = $row['total'];
            $data_info->discount_of_contract_value = $row['discount_of_contract_value'];
            $data_info->discount_of_qty_value = $row['discount_of_qty_value'];
            $data_info->province_name = $row['province_name'];
            return $data_info;

        } elseif ($data_info->is_product_owner == "0" && $data_info->is_have_product == "1") {
            //product_vander
            $sql = "SELECT
											pv.province_name,
											(v.total * $data_info->qty) * $data_info->contract_qty AS total
										FROM
											province pv,
											(
												SELECT
													($data_info->pm_time_value * $data_info->pm_time_qty) +
													($data_info->lb_year_value * $data_info->lb_year_qty) +
													($data_info->full_price * (100 - $data_info->discount_sla_type_value) / 100) AS total
											) v
										WHERE pv.province_id = $data_info->province_id
										";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            $data_info->total = $row['total'];
            $data_info->province_name = $row['province_name'];
            return $data_info;
        } else {
            //not have product
            return null;
        }
    }

    public function new_save_detail($data_info_old, $user_id)
    {
      //คำนวนใหม่
      $data_info = $this->get_product_cal($data_info_old,$user_id);
      $this->load->model('orders_model');
      // transection
      $this->db->trans_begin();
      //new save detail
      $data_detail = array(
                      'order_id' => $data_info->order_id ,
                      'line_number' => 999,
                      'is_product_owner' => $data_info->is_product_owner,
                      'is_have_product' => $data_info->is_have_product,
                      'comment' => $data_info->comment,
                      'product_owner_id' => $data_info->product_owner_id,
                      'product_vendor_id' => $data_info->product_vendor_id,
                      'type_name' => $data_info->type_name,
                      'type_description' => $data_info->type_description,
                      'full_price' => $data_info->full_price,
                      'dealer_price' => $data_info->dealer_price,
                      'discount_sla_type_id' => $data_info->discount_sla_type_id,
                      'discount_sla_type_value' => $data_info->discount_sla_type_value,
                      'discount_of_contract_value' => $data_info->discount_of_contract_value,
                      'discount_of_qty_value' => $data_info->discount_of_qty_value,
                      'province_id' => $data_info->province_id,
                      'province_name' => $data_info->province_name,
                      'pm_time_value' => $data_info->pm_time_value,
                      'lb_year_value' => $data_info->lb_year_value,
                      'pm_time_qty' => $data_info->pm_time_qty,
                      'lb_year_qty' => $data_info->lb_year_qty,
                      'contract_qty' => $data_info->contract_qty,
                      'qty' => $data_info->qty,
                      'total' => $data_info->total,
                  );
      $this->db->insert('order_detail', $data_detail);
      //get list all order
      $order_list = $this->orders_model->get_orders_detail($data_info->order_id);
      //delete all
      $sql = "DELETE FROM order_detail WHERE order_id = '$data_info->order_id' ";
      $query = $this->db->query($sql);

      $line_number = 1;
      //loop save run linenumber
      foreach ($order_list as $row) {
          $data_detail = array(
                          'order_id' => $row['order_id'],
                          'line_number' => $line_number,
                          'is_product_owner' => $row['is_product_owner'],
                          'is_have_product' => $row['is_have_product'],
                          'comment' => $row['comment'],
                          'product_owner_id' => $row['product_owner_id'],
                          'product_vendor_id' => $row['product_vendor_id'],
                          'type_name' => $row['type_name'],
                          'type_description' => $row['type_description'],
                          'full_price' => $row['full_price'],
                          'dealer_price' => $row['dealer_price'],
                          'discount_sla_type_id' => $row['discount_sla_type_id'],
                          'discount_sla_type_value' => $row['discount_sla_type_value'],
                          'discount_of_contract_value' => $row['discount_of_contract_value'],
                          'discount_of_qty_value' => $row['discount_of_qty_value'],
                          'province_id' => $row['province_id'],
                          'province_name' => $row['province_name'],
                          'pm_time_value' => $row['pm_time_value'],
                          'lb_year_value' => $row['lb_year_value'],
                          'pm_time_qty' => $row['pm_time_qty'],
                          'lb_year_qty' => $row['lb_year_qty'],
                          'contract_qty' => $row['contract_qty'],
                          'qty' => $row['qty'],
                          'total' => $row['total'],
                                          );
          $this->db->insert('order_detail', $data_detail);
          $line_number++;
      }


      //update header
      $total_cal = 0;
      $total_qty = 0;
      foreach ($this->orders_model->get_orders_detail($data_info->order_id) as $row) {
          $total_cal  = $total_cal  + $row['total'];
          $total_qty  = $total_qty  + $row['qty'];
      }

      date_default_timezone_set("Asia/Bangkok");
      $data = array(
              'qty' => $total_qty ,
              'total' => $total_cal,
              'modified_date' => date("Y-m-d H:i:s"),
              'modified_by' => $user_id
          );
      $where_order = array('order_id' => $data_info->order_id);
      $this->db->update('orders', $data, $where_order);

      if ($this->db->trans_status() === false) {
          $this->db->trans_rollback();
          return false;
      } else {
          $this->db->trans_commit();
          return true;
      }
    }

    public function update_confirm_special_price($id)
    {
      $sql =" UPDATE orders SET order_status_id = 4 WHERE order_status_id < 4 AND order_id = $id ";
			$this->db->query($sql);

			$sql =" INSERT INTO order_status_history VALUES($id,4,'Approve special price',NOW()) ";
			$this->db->query($sql);
			return true;
    }
    public function update_send_invioce_doc($id)
    {
      $sql =" UPDATE orders SET order_status_id = 6 WHERE order_status_id < 6 AND order_id = $id ";
			$this->db->query($sql);

			$sql =" INSERT INTO order_status_history VALUES($id,6,'Send invoice document',NOW()) ";
			$this->db->query($sql);
			return true;
    }

    public function update_confirm_document($id)
    {
      $sql =" UPDATE orders SET order_status_id = 8 WHERE order_status_id < 8 AND order_id = $id ";
            $this->db->query($sql);

            $sql =" INSERT INTO order_status_history VALUES($id,7,'Approve document',NOW()) ";
            $this->db->query($sql);
            return true;
    }
}
