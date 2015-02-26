//name the module, no dependencies (overall)
var myApp = angular.module('stockApp', []);

//my controller on the other hand wants data-binding and http requests
//those get passed in.
myApp.controller('stockController', ['$scope', '$http', function($scope, $http) {

  //I have value="GOOG" in my HTML but the ng-model cleared it, so this line 
  //gives me a default value of GOOG.
  $scope.ticker = "GOOG";
  
  //this was so that my ng-repeat wasn't working on an undefined variable.
  $scope.query = {};

  $scope.loadData = function(){
    //this uses my single-file API just as I ask it too.
    $http.get("api.php?ticker="+$scope.ticker).success(
      function(data, status, headers, config){
        //the response is not expecting anything in particular.
        $scope.query = data;
      });
  };

}]);
