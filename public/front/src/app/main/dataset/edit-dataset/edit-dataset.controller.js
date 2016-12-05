(function ()
{
    'use strict';

    angular
        .module('app.dataset.edit-dataset')
        .controller('EditDatasetController', EditDatasetController);

    /** @ngInject */
    function EditDatasetController(EditDataset)
    {
        var vm = this;

        // Data
        vm.datasets = EditDataset.data;
		
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