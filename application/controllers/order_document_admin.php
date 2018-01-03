<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Order_document_admin extends BaseController {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('initdata_model');
    $this->load->model('order_document_model');
    $this->load->model('order_document_sale_model');
    $this->load->model('orders_model');
    $this->isLoggedIn();
  }


  function index($page=0)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='20';
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

      $count = $this->order_document_model->get_order_doc_count($searchText);
      $data['links_pagination'] = $this->pagination_compress( "order_document_internal/index", $count, $this->config->item('pre_page') );
      $data['order_doc_list'] = $this->order_document_model->get_order_doc($searchText, $page, $this->config->item('pre_page'));


      $data['content'] = 'order_document/order_document_view';
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

  function assign($id=NULL)
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='20';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {
        if($id == null)
        {
            redirect('order_document_admin');
        }
        else {
          if (!ctype_digit($id)) {
            redirect('error');
          }
        }

        $data['user_sale'] = $this->orders_model->get_user_sale();
        $data['order_document_detail'] = $this->order_document_model->get_order_doc_detail($id);
        // $data['orders_detail_data'] = $this->orders_model->get_orders_detail($id);
        if(count($data['order_document_detail'])==0){
            redirect('error');
        }

        $data['content'] = 'order_document/order_document_assign_view';
        //if script file
        //$data['script_file'] = 'js/product_brand_js';
        $data['header'] = array('title' => 'Asign orders document | '.$this->config->item('sitename'),
                              'description' =>  'Asign orders document | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Orders document');
        $this->load->view('template/layout_main', $data);
    }
    else {
      // access denied
       $this->loadThis();
    }
  }

  function assign_save()
  {
    $data['global'] = $this->global;
    $data['menu_id'] ='20';
    $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
    $data['access_menu'] = $this->isAccessMenu($data['menu_list'],$data['menu_id']);
    if($data['access_menu']['is_access']&&$data['access_menu']['is_edit'])
    {
          $this->load->library('form_validation');
          $this->form_validation->set_rules('user','User','trim|required|numeric');
          if($this->form_validation->run() == FALSE)
          {
              $this->index();
          }
          else
          {
              $order_document_id = $this->input->post('order_document_id');
              $assign_to = $this->input->post('user');

              $orders_doc_info = array('assign_to'=>$assign_to,
                                      'order_document_id'=>$order_document_id,
                                      'assign_by'=>$this->vendorId,
                                      'modified_by'=>$this->vendorId,
                                      'assign_by_date'=>date('Y-m-d H:i:s'),
                                      'assign_to_date'=>date('Y-m-d H:i:s'),
                                      'modified_date'=>date('Y-m-d H:i:s'));

              $result = $this->order_document_model->assign_order_document($orders_doc_info,$order_document_id);

              if($result > 0)
              {
                  $this->load->model('user_model');
                  $data['order_document_detail'] = $this->order_document_model->get_order_doc_detail($order_document_id);

                  $user_data_assign_to = $data['user_data_assign_to'] = $this->orders_model->get_user_info($assign_to);
                  $user_data_assign = $data['user_data_assign'] = $this->orders_model->get_user_info($this->vendorId);

                  // //sendmail
                  $data['email'] = $user_data_assign_to["email"].",".$user_data_assign["email"]; //To Email
                  $data['template'] = "email/order_document";
                  $data['subject'] = "Assign order document #".$order_document_id;
                  $data['bcc_mail'] = $this->config->item('email_cc_group');
                  $data['name'] = "";
                  $data['tel'] = "";

                  //sendmail
                  $sendStatus = send_emali_template_gmail($data);
                  if($sendStatus){
                      $status = "send";
                      setFlashData('success', 'Assign order document and Send email successfully');
                  } else {
                      $status = "notsend";
                      setFlashData($status, "Email has been failed, try again.");
                  }
              }
              else
              {
                  $this->session->set_flashdata('error', 'Orders Assign failed');
              }
              redirect('order_document_admin/assign/'.$order_document_id);
          }
      }
      else {
           $this->loadThis();
      }
  }
}
