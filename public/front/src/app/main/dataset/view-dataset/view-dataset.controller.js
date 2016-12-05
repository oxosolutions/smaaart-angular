(function ()
{
    'use strict';

    angular
        .module('app.dataset.view-dataset')
        .controller('ViewDatasetController', ViewDatasetController);

    /** @ngInject */
    function ViewDatasetController(ViewDataset, $state, api)
    {
        var vm = this;

		// Data
		
		
		api.dataset.getById.get({'id': $state.params.id},
			// Success
			function (response){
				vm.datasets = response.records;
				vm.dataset_id = response.dataset_id;
				vm.dataset_name = response.dataset_name;
			},

			// Error
			function (response){
				console.error(response);
			}
		);
		
		
		
		
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