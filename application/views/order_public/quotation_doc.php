<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Quotation</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body ng-app="myApp" ng-controller="mainCtrl">
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
                            <td class="text-center"><?php echo $value['total']; ?></td>
                            <td class="text-center"><?php echo $value['cost_total']; ?></td>
                         </tr>
                      <?php endforeach ?>

                      <tr>
                        <td class="text-right" colspan="7"><strong>SUB TOTAL :</strong></td>
                        <td class="text-left" colspan="2"><?php echo $quotation_data['sub_total']; ?></td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="7"><strong>DISCOUNT :</strong></td>
                        <td class="text-left" colspan="2"><?php echo $quotation_data['discount']; ?></td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="7"><strong>VAT 7 % :</strong></td>
                        <td class="text-left" colspan="2"><?php echo $quotation_data['vat']; ?></td>
                      </tr>
                      <tr>
                        <td class="text-right" colspan="7"><strong>TOTAL :</strong></td>
                        <td class="text-left" colspan="2"><?php echo $quotation_data['total']; ?></td>
                      </tr>
                      </tbody>
                  </table>
                </div>
                <div class="panel-footer">
                  <p><strong>จำนวนเงิน ( BAHT ) :   </strong>-</p>
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

<style>

.height {

}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
.table-condensed>tbody>tr>td{
	padding: 2px;
}
.fix-container{
	/*width: 878px;*/
  width: 80%;
}
.lineover{
  /* Fallback for non-webkit */
  display: -webkit-box;
  /* Fallback for non-webkit */
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}
.product-id{
	width: 150px;
}
.sumprice{
	width: 150px;
}
.sumpricepernum{
	width: 90px;
}
  @media print {
      a[href]:after {
        content: "" !important;
      }
    }
</style>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0-rc.0/angular.min.js"></script>
		<script type="text/javascript">
			var app = angular.module('myApp', []);
			app.controller('mainCtrl', function($scope, $http) {

				$scope.orderSenmailInit = function() {

				    <?php if (isset($_GET["Sendmail"]) && $order_data["is_sendmail"]== 0) {
    ?>
			            $http({
			            method: 'GET',
			            url: '<?php echo base_url()."/inc/order_sendmail.php?order=".$_GET["Sendmail"]; ?>',
			            headers: {
			            'Content-Type': 'application/x-www-form-urlencoded'
			            },

			            }).success(function(data) {
			            console.log(data);
			            });
		            <?php
} ?>

		       	}

			});

		</script>
</body>
</html>
