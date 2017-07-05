
<script type="text/javascript">

app.controller("home_ctrl", function($scope, $http, $uibModal, $log) {

  $http({
            method: 'GET',
            url: '<?php echo base_url('home/get_products');?>',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data) {
          var products = data;
            console.log('------------',products);
          });


  $scope.product_credit_note = [];
   $scope.items = { return_id : '',
           order_id : '',
           serial : '' ,
           product_id : '' ,
         product_name : '',
          product_price : '' };

   $scope.open = function () {

      var modalInstance = $uibModal.open({
        animation: $scope.animationsEnabled,
        templateUrl: 'myModalContent.html',
        controller: 'ModalInstanceCtrl',
        size: "",
        resolve: {
          items: function () {
            return $scope.items;
          }
        }
      });


      $scope.animationsEnabled = true;
      modalInstance.result.then(function (selectedItem) {
       $scope.items = selectedItem;
       $scope.order_id = $scope.items.order_id;
       $scope.return_id = $scope.items.return_id;
       $scope.serial = $scope.items.serial;
       $scope.product_id = $scope.items.product_id;
     $scope.product_name = $scope.items.product_name;
     $scope.product_price = $scope.items.product_price;

        console.log($scope.items);
      }, function () {
        $log.info('Modal dismissed at: ' + new Date());
      });
    };

    $scope.toggleAnimation = function () {
      $scope.animationsEnabled = !$scope.animationsEnabled;
    };

    $scope.products = [
    { name: 'Adam',      email: 'adam@email.com',      age: 12, country: 'United States' },
    { name: 'Amalie',    email: 'amalie@email.com',    age: 12, country: 'Argentina' },
    { name: 'Estefanía', email: 'estefania@email.com', age: 21, country: 'Argentina' },
    { name: 'Adrian',    email: 'adrian@email.com',    age: 21, country: 'Ecuador' },
    { name: 'Wladimir',  email: 'wladimir@email.com',  age: 30, country: 'Ecuador' },
    { name: 'Samantha',  email: 'samantha@email.com',  age: 30, country: 'United States' },
    { name: 'Nicole',    email: 'nicole@email.com',    age: 43, country: 'Colombia' },
    { name: 'Natasha',   email: 'natasha@email.com',   age: 54, country: 'Ecuador' },
    { name: 'Michael',   email: 'michael@email.com',   age: 15, country: 'Colombia' },
    { name: 'Nicolás',   email: 'nicolas@email.com',    age: 43, country: 'Colombia' }
  ];


 });

 angular.module('ui.bootstrap').controller('ModalInstanceCtrl', function ($scope,$http, $uibModalInstance, items) {
    $scope.items = items;
    $scope.order_data;

    $scope.ok = function () {
      $uibModalInstance.close($scope.items);
    };

  $scope.cancel = function () {
   $uibModalInstance.dismiss('cancel');
  };

  $scope.searchOrder = function () {
   if($scope.search_order.length > 0){

    $http({
              method: 'POST',
              url: '<?php echo base_url('credit_note/get_search_order');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: { search : $scope.search_order }
          }).success(function(data) {
              var order_data = data;
              $scope.order_data = order_data;
    });

   }

  };


  $scope.selectOrder = function (data_v){

   $scope.items.return_id = data_v.return_id;
      $scope.items.order_id = data_v.order_id;
      $scope.items.serial = data_v.serial_number;
      $scope.items.product_id = data_v.product_id;
    $scope.items.product_name  = data_v.product_name;
    $scope.items.product_price = data_v.product_price;
   $uibModalInstance.close($scope.items);
  };


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

<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
      <h4>เลือกใบสั่งซื้อ</h4>
    </div>
    <div class="modal-body">
      <form class="form-inline" role="form" ng-submit="searchOrder(search_order)">
        <div class="form-group">
          <label class="sr-only" for="">รหัสสินค้า , เลขที่ใบสั่งซื้อ</label>
          <input type="text" class="form-control" ng-model="search_order" ng-init="search_order =''" placeholder="รหัสสินค้า , เลขที่สั่งซื้อ">
        </div>
        <button type="submit" class="btn btn-primary">ค้นหา</button>
      </form>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Serial Number</th>
              <th>วันที่</th>
              <th>Products</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="value in order_data">
              <td>
                ใบรับคืน : <span ng-bind="value.return_id"></span>/<span ng-bind="value.return_docno"></span>
                <br> ใบสั่งซื้อ : <span ng-bind="value.order_id"></span>/<span ng-bind="value.invoice_no"></span>
                <br>
              </td>
              <td>
                <span ng-bind="value.serial_number"></span>
                <br>
              </td>
              <td><span ng-bind="value.create_date"></span></td>
              <td>
                SKU : <span ng-bind="value.sku"></span>
                <br> NAME : <span ng-bind="value.product_name"></span>
              </td>
              <td ng-if="value.is_return == 0">
                <button type="button" class="btn btn-info btn-xs" ng-click="selectOrder(value.order_id,value.return_id,value.serial_number)">เลือก</button>
              </td>
              <td ng-if="value.is_return == 1"><span class="label label-default">ทำใบลดหนี้แล้ว</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
    </div>
  </script>
