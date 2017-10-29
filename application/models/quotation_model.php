
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
				$this->load->model('orders_model');
				$this->load->model('user_model');
    }

    public function get_quotation_count($searchText = '')
    {
        // $this->db->escape() ใส่ '' ให้
        // $this->db->escape_str()  ไม่ใส่ '' ให้
        // $this->db->escape_like_str($searchText) like
        $searchText = $this->db->escape_like_str($searchText);
        $sql =" SELECT COUNT(m.quotation_id) as connt_id FROM  quotation m WHERE 1=1 ";
        if (!empty($searchText)) {
          $sql = $sql." AND (m.quotation_id  LIKE '%".$searchText."%'
                        OR  m.order_id  LIKE '%".$searchText."%'
                        OR  IFNULL(m.ct_company,'')  LIKE '%".$searchText."%'
                        OR  IFNULL(m.ct_address,'')  LIKE '%".$searchText."%'
                        OR  IFNULL(m.ct_tel,'')  LIKE '%".$searchText."%'
                        OR  IFNULL(m.ct_email,'')  LIKE '%".$searchText."%'
                        OR  IFNULL(m.quotation_doc_no,'')  LIKE '%".$searchText."%'
                        OR  m.quotation_id  LIKE '%".$searchText."%')";
        }
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return  $row['connt_id'];
    }

    public function get_quotation($searchText = '', $page, $segment)
    {
        $searchText = $this->db->escape_like_str($searchText);
        $page = $this->db->escape_str($page);
        $segment = $this->db->escape_str($segment);

        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  quotation m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by WHERE 1=1 ";
        if (!empty($searchText)) {
            $sql = $sql." AND (m.quotation_id  LIKE '%".$searchText."%'
													OR  m.order_id  LIKE '%".$searchText."%'
                          OR  IFNULL(m.ct_company,'')  LIKE '%".$searchText."%'
                          OR  IFNULL(m.ct_address,'')  LIKE '%".$searchText."%'
                          OR  IFNULL(m.ct_tel,'')  LIKE '%".$searchText."%'
                          OR  IFNULL(m.ct_email,'')  LIKE '%".$searchText."%'
                          OR  IFNULL(m.quotation_doc_no,'')  LIKE '%".$searchText."%'
													OR  m.quotation_id  LIKE '%".$searchText."%')";
        }
        $sql = $sql." ORDER BY m.create_date DESC";
        $sql = $sql." LIMIT ".$page.",".$segment." ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_quotation_all()
    {
        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  quotation m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by WHERE 1=1 ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_quotation_id($id)
    {
        $id = $this->db->escape($id);

        $sql ="SELECT m.* , u1.name create_by_name , u2.name  modified_by_name FROM  quotation m
						LEFT JOIN tbl_users u1 ON u1.userId = m.create_by
						LEFT JOIN tbl_users u2 ON u2.userId = m.modified_by
						WHERE m.quotation_id = ".$id;
        $query = $this->db->query($sql);
        $row = $query->row_array();
        return $row;
    }


    public function add_gen($order_id,$vendorId)
    {
			$this->db->trans_start();
			$data['orders_data'] = $this->orders_model->get_orders_id($order_id);
			$data['orders_detail_data'] = $this->orders_model->get_orders_detail($order_id);
			if (isset($data['orders_data'])) {
					$checkDate = 'QO'.date("Y");

					 $sql ="SELECT COUNT(*)+1 connt_id
									FROM quotation
									WHERE  LEFT(quotation_doc_no, 6) = LEFT('$checkDate', 6) ";
					 $query = $this->db->query($sql);
					 $row = $query->row_array();
					 $order_qo_count =  $row['connt_id'];
					 $userInfo =  $this->user_model->getUser_Info($vendorId);

					 $gen_qo= 'QO'.date("Y").str_pad($order_qo_count, 6, "0", STR_PAD_LEFT);
					 $quotation_info = array(
														"order_id" => $order_id,
														"quotation_doc_no" => $gen_qo,
														"is_active" => "1",
														"create_date" => date("Y-m-d H:i:s"),
														"create_by" => $vendorId,
														"modified_date" =>  date("Y-m-d H:i:s"),
														"modified_by" =>$vendorId,
														"ct_company" => $data['orders_data']['company'],
														"ct_address" => $data['orders_data']['address'],
														"ct_tel" => $data['orders_data']['tel'],
														"ct_email" => $data['orders_data']['email'],
														"ow_company_name_th" => "บริษัท เทิร์นออน โซลูชั่น จำกัด",
														"ow_company_name_en" => "TURN ON SOLUTION CO., LTD. ",
														"ow_address" => "Level 29, The Offices at Centralworld 999/9 Rama I Road, Pathumwan Bangkok 10330 Thailand",
														"ow_logo" => base_url()."upload/quotation/qo_logo.png",
														"ow_contact_desc" => "Telephone 02-576-0385-6, Fax 02-576-0387",
														"ow_tax" => "0105558094400",
														"ow_desc" => "Website : www.turnonsolution.co.th , info@turnonsolution.co.th",
														"ct_fax" => "02-576-0387",
														"quotation_page" => "1/1",
														"quotation_subject" => "QUOTATION / ใบเสนอราคา",
														"sub_total" => "0",
														"total" => "0",
														"discount" => "0",
														"vat" => "0",
														"total_text" => "",
														"price_validity" => "",
														"payment_term" => "",
														"delivery_date" =>"",
														"terms_type" => "",
														"sale_manager_name" => $userInfo['name'],
														"sale_manager_signature" => "upload/quotation/sale_manager_signature.png",
														"sale_name" => $userInfo['name'],
														"sale_position" => "",
														"sale_email" => $userInfo['email'],
														"sale_tel"  => $userInfo['mobile']
													);
											$this->db->insert('quotation', $quotation_info);
							        $insert_id = $this->db->insert_id();
											$i = 1 ;
											$sub_total = 0;
											$discount = 0;
											$vat = 0;
											$total = 0;
											$total_text = "0";


										 foreach ($data['orders_detail_data'] as $row) {

											$price = $row['full_price'];
											if($price == 0){
												$price = $row['dealer_price'];
											}

												$qo_detail_info = array(
																	"quotation_id"=> $insert_id,
																	"line_number"=> $i,
																	"part_number"=> $row['part_number'],
																	"name"=> $row['type_name'],
																	"description"=> $row['type_description'],
																	"price" => $price,
																	"qty"=> $row['qty'],
																	"total"=> $row['total']-($row['pm_time_qty'] * $row['pm_time_value'])-($row['lb_year_qty'] * $row['lb_year_value']),
																	"line_no"=> $row['line_number'],
																	"cost_total"=> $row['total']-($row['pm_time_qty'] * $row['pm_time_value'])-($row['lb_year_qty'] * $row['lb_year_value']),
																	"is_delete"=> 0
																);
												 $this->db->insert('quotation_detail', $qo_detail_info);

												 $sub_total  = $sub_total + $row['total']-($row['pm_time_qty'] * $row['pm_time_value'])-($row['lb_year_qty'] * $row['lb_year_value']);

												 $i++;
												 //PM
												 $qo_detail_info = array(
 																	"quotation_id"=> $insert_id,
 																	"line_number"=> $i,
 																	"part_number"=> $row['part_number'],
 																	"name"=> "TOS-PM-1T",
 																	"description"=> "Preventive Maintenance 1 Time/Year ",
 																	"price" => $row['pm_time_value'],
 																	"qty"=> $row['pm_time_qty'],
 																	"total"=> $row['pm_time_qty'] * $row['pm_time_value'],
 																	"line_no"=>$row['line_number'],
 																	"cost_total"=> $row['pm_time_qty'] * $row['pm_time_value'],
 																	"is_delete"=> 0
 																);
 												 $this->db->insert('quotation_detail', $qo_detail_info);

												 $sub_total  = $sub_total +  $row['pm_time_qty'] * $row['pm_time_value'];
 												 $i++;
												 //LB
												 $qo_detail_info = array(
																	 "quotation_id"=> $insert_id,
																	 "line_number"=> $i,
																	 "part_number"=> $row['part_number'],
																	 "name"=> "TOS-LB-1T",
																	 "description"=> "Preventive Maintenance 1 Time/Year ",
																	 "price" => $row['lb_year_value'],
																	 "qty"=> $row['lb_year_qty'],
																	 "total"=> $row['lb_year_qty'] * $row['lb_year_value'],
																	 "line_no"=>$row['line_number'],
																	 "cost_total"=> $row['lb_year_qty'] * $row['lb_year_value'],
																	 "is_delete"=> 0
																 );
 												 $this->db->insert('quotation_detail', $qo_detail_info);
												 $sub_total  = $sub_total +  $row['lb_year_qty'] * $row['lb_year_value'];
												 $i++;

										 }

										 $vat = $sub_total  * 0.07;
										 $total = $vat + $sub_total ;


										 $quotation_update = array(
																		 'total' => $total,
																		 'sub_total' => $sub_total,
																		 'vat' =>$vat,
																		 'discount' => $discount,
																		 'total_text' => $total_text
														 );

										 $where = array('quotation_id' => $insert_id);
										 $this->db->update("quotation", $quotation_update, $where);

 								$this->db->trans_complete();
								return $insert_id;
			}
			return null;
    }

		public function get_quotation_by_id($quotation_id)
    {
			$sql = "SELECT * FROM quotation WHERE  quotation_id = $quotation_id ";
			$query = $this->db->query($sql);
			$result = $query->result_array();
        return $result;
    }


    public function get_quotation_datail_id($quotation_id)
    {
			$sql ="SELECT * FROM quotation_detail WHERE  quotation_id = $quotation_id ";
			$query = $this->db->query($sql);
			$result = $query->result_array();
				return $result;
    }

    public function update_quotation($quotation_info, $id)
    {
        $this->db->where('quotation_id', $id);
        $this->db->update('quotation', $quotation_info);
        return true;
    }
}

/* End of file quotation_model.php */
/* Location: ./application/models/quotation_model.php */
