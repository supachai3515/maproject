<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Quotation extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('Quotation_model');
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

      $count = $this->Quotation_model->get_Quotation_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "Quotation/index", $count, $this->config->item('pre_page') );
      $data['Quotation_list'] = $this->Quotation_model->get_Quotation($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'Quotation/Quotation_view';
      //if script file
<<<<<<< HEAD
      //$data['script_file'] = 'js/quotation_js';
=======
      //$data['script_file'] = 'js/Quotation_js';
>>>>>>> c7f484b5f14f69fab63d63da174e14c7ec219c8b
      $data['header'] = array('title' => 'Quotation | '.$this->config->item('sitename'),
                              'description' =>  'Quotation | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Quotation');
<<<<<<< HEAD


=======
>>>>>>> c7f484b5f14f69fab63d63da174e14c7ec219c8b
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
            redirect('Quotation');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['Quotation_data'] = $this->Quotation_model->get_Quotation_id($id);
        if(count($data['Quotation_data'])==0){
            redirect('error');
        }
        //$data['Quotation_detail'] = $this->Quotation_model->get_Quotation_detail($id);
        $data['content'] = 'Quotation/Quotation_info_view';
        //if script file
        //$data['script_file'] = 'js/menugroup_js';
        $data['header'] = array('title' => 'Quotation | '.$this->config->item('sitename'),
                              'description' =>  'Quotation | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Quotation');
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
          redirect('Quotation');
      }
      else {
        if (!ctype_digit($id)) {
          redirect('error');
        }
      }

        $data['Quotation_data'] = $this->Quotation_model->get_Quotation_id($id);

        if(count($data['Quotation_data'])==0){
            redirect('error');
        }
        $data['content'] = 'Quotation/Quotation_edit_view';
        //if script file
        //$data['script_file'] = 'js/Quotation_js';
        $data['header'] = array('title' => 'Quotation | '.$this->config->item('sitename'),
                              'description' =>  'Quotation | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Quotation');
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
              $Quotation_id = $this->input->post('Quotation_id');

              $Quotation_info = array('lb_year'=>$costLB, 'pm_time'=>$costPM, 'is_active'=>$is_active,
                                      'Quotation_id'=>$Quotation_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->Quotation_model->update_Quotation($Quotation_info,$Quotation_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Update Quotation successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Update Quotation failed');
              }
              redirect('Quotation/edit/'.$Quotation_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

}
