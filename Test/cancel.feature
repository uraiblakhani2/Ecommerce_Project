Feature: Cancel an order

In order to cancel order
As a buyer
I need to go on the buyer page.


Scenario: The buyer wants to cancel an order
	Given I am on "User/Buyer"
	And has an item added to the cart
	And the buyer goes into their cart 
	When clicks on the “Cancel order” label
	Then the order will be cancelled and not shown on the orders page

