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

<body style="background-color: #f5f8fa;" ng-app="mainApp" ng-controller="home_ctrl">
    <header class="header">
      <a href="/"><h1>TOS</h1></a>
      <ul class="nav navbar-nav navbar-right"><li><a href="<?php echo base_url('login'); ?>">Login</a></li></ul>
    </header>
    <div class="container">
      <div class="step">
        <div class="step-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#" role="tab">
                  <span class="round-tab"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                </a>
              </li>
              <li role="presentation">
                  <a href="#"  role="tab">
                      <span class="round-tab"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                  </a>
              </li>
              <li role="presentation">
                  <a href="#" title="Complete">
                      <span class="round-tab"><i class="fa fa-check" aria-hidden="true"></i></span>
                  </a>
              </li>
            </ul>
        </div>
      </div>
      <div class="flex-warp">
        <div class="flex flex-100">
          <div class="box-inner">
            <form class="form-horizontal" name="info_form" role="form" action="" method="post">
              <div class="form-group">
                <label for="email" class="col-md-4 control-label">Email<sup class="text-danger">*</sup></label>
                <div class="col-md-5" ng-class="{'has-error': info_form.$submitted && info_form.email.$invalid}">
                  <input type="email" name="email" class="form-control" id="email" ng-model="info.email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-md-4 control-label">Name/Company Name <sup class="text-danger">*</sup></label>
                <div class="col-md-5" ng-class="{'has-error': (info_form.$submitted && info_form.name.$invalid)}">
                  <input type="text" name="name" class="form-control" id="name" ng-model="info.name" required>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">Tel. <sup class="text-danger">*</sup></label>
                <div class="col-md-5" ng-class="{'has-error': (info_form.$submitted && info_form.tel.$invalid)}">
                  <input type="tel" name="tel" class="form-control" id="tel" ng-model="info.tel" required>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">Province <sup class="text-danger">*</sup></label>
                <div class="col-md-5" ng-class="{'has-error': (info_form.$submitted && info_form.province.$invalid)}">
                  <select class="form-control" name="province" ng-model="order.province" required>
                    <option value="">Select</option>
                    <?php foreach ($province_list as $record): ?>
                      <option value="<?php echo $record->province_id ?>"><?php echo $record->province_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">PM <sup class="text-danger">*</sup></label>
                <div class="col-md-5" ng-class="{'has-error': (info_form.$submitted && info_form.pm.$invalid)}">
                  <select class="form-control" name="pm" ng-model="order.pm" required>
                    <option value="">Select</option>
                    <option value="{{pm}}" ng-repeat="pm in pm_list">{{pm}}</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="tel" class="col-md-4 control-label">Contract <sup class="text-danger">*</sup></label>
                <div class="col-md-5" ng-class="{'has-error': (info_form.$submitted && info_form.contract.$invalid)}">
                  <select class="form-control" name="contract" ng-model="order.contract" required>
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
      </div>
      <div class="flex flex-100">
        <div class="box-inner">
          <form class="form-horizontal" nrole="form" action="" method="">
            <div class="form-group">
              <label for="tel" class="col-md-4 control-label">Search Product</label>
              <div class="col-md-5">
                <div class="input-group">
                  <ui-select ng-model="products.selected" theme="bootstrap" on-select="add_product_list($item)" search-enabled="!info_form.$invalid" ng-disabled="info_form.$invalid">
                    <ui-select-match placeholder="Select or search a products">{{$select.selected.name}}</ui-select-match>
                    <ui-select-choices repeat="pd in products" refresh="input_Select($select.search)" refresh-delay="300">
                      <span ng-bind-html="pd.part_number | highlight: $select.search"></span><span ng-bind-html="pd.name | highlight: $select.search"></span>
                    </ui-select-choices>
                  </ui-select>
                  <span class="input-group-btn">
                    <button type="button" ng-click="search_product()" class="btn btn-default" ng-disabled="info_form.$invalid">
                      <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </span>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="table-wrap">
        <div class="box-inner">
          <p class="text-right"><button type="button" class="btn btn-info" ng-click="add_product()"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;เพิ่มสินค้า</button></p>
          <table class="table table-striped">
            <thead>
              <tr>
                <th class="col-md-2">Part number</th>
                <th class="col-md-2">Name</th>
                <th class="col-md-2">Medel</th>
                <th class="col-md-1">QTY</th>
                <th class="col-md-2">Province</th>
                <th class="col-md-1">PM</th>
                <th class="col-md-1">Contract</th>
                <th class="col-md-1">Delete</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="(idx, p) in selected_products track by idx">
                <td class="text-center">{{p.part_number || '-'}}</td>
                <td>{{p.name || '-'}}</td>
                <td class="text-center">{{p.model || '-'}}</td>
                <td>
                  <input class="form-control text-center" type="number" name="selected_model_{{idx}}" value="{{p.qty}}" min="1">
                </td>
                <td>
                  <select class="form-control" name="selected_province_{{idx}}">
                    <?php foreach ($province_list as $record): ?>
                      <option ng-selected="p.province == <?php echo $record->province_id ?>" value="<?php echo $record->province_id ?>"><?php echo $record->province_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td>
                  <select class="form-control" name="selected_pm_{{idx}}">
                    <option value="p.pm" ng-repeat="pm in pm_list" ng-selected="p.pm == pm">{{pm}}</option>
                  </select>
                </td>
                <td>
                  <select class="form-control" name="selected_contract_{{idx}}">
                    <?php foreach ($contract_list as $record): ?>
                      <option ng-selected="p.contract == <?php echo $record->discount_of_contract_id ?>" value="<?php echo $record->discount_of_contract_id ?>"><?php echo $record->number ?> ปี</option>
                    <?php endforeach; ?>
                  </select>
                </td>
                <td class="text-center"><i class="fa fa-minus-circle text-danger del-icon" aria-hidden="true" ng-click="remove_product_list(idx)"></i></td>
              </tr>
              <tr ng-if="!selected_products.length">
                <td colspan="8" class="text-center">-</td>
              </tr>
            </tbody>
          </table>
        </div>
        <p class="submit-btn text-right"><button type="button" class="btn btn-primary btn-lg" ng-click="submit_products()">Next</button></p>
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
