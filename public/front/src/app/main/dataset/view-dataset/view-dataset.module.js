(function ()
{
    'use strict';

    angular
        .module('app.dataset.view-dataset', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, msApiProvider)
    {
        $stateProvider.state('app.dataset_view', {
            url    : '/dataset/view/:id',
            views  : {
                'content@app': {
                    templateUrl: 'app/main/dataset/view-dataset/view-dataset.html',
                    controller : 'ViewDatasetController as vm'
                }
            },
            resolve: {
                ViewDataset: function (msApi)
                {
                    return msApi.resolve('viewdataset@get');
                }
            }
        });

        // Api
        msApiProvider.register('viewdataset', ['http://192.168.0.101/smaart-angular/public/api/v1/dataset/list?api_token=yicnudlyiqghrr116323wq7pimihrhy17']);
    }

})();