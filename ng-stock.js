var myApp = angular.module('stockApp', []);

myApp.controller('stockController', ['$scope', '$http', function($scope, $http) {
  $scope.ticker = "GOOG";
  $scope.query = {};

  $scope.loadData = function(){
    $http.get("api.php?ticker="+$scope.ticker).success(
      function(data, status, headers, config){
        $scope.query = data;
      });
  };

}]);
