Feature: LogoutUser
  In order to logout from an account
  As a user
  I have to be logged in 

  Scenario: Log-out from an account with correct email and password
    Given I am on "User/Index"
    When I click "Logout" 
    Then I get redirected to "Main/Index"

