
<script type="text/javascript">
  app.controller("order_complete_ctrl", function($scope, $http) {
    $scope.order_info = {};
    $scope.order_detail = [];
    function getQueryVariable(variable) {
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
    }
    var ref_id = getQueryVariable("id");

    $http({
            method: 'POST',
            url: '<?php echo base_url('tos_cal/order_detail');?>',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
            data: {id:ref_id}
        }).success(function(data) {
          if(data) {
            console.log(data);
            $scope.order_info = data.order;
            $scope.order_detail = data.order_detail;
          }
        });
  });
</script>
