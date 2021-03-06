<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit SLA
      <small>แก้ไข SLA</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('discount_sla_type'); ?>"> Edit SLA</a></li>
      <li class="active">Edit SLA</li>
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
                    <h3 class="box-title">Edit SLA : (<?php echo $discount_sla_type_data['discount_sla_type_id']; ?>)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form role="form" id="editSla" action="<?php echo base_url() ?>discount_sla_type/edit_save" method="post" role="form">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $discount_sla_type_data['name']; ?>" maxlength="128"> 
                                    <input type="hidden" value="<?php echo $discount_sla_type_data['discount_sla_type_id']; ?>" name="discount_sla_type_id" id="discount_sla_type_id" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sla_desc">Description</label>
                                    <input type="text" class="form-control" id="sla_desc"  name="sla_desc" value="<?php echo $discount_sla_type_data['description']; ?>" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sla_min">Min</label>
                                    <input type="text" class="form-control" id="sla_min" name="sla_min" value="<?php echo $discount_sla_type_data['min']; ?>" maxlength="10">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sla_max">Max</label>
                                    <div>
                                        <input type="text" class="form-control" id="sla_max"  name="sla_max" value="<?php echo $discount_sla_type_data['max']; ?>" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sla_max">Owner</label>
                                    <div style="display: block;">
                                        <label class="checkbox-inline">
                                          <input type="radio" name="is_owner" id="is_owner" value="1" <?php if ($discount_sla_type_data['is_owner'] == 1): ?>checked='checked'<?php endif; ?> /> TOS
                                        </label>
                                        <label class="checkbox-inline">
                                          <input type="radio" name="is_owner" id="is_owner" value="0" <?php if ($discount_sla_type_data['is_owner'] == 0): ?>checked='checked'<?php endif; ?> /> Vender
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <?php if ($discount_sla_type_data['is_active'] == 1): ?>
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
