(function () {
    'use strict';

    /**
     * @ngdoc function
     * @name giantsApp.controller:BreadcrumbCtrl
     * @description
     * # BreadcrumbCtrl
     * Controller of the coinApp
     */
    angular.module('giantsApp')
        .controller('BreadcrumbCtrl', function ($scope, breadcrumbs) {
            $scope.breadcrumbs = breadcrumbs;
        });
}());