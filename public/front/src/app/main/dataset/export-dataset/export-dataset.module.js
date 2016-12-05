(function ()
{
    'use strict';

    angular
        .module('app.dataset.export-dataset', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, msApiProvider)
    {
        $stateProvider.state('app.dataset_export', {
            url    : '/dataset/export',
            views  : {
                'content@app': {
                    templateUrl: 'app/main/dataset/export-dataset/export-dataset.html',
                    controller : 'ExportDatasetController as vm'
                }
            },
            resolve: {
                ExportDataset: function (msApi)
                {
                    return msApi.resolve('exportdataset@get');
                }
            }
        });

        // Api
        msApiProvider.register('exportdataset', ['http://192.168.0.101/smaart-angular/public/api/v1/dataset/list?api_token=yicnudlyiqghrr116323wq7pimihrhy17']);
    }

})();