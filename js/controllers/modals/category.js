(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:CategoryModalsCtrl
     * @description
     * # CategoryModalsCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('CategoryModalsCtrl', function ($scope, Restangular, $route, $modal, $alert) {
            // Wrapper to hide modal
            $scope.closeModal = function () {
                this.$hide();
            };
            
            if($scope.category === undefined) {
                $scope.category = {};
            }

            // Add new category
            $scope.newCategory = function (category) {
                Restangular.all('Categories').post(category).then(
                    function (response) {
                        $alert({
                            title: 'Categorie toegevoegd',
                            content: '<strong>' + category.Name + '</strong> is toegevoegd aan de lijst met categorieën',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het toevoegen van <strong>' + category.Name + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                )
            };

            // Edit category
            $scope.editCategory = function (category) {
                Restangular.one('Categories', category.Id).customPUT(category).then(
                    function (reponse) {
                        $alert({
                            title: 'Categorie bijgewerkt',
                            content: '<strong>' + category.Name + '</strong> is bijgewerkt.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het bijwerken van <strong>' + category.Name + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };

            // Delete category
            $scope.deleteCategory = function (category) {
                Restangular.one('Categories', category.Id).remove().then(
                    function (reponse) {
                        $alert({
                            title: 'Categorie verwijderd',
                            content: '<strong>' + category.Name +  '</strong> is verwijderd.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het verwijderen van: <strong>' + category.Name +  '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };
		});
}());