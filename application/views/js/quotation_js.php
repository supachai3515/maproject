

<script type="text/javascript">
  app.controller("quotation_ctrl", function($scope, $http) {
    $scope.quotation_data = <?php echo json_encode($quotation_data);?>;
    $scope.quotation_detail_data = <?php echo json_encode($quotation_detail_data);?>;
    var logo_path = '',
        sale_manager_sign_path = '',
        sale_sign_path = '',
        edit_type = false;

    $(document).on("ready", function() {

    $("#ow_logo").fileinput({
        showPreview: false,
        uploadUrl: "<?php echo base_url('quotation/upload_file');?>",
        uploadAsync: true,
        minFileCount: 1,
        maxFileCount: 1,
        uploadExtraData: {
            quotation_id: <?php echo $quotation_data['quotation_id'];?>
        }
    }).on("filebatchselected", function(event, files) {
        $("#ow_logo").fileinput("upload");
    }).on('filesorted', function(e, params) {
        console.log('file sorted', e, params);
    }).on('fileuploaded', function(e, params) {
        console.log('file uploaded', e, params);
        logo_path = params.response['ow_logo'];
    });

    $("#sale_manager_signature").fileinput({
        showPreview: false,
        uploadUrl: "<?php echo base_url('quotation/upload_file');?>",
        uploadAsync: true,
        minFileCount: 1,
        maxFileCount: 1,
        uploadExtraData: {
            quotation_id: <?php echo $quotation_data['quotation_id'];?>
        }
    }).on("filebatchselected", function(event, files) {
        $("#sale_manager_signature").fileinput("upload");
    }).on('filesorted', function(e, params) {
        console.log('file sorted', e, params);
    }).on('fileuploaded', function(e, params) {
        console.log('file uploaded', e, params);
        sale_manager_sign_path = params.response['sale_manager_signature'];
    });

    $("#sale_signature").fileinput({
        showPreview: false,
        uploadUrl: "<?php echo base_url('quotation/upload_file');?>",
        uploadAsync: true,
        minFileCount: 1,
        maxFileCount: 1,
        uploadExtraData: {
            quotation_id: <?php echo $quotation_data['quotation_id'];?>
        }
    }).on("filebatchselected", function(event, files) {
        $("#sale_signature").fileinput("upload");
    }).on('filesorted', function(e, params) {
        console.log('file sorted', e, params);
    }).on('fileuploaded', function(e, params) {
        console.log('file uploaded', e, params);
        sale_sign_path = params.response['sale_signature'];
    });


  });

    $scope.cal_quotation = function(val) {
      var price = Number(val);
      var reg = /^\d+$/;
      if(val && reg.test(price)) {
        var subtotal = 0;
        for (var i = 0; i <= $scope.quotation_detail_data.length - 1; i++) {
          subtotal += Number($scope.quotation_detail_data[i].total);
        }
        $scope.quotation_data.sub_total = String(subtotal.toFixed(4));
        $scope.quotation_data.vat = String((subtotal*0.07).toFixed(4));
        $scope.quotation_data.total = String((subtotal+(subtotal*0.07)).toFixed(4));
      }
    }

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
      if(logo_path) {
        $scope.quotation_data.ow_logo = logo_path;
      }
      if(sale_manager_sign_path) {
        $scope.quotation_data.sale_manager_signature = sale_manager_sign_path;
      }
      if(sale_sign_path) {
        $scope.quotation_data.sale_signature = sale_sign_path;
      }
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
