(function ()
{
    'use strict';

    angular
        .module('app.dataset.import-dataset', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, msApiProvider)
    {
        $stateProvider.state('app.dataset_import', {
            url    : '/dataset/import',
            views  : {
                'content@app': {
                    templateUrl: 'app/main/dataset/import-dataset/import-dataset.html',
                    controller : 'ImportDatasetController as vm'
                }
            },
            resolve: {
                ImportDataset: function (msApi)
                {
                    return msApi.resolve('importdataset@get');
                }
            }
        });

        // Api
        msApiProvider.register('importdataset', ['http://192.168.0.101/smaart-angular/public/api/v1/dataset/list?api_token=yicnudlyiqghrr116323wq7pimihrhy17']);
    }

})();