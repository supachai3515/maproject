<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Product_owner extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('initdata_model');
        $this->load->model('product_owner_model');
        $this->isLoggedIn();
    }

    public function index($page=0)
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='11';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_view']) {
            if ($page != 0) {
                if (!ctype_digit($page)) {
                    redirect('error');
                }
            }

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $count = $this->product_owner_model->get_product_owner_count($searchText);
            $data['links_pagination'] = $this->pagination_compress("product_owner/index", $count, $this->config->item('pre_page'));
            $data['product_owner_list'] = $this->product_owner_model->get_product_owner($searchText, $page, $this->config->item('pre_page'));


            $data['content'] = 'product_owner/product_owner_view';
            //if script file
            //$data['script_file'] = 'js/product_owner_js';
            $data['header'] = array('title' => 'Product TOS | '.$this->config->item('sitename'),
                                              'description' =>  'Product TOS | '.$this->config->item('tagline'),
                                              'author' => $this->config->item('author'),
                                              'keyword' => 'Product TOS');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }

    public function view($id=null)
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='11';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_view']) {
            if ($id == null) {
                redirect('product_owner');
            } else {
                if (!ctype_digit($id)) {
                    redirect('error');
                }
            }

            $data['product_brand_data'] = $this->product_brand_model->get_product_brand_id($id);

            if (count($data['product_brand_data'])==0) {
                redirect('error');
            }

            $data['product_owner_data'] = $this->product_owner_model->get_product_owner_id($id);

            if (count($data['product_owner_data'])==0) {
                redirect('error');
            }
            $data['list_product_brand'] = $this->initdata_model->get_product_brand();
            $data['content'] = 'product_owner/product_owner_info_view';
            //if script file
            //$data['script_file'] = 'js/product_owner_js';
            $data['header'] = array('title' => 'View Product TOS | '.$this->config->item('sitename'),
                              'description' =>  'View Product TOS | '.$this->config->item('tagline'),
                              'author' => $this->config->item('author'),
                              'keyword' => 'Product TOS');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }

    public function add()
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='11';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $data['list_product_brand'] = $this->initdata_model->get_product_brand();
            $data['content'] = 'product_owner/product_owner_add_view';
            //if script file
            //$data['script_file'] = 'js/product_owner_js';
            $data['header'] = array('title' => 'Add Product TOS | '.$this->config->item('sitename'),
                                              'description' =>  'Add Product TOS | '.$this->config->item('tagline'),
                                              'author' => $this->config->item('author'),
                                              'keyword' => 'Product TOS');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }

    public function add_save()
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='11';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('part_number', 'Part number', 'trim|required|max_length[64]|xss_clean');
            $this->form_validation->set_rules('model', 'Model', 'trim|required|xss_clean|max_length[64]');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean|max_length[250]');
            $this->form_validation->set_rules('product_brand_id', 'Brand', 'trim|required|numeric');
            $this->form_validation->set_rules('full_price', 'Full price', 'trim|required|xss_clean|max_length[11]');
            $this->form_validation->set_rules('is_active', 'ใช้งาน', '');

            if ($this->form_validation->run() == false) {
                $this->add();
            } else {
                $part_number = $this->input->post('part_number');
                $model = $this->input->post('model');
                $name = $this->input->post('name');
                $description = $this->input->post('description');
                $product_brand_id = $this->input->post('product_brand_id');
                $full_price = $this->input->post('full_price');
                $is_active = $this->input->post('is_active');


                $product_owner_info = array('part_number' => $part_number ,'model' => $model,
                                          'name'=>$name, 'description'=>$description,
                                          'product_brand_id'=>$product_brand_id,'full_price'=>$full_price,
                                          'is_active'=>$is_active,
                                          'create_by'=>$this->vendorId, 'create_date'=>date('Y-m-d H:i:s'),
                                          'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

                $result = $this->product_owner_model->save_product_owner($product_owner_info);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Create Product TOS successfully');
                } elseif ($result==0) {
                    $this->session->set_flashdata('error', 'Part number duplicate');
                } else {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                redirect('product_owner/add');
            }
        } else {
            $this->loadThis();
        }
    }

    public function edit($id=null)
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='11';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_edit']) {
            if ($id == null) {
                redirect('product_owner');
            } else {
                if (!ctype_digit($id)) {
                    redirect('error');
                }
            }

            $data['product_owner_data'] = $this->product_owner_model->get_product_owner_id($id);
            if (count($data['product_owner_data'])==0) {
                redirect('error');
            }

            $data['list_product_brand'] = $this->initdata_model->get_product_brand();
            $data['content'] = 'product_owner/product_owner_edit_view';
            //if script file
            //$data['script_file'] = 'js/product_owner_js';
            $data['header'] = array('title' => 'Edit Product TOS | '.$this->config->item('sitename'),
                                              'description' =>  'Edit Product TOS | '.$this->config->item('tagline'),
                                              'author' => $this->config->item('author'),
                                              'keyword' => 'Product TOS');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }


    public function edit_save()
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='11';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('part_number', 'Part number', 'trim|required|max_length[64]|xss_clean');
            $this->form_validation->set_rules('model', 'Model', 'trim|required|xss_clean|max_length[64]');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|xss_clean|max_length[250]');
            $this->form_validation->set_rules('product_brand_id', 'Brand', 'trim|required|numeric');
            $this->form_validation->set_rules('full_price', 'Full price', 'trim|required|xss_clean|max_length[11]');
            $this->form_validation->set_rules('is_active', 'ใช้งาน', '');

            if ($this->form_validation->run() == false) {
                $this->add();
            } else {
                $product_owner_id = $this->input->post('product_owner_id');
                $part_number = $this->input->post('part_number');
                $model = $this->input->post('model');
                $name = $this->input->post('name');
                $description = $this->input->post('description');
                $product_brand_id = $this->input->post('product_brand_id');
                $full_price = $this->input->post('full_price');
                $is_active = $this->input->post('is_active');

                $product_owner_info = array('product_owner_id' => $product_owner_id,'part_number' => $part_number ,'model' => $model,
                                      'name'=>$name, 'description'=>$description, 'is_active'=>$is_active,
                                      'product_brand_id'=>$product_brand_id,
                                      'description'=>$description,'full_price'=>$full_price,
                                      'modified_by'=>$this->vendorId, 'modified_date'=>date('Y-m-d H:i:s'));

                $result = $this->product_owner_model->update_product_owner($product_owner_info, $product_owner_id);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Edit Product TOS Update successfully');
                } elseif ($result==0) {
                    $this->session->set_flashdata('error', 'Part number duplicate');
                } else {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                redirect('product_owner/edit/'.$product_owner_id);
            }
        } else {
            $this->loadThis();
        }
    }

    public function upload()
    {
        $data['global'] = $this->global;
        $data['menu_id'] ='11';
        $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
        $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
        if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
            $data['list_product_brand'] = $this->initdata_model->get_product_brand();
            $data['content'] = 'product_owner/product_owner_upload_view';
            //if script file
            //$data['script_file'] = 'js/product_owner_js';
            $data['header'] = array('title' => 'Upload Product TOS | '.$this->config->item('sitename'),
                                              'description' =>  'Upload Product TOS | '.$this->config->item('tagline'),
                                              'author' => $this->config->item('author'),
                                              'keyword' => 'Product TOS');
            $this->load->view('template/layout_main', $data);
        } else {
            // access denied
            $this->loadThis();
        }
    }


    public function upload_save()
    {
      $data['global'] = $this->global;
      $data['menu_id'] ='11';
      $data['menu_list'] = $this->initdata_model->get_menu($data['global']['menu_group_id']);
      $data['access_menu'] = $this->isAccessMenu($data['menu_list'], $data['menu_id']);
      if ($data['access_menu']['is_access']&&$data['access_menu']['is_add']) {
          $data['list_product_brand'] = $this->initdata_model->get_product_brand();
          $data['content'] = 'product_owner/product_owner_upload_view';
          //if script file

          $this->load->library('my_upload');
          $this->load->library('excel');//load PHPExcel library
          $dir ='./uploads/excel/'.date("Ym").'/';
          $dir_insert ='uploads/excel/'.date("Ym").'/';
          $file_name ='';

          $this->my_upload->upload($_FILES["file_excel"]);
          if ($this->my_upload->uploaded == true) {
              //$this->my_upload->allowed  = array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
              $this->my_upload->process($dir);

              if ($this->my_upload->processed == true) {
                  $file_name  = $this->my_upload->file_dst_name;
                  //update img
                  $this->my_upload->clean();
                  //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003
                  $objReader= PHPExcel_IOFactory::createReader('Excel2007');    // For excel 2007
                  //Set to read only
                  $objReader->setReadDataOnly(true);
                  //Load excel file
                  $objPHPExcel=$objReader->load($dir.$file_name); //load file name
                  $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel
                  $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
                  //loop from first data untill last data
                    $json_arr = "";
                  for ($i=2;$i<=$totalrows;$i++) {
                      $part_number= $objWorksheet->getCellByColumnAndRow(0, $i)->getValue(); //Excel Column 0
                      $model= $objWorksheet->getCellByColumnAndRow(1, $i)->getValue(); //Excel Column 1
                      $product_brand_id = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue(); //Excel Column 2
                      $name =$objWorksheet->getCellByColumnAndRow(3, $i)->getValue(); //Excel Column 3
                      $description =$objWorksheet->getCellByColumnAndRow(4, $i)->getValue(); //Excel Column 4
                      $full_price =$objWorksheet->getCellByColumnAndRow(5, $i)->getValue(); //Excel Column 5

                     $data_product =  array('part_number'=>$part_number, 'model'=>$model ,'product_brand_id'=>$product_brand_id ,'name'=>$name ,
                                              'description'=> $description, 'full_price'=> $full_price ,'is_error'=> 0 , 'comment' => "" );

                    $data_product = $this->product_owner_model->upload_product_owner($data_product, $this->vendorId);

                     $json_arr_t = json_encode($data_product);
                     $json_arr = $json_arr.','.$json_arr_t;

                  }
                  if($json_arr!= ""){
                    $data_product = json_decode('['.substr($json_arr,1).']');
                    $data['data_upload'] = $data_product;
                  }
                  else {
                      $data['errors'] = "No data upload.";
                  }

              } else {

                  $data['errors'] = $this->my_upload->error;
                  $this->session->set_flashdata('error',  $this->my_upload->error);

              }
          } else {
              $data['errors'] = $this->my_upload->error;
              $this->session->set_flashdata('error', $this->my_upload->error);
              echo $data['errors'];
          }

          $data['header'] = array('title' => 'Upload Product TOS | '.$this->config->item('sitename'),
                                            'description' =>  'Upload Product TOS | '.$this->config->item('tagline'),
                                            'author' => $this->config->item('author'),
                                            'keyword' => 'Product TOS');
          $this->load->view('template/layout_main', $data);
      } else {
          // access denied
          $this->loadThis();
      }

    }
}
