<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Orders_sale extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('initdata_model');
        $this->load->model('orders_model');
        $this->load->model('orders_sale_model');
        $this->load->model('home_model');
        $this->load->model('tos_cal_model');
        $this->load->library('my_upload');
        $this->load->model('quotation_model');
        $this->isLoggedIn();
    }

    public function index($page=0)
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='16';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_view']) {
            if ($page != 0) {
                if (!ctype_digit($page)) {
                    redirect('error');
                }
            }

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $count = $this->orders_sale_model->get_orders_count($searchText, $this->vendorId);
            $data['links_pagination'] = $this->pagination_compress("orders/index", $count, $this->config->item('pre_page'));
            $data['orders_list'] = $this->orders_sale_model->get_orders($searchText, $page, $this->config->item('pre_page'), $this->vendorId);

            $data['content'] = 'orders_sale/orders_sale_view';
            //if script file
            $data['script_file'] = 'js/orders_sale_js';
            $data['header'] = array('title' => 'Orders | '.$this->config->item('sitename'),
                                              'description' =>  'Orders | '.$this->config->item('tagline'),
                                              'author' => $this->config->item('author'),
                                              'keyword' => 'Orders');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }

    public function view($id=null)
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='16';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_view']) {
            if ($id == null) {
                redirect('orders_sale');
            } else {
                if (!ctype_digit($id)) {
                    redirect('error');
                }
            }

            $data['orders_data'] = $this->orders_model->get_orders_id($id);
            $data['orders_detail_data'] = $this->orders_model->get_orders_detail($id);

            if (count($data['orders_data'])==0) {
                redirect('error');
            }

            $data['content'] = 'orders/orders_info_view';
            //if script file
            //$data['script_file'] = 'js/orders_sale_js';
            $data['header'] = array('title' => 'View Orders | '.$this->config->item('sitename'),
                              'description' =>  'View Orders | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Orders');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }

    public function edit($id=null)
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='16';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_edit']) {
            if ($id == null) {
                redirect('orders_sale');
            } else {
                if (!ctype_digit($id)) {
                    redirect('error');
                }
            }


            $data['orders_data'] = $this->orders_model->get_orders_id($id);
            $data['orders_detail_data'] = $this->orders_model->get_orders_detail($id);
            $data['province_list'] = $this->home_model->get_province();
            $data['contract_list'] = $this->home_model->get_contract();

            $data['max_qo'] = $this->quotation_model->get_max_quotation($id);

            $data['status_list'] = $this->home_model->get_status();
            if (count($data['orders_data'])==0) {
                redirect('error');
            }

            $data['content'] = 'orders_sale/orders_sale_edit_view';
            //if script file
            $data['script_file'] = 'js/orders_sale_js';
            $data['header'] = array('title' => 'Edit Orders | '.$this->config->item('sitename'),
                                              'description' =>  'Edit Orders | '.$this->config->item('tagline'),
                                              'author' => $this->config->item('author'),
                                              'keyword' => 'Edit Orders');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }

    public function get_master_order_data()
    {
      $data['discount_contract'] = $this->orders_model->get_discount_contract();
      $data['discount_qty'] = $this->orders_model->get_discount_qty();
      $data['discount_tos'] = $this->orders_model->get_tos_discount();
      $data['discount_province'] = $this->home_model->get_province();
      echo json_encode($data);
    }

    public function edit_save()
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='16';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('company', 'Company', 'trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('tel', 'Tel', 'trim|required|xss_clean|max_length[11]');
            $this->form_validation->set_rules('comment_order', 'Comment', 'trim|xss_clean|max_length[1024]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('is_active', 'ใช้งาน', '');

            if ($this->form_validation->run() == false) {
                $this->edit($this->input->post('order_id'));
            } else {


              $this->load->library('my_upload');
              $dir ='./uploads/doc/'.date("Ym").'/';
              $dir_insert ='uploads/doc/'.date("Ym").'/';
              $file_name ='';

              $this->my_upload->upload($_FILES["file_path"]);
              if ($this->my_upload->uploaded == true) {
                  //$this->my_upload->allowed  = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                  $this->my_upload->process($dir);

                  if ($this->my_upload->processed == true) {
                      $file_name  = $this->my_upload->file_dst_name;
                      //update img
                      $this->my_upload->clean();
                  } else {
                      $data['errors'] = $this->my_upload->error;
                      echo $data['errors'];
                  }
              } else {
                  $data['errors'] = $this->my_upload->error;
              }


                $file_path = $dir_insert.$file_name;
                $company = $this->input->post('company');
                $tel = $this->input->post('tel');
                $email = $this->input->post('email');
                $comment_order = $this->input->post('comment_order');
                $is_active = $this->input->post('is_active');
                $order_id = $this->input->post('order_id');
                $order_status_id = $this->input->post('order_status_id');

                $orders_sale_info = array('company'=>$company, 'tel'=>$tel,'email'=>$email,
                                        'is_active'=>$is_active,'comment_order'=>  $comment_order,
                                        'order_status_id' => $order_status_id,
                                        'order_id'=>$order_id,
                                        'file_path'=>$file_path,
                                        'modified_by'=>$this->vendorId,
                                        'modified_date'=>date('Y-m-d H:i:s'));

                $result = $this->orders_sale_model->update_orders($orders_sale_info, $order_id);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Edit Order Update successfully');
                } else {
                    $this->session->set_flashdata('error', 'Order update failed');
                }
                redirect('orders_sale/edit/'.$order_id);
            }
        } else {
            $this->loadThis();
        }
    }

    public function get_order()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $value = json_decode(file_get_contents("php://input"));
            if ($value) {
                $data['order'] = $this->orders_model->get_orders_id($value->order_id);
                json_output(200, $data['order']);
            }
        }
    }

    public function get_order_detail()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $value = json_decode(file_get_contents("php://input"));
            if ($value) {
                $data['orders_detail'] = $this->orders_model->get_orders_detail($value->order_id);
                json_output(200, $data['orders_detail']);
            }
        }
    }

    public function edit_save_detail()
    {
        $json_str ='{
                	"part_number": "E7V99A",
                	"product_name": "1 MSA 1040 2Prt FC DC LFF Strg",
                	"product_description": "1 MSA 1040 2Prt FC DC LFF Strg",
                	"order_id": "12",
                	"line_number": "1",
                	"product_owner_id": "1",
                	"province_id": "1",
                	"is_have_product": "1",
                	"comment": "",
                	"is_product_owner": "0",
                	"product_vendor_id": "1",
                	"type_name": "GOLD",
                	"type_description": "Gold typee",
                	"full_price": "50000",
                	"dealer_price": "0",
                	"discount_sla_type_id": "1",
                	"discount_sla_type_value": "75",
                	"discount_of_contract_value": "0",
                	"discount_of_qty_value": "30",
                	"province_name": "กรุงเทพมหานคร",
                	"pm_time_value": "1000",
                	"lb_year_value": "2000",
                	"pm_time_qty": "2",
                	"lb_year_qty": "2",
                	"contract_qty": null,
                	"qty": "2",
                	"total": "65650.0000"
                }';

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $data_info = json_decode(file_get_contents("php://input"));
            //$data_info = json_decode($json_str);
            if ($data_info) {
                $result = $this->orders_sale_model->save_detail($data_info, $this->vendorId);
                if ($result) {
                    json_output(200, array('status' => 200,'message' => $result));
                } else {
                    json_output(400, array('status' => 400,'message' => 'error'));
                }
            }
        }
    }

    public function del_save_detail()
    {
        $json_str ='{
                "part_number": "E7V99A",
                "product_name": "1 MSA 1040 2Prt FC DC LFF Strg",
                "product_description": "1 MSA 1040 2Prt FC DC LFF Strg",
                "order_id": "7",
                "line_number": "1",
                "product_owner_id": "2",
                "province_id": "1",
                "is_have_product": "1",
                "comment": "",
                "is_product_owner": "0",
                "product_vendor_id": "1",
                "type_name": "GOLD",
                "type_description": "Gold typee",
                "full_price": "50000",
                "dealer_price": "0",
                "discount_sla_type_id": "1",
                "discount_sla_type_value": "75",
                "discount_of_contract_value": "0",
                "discount_of_qty_value": "30",
                "province_name": "กรุงเทพมหานคร",
                "pm_time_value": "1000",
                "lb_year_value": "2000",
                "pm_time_qty": "2",
                "lb_year_qty": "2",
                "contract_qty": null,
                "qty": "2",
                "total": "65650.0000"
              }';

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $data_info = json_decode(file_get_contents("php://input"));
            //$data_info = json_decode($json_str);
            if ($data_info) {
                $result = $this->orders_sale_model->del_detail($data_info, $this->vendorId);
                if ($result) {
                    json_output(200, array('status' => 200,'message' => $result));
                } else {
                    json_output(400, array('status' => 400,'message' => 'error'));
                }
            }
        }
    }

    public function get_search_product_cal()
    {
        $json_str ='{
                      "order_id": "12",
                      "is_have_product": "1",
                      "brand_name": "Cissco",
                      "model": "SV3200",
                      "name": "1 MSA 1040 2Prt FC DC SFF Strg",
                      "part_number": "E7W00A",
                      "product_owner_id": "2",
                      "province": "10",
                      "contract": "2",
                      "pm": "2",
                      "qty": 1
                    }';

        $json_return ='[
                        	{
                        		"is_product_owner": "1",
                        		"is_have_product": "1",
                        		"comment": "",
                        		"product_owner_id": "2",
                        		"product_vendor_id": "0",
                        		"type_name": "GOLD",
                        		"type_description": "Gold typee",
                        		"full_price": "229900",
                        		"dealer_price": "0",
                        		"discount_sla_type_id": "1",
                        		"discount_sla_type_value": "75",
                        		"discount_of_contract_value": "1",
                        		"discount_of_qty_value": "0",
                        		"province_id": "10",
                        		"province_name": "สระบุรี",
                        		"pm_time_value": "0",
                        		"lb_year_value": "0",
                        		"pm_time_qty": "2",
                        		"lb_year_qty": "2",
                        		"contract_qty": "2",
                        		"qty": "1",
                        		"total": "113800.500000000000"
                        	},
                        	{
                        		"is_product_owner": "1",
                        		"is_have_product": "1",
                        		"comment": "",
                        		"product_owner_id": "2",
                        		"product_vendor_id": "0",
                        		"type_name": "SILVER",
                        		"type_description": "Silver type",
                        		"full_price": "229900",
                        		"dealer_price": "0",
                        		"discount_sla_type_id": "2",
                        		"discount_sla_type_value": "85",
                        		"discount_of_contract_value": "1",
                        		"discount_of_qty_value": "0",
                        		"province_id": "10",
                        		"province_name": "สระบุรี",
                        		"pm_time_value": "0",
                        		"lb_year_value": "0",
                        		"pm_time_qty": "2",
                        		"lb_year_qty": "2",
                        		"contract_qty": "2",
                        		"qty": "1",
                        		"total": "68280.300000000000"
                        	},
                        	{
                        		"is_product_owner": "1",
                        		"is_have_product": "1",
                        		"comment": "",
                        		"product_owner_id": "2",
                        		"product_vendor_id": "0",
                        		"type_name": "BRONZ",
                        		"type_description": "Bronze type",
                        		"full_price": "229900",
                        		"dealer_price": "0",
                        		"discount_sla_type_id": "3",
                        		"discount_sla_type_value": "90",
                        		"discount_of_contract_value": "1",
                        		"discount_of_qty_value": "0",
                        		"province_id": "10",
                        		"province_name": "สระบุรี",
                        		"pm_time_value": "0",
                        		"lb_year_value": "0",
                        		"pm_time_qty": "2",
                        		"lb_year_qty": "2",
                        		"contract_qty": "2",
                        		"qty": "1",
                        		"total": "45520.200000000000"
                        	},
                        	{
                        		"is_product_owner": "0",
                        		"is_have_product": "1",
                        		"comment": "",
                        		"product_owner_id": "2",
                        		"product_vendor_id": "1",
                        		"type_name": "GP",
                        		"type_description": "1 5 Year Proactive Care Next Business Day StoreVirtual 3200 Service",
                        		"full_price": "0",
                        		"dealer_price": "60970",
                        		"discount_sla_type_id": "4",
                        		"discount_sla_type_value": "5",
                        		"discount_of_contract_value": "0",
                        		"discount_of_qty_value": "0",
                        		"province_id": "10",
                        		"province_name": "สระบุรี",
                        		"pm_time_value": "0",
                        		"lb_year_value": "0",
                        		"pm_time_qty": "2",
                        		"lb_year_qty": "2",
                        		"contract_qty": "2",
                        		"qty": "1",
                        		"total": "128037.000000000000"
                        	},
                        	{
                        		"is_product_owner": "0",
                        		"is_have_product": "1",
                        		"comment": "",
                        		"product_owner_id": "2",
                        		"product_vendor_id": "2",
                        		"type_name": "GP",
                        		"type_description": "1 5 Year Proactive Care 24x7 StoreVirtual 3200 Service",
                        		"full_price": "0",
                        		"dealer_price": "107840",
                        		"discount_sla_type_id": "4",
                        		"discount_sla_type_value": "5",
                        		"discount_of_contract_value": "0",
                        		"discount_of_qty_value": "0",
                        		"province_id": "10",
                        		"province_name": "สระบุรี",
                        		"pm_time_value": "0",
                        		"lb_year_value": "0",
                        		"pm_time_qty": "2",
                        		"lb_year_qty": "2",
                        		"contract_qty": "2",
                        		"qty": "1",
                        		"total": "226464.000000000000"
                        	}
                        ]';

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $data_info = json_decode(file_get_contents("php://input"));
            //$data_info = json_decode($json_str);
            //$data_return = json_decode($json_return);
            if ($data_info) {
                $result = $this->orders_sale_model->get_search_product_cal($data_info);
                if ($result) {
                    json_output(200, $result);
                } else {
                    json_output(400, array('status' => 400,'message' => 'error'));
                }
            }
        }
    }

    //ไม่ได้ใช้
    public function get_product_cal()
    {
      $json_str ='{
                "part_number": "E7V99A",
                "product_name": "1 MSA 1040 2Prt FC DC LFF Strg",
                "product_description": "1 MSA 1040 2Prt FC DC LFF Strg",
                "order_id": "12",
                "line_number": "1",
                "product_owner_id": "1",
                "province_id": "1",
                "is_have_product": "1",
                "comment": "",
                "is_product_owner": "0",
                "product_vendor_id": "1",
                "type_name": "GOLD",
                "type_description": "Gold typee",
                "full_price": "50000",
                "dealer_price": "0",
                "discount_sla_type_id": "1",
                "discount_sla_type_value": "75",
                "discount_of_contract_value": "0",
                "discount_of_qty_value": "30",
                "province_name": "กรุงเทพมหานคร",
                "pm_time_value": "1000",
                "lb_year_value": "2000",
                "pm_time_qty": "2",
                "lb_year_qty": "2",
                "contract_qty": null,
                "qty": "2",
                "total": "65650.0000"
              }';

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            //$data_info = json_decode(file_get_contents("php://input"));
            $data_info = json_decode($json_str);
            //$data_return = json_decode($json_return);
            if ($data_info) {
                $result = $this->orders_sale_model->get_product_cal($data_info, $this->vendorId);
                if ($result) {
                    json_output(200, $result);
                } else {
                    json_output(400, array('status' => 400,'message' => 'error'));
                }
            }
        }
    }

    public function new_save_detail()
    {
        $json_str ='{
                "part_number": "E7V99A",
                "product_name": "1 MSA 1040 2Prt FC DC LFF Strg",
                "product_description": "1 MSA 1040 2Prt FC DC LFF Strg",
                "order_id": "12",
                "line_number": "1",
                "product_owner_id": "1",
                "province_id": "1",
                "is_have_product": "1",
                "comment": "",
                "is_product_owner": "0",
                "product_vendor_id": "1",
                "type_name": "GOLD",
                "type_description": "Gold typee",
                "full_price": "50000",
                "dealer_price": "0",
                "discount_sla_type_id": "1",
                "discount_sla_type_value": "75",
                "discount_of_contract_value": "0",
                "discount_of_qty_value": "30",
                "province_name": "กรุงเทพมหานคร",
                "pm_time_value": "1000",
                "lb_year_value": "2000",
                "pm_time_qty": "2",
                "lb_year_qty": "2",
                "contract_qty": null,
                "qty": "2",
                "total": "65650.0000"
              }';

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {
            json_output(400, array('status' => 400,'message' => 'Bad request.'));
        } else {
            $data_info = json_decode(file_get_contents("php://input"));
            //$data_info = json_decode($json_str);
            if ($data_info) {
                $result = $this->orders_sale_model->new_save_detail($data_info, $this->vendorId);
                if ($result) {
                    json_output(200, array('status' => 200,'message' => $result));
                } else {
                    json_output(400, array('status' => 400,'message' => 'error'));
                }
            }
        }
    }

    public function send_special_price($order_id)
    {
      $data['global'] = $this->global;
      $data['menu_id'] ='16';
      $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
      $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
      if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $id = json_decode(file_get_contents("php://input"));
            $order_id = $id->id;
            $result = $this->orders_sale_model->update_confirm_special_price($order_id);

          if ($result > 0) {

            $resultInfo = $this->orders_model->get_orders_id($order_id);
            $data['order_data'] = $resultInfo;
            $data['order_detail_data'] = $this->orders_model->get_orders_detail($order_id);
            $sale_id = $resultInfo["assign_to"];

            $sale_detail = $this->orders_model->get_user_info($sale_id);

            $sale_email = $sale_detail['email'];
            $sale_name = $sale_detail['name'];
            $sale_mobile = $sale_detail['mobile'];

            $sale_info = array('name' => $sale_name,
                            'tel' => $sale_mobile,
                            'email' => $sale_email);

            //get sale email
            $data['sale_detail'] = $sale_info;

            //sendmail
            $data['email'] = $resultInfo["email"].",".$sale_email;// toemail
            $data['template'] = "email/approve_special_price";
            $data['subject'] = "Approve special price #".$order_id;
            $data['bcc_mail'] = $this->config->item('email_cc_group');
            $data['name'] = $resultInfo["company"];
      		$data['tel'] = $resultInfo["tel"];

			//sendmail
			$sendStatus = send_emali_template_gmail($data);
			if($sendStatus){
					json_output(200, array('status' => 200,'message' => 'success'));
			} else {
					json_output(400, array('status' => 400,'message' => 'error'));
			}
          } else {
              json_output(400, array('status' => 400,'message' => 'error'));
          }
          redirect('orders_sale/edit/'.$order_id);

      } else {
          $this->loadThis();
      }
    }

    public function send_quotation_doc($order_id)
    {
      $data['global'] = $this->global;
      $data['menu_id'] ='16';
      $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
      $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
      if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $id = json_decode(file_get_contents("php://input"));
            $order_id = $id->id;
            $result = $this->orders_sale_model->update_send_invioce_doc($order_id);

          if ($result > 0) {

            $resultInfo = $this->orders_model->get_orders_id($order_id);
            $data['order_data'] = $resultInfo;
            $data['order_detail_data'] = $this->orders_model->get_orders_detail($order_id);
            $sale_id = $resultInfo["assign_to"];

            $sale_detail = $this->orders_model->get_user_info($sale_id);

            $sale_email = $sale_detail['email'];
            $sale_name = $sale_detail['name'];
            $sale_mobile = $sale_detail['mobile'];

            $sale_info = array('name' => $sale_name,
                            'tel' => $sale_mobile,
                            'email' => $sale_email);

            //get sale email
            $data['sale_detail'] = $sale_info;

            //sendmail
            $data['email'] = $resultInfo["email"].",".$sale_email;// toemail
			$data['template'] = "email/order_invoice";
			$data['subject'] = "Send Quotation #".$order_id;
			$data['bcc_mail'] = $this->config->item('email_cc_group');
            $data['name'] = $resultInfo["company"];
			   $data['tel'] = $resultInfo["tel"];

			//sendmail
			$sendStatus = send_emali_template_gmail($data);
			if($sendStatus){
					json_output(200, array('status' => 200,'message' => 'success'));
			} else {
					json_output(400, array('status' => 400,'message' => 'error'));
			}
          } else {
              json_output(400, array('status' => 400,'message' => 'error'));
          }
          redirect('orders_sale/edit/'.$order_id);

      } else {
          $this->loadThis();
      }
    }

    public function approve_document($order_id)
    {
      $data['global'] = $this->global;
      $data['menu_id'] ='16';
      $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
      $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
      if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $id = json_decode(file_get_contents("php://input"));
            $order_id = $id->id;
            $result = $this->orders_sale_model->update_confirm_document($order_id);

          if ($result > 0) {

            $resultInfo = $this->orders_model->get_orders_id($order_id);
            $data['order_data'] = $resultInfo;
            $data['order_detail_data'] = $this->orders_model->get_orders_detail($order_id);
            $sale_id = $resultInfo["assign_to"];

            $sale_detail = $this->orders_model->get_user_info($sale_id);

            $sale_email = $sale_detail['email'];
            $sale_name = $sale_detail['name'];
            $sale_mobile = $sale_detail['mobile'];

            $sale_info = array('name' => $sale_name,
                            'tel' => $sale_mobile,
                            'email' => $sale_email);

            //get sale email
            $data['sale_detail'] = $sale_info;

            //sendmail
            $data['email'] = $resultInfo["email"].",".$sale_email;// toemail
            $data['template'] = "email/approve_document";
            $data['subject'] = "Approve document #".$order_id;
            $data['bcc_mail'] = $this->config->item('email_cc_group');
            $data['name'] = $resultInfo["company"];
            $data['tel'] = $resultInfo["tel"];

                    //sendmail
                    $sendStatus = send_emali_template_gmail($data);
                    if($sendStatus){
                            json_output(200, array('status' => 200,'message' => 'success'));
                    } else {
                            json_output(400, array('status' => 400,'message' => 'error'));
                    }
          } else {
              json_output(400, array('status' => 400,'message' => 'error'));
          }
          redirect('orders_sale/edit/'.$order_id);

      } else {
          $this->loadThis();
      }
    }
}
