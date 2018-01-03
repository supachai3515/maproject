<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Upload_document extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('initdata_model');
        $this->load->model('orders_model');
        $this->load->model('orders_sale_model');
        $this->load->model('home_model');
        $this->load->model('tos_cal_model');
        $this->load->library('my_upload');
    }

    public function upload_doct()
    {
      $dir ='./uploads/doc/'.date("Ym").'/';
      $dir_insert ='uploads/doc/'.date("Ym").'/';
      $file_name ='';
      $file_name_2 ='';

      $this->my_upload->upload($_FILES["file_path"]);
      if ($this->my_upload->uploaded == true) {
          $this->my_upload->process($dir);

          if ($this->my_upload->processed == true) {
              $file_name  = $this->my_upload->file_dst_name;
              //update img
              $this->my_upload->clean();
          } else {
              $data['errors'] = $this->my_upload->error;
              echo $data['errors'];
          }
      } else {
          $data['errors'] = $this->my_upload->error;
      }

      $this->my_upload->upload($_FILES["file_path_2"]);
      if ($this->my_upload->uploaded == true) {
          $this->my_upload->process($dir);

          if ($this->my_upload->processed == true) {
              $file_name_2  = $this->my_upload->file_dst_name;
              //update img
              $this->my_upload->clean();
          } else {
              $data['errors'] = $this->my_upload->error;
              echo $data['errors'];
          }
      } else {
          $data['errors'] = $this->my_upload->error;
      }

        $file_path = $dir_insert.$file_name;
        $file_path_2 = $dir_insert.$file_name_2;
        $order_status_id = 7;
        $order_id = $this->input->post('order_id');
        $ref_id = $this->input->post('ref_id');

        $orders_file = array('file_path'=>$file_path,
                            'file_path_2'=>$file_path_2,
                            'order_status_id' => $order_status_id,
                            'modified_date'=>date('Y-m-d H:i:s'));

        $result = $this->orders_sale_model->update_orders($orders_file, $order_id);



        if ($result > 0) {
            $resultInfo = $this->tos_cal_model->get_order($order_id);
            $data['order_data'] = $resultInfo;
            $data['order_detail_data'] = $this->tos_cal_model->get_order_detail($order_id);
            $sale_id = $resultInfo["assign_to"];

            $sale_detail = $this->orders_model->get_user_info($sale_id);

            $sale_email = $sale_detail['email'];
            $sale_name = $sale_detail['name'];
            $sale_mobile = $sale_detail['mobile'];

            $sale_info = array('name' => $sale_name,
                            'tel' => $sale_mobile,
                            'email' => $sale_email);

            //get sale email
            $data['sale_detail'] = $sale_info;

            //sendmail
            $data['email'] = $resultInfo["email"].",".$sale_email;// toemail
            $data['template'] = "email/send_document";
            $data['subject'] = "Send document #".$order_id;
            $data['bcc_mail'] = $this->config->item('email_cc_group');
            $data['name'] = $resultInfo["company"];
            $data['tel'] = $resultInfo["tel"];

            //sendmail
            $sendStatus = send_emali_template_gmail($data);
            if($sendStatus){
                json_output(200, array('status' => 200,'message' => 'success'));
            } else {
                json_output(400, array('status' => 400,'message' => 'error'));
            }
            $this->session->set_flashdata('success', 'Edit Order Update successfully');
        } else {
            $this->session->set_flashdata('error', 'Order update failed');
        }
        redirect('tos_cal/upload_document/'.$ref_id);
    }

    
}