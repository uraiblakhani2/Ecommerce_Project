Feature: Sort orders by date 

  In order to view orders sorted by date
  As a seller
  I need to log in first


Scenario: The seller wants to sort the received orders from newest to oldest
    Given I am on "Seler/home"
	And navigate to "Seller/sortedByDate"
	When the seller hovers on the “Filter by”
	And clicks the button “Newest”
	Then the seller will be able to see all the orders from newest to oldest with the dates


