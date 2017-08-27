
<script type="text/javascript">
  app.controller("confirm_order_ctrl", function($scope, $http) {
    $scope.order_info = {};
    $scope.order_detail = [];
    function get_order() {
      $http({
              method: 'GET',
              url: '<?php echo base_url('confirm_order/get_confirm_order_session');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
          }).then(function(response) {
            var data = response.data
            $scope.order_info = data.info;
            $scope.order_detail = data.detail;
          }, function(reason) {
            console.log(reason);
          });

    }
    get_order();

    $scope.back_select_product = function() {
      window.location = '<?php echo base_url('select_product');?>'
    }

    $scope.submit_products = function() {
      swal({
        title: 'ยืนยันการสั่งสินค้า?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#f0ad4e',
        confirmButtonText: 'Confirm'
      }).then(function () {
        confirm_submit()
      })
    }

    function confirm_submit() {
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal/save_order');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: $scope.order_detail
          }).then(function(response) {
            var data = response.data;
            var ref_id = data.order_id.ref_id;
            var url = '<?php echo base_url('tos_cal/confirm_order');?>';
            if(ref_id) {
              window.location = url+'/'+ref_id;
            } else {
              swal(
                'Error!',
                'Technical error please contact the administrator',
                'error'
              )
            }
          }, function(reason) {
            console.log(reason);
            swal(
              'Error!',
              'Technical error please contact the administrator',
              'error'
            )
          });
    }
  });
</script>
