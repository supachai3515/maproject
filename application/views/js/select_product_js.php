
<script type="text/javascript">
  app.controller("select_product_ctrl", function($scope, $http, $q) {
    var is_selected = false,
        selected_products = [];
    $scope.info = {};
    $scope.result_cal_product = [];

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
                          });;

    $q.all([get_info, get_cal_product]).then(function(values) {
        $scope.info = values[0].data;

        $.each(values[1].data, function(idx, val) {
          val.selected = false;
        })
        $scope.result_cal_product = values[1].data;
    });

    $scope.update_product_select = function(product, val) {
      $scope.result_cal_product.forEach(function(v) {
        if(v.product_owner_id == product) {
          v.selected = v === val;
        }
      });
    }

    $scope.submit_products = function() {
      selected_products = [];
      is_selected = false;
      $scope.result_cal_product.forEach(function(v) {
        if(v.selected) {
          is_selected = true;
          selected_products.push(v);
        }
      });

      if(is_selected !== true) {
        console.log('Please select product least one');
        return false;
      }
      console.log('save---->',selected_products);
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal/save_order');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: selected_products
          }).success(function(data) {
              console.log('response---->', data);
          });
    }

  });
</script>