<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ใบเสนอราคา</title>

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
	<div style="padding-top:30px;"></div>
	<div class="container fix-container" ng-init="orderSenmailInit()">
		<div class="row">
	    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	    		<img src="<?php echo base_url('theme');?>/img/logo/logo.png" style="width: 200px"/>
	    		<h2>บริษัท เทิร์นออน โซลูชั่น จำกัด</h2>
	    		<h4>TURN ON SOLUTION CO., LTD. </h4>
	    	</div>
	    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
	    		<p style="float: right;" class="col-xs-6 col-sm-6 col-md-6 col-lg-6"><img src="<?php echo base_url(); ?>assets/images/LOGO_TOS.png" class="img-thumbnail"></p>
	    	</div>
		</div>
		<div class="row" style="padding-top:10px;">
    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<p>Level 29, The Offices at Centralworld 999/9 Rama I Road, Pathumwan Bangkok 10330 Thailand<br>Telephone: 02-576-0385-6, Fax 02-576-0387<br>Website : www.turnonsolution.co.th , info@turnonsolution.co.th<br>เลขประจำตัวผู้เสียภาษีอากร :  0105558094400</p>
    	</div>
		</div>

    <!-- <?php pre($order_detail_data); ?> -->
    	<div class="panel panel-primary" style="margin-top:30px;">
	    	<div class="panel-heading">
			    <h3 class="panel-title text-center">QUOTATION / ใบเสนอราคา</h3>
			</div>
			<div class="panel-body">
			    <div class="row">
			    	<div class="col-md-6"><strong>Name:</strong>  <?php echo $order_data["company"];?></div>
			    	<div class="col-md-6"><strong>Quotation No.</strong></div>
			    </div>
			    <div class="row">
			    	<div class="col-md-6"><strong>Company:</strong>  <?php echo $order_data["company"];?></div>
			    	<div class="col-md-6"><strong>Date :</strong></div>
			    </div>
			    <div class="row">
			    	<div class="col-md-6"><strong>Address:</strong>  <?php echo $order_data["address"];?></div>
			    	<div class="col-md-6"><strong>Tel :</strong>  <?php echo $order_data["tel"];?></div>
			    </div>
			    <div class="row">
			    	<div class="col-md-6"><strong>E-mail:</strong>  <?php echo $order_data["email"];?></div>
			    	<div class="col-md-6"><strong>Fax :</strong></div>
			    </div>
			    <div class="row">
			    	<div class="col-md-6"><strong>Page:</strong></div>
			    </div>
			</div>
    	</div>
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-default">
	            	<div class="panel-heading"><h3 class="panel-title">Subject :</h3></div>
	                <div class="panel-body">
	                    <div class="table-responsive">
	                        <table class="table table-condensed">
	                            <thead>
	                                <tr>
	                                <th class="text-center">No.</th>
	                                  <th class="text-center"><strong>Part Number</strong></th>
	                                  <th class="text-center"><strong>Description</strong></th>
	                                  <th class="text-center"><strong>MA-TYPE</strong></th>
                                      <th class="text-center"><strong>Unit</strong></td>
                                      <th class="text-center"><strong>Unit Price</strong></th>
                                      <th class="text-center"><strong>Amount</strong></th>
                                      <th class="text-center"><strong>PM Time QTY</strong></th>
	                                    <th class="text-right"><strong>Cost Total</strong></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            <?php foreach ($order_detail_data as $value): ?>
	                            	 <tr>
	                            	 	<td class="text-center"><?php echo $value['line_number'] ?></td>
                										<td class="text-center"><?php echo $value['part_number'] ?></td>

                										<td><?php echo $value['product_description'] ?></td>
                										<td class="text-center"><?php echo $value['type_name'] ?></td>
                                    <td class="text-center"><?php echo $value['lb_year_qty'] ?></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"><?php echo $value['qty'] ?></td>
                                    <td class="text-center"><?php echo $value['pm_time_qty'] ?></td>
                										<td class="text-center"><?php echo number_format($value["total"], 2)?></td>
									               </tr>
	                            <?php endforeach ?>
	                            <tr>
	                            	<td class="text-right" colspan="7"><strong>SUB TOTAL :</strong></td>
	                            	<td class="text-left" colspan="2">140000</td>
	                            </tr>
	                            <tr>
	                            	<td class="text-right" colspan="7"><strong>DISCOUNT :</strong></td>
	                            	<td class="text-left" colspan="2">140000</td>
	                            </tr>
	                            <tr>
	                            	<td class="text-right" colspan="7"><strong>VAT 7 % :</strong></td>
	                            	<td class="text-left" colspan="2">140000</td>
	                            </tr>
	                            <tr>
	                            	<td class="text-right" colspan="7"><strong>TOTAL :</strong></td>
	                            	<td class="text-left" colspan="2">140000</td>
	                            </tr>
	                            <tr>
	                            	<td class="text-right" colspan="2"><strong>จำนวนเงิน ( BAHT ) : 	</strong></td>
	                            	<td class="text-center" colspan="7">หนึ่งแสนสี่หมื่นเก้าพันแปดร้อยบาทถ้วน	</td>
	                            </tr>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    		<div class="panel panel-default">
	    		 <div class="panel-heading text-center">Terms and Conditions</div>
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
	                    		<td class="text-center"></td>
	                    		<td class="text-center"></td>
	                    		<td class="text-center"></td>
	                    		<td class="text-center"></td>
	                    	</tr>
	                    </tbody>
					</table>
					<table class="table table-condensed">
	    		  		<thead>
	                        <tr>
	                          <th class="text-center"><strong>Approve by</strong></th>
	                          <th class="text-center"><strong>Purchase approved in accordance with this quotation</strong><br>(อนุมัติสั่งซื้อตามใบเสนอราคานี้)	</th>
	                          <th class="text-center"><strong>Best Regards,</strong></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<tr>
	                    		<td class="text-center"></td>
	                    		<td class="text-center"></td>
	                    		<td class="text-center"></td>
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
