<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Product vendor
      <small>แก้ไขสินค้า vendor</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('product_vendor'); ?>"> Product vendor</a></li>
      <li class="active">Edit Product vendor</li>
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
                    <h3 class="box-title">Edit Product vendor : (<?php echo $product_vendor_data['product_vendor_id']; ?>)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form role="form" id="addUser" action="<?php echo base_url() ?>product_vendor/edit_save" method="post" role="form">
                    <div class="box-body">
                      <div class="row">

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="description">Model</label>
                                  <input type="text" class="form-control" id="model"  name="model" value="<?php echo $product_vendor_data['model']; ?>"  maxlength="64"  required="true">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="description">Part number</label>
                                  <input type="text" class="form-control" id="part_number"  name="part_number" value="<?php echo $product_vendor_data['part_number']; ?>" maxlength="1204">
                              </div>
                          </div>

                          </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description"  name="description" value="<?php echo $product_vendor_data['description']; ?>" maxlength="1204">
                                </div>
                            </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="product_brand_id">Brand</label>
                                  <select class="form-control required" id="product_brand_id" name="product_brand_id" required="true">
                                      <option value="0">Select Brand</option>
                                      <?php
                                      if(!empty($list_product_brand))
                                      {
                                          foreach ($list_product_brand as $row)
                                          {
                                              ?>
                                              <option value="<?php echo $row['product_brand_id'] ?>" <?php if($row['product_brand_id'] == $product_vendor_data['product_brand_id']) {echo "selected=selected";} ?>><?php echo $row['name'] ?></option>>
                                              <?php
                                          }
                                      }
                                      ?>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control required" id="name" name="name" value="<?php echo $product_vendor_data['name']; ?>" maxlength="128">
                                  <input type="hidden" value="<?php echo $product_vendor_data['product_vendor_id']; ?>" name="product_vendor_id" id="product_vendor_id" />
                              </div>
                          </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Dealer price</label>
                                    <input type="number" class="form-control required" id="dealer_price" name="dealer_price" value="<?php echo $product_vendor_data['dealer_price']; ?>"maxlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <?php if ($product_vendor_data['is_active'] == 1): ?>
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
