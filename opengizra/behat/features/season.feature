Feature: Test Season page
  Make sure a season page is presented correctly.

  @api
  Scenario: Test the functionality of drush aliases
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "season" page with id "18"
    Then I should see the heading "Autumn-Winter 2013 Women"

