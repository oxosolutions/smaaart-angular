(function ()
{
    'use strict';

    /**
     * Main module of the Fuse
     */
    angular
        .module('fuse', [

            // Core
            'app.core',

            // Navigation
            'app.navigation',

            // Toolbar
            'app.toolbar',

            // Quick Panel
            'app.quick-panel',

            // Dashboard
            'app.dashboard',

            //Datasets
            'app.datasets',

            //Add Datasets
            'app.datasets.add-dataset',

            //List Datasets
            'app.datasets.list-datasets',

            //list dataset Record
             'app.datasets.dataset-record'
        ]);
})();