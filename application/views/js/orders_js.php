<script>
app.controller("orders_ctrl", function($scope, $http, $uibModal, $log, $filter, ngTableParams) {

  var data =  JSON.parse('<?php echo json_encode($orders_list); ?>');
  $scope.tableParams = new ngTableParams(
  {
    page: 1,
    count: 10,
    sorting:
        {
            order_id: 'asc'
        }
    },{
    total: data.length, // length of data

    getData: function($defer, params) {
    // use build-in angular filter
    var orderedData = params.sorting() ?
    $filter('orderBy')(data, params.orderBy()) :
    data;
    $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count()));
    }
  });

});
</script>
