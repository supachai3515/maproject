<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Product_vender extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('product_vender_model');
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

      $searchText = $this->input->post('searchText');
      $data['searchText'] = $searchText;
      $count = $this->product_vender_model->get_product_vender_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "product_vender/index", $count, $this->config->item('pre_page') );
  	  $data['product_vender_list'] = $this->product_vender_model->get_product_vender($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'product_vender/product_vender_view';
      //if script file
      //$data['script_file'] = 'js/product_vender_js';
  		$data['header'] = array('title' => 'Product Vender | '.$this->config->item('sitename'),
              								'description' =>  'Product Vender | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Product Vender');
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
            redirect('product_vender');
        }

        $data['product_vender_data'] = $this->product_vender_model->get_product_vender_id($id);

        if(count($data['product_vender_data'])==0){
            redirect('error');
        }
        $data['list_product_brand'] = $this->initdata_model->get_product_brand();
        $data['content'] = 'product_vender/product_vender_info_view';
        //if script file
        //$data['script_file'] = 'js/product_vender_js';
        $data['header'] = array('title' => 'View Product Vender | '.$this->config->item('sitename'),
                              'description' =>  'View Product Vender | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Product Vender');
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
        $data['content'] = 'product_vender/product_vender_add_view';
        //if script file
        //$data['script_file'] = 'js/product_vender_js';
  		  $data['header'] = array('title' => 'Add Product Vender | '.$this->config->item('sitename'),
              								'description' =>  'Add Product Vender | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Product Vender');
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
          $this->form_validation->set_rules('part_number','Part number','trim|required|max_length[64]|xss_clean');
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
              $part_number = $this->input->post('part_number');
              $model = $this->input->post('model');
              $name = $this->input->post('name');
              $description = $this->input->post('description');
              $product_brand_id = $this->input->post('product_brand_id');
              $dealer_price = $this->input->post('dealer_price');
              $is_active = $this->input->post('is_active');


              $product_vender_info = array('part_number' => $part_number ,'model' => $model,
                                          'name'=>$name, 'description'=>$description,
                                          'product_brand_id'=>$product_brand_id,'dealer_price'=>$dealer_price,
                                          'is_active'=>$is_active,
                                          'create_by'=>$this->vendorId, 'create_date'=>date('Y-m-d H:i:s'),
                                          'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->product_vender_model->save_product_vender($product_vender_info);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Create Product Vender successfully');
              }
              else if($result==0)
              {
                  $this->session->set_flashdata('error', 'Part number duplicate');
              }
              else{
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('product_vender/add');
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
            redirect('product_vender');
        }

        $data['product_vender_data'] = $this->product_vender_model->get_product_vender_id($id);
        if(count($data['product_vender_data'])==0){
            redirect('error');
        }

        $data['list_product_brand'] = $this->initdata_model->get_product_brand();
        $data['content'] = 'product_vender/product_vender_edit_view';
        //if script file
        //$data['script_file'] = 'js/product_vender_js';
  		  $data['header'] = array('title' => 'Edit Product Vender | '.$this->config->item('sitename'),
              								'description' =>  'Edit Product Vender | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'Product Vender');
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
          $this->form_validation->set_rules('part_number','Part number','trim|required|max_length[64]|xss_clean');
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
            $product_vender_id = $this->input->post('product_vender_id');
            $part_number = $this->input->post('part_number');
            $model = $this->input->post('model');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $product_brand_id = $this->input->post('product_brand_id');
            $dealer_price = $this->input->post('dealer_price');
            $is_active = $this->input->post('is_active');

              $product_vender_info = array('product_vender_id' => $product_vender_id,'part_number' => $part_number ,'model' => $model,
                                      'name'=>$name, 'description'=>$description, 'is_active'=>$is_active,
                                      'product_brand_id'=>$product_brand_id,
                                      'description'=>$description,'dealer_price'=>$dealer_price,
                                      'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->product_vender_model->update_product_vender($product_vender_info,$product_vender_id);
              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Edit Product Vender Update successfully');
              }
              else if($result==0)
              {
                  $this->session->set_flashdata('error', 'Part number duplicate');
              }
              else{
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('product_vender/edit/'.$product_vender_id);
          }
      }
      else {
           $this->loadThis();
    }
  }
}
