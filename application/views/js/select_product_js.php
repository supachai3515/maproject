
<script type="text/javascript">
  app.controller("select_product_ctrl", function($scope, $http, $q) {
    var is_selected = false,
        selected_products = [];
    $scope.info = {};
    $scope.result_cal_product = [];
    $scope.product_owner = [];
    $scope.product_vendor = [];

    var get_info = $http({
                        method: 'GET',
                        url: '<?php echo base_url('tos_cal/get_info');?>',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
                    }).success(function() {
                    });

    var get_cal_product = $http({
                              method: 'GET',
                              url: '<?php echo base_url('tos_cal/get_cal_product');?>',
                              headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
                          }).success(function() {
                          });

    $q.all([get_info, get_cal_product]).then(function(values) {
        $scope.info = values[0].data;

        $.each(values[1].data, function(idx, val) {
          val.selected = false;
        });
        $scope.result_cal_product = values[1].data;

        $scope.result_cal_product.forEach(function(v) {
            v.selected = false;
            if((v.is_product_owner == 1) && (v.is_have_product == 1)) {
              $scope.product_owner.push(v)
            } else if((v.is_product_owner == 0) && (v.is_have_product == 1)) {
              $scope.product_vendor.push(v)
            }
        });
    });

    $scope.update_product_owner = function(product, val) {
      $scope.product_owner.forEach(function(v) {
        if(v.product_owner_id == product) {
          v.selected = v === val;
        }
      });
    }
    $scope.update_product_vender = function(product, val) {
      $scope.product_vendor.forEach(function(v) {
        if(v.product_owner_id == product) {
          v.selected = v === val;
        }
      });
    }

    $scope.back_add_product = function() {
      window.location = '<?php echo base_url();?>'
    }
    $scope.submit_products = function() {
      selected_products = [];
      is_selected = false;
      $scope.product_owner.forEach(function(v) {
        if(v.selected) {
          is_selected = true;
          selected_products.push(v);
        }
      });
      $scope.product_vendor.forEach(function(v) {
        if(v.selected) {
          is_selected = true;
          selected_products.push(v);
        }
      });

      if(!is_selected) {
        swal(
          '',
          'โปรดเลือกสินค้าอย่างน้อย 1 อย่าง',
          'warning'
        )
        return false;
      }

      $http({
              method: 'POST',
              url: '<?php echo base_url('confirm_order/set_confirm_order_session');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: {'info':$scope.info,'detail':selected_products}
          }).then(function(data) {
            window.location = '<?php echo base_url('/confirm_order');?>';
          }, function(reason) {
            console.log(reason);
          });
    }

  });
</script>
