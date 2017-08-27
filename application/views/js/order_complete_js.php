
<script type="text/javascript">
  app.controller("order_complete_ctrl", function($scope, $http) {
    $scope.order_info = {};
    $scope.order_detail = [];
    function get_order() {
            $http({
               method: 'POST',
               url: '<?php echo base_url('tos_cal/get_order');?>',
               headers: {'Content-Type': 'application/x-www-form-urlencoded'},
               data: { order_id : order_id}
            }).then(function(response) {
              if(response.status = 200){
                  $scope.order_info = response.data;
              }
            }, function(reason) {
              console.log(reason);
            });
      }

    function get_order_detail() {
            $http({
               method: 'POST',
               url: '<?php echo base_url('tos_cal/get_order_detail');?>',
               headers: {'Content-Type': 'application/x-www-form-urlencoded'},
               data: { order_id : order_id}
           }).then(function(response) {
             if(response.status = 200){
                 $scope.order_detail = response.data;
             }
           }, function(reason) {
             console.log(reason);
           });
      }
      get_order();
      get_order_detail();
  });
</script>
