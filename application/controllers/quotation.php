<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Quotation extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('quotation_model');
    $this->isLoggedIn();
  }


  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='18';
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

      $count = $this->quotation_model->get_quotation_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "quotation/index", $count, $this->config->item('pre_page') );
      $data['quotation_list'] = $this->quotation_model->get_quotation($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'quotation/quotation_view';
      //if script file
      //$data['script_file'] = 'js/quotation_js';
      $data['header'] = array('title' => 'quotation | '.$this->config->item('sitename'),
                              'description' =>  'quotation | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'quotation');
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
    $data['menu_id'] ='18';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

        if($id == NULL)
        {
            redirect('quotation');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['quotation_data'] = $this->quotation_model->get_quotation_id($id);
        if(count($data['quotation_data'])==0){
            redirect('error');
        }
        //$data['quotation_detail'] = $this->quotation_model->get_quotation_detail($id);
        $data['content'] = 'quotation/quotation_info_view';
        //if script file
        //$data['script_file'] = 'js/menugroup_js';
        $data['header'] = array('title' => 'quotation | '.$this->config->item('sitename'),
                              'description' =>  'quotation | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'quotation');
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
    $data['menu_id'] ='18';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {

      if($id == NULL)
      {
          redirect('quotation');
      }
      else {
        if (!ctype_digit($id)) {
          redirect('error');
        }
      }

        $data['quotation_data'] = $this->quotation_model->get_quotation_id($id);

        if(count($data['quotation_data'])==0){
            redirect('error');
        }
        $data['content'] = 'quotation/quotation_edit_view';
        //if script file
        //$data['script_file'] = 'js/quotation_js';
        $data['header'] = array('title' => 'quotation | '.$this->config->item('sitename'),
                              'description' =>  'quotation | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'quotation');
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
    $data['menu_id'] ='18';
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
              $quotation_id = $this->input->post('quotation_id');

              $quotation_info = array('lb_year'=>$costLB, 'pm_time'=>$costPM, 'is_active'=>$is_active,
                                      'quotation_id'=>$quotation_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->quotation_model->update_quotation($quotation_info,$quotation_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Update quotation successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Update quotation failed');
              }
              redirect('quotation/edit/'.$quotation_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

}
