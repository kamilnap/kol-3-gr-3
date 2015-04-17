Feature: I would like to edit egypt

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/egypt/"
    Then I should not see "<egypt>"
     And I follow "Create a new entry"
    Then I should see "Egypt creation"
    When I fill in "Name" with "<egypt>"
     And I fill in "Description" with "<description>"
     And I fill in "Price" with "<price>"
     And I press "Create"
    Then I should see "<egypt>"
     And I should see "<description>"
     And I should see "<price>"

  Examples:
    | egypt     | description          | price |
    | edfu      | to jest opis miasta  | 123   |
    | eram      | to jest opis miasta  | 456   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/egypt/"
    Then I should not see "<new-egypt>"
    When I follow "<old-egypt>"
    Then I should see "<old-egypt>"
    When I follow "Edit"
     And I fill in "Name" with "<new-egypt>"
     And I fill in "Description" with "<new-description>"
     And I fill in "Price" with "<new-price>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-egypt>"
     And I should see "<new-description>"
     And I should see "<new-price>"
     And I should not see "<old-egypt>"

  Examples:
    | old-egypt     | new-egypt  | new-description    | new-price  |
    | edfu          | N-E-W-E-D-F| nowy opis miasta   | 666        |
    | eram          | N-E-W-E-R-A| nowy opis miasta   | 789        |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/egypt/"
    Then I should see "<egypt>"
    When I follow "<egypt>"
    Then I should see "<egypt>"
    When I press "Delete"
    Then I should not see "<egypt>"

  Examples:
    | egypt       |
    | N-E-W-E-D-F |
    | N-E-W-E-R-A |