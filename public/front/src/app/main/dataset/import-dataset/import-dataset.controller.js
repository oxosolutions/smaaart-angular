(function ()
{
    'use strict';

    angular
        .module('app.dataset.import-dataset')
        .controller('ImportDatasetController', ImportDatasetController);

    /** @ngInject */
    function ImportDatasetController(ImportDataset)
    {
        var vm = this;

        // Data
        vm.datasets = ImportDataset.data;
		console.log(ImportDataset);
		
		vm.dtOptions = {
            dom       : '<"top"f>rt<"bottom"<"left"<"length"l>><"right"<"info"i><"pagination"p>>>',
            pagingType: 'full_numbers',
            autoWidth : false,
            responsive: true
        };

        // Methods

        //////////
    }

})();