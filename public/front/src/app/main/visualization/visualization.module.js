(function ()
{
    'use strict';

    angular
        .module('app.visualization', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, $translatePartialLoaderProvider, msApiProvider, msNavigationServiceProvider)
    {
        // State
        $stateProvider
            .state('app.visualization', {
                url    : '/visualization',
                views  : {
                    'content@app': {
                        templateUrl: 'app/main/visualization/visualization.html',
                        controller : 'VisualizationController as vm'
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
        $translatePartialLoaderProvider.addPart('app/main/visualization');
        // Api
        msApiProvider.register('sample', ['app/data/sample/sample.json']);

    }
})();