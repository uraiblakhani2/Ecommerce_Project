Feature: Sort orders by price

  In order to view orders sorted by price
  As a seller
  I need to log in first


Scenario: The seller wants to sort the items by from lowest to highest price
    Given I am on "Seler/home"
	And navigate to "Seller/sortedByPrice"
	When the seller hovers on the “Filter by”
	And clicks the button “Lowest price”
	Then the seller will be able to see the prices from lowest to highest


Scenario: The seller wants to sort the items by from higest to lowest price
    Given I am on "Seler/home"
	And navigate to "Seller/sortedByPrice"
	When the seller hovers on the “Filter by”
	And clicks the button “Highest price”
	Then the seller will be able to see the prices from highest to lowest
