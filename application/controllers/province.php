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

  function view($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='6';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

        $data['province_data'] = $this->province_model->get_province_id($id);
        //$data['province_detail'] = $this->province_model->get_province_detail($id);
        $data['content'] = 'province/province_info_view';
        //if script file
        //$data['script_file'] = 'js/menugroup_js';
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

  function edit($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='6';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {

        $data['province_data'] = $this->province_model->get_province_id($id);
        $data['content'] = 'province/province_edit_view';
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

  function edit_save()
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='6';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('costLB','Cost LB','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('costPM','Cost PM','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $costLB = $this->input->post('costLB');
              $costPM = $this->input->post('costPM');
              $is_active = $this->input->post('is_active');
              $province_id = $this->input->post('province_id');

              $province_info = array('lb_year'=>$costLB, 'pm_time'=>$costPM, 'is_active'=>$is_active,
                                      'province_id'=>$province_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->province_model->update_province($province_info,$province_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Update Province successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Update Province failed');
              }
              redirect('province/edit/'.$province_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

}
