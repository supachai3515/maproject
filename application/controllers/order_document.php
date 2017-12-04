<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Order_document extends BaseController {
	public function __construct(){
		parent::__construct();
		$this->load->model('initdata_model');
		$this->load->model('order_document_model');
		$this->load->library('my_upload');
		//call model inti
    	session_start();
	}

	public function index()
	{
      //if script file
      $data['script_file'] = 'js/order_document_js';
  		$data['header'] = array('title' => 'Order Document | '.$this->config->item('sitename'),
              								'description' =>  'Order Document | '.$this->config->item('tagline'),
              								'author' => $this->config->item('author'),
              								'keyword' =>  'Order Document');
  		$userId= $this->session->userdata ( 'userId' );
		if (isset($userId)) {
			$data['sale_user'] = $this->initdata_model->get_sele_user($userId);
		}

  		$this->load->view('home/order_document_view', $data);
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
    	$order_document_id = $this->order_document_model->save_order_document($value);
        if(isset($order_document_id)){
          //sendmail
          $data['email'] = "";// toemail
          $data['template'] = "email/order_document";
          $data['subject'] = "Order document  #".$order_document_id;
          $data['bcc_mail'] = $this->config->item('email_cc_group');
          $data['name'] = "";
          $data['tel'] = "";
          //$this->load->view('email/send_order', $data);


          //sendmail
          $sendStatus = send_emali_template_gmail($data);
          if($sendStatus){
            json_output(200, array('status' => 200,'message' => 'success'));
          } else {
            json_output(400, array('status' => 400,'message' => 'error'));
          }
        }
        else{
        	json_output(400, array('status' => 400,'message' => 'error'));
        }
    }

}
