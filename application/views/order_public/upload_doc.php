<!DOCTYPE html>
<html lang="">
       <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Order document</title>

         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/loading-template.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/fileinput.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/home/home.css">
       </head>
       <body ng-app="mainApp" ng-controller="upload_doc_ctrl">
       <header class="header">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo base_url(); ?>">TOS</a>
            </div>
          </div><!-- /.container-fluid -->
        </nav>
      </header>
       <div class="content-wrapper">
         <section class="content">
           <div class="container">
            <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title">Order Info</h3>
               </div>
               <div class="box-body">
                 <form class="form-horizontal">
                   <div class="form-group">
                     <label class="col-md-5 control-label">Order ID:</label>
                     <div class="col-md-7">
                       <p class="form-control-static">#<?php echo $order_data['order_id']; ?></p>
                     </div>
                   </div>
                   <div class="form-group">
                     <label class="col-md-5 control-label">Email:</label>
                     <div class="col-md-7">
                       <p class="form-control-static"><?php echo $order_data['email']; ?></p>
                     </div>
                   </div>
                   <div class="form-group">
                     <label class="col-md-5 control-label">Name/Company Name:</label>
                     <div class="col-md-7">
                       <p class="form-control-static"><?php echo $order_data['company']; ?></p>
                     </div>
                   </div>
                   <div class="form-group">
                     <label class="col-md-5 control-label">Tel:</label>
                     <div class="col-md-7">
                       <p class="form-control-static"><?php echo $order_data['tel']; ?></p>
                     </div>
                   </div>
                 </form>
               </div>
            </div>
            <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Order Detail</h3>
              </div>
              <div class="box-body">
                <table class="table table-striped dataTable" role="grid">
                    <tr>
                      <th class="text-center">Part Number</th>
                      <th class="text-center">Type</th>
                      <th class="text-center">Product Name</th>
                      <th class="text-center">จังหวัด</th>
                      <th class="text-center">LB Year QTY</th>
                      <th class="text-center">QTY</th>
                      <th class="text-center">PM Time QTY</th>
                      <th class="text-center">Total</th>
                    </tr>
                    <?php foreach ($order_detail_data as $record): ?>
                    <tr>
                      <td class="text-center"><?php echo $record['part_number'] ?></td>
                      <td class="text-center"><?php echo $record['type_name'] ?></td>
                      <td class="text-center"><?php echo $record['product_name'] ?></td>
                      <td class="text-center"><?php echo $record['province_name'] ?></td>
                      <td class="text-center"><?php echo $record['lb_year_qty'] ?></td>
                      <td class="text-center"><?php echo $record['qty'] ?></td>
                      <td class="text-center"><?php echo $record['pm_time_qty'] ?></td>
                      <td class="text-center"><?php echo number_format($record['total'],0) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
              </div>
            </div>
            <div ng-if="order_status == 7" class="alert alert-success text-center" role="alert"><p>อัพโหลดเอกสารสำเร็จ โปรดรอการยืนยัน</p></div>
            <div ng-if="order_status < 6" class="alert alert-warning text-center" role="alert"><p>Order ของท่านยังไม่ถึงขั้นตอนการอัพโหลดเอกสาร</p></div>


            <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Upload Document</h3>
              </div>

              <div class="box-body">
                <form name="upload_document_form" class="form-horizontal" action="<?php echo base_url() ?>upload_document/upload_doct" method="post" role="form" enctype="multipart/form-data">
                   <div class="form-group">
                     <label class="col-md-5 control-label" for="file_path" >Document 1</label>
                     <div class="col-md-5">
                       <input id="file_path" name="file_path" class="file-loading" type="file" data-show-upload="false" data-min-file-count="1">
                       <input type="hidden" value="<?php echo $order_data['order_id']; ?>" name="order_id" id="order_id">
                       <input type="hidden" value="<?php echo $order_data['ref_id']; ?>" name="ref_id" id="ref_id">
                     </div>
                   </div>
                   <div class="form-group">
                     <label class="col-md-5 control-label" for="file_path_2" >Document 2</label>
                     <div class="col-md-5">
                       <input id="file_path_2" name="file_path_2" class="file-loading" type="file" data-show-upload="false" data-min-file-count="1">
                     </div>
                   </div>
                  <input id="btn_upload" type="submit" value="อัพโหลดเอกสาร" style="display: none;">
                </form>
              </div>
            </div>
            <p class="text-center">
              <button ng-if="order_status == 6 || order_status == 7" type="button" class="btn btn-primary btn-lg" ng-click="upload_document()">อัพโหลดเอกสาร</button>
            </p>
         </div>
        </section>
      </div>
      <footer class="main-footer text-center">
          <div class="pull-right hidden-xs">
            <b>TOS</b> | Version 1.0
          </div>
          <strong>Copyright &copy; 2017-2018 <a href="<?php echo base_url(); ?>"><?php echo $this->config->item('sitename'); ?></a>.</strong> All rights reserved.
      </footer>

        <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/validation.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/js/sweetalert2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/angular-sanitize.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/angular-animate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-1.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/ui-select/select.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/angular-filter/angular-filter-0.5.16.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/angular-loading-bar/loading-bar.js"></script>
        <script src="<?php echo base_url(); ?>assets/dist/js/ng-table.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fileinput.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/fileinput_locale_th.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- page script -->
        <?php $this->load->view("js/main_app"); ?>
        <?php $this->load->view("js/upload_doc_js"); ?>
       </body>
</html>
