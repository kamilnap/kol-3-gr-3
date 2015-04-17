Feature: I would like to edit iran

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/iran/"
    Then I should not see "<iran>"
     And I follow "Create a new entry"
    Then I should see "Iran creation"
    When I fill in "Name" with "<iran>"
     And I fill in "Description" with "<description>"
     And I fill in "Price" with "<price>"
     And I press "Create"
    Then I should see "<iran>"
     And I should see "<description>"
     And I should see "<price>"

  Examples:
    | iran     | description        | price   | 
    | Teheran  | opis Teheran       | 234234  |
    | Boak     | opis Boak          | 3234    |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/iran/"
    Then I should not see "<new-iran>"
    When I follow "<old-iran>"
    Then I should see "<old-iran>"
    When I follow "Edit"
     And I fill in "Name" with "<new-iran>"
     And I fill in "Description" with "<new-description>"
     And I fill in "Price" with "<new-price>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-iran>"
     And I should see "<new-price>"  
     And I should see "<new-price>"
     And I should not see "<old-iran>"

  Examples:
    | old-iran     | new-iran  | new-description    | new-price |
    | Boak         | Lakin     | 9876               |  253235   |      

  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/iran/"
    Then I should see "<iran>"
    When I follow "<iran>"
    Then I should see "<iran>"
    When I press "Delete"
    Then I should not see "<iran>"

  Examples:
    |  iran     |
    | Teheran   |
    | Lakin     |