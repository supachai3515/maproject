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
      //$data['script_file'] = 'js/home_js';
  		$data['header'] = array('title' => 'Home | '.$this->config->item('sitename'),
              								'description' =>  'Home | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' =>  'Home');
      $data['province_list'] = $this->home_model->get_province();
      $data['tos_list'] = $this->home_model->get_tos();
      $data['contract_list'] = $this->home_model->get_contract();

  		$this->load->view('home/home_view', $data);
	}
  function search_product()
  {
    
  }
}
