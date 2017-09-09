<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController {
	public function __construct(){
		parent::__construct();
		//call model inti
    $this->load->model('initdata_model');
    $this->load->model('home_model');
	}

	public function index()
	{
      //if script file
      $data['script_file'] = 'js/home_js';
  		$data['header'] = array('title' => 'Home | '.$this->config->item('sitename'),
              								'description' =>  'Home | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' =>  'Home');
      $data['province_list'] = $this->home_model->get_province();
      $data['contract_list'] = $this->home_model->get_contract();

			$userId= $this->session->userdata ( 'userId' );
			if (isset($userId)) {
				$data['sale_user'] = $this->initdata_model->get_sele_user($userId);
			}

  		$this->load->view('home/home_view', $data);
	}
	public function get_products()
	{
			$search_val = json_decode(file_get_contents("php://input"));
			$data = $this->home_model->get_products_serach($search_val->search,0,10);
			$products = json_encode($data);
			print $products;
	}

}
