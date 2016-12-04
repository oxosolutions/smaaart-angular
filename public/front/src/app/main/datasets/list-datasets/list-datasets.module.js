(function ()
{
    'use strict';

    angular
        .module('app.datasets.list-datasets',
            [
                // 3rd Party Dependencies
                'datatables'
            ]
        )
        .config(config);

    /** @ngInject */
    function config($stateProvider, $translatePartialLoaderProvider, msApiProvider, msNavigationServiceProvider)
    {
        // State
        $stateProvider
            .state('app.datasets_listdatasets', {
                url    : '/datasets/list-datasets',
                views  : {
                    'content@app': {
                        templateUrl: 'app/main/datasets/list-datasets/list-datasets.html',
                        controller : 'ListDatasetsController as vm'
                    }
                },
                resolve: {
                    SampleData: function (msApi)
                    {
                        return msApi.resolve('sample@get');
                    }
                }
            });

        // Translation
        $translatePartialLoaderProvider.addPart('app/main/datasets/list-datasets');

        // Api
        msApiProvider.register('sample', ['app/data/sample/sample.json']);

    }
})();