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

angular.module 'onesChallengeApp'
    .controller 'LandingCtrl', ($scope, $http) ->

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
                switch @cardId
                    when 1
                        $scope.type = param
                    when 2
                        $scope.type = param
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

        # PARAMETERS

        $scope.type = "" # enginner or designer

        $scope.valuePosition = null
        $scope.valueMoney = null

        $scope.skill = ""
        $scope.languageList = () ->
            console.log 'start'
            $http({method: 'GET', url: 'http://52.25.218.97/index.php/api/basic/all.json'})
            .success((data, status, headers, config) ->
                console.log 'success'
            )
            .error((data, status, headers, config) ->
                console.log 'error'
            )

        languageId = {
            first: -1
            second: -1
            third: -1
        }
        $scope.languageName = {
            first: ""
            second: ""
            third: ""
        }
        $scope.languageLevel = {
            first: 10
            second: 6
            third: 3
        }