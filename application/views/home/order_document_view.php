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
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/loading-template.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/fileinput.css">
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

<body ng-app="mainApp" ng-controller="order_document_ctrl">
    <header class="header">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">TOS</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <p class="navbar-text navbar-right"><?php echo $sale_user;?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('login'); ?>">Backend <i class="fa fa-arrow-right" aria-hidden="true"></i></a></p>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
    <div class="content-wrapper">
      <section class="content">
        <div class="container">
          <form class="form-horizontal" name="document_form" action="" method="post">
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Order Info</h3>
            </div>
            <div class="box-body">
                  <div class="form-group">
                    <label for="descripttion" class="col-md-4 control-label">Contact Detail<sup class="text-danger">*</sup></label>
                    <div class="col-md-5">
                      <textarea name="descripttion" rows="8" class="form-control" id="descripttion"  ng-model="order.descripttion" style="resize: none;" required></textarea>
                    </div>
                  </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Document</h3>
            </div>
            <div class="box-body">
               <div class="form-group">
                 <label class="col-md-4 control-label" for="document">Document <sup class="text-danger">*</sup></label>
                 <div class="col-md-5">
                   <input id="document" name="document" class="file-loading" type="file" data-show-upload="false" data-min-file-count="1">
                 </div>
               </div>
            </div>
          </div>
          <div class="text-center">
            <button type="button" class="btn btn-primary btn-lg" ng-click="submit_order_doc()"><i class="fa fa-cloud-upload" aria-hidden="true"></i>  Upload</button>
          </div>
          </form>
        </div>
      </section>
    </div>

    <footer class="main-footer text-center">
        <div class="pull-right hidden-xs">
          <b>TOS</b> | Version 1.0
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
  <script src="<?php echo base_url(); ?>assets/js/fileinput.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/fileinput_locale_th.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- page script -->
  <?php $this->load->view("js/main_app"); ?>
  <?php if(isset($script_file)){echo $this->load->view($script_file); }?>
</body>
</html>
