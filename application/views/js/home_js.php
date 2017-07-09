
<script type="text/javascript">

app.controller("home_ctrl", function($scope, $http, $uibModal, $log, $q) {
  var char_search = '';
  $scope.pm_list = ["1","2","3","4","5"];
  $scope.order = {};
  $scope.products = [];
  $scope.selected_products = [];

  $scope.input_Select = function(val){
    char_search = val;
    if(val && val.length >= 3){
      $scope.products = [];
      $http({
              method: 'GET',
              url: '<?php echo base_url('home/get_products');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: val
          }).success(function(data) {
            $scope.products = data;
          });

    }
  }
    $scope.add_product = function(val){
      $scope.products = [];
      console.log($scope.order);
      var item = $.extend({}, {'part_number': ''}, val, {'qty': 1}, $scope.order);
      $scope.selected_products.push(item);
    }
    $scope.remove_product = function(idx){
      $scope.selected_products.splice(idx,1);
    }

    $scope.search_product = function() {
      if(char_search){
        console.log('---search---');
      } else {
        console.log('---add---');
      }

      $uibModal.open({
          templateUrl: 'add_product_modal.html',
          controller: ['$scope', '$uibModalInstance', function($sc, $uib) {
            $sc.add_new_product = function (model) {
                var p_model = $.extend({}, {'part_number': ''}, model);
                $scope.selected_products.push(p_model);
                console.log('---add---',$scope.selected_products);
                $uib.close();
            }
            $sc.cancel = function () {
                $uib.dismiss('cancel');
            }
          }]
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
            <input type="text" name="p_name" ng-model="add_product.name" class="form-control" id="p_name">
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
