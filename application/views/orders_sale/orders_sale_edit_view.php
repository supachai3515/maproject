<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="order_sale_ctrl">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Order
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('orders_sale'); ?>"> Orders sale</a></li>
      <li class="active">Edit Order</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
              <h3 class="box-title"><?php echo $orders_data['company'] ?> (<?php echo $orders_data['order_id'] ?>)</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                  <th>รหัส</th>
                  <th>Company</th>
                  <th>email</th>
                  <th>tel</th>
                  <th>qty</th>
                  <th>total</th>
                  <th>สถานะ</th>
                  <th>Assign by</th>
                  <th>Assign to</th>
                  <th>วันที่</th>
                  <th>ใช้งาน</th>
                  <th class="text-center">Actions</th>
                </tr>
                <tr>
                  <td><span ng-bind="order_list.order_id"></span></td>
                  <td><span ng-bind="order_list.company"></span></td>
                  <td><span ng-bind="order_list.email"></span></td>
                  <td><span ng-bind="order_list.tel"></span></td>
                  <td><span ng-bind="order_list.qty"></span></td>
                  <td><span ng-bind="order_list.total | number:2"></span></td>
                  <td><span ng-bind="order_list.status_name"></span></td>
                  <td><span ng-bind="order_list.assign_by_name"></span></td>
                  <td><span ng-bind="order_list.assign_to_name"></span></td>
                  <td><span ng-bind="order_list.create_date"></span></td>
                  <td><span ng-bind="order_list.modified_date"></span></td>
                  <td><span ng-bind="order_list.is_active"></span></td>
                </tr>

              </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <div class="col-xs-12 text-right">
            <div class="form-group">
                <a class="btn btn-primary" ng-click="add_order(order_list)" ><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>
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
                  <th>Edit</th>
                </tr>

                <tr ng-repeat="(idx, row) in orders_detail track by idx">
                  <td><span ng-bind="row.line_number"></span></td>
                  <td><span ng-bind="row.part_number"></span></td>
                  <td><span ng-bind="row.product_name"></span></td>
                  <td><span ng-bind="row.product_description"></span></td>
                  <td><span ng-bind="row.comment"></span></td>
                  <td><span ng-bind="row.type_name"></span></td>
                  <td><span ng-bind="row.type_description"></span></td>
                  <td><span ng-bind="row.full_price | number"></span></td>
                  <td><span ng-bind="row.dealer_price | number"></span></td>
                  <td><span ng-bind="row.discount_sla_type_value | number"></span>%</td>
                  <td><span ng-bind="row.discount_of_contract_value | number"></span>%</td>
                  <td><span ng-bind="row.discount_of_qty_value | number"></span>%</td>
                  <td><span ng-bind="row.province_name"></span></td>
                  <td><span ng-bind="row.pm_time_qty | number"></span></td>
                  <td><span ng-bind="row.lb_year_qty | number"></span></td>
                  <td><span ng-bind="row.qty | number"></span></td>
                  <td><span ng-bind="row.total | number:2"></span></td>
                  <td>
                    <a class="btn btn-sm btn-warning"  ng-click="edit_order(row)" > <i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a class="btn btn-sm btn-danger"  ng-click="delete_order(row)" > <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  </td>
                </tr>
              </table>

              <!--
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
                  <td><?php echo number_format($row['full_price'],0); ?></td>
                  <td><?php echo number_format($row['dealer_price'],0); ?></td>
                  <td><?php echo number_format($row['discount_sla_type_value'],0); ?>%</td>
                  <td><?php echo number_format($row['discount_of_contract_value'],0); ?>%</td>
                  <td><?php echo number_format($row['discount_of_qty_value'],0); ?>%</td>
                  <td><?php echo $row['province_name']; ?></td>
                  <td><?php echo $row['pm_time_qty']; ?></td>
                  <td><?php echo $row['lb_year_qty']; ?></td>
                  <td><?php echo $row['qty']; ?></td>
                  <td><?php echo number_format($row['total'],2); ?></td>
                </tr>
                <?php endforeach; ?>
              </table>
              -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
    </div>
    <div class="row">
        <!-- left column -->
        <div class="col-md-8">
          <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Order : (<?php echo $orders_data['order_id']; ?>)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="addUser" action="<?php echo base_url() ?>orders_sale/edit_save" method="post" role="form">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Company/Name</label>
                                    <input type="text" class="form-control required" id="company" name="company" value="<?php echo $orders_data['company']; ?>" maxlength="128" required>
                                    <input type="hidden" value="<?php echo $orders_data['order_id']; ?>" name="order_id" id="order_id" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel">Tel</label>
                                    <input type="text" class="form-control" id="tel"  name="tel" value="<?php echo $orders_data['tel']; ?>" maxlength="128" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="tel">Email</label>
                                  <input type="email" class="form-control" id="email"  name="email" value="<?php echo $orders_data['email']; ?>" maxlength="128" required>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="comment_order">Comment</label>
                                  <textarea name="comment_order"  class="form-control" id="comment_order" rows="8" cols="80"><?php echo $orders_data['comment_order']; ?></textarea>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <?php if ($orders_data['is_active'] == 1): ?>
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
