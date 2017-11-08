<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>View Quotation</h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="<?php echo base_url('quotation'); ?>"> Quotation</a></li>
      <li class="active">View Quotation</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container" style="background-color: #fff; padding-top: 15px; padding-bottom: 15px;">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          <h2><?php echo $quotation_data["ow_company_name_th"];?></h2>
          <h4><?php echo $quotation_data["ow_company_name_en"];?></h4>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
          <p style="float: right;" class="col-xs-6 col-sm-6 col-md-6 col-lg-6"><img src="<?php echo base_url($quotation_data["ow_logo"]); ?>" class="img-thumbnail"></p>
        </div>
    </div>
    <div class="row" style="padding-top:10px;">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <p><?php echo $quotation_data["ow_address"];?><br><?php echo $quotation_data["ow_contact_desc"];?><br><?php echo $quotation_data["ow_desc"];?><br>เลขประจำตัวผู้เสียภาษีอากร :  <?php echo $quotation_data["ow_tax"];?></p>
      </div>
    </div>

      <div class="panel panel-primary" style="margin-top:30px;">
        <div class="panel-heading">
          <h3 class="panel-title text-center">QUOTATION / ใบเสนอราคา</h3>
      </div>
      <div class="panel-body">
          <div class="row">
            <div class="col-md-6"><strong>Name:</strong>  <?php echo $quotation_data["ct_email"];?></div>
            <div class="col-md-6"><strong>Quotation No.</strong>  <?php echo $quotation_data["quotation_doc_no"];?></div>
          </div>
          <div class="row">
            <div class="col-md-6"><strong>Company:</strong>  <?php echo $quotation_data["ct_company"];?></div>
            <div class="col-md-6"><strong>Date :</strong> <?php echo $quotation_data["modified_date"];?></div>
          </div>
          <div class="row">
            <div class="col-md-6"><strong>Address:</strong>  <?php echo $quotation_data["ct_address"];?></div>
            <div class="col-md-6"><strong>Tel :</strong>  <?php echo $quotation_data["ct_tel"];?></div>
          </div>
          <div class="row">
            <div class="col-md-6"><strong>E-mail:</strong>  <?php echo $quotation_data["ct_email"];?></div>
            <div class="col-md-6"><strong>Fax :</strong>  <?php echo $quotation_data["ct_fax"];?></div>
          </div>
          <div class="row">
            <div class="col-md-6"><strong>Page:</strong>  <?php echo $quotation_data["quotation_page"];?></div>
          </div>
      </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><span class="text-bold">Subject :</span> <span><?php echo $quotation_data["quotation_subject"];?></span></h3>
                </div>
                <div class="panel-body">
                  <table class="table table-condensed">
                      <thead>
                          <tr>
                          <th class="text-center">#</th>
                            <th class="text-center"><strong>Part Number</strong></th>
                            <th class="text-center"><strong>Description</strong></th>
                            <th class="text-center"><strong>MA-Type</strong></th>
                              <th class="text-center"><strong>Unit</strong></td>
                              <th class="text-center"><strong>Unit Price</strong></th>
                              <th class="text-center"><strong>Amount</strong></th>
                              <th class="text-center"><strong>Cost Total</strong></th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($quotation_detail_data as $value): ?>
                         <tr>
                          <td class="text-center"><?php echo $value['line_no']; ?></td>
                            <td class="text-center"><?php echo $value['part_number']; ?></td>

                            <td class="text-center"><?php echo $value['name']; ?></td>
                            <td class="text-center"><?php echo $value['name']; ?></td>
                            <td class="text-center"><?php echo $value['qty']; ?></td>
                            <td class="text-center"><?php echo $value['price']; ?></td>
                            <td class="text-center"><?php echo number_format($value['total'],2) ?></td>
                            <td class="text-center"><?php echo number_format($value['cost_total'],2) ?></td>
                         </tr>
                      <?php endforeach ?>

                      <tr>
                        <td class="text-right" colspan="7"><strong>SUB TOTAL :</strong></td>number_format($model['total'],0)
                        <td class="text-left" colspan="2"><?php echo number_format($quotation_data['sub_total'],2) ?></td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="7"><strong>DISCOUNT :</strong></td>
                        <td class="text-left" colspan="2"><?php echo number_format($quotation_data['discount'],2) ?></td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="7"><strong>VAT 7 % :</strong></td>
                        <td class="text-left" colspan="2"><?php echo number_format($quotation_data['vat'],2) ?></td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="7"><strong>TOTAL :</strong></td>
                        <td class="text-left" colspan="2"><?php echo number_format($quotation_data['total'],2) ?></td>
                      </tr>
                      </tbody>
                  </table>
                </div>
                <div class="panel-footer">
                  <p><strong>จำนวนเงิน ( BAHT ) :   <?php echo num2wordsThai(number_format($quotation_data['total'],2)); ?></strong></p>
                </div>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="panel panel-default">
           <div class="panel-heading text-center text-bold">Terms and Conditions</div>
          <div class="panel-body">
              <table class="table table-condensed">
                <thead>
                    <tr>
                      <th class="text-center"><strong>Price Validity</strong></th>
                      <th class="text-center"><strong>Payment Term</strong></th>
                      <th class="text-center"><strong>Delivery Date</strong></th>
                      <th class="text-center"><strong>Type</strong></td>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><?php echo $quotation_data['price_validity']; ?></td>
                    <td class="text-center"><?php echo $quotation_data['payment_term']; ?></td>
                    <td class="text-center"><?php echo $quotation_data['delivery_date']; ?></td>
                    <td class="text-center"><?php echo $quotation_data['terms_type']; ?></td>
                  </tr>
                </tbody>
              </table>
              <table class="table table-condensed">
                <thead>
                    <tr>
                      <th class="text-center col-md-4"><strong>Approve by</strong></th>
                      <th class="text-center col-md-4"><strong>Purchase approved in accordance with this quotation</strong><br>(อนุมัติสั่งซื้อตามใบเสนอราคานี้) </th>
                      <th class="text-center col-md-4"><strong>Best Regards,</strong></th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center col-mg-4">
                      <p><img style="width: 50%;" src="<?php echo base_url($quotation_data["sale_manager_signature"]); ?>" class="img-thumbnail"></p>
                      <p>( <?php echo $quotation_data['sale_manager_name']; ?> )</p>
                      <p>Sale Manager</p>
                    </td>
                    <td class="text-center col-mg-4" style="padding-top: 30px;">
                      <p>....................................................</p>
                      <p>(<span style="padding: 0 100px;"></span>)</p>
                      <p><strong>Purchaser Authorized Signature &amp; Sale<strong></p>
                      <p><strong>ลงนามผู้มีอำนาจในการสั่งซื้อ<strong></p>
                    </td>
                    <td class="text-center col-mg-4">
                      <p><img style="width: 50%;" src="<?php echo base_url($quotation_data["sale_signature"]); ?>" class="img-thumbnail"></p>
                      <p>( <?php echo $quotation_data['sale_name']; ?> )</p>
                      <p><?php echo $quotation_data['sale_position']; ?></p>
                      <p><?php echo $quotation_data['sale_email']; ?></p>
                      <p><?php echo $quotation_data['sale_tel']; ?></p>
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <p class="text-center">
      <button type="button" class="btn btn-primary" onClick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> พิมพ์ใบชำระเงิน</button>
      </p>
    </div>
  </div>
  </section>
  <!-- /.content -->
</div>
