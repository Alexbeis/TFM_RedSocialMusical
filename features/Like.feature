Feature: Create a Like Object
  As a user
  I want to like in the publication
  and save it on database

  Scenario: Create a valid Like object
    Given a user 1 and publication 10
    When the argument are valid
    Then a new like object should be created
