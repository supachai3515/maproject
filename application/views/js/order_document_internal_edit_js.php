<script>
	app.controller("order_document_internal_edit_ctrl", function($scope, $http) {
    var order_doc_path = '';
    var order_doc_data = <?php echo json_encode($order_document_detail); ?> || '';
    $scope.order = {};

    if(order_doc_data) {
      $scope.order.descripttion = order_doc_data.order_description;
      $scope.order.order_doc_path = order_doc_data.document_path;
    }

    $(document).ready(function() {

      $("#document").fileinput({
        showPreview: false,
        showRemove: false,
        uploadUrl: "<?php echo base_url('order_document_internal/upload_file');?>",
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
      swal({
        title: '',
        text: "ยืนยันการแก้ไข Order",
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
      if(order_doc_path) {
        $scope.order.order_doc_path = order_doc_path;
      }

      var data = $.extend({}, {'order_doc_id': order_doc_data.order_document_id},$scope.order);
      $http({
          method: 'POST',
          url: '<?php echo base_url('order_document_internal/save_order');?>',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
          data: data
      }).then(function(response) {
        swal({
          position: 'center',
          type: 'success',
          title: 'แก้ไข Order สำเร็จ',
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