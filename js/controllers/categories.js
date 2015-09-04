(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:CategoriesCtrl
     * @description
     * # CategoriesCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('CategoriesCtrl', function ($scope, Restangular, $modal) {
            // Default sorting order
            $scope.orderByField = 'Name';
            $scope.reverseSort = false;

            // Retrieve list of categories
            $scope.categories = Restangular.all('Categories').getList().$object;

            // Show modal for adding new category
            $scope.showAddCategoryModal = function () {
                $modal({
                    title: 'Categorie toevoegen',
                    contentTemplate: 'views/modals/categoryNew.html'
                });
            };

            // Show modal for editing category
            $scope.showEditCategoryModal = function (category) {
                var modal = $modal({
                    title: 'Categorie bewerken',
                    contentTemplate: 'views/modals/categoryEdit.html'
                });

                modal.$scope.category = angular.copy(category);
            };

            // Show modal to remove a category
            $scope.showDeleteCategoryModal = function (category) {
                var modal = $modal({
                    title: 'Categorie verwijderen',
                    contentTemplate: 'views/modals/categoryDelete.html'
                });

                modal.$scope.category = angular.copy(category);
            };
        });
}());