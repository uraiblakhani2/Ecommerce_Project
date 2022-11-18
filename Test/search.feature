Feature: searchProducts
  In order to search for products 
  As a user
  I need to enter a search term to get back results 

  Scenario: Searching for "Earrings"
    Given I am on "Main/Index"
    When I input "Earrings" in search bar
    Then I get redirected to "Main/Search" 
    And I see all Earrings

  
