<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Discount_of_contract extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('discount_of_contract_model');
    $this->isLoggedIn();
  }


  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='8';
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

      $count = $this->discount_of_contract_model->get_discount_of_contract_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "discount_of_contract/index", $count, $this->config->item('pre_page') );
      $data['discount_of_contract_list'] = $this->discount_of_contract_model->get_discount_of_contract($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'discount_of_contract/discount_of_contract_view';
      //if script file
      //$data['script_file'] = 'js/discount_of_contract_js';
      $data['header'] = array('title' => 'Contract | '.$this->config->item('sitename'),
                              'description' =>  'Contract | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Contract');
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
    $data['menu_id'] ='8';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {
        if($id == null)
        {
            redirect('discount_of_contract');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['discount_of_contract_data'] = $this->discount_of_contract_model->get_discount_of_contract_id($id);

        if(count($data['discount_of_contract_data'])==0){
            redirect('error');
        }
        //$data['discount_of_contract_detail'] = $this->discount_of_contract_model->get_discount_of_contract_detail($id);
        $data['content'] = 'discount_of_contract/discount_of_contract_info_view';
        //if script file
        //$data['script_file'] = 'js/menugroup_js';
        $data['header'] = array('title' => 'Contract | '.$this->config->item('sitename'),
                              'description' =>  'Contract | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Contract');
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
    $data['menu_id'] ='8';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
        $data['content'] = 'discount_of_contract/discount_of_contract_add_view';
        //if script file
        //$data['script_file'] = 'js/discount_of_contract_js';
        $data['header'] = array('title' => 'Contract | '.$this->config->item('sitename'),
                              'description' =>  'Contract | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Contract');
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
    $data['menu_id'] ='8';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('num_contract','Contract','trim|required|max_length[11]|xss_clean');
          $this->form_validation->set_rules('discount','Discount','trim|required|max_length[10]|xss_clean');
          $this->form_validation->set_rules('description','Description','trim|required|max_length[255]|xss_clean');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $num_contract = $this->input->post('num_contract');
              $discount = $this->input->post('discount');
              $description = $this->input->post('description');
              $is_active = $this->input->post('is_active');

              $discount_of_contract_info =array('number'=>$num_contract, 'discount'=>$discount,
                                      'description'=>$description, 'is_active'=>$is_active,
                                      'create_by'=>$this->vendorId, 'create_date'=>date('Y-m-d H:i:s'),
                                      'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->discount_of_contract_model->save_discount_of_contract($discount_of_contract_info);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Add Contract successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Contract creation failed');
              }
              redirect('discount_of_contract/add');
          }
      }
      else {
           $this->loadThis();
      }
  }


  function edit($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='8';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {

        if($id == null)
        {
            redirect('discount_of_contract');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['discount_of_contract_data'] = $this->discount_of_contract_model->get_discount_of_contract_id($id);
        if(count($data['discount_of_contract_data'])==0){
            redirect('error');
        }
        $data['content'] = 'discount_of_contract/discount_of_contract_edit_view';
        //if script file
        //$data['script_file'] = 'js/discount_of_contract_js';
        $data['header'] = array('title' => 'Contract | '.$this->config->item('sitename'),
                              'description' =>  'Contract | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Contract');
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
    $data['menu_id'] ='8';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('num_contract','Contract','trim|required|max_length[11]|xss_clean');
          $this->form_validation->set_rules('discount','Discount','trim|required|max_length[10]|xss_clean');
          $this->form_validation->set_rules('description','Description','trim|required|max_length[255]|xss_clean');
          $this->form_validation->set_rules('is_active','ใช้งาน','');

          if($this->form_validation->run() == FALSE)
          {
              $this->add();
          }
          else
          {
              $num_contract = $this->input->post('num_contract');
              $discount = $this->input->post('discount');
              $description = $this->input->post('description');
              $is_active = $this->input->post('is_active');
              $discount_of_contract_id = $this->input->post('discount_of_contract_id');

              $discount_of_contract_info = array('number'=>$num_contract, 'discount'=>$discount,
                                      'description'=>$description, 'is_active'=>$is_active,
                                      'discount_of_contract_id'=>$discount_of_contract_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->discount_of_contract_model->update_discount_of_contract($discount_of_contract_info,$discount_of_contract_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Update Contract successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Update Contract failed');
              }
              redirect('discount_of_contract/edit/'.$discount_of_contract_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

}
