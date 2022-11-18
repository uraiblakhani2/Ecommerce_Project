Feature: report a listing
  In order to report a seller
  As a user
  I need to address the issue imposed by the seller

  Scenario: Seller delivers broken product
    Given I am on "User/Earrings"
    When I input the problem in text box
    And I click "Submit report" 
    Then it displays a message confirming the submission

  