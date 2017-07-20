
<script type="text/javascript">
  app.controller("special_price_ctrl", function($scope, $http) {
    var ref_id = '<?php echo $ref_id ?>';

    $scope.get_special_price = function() {
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
            } else {
              swal(
                '',
                'ท่านได้ทำการขอราคาพิเศษแล้ว อยู่ระหว่างขั้นตอนการตรวจสอบ กรุณารอการติดต่อกลับ',
                'warning'
              )
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
