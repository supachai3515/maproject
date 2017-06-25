<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit QTY
      <small>แก้ไข QTY</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('discount_of_qty'); ?>"> QTY</a></li>
      <li class="active">Edit QTY</li>
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
                    <h3 class="box-title">Edit QTY : (<?php echo $discount_of_qty_data['discount_of_qty_id']; ?>)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form role="form" id="edit_discount_of_qty" action="<?php echo base_url() ?>discount_of_qty/edit_save" method="post" role="form">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="name">From Number</label>
                                    <input type="text" class="form-control" id="from_number" name="from_number" value="<?php echo $discount_of_qty_data['from_number']; ?>" maxlength="11">
                                    <input type="hidden" value="<?php echo $discount_of_qty_data['discount_of_qty_id']; ?>" name="discount_of_qty_id" id="discount_of_qty_id" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="to_number">To Number</label>
                                    <input type="text" class="form-control" id="to_number"  name="to_number" value="<?php echo $discount_of_qty_data['to_number']; ?>" maxlength="11">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="text" class="form-control" id="discount"  name="discount" value="<?php echo $discount_of_qty_data['discount']; ?>" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description"  name="description" value="<?php echo $discount_of_qty_data['description']; ?>" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <?php if ($discount_of_qty_data['is_active'] == 1): ?>
                                      <input type="checkbox"  id="is_active"  name="is_active" value="1" checked> ใช้งาน
                                    <?php else: ?>
                                      <input type="checkbox"  id="is_active"  name="is_active" value="1"> ใช้งาน
                                    <?php endif; ?>
                                  </label>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Submit" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if($error)
                {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
            <?php
                $success = $this->session->flashdata('success');
                if($success)
                {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>

            <div class="row">
                <div class="col-md-12">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
