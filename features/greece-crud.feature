Feature: I would like to edit greece

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/greece/"
    Then I should not see "<greece>"
     And I follow "Create a new entry"
    Then I should see "Greece creation"
    When I fill in "Name" with "<greece>"
     And I fill in "Description" with "<description>"
     And I fill in "Population" with "<population>"
     And I press "Create"
    Then I should see "<greece>"
     And I should see "<description>"
     And I should see "<population>"

  Examples:
    | greece      | description                | population |
    | chania      | This is the city of Greece | 108310     |
    | chalcis     | This is the city of Greece | 102420     |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/greece/"
    Then I should not see "<new-greece>"
    When I follow "<old-greece>"
    Then I should see "<old-greece>"
    When I follow "Edit"
     And I fill in "Name" with "<new-greece>"
     And I fill in "Description" with "<new-description>"
     And I fill in "Population" with "<new-population>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-greece>"
     And I should see "<new-description>"
     And I should see "<new-population>"
     And I should not see "<old-greece>"

  Examples:
    | old-greece      | new-greece   | new-description            | new-population |
    | chania          | N-E-W-C-H-A  | This is new city of Greece | 108319         |
    | chalcis         | C-H-A-L-C-I-S| This is new city of Greece | 102429         |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/greece/"
    Then I should see "<greece>"
    When I follow "<greece>"
    Then I should see "<greece>"
    When I press "Delete"
    Then I should not see "<greece>"

  Examples:
    |  greece       |
    | N-E-W-C-H-A   |
    | C-H-A-L-C-I-S |