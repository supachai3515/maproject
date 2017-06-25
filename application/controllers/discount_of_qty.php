<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Discount_of_qty extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('discount_of_qty_model');
    $this->isLoggedIn();
  }


  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='9';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

      $searchText = $this->input->post('searchText');
      $data['searchText'] = $searchText;

      $count = $this->discount_of_qty_model->get_discount_of_qty_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "discount_of_qty/index", $count, $this->config->item('pre_page') );
      $data['discount_of_qty_list'] = $this->discount_of_qty_model->get_discount_of_qty($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'discount_of_qty/discount_of_qty_view';
      //if script file
      //$data['script_file'] = 'js/discount_of_qty_js';
      $data['header'] = array('title' => 'QTY | '.$this->config->item('sitename'),
                              'description' =>  'QTY | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'QTY');
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
    $data['menu_id'] ='9';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

        $data['discount_of_qty_data'] = $this->discount_of_qty_model->get_discount_of_qty_id($id);
        if(count($data['discount_of_qty_data'])==0){
            redirect('error');
        }
        //$data['discount_of_qty_detail'] = $this->discount_of_qty_model->get_discount_of_qty_detail($id);
        $data['content'] = 'discount_of_qty/discount_of_qty_info_view';
        //if script file
        //$data['script_file'] = 'js/menugroup_js';
        $data['header'] = array('title' => 'QTY | '.$this->config->item('sitename'),
                              'description' =>  'QTY | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'QTY');
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
    $data['menu_id'] ='9';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
        $data['content'] = 'discount_of_qty/discount_of_qty_add_view';
        //if script file
        //$data['script_file'] = 'js/discount_of_qty_js';
        $data['header'] = array('title' => 'QTY | '.$this->config->item('sitename'),
                              'description' =>  'QTY | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'QTY');
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
    $data['menu_id'] ='9';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('from_number','From Number','trim|required|max_length[11]|xss_clean');
          $this->form_validation->set_rules('to_number','To Number','trim|required|max_length[11]|xss_clean');
          $this->form_validation->set_rules('discount','Discount','trim|required|max_length[10]|xss_clean');
          $this->form_validation->set_rules('description','Description','trim|required|max_length[255]|xss_clean');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $from_number = $this->input->post('from_number');
              $to_number = $this->input->post('to_number');
              $discount = $this->input->post('discount');
              $description = $this->input->post('description');
              $is_active = $this->input->post('is_active');

              $discount_of_qty_info = array('from_number'=>$from_number, 'to_number'=>$to_number,
                                      'discount'=>$discount, 'description'=>$description, 'is_active'=>$is_active,
                                      'create_by'=>$this->vendorId, 'create_date'=>date('Y-m-d H:i:s'),
                                      'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->discount_of_qty_model->save_discount_of_qty($discount_of_qty_info);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Add QTY successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'QTY creation failed');
              }
              redirect('discount_of_qty/add');
          }
      }
      else {
           $this->loadThis();
      }
  }

  function edit($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='9';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {

        $data['discount_of_qty_data'] = $this->discount_of_qty_model->get_discount_of_qty_id($id);
        if(count($data['discount_of_qty_data'])==0){
            redirect('error');
        }

        $data['content'] = 'discount_of_qty/discount_of_qty_edit_view';
        //if script file
        //$data['script_file'] = 'js/discount_of_qty_js';
        $data['header'] = array('title' => 'QTY | '.$this->config->item('sitename'),
                              'description' =>  'QTY | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'QTY');
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
    $data['menu_id'] ='9';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('from_number','From Number','trim|required|max_length[11]|xss_clean');
          $this->form_validation->set_rules('to_number','To Number','trim|required|max_length[11]|xss_clean');
          $this->form_validation->set_rules('discount','Discount','trim|required|max_length[10]|xss_clean');
          $this->form_validation->set_rules('description','Description','trim|required|max_length[255]|xss_clean');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $from_number = $this->input->post('from_number');
              $to_number = $this->input->post('to_number');
              $discount = $this->input->post('discount');
              $description = $this->input->post('description');
              $is_active = $this->input->post('is_active');
              $discount_of_qty_id = $this->input->post('discount_of_qty_id');

              $discount_of_qty_info = array('from_number'=>$from_number, 'to_number'=>$to_number,
                                      'discount'=>$discount,
                                      'description'=>$description,
                                      'is_active'=>$is_active,
                                      'discount_of_qty_id'=>$discount_of_qty_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->discount_of_qty_model->update_discount_of_qty($discount_of_qty_info,$discount_of_qty_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Update QTY successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Update QTY failed');
              }
              redirect('discount_of_qty/edit/'.$discount_of_qty_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

}
