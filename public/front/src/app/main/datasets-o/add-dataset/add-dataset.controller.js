(function ()
{
    'use strict';
    angular
        .module('app.datasets.add-dataset')
        . directive('ngFiles', ['$parse', function ($parse) {

            function fn_link(scope, element, attrs) {
                var onChange = $parse(attrs.ngFiles);
                element.on('change', function (event) {
                    onChange(scope, { $files: event.target.files });
                });
            };

            return {
                link: fn_link
            }
        } ])
        .controller('AddDatasetController', AddDatasetController);

    /** @ngInject */
    function AddDatasetController(SampleData, $scope, $http, api)
    {  
        // FORM File manage here
            var formdata = new FormData();
            $scope.getTheFiles = function ($files) {
                console.log($files);

            angular.forEach($files, function (value, key) {
            formdata.append('file', value);
            });
            };

           // POST FORM METHOD +  UPLOAD THE FILES Here.
            $scope.uploadFiles = function () {

                    if ($scope.dataset.$valid) {
                    $scope.dataset.$setSubmitted();
                    alert('Form was valid.');
                    } else {
                    alert('Form was invalid!');
                    }

                    var formFields = $scope.data;
                    console.log(formFields);
                    formdata.append('format', formFields.uploadby);
                    formdata.append('add_replace', formFields.state);
                    formdata.append('with_dataset', formFields.action); 
                  
                    $http.defaults.headers.post['Content-Type'] = undefined;

                $http.post('http://192.168.0.101/smaart-angular/public/api/v1/dataset/import?api_token=yicnudlyiqghrr116323wq7pimihrhy17', formdata ).then(function mySucces(response) {
                    console.log("success");
                    console.log(response.data.status);
                    console.log(response.data.error);
                    console.log(response.data.error.add_replace);
                    $scope.add_replace = response.data.error.add_replace;
                    $scope.file = response.data.error.file;

                    
                   // console.log(response.error);
                          //$scope.myWelcome = response.data;
                        }, function myError(response) {
                            console.log(error);
                            console.log(response);

                    console.log(response.data);
                        // $scope.myWelcome = response.statusText;
                    });  
                
               }
        //End POST FORM METHOD +  UPLOAD THE FILES Here.

       $scope.postForm = function()
       {  
      console.log($scope.data);
          // $(function(){
          //    data =   $("#form-data").serialize();
          // }());
            
        console.log("post form");
        api.getUsers.user.get({},

                 function(res){
                    console.log(res);
                }
        );
       }

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
