
<script type="text/javascript">

app.controller("home_ctrl", function($scope, $http, $uibModal, $log, $q, $location) {
  var char_search = '';
  $scope.order_step = 1;
  $scope.pm_list = ["1","2","3","4","5"];
  $scope.info_form = {};
  $scope.info = {};
  $scope.order = {};
  $scope.products = [];
  $scope.selected_products = [];
  $scope.result_products_list = [];
  $scope.result_cal_product = [];

  $scope.input_Select = function(val) {
    char_search = val;
    if(val && val.length >= 3) {
      $scope.products = [];
      $http({
              method: 'POST',
              url: '<?php echo base_url('home/get_products');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: {search: val}
          }).success(function(data) {
            $scope.products = data;
          });

    }
  }
    $scope.add_product_list = function(val) {
      $scope.products = [];
      var item = $.extend({}, {'part_number': ''}, val, {'qty': 1}, $scope.order);
      $scope.selected_products.push(item);
    }
    $scope.remove_product_list = function(idx) {
      $scope.selected_products.splice(idx,1);
    }

    $scope.search_product = function() {
      if(!char_search)
        return;
      $http({
              method: 'POST',
              url: '<?php echo base_url('home/get_products');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: {search: char_search}
          }).success(function(data) {
            $uibModal.open({
                templateUrl: 'result_search_product_modal.html',
                controller: ['$scope', '$uibModalInstance', function($sc, $uib) {
                  $sc.result_products = data;
                  $sc.selected = [];

                  $sc.add_select_product = function(val) {
                      $.each(val,function(idx, v) {
                        if(v) {
                          var product = $sc.result_products[idx];
                          var item = $.extend({}, product, {'qty': 1}, $scope.order);
                          $scope.selected_products.push(item)
                        }
                      });
                      $scope.products = [];
                      $uib.close();
                  }
                  $sc.cancel = function () {
                      $uib.dismiss('cancel');
                  }
                }]
            });
          });
    }
    $scope.add_product = function() {
      $uibModal.open({
          templateUrl: 'add_product_modal.html',
          controller: ['$scope', '$uibModalInstance', function($sc, $uib) {
            $sc.add_new_product = function (model) {
                var p_model = $.extend({}, {'part_number': ''}, model);
                $scope.selected_products.push(p_model);
                $uib.close();
            }
            $sc.cancel = function () {
                $uib.dismiss('cancel');
            }
          }]
      });
    }

    var dummy_data = {
              	"email": "abc@gmail.com",
              	"name": "Tony Stark",
              	"tel": "123456789",
              	"product_list": [
              		{
              			"brand_name": "Cissco",
              			"model": "SV3200",
              			"name": "1 MSA 1040 2Prt FC DC SFF Strg",
              			"part_number": "E7W00A",
              			"product_owner_id": "2",
              			"province": "10",
              			"contract": "2",
              			"pm": "2",
              			"qty": 1
              		},
              		{
              			"brand_name": "Cissco",
              			"model": "MSA2042",
              			"name": "1 MSA 1040 2Prt 1G iSCSI DC LFF Strg",
              			"part_number": "E7W01A",
              			"product_owner_id": "3",
              			"province": "10",
              			"contract": "2",
              			"pm": "2",
              			"qty": 1
              		},
              		{
              			"brand_name": "Cissco",
              			"model": "WS-C2960C",
              			"name": "1 MSA 1040 2Prt 1G iSCSI DC SFF Strg",
              			"part_number": "E7W02A",
              			"product_owner_id": "4",
              			"province": "10",
              			"contract": "2",
              			"pm": "2",
              			"qty": 1
              		}
              	]
              }

    $scope.submit_products = function() {
      var form = $scope.info_form;
      var info_model = $scope.info;
      //form.submited = true;

      // if(form.$invalid || !$scope.selected_products.length) {
      //   var msg = info_form.$invalid ? 'กรุณากรอกข้อมูลให้ครบ' : 'กรุณาเพิ่มสินค้า';
      //   swal(
      //     '',
      //     msg,
      //     'warning'
      //   )
      //   return;
      // }
      var model = $.extend({}, dummy_data);
      //var model = $.extend({}, info_model, {'product_list': $scope.selected_products});
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: model
          }).success(function(data) {
            $scope.order_step = 2;
            $scope.result_cal_product = data;
          });
    }
 });

 app.filter('propsFilter', function() {
  return function(items, props) {
    var out = [];

    if (angular.isArray(items)) {
      var keys = Object.keys(props);

      items.forEach(function(item) {
        var itemMatches = false;

        for (var i = 0; i < keys.length; i++) {
          var prop = keys[i];
          var text = props[prop].toLowerCase();
          if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
            itemMatches = true;
            break;
          }
        }

        if (itemMatches) {
          out.push(item);
        }
      });
    } else {
      // Let the output be the input untouched
      out = items;
    }

    return out;
  };
});
</script>

<script type="text/ng-template" id="add_product_modal.html">
    <div class="modal-header text-center">
      <h4>เพิ่มสินค้า</h4>
    </div>
    <div class="modal-body">
      <form class="form-horizontal">
        <div class="form-group">
          <label for="email" class="col-md-3 control-label">Name</label>
          <div class="col-md-9">
            <input type="text" name="p_name" ng-model="add_product.name" class="form-control" id="p_name" autofocus>
          </div>
        </div>
        <div class="form-group">
          <label for="name" class="col-md-3 control-label">Model</label>
          <div class="col-md-9">
            <input type="text" name="p_model" ng-model="add_product.model" class="form-control" id="p_model">
          </div>
        </div>
        <div class="form-group">
          <label for="tel" class="col-md-3 control-label">QTY</label>
          <div class="col-md-9">
              <input type="number" name="p_qty" ng-model="add_product.qty" class="form-control" id="p_qty" min="1">
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-success" type="button" ng-click="add_new_product(add_product)">Add</button>
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
                  <label for="is_select_{{idx}}"><input type="checkbox"  id="is_select_{{idx}}" ng-model="selected[idx]"  name="is_select_{{idx}}" value="1"></label>
                </div>
              </td>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="button" ng-click="add_select_product(selected)">Add</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
      </div>
    </script>
