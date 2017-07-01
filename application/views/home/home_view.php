<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="<?php echo $header['description'];?>">
  <meta name="keyword" content="<?php echo $header['keyword'];?>" />
  <meta name="author" content="<?php echo $header['author'];?>">
  <title>
    <?=$header['title'];?>
  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/home/home.css">
  <style>
    .error {
      color: red;
      font-weight: normal;
    }
  </style>
  <!-- jQuery 2.1.4 -->
  <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background-color: #f5f8fa;">
    <div class="container">
      <h2 class="text-center">Order</h2>
      <div class="flex-warp">
        <div class="flex flex-70">
          <div class="box-inner">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email</label>
                <div class="col-md-8 ">
                  <input type="email" name="email" class="form-control" id="email">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name/Company Name</label>
                <div class="col-md-8">
                  <input type="text" name="name" class="form-control" id="name">
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">Tel.</label>
                <div class="col-md-8">
                  <input type="tel" name="tel" class="form-control" id="tel">
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">Province</label>
                <div class="col-md-8">
                  <select class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($province_list as $record): ?>
                      <option value="<?php echo $record->province_code ?>"><?php echo $record->province_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">TOS</label>
                <div class="col-md-8">
                  <select class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($tos_list as $record): ?>
                      <option value="<?php echo $record->discount_of_qty_id ?>"><?php echo $record->from_number ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">Contract</label>
                <div class="col-md-8">
                  <select class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($contract_list as $record): ?>
                      <option value="<?php echo $record->discount_of_contract_id ?>"><?php echo $record->number ?> ปี</option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="flex flex-40">
          <div class="box-inner">
            <h4 class="text-center">Search and Add Products</h4>
            <form class="form-horizontal text-center" id="search_product" action="<?php echo base_url() ?>home/search_product" method="post" role="form">
                <div class="form-group">
                    <div class="form-inline">
                      <input type="text" class="form-control" id="search" name="searchProduct" value="value="<?php echo $searchText; ?>"">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div class="table-wrap">
        <div class="box-inner">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Part number</th>
                <th>Name</th>
                <th>Medel</th>
                <th>Description</th>
                <th>QTY</th>
                <th>Full price</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>test1</td>
                <td>test1</td>
                <td>test1</td>
                <td>test1</td>
                <td>test1</td>
                <td>test1</td>
              </tr>
              <tr>
                <td>test2</td>
                <td>test2</td>
                <td>test2</td>
                <td>test2</td>
                <td>test2</td>
                <td>test2</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/validation.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/ui-bootstrap-tpls-1.2.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url(); ?>assets/datepicker/locales/bootstrap-datepicker.th.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/datepicker/js/bootstrap-timepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- page script -->
  <?php $this->load->view("js/main_app"); ?>
  <?php if(isset($script_file)){echo $this->load->view($script_file); }?>
</body>
</html>
