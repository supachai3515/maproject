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
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ui-select/select.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/angular-loading-bar/loading-bar.css">
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

<body style="background-color: #f5f8fa;" ng-app="mainApp" ng-controller="select_product_ctrl">
    <header class="header">
      <a href="/"><h1>TOS</h1></a>
      <ul class="nav navbar-nav navbar-right"><li><a href="<?php echo base_url('login'); ?>">Login</a></li></ul>
    </header>
    <div class="container">
      <div class="step">
        <div class="step-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation">
                <a href="#" role="tab">
                  <span class="round-tab"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                </a>
              </li>
              <li role="presentation" class="active">
                  <a href="#"  role="tab">
                      <span class="round-tab"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                  </a>
              </li>
              <li role="presentation">
                  <a href="#" title="Complete">
                      <span class="round-tab">
                          <i class="fa fa-check" aria-hidden="true"></i>
                      </span>
                  </a>
              </li>
            </ul>
        </div>
      </div>
      <div class="flex-warp">
        <div class="flex flex-100">
          <div class="box-inner">
            <div class="form-horizontal" name="info_form" role="form" action="" method="post">
              <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email:</label>
                <div class="col-md-5"><p class="form-control-static">{{info.email || '-'}}</p></div>
              </div>
              <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name/Company Name:</label>
                <div class="col-md-5"><p class="form-control-static">{{info.name || '-'}}</p></div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">Tel:</label>
                <div class="col-md-5"><p class="form-control-static">{{info.tel || '-'}}</p></div>
              </div>
            </div>
            <div class="prodiucts_list" ng-repeat="(key, value) in result_cal_product | groupBy: 'product_owner_id'">
              <strong>product : {{$index+1}}</strong>
              <ul ng-repeat="(idx, val) in value | groupBy: 'is_product_owner'">
                  <li ng-repeat="p in val">
                    <div class="radio rodiucts_item">
                      <label for="product_{{key}}_{{idx}}_{{$index}}"><input type="radio" name="produc_{{key}}" id="product_{{key}}_{{idx}}_{{$index}}" ng-click="update_product_select(key, p)" ng-checked="p.selected"></label>
                      <div class="prodiucts_detail">
                        <p><strong>Type:</strong>   {{p.type_name || '-'}}</p>
                        <p><strong>Description:</strong>   {{p.type_description || '-'}}</p>
                        <p><strong>จังหวัด:</strong>   {{p.province_name || '-'}}</p>
                        <p><strong>PM Time QTY:</strong>   {{p.pm_time_qty || '-'}}</p>
                        <p><strong>LB Year QTY:</strong>   {{p.lb_year_qty || '-'}}</p>
                        <p><strong>Contract:</strong>   {{p.contract_qty || '-'}}</p>
                        <p><strong>QTY:</strong>   {{p.qty || '-'}}</p>
                        <p><strong>Total:</strong>   {{(p.total | number:0) || '-'}}</p>
                      </div>
                    </div>
                  </li>
              </ul>
            </div>
          </div>
          <p class="submit-btn text-right"><button type="button" class="btn btn-primary btn-lg" ng-click="submit_products()">Next</button></p>
        </div>
      </div>
    </div>

    <footer class="main-footer text-center">
        <div class="pull-right hidden-xs">
          <b>WISADEV</b> | Version 1.0
        </div>
        <strong>Copyright &copy; 2017-2018 <a href="<?php echo base_url(); ?>"><?php echo $this->config->item('sitename'); ?></a>.</strong> All rights reserved.
    </footer>

    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- jQuery 2.2.3 -->
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
  <?php if(isset($script_file)){echo $this->load->view($script_file); }?>
</body>
</html>
