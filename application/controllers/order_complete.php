<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Order_complete extends BaseController {
	public function __construct(){
		parent::__construct();
		//call model inti
    $this->load->model('initdata_model');
    $this->load->model('order_complete_model');
	}

	public function index()
	{
      //if script file
      $data['script_file'] = 'js/order_complete_js';
  		$data['header'] = array('title' => 'Order | '.$this->config->item('sitename'),
              								'description' =>  'Order | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' =>  'Order');

			$userId = $this->session->userdata ( 'userId' );
			if (isset($userId)) {
				$data['sale_user'] = $this->initdata_model->get_sele_user($userId);
			}

  		$this->load->view('home/order_complete_view', $data);
	}

}
