'use strict'

###*
 # @ngdoc directive
 # @name onesChallengeApp.directive:dropcard
 # @description
 # # dropcard
###
angular.module 'onesChallengeApp'
    .directive 'dropcards', ->
        restrict: 'E'
        template: '<div></div>'
        link: (scope, element, attrs) ->

angular.module 'onesChallengeApp'
    .directive 'dropcard', ->
        restrict: 'E'
        template: '<div class="dropcard md-whiteframe-z2 bg-white"></div>'
        link: (scope, element, attrs) ->
