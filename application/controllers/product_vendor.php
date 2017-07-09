<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Product_vendor extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('product_vendor_model');
    $this->isLoggedIn();
  }

  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='12';
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
      $count = $this->product_vendor_model->get_product_vendor_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "product_vendor/index", $count, $this->config->item('pre_page') );
  	  $data['product_vendor_list'] = $this->product_vendor_model->get_product_vendor($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'product_vendor/product_vendor_view';
      //if script file
      //$data['script_file'] = 'js/product_vendor_js';
  		$data['header'] = array('title' => 'Product vendor | '.$this->config->item('sitename'),
              								'description' =>  'Product vendor | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Product vendor');
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
    $data['menu_id'] ='12';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {
        if($id == null)
        {
            redirect('product_vendor');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['product_vendor_data'] = $this->product_vendor_model->get_product_vendor_id($id);

        if(count($data['product_vendor_data'])==0){
            redirect('error');
        }
        $data['list_product_brand'] = $this->initdata_model->get_product_brand();
        $data['content'] = 'product_vendor/product_vendor_info_view';
        //if script file
        //$data['script_file'] = 'js/product_vendor_js';
        $data['header'] = array('title' => 'View Product vendor | '.$this->config->item('sitename'),
                              'description' =>  'View Product vendor | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Product vendor');
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
    $data['menu_id'] ='12';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
        $data['list_product_brand'] = $this->initdata_model->get_product_brand();
        $data['content'] = 'product_vendor/product_vendor_add_view';
        //if script file
        //$data['script_file'] = 'js/product_vendor_js';
  		  $data['header'] = array('title' => 'Add Product vendor | '.$this->config->item('sitename'),
              								'description' =>  'Add Product vendor | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Product vendor');
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
    $data['menu_id'] ='12';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('model','Model','trim|required|xss_clean|max_length[64]');
          $this->form_validation->set_rules('name','Name','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('description','Description','trim|xss_clean|max_length[250]');
          $this->form_validation->set_rules('product_brand_id','Brand','trim|required|numeric');
          $this->form_validation->set_rules('dealer_price','Dealer price','trim|required|xss_clean|max_length[11]');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $model = $this->input->post('model');
              $name = $this->input->post('name');
              $description = $this->input->post('description');
              $product_brand_id = $this->input->post('product_brand_id');
              $dealer_price = $this->input->post('dealer_price');
              $is_active = $this->input->post('is_active');


              $product_vendor_info = array('model' => $model,
                                          'name'=>$name, 'description'=>$description,
                                          'product_brand_id'=>$product_brand_id,'dealer_price'=>$dealer_price,
                                          'is_active'=>$is_active,
                                          'create_by'=>$this->vendorId, 'create_date'=>date('Y-m-d H:i:s'),
                                          'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->product_vendor_model->save_product_vendor($product_vendor_info);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Create Product vendor successfully');
              }
              else if($result==0)
              {
                  $this->session->set_flashdata('error', 'Part number duplicate');
              }
              else{
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('product_vendor/add');
          }
      }
      else {
           $this->loadThis();
      }
  }

  function edit($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='12';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {
      if($id == null)
      {
          redirect('product_vendor');
      }
      else {
        if (!ctype_digit($id)) {
          redirect('error');
        }
      }

        $data['product_vendor_data'] = $this->product_vendor_model->get_product_vendor_id($id);
        if(count($data['product_vendor_data'])==0){
            redirect('error');
        }

        $data['list_product_brand'] = $this->initdata_model->get_product_brand();
        $data['content'] = 'product_vendor/product_vendor_edit_view';
        //if script file
        //$data['script_file'] = 'js/product_vendor_js';
  		  $data['header'] = array('title' => 'Edit Product vendor | '.$this->config->item('sitename'),
              								'description' =>  'Edit Product vendor | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Product vendor');
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
    $data['menu_id'] ='12';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('model','Model','trim|required|xss_clean|max_length[64]');
          $this->form_validation->set_rules('name','Name','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('description','Description','trim|xss_clean|max_length[250]');
          $this->form_validation->set_rules('product_brand_id','Brand','trim|required|numeric');
          $this->form_validation->set_rules('dealer_price','Dealer price','trim|required|xss_clean|max_length[11]');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
            $product_vendor_id = $this->input->post('product_vendor_id');
            $model = $this->input->post('model');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $product_brand_id = $this->input->post('product_brand_id');
            $dealer_price = $this->input->post('dealer_price');
            $is_active = $this->input->post('is_active');

              $product_vendor_info = array('model' => $model,
                                      'name'=>$name, 'description'=>$description, 'is_active'=>$is_active,
                                      'product_brand_id'=>$product_brand_id,
                                      'description'=>$description,'dealer_price'=>$dealer_price,
                                      'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->product_vendor_model->update_product_vendor($product_vendor_info,$product_vendor_id);
              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Edit Product vendor Update successfully');
              }
              else{
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('product_vendor/edit/'.$product_vendor_id);
          }
      }
      else {
           $this->loadThis();
    }
  }
}
