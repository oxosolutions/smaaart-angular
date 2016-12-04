(function ()
{
    'use strict';

    angular
        .module('app.datasets.list-datasets')
        .controller('ListDatasetsController', ListDatasetsController);

    /** @ngInject */
    function ListDatasetsController(SampleData, $scope, $http)
    {
        var vm = this;

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


      var listData = function()
        {

            console.log("list data");
    //$http.defaults.headers.get['Content-Type'] = undefined;

 $http.get("http://192.168.0.101/smaart-angular/public/api/v1/dataset/list?api_token=yicnudlyiqghrr116323wq7pimihrhy17")
    .then(function(response) {

            $scope.listdataset = response.data;
    });
} 

        listData();
    }
})();