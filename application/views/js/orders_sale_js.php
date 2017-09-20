<script>
$(document).on('ready', function() {
    $("#file_path").fileinput({
      language: "th",
      <?php if($orders_data['file_path']!=""){?>
          initialPreview: [
              '<img src="<?php echo $this->config->item('url_img').$orders_data['file_path'];?>" class="file-preview-image">'
          ],
        <?php } ?>
        overwriteInitial: false,
        maxFileSize: 2000,
    });
});
</script>

<script>
//swal('Hello world!');
app.controller("order_sale_ctrl", function($scope, $http, $uibModal, $log, $q) {
  $scope.master_init_data = {};
  $scope.owner_id = '';
  $scope.order_status = null;

  var char_search = '';

  <?php if (isset($orders_detail_data)): ?>
  $scope.initget_order = function() {
          $http({
           method: 'POST',
           url: '<?php echo base_url('orders_sale/get_order');?>',
           headers: {
           'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: { order_id : "<?php echo $orders_data['order_id'] ?>"}
        }).then(function onSuccess(response) {
          if(response.status = 200){
              $scope.order_list = response.data;
          }
        }).catch(function onError(response)  {
          console.log(response.status);
        });
    }

  $scope.initget_order_detail = function() {
          $http({
           method: 'POST',
           url: '<?php echo base_url('orders_sale/get_order_detail');?>',
           headers: {
           'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: { order_id : "<?php echo $orders_data['order_id'] ?>"}
       }).then(function onSuccess(response) {
         if(response.status = 200){
             $scope.orders_detail = response.data;
         }
       }).catch(function onError(response)  {
         console.log(response.status);
       });
    }

    $scope.initget_order();
    $scope.initget_order_detail();

  //Get master data
  get_master().then(function(result) {
    $scope.master_init_data =  result.data;
  });

  function get_master() {
    var defer = $q.defer();
    $http({
          method: 'GET',
          url: '<?php echo base_url('orders_sale/get_master_order_data');?>',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded'}
      }).then(function sucess(response) {
        defer.resolve(response);
      }, function error(reason){
        defer.reject(reason);
      });
      return defer.promise;
  }

  function get_order_status(){
    $http({
            method: 'POST',
            url: '<?php echo base_url('tos_cal/get_order_status');?>',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
            data: {id: "<?php echo $orders_data['order_id'] ?>"}
        }).then(function success(result) {
          var status = result.data;
          $scope.order_status = Number(status);
        }, function(err) {
          swal(
            'Error!',
            'Technical error please contact the administrator',
            'error'
          )
        });
  }
  get_order_status();

  //Add Order
  $scope.add_order = function(order_info) {
    $scope.owner_id = order_info.order_id;
    $uibModal.open({
        templateUrl: 'add_order_view.html',
        size: 'lg',
        backdrop  : 'static',
        controller: ['$scope', '$uibModalInstance', '$q', function($sc, $uib, $q) {
          $sc.selected_products = {};
          $sc.pm_val = ["1","2","3","4","5"];

          $sc.input_search = function(val) {
            char_search = val;
            if(val && val.length >= 3) {
              $sc.products = [];
              $http({
                      method: 'POST',
                      url: '<?php echo base_url('home/get_products');?>',
                      headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                      data: {search: val}
                  }).then(function success(response) {
                    $sc.products = response.data;
                  }, function error(reason) {

                  });

            }
          }
          $sc.btn_search = function() {
            if(!char_search)
              return;
            $http({
                    method: 'POST',
                    url: '<?php echo base_url('home/get_products');?>',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                    data: {search: char_search}
                }).then(function success(result) {
                  $uibModal.open({
                      templateUrl: 'result_search_product_modal.html',
                      controller: ['$scope', '$uibModalInstance', function($scp, $uib) {
                        $scp.result_products = result.data;
                        $scp.selected_model = '';
                        $scp.selected = [];

                        $scp.add_select_product = function() {
                            if($scp.selected_model) {
                              var product = $scp.result_products[$scp.selected_model];
                              var item = $.extend({},{'is_have_product': '1'},product, {'qty': 1}, {'order_id': $scope.owner_id}, {'province': '1'}, {'contract': '1'}, {'pm': '1'});
                              $sc.selected_products = item;
                            }
                            $sc.products = [];
                            $uib.close();
                        }
                        $scp.cancel = function () {
                            $uib.dismiss('cancel');
                        }
                      }]
                  });
                }, function error() {

                });
          }
          $sc.add_product_list = function(val) {
            $sc.products = [];
            var item = $.extend({}, {'is_have_product': '1'}, val, {'qty': 1}, {'order_id': $scope.owner_id}, {'province': '1'}, {'contract': '1'}, {'pm': '1'});
            $sc.selected_products = item;
          }
          $sc.remove_product_list = function(idx) {
            $sc.selected_products = {};
          }

          $sc.cancel = function () {
            swal({
              title: '',
              text: "คุณต้องการออกจากหน้าเพิ่มสินค้า",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#008CBA',
              cancelButtonColor: '#8388a1',
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
            }).then(function () {
              $uib.dismiss('cancel');
            })
          }

          $sc.next_to_choose_product = function() {
            if($sc.isObjectEmpty($sc.selected_products)) {
              swal(
                '',
                'คุณยังไม่ได้เพิ่มสินค้า',
                'warning'
              )
              return;
            }
            $http({
                method: 'POST',
                url: '<?php echo base_url('orders_sale/get_search_product_cal');?>',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                data: $sc.selected_products
            }).then(function success(result) {
              $uib.close();
              $scope.choose_order(result.data);
            }, function error() {
              swal(
                'Error!',
                'Technical error please contact the administrator',
                'error'
              )
            });

          }

          $sc.isObjectEmpty = function(card){
            return Object.keys(card).length === 0;
          }
        }]
    });
  }

  //Choose Order
  $scope.choose_order = function(model) {
    $uibModal.open({
        templateUrl: 'choose_order_view.html',
        size: 'lg',
        backdrop  : 'static',
        controller: ['$scope', '$uibModalInstance', '$q', function($sc, $uib, $q) {
          $sc.result_cal_product = model;
          var is_selected = false,
              choosed_products = {};
          $.each($sc.result_cal_product, function(idx, val) {
            val.selected = false;
          });
          $sc.update_product_owner = function(product, val) {
            $sc.result_cal_product.forEach(function(v) {
              if(v.product_owner_id == product) {
                v.selected = v === val;
              }
            });
          }
          $sc.next_to_edit_order = function() {
            choosed_products = {};
            is_selected = false;
            $sc.result_cal_product.forEach(function(v) {
              if(v.selected) {
                is_selected = true;
                choosed_products = v;
              }
            });

            if(!is_selected) {
              swal(
                '',
                'โปรดเลือกสินค้าอย่างน้อย 1 อย่าง',
                'warning'
              )
              return false;
            }
            $uib.close();
            $scope.edit_choosed_order(choosed_products);
          }
          $sc.cancel = function () {
            swal({
              title: '',
              text: "คุณต้องการออกจากหน้าเลือกสินค้า",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#008CBA',
              cancelButtonColor: '#8388a1',
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
            }).then(function () {
              $uib.dismiss('cancel');
            })
          }
        }]
    });
  }

  //Edit Choosed Order
  $scope.edit_choosed_order = function(model) {
    $uibModal.open({
        templateUrl: 'edit_choosed_order_view.html',
        size: 'lg',
        backdrop  : 'static',
        controller: ['$scope', '$uibModalInstance', '$q', function($sc, $uib, $q) {
          $sc.order_choosed_detail = model;
          $sc.pm_val = ["1","2","3","4","5"];
          var qty_discount =  $scope.master_init_data.discount_qty;
          var contract_discount =  $scope.master_init_data.discount_contract;
          var province_discount =  $scope.master_init_data.discount_province;
          var tos_discount =  $scope.master_init_data.discount_tos;

          $sc.submit_new_order = function(form, val) {
            if(form.$invalid) {
              swal(
                '',
                'กรุณากรอกข้อมูลให้ถูกต้อง',
                'warning'
              )
              return;
            }
            val.order_id = $scope.owner_id;
            $http({
                    method: 'POST',
                    url: '<?php echo base_url('orders_sale/new_save_detail');?>',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
                    data: val
                }).then(function success(result) {
                  swal(
                    '',
                    'เพิ่ม Order สำเร็จ',
                    'success'
                  )
                  $uib.close();
                  $scope.initget_order_detail();
                }, function error(reason) {
                  swal(
                    '',
                    'เพิ่ม Order ล้มเหลว',
                    'error'
                  )
                });
          }

          $sc.$watch('order_choosed_detail.qty', function(val) {
            if(val) {
              for (var i = 0; i < qty_discount.length; i++) {
                if(val == qty_discount[i].from_number) {
                  $sc.order_choosed_detail.discount_of_qty_value = qty_discount[i].discount;
                  return false;
                } else if (val > 5) {
                  $sc.order_choosed_detail.discount_of_qty_value = '50';
                  return false;
                }
              }
            }
          });

          $sc.$watch('order_choosed_detail.contract_qty', function(val) {
            if(val) {
              for (var i = 0; i < contract_discount.length; i++) {
                if(val == contract_discount[i].number) {
                  $sc.order_choosed_detail.discount_of_contract_value = contract_discount[i].discount;
                  return false;
                }
              }
            }
          });

          $sc.discount_for_province =  function(province_id) {
            if(province_id) {
              for (var i = 0; i < province_discount.length; i++) {
                if(province_id == province_discount[i].province_id) {
                  $sc.order_choosed_detail.lb_year_value = province_discount[i].lb_year;
                  $sc.order_choosed_detail.pm_time_value = province_discount[i].pm_time;
                  return false;
                }
              }
            }
          }

          $sc.get_sla_type_min = function(val) {
              var discount_min = '';
              for (var i = 0; i < tos_discount.length; i++) {
                if(tos_discount[i].name == val) {
                  discount_min = tos_discount[i].min;
                  break;
                }
              }
              return discount_min;
          }
          $sc.get_sla_type_max = function(val) {
            var discount_max = '';
            for (var i = 0; i < tos_discount.length; i++) {
              if(tos_discount[i].name == val) {
                discount_max = tos_discount[i].max;
                break;
              }
              
            }
            return discount_max;
          }

          $sc.cancel = function () {
            swal({
              title: '',
              text: "คุณต้องการออกจากหน้าแก้ไขสินค้า",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#008CBA',
              cancelButtonColor: '#8388a1',
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
            }).then(function () {
              $uib.dismiss('cancel');
            });
          }
        }]
    });
  }

  //Edit order
  $scope.edit_order = function(row_data) {
    $uibModal.open({
        templateUrl: 'edit_order_view.html',
        size: 'lg',
        controller: ['$scope', '$uibModalInstance', '$q', function($sc, $uib, $q) {
          $sc.pm_val = ["1","2","3","4","5"];
          $sc.order_detail = row_data;
          var qty_discount =  $scope.master_init_data.discount_qty;
          var contract_discount =  $scope.master_init_data.discount_contract;
          var province_discount =  $scope.master_init_data.discount_province;
          var tos_discount =  $scope.master_init_data.discount_tos;

          $sc.save_edit = function (form, model) {
              if(form.$invalid) {
                swal(
                  '',
                  'โปรดกรอกข้อมูลให้ถูกต้อง',
                  'warning'
                )
                return;
              }
              edit_func(model).then(function(data) {
                swal(
                  '',
                  'แก้ไขสำเร็จ',
                  'success'
                )
                $scope.initget_order_detail();
              });
              $uib.close();
          }

          $sc.cancel = function () {
              $uib.dismiss('cancel');
          }

          function edit_func(model) {
            var defer = $q.defer();
            $http({
                    method: 'POST',
                    url: '<?php echo base_url('orders_sale/edit_save_detail');?>',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    data: model
                  }).then(function(response) {
                    defer.resolve(response);
                  }, function(reason) {
                    swal(
                      'Error!',
                      'Order update failed',
                      'error'
                    )
                    defer.reject(reason);
                  });
            return defer.promise;
          }

          $sc.$watch('order_detail.qty', function(val) {
            if(val) {
              for (var i = 0; i < qty_discount.length; i++) {
                if(val == qty_discount[i].from_number) {
                  $sc.order_detail.discount_of_qty_value = qty_discount[i].discount;
                  return false;
                } else if (val > 5) {
                  $sc.order_detail.discount_of_qty_value = '50';
                  return false;
                }
              }
            }
          });

          $sc.$watch('order_detail.contract_qty', function(val) {
            if(val) {
              for (var i = 0; i < contract_discount.length; i++) {
                if(val == contract_discount[i].number) {
                  $sc.order_detail.discount_of_contract_value = contract_discount[i].discount;
                  return false;
                }
              }
            }
          });

          $sc.discount_for_province =  function(province_id) {
            if(province_id) {
              for (var i = 0; i < province_discount.length; i++) {
                if(province_id == province_discount[i].province_id) {
                  $sc.order_detail.lb_year_value = province_discount[i].lb_year;
                  $sc.order_detail.pm_time_value = province_discount[i].pm_time;
                  return false;
                }
              }
            }
          }
          $sc.get_sla_type_min = function(val) {
            if(val) {
              var discount_min = '';
              for (var i = 0; i < tos_discount.length; i++) {
                if(tos_discount[i].name == val) {
                  discount_min = tos_discount[i].min;
                  break;
                }
                
              }
              return discount_min;
            }
          }
          $sc.get_sla_type_max = function(val) {
            if(val) {
              var discount_max = '';
              for (var i = 0; i < tos_discount.length; i++) {
                if(tos_discount[i].name == val) {
                  discount_max = tos_discount[i].max;
                  break;
                }
              }
              return discount_max;
            }
          }

        }]
    });
   }

   //Delete product
   $scope.delete_order = function(model) {
     swal({
       title: '',
       text: "คุณต้องการลบสินค้า",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#008CBA',
       cancelButtonColor: '#8388a1',
       confirmButtonText: 'ยืนยัน',
       cancelButtonText: 'ยกเลิก',
     }).then(function () {
       $http({
           method: 'POST',
           url: '<?php echo base_url('orders_sale/del_save_detail');?>',
           headers: {'Content-Type': 'application/x-www-form-urlencoded'},
           data: model
         }).then(function success(response) {
           swal(
             '',
             'Delete Order successfully',
             'success'
           )
           $scope.initget_order_detail();
         }, function error(reason) {
           swal(
             'Error!',
             'Order delete failed',
             'error'
           )
         });
     });
   }

   //Send special price
   $scope.approve_order_price_event = function() {
     swal({
       title: '',
       text: "ยืนยันการส่งใบเสนอราคา",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#008CBA',
       cancelButtonColor: '#8388a1',
       confirmButtonText: 'ยืนยัน',
       cancelButtonText: 'ยกเลิก',
     }).then(function () {
       approve_order_price();
     });
   }
   function approve_order_price() {
     var order_id = $scope.order_list.order_id;
     $http({
             method: 'POST',
             url: '<?php echo base_url('orders_sale/send_special_price');?>',
             headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
             data: {id: order_id}
         }).then(function(response) {
           swal(
             '',
             'ส่งใบเสนอราคาสำเร็จ',
             'success'
           )
           get_order_status();
         }, function(reason) {
           swal(
             'Error!',
             'Technical error please contact the administrator',
             'error'
           )
         });
   }

   //Send invoice
   $scope.send_document_event = function() {
     swal({
       title: '',
       text: "ยืนยันการส่งเอกสารสั่งซื้อ",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#008CBA',
       cancelButtonColor: '#8388a1',
       confirmButtonText: 'ยืนยัน',
       cancelButtonText: 'ยกเลิก',
     }).then(function () {
       send_document();
     });
   }
   function send_document() {
     var order_id = $scope.order_list.order_id;
     $http({
           method: 'POST',
           url: '<?php echo base_url('orders_sale/send_invoice_doc');?>',
           headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
           data: {id: order_id}
         }).then(function(response) {
           swal(
             '',
             'ส่งเอกสารสั่งซื้อสำเร็จ',
             'success'
           )
           get_order_status();
         }, function(reason) {
           swal(
             'Error!',
             'Technical error please contact the administrator',
             'error'
           )
         });
   }

  <?php endif ?>
});

</script>
<?php if (isset($orders_detail_data)): ?>

<script type="text/ng-template" id="add_order_view.html">
      <div class="modal-header">
        <h4>Add Order</h4>
      </div>
      <div class="modal-body">
        <div class="input-group" style="margin-bottom: 20px;">
          <ui-select ng-model="products.selected" theme="bootstrap" on-select="add_product_list($item)" search-enabled="isObjectEmpty(selected_products)" ng-disabled="!isObjectEmpty(selected_products)">
            <ui-select-match placeholder="Select or search a products">{{$select.selected.name}}</ui-select-match>
            <ui-select-choices repeat="pd in products" refresh="input_search($select.search)" refresh-delay="300">
              <span ng-bind-html="pd.part_number | highlight: $select.search"></span><span ng-bind-html="pd.name | highlight: $select.search"></span>
            </ui-select-choices>
          </ui-select>
          <span class="input-group-btn">
            <button type="button" ng-click="btn_search()" class="btn btn-default" ng-disabled="!isObjectEmpty(selected_products)">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
        <form role="form">
            <div class="box-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="col-md-2 text-center">Part number</th>
                    <th class="col-md-2 text-center">Name</th>
                    <th class="col-md-2 text-center">Medel</th>
                    <th class="col-md-1 text-center">QTY</th>
                    <th class="col-md-2 text-center">Province</th>
                    <th class="col-md-1 text-center">PM</th>
                    <th class="col-md-1 text-center">Contract</th>
                    <th class="col-md-1 text-center">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-show="!isObjectEmpty(selected_products)">
                    <td class="text-center">{{selected_products.part_number || '-'}}</td>
                    <td>{{selected_products.name || '-'}}</td>
                    <td class="text-center">{{selected_products.model || '-'}}</td>
                    <td>
                      <input type="number" class="form-control text-center"  name="model_qty" ng-model="selected_products.qty" min="1">
                    </td>
                    <td>
                      <select class="form-control" name="model_province" ng-model="selected_products.province">
                        <?php foreach ($province_list as $record): ?>
                          <option value="<?php echo $record->province_id ?>"><?php echo $record->province_name ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="model_pm" ng-model="selected_products.pm">
                        <option value="{{pm}}" ng-repeat="pm in pm_val">{{pm}}</option>
                      </select>
                    </td>
                    <td>
                      <select class="form-control" name="model_contract" ng-model="selected_products.contract">
                        <?php foreach ($contract_list as $record): ?>
                          <option value="<?php echo $record->discount_of_contract_id ?>"><?php echo $record->number ?> ปี</option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td class="text-center"><i class="fa fa-minus-circle text-danger del-icon" aria-hidden="true" ng-click="remove_product_list()"></i></td>
                  </tr>
                  <tr ng-show="isObjectEmpty(selected_products)">
                    <td colspan="8" class="text-center">-</td>
                  </tr>
                </tbody>
              </table>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Next" ng-click="next_to_choose_product()">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
      </div>
  </script>

<script type="text/ng-template" id="choose_order_view.html">
      <div class="modal-header">
        <h4>Choose Order</h4>
      </div>
      <div class="modal-body">
        <form role="form">
            <div class="box-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="col-md-4 text-center">Type</th>
                    <th class="col-md-4 text-center">Description</th>
                    <th class="col-md-2 text-center">Total</th>
                    <th class="col-md-2 text-center">Select</th>
                  </tr>
                </thead>
              </table>
              <table class="table table-striped">
                <tbody>
                  <tr ng-repeat="(key, val) in result_cal_product | groupBy: 'product_owner_id'">
                      <td colspan="4">
                        <table style="width: 100%;">
                          <tr ng-repeat="p in val">
                            <td class="col-md-4 text-center" style="vertical-align: top; padding: 5px 0;">{{p.type_name || '-'}}</td>
                            <td class="col-md-4" style="vertical-align: top; padding: 5px 0;">{{p.type_description || '-'}}</td>
                            <td class="col-md-2 text-center" style="vertical-align: top; padding: 5px 0;">{{(p.total | number:0) || '-'}}</td>
                            <td class="col-md-2 text-center" style="vertical-align: top; padding: 5px 0;"><input type="radio" name="product_owner_{{key}}" ng-click="update_product_owner(key, p)" ng-checked="p.selected"></td>
                          </tr>
                        </table>
                      </td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Next" ng-click="next_to_edit_order()">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
      </div>
  </script>

<script type="text/ng-template" id="edit_choosed_order_view.html">
    <div class="modal-header">
      <h4>Edit (<span ng-bind="order_choosed_detail.type_name"></span>)</h4>
      <p><span ng-bind="order_choosed_detail.type_description"></span></p>
    </div>
    <div class="modal-body">
      <form role="form" name="edit_choosed_order_form">
          <div class="box-body">
              <div class="row">
                  <div class="col-md-4" ng-class="{'has-error': (edit_choosed_order_form.discount_sla.$error.min || edit_choosed_order_form.discount_sla.$error.max) || (edit_choosed_order_form.$submitted && edit_choosed_order_form.discount_sla.$error.required)}">
                      <div class="form-group">
                          <label for="name">Discount SLA Type Value</label>
                          <input type="number"
                            name="discount_sla"
                            class="form-control"
                            ng-model="order_choosed_detail.discount_sla_type_value"
                            ng-min="get_sla_type_min(order_choosed_detail.type_name)"
                            ng-max="get_sla_type_max(order_choosed_detail.type_name)"
                            data-toggle="tooltip"
                            data-placement="right"
                            title="{{get_sla_type_min(order_choosed_detail.type_name)+' - '+get_sla_type_max(order_choosed_detail.type_name)}}"
                            string-to-number
                            required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="name">Discount Contract Value</label>
                        <input type="text"
                          class="form-control"
                          ng-model="order_choosed_detail.discount_of_contract_value"
                          readonly>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                        <label for="name">Discount QTY Value</label>
                        <input type="text"
                          class="form-control"
                          ng-model="order_choosed_detail.discount_of_qty_value"
                          readonly>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="name">จังหวัด</label>
                          <select class="form-control"
                            name="contract"
                            ng-model="order_choosed_detail.province_id"
                            ng-change="discount_for_province(order_choosed_detail.province_id)" required>
                            <?php foreach ($province_list as $record): ?>
                              <option value="<?php echo $record->province_id ?>"><?php echo $record->province_name ?></option>
                            <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">PM</label>
                        <select class="form-control"
                          name="pm"
                          ng-model="order_choosed_detail.pm_time_qty" required>
                          <option value="">Select</option>
                          <option value="{{pm}}" ng-repeat="pm in pm_val">{{pm}}</option>
                        </select>
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6" ng-class="{'has-error': edit_choosed_order_form.pm_time.$error.required}">
                    <div class="form-group">
                      <label for="name">PM Time Value</label>
                      <input type="text"
                        name="pm_time"
                        class="form-control"
                        ng-model="order_choosed_detail.pm_time_value" required>
                    </div>
                </div>
                  <div class="col-md-6" ng-class="{'has-error': edit_choosed_order_form.lb_year.$error.required}">
                      <div class="form-group">
                        <label for="name">LB Year Value</label>
                        <input type="text"
                          name="lb_year"
                          class="form-control"
                          ng-model="order_choosed_detail.lb_year_value" required>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label for="name">Contact QTY</label>
                        <select class="form-control"
                          name="selected_contract_{{idx}}"
                          ng-model="order_choosed_detail.contract_qty">
                          <option value="">Select</option>
                          <?php foreach ($contract_list as $record): ?>
                            <option value="<?php echo $record->number ?>"><?php echo $record->number ?> ปี</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-6" ng-class="{'has-error': edit_choosed_order_form.qty.$error.min || (edit_choosed_order_form.$submitted && edit_choosed_order_form.qty.$error.required)}">
                      <div class="form-group">
                          <label for="name">QTY</label>
                          <input type="number"
                          class="form-control"
                          name="qty"
                          class="form-control required"
                          string-to-number
                          ng-model="order_choosed_detail.qty"
                          min="1" required>
                      </div>
                  </div>
              </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
              <input type="submit" class="btn btn-primary" value="Submit" ng-click="submit_new_order(edit_choosed_order_form, order_choosed_detail)">
          </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
    </div>
  </script>

<script type="text/ng-template" id="result_search_product_modal.html">
      <div class="modal-header text-center"><h4>เลือกสินค้า</h4></div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="col-md-3">Part number</th>
              <th class="col-md-4">Name</th>
              <th class="col-md-4">Medel</th>
              <th class="col-md-1">select</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="(idx, p) in result_products track by idx">
              <td class="text-center">{{p.part_number || '-'}}</td>
              <td>{{p.name || '-'}}</td>
              <td class="text-center">{{p.model || '-'}}</td>
              <td>
                <div class="checkbox text-center">
                  <label for="is_select_{{idx}}"><input type="radio"  id="is_select_{{idx}}"  name="is_select" value="{{idx}}" ng-model="$parent.selected_model"></label>
                </div>
              </td>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" type="button" ng-click="add_select_product()">Add</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
      </div>
    </script>

<script type="text/ng-template" id="edit_order_view.html">
  <div class="modal-header">
    <h4>Edit (<span ng-bind="order_detail.part_number"></span>) <small><span ng-bind="order_detail.product_name"></span></small></h4>
    <p><strong ng-bind="order_detail.type_name"></strong> <span ng-bind="order_detail.type_description"></span></p>
  </div>
  <div class="modal-body">
    <form role="form" name="edit_order_form"  ng-submit="save_edit(edit_order_form, order_detail)">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4" ng-class="{'has-error': (edit_order_form.discount_sla.$error.min || edit_order_form.discount_sla.$error.max) || (edit_order_form.$submitted && edit_order_form.discount_sla.$error.required)}">
                    <div class="form-group">
                        <label for="name">Discount SLA Type Value</label>
                        <input type="number"
                          name="discount_sla"
                          class="form-control required"
                          ng-model="order_detail.discount_sla_type_value"
                          ng-min="get_sla_type_min(order_detail.type_name)"
                          ng-max="get_sla_type_max(order_detail.type_name)"
                          data-toggle="tooltip"
                          data-placement="right"
                          title="{{get_sla_type_min(order_detail.type_name)+' - '+get_sla_type_max(order_detail.type_name)}}"
                          string-to-number
                          required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Discount Contract Value</label>
                      <input type="text"
                        class="form-control"
                        ng-model="order_detail.discount_of_contract_value"
                        readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label for="name">Discount QTY Value</label>
                      <input type="text"
                        class="form-control required"
                        ng-model="order_detail.discount_of_qty_value" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">จังหวัด</label>
                        <select class="form-control"
                          name="contract"
                          ng-model="order_detail.province_id"
                          ng-change="discount_for_province(order_detail.province_id)" required>
                          <?php foreach ($province_list as $record): ?>
                            <option value="<?php echo $record->province_id ?>"><?php echo $record->province_name ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">PM</label>
                      <select class="form-control" name="pm" ng-model="order_detail.pm_time_qty" required>
                        <option value="">Select</option>
                        <option value="{{pm}}" ng-repeat="pm in pm_val">{{pm}}</option>
                      </select>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6" ng-class="{'has-error': edit_order_form.pm_time.$error.required}">
                  <div class="form-group">
                    <label for="name">PM Time Value</label>
                    <input type="text"
                      name="pm_time"
                      class="form-control"
                      ng-model="order_detail.pm_time_value" required>
                  </div>
              </div>
                <div class="col-md-6" ng-class="{'has-error': edit_order_form.lb_year.$error.required}">
                    <div class="form-group">
                      <label for="name">LB Year Value</label>
                      <input type="text"
                        name='lb_year'
                        class="form-control"
                        ng-model="order_detail.lb_year_value" required>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Contact QTY</label>
                      <select class="form-control" name="selected_contract_{{idx}}" ng-model="order_detail.contract_qty">
                        <option value="">Select</option>
                        <?php foreach ($contract_list as $record): ?>
                          <option value="<?php echo $record->number ?>"><?php echo $record->number ?> ปี</option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                </div>
                <div class="col-md-6" ng-class="{'has-error': edit_order_form.qty.$error.min || (edit_order_form.$submitted && edit_order_form.qty.$error.required)}">
                    <div class="form-group">
                        <label for="name">QTY</label>
                        <input type="number"
                          name="qty"
                          class="form-control required"
                          string-to-number
                          ng-model="order_detail.qty"
                          min="1" required>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
  </div>
</script>

<?php endif ?>
