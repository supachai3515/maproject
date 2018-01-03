<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Assign to Sale
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('orders'); ?>"> Orders</a></li>
      <li class="active">Assign to Sale</li>
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
                    <h3 class="box-title">Assign to Sale</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form role="form" action="<?php echo base_url() ?>orders/assign_save" method="post" id="editUser" role="form">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role">Sale User</label>
                                    <input type="hidden" value="<?php echo $orders_data['order_id']; ?>" name="order_id" id="order_id" />
                                    <select class="form-control" id="user" name="user">
                                        <option value="0">Select User</option>

                                        <?php
                                        if (!empty($user_sale)) {
                                            foreach ($user_sale as $rl) {
                                                ?>
                                                <option value="<?php echo $rl['userId']; ?>" <?php if ($rl['userId'] == $orders_data['assign_to']) {
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
                    <h3 class="box-title">  View info orders : (<?php echo $orders_data['status_name']; ?>)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
              <div class="box box-solid">
                <div class="box-header with-border">
                  <i class="fa fa-file-text-o"></i>
                  <h3 class="box-title">สถานะ <?php echo $orders_data['status_name']; ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <dl class="dl-horizontal">
                    <dt>รหัส</dt>
                    <dd>#<?php echo $orders_data['order_id']; ?></dd>
                    <dt>Company</dt>
                    <dd><?php echo $orders_data['company']; ?></dd>
                    <dt>email</dt>
                    <dd><?php echo $orders_data['email']; ?></dd>
                    <dt>tel</dt>
                    <dd><?php echo $orders_data['tel']; ?></dd>
                    <dt>qty</dt>
                    <dd><?php echo $orders_data['qty']; ?></dd>
                    <dt>total</dt>
                    <dd><?php echo number_format($orders_data['total'], 0); ?></dd>
                    <dt>Assign by</dt>
                    <dd><?php echo $orders_data['assign_by_name']; ?></dd>
                    <dd><span><i class="fa fa-calendar"></i> <?php if (isset($orders_data['assign_by_date'])) {
                    echo date("d-m-Y H:i", strtotime($orders_data['assign_by_date']));
                }?></span></dd>
                    <dt>Assign to</dt>
                    <dd><?php echo $orders_data['assign_to_name']; ?></dd>
                    <dd><span><i class="fa fa-calendar"></i> <?php if (isset($orders_data['assign_to_date'])) {
                    echo date("d-m-Y H:i", strtotime($orders_data['assign_to_date']));
                }?></span></dd>
                    <dt>วันที่</dt>
                    <dd><span>สร้าง : <i class="fa fa-calendar"></i> <?php if (isset($orders_data['create_date'])) {
                    echo date("d-m-Y H:i", strtotime($orders_data['create_date']));
                }?></span></dd>
                    <dd><span>แก้ไข : <i class="fa fa-calendar"></i> <?php if (isset($orders_data['modified_date'])) {
                    echo date("d-m-Y H:i", strtotime($orders_data['modified_date']));
                }?></span></dd>
                    <dt>ใช้งาน</dt>
                    <dd><?php if ($orders_data['is_active']=="1"): ?>
                        <span><i class="fa fa-check"></i> ใช้งาน</span>
                    <?php else: ?>
                        <span class="text-danger"><i class="fa fa-times"></i> ยกเลิก</span>
                    <?php endif ?></dd>
                  </dl>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $orders_data['company'] ?> (<?php echo $orders_data['order_id'] ?>)</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ลำดับ</th>
                  <th>part number</th>
                  <th>product name</th>
                  <th>Description</th>
                  <th>comment</th>
                  <th>type name</th>
                  <th>type description</th>
                  <th>full price</th>
                  <th>dealer price</th>
                  <th>discount sla</th>
                  <th>discount contract</th>
                  <th>discount qty</th>
                  <th>province</th>
                  <th>pm</th>
                  <th>lb</th>
                  <th>qty</th>
                  <th>total</th>
                </tr>
                <?php foreach ($orders_detail_data as $row): ?>
                <tr>
                  <td><?php echo $row['line_number']; ?></td>
                  <td><?php echo $row['part_number']; ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['product_description']; ?></td>
                  <td><?php echo $row['comment']; ?></td>
                  <td><?php echo $row['type_name']; ?></td>
                  <td><?php echo $row['type_description']; ?></td>
                  <td><?php echo number_format($row['full_price'], 0); ?></td>
                  <td><?php echo number_format($row['dealer_price'], 0); ?></td>
                  <td><?php echo number_format($row['discount_sla_type_value'], 0); ?>%</td>
                  <td><?php echo number_format($row['discount_of_contract_value'], 0); ?>%</td>
                  <td><?php echo number_format($row['discount_of_qty_value'], 0); ?>%</td>
                  <td><?php echo $row['province_name']; ?></td>
                  <td><?php echo $row['pm_time_qty']; ?></td>
                  <td><?php echo $row['lb_year_qty']; ?></td>
                  <td><?php echo $row['qty']; ?></td>
                  <td><?php echo number_format($row['total'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
