<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Quotation extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
		$this->load->model('quotation_model');
    $this->load->library('my_upload');
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

  function add($order_id)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='18';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_add'])
    {

      if($order_id != 0)
      {
        if (!ctype_digit($order_id)) {
          redirect('error');
        }
      }

        $quotation_id = $this->quotation_model->add_gen($order_id,$this->vendorId);
        if(isset($quotation_id)){
          //$data['quotation_data'] = $this->quotation_model->get_quotation_by_id($quotation_id);
          //$data['quotation_d)etail_data'] = $this->quotation_model->get_quotation_datail_id($quotation_id);
          redirect('quotation/edit/'.$quotation_id);
        }
        else{
          $this->loadThis();
        }
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

        $data['quotation_data'] = $this->quotation_model->get_quotation_by_id($id);
        $data['quotation_detail_data'] = $this->quotation_model->get_quotation_datail_id($id);
        if(count($data['quotation_data'])==0){
            redirect('error');
        }
        //$data['quotation_detail'] = $this->quotation_model->get_quotation_detail($id);
        $data['content'] = 'quotation/quotation_info_view';
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
          redirect('quotation');
      }
      else {
        if (!ctype_digit($id)) {
          redirect('error');
        }
      }

        $data['quotation_data'] = $this->quotation_model->get_quotation_by_id($id);
        $data['quotation_detail_data'] = $this->quotation_model->get_quotation_datail_id($id);

        if(count($data['quotation_data'])==0){
            redirect('error');
        }
        $data['content'] = 'quotation/quotation_edit_view';
        //if script file
        $data['script_file'] = 'js/quotation_js';
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

  function edit_save(){
    $data_re = json_decode(file_get_contents("php://input"));
     $quotation_data = $data_re->quotation_data;
     $quotation_detail_data = $data_re->quotation_detail_data;
     $edit_type = $data_re->edit_type;

    if(isset($data_re)){
      //update in model
      $quotation_id =  $this->quotation_model->save_edit($quotation_data,$quotation_detail_data,$edit_type,$this->vendorId);
      //new qo
      //$quotation_id =   $this->quotation_model->save_edit($quotation_data,$quotation_detail_data,true,$this->vendorId);

       //get data
       $data['quotation_data'] = $this->quotation_model->get_quotation_by_id($quotation_id);
       $data['quotation_detail_data'] = $this->quotation_model->get_quotation_datail_id($quotation_id);
        json_output(200, $data);
    } else {
        json_output(400, array('status' => 400,'message' => 'Technical Error'));
    }
  }

  function edit_save_old()
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

    function upload_file()
    {
      $dir ='./uploads/quotation/'.date("Ym").'/';
      $dir_insert ='uploads/quotation/'.date("Ym").'/';
      $ow_logo_path ='';
      $sale_manager_sig_path ='';
      $sale_sig_path ='';
      $isErr = false;
      $errorStr = "";
      $file_path = [];

      if(isset($_FILES["ow_logo"]))
      {
        $this->my_upload->upload($_FILES["ow_logo"]);
        if ($this->my_upload->uploaded == true) {
            $this->my_upload->process($dir);

            if ($this->my_upload->processed == true) {
                $ow_logo_path  = $this->my_upload->file_dst_name;
                //update img
                $this->my_upload->clean();
            } else {
                $data['errors'] = $this->my_upload->error;
                //echo $data['errors'];
                $isErr = true;
                $errorStr= $data['errors'];
            }
        } else {
            $data['errors'] = $this->my_upload->error;
            $isErr = true;
            $errorStr= $data['errors'];
        }
        $file_path['ow_logo'] = $dir_insert.$ow_logo_path;
      }

      if(isset($_FILES["sale_manager_signature"]))
      {
        $this->my_upload->upload($_FILES["sale_manager_signature"]);
        if ($this->my_upload->uploaded == true) {
            $this->my_upload->process($dir);

            if ($this->my_upload->processed == true) {
                $sale_manager_sig_path  = $this->my_upload->file_dst_name;
                //update img
                $this->my_upload->clean();
            } else {
                $data['errors'] = $this->my_upload->error;
                //echo $data['errors'];
                $isErr = true;
                $errorStr= $data['errors'];
            }
        } else {
            $data['errors'] = $this->my_upload->error;
            $isErr = true;
            $errorStr= $data['errors'];
        }
        $file_path['sale_manager_signature'] = $dir_insert.$sale_manager_sig_path;
      }

      if(isset($_FILES["sale_signature"]))
      {
        $this->my_upload->upload($_FILES["sale_signature"]);
        if ($this->my_upload->uploaded == true) {
            $this->my_upload->process($dir);

            if ($this->my_upload->processed == true) {
                $sale_sig_path  = $this->my_upload->file_dst_name;
                //update img
                $this->my_upload->clean();
            } else {
                $data['errors'] = $this->my_upload->error;
                //echo $data['errors'];
                $isErr = true;
                $errorStr= $data['errors'];
            }
        } else {
            $data['errors'] = $this->my_upload->error;
            $isErr = true;
            $errorStr= $data['errors'];
        }
        $file_path['sale_signature'] = $dir_insert.$sale_sig_path;
      }

       if(!$isErr){
        json_output(200, $file_path );

       }
       else{
         json_output(400, array('status' => 400,'message' => $errorStr));
       }

      // $userid = empty($_POST['qo_id']) ? '' : $_POST['qo_id'];
      // echo json_encode($file_path); 
      
    }

}
