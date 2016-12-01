(function ()
{
    'use strict';

    angular
        .module('app.datasets.list-datasets')
        .controller('ListDatasetsController', ListDatasetsController);

    /** @ngInject */
    function ListDatasetsController(SampleData)
    {
        var vm = this;

        // Data
        vm.helloText = SampleData.data.helloText;

        // Methods

        //////////
    }
})();