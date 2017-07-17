<!DOCTYPE html>
<html lang="">
       <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>special_price</title>

         <!-- Bootstrap CSS -->
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
         <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/home/home.css">
         <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->
       </head>
       <body>
        <h1 class="text-center">Special Price</h1>
        <div class="container">
          <?php
          $success = $this->session->flashdata('success');
          $error = $this->session->flashdata('error');
          ?>
          <?php if ($success): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $success; ?>
        </div>

            <?php endif; ?>
           <?php if ($error): ?>
               <div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <?php echo $error; ?>
               </div>
            <?php endif; ?>
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
                            <td>Part Number :</td>
                            <td><?php echo $record['part_number'] ?></td>
                          </tr>
                          <tr>
                            <td>Type :</td>
                            <td><?php echo $record['type_name'] ?></td>
                          </tr>
                          <tr>
                            <td>Product Name :</td>
                            <td><?php echo $record['product_name'] ?></td>
                          </tr>
                          <tr>
                            <td>จังหวัด :</td>
                            <td><?php echo $record['province_name'] ?></td>
                          </tr>
                          <tr>
                            <td>LB Year QTY :</td>
                            <td><?php echo $record['lb_year_qty'] ?></td>
                          </tr>
                          <tr>
                            <td>QTY :</td>
                            <td><?php echo $record['qty'] ?></td>
                          </tr>
                          <tr>
                            <td>PM Time QTY :</td>
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
                  <p class="text-center"><button type="button" class="btn btn-primary btn-lg">Special Price</button></p>
                </div>
              </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <!-- Your own javascript -->
       </body>
</html>
