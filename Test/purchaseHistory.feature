Feature: Purchase history
 
  In order to view the purchase history
  As a buyer
  I need to log in first

Scenario: Buyer wants to see the purchase history
	Given I am on "Buyer/home"
	And navigate to "Buyer/searchHistory"
	When the buyer opens a search history
	And buyer clicks on search history 
	Then the buyer will see the search history
	
