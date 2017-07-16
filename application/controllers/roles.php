<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Roles extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('roles_model');
    $this->isLoggedIn();
  }

  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='17';
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
      $count = $this->roles_model->get_roles_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "roles/index", $count, $this->config->item('pre_page') );
  	  $data['roles_list'] = $this->roles_model->get_roles($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'roles/roles_view';
      //if script file
      //$data['script_file'] = 'js/roles_js';
  		$data['header'] = array('title' => 'roles | '.$this->config->item('sitename'),
              								'description' =>  'roles | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'roles');
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
    $data['menu_id'] ='17';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {
        $data['content'] = 'roles/roles_add_view';
        //if script file
        //$data['script_file'] = 'js/roles_js';
  		  $data['header'] = array('title' => 'Add roles | '.$this->config->item('sitename'),
              								'description' =>  'Add roles | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'roles');
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
    $data['menu_id'] ='17';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_view'])
    {

        if($id == null)
        {
            redirect('role');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['roles_data'] = $this->roles_model->get_roles_id($id);
        $data['content'] = 'roles/roles_info_view';
        //if script file
        //$data['script_file'] = 'js/roles_js';
        $data['header'] = array('title' => 'View roles | '.$this->config->item('sitename'),
                              'description' =>  'View roles | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'roles');
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
    $data['menu_id'] ='17';
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

              $roles_info = array('role'=>$name, 'description'=>$description, 'is_active'=>$is_active,
                                      'create_by'=>$this->vendorId, 'create_date'=>date('Y-m-d H:i:s'),
                                      'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->roles_model->save_roles($roles_info);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Add roles created successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('roles/add');
          }
      }
      else {
           $this->loadThis();
      }
  }

  function edit($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='17';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {

        if($id == null)
        {
            redirect('role');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['roles_data'] = $this->roles_model->get_roles_id($id);
        $data['content'] = 'roles/roles_edit_view';
        //if script file
        //$data['script_file'] = 'js/roles_js';
  		  $data['header'] = array('title' => 'Add roles | '.$this->config->item('sitename'),
              								'description' =>  'Add roles | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' => 'roles');
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
    $data['menu_id'] ='17';
		$data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
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
              $role_id = $this->input->post('role_id');

              $roles_info = array('role'=>$name, 'description'=>$description, 'is_active'=>$is_active,
                                      'roleId'=>$role_id,
                                      'modified_by'=>$this->vendorId,
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->roles_model->update_roles($roles_info,$role_id);

              if($result > 0)
              {
                  $this->session->set_flashdata('success', 'Add roles Update successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'User creation failed');
              }
              redirect('roles/edit/'.$role_id);
          }
      }
      else {
           $this->loadThis();
      }
  }

  function get_role_detail()
	{
		$value = json_decode(file_get_contents("php://input"));
    $data['role_detail'] = $this->roles_model->get_role_detail($value->role_id);
		print json_encode($data['role_detail']);

	}

  function get_menu()
	{
		$value = json_decode(file_get_contents("php://input"));
    $data['menu'] = $this->roles_model->get_menu($value->role_id);
		print json_encode($data['menu']);
	}

  function update_role_detail() {
    $value = json_decode(file_get_contents("php://input"));
    $data['result'] = $this->roles_model->update_role_detail($value);
		print json_encode($data['result']);

  }

  function save_role_detail() {
    $value = json_decode(file_get_contents("php://input"));
    $data['result'] = $this->roles_model->save_role_detail($value);
    print json_encode($data['result']);

  }

}
