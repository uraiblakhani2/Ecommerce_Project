Feature: Give seller feedback
  In order to give a seller feedback
  As a user
  I need to go on the seller's page

  Scenario: User wants to say that the seller sells good products
    Given I am on "User/Seller"
    When I input the words of praise in text box
    And I click "Submit review" 
    Then it displays a message confirming the submission

  