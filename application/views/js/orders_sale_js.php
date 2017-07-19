<script>
//swal('Hello world!');
app.controller("order_sale", function($scope, $http, $uibModal, $log) {
  <?php if (isset($orders_detail_data)): ?>

  $scope.initget_order = function() {
          $http({
           method: 'POST',
           url: '<?php echo base_url('orders_sale/get_order');?>',
           headers: {
           'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: { order_id : "<?php echo $orders_data['order_id'] ?>"}
       }).success(function(data) {
            $scope.order_list = data;
      });
    }

  $scope.initget_order_detail = function() {
          $http({
           method: 'POST',
           url: '<?php echo base_url('orders_sale/get_order_detail');?>',
           headers: {
           'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: { order_id : "<?php echo $orders_data['order_id'] ?>"}
       }).success(function(data) {
            $scope.orders_detail = data;
      });
    }
    $scope.initget_order ();
    $scope.initget_order_detail();
  <?php endif ?>
});
</script>
