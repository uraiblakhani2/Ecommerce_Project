Feature: See product reviews
  In order to see a product review
  As a user
  I need to go on the product page

  Scenario: User wants to see the reviews for "Earrings"
    Given I am on "User/Earrings"
    When I click on "Reviews" button
    Then it displays all users who left a review on the product with their comments

  