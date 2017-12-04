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
      <p class="text-center">Quotation | TOS MA Online</p>
      <div class="row">
          <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
            <h3><?php echo $quotation_data["ow_company_name_th"];?></h3>
            <h4><?php echo $quotation_data["ow_company_name_en"];?></h4>
            <p><?php echo $quotation_data["ow_address"];?><br><?php echo $quotation_data["ow_contact_desc"];?><br><?php echo $quotation_data["ow_desc"];?><br>เลขประจำตัวผู้เสียภาษีอากร :  <?php echo $quotation_data["ow_tax"];?></p>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
            <p style="float: right;"><img src="<?php echo base_url($quotation_data["ow_logo"]); ?>" class="img-thumbnail" style="border: none;"></p>
          </div>
      </div>
      
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h4 class="text-center text-bold">QUOTATION</h4>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 16.66%; padding: 0; border: none;"></th>
                <th style="width: 16.66%; padding: 0; border: none;"></th>
                <th style="width: 16.66%; padding: 0; border: none;"></th>
                <th style="width: 16.66%; padding: 0; border: none;"></th>
                <th style="width: 16.66%; padding: 0; border: none;"></th>
                <th style="width: 16.66%; padding: 0; border: none;"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-bold">Quotation No.</td>
                <td colspan="3"><?php echo $quotation_data["quotation_doc_no"];?></td>
                <td class="text-bold">Date.</td>
                <td><?php echo $quotation_data["modified_date"];?></td>
              </tr>
              <tr>
                <td class="text-bold">Name:</td>
                <td colspan="5"><?php echo $quotation_data["ct_email"];?></td>
              </tr>
              <tr>
                <td class="text-bold">Company:</td>
                <td colspan="5"><?php echo $quotation_data["ct_company"];?></td>
              </tr>
              <tr>
                <td class="text-bold">Address:</td>
                <td colspan="5"><?php echo $quotation_data["ct_address"];?></td>
              </tr>
              <tr>
                <td class="text-bold">Tel:</td>
                <td><?php echo $quotation_data["ct_tel"];?></td>
                <td class="text-bold">Fax:</td>
                <td><?php echo $quotation_data["ct_fax"];?></td>
                <td class="text-bold">Mobile:</td>
                <td></td>
              </tr>
              <tr>
                <td class="text-bold">E-mail:</td>
                <td colspan="2"><?php echo $quotation_data["ct_email"];?></td>
                <td class="text-bold">Remark:</td>
                <td colspan="2"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4><span class="text-bold">Subject :</span>&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $quotation_data["quotation_subject"];?></span></h4>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center"><strong>Part Number</strong></th>
                  <th class="text-center"><strong>Part Device/Description</strong></th>
                  <!-- <th class="text-center"><strong>MA-Type</strong></th> -->
                  <th class="text-center"><strong>Qty</strong></td>
                  <th class="text-center"><strong>Unit Price</strong></th>
                  <!-- <th class="text-center"><strong>Amount</strong></th> -->
                  <th class="text-center"><strong>Cost Total</strong></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($quotation_detail_data as $value): ?>
                   <tr>
                    <td class="text-center"><?php echo $value['line_no']; ?></td>
                      <td class="text-center"><?php echo $value['part_number']; ?></td>
                      <td class="text-center"><?php echo $value['name']; ?></td>
                      <!-- <td class="text-center"><?php echo $value['name']; ?></td> -->
                      <td class="text-center"><?php echo $value['qty']; ?></td>
                      <td class="text-center"><?php echo $value['price']; ?></td>
                      <!-- <td class="text-center"><?php echo number_format($value['total'],2) ?></td> -->
                      <td class="text-center"><?php echo number_format($value['cost_total'],2) ?></td>
                   </tr>
                <?php endforeach ?>
                <tr>
                  <td colspan="4" style="border: none;"></td>
                  <td class="text-right text-bold" style="
    background-color: #f5f5f5;"><strong>SUB TOTAL :</strong></td>
                  <td class="text-center"><?php echo number_format($quotation_data['sub_total'],2) ?></td>
                </tr>
                <tr>
                  <td colspan="4" style="border: none;"></td>
                  <td class="text-right text-bold" style="
    background-color: #f5f5f5;"><strong>DISCOUNT :</strong></td>
                  <td class="text-center"><?php echo number_format($quotation_data['discount'],2) ?></td>
                </tr>
                <tr>
                  <td colspan="3" class="text-center" style="border: none;"><p class="text-bold">จำนวนเงิน / บาท (ตัวหนังสือ)</p></td>
                  <td style="border: none;"></td>
                  <td class="text-right text-bold" style="
    background-color: #f5f5f5;"><strong>VAT 7 % :</strong></td>
                  <td class="text-center"><?php echo number_format($quotation_data['vat'],2) ?></td>
                </tr>
                <tr>
                  <td colspan="3" style="background-color: #f5f5f5;"><p class="text-center"><?php echo num2wordsThai(number_format($quotation_data['total'],2)); ?></p></td>
                  <td style="border: none;"></td>
                  <td class="text-right text-bold" style="
    background-color: #f5f5f5;"><strong>TOTAL :</strong></td>
                  <td class="text-center"><?php echo number_format($quotation_data['total'],2) ?></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h4 class="text-center text-bold"><span class="text-bold">Terms and Conditions</span></h4>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 30%;">Price Validity</th>
                <th class="text-center" style="width: 30%;">Payment Term</th>
                <th class="text-center" style="width: 30%;">Delivery Date</th>
                <th class="text-center" style="width: 30%;">Type</th>
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
                  <th class="text-center col-md-4" style="border: none;"><strong>Approve by</strong></th>
                  <th class="text-center col-md-4" style="border: none;"><strong>Purchase approved in accordance with this quotation</strong><br>(อนุมัติสั่งซื้อตามใบเสนอราคานี้) </th>
                  <th class="text-center col-md-4" style="border: none;"><strong>Best Regards,</strong></th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center col-mg-4" style="border: none;">
                  <p><img style="width: 50%;" src="<?php echo base_url($quotation_data["sale_manager_signature"]); ?>" class="img-thumbnail"></p>
                  <p>( <?php echo $quotation_data['sale_manager_name']; ?> )</p>
                  <p>Sale Manager</p>
                </td>
                <td class="text-center col-mg-4" style="padding-top: 30px; border: none;">
                  <p>....................................................</p>
                  <p>(<span style="padding: 0 100px;"></span>)</p>
                  <p><strong>Purchaser Authorized Signature<strong></p>
                  <p><strong>ลงนามผู้มีอำนาจในการสั่งซื้อ<strong></p>
                </td>
                <td class="text-center col-mg-4" style="border: none;">
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

      <p class="text-center">
        <button type="button" class="btn btn-primary btn-lg btn-print" onClick="window.print()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
      </p>
    </div>
  </section>
  <!-- /.content -->
</div>
<style>
@media print
 {
    .main-footer,
    .btn-print {display: none;}
 }
.row { margin-bottom: 30px; }
.table-bordered>thead:first-child>tr:first-child>th { border-top: 1px solid #ccc; }
  .table-bordered{ border: none; }
  .table-bordered>tbody>tr>td,
  .table-bordered>thead>tr>th{ border-color: #ccc; }
  .table-bordered>thead>tr>th {background-color: #f5f5f5;}
</style>
