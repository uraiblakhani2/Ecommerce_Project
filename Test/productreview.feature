Feature: Leave product review
  In order to leave a product review 
  As a user
  I need to have purchased a product from the seller

  Scenario: Leaving a product review for "Earrings"
    Given I am on "User/Earrings"
    When I input my thoughts on the product in text box
    And I click "Submit review" 
    Then it displays a message confirming the submission

  
