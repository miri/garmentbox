Feature: Test Season page
  Make sure a season page is presented correctly.

  @api @wip
  Scenario: Basic content is shown on the season task list page
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "season" page with id "18"
    Then I should see the heading "Autumn-Winter 2013 Women"
    And the page status is shown as "Design"
    And I should see the following <links>
    | links         |
    | Task List     |
    | Items         |
    | Inventory     |
    | Orders        |
    | Add new task  |

  @api @wip
  Scenario: Content is shown on the season task list itself
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "season" page with id "18"
    Then I should see a table titled "Task list / Item 18" with the following <contents>:
    | Summary     | Status      | Assignee |  Replies | Last updated | Created  | Actions   |
    | Fix marker  | Needs work  | <ignore> |  0       | <ignore>     | <ignore> | <ignore>  |
