Feature: Add or remove items from the cart and edit items amount

In order to add, remove or edit item
As a buyer
I need to go on the buyer page.

Scenario: Buyer has 3 t-shirts added to their cart and wants to add one more
	Given the view cart page,  the buyer sees three t-shirts in the cart
	When the buyer clicks the “+” button
	Then buyer will be given an option to add the an item
	when the buyer chose an option add an item
	Then the number will increase by 1 making it 4 t-shirts in the cart


Scenario: Buyer has 3 t-shirts added to their cart and wants to remove one
	Given the view cart page, the buyer sees three t-shirts in the cart
	When the buyer clicks the “-” button
	Then buyer will be given an option to remove the an item
	when the buyer chose an option remove an item
	Then the number will decrease by 1 making it 2 t-shirts in the cart

Scenario: Buyer has 3 t-shirts added to their cart and wants to edit an item. 

	Given the view cart page, the buyer sees three t-shirts in the cart
	When the buyer clicks the “edit” button
	Then the buyer will be given a form about the particular product he he would like to edit. 
	Once changes have been made about the item
	Such informations will be appliet to an item that has been edited. 