(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:SectionModalsCtrl
     * @description
     * # SectionModalsCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('SectionModalsCtrl', function ($scope, Restangular, $route, $modal, $alert) {
            // Wrapper to hide modal
            $scope.closeModal = function () {
                this.$hide();
            };

            if($scope.section === undefined) {
                $scope.section = {};
            }

            // Add new section
            $scope.newSection = function (section) {
                Restangular.all('Sections').post(section).then(
                    function (response) {
                        $alert({
                            title: 'Onderdeel toegevoegd',
                            content: '<strong>' + section.Name + '</strong> is toegevoegd aan de lijst met onderdelen',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het toevoegen van <strong>' + section.Name + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                )
            };

            // Edit section
            $scope.editSection = function (section) {
                Restangular.one('Sections', section.Id).customPUT(section).then(
                    function (reponse) {
                        $alert({
                            title: 'Onderdeel bijgewerkt',
                            content: '<strong>' + section.Name + '</strong> is bijgewerkt.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het bijwerken van <strong>' + section.Name + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };

            // Delete section
            $scope.deleteSection = function (section) {
                Restangular.one('Sections', section.Id).remove().then(
                    function (reponse) {
                        $alert({
                            title: 'Categorie verwijderd',
                            content: '<strong>' + section.Name + '</strong> is verwijderd.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het verwijderen van <strong>' + section.Name + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };
		});
}());