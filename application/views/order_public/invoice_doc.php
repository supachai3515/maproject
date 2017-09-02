<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ใบแจ้งชำระเงิน เลขที่ใบสั่งซื้อ <?php echo $order_data['id']." ".$order_data["name"];?> </title>

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
    		<h4><?php echo $this->config->item('short_sitename')?></h4>บริษัท ไซเบอร์ แบต จำกัด 2963 ซ.ลาดพร้าว <br>101/2 ถ.ลาดพร้าว คลองจั่น บางกะปิ กทม. 10310<br>
    	</div>
    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
        <h2>เลขที่ใบสั่งซื้อ #<?php echo  $order_data['order_id'];?> </h2>
        <strong>วันที่ออก <?php echo $order_data['order_date']?></strong><br/>กรุณาชำระเงินภายใน 3 วัน
    	</div>
		</div>
		<div class="row" style="padding-top:10px;">
    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    		<div class="panel panel-default height">
          <div class="panel-heading">ที่อยู่</div>
          <div class="panel-body">
              <strong>ชื่อ: </strong><?php echo $order_data["company"];?><br>
              <strong>ที่อยู่: </strong><?php echo $order_data["address"];?><br>
              <strong>เบอร์ติดต่อ: </strong><?php echo $order_data["tel"];?><br>
              <strong>อีเมล์: </strong><?php echo $order_data["email"];?>
          </div>
        </div>
    	</div>
		</div>

    <!-- <?php pre($order_detail_data); ?> -->
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-default">
	                <div class="panel-body">
	                    <div class="table-responsive">
	                        <table class="table table-condensed">
	                            <thead>
	                                <tr>
	                                    <td class="product-id col-md-3"><strong>Part Number</strong></td>
	                                    <td class="text-center col-md-3"><strong>Description</strong></td>
	                                    <td class="text-center col-md-1"><strong>Type</strong></td>
                                      <td class="text-center col-md-1"><strong>LB Year QTY</strong></td>
                                      <td class="text-center col-md-1"><strong>จังหวัด</strong></td>
                                      <td class="text-center col-md-1"><strong>QTY</strong></td>
                                      <td class="text-center col-md-1"><strong>PM Time QTY</strong></td>
	                                    <td class="text-right col-md-1"><strong>ราคารวม</strong></td>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            <?php foreach ($order_detail_data as $value): ?>
	                            	 <tr>
                										<td><?php echo $value['part_number'] ?></td>

                										<td><?php echo $value['product_description'] ?></td>
                										<td class="text-center"><?php echo $value['type_name'] ?></td>
                                    <td class="text-center"><?php echo $value['lb_year_qty'] ?></td>
                                    <td class="text-center"><?php echo $value['province_name'] ?></td>
                                    <td class="text-center"><?php echo $value['qty'] ?></td>
                                    <td class="text-center"><?php echo $value['pm_time_qty'] ?></td>
                										<td class="text-center"><?php echo number_format($value["total"], 2)?></td>
									               </tr>
	                            <?php endforeach ?>
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
	    		 <div class="panel-heading">การชำระเงิน</div>
	    		<div class="panel-body">
	    		   <?php echo $this->config->item('payment_transfer') ?>
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
