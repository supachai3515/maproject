
<script type="text/javascript">
  app.controller("quotation_ctrl", function($scope, $http) {
    $scope.quotation_data = <?php echo json_encode($quotation_data);?>;
    $scope.quotation_detail_data = <?php echo json_encode($quotation_detail_data);?>;

    $scope.save_quotation = function() {
      var data = $.extend({}, {'quotation_data':$scope.quotation_data}, {'quotation_detail_data':$scope.quotation_detail_data})
      $http({
              method: 'POST',
              url: '<?php echo base_url('quotation/edit_save');?>',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              data: data
          }).then(function(response) {
            console.log('=====', response.data)
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
