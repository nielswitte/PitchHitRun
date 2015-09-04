(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:SectionsCtrl
     * @description
     * # SectionsCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('SectionsCtrl', function ($scope, Restangular, $modal) {
            // Default sorting order
            $scope.orderByField = 'Name';
            $scope.reverseSort = false;

            // Retrieve list of sections
            $scope.sections = Restangular.all('Sections').getList().$object;

            // Show modal for adding new section
            $scope.showAddSectionModal = function () {
                $modal({
                    title: 'Onderdeel toevoegen',
                    contentTemplate: 'views/modals/sectionNew.html'
                });
            };

            // Show modal for editing section
            $scope.showEditSectionModal = function (section) {
                var modal = $modal({
                    title: 'Onderdeel bewerken',
                    contentTemplate: 'views/modals/sectionEdit.html'
                });

                modal.$scope.section = angular.copy(section);
            };

            // Show modal to remove a section
            $scope.showDeleteSectionModal = function (section) {
                var modal = $modal({
                    title: 'Onderdeel verwijderen',
                    contentTemplate: 'views/modals/sectionDelete.html'
                });

                modal.$scope.section = angular.copy(section);
            };
        });
}());