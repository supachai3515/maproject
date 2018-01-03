<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Order_document_sale extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
    $this->load->model('order_document_sale_model');
    $this->load->library('my_upload');
    $this->isLoggedIn();
  }


  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='19';
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

      $count = $this->order_document_sale_model->get_order_doc_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "order_document_internal/index", $count, $this->config->item('pre_page') );
      $data['order_doc_list'] = $this->order_document_sale_model->get_order_doc($searchText, $page, $this->config->item('pre_page'), $this->vendorId);


      $data['content'] = 'order_document_sale/order_document_view';
      //if script file
      //$data['script_file'] = 'js/order_document_internal_js';
      $data['header'] = array('title' => 'Order Document | '.$this->config->item('sitename'),
                              'description' =>  'Order Document | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Order Document');


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
    $data['menu_id'] ='19';
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

      $data['order_document_detail'] = $this->order_document_sale_model->get_order_doc_detail($id);


      $data['content'] = 'order_document_sale/order_document_edit_view';
      //if script file
      $data['script_file'] = 'js/order_document_sale_edit_js';
      $data['header'] = array('title' => 'Order Document | '.$this->config->item('sitename'),
                              'description' =>  'Order Document | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Order Document');


      $this->load->view('template/layout_main', $data);

    }
    else {
      // access denied
       $this->loadThis();
    }
  }

  function upload_file()
    {
      $dir ='./uploads/order_doc/'.date("Ym").'/';
      $dir_insert ='uploads/order_doc/'.date("Ym").'/';
      $order_doc_path ='';
      $isErr = false;
      $errorStr = "";
      $file_path = [];

      if(isset($_FILES["document"]))
      {
        $this->my_upload->upload($_FILES["document"]);
        if ($this->my_upload->uploaded == true) {
            $this->my_upload->process($dir);

            if ($this->my_upload->processed == true) {
                $order_doc_path  = $this->my_upload->file_dst_name;
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
        $file_path['order_document'] = $dir_insert.$order_doc_path;
      }

       if(!$isErr){
        json_output(200, $file_path );

       }
       else{
         json_output(400, array('status' => 400,'message' => $errorStr));
       }
    }

    public function save_order()
    {
      $value = json_decode(file_get_contents("php://input"));
      $result = $this->order_document_sale_model->update_order_document($value,$this->vendorId);
        if($result > 0){
          json_output(200, array('status' => 200,'message' => 'success'));
        }
        else{
          json_output(400, array('status' => 400,'message' => 'error'));
        }
    }
}
