Feature: I would like to edit Bio

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/bio/"
    Then I should not see "<bio>"
     And I follow "Create a new entry"
    Then I should see "Bio creation"
    When I fill in "Name" with "<bio>"
     And I fill in "Inta" with "<inta>"
     And I press "Create"
    Then I should see "<bio>"
     And I should see "<inta>"

  Examples:
    | bio         | inta|
    | costa       | 11  |
    | costam      | 222 |
    | costamcos   | 33  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/bio/"
    Then I should not see "<new-bio>"
    When I follow "<old-bio>"
    Then I should see "<old-bio>"
    When I follow "Edit"
     And I fill in "Name" with "<new-bio>"
     And I fill in "Inta" with "<new-inta>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-bio>"
     And I should see "<new-inta>"
     And I should see "<old-bio>"

  Examples:
    | old-bio     | new-bio         | new-inta  |
    | costa       | C-O-S-T-A       | 111       |
    | costam      | C-O-S-T-A-M     | 222       |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/bio/"
    Then I should see "<bio>"
    When I follow "<bio>"
    Then I should see "<bio>"
    When I press "Delete"
    Then I should not see "<bio>"

  Examples:
    |  bio    |
    | costamcos   |
    | C-O-S-T-A-M   |
    | C-O-S-T-A   |