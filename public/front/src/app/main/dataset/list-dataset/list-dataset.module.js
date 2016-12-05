(function ()
{
    'use strict';

    angular
        .module('app.dataset.list-dataset', ['datatables'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, msApiProvider)
    {
        $stateProvider.state('app.dataset_list', {
            url    : '/dataset/list',
            views  : {
                'content@app': {
                    templateUrl: 'app/main/dataset/list-dataset/list-dataset.html',
                    controller : 'ListDatasetController as vm'
                }
            },
            resolve: {
                ListDataset: function (msApi)
                {
                    return msApi.resolve('listdataset@get');
                }
            }
        });

        // Api
        msApiProvider.register('listdataset', ['http://projects.fhts.ac.in/sdgindia/smaart-angular/public/api/v1/dataset/list?api_token=yicnudlyiqghrr116323wq7pimihrhy17']);
    }

})();