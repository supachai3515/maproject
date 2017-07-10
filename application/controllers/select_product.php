<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Select_product extends BaseController {
	public function __construct(){
		parent::__construct();
		//call model inti
    $this->load->model('initdata_model');
	}

	public function index()
	{
      //if script file
      $data['script_file'] = 'js/select_product_js';
  		$data['header'] = array('title' => 'Product | '.$this->config->item('sitename'),
              								'description' =>  'Product | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' =>  'Product');

  		$this->load->view('home/select_product_view', $data);
	}

}
