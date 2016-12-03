(function ()
{
    'use strict';

    angular
        .module('app.datasets', [
            'app.datasets.add-dataset',
            'app.datasets.list-datasets'
        ])
        .config(config);

    /** @ngInject */
    function config(msNavigationServiceProvider)
    {
        // Navigation
        msNavigationServiceProvider.saveItem('datasets', {
            title : 'Datasets',
            icon  : 'icon-clipboard-outline',
            weight: 3
        });

        msNavigationServiceProvider.saveItem('datasets.add-dataset', {
            title: 'Add Datasets',
            state: 'app.datasets_adddatasets'
        });

        msNavigationServiceProvider.saveItem('datasets.list-datasets', {
            title: 'List Datasets',
            state: 'app.datasets_listdatasets'
        });
    }
})();