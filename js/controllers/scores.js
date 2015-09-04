(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:ScoresCtrl
     * @description
     * # ScoresCtrl
     * Controller of the giantsApp
     */
    angular.module('giantsApp')
        .controller('ScoresCtrl', function ($scope, Restangular, $modal) {
            // Default sorting order
            $scope.orderByField = 'User.FullName';
            $scope.reverseSort = false;

            // Retrieve list of scores
            $scope.scores = Restangular.all('Scores').getList().$object;

            // Show modal for adding new score
            $scope.showAddScoreModal = function () {
                var modal = $modal({
                    title: 'Score toevoegen',
                    contentTemplate: 'views/modals/scoreNew.html'
                });

                modal.$scope.users = Restangular.all('Users').getList().$object;
                modal.$scope.sections = Restangular.all('Sections').getList().$object;
            };

            // Show modal for editing score
            $scope.showEditScoreModal = function (score) {
                var modal = $modal({
                    title: 'Score bewerken',
                    contentTemplate: 'views/modals/scoreEdit.html'
                });

                modal.$scope.score = angular.copy(score);
                modal.$scope.users = Restangular.all('Users').getList().$object;
                modal.$scope.sections = Restangular.all('Sections').getList().$object;
            };

            // Show modal to remove a score
            $scope.showDeleteScoreModal = function (score) {
                var modal = $modal({
                    title: 'Score verwijderen',
                    contentTemplate: 'views/modals/scoreDelete.html'
                });

                modal.$scope.score = angular.copy(score);
            };
        });
}());