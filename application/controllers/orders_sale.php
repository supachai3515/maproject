<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Orders_sale extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('orders_model');
    $this->load->model('orders_sale_model');
    $this->load->model('home_model');
    $this->isLoggedIn();
  }

  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='16';
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
      $count = $this->orders_sale_model->get_orders_count($searchText,$this->vendorId);
      $data['links_pagination'] = $this->pagination_compress( "orders/index", $count, $this->config->item('pre_page') );
  	  $data['orders_list'] = $this->orders_sale_model->get_orders( $searchText, $page, $this->config->item('pre_page'),$this->vendorId);

      $data['content'] = 'orders_sale/orders_sale_view';
      //if script file
      $data['script_file'] = 'js/orders_sale_js';
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
    $data['menu_id'] ='16';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {
      if($id == null)
      {
          redirect('orders_sale');
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
        //$data['script_file'] = 'js/orders_sale_js';
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

  function edit($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='16';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {
        if($id == null)
        {
            redirect('orders_sale');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }


        $data['orders_data'] = $this->orders_model->get_orders_id($id);
        $data['orders_detail_data'] = $this->orders_model->get_orders_detail($id);
        $data['province_list'] = $this->home_model->get_province();
        $data['contract_list'] = $this->home_model->get_contract();
        if(count($data['orders_data'])==0){
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
    }
    else {
      // access denied
       $this->loadThis();
    }
  }

  function edit_save()
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='16';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('company','Company','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('tel','Tel','trim|required|xss_clean|max_length[11]');
          $this->form_validation->set_rules('comment_order','Comment','trim|xss_clean|max_length[1024]');
          $this->form_validation->set_rules('email','Email','trim|required|email|xss_clean|max_length[128]');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->edit($this->input->post('order_id'));
          }
          else
          {
              $company = $this->input->post('company');
              $tel = $this->input->post('tel');
              $email = $this->input->post('email');
              $comment_order = $this->input->post('comment_order');
              $is_active = $this->input->post('is_active');
              $order_id = $this->input->post('order_id');

              $orders_sale_info = array('company'=>$company, 'tel'=>$tel,'email'=>$email,
                                        'is_active'=>$is_active,'comment_order'=>  $comment_order,
                                        'order_id'=>$order_id,
                                        'modified_by'=>$this->vendorId,
                                        'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->orders_sale_model->update_orders($orders_sale_info,$order_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Edit Order Update successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Order update failed');
              }
              redirect('orders_sale/edit/'.$order_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

  function get_order()
  {

    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
        $value = json_decode(file_get_contents("php://input"));
        if($value){
          $data['order'] = $this->orders_model->get_orders_id($value->order_id);
          json_output(200,$data['order']);
        }
    }

  }

  function get_order_detail()
	{
    $method = $_SERVER['REQUEST_METHOD'];
    if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
        $value = json_decode(file_get_contents("php://input"));
        if($value){
          $data['orders_detail'] = $this->orders_model->get_orders_detail($value->order_id);
          json_output(200,$data['orders_detail']);
        }
    }
	}

}
