Feature: save user
  As a new user
  want to be saved on database


  Scenario: Save user
    Given a email 'me@example.com' and  username 'me' and image '/myimage.jpg'
    Then A user is created