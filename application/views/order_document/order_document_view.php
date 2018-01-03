<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="orders_ctrl">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Orders Document
      <small>เอกสารสินค้า</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Orders Document</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
      <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Orders List</h3>
                  <div class="box-tools">
                      <form action="<?php echo base_url() ?>orders" method="POST" id="searchList">
                          <div class="input-group">
                            <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                            <div class="input-group-btn">
                              <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                            </div>
                          </div>
                      </form>
                  </div>
              </div><!-- /.box-header -->
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
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php foreach ($order_doc_list as $record): ?>
                    <tr>
                      <td class="text-center"><?php echo $record->order_document_id ?></td>
                      <td class="text-center"><?php echo $record->order_description ?></td>
                      <td class="text-center"><a class="btn" href="<?php echo base_url().$record->document_path; ?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i></a></td>
                      <td class="text-center">
                        <?php if (isset($record->assign_by_name)): ?>
                          <?php echo $record->assign_by_name ?><br>
                          <span><i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($record->assign_by_date));?></span>
                          <?php else: ?>
                            -
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <?php if (isset($record->assign_to)): ?>
                          <?php echo $record->assign_to_name ?><br>
                          <span><i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($record->assign_to_date));?></span>
                          <?php else: ?>
                            -
                        <?php endif; ?>
                      </td>
                      <td class="text-center">
                        <?php if (isset($record->create_date)): ?>
                          <span>สร้าง : <i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($record->create_date));?></span><br>
                        <?php endif; ?>
                        <?php if (isset($record->modified_date)): ?>
                          <span>แก้ไข : <i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($record->modified_date));?></span>
                        <?php endif; ?>
                      <td class="text-center">
                          <?php if ($record->is_active=="1"): ?>
                              <span><i class="fa fa-check"></i></span>
                          <?php else: ?>
                              <span class="text-danger"><i class="fa fa-times"></i></span>
                          <?php endif ?>
                      </td>
                      <td class="text-center">
                        <?php if (isset($record->assign_to)): ?>
                          <a class="btn btn-xs btn-success" href="<?php echo base_url().'order_document_admin/assign/'.$record->order_document_id; ?>"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                        <?php else: ?>
                          <a class="btn btn-xs btn-default" href="<?php echo base_url().'order_document_admin/assign/'.$record->order_document_id; ?>"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </table>
              </div><!-- /.box-body -->
              <div class="box-footer clearfix">
                  <?php if(isset($links_pagination)) {echo $links_pagination;} ?>
              </div>
            </div><!-- /.box -->
          </div>
          <!--
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body table-responsive">
                <div class="table-responsive">
                   <button ng-click="tableParams.sorting({})" class="btn btn-info pull-right">Clear การเรียงลำดับ</button>
                     <table ng-table="tableParams" class="table table-striped">
                        <tr ng-repeat="p in $data">
                            <td data-title="'รหัส'" sortable="'order_id'" align="" >
                              #<span ng-bind="{{p.order_id}}"></span>
                            </td>
                            <td data-title="'Company'" sortable="'company'" align="">
                                {{p.company}}
                            </td>
                            <td data-title="'email'" sortable="'email'" align="">
                                {{p.email}}
                            </td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-warning" href="<?php echo base_url().'orders/edit/';?> {{p.order_id}}" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'orders/view/';?>{{p.order_id}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                          </tr>
                     </table>
                  </div>
                </div>
            </div>
          </div>
          -->
      </div>
  </section>
  <!-- /.content -->
</div>
