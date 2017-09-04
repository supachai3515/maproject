
<script type="text/javascript">
  app.controller("select_product_ctrl", function($scope, $http, $q) {
    var is_selected = false,
        get_product_data = [];
        selected_products = [];
    $scope.info = {};
    $scope.result_cal_product = [];
    $scope.product_owner = [];
    $scope.product_manual = [];

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
          if(v.is_have_product == 1) {
            $scope.product_owner.push(v)
          } else if(v.is_have_product == 0) {
            $scope.product_manual.push(v)
          }
        });
    });

    // function get_product_desc() {
    //   var deferred = $q.defer();
    //   $http({
    //       method: 'GET',
    //       url: '<?php echo base_url('tos_cal/get_product_des');?>',
    //       headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
    //       data: get_product_data
    //   }).then(function(response) {
    //     deferred.resolve(response.data)
    //   }, function(reason) {
    //     deferred.reject(reason)
    //   });
    //   return deferred.promise;
    // }
    // get_product_desc().then(function(val) {
    //   console.log("----->", val);
    // });

    $scope.update_product_owner = function(key, val) {
      $scope.product_owner.forEach(function(v) {
        if(v.line_number == key) {
          v.selected = v === val;
        }
      });
    }
    $scope.update_product_manual = function(key, val) {
      $scope.product_manual.forEach(function(v) {
        if(v.line_number == key) {
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
      $scope.product_manual.forEach(function(v) {
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
