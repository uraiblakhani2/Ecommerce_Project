Feature: LoginUser
  In order to buy products from the website
  As a user
  I have to be logged in 

  Scenario: Loggin into an account with correct email and password
    Given I am on "User/Login"
    When I input "uraiblakhani2@gmail.com" in email
    And I input "IlovePHP" in password
    And I click the submit
    Then I get redirected to "Main/Index"


  Scenario: Loggin into an account with wrong email or password
    Given I am on "User/Login"
    When I input "uraiblakhani2@gmail.com" in email
    And I input "abcd" in password
    And I click the submit
    Then I see an error that credentials were invalid