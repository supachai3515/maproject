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
              	"email": "abc@gmail.com",
              	"name": "Tony Stark",
              	"tel": "123456789",
              	"product_list": [
              		{
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
              			"brand_name": "Cissco",
              			"model": "MSA2042",
              			"name": "1 MSA 1040 2Prt 1G iSCSI DC LFF Strg",
              			"part_number": "E7W01A",
              			"product_owner_id": "3",
              			"province": "10",
              			"contract": "2",
              			"pm": "2",
              			"qty": 1
              		},
              		{
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

          $data_info = json_decode($myObj);
          //$data_info = json_decode(file_get_contents("php://input"));
          
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
      } catch (Exception $e) {

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

}
