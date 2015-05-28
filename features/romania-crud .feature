Feature: I would like to edit romania

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/romania/"
    Then I should not see "<romania>"
     And I follow "Create a new entry"
    Then I should see "Romania creation"
    When I fill in "Name" with "<romania>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<romania>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | romania     | caption                | size  |
    | Bucharest   | Bucharest description  | 123   |
    | Galati      | Galati description     | 456   |
    | Arad        | Arad description       | 789   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/romania/"
    Then I should not see "<new-romania>"
    When I follow "<old-romania>"
    Then I should see "<old-romania>"
    When I follow "Edit"
     And I fill in "Name" with "<new-romania>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-romania>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-romania>"

  Examples:
    | old-romania      | new-romania  | new-caption        | new-size  |
    | Galati           | Deva         | Deva description   | 135       |
    | Arad             | Carei        | Carei description  | 246       |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/romania/"
    Then I should see "<romania>"
    When I follow "<romania>"
    Then I should see "<romania>"
    When I press "Delete"
    Then I should not see "<romania>"

  Examples:
    |  romania    |
    | Bucharest   |
    | Deva        |
    | Carei       |