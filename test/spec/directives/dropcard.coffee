'use strict'

describe 'Directive: dropcard', ->

  # load the directive's module
  beforeEach module 'onesChallengeApp'

  scope = {}

  beforeEach inject ($controller, $rootScope) ->
    scope = $rootScope.$new()

  it 'should make hidden element visible', inject ($compile) ->
    element = angular.element '<dropcard></dropcard>'
    element = $compile(element) scope
    expect(element.text()).toBe 'this is the dropcard directive'
