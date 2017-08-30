
<script type="text/javascript">
  app.controller("order_complete_ctrl", function($scope, $http, $q) {
    $scope.order_info = {};
    $scope.order_detail = [];

    var url_string = window.location.href;
    var url = new URL(url_string);
    var ref_id = url.searchParams.get("id");

    function get_order() {
        var deferred = $q.defer();
        $http({
           method: 'POST',
           url: '<?php echo base_url('tos_cal/get_order_by_ref');?>',
           headers: {'Content-Type': 'application/x-www-form-urlencoded'},
           data: { id : ref_id}
        }).then(function(response) {
          deferred.resolve(response.data);
        }, function(reason) {
          deferred.reject(reason.data);
        });
        return deferred.promise;
      }
      get_order().then(function(result){
        swal(
          '',
          'การสั่งซื้อสินค้าสำเร็จ',
          'success'
        )
        $scope.order_info = result.order_info;
        $scope.order_detail = result.order_detail;
      });
  });
</script>
