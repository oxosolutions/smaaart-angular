(function ()
{
    'use strict';

    angular
        .module('app.dataset', [
			'app.dataset.list-dataset',
			'app.dataset.add-dataset',
			'app.dataset.edit-dataset',
			'app.dataset.view-dataset',
			'app.dataset.import-dataset',
			'app.dataset.export-dataset'
        ])
        .config(config);

    /** @ngInject */
    function config(msNavigationServiceProvider)
    {
        // Navigation
        msNavigationServiceProvider.saveItem('dataset', {
            title : 'DATASETS',
            group : true,
			state : 'app.dataset_list',
            weight: 4
        });

        msNavigationServiceProvider.saveItem('dataset.list-dataset', {
            title : 'All Datasets',
            icon  : 'icon-grid',
            state : 'app.dataset_list',
        });
		
		msNavigationServiceProvider.saveItem('dataset.add-dataset', {
            title : 'Add New Dataset',
            icon  : 'icon-plus',
			state : 'app.dataset_add',
        });
		
		msNavigationServiceProvider.saveItem('dataset.view-dataset', {
            title : 'View Dataset',
            icon  : 'icon-monitor',
			state : 'app.dataset_view',
			stateParams: {
                id: ''
            }
        });
		
		msNavigationServiceProvider.saveItem('dataset.edit-dataset', {
            title : 'Edit Dataset',
            icon  : 'icon-pencil',
			state : 'app.dataset_edit',
        });
		
		msNavigationServiceProvider.saveItem('dataset.import-dataset', {
            title : 'Import Dataset',
            icon  : 'icon-arrow-left',
			state : 'app.dataset_import',
        });
		
		msNavigationServiceProvider.saveItem('dataset.export-dataset', {
            title : 'Export Dataset',
            icon  : 'icon-arrow-right',
			state : 'app.dataset_export',
        });
		
    }
})();