<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Confirm_order extends BaseController {
	public function __construct(){
		parent::__construct();
		//call model inti
    $this->load->model('initdata_model');
		session_start();
	}

	public function index()
	{
      //if script file
      $data['script_file'] = 'js/confirm_order_js';
  		$data['header'] = array('title' => 'Product | '.$this->config->item('sitename'),
              								'description' =>  'Product | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' =>  'Product');

			$userId = $this->session->userdata ( 'userId' );
			if (isset($userId)) {
				$data['sale_user'] = $this->initdata_model->get_sele_user($userId);
			}

  		$this->load->view('home/confirm_order_view', $data);
	}

public function set_confirm_order_session () {
  $data_info = json_decode(file_get_contents("php://input"));
  $session_info = array('info_selct_prodct'=> $data_info );
   $this->session->set_userdata($session_info);
   echo json_encode($this->session->userdata('info_selct_prodct'));
 }

 public function get_confirm_order_session () {
  $data = $this->session->userdata('info_selct_prodct');
  echo json_encode($data);
 }

}
