(function ()
{
    'use strict';
    angular
        .module('app.datasets.add-dataset')
        .controller('AddDatasetController', AddDatasetController);

    /** @ngInject */
    function AddDatasetController(SampleData, $scope)
    {   
        var vm = this;
        //$scope.replaceVal = 'true';
        $scope.data = {

            uploadby : 'file'
        }
        $scope.model = {

            isDisabled: true
        }
        $scope.upload = function () {
            angular.element(document.querySelector('#fileInput')).click();
        };

        $scope.addReplaceOrAppend = function(){
            
            var action = $scope.data.action;
            
            if(action == 'replace' || action == 'append'){

                $scope.model = {

                    isDisabled: false
                }

            }else{

                $scope.model = {

                    isDisabled: true
                };
            }
        }
    }
})();
