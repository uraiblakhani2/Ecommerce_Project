Feature: RegisterUser
  In order to buy products from the website
  As a user
  I have to create an account 

  Scenario: creating an account
    Given I am on "User/Register"
    When I input "uraib" in name
    And I input "uraib2" in username
    And I input "uraiblakhani2@gmail.com" in email 
    And I input "IlovePHP" in password
    And I click the submit
    Then I get redirected to "Main/Index"

