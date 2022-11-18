Feature: FilterUser
  In order to filter product on the website
  As a user
  I have to be    

  Scenario: User wants to sort earrings by lowest price to highest
    Given I am on "Main/search"
    When I click sort on price
    Then I see all Earrings in inscreasing price order 

