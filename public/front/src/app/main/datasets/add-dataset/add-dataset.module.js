(function ()
{
    'use strict';

    angular
        .module('app.datasets.add-dataset', [])
        .config(config);

    /** @ngInject */
    function config($stateProvider, $translatePartialLoaderProvider, msApiProvider, msNavigationServiceProvider)
    {   

        // State
        $stateProvider
            .state('app.datasets_adddatasets', {
                url    : '/datasets/add-dataset',
                views  : {
                    'content@app': {
                        templateUrl: 'app/main/datasets/add-dataset/add-dataset.html',
                        controller : 'AddDatasetController as vm'
                    }
                },
                resolve: {
                    SampleData: function (msApi)
                    {
                        return msApi.resolve('sample@get');
                    }
                },
                bodyClass: 'forms'
            });

        // Translation
        $translatePartialLoaderProvider.addPart('app/main/datasets/add-dataset');

        // Api
        msApiProvider.register('sample', ['app/data/sample/sample.json']);

    
    }
})();