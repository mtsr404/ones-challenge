'use strict'

describe 'Controller: LandingCtrl', ->

  # load the controller's module
  beforeEach module 'onesChallengeApp'

  LandingCtrl = {}
  scope = {}

  # Initialize the controller and a mock scope
  beforeEach inject ($controller, $rootScope) ->
    scope = $rootScope.$new()
    LandingCtrl = $controller 'LandingCtrl', {
      $scope: scope
    }

  it 'should attach a list of awesomeThings to the scope', ->
    expect(scope.awesomeThings.length).toBe 3
