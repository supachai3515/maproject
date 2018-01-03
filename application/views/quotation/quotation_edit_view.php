<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Edit Quotation</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('quotation'); ?>"> Quotation</a></li>
      <li class="active">Edit Quotation</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content" ng-controller="quotation_ctrl">
    <form name="edit_quotation_form" method="post" role="form">
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
                        <input type="text" class="form-control" id="ow_company_name_th" name="ow_company_name_th" ng-model="quotation_data.ow_company_name_th" maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Company Name EN</label>
                        <input type="text" class="form-control" id="ow_company_name_en" name="ow_company_name_en" ng-model="quotation_data.ow_company_name_en"  maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" id="ow_address" name="ow_address" ng-model="quotation_data.ow_address" maxlength="255" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Contact Description</label>
                        <input type="text" class="form-control" id="ow_contact_desc" name="ow_contact_desc" ng-model="quotation_data.ow_contact_desc" maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tax</label>
                        <input type="text" class="form-control" id="ow_tax" name="ow_tax" ng-model="quotation_data.ow_tax" maxlength="20" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Description</label>
                        <input type="text" class="form-control" id="ow_desc" name="ow_desc" ng-model="quotation_data.ow_desc" maxlength="255" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Logo</label>
                        <p><img src="<?php echo base_url(); ?>{{quotation_data.ow_logo}}" alt="" style="width: 100%; border: 1px solid #d2d6de; padding: 5px;"></p>
                        <input id="ow_logo" name="ow_logo" type="file">
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
                        <input type="text" class="form-control" id="cust_name" name="cust_name" ng-model="quotation_data.ct_name" maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Quotation No.</label>
                        <input type="text" class="form-control" id="quotation_no" name="quotation_no" ng-model="quotation_data.quotation_doc_no" maxlength="11" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Company</label>
                        <input type="text" class="form-control" id="cust_company" name="cust_company" ng-model="quotation_data.ct_company" maxlength="128" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" id="cust_address" name="cust_address" ng-model="quotation_data.ct_address" maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">E-mail</label>
                        <input type="text" class="form-control" id="cust_email" name="cust_email" ng-model="quotation_data.ct_email" maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Date</label>
                        <input type="text" class="form-control" id="quotation_date" name="quotation_date" ng-model="quotation_data.create_date" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Tel</label>
                        <input type="text" class="form-control" id="cust_tel" name="cust_tel" ng-model="quotation_data.ct_tel" maxlength="11" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Fax</label>
                        <input type="text" class="form-control" id="cust_fax" name="cust_fax" ng-model="quotation_data.ct_fax" maxlength="255" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Page</label>
                        <input type="text" class="form-control" id="quotation_page" ng-model="quotation_data.quotation_page" name="quotation_page" maxlength="16" required>
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
                        <input type="text" class="form-control" id="quotation_subject" name="quotation_subject" ng-model="quotation_data.quotation_subject" maxlength="128" required>
                    </div>
                </div>
            </div>
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
                <div ng-repeat="(key, value) in quotation_detail_data track by key">
                  <div class="row">
                    <div class="col-md-1 text-center">
                      <span>{{value.line_no}}</span>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                          <input type="text" class="form-control required" id="qt_part_number_{{key}}" name="qt_part_number_{{key}}" ng-model="value.part_number" maxlength="64" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                          <input type="text" class="form-control required" id="qt_description_{{key}}" name="qt_description_{{key}}" ng-model="value.description" maxlength="255" required>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                          <input type="text" class="form-control required" id="qt_ma_type_{{key}}" name="qt_ma_type_{{key}}" ng-model="value.name" maxlength="255" required>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                          <input type="text" class="form-control required" id="qt_unit_{{key}}" name="qt_unit_{{key}}" ng-model="value.qty" required>
                      </div>
                    </div>
                    <div class="col-md-1">
                      <div class="form-group">
                          <input type="text" class="form-control required" id="qt_unit_price_{{key}}" name="qt_unit_price_{{key}}" ng-model="value.price" maxlength="11" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                          <input type="text" class="form-control required" id="qt_amount_{{key}}" name="qt_amount_{{key}}" ng-model="value.total" maxlength="11" ng-change="cal_quotation(value.total)" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                          <input type="text" class="form-control required" id="qt_total_{{key}}" name="qt_total_{{key}}" ng-model="value.cost_total" maxlength="128" required>
                      </div>
                    </div>
                  </div>
                </div>
          </div><!-- /.box-body -->
          <div class="box-footer form-horizontal">
            <div class="col-md-6"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-3 control-label">SUB TOTAL :</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{quotation_data.sub_total}}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">DISCOUNT :</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{quotation_data.discount}}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">VAT 7 % :</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{quotation_data.vat}}</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">TOTAL :</label>
                <div class="col-md-9">
                  <p class="form-control-static">{{quotation_data.total}}</p>
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
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="price_validity">Price Validity</label>
                        <textarea style="resize: none;" class="form-control" id="price_validity" name="price_validity" rows="3" ng-model="quotation_data.price_validity" ></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="payment_term">Payment Term</label>
                        <textarea style="resize: none;" class="form-control" id="payment_term" name="payment_term" rows="3" ng-model="quotation_data.payment_term"></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="delivery_date">Delivery Date</label>
                        <input type="text" class="form-control" id="delivery_date" name="delivery_date" ng-model="quotation_data.delivery_date" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="terms_type">Type</label>
                        <textarea style="resize: none;" class="form-control" id="terms_type" name="terms_type" rows="3" ng-model="quotation_data.terms_type"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sale_manager_name">Sale Manager Name</label>
                        <input type="text" class="form-control" id="sale_manager_name" name="sale_manager_name" ng-model="quotation_data.sale_manager_name" maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="sale_name">Sale Name</label>
                        <input type="text" class="form-control" id="sale_name" name="sale_name" ng-model="quotation_data.sale_name" maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sale_position">Sale Position</label>
                        <input type="text" class="form-control" id="sale_position" name="sale_position" ng-model="quotation_data.sale_position" maxlength="128" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sale_email">Sale Email</label>
                        <input type="text" class="form-control" id="sale_email" name="sale_email" ng-model="quotation_data.sale_email" maxlength="128" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sale_tel">Sale Tel</label>
                        <input type="text" class="form-control" id="sale_tel" name=" sale_tel" ng-model="quotation_data.sale_tel" maxlength="11" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sale_manager_signature">Sale Manager Signature</label>
                        <!-- <input type="text" class="form-control" id="sale_manager_signature" name="sale_manager_signature" ng-model="quotation_data.sale_manager_signature" maxlength="128" required> -->
                        <p><img src="<?php echo base_url(); ?>{{quotation_data.sale_manager_signature}}" alt="" style="width: 100%; border: 1px solid #d2d6de; padding: 5px;"></p>
                        <input id="sale_manager_signature" name="sale_manager_signature" type="file">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sale_signature">Sale Signature</label>
                        <!-- <input type="text" class="form-control" id="sale_signature" name="sale_signature" ng-model="quotation_data.sale_signature" maxlength="128" required> -->
                        <p><img src="<?php echo base_url(); ?>{{quotation_data.sale_signature}}" alt="" style="width: 100%; border: 1px solid #d2d6de; padding: 5px;"></p>
                        <input id="sale_signature" name="sale_signature" type="file">
                    </div>
                </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer text-center">
            <button type="button" class="btn btn-primary btn-lg" ng-click="save_quotation()"><i class="fa fa-floppy-o" aria-hidden="true"></i>  Save</button>
          </div><!-- /.box-footer -->
      </div><!-- /.box -->
      </div>
    </div>
    </form>
  </section>
  <!-- /.content -->
</div>
