<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Product venders
      <small>เพิ่มสินค้า Vender</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('product_vender'); ?>"> Product vender</a></li>
      <li class="active">Add Product vender</li>
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
                    <h3 class="box-title">Add Product vender</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form role="form" id="addUser" action="<?php echo base_url() ?>product_vender/add_save" method="post" role="form">
                    <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="description">Model</label>
                                  <input type="text" class="form-control" id="model"  name="model" maxlength="64"  required="true">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control required" id="name" name="name" maxlength="120" required="true">
                              </div>
                          </div>
                      </div>
                        <div class="row">
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
                                              <option value="<?php echo $row['product_brand_id'] ?>"><?php echo $row['name'] ?></option>
                                              <?php
                                          }
                                      }
                                      ?>
                                  </select>
                              </div>
                          </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description"  name="description" maxlength="1204">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Dealer price</label>
                                    <input type="number" class="form-control required" id="dealer_price" name="dealer_price" maxlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox"  id="is_active"  name="is_active" value="1" checked> ใช้งาน
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
