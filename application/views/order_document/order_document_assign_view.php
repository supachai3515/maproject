<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Assign Orders Document to Sale
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('order_document_admin'); ?>"> Orders Document</a></li>
      <li class="active">Assign Orders Document to Sale</li>
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
                    <h3 class="box-title">Assign Orders Document to Sale</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo base_url() ?>order_document_admin/assign_save" method="post" id="assignUser" role="form">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Sale User</label>
                                    <input type="hidden" value="<?php echo $order_document_detail['order_document_id']; ?>" name="order_document_id" id="order_document_id" />
                                    <select class="form-control" id="user" name="user">
                                        <option value="0">Select User</option>

                                        <?php
                                        if (!empty($user_sale)) {
                                            foreach ($user_sale as $rl) {
                                                ?>
                                                <option value="<?php echo $rl['userId']; ?>" <?php if ($rl['userId'] == $order_document_detail['assign_to']) {
                                                    echo "selected=selected";
                                                } ?>><?php echo $rl['name']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
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
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">  Order Document Detail : #<?php echo $order_document_detail['order_document_id']; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
              <div class="box box-solid">
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">Contact Detail</th>
                      <th class="text-center">View File</th>
                      <th class="text-center">Assign by</th>
                      <th class="text-center">Assign to</th>
                      <th class="text-center">Date</th>
                      <th class="text-center">Active</th>
                    </tr>
                    <tr>
                      <td class="text-center"><?php echo $order_document_detail['order_document_id'] ?></td>
                      <td class="text-center"><?php echo $order_document_detail['order_description'] ?></td>
                      <td class="text-center"><a class="btn" href="<?php echo base_url().$order_document_detail['document_path']; ?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i></a></td>
                      <td class="text-center">
                        <?php if (isset($order_document_detail['assign_by_name'])): ?>
                          <?php echo $order_document_detail['assign_by_name'] ?><br>
                          <span><i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($order_document_detail['assign_by_date']));?></span>
                          <?php else: ?>
                            -
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <?php if (isset($order_document_detail['assign_to'])): ?>
                          <?php echo $order_document_detail['assign_to_name'] ?><br>
                          <span><i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($order_document_detail['assign_to_date']));?></span>
                          <?php else: ?>
                            -
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <?php if (isset($order_document_detail['create_date'])): ?>
                          <span>สร้าง : <i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($order_document_detail['create_date']));?></span><br>
                        <?php endif; ?>
                        <?php if (isset($order_document_detail['modified_date'])): ?>
                          <span>แก้ไข : <i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($order_document_detail['modified_date']));?></span>
                        <?php endif; ?>
                      <td class="text-center">
                          <?php if ($order_document_detail['is_active']=="1"): ?>
                              <span><i class="fa fa-check"></i></span>
                          <?php else: ?>
                              <span class="text-danger"><i class="fa fa-times"></i></span>
                          <?php endif ?>
                      </td>
                    </tr>
                  </table>
              </div><!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
