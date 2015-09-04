(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:UsersCtrl
     * @description
     * # UsersCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('UsersCtrl', function ($scope, Restangular, $modal) {
            // Default sorting order
            $scope.orderByField = 'FirstName';
            $scope.reverseSort = false;

            // Retrieve list of users
            $scope.users = Restangular.all('Users').getList().$object;

            // Show modal for adding new user
            $scope.showAddUserModal = function () {
                var modal = $modal({
                    title: 'Deelnemer toevoegen',
                    contentTemplate: 'views/modals/userNew.html'
                });

                modal.$scope.categories = Restangular.all('Categories').getList().$object;
            };

            // Show modal for editing user
            $scope.showEditUserModal = function (user) {
                var modal = $modal({
                    title: 'Deelnemer bewerken',
                    contentTemplate: 'views/modals/userEdit.html'
                });

                modal.$scope.categories = Restangular.all('Categories').getList().$object;
                modal.$scope.user = angular.copy(user);
            };

            // Show modal to Remove a user
            $scope.showDeleteUserModal = function (user) {
                var modal = $modal({
                    title: 'Deelnemer verwijderen',
                    contentTemplate: 'views/modals/userDelete.html'
                });

                modal.$scope.user = angular.copy(user);
            };
        });
}());