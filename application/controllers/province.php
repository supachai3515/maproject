<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Province extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('province_model');
    $this->isLoggedIn();
  }


  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='6';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

      $searchText = $this->input->post('searchText');
      $data['searchText'] = $searchText;

      $count = $this->province_model->get_province_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "province/index", $count, $this->config->item('pre_page') );
      $data['province_list'] = $this->province_model->get_province($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'province/province_view';
      //if script file
      //$data['script_file'] = 'js/province_js';
      $data['header'] = array('title' => 'Province | '.$this->config->item('sitename'),
                              'description' =>  'Province | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Province');
      $this->load->view('template/layout_main', $data);

    }
    else {
      // access denied
       $this->loadThis();
    }
  }
}
