/* global baseUrl */
(function () {
    'use strict';

    /**
     * @ngdoc overview
     * @name giantsApp
     * @description
     * # giantsApp
     *
     * Main module of the application.
     */
    var giantsApp = angular.module('giantsApp', [
        'ngAnimate',
        'ngResource',
        'ngRoute',
        'ngSanitize',
        'ngTouch',
        'mgcrea.ngStrap',
        'restangular',
        'ng-breadcrumbs',
        'ui.select'
    ]);
    giantsApp.config(function ($routeProvider) {
        $routeProvider
            .when('/', {
                templateUrl: 'views/main.html',
                controller: 'MainCtrl',
                label: 'Home'
            })
            .when('/results', {
                templateUrl: 'views/results.html',
                controller: 'ResultsCtrl',
                label: 'Uitslagen',
            })
            .when('/scores', {
                templateUrl: 'views/scores.html',
                controller: 'ScoresCtrl',
                label: 'Scores',
            })
            .when('/settings', {
                templateUrl: 'views/settings.html',
                controller: 'SettingsCtrl',
                label: 'Instellingen',
            })
            .when('/settings/categories', {
                templateUrl: 'views/categories.html',
                controller: 'CategoriesCtrl',
                label: 'Categorieën',
            })
            .when('/settings/sections', {
                templateUrl: 'views/sections.html',
                controller: 'SectionsCtrl',
                label: 'Onderdelen',
            })
            .when('/users', {
                templateUrl: 'views/users.html',
                controller: 'UsersCtrl',
                label: 'Deelnemers',
            })
            .otherwise({
                redirectTo: '/'
            });
    });

    // Without token
    giantsApp.config(function (RestangularProvider) {
        RestangularProvider.setFullRequestInterceptor(function (element, operation, route, url, headers, params, httpConfig) {
            return {
                element: element,
                params: _.extend(params, { timestamp: new Date().getTime() }),
                headers: headers,
                httpConfig: httpConfig
            };
        });

        RestangularProvider.setBaseUrl('http://' + baseUrl + '/Api');
    });

    // Alerts
    giantsApp.config(function ($alertProvider) {
        angular.extend($alertProvider.defaults, {
            animation: 'am-fade-and-slide-top',
            placement: 'bottom-right',
            container: '#alerts-container',
            duration: 10,
            templateUrl: 'views/alerts/template.html'
        });
    });

    // Collapse
    giantsApp.config(function ($collapseProvider) {
        angular.extend($collapseProvider.defaults, {
            startCollapsed: true
        });
    });

    // Datepicker
    giantsApp.config(function ($datepickerProvider) {
        angular.extend($datepickerProvider.defaults, {
            dateFormat: 'dd-MM-yyyy',
            modelDateFormat: 'yyyy-MM-dd',
            dateType: 'string',
            startWeek: 1,
            autoclose: true
        });
    });

    // Tooltips
    giantsApp.config(function ($tooltipProvider) {
        angular.extend($tooltipProvider.defaults, {
            animation: 'am-flip-x',
            trigger: 'hover',
            placement: 'auto top'
        });
    });

    // Modals
    giantsApp.config(function ($modalProvider) {
        angular.extend($modalProvider.defaults, {
            html: true,
            backdrop: 'static',
            templateUrl: 'views/modals/template.html'
        });
    });

    // select
    giantsApp.config(function ($selectProvider) {
        angular.extend($selectProvider.defaults, {
            animation: 'am-flip-x',
            maxLength: 1,
            maxLengthHtml: 'gekozen',
            sort: true,
            allNoneButtons: true,
            noneText: 'Geen',
            allText: 'Alles',
            placeholder: 'Maak een selectie'
        });
    });

    // ui select
    giantsApp.config(function (uiSelectConfig) {
        uiSelectConfig.theme = 'bootstrap';
        uiSelectConfig.resetSearchInput = true;
    });

    // Constants
    giantsApp.constant('CONSTANTS', {
        APIPATH: 'http://' + baseUrl + '/api'
    });
}());