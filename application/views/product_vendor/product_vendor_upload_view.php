<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Upload Product Vendor
      <small>Upload สินค้า Vendor</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('product_vendor'); ?>"> Product Vendor</a></li>
      <li class="active">Upload Product Vendor</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Upload Product vendor </h3>
                    <a type="button" class="btn btn-info" href="<?php echo base_url() ?>uploads/excel/201707/product_vendor_template.xlsx"><i class="ion ion-ios-cloud-download-outline"></i> Template</a>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="addUser" action="<?php echo base_url() ?>product_vendor/upload_save" method="post" role="form" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                <label for="file_excel">File product Vendor</label>
                                <input type="file" id="file_excel" name="file_excel" required="true">
                                <p class="help-block">File Excel 2007 .xlsx กรณี กำหนด product_vendor_id  = 0 หมายถึงสร้างสินค้าใหม่ ถ้ากำหนด product_vendor_id ตามระบบ ระบบจะทำการ อับเดตให้</p>
                              </div>
                          </div>

                      </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="upload" />
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                    ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php
                } ?>
            <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                    ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php
                } ?>

            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php if (isset($data_upload)): ?>
          <div class="box">
            <div class="box-body table-responsive no-padding">
              <table class="table table-striped">
                  <tr>
                    <th>Product vendor id</th>
                    <th>Model</th>
                    <th>Part number</th>
                    <th>description</th>
                    <th>Brand</th>
                    <th>Dealer price</th>
                    <th>บันทึก</th>
                  </tr>
                  <?php foreach ($data_upload as $record): ?>
                  <tr>
                    <td><?php echo $record->product_vendor_id ?></td>
                    <td><?php echo $record->model ?></td>
                    <td><?php echo $record->part_number ?></td>
                    <td><?php echo $record->description ?></td>
                    <td><?php echo $record->product_brand_id ?></td>
                    <td class="text-right"><?php echo number_format($record->dealer_price, 2); ?></td>
                    <td class="text-center"><?php echo $record->comment ?></td>
                    <td class="text-center">
                        <?php if ($record->is_error == 0): ?>
                            <span><i class="fa fa-check"></i> สำเร็จ</span>
                        <?php else: ?>
                            <span class="text-danger"><i class="fa fa-times"></i> ผิดผลาด</span>
                        <?php endif ?>
                    </td>

                  </tr>
                  <?php endforeach; ?>
                </table>
            </div><!-- /.box-body -->
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
