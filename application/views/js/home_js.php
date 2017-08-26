
<script type="text/javascript">

app.controller("home_ctrl", function($scope, $http, $uibModal, $log, $q, $location) {
  var char_search = '';
  $scope.pm_list = ["1","2","3","4","5"];
  $scope.info_form = {};
  $scope.info = {};
  $scope.order = {};
  $scope.products = [];
  $scope.selected_products = [];
  $scope.result_products_list = [];

  function get_order_info() {
    $http({
            method: 'GET',
            url: '<?php echo base_url('tos_cal/get_session_order_info');?>',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
          var data = response.data;
          $scope.info.email = data.email;
          $scope.info.name = data.name;
          $scope.info.tel = data.tel;
          $scope.order.pm = data.pm;
          $scope.order.contract = data.contract;
          $scope.order.province = data.province;
        }, function(reason) {
          console.log(reason);
        });

  }

function get_order_detail() {
  $http({
          method: 'GET',
          url: '<?php echo base_url('tos_cal/get_session_order_detail');?>',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function(response) {
        var data = response.data;
        $scope.selected_products = data;
      }, function(reason) {
        console.log(reason);
      });
}
get_order_info();
get_order_detail();

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
      var item = $.extend({}, {'is_have_product': '1'}, val, {'qty': 1}, $scope.order);
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
              var p_model = $.extend({}, {'is_have_product': '0'}, model, {'qty': 1}, {'product_owner_id': 0}, $scope.order);
              $scope.selected_products.push(p_model);
              $uib.close();
            }
            $sc.cancel = function () {
                $uib.dismiss('cancel');
            }
          }]
      });
    }

    $scope.submit_products = function() {
      var form = $scope.info_form;
      var info_model = $scope.info;

      form.$submitted = true;

      if(form.$invalid) {
        swal(
          '',
          'กรอกข้อมูลไม่ครบ หรือ กรอกข้อมูลไม่สมบูรณ์',
          'warning'
        )
        return false;
      }

      if(!$scope.selected_products.length) {
        swal(
          '',
          'เพิ่มสินค้าอย่างน้อย 1 อย่าง',
          'warning'
        )
        return false;
      }

      var model = $.extend({}, info_model, $scope.order, {'product_list': $scope.selected_products});
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: model
          }).success(function() {
            window.location = '<?php echo base_url('/select_product');?>';
          }).error(function (error){
            swal(
              'Error!',
              'Technical error please contact the administrator',
              'error'
            )
          });
    }
 });
</script>

<script type="text/ng-template" id="add_product_modal.html">
    <div class="modal-header text-center">
      <h4>เพิ่มสินค้า</h4>
    </div>
    <form class="form-horizontal" name="self_add_product_form">
      <div class="modal-body">
        <div class="form-group">
          <label for="p_number" class="col-md-3 control-label">Part number</label>
          <div class="col-md-9">
            <input type="text" name="p_number" ng-model="add_product.part_number" class="form-control" id="p_number" required>
          </div>
        </div>
        <div class="form-group">
          <label for="p_name" class="col-md-3 control-label">Name</label>
          <div class="col-md-9">
            <input type="text" name="p_name" ng-model="add_product.name" class="form-control" id="p_name" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="button" ng-click="add_new_product(add_product)" ng-disabled="self_add_product_form.$invalid">Add</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
      </div>
    </form>
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
