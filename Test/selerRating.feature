Feature: Seller rating
 
  In order to view the seler rating
  As a seller
  I need to log in first

Scenario: Seler wants to see ratings for a t-shirt
	Given I am on "Seller/home"
	And navigate to "Seller/Rating"
	When the seller opens a t-shirt product 
	And scrolls down to the bottom of listing 
	Then the buyer will see the rating of the seller
	And I see the selling the product
