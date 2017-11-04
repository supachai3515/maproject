
<script type="text/javascript">
  // $(document).on("ready", function() {
  //   var $el1 = $("#ow_logo");
  //   $el1.fileinput({
  //     uploadUrl: '<?php echo base_url('quotation/upload_file');?>',
  //     uploadAsync: false,
  //     showUpload: false, // hide upload button
  //     showRemove: false, // hide remove button
  //     minFileCount: 1
  //   }).on("filebatchselected", function(event, files) {
  //     $el1.fileinput("upload");
  //   });
  // });

  app.controller("quotation_ctrl", function($scope, $http) {
    $scope.quotation_data = <?php echo json_encode($quotation_data);?>;
    $scope.quotation_detail_data = <?php echo json_encode($quotation_detail_data);?>;
    var edit_type = false;

    $scope.save_quotation = function() {

      swal({
        title: 'ยืนยันการแก้ไขใบเสนอราคา',
        text: "เลือกการแก้ไข",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'แก้ไขใบเสนอราคาเดิม',
        cancelButtonText: 'สร้างเป็นใบใหม่'
      }).then(function () {
        edit_type = false;
        confirm_submit();
      }, function (dismiss) {
        if (dismiss === 'cancel') {
          edit_type = true;
          confirm_submit();
        }
      });
    }

    function confirm_submit() {
      var data = $.extend({}, {'quotation_data':$scope.quotation_data}, {'quotation_detail_data':$scope.quotation_detail_data}, {'edit_type': edit_type})
        $http({
                method: 'POST',
                url: '<?php echo base_url('quotation/edit_save');?>',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                data: data
            }).then(function(response) {
              var data = response.data;
              $scope.quotation_data = data.quotation_data;
              $scope.quotation_detail_data = data.quotation_detail_data;
              swal({
                position: 'center',
                type: 'success',
                title: 'แก้ไขใบเสนอราคาสำเร็จ',
                showConfirmButton: false,
                timer: 1500
              })
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
