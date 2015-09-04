(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:ScoreModalsCtrl
     * @description
     * # ScoreModalsCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('ScoreModalsCtrl', function ($scope, Restangular, $route, $modal, $alert) {
            // Wrapper to hide modal
            $scope.closeModal = function () {
                this.$hide();
            };

            if($scope.score === undefined) {
                $scope.score = {};
            }

            // Add new Score
            $scope.newScore = function (score) {
                Restangular.all('Scores').post(score).then(
                    function (response) {
                        $alert({
                            title: 'Score toegevoegd',
                            content: 'Voor deelnemer <strong>' + score.User.FullName + '</strong> en onderdeel <strong>' + score.Section.Name + '</strong> is score <strong>' + score.Score + '</strong> toegevoegd.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het toevoegen van een score voor <strong>' + score.User.FullName +  '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                )
            };

            // Edit Score
            $scope.editScore = function (score) {
                Restangular.one('Scores', score.Id).customPUT(score).then(
                    function (reponse) {
                        $alert({
                            title: 'Score bijgewerkt',
                            content: 'Voor deelnemer <strong>' + score.User.FullName + '</strong> en onderdeel <strong>' + score.Section.Name + '</strong> is score <strong>' + score.Score + '</strong> bijgewerkt.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het bijwerken van de score voor <strong>' + score.User.FullName +  '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };

            // Delete Score
            $scope.deleteScore = function (score) {
                Restangular.one('Scores', score.Id).remove().then(
                    function (reponse) {
                        $alert({
                            title: 'Score verwijderd',
                            content: 'Score voor deelnemer <strong>' + score.User.FullName +  '</strong> en onderdeel <strong>' + score.Section.Name + '</strong> is verwijderd.',
                            type: 'success'
                        });

                        $route.reload();
                        $scope.closeModal();
                    },
                    function (response) {
                        $alert({
                            title: 'Fout!',
                            content: 'Er ging iets mis tijdens het verwijderen van een score voor <strong>' + score.User.FullName +  '</strong>. ' + response.data.error.message,
                            type: 'danger'
                        });
                    }
                );
            };
		});
}());