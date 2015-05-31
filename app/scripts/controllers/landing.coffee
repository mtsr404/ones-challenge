'use strict'

###*
 # @ngdoc function
 # @name onesChallengeApp.controller:LandingCtrl
 # @description
 # # LandingCtrl
 # Controller of the onesChallengeApp
###
angular.module 'onesChallengeApp'
    .controller 'LandingCtrl', ($scope) ->

        # drop card
        $scope.animated = true
        $scope.isPos1 = true
        $scope.isPos2 = false
        $scope.isPos3 = false

        $scope.showDropCard = () ->
            $scope.isPos1 = false
            $scope.isPos2 = true
            $scope.isPos3 = false

        $scope.hideDropCard = () ->
            $scope.isPos1 = true
            $scope.isPos2 = false
            $scope.isPos3 = false

        $scope.nextDropCard = (index, param) ->
            $scope.isPos1 = false
            $scope.isPos2 = false
            $scope.isPos3 = true

