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


  $scope.edit_order = function (row_data) {
    $uibModal.open({
        templateUrl: 'edit_order_view.html',
        size: 'lg',
        controller: ['$scope', '$uibModalInstance', '$q', function($sc, $uib, $q) {
          $sc.pm_val = ["1","2","3","4","5"];
          $sc.order_detail = row_data;

          $sc.save_edit = function (model) {
              edit_func(model).then(function(data) {
                swal(
                  '',
                  'Update Order successfully',
                  'success'
                )
                $scope.initget_order_detail();
              });
              $uib.close();
          }

          $sc.cancel = function () {
              $uib.dismiss('cancel');
          }

          function edit_func(model) {
            var defer = $q.defer();
            $http({
                    method: 'POST',
                    url: '<?php echo base_url('orders_sale/edit_save_detail');?>',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: model
                  }).then(function(response) {
                    defer.resolve(response);
                  }, function(reason) {
                    swal(
                      'Error!',
                      'Order update failed',
                      'error'
                    )
                    defer.reject(reason);
                  });
            return defer.promise;
          }
        }]
    });
   };

  <?php endif ?>
});

</script>

<?php if (isset($orders_detail_data)): ?>

<script type="text/ng-template" id="edit_order_view.html">
  <div class="modal-header">
    <h4>Edit (<span ng-bind="order_detail.part_number"></span>) <small><span ng-bind="order_detail.product_name"></span></small></h4>
    <p><strong ng-bind="order_detail.type_name"></strong> <span ng-bind="order_detail.type_description"></span></p>
  </div>
  <div class="modal-body">
    <form role="form"  ng-submit="save_edit(order_detail)">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Discount SLA Type Value</label>
                        <input type="text" class="form-control required" ng-model="order_detail.discount_sla_type_value"  required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Discount Contract Value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.discount_of_contract_value" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Discount QTY Value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.discount_of_qty_value" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">จังหวัด</label>
                        <select class="form-control" name="contract" ng-model="order_detail.province_id" required>
                          <?php foreach ($province_list as $record): ?>
                            <option value="<?php echo $record->province_id ?>"><?php echo $record->province_name ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">PM</label>
                      <select class="form-control" name="pm" ng-model="order_detail.pm_time_qty" required>
                        <option value="">Select</option>
                        <option value="{{pm}}" ng-repeat="pm in pm_val">{{pm}}</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">PM Time Value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.pm_time_value">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Contact QTY</label>
                      <select class="form-control" name="selected_contract_{{idx}}" ng-model="order_detail.contract_qty">
                        <option value="">Select</option>
                        <?php foreach ($contract_list as $record): ?>
                          <option value="<?php echo $record->number ?>"><?php echo $record->number ?> ปี</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">LB Year Value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.lb_year_value">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">QTY</label>
                        <input type="text" class="form-control required" ng-model="order_detail.qty">
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
</script>

<?php endif ?>
