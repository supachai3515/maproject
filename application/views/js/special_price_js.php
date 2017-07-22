
<script type="text/javascript">
  app.controller("special_price_ctrl", function($scope, $http) {
    var ref_id = '<?php echo $ref_id ?>';
    $scope.special_status = null;

    function get_special_status(){
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal/get_order_status');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: {id:ref_id}
          }).success(function(data) {
            var status = data;
            $scope.special_status = Number(status);
          }).error(function (){
            swal(
              'Error!',
              'Technical error please contact the administrator',
              'error'
            )
          });
    }
    get_special_status();


    $scope.get_special_price = function() {
      switch($scope.special_status) {
        case 1:
          canSubmit();
          break;
        case 2:
          onProcess_special_price();
          break;
        case 3:
          special_price_success();
          break;
        default:

      }
    }

    function canSubmit(){
      swal({
        title: '',
        text: "ยืนยันการขอราคาพิเศษ",
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

    function onProcess_special_price(){
      swal(
        '',
        'ท่านได้ทำการขอราคาพิเศษแล้ว อยู่ระหว่างขั้นตอนการตรวจสอบ กรุณารอการติดต่อกลับ',
        'warning'
      )
    }

    function special_price_success(){
      swal(
        '',
        'คำขอราคาพิเศษของท่านเสร็จสมบูรณ์แล้ว',
        'warning'
      )
    }

    function confirm_submit(){
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal/request_special_price');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: {id:ref_id}
          }).success(function(data) {
            if(data.success) {
              swal(
                '',
                'ระบบได้รับเรื่องการขอราคาพิเศษของท่านแล้ว กรุณารอการติดต่อกลับ',
                'success'
              )
              get_special_status();
            }
          }).error(function (){
            swal(
              'Error!',
              'Technical error please contact the administrator',
              'error'
            )
          });
    }

  });
</script>
