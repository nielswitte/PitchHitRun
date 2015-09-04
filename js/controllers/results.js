(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:ResultsCtrl
     * @description
     * # ResultsCtrl
     * Controller of the coinApp
     */
    angular.module('giantsApp')
        .controller('ResultsCtrl', function ($scope, Restangular, $filter) {
            // Lists with sections, categories and genders
            $scope.sections = Restangular.all('Sections').getList().$object;
            $scope.categories = Restangular.all('Categories').getList().$object;
            $scope.genders = [{ Name: 'M', Gender: 'Male' }, { Name: 'V', Gender: 'Female' }];

            $scope.orderByField = 'TotalScore';
            $scope.reverseSort = true;

            if($scope.filter === undefined) {
                $scope.filter = {};
            }

            $scope.$watchCollection('filter', function( newValue, oldValue ) {
                $scope.searchResults($scope.filter);
            });

            $scope.searchResults = function (filter) {
                var data = {};
                // Use category filter?
                if(filter.Category !== undefined) {
                    data.Category = filter.Category.Id;
                }
                // Use section filter?
                if(filter.Section !== undefined) {
                    data.Section = filter.Section.Id;
                }
                // Use gender filter?
                if(filter.Gender !== undefined) {
                    data.Gender = filter.Gender.Gender;
                }
                // Get new results
                Restangular.all('Results').customGET('', data).then(
                    function (response) {


                        $scope.results = $filter('orderBy')(response, 'TotalScore', true);
                    },
                    function (response) {
                        $scope.results = [];
                    }
                );
            };

            // Get all results when page opens
            //$scope.searchResults($scope.filter);
        });
}());