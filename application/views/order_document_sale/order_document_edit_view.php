<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Order Document</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('order_document_sale'); ?>"> Order Document List</a></li>
      <li class="active">Edit Order Document</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content" ng-controller="order_document_internal_edit_ctrl">
      <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Edit Order Document</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <div class="col-lg-12 col-md-12">
                  <div class="form-group row">
                    <label for="descripttion" class="col-md-4 control-label text-right">Contact Detail<sup class="text-danger">*</sup></label>
                    <div class="col-md-5">
                      <textarea name="descripttion" rows="8" class="form-control" id="descripttion"  ng-model="order.descripttion" style="resize: none;" required></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                   <label class="col-md-4 control-label text-right" for="document">Document <sup class="text-danger">*</sup></label>
                   <div class="col-md-5">
                     <input id="document" name="document" class="file-loading" type="file" data-show-upload="false" data-min-file-count="1">
                   </div>
                 </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer clearfix">
                <div class="text-center">
                  <button type="button" class="btn btn-primary btn-lg" ng-click="submit_order_doc()"><i class="fa fa-cloud-upload" aria-hidden="true"></i>  Save</button>
                </div>
              </div>
            </div><!-- /.box -->
          </div>
      </div>
  </section>
  <!-- /.content -->
</div>
