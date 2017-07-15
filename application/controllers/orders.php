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

  function add()
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='15';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
        $data['content'] = 'orders/orders_add_view';
        //if script file
        //$data['script_file'] = 'js/orders_js';
  		  $data['header'] = array('title' => 'Add Orders | '.$this->config->item('sitename'),
              								'description' =>  'Add Orders | '.$this->config->item('tagline'),
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


  function add_save()
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='15';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name','Name','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('description','description','trim|xss_clean|max_length[128]');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $name = $this->input->post('name');
              $description = $this->input->post('description');
              $is_active = $this->input->post('is_active');

              $orders_info = array('name'=>$name, 'description'=>$description, 'is_active'=>$is_active,
                                      'create_by'=>$this->vendorId, 'create_date'=>date('Y-m-d H:i:s'),
                                      'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->orders_model->save_orders($orders_info);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Add Orders created successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('orders/add');
          }
      }
      else {
           $this->loadThis();
      }
  }

  function edit($id=NULL)
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


        $data['orders_data'] = $this->orders_model->get_orders_id($id);
        if(count($data['orders_data'])==0){
            redirect('error');
        }

        $data['content'] = 'orders/orders_edit_view';
        //if script file
        //$data['script_file'] = 'js/orders_js';
  		  $data['header'] = array('title' => 'Add Orders | '.$this->config->item('sitename'),
              								'description' =>  'Add Orders | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Orders');
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
    $data['menu_id'] ='15';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name','Name','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('description','description','trim|xss_clean|max_length[128]');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $name = $this->input->post('name');
              $description = $this->input->post('description');
              $is_active = $this->input->post('is_active');
              $orders_id = $this->input->post('orders_id');

              $orders_info = array('name'=>$name, 'description'=>$description, 'is_active'=>$is_active,
                                      'orders_id'=>$orders_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->orders_model->update_orders($orders_info,$orders_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Edit Orders Update successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('orders/edit/'.$orders_id);
          }
      }
      else {
           $this->loadThis();
      }
  }
}
