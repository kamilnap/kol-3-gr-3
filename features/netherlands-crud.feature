Feature: I would like to edit netherlands

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/netherlands/"
    Then I should not see "<netherlands>"
     And I follow "Create a new entry"
    Then I should see "Netherlands creation"
    When I fill in "Name" with "<netherlands>"
     And I fill in "Description" with "<description>"
     And I fill in "Population" with "<population>"
     And I press "Create"
    Then I should see "<netherlands>"
     And I should see "<description>"
     And I should see "<population>"

  Examples:
    | netherlands     | description           | population |
    | almere          | This is the city      | 1500       |
    | sloten          | City in Netherlands   | 1900       |
    



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/netherlands/"
    Then I should not see "<new-netherlands>"
    When I follow "<old-netherlands>"
    Then I should see "<old-netherlands>"
    When I follow "Edit"
     And I fill in "Name" with "<new-netherlands>"
     And I fill in "Description" with "<new-description>"
     And I fill in "Population" with "<new-population>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-netherlands>"
     And I should see "<new-description>"
     And I should see "<new-population>"
     And I should not see "<old-netherlands>"

  Examples:
    | old-netherlands     | new-netherlands  | new-description            | new-population |
    | almere              | deil             | This is the new city       | 1230           |
    | sloten              | buren            | New city in Netherlands    | 2456           |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/netherlands/"
    Then I should see "<netherlands>"
    When I follow "<netherlands>"
    Then I should see "<netherlands>"
    When I press "Delete"
    Then I should not see "<netherlands>"

  Examples:
    | netherlands |
    |  deil       |
    | buren       |
    