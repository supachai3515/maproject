<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			View Province Info
			<small>รายละเอียดจังหวัด</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">View Province Info</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
			<div class="row">
					<div class="col-xs-12">
						<div class="box">

							<div class="box box-primary">
								<div class="box-header">
										<h3 class="box-title">View Province Info</h3>
								</div><!-- /.box-header -->
								<!-- form start -->
								<form role="form"  role="form">
				                    <div class="box-body">
				                        <div class="row">
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="name">Name</label>
				                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $province_data['province_name']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="cost_lb">Cost LB</label>
				                                    <input type="text" class="form-control" id="cost_lb"  name="costLB" value="<?php echo $province_data['lb_year']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="cost_pm">Cost PM</label>
				                                    <input type="text" class="form-control" id="cost_pm"  name="costPM" value="<?php echo $province_data['pm_time']; ?>" readonly>
				                                </div>
				                            </div>
				                        </div>

				                        <div class="row">
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="create_by">Create By</label>
				                                    <input type="text" class="form-control" id="create_by" name="createBy" value="<?php echo $province_data['create_by']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="create_date">Create Date</label>
				                                    <input type="text" class="form-control" id="create_date"  name="createDate" value="<?php echo $province_data['create_date']; ?>" readonly>
				                                </div>
				                            </div>
				                        </div>

				                        <div class="row">
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="modified_by">Modified By</label>
				                                    <input type="text" class="form-control" id="modified_by" name="modifiedBy" value="<?php echo $province_data['modified_by']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="modified_date">Modified Date</label>
				                                    <input type="text" class="form-control" id="modified_date"  name="modifiedDate" value="<?php echo $province_data['modified_date']; ?>" readonly>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="row">
				                            <div class="col-md-6">
				                              <div class="form-group">
				                                <div class="checkbox">
				                                  <label>
				                                    <?php if ($province_data['is_active'] == 1): ?>
				                                      <input type="checkbox"  id="is_active"  name="is_active" value="1" checked="true" disabled="true"> ใช้งาน
				                                    <?php else: ?>
				                                      <input type="checkbox"  id="is_active"  name="is_active" value="1" disabled="true"> ใช้งาน
				                                    <?php endif; ?>
				                                  </label>
				                                </div>
				                              </div>
				                            </div>
				                        </div>
				                    </div><!-- /.box-body -->
				                </form>
							</div>
						</div><!-- /.box -->
					</div>
			</div>
	</section>
	<!-- /.content -->
</div>
