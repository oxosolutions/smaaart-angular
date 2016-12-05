(function ()
{
    'use strict';

    angular
        .module('app.dataset.add-dataset', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, msApiProvider)
    {
        $stateProvider.state('app.dataset_add', {
            url    : '/dataset/add',
            views  : {
                'content@app': {
                    templateUrl: 'app/main/dataset/add-dataset/add-dataset.html',
                    controller : 'AddDatasetController as vm'
                }
            },
            resolve: {
                AddDataset: function (msApi)
                {
                    return msApi.resolve('adddataset@get');
                }
            }
        });

        // Api
        msApiProvider.register('adddataset', ['http://192.168.0.101/smaart-angular/public/api/v1/dataset/list?api_token=yicnudlyiqghrr116323wq7pimihrhy17']);
    }

})();