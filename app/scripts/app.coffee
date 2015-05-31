'use strict'

###*
 # @ngdoc overview
 # @name onesChallengeApp
 # @description
 # # onesChallengeApp
 #
 # Main module of the application.
###
angular
  .module 'onesChallengeApp', [
    'ngAnimate',
    'ngAria',
    'ngCookies',
    'ngMessages',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ngMaterial',
    'ngMdIcons',
  ]
  .config ($routeProvider, $httpProvider) ->
    $routeProvider
      .when '/',
        templateUrl: 'views/landing.html'
        controller: 'LandingCtrl'
      .when '/about',
        templateUrl: 'views/about.html'
        controller: 'AboutCtrl'
      .otherwise
        redirectTo: '/'

    $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;application/json;charset=utf-8'
