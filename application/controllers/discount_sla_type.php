<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Discount_sla_type extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('discount_sla_type_model');
    $this->isLoggedIn();
  }


  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='7';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

      $searchText = $this->input->post('searchText');
      $data['searchText'] = $searchText;

      $count = $this->discount_sla_type_model->get_discount_sla_type_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "discount_sla_type/index", $count, $this->config->item('pre_page') );
      $data['discount_sla_type_list'] = $this->discount_sla_type_model->get_discount_sla_type($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'discount_sla_type/discount_sla_type_view';
      //if script file
      //$data['script_file'] = 'js/discount_sla_type_js';
      $data['header'] = array('title' => 'SLA | '.$this->config->item('sitename'),
                              'description' =>  'Discount SLA Type | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Discount SLA Type');
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
    $data['menu_id'] ='7';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

        $data['discount_sla_type_data'] = $this->discount_sla_type_model->get_discount_sla_type_id($id);
        //$data['discount_sla_type_detail'] = $this->discount_sla_type_model->get_discount_sla_type_detail($id);
        $data['content'] = 'discount_sla_type/discount_sla_type_info_view';
        //if script file
        //$data['script_file'] = 'js/menugroup_js';
        $data['header'] = array('title' => 'SLA | '.$this->config->item('sitename'),
                              'description' =>  'Discount SLA Type | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Discount SLA Type');
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
    $data['menu_id'] ='7';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {

        $data['discount_sla_type_data'] = $this->discount_sla_type_model->get_discount_sla_type_id($id);
        $data['content'] = 'discount_sla_type/discount_sla_type_edit_view';
        //if script file
        //$data['script_file'] = 'js/discount_sla_type_js';
        $data['header'] = array('title' => 'SLA | '.$this->config->item('sitename'),
                              'description' =>  'Discount SLA Type | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Discount SLA Type');
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
    $data['menu_id'] ='7';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('name','name','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('sla_desc','Description','trim|required|max_length[255]|xss_clean');
          $this->form_validation->set_rules('sla_min','Min','trim|required|max_length[10]|xss_clean');
          $this->form_validation->set_rules('sla_max','Max','trim|required|max_length[10]|xss_clean');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $name = $this->input->post('name');
              $sla_desc = $this->input->post('sla_desc');
              $sla_min = $this->input->post('sla_min');
              $sla_max = $this->input->post('sla_max');
              $is_active = $this->input->post('is_active');
              $discount_sla_type_id = $this->input->post('discount_sla_type_id');

              $discount_sla_type_info = array('name'=>$name, 'description'=>$sla_desc,
                                      'min'=>$sla_min, 'max'=>$sla_max, 'is_active'=>$is_active,
                                      'discount_sla_type_id'=>$discount_sla_type_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->discount_sla_type_model->update_discount_sla_type($discount_sla_type_info,$discount_sla_type_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Update SLA successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Update SLA failed');
              }
              redirect('discount_sla_type/edit/'.$discount_sla_type_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

}
