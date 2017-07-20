<script>
//swal('Hello world!');
app.controller("order_sale_ctrl", function($scope, $http, $uibModal, $log) {
  <?php if (isset($orders_detail_data)): ?>

  $scope.initget_order = function() {
          $http({
           method: 'POST',
           url: '<?php echo base_url('orders_sale/get_order');?>',
           headers: {
           'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: { order_id : "<?php echo $orders_data['order_id'] ?>"}
        }).then(function onSuccess(response) {
          if(response.status = 200){
              $scope.order_list = response.data;
          }
        }).catch(function onError(response)  {
          console.log(response.status);
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
       }).then(function onSuccess(response) {
         if(response.status = 200){
             $scope.orders_detail = response.data;
         }
       }).catch(function onError(response)  {
         console.log(response.status);
       });
    }
    $scope.initget_order ();
    $scope.initget_order_detail();

  $scope.edit_ordes= function (row_data)  {
    swal(row_data.line_number + ' '+ row_data.part_number+' '+ row_data.order_id);
  }


  $scope.open = function (row_data) {
    $scope.items = row_data;

     var modalInstance = $uibModal.open({
       animation: $scope.animationsEnabled,
       templateUrl: 'myModalContent.html',
       controller: 'ModalInstanceCtrl',
       size: "lg",
       resolve: {
         items: function () {
           return $scope.items;
         }
       }
     });

     $scope.animationsEnabled = true;
     modalInstance.result.then(function () {
       $scope.initget_order ();
       $scope.initget_order_detail();
       console.log("---->save");
     }, function () {
       $log.info('Modal dismissed at: ' + new Date());
     });
   };

   $scope.toggleAnimation = function () {
     $scope.animationsEnabled = !$scope.animationsEnabled;
   };

  <?php endif ?>
});

angular.module('ui.bootstrap').controller('ModalInstanceCtrl', function ($scope,$http, $uibModalInstance, items) {
    $scope.items = items;

    $scope.ok = function () {
      $uibModalInstance.close();
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };

  $scope.save_edit = function () {
    console.log($scope.order_detail);
  };

});

</script>

<?php if (isset($orders_detail_data)): ?>

<script type="text/ng-template" id="myModalContent.html">
  <div class="modal-header">
    <h4>Edit (<span ng-bind="items.part_number"></span>) <small><span ng-bind="items.product_name"></span></small></h4>
    <p><strong ng-bind="items.type_name"></strong> <span ng-bind="items.type_description"></span></p>
  </div>
  <div class="modal-body">
    <form role="form"  ng-submit="save_edit(order_detail)">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">discount_sla_type_value</label>
                        <input type="text" class="form-control required" ng-model="order_detail.discount_sla_type_value" ng-init="order_detail.discount_sla_type_value = items.discount_sla_type_value"  ng-value="items.discount_sla_type_value | number" required>
                        <input type="hidden" ng-model="order_detail.order_id"  ng-init="order_detail.order_id = items.order_id" ng-value="items.order_id" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">discount_of_contract_value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.discount_of_contract_value" ng-init="order_detail.discount_of_contract_value = items.discount_of_contract_value"   ng-value="items.discount_of_contract_value | number" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">discount_of_qty_value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.discount_of_qty_value" ng-init="order_detail.discount_of_qty_value = items.discount_of_qty_value"   ng-value="items.discount_of_qty_value | number" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">province_name</label>
                        <input type="text" class="form-control required" ng-model="order_detail.province_name" ng-init="order_detail.province_name = items.province_name"   ng-value="items.province_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">pm_time_qty</label>
                      <input type="text" class="form-control required" ng-model="order_detail.pm_time_qty" ng-init="order_detail.pm_time_qty = items.pm_time_qty"   ng-value="items.pm_time_qty | number" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">pm_time_value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.pm_time_value" ng-init="order_detail.pm_time_value = items.pm_time_value"   ng-value="items.pm_time_value | number" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">lb_year_qty</label>
                      <input type="text" class="form-control required" ng-model="order_detail.lb_year_qty"  ng-init="order_detail.lb_year_qty = items.lb_year_qty"  ng-value="items.lb_year_qty | number" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">lb_year_value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.lb_year_value" ng-init="order_detail.lb_year_value = items.lb_year_value"   ng-value="items.lb_year_value | number" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">qty</label>
                        <input type="text" class="form-control required" ng-model="order_detail.qty" ng-init="order_detail.qty = items.qty"   ng-value="items.qty  | number" required>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
  </div>
    <pre>{{items}}</pre>
</script>

<?php endif ?>
