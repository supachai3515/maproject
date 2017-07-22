<!DOCTYPE html>
<html lang="">
       <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>special_price</title>

         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/loading-template.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/home/home.css">
       </head>
       <body ng-app="mainApp" ng-controller="special_price_ctrl">
        <h1 class="text-center">Special Price</h1>
        <div class="container">
          <div class="step">
            <div class="step-inner">
                <div class="connecting-line"></div>
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" ng-class="{'active': special_status == 1}">
                    <a href="#" role="tab">
                      <span class="round-tab"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></i></span>
                    </a>
                    <span>ขอราคาพิเศษ</span>
                  </li>
                  <li role="presentation" ng-class="{'active': special_status == 2}">
                      <a href="#"  role="tab">
                          <span class="round-tab"><i class="fa fa-tasks" aria-hidden="true"></i></span>
                      </a>
                      <span>รอการตรวจสอบ</span>
                  </li>
                  <li role="presentation" ng-class="{'active': special_status == 3}">
                      <a href="#" title="Complete">
                          <span class="round-tab"><i class="fa fa-check" aria-hidden="true"></i></span>
                      </a>
                      <span>สำเร็จ</span>
                  </li>
                </ul>
            </div>
          </div>
            <div class="flex-warp">
              <div class="flex flex-100">
                <div class="box-inner">
                  <div class="order_box">
                    <h3 class="header_order">Order Info</h3>
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label class="col-md-5 control-label">Email :</label>
                        <div class="col-md-7">
                          <p class="form-control-static"><?php echo $order_data['email']; ?></p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label">Name/Company Name :</label>
                        <div class="col-md-7">
                          <p class="form-control-static"><?php echo $order_data['company']; ?></p>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-5 control-label">Tel :</label>
                        <div class="col-md-7">
                          <p class="form-control-static"><?php echo $order_data['tel']; ?></p>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="order_box">
                    <h3 class="header_order">Order Detail</h3>
                    <?php foreach ($order_detail_data as $record): ?>
                    <div class="order_detail">
                      <div class="order_title">
                        <h4>Product: <span class="text-primary"><?php echo $record['product_name'] ?></span></h4>
                      </div>
                      <table class="table table-striped table-order">
                        <tbody>
                          <tr>
                            <td>Part Number:</td>
                            <td><?php echo $record['part_number'] ?></td>
                          </tr>
                          <tr>
                            <td>Type:</td>
                            <td><?php echo $record['type_name'] ?></td>
                          </tr>
                          <tr>
                            <td>Product Name:</td>
                            <td><?php echo $record['product_name'] ?></td>
                          </tr>
                          <tr>
                            <td>จังหวัด:</td>
                            <td><?php echo $record['province_name'] ?></td>
                          </tr>
                          <tr>
                            <td>LB Year QTY:</td>
                            <td><?php echo $record['lb_year_qty'] ?></td>
                          </tr>
                          <tr>
                            <td>QTY:</td>
                            <td><?php echo $record['qty'] ?></td>
                          </tr>
                          <tr>
                            <td>PM Time QTY:</td>
                            <td><?php echo $record['pm_time_qty'] ?></td>
                          </tr>
                          <tr>
                            <td colspan="2" class="total-num"><strong>Total:</strong> <?php echo number_format($record['total'],0) ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <?php endforeach; ?>
                  </div>
                  <p class="text-center"><button type="button" class="btn btn-primary btn-lg" ng-click="get_special_price()">ขอราคาพิเศษ</button></p>
                </div>
              </div>
            </div>
        </div>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- page script -->
        <?php $this->load->view("js/main_app"); ?>
        <?php $this->load->view("js/special_price_js"); ?>
       </body>
</html>
