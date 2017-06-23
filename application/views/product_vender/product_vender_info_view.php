<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View info Product Vender
      <small>สินค้า Vender</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('product_vender'); ?>"> Product Vender</a></li>
      <li class="active">View Product Vender</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">  View info Product Venders : (<?php echo $product_vender_data['product_vender_id']; ?>)</h3>
                </div><!-- /.box-header -->
                <!-- form start -->

                <form role="form"  role="form">
                    <div class="box-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="description">Model</label>
                                  <input type="text" class="form-control" id="model"  name="model" value="<?php echo $product_vender_data['model']; ?>"  maxlength="64"  required="true" readonly="true">
                              </div>
                          </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control required" id="name" name="name" value="<?php echo $product_vender_data['name']; ?>" maxlength="128" readonly>
                                    <input type="hidden" value="<?php echo $product_vender_data['product_vender_id']; ?>" name="product_vender_id" id="product_vender_id" />
                                </div>
                            </div>
                          </div>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description"  name="description" value="<?php echo $product_vender_data['description']; ?>" maxlength="1204" readonly>
                                </div>
                            </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="product_brand_id">Brand</label>
                                  <select class="form-control required" id="product_brand_id" name="product_brand_id" required="true"  disabled="true">
                                      <option value="0">Select Brand</option>
                                      <?php
                                      if(!empty($list_product_brand))
                                      {
                                          foreach ($list_product_brand as $row)
                                          {
                                              ?>
                                              <option value="<?php echo $row['product_brand_id'] ?>" <?php if($row['product_brand_id'] == $product_vender_data['product_brand_id']) {echo "selected=selected";} ?>><?php echo $row['name'] ?></option>>
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
                                    <label for="name">Dealer Price</label>
                                    <input type="number" class="form-control required" id="dealer_price" name="dealer_price" value="<?php echo $product_vender_data['dealer_price']; ?>"maxlength="10" readonly="true">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Create By</label>
                                    <input type="text" class="form-control required" id="name" name="name" value="<?php echo $product_vender_data['create_by_name']; ?>" maxlength="128" readonly>
                                    <input type="hidden" value="<?php echo $product_vender_data['product_vender_id']; ?>" name="product_vender_id" id="product_vender_id" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Create Date</label>
                                    <input type="text" class="form-control" id="description"  name="description" value="<?php echo $product_vender_data['create_date']; ?>" maxlength="1204" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Modified By</label>
                                    <input type="text" class="form-control required" id="name" name="name" value="<?php echo $product_vender_data['modified_by_name']; ?>" maxlength="128" readonly>
                                    <input type="hidden" value="<?php echo $product_vender_data['product_vender_id']; ?>" name="product_vender_id" id="product_vender_id" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description">Modified Date</label>
                                    <input type="text" class="form-control" id="description"  name="description" value="<?php echo $product_vender_data['modified_date']; ?>" maxlength="1204" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <div class="checkbox">
                                  <label>
                                    <?php if ($product_vender_data['is_active'] == 1): ?>
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
        </div>
    </div>
  </section>
  <!-- /.content -->
</div>
