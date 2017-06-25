<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			View SLA Info
			<small>รายละเอียด SLA</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">View SLA Info</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
			<div class="row">
					<div class="col-xs-12">
						<div class="box">

							<div class="box box-primary">
								<div class="box-header">
										<h3 class="box-title">View SLA Info</h3>
								</div><!-- /.box-header -->
								<!-- form start -->
								<form role="form"  role="form">
				                    <div class="box-body">
				                        <div class="row">
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="sla_name">Name</label>
				                                    <input type="text" class="form-control" id="sla_name" name="sla_name" value="<?php echo $discount_sla_type_data['name']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="sla_desc">Description</label>
				                                    <input type="text" class="form-control" id="sla_desc"  name="sla_desc" value="<?php echo $discount_sla_type_data['description']; ?>" readonly>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="row">
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="sla_min">Min</label>
				                                    <input type="text" class="form-control" id="sla_min"  name="sla_min" value="<?php echo $discount_sla_type_data['min']; ?>%" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="sla_max">Max</label>
				                                    <input type="text" class="form-control" id="sla_max"  name="sla_max" value="<?php echo $discount_sla_type_data['max']; ?>%" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-6">
				                                <div class="form-group">
				                                    <label for="sla_type">Owner</label>
					                                <?php if ($discount_sla_type_data['is_owner']==1): ?>
							                            <input type="text" class="form-control" id="sla_type"  name="sla_type" value="TOS" readonly>
							                        <?php else: ?>
							                            <input type="text" class="form-control" id="sla_type"  name="sla_type" value="Vender" readonly>
							                        <?php endif ?>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="row">
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="create_by">Create By</label>
				                                    <input type="text" class="form-control" id="create_by" name="create_by" value="<?php echo $discount_sla_type_data['create_by_name']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="create_date">Create Date</label>
				                                    <input type="text" class="form-control" id="create_date"  name="create_date" value="<?php echo $discount_sla_type_data['create_date']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="modified_by">Modified By</label>
				                                    <input type="text" class="form-control" id="modified_by" name="modified_by" value="<?php echo $discount_sla_type_data['modified_by_name']; ?>" readonly>
				                                </div>
				                            </div>
				                            <div class="col-md-3">
				                                <div class="form-group">
				                                    <label for="modified_date">Modified Date</label>
				                                    <input type="text" class="form-control" id="modified_date"  name="modified_date" value="<?php echo $discount_sla_type_data['modified_date']; ?>" readonly>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="row">
				                            <div class="col-md-6">
				                              <div class="form-group">
				                                <div class="checkbox">
				                                  <label>
				                                    <?php if ($discount_sla_type_data['is_active'] == 1): ?>
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
