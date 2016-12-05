(function ()
{
    'use strict';

    angular
        .module('app.dataset.export-dataset')
        .controller('ExportDatasetController', ExportDatasetController);

    /** @ngInject */
    function ExportDatasetController(ExportDataset)
    {
        var vm = this;

        // Data
        vm.datasets = ExportDataset.data;
		console.log(ExportDataset);
		
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