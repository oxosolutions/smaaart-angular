(function ()
{
    'use strict';

    angular
        .module('app.dataset.list-dataset')
        .controller('ListDatasetController', ListDatasetController);

    /** @ngInject */
    function ListDatasetController(ListDataset)
    {
        var vm = this;

        // Data
        vm.datasets = ListDataset.data;
		console.log(ListDataset);
		
		vm.dtOptions = {
            dom       : '<"top"<"left"<"length"l>><"right"<"search"f>>>rt<"bottom"<"left"<"info"i>><"right"<"pagination"p>>>',
            pagingType: 'full_numbers',
            autoWidth : false,
            responsive: true
        };

        // Methods

        //////////
    }

})();