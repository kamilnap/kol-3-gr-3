Feature: I would like to edit reptiles

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/france/"
    Then I should not see "<france>"
     And I follow "Create a new entry"
    Then I should see "France creation"
    When I fill in "Name" with "<france>"
     And I fill in "Description" with "<description>"
    And I fill in "Price" with "<price>" 
    And I press "Create"
    Then I should see "<france>"
     And I should see "<description>"
     And I should see "<price>"
  Examples:
    | france      | description        | price |
    | lion        | to jest opis lionu | 123   |
    | paris       | to jest opis paris | 345   |
    | nicea       | to jest opis nicea | 678   |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/france/"
    Then I should not see "<new-france>"
    When I follow "<old-france>"
    Then I should see "<old-france>"
    When I follow "Edit"
     And I fill in "Name" with "<new-france>"
     And I fill in "Description" with "<new-description>"
     And I fill in "Price" with "<new-price>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-france>"
     And I should see "<new-description>"
     And I should see "<new-price>"
     And I should not see "<old-france>"

  Examples:
    | old-france      | new-france   | new-description     | new-price |
    | lion            | tuluza       | to jest opis tuluza | 3445      |
    | paris           | lille        | to jest opis lille  | 654       | 


  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/france/"
    Then I should see "<france>"
    When I follow "<france>"
    Then I should see "<france>"
    When I press "Delete"
    Then I should not see "<france>"

  Examples:
    |  france     |
    | nicea       |
    | tuluza      |
    | lille       |