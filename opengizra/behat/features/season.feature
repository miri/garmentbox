Feature: Test Season page
  Make sure a season page is presented correctly.

  @api
  Scenario: Basic content is shown on the season task list page.
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

  @api
  Scenario: Content is shown on the season task list itself.
    Given I am logged in as a user with the "authenticated user" role
    And I am on a "season" page with id "18"
    Then I should see a table titled "Task list / Item 18" with the following <contents>:
    | Summary     | Status      | Assignee |  Replies | Last updated | Created  | Actions   |
    | Fix marker  | Needs work  | <ignore> |  0       | <ignore>     | <ignore> | <ignore>  |
    And I should see "Total open tasks: 3"

  @api @wip
  Scenario: Correct content is shown on the season items list.
    Given I am logged in as a user with the "authenticated user" role
    And  I am on "/season/18/items"
    Then I should see a table titled "Pearls Epaulets shirt" with the following <contents>:
    |         | Variant                     | Main material | Status | Retail price | Wholesale price |
    | <image> | White Pearls Epaulets shirt | <image>       |        |              |                 |

