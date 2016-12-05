(function ()
{
    'use strict';

    angular
        .module('app.datasets.dataset-record', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, $translatePartialLoaderProvider, msApiProvider, msNavigationServiceProvider)
    {
        // State
        $stateProvider
            .state('app.dataset_record', {
                url    : '/datasets/dataset-record/:id',
                views  : {
                    'content@app': {
                        templateUrl: 'app/main/datasets/dataset-record/dataset-record.html',
                        controller : 'DatasetRecordController as vm'
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
        $translatePartialLoaderProvider.addPart('app/main/datasets/dataset-record');
        // Api
        msApiProvider.register('sample', ['app/data/sample/sample.json']);

    }
})();