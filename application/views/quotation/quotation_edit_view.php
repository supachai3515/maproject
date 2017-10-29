<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Edit Quotation</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('quotation'); ?>"> Quotation</a></li>
      <li class="active">Edit Quotation</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Quotation Header</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Company Name TH</label>
                        <input type="text" class="form-control" id="ow_company_name_th" name="ow_company_name_th"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Company Name EN</label>
                        <input type="text" class="form-control" id="ow_company_name_en" name="ow_company_name_en"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" id="ow_address" name="ow_address"  maxlength="255" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Contact Description</label>
                        <input type="text" class="form-control" id="ow_contact_desc" name="ow_contact_desc"  maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tax</label>
                        <input type="text" class="form-control" id="ow_tax" name="ow_tax"  maxlength="20" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Description</label>
                        <input type="text" class="form-control" id="ow_desc" name="ow_desc"  maxlength="255" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Logo</label>
                        <input type="text" class="form-control" id="ow_logo" name="ow_logo" required>
                    </div>
                </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">

          </div><!-- /.box-footer -->
      </div><!-- /.box -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Quotation Info</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="cust_name" name="cust_name"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Quotation No.</label>
                        <input type="text" class="form-control" id="quotation_no" name="quotation_no"  maxlength="11" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Company</label>
                        <input type="text" class="form-control" id="cust_company" name="cust_company"  maxlength="128" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" id="cust_address" name="cust_address"  maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">E-mail</label>
                        <input type="text" class="form-control" id="cust_email" name="cust_email"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Date</label>
                        <input type="text" class="form-control" id="quotation_date" name="quotation_date" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tel</label>
                        <input type="text" class="form-control" id="cust_tel" name="cust_tel"  maxlength="11" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Fax</label>
                        <input type="text" class="form-control" id="cust_fax" name="cust_fax"  maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Page</label>
                        <input type="text" class="form-control" id="quotation_page" name="quotation_page"  maxlength="16" required>
                    </div>
                </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">

          </div><!-- /.box-footer -->
      </div><!-- /.box -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Quotation Detail</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Subject</label>
                        <input type="text" class="form-control" id="quotation_subject" name="quotation_subject"  maxlength="128" required>
                    </div>
                </div>
            </div>
            <form action="" method="post" role="form">
              <div ng-repeat="(key, order) in orders_detail">
                <div class="row">
                  <div class="col-md-1 text-center">
                    <label>#</label>
                  </div>
                  <div class="col-md-2 text-center">
                    <label>Part Number</label>
                  </div>
                  <div class="col-md-2 text-center">
                      <label>Description</label>
                  </div>
                  <div class="col-md-1 text-center">
                        <label>MA-Type</label>
                  </div>
                  <div class="col-md-1 text-center">
                        <label>Unit</label>
                  </div>
                  <div class="col-md-1 text-center">
                        <label>Unit Price</label>
                  </div>
                  <div class="col-md-2 text-center">
                        <label>Amount</label>
                  </div>
                  <div class="col-md-2 text-center">
                        <label>Cost Total</label>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-1 text-center">
                    <span ng-bind="order.line_number"></span>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_part_number_{{key}}" name="qt_part_number_{{key}}" ng-model="order.part_number" maxlength="64" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_description_{{key}}" name="qt_description_{{key}}" ng-model="order.product_description" maxlength="255" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_ma_type_{{key}}" name="qt_ma_type_{{key}}" ng-model="order.type_name" maxlength="255" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_unit_{{key}}" name="qt_unit_{{key}}" ng-model="order.qty" maxlength="3" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_unit_price_{{key}}" name="qt_unit_price_{{key}}" ng-model="order.full_price" maxlength="11" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group" ng-init="order.amount = order.full_price*order.qty">
                        <input type="text" class="form-control required" id="qt_amount_{{key}}" name="qt_amount_{{key}}" ng-model="order.amount" maxlength="11" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_total_{{key}}" name="qt_total_{{key}}" ng-model="order.total" maxlength="128" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1 text-center"></div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_pm_part_number_{{key}}" name="qt_pm_part_number_{{key}}" ng-model="order.part_number" maxlength="64" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_pm_description_{{key}}" name="qt_pm_description_{{key}}" ng-model="order.product_description" maxlength="255" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group text-center">
                        <span>PM</span>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_pm_unit_{{key}}" name="qt_pm_unit_{{key}}" ng-model="order.pm_time_qty" maxlength="3" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_pm_unit_price_{{key}}" name="qt_pm_unit_price_{{key}}" ng-model="order.pm_time_value" maxlength="11" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group" ng-init="order.pm_amount = order.pm_time_value*order.pm_time_qty">
                        <input type="text" class="form-control required" id="qt_pm_amount_{{key}}" name="qt_pm_amount_{{key}}" ng-model="order.pm_amount" maxlength="11" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group" ng-init="order.pm_total = order.pm_time_value*order.pm_time_qty">
                        <input type="text" class="form-control required" id="qt_pm_total_{{key}}" name="qt_pm_total_{{key}}" ng-model="order.pm_total" maxlength="128" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-1 text-center"></div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_lb_part_number_{{key}}" name="qt_lb_part_number_{{key}}" ng-model="order.part_number" maxlength="64" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_lb_description_{{key}}" name="qt_description_{{key}}" ng-model="order.product_description" maxlength="255" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group text-center">
                        <span>LB</span>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_lb_year_qty_{{key}}" name="qt_lb_year_qty_{{key}}" ng-model="order.lb_year_qty" maxlength="3" required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control required" id="qt_lb_year_value_{{key}}" name="qt_lb_year_value_{{key}}" ng-model="order.lb_year_value" maxlength="11" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group" ng-init="order.lb_amount = order.lb_year_value*order.lb_year_qty">
                        <input type="text" class="form-control required" id="qt_lb_amount_{{key}}" name="qt_lb_amount_{{key}}" ng-model="order.lb_amount" maxlength="11" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group" ng-init="order.lb_total = order.lb_year_value*order.lb_year_qty">
                        <input type="text" class="form-control required" id="qt_lb_total_{{key}}" name="qt_lb_total_{{key}}" ng-model="order.lb_total" maxlength="128" required>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div><!-- /.box-body -->
          <div class="box-footer form-horizontal">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail3" class="col-md-3 control-label">SUB TOTAL :</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{subTotalOrder() | number : '2'}}</p>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-md-3 control-label">DISCOUNT :</label>
                <div class="col-md-9">
                  <p class="form-control-static">-</p>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-md-3 control-label">VAT 7 % :</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{subTotalVat()}}</p>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-md-3 control-label">TOTAL :</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{orderTotal()}}</p>
                </div>
              </div>
            </div>
          </div>
      </div><!-- /.box -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title">Quotation Footer</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Price Validity</label>
                        <input type="text" class="form-control" id="price_validity" name="price_validity"  maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Payment Term</label>
                        <input type="text" class="form-control" id="payment_term" name="payment_term"  maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Delivery Date</label>
                        <input type="text" class="form-control" id="delivery_date" name="delivery_date" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Type</label>
                        <input type="text" class="form-control" id="terms_type" name="terms_type"  maxlength="255" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Manager Name</label>
                        <input type="text" class="form-control" id="sale_manager_name" name="sale_manager_name"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Manager Position</label>
                        <input type="text" class="form-control" id="sale_manager_position" name="sale_manager_position"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Manager Signature</label>
                        <input type="text" class="form-control" id="sale_manager_signature" name="sale_manager_signature"  maxlength="128" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Name</label>
                        <input type="text" class="form-control" id="sale_name" name="sale_name"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Position</label>
                        <input type="text" class="form-control" id="sale_position" name="sale_position"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Signature</label>
                        <input type="text" class="form-control" id="sale_signature" name="sale_signature"  maxlength="128" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Email</label>
                        <input type="text" class="form-control" id="sale_email" name="sale_email"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Sale Tel</label>
                        <input type="text" class="form-control" id="  sale_tel" name="  sale_tel"  maxlength="11" required>
                    </div>
                </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer text-center">
            <button type="button" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
          </div><!-- /.box-footer -->
      </div><!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
