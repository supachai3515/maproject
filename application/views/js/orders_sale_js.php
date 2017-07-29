<script>
//swal('Hello world!');
app.controller("order_sale_ctrl", function($scope, $http, $uibModal, $log, $q) {
  $scope.master_init_data = {};
  var char_search = '';
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

  //Get master data
  get_master().then(function(result) {
    $scope.master_init_data =  result.data;
  });

  function get_master() {
    var defer = $q.defer();
    $http({
          method: 'GET',
          url: '<?php echo base_url('orders_sale/get_master_order_data');?>',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function sucess(response) {
        defer.resolve(response);
      }, function error(reason){
        defer.reject(reason);
      });
      return defer.promise;
  }

  $scope.add_order = function(order_info) {
    $uibModal.open({
        templateUrl: 'add_order_view.html',
        size: 'lg',
        controller: ['$scope', '$uibModalInstance', '$q', function($sc, $uib, $q) {
          $sc.selected_products = [];

          $sc.input_Select = function(val) {
            char_search = val;
            if(val && val.length >= 3) {
              $sc.products = [];
              $http({
                      method: 'POST',
                      url: '<?php echo base_url('home/get_products');?>',
                      headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                      data: {search: val}
                  }).then(function success(response) {
                    $sc.products = response.data;
                  }, function error(reason) {

                  });

            }
          }
          $sc.search_product = function() {
            if(!char_search)
              return;
            $http({
                    method: 'POST',
                    url: '<?php echo base_url('home/get_products');?>',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                    data: {search: char_search}
                }).then(function success(result) {
                  $uibModal.open({
                      templateUrl: 'result_search_product_modal.html',
                      controller: ['$scope', '$uibModalInstance', function($scp, $uib) {
                        $scp.result_products = result.data;
                        $scp.selected_model = '';
                        $scp.selected = [];

                        $scp.add_select_product = function() {
                            if($scp.selected_model) {
                              var product = $scp.result_products[$scp.selected_model];
                              var item = $.extend({}, product, {'qty': order_info.qty});
                              $sc.selected_products.push(item)
                            }
                            $sc.products = [];
                            $uib.close();
                        }
                        $scp.cancel = function () {
                            $uib.dismiss('cancel');
                        }
                      }]
                  });
                }, function error() {

                });
          }
          $sc.add_product_list = function(val) {
            $sc.products = [];
            var item = $.extend({}, {'is_have_product': '1'}, val, {'qty': order_info.qty}, {'order_id': order_info.order_id});
            $sc.selected_products.push(item);
          }

          $sc.cancel = function () {
              $uib.dismiss('cancel');
          }
        }]
    });
  }

  //Edit order
  $scope.edit_order = function (row_data) {
    $uibModal.open({
        templateUrl: 'edit_order_view.html',
        size: 'lg',
        controller: ['$scope', '$uibModalInstance', '$q', function($sc, $uib, $q) {
          $sc.pm_val = ["1","2","3","4","5"];
          $sc.order_detail = row_data;
          var qty_discount =  $scope.master_init_data.discount_qty;
          var contract_discount =  $scope.master_init_data.discount_contract;
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

          $sc.$watch('order_detail.qty', function(val) {
            if(val) {
              for (var i = 0; i < qty_discount.length; i++) {
                if(val == qty_discount[i].from_number) {
                  $sc.order_detail.discount_of_qty_value = qty_discount[i].discount;
                  return false;
                } else if (val > 5) {
                  $sc.order_detail.discount_of_qty_value = '50';
                  return false;
                }
              }
            }
          });

          $sc.$watch('order_detail.contract_qty', function(val) {
            if(val) {
              for (var i = 0; i < contract_discount.length; i++) {
                if(val == contract_discount[i].number) {
                  $sc.order_detail.discount_of_contract_value = contract_discount[i].discount;
                  return false;
                }
              }
            }
          });
        }]
    });
   };

   $scope.delete_order = function(model) {
     $http({
             method: 'POST',
             url: '<?php echo base_url('orders_sale/del_save_detail');?>',
             headers: {'Content-Type': 'application/x-www-form-urlencoded'},
             data: model
           }).then(function(response) {
             swal(
               '',
               'Delete Order successfully',
               'success'
             )
           }, function(reason) {
             swal(
               'Error!',
               'Order delete failed',
               'error'
             )
           });
   }

  <?php endif ?>
});

</script>

<?php if (isset($orders_detail_data)): ?>

  <script type="text/ng-template" id="add_order_view.html">
    <div class="modal-header">
      <h4>Add Order</h4>
    </div>
    <div class="modal-body">
      <div class="input-group" style="margin-bottom: 20px;">
        <ui-select ng-model="products.selected" theme="bootstrap" on-select="add_product_list($item)" search-enabled="selected_products.length < 1" ng-disabled="selected_products.length == 1">
          <ui-select-match placeholder="Select or search a products">{{$select.selected.name}}</ui-select-match>
          <ui-select-choices repeat="pd in products" refresh="input_Select($select.search)" refresh-delay="300">
            <span ng-bind-html="pd.part_number | highlight: $select.search"></span><span ng-bind-html="pd.name | highlight: $select.search"></span>
          </ui-select-choices>
        </ui-select>
        <span class="input-group-btn">
          <button type="button" ng-click="search_product()" class="btn btn-default" ng-disabled="selected_products.length == 1">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
      <form role="form"  ng-submit="save_edit(order_detail)">
          <div class="box-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th class="col-md-2 text-center">Part number</th>
                  <th class="col-md-4 text-center">Name</th>
                  <th class="col-md-3 text-center">Medel</th>
                  <th class="col-md-1 text-center">QTY</th>
                  <th class="col-md-2 text-center">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr ng-repeat="(idx, p) in selected_products track by idx">
                  <td class="text-center">{{p.part_number || '-'}}</td>
                  <td>{{p.name || '-'}}</td>
                  <td class="text-center">{{p.model || '-'}}</td>
                  <td class="text-center">{{p.qty || '-'}}</td>
                  <td class="text-center"><i class="fa fa-minus-circle text-danger del-icon" aria-hidden="true" ng-click="remove_product_list(idx)"></i></td>
                </tr>
                <tr ng-if="!selected_products.length">
                  <td colspan="8" class="text-center">-</td>
                </tr>
              </tbody>
            </table>
          </div><!-- /.box-body -->
          <div class="box-footer">
              <input type="submit" class="btn btn-primary" value="Next" />
          </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
    </div>
  </script>

  <script type="text/ng-template" id="result_search_product_modal.html">
      <div class="modal-header text-center"><h4>เลือกสินค้า</h4></div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="col-md-3">Part number</th>
              <th class="col-md-4">Name</th>
              <th class="col-md-4">Medel</th>
              <th class="col-md-1">select</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="(idx, p) in result_products track by idx">
              <td class="text-center">{{p.part_number || '-'}}</td>
              <td>{{p.name || '-'}}</td>
              <td class="text-center">{{p.model || '-'}}</td>
              <td>
                <div class="checkbox text-center">
                  <label for="is_select_{{idx}}"><input type="radio"  id="is_select_{{idx}}"  name="is_select" value="{{idx}}" ng-model="$parent.selected_model"></label>
                </div>
              </td>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="button" ng-click="add_select_product()">Add</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
      </div>
    </script>

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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">จังหวัด</label>
                        <select class="form-control" name="contract" ng-model="order_detail.province_id" required>
                          <?php foreach ($province_list as $record): ?>
                            <option value="<?php echo $record->province_id ?>"><?php echo $record->province_name ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">PM</label>
                      <select class="form-control" name="pm" ng-model="order_detail.pm_time_qty" required>
                        <option value="">Select</option>
                        <option value="{{pm}}" ng-repeat="pm in pm_val">{{pm}}</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="name">PM Time Value</label>
                    <input type="text" class="form-control required" ng-model="order_detail.pm_time_value">
                  </div>
              </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">LB Year Value</label>
                      <input type="text" class="form-control required" ng-model="order_detail.lb_year_value">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">QTY</label>
                        <input type="number" class="form-control required" string-to-number ng-model="order_detail.qty">
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
