Feature: I would like to edit spain

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/spain/"
    Then I should not see "<spain>"
     And I follow "Create a new entry"
    Then I should see "Spain creation"
    When I fill in "Name" with "<spain>"
     And I fill in "Description" with "<description>"
    And I fill in "Size" with "<size>" 
    And I press "Create"
    Then I should see "<spain>"
     And I should see "<description>"
     And I should see "<size>"
  Examples:
    | spain             | description               | size  |
    | Barcelona         | to jest opis barcelony    | 123   |
    | Madryt            | to jest opis madrytu      | 345   |
    | Valencja          | to jest opis valencji     | 678   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/spain/"
    Then I should not see "<new-spain>"
    When I follow "<old-spain>"
    Then I should see "<old-spain>"
    When I follow "Edit"
     And I fill in "Name" with "<new-spain>"
     And I fill in "Description" with "<new-description>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-spain>"
     And I should see "<new-description>"
     And I should see "<new-size>"
     And I should not see "<old-spain>"

  Examples:
    | old-spain            | new-spain      | new-description       | new-size |
    | Barcelona            | Malaga         | to jest opis malagi   | 3445     |
    | Madryt               | Sevilla        | to jest opis sevilli  | 654      | 


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/spain/"
    Then I should see "<spain>"
    When I follow "<spain>"
    Then I should see "<spain>"
    When I press "Delete"
    Then I should not see "<spain>"

  Examples:
    |  spain         |
    | Valencia       |
    | Malaga         |
    | Sevilla        |