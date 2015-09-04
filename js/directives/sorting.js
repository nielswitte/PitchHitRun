(function () {
    'use strict';

    /**
     * @ngdoc directive
     * @name giantsApp.directive:sorting
     * @description
     * # sorting
     */
    angular.module('giantsApp')
        .directive('sorting', function () {
            return {
                restrict: 'E',
                template: function (elem, attr) {
                    return '<a ng-click="orderByField=\'' + attr.field + '\'; reverseSort = !reverseSort">' + attr.title + '</a>' +
                        '<span ng-show="orderByField == \'' + attr.field + '\'">' +
                        '    <i class=" glyphicon glyphicon-sort-by-attributes" ng-hide="reverseSort"></i>' +
                        '    <i class=" glyphicon glyphicon-sort-by-attributes-alt" ng-show="reverseSort"></i>' +
                        '</span>';
                }
            };
        });
}());