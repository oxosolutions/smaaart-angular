(function ()
{
    'use strict';

    angular
        .module('app.dataset.add-dataset')
        .controller('AddDatasetController', AddDatasetController);

    /** @ngInject */
    function AddDatasetController(AddDataset)
    {
        var vm = this;

        // Data
        vm.datasets = AddDataset.data;
		
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