(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:UserModalsCtrl
     * @description
     * # UserModalsCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('UserModalsCtrl', function ($scope, Restangular, $route, $modal, $alert) {
            // Wrapper to hide modal
            $scope.closeModal = function () {
                this.$hide();
            };

            if($scope.user === undefined) {
                $scope.user = {};
            }

            // Add new user
            $scope.newUser = function (user) {
                Restangular.all('Users').post(user).then(
                    function (response) {
                        $alert({
                            title: 'Deelnemer toegevoegd',
                            content: '<strong>' + user.FirstName + ' ' + user.LastName + '</strong> is toegevoegd aan de lijst met deelnemers',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het toevoegen van <strong>' + user.FirstName + ' ' + user.LastName + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                )
            };

            // Edit user
            $scope.editUser = function (user) {
                Restangular.one('Users', user.Id).customPUT(user).then(
                    function (reponse) {
                        $alert({
                            title: 'Deelnemer bijgewerkt',
                            content: '<strong>' + user.FirstName + ' ' + user.LastName + '</strong> is bijgewerkt.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het bijwerken van <strong>' + user.FirstName + ' ' + user.LastName + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };

            // Delete user
            $scope.deleteUser = function (user) {
                Restangular.one('Users', user.Id).remove().then(
                    function (reponse) {
                        $alert({
                            title: 'Deelnemer verwijderd',
                            content: '<strong>' + user.FirstName + ' ' + user.LastName + '</strong> is verwijderd.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het verwijderen van <strong>' + user.FirstName + ' ' + user.LastName + '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };
		});
}());