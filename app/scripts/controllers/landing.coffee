'use strict'

###*
 # @ngdoc function
 # @name onesChallengeApp.controller:LandingCtrl
 # @description
 # # LandingCtrl
 # Controller of the onesChallengeApp
###

# app.config(($httpProvider)->
#     $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;application/json;charset=utf-8'
# )
#
# app.factory('HTTPService', ($http) ->
#
#     return {
#
#         get : (url, params, success, error) ->
#
#             console.log("request url : " + url)
#
#             if (params && params !== undefined)
#                 query = ""
#                 isFirstLoop = true
#                 angular.forEach(params, (value, key) ->
#                     console.log(key + " :  " + value)
#                     query += isFirstLoop ? '?' : '&'
#                     query += encodeURIComponent(key) + "=" + encodeURIComponent(value)
#                     isFirstLoop = false
#                 )
#                 url += query
#             }
#             $http.get(url).success(success).error(error)
#         },
#
#         post : (url, params, success, error) ->
#
#             console.log("request url : " + url)
#
#             if (params && params !== undefined) {
#                 query = ""
#                 isFirstLoop = true
#                 angular.forEach(params, (value, key) ->
#                     console.log(key + " :  " + value)
#                     query += isFirstLoop ? '' : '&'
#                     query += encodeURIComponent(key) + "=" + encodeURIComponent(value)
#                     isFirstLoop = false
#                 )
#                 params = query
#             }
#
#             $http.post(url, params).success(success).error(error)
#         ,
#
# )
#
# app.factory('BaseModel', (HTTPService) ->
#
#     baseURL = 'http:///api/';
#
#     // Session ID
#     sessionID = () ->
#         return localStorage.getItem('sessionID')
#     }
#
#     return {
#
#         send : (options) ->
#
#             if (!options.api)
#                 throw new Error('BaseModel.send must contain "api".')
#
#             url = baseURL + options.api + '.json'
#             success = options.success || ()
#             error = options.error || ()
#
#             defaults = {
#                 env: env(),
#                 app_version: appVersion(),
#                 session_id: sessionID()
#             }
#
#             params = angular.extend({}, defaults, options.params)
#
#             if (options.method === 'GET') {
#                 HTTPService.get(url, params, success, error)
#             else
#                 HTTPService.post(url, params, success, error)
#
#         ,
#
# )



angular.module 'onesChallengeApp'
    .controller 'LandingCtrl', ($scope) ->

        # drop card
        class DropCard
            constructor: (id) ->
                @cardId = id
                @animated = true
                @isPos1 = true
                @isPos2 = false
                @isPos3 = false

            showDropCard: ->
                @animated = true
                @isPos1 = false
                @isPos2 = true
                @isPos3 = false

            hideDropCard: ->
                @isPos1 = true
                @isPos2 = false
                @isPos3 = false
                window.setTimeout(()->
                    resetAllCard()
                , 1000)

            resetDropCard: ->
                @animated = false
                @isPos1 = true
                @isPos2 = false
                @isPos3 = false

            nextDropCard: (param) ->
                @isPos1 = false
                @isPos2 = false
                @isPos3 = true
                card = findCardById(@cardId + 1)
                if card
                    card.showDropCard()

        findCardById = (id) ->
            switch id
                when 1
                    return $scope.firstCard
                when 2
                    return $scope.secondCard
                when 3
                    return $scope.thirdCard
                else
                    return false

        resetAllCard = () ->
            $scope.firstCard.resetDropCard()
            $scope.secondCard.resetDropCard()
            $scope.thirdCard.resetDropCard()

        $scope.firstCard = new DropCard(1)
        $scope.secondCard = new DropCard(2)
        $scope.thirdCard = new DropCard(3)

        $scope.skill = ""
        $scope.languageList = () ->

        $scope.language = {
            first: 10
            second: 6
            third: 3
        }
