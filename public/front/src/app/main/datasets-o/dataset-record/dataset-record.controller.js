
(function ()
{
    'use strict';

    angular
        .module('app.datasets.dataset-record')
        .controller('DatasetRecordController', DatasetRecordController).filter('start', function () {
        return function (input, start) {
            if (!input || !input.length) { return; }

            start = +start;
            return input.slice(start);
        };
    });

    /** @ngInject */
    function DatasetRecordController(SampleData, $scope, $http , $stateParams){
        var vm = this;
        $scope.ids = $stateParams.id;
        // Data
        vm.helloText = SampleData.data.helloText;
		
		vm.dtOptions = {
            dom       : '<"top"f>rt<"bottom"<"left"<"length"l>><"right"<"info"i><"pagination"p>>>',
            pagingType: 'simple',
            autoWidth : false,
            responsive: true
        };
		
		

        // Methods

        //////////
	$scope.sort = function(keyname){
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    }

    var vm = this;

        // Data
       // vm.employees = Employees.data;

       

      var listRecord = function()
        {

            console.log("list data");

            $scope.list = [];
 
        //$scope.currentPage = 1; // keeps track of the current page
        //$scope.pageSize = 5;


    //$http.defaults.headers.get['Content-Type'] = undefined;

 $http.get("http://192.168.0.101/smaart-angular/public/api/v1/dataset/view/"+$stateParams.id+"?api_token=yicnudlyiqghrr116323wq7pimihrhy17")
    .then(function(response) {

            $scope.listrecords = response.data;
                    
    });
} 

        listRecord();
    }
}) ();