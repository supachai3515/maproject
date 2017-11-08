<script>
	$(document).ready(function() {
	    $("#file_path").fileinput({
	    	showPreview: false,
	    	showRemove: false,
	      language: "en",
	      <?php if($order_data['file_path']!=""){?>
	          initialPreview: [
	              '<img src="<?php echo $this->config->item('url_img').$order_data['file_path'];?>" class="file-preview-image">'
	          ],
	        <?php } ?>
	        overwriteInitial: false,
	        maxFileSize: 2000,
	    });
	    $("#file_path_2").fileinput({
	    	showPreview: false,
	    	showRemove: false,
	      language: "en",
	      <?php if($order_data['file_path_2']!=""){?>
	          initialPreview: [
	              '<img src="<?php echo $this->config->item('url_img').$order_data['file_path_2'];?>" class="file-preview-image">'
	          ],
	        <?php } ?>
	        overwriteInitial: false,
	        maxFileSize: 2000,
	    });
	 });
</script>

<script type="text/javascript">
app.controller("upload_doc_ctrl", function($scope, $http) {
	$scope.order_status = null;

    function get_order_status(){
      $http({
              method: 'POST',
              url: '<?php echo base_url('tos_cal/get_order_status');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: {id:'<?php echo $order_data['order_id']; ?>'}
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

	$scope.upload_document = function() {
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
        confirm_upload();
      })
	}
	function confirm_upload() {
		$('#btn_upload').click();
	}

});
</script>