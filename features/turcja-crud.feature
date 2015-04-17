Feature: I would like to edit turcja

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/turcja/"
    Then I should not see "<turcja>"
     And I follow "Create a new entry"
    Then I should see "Turcja creation"
    When I fill in "Name" with "<turcja>"
     And I fill in "Description" with "<description>"
     And I fill in "Price" with "<price>"
     And I press "Create"
    Then I should see "<turcja>"
     And I should see "<description>"
     And I should see "<price>"

  Examples:
    | turcja      | description | price |
    | Konya       | Opis Konya  | 123   |
    | Ankara      | Opis Ankara | 456   |
    | Corum       | Opis Corum  | 789   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/turcja/"
    Then I should not see "<new-turcja>"
    When I follow "<old-turcja>"
    Then I should see "<old-turcja>"
    When I follow "Edit"
     And I fill in "Name" with "<new-turcja>"
     And I fill in "Description" with "<new-description>"
     And I fill in "Price" with "<new-price>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-turcja>"
     And I should see "<new-description>"
     And I should see "<new-price>"
     And I should not see "<old-turcja>"

  Examples:
    | old-turcja      | new-turcja  | new-description    | new-price |
    | Konya           | Usak        | Opis Usak          | 765       |
    | Ankara          | Ordu        | Opis Ordu          | 934       |


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/turcja/"
    Then I should see "<turcja>"
    When I follow "<turcja>"
    Then I should see "<turcja>"
    When I press "Delete"
    Then I should not see "<turcja>"

  Examples:
    |  turcja    |
    | Corum      |
    | Usak       |
    | Ordu       |