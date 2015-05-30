'use strict'

###*
 # @ngdoc function
 # @name onesChallengeApp.controller:MainCtrl
 # @description
 # # MainCtrl
 # Controller of the onesChallengeApp
###
angular.module 'onesChallengeApp'
  .controller 'MainCtrl', ($scope) ->
    $scope.awesomeThings = [
      'HTML5 Boilerplate'
      'AngularJS'
      'Karma'
    ]
