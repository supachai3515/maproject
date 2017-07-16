<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Orders extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('orders_model');
    $this->isLoggedIn();
  }

  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='15';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {
      if($page != 0)
      {
        if (!ctype_digit($page)) {
          redirect('error');
        }
      }

      $searchText = $this->input->post('searchText');
      $data['searchText'] = $searchText;
      $count = $this->orders_model->get_orders_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "orders/index", $count, $this->config->item('pre_page') );
  	  $data['orders_list'] = $this->orders_model->get_orders($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'orders/orders_view';
      //if script file
      $data['script_file'] = 'js/orders_js';
  		$data['header'] = array('title' => 'Orders | '.$this->config->item('sitename'),
              								'description' =>  'Orders | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Orders');
  		$this->load->view('template/layout_main', $data);
    }
    else {
      // access denied
       $this->loadThis();
    }
  }

  function view($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='15';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {
      if($id == null)
      {
          redirect('orders');
      }
      else {
        if (!ctype_digit($id)) {
          redirect('error');
        }
      }

        $data['orders_data'] = $this->orders_model->get_orders_id($id);
        $data['orders_detail_data'] = $this->orders_model->get_orders_detail($id);

        if(count($data['orders_data'])==0){
            redirect('error');
        }

        $data['content'] = 'orders/orders_info_view';
        //if script file
        //$data['script_file'] = 'js/orders_js';
        $data['header'] = array('title' => 'View Orders | '.$this->config->item('sitename'),
                              'description' =>  'View Orders | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Orders');
        $this->load->view('template/layout_main', $data);
    }
    else {
      // access denied
       $this->loadThis();
    }
  }

  function assign($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='15';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {
        if($id == null)
        {
            redirect('orders');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['user_sale'] = $this->orders_model->get_user_sale();
        $data['orders_data'] = $this->orders_model->get_orders_id($id);
        $data['orders_detail_data'] = $this->orders_model->get_orders_detail($id);
        if(count($data['orders_data'])==0){
            redirect('error');
        }

        $data['content'] = 'orders/orders_assign_view';
        //if script file
        //$data['script_file'] = 'js/product_brand_js';
        $data['header'] = array('title' => 'Asign orders | '.$this->config->item('sitename'),
                              'description' =>  'Asign orders | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'orders');
        $this->load->view('template/layout_main', $data);
    }
    else {
      // access denied
       $this->loadThis();
    }
  }

}
