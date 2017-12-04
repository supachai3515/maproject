
<script type="text/javascript">
  app.controller("order_document_ctrl", function($scope, $http) {
    var order_doc_path = '';
    $scope.order = {};

    $(document).ready(function() {

      $("#document").fileinput({
        showPreview: false,
        showRemove: false,
        uploadUrl: "<?php echo base_url('order_document/upload_file');?>",
        uploadAsync: true,
        minFileCount: 1,
        maxFileCount: 1,
        uploadExtraData: {
            order_document: 'order'
        }
    }).on("filebatchselected", function(event, files) {
        $("#document").fileinput("upload");
    }).on('filesorted', function(e, params) {
        console.log('file sorted', e, params);
    }).on('fileuploaded', function(e, params) {
        console.log('file uploaded', e, params);
        order_doc_path = params.response['order_document'];
    });

   });

    $scope.submit_order_doc = function() {
      if(order_doc_path) {
        $scope.order.order_doc_path = order_doc_path;
      }

      if(!order_doc_path || !$scope.order.descripttion) {
        swal(
          '',
          'กรุณากรอกข้อมูลให้ครบ',
          'warning'
        )
        return false;
      }

      swal({
        title: '',
        text: "ยืนยันการส่งเอกสาร",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5cb85c',
        cancelButtonColor: '#f0ad4e',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
      }).then(function () {
        confirm_submit()
      })

      

    }

    function confirm_submit() {
      $http({
          method: 'POST',
          url: '<?php echo base_url('order_document/save_order');?>',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
          data: $scope.order
      }).then(function(response) {
        $scope.order = {};
        order_doc_path = '';
        $("#document").fileinput("clear");
        swal({
          position: 'center',
          type: 'success',
          title: 'ส่งเอกสารสำเร็จ',
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
