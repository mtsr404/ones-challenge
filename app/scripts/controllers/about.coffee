'use strict'

###*
 # @ngdoc function
 # @name onesChallengeApp.controller:AboutCtrl
 # @description
 # # AboutCtrl
 # Controller of the onesChallengeApp
###
angular.module 'onesChallengeApp'
  .controller 'AboutCtrl', ($scope) ->
    $scope.awesomeThings = [
      'HTML5 Boilerplate'
      'AngularJS'
      'Karma'
    ]
