
<script type="text/javascript">
  app.controller("special_price_ctrl", function($scope, $http, cfpLoadingBar) {
    var ref_id = '<?php echo $ref_id ?>';
    $scope.order_status = null;

    function get_order_status(){
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal/get_order_status');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: {id:'<?php echo $order_data['order_id'] ?>'}
          }).then(function success(result) {
            var status = result.data;
            $scope.order_status = Number(status);
          }, function(err) {
            console.log(err);
            swal(
              'Error!',
              'Technical error please contact the administrator',
              'error'
            )
          });
    }
    get_order_status();

    $scope.canSubmit = function() {
      var status = [1,4];
      return status.includes($scope.order_status);
    }

    var params = {
      confirm_msg: function() {
        var msg = '';
        switch ($scope.order_status) {
          case 1:
            msg = "ยืนยันการขอราคาพิเศษ";
            break;
          case 4:
            msg = "ยืนยันราคาพิเศษ";
            break;
          default:
        }
        return msg;
      },
      url: function() {
        var url = '';
        switch ($scope.order_status) {
          case 1:
            url = '<?php echo base_url('tos_cal/request_special_price');?>';
            break;
          case 4:
            url = '<?php echo base_url('tos_cal/accept_special_price');?>';
            break;
          default:
        }
        return url;
      },
      respond_msg: function() {
        var msg = '';
        switch ($scope.order_status) {
          case 1:
            msg = 'ระบบได้รับเรื่องการขอราคาพิเศษของท่านแล้ว กรุณารอการติดต่อกลับ';
            break;
          case 4:
            msg = 'ระบบได้รับการยืนยันราคาของท่านแล้ว กรุณารอการติดต่อกลับ';
            break;
          default:
        }
        return msg;
      }
    }

    $scope.submit_order = function(){
      swal({
        title: '',
        text: params.confirm_msg(),
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#008CBA',
        cancelButtonColor: '#8388a1',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
      }).then(function () {
        confirm_submit();
      })
    }

    function confirm_submit(){
      $http({
              method: 'POST',
              url: params.url(),
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: { order_id : '<?php echo $order_data['order_id'] ?>'}
          }).then(function success(result) {
              swal(
                '',
                params.respond_msg(),
                'success'
              )
              get_order_status();
          }, function error(reason) {
            swal(
              'Error!',
              'Technical error please contact the administrator',
              'error'
            )
          });
    }

  });
</script>
