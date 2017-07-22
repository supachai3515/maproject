<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Tos_cal extends BaseController {
	public function __construct(){
		parent::__construct();
		//call model inti
    $this->load->model('initdata_model');
    $this->load->model('tos_cal_model');
	}

	public function index()
	{
    $myObj = '{
              	"email": "supachai.wisa@gmail.com",
              	"name": "Tony Stark",
              	"tel": "123456789",
              	"product_list": [
              		{
										"is_have_product" : "1",
              			"brand_name": "Cissco",
              			"model": "SV3200",
              			"name": "1 MSA 1040 2Prt FC DC SFF Strg",
              			"part_number": "E7W00A",
              			"product_owner_id": "2",
              			"province": "10",
              			"contract": "2",
              			"pm": "2",
              			"qty": 1
              		},
              		{
										"is_have_product" : "0",
              			"brand_name": "Cissco",
              			"model": "WS-C2960C",
              			"name": "1 MSA 1040 2Prt 1G iSCSI DC SFF Strg",
              			"part_number": "E7W02A",
              			"product_owner_id": "4",
              			"province": "10",
              			"contract": "2",
              			"pm": "2",
              			"qty": 1
              		}
              	]
              }';


      try {

          //$data_info = json_decode($myObj);
          $data_info = json_decode(file_get_contents("php://input"));
					//if null
					if(!isset($data_info) ){
						redirect('','refresh');
					}

          $session_info = array('info_email'=>$data_info->email,
            'info_name'=>$data_info->name,
            'info_tel'=>$data_info->tel,
            'product_list'=>$data_info->product_list
          );
          $this->session->set_userdata($session_info);
          $product_list = $this->session->userdata('product_list');
          $data = $this->tos_cal_model->get_cal_product($product_list);

          echo json_encode($data);
          //echo "<pre>";
      		//print_r ($data);
      		//echo "</pre>";
        //throw new Exception('Division by zero.');
      } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
      }

	}

  public function get_info()
  {
      $name = $this->session->userdata('info_name');
      $tel = $this->session->userdata('info_tel');
      $email = $this->session->userdata('info_email');
      $info = array('name' => $name,'tel' => $tel,'email' => $email );
      echo json_encode($info);
  }


	public function get_cal_product()
	{
		if($this->session->userdata('product_list') != null ){
			$product_list = $this->session->userdata('product_list');
			$data = $this->tos_cal_model->get_cal_product($product_list);
			echo json_encode($data);
		}
	}

	public function save_order()
	{
		$myObj = '[
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
									"discount_of_qty_value": "30",
									"province_id": "10",
									"province_name": "สระบุรี",
									"pm_time_value": "0",
									"lb_year_value": "0",
									"pm_time_qty": "2",
									"lb_year_qty": "2",
									"qty": "2",
									"total": "79660.350000000000"
								},
								{
									"is_product_owner": "0",
									"is_have_product": "0",
									"comment": "Name: 1 MSA 1040 2Prt 1G iSCSI DC SFF Strg , Model: WS-C2960C",
									"product_owner_id": "0",
									"product_vendor_id": "0",
									"type_name": "",
									"type_description": "",
									"full_price": "0",
									"dealer_price": "0",
									"discount_sla_type_id": "0",
									"discount_sla_type_value": "0",
									"discount_of_contract_value": "0",
									"discount_of_qty_value": "0",
									"province_id": "10",
									"province_name": "สระบุรี",
									"pm_time_value": "",
									"lb_year_value": "",
									"pm_time_qty": "2",
									"lb_year_qty": "2",
									"qty": "2",
									"total": "0.000000000000"
								}
							]';

		if($this->session->userdata('info_name') != null  && $this->session->userdata('info_tel') != null && $this->session->userdata('info_email') != null )
		{
			$name = $this->session->userdata('info_name');
			$tel = $this->session->userdata('info_tel');
			$email = $this->session->userdata('info_email');
			$data_info = array('name' => $name,'tel' => $tel,'email' => $email );
			//$product_list = json_decode($myObj);
			$product_list = json_decode(file_get_contents("php://input"));

			$order_id = $this->tos_cal_model->save_order($data_info ,$product_list);
			if($order_id == "0"){
				$result = array('status' => 'error', 'data'=> '');
				echo json_encode($result);
			}else {
				$data['order_data'] = $this->tos_cal_model->get_order($order_id);
				$data['order_detail_data'] = $this->tos_cal_model->get_order_detail($order_id);
				$result = array('status' => 'success' ,'order_id'=> $data['order_data']);
				echo json_encode($result);
				//sendmail
	      $data['email'] = $email;// toemail
				$data['template'] = "email/send_order";
				$data['subject'] = "Tos Order";
				$data['bcc_mail'] = "winchesterbee@gmail.com";
				$data['name'] = $name;
				$data['tel'] = $tel;
				//$this->load->view('email/send_order', $data);


				//sendmail
				$sendStatus = send_emali_template($data);
				if($sendStatus){
						$status = "send";
						setFlashData($status, "ทางเราได้ส่งใบเสนอราคาไปที่ Email เรียบร้อยแล้ว กรุณาตรวจสอบ Email");
				} else {
						$status = "notsend";
						setFlashData($status, "Email has been failed, try again.");
				}

			}

		}
		else{
			$result = array('status' => 'error', 'data'=> '');
			echo json_encode($result);
		}

	}

	public function special_price($ref_id)
	{
		$order_id = $this->tos_cal_model->get_order_id_by_ref($ref_id);
		if(isset($order_id)){
				//set status special_price
				$data['ref_id'] = $ref_id;
				$data['order_data'] = $this->tos_cal_model->get_order($order_id);
				$data['order_detail_data'] = $this->tos_cal_model->get_order_detail($order_id);
				$status = "success";
				//setFlashData($status, "ทางเราได้รับคำขอจากท่านเรียบร้อยแล้ว กรุณารอทางเราติดต่อครับ");
		} else {
				$status = "error";
				//setFlashData($status, "ข้อผิดผลาด");
		}

		$this->load->view('order_public/special_price', $data);
	}

	public function get_order_status()
	{
		$ref_id = json_decode(file_get_contents("php://input"));
		$order_status = $this->tos_cal_model->get_order_status_id_by_ref($ref_id->id);
		echo json_encode((int)$order_status);

	}

	public function request_special_price()
	{
		$ref_id = json_decode(file_get_contents("php://input"));
		$order_status = $this->tos_cal_model->get_order_status_id_by_ref($ref_id->id);
		if(isset($order_status)){
			if($order_status < 2)
			{
				$result_update = $this->tos_cal_model->update_spacial_price_status($ref_id->id);
				$result = array('success' => true);
				echo json_encode($result);
			}
			else
			{
				$result = array('success' => false);
				echo json_encode($result);
			}

		} else {
		}
	}

	public function order_detail()
	{
		$data_info = json_decode(file_get_contents("php://input"));
		$order_id = $this->tos_cal_model->get_order_id_by_ref($data_info->id);
		if(isset($order_id)){
				//set status special_price
				$data['order_data'] = $this->tos_cal_model->get_order($order_id);
				$data['order_detail_data'] = $this->tos_cal_model->get_order_detail($order_id);
				$result = array( 'order' => $data['order_data'],
				 								 'order_detail' => $data['order_detail_data'] );
				echo json_encode($result);
		} else {
		}
	}
}
