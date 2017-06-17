<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Province
      <small>จังหวัด</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Menu Group</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
      <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                  <h3 class="box-title">Province List</h3>
                  <div class="box-tools">
                      <form action="<?php echo base_url() ?>province" method="POST" id="searchList">
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
                      <th>รหัส</th>
                      <th>ชื่อ</th>
                      <th>Cost LB</th>
                      <th>Cost PM</th>
                      <th>วันที่สร้าง</th>
                      <th>วันที่แก้ไข</th>
                      <th>สถานะ</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php foreach ($province_list as $record): ?>
                    <tr>
                      <td><?php echo $record->province_code ?></td>
                      <td><?php echo $record->province_name ?></td>
                      <td><?php echo $record->lb_year ?></td>
                      <td><?php echo $record->pm_time ?></td>
                      <td><span><i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($record->create_date));?></span></td>
                      <td><span><i class="fa fa-calendar"></i> <?php echo date("d-m-Y H:i", strtotime($record->modified_date));?></span></td>
                      <td>
                          <?php if ($record->is_active=="1"): ?>
                              <span><i class="fa fa-check"></i> ใช้งาน</span>
                          <?php else: ?>
                              <span class="text-danger"><i class="fa fa-times"></i> ยกเลิก</span>
                          <?php endif ?>
                      </td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-warning" href="<?php echo base_url().'province/edit/'.$record->province_id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'province/view/'.$record->province_id; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
      </div>
  </section>
  <!-- /.content -->
</div>
