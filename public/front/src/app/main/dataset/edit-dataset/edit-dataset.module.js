(function ()
{
    'use strict';

    angular
        .module('app.dataset.edit-dataset', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, msApiProvider)
    {
        $stateProvider.state('app.dataset_edit', {
            url    : '/dataset/edit',
            views  : {
                'content@app': {
                    templateUrl: 'app/main/dataset/edit-dataset/edit-dataset.html',
                    controller : 'EditDatasetController as vm'
                }
            },
            resolve: {
                EditDataset: function (msApi)
                {
                    return msApi.resolve('editdataset@get');
                }
            }
        });

        // Api
        msApiProvider.register('editdataset', ['http://192.168.0.101/smaart-angular/public/api/v1/dataset/list?api_token=yicnudlyiqghrr116323wq7pimihrhy17']);
    }

})();