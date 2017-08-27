<script type="text/javascript">
	var inject = ['ui.bootstrap', 'ui.select', 'ngSanitize','angular.filter', 'angular-loading-bar', 'ngAnimate','ngTable'];
	var app = angular.module('mainApp', inject);
	app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.latencyThreshold = 100;
    cfpLoadingBarProvider.spinnerTemplate = '<div id="loading-bar-container"><div class="sk-fading-circle"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div></div>';
  }])
	app.controller("mainCtrl", function($scope, $http, $uibModal, $log) {
	    //code
	});
	// enter to tab
	app.directive('enter',function(){
		return function(scope,element,attrs){
			element.bind("keydown keypress",function(event){
				if(event.which===13){
					event.preventDefault();
					var fields=$(this).parents('form:eq(0),body').find('input, textarea, select');
					var index=fields.index(this);
					if(index> -1&&(index+1)<fields.length)
						fields.eq(index+1).focus();
				}
			});
		};
	});

	app.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value);
      });
    }
  };
});

</script>
